@extends('layout.base')

@section('page-content')
    <div class="col-xxl-12">
        <div class="card">
            <div class="card-body border-bottom pb-3">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <div>
                        <h4 class="fw-bold text-primary mb-1">
                            <i class="ri-shield-user-line me-2"></i> User Management
                        </h4>
                        <p class="mb-0 text-muted fs-14">
                            Easily Add Users In One Section.
                        </p>
                    </div>

                    @can('users.create')
                        <a href="{{ route('users.index') }}" class="btn btn-primary">
                            <i class="ri-arrow-go-back-line"></i> Back
                        </a>
                    @endcan
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">


                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card-body">
                    <form id="userForm" class="row g-3 needs-validation" method="POST" action="{{ route('users.store') }}"
                        novalidate>
                        @csrf

                        <input type="hidden" name="assembly_url" url="{{ route('assembly.fetch') }}">

                        <!-- Form Fields -->
                        <div class="col-md-4">
                            <label class="form-label">Full Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                placeholder="Full Name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                placeholder="Email Address" name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Password</label>
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror" placeholder="Password"
                                required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Confirm Password</label>
                            <input type="password" name="password_confirmation"
                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                placeholder="Password confirmation" required>
                            @error('password_confirmation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Phone</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                placeholder="Phone Number" name="phone" value="{{ old('phone') }}" required>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Gender</label>
                            <select class="form-control @error('gender') is-invalid @enderror" id="gender" name="gender"
                                required>
                                <option value="">Select User Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>

                            @error('gender')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Access Level</label>
                            <select class="form-control @error('access_level') is-invalid @enderror" name="access_level"
                                id="access_level" required>
                                <option value="">Select Access Level</option>
                                @if (\Illuminate\Support\Str::contains(\Auth::user()->access_level, 'Assembly'))
                                    <option value="Assembly_Supervisor">Assembly Supervisor</option>
                                    <option value="Assembly_Agent">Assembly Agent</option>
                                @else
                                    <option value="Super_User">Super User</option>
                                    <option value="Assembly_Administrator">Assembly Administrator</option>
                                    <option value="Assembly_Supervisor">Assembly Supervisor</option>
                                    <option value="Assembly_Agent">Assembly Agent</option>
                                    <option value="GOG_Administrator">GOG Administrator</option>
                                @endif
                            </select>
                            @error('access_level')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="role" class="form-label">Role</label>
                            <select class="form-control @error('role') is-invalid @enderror" id="role" name="role"
                                required>
                                <option value="">Select User Role</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}" {{ old('role') == $role->id ? 'selected' : '' }}>
                                        {{ $role->name }}</option>
                                @endforeach
                            </select>

                            @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Region</label>
                            <select class="form-control" name="regional_code">
                                <option disabled selected>Select Region</option>
                                @foreach ($regions as $region)
                                    <option value="{{ $region->regional_code }}"
                                        {{ old('regional_code') == $region->regional_code ? 'selected' : '' }}>
                                        {{ $region->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Assembly</label>
                            <select class="form-control" name="assembly_code">
                                <option disabled selected>Select Assembly</option>

                            </select>
                        </div>

                        <div class="col-md-4" id="division_code_field" style="display: none;">
                            <label class="form-label">Division</label>
                            <select class="form-control" name="division_code">
                                <option value="">Select Division</option>
                                @foreach ($divisions as $division)
                                    <option value="{{ $division->division_code }}"
                                        {{ old('division_code') == $division->division_code ? 'selected' : '' }}>
                                        {{ $division->division_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Status</label>
                            <select class="form-control" name="status" required>
                                <option value="Active" {{ old('status') == 'Active' ? 'selected' : '' }}>Active</option>
                                <option value="InActive" {{ old('status') == 'InActive' ? 'selected' : '' }}>In Active
                                </option>
                            </select>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Save User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-scripts')
    <script src="{{ asset('assets/js/user.js?v=' . time()) }}"></script>

    <script>
        document.getElementById('access_level').addEventListener('change', function() {
            var assemblyField = document.getElementById('assembly_code_field');
            var divisionField = document.getElementById('division_code_field');
            if (this.value == 'Assembly_Administrator') {
                assemblyField.style.display = 'block';
                divisionField.style.display = 'none';
            } else if (this.value == 'Assembly_Agent' || this.value == 'Assembly_Supervisor') {
                assemblyField.style.display = 'block';
                divisionField.style.display = 'block';
            } else {
                assemblyField.style.display = 'none';
                divisionField.style.display = 'none';
            }
        });
    </script>

    <script>
        let startTime = new Date().getTime();

        function formatTime(seconds) {
            let hours = Math.floor(seconds / 3600);
            let minutes = Math.floor((seconds % 3600) / 60);
            let sec = seconds % 60;

            return `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(sec).padStart(2, '0')}`;
        }

        function updateTimeSpent() {
            let currentTime = new Date().getTime();
            let elapsedTime = Math.floor((currentTime - startTime) / 1000);
            document.getElementById('timeSpent').textContent = formatTime(elapsedTime);
        }

        setInterval(updateTimeSpent, 1000);
    </script>
@endsection
