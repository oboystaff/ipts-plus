@extends('layout.base')

@section('page-styles')
    <!-- Include any additional styles needed for the payment form -->
@endsection
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

@section('page-content')
    <div class="card">
        <!-- HEADER SECTION -->
        <div class="card-body border-bottom pb-3">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <div>
                    <h4 class="fw-bold text-primary mb-1">
                        <i class="ri-wallet-3-line me-2"></i> Payment Record Details
                    </h4>

                    <p class="mb-0 text-muted fs-14">
                        You are Viewing A Payment on A generated bill record in your
                        central database repository.
                    </p>
                </div>

                <a href="{{ route('payments.index') }}" class="btn btn-sm btn-primary">
                    <i class="ri-arrow-go-back-line"></i> Back
                </a>

            </div>
        </div>

    </div>
    <div class="row">
        <div class="container-fluid mh-auto">
            <div class="card">

                <div class="card-body">
                    <form action="{{ route('payments.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="form-group col-md-6 mb-4">
                                <label for="bills_id">Bill No.:</label>
                                <input type="text" class="form-control" id="bills_id" name="bills_id"
                                    value="{{ $payment->bills_id ?? '' }}" readonly>
                            </div>

                            <div class="form-group col-md-6 mb-4">
                                <label for="bills_id">Name:</label>
                                <input type="text" class="form-control" id="bills_id" name="bills_id"
                                    value="{{ $name ?? '' }}" readonly>
                            </div>

                            <div class="form-group col-md-6 mb-4">
                                <label for="paid_by">Amount:</label>
                                <input type="text" class="form-control @error('amount') is-invalid @enderror"
                                    id="amount" name="amount" value="{{ $payment->amount }}" readonly>

                                @error('amount')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 mb-4">
                                <label for="payment_mode">Payment Mode:</label>
                                <input type="text" class="form-control @error('payment_mode') is-invalid @enderror"
                                    id="payment_mode" name="payment_mode" value="{{ $payment->payment_mode }}" readonly>

                                @error('payment_mode')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 mb-4 phone">
                                <label for="phone">Payer Phone:</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                    id="phone" name="phone" value="{{ $payment->phone ?? 'N/A' }}" readonly>

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 mb-4 network">
                                <label for="network">Payment Network:</label>
                                <input type="text" class="form-control @error('network') is-invalid @enderror"
                                    id="network" name="network" value="{{ $payment->network ?? 'N/A' }}" readonly>

                                @error('network')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 mb-4 network">
                                <label for="network">Payment Status:</label>
                                <input type="text" class="form-control @error('network') is-invalid @enderror"
                                    id="network" name="network" value="{{ $payment->transaction_status ?? 'N/A' }}"
                                    readonly>

                                @error('network')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            {{-- @if ($payment->reason != null)
                                <label style="color:red;font-size:16px">{{ $payment->reason }}</label>
                            @endif --}}

                        </div>

                        <br>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-scripts')
    <script src="{{ asset('assets/js/general.js?v1=1234') }}"></script>
@endsection
