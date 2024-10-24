<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Business;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Invoice;
use App\Models\Property;
use App\Models\Bill;
use App\Models\Citizen;
use App\Models\User;
use App\Models\Payment;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum']);
    }

    public function operational(Request $request)
    {
        if (!auth()->user()->can('dashboards.operational')) {
            abort(403, 'Unauthorized action.');
        }

        $totalBusinesses = Business::query()
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->where('status_of_business', 'Active')
            ->count();

        $totalProperties = Property::query()
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->count();

        $currentYear = Carbon::now()->year;
        $totalBusinessBill = Bill::whereNotNull('business_id')
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->whereNull('property_id')
            ->whereYear('created_at', $currentYear)
            ->sum('amount');

        $totalPropertyBill = Bill::whereNotNull('property_id')
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->whereNull('business_id')
            ->whereYear('created_at', $currentYear)
            ->sum('amount');

        $totalAssemblyAgents = User::where('access_level', 'Assembly_Agent')
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->count();

        $totalActiveAssemblyAgents = User::where('access_level', 'Assembly_Agent')
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->where('status', 'Active')
            ->count();

        $totalInactiveAssemblyAgents = User::where('access_level', 'Assembly_Agent')
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->where('status', 'InActive')
            ->count();

        $totalPayments = Payment::selectRaw('SUM(amount) as total')
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->when('momo', function ($query) {
                $query->where(function ($q) {
                    $q->where('payment_mode', '!=', 'momo')
                        ->orWhere(function ($q2) {
                            $q2->where('payment_mode', 'momo')
                                ->where('transaction_status', 'Success');
                        });
                });
            });

        $dailyPayments = (clone $totalPayments)
            ->whereDate('created_at', Carbon::today())
            ->first();

        $weeklyPayments = (clone $totalPayments)
            ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->first();

        $monthlyPayments = (clone $totalPayments)
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->first();

        $yearlyPayments = (clone $totalPayments)
            ->whereYear('created_at', Carbon::now()->year)
            ->first();

        //Graph data
        $year = $request->input('year', Carbon::now()->year);

        $billData = Bill::select(
            DB::raw('SUM(amount) as total_bills'),
            DB::raw('MONTH(created_at) as month')
        )
            ->whereYear('created_at', $year)
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->groupBy('month')
            ->get()
            ->pluck('total_bills', 'month');

        $paymentData = Payment::select(
            DB::raw('SUM(CASE 
                    WHEN payment_mode = "momo" AND transaction_status = "Success" THEN amount 
                    WHEN payment_mode != "momo" THEN amount 
                    ELSE 0 
                END) as total_payments'),
            DB::raw('MONTH(created_at) as month')
        )
            ->whereYear('created_at', $year)
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->groupBy('month')
            ->get()
            ->pluck('total_payments', 'month');

        $months = collect(range(1, 12))->mapWithKeys(function ($month) use ($billData, $paymentData) {
            return [
                $month => [
                    'bills' => $billData->get($month, 0),
                    'payments' => $paymentData->get($month, 0)
                ]
            ];
        });

        $labels = $months->keys()->map(function ($month) {
            return Carbon::create()->month($month)->format('F');
        });

        $billAmounts = $months->pluck('bills');
        $paymentAmounts = $months->pluck('payments');

        $chartData = [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Bills',
                    'backgroundColor' => 'rgba(54, 162, 235, 0.6)',
                    'data' => $billAmounts,
                ],
                [
                    'label' => 'Payments',
                    'backgroundColor' => 'rgba(75, 192, 192, 0.6)',
                    'data' => $paymentAmounts,
                ],
            ],
        ];

        $totalBill = Bill::query()
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('amount');

        $totalArrears = Bill::query()
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('arrears');

        $totalExpectedPayments = Bill::query()
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->whereYear('created_at', Carbon::now()->year)
            ->select(DB::raw('SUM(amount + arrears) as expectedPayment'))
            ->value('expectedPayment');

        //weekly performance graph
        $paymentsData = Payment::select(
            DB::raw('SUM(amount) as total_payments'),
            DB::raw('DAYNAME(created_at) as day')
        )
            ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->groupBy('day')
            ->get()
            ->pluck('total_payments', 'day');

        $weekDays = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        $chartData2 = [];

        foreach ($weekDays as $day) {
            $chartData2[] = $paymentsData->get($day, 0);
        }

        //monthly performance graph
        $paymentsData2 = Payment::select(
            DB::raw('SUM(amount) as total_payments'),
            DB::raw('MONTH(created_at) as month')
        )
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('month')
            ->get()
            ->pluck('total_payments', 'month');

        $chartData3 = [];
        for ($month = 1; $month <= 12; $month++) {
            $chartData3[] = $paymentsData2->get($month, 0);
        }

        //Customer Data
        $customerData = [];
        if ($request->user()->access_level == 'customer') {
            $customer = Citizen::where('user_id', $request->user()->id)->first();

            if ($customer) {
                $properties = Property::orderBy('created_at', 'DESC')
                    ->where('customer_name', $customer->id)
                    ->get();

                $businesses = Business::orderBy('created_at', 'DESC')
                    ->where('citizen_account_number', $customer->id)
                    ->get();

                $bills = Bill::orderBy('created_at', 'DESC')
                    ->with(['property', 'business'])
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
                    ->get();

                $payments = Payment::orderBy('created_at', 'DESC')
                    ->whereHas('bill', function ($query) use ($customer) {
                        $query->whereHas('property', function ($propertyQuery) use ($customer) {
                            $propertyQuery->where('customer_name', $customer->id)
                                ->whereNotNull('property_id')
                                ->whereNull('business_id');
                        })
                            ->orWhereHas('business', function ($businessQuery) use ($customer) {
                                $businessQuery->where('citizen_account_number', $customer->id)
                                    ->whereNotNull('business_id')
                                    ->whereNull('property_id');
                            });
                    })
                    ->get();


                $totalBillP = Bill::query()
                    ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                        $query->where('assembly_code', $request->user()->assembly_code);
                    })
                    ->whereYear('created_at', Carbon::now()->year)
                    ->where(function ($query) use ($customer) {
                        $query->whereHas('property', function ($q) use ($customer) {
                            $q->where('customer_name',  $customer->id);
                        })
                            ->whereNotNull('property_id')
                            ->whereNull('business_id');
                    })
                    ->sum('amount');

                $totalBillB = Bill::query()
                    ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                        $query->where('assembly_code', $request->user()->assembly_code);
                    })
                    ->whereYear('created_at', Carbon::now()->year)
                    ->where(function ($query) use ($customer) {
                        $query->whereHas('business', function ($q) use ($customer) {
                            $q->where('citizen_account_number', $customer->id);
                        })
                            ->whereNotNull('business_id')
                            ->whereNull('property_id');
                    })
                    ->sum('amount');

                $totalArrearsP = Bill::query()
                    ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                        $query->where('assembly_code', $request->user()->assembly_code);
                    })
                    ->whereYear('created_at', Carbon::now()->year)
                    ->where(function ($query) use ($customer) {
                        $query->whereHas('property', function ($q) use ($customer) {
                            $q->where('customer_name',  $customer->id);
                        })
                            ->whereNotNull('property_id')
                            ->whereNull('business_id');
                    })
                    ->sum('arrears');

                $totalArrearsB = Bill::query()
                    ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                        $query->where('assembly_code', $request->user()->assembly_code);
                    })
                    ->whereYear('created_at', Carbon::now()->year)
                    ->where(function ($query) use ($customer) {
                        $query->whereHas('business', function ($q) use ($customer) {
                            $q->where('citizen_account_number', $customer->id);
                        })
                            ->whereNotNull('business_id')
                            ->whereNull('property_id');
                    })
                    ->sum('arrears');

                $totalExpectedPaymentsP = Bill::query()
                    ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                        $query->where('assembly_code', $request->user()->assembly_code);
                    })
                    ->whereYear('created_at', Carbon::now()->year)
                    ->where(function ($query) use ($customer) {
                        $query->whereHas('property', function ($q) use ($customer) {
                            $q->where('customer_name',  $customer->id);
                        })
                            ->whereNotNull('property_id')
                            ->whereNull('business_id');
                    })
                    ->select(DB::raw('SUM(amount + arrears) as expectedPayment'))
                    ->value('expectedPayment');

                $totalExpectedPaymentsB = Bill::query()
                    ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                        $query->where('assembly_code', $request->user()->assembly_code);
                    })
                    ->whereYear('created_at', Carbon::now()->year)
                    ->where(function ($query) use ($customer) {
                        $query->whereHas('business', function ($q) use ($customer) {
                            $q->where('citizen_account_number', $customer->id);
                        })
                            ->whereNotNull('business_id')
                            ->whereNull('property_id');
                    })
                    ->select(DB::raw('SUM(amount + arrears) as expectedPayment'))
                    ->value('expectedPayment');

                $totalPaymentsP = Payment::selectRaw('SUM(amount) as total')
                    ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                        $query->where('assembly_code', $request->user()->assembly_code);
                    })
                    ->whereHas('bill', function ($query) use ($customer) {
                        $query->whereHas('property', function ($propertyQuery) use ($customer) {
                            $propertyQuery->where('customer_name', $customer->id)
                                ->whereNotNull('property_id')
                                ->whereNull('business_id');
                        });
                    })
                    ->when('momo', function ($query) {
                        $query->where(function ($q) {
                            $q->where('payment_mode', '!=', 'momo')
                                ->orWhere(function ($q2) {
                                    $q2->where('payment_mode', 'momo')
                                        ->where('transaction_status', 'Success');
                                });
                        });
                    });

                $totalPaymentsB = Payment::selectRaw('SUM(amount) as total')
                    ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                        $query->where('assembly_code', $request->user()->assembly_code);
                    })
                    ->whereHas('bill', function ($query) use ($customer) {
                        $query->whereHas('business', function ($businessQuery) use ($customer) {
                            $businessQuery->where('citizen_account_number', $customer->id)
                                ->whereNotNull('business_id')
                                ->whereNull('property_id');
                        });
                    })
                    ->when('momo', function ($query) {
                        $query->where(function ($q) {
                            $q->where('payment_mode', '!=', 'momo')
                                ->orWhere(function ($q2) {
                                    $q2->where('payment_mode', 'momo')
                                        ->where('transaction_status', 'Success');
                                });
                        });
                    });

                $yearlyPaymentsP = (clone $totalPaymentsP)
                    ->whereYear('created_at', Carbon::now()->year)
                    ->first();

                $yearlyPaymentsB = (clone $totalPaymentsB)
                    ->whereYear('created_at', Carbon::now()->year)
                    ->first();

                $totalArrears = $bills->sum('arrears');
                $totalAmount = $bills->sum('amount');
            } else {
                $properties = [];
                $businesses = [];
                $bills = [];
                $payments = [];
            }

            $customerData = [
                'properties' => isset($properties) ? $properties : [],
                'businesses' => isset($businesses) ? $businesses : [],
                'total' => isset($properties) ? number_format(collect($properties)->sum('ratable_value'), 2) : 0,
                'bills' => isset($bills) ? $bills : [],
                'totalArrears' => isset($totalArrears) ? number_format($totalArrears, 2) : 0,
                'totalAmount' => isset($totalAmount) ? number_format($totalAmount, 2) : 0,
                'totalDue' => isset($totalArrears) && isset($totalAmount) ? number_format($totalArrears + $totalAmount, 2) : 0,
                'payments' => isset($payments) ? $payments : [],
                'paymentTotal' => isset($payments) ? number_format($payments->sum('amount'), 2) : 0,
                'totalBillP' => isset($totalBillP) ? number_format($totalBillP, 2) : 0,
                'totalArrearsP' => isset($totalArrearsP) ? number_format($totalArrearsP, 2) : 0,
                'totalExpectedPaymentsP' => isset($totalExpectedPaymentsP) ? number_format($totalExpectedPaymentsP, 2) : 0,
                'yearlyPaymentsP' => isset($yearlyPaymentsP) ? number_format($yearlyPaymentsP->total, 2) : 0,
                'totalBillB' => isset($totalBillB) ? number_format($totalBillB, 2) : 0,
                'totalArrearsB' => isset($totalArrearsB) ? number_format($totalArrearsB, 2) : 0,
                'totalExpectedPaymentsB' => isset($totalExpectedPaymentsB) ? number_format($totalExpectedPaymentsB, 2) : 0,
                'yearlyPaymentsB' => isset($yearlyPaymentsB) ? number_format($yearlyPaymentsB->total, 2) : 0,
            ];
        }

        $total = [
            'totalBusinesses' => isset($totalBusinesses) ? $totalBusinesses : 0,
            'totalProperties' => isset($totalProperties) ? $totalProperties : 0,
            'totalBusinessBill' => isset($totalBusinessBill) ? number_format($totalBusinessBill, 2) : 0,
            'totalPropertyBill' => isset($totalPropertyBill) ? number_format($totalPropertyBill, 2) : 0,
            'totalAssemblyAgents' => isset($totalAssemblyAgents) ? $totalAssemblyAgents : 0,
            'totalActiveAssemblyAgents' => isset($totalActiveAssemblyAgents) ? $totalActiveAssemblyAgents : 0,
            'totalInactiveAssemblyAgents' => isset($totalInactiveAssemblyAgents) ? $totalInactiveAssemblyAgents : 0,
            'dailyPayments' => isset($dailyPayments) ? number_format($dailyPayments->total, 2) : 0,
            'weeklyPayments' => isset($weeklyPayments) ? number_format($weeklyPayments->total, 2) : 0,
            'monthlyPayments' => isset($monthlyPayments) ? number_format($monthlyPayments->total, 2) : 0,
            'yearlyPayments' => isset($yearlyPayments) ? number_format($yearlyPayments->total, 2) : 0,
            'totalBill' => isset($totalBill) ? number_format($totalBill, 2) : 0,
            'totalArrears' => isset($totalArrears) ? number_format($totalArrears, 2) : 0,
            'totalExpectedPayments' => isset($totalExpectedPayments) ? number_format($totalExpectedPayments, 2) : 0
        ];

        return view('dashboard.operational', compact('total', 'chartData', 'chartData2', 'chartData3', 'customerData'));
    }
}
