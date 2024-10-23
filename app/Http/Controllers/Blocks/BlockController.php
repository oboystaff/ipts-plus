<?php

namespace App\Http\Controllers\Blocks;

use App\Http\Controllers\Controller;
use App\Http\Requests\Block\CreateBlockRequest;
use App\Http\Requests\Block\UpdateBlockRequest;
use Illuminate\Http\Request;
use App\Models\Block;
use App\Models\Division;
use App\Models\Assembly;

class BlockController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum']);
    }

    public function index(Request $request)
    {
        if (!auth()->user()->can('blocks.view')) {
            abort(403, 'Unauthorized action.');
        }

        $blocks = Block::orderBy('created_at', 'DESC')
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->get();

        return view('blocks.index', compact('blocks'));
    }

    public function create(Request $request)
    {
        if (!auth()->user()->can('blocks.create')) {
            abort(403, 'Unauthorized action.');
        }

        $divisions = Division::query()
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->get();

        $assemblies = Assembly::orderBy('name', 'ASC')
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->get();

        return view('blocks.create', compact('divisions', 'assemblies'));
    }

    public function store(CreateBlockRequest $request)
    {
        Block::create($request->validated());

        return redirect()->route('blocks.index')->with('status', 'Block created successfully.');
    }

    public function show(Block $block)
    {
        return view('blocks.show', compact('block'));
    }

    public function edit(Request $request, Block $block)
    {
        if (!auth()->user()->can('blocks.update')) {
            abort(403, 'Unauthorized action.');
        }

        $divisions = Division::query()
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->get();

        $assemblies = Assembly::orderBy('name', 'ASC')
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->get();

        return view('blocks.edit', compact('block', 'divisions', 'assemblies'));
    }

    public function update(UpdateBlockRequest $request, Block $block)
    {
        $block->update($request->validated());

        return redirect()->route('blocks.index')->with('status', 'Block updated successfully.');
    }

    public function destroy(Block $block)
    {
        $block->delete();
        return redirect()->route('blocks.index')->with('success', 'Block deleted successfully.');
    }

    public function division(Request $request)
    {
        try {
            $divisions = Division::where('assembly_code', $request->input('assembly_code'))
                ->where('status', 'Active')
                ->get();

            return response()->json([
                'message' => $divisions
            ]);
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }
}
