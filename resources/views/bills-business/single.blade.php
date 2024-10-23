@extends('layout.base')

@section('page-styles')
    <link href="{{ asset('assets/css/bootstrap-duallistbox.css') }}" rel="stylesheet">
@endsection

@section('page-content')
    <div class="container-fluid mh-auto">
        <div class="row">
            <div class="col-lg-6 col-lg-12">
                <div class="card">
                    <div class="card-header flex-wrap d-flex justify-content-between">
                        <div>
                            <h4 class="card-title">Generate Yearly Business Operating Permit Bills</h4>
                        </div>

                        <div>
                            <a href="{{ route('bills.bus.index') }}" class="btn btn-primary btn-sm ms-2">Back</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form method="POST" action="{{ route('bills.bus.singleStore') }}">
                                @csrf

                                <input type="hidden" name="business_url" url="{{ route('bills.business') }}">

                                <div class="row">
                                    <div class="alert alert-warning alert-dismissible fade show">
                                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor"
                                            stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                            class="me-2">
                                            <polyline points="9 11 12 14 22 4"></polyline>
                                            <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                                        </svg>
                                        <strong>TOTAL BUSINESSES AVAILABLE FOR BILLING: {{ $total }}</strong>
                                    </div>

                                    <div class="mb-4 col-md-6">
                                        <label class="form-label">Bill Year</label>
                                        <select class="form-control form-select @error('bills_year') is-invalid @enderror"
                                            name="bills_year">
                                            <option disabled selected>Select Bill Year</option>
                                            @for ($i = 2010; $i <= date('Y'); $i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>

                                        @error('bills_year')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-sm-6 mb-3">
                                        <label for="assembly_code" class="form-label">Assembly Code</label>
                                        <select class="form-control @error('assembly_code') is-invalid @enderror"
                                            id="assembly_code" name="assembly_code" data-option="bop" required>
                                            <option disabled selected>Select Assembly</option>
                                            @foreach ($assemblies as $assembly)
                                                <option value="{{ $assembly->assembly_code }}">{{ $assembly->name }}
                                                </option>
                                            @endforeach
                                        </select>

                                        @error('assembly_code')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-sm-12 mb-3">
                                        <label for="business_id" class="form-label">Business</label>
                                        <select class="form-control @error('business_id') is-invalid @enderror"
                                            name="business_id[]" multiple style="height:300px;">
                                            @foreach ($businesses as $business)
                                                @php
                                                    $firstname = $business->customer->first_name ?? '';
                                                    $lastname = $business->customer->last_name ?? '';
                                                    $fullname = $firstname . ' ' . $lastname;
                                                @endphp

                                                <option value="{{ $business->id }}">
                                                    {{ $fullname }} ({{ $business->business_owner_id }})
                                                </option>
                                            @endforeach
                                        </select>

                                        @error('business_id')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                </div>

                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-success">Generate Invoice</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-scripts')
    <script src="{{ asset('assets/js/bill.js?v1=1234') }}"></script>
    <script src="{{ asset('assets/js/jquery.bootstrap-duallistbox.js') }}"></script>
@endsection
