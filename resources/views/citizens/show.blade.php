@extends('layout.base')

@section('page-content')
    <div class="container-fluid">
        <!-- row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="profile card card-body px-3 pt-3 pb-0">
                    <div class="profile-head">
                        <div class="photo-content">
                            <div class="cover-photo rounded"></div>
                        </div>
                        <div class="profile-info">
                            <div class="profile-photo">
                                <img src="" class="img-fluid rounded-circle" alt="">
                            </div>
                            <div class="profile-details">
                                <div class="profile-name px-3 pt-2">
                                    <h4 class="text-primary mb-0">{{ $citizen->first_name }} {{ $citizen->last_name }} ,
                                        {{ $citizen->other_name }}</h4>
                                    <p>Full Name </p>
                                </div>
                                <div class="profile-email px-2 pt-2">
                                    <h4 class="text-muted mb-0">{{ $citizen->account_number }}</h4>
                                    <p>Account Number</p>
                                </div>
                                <div class="dropdown ms-auto">
                                    <a href="#" class="btn btn-primary light sharp" data-bs-toggle="dropdown"
                                        aria-expanded="true"><svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px"
                                            viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                <circle fill="#000000" cx="5" cy="12" r="2"></circle>
                                                <circle fill="#000000" cx="12" cy="12" r="2"></circle>
                                                <circle fill="#000000" cx="19" cy="12" r="2"></circle>
                                            </g>
                                        </svg></a>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <a href="{{ route('citizens.index') }}" class="dropdown-item">
                                            <i class="fa fa-user-circle text-primary me-2"></i> Back
                                        </a>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-4">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="profile-statistics">
                                    <div class="text-center">
                                        <div class="row">
                                            <div class="col">
                                                <h3 class="m-b-0">GHS 0.00 </h3><span>Arrears</span>
                                            </div>
                                            <div class="col">
                                                <h3 class="m-b-0">GHS 0.00</h3><span>Current Bill </span>
                                            </div>
                                            <div class="col">
                                                <h3 class="m-b-0">0.0</h3><span>Bills Count</span>
                                            </div>
                                        </div>
                                        <div class="mt-4">
                                            <a href="javascript:void(0);" class="btn btn-primary mb-1"
                                                data-bs-toggle="modal" data-bs-target="#sendMessageModal">Pay Bill</a>
                                            <button class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#replyModal"><span class="me-2"><i
                                                        class="fa fa-reply"></i></span>Re-Generate Bill</button>
                                        </div>
                                    </div>
                                    <!-- Modal -->
                                    <div class="modal fade" id="sendMessageModal">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Initiate Payment</h5>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="comment-form">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="mb-3">
                                                                    <label class="text-black font-w600 form-label">Amount-
                                                                        GHS
                                                                        <span class="required">*</span></label>
                                                                    <input type="text" class="form-control"
                                                                        value=" " name="Amount" placeholder="Amount">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="mb-3">
                                                                    <label class="text-black font-w600 form-label">Mode Of
                                                                        Payment
                                                                        <span class="required">*</span></label>
                                                                    <select name="gender" class="form-select">
                                                                        <option value="Momo">Mobile Money</option>
                                                                        <option value="Card">Card Payment -(VISA / Master
                                                                            Card)</option>
                                                                        <option value="Cash">Cash</option>
                                                                        <option value="Cheque">Cheque Payment</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12">


                                                            </div>
                                                            <div class="col-lg-12">
                                                                <div class="mb-3 mb-0">
                                                                    <input type="submit" value="Pay"
                                                                        class="submit btn btn-primary" name="submit">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="profile-interest">
                                    <h5 class="text-primary d-inline">Avalibale Mode Of Payments</h5>
                                    <div class="row mt-4 sp4" id="lightgallery">
                                        <a data-exthumbimage="{{ asset('assets/images/profile/gmoney.jpeg') }}"
                                            data-src="{{ asset('assets/images/profile/gmoney.jpeg') }}"
                                            class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                                            <img src="{{ asset('assets/images/profile/gmoney.jpeg') }}" alt=""
                                                class="px-1 py-1 img-fluid rounded">
                                        </a>

                                        <a data-exthumbimage="{{ asset('assets/images/profile/cash.webp') }}"
                                            data-src="{{ asset('assets/images/profile/cash.webp') }}"
                                            class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                                            <img src="{{ asset('assets/images/profile/cash.webp') }}" alt=""
                                                class="px-1 py-1 img-fluid rounded">
                                        </a>

                                        <a data-exthumbimage="{{ asset('assets/images/profile/master.jpeg') }}"
                                            data-src="{{ asset('assets/images/profile/master.jpeg') }}"
                                            class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                                            <img src="{{ asset('assets/images/profile/master.jpeg') }}" alt=""
                                                class="px-1 py-1 img-fluid rounded">
                                        </a>
                                        <a data-exthumbimage="{{ asset('assets/images/profile/momon.jpeg') }}"
                                            data-src="images/profile/momon.jpeg') }}"
                                            class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                                            <img src="{{ asset('assets/images/profile/momon.jpeg') }}" alt=""
                                                class="px-1 py-1 img-fluid rounded">
                                        </a>
                                        <a data-exthumbimage="{{ asset('assets/images/profile/visa.png') }}"
                                            data-src="{{ asset('assets/images/profile/visa.png') }}"
                                            class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                                            <img src="{{ asset('assets/images/profile/visa.png') }}" alt=""
                                                class="px-1 py-1 img-fluid rounded">
                                        </a>
                                        <a data-exthumbimage="{{ asset('assets/images/profile/Hubtel.jpeg') }}"
                                            data-src="{{ asset('assets/images/profile/Hubtel.jpeg') }}"
                                            class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                                            <img src="{{ asset('assets/images/profile/Hubtel.jpeg') }}" alt=""
                                                class="px-1 py-1 img-fluid rounded">
                                        </a>
                                        <a data-exthumbimage="{{ asset('assets/images/profile/cash.webp') }}"
                                            data-src="{{ asset('assets/images/profile/cash.webp') }}"
                                            class="mb-1 col-lg-4 col-xl-4 col-sm-4 col-6">
                                            <img src="i{{ asset('assets/mages/profile/cash.webp') }}" alt=""
                                                class="px-1 py-1 img-fluid rounded">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-xl-8">
                <div class="card h-auto">
                    <div class="card-body">
                        <div class="profile-tab">
                            <div class="custom-tab-1">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item"><a href="#my-posts" data-bs-toggle="tab"
                                            class="nav-link active show">Personal Information</a>
                                    </li>
                                    <li class="nav-item"><a href="#about-me" data-bs-toggle="tab" class="nav-link">Bills
                                            History
                                        </a>
                                    </li>
                                    <li class="nav-item"><a href="#profile-settings" data-bs-toggle="tab"
                                            class="nav-link">Payments History</a>
                                    </li>
                                </ul>
                                <div class="tab-content">

                                    <div id="my-posts" class="tab-pane fade active show">
                                        <div class="my-post-content pt-3">
                                            <div class="post-input">

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="first_name">First Name</label>
                                                            <input type="text" class="form-control" id="first_name"
                                                                name="first_name" value="{{ $citizen->first_name }}"
                                                                readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="last_name">Last Name</label>
                                                            <input type="text" class="form-control" id="last_name"
                                                                name="last_name" value="{{ $citizen->last_name }}"
                                                                readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="other_name">Other Name</label>
                                                            <input type="text" class="form-control" id="other_name"
                                                                name="other_name"
                                                                value="{{ $citizen->other_name ?? 'N/A' }}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="gender">Gender</label>
                                                            <input type="text" class="form-control" id="gender"
                                                                name="gender" value="{{ $citizen->gender }}" readonly>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="date_of_birth">Date of Birth</label>
                                                            <input type="text" class="form-control" id="date_of_birth"
                                                                name="date_of_birth"
                                                                value="{{ $citizen->date_of_birth }}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="marital_status">Marital Status</label>
                                                            <input type="text" class="form-control"
                                                                id="marital_status" name="marital_status"
                                                                value="{{ $citizen->marital_status }}" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="nia_number">NIA Number</label>
                                                            <input type="text" class="form-control" id="nia_number"
                                                                name="nia_number" value="{{ $citizen->nia_number }}"
                                                                readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="account_number">Account Number</label>
                                                            <input type="text" class="form-control"
                                                                id="account_number" name="account_number"
                                                                value="{{ $citizen->account_number }}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="account_number">Customer Type</label>
                                                            <input type="text" class="form-control" id="customer_type"
                                                                name="customer_type"
                                                                value="{{ $citizen->customerType->name ?? 'N/A' }}"
                                                                readonly>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="about-me" class="tab-pane fade">
                                        <div class="table-responsive active-projects">
                                            <div class="tbl-caption">
                                                <h4 class="heading mb-0">Bill Generation History</h4>
                                            </div>
                                            <table id="empoloyees-tbl3" class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Marketplaces</th>
                                                        <th>Date</th>
                                                        <th>Payouts</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Marketing Revenue</td>
                                                        <td>Jan 12, 2023</td>
                                                        <td>$5659.68</td>
                                                        <td><span class="badge badge-success border-0">Completed</span>
                                                        </td>
                                                        <td class="edit-action">
                                                            <div class="icon-box icon-box-xs bg-primary me-1">
                                                                <i class="fa-solid fa-pencil text-white"></i>
                                                            </div>
                                                            <div class="icon-box icon-box-xs bg-danger  ms-1">
                                                                <i class="fa-solid fa-trash text-white"></i>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Edward Market</td>
                                                        <td>Feb 14, 2022</td>
                                                        <td>$3586.68</td>
                                                        <td><span class="badge badge-danger border-0">Pending</span></td>
                                                        <td class="edit-action">
                                                            <div class="icon-box icon-box-xs bg-primary me-1">
                                                                <i class="fa-solid fa-pencil text-white"></i>
                                                            </div>
                                                            <div class="icon-box icon-box-xs bg-danger  ms-1">
                                                                <i class="fa-solid fa-trash text-white"></i>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>David Market</td>
                                                        <td>Mar 16, 2022</td>
                                                        <td>$4528.68</td>
                                                        <td><span class="badge badge-info border-0">Completed</span></td>
                                                        <td class="edit-action">
                                                            <div class="icon-box icon-box-xs bg-primary me-1">
                                                                <i class="fa-solid fa-pencil text-white"></i>
                                                            </div>
                                                            <div class="icon-box icon-box-xs bg-danger  ms-1">
                                                                <i class="fa-solid fa-trash text-white"></i>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Brian Market</td>
                                                        <td>April 18, 2022</td>
                                                        <td>$4528.68</td>
                                                        <td><span class="badge badge-info border-0">Completed</span></td>
                                                        <td class="edit-action">
                                                            <div class="icon-box icon-box-xs bg-primary me-1">
                                                                <i class="fa-solid fa-pencil text-white"></i>
                                                            </div>
                                                            <div class="icon-box icon-box-xs bg-danger  ms-1">
                                                                <i class="fa-solid fa-trash text-white"></i>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Edward Market</td>
                                                        <td>May 25, 2022</td>
                                                        <td>$2128.68</td>
                                                        <td><span class="badge badge-primary border-0">Inprogress</span>
                                                        </td>
                                                        <td class="edit-action">
                                                            <div class="icon-box icon-box-xs bg-primary me-1">
                                                                <i class="fa-solid fa-pencil text-white"></i>
                                                            </div>
                                                            <div class="icon-box icon-box-xs bg-danger  ms-1">
                                                                <i class="fa-solid fa-trash text-white"></i>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Donald Revenue</td>
                                                        <td>June 30, 2022</td>
                                                        <td>$1269.53</td>
                                                        <td><span class="badge badge-primary border-0">Inprogress</span>
                                                        </td>
                                                        <td class="edit-action">
                                                            <div class="icon-box icon-box-xs bg-primary me-1">
                                                                <i class="fa-solid fa-pencil text-white"></i>
                                                            </div>
                                                            <div class="icon-box icon-box-xs bg-danger  ms-1">
                                                                <i class="fa-solid fa-trash text-white"></i>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div id="profile-settings" class="tab-pane fade">
                                        <div class="pt-3">
                                            <div class="settings-form">
                                                <div class="table-responsive active-projects">
                                                    <div class="tbl-caption">
                                                        <h4 class="heading mb-0">Payment History</h4>
                                                    </div>
                                                    <table id="empoloyees-tbl3" class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>Marketplaces</th>
                                                                <th>Date</th>
                                                                <th>Payouts</th>
                                                                <th>Status</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>Marketing Revenue</td>
                                                                <td>Jan 12, 2023</td>
                                                                <td>$5659.68</td>
                                                                <td><span
                                                                        class="badge badge-success border-0">Completed</span>
                                                                </td>
                                                                <td class="edit-action">
                                                                    <div class="icon-box icon-box-xs bg-primary me-1">
                                                                        <i class="fa-solid fa-pencil text-white"></i>
                                                                    </div>
                                                                    <div class="icon-box icon-box-xs bg-danger  ms-1">
                                                                        <i class="fa-solid fa-trash text-white"></i>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Edward Market</td>
                                                                <td>Feb 14, 2022</td>
                                                                <td>$3586.68</td>
                                                                <td><span
                                                                        class="badge badge-danger border-0">Pending</span>
                                                                </td>
                                                                <td class="edit-action">
                                                                    <div class="icon-box icon-box-xs bg-primary me-1">
                                                                        <i class="fa-solid fa-pencil text-white"></i>
                                                                    </div>
                                                                    <div class="icon-box icon-box-xs bg-danger  ms-1">
                                                                        <i class="fa-solid fa-trash text-white"></i>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>David Market</td>
                                                                <td>Mar 16, 2022</td>
                                                                <td>$4528.68</td>
                                                                <td><span
                                                                        class="badge badge-info border-0">Completed</span>
                                                                </td>
                                                                <td class="edit-action">
                                                                    <div class="icon-box icon-box-xs bg-primary me-1">
                                                                        <i class="fa-solid fa-pencil text-white"></i>
                                                                    </div>
                                                                    <div class="icon-box icon-box-xs bg-danger  ms-1">
                                                                        <i class="fa-solid fa-trash text-white"></i>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Brian Market</td>
                                                                <td>April 18, 2022</td>
                                                                <td>$4528.68</td>
                                                                <td><span
                                                                        class="badge badge-info border-0">Completed</span>
                                                                </td>
                                                                <td class="edit-action">
                                                                    <div class="icon-box icon-box-xs bg-primary me-1">
                                                                        <i class="fa-solid fa-pencil text-white"></i>
                                                                    </div>
                                                                    <div class="icon-box icon-box-xs bg-danger  ms-1">
                                                                        <i class="fa-solid fa-trash text-white"></i>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Edward Market</td>
                                                                <td>May 25, 2022</td>
                                                                <td>$2128.68</td>
                                                                <td><span
                                                                        class="badge badge-primary border-0">Inprogress</span>
                                                                </td>
                                                                <td class="edit-action">
                                                                    <div class="icon-box icon-box-xs bg-primary me-1">
                                                                        <i class="fa-solid fa-pencil text-white"></i>
                                                                    </div>
                                                                    <div class="icon-box icon-box-xs bg-danger  ms-1">
                                                                        <i class="fa-solid fa-trash text-white"></i>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Donald Revenue</td>
                                                                <td>June 30, 2022</td>
                                                                <td>$1269.53</td>
                                                                <td><span
                                                                        class="badge badge-primary border-0">Inprogress</span>
                                                                </td>
                                                                <td class="edit-action">
                                                                    <div class="icon-box icon-box-xs bg-primary me-1">
                                                                        <i class="fa-solid fa-pencil text-white"></i>
                                                                    </div>
                                                                    <div class="icon-box icon-box-xs bg-danger  ms-1">
                                                                        <i class="fa-solid fa-trash text-white"></i>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="replyModal">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Post Reply</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form>
                                                <textarea class="form-control h-50" rows="4">Message</textarea>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger light"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Reply</button>
                                        </div>
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
