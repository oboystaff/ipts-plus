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
            background: rgba(72, 125, 110, 0.5);
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

        <div class="p-xl-12 p-2 z-1 position-relative">
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
                        <!-- Notification button fixed at the bottom left -->

                    </div>

                </div>


            </div>
        </div>




        <div class="col-md-12">
            <div class="inner-profile-card">
                <div class="card-header d-flex justify-content-between align-items-center position-relative">
                    <div class="card-title">
                    </div>

                    <!-- Notification button fixed at the bottom left -->
                    <button type="button" class="btn btn-primary my-1 position-absolute bottom-0 start-0">
                        Last Updated Date: <span class="badge ms-2 bg-secondary">{{ old('name', $user->updated_at) }}</span>
                    </button>

                    <!-- Back button on the right -->
                    <a href="{{ route('users.index') }}" class="btn btn-danger btn-sm ms-2">Back</a>
                </div>


                <div class="card-body">
                    <form class="row g-3 needs-validation" method="POST" action="{{ route('users.update', $user->id) }}">
                        @csrf

                        <!-- First Row -->
                        <div class="mb-3 col-md-4">
                            <label class="form-label">Full Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                placeholder="Enter full name" name="name" value="{{ old('name', $user->name) }}"
                                required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-4">
                            <label class="form-label">Email</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror"
                                placeholder="Enter email" name="email" value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-4">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                placeholder="Enter password" name="password">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Second Row -->
                        <div class="mb-4 col-md-4">
                            <label class="form-label">Confirm Password</label>
                            <input type="password" name="password_confirmation"
                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                placeholder="Password confirmation">
                            @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-4">
                            <label class="form-label">Phone</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                placeholder="Enter phone number" name="phone" value="{{ old('phone', $user->phone) }}"
                                required>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Gender</label>
                            <select class="form-control @error('gender') is-invalid @enderror" id="gender" name="gender"
                                required>
                                <option value="">Select User Gender</option>
                                <option value="Male"
                                    {{ old('gender', $user->gender ?? '') == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female"
                                    {{ old('gender', $user->gender ?? '') == 'Female' ? 'selected' : '' }}>Female</option>
                            </select>

                            @error('gender')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-4">
                            <label class="form-label">Access Level</label>
                            <select class="form-control @error('access_level') is-invalid @enderror" name="access_level"
                                required>
                                <option value="">Select Access Level</option>
                                @if (\Illuminate\Support\Str::contains(\Auth::user()->access_level, 'Assembly'))
                                    <option value="Assembly_Administrator"
                                        {{ old('access_level', $user->access_level) == 'Assembly_Administrator' ? 'selected' : '' }}>
                                        Assembly Administrator
                                    </option>
                                    <option value="Assembly_Supervisor"
                                        {{ old('access_level', $user->access_level) == 'Assembly_Supervisor' ? 'selected' : '' }}>
                                        Assembly Supervisor
                                    </option>
                                    <option value="Assembly_Agent"
                                        {{ old('access_level', $user->access_level) == 'Assembly_Agent' ? 'selected' : '' }}>
                                        Assembly Agent
                                    </option>
                                    <option value="customer"
                                        {{ old('access_level', $user->access_level) == 'customer' ? 'selected' : '' }}>
                                        Customer
                                    </option>
                                @else
                                    <option value="Melchia_Account_Manager"
                                        {{ old('access_level', $user->access_level) == 'Melchia_Account_Manager' ? 'selected' : '' }}>
                                        Melchia Account Manager
                                    </option>
                                    <option value="Assembly_Administrator"
                                        {{ old('access_level', $user->access_level) == 'Assembly_Administrator' ? 'selected' : '' }}>
                                        Assembly Administrator
                                    </option>
                                    <option value="Assembly_Supervisor"
                                        {{ old('access_level', $user->access_level) == 'Assembly_Supervisor' ? 'selected' : '' }}>
                                        Assembly Supervisor
                                    </option>
                                    <option value="Assembly_Agent"
                                        {{ old('access_level', $user->access_level) == 'Assembly_Agent' ? 'selected' : '' }}>
                                        Assembly Agent
                                    </option>
                                    <option value="GRA_Administrator"
                                        {{ old('access_level', $user->access_level) == 'GRA_Administrator' ? 'selected' : '' }}>
                                        GRA Administrator
                                    </option>
                                    <option value="customer"
                                        {{ old('access_level', $user->access_level) == 'customer' ? 'selected' : '' }}>
                                        Customer
                                    </option>
                                @endif
                            </select>

                            @error('access_level')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Third Row -->
                        <div class="mb-3 col-md-4">
                            <label for="role" class="form-label">Role</label>
                            <select class="form-control @error('role') is-invalid @enderror" id="role"
                                name="role">
                                <option value="">Select User Role</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}"
                                        {{ in_array($role->id, $userRole) ? 'selected' : '' }}>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        @if ($user->access_level !== 'customer')
                            <div class="mb-3 col-md-4">
                                <label for="assembly_code" class="form-label">Assembly Code</label>
                                <select class="form-control" name="assembly_code">
                                    <option value="">Select Assembly</option>
                                    @foreach ($assemblies as $assembly)
                                        <option value="{{ $assembly->assembly_code }}"
                                            {{ old('assembly_code', $user->assembly_code) == $assembly->assembly_code ? 'selected' : '' }}>
                                            {{ $assembly->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3 col-md-4">
                                <label for="division_code" class="form-label">Division Code</label>
                                <select class="form-control" name="division_code">
                                    <option value="">Select Division</option>
                                    @foreach ($divisions as $division)
                                        <option value="{{ $division->division_code }}"
                                            {{ old('division_code', $user->division_code) == $division->division_code ? 'selected' : '' }}>
                                            {{ $division->division_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endif

                        <!-- Fourth Row -->
                        <div class="mb-3 col-md-4">
                            <label class="form-label">Status</label>
                            <select class="form-control @error('status') is-invalid @enderror" name="status" required>
                                <option value="Active" {{ old('status', $user->status) == 'Active' ? 'selected' : '' }}>
                                    Active</option>
                                <option value="InActive"
                                    {{ old('status', $user->status) == 'InActive' ? 'selected' : '' }}>In Active</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="col-12">
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
    <!-- Additional scripts or JavaScript libraries -->
@endsection
