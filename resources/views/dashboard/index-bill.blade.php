@extends('layout.base')

@section('page-styles')
@endsection

@section('page-content')
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

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header flex-wrap d-flex justify-content-between">
                        <div>
                            <h4 class="card-title">View Customer Bill</h4>
                        </div>

                        <div>
                            <a href="{{ route('dashboard.mybills') }}" class="btn btn-primary btn-sm ms-2">Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <form class="row g-3 needs-validation" method="POST" action="{{ route('blocks.store') }}">
                            @csrf

                            <div class="col-md-6 mb-3">
                                <label for="block_code">Bill No.</label>
                                <input type="text" class="form-control @error('block_code') is-invalid @enderror"
                                    id="block_code" name="block_code" placeholder="Enter block code"
                                    value="{{ $bill->bills_id }}" readonly>

                                @error('block_code')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="block_name">Owner Name</label>
                                <input type="text" class="form-control @error('block_name') is-invalid @enderror"
                                    id="block_name" name="block_name" placeholder="Enter block name"
                                    value="{{ $name }}" readonly>

                                @error('block_name')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="block_name">Bill Date</label>
                                <input type="text" class="form-control @error('block_name') is-invalid @enderror"
                                    id="block_name" name="block_name" placeholder="Enter block name"
                                    value="{{ $bill->billing_date }}" readonly>

                                @error('block_name')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="block_name">Bill Year</label>
                                <input type="text" class="form-control @error('block_name') is-invalid @enderror"
                                    id="block_name" name="block_name" placeholder="Enter block name"
                                    value="{{ $bill->bills_year }}" readonly>

                                @error('block_name')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="block_name">Bill Type</label>
                                <input type="text" class="form-control @error('block_name') is-invalid @enderror"
                                    id="block_name" name="block_name" placeholder="Enter block name"
                                    value="{{ $billType }}" readonly>

                                @error('block_name')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="block_name">Arrears (GHS)</label>
                                <input type="text" class="form-control @error('block_name') is-invalid @enderror"
                                    id="block_name" name="block_name" placeholder="Enter block name"
                                    value="{{ number_format($bill->arrears, 2) }}" readonly>

                                @error('block_name')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="block_name">Current Amount</label>
                                <input type="text" class="form-control @error('block_name') is-invalid @enderror"
                                    id="block_name" name="block_name" placeholder="Enter block name"
                                    value="{{ number_format($bill->amount, 2) }}" readonly>

                                @error('block_name')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="block_name">Amount Due</label>
                                <input type="text" class="form-control @error('block_name') is-invalid @enderror"
                                    id="block_name" name="block_name" placeholder="Enter block name"
                                    value="{{ number_format($bill->amount + $bill->arrears, 2) }}" readonly>

                                @error('block_name')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-scripts')
    <script type="text/javascript">
        var Tawk_API = Tawk_API || {},
            Tawk_LoadStart = new Date();
        (function() {
            var s1 = document.createElement("script"),
                s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/663e4f9b9a809f19fb2fa32d/1hthme206';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script>

    <script src="{{ asset('assets/js/general/app.js?t=1234') }}"></script>
@endsection
