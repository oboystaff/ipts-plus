<?php

namespace App\Http\Controllers\API\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Customer\UpdateCustomerRequest;
use App\Models\Citizen;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $data = Citizen::orderBy('created_at', 'DESC')
            ->get();

        return response()->json([
            'message' => 'Get all customers',
            'data' => $data
        ]);
    }

    public function store() {}

    public function show($id)
    {
        $customer = Citizen::where('id', $id)
            ->orWhere('user_id', $id)
            ->first();

        if (empty($customer)) {
            return response()->json([
                'message' => 'Customer not found'
            ], 422);
        }

        return response()->json([
            'message' => 'Get particular customer',
            'data' => $customer
        ]);
    }

    public function update(UpdateCustomerRequest $request, $id)
    {
        $customer = Citizen::where('id', $id)
            ->orWhere('user_id', $id)
            ->first();

        if (empty($customer)) {
            return response()->json([
                'message' => 'Customer not found'
            ], 422);
        }

        $customer->update($request->validated());

        return response()->json([
            'message' => 'Customer updated successfully'
        ]);
    }
}
