<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Payment\CreatePaymentRequest;
use App\Models\AuditTrail;
use Illuminate\Http\Request;
use App\Models\Bill;
use App\Models\Payment;
use App\Models\ServiceRequest;
use Illuminate\Support\Facades\DB;
use App\Actions\Payment\MakePayment;
use App\Jobs\Payment\SendPaymentSMS;


class PaymentController extends Controller
{
    public function index(Request $request)
    {
        if (!auth()->user()->can('payments.view')) {
            abort(403, 'Unauthorized action.');
        }

        $payments = Payment::orderBy('created_at', 'DESC')
            ->when(!empty($request->user()->regional_code), function ($query) use ($request) {
                $query->whereHas('assembly', function ($q) use ($request) {
                    $q->where('regional_code', $request->user()->regional_code);
                });
            })
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
            ->when($request->status, function ($query) use ($request) {
                $query->where('transaction_status', $request->status);
            })
            ->when($request->payment_mode, function ($query) use ($request) {
                $query->where('payment_mode', $request->payment_mode);
            })
            ->when($request->from_date && $request->to_date, function ($query) use ($request) {
                $query->whereBetween('created_at', [$request->from_date, $request->to_date]);
            })
            ->get();

        $successfulPayments = $payments->filter(function ($payment) {
            return ($payment->payment_mode === 'momo' && $payment->transaction_status === 'Success') ||
                $payment->payment_mode === 'cash';
        });

        $pendingPayments = $payments->filter(function ($payment) {
            return $payment->payment_mode === 'momo' && $payment->transaction_status === 'Pending';
        });

        $failedPayments = $payments->filter(function ($payment) {
            return $payment->payment_mode === 'momo' && $payment->transaction_status === 'Failed';
        });

        $totalSuccessfulPayments = $successfulPayments->sum('amount');
        $totalPendingPayments = $pendingPayments->sum('amount');
        $totalFailedPayments = $failedPayments->sum('amount');

        $total = number_format($payments->sum('amount'), 2);

        // Yearly payment trends
        $yearlyPaymentData = Payment::selectRaw('YEAR(created_at) as year, SUM(amount) as total')
            ->groupBy('year')
            ->get()
            ->pluck('total', 'year')->toArray();

        $yearLabels = array_keys($yearlyPaymentData);
        $yearlyPaymentData = array_values($yearlyPaymentData);

        // Monthly payment trends (within the selected year)
        $monthlyPaymentData = Payment::selectRaw('MONTH(created_at) as month, SUM(amount) as total')
            ->groupBy('month')
            ->whereYear('created_at', now()->year)
            ->get()
            ->pluck('total', 'month')->toArray();

        $monthLabels = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $monthlyPaymentData = array_values($monthlyPaymentData);

        // Momo payment vs Assembly (Yearly)
        $momoPaymentByAssembly = Payment::selectRaw('assembly_code, SUM(amount) as total')
            ->where('payment_mode', 'momo')
            ->groupBy('assembly_code')
            ->get()
            ->pluck('total', 'assembly_code')->toArray();

        $assemblyLabels = array_keys($momoPaymentByAssembly);
        $momoPaymentByAssembly = array_values($momoPaymentByAssembly);

        // Payment Status Breakdown by Assembly
        $statusData = Payment::selectRaw('transaction_status, COUNT(*) as count')
            ->groupBy('transaction_status')
            ->get()
            ->pluck('count', 'transaction_status')->toArray();

        $statusLabels = ['Success', 'Pending', 'Failed'];
        $statusData = array_values($statusData);

        $yearlyPayments = Payment::groupBy(DB::raw('YEAR(created_at)'))
            ->select(DB::raw('YEAR(created_at) as year'), DB::raw('SUM(amount) as total'))
            ->get();

        $momoPayments = Payment::groupBy(DB::raw('YEAR(created_at)'))
            ->select(DB::raw('YEAR(created_at) as year'), DB::raw('SUM(amount) as total'))
            ->get();

        $paymentStatus = Payment::select(DB::raw('transaction_status, COUNT(*) as count'))
            ->groupBy('transaction_status')
            ->get();

        $data = [
            'totalSuccessfulPayments' => isset($totalSuccessfulPayments) ? number_format($totalSuccessfulPayments, 2) : 0,
            'totalPendingPayments' => isset($totalPendingPayments) ? number_format($totalPendingPayments, 2) : 0,
            'totalFailedPayments' => isset($totalFailedPayments) ? number_format($totalFailedPayments, 2) : 0,
            'yearLabels' => $yearLabels,
            'yearlyPaymentData' => $yearlyPaymentData,
            'monthLabels' => $monthLabels,
            'monthlyPaymentData' => $monthlyPaymentData,
            'assemblyLabels' => $assemblyLabels,
            'momoPaymentByAssembly' => $momoPaymentByAssembly,
            'statusLabels' => $statusLabels,
            'statusData' => $statusData,
            'yearlyPayments' => $yearlyPayments,
            'momoPayments' => $momoPayments,
            'paymentStatus' => $paymentStatus
        ];

        return view('payments.index', compact('payments', 'total', 'data'));
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
            //Cash payment

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

    public function makePayment(Request $request)
    {
        $paymentId = $request->input('payment_id');

        $payment = Payment::where('id', $paymentId)->first();

        $payment->update(['transaction_status' => 'Success']);

        //Send SMS
        dispatch(new SendPaymentSMS($payment));

        session()->flash('status', 'Payment made successfully');

        return response()->json(['message' => 'Payment made successfully']);
    }
}
