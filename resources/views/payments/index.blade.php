@extends('layout.base')

@section('page-styles')
@endsection

@section('page-content')
    <div class="container-fluid mh-auto">
        <div class="col-xl-12">
            <div class="card custom-card rounded-md overflow-hidden p-2">
                <div class="card-body bg-primary bg-opacity-10 rounded-2 ps-4 medical-cards">
                    <div class="row">
                        <div class="col-xxl-12">
                            <form action="{{ route('payments.index') }}" method="GET">
                                <div class="row align-items-end g-3">

                                    <!-- Payment Mode -->
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="payment_mode">Payment Mode</label>
                                            <select name="payment_mode" id="payment_mode" class="form-select">
                                                <option value="">Select Payment Mode</option>
                                                <option value="momo"
                                                    {{ request('payment_mode') == 'momo' ? 'selected' : '' }}>MOMO</option>
                                                <option value="cash"
                                                    {{ request('payment_mode') == 'cash' ? 'selected' : '' }}>Cash</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Status -->
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select name="status" id="status" class="form-select">
                                                <option value="">Select Status</option>
                                                <option value="Success"
                                                    {{ request('status') == 'Success' ? 'selected' : '' }}>
                                                    Success</option>
                                                <option value="Pending"
                                                    {{ request('status') == 'Pending' ? 'selected' : '' }}>
                                                    Pending</option>
                                                <option value="Failed"
                                                    {{ request('status') == 'Failed' ? 'selected' : '' }}>
                                                    Failed</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- From Date -->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="from_date">From Date</label>
                                            <input type="date" name="from_date" id="from_date"
                                                value="{{ request('from_date') }}" class="form-control">
                                        </div>
                                    </div>

                                    <!-- To Date -->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="to_date">To Date</label>
                                            <input type="date" name="to_date" id="to_date"
                                                value="{{ request('to_date') }}" class="form-control">
                                        </div>
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-primary" style="width: 100px;">Filter</button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="container mt-5">
            <!-- Filter Form -->

            <div class="row">
                <!-- Yearly Payment Trends -->
                <div class="col-md-4">
                    <div id="yearly-payment-trends" class="graph-placeholder">
                        </br>
                        <label class="form-label d-block">Yearly Payment Trend</label>
                        <div id="yearly-payment-chart"></div>
                    </div>
                </div>

                <!-- Momo Payment vs Assembly by Year -->
                <div class="col-md-4">
                    <div id="momo-payment-vs-assembly" class="graph-placeholder">
                        </br>
                        <label class="form-label d-block">
                            Momo Payment vs Assembly (Yearly Trend)</label>
                        <div id="momo-payment-chart"></div>
                    </div>
                </div>

                <!-- Payment Status Breakdown by Assembly -->
                <div class="col-md-4">
                    <div id="payment-status-breakdown" class="graph-placeholder">
                        </br>
                        <label class="form-label d-block">
                            Payment Status Breakdown vs Assembly</label>
                        <div id="payment-status-chart"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment Data Cards Section -->
        <div class="row">
            <!-- Pending Payments Card -->
            <div class="col-xl-4">
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
                                    <h4 class="fw-semibold mb-2">GHS {{ $data['totalPendingPayments'] }}</h4>
                                    <div class="text-muted mb-0">Total Pending Payments</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Successful Payments Card -->
            <div class="col-xl-4">
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
                                    <h4 class="fw-semibold mb-2">GHS {{ $data['totalSuccessfulPayments'] }}</h4>
                                    <div class="text-muted mb-0">Total Successful Payments</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Failed Payments Card -->
            <div class="col-xl-4">
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
                                    <h4 class="fw-semibold mb-2">GHS {{ $data['totalFailedPayments'] }}</h4>
                                    <div class="text-muted mb-0">Total Failed Payments</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Payment Data Table Section -->
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
                    <div class="card-header">
                        <div class="card-title">Payment Management</div>
                    </div>
                </div>

                <div class="card-body px-0">
                    <div class="table-responsive">
                        <table id="file-export" class="table table-bordered text-nowrap w-100">
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
                                @foreach ($payments as $index => $payment)
                                    @php
                                        $name = '';
                                        if ($payment->bill->property && $payment->bill->property->customer) {
                                            $firstname = $payment->bill->property->customer->first_name ?? '';
                                            $lastname = $payment->bill->property->customer->last_name ?? '';
                                            $name = $firstname . ' ' . $lastname;
                                        } elseif ($payment->bill->business && $payment->bill->business->customer) {
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
                                                    <a class="dropdown-item"
                                                        href="{{ route('payments.show', $payment) }}">View
                                                        Payment</a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('payments.receipt', $payment) }}"
                                                        target="_blank">View Receipt</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <th colspan="2"></th>
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
@endsection

@section('page-scripts')
    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Yearly Payment Trends Data from Controller
        var yearlyPaymentsData = @json($data['yearlyPayments']);
        var momoPaymentsData = @json($data['momoPayments']);
        var paymentStatusData = @json($data['paymentStatus']);

        // Prepare Data for Charts
        var yearlyLabels = [];
        var yearlyPayments = [];
        yearlyPaymentsData.forEach(function(item) {
            yearlyLabels.push(item.year);
            yearlyPayments.push(item.total);
        });

        // Yearly Payment Trends
        var optionsYearly = {
            series: [{
                name: 'Payments',
                data: yearlyPayments,
                type: 'column',
            }],
            chart: {
                height: 350,
                type: 'line',
                toolbar: {
                    show: false
                },
                zoom: {
                    enabled: false
                },
                dropShadow: {
                    enabled: true,
                    opacity: 0.15
                }
            },
            plotOptions: {
                bar: {
                    borderRadius: 3,
                    columnWidth: "30%"
                }
            },
            grid: {
                borderColor: "#f1f1f1",
                strokeDashArray: 2,
                xaxis: {
                    lines: {
                        show: true
                    }
                },
                yaxis: {
                    lines: {
                        show: false
                    }
                }
            },
            dataLabels: {
                enabled: false
            },
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.4,
                    opacityTo: 0.1,
                    stops: [0, 90, 100]
                }
            },
            legend: {
                position: 'top',
                fontSize: '14px',
                fontWeight: 500,
                fontFamily: 'Poppins, sans-serif'
            },
            colors: ["#3f51b5"],
            stroke: {
                width: [2.5],
                curve: 'smooth'
            },
            labels: yearlyLabels,
            tooltip: {
                shared: true
            }
        };
        var chartYearly = new ApexCharts(document.querySelector("#yearly-payment-chart"), optionsYearly);
        chartYearly.render();

        // Momo Payment vs Assembly by Year Data
        var momoLabels = [];
        var momoPayments = [];
        var assemblyPayments = [];
        momoPaymentsData.forEach(function(item) {
            momoLabels.push(item.year);
            momoPayments.push(item.total);
        });

        // Assuming you also have assemblyPaymentsData for comparison
        // Example assemblyPayments data (you may need to fetch it similarly from the controller)
        assemblyPayments = [30, 50, 70, 80, 90, 100, 110, 120, 130, 140, 150, 160]; // Example

        var optionsMomoAssembly = {
            series: [{
                name: 'Momo Payment',
                data: momoPayments,
                type: 'column',
            }, {
                name: 'Assembly Payments',
                data: assemblyPayments,
                type: 'line',
            }],
            chart: {
                height: 350,
                type: 'line',
                toolbar: {
                    show: false
                },
                zoom: {
                    enabled: false
                },
                dropShadow: {
                    enabled: true,
                    opacity: 0.15
                }
            },
            plotOptions: {
                bar: {
                    borderRadius: 3,
                    columnWidth: "30%"
                }
            },
            grid: {
                borderColor: "#f1f1f1",
                strokeDashArray: 2,
                xaxis: {
                    lines: {
                        show: true
                    }
                },
                yaxis: {
                    lines: {
                        show: false
                    }
                }
            },
            dataLabels: {
                enabled: false
            },
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.4,
                    opacityTo: 0.1,
                    stops: [0, 90, 100]
                }
            },
            legend: {
                position: 'top',
                fontSize: '14px',
                fontWeight: 500,
                fontFamily: 'Poppins, sans-serif'
            },
            colors: ["#2196f3", "#ff5722"],
            stroke: {
                width: [2.5, 3],
                curve: 'smooth'
            },
            labels: momoLabels,
            tooltip: {
                shared: true
            }
        };
        var chartMomoAssembly = new ApexCharts(document.querySelector("#momo-payment-chart"), optionsMomoAssembly);
        chartMomoAssembly.render();

        // Payment Status Breakdown Data
        var statusLabels = ['Paid', 'Pending', 'Failed']; // Example statuses
        var paidData = paymentStatusData.filter(status => status.status === 'Paid').map(status => status.count);
        var pendingData = paymentStatusData.filter(status => status.status === 'Pending').map(status => status.count);
        var failedData = paymentStatusData.filter(status => status.status === 'Failed').map(status => status.count);

        var optionsStatusBreakdown = {
            series: [{
                name: 'Paid',
                data: paidData
            }, {
                name: 'Pending',
                data: pendingData
            }, {
                name: 'Failed',
                data: failedData
            }],
            chart: {
                height: 350,
                type: 'pie',
                toolbar: {
                    show: false
                },
                zoom: {
                    enabled: false
                }
            },
            labels: statusLabels,
            colors: ['#4caf50', '#ffeb3b', '#f44336'],
            legend: {
                position: 'top',
                fontSize: '14px',
                fontWeight: 500,
                fontFamily: 'Poppins, sans-serif'
            },
            tooltip: {
                shared: true
            }
        };
        var chartStatusBreakdown = new ApexCharts(document.querySelector("#payment-status-chart"), optionsStatusBreakdown);
        chartStatusBreakdown.render();
    </script>
@endsection
