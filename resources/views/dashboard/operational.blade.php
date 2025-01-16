@extends('layout.base')

@section('page-styles')
    <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.8/main.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.8/main.min.css" rel="stylesheet">

    <style>
        .fc-day-today {
            background-color: #ffebcc !important;
        }
    </style>
@endsection

@section('page-content')
    <div class="container-fluid">
        @if (\Auth::user()->access_level !== 'customer' && \Auth::user()->access_level !== 'GRA_Administrator')
            @include('dashboard.includes.main')
            @include('dashboard.includes.analytics')
        @elseif (\Auth::user()->access_level == 'GRA_Administrator')
            @include('dashboard.includes.gra')
            @include('dashboard.includes.analytics')
        @elseif (\Auth::user()->access_level == 'customer')
            @include('dashboard.includes.customer')
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

    <script src="{{ asset('assets/libs/moment/min/moment.min.js') }}"></script>

    <script src="{{ asset('assets/libs/flatpickr/flatpickr.min.js') }}"></script>

    <!-- Fullcalendar JS -->
    <script src="{{ asset('assets/libs/fullcalendar/index.global.min.js') }}"></script>
    <script src="{{ asset('assets/js/fullcalendar.js?t=1234') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.8/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.8/main.min.js"></script>

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

    <script>
        //Revenue trends chart
        var paymentData = @json($total['paymentData']);
        var billData = @json($total['billData']);
        var arrearsData = @json($total['arrearsData']);

        var options = {
            series: [{
                name: 'Payment',
                data: paymentData
            }, {
                name: 'Bill',
                data: billData
            }, {
                name: 'Arrears',
                data: arrearsData
            }],
            chart: {
                type: 'bar',
                height: 320
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '80%',
                    endingShape: 'rounded'
                },
            },
            grid: {
                borderColor: '#f2f5f7',
            },
            dataLabels: {
                enabled: false
            },
            colors: ["#8b7eff", "#35bdaa", "#ffb748"],
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                labels: {
                    show: true,
                    style: {
                        colors: "#8c9097",
                        fontSize: '11px',
                        fontWeight: 600,
                        cssClass: 'apexcharts-xaxis-label',
                    },
                }
            },
            yaxis: {
                title: {
                    text: 'GHS (thousands)',
                    style: {
                        color: "#8c9097",
                    }
                },
                labels: {
                    show: true,
                    style: {
                        colors: "#8c9097",
                        fontSize: '11px',
                        fontWeight: 600,
                        cssClass: 'apexcharts-xaxis-label',
                    },
                }
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return "GHS " + val + " thousands"
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#column-basic"), options);
        chart.render();
    </script>

    <script>
        //Top Performing Assembly graph
        var categories = @json($total['categories']);
        var data = @json($total['graphData']);

        var options = {
            series: [{
                name: 'Assembly',
                data: data
            }],
            chart: {
                height: 320,
                type: 'bar',
            },
            grid: {
                borderColor: '#f2f5f7',
            },
            plotOptions: {
                bar: {
                    borderRadius: 10,
                    dataLabels: {
                        position: 'top',
                    },
                }
            },
            dataLabels: {
                enabled: true,
                formatter: function(val) {
                    return val;
                },
                offsetY: -20,
                style: {
                    fontSize: '12px',
                    colors: ["#8c9097"]
                }
            },
            colors: ["#8b7eff"],
            xaxis: {
                categories: categories,
                position: 'top',
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                },
                crosshairs: {
                    fill: {
                        type: 'gradient',
                        gradient: {
                            colorFrom: '#D8E3F0',
                            colorTo: '#BED1E6',
                            stops: [0, 100],
                            opacityFrom: 0.4,
                            opacityTo: 0.5,
                        }
                    }
                },
                tooltip: {
                    enabled: true,
                },
                labels: {
                    show: true,
                    style: {
                        colors: "#8c9097",
                        fontSize: '11px',
                        fontWeight: 600,
                        cssClass: 'apexcharts-xaxis-label',
                    },
                }
            },
            yaxis: {
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false,
                },
                labels: {
                    show: true,
                    formatter: function(val) {
                        return val;
                    },
                    style: {
                        colors: "#8c9097",
                        fontSize: '11px',
                        fontWeight: 600,
                        cssClass: 'apexcharts-yaxis-label',
                    },
                },
                title: {
                    text: 'Payment (GHS)',
                    style: {
                        color: '#8c9097',
                        fontSize: '12px',
                        fontWeight: 600,
                    }
                }
            },
            title: {
                text: 'Monthly Payments in Ghana, 2025',
                floating: true,
                offsetY: 330,
                align: 'center',
                style: {
                    color: '#444'
                }
            }
        };
        var chart = new ApexCharts(document.querySelector("#column-datalabels"), options);
        chart.render();
    </script>

    <script>
        //Outstanding payments graph
        var chartData11 = @json($chartData11);

        var options = {
            series: chartData11,
            chart: {
                type: 'bar',
                height: 320,
                stacked: true,
                toolbar: {
                    show: true
                },
                zoom: {
                    enabled: true
                }
            },
            grid: {
                borderColor: '#f2f5f7',
            },
            colors: ["#8b7eff", "#35bdaa", "#ffb748", "#e6533c", "#1e90ff"],
            responsive: [{
                breakpoint: 480,
                options: {
                    legend: {
                        position: 'bottom',
                        offsetX: -10,
                        offsetY: 0
                    }
                }
            }],
            plotOptions: {
                bar: {
                    horizontal: false,
                },
            },
            xaxis: {
                type: 'category',
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                labels: {
                    show: true,
                    style: {
                        colors: "#8c9097",
                        fontSize: '11px',
                        fontWeight: 600,
                        cssClass: 'apexcharts-xaxis-label',
                    },
                }
            },
            legend: {
                position: 'right',
                offsetY: 40
            },
            fill: {
                opacity: 1
            },
            yaxis: {
                labels: {
                    show: true,
                    style: {
                        colors: "#8c9097",
                        fontSize: '11px',
                        fontWeight: 600,
                        cssClass: 'apexcharts-yaxis-label',
                    },
                }
            }
        };
        var chart = new ApexCharts(document.querySelector("#column-stacked"), options);
        chart.render();
    </script>

    <script>
        //Total Registered Rate payers graph
        var maleMonthlyData = @json($total['maleMonthlyCount']);
        var femaleMonthlyData = @json($total['femaleMonthlyCount']);

        var options = {
            series: [{
                name: 'MALE',
                data: maleMonthlyData
            }, {
                name: 'FEMALE',
                data: femaleMonthlyData
            }],
            chart: {
                type: 'bar',
                height: 320,
                stacked: true,
                stackType: '100%'
            },
            grid: {
                borderColor: '#f2f5f7',
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    legend: {
                        position: 'bottom',
                        offsetX: -10,
                        offsetY: 0
                    }
                }
            }],
            colors: ["#8b7eff", "#35bdaa", "#ffb748"],
            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                labels: {
                    show: true,
                    style: {
                        colors: "#8c9097",
                        fontSize: '11px',
                        fontWeight: 600,
                        cssClass: 'apexcharts-xaxis-label',
                    },
                }
            },
            yaxis: {
                labels: {
                    show: true,
                    style: {
                        colors: "#8c9097",
                        fontSize: '11px',
                        fontWeight: 600,
                        cssClass: 'apexcharts-yaxis-label',
                    },
                }
            },
            fill: {
                opacity: 1
            },
            legend: {
                position: 'right',
                offsetX: 0,
                offsetY: 50
            },
        };
        var chart = new ApexCharts(document.querySelector("#column-stacked-full"), options);
        chart.render();
    </script>

    <script>
        var activeCitizens = @json($total['monthlyActiveCounts']);
        var inactiveCitizens = @json($total['monthlyInactiveCounts']);

        var options = {
            series: [{
                name: 'Active',
                data: [{
                        x: 'Jan',
                        y: activeCitizens[0],
                        goals: [{
                            name: 'InActive',
                            value: inactiveCitizens[0],
                            strokeHeight: 5,
                            strokeColor: '#775DD0'
                        }]
                    },
                    {
                        x: 'Feb',
                        y: activeCitizens[1],
                        goals: [{
                            name: 'InActive',
                            value: inactiveCitizens[1],
                            strokeHeight: 5,
                            strokeColor: '#775DD0'
                        }]
                    },
                    {
                        x: 'Mar',
                        y: activeCitizens[2],
                        goals: [{
                            name: 'InActive',
                            value: inactiveCitizens[2],
                            strokeHeight: 5,
                            strokeColor: '#775DD0'
                        }]
                    },
                    {
                        x: 'Apr',
                        y: activeCitizens[3],
                        goals: [{
                            name: 'InActive',
                            value: inactiveCitizens[3],
                            strokeHeight: 5,
                            strokeColor: '#775DD0'
                        }]
                    },
                    {
                        x: 'May',
                        y: activeCitizens[4],
                        goals: [{
                            name: 'InActive',
                            value: inactiveCitizens[4],
                            strokeHeight: 5,
                            strokeColor: '#775DD0'
                        }]
                    },
                    {
                        x: 'Jun',
                        y: activeCitizens[5],
                        goals: [{
                            name: 'InActive',
                            value: inactiveCitizens[5],
                            strokeHeight: 5,
                            strokeColor: '#775DD0'
                        }]
                    },
                    {
                        x: 'Jul',
                        y: activeCitizens[6],
                        goals: [{
                            name: 'InActive',
                            value: inactiveCitizens[6],
                            strokeHeight: 5,
                            strokeColor: '#775DD0'
                        }]
                    },
                    {
                        x: 'Aug',
                        y: activeCitizens[7],
                        goals: [{
                            name: 'InActive',
                            value: inactiveCitizens[7],
                            strokeHeight: 5,
                            strokeColor: '#775DD0'
                        }]
                    },
                    {
                        x: 'Sep',
                        y: activeCitizens[8],
                        goals: [{
                            name: 'InActive',
                            value: inactiveCitizens[8],
                            strokeHeight: 5,
                            strokeColor: '#775DD0'
                        }]
                    },
                    {
                        x: 'Oct',
                        y: activeCitizens[9],
                        goals: [{
                            name: 'InActive',
                            value: inactiveCitizens[9],
                            strokeHeight: 5,
                            strokeColor: '#775DD0'
                        }]
                    },
                    {
                        x: 'Nov',
                        y: activeCitizens[10],
                        goals: [{
                            name: 'InActive',
                            value: inactiveCitizens[10],
                            strokeHeight: 5,
                            strokeColor: '#775DD0'
                        }]
                    },
                    {
                        x: 'Dec',
                        y: activeCitizens[11],
                        goals: [{
                            name: 'InActive',
                            value: inactiveCitizens[11],
                            strokeHeight: 5,
                            strokeColor: '#775DD0'
                        }]
                    }
                ]
            }],
            chart: {
                height: 320,
                type: 'bar'
            },
            plotOptions: {
                bar: {
                    columnWidth: '60%'
                }
            },
            colors: ['#35bdaa'],
            dataLabels: {
                enabled: false
            },
            grid: {
                borderColor: '#f2f5f7',
            },
            legend: {
                show: true,
                showForSingleSeries: true,
                customLegendItems: ['Active', 'InActive'],
                markers: {
                    fillColors: ['#35bdaa', '#775DD0']
                }
            },
            xaxis: {
                labels: {
                    show: true,
                    style: {
                        colors: "#8c9097",
                        fontSize: '11px',
                        fontWeight: 600,
                        cssClass: 'apexcharts-xaxis-label',
                    },
                }
            },
            yaxis: {
                labels: {
                    show: true,
                    style: {
                        colors: "#8c9097",
                        fontSize: '11px',
                        fontWeight: 600,
                        cssClass: 'apexcharts-xaxis-label',
                    },
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#column-markers"), options);
        chart.render();
    </script>

    <script>
        //Property and business registration chart
        var propertyData = @json($total['monthlyPropertyCounts']);
        var businessData = @json($total['monthlyBusinessCounts']);

        var options = {
            series: [{
                name: 'Property',
                data: propertyData
            }, {
                name: 'Business',
                data: businessData
            }],
            chart: {
                type: 'bar',
                height: 320
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '80%',
                    endingShape: 'rounded'
                },
            },
            grid: {
                borderColor: '#f2f5f7',
            },
            dataLabels: {
                enabled: false
            },
            colors: ["#8b7eff", "#35bdaa", "#ffb748"],
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                labels: {
                    show: true,
                    style: {
                        colors: "#8c9097",
                        fontSize: '11px',
                        fontWeight: 600,
                        cssClass: 'apexcharts-xaxis-label',
                    },
                }
            },
            yaxis: {
                title: {
                    text: 'Monthly (counts)',
                    style: {
                        color: "#8c9097",
                    }
                },
                labels: {
                    show: true,
                    style: {
                        colors: "#8c9097",
                        fontSize: '11px',
                        fontWeight: 600,
                        cssClass: 'apexcharts-xaxis-label',
                    },
                }
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return val
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#column-rotated-labels"), options);
        chart.render();
    </script>

    <script>
        var chartData12 = @json($total['chartData12']);

        var seriesData = [
            ...chartData12.properties.map(property => ({
                name: property.name,
                data: property.data,
                stack: 'Properties'
            })),
            ...chartData12.businesses.map(business => ({
                name: business.name,
                data: business.data,
                stack: 'Businesses'
            }))
        ];

        var options = {
            series: seriesData,
            chart: {
                type: 'bar',
                height: 400,
                stacked: true,
                toolbar: {
                    show: true
                },
                zoom: {
                    enabled: true
                },
                group: 'grouped-stacks'
            },
            grid: {
                borderColor: '#f2f5f7',
            },
            colors: [
                "#8b7eff", "#35bdaa", "#ffb748", "#e6533c", "#1e90ff", "#34a853", "#4285f4", "#fbbc05", "#ea4335",
                "#a142f4",
                "#ff9e67", "#00aaff", "#66bb6a", "#ff4081", "#ffa726", "#42a5f5", "#9c27b0", "#ab47bc", "#8d6e63",
                "#ff7043"
            ],
            xaxis: {
                type: 'category',
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                labels: {
                    show: true,
                    style: {
                        colors: "#8c9097",
                        fontSize: '11px',
                        fontWeight: 600,
                        cssClass: 'apexcharts-xaxis-label',
                    },
                },
            },
            legend: {
                position: 'top',
                offsetY: 10
            },
            fill: {
                opacity: 1
            },
            yaxis: {
                labels: {
                    show: true,
                    style: {
                        colors: "#8c9097",
                        fontSize: '11px',
                        fontWeight: 600,
                        cssClass: 'apexcharts-yaxis-label',
                    },
                },
                title: {
                    text: 'Payments (GHS)',
                    style: {
                        color: '#8c9097',
                        fontSize: '12px',
                        fontWeight: 600
                    }
                }
            },
            tooltip: {
                shared: true,
                intersect: false
            }
        };

        var chart = new ApexCharts(document.querySelector("#column-negative"), options);
        chart.render();
    </script>

    <script>
        // Revenue by location chart
        var divisionPaymentData = @json($total['divisionPaymentData']);

        var seriesData = [];
        var divisions = [...new Set(divisionPaymentData.map(item => item.division_name))];
        var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        divisions.forEach(function(division) {
            var divisionData = months.map(function(month) {
                var payment = divisionPaymentData.find(function(item) {
                    return item.division_name === division && item.month === (months.indexOf(
                        month) + 1);
                });

                return payment ? payment.total_payments : 0;
            });

            seriesData.push({
                name: division,
                data: divisionData
            });
        });

        var options = {
            series: seriesData,
            chart: {
                type: 'bar',
                height: 320,
                stacked: true,
                toolbar: {
                    show: true
                },
                zoom: {
                    enabled: true
                }
            },
            grid: {
                borderColor: '#f2f5f7',
            },
            colors: ["#8b7eff", "#35bdaa", "#ffb748", "#e6533c", "#1e90ff", "#ff6347", "#ff1493", "#32cd32", "#f0e68c",
                "#800080", "#ff4500", "#708090"
            ],
            responsive: [{
                breakpoint: 480,
                options: {
                    legend: {
                        position: 'bottom',
                        offsetX: -10,
                        offsetY: 0
                    }
                }
            }],
            plotOptions: {
                bar: {
                    horizontal: false,
                },
            },
            xaxis: {
                type: 'category',
                categories: months,
                labels: {
                    show: true,
                    style: {
                        colors: "#8c9097",
                        fontSize: '11px',
                        fontWeight: 600,
                        cssClass: 'apexcharts-xaxis-label',
                    },
                }
            },
            legend: {
                position: 'right',
                offsetY: 40
            },
            fill: {
                opacity: 1
            },
            yaxis: {
                labels: {
                    show: true,
                    style: {
                        colors: "#8c9097",
                        fontSize: '11px',
                        fontWeight: 600,
                        cssClass: 'apexcharts-yaxis-label',
                    },
                },
                title: {
                    text: 'Payments (GHS)',
                    style: {
                        color: '#8c9097',
                        fontSize: '12px',
                        fontWeight: 600
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#column-range"), options);
        chart.render();
    </script>

    <script>
        // Regional arrears chart
        var regionArrearsData = @json($total['regionArrearsData']);

        var seriesData = [];
        var regions = [...new Set(regionArrearsData.map(item => item.region_name))];
        var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        regions.forEach(function(region) {
            var regionData = months.map(function(month) {
                var arrearsData = regionArrearsData.find(function(item) {
                    return item.region_name === region && parseInt(item.month) === (months.indexOf(
                        month) + 1);
                });

                return arrearsData ? arrearsData.arrears : 0;
            });

            seriesData.push({
                name: region,
                data: regionData
            });
        });

        var options = {
            series: seriesData,
            chart: {
                type: 'bar',
                height: 320,
                stacked: true,
                toolbar: {
                    show: true
                },
                zoom: {
                    enabled: true
                }
            },
            grid: {
                borderColor: '#f2f5f7',
            },
            colors: [
                "#e74c3c", "#3498db", "#2ecc71", "#f1c40f", "#9b59b6", "#1abc9c", "#e67e22", "#34495e",
                "#d35400", "#7f8c8d", "#8e44ad", "#c0392b", "#16a085", "#f39c12", "#2980b9", "#8e44ad"
            ],
            responsive: [{
                breakpoint: 480,
                options: {
                    legend: {
                        position: 'bottom',
                        offsetX: -10,
                        offsetY: 0
                    }
                }
            }],
            plotOptions: {
                bar: {
                    horizontal: false,
                },
            },
            xaxis: {
                type: 'category',
                categories: months,
                labels: {
                    style: {
                        colors: "#8c9097",
                        fontSize: '11px',
                        fontWeight: 600,
                    },
                }
            },
            legend: {
                position: 'right',
                offsetY: 40
            },
            fill: {
                opacity: 1
            },
            yaxis: {
                labels: {
                    style: {
                        colors: "#8c9097",
                        fontSize: '11px',
                        fontWeight: 600,
                    },
                },
                title: {
                    text: 'Arrears (GHS)',
                    style: {
                        color: '#8c9097',
                        fontSize: '12px',
                        fontWeight: 600
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#chart-arrears"), options);
        chart.render();
    </script>

    <script>
        //Collection efficient chart
        var regionPaymentData2 = @json($total['regionPaymentData2']);

        var seriesData = [];
        var regions = [...new Set(regionPaymentData2.map(item => item.region_name))];
        var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        var paymentModes = ['momo', 'cash'];

        regions.forEach(function(region) {
            var totalRegionData = months.map(function(month) {
                var totalPaymentsForMonth = paymentModes.reduce(function(total, paymentMode) {
                    var paymentData = regionPaymentData2.find(function(item) {
                        return item.region_name === region && item.payment_mode ===
                            paymentMode && parseInt(item.month) === (months.indexOf(month) +
                                1);
                    });

                    return total + (paymentData ? paymentData.total_payments : 0);
                }, 0);

                return totalPaymentsForMonth;
            });

            seriesData.push({
                name: region,
                data: totalRegionData,
                type: 'bar',
            });
        });

        var options = {
            series: seriesData,
            chart: {
                type: 'bar',
                height: 320,
                stacked: true,
                toolbar: {
                    show: true
                },
                zoom: {
                    enabled: true
                }
            },
            grid: {
                borderColor: '#f2f5f7',
            },
            colors: [
                "#e74c3c", "#3498db", "#2ecc71", "#f1c40f", "#9b59b6", "#1abc9c", "#e67e22", "#34495e",
                "#d35400", "#7f8c8d", "#8e44ad", "#c0392b", "#16a085", "#f39c12", "#2980b9", "#8e44ad"
            ],
            responsive: [{
                breakpoint: 480,
                options: {
                    legend: {
                        position: 'bottom',
                        offsetX: -10,
                        offsetY: 0
                    }
                }
            }],
            plotOptions: {
                bar: {
                    horizontal: false,
                },
            },
            xaxis: {
                type: 'category',
                categories: months,
                labels: {
                    style: {
                        colors: "#8c9097",
                        fontSize: '11px',
                        fontWeight: 600,
                    },
                }
            },
            legend: {
                position: 'right',
                offsetY: 40
            },
            fill: {
                opacity: 1
            },
            yaxis: {
                labels: {
                    style: {
                        colors: "#8c9097",
                        fontSize: '11px',
                        fontWeight: 600,
                    },
                },
                title: {
                    text: 'Total Payments (GHS)',
                    style: {
                        color: '#8c9097',
                        fontSize: '12px',
                        fontWeight: 600
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#collection-chart"), options);
        chart.render();
    </script>

    <script>
        const dashChartData = @json($total['dashChartData']);

        const bills = dashChartData.map(item => item.bills);
        const payments = dashChartData.map(item => item.payments);
        const arrears = dashChartData.map(item => item.arrears);

        var options = {
            series: [{
                    name: 'Bill',
                    data: bills,
                    type: 'bar',
                },
                {
                    name: 'Payment',
                    data: payments,
                    type: 'bar',
                },
                {
                    name: 'Arrears',
                    data: arrears,
                    type: 'area',
                }
            ],
            chart: {
                height: 352,
                type: 'line',
                toolbar: {
                    show: false,
                },
                zoom: {
                    enabled: false
                },
            },
            plotOptions: {
                bar: {
                    borderRadius: 3,
                    columnWidth: "40%",
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
                opacity: 1,
            },
            legend: {
                position: 'top',
                fontSize: '14px',
                fontWeight: 500,
                fontFamily: 'Poppins, sans-serif',
            },
            colors: [
                "rgb(52, 152, 219)",
                "rgb(255, 183, 72)",
                "rgb(53, 189, 170)"
            ],
            stroke: {
                width: [0, 2.5, 2.5],
                curve: 'smooth',
            },
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            tooltip: {
                shared: true,
            }
        };

        var chart = new ApexCharts(document.querySelector("#sales-statistics1"), options);
        chart.render();
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: ''
                },
                // events: [{
                //         title: 'Meeting with Client',
                //         start: '2025-01-15',
                //         end: '2025-01-16'
                //     },
                //     {
                //         title: 'Project Deadline',
                //         start: '2025-01-18'
                //     },
                //     {
                //         title: 'Team Outing',
                //         start: '2025-01-22'
                //     }
                // ],
                nowIndicator: true,
                selectable: false,
                editable: false,
                initialDate: new Date().toISOString().split('T')[0],
            });

            calendar.render();
        });
    </script>

    <script>
        const finalCut = @json($total['finalCut']);

        var options1 = {
            chart: {
                height: 225,
                type: 'radialBar',
                responsive: 'true',
                offsetX: 0,
                offsetY: -10,
                zoom: {
                    enabled: false
                }
            },
            grid: {
                padding: {
                    top: 0,
                    right: 0,
                    bottom: 0,
                    left: 0
                },
            },
            plotOptions: {
                radialBar: {
                    startAngle: -135,
                    endAngle: 135,
                    track: {
                        strokeWidth: "80%",
                    },
                    hollow: {
                        size: "55%"
                    },
                    dataLabels: {
                        name: {
                            fontSize: '15px',
                            color: undefined,
                            offsetY: 20,
                            fontWeight: [400]
                        },
                        value: {
                            offsetY: -20,
                            fontSize: '22px',
                            color: undefined,
                            fontWeight: [600],
                            formatter: function(val) {
                                return val + "%";
                            }
                        }
                    }
                }
            },
            colors: ["var(--primary-color)"],
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    type: "horizontal",
                    gradientToColors: ["rgb(53, 189, 170)"],
                    opacityFrom: 1,
                    opacityTo: 1,
                    stops: [0, 100]
                }
            },
            stroke: {
                dashArray: 4
            },
            labels: ['Revenue'],
            series: [finalCut],
        };
        var options1 = new ApexCharts(document.querySelector("#revenue-statistics"), options1);
        options1.render();
    </script>
@endsection
