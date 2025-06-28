<?php

namespace App\Http\Controllers\API\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Payment;
use App\Models\TaskAssignment;
use App\Models\Block;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    public function agentPayment($id)
    {
        $agent = User::where('id', $id)
            ->where('access_level', 'Assembly_Agent')
            ->first();

        if (empty($agent)) {
            return response()->json([
                'message' => 'Agent not found, enter agent account id, or the user is not an agent'
            ], 422);
        }

        $payments = Payment::orderBy('created_at', 'DESC')
            ->with(['assembly', 'bill'])
            ->where('created_by', $agent->id)
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

        $dailyTotal = Payment::where('created_by', $agent->id)
            ->whereDate('created_at', now()->toDateString())
            ->where(function ($query) {
                $query->where('payment_mode', 'momo')
                    ->where('transaction_status', 'Success')
                    ->orWhere('payment_mode', '<>', 'momo');
            })
            ->sum('amount');

        $weeklyTotal = Payment::where('created_by', $agent->id)
            ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->where(function ($query) {
                $query->where('payment_mode', 'momo')
                    ->where('transaction_status', 'Success')
                    ->orWhere('payment_mode', '<>', 'momo');
            })
            ->sum('amount');

        $monthlyTotal = Payment::where('created_by', $agent->id)
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->where(function ($query) {
                $query->where('payment_mode', 'momo')
                    ->where('transaction_status', 'Success')
                    ->orWhere('payment_mode', '<>', 'momo');
            })
            ->sum('amount');

        $yearlyTotal = Payment::where('created_by', $agent->id)
            ->whereYear('created_at', now()->year)
            ->where(function ($query) {
                $query->where('payment_mode', 'momo')
                    ->where('transaction_status', 'Success')
                    ->orWhere('payment_mode', '<>', 'momo');
            })
            ->sum('amount');

        $totals = [
            'daily_payments' => isset($dailyTotal) ? $dailyTotal : 0,
            'weekly_payments' => isset($weeklyTotal) ? $weeklyTotal : 0,
            'monthly_payments' => isset($monthlyTotal) ? $monthlyTotal : 0,
            'year_payments' => isset($yearlyTotal) ? $yearlyTotal : 0
        ];

        return response()->json([
            'message' => 'Get agent payment collections',
            'data' => $payments,
            'totals' => $totals
        ]);
    }

    public function agentTask(Request $request, $id)
    {
        $agent = User::where('id', $id)
            ->where('access_level', 'Assembly_Agent')
            ->first();

        if (empty($agent)) {
            return response()->json([
                'message' => 'Agent not found or the user is not an agent, check and try again'
            ], 422);
        }

        $taskAssignments = TaskAssignment::orderBy('created_at', 'DESC')
            ->with(['supervisor', 'agent', 'assembly'])
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->when($request->user()->access_level == 'Assembly_Supervisor', function ($query) use ($request) {
                $query->where('supervisor_id', $request->user()->id);
            })
            ->when($request->user()->access_level == 'Assembly_Agent', function ($query) use ($request) {
                $query->where('agent_id', $request->user()->id);
            })
            ->where('agent_id', $agent->id)
            ->get()
            ->map(function ($assignment) {
                $assignment->block_data = collect($assignment->block_data)->map(function ($block) {
                    $blockModel = Block::find($block['block_id']);
                    $block['block_name'] = $blockModel ? $blockModel->block_name : 'Unknown';
                    return $block;
                })->toArray();

                $assignment->block_count = count($assignment->block_data);

                return $assignment;
            });

        return response()->json([
            'message' => 'Get all agent task assignments',
            'data' => $taskAssignments
        ]);
    }

    public function dashboardData($id)
    {
        $now = Carbon::now();
        $startOfYear = $now->copy()->firstOfYear();

        $agent = User::where('id', $id)
            ->where('access_level', 'Assembly_Agent')
            ->first();

        if (empty($agent)) {
            return response()->json([
                'message' => 'Agent not found or the user is not an agent, check and try again'
            ], 422);
        }

        $totalProperties = DB::table('properties')->where('created_by', $agent->id)->count();

        $totalBillsDistributed = DB::table('bills')
            ->where('issue_bill', 'Yes')
            ->where('issued_by', $agent->id)
            ->count();

        $totalBillsAmount = DB::table('bills')
            ->join('properties', 'bills.property_id', '=', 'properties.id')
            ->where('properties.created_by', $agent->id)
            ->sum('bills.amount');

        $paymentsQuery = DB::table('payments')
            ->where(function ($q) {
                $q->where('payment_mode', '!=', 'momo')
                    ->orWhere(function ($q2) {
                        $q2->where('payment_mode', 'momo')
                            ->where('transaction_status', 'Success');
                    });
            })
            ->where('created_by', $agent->id);

        $totalPaymentsCount = $paymentsQuery->count();
        $totalAmountCollected = $paymentsQuery->sum('amount');

        $monthlyPayments = DB::table('payments')
            ->whereBetween('created_at', [$startOfYear, $now])
            ->where(function ($q) {
                $q->where('payment_mode', '!=', 'momo')
                    ->orWhere(function ($q2) {
                        $q2->where('payment_mode', 'momo')
                            ->where('transaction_status', 'Success');
                    });
            })
            ->select(
                DB::raw("DATE_FORMAT(created_at, '%b \'%y') as month"),
                DB::raw('SUM(amount) as total'),
                DB::raw('COUNT(*) as count')
            )
            ->groupBy('month')
            ->orderByRaw('STR_TO_DATE(month, \'%b \\\'%y\')')
            ->where('created_by', $agent->id)
            ->get();

        $propertyTypes = DB::table('properties')
            ->join('business_class_types', 'properties.entity_type', '=', 'business_class_types.id')
            ->select('business_class_types.category as type', DB::raw('COUNT(*) as count'))
            ->groupBy('category')
            ->where('properties.created_by', $agent->id)
            ->get();

        $paymentsByType = DB::table('payments')
            ->join('bills', 'payments.bills_id', '=', 'bills.bills_id')
            ->join('properties', 'bills.property_id', '=', 'properties.id')
            ->join('business_class_types', 'properties.entity_type', '=', 'business_class_types.id')
            ->where(function ($q) {
                $q->where('payment_mode', '!=', 'momo')
                    ->orWhere(function ($q2) {
                        $q2->where('payment_mode', 'momo')
                            ->where('transaction_status', 'Success');
                    });
            })
            ->select('business_class_types.category as type', DB::raw('SUM(payments.amount) as total'))
            ->groupBy('category')
            ->where('payments.created_by', $agent->id)
            ->get();

        return response()->json([
            'message' => 'Get agent dashboard data',
            'data' => [
                'summary' => [
                    'total_properties' => $totalProperties,
                    'total_payments' => $totalPaymentsCount,
                    'total_bills_distributed' => $totalBillsDistributed,
                    'total_bills_amount' => (float) $totalBillsAmount,
                    'total_amount_collected' => (float) $totalAmountCollected,
                ],
                'monthly_payments' => $monthlyPayments,
                'property_types' => $propertyTypes,
                'payments_by_type' => $paymentsByType,
            ]
        ]);
    }
}
