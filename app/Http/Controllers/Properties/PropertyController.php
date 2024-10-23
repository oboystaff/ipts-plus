<?php

namespace App\Http\Controllers\Properties;

use App\Http\Controllers\Controller;
use App\Http\Requests\Property\CreatePropertyRequest;
use App\Http\Requests\Property\UpdatePropertyRequest;
use App\Jobs\Property\SendPropertyOwnerSMS;
use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\Citizen;
use App\Models\BusinessClassType;
use App\Models\Assembly;
use App\Models\Block;
use App\Models\Division;
use App\Models\Zone;
use App\Models\PropertyUser;


class PropertyController extends Controller
{
    public function index(Request $request)
    {
        if (!auth()->user()->can('properties.view')) {
            abort(403, 'Unauthorized action.');
        }

        $properties = Property::orderBy('created_at', 'DESC')
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->get();

        $customers = Citizen::query()
            ->get();

        $businessClassTypes = BusinessClassType::get();

        $DistrictAssemblies = Assembly::query()
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->get();

        $total = Property::query()
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->sum('ratable_value');

        $total = number_format($total, 2);

        return view('properties.index', compact('properties', 'DistrictAssemblies', 'businessClassTypes', 'customers', 'total'));
    }

    /**
     * Show the form for creating a new property.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if (!auth()->user()->can('properties.create')) {
            abort(403, 'Unauthorized action.');
        }

        $businessClassTypes = BusinessClassType::get();
        $customers = Citizen::query()
            ->get();

        $districtAssemblies = Assembly::orderBy('name', 'ASC')
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->get();

        $zones = Zone::orderBy('name', 'ASC')->get();

        return view('properties.create', compact('businessClassTypes', 'customers', 'districtAssemblies', 'zones'));
    }

    public function store(CreatePropertyRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = $request->user()->id;
        $data['property_number'] = $this->generateUniquePropertyNumber($data['assembly_code'], $data['division_id'], $data['block_id']);

        $property = Property::create($data);

        if (!empty($data['customer_name'])) {
            dispatch(new SendPropertyOwnerSMS($property->load('customer')));
        }

        return redirect()->route('properties.index')->with('status', 'Property created successfully!');
    }

    public function getDetails(Property $property)
    {
        return response()->json($property);
    }

    public function searchCitizens(Request $request)
    {
        $query = $request->input('query');

        $citizens = Citizen::where('telephone_number', 'like', "%$query%")
            ->orWhere('account_number', 'like', "%$query%")
            ->orWhere('nia_number', 'like', "%$query%")
            ->orWhere('first_name', 'like', "%$query%")
            ->orWhere('last_name', 'like', "%$query%")
            ->orWhere('other_name', 'like', "%$query%")
            ->get();

        return view('citizens.search_results', compact('citizens'));
    }

    public function assignCitizen(Request $request)
    {
        $citizenId = $request->input('citizenId');
        $propertyName = $request->input('propertyName');

        // Update the property record with the assigned citizen ID
        Property::where('name', $propertyName)->update(['customer_name' => $citizenId]);

        return response()->json(['message' => 'Citizen assigned successfully']);
    }

    // Method to generate a unique property_number
    private function generateUniquePropertyNumber($assembly_code, $division_id, $block_id)
    {
        $randomNumbers = '';
        for ($i = 0; $i < 6; $i++) {
            $randomNumbers .= mt_rand(0, 9);
        }

        $division_code = Division::where('id', $division_id)->pluck('division_code')->first();
        $block_code = Block::where('id', $block_id)->pluck('block_code')->first();
        $propertyNumber = $assembly_code . $division_code . $block_code . $randomNumbers;

        while (Property::where('property_number', $propertyNumber)->exists()) {
            $randomNumbers = '';
            for ($i = 0; $i < 6; $i++) {
                $randomNumbers .= mt_rand(0, 9);
            }
            $propertyNumber = $assembly_code . $division_code . $block_code . $randomNumbers;
        }

        return $propertyNumber;
    }

    /**
     * Display the specified property.
     *
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function show(Property $property)
    {
        return view('properties.show', compact('property'));
    }

    /**
     * Show the form for editing the specified property.
     *
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Property $property)
    {
        if (!auth()->user()->can('properties.update')) {
            abort(403, 'Unauthorized action.');
        }

        $businessClassTypes = BusinessClassType::get();
        $customers = Citizen::query()
            ->get();

        $districtAssemblies = Assembly::orderBy('name', 'ASC')
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->get();

        $divisions = Division::orderBy('division_name', 'ASC')
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->get();

        $blocks = Block::orderBy('block_name', 'ASC')
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->get();

        $zones = Zone::orderBy('name', 'ASC')->get();
        $propertyUsers = PropertyUser::orderBy('name', 'ASC')
            ->where('zone_id', $property->zone_id)
            ->get();

        return view('properties.edit', compact(
            'property',
            'businessClassTypes',
            'customers',
            'districtAssemblies',
            'divisions',
            'blocks',
            'zones',
            'propertyUsers'
        ));
    }

    /**
     * Update the specified property in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePropertyRequest $request, Property $property)
    {
        $data = $request->validated();
        $confirmSendSMS = false;

        if ($property->assembly_code !== $data['assembly_code'] && $property->division_id !== $data['division_id']) {
            $data['property_number'] = $this->generateUniquePropertyNumber($data['assembly_code'], $data['division_id'], $data['block_id']);
        }

        if (isset($data['customer_name']) && $property->customer_name === null && $data['customer_name'] !== $property->customer_name) {
            $confirmSendSMS = true;
        }

        $property->update($data);

        if ($confirmSendSMS) {
            dispatch(new SendPropertyOwnerSMS($property->load('customer')));
        }

        return redirect()->route('properties.index')->with('status', 'Property updated successfully!');
    }

    /**
     * Remove the specified property from storage.
     *
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function destroy(Property $property)
    {
        $property->delete();

        return redirect()->route('properties.index')->with('success', 'Property deleted successfully!');
    }

    public function block(Request $request)
    {
        $blocks = Block::where('division_code', $request->division_id)->get();

        return response()->json([
            'message' => $blocks
        ]);
    }
}
