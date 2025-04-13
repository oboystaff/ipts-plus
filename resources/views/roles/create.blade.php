@extends('layout.base')

@section('page-content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 active-p">
                <div class="card">
                    <!-- HEADER BLOCK -->
                    <div class="card-body border-bottom pb-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div>
                                <h4 class="fw-bold text-primary mb-1">
                                    <i class="ri-shield-user-line me-2"></i> Create New Role
                                </h4>
                                <p class="mb-0 text-muted fs-14">
                                    Define a new system role and assign access permissions accordingly.
                                </p>
                            </div>

                            <a href="{{ route('roles.index') }}" class="btn btn-sm btn-outline-primary">
                                <i class="fa fa-arrow-left me-1"></i> Back to Roles
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <!-- FORM BODY -->
                    <div class="card-body">
                        <form class="row g-3 needs-validation" method="POST" action="{{ route('roles.store') }}">
                            @csrf

                            <!-- Role Name -->
                            <div class="mb-4 col-md-12">
                                <label class="form-label">Role Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    placeholder="Enter Role Name" name="name" required>

                                @error('name')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-save me-1"></i> Save Role
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div> <!-- card -->
        </div>
    </div>
    </div>
@endsection
