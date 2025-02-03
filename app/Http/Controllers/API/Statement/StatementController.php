<?php

namespace App\Http\Controllers\API\Statement;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Statement\BillStatementRequest;
use App\Http\Requests\API\Statement\PaymentStatementRequest;
use Illuminate\Http\Request;
use App\Models\Bill;
use App\Models\Citizen;
use App\Models\Payment;
use App\Mail\BillStatementMail;
use App\Mail\PaymentStatementMail;
use Illuminate\Support\Facades\Mail;


class StatementController extends Controller
{
    public function billStatement(BillStatementRequest $request)
    {
        $message = "";
        $customer = Citizen::where('user_id', $request->input('user_id'))
            ->orWhere('id', $request->input('user_id'))
            ->first();

        if (empty($customer)) {
            return response()->json([
                'message' => 'Customer not found, enter customer account id'
            ], 422);
        }

        $bills = Bill::orderBy('created_at', 'DESC')
            ->with(['property', 'business', 'assembly', 'payments'])
            ->where(function ($query) use ($customer) {
                $query->whereHas('property', function ($q) use ($customer) {
                    $q->where('customer_name',  $customer->id);
                })
                    ->whereNotNull('property_id')
                    ->whereNull('business_id');
            })
            ->orWhere(function ($query) use ($customer) {
                $query->whereHas('business', function ($q) use ($customer) {
                    $q->where('citizen_account_number', $customer->id);
                })
                    ->whereNotNull('business_id')
                    ->whereNull('property_id');
            })
            ->get()
            ->map(function ($bill) {
                if (is_null($bill->property_id)) {
                    $bill->bill_type = 'Business Bill';
                } elseif (is_null($bill->business_id)) {
                    $bill->bill_type = 'Property Bill';
                } else {
                    $bill->bill_type = 'Unknown';
                }

                return $bill;
            });

        $totalArrears = $bills->sum('arrears');
        $totalAmount = $bills->sum('amount');

        if ($bills->isNotEmpty()) {
            $this->sendBillStatementEmail($customer, $request->input('email'), $bills, $totalArrears, $totalAmount);
            $message = 'Bill statement sent to the customer via the email provided';
        } else {
            $message = 'Customer has no bill statement';
        }

        return response()->json([
            'message' => $message,
            'data' => $bills
        ]);
    }

    public function paymentStatement(PaymentStatementRequest $request)
    {
        $message = "";
        $customer = Citizen::where('user_id', $request->input('user_id'))
            ->orWhere('id', $request->input('user_id'))
            ->first();

        if (empty($customer)) {
            return response()->json([
                'message' => 'Customer not found, enter customer account id'
            ], 422);
        }

        $payments = Payment::orderBy('created_at', 'DESC')
            ->with(['assembly', 'bill'])
            ->where(function ($query) {
                $query->where('payment_mode', 'momo')
                    ->where('transaction_status', 'Success')
                    ->orWhere('payment_mode', '!=', 'momo');
            })
            ->whereHas('bill', function ($query) use ($customer) {
                $query->whereHas('property', function ($propertyQuery) use ($customer) {
                    $propertyQuery->where('customer_name', $customer->id)
                        ->whereNotNull('property_id')
                        ->whereNull('business_id');
                })
                    ->orWhereHas('business', function ($businessQuery) use ($customer) {
                        $businessQuery->where('citizen_account_number', $customer->id)
                            ->whereNotNull('business_id')
                            ->whereNull('property_id');
                    });
            })
            ->get()
            ->map(function ($payment) {
                if (is_null($payment->bill->property_id)) {
                    $payment->bill_type = 'Business Bill';
                } elseif (is_null($payment->bill->business_id)) {
                    $payment->bill_type = 'Property Bill';
                } else {
                    $payment->bill_type = 'Unknown';
                }

                return $payment;
            });

        $totalAmount = $payments->sum('amount');

        if ($payments->isNotEmpty()) {
            $this->sendPaymentStatementEmail($customer, $request->input('email'), $payments, $totalAmount);
            $message = 'Payment statement sent to the customer via the email provided';
        } else {
            $message = 'Customer has no payment statement';
        }

        return response()->json([
            'message' => $message,
            'data' => $payments
        ]);
    }

    public function sendBillStatementEmail($customer, $email, $bills, $totalArrears, $totalAmount)
    {
        $firstname = $customer->first_name ?? '';
        $lastname = $customer->last_name ?? '';
        $name = $firstname . " " . $lastname;

        $details = [
            'message' => 'Please find below your latest bill statement.',
            'name' => $name ?? '',
            'bills' => $bills,
            'total_arrears' => isset($totalArrears) ? number_format($totalArrears, 2) : 0,
            'total_amount' => isset($totalAmount) ? number_format($totalAmount, 2) : 0
        ];

        Mail::to($email)->send(new BillStatementMail($details));
    }

    public function sendPaymentStatementEmail($customer, $email, $payments, $totalAmount)
    {
        $firstname = $customer->first_name ?? '';
        $lastname = $customer->last_name ?? '';
        $name = $firstname . " " . $lastname;

        $details = [
            'message' => 'Please find below your latest payment statement.',
            'name' => $name ?? '',
            'payments' => $payments,
            'total_amount' => isset($totalAmount) ? number_format($totalAmount, 2) : 0
        ];

        Mail::to($email)->send(new PaymentStatementMail($details));
    }
}
