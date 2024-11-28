<?php

namespace App\Http\Controllers\API\Payment;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Payment\CreatePaymentRequest;
use App\Models\Payment;
use App\Models\Citizen;
use Illuminate\Http\Request;


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
        $paymentData = [
            'bills_id' => $request->input('bills_id'),
            'amount' => $request->input('amount'),
            'payment_mode' => $request->input('payment_mode'),
            'phone' => $request->input('phone'),
            'network' => $request->input('network'),
            'transaction_status' => $request->input('payment_mode') == 'momo' ? 'Pending' : 'Success',
            'assembly_code' => $request->input('assembly_code'),
            'created_by' => $request->user()->id ?? null
        ];

        $payment = Payment::create($paymentData);

        if ($request->input('payment_mode') == 'momo') {
            $client = new \GuzzleHttp\Client();

            $apiKey = '$2a$10$YKxaeD8IwH1SoCa0VrCHwuKXAELu8h2HFd8AsyPBs4k1YBovs2UhS';
            $apiId = '1647';

            $response = $client->post('https://api.reddeonline.com/v1/receive', [
                'headers' => [
                    'ApiKey' => $apiKey,
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    'Cache-Control' => 'no-cache'
                ],
                'json' => [
                    'amount' => $request->input('amount'),
                    'appid' => $apiId,
                    'clientreference' => '123456',
                    'clienttransid' => 'test2025donlinetest',
                    'description' => 'Yearly Bill Payment',
                    'nickname' => 'Yearly Bill Payment',
                    'paymentoption' => $request->input('network'),
                    'walletnumber' => $request->input('phone')
                ]
            ]);

            $body = json_decode($response->getBody(), true);

            if ($body['status'] === 'OK') {

                $data = [
                    'transaction_id' => $body['transactionid'],
                    'prompt' => $body['reason']
                ];

                $payment->update($data);

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
            ->orWhere('bills_id', $id)
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
}
