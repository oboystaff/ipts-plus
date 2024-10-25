<?php

namespace App\Http\Controllers\TaskAssignment;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskAssignment\CreateTaskAssignmentRequest;
use App\Http\Requests\TaskAssignment\UpdateTaskAssignmentRequest;
use App\Models\Block;
use App\Models\Division;
use App\Models\TaskAssignment;
use App\Models\User;
use Illuminate\Http\Request;
use stdClass;

class TaskAssignmentController extends Controller
{
    public function index(Request $request)
    {
        $taskAssignments = TaskAssignment::orderBy('created_at', 'DESC')
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->when($request->user()->access_level == 'Assembly_Supervisor', function ($query) use ($request) {
                $query->where('supervisor_id', $request->user()->id);
            })
            ->when($request->user()->access_level == 'Assembly_Agent', function ($query) use ($request) {
                $query->where('agent_id', $request->user()->id);
            })
            ->get();

        foreach ($taskAssignments as $assignment) {
            $blockData = $assignment->block_data;
            $assignment->block_count = count($blockData);
        }

        return view('task-assignments.index', compact('taskAssignments'));
    }

    public function create(Request $request)
    {
        $loggedInSupervisorId = $request->user()->id;
        $agents = User::where('access_level', 'Assembly_Agent')
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->where('status', 'Active')
            ->whereIn('id', function ($query) use ($loggedInSupervisorId) {
                $query->select('agent_id')
                    ->from('agent_assignments')
                    ->where('supervisor_id', $loggedInSupervisorId);
            })
            ->get();

        $supervisor = User::where('access_level', 'Assembly_Supervisor')
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->where('id', $request->user()->id)
            ->where('status', 'Active')
            ->first();

        $division = Division::where('division_code', $request->user()->division_code)->first();
        if ($division) {
            $blocks = Block::orderBy('block_name', 'ASC')
                ->where('division_code', $division->id)
                ->get();
        }

        $assembly = $request->user()->assembly->name ?? '';
        $assemblyCode = $request->user()->assembly_code;

        $data = [
            'assembly' => isset($assembly) ? $assembly : 'N/A',
            'assemblyCode' => isset($assemblyCode) ? $assemblyCode : 'N/A'
        ];

        return view('task-assignments.create', compact('agents', 'supervisor', 'data', 'blocks'));
    }

    public function store(CreateTaskAssignmentRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = $request->user()->id;

        $blockData = [];
        foreach ($data['block_data'] as $blockId) {
            $blockData[] = [
                'block_id' => $blockId,
                'status' => 'Pending',
            ];
        }

        $data['block_data'] = $blockData;

        TaskAssignment::create($data);

        return redirect()->route('task-assignments.index')->with('status', 'Task assignment created successfully.');
    }

    public function show(Request $request, TaskAssignment $taskAssignment)
    {
        $blockData = $taskAssignment->block_data;

        $status = [];
        foreach ($blockData as $data) {
            $status[$data['block_id']] = $data['status'];
        }

        $blockIds = array_column($blockData, 'block_id');
        $blocks = Block::whereIn('id', $blockIds)
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->get()
            ->map(function ($block) use ($taskAssignment, $status) {
                $result = new stdClass();
                $result->block_code = $block->block_code;
                $result->block_name = $block->block_name;
                $result->assembly = $block->assembly->name ?? '';
                $result->created_by = $taskAssignment->createdBy->name ?? '';
                $result->created_at = $taskAssignment->created_at;
                $result->status = $status[$block->id] ?? '';
                $result->task = $taskAssignment->task;
                return $result;
            });

        return view('task-assignments.show', compact('taskAssignment', 'blocks'));
    }

    public function edit(Request $request, TaskAssignment $taskAssignment)
    {
        $loggedInSupervisorId = $request->user()->id;
        $agents = User::where('access_level', 'Assembly_Agent')
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->where('status', 'Active')
            ->whereIn('id', function ($query) use ($loggedInSupervisorId) {
                $query->select('agent_id')
                    ->from('agent_assignments')
                    ->where('supervisor_id', $loggedInSupervisorId);
            })
            ->get();

        $supervisor = User::where('access_level', 'Assembly_Supervisor')
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->where('id', $request->user()->id)
            ->where('status', 'Active')
            ->first();

        $division = Division::where('division_code', $request->user()->division_code)->first();
        if ($division) {
            $blockss = Block::orderBy('block_name', 'ASC')
                ->where('division_code', $division->id)
                ->get();
        }

        $assembly = $request->user()->assembly->name ?? '';
        $assemblyCode = $request->user()->assembly_code;

        $assemblyData = [
            'assembly' => isset($assembly) ? $assembly : 'N/A',
            'assemblyCode' => isset($assemblyCode) ? $assemblyCode : 'N/A'
        ];

        $blockData = $taskAssignment->block_data;

        $status = [];
        foreach ($blockData as $data) {
            $status[$data['block_id']] = $data['status'];
        }

        $blockIds = array_column($blockData, 'block_id');
        $blocks = Block::whereIn('id', $blockIds)
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->get()
            ->map(function ($block) use ($taskAssignment, $status) {
                $result = new stdClass();
                $result->block_code = $block->block_code;
                $result->block_name = $block->block_name;
                $result->assembly = $block->assembly->name ?? '';
                $result->created_by = $taskAssignment->createdBy->name ?? '';
                $result->created_at = $taskAssignment->created_at;
                $result->status = $status[$block->id] ?? '';
                $result->task = $taskAssignment->task;
                return $result;
            });

        return view('task-assignments.edit', compact('agents', 'supervisor', 'taskAssignment', 'blocks', 'blockss', 'assemblyData'));
    }

    public function update(UpdateTaskAssignmentRequest $request, TaskAssignment $taskAssignment)
    {
        $data = $request->validated();

        $blockData = [];
        foreach ($data['block_data'] as $blockId) {
            $status = collect($taskAssignment->block_data ?? [])->firstWhere('block_id', $blockId)['status'] ?? 'Pending';

            $blockData[] = [
                'block_id' => $blockId,
                'status' => $status,
            ];
        }

        $data['block_data'] = $blockData;

        $taskAssignment->update($data);

        return redirect()->route('task-assignments.index')->with('status', 'Task assignment updated successfully.');
    }
}
