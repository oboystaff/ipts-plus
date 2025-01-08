@extends('layout.base')

@section('page-styles')
    <style>
        /* Adjust the profile card size */
        .profile-card {
            width: 50%;
            height: auto;
            margin: 20px auto;
            background-color: #f0f0f0;
            border-radius: 15px;
            overflow: hidden;
        }

        .main-profile-cover {
            background-color: #d3d3d3;
            padding: 40px 20px;
            border-radius: 15px 15px 0 0;
        }

        .text-fixed-white {
            color: white;
        }

        .bg-black-transparent {
            background: rgba(0, 0, 0, 0.5);
        }

        .profile-info {
            margin-top: -20px;
        }

        .user-img {
            width: 80px;
            height: 80px;
            object-fit: cover;
        }

        .user-info {
            padding-left: 15px;
            text-align: left;
        }

        .user-info p {
            margin-bottom: 5px;
        }

        .user-stats .stat-box {
            text-align: center;
            padding: 10px;
        }

        .user-stats .stat-box i {
            font-size: 25px;
            padding: 8px;
            background-color: #f0f1f6;
            border-radius: 50%;
        }

        .user-stats .stat-box p {
            margin-bottom: 0;
        }

        /* Styling for the inner profile card */
        .inner-profile-card {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #f8f9fa;
            border-bottom: 2px solid #e9ecef;
            border-radius: 10px 10px 0 0;
            padding: 10px;
        }

        .card-body {
            padding: 20px;
        }

        .form-label {
            font-weight: 500;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .user-stats {
            margin-top: 10px;
        }
    </style>
@endsection

@section('page-content')
    <div class="container-fluid">

        <div class="p-xl-12 p-2 z-1">
            <div class="p-4 bg-black-transparent rounded-3 border border-opacity-10 border-white">
                <div class="d-flex gap-3 align-items-center flex-wrap">
                    <div>
                        <img src="{{ asset('assets/images/profileuser.png') }}" alt=""
                            class="img-fluid rounded-circle p-2 bg-success bg-opacity-25 shadow user-img">
                    </div>
                    <div class="user-info">
                        <h4 class="text-fixed-white mb-1" style="font-size: 1rem;">Full Name: {{ $user->name }}
                        </h4>
                        <p class="mb-1 op-6 fs-12" style="font-size: 0.875rem;"><i
                                class="ri-mail-fill lh-1 align-middle me-2 d-inline-block"></i>E-Mail:{{ $user->email }}
                        </p>

                    </div>

                    <div class="ms-auto align-self-end pb-2 user-stats d-flex gap-3">
                        <!-- Access Level -->
                        <div class="stat-box text-center">
                            <p class="mb-0 op-7 fs-14">Access Level</p>
                            <button class="btn btn-teal-light btn-border-down">{{ $user->access_level }}</button>
                        </div>

                        <!-- Role -->
                        <div class="stat-box text-center">
                            <p class="mb-0 op-7 fs-14">Role</p>
                            <button
                                class="btn btn-secondary-light btn-border-start">{{ $user->roleName->name ?? 'N/A' }}</button>
                        </div>

                        <!-- Status -->
                        <div class="stat-box text-center">
                            <p class="mb-0 op-7 fs-14">Status</p>
                            <button class="btn btn-purple-light btn-border-end">{{ $user->status }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-12">
            <div class="inner-profile-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="card-title">User Management /You Are Viewing Information for {{ $user->name }}</div>
                    <a href="{{ route('users.index') }}" class="btn btn-danger btn-sm ms-2">Back</a>
                </div>

                <div class="card-body">
                    <div class="row g-3 needs-validation">
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Phone</label>
                            <input type="text" class="form-control" value="{{ $user->phone }}" readonly>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label class="form-label">Date Of Joining</label>
                            <div class="d-flex align-items-center">
                                <input type="text" class="form-control" value="{{ $user->created_at->format('Y-m-d') }}"
                                    readonly>
                                <span class="text-secondary ms-2">{{ $user->created_at->diffForHumans() }}</span>
                            </div>

                        </div>

                        <div class="mb-3 col-md-6">
                            <label class="form-label">Gender</label>
                            <input type="text" class="form-control"
                                value="{{ !empty($user->gender) ? $user->gender : 'N/A' }}" readonly>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label class="form-label">Assembly Code</label>
                            <input type="text" class="form-control"
                                value="{{ $user->assembly->assembly_code ?? 'N/A' }}" readonly>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label class="form-label">Division Code</label>
                            <input type="text" class="form-control"
                                value="{{ $user->division->division_name ?? 'N/A' }}" readonly>
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
