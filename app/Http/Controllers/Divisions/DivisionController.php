<?php

namespace App\Http\Controllers\Divisions;

use App\Http\Controllers\Controller;
use App\Http\Requests\Division\CreateDivisionRequest;
use App\Http\Requests\Division\UpdateDivisionRequest;
use Illuminate\Http\Request;
use App\Models\Division;
use App\Models\Assembly;


class DivisionController extends Controller
{

    public function index(Request $request)
    {
        if (!auth()->user()->can('divisions.view')) {
            abort(403, 'Unauthorized action.');
        }

        $divisions = Division::orderBy('created_at', 'DESC')
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->get();

        $assemblies = Assembly::orderBy('name', 'ASC')
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->get();

        return view('divisions.index', compact('divisions', 'assemblies'));
    }

    public function create(Request $request)
    {
        if (!auth()->user()->can('divisions.create')) {
            abort(403, 'Unauthorized action.');
        }

        $assemblies = Assembly::orderBy('name', 'ASC')
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->get();

        return view('divisions.create')->with([
            'assemblies' => $assemblies
        ]);
    }

    public function store(CreateDivisionRequest $request)
    {
        Division::create($request->validated());

        return redirect()->route('divisions.index')->with('status', 'Division created successfully.');
    }

    public function show(Division $division)
    {
        return view('divisions.show', compact('division'));
    }

    public function edit(Request $request, Division $division)
    {
        if (!auth()->user()->can('divisions.update')) {
            abort(403, 'Unauthorized action.');
        }

        $assemblies = Assembly::orderBy('name', 'ASC')
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->get();

        return view('divisions.edit', compact('division', 'assemblies'));
    }

    public function update(UpdateDivisionRequest $request, Division $division)
    {
        $division->update($request->validated());

        return redirect()->route('divisions.index')->with('status', 'Division updated successfully.');
    }

    public function destroy(Division $division)
    {
        $division->delete();
        return redirect()->route('divisions.index')->with('success', 'Division deleted successfully.');
    }
}
