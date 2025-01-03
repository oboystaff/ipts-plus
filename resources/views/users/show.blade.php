@extends('layout.base')

@section('page-styles')
    <!-- Additional stylesheets or CSS -->
@endsection

@section('page-content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header flex-wrap d-flex justify-content-between">
                        <div class="card-header">
                            <div class="card-title">User Management / View User</div>
                        </div>

                        <div>
                            <a href="{{ route('users.index') }}" class="btn btn-primary btn-sm ms-2">Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row g-3 needs-validation">
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Full Name</label>
                                <input type="text" class="form-control" value="{{ $user->name }}" readonly>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" value="{{ $user->email }}" readonly>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">Phone</label>
                                <input type="text" class="form-control" value="{{ $user->phone }}" readonly>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">Access Level</label>
                                <input type="text" class="form-control" value="{{ $user->access_level }}" readonly>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">Role</label>
                                <input type="text" class="form-control" value="{{ $user->roleName->name ?? 'N/A' }}"
                                    readonly>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">Status</label>
                                <input type="text" class="form-control" value="{{ $user->status }}" readonly>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">Date Of Joining</label>
                                <input type="text" class="form-control" value="{{ $user->created_at->format('Y-m-d') }}"
                                    readonly>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">Assembly Code</label>
                                <input type="text" class="form-control" value="{{ $user->assembly_code }}" readonly>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">Division Code</label>
                                <input type="text" class="form-control" value="{{ $user->division_code }}" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-scripts')
    <!-- Additional scripts or JavaScript libraries -->
@endsection
