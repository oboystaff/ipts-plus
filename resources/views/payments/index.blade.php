@extends('layout.base')

@section('page-styles')
@endsection

@section('page-content')
    <div class="container-fluid mh-auto">
        <div class="row">

            <div class="row">
                <div class="col-xl-4">
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
                                        <h4 class="fw-semibold mb-2">GHS {{ $data['totalPendingPayments'] }}</h4>
                                        <div class="text-muted mb-0">Total Pending Payments</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
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
                                        <h4 class="fw-semibold mb-2">GHS {{ $data['totalSuccessfulPayments'] }}</h4>
                                        <div class="text-muted mb-0">Total Successful Payments</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
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
                                        <h4 class="fw-semibold mb-2">GHS {{ $data['totalFailedPayments'] }}</h4>
                                        <div class="text-muted mb-0">Total Failed Payments</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


            <div class="col-xl-12 active-p">

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

                <div class="card">

                    <div class="card-header flex-wrap d-flex justify-content-between">
                        <div class="card-header">
                            <div class="card-title">Payment Management</div>
                        </div>
                    </div>

                    <div class="card-body px-0">
                        <div class="table-responsive">
                            <table id="file-export" class="table table-bordered text-nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Bill ID</th>
                                        <th>Owners Name</th>
                                        <th>Amount</th>
                                        <th>Payment Mode</th>
                                        <th>Status</th>
                                        <th>Assembly</th>
                                        <th>Paid By</th>
                                        <th>Transaction ID</th>
                                        <th>Phone</th>
                                        <th>Network</th>
                                        <th>Payment Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($payments as $index => $payment)
                                        @php
                                            $name = '';
                                            if ($payment->bill->property && $payment->bill->property->customer) {
                                                $firstname = $payment->bill->property->customer->first_name ?? '';
                                                $lastname = $payment->bill->property->customer->last_name ?? '';
                                                $name = $firstname . ' ' . $lastname;
                                            } elseif ($payment->bill->business && $payment->bill->business->customer) {
                                                $firstname = $payment->bill->business->customer->first_name ?? '';
                                                $lastname = $payment->bill->business->customer->last_name ?? '';
                                                $name = $firstname . ' ' . $lastname;
                                            }
                                        @endphp
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $payment->bills_id }}</td>
                                            <td>{{ $name }}</td>
                                            <td>{{ number_format($payment->amount, 2) }}</td>
                                            <td>{{ $payment->payment_mode }}</td>
                                            <td>{{ $payment->transaction_status }}</td>
                                            <td>{{ $payment->assembly->name ?? 'N/A' }}</td>
                                            <td>{{ $payment->createdBy->name ?? 'N/A' }}</td>
                                            <th>{{ !empty($payment->transaction_id) ? $payment->transaction_id : 'N/A' }}
                                            </th>
                                            <th>{{ $payment->phone ?? 'N/A' }}</th>
                                            <td>{{ $payment->network ?? 'N/A' }}</td>
                                            <td>{{ $payment->created_at }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <div class="btn-link" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M11 12C11 12.5523 11.4477 13 12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12Z"
                                                                stroke="#737B8B" stroke-width="2" stroke-linecap="round"
                                                                stroke-linejoin="round">
                                                            </path>
                                                            <path
                                                                d="M18 12C18 12.5523 18.4477 13 19 13C19.5523 13 20 12.5523 20 12C20 11.4477 19.5523 11 19 11C18.4477 11 18 11.4477 18 12Z"
                                                                stroke="#737B8B" stroke-width="2" stroke-linecap="round"
                                                                stroke-linejoin="round">
                                                            </path>
                                                            <path
                                                                d="M4 12C4 12.5523 4.44772 13 5 13C5.55228 13 6 12.5523 6 12C6 11.4477 5.55228 11 5 11C4.44772 11 4 11.4477 4 12Z"
                                                                stroke="#737B8B" stroke-width="2" stroke-linecap="round"
                                                                stroke-linejoin="round">
                                                            </path>
                                                        </svg>
                                                    </div>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item"
                                                            href="{{ route('payments.show', $payment) }}">View
                                                            Payment</a>
                                                        <a class="dropdown-item"
                                                            href="{{ route('payments.receipt', $payment) }}"
                                                            target="_blank">View
                                                            Receipt</a>
                                                        {{-- <a class="dropdown-item"
                                                            href="{{ route('payments.edit', $payment) }}">Amend
                                                            Bill</a> --}}
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <th colspan="2"></th>
                                    <th>Total (GHS)</th>
                                    <th>{{ $total }}</th>
                                    <th colspan="7"></th>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-scripts')
@endsection
