<?php

namespace App\Http\Controllers\API\Property;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Property\CreatePropertyRequest;
use App\Http\Requests\API\Property\UpdatePropertyRequest;
use App\Models\Property;
use App\Models\Citizen;
use App\Models\Division;
use App\Models\Block;
use Illuminate\Http\Request;
use App\Jobs\Property\SendPropertyOwnerSMS;


class PropertyController extends Controller
{
    public function index(Request $request)
    {
        $data = Property::orderBy('created_at', 'DESC')
            ->with(['customer', 'entityType', 'assembly', 'zone', 'division', 'block'])
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->get();

        return response()->json([
            'message' => 'Get all properties',
            'data' => $data
        ]);
    }

    public function show($id)
    {
        $property = Property::where('id', $id)
            ->with(['customer', 'entityType', 'assembly', 'zone', 'division', 'block'])
            ->first();

        if (empty($property)) {
            return response()->json([
                'message' => 'Customer property not found'
            ], 422);
        }

        return response()->json([
            'message' => 'Get particular customer property',
            'data' => $property
        ]);
    }

    public function customerProperty($id)
    {
        $customer = Citizen::where('user_id', $id)
            ->orWhere('id', $id)
            ->first();

        if (empty($customer)) {
            return response()->json([
                'message' => 'Customer has no property, check and enter the customer id again'
            ], 422);
        }

        $property = Property::where('customer_name', $customer->id)
            ->with(['customer', 'entityType', 'assembly', 'zone', 'division', 'block'])
            ->get();

        if (count($property) == 0) {
            return response()->json([
                'message' => 'Customer property not found'
            ], 422);
        }

        return response()->json([
            'message' => 'Get particular customer property',
            'data' => $property,
            'total_property' => count($property)
        ]);
    }

    public function store(CreatePropertyRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = $request->user()->id;
        $data['property_number'] = $this->generateUniquePropertyNumber($data['assembly_code'], $data['division_id'], $data['block_id']);
        $data['rated'] = 'Yes';
        $data['validated'] = 'Yes';
        $data['customer_name'] = $data['customer_id'] ?? '';

        $property = Property::create($data);

        if (!empty($data['customer_name'])) {
            dispatch(new SendPropertyOwnerSMS($property->load('customer')));
        }

        return response()->json([
            'message' => 'Customer property created successfully',
            'data' => $property
        ]);
    }

    public function update(UpdatePropertyRequest $request, $id)
    {
        $property = Property::where('id', $id)->first();

        if (empty($property)) {
            return response()->json([
                'message' => 'Customer property not found'
            ], 422);
        }

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

        return response()->json([
            'message' => 'Customer property updated successfully'
        ]);
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
}
