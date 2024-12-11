@extends('layout.base')

@section('page-content')
    <div class="container-fluid">
        <!-- row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="profile card card-body px-3 pt-3 pb-0">
                    <div class="profile-head">
                        <div class="photo-content">
                            <div class="cover-photo rounded"></div>
                        </div>
                        <div class="profile-info">
                            <div class="profile-photo">
                                <img src="" class="img-fluid rounded-circle" alt="">
                            </div>
                            <div class="profile-details">
                                <div class="profile-name px-3 pt-2">
                                    <h4 class="text-primary mb-0">{{ $citizen->first_name }} {{ $citizen->last_name }} ,
                                        {{ $citizen->other_name }}</h4>
                                    <p>Full Name </p>
                                </div>
                                <div class="profile-email px-2 pt-2">
                                    <h4 class="text-muted mb-0">{{ $citizen->account_number }}</h4>
                                    <p>Account Number</p>
                                </div>
                                <div class="dropdown ms-auto">
                                    <a href="#" class="btn btn-primary light sharp" data-bs-toggle="dropdown"
                                        aria-expanded="true"><svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px"
                                            viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                <circle fill="#000000" cx="5" cy="12" r="2"></circle>
                                                <circle fill="#000000" cx="12" cy="12" r="2"></circle>
                                                <circle fill="#000000" cx="19" cy="12" r="2"></circle>
                                            </g>
                                        </svg></a>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <a href="{{ route('citizens.index') }}" class="dropdown-item">
                                            <i class="fa fa-user-circle text-primary me-2"></i> Back
                                        </a>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="card h-auto">
                    <div class="card-body">
                        <div class="profile-tab">
                            <div class="custom-tab-1">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item"><a href="#my-posts" data-bs-toggle="tab"
                                            class="nav-link active show">Personal Information</a>
                                    </li>
                                    <li class="nav-item"><a href="#about-me" data-bs-toggle="tab" class="nav-link">Bills
                                            History
                                        </a>
                                    </li>
                                    <li class="nav-item"><a href="#profile-settings" data-bs-toggle="tab"
                                            class="nav-link">Payments History</a>
                                    </li>
                                    <li class="nav-item"><a href="#property" data-bs-toggle="tab" class="nav-link">Property
                                            Information</a>
                                    </li>
                                    <li class="nav-item"><a href="#business" data-bs-toggle="tab" class="nav-link">Business
                                            Information</a>
                                    </li>
                                </ul>
                                <div class="tab-content">

                                    <div id="my-posts" class="tab-pane fade active show">
                                        <div class="my-post-content pt-3">
                                            <div class="post-input">

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="first_name">First Name</label>
                                                            <input type="text" class="form-control" id="first_name"
                                                                name="first_name" value="{{ $citizen->first_name }}"
                                                                readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="last_name">Last Name</label>
                                                            <input type="text" class="form-control" id="last_name"
                                                                name="last_name" value="{{ $citizen->last_name }}" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="other_name">Other Name</label>
                                                            <input type="text" class="form-control" id="other_name"
                                                                name="other_name"
                                                                value="{{ $citizen->other_name ?? 'N/A' }}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="gender">Gender</label>
                                                            <input type="text" class="form-control" id="gender"
                                                                name="gender" value="{{ $citizen->gender }}" readonly>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="date_of_birth">Date of Birth</label>
                                                            <input type="text" class="form-control" id="date_of_birth"
                                                                name="date_of_birth" value="{{ $citizen->date_of_birth }}"
                                                                readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="marital_status">Marital Status</label>
                                                            <input type="text" class="form-control"
                                                                id="marital_status" name="marital_status"
                                                                value="{{ $citizen->marital_status }}" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="nia_number">NIA Number</label>
                                                            <input type="text" class="form-control" id="nia_number"
                                                                name="nia_number"
                                                                value="{{ $citizen->nia_number ?? 'N/A' }}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="account_number">Account Number</label>
                                                            <input type="text" class="form-control"
                                                                id="account_number" name="account_number"
                                                                value="{{ $citizen->account_number }}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="account_number">Customer Type</label>
                                                            <input type="text" class="form-control" id="customer_type"
                                                                name="customer_type"
                                                                value="{{ $citizen->customerType->name ?? 'N/A' }}"
                                                                readonly>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="about-me" class="tab-pane fade">
                                        <div class="pt-3">
                                            <div class="table-responsive active-projects">
                                                <div class="tbl-caption">
                                                    <h4 class="heading mb-0">Bill Generation History</h4>
                                                </div>
                                                <table id="empoloyees-tbl" class="table">
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
                                                    <tbody>
                                                        @foreach ($customerData['bills'] as $index => $bill)
                                                            @php
                                                                $billType = '';

                                                                if ($bill->property_id !== null) {
                                                                    $firstname =
                                                                        $bill->property->customer->first_name ?? '';
                                                                    $lastname =
                                                                        $bill->property->customer->last_name ?? '';
                                                                    $billType = 'Property Bill';
                                                                } else {
                                                                    $firstname =
                                                                        $bill->business->customer->first_name ?? '';
                                                                    $lastname =
                                                                        $bill->business->customer->last_name ?? '';
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
                                                                <td>{{ number_format($bill->amount + $bill->arrears, 2) }}
                                                                </td>
                                                                <td>{{ $bill->createdBy->name ?? 'N/A' }}</td>
                                                                <td>{{ $bill->created_at }}</td>
                                                                <td>
                                                                    <div class="dropdown">
                                                                        <div class="btn-link" data-bs-toggle="dropdown"
                                                                            aria-expanded="false">
                                                                            <svg width="24" height="24"
                                                                                viewBox="0 0 24 24" fill="none"
                                                                                xmlns="http://www.w3.org/2000/svg">
                                                                                <path
                                                                                    d="M11 12C11 12.5523 11.4477 13 12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12Z"
                                                                                    stroke="#737B8B" stroke-width="2"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round">
                                                                                </path>
                                                                                <path
                                                                                    d="M18 12C18 12.5523 18.4477 13 19 13C19.5523 13 20 12.5523 20 12C20 11.4477 19.5523 11 19 11C18.4477 11 18 11.4477 18 12Z"
                                                                                    stroke="#737B8B" stroke-width="2"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round">
                                                                                </path>
                                                                                <path
                                                                                    d="M4 12C4 12.5523 4.44772 13 5 13C5.55228 13 6 12.5523 6 12C6 11.4477 5.55228 11 5 11C4.44772 11 4 11.4477 4 12Z"
                                                                                    stroke="#737B8B" stroke-width="2"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round">
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
                                                            <th>{{ $customerData['totalArrears'] }}</th>
                                                            <th>{{ $customerData['totalAmount'] }}</th>
                                                            <th>{{ $customerData['totalDue'] }}</th>
                                                            <th colspan="3"></th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="profile-settings" class="tab-pane fade">
                                        <div class="pt-3">
                                            <div class="table-responsive active-projects">
                                                <div class="tbl-caption">
                                                    <h4 class="heading mb-0">Payment History</h4>
                                                </div>
                                                <table id="empoloyees-tbl4" class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>SN</th>
                                                            <th>Bills ID</th>
                                                            <th>Name</th>
                                                            <th>Amount</th>
                                                            <th>Payment Mode</th>
                                                            <th>Status</th>
                                                            <th>Assembly</th>
                                                            <th>Paid By</th>
                                                            <th>Payment Date</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($customerData['payments'] as $index => $payment)
                                                            @php
                                                                $name = '';
                                                                if (
                                                                    $payment->bill->property &&
                                                                    $payment->bill->property->customer
                                                                ) {
                                                                    $firstname =
                                                                        $payment->bill->property->customer
                                                                            ->first_name ?? '';
                                                                    $lastname =
                                                                        $payment->bill->property->customer->last_name ??
                                                                        '';
                                                                    $name = $firstname . ' ' . $lastname;
                                                                } elseif (
                                                                    $payment->bill->business &&
                                                                    $payment->bill->business->customer
                                                                ) {
                                                                    $firstname =
                                                                        $payment->bill->business->customer
                                                                            ->first_name ?? '';
                                                                    $lastname =
                                                                        $payment->bill->business->customer->last_name ??
                                                                        '';
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
                                                                <td>{{ $payment->created_at }}</td>
                                                                <td>
                                                                    <div class="dropdown">
                                                                        <div class="btn-link" data-bs-toggle="dropdown"
                                                                            aria-expanded="false">
                                                                            <svg width="24" height="24"
                                                                                viewBox="0 0 24 24" fill="none"
                                                                                xmlns="http://www.w3.org/2000/svg">
                                                                                <path
                                                                                    d="M11 12C11 12.5523 11.4477 13 12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12Z"
                                                                                    stroke="#737B8B" stroke-width="2"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round">
                                                                                </path>
                                                                                <path
                                                                                    d="M18 12C18 12.5523 18.4477 13 19 13C19.5523 13 20 12.5523 20 12C20 11.4477 19.5523 11 19 11C18.4477 11 18 11.4477 18 12Z"
                                                                                    stroke="#737B8B" stroke-width="2"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round">
                                                                                </path>
                                                                                <path
                                                                                    d="M4 12C4 12.5523 4.44772 13 5 13C5.55228 13 6 12.5523 6 12C6 11.4477 5.55228 11 5 11C4.44772 11 4 11.4477 4 12Z"
                                                                                    stroke="#737B8B" stroke-width="2"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round">
                                                                                </path>
                                                                            </svg>
                                                                        </div>
                                                                        <div class="dropdown-menu dropdown-menu-end">
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
                                                        <th>{{ $customerData['paymentTotal'] }}</th>
                                                        <th colspan="7"></th>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="property" class="tab-pane fade">
                                        <div class="pt-3">
                                            <div class="table-responsive active-projects">
                                                <div class="tbl-caption">
                                                    <h4 class="heading mb-0">Property Information</h4>
                                                </div>
                                                <table id="empoloyees-tbl3" class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>S/N</th>
                                                            <th>Entity Type</th>
                                                            <th>Category</th>
                                                            <th>Digital Address</th>
                                                            <th>Location</th>
                                                            <th>Street Name</th>
                                                            <th>Rated</th>
                                                            <th>Validated</th>
                                                            <th>Property Number</th>
                                                            <th>Owner Account</th>
                                                            <th>Owner Name</th>
                                                            <th>Ratable Value</th>
                                                            <th>Assembly</th>
                                                            <th>Division</th>
                                                            <th>Block</th>
                                                            <th>Zone</th>
                                                            <th>Property Use</th>
                                                            <th>Date Created</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($customerData['properties'] as $index => $property)
                                                            <tr>
                                                                <td>{{ $index + 1 }}</td>
                                                                <td>{{ $property->entityType->name ?? '' }}</td>
                                                                <td>{{ $property->entityType->category ?? '' }}</td>
                                                                <td>{{ $property->digital_address }}</td>
                                                                <td>{{ $property->location }}</td>
                                                                <td>{{ $property->street_name }}</td>
                                                                <td>{{ $property->rated }}</td>
                                                                <td>{{ $property->validated }}</td>
                                                                <td>{{ $property->property_number }}</td>
                                                                <td>{{ $property->customer->account_number ?? 'N/A' }}</td>
                                                                <td>{{ $property->customer->first_name ?? '' }}
                                                                    {{ $property->customer->last_name ?? 'N/A' }}
                                                                </td>
                                                                <td>{{ number_format($property->ratable_value, 2) }}</td>
                                                                <td>{{ $property->assembly->name ?? 'N/A' }}</td>
                                                                <td>{{ $property->division->division_name ?? 'N/A' }}</td>
                                                                <td>{{ $property->block->block_name ?? 'N/A' }}</td>
                                                                <td>{{ $property->zone->name ?? 'N/A' }}</td>
                                                                <td>{{ $property->propertyUse->name ?? 'N/A' }}</td>
                                                                <td>{{ $property->created_at }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th colspan="10"></th>
                                                            <th>Total (GHS)</th>
                                                            <th>{{ $customerData['total'] }}</th>
                                                            <th colspan="6"></th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="business" class="tab-pane fade">
                                        <div class="pt-3">
                                            <div class="table-responsive active-projects">
                                                <div class="tbl-caption">
                                                    <h4 class="heading mb-0">Business Information</h4>
                                                </div>
                                                <table id="empoloyees-tbl2" class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>S/N</th>
                                                            <th>Business Name</th>
                                                            <th>Business Type</th>
                                                            <th>Business Class</th>
                                                            <th>Location</th>
                                                            <th>Email</th>
                                                            <th>Phone</th>
                                                            <th>Business Owner</th>
                                                            <th>Assembly</th>
                                                            <th>Division</th>
                                                            <th>Block</th>
                                                            <th>Zone</th>
                                                            <th>Property Use</th>
                                                            <th>Created By</th>
                                                            <th>Date Created</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($customerData['businesses'] as $index => $business)
                                                            @php
                                                                $firstname = $business->customer->first_name ?? '';
                                                                $lastname = $business->customer->last_name ?? '';
                                                                $fullname = $firstname . ' ' . $lastname;
                                                            @endphp

                                                            <tr>
                                                                <td>{{ $index + 1 }}</td>
                                                                <td>{{ $business->business_name }}</td>
                                                                <td>{{ $business->businessType->name ?? '' }}</td>
                                                                <td>{{ $business->businessClass->name ?? '' }}</td>
                                                                <td>{{ $business->location }}</td>
                                                                <td>{{ $business->email }}</td>
                                                                <td>{{ $business->business_phone }}</td>
                                                                <td>{{ $fullname ?? '' }}</td>
                                                                <td>{{ $business->assembly->name ?? 'N/A' }}</td>
                                                                <td>{{ $business->division->division_name ?? 'N/A' }}</td>
                                                                <td>{{ $business->block->block_name ?? 'N/A' }}</td>
                                                                <td>{{ $business->zone->name ?? 'N/A' }}</td>
                                                                <td>{{ $business->propertyUse->name ?? 'N/A' }}</td>
                                                                <td>{{ $business->createdBy->name ?? 'N/A' }}</td>
                                                                <td>{{ $business->created_at }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
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
        </div>
    </div>
@endsection
