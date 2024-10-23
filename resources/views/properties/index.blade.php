@extends('layout.base')

@section('page-styles')
@endsection

@section('page-content')
    <div class="container-fluid mh-auto">
        <div class="row">
            <div class="col-xl-12 active-p">

                @if (session()->has('status'))
                    <div class="alert alert-success alert-dismissible fade show">
                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2"
                            fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                            <polyline points="9 11 12 14 22 4"></polyline>
                            <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                        </svg>
                        <strong>{{ session('status') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"><span><i
                                    class="fa-solid fa-xmark"></i></span>
                        </button>
                    </div>
                @endif

                <div class="card">

                    <div class="card-header flex-wrap d-flex justify-content-between">
                        <div>
                            <h4 class="heading mb-0">Customer Properties</h4>
                        </div>

                        <div class="d-flex align-items-center">
                            @can('properties.create')
                                <a href="{{ route('properties.create') }}" class="btn btn-primary btn-sm ms-2">+ Create
                                    Customer Property</a>
                            @endcan
                        </div>
                    </div>

                    <div class="card-body px-0">
                        <div class="table-responsive active-projects user-tbl  dt-filter">
                            <table id="user-tbl" class="table shorting">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Entity Type</th>
                                        <th>Category</th>
                                        <th>Digital Address</th>
                                        <th>Location</th>
                                        <th>Street Name</th>
                                        <th>Rated</th>
                                        <th>Validated</th>
                                        <th>Property Number</th>
                                        <th>Owner Account</th>
                                        <th>Owner Name</th>
                                        <th>Ratable Value</th>
                                        <th>Assembly</th>
                                        <th>Division</th>
                                        <th>Block</th>
                                        <th>Zone</th>
                                        <th>Property Use</th>
                                        <th>Date Created</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($properties as $index => $property)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $property->entityType->name ?? '' }}</td>
                                            <td>{{ $property->entityType->category ?? '' }}</td>
                                            <td>{{ $property->digital_address }}</td>
                                            <td>{{ $property->location }}</td>
                                            <td>{{ $property->street_name }}</td>
                                            <td>{{ $property->rated }}</td>
                                            <td>{{ $property->validated }}</td>
                                            <td>{{ $property->property_number }}</td>
                                            <td>{{ $property->customer->account_number ?? 'N/A' }}</td>
                                            <td>{{ $property->customer->first_name ?? '' }}
                                                {{ $property->customer->last_name ?? 'N/A' }}
                                            </td>
                                            <td>{{ number_format($property->ratable_value, 2) }}</td>
                                            <td>{{ $property->assembly->name ?? 'N/A' }}</td>
                                            <td>{{ $property->division->division_name ?? 'N/A' }}</td>
                                            <td>{{ $property->block->block_name ?? 'N/A' }}</td>
                                            <td>{{ $property->zone->name ?? 'N/A' }}</td>
                                            <td>{{ $property->propertyUse->name ?? 'N/A' }}</td>
                                            <td>{{ $property->created_at }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <div class="btn-link" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M11 12C11 12.5523 11.4477 13 12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12Z"
                                                                stroke="#737B8B" stroke-width="2" stroke-linecap="round"
                                                                stroke-linejoin="round">
                                                            </path>
                                                            <path
                                                                d="M18 12C18 12.5523 18.4477 13 19 13C19.5523 13 20 12.5523 20 12C20 11.4477 19.5523 11 19 11C18.4477 11 18 11.4477 18 12Z"
                                                                stroke="#737B8B" stroke-width="2" stroke-linecap="round"
                                                                stroke-linejoin="round">
                                                            </path>
                                                            <path
                                                                d="M4 12C4 12.5523 4.44772 13 5 13C5.55228 13 6 12.5523 6 12C6 11.4477 5.55228 11 5 11C4.44772 11 4 11.4477 4 12Z"
                                                                stroke="#737B8B" stroke-width="2" stroke-linecap="round"
                                                                stroke-linejoin="round">
                                                            </path>
                                                        </svg>
                                                    </div>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <div class="py-2">
                                                            <a class="dropdown-item"
                                                                href=" {{ route('properties.show', $property) }}">View
                                                            </a>
                                                            <a class="dropdown-item"
                                                                href=" {{ route('properties.edit', $property) }}">Edit
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <th colspan="10"></th>
                                    <th>Total (GHS)</th>
                                    <th>{{ $total }}</th>
                                    <th colspan="7"></th>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-scripts')
    <script>
        $(document).ready(function() {
            $('.view-property-btn').click(function(e) {
                e.preventDefault();
                var propertyId = $(this).data('property-id');
                $.ajax({
                    url: '/properties/' + propertyId,
                    method: 'GET',
                    success: function(response) {
                        // Populate modal with data
                        $('#propertyModal .modal-body').html(`

                        <!-- Add more properties as needed -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="entity_type" class="form-label">Entity Type:</label>
                                    <input type="text" class="form-control" id="entity_type" value="${response.entity_type}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="digital_address" class="form-label">Digital Address:</label>
                                    <input type="text" class="form-control" id="digital_address" value="${response.digital_address}" readonly>
                                </div>
                                <!-- Add more fields as needed -->
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="location" class="form-label">Location:</label>
                                    <input type="text" class="form-control" id="location" value="${response.location}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="street_name" class="form-label">Street Name:</label>
                                    <input type="text" class="form-control" id="street_name" value="${response.street_name}" readonly>
                                </div>
                                <!-- Add more fields as needed -->
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="location" class="form-label">Is This Property Rated?:</label>
                                    <input type="text" class="form-control" id="location" value="${response.rated}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="street_name" class="form-label">Is This Property Validated:</label>
                                    <input type="text" class="form-control" id="street_name" value="${response.validated}" readonly>
                                </div>
                                <!-- Add more fields as needed -->
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="location" class="form-label">Ratable Value:</label>
                                    <input type="text" class="form-control" id="location" value="${response.ratable_value}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="street_name" class="form-label">Property Number  :</label>
                                    <input type="text" class="form-control" id="street_name" value="${response.property_number}" readonly>
                                </div>
                                <!-- Add more fields as needed -->
                            </div>
                        </div>
                         <h5 class="modal-title" >Owners Bio Data</h5>
                         <div class="row">
                        <table id="empoloyees-tbl3" class="table">
                            <thead>
                                <tr>
                                    <th>Owner  ID</th>
                                    <th>Owner Name</th>
                                    <th>Owner Phone</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><span>${response.customer_id}</span></td>
                                    <td>
                                        <div class="products">
                                            <img src="{{ asset('assets/images/arms.png') }}" class="avatar avatar-md" alt="">
                                            <div>
                                                <h6><a href="javascript:void(0)">Ricky Antony</a></h6>
                                                <span>${response.first_name}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td><a href="javascript:void(0)" class="text-primary">${response.customer_phone}</a></td>
                                    <td>
                                        <span>+12 123 456 7890</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    `);
                        // Show modal
                        $('#propertyModal').modal('show');
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Click event handler for the Assign Owner button
            $('.assign-owner-btn').click(function(e) {
                e.preventDefault();
                // Show the modal for assigning owners
                $('#assignOwnerModal').modal('show');
            });

            // AJAX request to search for citizens
            $('#ownerSearch').keyup(function() {
                var query = $(this).val();
                if (query !== '') {
                    $.ajax({
                        url: '/citizens/search',
                        method: 'GET',
                        data: {
                            query: query
                        },
                        success: function(response) {
                            $('#citizenSearchResults').html(response);
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                } else {
                    $('#citizenSearchResults').html('');
                }
            });
        });
    </script>
@endsection
