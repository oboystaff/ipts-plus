@extends('layout.base')

@section('page-content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header flex-wrap d-flex justify-content-between">
                        <div>
                            <h4 class="card-title">View Assembly</h4>
                        </div>

                        <div>
                            <a href="{{ route('assembly.index') }}" class="btn btn-primary btn-sm ms-2">Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <form class="row g-3 needs-validation" action="{{ route('assembly.update', $assembly->id) }}"
                            method="POST">
                            @csrf

                            <div class="col-md-6 mb-3">
                                <label for="name">Assembly Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ $assembly->name }}" readonly>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="assembly_code">Assembly Code</label>
                                <input type="text" class="form-control" id="assembly_code" name="assembly_code"
                                    value="{{ $assembly->assembly_code }}" readonly>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="regional_code">Regional Code</label>
                                <input type="text" class="form-control" id="regional_code" name="regional_code"
                                    value="{{ $assembly->regional_code }}" readonly>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="geo_reference_area">Geo Reference Area</label>
                                <input type="text" class="form-control" id="geo_reference_area" name="geo_reference_area"
                                    value="{{ $assembly->geo_reference_area }}" readonly>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="status">Status</label>
                                <input type="text" class="form-control" id="status" name="status"
                                    value="{{ $assembly->status }}" readonly>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="supervisor">Supervisor</label>
                                <input type="text" class="form-control" id="supervisor" name="supervisor"
                                    value="{{ $assembly->assemblySupervisor->name ?? '' }}" readonly>
                            </div>


                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        @if (isset($assembly->logo))
                                            <label>Assembly Logo</label>
                                            <img src="{{ asset('storage/images/logo/' . $assembly->logo) }}" width="300"
                                                height="340" style="border-radius: 10px;">
                                        @else
                                            <h4 style="color:red">No logo uploaded for the selected assembly</h4>
                                        @endif
                                    </div>

                                    <div class="col-md-6">
                                        @if (isset($assembly->invoice_layout))
                                            <label>Assembly Invoice Template</label>
                                            <img src="{{ asset('assets/images/template/' . $assembly->invoice_layout) }}"
                                                width="300" height="340" style="border-radius: 10px;">
                                        @else
                                            <h4 style="color:red">No template uploaded for the selected assembly</h4>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
