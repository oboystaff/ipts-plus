<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Assembly;
use App\Models\Business;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Invoice;
use App\Models\Property;
use App\Models\Bill;
use App\Models\Citizen;
use App\Models\GhanaRegion;
use App\Models\User;
use App\Models\Payment;
use App\Models\BusinessClassType;
use App\Models\Zone;
use Illuminate\Support\Collection;


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

        $lastMonthBusinessBill = Bill::whereNotNull('business_id')
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->whereNull('property_id')
            ->whereBetween('created_at', [
                Carbon::now()->subMonth()->startOfMonth(),
                Carbon::now()->subMonth()->endOfMonth(),
            ])
            ->sum('amount');

        $totalPropertyBill = Bill::whereNotNull('property_id')
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->whereNull('business_id')
            ->whereYear('created_at', $currentYear)
            ->sum('amount');

        $lastMonthPropertyBill = Bill::whereNotNull('property_id')
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->whereNull('business_id')
            ->whereBetween('created_at', [
                Carbon::now()->subMonth()->startOfMonth(),
                Carbon::now()->subMonth()->endOfMonth(),
            ])
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

        $startOfLastMonth = Carbon::now()->subMonth()->startOfMonth();
        $endOfLastMonth = Carbon::now()->subMonth()->endOfMonth();

        // Get total payments for the last month
        $lastMonthPayments = (clone $totalPayments)
            ->whereBetween('created_at', [$startOfLastMonth, $endOfLastMonth])
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

        //No payment bills
        $totalCompletedBill = Bill::query()
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->whereYear('created_at', Carbon::now()->year)
            ->whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('payments')
                    ->whereColumn('payments.bills_id', 'bills.bills_id');
            })
            ->count();

        $totalUpcomingBill = Bill::query()
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->whereYear('created_at', Carbon::now()->year)
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('payments')
                    ->whereColumn('payments.bills_id', 'bills.bills_id')
                    ->groupBy('payments.bills_id')
                    ->havingRaw('SUM(payments.amount) < bills.amount');
            })
            ->count();

        $totalNewBill = Bill::query()
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->whereYear('created_at', Carbon::now()->year)
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('payments')
                    ->whereColumn('payments.bills_id', 'bills.bills_id')
                    ->groupBy('payments.bills_id')
                    ->havingRaw('SUM(payments.amount) >= bills.amount');
            })
            ->count();

        $totalBills = $totalCompletedBill + $totalUpcomingBill + $totalNewBill;
        if ($totalBills > 0) {
            $completedPercentage = ($totalCompletedBill / $totalBills) * 100;
            $upcomingPercentage = ($totalUpcomingBill / $totalBills) * 100;
            $newPercentage = ($totalNewBill / $totalBills) * 100;
        } else {
            $completedPercentage = $upcomingPercentage = $newPercentage = 0;
        }

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

        $yearlyCashPayments = Payment::where('payment_mode', 'cash')
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('amount');

        $yearlyMomoPayments = Payment::where('payment_mode', 'momo')
            ->where('transaction_status', 'Success')
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('amount');

        $yearlyReceivables = $totalBill - $yearlyPayments->total;

        $totalAssembly = Assembly::where('status', 'Active')
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->count();

        $regions = GhanaRegion::with('assemblies')->get();

        //Grapha Data
        $payments = DB::table('payments')
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('SUM(amount) as total'))
            ->whereYear('created_at', $currentYear)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month');

        $bills = DB::table('bills')
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('SUM(amount) as total'))
            ->whereYear('created_at', $currentYear)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month');

        $arrears = [];
        for ($month = 1; $month <= 12; $month++) {
            $arrears[$month] = ($bills[$month] ?? 0) - ($payments[$month] ?? 0);
        }

        $paymentData = [];
        $billData = [];
        $arrearsData = [];

        for ($month = 1; $month <= 12; $month++) {
            $paymentData[] = $payments[$month] ?? 0;
            $billData[] = $bills[$month] ?? 0;
            $arrearsData[] = $arrears[$month] ?? 0;
        }

        $assemblyPayments = DB::table('payments')
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('payments.assembly_code', $request->user()->assembly_code);
            })
            ->join('assemblies', 'payments.assembly_code', '=', 'assemblies.assembly_code')
            ->select(
                'assemblies.name as assembly_name',
                DB::raw("
                    SUM(
                        CASE
                            WHEN payments.payment_mode = 'momo' AND payments.transaction_status = 'Success' THEN payments.amount
                            WHEN payments.payment_mode != 'momo' THEN payments.amount
                            ELSE 0
                        END
                    ) as total_payment
                ")
            )
            ->whereYear('payments.created_at', $currentYear)
            ->groupBy('assemblies.name')
            ->orderBy('total_payment', 'desc')
            ->get();

        $topAssemblies = DB::table('bills')
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('bills.assembly_code', $request->user()->assembly_code);
            })
            ->join('assemblies', 'bills.assembly_code', '=', 'assemblies.assembly_code')
            ->leftJoin('payments', 'bills.bills_id', '=', 'payments.bills_id')
            ->select(
                'assemblies.name as assembly_name',
                'bills.assembly_code',
                DB::raw("
                    SUM(bills.amount) as total_bill_amount
                ")
            )
            ->whereYear('bills.created_at', $currentYear)
            ->whereNull('payments.bills_id')
            ->groupBy('bills.assembly_code', 'assemblies.name')
            ->orderBy('total_bill_amount', 'desc')
            ->limit(5)
            ->get();

        $chartData11 = [];
        foreach ($topAssemblies as $assembly) {
            $monthlyBills = DB::table('bills')
                ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                    $query->where('bills.assembly_code', $request->user()->assembly_code);
                })
                ->leftJoin('payments', 'bills.bills_id', '=', 'payments.bills_id')
                ->where('bills.assembly_code', $assembly->assembly_code)
                ->whereYear('bills.created_at', $currentYear)
                ->whereNull('payments.bills_id')
                ->select(
                    DB::raw('MONTH(bills.created_at) as month'),
                    DB::raw('SUM(bills.amount) as total')
                )
                ->groupBy('month')
                ->get()
                ->pluck('total', 'month')
                ->toArray();

            $data = [];
            foreach (range(1, 12) as $month) {
                $data[] = $monthlyBills[$month] ?? 0;
            }

            $chartData11[] = [
                'name' => $assembly->assembly_name,
                'data' => $data,
            ];
        }

        $maleMonthlyCount = DB::table('citizens')
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as total'))
            ->where('gender', 'Male')
            ->where('status', 'Active')
            ->whereYear('created_at', $currentYear)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->pluck('total', 'month');

        $femaleMonthlyCount = DB::table('citizens')
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as total'))
            ->where('gender', 'Female')
            ->where('status', 'Active')
            ->whereYear('created_at', $currentYear)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->pluck('total', 'month');

        $maleMonthlyCount = array_pad($maleMonthlyCount->toArray(), 12, 0);
        $femaleMonthlyCount = array_pad($femaleMonthlyCount->toArray(), 12, 0);

        $monthlyActiveCounts = [];
        $monthlyInactiveCounts = [];
        for ($month = 1; $month <= 12; $month++) {
            $startOfMonth = Carbon::create($currentYear, $month, 1)->startOfMonth();
            $endOfMonth = Carbon::create($currentYear, $month, 1)->endOfMonth();

            $activeCount = Citizen::where('status', 'Active')
                ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
                ->count();

            $inactiveCount = Citizen::where('status', 'InActive')
                ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
                ->count();

            $monthlyActiveCounts[] = $activeCount;
            $monthlyInactiveCounts[] = $inactiveCount;
        }

        $monthlyPropertyCounts = [];
        $monthlyBusinessCounts = [];
        for ($month = 1; $month <= 12; $month++) {
            $startOfMonth = Carbon::create($currentYear, $month, 1)->startOfMonth();
            $endOfMonth = Carbon::create($currentYear, $month, 1)->endOfMonth();

            $propertyCount = Property::query()
                ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                    $query->where('assembly_code', $request->user()->assembly_code);
                })
                ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
                ->count();

            $businessCount = Business::query()
                ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                    $query->where('assembly_code', $request->user()->assembly_code);
                })
                ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
                ->count();

            // Store the results in the arrays
            $monthlyPropertyCounts[] = $propertyCount;
            $monthlyBusinessCounts[] = $businessCount;
        }

        $topProperties = DB::table('payments')
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('payments.assembly_code', $request->user()->assembly_code);
            })
            ->join('bills', 'payments.bills_id', '=', 'bills.bills_id')
            ->join('properties', 'bills.property_id', '=', 'properties.id')
            ->join('citizens', 'properties.customer_name', '=', 'citizens.id')
            ->selectRaw('
                bills.property_id as id, 
                properties.property_number as number, 
                citizens.first_name as owner_name, 
                citizens.telephone_number as phone,
                SUM(CASE 
                    WHEN payments.payment_mode = "momo" AND payments.transaction_status = "Success" THEN payments.amount
                    WHEN payments.payment_mode != "momo" THEN payments.amount
                    ELSE 0 
                END) as total_payments')
            ->whereNotNull('bills.property_id')
            ->whereNull('bills.business_id')
            ->whereYear('payments.created_at', $currentYear)
            ->groupBy('bills.property_id', 'properties.property_number', 'citizens.first_name', 'citizens.telephone_number')
            ->orderByDesc('total_payments')
            ->limit(10)
            ->get();

        $topBusinesses = DB::table('payments')
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('payments.assembly_code', $request->user()->assembly_code);
            })
            ->join('bills', 'payments.bills_id', '=', 'bills.bills_id')
            ->join('businesses', 'bills.business_id', '=', 'businesses.id')
            ->join('citizens', 'businesses.citizen_account_number', '=', 'citizens.id')
            ->selectRaw('
                bills.business_id as id, 
                businesses.bus_account_number as bus_number,
                 citizens.first_name as owner_name, 
                citizens.telephone_number as phone,
                SUM(CASE 
                    WHEN payments.payment_mode = "momo" AND payments.transaction_status = "Success" THEN payments.amount
                    WHEN payments.payment_mode != "momo" THEN payments.amount
                    ELSE 0 
                END) as total_payments')
            ->whereNotNull('bills.business_id')
            ->whereNull('bills.property_id')
            ->whereYear('payments.created_at', $currentYear)
            ->groupBy('bills.business_id', 'businesses.bus_account_number', 'citizens.first_name', 'citizens.telephone_number')
            ->orderByDesc('total_payments')
            ->limit(10)
            ->get();

        $chartData12 = [
            'properties' => $topProperties->map(function ($property) {
                return [
                    'name' => $property->number . '(P)/' . $property->owner_name . '/' . $property->phone,
                    'data' => [$property->total_payments],
                ];
            }),
            'businesses' => $topBusinesses->map(function ($business) {
                return [
                    'name' => $business->bus_number . '(B)/' . $business->owner_name . '/' . $business->phone,
                    'data' => [$business->total_payments],
                ];
            }),
        ];

        $divisionPaymentData = DB::table('payments')
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('payments.assembly_code', $request->user()->assembly_code);
            })
            ->join('bills', 'payments.bills_id', '=', 'bills.bills_id')
            ->leftJoin('properties', 'bills.property_id', '=', 'properties.id')
            ->leftJoin('businesses', 'bills.business_id', '=', 'businesses.id')
            ->leftJoin('divisions', function ($join) {
                $join->on('properties.division_id', '=', 'divisions.id')
                    ->orOn('businesses.division_id', '=', 'divisions.id');
            })
            ->selectRaw('divisions.division_name as division_name, 
                MONTH(payments.created_at) as month, 
                SUM(CASE 
                    WHEN payments.payment_mode = "momo" AND payments.transaction_status = "Success" THEN payments.amount
                    WHEN payments.payment_mode != "momo" THEN payments.amount
                    ELSE 0 
                END) as total_payments')
            ->whereYear('payments.created_at', $currentYear)
            ->groupBy('divisions.division_name', 'month')
            ->orderByDesc('total_payments')
            ->limit(10)
            ->get();

        $regionPaymentData = DB::table('payments')
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('payments.assembly_code', $request->user()->assembly_code);
            })
            ->join('assemblies', 'payments.assembly_code', '=', 'assemblies.assembly_code')
            ->join('ghana_regions', 'assemblies.regional_code', '=', 'ghana_regions.regional_code')
            ->selectRaw('
                ghana_regions.name as region_name, 
                MONTH(payments.created_at) as month, 
                SUM(CASE 
                    WHEN payments.payment_mode = "momo" AND payments.transaction_status = "Success" THEN payments.amount
                    WHEN payments.payment_mode != "momo" THEN payments.amount
                    ELSE 0 
                END) as total_payments
            ')
            ->whereYear('payments.created_at', $currentYear)
            ->groupBy('ghana_regions.name', 'month')
            ->get()
            ->keyBy(function ($item) {
                return $item->region_name . '-' . $item->month;
            });

        $regionBillData = DB::table('bills')
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('bills.assembly_code', $request->user()->assembly_code);
            })
            ->join('assemblies', 'bills.assembly_code', '=', 'assemblies.assembly_code')
            ->join('ghana_regions', 'assemblies.regional_code', '=', 'ghana_regions.regional_code')
            ->selectRaw('
                ghana_regions.name as region_name, 
                MONTH(bills.created_at) as month, 
                SUM(bills.amount) as total_bills
            ')
            ->whereYear('bills.created_at', $currentYear)
            ->groupBy('ghana_regions.name', 'month')
            ->get()
            ->keyBy(function ($item) {
                return $item->region_name . '-' . $item->month;
            });


        $regionArrearsData = new Collection();
        foreach ($regionPaymentData as $regionMonth => $payment) {
            list($regionName, $month) = explode('-', $regionMonth);

            $bills = $regionBillData->get($regionMonth);
            $totalBills = $bills ? $bills->total_bills : 0;
            $totalPayments = $payment->total_payments;

            $regionArrearsData->push([
                'region_name' => $regionName,
                'month' => $month,
                'arrears' => $totalBills - $totalPayments,
            ]);
        }

        $regionPaymentData2 = DB::table('payments')
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('payments.assembly_code', $request->user()->assembly_code);
            })
            ->join('assemblies', 'payments.assembly_code', '=', 'assemblies.assembly_code')
            ->join('ghana_regions', 'assemblies.regional_code', '=', 'ghana_regions.regional_code')
            ->selectRaw('
                ghana_regions.name as region_name, 
                MONTH(payments.created_at) as month,
                payments.payment_mode, 
                SUM(CASE 
                    WHEN payments.payment_mode = "momo" AND payments.transaction_status = "Success" THEN payments.amount
                    WHEN payments.payment_mode != "momo" THEN payments.amount
                    ELSE 0 
                END) as total_payments
            ')
            ->whereYear('payments.created_at', $currentYear)
            ->groupBy('ghana_regions.name', 'payments.payment_mode', 'month')
            ->get();

        $dashBills = DB::table('bills')
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->selectRaw('MONTH(created_at) as month, SUM(amount) as total_bills')
            ->whereYear('created_at', $currentYear)
            ->groupBy('month')
            ->pluck('total_bills', 'month');

        $dashPayments = DB::table('payments')
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->selectRaw("
                MONTH(created_at) as month, 
                SUM(CASE 
                    WHEN payment_mode = 'momo' AND transaction_status = 'Success' THEN amount 
                    WHEN payment_mode != 'momo' THEN amount 
                    ELSE 0 
                END) as total_payments
            ")
            ->whereYear('created_at', $currentYear)
            ->groupBy('month')
            ->pluck(
                'total_payments',
                'month'
            );

        $dashChartData = [];
        for ($month = 1; $month <= 12; $month++) {
            $totalBills = $dashBills[$month] ?? 0;
            $totalPayments = $dashPayments[$month] ?? 0;
            $arrears = $totalBills - $totalPayments;

            $dashChartData[] = [
                'month' => $month,
                'bills' => $totalBills,
                'payments' => $totalPayments,
                'arrears' => $arrears,
            ];
        }

        $totalBusinessBill = (float) $totalBusinessBill;
        $totalPropertyBill = (float) $totalPropertyBill;

        // Calculate the summation
        $totalSum = $totalBusinessBill + $totalPropertyBill;

        // Define the cuts
        $gracut = $totalSum * 1.5; // 15%
        $level10cut = $totalSum * 1.5; // 15%
        $assemblycut = $totalSum * 7.0; // 70%
        $finalCut = 0;

        if ($request->user()->access_level === 'Melchia_Account_Manager') {
            $finalCut = $level10cut / 100;
        } elseif ($request->user()->access_level === 'GRA_Administrator') {
            $finalCut = $gracut / 100;
        } elseif ($request->user()->access_level === 'Assembly_Administrator') {
            $finalCut = $assemblycut / 100;
        }

        $totalRegionalData = DB::table('ghana_regions')
            ->join('assemblies', 'ghana_regions.regional_code', '=', 'assemblies.regional_code')
            ->join('properties', 'assemblies.assembly_code', '=', 'properties.assembly_code')
            ->join('bills', 'assemblies.assembly_code', '=', 'bills.assembly_code')
            ->join('payments', 'assemblies.assembly_code', '=', 'payments.assembly_code')
            ->select(
                'ghana_regions.name as region_name',
                DB::raw('COUNT(DISTINCT properties.id) as total_properties_region'),
                DB::raw('COALESCE(SUM(bills.amount), 0) as total_bills_region'),
                DB::raw("
                    SUM(
                        CASE 
                            WHEN payments.payment_mode = 'momo' AND payments.transaction_status = 'Success' THEN payments.amount
                            WHEN payments.payment_mode != 'momo' THEN payments.amount
                            ELSE 0
                        END
                    ) as total_payments_region
                "),
                DB::raw('
                    COALESCE(SUM(bills.amount), 0) - 
                    COALESCE(SUM(
                        CASE 
                            WHEN payments.payment_mode = "momo" AND payments.transaction_status = "Success" THEN payments.amount
                            WHEN payments.payment_mode != "momo" THEN payments.amount
                            ELSE 0
                        END
                    ), 0) as total_arrears_region
                ')
            )
            ->groupBy('ghana_regions.name')
            ->get();

        $totalRegionalGraphData = DB::table('ghana_regions')
            ->join('assemblies', 'ghana_regions.regional_code', '=', 'assemblies.regional_code')
            ->join('properties', 'assemblies.assembly_code', '=', 'properties.assembly_code')
            ->join('bills', 'assemblies.assembly_code', '=', 'bills.assembly_code')
            ->join('payments', 'assemblies.assembly_code', '=', 'payments.assembly_code')
            ->select(
                'ghana_regions.name as region_name',
                DB::raw('COALESCE(SUM(bills.amount), 0) as total_bills_region'),
                DB::raw("
                    SUM(
                        CASE 
                            WHEN payments.payment_mode = 'momo' AND payments.transaction_status = 'Success' THEN payments.amount
                            WHEN payments.payment_mode != 'momo' THEN payments.amount
                            ELSE 0
                        END
                    ) as total_payments_region
                "),
                DB::raw('
                    COALESCE(SUM(bills.amount), 0) - 
                    COALESCE(SUM(
                        CASE 
                            WHEN payments.payment_mode = "momo" AND payments.transaction_status = "Success" THEN payments.amount
                            WHEN payments.payment_mode != "momo" THEN payments.amount
                            ELSE 0
                        END
                    ), 0) as total_arrears_region
                ')
            )
            ->groupBy('ghana_regions.name')
            ->get();

        // Prepare data for chart
        $regionNames = [];
        $paymentGraphData = [];
        $billGraphData = [];
        $arrearsGraphData = [];

        foreach ($totalRegionalGraphData as $data) {
            $regionNames[] = $data->region_name;
            $paymentGraphData[] = (float)$data->total_payments_region;
            $billGraphData[] = (float)$data->total_bills_region;
            $arrearsGraphData[] = (float)$data->total_arrears_region;
        }

        $totalRegionalDonutData = DB::table('ghana_regions')
            ->join('assemblies', 'ghana_regions.regional_code', '=', 'assemblies.regional_code')
            ->join('properties', 'assemblies.assembly_code', '=', 'properties.assembly_code')
            ->join('bills', 'assemblies.assembly_code', '=', 'bills.assembly_code')
            ->join('payments', 'assemblies.assembly_code', '=', 'payments.assembly_code')
            ->select(
                'ghana_regions.name as region_name',
                DB::raw('COUNT(DISTINCT properties.id) as total_properties_region'),
                DB::raw('COALESCE(SUM(bills.amount), 0) as total_bills_region'),
                DB::raw("
                    SUM(
                        CASE 
                            WHEN payments.payment_mode = 'momo' AND payments.transaction_status = 'Success' THEN payments.amount
                            WHEN payments.payment_mode != 'momo' THEN payments.amount
                            ELSE 0
                        END
                    ) as total_payments_region
                "),
                DB::raw('
                    COALESCE(SUM(bills.amount), 0) - 
                    COALESCE(SUM(
                        CASE 
                            WHEN payments.payment_mode = "momo" AND payments.transaction_status = "Success" THEN payments.amount
                            WHEN payments.payment_mode != "momo" THEN payments.amount
                            ELSE 0
                        END
                    ), 0) as total_arrears_region
                ')
            )
            ->groupBy('ghana_regions.name')
            ->get();

        $regionNameDonut = $totalRegionalDonutData->pluck('region_name');
        $totalDonutProperties = $totalRegionalDonutData->pluck('total_properties_region');
        $totalDonutBills = $totalRegionalDonutData->pluck('total_bills_region');
        $totalDonutPayments = $totalRegionalDonutData->pluck('total_payments_region');
        $totalDonutArrears = $totalRegionalDonutData->pluck('total_arrears_region');

        $dashTotalBills = DB::table('bills')
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->when($request->display == "daily", function ($query) {
                $query->whereDate('created_at', [now()->format('Y-m-d')]);
            })
            ->when($request->display == "weekly", function ($query) {
                $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
            })
            ->when($request->display == "monthly", function ($query) {
                $query->whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()]);
            })
            ->when($request->display == "yearly", function ($query) {
                $query->whereBetween('created_at', [now()->startOfYear(), now()->endOfYear()]);
            })
            ->sum('amount');

        $dashTotalBillCount = DB::table('bills')
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->when($request->display == "daily", function ($query) {
                $query->whereDate('created_at', [now()->format('Y-m-d')]);
            })
            ->when($request->display == "weekly", function ($query) {
                $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
            })
            ->when($request->display == "monthly", function ($query) {
                $query->whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()]);
            })
            ->when($request->display == "yearly", function ($query) {
                $query->whereBetween('created_at', [now()->startOfYear(), now()->endOfYear()]);
            })
            ->count();

        $dashTotalPayments = DB::table('payments')
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->when($request->display == "daily", function ($query) {
                $query->whereDate('created_at', [now()->format('Y-m-d')]);
            })
            ->when($request->display == "weekly", function ($query) {
                $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
            })
            ->when($request->display == "monthly", function ($query) {
                $query->whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()]);
            })
            ->when($request->display == "yearly", function ($query) {
                $query->whereBetween('created_at', [now()->startOfYear(), now()->endOfYear()]);
            })
            ->when(true, function ($query) {
                $query->where(function ($q) {
                    $q->where('payment_mode', '!=', 'momo')
                        ->orWhere(function ($q2) {
                            $q2->where('payment_mode', 'momo')
                                ->where('transaction_status', 'Success');
                        });
                });
            })
            ->sum('amount');

        $dashTotalOutstanding = $dashTotalBills - $dashTotalPayments;

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

                $totalPayments = Payment::whereHas('bill', function ($query) use ($customer) {
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
                    ->selectRaw("
                        SUM(CASE 
                            WHEN payment_mode = 'momo' AND transaction_status = 'Success' THEN amount
                            WHEN payment_mode != 'momo' THEN amount
                            ELSE 0
                        END) as total
                    ")
                    ->value('total');

                $totalBills = Bill::where(function ($query) use ($customer) {
                    $query->whereHas('property', function ($q) use ($customer) {
                        $q->where('customer_name', $customer->id);
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
                    ->sum('amount');

                $totalArrears2 = $totalBills - $totalPayments;

                $businessClassTypes = BusinessClassType::get();
                $customers = Citizen::where('user_id', $request->user()->id)
                    ->get();

                $districtAssemblies = Assembly::get();
                $zones = Zone::get();
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
                'paymentTotal' => isset($payments) ? number_format(collect($payments)->sum('amount'), 2) : 0,
                'totalBillP' => isset($totalBillP) ? number_format($totalBillP, 2) : 0,
                'totalArrearsP' => isset($totalArrearsP) ? number_format($totalArrearsP, 2) : 0,
                'totalExpectedPaymentsP' => isset($totalExpectedPaymentsP) ? number_format($totalExpectedPaymentsP, 2) : 0,
                'yearlyPaymentsP' => isset($yearlyPaymentsP) ? number_format($yearlyPaymentsP->total, 2) : 0,
                'totalBillB' => isset($totalBillB) ? number_format($totalBillB, 2) : 0,
                'totalArrearsB' => isset($totalArrearsB) ? number_format($totalArrearsB, 2) : 0,
                'totalExpectedPaymentsB' => isset($totalExpectedPaymentsB) ? number_format($totalExpectedPaymentsB, 2) : 0,
                'yearlyPaymentsB' => isset($yearlyPaymentsB) ? number_format($yearlyPaymentsB->total, 2) : 0,
                'propertyCount' => isset($properties) ? count($properties) : 0,
                'totalPayments' => isset($totalPayments) ? $totalPayments : 0,
                'totalBills' => isset($totalBills) ? $totalBills : 0,
                'totalArrears2' => isset($totalArrears2) ? $totalArrears2 : 0,
                'businessClassTypes' => isset($businessClassTypes) ? $businessClassTypes : [],
                'customers' => isset($customers) ? $customers : [],
                'districtAssemblies' => isset($districtAssemblies) ? $districtAssemblies : [],
                'zones' => isset($zones) ? $zones : []
            ];
        }

        $total = [
            'totalBusinesses' => isset($totalBusinesses) ? $totalBusinesses : 0,
            'totalProperties' => isset($totalProperties) ? $totalProperties : 0,
            'totalBusinessBill' => isset($totalBusinessBill) ? number_format($totalBusinessBill, 2) : 0,
            'totalPropertyBill' => isset($totalPropertyBill) ? number_format($totalPropertyBill, 2) : 0,
            'lastMonthPropertyBill' => isset($lastMonthPropertyBill) ? number_format($lastMonthPropertyBill, 2) : 0,
            'lastMonthBusinessBill' => isset($lastMonthBusinessBill) ? number_format($lastMonthBusinessBill, 2) : 0,
            'totalAssemblyAgents' => isset($totalAssemblyAgents) ? $totalAssemblyAgents : 0,
            'totalActiveAssemblyAgents' => isset($totalActiveAssemblyAgents) ? $totalActiveAssemblyAgents : 0,
            'totalInactiveAssemblyAgents' => isset($totalInactiveAssemblyAgents) ? $totalInactiveAssemblyAgents : 0,
            'dailyPayments' => isset($dailyPayments) ? number_format($dailyPayments->total, 2) : 0,
            'weeklyPayments' => isset($weeklyPayments) ? number_format($weeklyPayments->total, 2) : 0,
            'monthlyPayments' => isset($monthlyPayments) ? number_format($monthlyPayments->total, 2) : 0,
            'yearlyPayments' => isset($yearlyPayments) ? number_format($yearlyPayments->total, 2) : 0,
            'lastMonthPayments' => isset($lastMonthPayments) ? number_format($lastMonthPayments->total, 2) : 0,
            'totalBill' => isset($totalBill) ? number_format($totalBill, 2) : 0,
            'totalArrears' => isset($totalArrears) ? number_format($totalArrears, 2) : 0,
            'totalExpectedPayments' => isset($totalExpectedPayments) ? number_format($totalExpectedPayments, 2) : 0,
            'yearlyCashPayments' => isset($yearlyCashPayments) ? number_format($yearlyCashPayments, 2) : 0,
            'yearlyMomoPayments' => isset($yearlyMomoPayments) ? number_format($yearlyMomoPayments, 2) : 0,
            'yearlyReceivables' => isset($yearlyReceivables) ? number_format($yearlyReceivables, 2) : 0,
            'totalAssembly' => isset($totalAssembly) ? $totalAssembly : 0,
            'regions' => isset($regions) ? $regions : '',
            'totalCompletedBill' => isset($totalCompletedBill) ? $totalCompletedBill : 0,
            'totalUpcomingBill' => isset($totalUpcomingBill) ? $totalUpcomingBill : 0,
            'totalNewBill' => isset($totalNewBill) ? $totalNewBill : 0,
            'completedPercentage' => isset($completedPercentage) ? round($completedPercentage, 2) : 0,
            'upcomingPercentage' => isset($upcomingPercentage) ? round($upcomingPercentage, 2) : 0,
            'newPercentage' => isset($newPercentage) ? round($newPercentage, 2) : 0,
            'paymentData' => isset($paymentData) ? $paymentData : 0,
            'billData' => isset($billData) ? $billData : 0,
            'arrearsData' => isset($arrearsData) ? $arrearsData : 0,
            'categories' => isset($assemblyPayments) ? $assemblyPayments->pluck('assembly_name') : 'N/A',
            'graphData' => isset($assemblyPayments) ? $assemblyPayments->pluck('total_payment') : 0,
            'maleMonthlyCount' => isset($maleMonthlyCount) ? $maleMonthlyCount : 0,
            'femaleMonthlyCount' => isset($femaleMonthlyCount) ? $femaleMonthlyCount : 0,
            'monthlyActiveCounts' => isset($monthlyActiveCounts) ? $monthlyActiveCounts : [],
            'monthlyInactiveCounts' => isset($monthlyInactiveCounts) ? $monthlyInactiveCounts : [],
            'monthlyPropertyCounts' => isset($monthlyPropertyCounts) ? $monthlyPropertyCounts : [],
            'monthlyBusinessCounts' => isset($monthlyBusinessCounts) ? $monthlyBusinessCounts : [],
            'chartData12' => isset($chartData12) ? $chartData12 : [],
            'divisionPaymentData' => isset($divisionPaymentData) ? $divisionPaymentData : [],
            'regionArrearsData' => isset($regionArrearsData) ? $regionArrearsData : [],
            'regionPaymentData2' => isset($regionPaymentData2) ? $regionPaymentData2 : [],
            'dashChartData' => isset($dashChartData) ? $dashChartData : [],
            'gracut' => isset($gracut) ? number_format($gracut, 2) : 0,
            'level10cut' => isset($level10cut) ? number_format($level10cut, 2) : 0,
            'assemblycut' => isset($assemblycut) ? number_format($assemblycut, 2) : 0,
            'finalCut' => isset($finalCut) ? number_format($finalCut, 2) : 0,
            'totalRegionalData' => isset($totalRegionalData) ? $totalRegionalData : [],
            'regionNames' => isset($regionNames) ? $regionNames : '',
            'paymentGraphData' => isset($paymentGraphData) ? $paymentGraphData : [],
            'billGraphData' => isset($billGraphData) ? $billGraphData : [],
            'arrearsGraphData' => isset($arrearsGraphData) ? $arrearsGraphData : [],
            'regionNameDonut' => isset($regionNameDonut) ? $regionNameDonut : [],
            'totalDonutProperties' => isset($totalDonutProperties) ? $totalDonutProperties : [],
            'totalDonutBills' => isset($totalDonutBills) ? $totalDonutBills : [],
            'totalDonutPayments' => isset($totalDonutPayments) ? $totalDonutPayments : [],
            'totalDonutArrears' => isset($totalDonutArrears) ? $totalDonutArrears : [],
            'dashTotalBills' => isset($dashTotalBills) ? number_format($dashTotalBills, 2) : 0,
            'dashTotalBillCount' => isset($dashTotalBillCount) ? number_format($dashTotalBillCount) : 0,
            'dashTotalPayments' => isset($dashTotalPayments) ? number_format($dashTotalPayments, 2) : 0,
            'dashTotalOutstanding' => isset($dashTotalOutstanding) ? number_format($dashTotalOutstanding, 2) : 0
        ];

        return view('dashboard.operational', compact('total', 'chartData', 'chartData2', 'chartData3', 'chartData11', 'customerData'));
    }


    public function Mybills(Request $request)
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

        $yearlyCashPayments = Payment::where('payment_mode', 'cash')
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('amount');

        $yearlyMomoPayments = Payment::where('payment_mode', 'momo')
            ->where('transaction_status', 'Success')
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('amount');

        $yearlyReceivables = $totalBill - $yearlyPayments->total;

        $totalAssembly = Assembly::where('status', 'Active')
            ->count();

        $regions = GhanaRegion::with('assemblies')->get();

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
                'paymentTotal' => isset($payments) ? number_format(collect($payments)->sum('amount'), 2) : 0,
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
            'totalExpectedPayments' => isset($totalExpectedPayments) ? number_format($totalExpectedPayments, 2) : 0,
            'yearlyCashPayments' => isset($yearlyCashPayments) ? number_format($yearlyCashPayments, 2) : 0,
            'yearlyMomoPayments' => isset($yearlyMomoPayments) ? number_format($yearlyMomoPayments, 2) : 0,
            'yearlyReceivables' => isset($yearlyReceivables) ? number_format($yearlyReceivables, 2) : 0,
            'totalAssembly' => isset($totalAssembly) ? $totalAssembly : 0,
            'regions' => isset($regions) ? $regions : ''
        ];

        return view('dashboard.mybills', compact('total', 'chartData', 'chartData2', 'chartData3', 'customerData'));
    }


    public function Myproperties(Request $request)
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


        $allPayments = $totalPayments->first();

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

        $yearlyCashPayments = Payment::where('payment_mode', 'cash')
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('amount');

        $yearlyMomoPayments = Payment::where('payment_mode', 'momo')
            ->where('transaction_status', 'Success')
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('amount');

        $yearlyReceivables = $totalBill - $yearlyPayments->total;

        $totalAssembly = Assembly::where('status', 'Active')
            ->count();

        $regions = GhanaRegion::with('assemblies')->get();

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
                'paymentTotal' => isset($payments) ? number_format(collect($payments)->sum('amount'), 2) : 0,
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
            'totalExpectedPayments' => isset($totalExpectedPayments) ? number_format($totalExpectedPayments, 2) : 0,
            'yearlyCashPayments' => isset($yearlyCashPayments) ? number_format($yearlyCashPayments, 2) : 0,
            'yearlyMomoPayments' => isset($yearlyMomoPayments) ? number_format($yearlyMomoPayments, 2) : 0,
            'yearlyReceivables' => isset($yearlyReceivables) ? number_format($yearlyReceivables, 2) : 0,
            'totalAssembly' => isset($totalAssembly) ? $totalAssembly : 0,
            'regions' => isset($regions) ? $regions : ''
        ];

        return view('dashboard.myproperties', compact('total', 'chartData', 'chartData2', 'chartData3', 'customerData'));
    }


    public function Mybusiness(Request $request)
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

        $yearlyCashPayments = Payment::where('payment_mode', 'cash')
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('amount');

        $yearlyMomoPayments = Payment::where('payment_mode', 'momo')
            ->where('transaction_status', 'Success')
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('amount');

        $yearlyReceivables = $totalBill - $yearlyPayments->total;

        $totalAssembly = Assembly::where('status', 'Active')
            ->count();

        $regions = GhanaRegion::with('assemblies')->get();

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
                'paymentTotal' => isset($payments) ? number_format(collect($payments)->sum('amount'), 2) : 0,
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
            'totalExpectedPayments' => isset($totalExpectedPayments) ? number_format($totalExpectedPayments, 2) : 0,
            'yearlyCashPayments' => isset($yearlyCashPayments) ? number_format($yearlyCashPayments, 2) : 0,
            'yearlyMomoPayments' => isset($yearlyMomoPayments) ? number_format($yearlyMomoPayments, 2) : 0,
            'yearlyReceivables' => isset($yearlyReceivables) ? number_format($yearlyReceivables, 2) : 0,
            'totalAssembly' => isset($totalAssembly) ? $totalAssembly : 0,
            'regions' => isset($regions) ? $regions : ''
        ];

        return view('dashboard.mybusiness', compact('total', 'chartData', 'chartData2', 'chartData3', 'customerData'));
    }


    public function Mypaymenthistory(Request $request)
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

        $yearlyCashPayments = Payment::where('payment_mode', 'cash')
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('amount');

        $yearlyMomoPayments = Payment::where('payment_mode', 'momo')
            ->where('transaction_status', 'Success')
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('amount');

        $yearlyReceivables = $totalBill - $yearlyPayments->total;

        $totalAssembly = Assembly::where('status', 'Active')
            ->count();

        $regions = GhanaRegion::with('assemblies')->get();

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
                'paymentTotal' => isset($payments) ? number_format(collect($payments)->sum('amount'), 2) : 0,
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
            'totalExpectedPayments' => isset($totalExpectedPayments) ? number_format($totalExpectedPayments, 2) : 0,
            'yearlyCashPayments' => isset($yearlyCashPayments) ? number_format($yearlyCashPayments, 2) : 0,
            'yearlyMomoPayments' => isset($yearlyMomoPayments) ? number_format($yearlyMomoPayments, 2) : 0,
            'yearlyReceivables' => isset($yearlyReceivables) ? number_format($yearlyReceivables, 2) : 0,
            'totalAssembly' => isset($totalAssembly) ? $totalAssembly : 0,
            'regions' => isset($regions) ? $regions : ''
        ];

        return view('dashboard.mypaymenthistory', compact('total', 'chartData', 'chartData2', 'chartData3', 'customerData'));
    }

    public function faqAction()
    {
        return view('dashboard.faq');
    }

    public function propertyAnalytic(Request $request)
    {
        $currentYear = Carbon::now()->year;
        $maleMonthlyCount = DB::table('citizens')
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as total'))
            ->where('gender', 'Male')
            ->where('status', 'Active')
            ->whereYear('created_at', $currentYear)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->pluck('total', 'month');

        $femaleMonthlyCount = DB::table('citizens')
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as total'))
            ->where('gender', 'Female')
            ->where('status', 'Active')
            ->whereYear('created_at', $currentYear)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->pluck('total', 'month');

        $maleMonthlyCount = array_pad($maleMonthlyCount->toArray(), 12, 0);
        $femaleMonthlyCount = array_pad($femaleMonthlyCount->toArray(), 12, 0);

        $monthlyActiveCounts = [];
        $monthlyInactiveCounts = [];
        for ($month = 1; $month <= 12; $month++) {
            $startOfMonth = Carbon::create($currentYear, $month, 1)->startOfMonth();
            $endOfMonth = Carbon::create($currentYear, $month, 1)->endOfMonth();

            $activeCount = Citizen::where('status', 'Active')
                ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
                ->count();

            $inactiveCount = Citizen::where('status', 'InActive')
                ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
                ->count();

            $monthlyActiveCounts[] = $activeCount;
            $monthlyInactiveCounts[] = $inactiveCount;
        }

        $monthlyPropertyCounts = [];
        $monthlyBusinessCounts = [];
        for ($month = 1; $month <= 12; $month++) {
            $startOfMonth = Carbon::create($currentYear, $month, 1)->startOfMonth();
            $endOfMonth = Carbon::create($currentYear, $month, 1)->endOfMonth();

            $propertyCount = Property::query()
                ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                    $query->where('assembly_code', $request->user()->assembly_code);
                })
                ->when(($request->from_date !== null) && $request->end_date !== null, function ($query) use ($request) {
                    $query->whereBetween('properties.created_at', [$request->from_date . ' 00:00:00', $request->end_date . ' 23:59:59']);
                })
                ->when($request->region !== null, function ($query) use ($request) {
                    $query->join('assemblies', 'properties.assembly_code', '=', 'assemblies.assembly_code')
                        ->where('assemblies.regional_code', $request->region);
                })
                ->whereBetween('properties.created_at', [$startOfMonth, $endOfMonth])
                ->count();

            $businessCount = Business::query()
                ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                    $query->where('assembly_code', $request->user()->assembly_code);
                })
                ->when(($request->from_date !== null) && $request->end_date !== null, function ($query) use ($request) {
                    $query->whereBetween('businesses.created_at', [$request->from_date . ' 00:00:00', $request->end_date . ' 23:59:59']);
                })
                ->when($request->region !== null, function ($query) use ($request) {
                    $query->join('assemblies', 'businesses.assembly_code', '=', 'assemblies.assembly_code')
                        ->where('assemblies.regional_code', $request->region);
                })
                ->whereBetween('businesses.created_at', [$startOfMonth, $endOfMonth])
                ->count();

            // Store the results in the arrays
            $monthlyPropertyCounts[] = $propertyCount;
            $monthlyBusinessCounts[] = $businessCount;
        }

        $topProperties = DB::table('payments')
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('payments.assembly_code', $request->user()->assembly_code);
            })
            ->join('bills', 'payments.bills_id', '=', 'bills.bills_id')
            ->join('properties', 'bills.property_id', '=', 'properties.id')
            ->join('citizens', 'properties.customer_name', '=', 'citizens.id')
            ->selectRaw('
                bills.property_id as id, 
                properties.property_number as number, 
                citizens.first_name as owner_name, 
                citizens.telephone_number as phone,
                SUM(CASE 
                    WHEN payments.payment_mode = "momo" AND payments.transaction_status = "Success" THEN payments.amount
                    WHEN payments.payment_mode != "momo" THEN payments.amount
                    ELSE 0 
                END) as total_payments')
            ->whereNotNull('bills.property_id')
            ->whereNull('bills.business_id')
            ->whereYear('payments.created_at', $currentYear)
            ->groupBy('bills.property_id', 'properties.property_number', 'citizens.first_name', 'citizens.telephone_number')
            ->orderByDesc('total_payments')
            ->limit(10)
            ->get();

        $topBusinesses = DB::table('payments')
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('payments.assembly_code', $request->user()->assembly_code);
            })
            ->join('bills', 'payments.bills_id', '=', 'bills.bills_id')
            ->join('businesses', 'bills.business_id', '=', 'businesses.id')
            ->join('citizens', 'businesses.citizen_account_number', '=', 'citizens.id')
            ->selectRaw('
                bills.business_id as id, 
                businesses.bus_account_number as bus_number,
                 citizens.first_name as owner_name, 
                citizens.telephone_number as phone,
                SUM(CASE 
                    WHEN payments.payment_mode = "momo" AND payments.transaction_status = "Success" THEN payments.amount
                    WHEN payments.payment_mode != "momo" THEN payments.amount
                    ELSE 0 
                END) as total_payments')
            ->whereNotNull('bills.business_id')
            ->whereNull('bills.property_id')
            ->whereYear('payments.created_at', $currentYear)
            ->groupBy('bills.business_id', 'businesses.bus_account_number', 'citizens.first_name', 'citizens.telephone_number')
            ->orderByDesc('total_payments')
            ->limit(10)
            ->get();

        $chartData12 = [
            'properties' => $topProperties->map(function ($property) {
                return [
                    'name' => $property->number . '(P)/' . $property->owner_name . '/' . $property->phone,
                    'data' => [$property->total_payments],
                ];
            }),
            'businesses' => $topBusinesses->map(function ($business) {
                return [
                    'name' => $business->bus_number . '(B)/' . $business->owner_name . '/' . $business->phone,
                    'data' => [$business->total_payments],
                ];
            }),
        ];

        $regions = GhanaRegion::orderBy('name', 'ASC')->get();

        $total = [
            'maleMonthlyCount' => isset($maleMonthlyCount) ? $maleMonthlyCount : 0,
            'femaleMonthlyCount' => isset($femaleMonthlyCount) ? $femaleMonthlyCount : 0,
            'monthlyActiveCounts' => isset($monthlyActiveCounts) ? $monthlyActiveCounts : [],
            'monthlyInactiveCounts' => isset($monthlyInactiveCounts) ? $monthlyInactiveCounts : [],
            'monthlyPropertyCounts' => isset($monthlyPropertyCounts) ? $monthlyPropertyCounts : [],
            'monthlyBusinessCounts' => isset($monthlyBusinessCounts) ? $monthlyBusinessCounts : [],
            'chartData12' => isset($chartData12) ? $chartData12 : [],
            'regions' => isset($regions) ? $regions : []
        ];

        return view('dashboard.includes.property', compact('total'));
    }

    public function overview()
    {
        $regions = GhanaRegion::with('assemblies')->get();

        $total = [
            'regions' => isset($regions) ? $regions : []
        ];

        return view('dashboard.includes.overview', compact('total'));
    }

    public function paymentAnalytic(Request $request)
    {
        $currentYear = Carbon::now()->year;
        $yearlyMomoPayments = Payment::where('payment_mode', 'momo')
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->when(($request->from_date !== null) && $request->end_date !== null, function ($query) use ($request) {
                $query->whereBetween('payments.created_at', [$request->from_date . ' 00:00:00', $request->end_date . ' 23:59:59']);
            })
            ->when($request->region !== null, function ($query) use ($request) {
                $query->join('assemblies', 'payments.assembly_code', '=', 'assemblies.assembly_code')
                    ->where('assemblies.regional_code', $request->region);
            })
            ->where('transaction_status', 'Success')
            ->whereYear('payments.created_at', Carbon::now()->year)
            ->sum('amount');

        $totalPayments = Payment::selectRaw('SUM(amount) as total')
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->when(($request->from_date !== null) && $request->end_date !== null, function ($query) use ($request) {
                $query->whereBetween('payments.created_at', [$request->from_date . ' 00:00:00', $request->end_date . ' 23:59:59']);
            })
            ->when($request->region !== null, function ($query) use ($request) {
                $query->join('assemblies', 'payments.assembly_code', '=', 'assemblies.assembly_code')
                    ->where('assemblies.regional_code', $request->region);
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
            ->whereDate('payments.created_at', Carbon::today())
            ->first();

        $weeklyPayments = (clone $totalPayments)
            ->whereBetween('payments.created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->first();

        $monthlyPayments = (clone $totalPayments)
            ->whereMonth('payments.created_at', Carbon::now()->month)
            ->whereYear('payments.created_at', Carbon::now()->year)
            ->first();

        $yearlyPayments = (clone $totalPayments)
            ->whereYear('payments.created_at', Carbon::now()->year)
            ->first();

        $totalBill = Bill::query()
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->when(($request->from_date !== null) && $request->end_date !== null, function ($query) use ($request) {
                $query->whereBetween('bills.created_at', [$request->from_date . ' 00:00:00', $request->end_date . ' 23:59:59']);
            })
            ->when($request->region !== null, function ($query) use ($request) {
                $query->join('assemblies', 'bills.assembly_code', '=', 'assemblies.assembly_code')
                    ->where('assemblies.regional_code', $request->region);
            })
            ->whereYear('bills.created_at', Carbon::now()->year)
            ->sum('amount');

        $yearlyReceivables = $totalBill - $yearlyPayments->total;

        $year = $request->input('year', Carbon::now()->year);

        $payments = DB::table('payments')
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->when(($request->from_date !== null) && $request->end_date !== null, function ($query) use ($request) {
                $query->whereBetween('payments.created_at', [$request->from_date . ' 00:00:00', $request->end_date . ' 23:59:59']);
            })
            ->when($request->region !== null, function ($query) use ($request) {
                $query->join('assemblies', 'payments.assembly_code', '=', 'assemblies.assembly_code')
                    ->where('assemblies.regional_code', $request->region);
            })
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('SUM(amount) as total'))
            ->whereYear('payments.created_at', $currentYear)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month');

        $bills = DB::table('bills')
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->when(($request->from_date !== null) && $request->end_date !== null, function ($query) use ($request) {
                $query->whereBetween('bills.created_at', [$request->from_date . ' 00:00:00', $request->end_date . ' 23:59:59']);
            })
            ->when($request->region !== null, function ($query) use ($request) {
                $query->join('assemblies', 'bills.assembly_code', '=', 'assemblies.assembly_code')
                    ->where('assemblies.regional_code', $request->region);
            })
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('SUM(amount) as total'))
            ->whereYear('bills.created_at', $currentYear)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month');

        $arrears = [];
        for ($month = 1; $month <= 12; $month++) {
            $arrears[$month] = ($bills[$month] ?? 0) - ($payments[$month] ?? 0);
        }

        $paymentData = [];
        $billData = [];
        $arrearsData = [];

        for ($month = 1; $month <= 12; $month++) {
            $paymentData[] = $payments[$month] ?? 0;
            $billData[] = $bills[$month] ?? 0;
            $arrearsData[] = $arrears[$month] ?? 0;
        }

        $assemblyPayments = DB::table('payments')
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('payments.assembly_code', $request->user()->assembly_code);
            })
            ->when(($request->from_date !== null) && $request->end_date !== null, function ($query) use ($request) {
                $query->whereBetween('payments.created_at', [$request->from_date . ' 00:00:00', $request->end_date . ' 23:59:59']);
            })
            ->when($request->region !== null, function ($query) use ($request) {
                $query->join('assemblies', 'payments.assembly_code', '=', 'assemblies.assembly_code')
                    ->where('assemblies.regional_code', $request->region);
            })
            ->join('assemblies', 'payments.assembly_code', '=', 'assemblies.assembly_code')
            ->select(
                'assemblies.name as assembly_name',
                DB::raw("
                    SUM(
                        CASE
                            WHEN payments.payment_mode = 'momo' AND payments.transaction_status = 'Success' THEN payments.amount
                            WHEN payments.payment_mode != 'momo' THEN payments.amount
                            ELSE 0
                        END
                    ) as total_payment
                ")
            )
            ->whereYear('payments.created_at', $currentYear)
            ->groupBy('assemblies.name')
            ->orderBy('total_payment', 'desc')
            ->get();

        $topAssemblies = DB::table('bills')
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('bills.assembly_code', $request->user()->assembly_code);
            })
            ->when(($request->from_date !== null) && $request->end_date !== null, function ($query) use ($request) {
                $query->whereBetween('bills.created_at', [$request->from_date . ' 00:00:00', $request->end_date . ' 23:59:59']);
            })
            ->when($request->region !== null, function ($query) use ($request) {
                $query->join('assemblies', 'bills.assembly_code', '=', 'assemblies.assembly_code')
                    ->where('assemblies.regional_code', $request->region);
            })
            ->join('assemblies', 'bills.assembly_code', '=', 'assemblies.assembly_code')
            ->leftJoin('payments', 'bills.bills_id', '=', 'payments.bills_id')
            ->select(
                'assemblies.name as assembly_name',
                'bills.assembly_code',
                DB::raw("
                    SUM(bills.amount) as total_bill_amount
                ")
            )
            ->whereYear('bills.created_at', $currentYear)
            ->whereNull('payments.bills_id')
            ->groupBy('bills.assembly_code', 'assemblies.name')
            ->orderBy('total_bill_amount', 'desc')
            ->limit(5)
            ->get();

        $chartData = [];
        foreach ($topAssemblies as $assembly) {
            $monthlyBills = DB::table('bills')
                ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                    $query->where('bills.assembly_code', $request->user()->assembly_code);
                })
                ->when(($request->from_date !== null) && $request->end_date !== null, function ($query) use ($request) {
                    $query->whereBetween('bills.created_at', [$request->from_date . ' 00:00:00', $request->end_date . ' 23:59:59']);
                })
                ->when($request->region !== null, function ($query) use ($request) {
                    $query->join('assemblies', 'bills.assembly_code', '=', 'assemblies.assembly_code')
                        ->where('assemblies.regional_code', $request->region);
                })
                ->leftJoin('payments', 'bills.bills_id', '=', 'payments.bills_id')
                ->where('bills.assembly_code', $assembly->assembly_code)
                ->whereYear('bills.created_at', $currentYear)
                ->whereNull('payments.bills_id')
                ->select(
                    DB::raw('MONTH(bills.created_at) as month'),
                    DB::raw('SUM(bills.amount) as total')
                )
                ->groupBy('month')
                ->get()
                ->pluck('total', 'month')
                ->toArray();

            $data = [];
            foreach (range(1, 12) as $month) {
                $data[] = $monthlyBills[$month] ?? 0;
            }

            $chartData[] = [
                'name' => $assembly->assembly_name,
                'data' => $data,
            ];
        }

        $divisionPaymentData = DB::table('payments')
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('payments.assembly_code', $request->user()->assembly_code);
            })
            ->when(($request->from_date !== null) && $request->end_date !== null, function ($query) use ($request) {
                $query->whereBetween('payments.created_at', [$request->from_date . ' 00:00:00', $request->end_date . ' 23:59:59']);
            })
            ->when($request->region !== null, function ($query) use ($request) {
                $query->join('assemblies', 'payments.assembly_code', '=', 'assemblies.assembly_code')
                    ->where('assemblies.regional_code', $request->region);
            })
            ->join('bills', 'payments.bills_id', '=', 'bills.bills_id')
            ->leftJoin('properties', 'bills.property_id', '=', 'properties.id')
            ->leftJoin('businesses', 'bills.business_id', '=', 'businesses.id')
            ->leftJoin('divisions', function ($join) {
                $join->on('properties.division_id', '=', 'divisions.id')
                    ->orOn('businesses.division_id', '=', 'divisions.id');
            })
            ->selectRaw('divisions.division_name as division_name, 
                MONTH(payments.created_at) as month, 
                SUM(CASE 
                    WHEN payments.payment_mode = "momo" AND payments.transaction_status = "Success" THEN payments.amount
                    WHEN payments.payment_mode != "momo" THEN payments.amount
                    ELSE 0 
                END) as total_payments')
            ->whereYear('payments.created_at', $currentYear)
            ->groupBy('divisions.division_name', 'month')
            ->orderByDesc('total_payments')
            ->limit(10)
            ->get();

        $regionPaymentData = DB::table('payments')
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('payments.assembly_code', $request->user()->assembly_code);
            })
            ->when(($request->from_date !== null) && $request->end_date !== null, function ($query) use ($request) {
                $query->whereBetween('payments.created_at', [$request->from_date . ' 00:00:00', $request->end_date . ' 23:59:59']);
            })
            ->when($request->region !== null, function ($query) use ($request) {
                $query->join('assemblies', 'payments.assembly_code', '=', 'assemblies.assembly_code')
                    ->where('assemblies.regional_code', $request->region);
            })
            ->join('assemblies', 'payments.assembly_code', '=', 'assemblies.assembly_code')
            ->join('ghana_regions', 'assemblies.regional_code', '=', 'ghana_regions.regional_code')
            ->selectRaw('
                ghana_regions.name as region_name, 
                MONTH(payments.created_at) as month, 
                SUM(CASE 
                    WHEN payments.payment_mode = "momo" AND payments.transaction_status = "Success" THEN payments.amount
                    WHEN payments.payment_mode != "momo" THEN payments.amount
                    ELSE 0 
                END) as total_payments
            ')
            ->whereYear('payments.created_at', $currentYear)
            ->groupBy('ghana_regions.name', 'month')
            ->get()
            ->keyBy(function ($item) {
                return $item->region_name . '-' . $item->month;
            });

        $regionBillData = DB::table('bills')
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('bills.assembly_code', $request->user()->assembly_code);
            })
            ->when(($request->from_date !== null) && $request->end_date !== null, function ($query) use ($request) {
                $query->whereBetween('bills.created_at', [$request->from_date . ' 00:00:00', $request->end_date . ' 23:59:59']);
            })
            ->when($request->region !== null, function ($query) use ($request) {
                $query->join('assemblies', 'bills.assembly_code', '=', 'assemblies.assembly_code')
                    ->where('assemblies.regional_code', $request->region);
            })
            ->join('assemblies', 'bills.assembly_code', '=', 'assemblies.assembly_code')
            ->join('ghana_regions', 'assemblies.regional_code', '=', 'ghana_regions.regional_code')
            ->selectRaw('
                ghana_regions.name as region_name, 
                MONTH(bills.created_at) as month, 
                SUM(bills.amount) as total_bills
            ')
            ->whereYear('bills.created_at', $currentYear)
            ->groupBy('ghana_regions.name', 'month')
            ->get()
            ->keyBy(function ($item) {
                return $item->region_name . '-' . $item->month;
            });


        $regionArrearsData = new Collection();
        foreach ($regionPaymentData as $regionMonth => $payment) {
            list($regionName, $month) = explode('-', $regionMonth);

            $bills = $regionBillData->get($regionMonth);
            $totalBills = $bills ? $bills->total_bills : 0;
            $totalPayments = $payment->total_payments;

            $regionArrearsData->push([
                'region_name' => $regionName,
                'month' => $month,
                'arrears' => $totalBills - $totalPayments,
            ]);
        }

        $regionPaymentData2 = DB::table('payments')
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('payments.assembly_code', $request->user()->assembly_code);
            })
            ->when(($request->from_date !== null) && $request->end_date !== null, function ($query) use ($request) {
                $query->whereBetween('payments.created_at', [$request->from_date . ' 00:00:00', $request->end_date . ' 23:59:59']);
            })
            ->when($request->region !== null, function ($query) use ($request) {
                $query->join('assemblies', 'payments.assembly_code', '=', 'assemblies.assembly_code')
                    ->where('assemblies.regional_code', $request->region);
            })
            ->join('assemblies', 'payments.assembly_code', '=', 'assemblies.assembly_code')
            ->join('ghana_regions', 'assemblies.regional_code', '=', 'ghana_regions.regional_code')
            ->selectRaw('
                ghana_regions.name as region_name, 
                MONTH(payments.created_at) as month,
                payments.payment_mode, 
                SUM(CASE 
                    WHEN payments.payment_mode = "momo" AND payments.transaction_status = "Success" THEN payments.amount
                    WHEN payments.payment_mode != "momo" THEN payments.amount
                    ELSE 0 
                END) as total_payments
            ')
            ->whereYear('payments.created_at', $currentYear)
            ->groupBy('ghana_regions.name', 'payments.payment_mode', 'month')
            ->get();

        $dashBills = DB::table('bills')
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->when(($request->from_date !== null) && $request->end_date !== null, function ($query) use ($request) {
                $query->whereBetween('bills.created_at', [$request->from_date . ' 00:00:00', $request->end_date . ' 23:59:59']);
            })
            ->when($request->region !== null, function ($query) use ($request) {
                $query->join('assemblies', 'bills.assembly_code', '=', 'assemblies.assembly_code')
                    ->where('assemblies.regional_code', $request->region);
            })
            ->selectRaw('MONTH(created_at) as month, SUM(amount) as total_bills')
            ->whereYear('created_at', $currentYear)
            ->groupBy('month')
            ->pluck('total_bills', 'month');

        $dashPayments = DB::table('payments')
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->when(($request->from_date !== null) && $request->end_date !== null, function ($query) use ($request) {
                $query->whereBetween('payments.created_at', [$request->from_date . ' 00:00:00', $request->end_date . ' 23:59:59']);
            })
            ->when($request->region !== null, function ($query) use ($request) {
                $query->join('assemblies', 'payments.assembly_code', '=', 'assemblies.assembly_code')
                    ->where('assemblies.regional_code', $request->region);
            })
            ->selectRaw("
                MONTH(created_at) as month, 
                SUM(CASE 
                    WHEN payment_mode = 'momo' AND transaction_status = 'Success' THEN amount 
                    WHEN payment_mode != 'momo' THEN amount 
                    ELSE 0 
                END) as total_payments
            ")
            ->whereYear('created_at', $currentYear)
            ->groupBy('month')
            ->pluck(
                'total_payments',
                'month'
            );

        $dashChartData = [];
        for ($month = 1; $month <= 12; $month++) {
            $totalBills = $dashBills[$month] ?? 0;
            $totalPayments = $dashPayments[$month] ?? 0;
            $arrears = $totalBills - $totalPayments;

            $dashChartData[] = [
                'month' => $month,
                'bills' => $totalBills,
                'payments' => $totalPayments,
                'arrears' => $arrears,
            ];
        }

        $regions = GhanaRegion::orderBy('name', 'ASC')->get();

        $total = [
            'yearlyMomoPayments' => isset($yearlyMomoPayments) ? number_format($yearlyMomoPayments, 2) : 0,
            'yearlyPayments' => isset($yearlyPayments) ? number_format($yearlyPayments->total, 2) : 0,
            'yearlyReceivables' => isset($yearlyReceivables) ? number_format($yearlyReceivables, 2) : 0,
            'paymentData' => isset($paymentData) ? $paymentData : 0,
            'billData' => isset($billData) ? $billData : 0,
            'arrearsData' => isset($arrearsData) ? $arrearsData : 0,
            'categories' => isset($assemblyPayments) ? $assemblyPayments->pluck('assembly_name') : 'N/A',
            'graphData' => isset($assemblyPayments) ? $assemblyPayments->pluck('total_payment') : [],
            'chartData' => isset($chartData) ? $chartData : [],
            'divisionPaymentData' => isset($divisionPaymentData) ? $divisionPaymentData : [],
            'regionArrearsData' => isset($regionArrearsData) ? $regionArrearsData : [],
            'regionPaymentData2' => isset($regionPaymentData2) ? $regionPaymentData2 : [],
            'regions' => isset($regions) ? $regions : []
        ];

        return view('dashboard.includes.payment', compact('total'));
    }

    public function billAnalytic(Request $request)
    {
        //No payment bills
        $totalCompletedBill = Bill::query()
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->when(($request->from_date !== null) && $request->end_date !== null, function ($query) use ($request) {
                $query->whereBetween('bills.created_at', [$request->from_date . ' 00:00:00', $request->end_date . ' 23:59:59']);
            })
            ->when($request->region !== null, function ($query) use ($request) {
                $query->join('assemblies', 'bills.assembly_code', '=', 'assemblies.assembly_code')
                    ->where('assemblies.regional_code', $request->region);
            })
            ->whereYear('bills.created_at', Carbon::now()->year)
            ->whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('payments')
                    ->whereColumn('payments.bills_id', 'bills.bills_id');
            })
            ->count();

        $totalUpcomingBill = Bill::query()
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->when(($request->from_date !== null) && $request->end_date !== null, function ($query) use ($request) {
                $query->whereBetween('bills.created_at', [$request->from_date . ' 00:00:00', $request->end_date . ' 23:59:59']);
            })
            ->when($request->region !== null, function ($query) use ($request) {
                $query->join('assemblies', 'bills.assembly_code', '=', 'assemblies.assembly_code')
                    ->where('assemblies.regional_code', $request->region);
            })
            ->whereYear('bills.created_at', Carbon::now()->year)
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('payments')
                    ->whereColumn('payments.bills_id', 'bills.bills_id')
                    ->groupBy('payments.bills_id')
                    ->havingRaw('SUM(payments.amount) < bills.amount');
            })
            ->count();

        $totalNewBill = Bill::query()
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->when(($request->from_date !== null) && $request->end_date !== null, function ($query) use ($request) {
                $query->whereBetween('bills.created_at', [$request->from_date . ' 00:00:00', $request->end_date . ' 23:59:59']);
            })
            ->when($request->region !== null, function ($query) use ($request) {
                $query->join('assemblies', 'bills.assembly_code', '=', 'assemblies.assembly_code')
                    ->where('assemblies.regional_code', $request->region);
            })
            ->whereYear('bills.created_at', Carbon::now()->year)
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('payments')
                    ->whereColumn('payments.bills_id', 'bills.bills_id')
                    ->groupBy('payments.bills_id')
                    ->havingRaw('SUM(payments.amount) >= bills.amount');
            })
            ->count();

        $totalBills = $totalCompletedBill + $totalUpcomingBill + $totalNewBill;
        if ($totalBills > 0) {
            $completedPercentage = ($totalCompletedBill / $totalBills) * 100;
            $upcomingPercentage = ($totalUpcomingBill / $totalBills) * 100;
            $newPercentage = ($totalNewBill / $totalBills) * 100;
        } else {
            $completedPercentage = $upcomingPercentage = $newPercentage = 0;
        }

        $regionalBills = DB::table('ghana_regions')
            ->leftJoin('assemblies', 'ghana_regions.regional_code', '=', 'assemblies.regional_code')
            ->leftJoin('bills', 'assemblies.assembly_code', '=', 'bills.assembly_code')
            ->select('ghana_regions.name as region_name', DB::raw('COALESCE(SUM(bills.amount), 0) as total_bills'))
            ->groupBy('ghana_regions.name')
            ->orderBy('ghana_regions.name')
            ->get();

        $regions = $regionalBills->pluck('region_name')->toArray();
        $totals = $regionalBills->pluck('total_bills')->toArray();

        $regions = GhanaRegion::orderBy('name', 'ASC')->get();

        $total = [
            'totalCompletedBill' => isset($totalCompletedBill) ? $totalCompletedBill : 0,
            'totalUpcomingBill' => isset($totalUpcomingBill) ? $totalUpcomingBill : 0,
            'totalNewBill' => isset($totalNewBill) ? $totalNewBill : 0,
            'completedPercentage' => isset($completedPercentage) ? round($completedPercentage, 2) : 0,
            'upcomingPercentage' => isset($upcomingPercentage) ? round($upcomingPercentage, 2) : 0,
            'newPercentage' => isset($newPercentage) ? round($newPercentage, 2) : 0,
            'regions' => isset($regions) ? $regions : [],
            'totals' => isset($totals) ? $totals : [],
            'regionsDrop' => isset($regions) ? $regions : []
        ];

        return view('dashboard.includes.bill', compact('total'));
    }
}
