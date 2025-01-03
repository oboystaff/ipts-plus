@extends('layout.base')

@section('page-styles')
@endsection

@section('page-content')
    <div class="container-fluid mh-auto">
        <div class="row">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="card-header">
                    <div class="card-title">Bills Management / Property Bills</div>
                </div>
                <div class="d-flex align-items-center">
                    @can('bills.create')
                        {{-- <a href="{{ route('bills.create') }}" class="btn btn-primary btn-sm ms-2">+ Bulk Bills Generate </a> --}}
                        <button class="btn btn-primary btn-wave">
                            <a href="{{ route('bills.create') }}" class="text-white text-decoration-none">
                                <i class="ri-share-forward-line me-1 rtl-icon-transform lh-1 d-inline-block"></i> Bulk Bills
                            </a>
                        </button>
                    @endcan

                    @can('bills.create')
                        {{-- <a href="{{ route('bills.singleCreate') }}" class="btn btn-primary btn-sm ms-2">+ Single Bill Generate
                        </a> --}}...
                        <button class="btn btn-primary btn-wave">
                            <a href="{{ route('bills.singleCreate') }}" class="text-white text-decoration-none">
                                <i class="ri-share-forward-line me-1 rtl-icon-transform lh-1 d-inline-block"></i> Single Bills
                            </a>
                        </button>
                    @endcan

                    @can('bills.create')
                        {{-- <a href="{{ route('bills.divisionCreate') }}" class="btn btn-primary btn-sm ms-2">+ Division Bills
                            Generate </a> --}}...
                        <button class="btn btn-primary btn-wave">
                            <a href="{{ route('bills.divisionCreate') }}" class="text-white text-decoration-none">
                                <i class="ri-share-forward-line me-1 rtl-icon-transform lh-1 d-inline-block"></i> Division Bills
                            </a>
                        </button>
                    @endcan

                    @can('bills.create')
                        {{-- <a href="{{ route('bills.blockCreate') }}" class="btn btn-primary btn-sm ms-2">+ Blocks Bill Generate
                        </a> --}}...
                        <button class="btn btn-primary btn-wave">
                            <a href="{{ route('bills.divisionCreate') }}" class="text-white text-decoration-none">
                                <i class="ri-share-forward-line me-1 rtl-icon-transform lh-1 d-inline-block"></i> Block Bills
                            </a>
                        </button>
                    @endcan
                </div>
            </div>

            <div class="row">
                <div class="col-xl-3">
                    <div class="card custom-card">
                        <div class="card-body">
                            <div class="d-flex gap-2 justify-content-between">
                                <div class="d-flex flex-column justify-content-between gap-2">

                                    <div id="crmchart01"></div>
                                </div>
                                <div class="text-end">
                                    <div class="avatar avatar-md bg-primary bg-opacity-25 avatar-rounded mb-2">
                                        <div class="avatar avatar-sm bg-primary text-fixed-white avatar-rounded">
                                            <i class="ri-bar-chart-box-line fs-18"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <h4 class="fw-semibold mb-2"> GHS {{ $total['totalExpectedPayments'] }} </h4>
                                        <div class="text-muted mb-0">Total Bills Payables </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="card custom-card">
                        <div class="card-body">
                            <div class="d-flex gap-2 justify-content-between">
                                <div class="d-flex flex-column justify-content-between gap-2">

                                    <div id="crmchart02"></div>
                                </div>
                                <div class="text-end">
                                    <div class="avatar avatar-md bg-secondary bg-opacity-25 avatar-rounded mb-2">
                                        <div class="avatar avatar-sm bg-secondary text-fixed-white avatar-rounded">
                                            <i class="ri-user-add-line fs-18"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <h4 class="fw-semibold mb-2">GHS {{ $total['totalPayments'] }} </h4>
                                        <div class="text-muted mb-0"> Total Bills Paid </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="card custom-card">
                        <div class="card-body">
                            <div class="d-flex gap-2 justify-content-between">
                                <div class="d-flex flex-column justify-content-between gap-2">

                                    <div id="crmchart03"></div>
                                </div>
                                <div class="text-end">
                                    <div class="avatar avatar-md bg-success bg-opacity-25 avatar-rounded mb-2">
                                        <div class="avatar avatar-sm bg-success text-fixed-white avatar-rounded">
                                            <i class="ri-shake-hands-line fs-18"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <h4 class="fw-semibold mb-2">GHS {{ $total['totalUnpaidBills'] }} </h4>
                                        <div class="text-muted mb-0"> Total Un-Paid Bills</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="card custom-card">
                        <div class="card-body">
                            <div class="d-flex gap-2 justify-content-between">
                                <div class="d-flex flex-column justify-content-between gap-2">

                                    <div id="crmchart04"></div>
                                </div>
                                <div class="text-end">
                                    <div class="avatar avatar-md bg-info bg-opacity-25 avatar-rounded mb-2">
                                        <div class="avatar avatar-sm bg-info text-fixed-white avatar-rounded">
                                            <i class="ri-hourglass-line fs-18"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <h4 class="fw-semibold mb-2">{{ $total['paymentPercentage'] }}%</h4>
                                        <div class="text-muted mb-0"> Payment Percentage</div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                    <div class="tab-pane fade show active" id="pills-list" role="tabpanel" aria-labelledby="pills-list-tab">

                        <div class="card">
                            <div class="card-body px-0">
                                <div class="table-responsive active-projects user-tbl  dt-filter">
                                    <table id="file-export" class="table table-bordered text-nowrap w-100">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Bill No</th>
                                                <th>Name</th>
                                                <th>Property No.</th>
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
                                                    $firstname = $bill->property->customer->first_name ?? '';
                                                    $lastname = $bill->property->customer->last_name ?? '';
                                                    $name = $firstname . ' ' . $lastname;
                                                @endphp
                                                <tr class="btn-reveal-trigger">
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $bill->bills_id }}</td>
                                                    <td>{{ $name ?? '' }}</td>
                                                    <td>{{ $bill->property->property_number ?? '' }}</td>
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
                                                                        href=" {{ route('bills.receipt', $bill) }}">View
                                                                        Receipt
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
                                                <th colspan="3"></th>
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
