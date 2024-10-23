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
                            <h4 class="card-title">View Business Type</h4>
                        </div>

                        <div>
                            <a href="{{ route('business-types.index') }}" class="btn btn-primary btn-sm ms-2">Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <form class="row g-3 needs-validation" method="POST"
                            action="{{ route('business-types.update', $businessType) }}">
                            @csrf

                            <div class="col-sm-6 mb-3">
                                <label for="class_name" class="form-label"> Class Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" placeholder="Class Name" value="{{ $businessType->name }}"
                                    readonly>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="col-sm-6 mb-3">
                                <label for="parent_category" class="form-label"> Category</label>
                                <input type="text" class="form-control @error('parent_category') is-invalid @enderror"
                                    id="parent_category" name="parent_category" placeholder="Parent category"
                                    value="{{ $businessType->parent_category }}" readonly>

                                @error('parent_category')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="col-sm-6 mb-3">
                                <label for="sub_categories" class="form-label">Sub Categories</label>
                                <input type="text" class="form-control @error('sub_categories') is-invalid @enderror"
                                    id="sub_categories" name="sub_categories" placeholder="Enter Sub_categories"
                                    value="{{ $subCategoriesString }}" readonly>

                                @error('sub_categories')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="col-sm-6 mb-3">
                                <label for="class_rate" class="form-label"> Rate - GHS </label>
                                <input type="text" class="form-control @error('rate') is-invalid @enderror"
                                    id="rate" name="rate" placeholder="Enter Rate" value="{{ $businessType->rate }}"
                                    readonly>

                                @error('rate')
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
