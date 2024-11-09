<?php

namespace App\Http\Controllers\API\Property;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\Citizen;
use Illuminate\Http\Request;


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
}
