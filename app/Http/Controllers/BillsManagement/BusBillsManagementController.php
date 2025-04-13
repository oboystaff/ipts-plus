<?php

namespace App\Http\Controllers\BillsManagement;

use App\Http\Controllers\Controller;
use App\Http\Requests\BusBill\CreateBlockBillRequest;
use App\Http\Requests\BusBill\CreateBulkBillRequest;
use App\Http\Requests\BusBill\CreateDivisionBillRequest;
use App\Http\Requests\BusBill\CreateSingleBillRequest;
use Illuminate\Http\Request;
use App\Models\Bill;
use App\Models\Business;
use App\Models\Invoice;
use App\Models\Assembly;
use App\Models\BOPRate;
use App\Models\Payment;
use App\Models\Division;
use App\Models\Block;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class BusBillsManagementController extends Controller
{
    public function index(Request $request)
    {
        if (!auth()->user()->can('bills.view')) {
            abort(403, 'Unauthorized action.');
        }

        $bills = Bill::orderBy('created_at', 'DESC')
            ->when(!empty($request->user()->regional_code), function ($query) use ($request) {
                $query->whereHas('assembly', function ($q) use ($request) {
                    $q->where('regional_code', $request->user()->regional_code);
                });
            })
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->whereNotNull('business_id')
            ->get();

        $invoiceExpectedAmount = Invoice::sum('amount_due');
        $invoicesPaid = Invoice::where('status', 'paid')->sum('amount_paid');
        $invoicesUnPaid = Invoice::where('status', null)->sum('amount_due');
        $invoicesArrears = Invoice::where('status', null)->sum('arrears');
        $currentAmount = Invoice::where('status', null)->sum('current_amount');
        $varianceofbill = $invoicesArrears - $currentAmount;
        $totalArrears = $bills->sum('arrears');
        $totalAmount = $bills->sum('amount');

        $totalExpectedPayments = Bill::query()
            ->when(!empty($request->user()->regional_code), function ($query) use ($request) {
                $query->whereHas('assembly', function ($q) use ($request) {
                    $q->where('regional_code', $request->user()->regional_code);
                });
            })
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->whereNotNull('business_id')
            ->whereYear('created_at', Carbon::now()->year)
            ->select(DB::raw('SUM(amount + arrears) as expectedPayment'))
            ->value('expectedPayment');

        $totalPayments = Payment::query()
            ->when(!empty($request->user()->regional_code), function ($query) use ($request) {
                $query->whereHas('assembly', function ($q) use ($request) {
                    $q->where('regional_code', $request->user()->regional_code);
                });
            })
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->whereHas('bill', function ($query) {
                $query->whereNotNull('business_id');
            })
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('amount');

        $totalUnpaidBills = 0;
        if (isset($totalExpectedPayments) && isset($totalPayments)) {
            $totalUnpaidBills = $totalExpectedPayments - $totalPayments;
        }

        $paymentPercentage = $totalExpectedPayments > 0 ? ($totalPayments / $totalExpectedPayments) * 100 : 0;

        $totalBill = Bill::query()
            ->when(!empty($request->user()->regional_code), function ($query) use ($request) {
                $query->whereHas('assembly', function ($q) use ($request) {
                    $q->where('regional_code', $request->user()->regional_code);
                });
            })
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->whereNotNull('business_id')
            ->whereNull('property_id')
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('amount');

        $totalBillArrears = Bill::query()
            ->when(!empty($request->user()->regional_code), function ($query) use ($request) {
                $query->whereHas('assembly', function ($q) use ($request) {
                    $q->where('regional_code', $request->user()->regional_code);
                });
            })
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->whereNotNull('business_id')
            ->whereNull('property_id')
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

        return view('bills-business.index', compact(
            'bills',
            'invoiceExpectedAmount',
            'invoicesPaid',
            'invoicesUnPaid',
            'invoicesArrears',
            'currentAmount',
            'varianceofbill',
            'total'
        ));
    }

    public function create(Request $request)
    {
        if (!auth()->user()->can('bills.create')) {
            abort(403, 'Unauthorized action.');
        }

        $total = 0;
        $businesses = Business::orderBy('created_at', 'DESC')
            ->when(!empty($request->user()->regional_code), function ($query) use ($request) {
                $query->whereHas('assembly', function ($q) use ($request) {
                    $q->where('regional_code', $request->user()->regional_code);
                });
            })
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->whereNotIn('id', function ($query) {
                $query->select('business_id')
                    ->from('bills')
                    ->whereNotNull('business_id')
                    ->where('bills_year', Carbon::now()->year);
            })
            ->get();

        $assemblies = Assembly::orderBy('name', 'ASC')
            ->when(!empty($request->user()->regional_code), function ($query) use ($request) {
                $query->where('regional_code', $request->user()->regional_code);
            })
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->get();

        $total = $businesses->count('*');

        return view('bills-business.bulk', compact('total', 'assemblies'));
    }

    public function store(CreateBulkBillRequest $request)
    {
        Business::query()
            ->when(!empty($request->user()->regional_code), function ($query) use ($request) {
                $query->whereHas('assembly', function ($q) use ($request) {
                    $q->where('regional_code', $request->user()->regional_code);
                });
            })
            ->when($request->assembly_code, function ($query) use ($request) {
                $query->where('assembly_code', $request->assembly_code);
            })
            ->chunk(100, function ($businesses) use ($request) {
                foreach ($businesses as $business) {

                    $existingBill = Bill::where('business_id', $business->id)
                        ->where('bills_year', $request->bills_year)
                        ->first();

                    if (!$existingBill) {
                        $rateRecord = BOPRate::where('zone_id', $business->zone_id)
                            ->where('property_use_id', $business->property_use_id)
                            ->where('assembly_code', $business->assembly_code)
                            ->first();

                        if ($rateRecord) {
                            $calculatedBill = $rateRecord->amount;

                            $yearlyBill = $calculatedBill;

                            $totalBills = Bill::where('business_id', $business->id)->sum('amount');

                            $totalPayments = Payment::whereIn('bills_id', function ($query) use ($business) {
                                $query->select('bills_id')->from('bills')->where('business_id', $business->id);
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
                                'business_id' => $business->id,
                                'assembly_code' => $business->assembly_code,
                                'bills_id' => 'BILL' . time() . $business->id,
                                'bills_year' => $request->bills_year,
                                'arrears' => $arrears ?? 0,
                                'amount' => $yearlyBill,
                                'billing_date' => Carbon::now(),
                                'created_by' => $request->user()->id,
                            ];

                            Bill::create($billData);
                        } else {
                            echo "No rate found for Business Number: {$business->business_number}\n";
                        }
                    } else {
                        echo "Bill already exists for Business Number: {$business->business_number} for the current year.\n";
                    }
                }
            });

        return redirect()->route('bills.bus.index')->with('status', 'Yearly bill generated successfully.');
    }

    public function singleCreate(Request $request)
    {
        if (!auth()->user()->can('bills.create')) {
            abort(403, 'Unauthorized action.');
        }

        $total = 0;
        $businesses = Business::orderBy('created_at', 'DESC')
            ->when(!empty($request->user()->regional_code), function ($query) use ($request) {
                $query->whereHas('assembly', function ($q) use ($request) {
                    $q->where('regional_code', $request->user()->regional_code);
                });
            })
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->whereNotIn('id', function ($query) {
                $query->select('business_id')
                    ->from('bills')
                    ->whereNotNull('business_id')
                    ->where('bills_year', Carbon::now()->year);
            })
            ->get();

        $assemblies = Assembly::orderBy('name', 'ASC')
            ->when(!empty($request->user()->regional_code), function ($query) use ($request) {
                $query->where('regional_code', $request->user()->regional_code);
            })
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->get();

        $total = $businesses->count('*');

        return view('bills-business.single', compact('total', 'assemblies', 'businesses'));
    }

    public function singleStore(CreateSingleBillRequest $request)
    {
        Business::query()
            ->when(!empty($request->user()->regional_code), function ($query) use ($request) {
                $query->whereHas('assembly', function ($q) use ($request) {
                    $q->where('regional_code', $request->user()->regional_code);
                });
            })
            ->when($request->assembly_code, function ($query) use ($request) {
                $query->where('assembly_code', $request->assembly_code);
            })
            ->whereIn('id', $request->business_id)
            ->chunk(100, function ($businesses) use ($request) {
                foreach ($businesses as $business) {

                    $existingBill = Bill::where('business_id', $business->id)
                        ->where('bills_year', $request->bills_year)
                        ->first();

                    if (!$existingBill) {
                        $rateRecord = BOPRate::where('zone_id', $business->zone_id)
                            ->where('property_use_id', $business->property_use_id)
                            ->where('assembly_code', $business->assembly_code)
                            ->first();

                        if ($rateRecord) {
                            $calculatedBill = $rateRecord->amount;

                            $yearlyBill = $calculatedBill;

                            $totalBills = Bill::where('business_id', $business->id)->sum('amount');

                            $totalPayments = Payment::whereIn('bills_id', function ($query) use ($business) {
                                $query->select('bills_id')->from('bills')->where('business_id', $business->id);
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
                                'business_id' => $business->id,
                                'assembly_code' => $business->assembly_code,
                                'bills_id' => 'BILL' . time() . $business->id,
                                'bills_year' => $request->bills_year,
                                'arrears' => $arrears ?? 0,
                                'amount' => $yearlyBill,
                                'billing_date' => Carbon::now(),
                                'created_by' => $request->user()->id,
                            ];

                            Bill::create($billData);
                        } else {
                            echo "No rate found for Businesss Number: {$business->businesss_number}\n";
                        }
                    } else {
                        echo "Bill already exists for Businesss Number: {$business->businesss_number} for the current year.\n";
                    }
                }
            });

        return redirect()->route('bills.bus.index')->with('status', 'Yearly bill generated successfully.');
    }

    public function divisionCreate(Request $request)
    {
        if (!auth()->user()->can('bills.create')) {
            abort(403, 'Unauthorized action.');
        }

        $total = 0;
        $businesses = Business::orderBy('created_at', 'DESC')
            ->when(!empty($request->user()->regional_code), function ($query) use ($request) {
                $query->whereHas('assembly', function ($q) use ($request) {
                    $q->where('regional_code', $request->user()->regional_code);
                });
            })
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->whereNotIn('id', function ($query) {
                $query->select('business_id')
                    ->from('bills')
                    ->whereNotNull('business_id')
                    ->where('bills_year', Carbon::now()->year);
            })
            ->get();

        $divisions = Division::orderBy('division_name', 'ASC')
            ->when(!empty($request->user()->regional_code), function ($query) use ($request) {
                $query->whereHas('assembly', function ($q) use ($request) {
                    $q->where('regional_code', $request->user()->regional_code);
                });
            })
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->get();

        $total = $businesses->count('*');

        return view('bills-business.division', compact('divisions', 'total'));
    }

    public function divisionStore(CreateDivisionBillRequest $request)
    {
        Business::query()
            ->when($request->division_id, function ($query) use ($request) {
                $query->where('division_id', $request->division_id);
            })
            ->chunk(100, function ($businesses) use ($request) {
                foreach ($businesses as $business) {

                    $existingBill = Bill::where('business_id', $business->id)
                        ->where('bills_year', $request->bills_year)
                        ->first();

                    if (!$existingBill) {
                        $rateRecord = BOPRate::where('zone_id', $business->zone_id)
                            ->where('property_use_id', $business->property_use_id)
                            ->where('assembly_code', $business->assembly_code)
                            ->first();

                        if ($rateRecord) {
                            $calculatedBill = $rateRecord->amount;

                            $yearlyBill = $calculatedBill;

                            $totalBills = Bill::where('business_id', $business->id)->sum('amount');

                            $totalPayments = Payment::whereIn('bills_id', function ($query) use ($business) {
                                $query->select('bills_id')->from('bills')->where('business_id', $business->id);
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
                                'business_id' => $business->id,
                                'assembly_code' => $business->assembly_code,
                                'bills_id' => 'BILL' . time() . $business->id,
                                'bills_year' => $request->bills_year,
                                'arrears' => $arrears ?? 0,
                                'amount' => $yearlyBill,
                                'billing_date' => Carbon::now(),
                                'created_by' => $request->user()->id,
                            ];

                            Bill::create($billData);
                        } else {
                            echo "No rate found for Business Number: {$business->business_number}\n";
                        }
                    } else {
                        echo "Bill already exists for Business Number: {$business->property_number} for the current year.\n";
                    }
                }
            });

        return redirect()->route('bills.bus.index')->with('status', 'Yearly bill generated successfully.');
    }

    public function blockCreate(Request $request)
    {
        if (!auth()->user()->can('bills.create')) {
            abort(403, 'Unauthorized action.');
        }

        $total = 0;
        $businesses = Business::orderBy('created_at', 'DESC')
            ->when(!empty($request->user()->regional_code), function ($query) use ($request) {
                $query->whereHas('assembly', function ($q) use ($request) {
                    $q->where('regional_code', $request->user()->regional_code);
                });
            })
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->whereNotIn('id', function ($query) {
                $query->select('business_id')
                    ->from('bills')
                    ->whereNotNull('business_id')
                    ->where('bills_year', Carbon::now()->year);
            })
            ->get();

        $blocks = Block::orderBy('block_name', 'ASC')
            ->when(!empty($request->user()->regional_code), function ($query) use ($request) {
                $query->whereHas('assembly', function ($q) use ($request) {
                    $q->where('regional_code', $request->user()->regional_code);
                });
            })
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->get();

        $total = $businesses->count('*');

        return view('bills-business.block', compact('blocks', 'total'));
    }

    public function blockStore(CreateBlockBillRequest $request)
    {
        Business::query()
            ->when($request->block_id, function ($query) use ($request) {
                $query->where('block_id', $request->block_id);
            })
            ->chunk(100, function ($businesses) use ($request) {
                foreach ($businesses as $business) {

                    $existingBill = Bill::where('business_id', $business->id)
                        ->where('bills_year', $request->bills_year)
                        ->first();

                    if (!$existingBill) {
                        $rateRecord = BOPRate::where('zone_id', $business->zone_id)
                            ->where('property_use_id', $business->property_use_id)
                            ->where('assembly_code', $business->assembly_code)
                            ->first();

                        if ($rateRecord) {
                            $calculatedBill = $rateRecord->amount;

                            $yearlyBill = $calculatedBill;

                            $totalBills = Bill::where('business_id', $business->id)->sum('amount');

                            $totalPayments = Payment::whereIn('bills_id', function ($query) use ($business) {
                                $query->select('bills_id')->from('bills')->where('business_id', $business->id);
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
                                'business_id' => $business->id,
                                'assembly_code' => $business->assembly_code,
                                'bills_id' => 'BILL' . time() . $business->id,
                                'bills_year' => $request->bills_year,
                                'arrears' => $arrears ?? 0,
                                'amount' => $yearlyBill,
                                'billing_date' => Carbon::now(),
                                'created_by' => $request->user()->id,
                            ];

                            Bill::create($billData);
                        } else {
                            echo "No rate found for Business Number: {$business->business_number}\n";
                        }
                    } else {
                        echo "Bill already exists for Business Number: {$business->business_number} for the current year.\n";
                    }
                }
            });

        return redirect()->route('bills.bus.index')->with('status', 'Yearly bill generated successfully.');
    }

    public function business(Request $request)
    {
        $businesses = Business::orderBy('assembly_code', 'ASC')
            ->where('assembly_code', $request->assembly_code)
            ->whereNotIn('id', function ($query) {
                $query->select('business_id')
                    ->from('bills')
                    ->whereNotNull('business_id')
                    ->where('bills_year', Carbon::now()->year);
            })
            ->get()
            ->map(function ($business) {
                $firstname = $business->customer->first_name ?? '';
                $lastname = $business->customer->last_name ?? '';
                $fullname = $firstname . " " . $lastname;

                return [
                    'id' => $business->id,
                    'name' => $fullname . ' (' . $business->business_owner_id . ')',
                ];
            });

        return response()->json([
            'message' => $businesses
        ]);
    }

    public function show() {}

    public function edit() {}

    public function update() {}
}
