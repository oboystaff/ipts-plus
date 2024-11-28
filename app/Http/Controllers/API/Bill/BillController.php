<?php

namespace App\Http\Controllers\API\Bill;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Citizen;
use Illuminate\Http\Request;


class BillController extends Controller
{
    public function index(Request $request)
    {
        $data = Bill::orderBy('created_at', 'DESC')
            ->with(['property', 'business', 'assembly'])
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->get()
            ->map(function ($bill) {
                if (is_null($bill->property_id)) {
                    $bill->bill_type = 'Business Bill';
                } elseif (is_null($bill->business_id)) {
                    $bill->bill_type = 'Property Bill';
                } else {
                    $bill->bill_type = 'Unknown';
                }

                return $bill;
            });

        return response()->json([
            'message' => 'Get all bills',
            'data' => $data
        ]);
    }

    public function show($id)
    {
        $bill = Bill::where('id', $id)
            ->with(['property', 'business', 'assembly'])
            ->orWhere('bills_id', $id)
            ->first();

        if ($bill) {
            if (is_null($bill->property_id)) {
                $bill->bill_type = 'Business Bill';
            } elseif (is_null($bill->business_id)) {
                $bill->bill_type = 'Property Bill';
            } else {
                $bill->bill_type = 'Unknown';
            }
        }

        if (empty($bill)) {
            return response()->json([
                'message' => 'Bill not found'
            ], 422);
        }

        return response()->json([
            'message' => 'Get particular bill',
            'data' => $bill
        ]);
    }

    public function customerBill($id)
    {
        $customer = Citizen::where('user_id', $id)
            ->orWhere('id', $id)
            ->first();

        if (empty($customer)) {
            return response()->json([
                'message' => 'Customer not found, enter customer account id'
            ], 422);
        }

        $bills = Bill::orderBy('created_at', 'DESC')
            ->with(['property', 'business', 'assembly', 'payments'])
            ->where(function ($query) use ($customer) {
                $query->whereHas('property', function ($q) use ($customer) {
                    $q->where('customer_name',  $customer->id);
                })
                    ->whereNotNull('property_id')
                    ->whereNull('business_id');
            })
            ->orWhere(function ($query) use ($customer) {
                $query->whereHas('business', function ($q) use ($customer) {
                    $q->where('citizen_account_number', $customer->id);
                })
                    ->whereNotNull('business_id')
                    ->whereNull('property_id');
            })
            ->get()
            ->map(function ($bill) {
                if (is_null($bill->property_id)) {
                    $bill->bill_type = 'Business Bill';
                } elseif (is_null($bill->business_id)) {
                    $bill->bill_type = 'Property Bill';
                } else {
                    $bill->bill_type = 'Unknown';
                }

                return $bill;
            });

        return response()->json([
            'message' => 'Get all bills',
            'data' => $bills
        ]);
    }

    public function pendingBill($id)
    {
        $customer = Citizen::where('user_id', $id)
            ->orWhere('id', $id)
            ->first();

        if (empty($customer)) {
            return response()->json([
                'message' => 'Customer not found, enter customer account id'
            ], 422);
        }

        $bills = Bill::orderBy('created_at', 'DESC')
            ->with(['property', 'business', 'assembly'])
            ->where(function ($query) use ($customer) {
                $query->whereHas('property', function ($q) use ($customer) {
                    $q->where('customer_name',  $customer->id);
                })
                    ->whereNotNull('property_id')
                    ->whereNull('business_id');
            })
            ->orWhere(function ($query) use ($customer) {
                $query->whereHas('business', function ($q) use ($customer) {
                    $q->where('citizen_account_number', $customer->id);
                })
                    ->whereNotNull('business_id')
                    ->whereNull('property_id');
            })
            ->whereDoesntHave('payments', function ($query) {
                $query->whereColumn('payments.bills_id', 'bills.id');
            })
            ->get()
            ->map(function ($bill) {
                if (is_null($bill->property_id)) {
                    $bill->bill_type = 'Business Bill';
                } elseif (is_null($bill->business_id)) {
                    $bill->bill_type = 'Property Bill';
                } else {
                    $bill->bill_type = 'Unknown';
                }

                return $bill;
            });

        return response()->json([
            'message' => 'Get all pending bills',
            'data' => $bills
        ]);
    }
}
