@extends('layout.base')

@section('page-content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header flex-wrap d-flex justify-content-between">
                        <div class="card-header">
                            <div class="card-title">User Management /Create User</div>
                        </div>

                        <div>
                            <a href="{{ route('users.index') }}" class="btn btn-primary btn-sm ms-2">Back</a>
                        </div>
                    </div>

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
                        <form class="row g-3 needs-validation" method="POST" action="{{ route('users.store') }}">
                            @csrf

                            <div class="mb-4 col-md-6">
                                <label class="form-label">Full Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    placeholder="Full Name" name="name" required>

                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4 col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    placeholder="Email Address" name="email" required>

                                @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4 col-md-6">
                                <label class="form-label">Password</label>
                                <input type="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror" placeholder="Password"
                                    required>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-4 col-md-6">
                                <label class="form-label">Confirm Password</label>
                                <input type="password" name="password_confirmation"
                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                    placeholder="Password confirmation" required>

                                @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-4 col-md-6">
                                <label>Phone</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                    placeholder="Phone Number" name="phone" required>

                                @error('phone')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4 col-md-6">
                                <label>Access Level</label>
                                <select class="form-control @error('access_level') is-invalid @enderror" name="access_level"
                                    id="access_level" required>
                                    <option value="">Select Access Level</option>
                                    @if (\Illuminate\Support\Str::contains(\Auth::user()->access_level, 'Assembly'))
                                        <option value="Assembly_Supervisor">Assembly Supervisor</option>
                                        <option value="Assembly_Agent">Assembly Agent</option>
                                        <option value="customer">Customer</option>
                                    @else
                                        <option value="Melchia_Account_Manager">Melchia Account Manager</option>
                                        <option value="Assembly_Administrator">Assembly Administrator</option>
                                        <option value="Assembly_Supervisor">Assembly Supervisor</option>
                                        <option value="Assembly_Agent">Assembly Agent</option>
                                        <option value="GRA_Administrator">GRA Administrator</option>
                                        <option value="customer">Customer</option>
                                    @endif
                                </select>

                                @error('access_level')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4 col-md-6">
                                <label for="role" class="form-label">Role</label>
                                <select class="form-control @error('role') is-invalid @enderror" id="role"
                                    name="role" required>
                                    <option value="">Select User Role</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>

                                @error('role')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4 col-md-6" id="assembly_code_field" style="display: none;">
                                <label>Assembly</label>
                                <select class="form-control" name="assembly_code">
                                    <option value="">Select Assembly</option>
                                    @foreach ($assemblies as $assembly)
                                        <option value="{{ $assembly->assembly_code }}">{{ $assembly->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-4 col-md-6" id="division_code_field" style="display: none;">
                                <label>Division</label>
                                <select class="form-control" name="division_code">
                                    <option value="">Select Division</option>
                                    @foreach ($divisions as $division)
                                        <option value="{{ $division->division_code }}">{{ $division->division_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-4 col-md-6">
                                <label>Status</label>
                                <select class="form-control" name="status" required>
                                    <option value="Active">Active</option>
                                    <option value="InActive">In Active</option>
                                </select>
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
@endsection
