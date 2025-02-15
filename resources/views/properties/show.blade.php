@extends('layout.base')

@section('page-styles')
@endsection

@section('page-content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header flex-wrap d-flex justify-content-between">
                        <div class="card-header">
                            <div class="card-title">Property Management / View Assembly Property</div>
                        </div>

                        <div>
                            <a href="{{ route('properties.index') }}" class="btn btn-primary btn-sm ms-2">Back</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card h-auto">
                                    <div class="card-body">
                                        <div class="custom-tab-1">
                                            <ul class="nav nav-tabs">
                                                <li class="nav-item"><a href="#my-posts" data-bs-toggle="tab"
                                                        class="nav-link active show">Owner Information</a>
                                                </li>
                                                <li class="nav-item"><a href="#about-me" data-bs-toggle="tab"
                                                        class="nav-link">Bills History
                                                    </a>
                                                </li>
                                                <li class="nav-item"><a href="#profile-settings" data-bs-toggle="tab"
                                                        class="nav-link">Payments History</a>
                                                </li>
                                                <li class="nav-item"><a href="#property" data-bs-toggle="tab"
                                                        class="nav-link">Property Information</a>
                                                </li>
                                            </ul>
                                            <div class="tab-content">

                                                <div id="my-posts" class="tab-pane fade active show">
                                                    <div class="my-post-content pt-3">
                                                        <div class="post-input">

                                                            <div class="row">
                                                                <div class="col-md-6 mb-3">
                                                                    <div class="form-group">
                                                                        <label for="first_name">First Name</label>
                                                                        <input type="text" class="form-control"
                                                                            id="first_name" name="first_name"
                                                                            value="{{ $property->customer->first_name ?? '' }}"
                                                                            readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <div class="form-group">
                                                                        <label for="last_name">Last Name</label>
                                                                        <input type="text" class="form-control"
                                                                            id="last_name" name="last_name"
                                                                            value="{{ $property->customer->last_name ?? '' }}"
                                                                            readonly>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6 mb-3">
                                                                    <div class="form-group">
                                                                        <label for="other_name">Other Name</label>
                                                                        <input type="text" class="form-control"
                                                                            id="other_name" name="other_name"
                                                                            value="{{ $property->customer->other_name ?? 'N/A' }}"
                                                                            readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <div class="form-group">
                                                                        <label for="other_name">Phone Number</label>
                                                                        <input type="text" class="form-control"
                                                                            id="other_name" name="other_name"
                                                                            value="{{ $property->customer->telephone_number ?? 'N/A' }}"
                                                                            readonly>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-6 mb-3">
                                                                    <div class="form-group">
                                                                        <label for="gender">Gender</label>
                                                                        <input type="text" class="form-control"
                                                                            id="gender" name="gender"
                                                                            value="{{ $property->customer->gender ?? '' }}"
                                                                            readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <div class="form-group">
                                                                        <label for="date_of_birth">Date of Birth</label>
                                                                        <input type="text" class="form-control"
                                                                            id="date_of_birth" name="date_of_birth"
                                                                            value="{{ $property->customer->date_of_birth ?? '' }}"
                                                                            readonly>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6 mb-3">
                                                                    <div class="form-group">
                                                                        <label for="marital_status">Marital
                                                                            Status</label>
                                                                        <input type="text" class="form-control"
                                                                            id="marital_status" name="marital_status"
                                                                            value="{{ $property->customer->marital_status ?? '' }}"
                                                                            readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <div class="form-group">
                                                                        <label for="nia_number">NIA Number</label>
                                                                        <input type="text" class="form-control"
                                                                            id="nia_number" name="nia_number"
                                                                            value="{{ $property->customer->nia_number ?? 'N/A' }}"
                                                                            readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <div class="form-group">
                                                                        <label for="account_number">Account
                                                                            Number</label>
                                                                        <input type="text" class="form-control"
                                                                            id="account_number" name="account_number"
                                                                            value="{{ $property->customer->account_number }}"
                                                                            readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <div class="form-group">
                                                                        <label for="account_number">Customer
                                                                            Type</label>
                                                                        <input type="text" class="form-control"
                                                                            id="customer_type" name="customer_type"
                                                                            value="{{ $property->customer->customerType->name ?? 'N/A' }}"
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
                                                            {{-- <div class="card-header">
                                                                <div class="card-title">Bill Generation History</div>
                                                            </div> --}}
                                                            <table id="file-export"
                                                                class="table table-bordered text-nowrap w-100">
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
                                                                                    $bill->property->customer
                                                                                        ->first_name ?? '';
                                                                                $lastname =
                                                                                    $bill->property->customer
                                                                                        ->last_name ?? '';
                                                                                $billType = 'Property Bill';
                                                                            } else {
                                                                                $firstname =
                                                                                    $bill->business->customer
                                                                                        ->first_name ?? '';
                                                                                $lastname =
                                                                                    $bill->business->customer
                                                                                        ->last_name ?? '';
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
                                                                            <td>{{ $billType }}</td>
                                                                            <td>{{ number_format($bill->arrears, 2) }}
                                                                            </td>
                                                                            <td>{{ number_format($bill->amount, 2) }}
                                                                            </td>
                                                                            <td>{{ number_format($bill->amount + $bill->arrears, 2) }}
                                                                            </td>
                                                                            <td>{{ $bill->createdBy->name ?? 'N/A' }}
                                                                            </td>
                                                                            <td>{{ $bill->created_at }}</td>
                                                                            <td>
                                                                                <div class="dropdown">
                                                                                    <div class="btn-link"
                                                                                        data-bs-toggle="dropdown"
                                                                                        aria-expanded="false">
                                                                                        <svg width="24" height="24"
                                                                                            viewBox="0 0 24 24"
                                                                                            fill="none"
                                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                                            <path
                                                                                                d="M11 12C11 12.5523 11.4477 13 12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12Z"
                                                                                                stroke="#737B8B"
                                                                                                stroke-width="2"
                                                                                                stroke-linecap="round"
                                                                                                stroke-linejoin="round">
                                                                                            </path>
                                                                                            <path
                                                                                                d="M18 12C18 12.5523 18.4477 13 19 13C19.5523 13 20 12.5523 20 12C20 11.4477 19.5523 11 19 11C18.4477 11 18 11.4477 18 12Z"
                                                                                                stroke="#737B8B"
                                                                                                stroke-width="2"
                                                                                                stroke-linecap="round"
                                                                                                stroke-linejoin="round">
                                                                                            </path>
                                                                                            <path
                                                                                                d="M4 12C4 12.5523 4.44772 13 5 13C5.55228 13 6 12.5523 6 12C6 11.4477 5.55228 11 5 11C4.44772 11 4 11.4477 4 12Z"
                                                                                                stroke="#737B8B"
                                                                                                stroke-width="2"
                                                                                                stroke-linecap="round"
                                                                                                stroke-linejoin="round">
                                                                                            </path>
                                                                                        </svg>
                                                                                    </div>
                                                                                    <div
                                                                                        class="dropdown-menu dropdown-menu-end">
                                                                                        <div class="py-2">
                                                                                            <a class="dropdown-item"
                                                                                                href=" {{ route('bills.show', $bill) }}"
                                                                                                target="_blank">Print
                                                                                                Bill Receipt
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
                                                            {{-- <div class="card-header">
                                                                <div class="card-title">Payment History</div>
                                                            </div> --}}

                                                            <table id="file-export2"
                                                                class="table table-bordered text-nowrap w-100">
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
                                                                                    $payment->bill->property->customer
                                                                                        ->last_name ?? '';
                                                                                $name = $firstname . ' ' . $lastname;
                                                                            } elseif (
                                                                                $payment->bill->business &&
                                                                                $payment->bill->business->customer
                                                                            ) {
                                                                                $firstname =
                                                                                    $payment->bill->business->customer
                                                                                        ->first_name ?? '';
                                                                                $lastname =
                                                                                    $payment->bill->business->customer
                                                                                        ->last_name ?? '';
                                                                                $name = $firstname . ' ' . $lastname;
                                                                            }
                                                                        @endphp
                                                                        <tr>
                                                                            <td>{{ $index + 1 }}</td>
                                                                            <td>{{ $payment->bills_id }}</td>
                                                                            <td>{{ $name }}</td>
                                                                            <td>{{ number_format($payment->amount, 2) }}
                                                                            </td>
                                                                            <td>{{ $payment->payment_mode }}</td>
                                                                            <td>{{ $payment->transaction_status }}</td>
                                                                            <td>{{ $payment->assembly->name ?? 'N/A' }}
                                                                            </td>
                                                                            <td>{{ $payment->createdBy->name ?? 'N/A' }}
                                                                            </td>
                                                                            <td>{{ $payment->created_at }}</td>
                                                                            <td>
                                                                                <div class="dropdown">
                                                                                    <div class="btn-link"
                                                                                        data-bs-toggle="dropdown"
                                                                                        aria-expanded="false">
                                                                                        <svg width="24" height="24"
                                                                                            viewBox="0 0 24 24"
                                                                                            fill="none"
                                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                                            <path
                                                                                                d="M11 12C11 12.5523 11.4477 13 12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12Z"
                                                                                                stroke="#737B8B"
                                                                                                stroke-width="2"
                                                                                                stroke-linecap="round"
                                                                                                stroke-linejoin="round">
                                                                                            </path>
                                                                                            <path
                                                                                                d="M18 12C18 12.5523 18.4477 13 19 13C19.5523 13 20 12.5523 20 12C20 11.4477 19.5523 11 19 11C18.4477 11 18 11.4477 18 12Z"
                                                                                                stroke="#737B8B"
                                                                                                stroke-width="2"
                                                                                                stroke-linecap="round"
                                                                                                stroke-linejoin="round">
                                                                                            </path>
                                                                                            <path
                                                                                                d="M4 12C4 12.5523 4.44772 13 5 13C5.55228 13 6 12.5523 6 12C6 11.4477 5.55228 11 5 11C4.44772 11 4 11.4477 4 12Z"
                                                                                                stroke="#737B8B"
                                                                                                stroke-width="2"
                                                                                                stroke-linecap="round"
                                                                                                stroke-linejoin="round">
                                                                                            </path>
                                                                                        </svg>
                                                                                    </div>
                                                                                    <div
                                                                                        class="dropdown-menu dropdown-menu-end">
                                                                                        <a class="dropdown-item"
                                                                                            href="{{ route('payments.receipt', $payment) }}"
                                                                                            target="_blank">View
                                                                                            Receipt</a>
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
                                                                    <th colspan="6"></th>
                                                                </tfoot>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div id="property" class="tab-pane fade">
                                                    <div class="pt-3">
                                                        <div class="table-responsive active-projects">
                                                            {{-- <div class="card-header">
                                                                <div class="card-title">Property Information</div>
                                                            </div> --}}

                                                            <form class="row g-3 needs-validation" method="POST"
                                                                action="{{ route('properties.update', $property) }}">
                                                                @csrf

                                                                <div class="col-sm-6 mb-3">
                                                                    <div class="form-group">
                                                                        <label for="entity_type">Entity Type</label>
                                                                        <input type="text"
                                                                            class="form-control @error('entity_type') is-invalid @enderror"
                                                                            id="entity_type" name="entity_type"
                                                                            placeholder="Digital address"
                                                                            value="{{ $property->entityType->name ?? '' }}"
                                                                            readonly>

                                                                        @error('entity_type')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                {{ $message }}
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                </div>

                                                                <div class="col-sm-6 mb-3">
                                                                    <div class="form-group">
                                                                        <label for="digital_address">Digital
                                                                            Address</label>
                                                                        <input type="text"
                                                                            class="form-control @error('digital_address') is-invalid @enderror"
                                                                            id="digital_address" name="digital_address"
                                                                            placeholder="Digital address"
                                                                            value="{{ $property->digital_address }}"
                                                                            readonly>

                                                                        @error('digital_address')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                {{ $message }}
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                </div>

                                                                <div class="col-sm-6 mb-3">
                                                                    <div class="form-group">
                                                                        <label for="location">Location</label>
                                                                        <input type="text"
                                                                            class="form-control @error('location') is-invalid @enderror"
                                                                            id="location" name="location"
                                                                            placeholder="Location"
                                                                            value="{{ $property->location }}" readonly>

                                                                        @error('location')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                {{ $message }}
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                </div>

                                                                <div class="col-sm-6 mb-3">
                                                                    <div class="form-group">
                                                                        <label for="street_name">Street Name</label>
                                                                        <input type="text" class="form-control"
                                                                            id="street_name" name="street_name"
                                                                            placeholder="Street name"
                                                                            value="{{ $property->street_name }}" readonly>
                                                                    </div>
                                                                </div>

                                                                <div class="col-sm-6 mb-3">
                                                                    <div class="form-group">
                                                                        <label for="rated">Rated</label>
                                                                        <input type="text" class="form-control"
                                                                            id="rated" name="rated"
                                                                            placeholder="Street name"
                                                                            value="{{ $property->rated }}" readonly>
                                                                    </div>
                                                                </div>

                                                                <div class="col-sm-6 mb-3">
                                                                    <div class="form-group">
                                                                        <label for="validated">Validated</label>
                                                                        <input type="text" class="form-control"
                                                                            id="validated" name="validated"
                                                                            placeholder="Street name"
                                                                            value="{{ $property->validated }}" readonly>
                                                                    </div>
                                                                </div>

                                                                <div class="col-sm-6 mb-3">
                                                                    <label for="entity_type">Associate Owner</label>
                                                                    <input type="text" class="form-control"
                                                                        id="customer_name" name="customer_name"
                                                                        placeholder="Street name"
                                                                        value="{{ $property->customer->first_name ?? '' }} {{ $property->customer->last_name ?? '' }}"
                                                                        readonly>
                                                                </div>

                                                                <div class="col-sm-6 mb-3">
                                                                    <div class="form-group">
                                                                        <label for="ratable_value">Ratable
                                                                            Value</label>
                                                                        <input type="text" class="form-control"
                                                                            id="ratable_value" name="ratable_value"
                                                                            placeholder="Ratable value"
                                                                            value="{{ $property->ratable_value }}"
                                                                            readonly>
                                                                    </div>
                                                                </div>

                                                                <div class="col-sm-6 mb-3">
                                                                    <div class="form-group">
                                                                        <label for="longitude">Longitude</label>
                                                                        <input type="text" class="form-control"
                                                                            id="longitude" name="longitude"
                                                                            placeholder="Longitude"
                                                                            value="{{ $property->longitude }}" readonly>
                                                                    </div>
                                                                </div>

                                                                <div class="col-sm-6 mb-3">
                                                                    <div class="form-group">
                                                                        <label for="latitude">Latitude</label>
                                                                        <input type="text" class="form-control"
                                                                            id="latitude" name="latitude"
                                                                            placeholder="Latitude"
                                                                            value="{{ $property->latitude }}" readonly>
                                                                    </div>
                                                                </div>

                                                                <!-- Add Assembly field here -->
                                                                <div class="col-sm-6 mb-3">
                                                                    <div class="form-group">
                                                                        <label for="assembly">Assembly Property</label>
                                                                        <input type="text" class="form-control"
                                                                            id="assembly_code" name="assembly_code"
                                                                            placeholder="Assembly_code"
                                                                            value="{{ $property->assembly->name ?? '' }}"
                                                                            readonly>

                                                                        @error('assembly_code')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                {{ $message }}
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </form>
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
            </div>
        </div>
    </div>
@endsection

@section('page-scripts')
@endsection
