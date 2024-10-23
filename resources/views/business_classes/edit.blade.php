@extends('layout.base')

@section('page-styles')
@endsection

@section('page-content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header flex-wrap d-flex justify-content-between">
                        <div>
                            <h4 class="card-title">Edit Business Class</h4>
                        </div>

                        <div>
                            <a href="{{ route('business-classes.index') }}" class="btn btn-primary btn-sm ms-2">Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <form class="row g-3 needs-validation" method="POST"
                            action="{{ route('business-classes.update', $businessClass) }}">
                            @csrf

                            <div class="col-sm-6 mb-3">
                                <label for="business_type_id" class="form-label">Business Type</label>
                                <select class="form-control @error('business_type_id') is-invalid @enderror"
                                    id="business_type_id" name="business_type_id" required>
                                    <option disabled selected>Select Business Type</option>
                                    @foreach ($businessTypes as $businessType)
                                        <option value="{{ $businessType->id }}"
                                            {{ old('business_type_id', $businessClass->business_type_id) == $businessType->id ? 'selected' : '' }}>
                                            {{ $businessType->name }}</option>
                                    @endforeach
                                </select>

                                @error('business_type_id')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="col-sm-6 mb-3">
                                <label for="parent_category" class="form-label">Business Class Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" placeholder="Business Class Name"
                                    value="{{ $businessClass->name }}">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">Update</button>
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
