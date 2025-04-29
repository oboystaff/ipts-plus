<?php

namespace App\Http\Controllers\Zone;

use App\Http\Controllers\Controller;
use App\Http\Requests\Zone\CreateZoneRequest;
use App\Http\Requests\Zone\UpdateZoneRequest;
use Illuminate\Http\Request;
use App\Models\Zone;
use App\Models\Assembly;


class ZoneController extends Controller
{
    public function index(Request $request)
    {
        if (!auth()->user()->can('zones.view')) {
            abort(403, 'Unauthorized action.');
        }

        $zones = Zone::orderBy('created_at', 'DESC')
            ->when(!empty($request->user()->regional_code), function ($query) use ($request) {
                $query->whereHas('assembly', function ($q) use ($request) {
                    $q->where('regional_code', $request->user()->regional_code);
                });
            })
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->get();

        return view('zones.index', compact('zones'));
    }

    public function create(Request $request)
    {
        if (!auth()->user()->can('zones.create')) {
            abort(403, 'Unauthorized action.');
        }

        $assemblies = Assembly::orderBy('name', 'ASC')
            ->when(!empty($request->user()->regional_code), function ($query) use ($request) {
                $query->where('regional_code', $request->user()->regional_code);
            })
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->get();

        return view('zones.create', compact('assemblies'));
    }

    public function store(CreateZoneRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = $request->user()->id;

        Zone::create($data);

        return redirect()->route('zones.index')->with('status', 'Zone created successfully!');
    }

    public function show(Zone $zone)
    {
        return view('zones.show', compact('zone'));
    }

    public function edit(Request $request, Zone $zone)
    {
        if (!auth()->user()->can('zones.update')) {
            abort(403, 'Unauthorized action.');
        }

        $assemblies = Assembly::orderBy('name', 'ASC')
            ->when(!empty($request->user()->regional_code), function ($query) use ($request) {
                $query->where('regional_code', $request->user()->regional_code);
            })
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->get();

        return view('zones.edit', compact('zone', 'assemblies'));
    }

    public function update(UpdateZoneRequest $request, Zone $zone)
    {
        $zone->update($request->validated());

        return redirect()->route('zones.index')->with('status', 'Zone updated successfully!');
    }
}
