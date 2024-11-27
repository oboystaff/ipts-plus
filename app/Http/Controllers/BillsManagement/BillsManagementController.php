<?php

namespace App\Http\Controllers\BillsManagement;

use App\Http\Controllers\Controller;
use App\Http\Requests\Bill\CreateBlockBillRequest;
use App\Http\Requests\Bill\CreateBulkBillRequest;
use App\Http\Requests\Bill\CreateDivisionBillRequest;
use App\Http\Requests\Bill\CreateSingleBillRequest;
use Illuminate\Http\Request;
use App\Models\Bill;
use App\Models\Assembly;
use App\Models\Block;
use App\Models\Division;
use App\Models\Property;
use App\Models\Rate;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BillsManagementController extends Controller
{
    public function index(Request $request)
    {
        if (!auth()->user()->can('bills.view')) {
            abort(403, 'Unauthorized action.');
        }

        $bills = Bill::orderBy('created_at', 'DESC')
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->whereNotNull('property_id')
            ->get();

        $totalArrears = $bills->sum('arrears');
        $totalAmount = $bills->sum('amount');

        $totalExpectedPayments = Bill::query()
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->whereNotNull('property_id')
            ->whereYear('created_at', Carbon::now()->year)
            ->select(DB::raw('SUM(amount + arrears) as expectedPayment'))
            ->value('expectedPayment');

        $totalPayments = Payment::query()
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->whereHas('bill', function ($query) {
                $query->whereNotNull('property_id');
            })
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('amount');

        $totalUnpaidBills = 0;
        if (isset($totalExpectedPayments) && isset($totalPayments)) {
            $totalUnpaidBills = $totalExpectedPayments - $totalPayments;
        }

        $paymentPercentage = $totalExpectedPayments > 0 ? ($totalPayments / $totalExpectedPayments) * 100 : 0;

        $totalBill = Bill::query()
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->whereNotNull('property_id')
            ->whereNull('business_id')
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('amount');

        $totalBillArrears = Bill::query()
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->whereNotNull('property_id')
            ->whereNull('business_id')
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('arrears');

        $totalBillVariance = 0;
        if (isset($totalBill) && isset($totalBillArrears)) {
            $totalBillVariance = $totalBillArrears - $totalBill;
        }

        $total = [
            'totalArrears' => isset($totalArrears) ? number_format($totalArrears, 2) : 0,
            'totalAmount' => isset($totalAmount) ? number_format($totalAmount, 2) : 0,
            'totalDue' => isset($totalArrears) && isset($totalAmount) ? number_format($totalArrears + $totalAmount, 2) : 0,
            'totalExpectedPayments' => isset($totalExpectedPayments) ? number_format($totalExpectedPayments, 2) : 0,
            'totalPayments' => isset($totalPayments) ? number_format($totalPayments, 2) : 0,
            'totalUnpaidBills' => isset($totalUnpaidBills) ? number_format($totalUnpaidBills, 2) : 0,
            'paymentPercentage' => isset($paymentPercentage) ? round($paymentPercentage, 2) : 0,
            'totalBill' => isset($totalBill) ? number_format($totalBill, 2) : 0,
            'totalBillArrears' => isset($totalBillArrears) ? number_format($totalBillArrears, 2) : 0,
            'totalBillVariance' => isset($totalBillVariance) ? number_format($totalBillVariance, 2) : 0
        ];

        return view('bills.index', compact('bills', 'total'));
    }

    public function fetchBill(Request $request)
    {
        if (!auth()->user()->can('bills.view')) {
            abort(403, 'Unauthorized action.');
        }

        $bills = Bill::orderBy('created_at', 'DESC')
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->when($request->display == "business", function ($query) {
                $query->whereNotNull('business_id')
                    ->whereYear('created_at', Carbon::now()->year);
            })
            ->when($request->display == "property", function ($query) {
                $query->whereNotNull('property_id')
                    ->whereYear('created_at', Carbon::now()->year);
            })
            ->when($request->display == "fetch_bill", function ($query) {
                $query->whereYear('created_at', Carbon::now()->year);
            })
            ->get();

        $totalArrears = $bills->sum('arrears');
        $totalAmount = $bills->sum('amount');

        $total = [
            'totalArrears' => isset($totalArrears) ? number_format($totalArrears, 2) : 0,
            'totalAmount' => isset($totalAmount) ? number_format($totalAmount, 2) : 0,
            'totalDue' => isset($totalArrears) && isset($totalAmount) ? number_format($totalArrears + $totalAmount, 2) : 0
        ];

        return view('bills.fetch', compact('bills', 'total'));
    }

    public function create(Request $request)
    {
        if (!auth()->user()->can('bills.create')) {
            abort(403, 'Unauthorized action.');
        }

        $total = 0;
        $properties = Property::orderBy('created_at', 'DESC')
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->whereNotIn('id', function ($query) {
                $query->select('property_id')
                    ->from('bills')
                    ->whereNotNull('property_id')
                    ->where('bills_year', Carbon::now()->year);
            })
            ->get();

        $assemblies = Assembly::orderBy('name', 'ASC')
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->get();

        $total = $properties->count('*');

        return view('bills.bulk', compact('total', 'assemblies'));
    }

    public function store(CreateBulkBillRequest $request)
    {
        Property::query()
            ->when($request->assembly_code, function ($query) use ($request) {
                $query->where('assembly_code', $request->assembly_code);
            })
            ->chunk(100, function ($properties) use ($request) {
                foreach ($properties as $property) {

                    $existingBill = Bill::where('property_id', $property->id)
                        ->where('bills_year', $request->bills_year)
                        ->first();

                    if (!$existingBill) {
                        $rateRecord = Rate::where('zone_id', $property->zone_id)
                            ->where('property_use_id', $property->property_use_id)
                            ->where('assembly_code', $property->assembly_code)
                            ->first();

                        if ($rateRecord) {
                            $calculatedBill = $rateRecord->rate * $property->ratable_value;

                            $yearlyBill = ($calculatedBill < $rateRecord->minimum_rate)
                                ? $rateRecord->minimum_rate
                                : $calculatedBill;

                            $totalBills = Bill::where('property_id', $property->id)->sum('amount');

                            $totalPayments = Payment::whereIn('bills_id', function ($query) use ($property) {
                                $query->select('bills_id')->from('bills')->where('property_id', $property->id);
                            })
                                ->where(function ($query) {
                                    $query->where('payment_mode', '!=', 'momo')
                                        ->orWhere(function ($query) {
                                            $query->where('payment_mode', 'momo')
                                                ->where('transaction_status', 'Success');
                                        });
                                })
                                ->sum('amount');

                            $arrears = $totalBills - $totalPayments;

                            $billData = [
                                'property_id' => $property->id,
                                'assembly_code' => $property->assembly_code,
                                'bills_id' => 'BILL' . time() . $property->id,
                                'bills_year' => $request->bills_year,
                                'arrears' => $arrears ?? 0,
                                'amount' => $yearlyBill,
                                'billing_date' => Carbon::now(),
                                'created_by' => $request->user()->id,
                            ];

                            Bill::create($billData);
                        } else {
                            echo "No rate found for Property Number: {$property->property_number}\n";
                        }
                    } else {
                        echo "Bill already exists for Property Number: {$property->property_number} for the current year.\n";
                    }
                }
            });

        return redirect()->route('bills.index')->with('status', 'Yearly bill generated successfully.');
    }

    public function singleCreate(Request $request)
    {
        if (!auth()->user()->can('bills.create')) {
            abort(403, 'Unauthorized action.');
        }

        $total = 0;
        $properties = Property::orderBy('created_at', 'DESC')
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->whereNotIn('id', function ($query) {
                $query->select('property_id')
                    ->from('bills')
                    ->whereNotNull('property_id')
                    ->where('bills_year', Carbon::now()->year);
            })
            ->get();

        $assemblies = Assembly::orderBy('name', 'ASC')
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->get();

        $total = $properties->count('*');

        return view('bills.single', compact('total', 'assemblies', 'properties'));
    }

    public function singleStore(CreateSingleBillRequest $request)
    {
        Property::query()
            ->when($request->assembly_code, function ($query) use ($request) {
                $query->where('assembly_code', $request->assembly_code);
            })
            ->whereIn('id', $request->property_id)
            ->chunk(100, function ($properties) use ($request) {
                foreach ($properties as $property) {

                    $existingBill = Bill::where('property_id', $property->id)
                        ->where('bills_year', $request->bills_year)
                        ->first();

                    if (!$existingBill) {
                        $rateRecord = Rate::where('zone_id', $property->zone_id)
                            ->where('property_use_id', $property->property_use_id)
                            ->where('assembly_code', $property->assembly_code)
                            ->first();

                        if ($rateRecord) {
                            $calculatedBill = $rateRecord->rate * $property->ratable_value;

                            $yearlyBill = ($calculatedBill < $rateRecord->minimum_rate)
                                ? $rateRecord->minimum_rate
                                : $calculatedBill;

                            $totalBills = Bill::where('property_id', $property->id)->sum('amount');

                            $totalPayments = Payment::whereIn('bills_id', function ($query) use ($property) {
                                $query->select('bills_id')->from('bills')->where('property_id', $property->id);
                            })
                                ->where(function ($query) {
                                    $query->where('payment_mode', '!=', 'momo')
                                        ->orWhere(function ($query) {
                                            $query->where('payment_mode', 'momo')
                                                ->where('transaction_status', 'Success');
                                        });
                                })
                                ->sum('amount');

                            $arrears = $totalBills - $totalPayments;

                            $billData = [
                                'property_id' => $property->id,
                                'assembly_code' => $property->assembly_code,
                                'bills_id' => 'BILL' . time() . $property->id,
                                'bills_year' => $request->bills_year,
                                'arrears' => $arrears ?? 0,
                                'amount' => $yearlyBill,
                                'billing_date' => Carbon::now(),
                                'created_by' => $request->user()->id,
                            ];

                            Bill::create($billData);
                        } else {
                            echo "No rate found for Property Number: {$property->property_number}\n";
                        }
                    } else {
                        echo "Bill already exists for Property Number: {$property->property_number} for the current year.\n";
                    }
                }
            });

        return redirect()->route('bills.index')->with('status', 'Yearly bill generated successfully.');
    }

    public function divisionCreate(Request $request)
    {
        if (!auth()->user()->can('bills.create')) {
            abort(403, 'Unauthorized action.');
        }

        $total = 0;
        $properties = Property::orderBy('created_at', 'DESC')
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->whereNotIn('id', function ($query) {
                $query->select('property_id')
                    ->from('bills')
                    ->whereNotNull('property_id')
                    ->where('bills_year', Carbon::now()->year);
            })
            ->get();

        $divisions = Division::orderBy('division_name', 'ASC')
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->get();

        $total = $properties->count('*');

        return view('bills.division', compact('divisions', 'total'));
    }

    public function divisionStore(CreateDivisionBillRequest $request)
    {
        Property::query()
            ->when($request->division_id, function ($query) use ($request) {
                $query->where('division_id', $request->division_id);
            })
            ->chunk(100, function ($properties) use ($request) {
                foreach ($properties as $property) {

                    $existingBill = Bill::where('property_id', $property->id)
                        ->where('bills_year', $request->bills_year)
                        ->first();

                    if (!$existingBill) {
                        $rateRecord = Rate::where('zone_id', $property->zone_id)
                            ->where('property_use_id', $property->property_use_id)
                            ->where('assembly_code', $property->assembly_code)
                            ->first();

                        if ($rateRecord) {
                            $calculatedBill = $rateRecord->rate * $property->ratable_value;

                            $yearlyBill = ($calculatedBill < $rateRecord->minimum_rate)
                                ? $rateRecord->minimum_rate
                                : $calculatedBill;

                            $totalBills = Bill::where('property_id', $property->id)->sum('amount');

                            $totalPayments = Payment::whereIn('bills_id', function ($query) use ($property) {
                                $query->select('bills_id')->from('bills')->where('property_id', $property->id);
                            })
                                ->where(function ($query) {
                                    $query->where('payment_mode', '!=', 'momo')
                                        ->orWhere(function ($query) {
                                            $query->where('payment_mode', 'momo')
                                                ->where('transaction_status', 'Success');
                                        });
                                })
                                ->sum('amount');

                            $arrears = $totalBills - $totalPayments;

                            $billData = [
                                'property_id' => $property->id,
                                'assembly_code' => $property->assembly_code,
                                'bills_id' => 'BILL' . time() . $property->id,
                                'bills_year' => $request->bills_year,
                                'arrears' => $arrears ?? 0,
                                'amount' => $yearlyBill,
                                'billing_date' => Carbon::now(),
                                'created_by' => $request->user()->id,
                            ];

                            Bill::create($billData);
                        } else {
                            echo "No rate found for Property Number: {$property->property_number}\n";
                        }
                    } else {
                        echo "Bill already exists for Property Number: {$property->property_number} for the current year.\n";
                    }
                }
            });

        return redirect()->route('bills.index')->with('status', 'Yearly bill generated successfully.');
    }

    public function blockCreate(Request $request)
    {
        if (!auth()->user()->can('bills.create')) {
            abort(403, 'Unauthorized action.');
        }

        $total = 0;
        $properties = Property::orderBy('created_at', 'DESC')
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->whereNotIn('id', function ($query) {
                $query->select('property_id')
                    ->from('bills')
                    ->whereNotNull('property_id')
                    ->where('bills_year', Carbon::now()->year);
            })
            ->get();

        $blocks = Block::orderBy('block_name', 'ASC')
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->get();

        $total = $properties->count('*');

        return view('bills.block', compact('blocks', 'total'));
    }

    public function blockStore(CreateBlockBillRequest $request)
    {
        Property::query()
            ->when($request->block_id, function ($query) use ($request) {
                $query->where('block_id', $request->block_id);
            })
            ->chunk(100, function ($properties) use ($request) {
                foreach ($properties as $property) {

                    $existingBill = Bill::where('property_id', $property->id)
                        ->where('bills_year', $request->bills_year)
                        ->first();

                    if (!$existingBill) {
                        $rateRecord = Rate::where('zone_id', $property->zone_id)
                            ->where('property_use_id', $property->property_use_id)
                            ->where('assembly_code', $property->assembly_code)
                            ->first();

                        if ($rateRecord) {
                            $calculatedBill = $rateRecord->rate * $property->ratable_value;

                            $yearlyBill = ($calculatedBill < $rateRecord->minimum_rate)
                                ? $rateRecord->minimum_rate
                                : $calculatedBill;

                            $totalBills = Bill::where('property_id', $property->id)->sum('amount');

                            $totalPayments = Payment::whereIn('bills_id', function ($query) use ($property) {
                                $query->select('bills_id')->from('bills')->where('property_id', $property->id);
                            })
                                ->where(function ($query) {
                                    $query->where('payment_mode', '!=', 'momo')
                                        ->orWhere(function ($query) {
                                            $query->where('payment_mode', 'momo')
                                                ->where('transaction_status', 'Success');
                                        });
                                })
                                ->sum('amount');

                            $arrears = $totalBills - $totalPayments;

                            $billData = [
                                'property_id' => $property->id,
                                'assembly_code' => $property->assembly_code,
                                'bills_id' => 'BILL' . time() . $property->id,
                                'bills_year' => $request->bills_year,
                                'arrears' => $arrears ?? 0,
                                'amount' => $yearlyBill,
                                'billing_date' => Carbon::now(),
                                'created_by' => $request->user()->id,
                            ];

                            Bill::create($billData);
                        } else {
                            echo "No rate found for Property Number: {$property->property_number}\n";
                        }
                    } else {
                        echo "Bill already exists for Property Number: {$property->property_number} for the current year.\n";
                    }
                }
            });

        return redirect()->route('bills.index')->with('status', 'Yearly bill generated successfully.');
    }

    public function property(Request $request)
    {
        $properties = Property::orderBy('assembly_code', 'ASC')
            ->where('assembly_code', $request->assembly_code)
            ->whereNotIn('id', function ($query) {
                $query->select('property_id')
                    ->from('bills')
                    ->whereNotNull('property_id')
                    ->where('bills_year', Carbon::now()->year);
            })
            ->get()
            ->map(function ($property) {
                $firstname = $property->customer->first_name ?? '';
                $lastname = $property->customer->last_name ?? '';
                $fullname = $firstname . " " . $lastname;

                return [
                    'id' => $property->id,
                    'name' => $fullname . ' (' . $property->property_number . ')',
                ];
            });

        return response()->json([
            'message' => $properties
        ]);
    }

    public function receipt(Bill $bill)
    {
        return view('bills.receipt', compact('bill'));
    }

    public function show(Bill $bill)
    {
        return view('bills.show', compact('bill'));
    }

    public function edit($id)
    {
        // Logic for displaying the form to edit a bill
    }

    public function update(Request $request, $id)
    {
        // Logic for updating a bill
    }

    public function destroy($id)
    {
        // Logic for deleting a bill
    }
}
