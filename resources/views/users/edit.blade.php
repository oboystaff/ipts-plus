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
                        <div>
                            <h4 class="card-title">Edit User</h4>
                        </div>

                        <div>
                            <a href="{{ route('users.index') }}" class="btn btn-primary btn-sm ms-2">Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <form class="row g-3 needs-validation" method="POST"
                            action="{{ route('users.update', $user->id) }}">
                            @csrf

                            <div class="mb-3 col-md-6">
                                <label class="form-label">Full Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    placeholder="Enter full name" name="name" value="{{ old('name', $user->name) }}"
                                    required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    placeholder="Enter email" name="email" value="{{ old('email', $user->email) }}"
                                    required>

                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Enter password" name="password">

                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4 col-md-6">
                                <label class="form-label">Confirm Password</label>
                                <input type="password" name="password_confirmation"
                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                    placeholder="Password confirmation">

                                @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">Phone</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                    placeholder="Enter phone number" name="phone" value="{{ old('phone', $user->phone) }}"
                                    required>

                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">Access Level</label>
                                <select class="form-control @error('access_level') is-invalid @enderror" name="access_level"
                                    required>
                                    <option value="">Select Access Level</option>
                                    <option value="Melchia_Account_Manager"
                                        {{ old('access_level', $user->access_level) == 'Melchia_Account_Manager' ? 'selected' : '' }}>
                                        Melchia Account Manager</option>
                                    <option value="Assembly_Administrator"
                                        {{ old('access_level', $user->access_level) == 'Assembly_Administrator' ? 'selected' : '' }}>
                                        Assembly Administrator</option>
                                    <option value="Assembly_Agent"
                                        {{ old('access_level', $user->access_level) == 'Assembly_Agent' ? 'selected' : '' }}>
                                        Assembly Agent</option>
                                    <option value="Assembly_Agent"
                                        {{ old('access_level', $user->access_level) == 'customer' ? 'selected' : '' }}>
                                        Customer</option>
                                </select>

                                @error('access_level')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
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
                                <div class="mb-3 col-md-6">
                                    <label for="assembly_code" class="form-label">Assembly Code</label>
                                    <select class="form-control" name="assembly_code">
                                        <option value="">Select Assembly</option>
                                        @foreach ($assemblies as $assembly)
                                            <option value="{{ $assembly->assembly_code }}"
                                                {{ old('assembly_code', $user->assembly_code) == $assembly->assembly_code ? 'selected' : '' }}>
                                                {{ $assembly->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="division_code" class="form-label">Division Code</label>
                                    <select class="form-control" name="division_code">
                                        <option value="">Select Division</option>
                                        @foreach ($divisions as $division)
                                            <option value="{{ $division->division_code }}"
                                                {{ old('division_code', $user->division_code) == $division->division_code ? 'selected' : '' }}>
                                                {{ $division->division_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif

                            <div class="mb-3 col-md-6">
                                <label class="form-label">Status</label>
                                <select class="form-control @error('status') is-invalid @enderror" name="status" required>
                                    <option value="Active"
                                        {{ old('status', $user->status) == 'Active' ? 'selected' : '' }}>Active</option>
                                    <option value="InActive"
                                        {{ old('status', $user->status) == 'InActive' ? 'selected' : '' }}>In Active
                                    </option>
                                </select>

                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

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
