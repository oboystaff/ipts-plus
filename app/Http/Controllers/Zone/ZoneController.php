<?php

namespace App\Http\Controllers\Zone;

use App\Http\Controllers\Controller;
use App\Http\Requests\Zone\CreateZoneRequest;
use App\Http\Requests\Zone\UpdateZoneRequest;
use Illuminate\Http\Request;
use App\Models\Zone;

class ZoneController extends Controller
{
    public function index()
    {
        if (!auth()->user()->can('zones.view')) {
            abort(403, 'Unauthorized action.');
        }

        $zones = Zone::orderBy('created_at', 'DESC')->get();

        return view('zones.index', compact('zones'));
    }

    public function create()
    {
        if (!auth()->user()->can('zones.create')) {
            abort(403, 'Unauthorized action.');
        }

        return view('zones.create');
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

    public function edit(Zone $zone)
    {
        if (!auth()->user()->can('zones.update')) {
            abort(403, 'Unauthorized action.');
        }

        return view('zones.edit', compact('zone'));
    }

    public function update(UpdateZoneRequest $request, Zone $zone)
    {
        $zone->update($request->validated());

        return redirect()->route('zones.index')->with('status', 'Zone updated successfully!');
    }
}
