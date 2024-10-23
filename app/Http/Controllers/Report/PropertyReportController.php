<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Assembly;
use App\Models\Property;

class PropertyReportController extends Controller
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
                    $data = Property::orderBy('created_at', 'DESC')
                        ->when(($request->filled('from_date') && $request->filled('to_date')), function ($query) use ($request) {
                            $query->whereBetween('created_at', [$request->from_date . ' 00:00:00', $request->to_date . ' 23:59:59']);
                        })
                        ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                            $query->where('assembly_code', $request->user()->assembly_code);
                        })
                        ->when($request->filled('assembly_code'), function ($query) use ($request) {
                            $query->where('assembly_code', $request->assembly_code);
                        })
                        ->when($request->filled('status'), function ($query) use ($request) {
                            $query->where('status', $request->status);
                        })
                        ->get();

                    return datatables()->of($data)
                        ->addIndexColumn()
                        ->editColumn('entity_type', function (Property $property) {
                            return $property->entityType->name ?? 'N/A';
                        })
                        ->editColumn('category', function (Property $property) {
                            return $property->entityType->category ?? 'N/A';
                        })
                        ->editColumn('owner_account', function (Property $property) {
                            return $property->customer->account_number ?? 'N/A';
                        })
                        ->editColumn('owner_name', function (Property $property) {
                            $firstname = $property->customer->first_name ?? '';
                            $lastname = $property->customer->last_name ?? '';
                            $fullname = $firstname . ' ' . $lastname;

                            return $fullname;
                        })
                        ->editColumn('ratable_value', function (Property $property) {
                            return number_format($property->ratable_value, 2);
                        })
                        ->editColumn('assembly', function (Property $property) {
                            return $property->assembly->name ?? 'N/A';
                        })
                        ->editColumn('division', function (Property $property) {
                            return $property->division->division_name ?? 'N/A';
                        })
                        ->editColumn('block', function (Property $property) {
                            return $property->block->block_name ?? 'N/A';
                        })
                        ->editColumn('zone', function (Property $property) {
                            return $property->zone->name ?? 'N/A';
                        })
                        ->editColumn('property_use', function (Property $property) {
                            return $property->propertyUse->name ?? 'N/A';
                        })
                        ->editColumn('created_by', function (Property $property) {
                            return $property->createdBy->name ?? 'N/A';
                        })
                        ->editColumn('created_at', function (Property $property) {
                            return $property->created_at;
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

            return view('reports.property-report', compact('assemblies'));
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }
}
