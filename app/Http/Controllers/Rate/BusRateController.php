<?php

namespace App\Http\Controllers\Rate;

use App\Http\Controllers\Controller;
use App\Http\Requests\BusRate\CreateBusRateRequest;
use App\Http\Requests\BusRate\UpdateBusRateRequest;
use App\Models\BOPRate;
use App\Models\Assembly;
use App\Models\Zone;
use App\Models\PropertyUser;
use Illuminate\Http\Request;


class BusRateController extends Controller
{
    public function index(Request $request)
    {
        if (!auth()->user()->can('rates.view')) {
            abort(403, 'Unauthorized action.');
        }

        $rates = BOPRate::orderBy('created_at', 'DESC')
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->get();

        return view('bop-rates.index', compact('rates'));
    }

    public function create(Request $request)
    {
        if (!auth()->user()->can('rates.create')) {
            abort(403, 'Unauthorized action.');
        }

        $zones = Zone::orderBy('name', 'ASC')->get();
        $assemblies = Assembly::orderBy('name', 'ASC')
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->get();

        return view('bop-rates.create', compact('assemblies', 'zones'));
    }

    public function store(CreateBusRateRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = $request->user()->id;

        BOPRate::create($data);

        return redirect()->route('rates.bus.index')->with('status', 'Business operating permit rate created successfully!');
    }

    public function show(BOPRate $rate)
    {
        return view('bop-rates.show', compact('rate'));
    }

    public function edit(Request $request, BOPRate $rate)
    {
        if (!auth()->user()->can('rates.update')) {
            abort(403, 'Unauthorized action.');
        }

        $zones = Zone::orderBy('name', 'ASC')->get();
        $propertyUsers = PropertyUser::orderBy('name', 'ASC')
            ->where('zone_id', $rate->zone_id)
            ->get();

        $assemblies = Assembly::orderBy('name', 'ASC')
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->get();

        return view('bop-rates.edit', compact('rate', 'zones', 'assemblies', 'propertyUsers'));
    }

    public function update(UpdateBusRateRequest $request, BOPRate $rate)
    {
        $rate->update(($request->validated()));

        return redirect()->route('rates.bus.index')->with('status', 'Business operating permit rate updated successfully!');
    }
}
