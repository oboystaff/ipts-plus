@extends('layout.base')

@section('page-styles')
@endsection

@section('page-content')

    <div class="container-fluid">
        <div class="row">
            @if (\Auth::user()->access_level !== 'customer' && \Auth::user()->access_level !== 'GRA_Administrator')
                <div class="col-xl-2 col-xxl-3 col-sm-6">
                    <div class="card crm-cart bg-secondary border-0">
                        <div class="card-header border-0 pb-0">
                            <span class="text-white fs-16">Total Business Bill<i
                                    class="fa-solid fa-chevron-up ms-1"></i></span>
                            <div class="icon-box bg-white">
                                <svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <text x="0" y="16" font-size="20" font-family="Arial, sans-serif" fill="var(--primary)">
                                        ₵
                                    </text>
                                </svg>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="crm-cart-data">
                                <p>GHS {{ $total['totalBusinessBill'] }}</p>
                                <span class="d-block mb-3 text-black">Overall Yearly Business Bill</span>
                                <a href="{{ route('bills.fetchBill', ['display' => 'business']) }}"
                                    class="badge bg-white text-black border-0">View Data</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-xxl-3 col-sm-6">
                    <div class="card crm-cart bg-secondary border-0">
                        <div class="card-header border-0 pb-0">
                            <span class="text-white fs-16">Total Property Bill<i
                                    class="fa-solid fa-chevron-up ms-1"></i></span>
                            <div class="icon-box bg-white">
                                <svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <text x="0" y="16" font-size="20" font-family="Arial, sans-serif" fill="var(--primary)">
                                        ₵
                                    </text>
                                </svg>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="crm-cart-data">
                                <p>GHS {{ $total['totalPropertyBill'] }}</p>
                                <span class="d-block mb-3 text-black">Overall Yearly Property Bill</span>
                                <a href="{{ route('bills.fetchBill', ['display' => 'property']) }}"
                                    class="badge bg-white text-black border-0">View Data</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-xxl-3 col-sm-4">
                    <div class="card crm-cart bg-primary border-0">
                        <div class="card-header border-0 pb-0">
                            <span class="text-white fs-16">Total Business<i class="fa-solid fa-chevron-up ms-1"></i></span>
                            <div class="icon-box bg-white">
                                <svg id="_x31__px" height="24" viewBox="0 0 24 24" width="24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="m17.5 13c-3.584 0-6.5-2.916-6.5-6.5s2.916-6.5 6.5-6.5 6.5 2.916 6.5 6.5-2.916 6.5-6.5 6.5zm0-12c-3.033 0-5.5 2.467-5.5 5.5s2.467 5.5 5.5 5.5 5.5-2.467 5.5-5.5-2.467-5.5-5.5-5.5z" />
                                    <path
                                        d="m17.5 10c-.276 0-.5-.224-.5-.5v-6c0-.276.224-.5.5-.5s.5.224.5.5v6c0 .276-.224.5-.5.5z" />
                                    <path
                                        d="m20.5 7h-6c-.276 0-.5-.224-.5-.5s.224-.5.5-.5h6c.276 0 .5.224.5.5s-.224.5-.5.5z" />
                                    <path
                                        d="m19.5 17h-13c-.238 0-.443-.168-.49-.402l-2-10c-.03-.147.009-.299.103-.415.095-.116.237-.183.387-.183h4c.276 0 .5.224.5.5s-.224.5-.5.5h-3.39l1.8 9h12.18l.277-1.385c.054-.271.317-.448.588-.392.271.054.446.317.392.588l-.357 1.787c-.047.234-.252.402-.49.402z" />
                                    <path
                                        d="m6.5 17c-.233 0-.442-.164-.49-.402l-2.479-12.394c-.14-.699-.759-1.206-1.471-1.206h-.001l-1.559.002c-.276 0-.5-.224-.5-.5s.223-.5.5-.5l1.558-.002h.002c1.188 0 2.219.845 2.452 2.01l2.478 12.394c.054.271-.122.534-.392.588-.033.007-.066.01-.098.01z" />
                                    <path
                                        d="m21.5 19h-17c-.827 0-1.5-.673-1.5-1.5s.673-1.5 1.5-1.5h2c.276 0 .5.224.5.5s-.224.5-.5.5h-2c-.276 0-.5.224-.5.5s.224.5.5.5h17c.276 0 .5.224.5.5s-.224.5-.5.5z" />
                                    <path
                                        d="m8 24c-1.103 0-2-.897-2-2s.897-2 2-2 2 .897 2 2-.897 2-2 2zm0-3c-.551 0-1 .449-1 1s.449 1 1 1 1-.449 1-1-.449-1-1-1z" />
                                    <path
                                        d="m17 24c-1.103 0-2-.897-2-2s.897-2 2-2 2 .897 2 2-.897 2-2 2zm0-3c-.551 0-1 .449-1 1s.449 1 1 1 1-.449 1-1-.449-1-1-1z" />
                                </svg>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="crm-cart-data">
                                <p class="text-white">{{ $total['totalBusinesses'] }}</p>
                                <span class="d-block mb-3 text-white">Total Businesses</span>
                                <a href="{{ route('businesses.index', ['display' => 'active']) }}"
                                    class="badge bg-white text-black border-0">View Data</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-2 col-xxl-3 col-sm-4">
                    <div class="card crm-cart bg-primary border-0">
                        <div class="card-header border-0 pb-0">
                            <span class="text-white fs-16">Total Property<i class="fa-solid fa-chevron-up ms-1"></i></span>
                            <div class="icon-box bg-white">
                                <svg id="_x31__px" height="24" viewBox="0 0 24 24" width="24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="m17.5 13c-3.584 0-6.5-2.916-6.5-6.5s2.916-6.5 6.5-6.5 6.5 2.916 6.5 6.5-2.916 6.5-6.5 6.5zm0-12c-3.033 0-5.5 2.467-5.5 5.5s2.467 5.5 5.5 5.5 5.5-2.467 5.5-5.5-2.467-5.5-5.5-5.5z" />
                                    <path
                                        d="m17.5 10c-.276 0-.5-.224-.5-.5v-6c0-.276.224-.5.5-.5s.5.224.5.5v6c0 .276-.224.5-.5.5z" />
                                    <path
                                        d="m20.5 7h-6c-.276 0-.5-.224-.5-.5s.224-.5.5-.5h6c.276 0 .5.224.5.5s-.224.5-.5.5z" />
                                    <path
                                        d="m19.5 17h-13c-.238 0-.443-.168-.49-.402l-2-10c-.03-.147.009-.299.103-.415.095-.116.237-.183.387-.183h4c.276 0 .5.224.5.5s-.224.5-.5.5h-3.39l1.8 9h12.18l.277-1.385c.054-.271.317-.448.588-.392.271.054.446.317.392.588l-.357 1.787c-.047.234-.252.402-.49.402z" />
                                    <path
                                        d="m6.5 17c-.233 0-.442-.164-.49-.402l-2.479-12.394c-.14-.699-.759-1.206-1.471-1.206h-.001l-1.559.002c-.276 0-.5-.224-.5-.5s.223-.5.5-.5l1.558-.002h.002c1.188 0 2.219.845 2.452 2.01l2.478 12.394c.054.271-.122.534-.392.588-.033.007-.066.01-.098.01z" />
                                    <path
                                        d="m21.5 19h-17c-.827 0-1.5-.673-1.5-1.5s.673-1.5 1.5-1.5h2c.276 0 .5.224.5.5s-.224.5-.5.5h-2c-.276 0-.5.224-.5.5s.224.5.5.5h17c.276 0 .5.224.5.5s-.224.5-.5.5z" />
                                    <path
                                        d="m8 24c-1.103 0-2-.897-2-2s.897-2 2-2 2 .897 2 2-.897 2-2 2zm0-3c-.551 0-1 .449-1 1s.449 1 1 1 1-.449 1-1-.449-1-1-1z" />
                                    <path
                                        d="m17 24c-1.103 0-2-.897-2-2s.897-2 2-2 2 .897 2 2-.897 2-2 2zm0-3c-.551 0-1 .449-1 1s.449 1 1 1 1-.449 1-1-.449-1-1-1z" />
                                </svg>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="crm-cart-data">
                                <p class="text-white">{{ $total['totalProperties'] }}</p>
                                <span class="d-block mb-3 text-white">Total Properties</span>
                                <a href="{{ route('properties.index') }}" class="badge bg-white text-black border-0">View
                                    Data</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-4">
                    <div class="card sale-card">
                        <div class="card-header pb-0 border-0 align-items-baseline">
                            <div>
                                <span>Total Assembly Agents</span>
                                <h4>{{ $total['totalAssemblyAgents'] }} <i class="fa-solid fa-arrow-trend-up ms-1"></i></h4>
                            </div>
                            <a href="{{ route('users.index', ['display' => 'agent']) }}"
                                class="badge badge-primary border-0">View
                                Data<i class="fa-solid fa-caret-up ms-1"></i></a>
                        </div>
                        <div class="card-body p-0 custome-tooltip">
                            <div id="totalSale"></div>
                        </div>
                        <div class="card-footer border-0">
                            <span class="tag bg-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                                    <polyline points="17 6 23 6 23 12"></polyline>
                                </svg>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="card sale-card">
                        <div class="card-header pb-0 border-0 align-items-baseline">
                            <div>
                                <span>Total Active Assembly Agents</span>
                                <h4>{{ $total['totalActiveAssemblyAgents'] }} <i
                                        class="fa-solid fa-arrow-trend-down ms-1"></i>
                                </h4>
                            </div>
                            <a href="{{ route('users.index', ['display' => 'active']) }}"
                                class="badge badge-secondary border-0">View Data<i
                                    class="fa-solid fa-caret-down ms-1"></i></a>
                        </div>
                        <div class="card-body p-0 custome-tooltip">
                            <div id="totalPurchase"></div>
                        </div>
                        <div class="card-footer border-0">
                            <span class="tag bg-secondary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                                    <polyline points="17 6 23 6 23 12"></polyline>
                                </svg>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="card sale-card">
                        <div class="card-header pb-0 border-0 align-items-baseline">
                            <div>
                                <span>Total In-Active Assembly Agents</span>
                                <h4>{{ $total['totalInactiveAssemblyAgents'] }} <i
                                        class="fa-solid fa-arrow-trend-down ms-1"></i></h4>
                            </div>
                            <a href="{{ route('users.index', ['display' => 'inactive']) }}"
                                class="badge badge-info border-0">View Data<i class="fa-solid fa-caret-down ms-1"></i></a>
                        </div>
                        <div class="card-body p-0 custome-tooltip">
                            <div id="activeCustomers"></div>
                        </div>
                        <div class="card-footer border-0">
                            <span class="tag bg-info">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                                    <polyline points="17 6 23 6 23 12"></polyline>
                                </svg>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-3">
                    <div class="card sale-card">
                        <div class="card-header pb-0 border-0 align-items-baseline">
                            <div>
                                <span>Total Daily Payments</span>
                                <h4>GHS {{ $total['dailyPayments'] }} <i class="fa-solid fa-arrow-trend-up ms-1"></i></h4>
                            </div>
                            <a href="{{ route('payments.index', ['display' => 'daily']) }}"
                                class="badge badge-primary border-0">View
                                Data<i class="fa-solid fa-caret-up ms-1"></i></a>
                        </div>
                        <div class="card-body p-0 custome-tooltip">
                            <div id="totalSale"></div>
                        </div>
                        <div class="card-footer border-0">
                            <span class="tag bg-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                                    <polyline points="17 6 23 6 23 12"></polyline>
                                </svg>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-3">
                    <div class="card sale-card">
                        <div class="card-header pb-0 border-0 align-items-baseline">
                            <div>
                                <span>Total Weekly Payments</span>
                                <h4>GHS {{ $total['weeklyPayments'] }} <i class="fa-solid fa-arrow-trend-down ms-1"></i>
                                </h4>
                            </div>
                            <a href="{{ route('payments.index', ['display' => 'weekly']) }}"
                                class="badge badge-secondary border-0">View Data<i
                                    class="fa-solid fa-caret-down ms-1"></i></a>
                        </div>
                        <div class="card-body p-0 custome-tooltip">
                            <div id="totalPurchase"></div>
                        </div>
                        <div class="card-footer border-0">
                            <span class="tag bg-secondary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                                    <polyline points="17 6 23 6 23 12"></polyline>
                                </svg>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-3">
                    <div class="card sale-card">
                        <div class="card-header pb-0 border-0 align-items-baseline">
                            <div>
                                <span>Total Monthly Payments</span>
                                <h4>GHS {{ $total['monthlyPayments'] }} <i class="fa-solid fa-arrow-trend-down ms-1"></i>
                                </h4>
                            </div>
                            <a href="{{ route('payments.index', ['display' => 'monthly']) }}"
                                class="badge badge-info border-0">View Data<i class="fa-solid fa-caret-down ms-1"></i></a>
                        </div>
                        <div class="card-body p-0 custome-tooltip">
                            <div id="activeCustomers"></div>
                        </div>
                        <div class="card-footer border-0">
                            <span class="tag bg-info">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                                    <polyline points="17 6 23 6 23 12"></polyline>
                                </svg>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-3">
                    <div class="card sale-card">
                        <div class="card-header pb-0 border-0 align-items-baseline">
                            <div>
                                <span>Total Yearly Payments</span>
                                <h4>GHS {{ $total['yearlyPayments'] }} <i class="fa-solid fa-arrow-trend-down ms-1"></i>
                                </h4>
                            </div>
                            <a href="{{ route('payments.index', ['display' => 'yearly']) }}"
                                class="badge badge-secondary border-0">View Data<i
                                    class="fa-solid fa-caret-down ms-1"></i></a>
                        </div>
                        <div class="card-body p-0 custome-tooltip">
                            <div id="activeCustomers"></div>
                        </div>
                        <div class="card-footer border-0">
                            <span class="tag bg-secondary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                                    <polyline points="17 6 23 6 23 12"></polyline>
                                </svg>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-12 col-sm-12">
                    <div class="card overflow-hidden">
                        <div class="text-center p-5 overlay-box" style="background-image: url(images/big/img5.jpg);">
                            <img src="images/profile/profile.png" width="100" class="img-fluid rounded-circle"
                                alt="">
                            <h3 class="mt-3 mb-0 text-white">Bills And Payments</h3>
                        </div>
                        <div class="card-body">
                            <div class="row text-center">
                                <div class="col-6">
                                    <div class="bgl-primary rounded p-3">
                                        <h4 class="mb-0">GHS {{ $total['totalBill'] }}</h4>
                                        <small>Total Bills</small>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="bgl-primary rounded p-3">
                                        <h4 class="mb-0">GHS {{ $total['totalArrears'] }}</h4>
                                        <small>Arrears </small>
                                    </div>
                                </div>
                                <p></p>
                            </div>

                            <div class="row text-center">
                                <div class="col-6">
                                    <div class="bgl-primary rounded p-3">
                                        <h4 class="mb-0">GHS {{ $total['totalExpectedPayments'] }}</h4>
                                        <small>Expected Payments</small>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="bgl-primary rounded p-3">
                                        <h4 class="mb-0">GHS {{ $total['yearlyPayments'] }}</h4>
                                        <small>Actual Payments</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer mt-0">
                            <a href="{{ route('bills.fetchBill', ['display' => 'fetch_bill']) }}"
                                class="btn btn-primary btn-lg btn-block">
                                View Detailed Analysis
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="card">
                        <div class="card-header border-0">
                            <h4 class="heading mb-0">Weekly Payments Performance</h4>
                        </div>
                        <div class="card-body py-0 custome-tooltip">
                            <div id="activity1"></div>
                        </div>
                        <div class="card-footer border-0 pt-0">
                            <a href="{{ route('payments.index') }}" class="btn btn-primary btn-block">Explore Details</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="card">
                        <div class="card-header border-0">
                            <h4 class="heading mb-0">Monthly Payments Performance</h4>
                        </div>
                        <div class="card-body py-0 custome-tooltip">
                            <div id="activity2"></div>
                        </div>
                        <div class="card-footer border-0 pt-0">
                            <a href="{{ route('payments.index') }}" class="btn btn-primary btn-block">Explore Details</a>
                        </div>
                    </div>
                </div>

                <div class="col-xl-12">
                    <div class="card overflow-hidden">
                        <div class="card-header border-0">
                            <div>
                                <h4 class="heading mb-0">Revenue Payment Analysis</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-12 col-sm-12">
                                    <canvas id="billPaymentChart" height="100"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @elseif (\Auth::user()->access_level == 'GRA_Administrator')
                <div class="col-xl-2 col-xxl-3 col-sm-6">
                    <div class="card crm-cart bg-secondary border-0">
                        <div class="card-header border-0 pb-0">
                            <span class="text-white fs-16">Total Business Bill<i
                                    class="fa-solid fa-chevron-up ms-1"></i></span>
                            <div class="icon-box bg-white">
                                <svg width="20" height="20" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <text x="0" y="16" font-size="20" font-family="Arial, sans-serif"
                                        fill="var(--primary)">
                                        ₵
                                    </text>
                                </svg>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="crm-cart-data">
                                <p>GHS {{ $total['totalBusinessBill'] }}</p>
                                <span class="d-block mb-3 text-black">Overall Yearly Business Bill</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-2 col-xxl-3 col-sm-6">
                    <div class="card crm-cart bg-secondary border-0">
                        <div class="card-header border-0 pb-0">
                            <span class="text-white fs-16">Total Property Bill<i
                                    class="fa-solid fa-chevron-up ms-1"></i></span>
                            <div class="icon-box bg-white">
                                <svg width="20" height="20" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <text x="0" y="16" font-size="20" font-family="Arial, sans-serif"
                                        fill="var(--primary)">
                                        ₵
                                    </text>
                                </svg>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="crm-cart-data">
                                <p>GHS {{ $total['totalPropertyBill'] }}</p>
                                <span class="d-block mb-3 text-black">Overall Yearly Property Bill</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-2 col-xxl-3 col-sm-4">
                    <div class="card crm-cart bg-secondary border-0">
                        <div class="card-header border-0 pb-0">
                            <span class="text-white fs-16">Total Bills<i class="fa-solid fa-chevron-up ms-1"></i></span>
                            <div class="icon-box bg-white">
                                <svg id="_x31__px" height="24" viewBox="0 0 24 24" width="24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <text x="0" y="16" font-size="20" font-family="Arial, sans-serif"
                                        fill="var(--primary)">
                                        ₵
                                    </text>
                                </svg>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="crm-cart-data">
                                <p class="text-black">GHS {{ $total['totalBill'] }}</p>
                                <span class="d-block mb-3 text-black">Overall Yearly Total Bills</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-2 col-xxl-3 col-sm-4">
                    <div class="card crm-cart bg-secondary border-0">
                        <div class="card-header border-0 pb-0">
                            <span class="text-white fs-16">Total Cash Payment<i
                                    class="fa-solid fa-chevron-up ms-1"></i></span>
                            <div class="icon-box bg-white">
                                <svg id="_x31__px" height="24" viewBox="0 0 24 24" width="24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <text x="0" y="16" font-size="20" font-family="Arial, sans-serif"
                                        fill="var(--primary)">
                                        ₵
                                    </text>
                                </svg>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="crm-cart-data">
                                <p class="text-black">GHS {{ $total['yearlyCashPayments'] }}</p>
                                <span class="d-block mb-3 text-black">Overall Yearly Cash Payment</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-2 col-xxl-3 col-sm-4">
                    <div class="card crm-cart bg-primary border-0">
                        <div class="card-header border-0 pb-0">
                            <span class="text-white fs-16">Total Momo Payment<i
                                    class="fa-solid fa-chevron-up ms-1"></i></span>
                            <div class="icon-box bg-white">
                                <svg id="_x31__px" height="24" viewBox="0 0 24 24" width="24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <text x="0" y="16" font-size="20" font-family="Arial, sans-serif"
                                        fill="var(--primary)">
                                        ₵
                                    </text>
                                </svg>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="crm-cart-data">
                                <p class="text-white">GHS {{ $total['yearlyMomoPayments'] }}</p>
                                <span class="d-block mb-3 text-white">Overall Yearly Momo Payment</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-2 col-xxl-3 col-sm-4">
                    <div class="card crm-cart bg-primary border-0">
                        <div class="card-header border-0 pb-0">
                            <span class="text-white fs-16">Total Payment<i class="fa-solid fa-chevron-up ms-1"></i></span>
                            <div class="icon-box bg-white">
                                <svg id="_x31__px" height="24" viewBox="0 0 24 24" width="24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <text x="0" y="16" font-size="20" font-family="Arial, sans-serif"
                                        fill="var(--primary)">
                                        ₵
                                    </text>
                                </svg>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="crm-cart-data">
                                <p class="text-white">GHS {{ $total['yearlyPayments'] }}</p>
                                <span class="d-block mb-3 text-white">Overall Yearly Total Payment</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-2 col-xxl-3 col-sm-4">
                    <div class="card crm-cart bg-primary border-0">
                        <div class="card-header border-0 pb-0">
                            <span class="text-white fs-16">Total Receivables<i
                                    class="fa-solid fa-chevron-up ms-1"></i></span>
                            <div class="icon-box bg-white">
                                <svg id="_x31__px" height="24" viewBox="0 0 24 24" width="24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <text x="0" y="16" font-size="20" font-family="Arial, sans-serif"
                                        fill="var(--primary)">
                                        ₵
                                    </text>
                                </svg>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="crm-cart-data">
                                <p class="text-white">GHS {{ $total['yearlyReceivables'] }}</p>
                                <span class="d-block mb-3 text-white">Overall Yearly Total Receivables</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-2 col-xxl-3 col-sm-4">
                    <div class="card crm-cart bg-primary border-0">
                        <div class="card-header border-0 pb-0">
                            <span class="text-white fs-16">Total Business<i
                                    class="fa-solid fa-chevron-up ms-1"></i></span>
                            <div class="icon-box bg-white">
                                <svg id="_x31__px" height="24" viewBox="0 0 24 24" width="24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="m17.5 13c-3.584 0-6.5-2.916-6.5-6.5s2.916-6.5 6.5-6.5 6.5 2.916 6.5 6.5-2.916 6.5-6.5 6.5zm0-12c-3.033 0-5.5 2.467-5.5 5.5s2.467 5.5 5.5 5.5 5.5-2.467 5.5-5.5-2.467-5.5-5.5-5.5z" />
                                    <path
                                        d="m17.5 10c-.276 0-.5-.224-.5-.5v-6c0-.276.224-.5.5-.5s.5.224.5.5v6c0 .276-.224.5-.5.5z" />
                                    <path
                                        d="m20.5 7h-6c-.276 0-.5-.224-.5-.5s.224-.5.5-.5h6c.276 0 .5.224.5.5s-.224.5-.5.5z" />
                                    <path
                                        d="m19.5 17h-13c-.238 0-.443-.168-.49-.402l-2-10c-.03-.147.009-.299.103-.415.095-.116.237-.183.387-.183h4c.276 0 .5.224.5.5s-.224.5-.5.5h-3.39l1.8 9h12.18l.277-1.385c.054-.271.317-.448.588-.392.271.054.446.317.392.588l-.357 1.787c-.047.234-.252.402-.49.402z" />
                                    <path
                                        d="m6.5 17c-.233 0-.442-.164-.49-.402l-2.479-12.394c-.14-.699-.759-1.206-1.471-1.206h-.001l-1.559.002c-.276 0-.5-.224-.5-.5s.223-.5.5-.5l1.558-.002h.002c1.188 0 2.219.845 2.452 2.01l2.478 12.394c.054.271-.122.534-.392.588-.033.007-.066.01-.098.01z" />
                                    <path
                                        d="m21.5 19h-17c-.827 0-1.5-.673-1.5-1.5s.673-1.5 1.5-1.5h2c.276 0 .5.224.5.5s-.224.5-.5.5h-2c-.276 0-.5.224-.5.5s.224.5.5.5h17c.276 0 .5.224.5.5s-.224.5-.5.5z" />
                                    <path
                                        d="m8 24c-1.103 0-2-.897-2-2s.897-2 2-2 2 .897 2 2-.897 2-2 2zm0-3c-.551 0-1 .449-1 1s.449 1 1 1 1-.449 1-1-.449-1-1-1z" />
                                    <path
                                        d="m17 24c-1.103 0-2-.897-2-2s.897-2 2-2 2 .897 2 2-.897 2-2 2zm0-3c-.551 0-1 .449-1 1s.449 1 1 1 1-.449 1-1-.449-1-1-1z" />
                                </svg>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="crm-cart-data">
                                <p class="text-white">{{ $total['totalBusinesses'] }}</p>
                                <span class="d-block mb-3 text-white">Total Businesses</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-2 col-xxl-3 col-sm-4">
                    <div class="card crm-cart bg-success border-0">
                        <div class="card-header border-0 pb-0">
                            <span class="text-white fs-16">Total Property<i
                                    class="fa-solid fa-chevron-up ms-1"></i></span>
                            <div class="icon-box bg-white">
                                <svg id="_x31__px" height="24" viewBox="0 0 24 24" width="24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="m17.5 13c-3.584 0-6.5-2.916-6.5-6.5s2.916-6.5 6.5-6.5 6.5 2.916 6.5 6.5-2.916 6.5-6.5 6.5zm0-12c-3.033 0-5.5 2.467-5.5 5.5s2.467 5.5 5.5 5.5 5.5-2.467 5.5-5.5-2.467-5.5-5.5-5.5z" />
                                    <path
                                        d="m17.5 10c-.276 0-.5-.224-.5-.5v-6c0-.276.224-.5.5-.5s.5.224.5.5v6c0 .276-.224.5-.5.5z" />
                                    <path
                                        d="m20.5 7h-6c-.276 0-.5-.224-.5-.5s.224-.5.5-.5h6c.276 0 .5.224.5.5s-.224.5-.5.5z" />
                                    <path
                                        d="m19.5 17h-13c-.238 0-.443-.168-.49-.402l-2-10c-.03-.147.009-.299.103-.415.095-.116.237-.183.387-.183h4c.276 0 .5.224.5.5s-.224.5-.5.5h-3.39l1.8 9h12.18l.277-1.385c.054-.271.317-.448.588-.392.271.054.446.317.392.588l-.357 1.787c-.047.234-.252.402-.49.402z" />
                                    <path
                                        d="m6.5 17c-.233 0-.442-.164-.49-.402l-2.479-12.394c-.14-.699-.759-1.206-1.471-1.206h-.001l-1.559.002c-.276 0-.5-.224-.5-.5s.223-.5.5-.5l1.558-.002h.002c1.188 0 2.219.845 2.452 2.01l2.478 12.394c.054.271-.122.534-.392.588-.033.007-.066.01-.098.01z" />
                                    <path
                                        d="m21.5 19h-17c-.827 0-1.5-.673-1.5-1.5s.673-1.5 1.5-1.5h2c.276 0 .5.224.5.5s-.224.5-.5.5h-2c-.276 0-.5.224-.5.5s.224.5.5.5h17c.276 0 .5.224.5.5s-.224.5-.5.5z" />
                                    <path
                                        d="m8 24c-1.103 0-2-.897-2-2s.897-2 2-2 2 .897 2 2-.897 2-2 2zm0-3c-.551 0-1 .449-1 1s.449 1 1 1 1-.449 1-1-.449-1-1-1z" />
                                    <path
                                        d="m17 24c-1.103 0-2-.897-2-2s.897-2 2-2 2 .897 2 2-.897 2-2 2zm0-3c-.551 0-1 .449-1 1s.449 1 1 1 1-.449 1-1-.449-1-1-1z" />
                                </svg>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="crm-cart-data">
                                <p class="text-white">{{ $total['totalProperties'] }}</p>
                                <span class="d-block mb-3 text-white">Total Properties</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-2 col-xxl-3 col-sm-4">
                    <div class="card crm-cart bg-success border-0">
                        <div class="card-header border-0 pb-0">
                            <span class="text-white fs-16">Total Active Assembly<i
                                    class="fa-solid fa-chevron-up ms-1"></i></span>
                            <div class="icon-box bg-white">
                                <svg id="_x31__px" height="24" viewBox="0 0 24 24" width="24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="m17.5 13c-3.584 0-6.5-2.916-6.5-6.5s2.916-6.5 6.5-6.5 6.5 2.916 6.5 6.5-2.916 6.5-6.5 6.5zm0-12c-3.033 0-5.5 2.467-5.5 5.5s2.467 5.5 5.5 5.5 5.5-2.467 5.5-5.5-2.467-5.5-5.5-5.5z" />
                                    <path
                                        d="m17.5 10c-.276 0-.5-.224-.5-.5v-6c0-.276.224-.5.5-.5s.5.224.5.5v6c0 .276-.224.5-.5.5z" />
                                    <path
                                        d="m20.5 7h-6c-.276 0-.5-.224-.5-.5s.224-.5.5-.5h6c.276 0 .5.224.5.5s-.224.5-.5.5z" />
                                    <path
                                        d="m19.5 17h-13c-.238 0-.443-.168-.49-.402l-2-10c-.03-.147.009-.299.103-.415.095-.116.237-.183.387-.183h4c.276 0 .5.224.5.5s-.224.5-.5.5h-3.39l1.8 9h12.18l.277-1.385c.054-.271.317-.448.588-.392.271.054.446.317.392.588l-.357 1.787c-.047.234-.252.402-.49.402z" />
                                    <path
                                        d="m6.5 17c-.233 0-.442-.164-.49-.402l-2.479-12.394c-.14-.699-.759-1.206-1.471-1.206h-.001l-1.559.002c-.276 0-.5-.224-.5-.5s.223-.5.5-.5l1.558-.002h.002c1.188 0 2.219.845 2.452 2.01l2.478 12.394c.054.271-.122.534-.392.588-.033.007-.066.01-.098.01z" />
                                    <path
                                        d="m21.5 19h-17c-.827 0-1.5-.673-1.5-1.5s.673-1.5 1.5-1.5h2c.276 0 .5.224.5.5s-.224.5-.5.5h-2c-.276 0-.5.224-.5.5s.224.5.5.5h17c.276 0 .5.224.5.5s-.224.5-.5.5z" />
                                    <path
                                        d="m8 24c-1.103 0-2-.897-2-2s.897-2 2-2 2 .897 2 2-.897 2-2 2zm0-3c-.551 0-1 .449-1 1s.449 1 1 1 1-.449 1-1-.449-1-1-1z" />
                                    <path
                                        d="m17 24c-1.103 0-2-.897-2-2s.897-2 2-2 2 .897 2 2-.897 2-2 2zm0-3c-.551 0-1 .449-1 1s.449 1 1 1 1-.449 1-1-.449-1-1-1z" />
                                </svg>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="crm-cart-data">
                                <p class="text-white">{{ $total['totalAssembly'] }}</p>
                                <span class="d-block mb-3 text-white">Total Active Assemblies</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-12">
                    <div class="card dz-card" id="accordion-one">
                        <div class="card-header flex-wrap border-0">
                            <div>
                                <h4 class="card-title">Assemblies By Region</h4>
                            </div>
                        </div>

                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="Preview" role="tabpanel"
                                aria-labelledby="home-tab">
                                <div class="card-body pt-0">
                                    <!-- Default accordion -->
                                    <div class="accordion accordion-primary" id="accordion-regions">
                                        @foreach ($total['regions'] as $index => $region)
                                            <div class="accordion-item">
                                                <div class="accordion-header rounded-lg" id="heading{{ $index }}"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#collapse{{ $index }}"
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
                                                            <table class="table table-bordered table-striped">
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
                                                                            $totalBills = $assembly->bills->sum(
                                                                                'amount',
                                                                            );
                                                                            $totalBillsCount = isset($totalBills)
                                                                                ? number_format($totalBills, 2)
                                                                                : 0;
                                                                            $totalPayments = $assembly->payments
                                                                                ->filter(function ($payment) {
                                                                                    if (
                                                                                        $payment->payment_mode == 'momo'
                                                                                    ) {
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
                </div>
            @elseif (\Auth::user()->access_level == 'customer')
                <div class="col-xl-4 col-lg-12 col-sm-12">
                    <div class="card overflow-hidden">
                        <div class="text-center p-5 overlay-box">
                            <h3 class="mt-3 mb-0 text-white">Property Rate</h3>
                        </div>
                        <div class="card-body">
                            <div class="row text-center">
                                <div class="col-6">
                                    <div class="bgl-primary rounded p-3">
                                        <h4 class="mb-0">GHS {{ $customerData['totalBillP'] }}</h4>
                                        <small>Total Bills</small>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="bgl-primary rounded p-3">
                                        <h4 class="mb-0">GHS {{ $customerData['totalArrearsP'] }}</h4>
                                        <small>Arrears </small>
                                    </div>
                                </div>
                                <p></p>
                            </div>

                            <div class="row text-center">
                                <div class="col-6">
                                    <div class="bgl-primary rounded p-3">
                                        <h4 class="mb-0">GHS {{ $customerData['totalExpectedPaymentsP'] }}</h4>
                                        <small>Expected Payments</small>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="bgl-primary rounded p-3">
                                        <h4 class="mb-0">GHS {{ $customerData['yearlyPaymentsP'] }}</h4>
                                        <small>Actual Payments</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer mt-0">
                            <a href="#analysis-section" class="btn btn-primary btn-lg btn-block">
                                View Detailed Analysis
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-12 col-sm-12">
                    <div class="card overflow-hidden">
                        <div class="text-center p-5 overlay-box">
                            <h3 class="mt-3 mb-0 text-white">Business Operating Permit</h3>
                        </div>
                        <div class="card-body">
                            <div class="row text-center">
                                <div class="col-6">
                                    <div class="bgl-primary rounded p-3">
                                        <h4 class="mb-0">GHS {{ $customerData['totalBillB'] }}</h4>
                                        <small>Total Bills</small>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="bgl-primary rounded p-3">
                                        <h4 class="mb-0">GHS {{ $customerData['totalArrearsB'] }}</h4>
                                        <small>Arrears </small>
                                    </div>
                                </div>
                                <p></p>
                            </div>

                            <div class="row text-center">
                                <div class="col-6">
                                    <div class="bgl-primary rounded p-3">
                                        <h4 class="mb-0">GHS {{ $customerData['totalExpectedPaymentsB'] }}</h4>
                                        <small>Expected Payments</small>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="bgl-primary rounded p-3">
                                        <h4 class="mb-0">GHS {{ $customerData['yearlyPaymentsB'] }}</h4>
                                        <small>Actual Payments</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer mt-0">
                            <a href="#analysis-section" class="btn btn-primary btn-lg btn-block">
                                View Detailed Analysis
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-12 col-sm-12">
                    <div class="card overflow-hidden">
                        <div class="text-center p-5 overlay-box">
                            <h3 class="mt-3 mb-0 text-white">Market Toll</h3>
                        </div>
                        <div class="card-body">
                            <div class="row text-center">
                                <div class="col-6">
                                    <div class="bgl-primary rounded p-3">
                                        <h4 class="mb-0">GHS {{ $total['totalBill'] }}</h4>
                                        <small>Total Bills</small>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="bgl-primary rounded p-3">
                                        <h4 class="mb-0">GHS {{ $total['totalArrears'] }}</h4>
                                        <small>Arrears </small>
                                    </div>
                                </div>
                                <p></p>
                            </div>

                            <div class="row text-center">
                                <div class="col-6">
                                    <div class="bgl-primary rounded p-3">
                                        <h4 class="mb-0">GHS {{ $total['totalExpectedPayments'] }}</h4>
                                        <small>Expected Payments</small>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="bgl-primary rounded p-3">
                                        <h4 class="mb-0">GHS {{ $total['yearlyPayments'] }}</h4>
                                        <small>Actual Payments</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer mt-0">
                            <a href="#analysis-section" class="btn btn-primary btn-lg btn-block">
                                View Detailed Analysis
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-xl-12 active-p">

                    <div class="card">

                        <div class="card-header flex-wrap d-flex justify-content-between">
                            <div>
                                <h4 class="heading mb-0">Customer Properties</h4>
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
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($customerData['properties'] as $index => $property)
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
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <th colspan="10"></th>
                                        <th>Total (GHS)</th>
                                        <th>{{ $customerData['total'] }}</th>
                                        <th colspan="6"></th>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-12 active-p">
                    <div class="card">

                        <div class="card-header flex-wrap d-flex justify-content-between">
                            <div>
                                <h4 class="heading mb-0">Customer Businesses</h4>
                            </div>
                        </div>

                        <div class="card-body px-0">
                            <div class="table-responsive active-projects user-tbl2  dt-filter">
                                <table id="user-tbl2" class="table shorting">
                                    <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Business Name</th>
                                            <th>Business Type</th>
                                            <th>Business Class</th>
                                            <th>Location</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Business Owner</th>
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
                                        @foreach ($customerData['businesses'] as $index => $business)
                                            @php
                                                $firstname = $business->customer->first_name ?? '';
                                                $lastname = $business->customer->last_name ?? '';
                                                $fullname = $firstname . ' ' . $lastname;
                                            @endphp

                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $business->business_name }}</td>
                                                <td>{{ $business->businessType->name ?? '' }}</td>
                                                <td>{{ $business->businessClass->name ?? '' }}</td>
                                                <td>{{ $business->location }}</td>
                                                <td>{{ $business->email }}</td>
                                                <td>{{ $business->business_phone }}</td>
                                                <td>{{ $fullname ?? '' }}</td>
                                                <td>{{ $business->assembly->name ?? 'N/A' }}</td>
                                                <td>{{ $business->division->division_name ?? 'N/A' }}</td>
                                                <td>{{ $business->block->block_name ?? 'N/A' }}</td>
                                                <td>{{ $business->zone->name ?? 'N/A' }}</td>
                                                <td>{{ $business->propertyUse->name ?? 'N/A' }}</td>
                                                <td>{{ $business->createdBy->name ?? 'N/A' }}</td>
                                                <td>{{ $business->created_at }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-12 active-p" id="analysis-section">
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-list" role="tabpanel"
                            aria-labelledby="pills-list-tab">
                            <div class="card">

                                <div class="card-header flex-wrap d-flex justify-content-between">
                                    <div>
                                        <h4 class="heading mb-0">Customer Bills</h4>
                                    </div>
                                </div>

                                <div class="card-body px-0">
                                    <div class="table-responsive active-projects user-tbl3  dt-filter">
                                        <table id="user-tbl3" class="table shorting">
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
                                                    <th>Created By</th>
                                                    <th>Date Created</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($customerData['bills'] as $index => $bill)
                                                    @php
                                                        $billType = '';

                                                        if ($bill->property_id !== null) {
                                                            $firstname = $bill->property->customer->first_name ?? '';
                                                            $lastname = $bill->property->customer->last_name ?? '';
                                                            $billType = 'Property Bill';
                                                        } else {
                                                            $firstname = $bill->business->customer->first_name ?? '';
                                                            $lastname = $bill->business->customer->last_name ?? '';
                                                            $billType = 'Business Bill';
                                                        }
                                                        $name = $firstname . ' ' . $lastname;
                                                    @endphp

                                                    <tr class="btn-reveal-trigger">
                                                        <td>{{ $index + 1 }}</td>
                                                        <td>{{ $bill->bills_id }}</td>
                                                        <td>{{ $name ?? '' }}</td>
                                                        <td>{{ $bill->billing_date }}</td>
                                                        <td>{{ $bill->bills_year }}</td>
                                                        @if ($bill->property_id !== null)
                                                            <td>
                                                                <span class="badge light badge-success">
                                                                    {{ $billType }}
                                                                </span>
                                                            </td>
                                                        @else
                                                            <td>
                                                                <span class="badge light badge-warning">
                                                                    {{ $billType }}
                                                                </span>
                                                            </td>
                                                        @endif
                                                        <td>{{ number_format($bill->arrears, 2) }}</td>
                                                        <td>{{ number_format($bill->amount, 2) }}</td>
                                                        <td>{{ number_format($bill->amount + $bill->arrears, 2) }}
                                                        </td>
                                                        <td>{{ $bill->createdBy->name ?? 'N/A' }}</td>
                                                        <td>{{ $bill->created_at }}</td>
                                                        <td>
                                                            <div class="dropdown">
                                                                <div class="btn-link" data-bs-toggle="dropdown"
                                                                    aria-expanded="false">
                                                                    <svg width="24" height="24"
                                                                        viewBox="0 0 24 24" fill="none"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M11 12C11 12.5523 11.4477 13 12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12Z"
                                                                            stroke="#737B8B" stroke-width="2"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round">
                                                                        </path>
                                                                        <path
                                                                            d="M18 12C18 12.5523 18.4477 13 19 13C19.5523 13 20 12.5523 20 12C20 11.4477 19.5523 11 19 11C18.4477 11 18 11.4477 18 12Z"
                                                                            stroke="#737B8B" stroke-width="2"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round">
                                                                        </path>
                                                                        <path
                                                                            d="M4 12C4 12.5523 4.44772 13 5 13C5.55228 13 6 12.5523 6 12C6 11.4477 5.55228 11 5 11C4.44772 11 4 11.4477 4 12Z"
                                                                            stroke="#737B8B" stroke-width="2"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round">
                                                                        </path>
                                                                    </svg>
                                                                </div>
                                                                <div class="dropdown-menu dropdown-menu-end">
                                                                    <div class="py-2">
                                                                        <a class="dropdown-item"
                                                                            href=" {{ route('payments.customerCreate', $bill) }}">Make
                                                                            Payment
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="5"></th>
                                                    <th>Total (GHS)</th>
                                                    <th>{{ $customerData['totalArrears'] }}</th>
                                                    <th>{{ $customerData['totalAmount'] }}</th>
                                                    <th>{{ $customerData['totalDue'] }}</th>
                                                    <th colspan="3"></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-12 active-p">

                    @if (session()->has('status'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor"
                                stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                class="me-2">
                                <polyline points="9 11 12 14 22 4"></polyline>
                                <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                            </svg>
                            <strong>{{ session('status') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="btn-close"><span><i class="fa-solid fa-xmark"></i></span>
                            </button>
                        </div>
                    @endif

                    <div class="card">

                        <div class="card-header flex-wrap d-flex justify-content-between">
                            <div>
                                <h4 class="heading mb-0">Customer Payments</h4>
                            </div>
                        </div>

                        <div class="card-body px-0">
                            <div class="table-responsive active-projects user-tbl4  dt-filter">
                                <table id="user-tbl4" class="table shorting">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>Bills ID</th>
                                            <th>Name</th>
                                            <th>Amount</th>
                                            <th>Payment Mode</th>
                                            <th>Status</th>
                                            <th>Assembly</th>
                                            <th>Paid By</th>
                                            <th>Payment Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($customerData['payments'] as $index => $payment)
                                            @php
                                                $name = '';
                                                if ($payment->bill->property && $payment->bill->property->customer) {
                                                    $firstname = $payment->bill->property->customer->first_name ?? '';
                                                    $lastname = $payment->bill->property->customer->last_name ?? '';
                                                    $name = $firstname . ' ' . $lastname;
                                                } elseif (
                                                    $payment->bill->business &&
                                                    $payment->bill->business->customer
                                                ) {
                                                    $firstname = $payment->bill->business->customer->first_name ?? '';
                                                    $lastname = $payment->bill->business->customer->last_name ?? '';
                                                    $name = $firstname . ' ' . $lastname;
                                                }
                                            @endphp
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $payment->bills_id }}</td>
                                                <td>{{ $name }}</td>
                                                <td>{{ number_format($payment->amount, 2) }}</td>
                                                <td>{{ $payment->payment_mode }}</td>
                                                <td>{{ $payment->transaction_status }}</td>
                                                <td>{{ $payment->assembly->name ?? 'N/A' }}</td>
                                                <td>{{ $payment->createdBy->name ?? 'N/A' }}</td>
                                                <td>{{ $payment->created_at }}</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <div class="btn-link" data-bs-toggle="dropdown"
                                                            aria-expanded="false">
                                                            <svg width="24" height="24" viewBox="0 0 24 24"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M11 12C11 12.5523 11.4477 13 12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12Z"
                                                                    stroke="#737B8B" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round">
                                                                </path>
                                                                <path
                                                                    d="M18 12C18 12.5523 18.4477 13 19 13C19.5523 13 20 12.5523 20 12C20 11.4477 19.5523 11 19 11C18.4477 11 18 11.4477 18 12Z"
                                                                    stroke="#737B8B" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round">
                                                                </path>
                                                                <path
                                                                    d="M4 12C4 12.5523 4.44772 13 5 13C5.55228 13 6 12.5523 6 12C6 11.4477 5.55228 11 5 11C4.44772 11 4 11.4477 4 12Z"
                                                                    stroke="#737B8B" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round">
                                                                </path>
                                                            </svg>
                                                        </div>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            {{-- <a class="dropdown-item"
                                                                    href="{{ route('payments.show', $payment) }}">Make
                                                                    Payment</a>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('payments.fetch', $payment->bills_id) }}">View
                                                                    Payment</a>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('receipt.show', $payment) }}">View
                                                                    Receipt</a>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('payments.edit', $payment) }}">Amend
                                                                    Bill</a> --}}
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <th colspan="2"></th>
                                        <th>Total (GHS)</th>
                                        <th>{{ $customerData['paymentTotal'] }}</th>
                                        <th colspan="7"></th>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
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
@endsection
