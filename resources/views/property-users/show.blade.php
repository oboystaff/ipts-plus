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
                            <h4 class="card-title">View Property Use</h4>
                        </div>

                        <div>
                            <a href="{{ route('property-users.index') }}" class="btn btn-primary btn-sm ms-2">Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <form class="row g-3 needs-validation" method="POST"
                            action="{{ route('property-users.update', $propertyUser) }}">
                            @csrf


                            <div class="col-md-6 mb-3">
                                <label for="block_code">Property Use Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" placeholder="Property use name"
                                    value="{{ $propertyUser->name }}" readonly>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="col-sm-6 mb-3">
                                <label for="zone_id" class="form-label">Zone</label>
                                <input type="text" class="form-control @error('zone_id') is-invalid @enderror"
                                    id="zone_id" name="zone_id" placeholder="Property use zone_id"
                                    value="{{ $propertyUser->zone->name ?? '' }}" readonly>

                                @error('zone_id')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                {{-- <button type="submit" class="btn btn-primary">Update</button> --}}
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
