<?php

namespace App\Http\Controllers\API\USSD;

use App\Http\Controllers\Controller;
use App\Models\Citizen;
use Illuminate\Http\Request;

class USSDController extends Controller
{
    public function customerInfo($phone)
    {
        $customer = Citizen::with(['properties', 'businesses', 'customerType', 'user'])
            ->where('telephone_number', $phone)
            ->first();

        if (empty($customer)) {
            return response()->json([
                'message' => 'Customer record not found'
            ], 422);
        }

        return response()->json([
            'message' => 'Get customr records',
            'data' => $customer
        ]);
    }
}
