<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Assembly;
use App\Models\Payment;


class TaxCollectionSummaryReportController extends Controller
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

                    $data = Payment::selectRaw("
                            assemblies.name AS assembly_name,
                            SUM(CASE 
                                    WHEN payments.payment_mode = 'momo' AND payments.transaction_status = 'Success' THEN payments.amount 
                                    ELSE 0 
                                END) AS momo_total,
                            SUM(CASE 
                                    WHEN payments.payment_mode = 'cash' THEN payments.amount 
                                    ELSE 0 
                                END) AS cash_total,
                            SUM(CASE 
                                    WHEN payments.payment_mode = 'momo' AND payments.transaction_status = 'Success' THEN payments.amount 
                                    WHEN payments.payment_mode = 'cash' THEN payments.amount 
                                    ELSE 0 
                                END) AS total_amount,
                            COUNT(*) AS transaction_no,
                            CASE 
                                WHEN SUM(CASE WHEN payments.payment_mode = 'momo' AND payments.transaction_status = 'Success' THEN 1 ELSE 0 END) > 
                                    SUM(CASE WHEN payments.payment_mode = 'cash' THEN 1 ELSE 0 END) 
                                THEN 'momo'
                                ELSE 'cash' 
                            END AS frequently_used
                        ")
                        ->join('assemblies', 'payments.assembly_code', '=', 'assemblies.assembly_code')
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
                        ->groupBy('assemblies.name')
                        ->orderBy('assemblies.name')
                        ->get();


                    return datatables()->of($data)
                        ->addIndexColumn()
                        ->editColumn('frequently_used', function ($row) {
                            return isset($row->frequently_used) ? ucfirst($row->frequently_used) : 'N/A';
                        })
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

            return view('reports.tax-collection-summary-report', compact('assemblies'));
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }
}
