@extends('layout.base')

@section('page-styles')
@endsection

@section('page-content')
    <div class="container-fluid">
        @if (\Auth::user()->access_level !== 'customer' && \Auth::user()->access_level !== 'GRA_Administrator')
            <div class="row">
                <div class="col-xxl-7 col-xl-12 col-lg-12">
                    <div class="card custom-card overflow-hidden nft-main-card">
                        <div class="card-body">
                            <div class="row gap-3 gap-sm-0 mx-0 py-3 rounded-3">
                                <div class="col-xxl-8 col-xl-6 col-lg-8 col-12">
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
                                        <h6 class="fw-semibold mb-3 op-9 text-fixed-white"> {{ $greeting }}
                                            {{ Auth::user()->name }} ! &#128075;</h6>
                                        <h4 class="fw-semibold mb-2  text-fixed-white"> "Welcome to Your <span
                                                class="text-secondary"> IPTS</span> Dashboard!" </h4>
                                        <p class="mb-4 text-fixed-white op-7 fs-12">
                                            Empowering you to manage your contributions with ease, transparency, and
                                            confidence.
                                            Together, we’re building stronger communities!


                                        </p>
                                        <div class="d-flex gap-2 flex-wrap">
                                            <button class="btn btn-success btn-wave waves-effect waves-light"
                                                onclick="window.location.href='{{ route('bills.fetchBill', ['display' => 'property']) }}'">
                                                View BoP Bills
                                            </button>
                                            <button class="btn btn-secondary btn-wave waves-effect waves-light"
                                                onclick="window.location.href='{{ route('businesses.index', ['display' => 'active']) }}'">
                                                View Property Bills
                                            </button>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-4 col-xl-6 col-lg-4 my-auto text-end">
                                    <div class="featured-nft text-end">
                                        <img src="../assets/images/gh.png" alt=""
                                            class="img-fluid nft-cardimg rounded-3">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Start::row-1 -->
            <div class="row">
                <div class="col-xl-3">
                    <div class="card custom-card">
                        <div class="card-body">
                            <div class="d-flex gap-2 justify-content-between">
                                <div class="d-flex flex-column justify-content-between gap-2">

                                    <div id="crmchart01"></div>
                                </div>
                                <div class="text-end">
                                    <div class="avatar avatar-md bg-primary bg-opacity-25 avatar-rounded mb-2">
                                        <div class="avatar avatar-sm bg-primary text-fixed-white avatar-rounded">
                                            <i class="ri-bar-chart-box-line fs-18"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <h4 class="fw-semibold mb-2"> 211</h4>
                                        <div class="text-muted mb-0"> Total Assemblies </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="card custom-card">
                        <div class="card-body">
                            <div class="d-flex gap-2 justify-content-between">
                                <div class="d-flex flex-column justify-content-between gap-2">

                                    <div id="crmchart02"></div>
                                </div>
                                <div class="text-end">
                                    <div class="avatar avatar-md bg-secondary bg-opacity-25 avatar-rounded mb-2">
                                        <div class="avatar avatar-sm bg-secondary text-fixed-white avatar-rounded">
                                            <i class="ri-user-add-line fs-18"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <h4 class="fw-semibold mb-2">GHS {{ $total['totalArrears'] }}</h4>
                                        <div class="text-muted mb-0">Outstanding Balances</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="card custom-card">
                        <div class="card-body">
                            <div class="d-flex gap-2 justify-content-between">
                                <div class="d-flex flex-column justify-content-between gap-2">

                                    <div id="crmchart03"></div>
                                </div>
                                <div class="text-end">
                                    <div class="avatar avatar-md bg-success bg-opacity-25 avatar-rounded mb-2">
                                        <div class="avatar avatar-sm bg-success text-fixed-white avatar-rounded">
                                            <i class="ri-shake-hands-line fs-18"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <h4 class="fw-semibold mb-2">{{ $total['totalProperties'] }}</h4>
                                        <div class="text-muted mb-0">Registered Properties </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3">
                    <div class="card custom-card">
                        <div class="card-body">
                            <div class="d-flex gap-2 justify-content-between">
                                <div class="d-flex flex-column justify-content-between gap-2">

                                    <div id="crmchart04"></div>
                                </div>
                                <div class="text-end">
                                    <div class="avatar avatar-md bg-info bg-opacity-25 avatar-rounded mb-2">
                                        <div class="avatar avatar-sm bg-info text-fixed-white avatar-rounded">
                                            <i class="ri-hourglass-line fs-18"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <h4 class="fw-semibold mb-2">3.6%</h4>
                                        <div class="text-muted mb-0">Collection Rate </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card custom-card">
                    <div class="card-header justify-content-between">
                        <div class="card-title">
                            Payment Trends
                        </div>
                        <a href="{{ route('payments.index', ['display' => 'yearly']) }}" class="btn btn-primary btn-sm">View
                            All Payments</a>

                    </div>
                    <div class="card-body">
                        <div class="list-unstyled row mt-1">
                            <div class="col-xl-3 col-sm-6 mb-3 mb-xl-0">
                                <div
                                    class="border border-primary border-opacity-10 align-items-center gap-2 p-3 text-center rounded-3 pod-artist">
                                    <div class="lh-1 mb-3 rounded-circle">
                                        <span class="podcast-author rounded-circle d-inline-block">
                                            <span class="avatar avatar-xxl p-1 bg-white avatar-rounded">
                                                <img src="{{ asset('assets/images/coin.jpg') }}" alt="">
                                            </span>
                                        </span>
                                    </div>
                                    <div>
                                        <a href="javascript:void(0);" class="fw-semibold">Today's Payment</a>
                                        <p class="text-muted mb-2">As At , {{ \Carbon\Carbon::now()->format('l, F j, Y ') }}
                                        </p>
                                        <span class="text-primary fw-semibold">GHS {{ $total['dailyPayments'] }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-sm-6 mb-3 mb-xl-0">
                                <div
                                    class="border border-secondary border-opacity-10 align-items-center gap-2 p-3 text-center rounded-3 pod-artist">
                                    <div class="lh-1 mb-3">
                                        <span class="podcast-author secondary rounded-circle d-inline-block">
                                            <span class="avatar avatar-xxl p-1 bg-white avatar-rounded">
                                                <img src="{{ asset('assets/images/coin.jpg') }}" alt="">
                                            </span>
                                        </span>
                                    </div>
                                    <div>
                                        <a href="javascript:void(0);" class="fw-semibold">This Weeks Payment </a>
                                        <p class="text-muted mb-2">As At ,
                                            {{ \Carbon\Carbon::now()->format('l, F j, Y ') }}
                                        </p>
                                        <span class="text-secondary fw-semibold">GHS {{ $total['weeklyPayments'] }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-sm-6 mb-3 mb-xl-0">
                                <div
                                    class="border border-success border-opacity-10 align-items-center gap-2 p-3 text-center rounded-3 pod-artist">
                                    <div class="lh-1 mb-3">
                                        <span class="podcast-author success rounded-circle d-inline-block">
                                            <span class="avatar avatar-xxl p-1 bg-white avatar-rounded">
                                                <img src="{{ asset('assets/images/coin.jpg') }}" alt="">
                                            </span>
                                        </span>
                                    </div>
                                    <div>
                                        <a href="javascript:void(0);" class="fw-semibold">This Months Payment </a>
                                        <p class="text-muted mb-2">As At ,
                                            {{ \Carbon\Carbon::now()->format('l, F j, Y ') }}
                                        </p>
                                        <span class="text-success fw-semibold">GHS {{ $total['monthlyPayments'] }} </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-sm-6">
                                <div
                                    class="border border-info border-opacity-10 align-items-center gap-2 p-3 text-center rounded-3 pod-artist">
                                    <div class="lh-1 mb-3">
                                        <span class="podcast-author info rounded-circle d-inline-block">
                                            <span class="avatar avatar-xxl p-1 bg-white avatar-rounded">
                                                <img src="{{ asset('assets/images/coin.jpg') }}" alt="">
                                            </span>
                                        </span>
                                    </div>
                                    <div>
                                        <a href="javascript:void(0);" class="fw-semibold">This Years Payment</a>
                                        <p class="text-muted mb-2">As At ,
                                            {{ \Carbon\Carbon::now()->format('l, F j, Y ') }}
                                        </p>
                                        <span class="text-info fw-semibold">GHS {{ $total['yearlyPayments'] }} </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card custom-card">
                            <div class="card-body">
                                <div
                                    class="mb-4 d-flex align-items-center justify-content-between bg-light p-2 px-3 rounded-3">
                                    <h6 class="fw-semibold mb-0">Operational Information :</h6>
                                    <button class="btn btn-primary btn-sm" type="button">View All</button>
                                </div>
                                <div
                                    class="row row-cols-md-4 row-cols-sm-3 row-cols-xxl-auto personal-favourite-contacts mb-0 gap-2 flex-wrap">
                                    <div class="col flex-fill">
                                        <div
                                            class="d-flex align-items-center bg-primary-transparent rounded-pill p-2 pe-5">
                                            <div class="me-2">
                                                <span class="avatar avatar-md avatar-rounded bg-primary p-2">
                                                    <i class="ri-macbook-line fs-18 lh-1"></i>
                                                </span>
                                            </div>
                                            <div class="flex-fill">
                                                <div class="fw-semibold mb-0 text-default">Total Agents
                                                </div>
                                                <span class="text-muted">{{ $total['totalAssemblyAgents'] }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col flex-fill">
                                        <div
                                            class="d-flex align-items-center bg-secondary-transparent rounded-pill p-2 pe-5">
                                            <div class="me-2">
                                                <span class="avatar avatar-md avatar-rounded bg-secondary p-2">
                                                    <i class="ri-briefcase-2-line fs-18 lh-1"></i>
                                                </span>
                                            </div>
                                            <div class="flex-fill">
                                                <div class="fw-semibold mb-0 text-default"> Active Agents</div>
                                                <span class="text-muted">{{ $total['totalActiveAssemblyAgents'] }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col flex-fill">
                                        <div
                                            class="d-flex align-items-center bg-success-transparent rounded-pill p-2 pe-5">
                                            <div class="me-2">
                                                <span class="avatar avatar-md avatar-rounded bg-success p-2">
                                                    <i class="ri-heart-pulse-line fs-18 lh-1"></i>
                                                </span>
                                            </div>
                                            <div class="flex-fill">
                                                <div class="fw-semibold mb-0 text-default"> In-Active Agents</div>
                                                <span class="text-muted">{{ $total['totalInactiveAssemblyAgents'] }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col flex-fill">
                                        <div class="d-flex align-items-center bg-info-transparent rounded-pill p-2 pe-5">
                                            <div class="me-2">
                                                <span class="avatar avatar-md avatar-rounded bg-info p-2">
                                                    <i class="ri-football-line fs-18 lh-1"></i>
                                                </span>
                                            </div>
                                            <div class="flex-fill">
                                                <div class="fw-semibold mb-0 text-default">Total Businessess</div>
                                                <span class="text-muted">{{ $total['totalBusinesses'] }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col flex-fill">
                                        <div class="d-flex align-items-center bg-pink-transparent rounded-pill p-2 pe-5">
                                            <div class="me-2">
                                                <span class="avatar avatar-md avatar-rounded bg-warning p-2">
                                                    <i class="ri-briefcase-2-line fs-18 lh-1"></i>
                                                </span>
                                            </div>
                                            <div class="flex-fill">
                                                <div class="fw-semibold mb-0 text-default">Total Properties</div>
                                                <span class="text-muted">{{ $total['totalProperties'] }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>




                <div class="col-xl-3">
                    <div class="card custom-card profit-analysis-card">
                        <div class="card-body p-0">
                            <div class="p-4 pb-1">
                                <h4 class="mb-1 d-flex align-items-center fw-semibold flex-wrap">GHS
                                    {{ $total['totalExpectedPayments'] }}<span
                                        class="text-success fw-medium fs-12 ms-2"><i
                                            class="ti ti-arrow-up align-middle me-1"></i> </span> </h4>
                                <span class="fs-14 d-block">Expected Revenue </span>
                            </div>
                            <div id="profit-analysis"></div>
                            <div id="profit-analysis1"></div>
                            <div id="profit-analysis2"></div>
                        </div>
                    </div>
                    <div class="card custom-card">
                        <div class="card-header">
                            <div class="card-title">
                                Bills And Payments

                            </div>
                        </div>
                        <div class="card-body">
                            <div class="progress-stacked progress-sm mb-4 mt-2 gap-1">
                                <div class="progress-bar rounded" role="progressbar" style="width: 45%"
                                    aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
                                <div class="progress-bar bg-secondary rounded" role="progressbar" style="width: 25%"
                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                <div class="progress-bar bg-success rounded" role="progressbar" style="width: 30%"
                                    aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <ul class="list-unstyled sales-traffic-list">
                                <li>
                                    <div class="d-flex align-items-center flex-wrap justify-content-between">
                                        <div class="fw-semibold"> Bills</div>
                                        <div class="fw-semibold"><span
                                                class="text-success fs-11 fw-medium me-2 d-inline-block"><i
                                                    class="ti ti-arrow-up alilgn-middle me-1"></i>0.56%</span>GHS
                                            {{ $total['totalBill'] }}</div>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex align-items-center flex-wrap justify-content-between">
                                        <div class="fw-semibold">Arrears</div>
                                        <div class="fw-semibold"><span
                                                class="text-success fs-11 fw-medium me-2 d-inline-block"><i
                                                    class="ti ti-arrow-up alilgn-middle me-1"></i>4.23%</span> GHS
                                            {{ $total['totalArrears'] }} </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex align-items-center flex-wrap justify-content-between">
                                        <div class="fw-semibold">Revenue</div>
                                        <div class="fw-semibold"><span
                                                class="text-danger fs-11 fw-medium me-2 d-inline-block"><i
                                                    class="ti ti-arrow-down alilgn-middle me-1"></i>6.88%</span>GHS
                                            {{ $total['totalExpectedPayments'] }}
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9">
                    <div class="card custom-card">
                        <div class="card-header justify-content-between">
                            <div class="card-title">
                                BoP's Bill / Property Rate Bill & Payment Statistics
                            </div>
                            <div class="dropdown">
                                <a href="javascript:void(0);" class="btn btn-sm btn-light btn-wave fs-12 text-muted"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    View All<i class="ri-arrow-down-s-line align-middle ms-1 d-inline-block"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" role="menu">
                                    <li><a class="dropdown-item" href="javascript:void(0);">Download</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0);">Import</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0);">Export</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div id="sales-statistics" class="p-3"></div>
                            <div id="sales-statistics1"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card custom-card overflow-hidden">
                                <div class="card-header justify-content-between">
                                    <div class="card-title">
                                        Revenue Statistics
                                    </div>

                                </div>
                                <div class="card-body text-center p-0">
                                    <div id="revenue-statistics1"></div>
                                    <div class="revenue-statistics">
                                        <div id="revenue-statistics"></div>
                                        <div class="chart-circle-value"></div>
                                    </div>

                                    @php
                                        // Define the totals
                                        $totalBusinessBill = $total['totalBusinessBill'];
                                        $totalPropertyBill = $total['totalPropertyBill'];

                                        // Calculate the summation
                                        $totalSum = $totalBusinessBill + $totalPropertyBill;

                                        // Define the cuts
                                        $gracut = $totalSum * 1.5; // 15%
                                        $level10cut = $totalSum * 1.5; // 15%
                                        $assemblycut = $totalSum * 7.0; // 70%
                                    @endphp
                                    <div class="row justify-content-center mt-4 p-3 gx-xl-1 gx-xxl-3">
                                        <div class="col col-xl-4 border-end border-inline-end-dashed">
                                            <span class="d-block text-muted mb-1 fs-12">Assembly Fund - (70%)</span>
                                            <span
                                                class="fw-semibold h6 mb-0 text-center">{{ number_format($assemblycut, 2) }}
                                                <i class="ti ti-arrow-up text-success"></i></span>
                                        </div>
                                        <div class="col col-xl-4 border-end border-inline-end-dashed">
                                            <span class="d-block text-muted mb-1 fs-12">GRA-(15%)</span>
                                            <span class="fw-semibold h6 mb-0 text-center">{{ number_format($gracut, 2) }}
                                                <i class="ti ti-arrow-down text-danger"></i></span>
                                        </div>
                                        <div class="col col-xl-4">
                                            <span class="d-block text-muted mb-1 fs-12">Level 10 -(15%)</span>
                                            <span
                                                class="fw-semibold h6 mb-0 text-center">{{ number_format($level10cut, 2) }}<i
                                                    class="ti ti-arrow-up text-success"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12">
                            <div class="card custom-card income-card">
                                <div class="card-body p-0">
                                    <div class="d-flex align-items-center flex-wrap gap-2 lh-1 p-3">
                                        <div class="circle-content">
                                            <div id="income"></div>
                                            <i class='bx bx-wallet fs-5 text-success'></i>
                                        </div>
                                        <div class="d-flex flex-column flex-fill">
                                            <span class="fw-semibold h6 mb-2">GHS {{ $total['totalBusinessBill'] }}</span>
                                            <p class="fs-13 mb-0">Total Revenue Generated For BoP</p>
                                        </div>
                                        <div class="text-end">
                                            <span class="d-block text-danger fw-medium fs-13 mb-2">
                                                <i class="ti ti-arrow-down"></i>0.96%
                                            </span>
                                            <span>This Month -AS AT
                                                {{ \Carbon\Carbon::now()->format('l, F j, Y h:i A') }}</span>
                                        </div>
                                    </div>
                                    <div id="income-chart"></div>
                                </div>
                            </div>
                            <div class="card custom-card expense-card">
                                <div class="card-body p-0">
                                    <div class="d-flex align-items-center flex-wrap gap-2 lh-1 p-3">
                                        <div class="circle-content">
                                            <div id="expense"></div>
                                            <i class='bx bx-dollar-circle fs-5 text-secondary'></i>
                                        </div>
                                        <div class="d-flex flex-column flex-fill">
                                            <span class="fw-semibold h6 mb-2">GHS {{ $total['totalPropertyBill'] }}</span>
                                            <p class="fs-13 mb-0">Total Revenue Generated For Property Rate </p>
                                        </div>
                                        <div class="text-end">
                                            <span class="d-block text-success fw-medium fs-13 mb-2">
                                                <i class="ti ti-arrow-up"></i>4.27%
                                            </span>
                                            <span>This Month AS AT-
                                                {{ \Carbon\Carbon::now()->format('l, F j, Y h:i A') }}</span>
                                        </div>
                                    </div>
                                    <div id="expenditure-chart"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12 col-md-12">
                <div class="card">


                    <div class="card-header">
                        <div class="card-title">Weekly Payments Performance</div>
                    </div>
                    <div class="card-body py-0 custome-tooltip">
                        <div id="activity1"></div>
                    </div>
                    <div class="card-footer border-0 pt-0">
                        <a href="{{ route('payments.index') }}" class="btn btn-primary btn-block">Explore Details</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-12 col-md-12">
                <div class="card">

                    <div class="card-header">
                        <div class="card-title">Monthly Payments Performance</div>
                    </div>
                    <div class="card-body py-0 custome-tooltip">
                        <div id="activity2"></div>
                    </div>
                    <div class="card-footer border-0 pt-0">
                        <a href="{{ route('payments.index') }}" class="btn btn-primary btn-block">Explore Details</a>
                    </div>
                </div>
            </div>
        @elseif (\Auth::user()->access_level == 'GRA_Administrator')
            <div class="accordion customized-accordion accordions-items-separate" id="customizedAccordion">
                <div class="accordion-item custom-accordion-primary">
                    <h2 class="accordion-header" id="customizedAccordionOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#customized-AccordionOne" aria-expanded="true"
                            aria-controls="customized-AccordionOne">
                            Financial Overview
                        </button>
                    </h2>
                    <div id="customized-AccordionOne" class="accordion-collapse collapse show"
                        aria-labelledby="customizedAccordionOne" data-bs-parent="#customizedAccordion">
                        <div class="accordion-body">
                            <div class="row">
                                <div class="col-xxl-9">
                                    <div class="row">
                                        <div class="col-xl-3">
                                            <div class="card custom-card">
                                                <div class="card-body">
                                                    <div class="d-flex align-items-start gap-3 flex-wrap">
                                                        <div>
                                                            <span
                                                                class="avatar avatar-md avatar-rounded bg-primary shadow shadow-primary">
                                                                <i class="ti ti-shopping-bag fs-5"></i>
                                                            </span>
                                                        </div>
                                                        <div class="flex-fill">
                                                            <div
                                                                class="d-flex align-items-center justify-content-between mb-2">
                                                                <span class="d-block"> Yearly BoP Bill</span>
                                                                <span
                                                                    class="badge bg-success-transparent rounded-pill">0.25%<i
                                                                        class="ti ti-arrow-up"></i></span>
                                                            </div>
                                                            <h4 class="fw-semibold mb-3 lh-1">GHS
                                                                {{ $total['totalBusinessBill'] }} </h4>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3">
                                            <div class="card custom-card">
                                                <div class="card-body">
                                                    <div class="d-flex align-items-start gap-3 flex-wrap">
                                                        <div>
                                                            <span
                                                                class="avatar avatar-md avatar-rounded bg-secondary shadow shadow-secondary">
                                                                <i class="ti ti-currency-dollar fs-5"></i>
                                                            </span>
                                                        </div>
                                                        <div class="flex-fill">
                                                            <div
                                                                class="d-flex align-items-center justify-content-between mb-2">
                                                                <span class="d-block">Total Property Bill </span>
                                                                <span
                                                                    class="badge bg-success-transparent rounded-pill">5.44%<i
                                                                        class="ti ti-arrow-up"></i></span>
                                                            </div>
                                                            <h4 class="fw-semibold mb-3 lh-1"> GHS
                                                                {{ $total['totalPropertyBill'] }}</h4>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3">
                                            <div class="card custom-card">
                                                <div class="card-body">
                                                    <div class="d-flex align-items-start gap-3 flex-wrap">
                                                        <div>
                                                            <span
                                                                class="avatar avatar-md avatar-rounded bg-success shadow shadow-success">
                                                                <i class="ti ti-box fs-5"></i>
                                                            </span>
                                                        </div>
                                                        <div class="flex-fill">
                                                            <div
                                                                class="d-flex align-items-center justify-content-between mb-2">
                                                                <span class="d-block">Yearly Revenue </span>
                                                                <span
                                                                    class="badge bg-danger-transparent rounded-pill">12.34%<i
                                                                        class="ti ti-arrow-down"></i></span>
                                                            </div>
                                                            <span class="d-block mb-2"></span>
                                                            <h4 class="fw-semibold mb-3 lh-1">GHS
                                                                {{ $total['totalBill'] }}</h4>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3">
                                            <div class="card custom-card">
                                                <div class="card-body">
                                                    <div class="d-flex align-items-start gap-3 flex-wrap">
                                                        <div>
                                                            <span
                                                                class="avatar avatar-md avatar-rounded bg-info shadow shadow-info">
                                                                <i class="ti ti-moneybag fs-5"></i>
                                                            </span>
                                                        </div>
                                                        <div class="flex-fill">
                                                            <div
                                                                class="d-flex align-items-center justify-content-between mb-2">
                                                                <span class="d-block"> Cash Collections </span>
                                                                <span
                                                                    class="badge bg-success-transparent rounded-pill">2.12%<i
                                                                        class="ti ti-arrow-up"></i></span>
                                                            </div>
                                                            <span class="d-block mb-2"></span>
                                                            <h4 class="fw-semibold mb-3 lh-1"> GHS
                                                                {{ $total['yearlyCashPayments'] }}</h4>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xxl-3 col-xl-12">
                                    <div class="card custom-card">
                                        <div class="card-header justify-content-between">
                                            <div class="card-title">
                                                Country Statistics
                                            </div>
                                            <a href="javascript:void(0);"
                                                class="btn btn-light btn-wave btn-sm text-muted waves-effect waves-light">Export</a>
                                        </div>
                                        <div class="card-body">
                                            <ul class="list-unstyled country-stats-list">
                                                <li>
                                                    <div class="d-flex align-items-center gap-3">
                                                        <div class="lh-1">
                                                            <span class="avatar avatar-md bg-light p-2">
                                                                <img src="../assets/images/flags/india_flag.jpg"
                                                                    alt="" class="rounded-circle">
                                                            </span>
                                                        </div>
                                                        <div class="flex-fill">
                                                            <div
                                                                class="d-flex mb-2 justify-content-between align-items-center">
                                                                <div class="d-flex align-items-center gap-2">
                                                                    <span class="fw-semibold d-block">Overall Yearly Momo
                                                                        Payment</span>
                                                                </div>
                                                                <div class="fw-medium"><span class="text-danger me-1"><i
                                                                            class="ti ti-arrow-down align-middle"></i></span><span>GHS
                                                                        {{ $total['yearlyMomoPayments'] }}</span>
                                                                    (65%)</div>
                                                            </div>
                                                            <div class="progress progress-xs progress-animate"
                                                                role="progressbar" aria-valuenow="65" aria-valuemin="0"
                                                                aria-valuemax="100">
                                                                <div class="progress-bar" style="width: 65%"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="d-flex align-items-center gap-3">
                                                        <div class="lh-1">
                                                            <span class="avatar avatar-md bg-light p-2">
                                                                <img src="../assets/images/flags/russia_flag.jpg"
                                                                    alt="" class="rounded-circle">
                                                            </span>
                                                        </div>
                                                        <div class="flex-fill">
                                                            <div
                                                                class="d-flex mb-2 justify-content-between align-items-center">
                                                                <div class="d-flex align-items-center gap-2">
                                                                    <span class="fw-semibold d-block">Total Yearly
                                                                        Payments</span>
                                                                </div>
                                                                <div class="fw-medium"><span class="text-success me-1"><i
                                                                            class="ti ti-arrow-up align-middle"></i></span><span>GHS
                                                                        {{ $total['yearlyPayments'] }}</span>
                                                                    (55%)</div>
                                                            </div>
                                                            <div class="progress progress-xs progress-animate"
                                                                role="progressbar" aria-valuenow="55" aria-valuemin="0"
                                                                aria-valuemax="100">
                                                                <div class="progress-bar bg-secondary" style="width: 55%">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="d-flex align-items-center gap-3">
                                                        <div class="lh-1">
                                                            <span class="avatar avatar-md bg-light p-2">
                                                                <img src="../assets/images/flags/canada_flag.jpg"
                                                                    alt="" class="rounded-circle">
                                                            </span>
                                                        </div>
                                                        <div class="flex-fill">
                                                            <div
                                                                class="d-flex mb-2 justify-content-between align-items-center">
                                                                <div class="d-flex align-items-center gap-2">
                                                                    <span class="fw-semibold d-block">Total
                                                                        Receivables</span>
                                                                </div>
                                                                <div class="fw-medium"><span class="text-danger me-1"><i
                                                                            class="ti ti-arrow-down align-middle"></i></span><span>>GHS
                                                                        {{ $total['yearlyReceivables'] }}</span>
                                                                    (69%)</div>
                                                            </div>
                                                            <div class="progress progress-xs progress-animate"
                                                                role="progressbar" aria-valuenow="69" aria-valuemin="0"
                                                                aria-valuemax="100">
                                                                <div class="progress-bar bg-success" style="width: 69%">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>


                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item custom-accordion-secondary">
                    <h2 class="accordion-header" id="customizedAccordionTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#customized-AccordionTwo" aria-expanded="false"
                            aria-controls="customized-AccordionTwo">
                            Operational Overview
                        </button>
                    </h2>
                    <div id="customized-AccordionTwo" class="accordion-collapse collapse"
                        aria-labelledby="customizedAccordionTwo" data-bs-parent="#customizedAccordion">
                        <div class="accordion-body">
                            <div class="row">
                                <!-- Card 1 -->
                                <div class="col-xl-4">
                                    <div class="card custom-card">
                                        <div class="card-body">
                                            <div class="progress-stacked progress-sm mb-4 mt-2 gap-1">
                                                <div class="progress-bar rounded" role="progressbar" style="width: 45%"
                                                    aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
                                                <div class="progress-bar bg-secondary rounded" role="progressbar"
                                                    style="width: 25%" aria-valuenow="25" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                                <div class="progress-bar bg-success rounded" role="progressbar"
                                                    style="width: 30%" aria-valuenow="30" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                            <ul class="list-unstyled sales-traffic-list">
                                                <li>
                                                    <div
                                                        class="d-flex align-items-center flex-wrap justify-content-between">
                                                        <div class="fw-semibold">Total Properties</div>
                                                        <div class="fw-semibold"><span
                                                                class="text-success fs-11 fw-medium me-2 d-inline-block"><i
                                                                    class="ti ti-arrow-up alilgn-middle me-1"></i>0.56%</span>{{ $total['totalProperties'] }}
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div
                                                        class="d-flex align-items-center flex-wrap justify-content-between">
                                                        <div class="fw-semibold">Valued </div>
                                                        <div class="fw-semibold"><span
                                                                class="text-success fs-11 fw-medium me-2 d-inline-block"><i
                                                                    class="ti ti-arrow-up alilgn-middle me-1"></i>0.00%</span>0
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div
                                                        class="d-flex align-items-center flex-wrap justify-content-between">
                                                        <div class="fw-semibold">Un-Valued </div>
                                                        <div class="fw-semibold"><span
                                                                class="text-danger fs-11 fw-medium me-2 d-inline-block"><i
                                                                    class="ti ti-arrow-down alilgn-middle me-1"></i>0.00%</span>0.00
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <!-- Card 2 -->
                                <div class="col-xl-4">
                                    <div class="card custom-card">
                                        <div class="card-body">
                                            <!-- Duplicate content from Card 1 -->
                                            <div class="progress-stacked progress-sm mb-4 mt-2 gap-1">
                                                <div class="progress-bar rounded" role="progressbar" style="width: 45%"
                                                    aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
                                                <div class="progress-bar bg-secondary rounded" role="progressbar"
                                                    style="width: 25%" aria-valuenow="25" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                                <div class="progress-bar bg-success rounded" role="progressbar"
                                                    style="width: 30%" aria-valuenow="30" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                            <ul class="list-unstyled sales-traffic-list">
                                                <li>
                                                    <div
                                                        class="d-flex align-items-center flex-wrap justify-content-between">
                                                        <div class="fw-semibold">Total Businessess</div>
                                                        <div class="fw-semibold"><span
                                                                class="text-success fs-11 fw-medium me-2 d-inline-block"><i
                                                                    class="ti ti-arrow-up alilgn-middle me-1"></i>0.56%</span>{{ $total['totalBusinesses'] }}
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div
                                                        class="d-flex align-items-center flex-wrap justify-content-between">
                                                        <div class="fw-semibold">Validated</div>
                                                        <div class="fw-semibold"><span
                                                                class="text-success fs-11 fw-medium me-2 d-inline-block"><i
                                                                    class="ti ti-arrow-up alilgn-middle me-1"></i>0.00%</span>0
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div
                                                        class="d-flex align-items-center flex-wrap justify-content-between">
                                                        <div class="fw-semibold">Un-Validated </div>
                                                        <div class="fw-semibold"><span
                                                                class="text-danger fs-11 fw-medium me-2 d-inline-block"><i
                                                                    class="ti ti-arrow-down alilgn-middle me-1"></i>0.00%</span>0
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <!-- Card 3 -->
                                <div class="col-xl-4">
                                    <div class="card custom-card">
                                        <div class="card-body">
                                            <!-- Duplicate content from Card 1 -->
                                            <div class="progress-stacked progress-sm mb-4 mt-2 gap-1">
                                                <div class="progress-bar rounded" role="progressbar" style="width: 45%"
                                                    aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
                                                <div class="progress-bar bg-secondary rounded" role="progressbar"
                                                    style="width: 25%" aria-valuenow="25" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                                <div class="progress-bar bg-success rounded" role="progressbar"
                                                    style="width: 30%" aria-valuenow="30" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                            <ul class="list-unstyled sales-traffic-list">
                                                <li>
                                                    <div
                                                        class="d-flex align-items-center flex-wrap justify-content-between">
                                                        <div class="fw-semibold">Total Assemblies</div>
                                                        <div class="fw-semibold"><span
                                                                class="text-success fs-11 fw-medium me-2 d-inline-block"><i
                                                                    class="ti ti-arrow-up alilgn-middle me-1"></i>0.56%</span>{{ $total['totalAssembly'] }}
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div
                                                        class="d-flex align-items-center flex-wrap justify-content-between">
                                                        <div class="fw-semibold">Active </div>
                                                        <div class="fw-semibold"><span
                                                                class="text-success fs-11 fw-medium me-2 d-inline-block"><i
                                                                    class="ti ti-arrow-up alilgn-middle me-1"></i>0.00%</span>0
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div
                                                        class="d-flex align-items-center flex-wrap justify-content-between">
                                                        <div class="fw-semibold">In-Active </div>
                                                        <div class="fw-semibold"><span
                                                                class="text-danger fs-11 fw-medium me-2 d-inline-block"><i
                                                                    class="ti ti-arrow-down alilgn-middle me-1"></i>0.00%</span>0
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
                <div class="accordion-item custom-accordion-danger">
                    <h2 class="accordion-header" id="customizedAccordionThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#customized-AccordionThree" aria-expanded="false"
                            aria-controls="customized-AccordionThree">
                            Nationwide Assemblies Performance Overview
                        </button>
                    </h2>
                    <div id="customized-AccordionThree" class="accordion-collapse collapse"
                        aria-labelledby="customizedAccordionThree" data-bs-parent="#customizedAccordion">
                        <div class="accordion-body">
                            <!-- Default accordion -->
                            <div class="accordion-body" id="accordion-regions">
                                @foreach ($total['regions'] as $index => $region)
                                    <div class="accordion-item">
                                        <div class="accordion-header rounded-lg" id="heading{{ $index }}"
                                            data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}"
                                            aria-controls="collapse{{ $index }}" aria-expanded="false"
                                            role="button">
                                            <span class="accordion-header-icon"></span>
                                            <span class="accordion-header-text">{{ $region->name }}</span>
                                            <span class="accordion-header-indicator"></span>
                                        </div>
                                        <div id="collapse{{ $index }}" class="collapse"
                                            aria-labelledby="heading{{ $index }}"
                                            data-bs-parent="#accordion-regions">
                                            <div class="accordion-body-text">
                                                @if ($region->assemblies->count() > 0)
                                                    <div class="table table-bordered text-nowrap w-100">
                                                        <table id="file-export-{{ $region->id }}">
                                                            <thead>
                                                                <tr>
                                                                    <th>S/N</th>
                                                                    <th>Assembly Name</th>
                                                                    <th>Total Properties</th>
                                                                    <th>Total Businesses</th>
                                                                    <th>Total Bills (GHS)</th>
                                                                    <th>Total Payments (GHS)</th>
                                                                    <th>Total Receivables (GHS)</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($region->assemblies as $key => $assembly)
                                                                    @php
                                                                        $totalPropertiesCount = $assembly->properties->count();
                                                                        $totalBusinessesCount = $assembly->businesses->count();
                                                                        $totalBills = $assembly->bills->sum('amount');
                                                                        $totalBillsCount = isset($totalBills)
                                                                            ? number_format($totalBills, 2)
                                                                            : 0;
                                                                        $totalPayments = $assembly->payments
                                                                            ->filter(function ($payment) {
                                                                                if ($payment->payment_mode == 'momo') {
                                                                                    return $payment->transaction_status ==
                                                                                        'Success';
                                                                                }

                                                                                return true;
                                                                            })
                                                                            ->sum('amount');
                                                                        $totalPaymentsCount = isset($totalPayments)
                                                                            ? number_format($totalPayments, 2)
                                                                            : 0;
                                                                        $totalReceivables =
                                                                            $totalBills - $totalPayments;
                                                                    @endphp

                                                                    <tr>
                                                                        <td>{{ $key + 1 }}</td>
                                                                        <td>{{ $assembly->name }}</td>
                                                                        <td>{{ $totalPropertiesCount }}</td>
                                                                        <td>{{ $totalBusinessesCount }}</td>
                                                                        <td>{{ $totalBillsCount }}</td>
                                                                        <td>{{ $totalPaymentsCount }}</td>
                                                                        <td>{{ number_format($totalReceivables, 2) }}
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                @else
                                                    <p>No assemblies available for this region.</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @elseif (\Auth::user()->access_level == 'customer')
            <!-- Start::row-1 -->
            <div class="row">
                <div class="col-xxl-7 col-xl-12 col-lg-12">
                    <div class="card custom-card overflow-hidden nft-main-card">
                        <div class="card-body">
                            <div class="row gap-3 gap-sm-0 mx-0 py-3 rounded-3">
                                <div class="col-xxl-8 col-xl-6 col-lg-8 col-12">
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

                    <div class="col-xxl-4 col-xl-6">
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
                    <div class="col-xxl-4 col-xl-6">
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
                                        <span class="badge bg-success rounded-pill">2.3%<i
                                                class="ti ti-arrow-up"></i></span>
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
                                        <span class="badge bg-danger rounded-pill">-1.5%<i
                                                class="ti ti-arrow-down"></i></span>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End:: Row-3 -->

            </div>
            <!--End::row-1 -->
        @endif


    </div>
@endsection


@section('page-scripts')
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->

    <script src="{{ asset('assets/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/js/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins-init/datatables.init.js') }}"></script>

    <script>
        const ctx = document.getElementById('billPaymentChart').getContext('2d');
        const chartData = @json($chartData);

        new Chart(ctx, {
            type: 'bar',
            data: chartData,
            options: {
                responsive: true,
                scales: {
                    x: {
                        beginAtZero: true
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

    <script>
        var chartData2 = @json($chartData2);

        var weeklyPerformance = function() {
            var optionsArea = {
                series: [{
                    name: "Payments",
                    data: chartData2
                }],
                chart: {
                    height: 250,
                    type: 'area',
                    group: 'social',
                    toolbar: {
                        show: false
                    },
                    zoom: {
                        enabled: false
                    },
                },
                dataLabels: {
                    enabled: false
                },
                legend: {
                    show: false,
                    tooltipHoverFormatter: function(val, opts) {
                        return val + ' - ' + opts.w.globals.series[opts.seriesIndex][opts.dataPointIndex] + ''
                    },
                    markers: {
                        fillColors: ['var(--primary)'],
                        width: 3,
                        height: 16,
                        strokeWidth: 0,
                        radius: 16
                    }
                },
                markers: {
                    size: [8, ],
                    strokeWidth: [4, ],
                    strokeColors: ['#fff'],
                    border: 4,
                    radius: 4,
                    colors: ['var(--primary)'],
                    hover: {
                        size: 10,
                    }
                },
                xaxis: {
                    categories: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                    labels: {
                        style: {
                            colors: '#3E4954',
                            fontSize: '14px',
                            fontFamily: 'Poppins',
                            fontWeight: 100,
                        },
                    },
                    axisBorder: {
                        show: false,
                    }
                },
                yaxis: {
                    labels: {
                        show: true,
                        align: 'right',
                        minWidth: 15,
                        offsetX: -16,
                        style: {
                            colors: '#666666',
                            fontSize: '14px',
                            fontFamily: 'Poppins',
                            fontWeight: 100,
                        },
                    },
                },
                fill: {
                    colors: ['#fff', 'var(--primary)'],
                    type: 'gradient',
                    opacity: 1,
                    gradient: {
                        shade: 'light',
                        shadeIntensity: 1,
                        colorStops: [
                            [{
                                    offset: 0,
                                    color: 'var(--primary)',
                                    opacity: 0.4
                                },
                                {
                                    offset: 0.6,
                                    color: 'var(--primary)',
                                    opacity: 0.25
                                },
                                {
                                    offset: 100,
                                    color: 'var(--primary)',
                                    opacity: 0
                                }
                            ],
                            [{
                                    offset: 0,
                                    color: 'var(--primary)',
                                    opacity: .4
                                },
                                {
                                    offset: 50,
                                    color: 'var(--primary)',
                                    opacity: 0.25
                                },
                                {
                                    offset: 100,
                                    color: '#fff',
                                    opacity: 0
                                }
                            ]
                        ]

                    },
                },
                colors: ['var(--primary)', 'var(--primary)'],
                stroke: {
                    curve: "straight",
                    width: 3,
                },
                grid: {
                    borderColor: '#e1dede',
                    strokeDashArray: 8,
                    xaxis: {
                        lines: {
                            show: true,
                            opacity: 0.5,
                        }
                    },
                    yaxis: {
                        lines: {
                            show: true,
                            opacity: 0.5,
                        }
                    },
                    row: {
                        colors: undefined,
                        opacity: 0.5
                    },
                    column: {
                        colors: undefined,
                        opacity: 0.5
                    },
                },
                responsive: [{
                    breakpoint: 1602,
                    options: {
                        markers: {
                            size: [6, 6, 4],
                            hover: {
                                size: 7,
                            }
                        },
                        chart: {
                            height: 230,
                        },
                    },

                }]
            };

            var chartArea = new ApexCharts(document.querySelector("#activity1"), optionsArea);
            chartArea.render();
        };

        weeklyPerformance();
    </script>

    <script>
        var chartData3 = @json($chartData3);

        var monthlyPerformance = function() {
            var optionsArea = {
                series: [{
                    name: "Payments",
                    data: chartData3
                }],
                chart: {
                    height: 250,
                    type: 'area',
                    group: 'social',
                    toolbar: {
                        show: false
                    },
                    zoom: {
                        enabled: false
                    },
                },
                dataLabels: {
                    enabled: false
                },
                legend: {
                    show: false,
                    tooltipHoverFormatter: function(val, opts) {
                        return val + ' - ' + opts.w.globals.series[opts.seriesIndex][opts.dataPointIndex] + ''
                    },
                    markers: {
                        fillColors: ['var(--primary)'],
                        width: 3,
                        height: 16,
                        strokeWidth: 0,
                        radius: 16
                    }
                },
                markers: {
                    size: [8],
                    strokeWidth: [4],
                    strokeColors: ['#fff'],
                    border: 4,
                    radius: 4,
                    colors: ['var(--primary)'],
                    hover: {
                        size: 10,
                    }
                },
                xaxis: {
                    categories: [
                        'January', 'February', 'March', 'April', 'May', 'June',
                        'July', 'August', 'September', 'October', 'November', 'December'
                    ],
                    labels: {
                        style: {
                            colors: '#3E4954',
                            fontSize: '14px',
                            fontFamily: 'Poppins',
                            fontWeight: 100,
                        },
                    },
                    axisBorder: {
                        show: false,
                    }
                },
                yaxis: {
                    labels: {
                        show: true,
                        align: 'right',
                        minWidth: 15,
                        offsetX: -16,
                        style: {
                            colors: '#666666',
                            fontSize: '14px',
                            fontFamily: 'Poppins',
                            fontWeight: 100,
                        },
                    },
                },
                fill: {
                    colors: ['#fff', 'var(--primary)'],
                    type: 'gradient',
                    opacity: 1,
                    gradient: {
                        shade: 'light',
                        shadeIntensity: 1,
                        colorStops: [
                            [{
                                    offset: 0,
                                    color: 'var(--primary)',
                                    opacity: 0.4
                                },
                                {
                                    offset: 0.6,
                                    color: 'var(--primary)',
                                    opacity: 0.25
                                },
                                {
                                    offset: 100,
                                    color: 'var(--primary)',
                                    opacity: 0
                                }
                            ],
                            [{
                                    offset: 0,
                                    color: 'var(--primary)',
                                    opacity: 0.4
                                },
                                {
                                    offset: 50,
                                    color: 'var(--primary)',
                                    opacity: 0.25
                                },
                                {
                                    offset: 100,
                                    color: '#fff',
                                    opacity: 0
                                }
                            ]
                        ]
                    },
                },
                colors: ['var(--primary)', 'var(--primary)'],
                stroke: {
                    curve: "straight",
                    width: 3,
                },
                grid: {
                    borderColor: '#e1dede',
                    strokeDashArray: 8,
                    xaxis: {
                        lines: {
                            show: true,
                            opacity: 0.5,
                        }
                    },
                    yaxis: {
                        lines: {
                            show: true,
                            opacity: 0.5,
                        }
                    },
                    row: {
                        colors: undefined,
                        opacity: 0.5
                    },
                    column: {
                        colors: undefined,
                        opacity: 0.5
                    },
                },
                responsive: [{
                    breakpoint: 1602,
                    options: {
                        markers: {
                            size: [6, 6, 4],
                            hover: {
                                size: 7,
                            }
                        },
                        chart: {
                            height: 230,
                        },
                    },
                }]
            };

            var chartArea = new ApexCharts(document.querySelector("#activity2"), optionsArea);
            chartArea.render();
        };

        monthlyPerformance();
    </script>

    <script>
        $(document).ready(function() {
            @foreach ($total['regions'] as $region)
                $('#file-export-{{ $region->id }}').DataTable({
                    'dom': 'ZBfrltip',
                    buttons: [

                        {
                            extend: 'excel',
                            text: '<i class="fa-solid fa-file-excel"></i> Export Report',
                            className: 'btn btn-sm border-0'
                        }
                    ],

                    searching: true,
                    pageLength: 12,
                    select: false,
                    lengthChange: false,
                    language: {
                        paginate: {
                            next: '<i class="fa-solid fa-angle-right"></i>',
                            previous: '<i class="fa-solid fa-angle-left"></i>'
                        },
                        'search': ' <i class="fa-solid fa-magnifying-glass"></i>',
                        searchPlaceholder: "Search..."

                    },
                });
            @endforeach
        });
    </script>

    <!-- Popper JS -->
    <script src="{{ asset('assets/libs/@popperjs/core/umd/popper.min.js') }}"></script>

    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Defaultmenu JS -->
    <script src="{{ asset('assets/js/defaultmenu.js') }}"></script>

    <!-- Node Waves JS-->
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>

    <!-- Sticky JS -->
    <script src="{{ asset('assets/js/sticky.js') }}"></script>

    <!-- Simplebar JS -->
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/js/simplebar.js') }}"></script>

    <!-- Auto Complete JS -->
    <script src="{{ asset('assets/libs/@tarekraafat/autocomplete.js/autoComplete.min.js') }}"></script>

    <!-- Color Picker JS -->
    <script src="{{ asset('assets/libs/@simonwep/pickr/pickr.es5.min.js') }}"></script>


    <!-- Apex Charts JS -->
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!-- Date & Time Picker JS -->
    <script src="{{ asset('assets/libs/flatpickr/flatpickr.min.js') }}"></script>

    <!-- Sales Dashboard -->
    <script src="{{ asset('assets/js/sales-dashboard.js') }}"></script>

    <!-- Custom JS -->
    <script src="{{ asset('assets/js/custom.js') }}"></script>


    <!-- Custom-Switcher JS -->
    <script src="{{ asset('assets/js/custom-switcher.js') }}"></script>
    <!-- Crypto Dashboard -->
    <script src="{{ asset('assets/js/crypto-dashboard.js') }}"></script>
    <!-- Popper JS -->
    <script src="{{ asset('assets/libs/@popperjs/core/umd/popper.min.js') }}"></script>

    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Defaultmenu JS -->
    <script src="{{ asset('assets/js/defaultmenu.js') }}"></script>

    <!-- Node Waves JS-->
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>

    <!-- Sticky JS -->
    <script src="{{ asset('assets/js/sticky.js') }}"></script>

    <!-- Simplebar JS -->
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/js/simplebar.js') }}"></script>

    <!-- Auto Complete JS -->
    <script src="{{ asset('assets/libs/@tarekraafat/autocomplete.js/autoComplete.min.js') }}"></script>

    <!-- Color Picker JS -->
    <script src="{{ asset('assets/libs/@simonwep/pickr/pickr.es5.min.js') }}"></script>


    <!-- Apex Charts JS -->
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!-- Swiper JS -->
    <script src="{{ asset('assets/libs/swiper/swiper-bundle.min.js') }}"></script>

    <!-- Echarts JS -->
    <script src="{{ asset('assets/libs/echarts/echarts.min.js') }}"></script>

    <!-- Crypto Dashboard -->
    <script src="{{ asset('assets/js/crypto-dashboard.js') }}"></script>

    <!-- Custom JS -->
    <script src="{{ asset('assets/js/custom.js') }}"></script>


    <!-- Custom-Switcher JS -->
    <script src="{{ asset('assets/js/custom-switcher.js') }}"></script>
    <!-- Swiper JS -->
    <script src="{{ asset('assets/libs/swiper/swiper-bundle.min.js') }}"></script>

    <!-- Internal Swiper JS -->
    <script src="{{ asset('assets/js/swiper.js') }}"></script>

    <script>
        const messages = [
            "Did You Know Paying your property rates helps drive National Development!",
            "Your contributions build better communities and infrastructure.",
            "Together, we create opportunities through your property rate payments.",
            "Support local growth by fulfilling your property rate obligations.",
            "Be a part of progress—your property rates make a difference!"
        ];

        let currentMessageIndex = 0;
        let currentCharIndex = 0;
        const messageElement = document.getElementById('message');

        function typeMessage() {
            if (currentCharIndex < messages[currentMessageIndex].length) {
                messageElement.textContent += messages[currentMessageIndex].charAt(currentCharIndex);
                currentCharIndex++;
                setTimeout(typeMessage, 100); // Adjust typing speed here
            } else {
                setTimeout(eraseMessage, 2000); // Pause before erasing
            }
        }

        function eraseMessage() {
            if (currentCharIndex > 0) {
                messageElement.textContent = messages[currentMessageIndex].substring(0, currentCharIndex - 1);
                currentCharIndex--;
                setTimeout(eraseMessage, 50); // Adjust erasing speed here
            } else {
                currentMessageIndex = (currentMessageIndex + 1) % messages.length;
                setTimeout(typeMessage, 1000); // Pause before typing the next message
            }
        }

        // Start typing the first message
        typeMessage();
    </script>
@endsection
