@extends('layout.base')

@section('page-styles')
@endsection

@section('page-content')
    @php
        $name = '';

        $firstname = $customerSupport->citizen->first_name ?? '';
        $lastname = $customerSupport->citizen->last_name ?? '';
        $name = $firstname . ' ' . $lastname;
    @endphp

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header flex-wrap d-flex justify-content-between">
                        <div>
                            <h4 class="card-title">View Customer Support</h4>
                        </div>

                        <div>
                            <a href="{{ route('customer-supports.index') }}" class="btn btn-primary btn-sm ms-2">Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <form class="row g-3 needs-validation" method="POST"
                            action="{{ route('customer-supports.update', $customerSupport) }}">
                            @csrf

                            <div class="col-md-6 mb-3">
                                <label for="description">Description</label>
                                <input type="text" class="form-control @error('description') is-invalid @enderror"
                                    id="description" placeholder="Enter division code" name="description"
                                    value="{{ $customerSupport->description }}" readonly>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="tax_payer">Tax Payer</label>
                                <input type="text" class="form-control @error('tax_payer') is-invalid @enderror"
                                    id="tax_payer" placeholder="Enter division name" name="tax_payer"
                                    value="{{ $name }}" readonly>

                                @error('tax_payer')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="status">Status</label>
                                <input type="text" class="form-control @error('status') is-invalid @enderror"
                                    id="status" placeholder="Enter status" name="status"
                                    value="{{ $customerSupport->status }}" readonly>

                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="assembly_code">Assembly Code</label>
                                <input type="text" class="form-control @error('assembly_code') is-invalid @enderror"
                                    id="assembly_code" placeholder="Enter division name" name="assembly_code"
                                    value="{{ $customerSupport->assembly->name ?? '' }} ({{ $customerSupport->assembly_code }})"
                                    readonly>

                                @error('assembly_code')
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
@endsection
