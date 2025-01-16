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
                        <div class="fw-medium mb-2">Total Revenue Collected </div>
                        <h4 class="fw-semibold mb-0 lh-1">{{ $total['lastMonthPayments'] }}</h4>
                    </div>
                    <div class="ms-auto text-end align-self-end">
                        <div class="avatar avatar-md avatar-rounded bg-primary shadow shadow-primary mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                class="svg-icon-med text-fixed-white" fill="currentColor" viewBox="0 0 256 256">
                                <path d="M136,108A52,52,0,1,1,84,56,52,52,0,0,1,136,108Z" opacity="0.2"></path>
                                <path
                                    d="M117.25,157.92a60,60,0,1,0-66.5,0A95.83,95.83,0,0,0,3.53,195.63a8,8,0,1,0,13.4,8.74,80,80,0,0,1,134.14,0,8,8,0,0,0,13.4-8.74A95.83,95.83,0,0,0,117.25,157.92ZM40,108a44,44,0,1,1,44,44A44.05,44.05,0,0,1,40,108Zm210.14,98.7a8,8,0,0,1-11.07-2.33A79.83,79.83,0,0,0,172,168a8,8,0,0,1,0-16,44,44,0,1,0-16.34-84.87,8,8,0,1,1-5.94-14.85,60,60,0,0,1,55.53,105.64,95.83,95.83,0,0,1,47.22,37.71A8,8,0,0,1,250.14,206.7Z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <span class="text-danger fw-medium fs-13 mb-2">
                                <i class="ti ti-arrow-down"></i>GHS
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
                        <div class="avatar avatar-md avatar-rounded bg-secondary shadow shadow-secondary mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                class="svg-icon-med text-fixed-white" fill="currentColor" viewBox="0 0 256 256">
                                <path d="M240,160a32,32,0,1,1-32-32A32,32,0,0,1,240,160Z" opacity="0.2"></path>
                                <path
                                    d="M220,160a12,12,0,1,1-12-12A12,12,0,0,1,220,160Zm-4.55,39.29A48.08,48.08,0,0,1,168,240H144a48.05,48.05,0,0,1-48-48V151.49A64,64,0,0,1,40,88V40a8,8,0,0,1,8-8H72a8,8,0,0,1,0,16H56V88a48,48,0,0,0,48.64,48c26.11-.34,47.36-22.25,47.36-48.83V48H136a8,8,0,0,1,0-16h24a8,8,0,0,1,8,8V87.17c0,32.84-24.53,60.29-56,64.31V192a32,32,0,0,0,32,32h24a32.06,32.06,0,0,0,31.22-25,40,40,0,1,1,16.23.27ZM232,160a24,24,0,1,0-24,24A24,24,0,0,0,232,160Z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <span class="text-success fw-medium fs-13 mb-2">
                                <i class="ti ti-arrow-up"></i>GHS
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
                        <div class="avatar avatar-md avatar-rounded bg-success shadow shadow-success mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                class="svg-icon-med text-fixed-white" fill="currentColor" viewBox="0 0 256 256">
                                <path d="M216,48V88H40V48a8,8,0,0,1,8-8H208A8,8,0,0,1,216,48Z" opacity="0.2"></path>
                                <path
                                    d="M208,32H184V24a8,8,0,0,0-16,0v8H88V24a8,8,0,0,0-16,0v8H48A16,16,0,0,0,32,48V208a16,16,0,0,0,16,16H208a16,16,0,0,0,16-16V48A16,16,0,0,0,208,32ZM72,48v8a8,8,0,0,0,16,0V48h80v8a8,8,0,0,0,16,0V48h24V80H48V48ZM208,208H48V96H208V208Zm-48-56a8,8,0,0,1-8,8H136v16a8,8,0,0,1-16,0V160H104a8,8,0,0,1,0-16h16V128a8,8,0,0,1,16,0v16h16A8,8,0,0,1,160,152Z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <span class="text-danger fw-medium fs-13 mb-2">
                                <i class="ti ti-arrow-down"></i>GHS
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
                        <div class="avatar avatar-md avatar-rounded bg-info shadow shadow-info mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                class="svg-icon-med text-fixed-white" fill="currentColor" viewBox="0 0 256 256">
                                <path
                                    d="M168,144a40,40,0,1,1-40-40A40,40,0,0,1,168,144ZM64,56A32,32,0,1,0,96,88,32,32,0,0,0,64,56Zm128,0a32,32,0,1,0,32,32A32,32,0,0,0,192,56Z"
                                    opacity="0.2"></path>
                                <path
                                    d="M244.8,150.4a8,8,0,0,1-11.2-1.6A51.6,51.6,0,0,0,192,128a8,8,0,0,1,0-16,24,24,0,1,0-23.24-30,8,8,0,1,1-15.5-4A40,40,0,1,1,219,117.51a67.94,67.94,0,0,1,27.43,21.68A8,8,0,0,1,244.8,150.4ZM190.92,212a8,8,0,1,1-13.85,8,57,57,0,0,0-98.15,0,8,8,0,1,1-13.84-8,72.06,72.06,0,0,1,33.74-29.92,48,48,0,1,1,58.36,0A72.06,72.06,0,0,1,190.92,212ZM128,176a32,32,0,1,0-32-32A32,32,0,0,0,128,176ZM72,120a8,8,0,0,0-8-8A24,24,0,1,1,87.24,82a8,8,0,1,0,15.5-4A40,40,0,1,0,37,117.51,67.94,67.94,0,0,0,9.6,139.19a8,8,0,1,0,12.8,9.61A51.6,51.6,0,0,1,64,128,8,8,0,0,0,72,120Z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <span class="text-danger fw-medium fs-13 mb-2">
                                <i class="ti ti-arrow-down"></i>GHS
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
