<div class="row mb-4">
    <div class="col-xxl-6 col-xl-6 col-lg-6">
        <div class="card custom-card overflow-hidden nft-main-card h-100">
            <div class="card-body d-flex align-items-center justify-content-center" style="height: 100%;">
                <div class="row gap-3 gap-sm-0 mx-0 py-3 rounded-3 w-100">
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
                                    class="text-secondary">
                                    IPTS</span> Dashboard!" </h4>
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
                            <img src="{{ asset('assets/images/gh.png') }}" alt=""
                                class="img-fluid nft-cardimg rounded-3">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xxl-6 col-xl-6 col-lg-6">
        <div class="card custom-card h-100">
            <div class="card-body">
                <div id='calendar'></div>
            </div>
        </div>
    </div>
</div>

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
                            <h4 class="fw-semibold mb-2"> {{ $total['totalAssembly'] }}</h4>
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
</div>

<div class="row">
    <div class="col-xxl-12">
        <div class="row">
            <div class="col-xl-3">
                <div class="card custom-card">
                    <div class="card-body">
                        <div class="d-flex align-items-start gap-3 flex-wrap">
                            <div>
                                <span class="avatar avatar-md avatar-rounded bg-primary shadow shadow-primary">
                                    <i class="ti ti-shopping-bag fs-5"></i>
                                </span>
                            </div>
                            <div class="flex-fill">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <span class="d-block"> Total Revenue Collected</span>
                                </div>
                                <h4 class="fw-semibold mb-3 lh-1">GHS {{ $total['yearlyPayments'] }}</h4>

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
                                <span class="avatar avatar-md avatar-rounded bg-secondary shadow shadow-secondary">
                                    <i class="ti ti-currency-dollar fs-5"></i>
                                </span>
                            </div>
                            <div class="flex-fill">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <span class="d-block">Total Revenue Growth</span>
                                </div>
                                <h4 class="fw-semibold mb-3 lh-1">{{ $total['newPercentage'] }}%</h4>

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
                                <span class="avatar avatar-md avatar-rounded bg-success shadow shadow-success">
                                    <i class="ti ti-box fs-5"></i>
                                </span>
                            </div>
                            <div class="flex-fill">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <span class="d-block"> Outstanding Payments</span>
                                </div>
                                <span class="d-block mb-2"></span>
                                <h4 class="fw-semibold mb-3 lh-1">GHS {{ $total['totalBill'] }}</h4>

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
                                <span class="avatar avatar-md avatar-rounded bg-info shadow shadow-info">
                                    <i class="ti ti-moneybag fs-5"></i>
                                </span>
                            </div>
                            <div class="flex-fill">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <span class="d-block"> Top Revenue by Momo</span>

                                </div>
                                <span class="d-block mb-2"></span>
                                <h4 class="fw-semibold mb-3 lh-1">36.75%</h4>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-xl-12">
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
        <div class="col-xxl-12 col-xl-12 col-lg-12">
            <div class="card custom-card">
                <div class="card-body">
                    <div class="mb-4 d-flex align-items-center justify-content-between bg-light p-2 px-3 rounded-3">
                        <h6 class="fw-semibold mb-0">Operational Information :</h6>
                        <button class="btn btn-primary btn-sm" type="button">View All</button>
                    </div>
                    <div
                        class="row row-cols-md-4 row-cols-sm-3 row-cols-xxl-auto personal-favourite-contacts mb-0 gap-2 flex-wrap">
                        <div class="col flex-fill">
                            <div class="d-flex align-items-center bg-primary-transparent rounded-pill p-2 pe-5">
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
                            <div class="d-flex align-items-center bg-secondary-transparent rounded-pill p-2 pe-5">
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
                            <div class="d-flex align-items-center bg-success-transparent rounded-pill p-2 pe-5">
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

    <div class="row">
        <div class="col-xl-3">
            <div class="card custom-card profit-analysis-card">
                <div class="card-body p-0">
                    <div class="p-4 pb-1">
                        <h4 class="mb-1 d-flex align-items-center fw-semibold flex-wrap">GHS
                            {{ $total['totalExpectedPayments'] }}<span class="text-success fw-medium fs-12 ms-2"><i
                                    class="ti ti-arrow-up align-middle me-1"></i> </span> </h4>
                        <span class="fs-14 d-block">Expected Revenue </span>
                    </div>
                    <div id="profit-analysis"></div>
                    <div id="profit-analysis1"></div>
                    <div id="profit-analysis2"></div>
                </div>
            </div>
            <div class="card custom-card" style="height: 238px">
                <div class="card-header">
                    <div class="card-title">
                        Bills And Payments

                    </div>
                </div>
                <div class="card-body">
                    <div class="progress-stacked progress-sm mb-4 mt-2 gap-1">
                        <div class="progress-bar rounded" role="progressbar" style="width: 45%" aria-valuenow="45"
                            aria-valuemin="0" aria-valuemax="100"></div>
                        <div class="progress-bar bg-secondary rounded" role="progressbar" style="width: 25%"
                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        <div class="progress-bar bg-success rounded" role="progressbar" style="width: 30%"
                            aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <ul class="list-unstyled sales-traffic-list">
                        <li>
                            <div class="d-flex align-items-center flex-wrap justify-content-between">
                                <div class="fw-semibold"> Bills</div>
                                <div class="fw-semibold">GHS
                                    {{ $total['totalBill'] }}</div>
                            </div>
                        </li>
                        <li>
                            <div class="d-flex align-items-center flex-wrap justify-content-between">
                                <div class="fw-semibold">Arrears</div>
                                <div class="fw-semibold">GHS
                                    {{ $total['totalArrears'] }} </div>
                            </div>
                        </li>
                        <li>
                            <div class="d-flex align-items-center flex-wrap justify-content-between">
                                <div class="fw-semibold">Revenue</div>
                                <div class="fw-semibold">GHS
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
                    <div id="sales-statistics1" class="p-3"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xxl-12">
        <div class="row">
            {{-- <div class="col-xl-12">
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
                        @endphp
                        <div class="row justify-content-center mt-4 p-3 gx-xl-1 gx-xxl-3">
                            <div class="col col-xl-4 border-end border-inline-end-dashed">
                                <span class="d-block text-muted mb-1 fs-12">Assembly Fund - (70%)</span>
                                <span class="fw-semibold h6 mb-0 text-center">GHS {{ $total['assemblycut'] }}
                                    <i class="ti ti-arrow-up text-success"></i></span>
                            </div>
                            <div class="col col-xl-4 border-end border-inline-end-dashed">
                                <span class="d-block text-muted mb-1 fs-12">GRA - (15%)</span>
                                <span class="fw-semibold h6 mb-0 text-center">GHS {{ $total['gracut'] }}
                                    <i class="ti ti-arrow-down text-danger"></i></span>
                            </div>
                            <div class="col col-xl-4">
                                <span class="d-block text-muted mb-1 fs-12">Level 10 - (15%)</span>
                                <span class="fw-semibold h6 mb-0 text-center">GHS
                                    {{ $total['level10cut'] }}<i class="ti ti-arrow-up text-success"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
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
