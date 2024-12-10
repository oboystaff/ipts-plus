<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Payment\CreatePaymentRequest;
use Illuminate\Http\Request;
use App\Models\Bill;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        if (!auth()->user()->can('payments.view')) {
            abort(403, 'Unauthorized action.');
        }

        $payments = Payment::orderBy('created_at', 'DESC')
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->when($request->display == "daily", function ($query) {
                $query->whereDate('created_at', [now()->format('Y-m-d')]);
            })
            ->when($request->display == "weekly", function ($query) {
                $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
            })
            ->when($request->display == "monthly", function ($query) {
                $query->whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()]);
            })
            ->when($request->display == "yearly", function ($query) {
                $query->whereBetween('created_at', [now()->startOfYear(), now()->endOfYear()]);
            })
            ->get();

        $total = number_format($payments->sum('amount'), 2);

        return view('payments.index', compact('payments', 'total'));
    }

    public function create(Bill $bill)
    {
        if (!auth()->user()->can('payments.create')) {
            abort(403, 'Unauthorized action.');
        }

        return view('payments.create', compact('bill'));
    }

    public function customerCreate(Bill $bill)
    {
        return view('payments.customer-create', compact('bill'));
    }

    public function store(CreatePaymentRequest $request)
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

                if ($request->user()->access_level !== 'customer') {
                    return redirect()->route('payments.index')->with(
                        'status',
                        'Payment processed successfully. Kindly ' . $data['prompt']
                    );
                } else {
                    return redirect()->route('dashboard.operational')->with(
                        'status',
                        'Payment processed successfully. Kindly ' . $data['prompt']
                    );
                }
            } else {
                // Handle payment initiation failure
                if ($request->user()->access_level !== 'customer') {
                    return redirect()->route('payments.index')->with('error', 'Failed to initiate payment. Please try again.');
                } else {
                    return redirect()->route('dashboard.operational')->with('error', 'Failed to initiate payment. Please try again.');
                }
            }
        } else {
            if ($request->user()->access_level !== 'customer') {
                return redirect()->route('payments.index')->with('status', 'Payment processed successfully');
            } else {
                return redirect()->route('dashboard.operational')->with('status', 'Payment processed successfully');
            }
        }
    }

    public function show(Payment $payment)
    {
        return view('payments.show', compact('payment'));
    }

    public function receipt(Payment $payment)
    {
        return view('payments.receipt', compact('payment'));
    }

    public function edit() {}

    public function update() {}
}
