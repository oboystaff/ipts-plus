<div class="accordion customized-accordion accordions-items-separate" id="customizedAccordion">
    <div class="accordion-item custom-accordion-primary">
        <h2 class="accordion-header" id="customizedAccordionOne">
            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                data-bs-target="#customized-AccordionOne" aria-expanded="true" aria-controls="customized-AccordionOne">
                Financial Overview
            </button>
        </h2>
        <div id="customized-AccordionOne" class="accordion-collapse collapse show"
            aria-labelledby="customizedAccordionOne" data-bs-parent="#customizedAccordion">
            <div class="accordion-body">
                <div class="row">
                    <div class="col-xxl-12">
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
                                                <div class="d-flex align-items-center justify-content-between mb-2">
                                                    <span class="d-block"> Yearly BoP Bill</span>
                                                    <span class="badge bg-success-transparent rounded-pill">0.25%<i
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
                                                <div class="d-flex align-items-center justify-content-between mb-2">
                                                    <span class="d-block">Total Property Bill </span>
                                                    <span class="badge bg-success-transparent rounded-pill">5.44%<i
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
                                                <div class="d-flex align-items-center justify-content-between mb-2">
                                                    <span class="d-block">Yearly Revenue </span>
                                                    <span class="badge bg-danger-transparent rounded-pill">12.34%<i
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
                                                <div class="d-flex align-items-center justify-content-between mb-2">
                                                    <span class="d-block"> Cash Collections </span>
                                                    <span class="badge bg-success-transparent rounded-pill">2.12%<i
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
                    <div class="col-xxl-12 col-xl-12">
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
                                                    <img src="../assets/images/flags/india_flag.jpg" alt=""
                                                        class="rounded-circle">
                                                </span>
                                            </div>
                                            <div class="flex-fill">
                                                <div class="d-flex mb-2 justify-content-between align-items-center">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <span class="fw-semibold d-block">Overall Yearly Momo
                                                            Payment</span>
                                                    </div>
                                                    <div class="fw-medium"><span class="text-danger me-1"><i
                                                                class="ti ti-arrow-down align-middle"></i></span><span>GHS
                                                            {{ $total['yearlyMomoPayments'] }}</span>
                                                        (65%)</div>
                                                </div>
                                                <div class="progress progress-xs progress-animate" role="progressbar"
                                                    aria-valuenow="65" aria-valuemin="0" aria-valuemax="100">
                                                    <div class="progress-bar" style="width: 65%"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="lh-1">
                                                <span class="avatar avatar-md bg-light p-2">
                                                    <img src="../assets/images/flags/russia_flag.jpg" alt=""
                                                        class="rounded-circle">
                                                </span>
                                            </div>
                                            <div class="flex-fill">
                                                <div class="d-flex mb-2 justify-content-between align-items-center">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <span class="fw-semibold d-block">Total Yearly
                                                            Payments</span>
                                                    </div>
                                                    <div class="fw-medium"><span class="text-success me-1"><i
                                                                class="ti ti-arrow-up align-middle"></i></span><span>GHS
                                                            {{ $total['yearlyPayments'] }}</span>
                                                        (55%)</div>
                                                </div>
                                                <div class="progress progress-xs progress-animate" role="progressbar"
                                                    aria-valuenow="55" aria-valuemin="0" aria-valuemax="100">
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
                                                    <img src="../assets/images/flags/canada_flag.jpg" alt=""
                                                        class="rounded-circle">
                                                </span>
                                            </div>
                                            <div class="flex-fill">
                                                <div class="d-flex mb-2 justify-content-between align-items-center">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <span class="fw-semibold d-block">Total
                                                            Receivables</span>
                                                    </div>
                                                    <div class="fw-medium"><span class="text-danger me-1"><i
                                                                class="ti ti-arrow-down align-middle"></i></span><span>>GHS
                                                            {{ $total['yearlyReceivables'] }}</span>
                                                        (69%)</div>
                                                </div>
                                                <div class="progress progress-xs progress-animate" role="progressbar"
                                                    aria-valuenow="69" aria-valuemin="0" aria-valuemax="100">
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
                                        style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                    <div class="progress-bar bg-success rounded" role="progressbar"
                                        style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                </div>
                                <ul class="list-unstyled sales-traffic-list">
                                    <li>
                                        <div class="d-flex align-items-center flex-wrap justify-content-between">
                                            <div class="fw-semibold">Total Properties</div>
                                            <div class="fw-semibold"><span
                                                    class="text-success fs-11 fw-medium me-2 d-inline-block"><i
                                                        class="ti ti-arrow-up alilgn-middle me-1"></i>0.56%</span>{{ $total['totalProperties'] }}
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex align-items-center flex-wrap justify-content-between">
                                            <div class="fw-semibold">Valued </div>
                                            <div class="fw-semibold"><span
                                                    class="text-success fs-11 fw-medium me-2 d-inline-block"><i
                                                        class="ti ti-arrow-up alilgn-middle me-1"></i>0.00%</span>0
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex align-items-center flex-wrap justify-content-between">
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
                                        style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                    <div class="progress-bar bg-success rounded" role="progressbar"
                                        style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                </div>
                                <ul class="list-unstyled sales-traffic-list">
                                    <li>
                                        <div class="d-flex align-items-center flex-wrap justify-content-between">
                                            <div class="fw-semibold">Total Businessess</div>
                                            <div class="fw-semibold"><span
                                                    class="text-success fs-11 fw-medium me-2 d-inline-block"><i
                                                        class="ti ti-arrow-up alilgn-middle me-1"></i>0.56%</span>{{ $total['totalBusinesses'] }}
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex align-items-center flex-wrap justify-content-between">
                                            <div class="fw-semibold">Validated</div>
                                            <div class="fw-semibold"><span
                                                    class="text-success fs-11 fw-medium me-2 d-inline-block"><i
                                                        class="ti ti-arrow-up alilgn-middle me-1"></i>0.00%</span>0
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex align-items-center flex-wrap justify-content-between">
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
                                        style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                    <div class="progress-bar bg-success rounded" role="progressbar"
                                        style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                </div>
                                <ul class="list-unstyled sales-traffic-list">
                                    <li>
                                        <div class="d-flex align-items-center flex-wrap justify-content-between">
                                            <div class="fw-semibold">Total Assemblies</div>
                                            <div class="fw-semibold"><span
                                                    class="text-success fs-11 fw-medium me-2 d-inline-block"><i
                                                        class="ti ti-arrow-up alilgn-middle me-1"></i>0.56%</span>{{ $total['totalAssembly'] }}
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex align-items-center flex-wrap justify-content-between">
                                            <div class="fw-semibold">Active </div>
                                            <div class="fw-semibold"><span
                                                    class="text-success fs-11 fw-medium me-2 d-inline-block"><i
                                                        class="ti ti-arrow-up alilgn-middle me-1"></i>0.00%</span>0
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex align-items-center flex-wrap justify-content-between">
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
                                aria-controls="collapse{{ $index }}" aria-expanded="false" role="button">
                                <span class="accordion-header-icon"></span>
                                <span class="accordion-header-text">{{ $region->name }}</span>
                                <span class="accordion-header-indicator"></span>
                            </div>
                            <div id="collapse{{ $index }}" class="collapse"
                                aria-labelledby="heading{{ $index }}" data-bs-parent="#accordion-regions">
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
                                                            $totalReceivables = $totalBills - $totalPayments;
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
