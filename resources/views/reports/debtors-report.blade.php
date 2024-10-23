@extends('layout.base')

@section('page-styles')
@endsection

@section('page-content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card dz-card" id="accordion-four">
                    <div class="card-header flex-wrap d-flex justify-content-between">
                        <div>
                            <h4 class="card-title">Debtors Report</h4>
                        </div>
                    </div>

                    <input type="hidden" name="debtors-report_url" url="{{ route('debtors-reports.index') }}">

                    <div class="card-body">
                        <div class="basic-form">
                            <div class="row">
                                <div class="mb-4 col-md-6">
                                    <label class="form-label">From Date</label>
                                    <input type="date" name="from_date" class="form-control">
                                </div>

                                <div class="mb-4 col-md-6">
                                    <label class="form-label">To Date</label>
                                    <input type="date" name="to_date" class="form-control">
                                </div>

                                <div id="detail_field">
                                    <div class="row">

                                        <div class="col-md-6 mb-4">
                                            <label class="form-label">Assembly</label>
                                            <select
                                                class="form-control form-select @error('assembly_code') is-invalid @enderror"
                                                name="assembly_code">
                                                <option disabled selected>Select Assembly</option>
                                                @foreach ($assemblies as $assembly)
                                                    <option value="{{ $assembly->assembly_code }}">
                                                        {{ $assembly->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-6 mb-4">
                                            <label class="form-label">Bill Type</label>
                                            <select class="form-control form-select @error('status') is-invalid @enderror"
                                                id="status" name="status">
                                                <option disabled selected>Select Bill Type</option>
                                                <option value="Property">Property Bill</option>
                                                <option value="Business">Business Bill</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-4" style="display:none">
                                    <label class="form-label">Report Type</label>
                                    <select class="form-select @error('report_type') is-invalid @enderror" id="report_type"
                                        name="report_type">
                                        <option value="1">Customer Report</option>
                                        <option value="2">Summary Report</option>
                                    </select>
                                </div>

                                <center>
                                    <div class="mb-4 col-md-12">
                                        <button type="submit" class="btn btn-primary generate_report"
                                            style="width:200px">Generate
                                            Report</button>
                                    </div>
                                </center>
                                <hr />
                            </div>
                        </div>
                    </div>

                    <div class="tab-content" id="myTabContent-3">
                        <div class="tab-pane fade show active" id="withoutBorder" role="tabpanel"
                            aria-labelledby="home-tab-3">
                            <div class="card-body pt-0">
                                <div class="table-responsive">
                                    <div id="details">
                                        <table id="example4" class="display table" style="width: 100%">
                                            <thead>
                                                <tr>
                                                    <th>S/N</th>
                                                    <th>Bill No</th>
                                                    <th>Name</th>
                                                    <th>Bill Date</th>
                                                    <th>Bill Year</th>
                                                    <th>Bill Type</th>
                                                    <th>Arrears</th>
                                                    <th>Current Amount</th>
                                                    <th>Amount Due</th>
                                                    <th>Assembly</th>
                                                    <th>Division</th>
                                                    <th>Block</th>
                                                    <th>Zone</th>
                                                    <th>Property Use</th>
                                                    <th>Created By</th>
                                                    <th>Date Created</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="5"></th>
                                                    <th id="title"></th>
                                                    <th id="total_arrears"></th>
                                                    <th id="total_amount"></th>
                                                    <th id="total_due"></th>
                                                    <th colspan="7"></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>

                                    <div style="display:none" id="summary">
                                        <table id="example5" class="display table" style="width: 100%">
                                            <thead>
                                                <tr>
                                                    <th>S/N</th>
                                                    <th id="header">Name</th>
                                                    <th>Total Customer</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th></th>
                                                    <th id="title"></th>
                                                    <th id="customer_total"></th>
                                                    <th></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-scripts')
    <script src="{{ asset('assets/js/report/debtors-report.js?v1=1234') }}"></script>
@endsection
