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
                                    <i class="ri-shield-user-line me-2"></i> View Role
                                </h4>
                                <p class="mb-0 text-muted fs-14">
                                    Details of the selected role are shown below.
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
                        <form>
                            <div class="mb-4 col-md-12">
                                <label for="name" class="form-label">Role Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ $role->name }}" readonly>
                            </div>
                        </form>
                    </div>
                </div>
            </div> <!-- card -->
        </div>
    </div>
    </div>
@endsection
