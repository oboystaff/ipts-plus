<div class="row">
    <div class="col-xl-3">
        <div class="card custom-card rounded-md overflow-hidden p-2">
            <div class="card-body bg-primary bg-opacity-10 rounded-2 ps-4 medical-cards">
                <div class="d-flex gap-2 align-items-center ps-2">
                    <div class="align-self-start">
                        <div class="fw-medium mb-2"> Current Bill</div>
                        <h4 class="fw-semibold mb-0 lh-1">GHS {{ $customerData['totalArrearsP'] }}</h4>
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
                        <div class="fw-medium mb-2">Last Payment </div>
                        <h4 class="fw-semibold mb-0 lh-1">GHS {{ $customerData['yearlyPaymentsP'] }} </h4>
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
                        <div class="fw-medium mb-2">Arrears </div>
                        <h4 class="fw-semibold mb-0 lh-1">GHS {{ $customerData['totalArrearsP'] }} </h4>
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
                        <div class="fw-medium mb-2">Current Time</div>
                        <h4 class="fw-semibold mb-0 lh-1" id="currentTime">Loading...</h4>
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
                                    <p class="mb-4 text-fixed-white op-7 fs-12">Use these convenient channels to pay
                                        your property rates:</p>
                                    <ul class="mb-4 text-fixed-white op-7 fs-12">
                                        <li>Dial our USSD code to pay quickly and easily.</li>
                                        <li>Download the mobile app from the App Store or Google Play for seamless
                                            payments.</li>
                                        <li>Visit our web portal at <a href="https://www.app.melchia.com"
                                                class="text-secondary">www.app.melchia.com</a>.</li>
                                        <li>Ask your Agent for your Payment receipts Always </li>
                                        <li>Use the mobile app to track your payment history and receipts.</li>
                                        <li>Contact our support team for assistance with any payment issues.</li>
                                    </ul>


                                    <div class="d-flex gap-2 flex-wrap">
                                        <button class="btn btn-success btn-wave waves-effect waves-light">
                                            Pay Bills</button>
                                        <button class="btn btn-secondary btn-wave waves-effect waves-light">
                                            Check Arrears</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-6 col-xl-6 col-lg-6">
                <div class="card custom-card">
                    <div class="card-body">
                        <div id='calendar'></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-12">
        <div class="card custom-card rounded-md overflow-hidden p-2">
            <div class="card-body bg-secondary bg-opacity-10 rounded-2 ps-4 medical-cards secondary">
                <div class="chart-container" style="position: relative; height:400px; width:100%;">
                    <canvas id="summaryChart"></canvas>
                </div>
            </div>
        </div>
    </div>

</div>



<script type="text/javascript">
    var Tawk_API = Tawk_API || {},
        Tawk_LoadStart = new Date();
    (function() {
        var s1 = document.createElement("script"),
            s0 = document.getElementsByTagName("script")[0];
        s1.async = true;
        s1.src = 'https://embed.tawk.to/663e4f9b9a809f19fb2fa32d/1hthme206';
        s1.charset = 'UTF-8';
        s1.setAttribute('crossorigin', '*');
        s0.parentNode.insertBefore(s1, s0);
    })();
</script>

<script>
    function updateTime() {
        const currentDate = new Date();
        const time = currentDate.toLocaleTimeString('en-US', {
            hour12: true
        });
        document.getElementById('currentTime').innerText = time;
    }

    // Initial call to display the current time
    updateTime();

    // Update the time every second
    setInterval(updateTime, 1000);
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Data from the controller
        const data = @json($customerData);

        // Labels and values
        const labels = [
            "Total Properties",
            "Total Businesses",
            "Total Bills (Properties)",
            "Total Bills (Businesses)",
            "Total Arrears (Properties)",
            "Total Arrears (Businesses)",
            "Total Expected Payments (Properties)",
            "Total Expected Payments (Businesses)",
            "Yearly Payments (Properties)",
            "Yearly Payments (Businesses)",
            "Total Due"
        ];

        const values = [
            data.totalProperties || 0,
            data.totalBusinesses || 0,
            data.totalBillsProperties || 0,
            data.totalBillsBusinesses || 0,
            data.totalArrearsProperties || 0,
            data.totalArrearsBusinesses || 0,
            data.totalExpectedPaymentsProperties || 0,
            data.totalExpectedPaymentsBusinesses || 0,
            data.yearlyPaymentsProperties || 0,
            data.yearlyPaymentsBusinesses || 0,
            data.totalDue || 0
        ];

        const colors = [
            "#FF9999", "#66B3FF", "#99FF99", "#FFCC99", "#C0C0C0",
            "#FFB6C1", "#ADD8E6", "#90EE90", "#FFDAC1", "#FFD700", "#FFA07A"
        ];

        // Render Chart.js
        const ctx = document.getElementById('summaryChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Customer Data Summary',
                    data: values,
                    backgroundColor: colors
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.raw.toLocaleString();
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Categories'
                        },
                        ticks: {
                            autoSkip: false
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Values'
                        },
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>
