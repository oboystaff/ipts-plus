<?php

namespace App\Http\Controllers\API\Agent;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\TaskAssignment\UpdateTaskAssignment;
use App\Http\Requests\API\TaskAssignment\UploadReportRequest;
use App\Http\Requests\API\User\UpdateUserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Block;
use Illuminate\Support\Facades\Hash;
use App\Models\TaskAssignment;
use App\Models\Payment;
use App\Models\ReportUpload;

class AgentController extends Controller
{
    public function index(Request $request)
    {
        $data = User::orderBy('created_at', 'DESC')
            ->with(['assembly', 'division'])
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->where('access_level', 'Assembly_Agent')
            ->get();

        return response()->json([
            'message' => 'Get all agents',
            'data' => $data
        ]);
    }

    public function show($id)
    {
        $user = User::query()
            ->with(['assembly', 'division'])
            ->where('id', $id)
            ->where('access_level', 'Assembly_Agent')
            ->first();

        if (empty($user)) {
            return response()->json([
                'message' => 'Agent not found'
            ], 422);
        }

        return response()->json([
            'message' => 'Get particular agent',
            'data' => $user
        ]);
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $data = $request->validated();

        $user = User::query()
            ->with(['assembly', 'division'])
            ->where('id', $id)
            ->first();

        if (empty($user)) {
            return response()->json([
                'message' => 'Agent not found'
            ], 422);
        }

        if (empty($request->validated('password'))) {
            $data['password'] = $user->password;
        } else {
            $data['password'] = Hash::make($data['password']);
        }

        $user->update($data);

        return response()->json([
            'message' => 'Agent record updated successfully'
        ]);
    }

    public function agentTask(Request $request)
    {
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
            'message' => 'Get all task assignments',
            'data' => $taskAssignments
        ]);
    }

    public function agentTaskShow(Request $request, $id)
    {
        $taskAssignment = TaskAssignment::orderBy('created_at', 'DESC')
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
            ->where('id', $id)
            ->first();

        if ($taskAssignment) {
            $taskAssignment->block_data = collect($taskAssignment->block_data)->map(function ($block) {
                $blockModel = Block::find($block['block_id']);
                $block['block_name'] = $blockModel ? $blockModel->block_name : 'Unknown';
                return $block;
            })->toArray();

            $taskAssignment->block_count = count($taskAssignment->block_data);
        }

        if (empty($taskAssignment)) {
            return response()->json([
                'message' => 'Agent assignment not found'
            ], 422);
        }

        return response()->json([
            'message' => 'Get particular task assignmnet',
            'data' => $taskAssignment
        ]);
    }

    public function agentTaskAssignment(Request $request, $id)
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

    public function agentPayment($id)
    {
        $agent = User::where('id', $id)
            ->where('access_level', 'Assembly_Agent')
            ->first();

        if (empty($agent)) {
            return response()->json([
                'message' => 'Agent not found, or the user is not an agent'
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

        return response()->json([
            'message' => 'Get agent payment collection',
            'data' => $payments
        ]);
    }

    public function taskUpdate(UpdateTaskAssignment $request, $id)
    {
        $taskAssignment = TaskAssignment::where('id', $id)->first();

        if (empty($taskAssignment)) {
            return response()->json([
                'message' => 'Agent task assignment not found'
            ], 422);
        }

        $blockData = $taskAssignment->block_data;

        $statusUpdate = [
            $request->block_id => $request->status,
        ];

        // Update the block_data
        foreach ($blockData as &$data) {
            if (array_key_exists($data['block_id'], $statusUpdate)) {
                $data['status'] = $statusUpdate[$data['block_id']];
            }
        }

        $taskAssignment->block_data = $blockData;
        $taskAssignment->save();

        return response()->json([
            'message' => 'Task assignment status updated successfully'
        ]);
    }

    public function uploadReport(UploadReportRequest $request)
    {
        if ($request->hasFile('file_path')) {
            $file = $request->file('file_path');
            $file_name = ReportUpload::generateFileName();
            $file_name = $file_name . '.' . $file->getClientOriginalExtension();
            $fileDestinationPath = storage_path('app/public/files');
            $file->move($fileDestinationPath, $file_name);
        }

        $data = $request->validated();
        $data['created_by'] = $request->user()->id ?? '';
        $data['file_path'] = $file_name ?? null;

        ReportUpload::create($data);

        return response()->json([
            'message' => 'Task assignment report uploaded successfully',
        ]);
    }
}
