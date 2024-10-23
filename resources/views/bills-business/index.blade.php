@extends('layout.base')

@section('page-styles')
@endsection

@section('page-content')
    <div class="container-fluid mh-auto">
        <div class="row">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="heading mb-0">Business Bills Management </h4>
                <div class="d-flex align-items-center">
                    @can('bills.create')
                        <a href="{{ route('bills.bus.create') }}" class="btn btn-primary btn-sm ms-2">+ Bulk Bills Generate </a>
                    @endcan

                    @can('bills.create')
                        <a href="{{ route('bills.bus.singleCreate') }}" class="btn btn-primary btn-sm ms-2">+ Single Bill Generate
                        </a>
                    @endcan

                    @can('bills.create')
                        <a href="{{ route('bills.bus.divisionCreate') }}" class="btn btn-primary btn-sm ms-2">+ Division Bills
                            Generate </a>
                    @endcan

                    @can('bills.create')
                        <a href="{{ route('bills.bus.blockCreate') }}" class="btn btn-primary btn-sm ms-2">+ Blocks Bill
                            Generate
                        </a>
                    @endcan
                </div>
            </div>

            <div class="col-xl-3  col-lg-6 col-sm-6">
                <div class="widget-stat card">
                    <div class="card-body p-4">
                        <h4 class="card-title">Total Bills Payables </h4>
                        <h3> GHS {{ $total['totalExpectedPayments'] }}</h3>
                        <div class="progress mb-2">
                            <div class="progress-bar progress-animated bg-primary" style="width: 80%"></div>
                        </div>
                        <small>80% Increase in 20 Days</small>
                    </div>
                </div>
            </div>

            <div class="col-xl-3  col-lg-6 col-sm-6">
                <div class="widget-stat card">
                    <div class="card-body p-4">
                        <h4 class="card-title">Total Bills Paid </h4>
                        <h3>GHS {{ $total['totalPayments'] }}</h3>
                        <div class="progress mb-2">
                            <div class="progress-bar progress-animated bg-warning" style="width: 50%"></div>
                        </div>
                        <small>50% Increase in 25 Days</small>
                    </div>
                </div>
            </div>

            <div class="col-xl-3  col-lg-6 col-sm-6">
                <div class="widget-stat card">
                    <div class="card-body p-4">
                        <h4 class="card-title">Total Un-Paid Bills </h4>
                        <h3>GHS{{ $total['totalUnpaidBills'] }}</h3>
                        <div class="progress mb-2">
                            <div class="progress-bar progress-animated bg-red" style="width: 76%"></div>
                        </div>
                        <small>76% Increase in 20 Days</small>
                    </div>
                </div>
            </div>
            <div class="col-xl-3  col-lg-6 col-sm-6">
                <div class="widget-stat card">
                    <div class="card-body p-4">
                        <h4 class="card-title">Payment Percentage</h4>
                        <h3>{{ $total['paymentPercentage'] }}%</h3>
                        <div class="progress mb-2">
                            <div class="progress-bar progress-animated bg-success" style="width: 30%"></div>
                        </div>
                        <small>30% Increase in 30 Days</small>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-4">
                <div class="card sale-card">
                    <div class="card-header pb-0 border-0 align-items-baseline">
                        <div>
                            <span>Variance of Arrears and Current Bill </span>
                            <h4>GHS {{ $total['totalBillVariance'] }} <i class="fa-solid fa-arrow-trend-up ms-1"></i>
                            </h4>
                        </div>
                    </div>
                    <div class="card-body p-0 custome-tooltip">
                        <div id="totalSale"></div>
                    </div>
                    <div class="card-footer border-0">
                        <span class="tag bg-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                                <polyline points="17 6 23 6 23 12"></polyline>
                            </svg>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-4">
                <div class="card sale-card">
                    <div class="card-header pb-0 border-0 align-items-baseline">
                        <div>
                            <span>Total Current Bill</span>
                            <h4>GHS {{ $total['totalBill'] }} <i class="fa-solid fa-arrow-trend-down ms-1"></i>
                            </h4>
                        </div>
                    </div>
                    <div class="card-body p-0 custome-tooltip">
                        <div id="totalPurchase"></div>
                    </div>
                    <div class="card-footer border-0">
                        <span class="tag bg-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                                <polyline points="17 6 23 6 23 12"></polyline>
                            </svg>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-4">
                <div class="card sale-card">
                    <div class="card-header pb-0 border-0 align-items-baseline">
                        <div>
                            <span>Total Arrears
                            </span>
                            <h4>GHS {{ $total['totalBillArrears'] }}<i class="fa-solid fa-arrow-trend-down ms-1"></i></h4>
                        </div>
                    </div>
                    <div class="card-body p-0 custome-tooltip">
                        <div id="activeCustomers"></div>
                    </div>
                    <div class="card-footer border-0">
                        <span class="tag bg-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                                <polyline points="17 6 23 6 23 12"></polyline>
                            </svg>
                        </span>
                    </div>
                </div>
            </div>

            @if (session()->has('status'))
                <div class="alert alert-success alert-dismissible fade show">
                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2"
                        fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                        <polyline points="9 11 12 14 22 4"></polyline>
                        <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                    </svg>
                    <strong>{{ session('status') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"><span><i
                                class="fa-solid fa-xmark"></i></span>
                    </button>
                </div>
            @endif

            <div class="col-xl-12 active-p">
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-list" role="tabpanel"
                        aria-labelledby="pills-list-tab">

                        <div class="card">
                            <div class="card-body px-0">
                                <div class="table-responsive active-projects user-tbl  dt-filter">
                                    <table id="user-tbl" class="table shorting">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Bill No</th>
                                                <th>Name</th>
                                                <th>Business No.</th>
                                                <th>Bill Date</th>
                                                <th>Bill Year</th>
                                                <th>Arrears</th>
                                                <th>Current Amount</th>
                                                <th>Amount Due</th>
                                                <th>Created By</th>
                                                <th>Date Created</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody id="customers">
                                            @foreach ($bills as $index => $bill)
                                                @php
                                                    $firstname = $bill->business->customer->first_name ?? '';
                                                    $lastname = $bill->business->customer->last_name ?? '';
                                                    $name = $firstname . ' ' . $lastname;
                                                @endphp
                                                <tr class="btn-reveal-trigger">
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $bill->bills_id }}</td>
                                                    <td>{{ $name ?? '' }}</td>
                                                    <td>{{ $bill->business->business_owner_id ?? '' }}</td>
                                                    <td>{{ $bill->billing_date }}</td>
                                                    <td>{{ $bill->bills_year }}</td>
                                                    <td>{{ number_format($bill->arrears, 2) }}</td>
                                                    <td>{{ number_format($bill->amount, 2) }}</td>
                                                    <td>{{ number_format($bill->amount + $bill->arrears, 2) }}</td>
                                                    <td>{{ $bill->createdBy->name ?? 'N/A' }}</td>
                                                    <td>{{ $bill->created_at }}</td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <div class="btn-link" data-bs-toggle="dropdown"
                                                                aria-expanded="false">
                                                                <svg width="24" height="24" viewBox="0 0 24 24"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M11 12C11 12.5523 11.4477 13 12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12Z"
                                                                        stroke="#737B8B" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round">
                                                                    </path>
                                                                    <path
                                                                        d="M18 12C18 12.5523 18.4477 13 19 13C19.5523 13 20 12.5523 20 12C20 11.4477 19.5523 11 19 11C18.4477 11 18 11.4477 18 12Z"
                                                                        stroke="#737B8B" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round">
                                                                    </path>
                                                                    <path
                                                                        d="M4 12C4 12.5523 4.44772 13 5 13C5.55228 13 6 12.5523 6 12C6 11.4477 5.55228 11 5 11C4.44772 11 4 11.4477 4 12Z"
                                                                        stroke="#737B8B" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round">
                                                                    </path>
                                                                </svg>
                                                            </div>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <div class="py-2">
                                                                    <a class="dropdown-item"
                                                                        href=" {{ route('bills.show', $bill) }}">View
                                                                    </a>
                                                                    <a class="dropdown-item"
                                                                        href=" {{ route('bills.edit', $bill) }}">Edit
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="5"></th>
                                                <th>Total (GHS)</th>
                                                <th>{{ $total['totalArrears'] }}</th>
                                                <th>{{ $total['totalAmount'] }}</th>
                                                <th>{{ $total['totalDue'] }}</th>
                                                <th colspan="2"></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection


@section('page-scripts')
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
@endsection
