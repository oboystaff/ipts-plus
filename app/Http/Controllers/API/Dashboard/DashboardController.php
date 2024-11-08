<?php

namespace App\Http\Controllers\API\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Payment;
use App\Models\TaskAssignment;
use App\Models\Block;


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
}
