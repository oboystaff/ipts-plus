<div class="row">
    <div class="col-xxl-6 col-xl-6">
        <div class="card custom-card overflow-hidden">
            <div class="card-body">
                <div class="d-flex flex-wrap gap-1 flex-xxl-nowrap">
                    <div class="flex-fill d-flex gap-2 align-items-center">
                        <div class="flex-shrink-0 avatar avatar-sm bg-pink-transparent avatar-rounded">
                            <i class="ri-money-dollar-circle-line fs-5 lh-1"></i>
                        </div>
                        <p class="mb-0 fw-medium">Total Revenue Collected</p>
                    </div>
                    <div class="text-end ms-auto">
                        <h4 class="mb-0 fw-semibold">GHS {{ $total['dailyPayments'] }}</h4>
                    </div>
                </div>
            </div>
            <div class="d-flex gap-2 align-items-center flex-wrap bg-pink-transparent justify-content-between">
                <div id="widget-chart-1"></div>
                <div class="text-end pe-3">
                    <span class="text-muted fw-medium fs-12">Daily</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xxl-6 col-xl-6">
        <div class="card custom-card overflow-hidden">
            <div class="card-body">
                <div class="d-flex flex-wrap gap-1 flex-xxl-nowrap">
                    <div class="flex-fill d-flex gap-2 align-items-center">
                        <div class="flex-shrink-0 avatar avatar-sm bg-primary-transparent avatar-rounded">
                            <i class="ri-money-dollar-circle-line fs-5 lh-1"></i>
                        </div>
                        <p class="mb-0 fw-medium">Total Revenue Collected</p>
                    </div>
                    <div class="text-end ms-auto">
                        <h4 class="mb-0 fw-semibold">GHS {{ $total['weeklyPayments'] }}</h4>
                    </div>
                </div>
            </div>
            <div class="d-flex gap-2 align-items-center flex-wrap bg-primary-transparent justify-content-between">
                <div id="widget-chart-2"></div>
                <div class="text-end pe-3">
                    <span class="text-muted fw-medium fs-12">Weekly</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xxl-6 col-xl-6">
        <div class="card custom-card overflow-hidden">
            <div class="card-body">
                <div class="d-flex flex-wrap gap-1 flex-xxl-nowrap">
                    <div class="flex-fill d-flex gap-2 align-items-center">
                        <div class="flex-shrink-0 avatar avatar-sm bg-secondary-transparent avatar-rounded">
                            <i class="ri-money-dollar-circle-line fs-5 lh-1"></i>
                        </div>
                        <p class="mb-0 fw-medium">Total Revenue Collected </p>
                    </div>
                    <div class="text-end ms-auto">
                        <h4 class="mb-0 fw-semibold">GHS {{ $total['monthlyPayments'] }}</h4>
                    </div>
                </div>
            </div>
            <div class="d-flex gap-2 align-items-center flex-wrap bg-secondary-transparent justify-content-between">
                <div id="widget-chart-3"></div>
                <div class="text-end pe-3">
                    <span class="text-muted fw-medium fs-12">Monthly</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xxl-6 col-xl-6">
        <div class="card custom-card overflow-hidden">
            <div class="card-body">
                <div class="d-flex flex-wrap gap-1 flex-xxl-nowrap">
                    <div class="flex-fill d-flex gap-2 align-items-center">
                        <div class="flex-shrink-0 avatar avatar-sm bg-success-transparent avatar-rounded">
                            <i class="ri-money-dollar-circle-line fs-5 lh-1"></i>
                        </div>
                        <p class="mb-0 fw-medium">Total Revenue Collected </p>
                    </div>
                    <div class="text-end ms-auto">
                        <h4 class="mb-0 fw-semibold">GHS {{ $total['yearlyPayments'] }}</h4>
                    </div>
                </div>
            </div>
            <div class="d-flex gap-2 align-items-center flex-wrap bg-success-transparent justify-content-between">
                <div id="widget-chart-4"></div>
                <div class="text-end pe-3">
                    <span class="text-muted fw-medium fs-12">Yearly</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-3">
        <div class="card custom-card rounded-md overflow-hidden p-2">
            <div class="card-body bg-primary bg-opacity-10 rounded-2 ps-4 medical-cards">
                <div class="d-flex gap-2 align-items-center ps-2">
                    <div class="align-self-start">
                        <div class="fw-medium mb-2">Total Payments </div>
                        <h4 class="fw-semibold mb-0 lh-1">{{ $total['lastMonthPayments'] }}</h4>
                    </div>
                    <div class="ms-auto text-end align-self-end">

                        <div>
                            <span class="text-danger fw-medium fs-13 mb-2">
                                GHS
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3">
        <div class="card custom-card rounded-md overflow-hidden p-2">
            <div class="card-body bg-secondary bg-opacity-10 rounded-2 ps-4 medical-cards secondary">
                <div class="d-flex gap-2 align-items-center ps-2">
                    <div class="align-self-start">
                        <div class="fw-medium mb-2">Total property tax</div>
                        <h4 class="fw-semibold mb-0 lh-1">{{ $total['lastMonthPropertyBill'] }}</h4>
                    </div>
                    <div class="ms-auto text-end align-self-end">
                        <div>
                            <span class="text-success fw-medium fs-13 mb-2">
                                GHS
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3">
        <div class="card custom-card rounded-md overflow-hidden p-2">
            <div class="card-body bg-success bg-opacity-10 rounded-2 ps-4 medical-cards success">
                <div class="d-flex gap-2 align-items-center ps-2">
                    <div class="align-self-start">
                        <div class="fw-medium mb-2">Total BoP</div>
                        <h4 class="fw-semibold mb-0 lh-1">{{ $total['lastMonthBusinessBill'] }}</h4>
                    </div>
                    <div class="ms-auto text-end align-self-end">
                        <div>
                            <span class="text-danger fw-medium fs-13 mb-2">
                                GHS
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3">
        <div class="card custom-card rounded-md overflow-hidden p-2">
            <div class="card-body bg-info bg-opacity-10 rounded-2 ps-4 medical-cards info">
                <div class="d-flex gap-2 align-items-center ps-2">
                    <div class="align-self-start">
                        <div class="fw-medium mb-2">Total market tolls</div>
                        <h4 class="fw-semibold mb-0 lh-1">0.00</h4>
                    </div>
                    <div class="ms-auto text-end align-self-end">
                        <div>
                            <span class="text-danger fw-medium fs-13 mb-2">
                                GHS
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xxl-12">
        <div class="card custom-card">
            <div class="card-body p-4">
                <div class="d-flex gap-3 align-items-center mb-2 justify-content-between">
                    <p class="mb-0 fw-semibold">Revenue Overview</p>
                </div>
                <h3 class="d-inline-block me-2">{{ $total['completedPercentage'] }}%</h3><span
                    class="text-muted fs-12 align-middle">Generated Bills</span>
                <div class="d-flex align-items-center mb-1 justify-content-between">
                    <div>Revenue Progress</div>
                </div>
                <div class="progress-stacked progress-sm mb-3 mt-2 gap-1">
                    <div class="progress-bar rounded" role="progressbar"
                        style="width: <?= $total['completedPercentage'] ?>%"
                        aria-valuenow="<?= $total['completedPercentage'] ?>" aria-valuemin="0" aria-valuemax="100">
                    </div>
                    <div class="progress-bar bg-secondary rounded" role="progressbar"
                        style="width: <?= $total['upcomingPercentage'] ?>%"
                        aria-valuenow="<?= $total['upcomingPercentage'] ?>" aria-valuemin="0" aria-valuemax="100">
                    </div>
                    <div class="progress-bar bg-success rounded" role="progressbar"
                        style="width: <?= $total['newPercentage'] ?>%" aria-valuenow="<?= $total['newPercentage'] ?>"
                        aria-valuemin="0" aria-valuemax="100">
                    </div>
                </div>
                <div class="d-flex gap-3 align-items-start justify-content-between flex-wrap flex-xxl-nowrap">
                    <div class="text-center">
                        <div class="flex-shrink-0 avatar avatar-md bg-primary-transparent avatar-rounded mb-2">
                            <i class="ri-file-list-3-fill fs-15 lh-1"></i>
                        </div>
                        <div class="fw-semibold mb-1">
                            Generated Bills
                        </div>
                        <span class="text-muted fs-14 fw-medium">{{ $total['completedPercentage'] }}%</span>
                        <div class="fw-semibold mt-1">
                            {{ $total['totalCompletedBill'] }} Bills
                        </div>
                    </div>
                    <div class="text-center">
                        <div class="flex-shrink-0 avatar avatar-md bg-secondary-transparent avatar-rounded mb-2">
                            <i class="ri-file-list-3-fill fs-15 lh-1"></i>
                        </div>
                        <div class="fw-semibold mb-1">
                            Arrears
                        </div>
                        <span class="text-muted fs-14 fw-medium">{{ $total['upcomingPercentage'] }}%</span>
                        <div class="fw-semibold mt-1">
                            {{ $total['totalUpcomingBill'] }} Arrears On Bills
                        </div>
                    </div>
                    <div class="text-center">
                        <div class="flex-shrink-0 avatar avatar-md bg-success-transparent avatar-rounded mb-2">
                            <i class="ri-file-list-3-fill fs-15 lh-1"></i>
                        </div>
                        <div class="fw-semibold mb-1">
                            Payments
                        </div>
                        <span class="text-muted fs-14 fw-medium">{{ $total['newPercentage'] }}%</span>
                        <div class="fw-semibold mt-1">
                            {{ $total['totalNewBill'] }} Payments On Bills
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-6">
        <div class="card custom-card">
            <div class="card-header">
                <div class="card-title">Revenue Trends Chart</div>
            </div>
            <div class="card-body">
                <div id="column-basic"></div>
            </div>
        </div>
    </div>

    <div class="col-xl-6">
        <div class="card custom-card">
            <div class="card-header">
                <div class="card-title">Top Performing Assemblies (GHS)</div>
            </div>
            <div class="card-body">
                <div id="column-datalabels"></div>
            </div>
        </div>
    </div>

    <div class="col-xl-6">
        <div class="card custom-card">
            <div class="card-header">
                <div class="card-title">Outstanding Payments</div>
            </div>
            <div class="card-body">
                <div id="column-stacked"></div>
            </div>
        </div>
    </div>

    <div class="col-xl-6">
        <div class="card custom-card">
            <div class="card-header">
                <div class="card-title">Total Registered Rate Payers Chart</div>
            </div>
            <div class="card-body">
                <div id="column-stacked-full"></div>
            </div>
        </div>
    </div>

    <div class="col-xl-6">
        <div class="card custom-card">
            <div class="card-header">
                <div class="card-title">Active vs. Inactive Rate Payers</div>
            </div>
            <div class="card-body">
                <div id="column-markers"></div>
            </div>
        </div>
    </div>

    <div class="col-xl-6">
        <div class="card custom-card">
            <div class="card-header">
                <div class="card-title">Property/Business Registration Trend</div>
            </div>
            <div class="card-body">
                <div id="column-rotated-labels"></div>
            </div>
        </div>
    </div>

    <div class="col-xl-6">
        <div class="card custom-card">
            <div class="card-header">
                <div class="card-title">Top Contributing Properties/Businesses</div>
            </div>
            <div class="card-body">
                <div id="column-negative"></div>
            </div>
        </div>
    </div>

    <div class="col-xl-6">
        <div class="card custom-card">
            <div class="card-header">
                <div class="card-title">Revenue by Location Chart</div>
            </div>
            <div class="card-body">
                <div id="column-range" style="height: 418px;"></div>
            </div>
        </div>
    </div>

    <div class="col-xl-6">
        <div class="card custom-card">
            <div class="card-header">
                <div class="card-title">Arrears Chart</div>
            </div>
            <div class="card-body">
                <div id="chart-arrears"></div>
            </div>
        </div>
    </div>

    <div class="col-xl-6">
        <div class="card custom-card">
            <div class="card-header">
                <div class="card-title">Collection Efficiency Chart</div>
            </div>
            <div class="card-body">
                <div id="collection-chart"></div>
            </div>
        </div>
    </div>
</div>
