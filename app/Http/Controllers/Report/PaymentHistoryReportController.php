<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Assembly;
use App\Models\Payment;


class PaymentHistoryReportController extends Controller
{
    public function index(Request $request)
    {
        try {
            if (!auth()->user()->can('reports.view')) {
                abort(403, 'Unauthorized action.');
            }

            $assemblies = Assembly::orderBy('name', 'ASC')
                ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                    $query->where('assembly_code', $request->user()->assembly_code);
                })
                ->get();

            if (request()->ajax()) {

                if ($request->report_type == 1) {

                    $data = Payment::selectRaw('
                            CASE 
                                WHEN bills.business_id IS NULL THEN properties.property_number 
                                ELSE businesses.business_owner_id 
                            END AS property_id,
                            SUM(CASE 
                                WHEN payments.payment_mode = "momo" 
                                    AND (payments.transaction_status = "Success" OR payments.transaction_status = "Pending") 
                                    THEN payments.amount 
                                WHEN payments.payment_mode != "momo" THEN payments.amount 
                                ELSE 0 
                            END) AS total_amount,
                            CONCAT(MAX(citizens.first_name), " ", MAX(citizens.last_name)) AS owner_name,
                            MAX(payments.transaction_status) AS status,
                            MAX(assemblies.name) AS assembly_name,
                            MAX(divisions.division_name) AS division_name,
                            MAX(blocks.block_name) AS block_name,
                            MAX(zones.name) AS zone_name,
                            MAX(property_users.name) AS property_use_name,
                            MAX(payments.transaction_id) AS transaction_id,
                            MAX(payments.phone) AS phone,
                            MAX(payments.network) AS network
                        ')
                        ->join('bills', 'payments.bills_id', '=', 'bills.bills_id')
                        ->leftJoin('properties', 'bills.property_id', '=', 'properties.id')
                        ->leftJoin('businesses', 'bills.business_id', '=', 'businesses.id')
                        ->leftJoin('assemblies', function ($join) {
                            $join->on('properties.assembly_code', '=', 'assemblies.assembly_code')
                                ->orOn('businesses.assembly_code', '=', 'assemblies.assembly_code');
                        })
                        ->leftJoin('divisions', function ($join) {
                            $join->on('properties.division_id', '=', 'divisions.id')
                                ->orOn('businesses.division_id', '=', 'divisions.id');
                        })
                        ->leftJoin('blocks', function ($join) {
                            $join->on('properties.block_id', '=', 'blocks.id')
                                ->orOn('businesses.block_id', '=', 'blocks.id');
                        })
                        ->leftJoin('zones', function ($join) {
                            $join->on('properties.zone_id', '=', 'zones.id')
                                ->orOn('businesses.zone_id', '=', 'zones.id');
                        })
                        ->leftJoin('property_users', function ($join) {
                            $join->on('properties.property_use_id', '=', 'property_users.id')
                                ->orOn('businesses.property_use_id', '=', 'property_users.id');
                        })
                        ->leftJoin('citizens', function ($join) {
                            $join->on('properties.customer_name', '=', 'citizens.id')
                                ->orOn('businesses.citizen_account_number', '=', 'citizens.id');
                        })
                        ->when($request->filled('from_date') && $request->filled('to_date'), function ($query) use ($request) {
                            $query->whereBetween('payments.created_at', [
                                $request->from_date . ' 00:00:00',
                                $request->to_date . ' 23:59:59',
                            ]);
                        })
                        ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                            $query->where('payments.assembly_code', $request->user()->assembly_code);
                        })
                        ->when($request->filled('assembly_code'), function ($query) use ($request) {
                            $query->where('payments.assembly_code', $request->assembly_code);
                        })
                        ->when($request->filled('status'), function ($query) use ($request) {
                            $query->where('payments.transaction_status', $request->status);
                        })
                        ->groupByRaw('
                            CASE 
                                WHEN bills.business_id IS NULL THEN properties.property_number 
                                ELSE businesses.business_owner_id 
                            END,
                            CASE 
                                WHEN bills.business_id IS NULL THEN properties.customer_name 
                                ELSE businesses.citizen_account_number 
                            END
                        ')
                        ->orderBy('total_amount', 'DESC')
                        ->get();


                    return datatables()->of($data)
                        ->addIndexColumn()
                        ->make(true);
                } else {

                    $levelMapping = [
                        'cluster_level' => ['table' => 'clusters', 'column' => 'name', 'id' => 'cluster_id'],
                        'business_center_level' => ['table' => 'business_centers', 'column' => 'name', 'id' => 'business_center_id'],
                        'branch_level' => ['table' => 'branches', 'column' => 'name', 'id' => 'branch_id'],
                        'district_level' => ['table' => 'districts', 'column' => 'name', 'id' => 'district_id'],
                        'community_level' => ['table' => 'communities', 'column' => 'name', 'id' => 'community_id'],
                    ];

                    $selectedLevel = $request->level_type;
                    $level = $levelMapping[$selectedLevel] ?? null;

                    if ($level) {
                        try {
                            $data = DB::table('customers')
                                ->join($level['table'], 'customers.' . $level['id'], '=', $level['table'] . '.id')
                                ->select(
                                    $level['table'] . '.' . $level['column'] . ' as name',
                                    $level['table'] . '.id as id',
                                    DB::raw('COUNT(*) as total_customer')
                                )
                                ->groupBy($level['table'] . '.' . $level['column'])
                                ->get();

                            return datatables()->of($data)
                                ->addIndexColumn()
                                ->editColumn('name', function ($row) {
                                    return $row->name;
                                })
                                ->editColumn('link', function ($row) use ($request) {
                                    return '<a href="' . route('customers.index', ['param' => $request->name, 'param_id' => $row->id]) . '" class="btn btn-success btn-sm" target="_blank">View Details</a>';
                                })
                                ->rawColumns(['link'])
                                ->make(true);
                        } catch (\Exception $e) {
                            return response()->json(['error' => $e->getMessage()], 500);
                        }
                    } else {
                        return response()->json(['error' => 'Invalid level selected'], 400);
                    }
                }
            }

            return view('reports.payment-history-report', compact('assemblies'));
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }
}
