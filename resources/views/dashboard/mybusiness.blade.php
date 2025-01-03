@extends('layout.base')

@section('page-styles')
@endsection

@section('page-content')
    <div class="container-fluid mh-auto">
        <div class="row">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="card-header">
                    <div class="card-title">Customer Service / My Buinessesss</div>
                </div>

            </div>



            <div class="col-xl-12 active-p">
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-list" role="tabpanel" aria-labelledby="pills-list-tab">

                        <div class="card">
                            <div class="card-body px-0">
                                <div class="table-responsive active-projects user-tbl  dt-filter">
                                    <table id="file-export" class="table table-bordered text-nowrap w-100">
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
                </div>
            </div>
        </div>
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
