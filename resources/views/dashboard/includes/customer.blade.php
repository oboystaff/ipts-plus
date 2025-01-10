<div class="row">
    <div class="col-xxl-12 col-xl-12 col-lg-12">
        <div class="card custom-card overflow-hidden nft-main-card">
            <div class="card-body">
                <div class="row gap-3 gap-sm-0 mx-0 py-3 rounded-3">
                    <div class="col-xxl-12 col-xl-12 col-lg-12 col-12">
                        <div class="p-2">
                            @php
                                $hour = date('H');
                                if ($hour < 12) {
                                    $greeting = 'Good Morning';
                                } elseif ($hour < 18) {
                                    $greeting = 'Good Afternoon';
                                } else {
                                    $greeting = 'Good Evening';
                                }
                            @endphp
                            <h6 class="fw-semibold mb-3 op-9 text-fixed-white"> {{ $greeting }},
                                {{ Auth::user()->name }} &#128075;</h6>
                            {{-- <h4 class="fw-semibold mb-2  text-fixed-white">Paying your property rates helps
                                            drive <span class="text-secondary">National development!</span> </h4> --}}
                            <div class="message-container">
                                <h4 class="fw-semibold mb-2 text-fixed-white">
                                    <span id="message"></span>
                                    <span class="cursor"></span>
                                </h4>
                            </div>

                            <style>
                                .message-container {
                                    font-family: Arial, sans-serif;
                                    font-size: 1.5rem;
                                    white-space: nowrap;
                                    overflow: hidden;
                                    display: inline-block;
                                    border-right: 3px solid #ccc;
                                    /* Blinking cursor effect */
                                    width: fit-content;
                                    animation: blinkCursor 0.6s step-end infinite;
                                }

                                @keyframes blinkCursor {
                                    50% {
                                        border-color: transparent;
                                    }
                                }
                            </style>
                            <p class="mb-4 text-fixed-white op-7 fs-12">...
                            </p>
                            <div class="d-flex gap-2 flex-wrap">
                                <button class="btn btn-success btn-wave waves-effect waves-light">
                                    View My Bills</button>
                                <button class="btn btn-secondary btn-wave waves-effect waves-light">
                                    Check Payment History</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Start:: Row-3 -->
    <div class="row">

        <div class="col-xxl-12 col-xl-12">
            <div class="row">
                <div class="col-xl-6">
                    <div class="custom-card card">
                        <div class="card-body p-0">
                            <div class="text-end mb-3 p-3">
                                <div class="avatar avatar-lg bg-secondary bg-opacity-25 avatar-rounded mb-3">
                                    <div class="avatar avatar-md bg-secondary text-fixed-white avatar-rounded">
                                        <i class="ri-bar-chart-box-line fs-18"></i>
                                    </div>
                                </div>
                                <div>
                                    <h4 class="fw-semibold mb-1">GHS {{ $customerData['totalBillP'] }}</h4>
                                    <span class="badge bg-success-transparent rounded-pill me-2">0.25%<i
                                            class="ti ti-arrow-up"></i></span>
                                    <div class="text-muted mb-0 me-1 d-inline-block">Total BoP Bill</div>
                                </div>
                            </div>
                            <div id="widget-chart-5"></div>

                        </div>
                        <button class="btn btn-secondary-light btn-border-start">View Details</button>

                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="custom-card card">
                        <div class="card-body p-0">
                            <div class="text-end mb-3 p-3">
                                <div class="avatar avatar-lg bg-success bg-opacity-25 avatar-rounded mb-3">
                                    <div class="avatar avatar-md bg-success text-fixed-white avatar-rounded">
                                        <i class="ri-bar-chart-box-line fs-18"></i>
                                    </div>
                                </div>
                                <div>
                                    <h4 class="fw-semibold mb-1">GHS {{ $customerData['totalArrearsP'] }}</h4>
                                    <span class="badge bg-danger-transparent rounded-pill me-2">0.25%<i
                                            class="ti ti-arrow-down"></i></span>
                                    <div class="text-muted mb-0 me-1 d-inline-block">Total BoP Arrears</div>
                                </div>
                            </div>
                            <div id="widget-chart-6"></div>
                        </div>
                        <button class="btn btn-secondary-light btn-border-start">View Details</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xxl-12 col-xl-12">
            <div class="card custom-card">
                <div class="card-header border-bottom border-block-end-dashed">
                    <div>
                        <h6 class="mb-0">Transactions</h6>
                        <span class="fs-11 text-muted">Summary of Yearly transactions</span>
                    </div>

                </div>
                <div class="card-body">
                    <div class=" p-2 bg-light bg-opacity-75 rounded-3">
                        <div class="d-flex gap-3 justify-content-between align-items-center flex-wrap mb-3">
                            <div>
                                <span class="avatar avatar-sm bg-success-transparent avatar-rounded">
                                    <i class="ri-arrow-left-down-line fs-18"></i>
                                </span>
                                <span class="align-center fw-medium ms-1">Amount Paid</span>
                            </div>
                            <div>
                                <div class="fw-semibold mb-1 d-inline-block">Property Rates</div>
                                <span class="text-muted mb-0 ms-1 d-inline-block"> </span>
                            </div>
                            <h6 class="fw-semibold">GHS
                                {{ $customerData['yearlyPaymentsP'] }}</h6>
                            <span class="badge bg-success rounded-pill">2.3%<i class="ti ti-arrow-up"></i></span>
                        </div>
                        <div class="d-flex gap-3 justify-content-between align-items-center flex-wrap mb-3">
                            <div>
                                <span class="avatar avatar-sm bg-primary-transparent avatar-rounded">
                                    <i class="ri-arrow-right-up-line fs-18"></i>
                                </span>
                                <span class="align-center fw-medium ms-1">Amount Paid</span>
                            </div>
                            <div>
                                <div class="fw-semibold mb-1 d-inline-block">BoP</div>
                                <span class="text-muted mb-0 ms-1 d-inline-block"> </span>
                            </div>
                            <h6 class="fw-semibold">GHS {{ $customerData['yearlyPaymentsB'] }}</h6>
                            <span class="badge bg-danger rounded-pill">-1.5%<i class="ti ti-arrow-down"></i></span>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End:: Row-3 -->

</div>
