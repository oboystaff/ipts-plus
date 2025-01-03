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
                            <div class="card-title">View Customer Type Information</div>
                        </div>

                        <div>
                            <a href="{{ route('customer-types.index') }}" class="btn btn-primary btn-sm ms-2">Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <form class="row g-3 needs-validation" method="POST"
                            action="{{ route('customer-types.update', $customerType) }}">
                            @csrf

                            <div class="col-md-6 mb-3">
                                <label for="block_code">Customer Type Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" placeholder="Enter customer type name"
                                    value="{{ $customerType->name }}" readonly>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="status">Status</label>
                                <input type="text" class="form-control @error('status') is-invalid @enderror"
                                    id="status" name="status" placeholder="Enter status"
                                    value="{{ $customerType->status }}" readonly>

                                @error('status')
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
