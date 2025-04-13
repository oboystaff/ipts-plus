@extends('layout.base')

@section('page-content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 active-p">
                <div class="card">

                    <!-- HEADER SECTION -->
                    <div class="card-body border-bottom pb-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div>
                                <h4 class="fw-bold text-primary mb-1">
                                    <i class="ri-shield-user-line me-2"></i> Edit Role
                                </h4>
                                <p class="mb-0 text-muted fs-14">
                                    Modify the details of an existing system role.
                                </p>
                            </div>

                            <a href="{{ route('roles.index') }}" class="btn btn-sm btn-outline-primary">
                                <i class="fa fa-arrow-left me-1"></i> Back to Roles
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <!-- FORM SECTION -->
                    <div class="card-body">
                        <form method="POST" action="{{ route('roles.update', $role) }}">
                            @csrf
                            @method('PUT') <!-- Required for Laravel resource updates -->

                            <div class="mb-4 col-md-12">
                                <label for="name" class="form-label">Role Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name', $role->name) }}"
                                    placeholder="Enter Role Name" required>

                                @error('name')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-save me-1"></i> Update Role
                            </button>
                        </form>
                    </div>
                </div>
            </div> <!-- card -->
        </div>
    </div>
    </div>
@endsection
