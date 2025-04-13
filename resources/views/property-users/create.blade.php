@extends('layout.base')

@section('page-styles')
@endsection

@section('page-content')
    <div class="container-fluid">
        <div class="card">
            <!-- HEADER SECTION -->
            <div class="card-body border-bottom pb-3">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <div>
                        <h4 class="fw-bold text-primary mb-1">
                            <i class="ri-home-gear-line"></i> Use Type Settings
                        </h4>

                        <p class="mb-0 text-muted fs-14">
                            You are viewing A Property Use Type Record from your
                            central database repository.
                        </p>
                    </div>
                    @can('property-uses.create')
                        <a href="{{ route('property-users.index') }}" class="btn btn-sm btn-primary">
                            <i class="ri-arrow-go-back-line"></i> Back
                        </a>
                    @endcan
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">



                    <form class="row g-3 needs-validation" method="POST" action="{{ route('property-users.store') }}">
                        @csrf

                        <!-- Property Use Name -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Property Use Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" placeholder="Enter property use name" required>
                                @error('name')
                                    <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Zone Dropdown -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="zone_id" class="form-label">Zone</label>
                                <select class="form-control @error('zone_id') is-invalid @enderror" id="zone_id"
                                    name="zone_id" required>
                                    <option disabled selected>Select Zone</option>
                                    @foreach ($zones as $zone)
                                        <option value="{{ $zone->id }}">{{ $zone->name }}</option>
                                    @endforeach
                                </select>
                                @error('zone_id')
                                    <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="col-12 text-end">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>



                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-scripts')
@endsection
