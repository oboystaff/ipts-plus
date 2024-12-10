@extends('layout.base')

@section('page-styles')
@endsection

@section('page-content')
    <div class="container-fluid mh-auto">
        <div class="row">
            <div class="col-xl-12 active-p">
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-list" role="tabpanel" aria-labelledby="pills-list-tab">
                        <div class="card">

                            <div class="card-header flex-wrap d-flex justify-content-between">
                                <div>
                                    <h4 class="heading mb-0">Bills Management</h4>
                                </div>
                            </div>

                            <div class="card-body px-0">
                                <div class="table-responsive active-projects user-tbl  dt-filter">
                                    <table id="user-tbl" class="table shorting">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Bill No</th>
                                                <th>Name</th>
                                                <th>Bill Date</th>
                                                <th>Bill Year</th>
                                                <th>Bill Type</th>
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
                                                    $billType = '';

                                                    if ($bill->property_id !== null) {
                                                        $firstname = $bill->property->customer->first_name ?? '';
                                                        $lastname = $bill->property->customer->last_name ?? '';
                                                        $billType = 'Property Bill';
                                                    } else {
                                                        $firstname = $bill->business->customer->first_name ?? '';
                                                        $lastname = $bill->business->customer->last_name ?? '';
                                                        $billType = 'Business Bill';
                                                    }
                                                    $name = $firstname . ' ' . $lastname;
                                                @endphp

                                                <tr class="btn-reveal-trigger">
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $bill->bills_id }}</td>
                                                    <td>{{ $name ?? '' }}</td>
                                                    <td>{{ $bill->billing_date }}</td>
                                                    <td>{{ $bill->bills_year }}</td>
                                                    @if ($bill->property_id !== null)
                                                        <td>
                                                            <span class="badge light badge-success">
                                                                {{ $billType }}
                                                            </span>
                                                        </td>
                                                    @else
                                                        <td>
                                                            <span class="badge light badge-warning">
                                                                {{ $billType }}
                                                            </span>
                                                        </td>
                                                    @endif
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
                                                                        href=" {{ route('bills.show', $bill) }}"
                                                                        target="_blank">Print Bill Receipt
                                                                    </a>
                                                                    <a class="dropdown-item"
                                                                        href=" {{ route('payments.create', $bill) }}">Make
                                                                        Payment
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
