<?php

namespace App\Http\Controllers\API\Payment;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Payment\CreatePaymentRequest;
use App\Models\Payment;
use App\Models\Citizen;
use Illuminate\Http\Request;
use App\Actions\Payment\MakePayment;
use App\Models\AuditTrail;
use App\Models\ServiceRequest;


class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $data = Payment::orderBy('created_at', 'DESC')
            ->with(['assembly', 'bill'])
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->get();

        return response()->json([
            'message' => 'Get all payments',
            'data' => $data
        ]);
    }

    public function makePayment(CreatePaymentRequest $request)
    {
        do {
            $transactionID = str_pad(mt_rand(1, 999999999999), 12, '0', STR_PAD_LEFT);
        } while (Payment::where('transaction_id', $transactionID)->exists());

        $paymentData = [
            'bills_id' => $request->input('bills_id'),
            'amount' => $request->input('amount'),
            'payment_mode' => $request->input('payment_mode'),
            'phone' => $request->input('phone'),
            'network' => $request->input('network'),
            // 'transaction_id' => $request->input('payment_mode') == 'momo' ? $transactionID : null,
            'transaction_status' => $request->input('payment_mode') == 'momo' ? 'Pending' : 'Success',
            'assembly_code' => $request->input('assembly_code'),
            'created_by' => $request->user()->id ?? null
        ];

        $payment = Payment::create($paymentData);

        if ($request->input('payment_mode') == 'momo') {
            $amount = $payment->amount;
            $phone = $payment->phone;
            $network = $payment->network;

            $response = MakePayment::acceptPayment($amount, $phone, $network);

            if ($response['status'] === 'OK') {

                $data = [
                    'transaction_id' => $response['transactionid'],
                    'prompt' => $response['reason']
                ];

                $payment->update($data);

                $serviceData = [
                    'user_id' => $request->user()->id,
                    'service_used' => 'Bill Payment',
                    'usage_date' => now(),
                    'service_channel' => 'Web Portal',
                    'status' => 'Completed'
                ];

                $auditTrailData = [
                    'user_id' => $request->user()->id,
                    'action_performed' => 'Bill Payment',
                    'action_date' => now(),
                    'ip_address' => $request->ip(),
                    'device_used' => request()->userAgent(),
                    'remarks' => 'Success'
                ];

                ServiceRequest::create($serviceData);
                AuditTrail::create($auditTrailData);


                return response()->json([
                    'message' => 'Payment processed successfully. Kindly ' . $data['prompt'],
                    'data' => $payment
                ]);
            } else {
                // Handle payment initiation failure

                return response()->json([
                    'message' => 'Failed to initiate payment. Please try again.'
                ]);
            }
        }
    }

    public function show($id)
    {
        $payment = Payment::where('id', $id)
            ->with(['assembly', 'bill'])
            ->first();

        if (empty($payment)) {
            return response()->json([
                'message' => 'Payment not found'
            ], 422);
        }

        return response()->json([
            'message' => 'Get particular payment',
            'data' => $payment
        ]);
    }

    public function customerPayment($id)
    {
        $customer = Citizen::where('user_id', $id)
            ->orWhere('id', $id)
            ->first();

        if (empty($customer)) {
            return response()->json([
                'message' => 'Customer not found, enter customer account id'
            ], 422);
        }

        $payments = Payment::orderBy('created_at', 'DESC')
            ->with(['assembly', 'bill'])
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

        return response()->json([
            'message' => 'Get customer payments',
            'data' => $payments
        ]);
    }

    public function paymentCallback(Request $request)
    {
        // Log the full request for debugging
        \Log::info('Payment Callback Received:', $request->all());

        $payment = Payment::where('transaction_id', $request->transaction_id)->first();

        if (!$payment) {
            return response()->json(['error' => 'Payment not found'], 404);
        }

        // Update the payment record based on the status
        $payment->update([
            'status' => ucfirst($request->status)
        ]);
    }
}
