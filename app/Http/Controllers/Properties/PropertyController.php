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
use App\Models\AuditTrail;
use App\Models\Block;
use App\Models\Division;
use App\Models\Zone;
use App\Models\PropertyUser;
use App\Models\ServiceRequest;
use Illuminate\Support\Facades\DB;


class PropertyController extends Controller
{
    public function index(Request $request)
    {
        if (!auth()->user()->can('properties.view')) {
            abort(403, 'Unauthorized action.');
        }

        // Fetch data for filters
        $entityTypes = BusinessClassType::orderBy('created_at', 'DESC')->get();
        $categories = BusinessClassType::orderBy('created_at', 'DESC')->get();
        $assemblies = Assembly::orderBy('created_at', 'DESC')->get();
        $divisions = Division::orderBy('created_at', 'DESC')->get();
        $propertyUses = PropertyUser::orderBy('created_at', 'DESC')->get();

        $properties = Property::orderBy('created_at', 'DESC')
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->when($request->filled('entity_type'), function ($query) use ($request) {
                $query->where('entity_type', $request->entity_type);
            })
            ->when($request->filled('category'), function ($query) use ($request) {
                $query->where('category', $request->category);
            })
            ->when($request->filled('rated'), function ($query) use ($request) {
                $query->where('rated', $request->rated);
            })
            ->when($request->filled('validated'), function ($query) use ($request) {
                $query->where('validated', $request->validated);
            })
            ->when($request->filled('assembly'), function ($query) use ($request) {
                $query->where('assembly_code', $request->assembly);
            })
            ->when($request->filled('division'), function ($query) use ($request) {
                $query->where('division_code', $request->division);
            })
            ->when($request->filled('property_use'), function ($query) use ($request) {
                $query->where('property_use', $request->property_use);
            })
            ->with([
                'bills' => function ($query) {
                    $query->select('property_id', DB::raw('SUM(amount) as total_bills'))
                        ->groupBy('property_id');
                }
            ])
            ->get()
            ->map(function ($property) {
                $property->total_bills = $property->bills->first()->total_bills ?? 0;
                $firstname = $property->customer->first_name ?? '';
                $lastname = $property->customer->last_name ?? '';
                $property->owner = $firstname . ' ' . $lastname;
                $property->property_no = $property->property_number ?? 'N/A';

                $property->total_payments = DB::table('payments')
                    ->join('bills', 'payments.bills_id', '=', 'bills.bills_id')
                    ->where('bills.property_id', $property->id)
                    ->select(
                        DB::raw('SUM(CASE 
                                WHEN payment_mode = "momo" AND transaction_status = "Success" THEN payments.amount 
                                WHEN payment_mode != "momo" THEN payments.amount 
                                ELSE 0 
                         END) as total_payments')
                    )
                    ->value('total_payments') ?? 0;

                return $property;
            });

        // Calculate total properties
        $totalProperties = $properties->count();

        // Calculate totals and percentages
        $valuedProperties = $properties->where('validated', 1)->count();
        $unvaluedProperties = $properties->where('validated', 0)->count();
        $ratedProperties = $properties->where('rated', 1)->count();
        $unratedProperties = $properties->where('rated', 0)->count();

        $valuedPercentage = $totalProperties > 0 ? ($valuedProperties / $totalProperties) * 100 : 0;
        $unvaluedPercentage = $totalProperties > 0 ? ($unvaluedProperties / $totalProperties) * 100 : 0;
        $ratedPercentage = $totalProperties > 0 ? ($ratedProperties / $totalProperties) * 100 : 0;
        $unratedPercentage = $totalProperties > 0 ? ($unratedProperties / $totalProperties) * 100 : 0;

        $data = [
            'properties' => $properties,
            'entityTypes' => $entityTypes,
            'assemblies' => $assemblies,
            'divisions' => $divisions,
            'propertyUses' => $propertyUses,
            'totalProperties' => $totalProperties,
            'valuedProperties' => $valuedProperties,
            'unvaluedProperties' => $unvaluedProperties,
            'ratedProperties' => $ratedProperties,
            'unratedProperties' => $unratedProperties,
            'valuedPercentage' => number_format($valuedPercentage, 2),
            'unvaluedPercentage' => number_format($unvaluedPercentage, 2),
            'ratedPercentage' => number_format($ratedPercentage, 2),
            'unratedPercentage' => number_format($unratedPercentage, 2)
        ];

        return view('properties.index', compact('data'));
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

        $serviceData = [
            'user_id' => $request->user()->id,
            'service_used' => 'Property Registration',
            'usage_date' => now(),
            'service_channel' => 'Web Portal',
            'status' => 'Completed'
        ];

        $auditTrailData = [
            'user_id' => $request->user()->id,
            'action_performed' => 'Property Registration',
            'action_date' => now(),
            'ip_address' => $request->ip(),
            'device_used' => request()->userAgent(),
            'remarks' => 'Success'
        ];

        ServiceRequest::create($serviceData);
        AuditTrail::create($auditTrailData);

        return redirect()->route('properties.index')->with('status', 'Property created successfully!');
    }

    public function ratePayerStore(CreatePropertyRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = $request->user()->id;
        $data['property_number'] = $this->generateUniquePropertyNumber($data['assembly_code'], $data['division_id'], $data['block_id']);

        $property = Property::create($data);

        if (!empty($data['customer_name'])) {
            dispatch(new SendPropertyOwnerSMS($property->load('customer')));
        }

        $serviceData = [
            'user_id' => $request->user()->id,
            'service_used' => 'Property Registration',
            'usage_date' => now(),
            'service_channel' => 'Web Portal',
            'status' => 'Completed'
        ];

        $auditTrailData = [
            'user_id' => $request->user()->id,
            'action_performed' => 'Property Registration',
            'action_date' => now(),
            'ip_address' => $request->ip(),
            'device_used' => request()->userAgent(),
            'remarks' => 'Success'
        ];

        ServiceRequest::create($serviceData);
        AuditTrail::create($auditTrailData);

        return redirect()->back()->with('status', 'Property linked successfully!');
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
