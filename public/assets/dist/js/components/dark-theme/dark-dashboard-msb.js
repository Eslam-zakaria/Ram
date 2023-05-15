(function($) {
    'use strict';
    $(function () {
        var d = [{
            datasets: [{
                borderColor: "#0b1835",
                hoverBorderColor: "#0b1835",
                data: [70.5, 29.5],
                backgroundColor: ['#4765ff', '#aca9bb']
            }],
            labels: ["Label 1", "Label 2"]
        }, {
            datasets: [{
                borderColor: "#0b1835",
                hoverBorderColor: "#0b1835",
                data: [60.3, 39.7],
                backgroundColor: ['#00CB8E', '#aca9bb']
            }],
            labels: ["Label 1", "Label 2"]
        }, {
            datasets: [{
                borderColor: "#0b1835",
                hoverBorderColor: "#0b1835",
                data: [40.8, 59.2],
                backgroundColor: ['#FFC555', '#aca9bb']
            }],
            labels: ["Label 1", "Label 2"]
        }, {
            datasets: [{
                borderColor: "#0b1835",
                hoverBorderColor: "#0b1835",
                data: [30.7, 69.3],
                backgroundColor: ['#FF5666', '#aca9bb']
            }],
            labels: ["Label 1", "Label 2"]
        }];
        [0, 1, 2, 3].forEach(function(a) {
            var obj = document.getElementById("analytics-overview-goal-completion-" + (a + 1));
            new Chart(obj, {
                type: "doughnut",
                data: d[a],
                options: {
                    legend: false,
                    responsive: false,
                    cutoutPercentage: 70,
                    animation: false,
                    tooltips: false
                }
            })
        });

        //Event carousel
        $("#events").owlCarousel({
            loop:true,
            margin:0,
            autoPlay: 3000,
            responsive:{
                0:{
                    items:1
                },
                768:{
                    items:2
                },
                979:{
                    items:3
                },
                1199:{
                    items:4
                }
            },
            singleItem : false,
            dots: false,
            nav: true,
            navText : ["<div class='owl-nav-wrapper bg-soft-primary'><i data-feather='chevron-left' class='text-primary'></i></div>","<div class='owl-nav-wrapper bg-soft-primary'><i data-feather='chevron-right' class='text-primary'></i></div>"]
        });

        $(".btn-event-show").collapse();

        //Events: Tooltip
        $('.event-user').tooltip({ boundary: 'window' });

        // ChartJS - Weekly Device Access Analytics
        var config = {
            type: 'doughnut',
            data: {
                labels: [
                    "Android",
                    "Ios",
                    "Window"
                ],
                datasets: [{
                    data: [35, 30, 35],
                    borderColor: [
                        "#0b1835",
                        "#0b1835",
                        "#0b1835"
                    ],
                    backgroundColor: [
                        "#ACA9BB",
                        "#474554",
                        "#4765FF"
                    ],
                    hoverBackgroundColor: [
                        "#ACA9BB",
                        "#474554",
                        "#4765FF"
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutoutPercentage: 75,
                elements: {
                    center: {
                        text: '33%',
                        color: '#ced1e7',
                        fontStyle: 'Poppins',
                        fontSize: '20',
                        sidePadding: 20
                    }
                },
                legend:{
                    display: false,
                },
                tooltips: {
                    backgroundColor: '#4765FF',
                    bodyFontFamily: 'Poppins',
                    bodyFontColor: '#FFF',
                    bodyFontSize: 12,
                    displayColors: false
                }
            }
        };
        var ctx = document.getElementById("device-weekly").getContext("2d");
        var myChart = new Chart(ctx, config);

        // ChartJS - Monthly Device Access Analytics
        var monthlyConfig = {
            type: 'doughnut',
            data: {
                labels: [
                    "Android",
                    "Ios",
                    "Window"
                ],
                datasets: [{
                    data: [35, 30, 35],
                    borderColor: [
                      "#0b1835",
                      "#0b1835",
                      "#0b1835"
                    ],
                    backgroundColor: [
                        "#00CB8E",
                        "#4765FF",
                        "#FFC555"
                    ],
                    hoverBackgroundColor: [
                        "#00CB8E",
                        "#4765FF",
                        "#FFC555"
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutoutPercentage: 75,
                elements: {
                    center: {
                        text: '33%',
                        color: '#ced1e7',
                        fontStyle: 'Poppins',
                        fontSize: '20',
                        sidePadding: 20
                    }
                },
                legend:{
                    display: false,
                },
                tooltips: {
                    backgroundColor: '#4765FF',
                    bodyFontFamily: 'Poppins',
                    bodyFontColor: '#FFF',
                    bodyFontSize: 12,
                    displayColors: false
                }
            }
        };

        // ChartJS - Yearly Device Access Analytics
        var yearlyConfig = {
            type: 'doughnut',
            data: {
                labels: [
                    "Android",
                    "Ios",
                    "Window"
                ],
                datasets: [{
                    data: [35, 30, 35],
                    borderColor: [
                        "#0b1835",
                        "#0b1835",
                        "#0b1835"
                    ],
                    backgroundColor: [
                        "#FF5666",
                        "#4765FF",
                        "#FFC555"
                    ],
                    hoverBackgroundColor: [
                        "#FF5666",
                        "#4765FF",
                        "#FFC555"
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutoutPercentage: 75,
                elements: {
                    center: {
                        text: '33%',
                        color: '#ced1e7',
                        fontStyle: 'Poppins',
                        fontSize: '20',
                        sidePadding: 20
                    }
                },
                legend:{
                    display: false,
                },
                tooltips: {
                    backgroundColor: '#4765FF',
                    bodyFontFamily: 'Poppins',
                    bodyFontColor: '#FFF',
                    bodyFontSize: 12,
                    displayColors: false
                }
            }
        };

        $('#device-overview, #sales-overview, #session-overview').carousel({
            interval: false,
            pause: true
        });
        $('#task-list, #project-list, #mom-list').carousel({
            interval: 4000
        });

        var flag = 2;
        $('#device-overview').on('slid.bs.carousel', function() {
            var currentIndex = $("#device-overview").find("div.active" ).index() + 1;
            //var currentIndex = $('#device-overview .item').index(currentItem) + 1
            if(currentIndex == 2 && flag > 0)
            {
                var ctx = document.getElementById("device-monthly").getContext("2d");
                var myChart = new Chart(ctx, monthlyConfig);
                flag--;

            }
            if(currentIndex == 3 && flag > 0)
            {
                var ctx = document.getElementById("device-yearly").getContext("2d");
                var myChart = new Chart(ctx, yearlyConfig);
                flag--;
            }

        });

        // Chartjs - Weekly Sales Graph
        $(".widget-2-statistics-graph").css({height: '108px'});
        var ctx = document.getElementById('sales-weekly').getContext("2d");

        var gradientFill = ctx.createLinearGradient(0, 0, 0, 200);
        gradientFill.addColorStop(0, "#283264");
        gradientFill.addColorStop(1, "#2832641a");
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["SUN", "MON", "TUE", "WED", "THU", "FRI", "SAT"],
                datasets: [{
                    label: "Data",
                    borderColor: '#637CF9',
                    pointBorderWidth: 1,
                    pointHoverRadius: 1,
                    pointHoverBorderWidth: 1,
                    pointRadius: 1,
                    backgroundColor: gradientFill,
                    borderWidth: 3,
                    pointBackgroundColor: '#637CF9',
                    data: [35, 45, 39, 48, 45, 65, 35]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                title: {
                    display: !1,
                    text: "Stacked Area"
                },
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        display: false,
                        gridLines: {
                            color: "#eef2f9",
                            drawBorder: false,
                            offsetGridLines: true,
                            drawTicks: false
                        },
                        ticks: {
                            max: 70,
                            display: false,
                            beginAtZero: true
                        },
                    }],
                    xAxes: [{
                        gridLines: {
                            display:false
                        },ticks: {
                            display:false,
                            suggestedMin: 20,
                            suggestedMax: 50
                        },
                    }]
                },
                tooltips: {
                    backgroundColor: '#4765FF',
                    bodyFontFamily: 'Poppins',
                    bodyFontColor: '#FFF',
                    bodyFontSize: 12,
                    displayColors: false,
                    intersect: false,
                },
                hover: {
                    mode: "index"
                },

            }
        });

        var salesFlag = 2;
        $('#sales-overview').on('slid.bs.carousel', function() {
            var currentIndex = $("#sales-overview").find("div.active").index() + 1;
            //var currentIndex = $('#device-overview .item').index(currentItem) + 1
            if(currentIndex == 2 && salesFlag > 0)
            {
                var ctx = document.getElementById('sales-monthly').getContext("2d");
                var gradientFill = ctx.createLinearGradient(0, 0, 0, 200);
                gradientFill.addColorStop(0, "#005139");
                gradientFill.addColorStop(1, "#0051391a");
                var myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: ["JAN", "FEB", "MAR", "APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC"],
                        datasets: [{
                            label: "Data",
                            borderColor: '#00CB8E',
                            pointBorderWidth: 1,
                            pointHoverRadius: 1,
                            pointHoverBorderWidth: 1,
                            pointRadius: 1,
                            backgroundColor: gradientFill,
                            borderWidth: 3,
                            pointBackgroundColor: '#00CB8E',
                            data: [35, 45, 39, 48, 45, 65, 35, 45, 39, 48, 45, 65]
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: true,
                        title: {
                            display: !1,
                            text: "Stacked Area"
                        },
                        legend: {
                            display: false
                        },
                        scales: {
                            yAxes: [{
                                display: false,
                                gridLines: {
                                    color: "#eef2f9",
                                    drawBorder: false,
                                    offsetGridLines: true,
                                    drawTicks: false
                                },
                                ticks: {
                                    max: 70,
                                    display: false,
                                    beginAtZero: true
                                },
                            }],
                            xAxes: [{
                                gridLines: {
                                    display:false
                                },ticks: {
                                    display:false,
                                    suggestedMin: 20,
                                    suggestedMax: 50
                                },
                            }]
                        },
                        tooltips: {
                            backgroundColor: '#4765FF',
                            bodyFontFamily: 'Poppins',
                            bodyFontColor: '#FFF',
                            bodyFontSize: 12,
                            displayColors: false,
                            intersect: false,
                        },
                        hover: {
                            mode: "index"
                        },

                    }
                });
                salesFlag--;

            }
            if(currentIndex == 3 && salesFlag > 0)
            {
                var ctx = document.getElementById('sales-yearly').getContext("2d");
                var gradientFill = ctx.createLinearGradient(0, 0, 0, 200);
                gradientFill.addColorStop(0, "#664f22");
                gradientFill.addColorStop(1, "#664f221a");
                var myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: ["2013", "2014", "2015", "2016", "2017", "2018", "2019"],
                        datasets: [{
                            label: "Data",
                            borderColor: '#FFC555',
                            pointBorderWidth: 1,
                            pointHoverRadius: 1,
                            pointHoverBorderWidth: 1,
                            pointRadius: 1,
                            backgroundColor: gradientFill,
                            borderWidth: 3,
                            pointBackgroundColor: '#FFC555',
                            data: [35, 45, 39, 65, 42, 48, 45]
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: true,
                        title: {
                            display: false,
                        },
                        legend: {
                            display: false
                        },
                        scales: {
                            yAxes: [{
                                display: false,
                                gridLines: {
                                    color: "#eef2f9",
                                    drawBorder: false,
                                    offsetGridLines: true,
                                    drawTicks: false,
                                },
                                ticks: {
                                    max: 70,
                                    display: false,
                                    beginAtZero: true
                                },
                            }],
                            xAxes: [{
                                gridLines: {
                                    display:false,
                                    color: '#fff'
                                },ticks: {
                                    display:false,
                                    suggestedMin: 20,
                                    suggestedMax: 50
                                },
                            }]
                        },
                        tooltips: {
                            backgroundColor: '#4765FF',
                            bodyFontFamily: 'Poppins',
                            bodyFontColor: '#FFF',
                            bodyFontSize: 12,
                            displayColors: false,
                            intersect: false,
                        },
                        hover: {
                            mode: "index"
                        },

                    }
                });
                salesFlag--;
            }

        });

        //Chart JS - Session Bar Charts
        $(".widget-3-statistics-graph").css({height: '108px'});
        var ctx = document.getElementById("session-weekly").getContext("2d");
        var myBarChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["SUN", "MON", "TUE", "WED", "THU", "FRI", "SAT"],
                datasets: [
                    {
                        label: "Session",
                        backgroundColor: "#637CF9",
                        data: [248,343,532,345,483,376,310]

                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                legend: { display: false },
                scales: {
                    yAxes: [{
                        display: false,
                        gridLines: {
                            color: "#eef2f9",
                            drawBorder: false,
                            offsetGridLines: true,
                            drawTicks: false
                        },
                        ticks: {
                            display: false,
                        },
                    }],
                    xAxes: [{
                        barPercentage: 1,
                        categoryPercentage: 1,
                        barThickness: 10,
                        maxBarThickness: 10,
                        gridLines: {
                            display:false,
                            drawBorder: false,
                        },ticks: {
                            display:false
                        },

                    }]
                },
                tooltips: {
                    backgroundColor: '#4765FF',
                    bodyFontFamily: 'Poppins',
                    bodyFontColor: '#FFF',
                    bodyFontSize: 12,
                    displayColors: false,
                    intersect: false,
                }
            }
        });

        var sessionFlag = 2;
        $('#session-overview').on('slid.bs.carousel', function() {
            var currentIndex = $("#session-overview").find("div.active").index() + 1;
            //var currentIndex = $('#device-overview .item').index(currentItem) + 1
            if(currentIndex == 2 && sessionFlag > 0)
            {
                //Chart JS - Monthly Session Bar Charts
                var ctx1 = document.getElementById("session-monthly").getContext("2d");
                var myBarChart1 = new Chart(ctx1, {
                    type: 'bar',
                    data: {
                        labels: ["JAN", "FEB", "MAR", "APR", "MAY", "JUN", "JUL"],
                        datasets: [
                            {
                                label: "Session",
                                backgroundColor: "#00CB8E",
                                data: [248,343,532,345,483,376,310]
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        legend: { display: false },
                        scales: {
                            yAxes: [{
                                display: false,
                                gridLines: {
                                    color: "#eef2f9",
                                    drawBorder: false,
                                    offsetGridLines: true,
                                    drawTicks: false
                                },
                                ticks: {
                                    display: false,
                                },
                            }],
                            xAxes: [{
                                barPercentage: 1,
                                categoryPercentage: 1,
                                barThickness: 10,
                                maxBarThickness: 10,
                                gridLines: {
                                    display:false,
                                    drawBorder: false,
                                },ticks: {
                                    display:false
                                },

                            }]
                        },
                        tooltips: {
                            backgroundColor: '#4765FF',
                            bodyFontFamily: 'Poppins',
                            bodyFontColor: '#FFF',
                            bodyFontSize: 12,
                            displayColors: false,
                        }
                    }
                });
                sessionFlag = sessionFlag - 1;

            }
            if(currentIndex == 3 && sessionFlag > 0)
            {
                //Chart JS - Yearly Session Bar Charts
                var ctx = document.getElementById("session-yearly").getContext("2d");
                var myBarChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ["2013", "2014", "2015", "2016", "2017", "2018", "2019"],
                        datasets: [
                            {
                                label: "Session",
                                backgroundColor: "#FFC555",
                                data: [39, 40, 42, 48, 45, 41, 45]

                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        legend: { display: false },
                        scales: {
                            yAxes: [{
                                display: false,
                                gridLines: {
                                    color: "#eef2f9",
                                    drawBorder: false,
                                    offsetGridLines: true,
                                    drawTicks: false
                                },
                                ticks: {
                                    display: false,
                                },
                            }],
                            xAxes: [{
                                barPercentage: 1,
                                categoryPercentage: 1,
                                barThickness: 10,
                                maxBarThickness: 10,
                                gridLines: {
                                    display:false,
                                    drawBorder: false,
                                },ticks: {
                                    display:false
                                },

                            }]
                        },
                        tooltips: {
                            backgroundColor: '#4765FF',
                            bodyFontFamily: 'Poppins',
                            bodyFontColor: '#FFF',
                            bodyFontSize: 12,
                            displayColors: false,
                            intersect: false,
                        }
                    }
                });
                sessionFlag = sessionFlag - 1;
            }

        });

        //Chart JS - Portal Highlights
        var lineCtx = document.getElementById('portal-weekly-highlights').getContext("2d");
        var myChart = new Chart(lineCtx, {
            type: 'bar',
            data: {
                labels: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
                datasets: [{
                    label: "Amazon",
                    data: [25, 15, 20, 50, 25, 45, 40],
                    backgroundColor: '#4765FF',
                    borderColor: '#4765FF',
                    borderWidth: 3,
                    radius: 0,
                    pointStyle: 'line'
                },
                {
                    label: "Wallmart",
                    data: [20, 10, 35, 55, 20, 65, 45],
                    backgroundColor: '#dae0ff',
                    borderColor: '#dae0ff',
                    borderWidth: 3,
                    radius: 0,
                    pointStyle: 'line'
                }]
            },
            options: {
                maintainAspectRatio: false,
                legend: {
                    display: true,
                    position: "top",
                    labels: {
                        usePointStyle: true,
                        fontSize: 13,
                        fontFamily: "'Poppins', sans-serif",
                        fontColor: '#585e7f',
                        fontStyle: '400',
                    },
                },

                scales: {

                    xAxes: [{
                        barPercentage: 1,
                        categoryPercentage: 1,
                        barThickness: 10,
                        maxBarThickness: 10,
                        ticks: {
                            display: true,
                            beginAtZero: true,
                            fontColor: '#afb2c5',
                            fontFamily: "'Poppins'",
                            fontStyle: '400',
                            fontSize: 13,
                            padding: 10
                        },
                        gridLines: false
                    }],
                    yAxes: [{
                        gridLines: {
                            drawBorder: false,
                            display: true,
                            color: '#ced1e7',
                            borderDash: [2, 5],
                            zeroLineWidth: 1,
                            zeroLineColor: '#ced1e7',
                            zeroLineBorderDash: [2, 5]
                        },
                        categoryPercentage: 0.5,
                        ticks: {
                            display: true,
                            beginAtZero: true,
                            stepSize: 20,
                            max: 80,
                            fontColor: '#afb2c5',
                            fontFamily: "'Poppins'",
                            fontStyle: '400',
                            fontSize: 13,
                            padding: 10
                        }
                    }],
                },
                tooltips: {
                    backgroundColor: '#4765FF',
                    bodyFontFamily: 'Poppins',
                    bodyFontColor: '#FFF',
                    bodyFontSize: 12,
                    displayColors: false,
                    intersect: false,
                },
            },
            elements: {
                point: {
                    radius: 0
                }
            }
        });

        var portalChartFlag1 = 1, portalChartFlag2 = 1;
        $('#nav-time-tab').on('shown.bs.tab', function (e) {
            var target = $(e.target).index() + 1;
            if(target == 2 && portalChartFlag1 > 0){
                var lineCtx = document.getElementById('portal-monthly-highlights').getContext("2d");
                var myChart = new Chart(lineCtx, {
                    type: 'bar',
                    data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                        datasets: [{
                            label: "Amazon",
                            data: [20, 35, 25, 45, 30, 55, 55],
                            backgroundColor: '#4765FF',
                            borderColor: '#4765FF',
                            borderWidth: 3,
                            radius: 0,
                            pointStyle: 'line'
                        },
                            {
                                label: "Wallmart",
                                data: [15, 30, 35, 55, 20, 65, 45],
                                backgroundColor: '#dae0ff',
                                borderColor: '#dae0ff',
                                borderWidth: 3,
                                radius: 0,
                                pointStyle: 'line'
                            }]
                    },
                    options: {
                        maintainAspectRatio: false,
                        legend: {
                            display: true,
                            position: "top",
                            labels: {
                                usePointStyle: true,
                                fontSize: 13,
                                fontFamily: "'Poppins', sans-serif",
                                fontColor: '#585e7f',
                                fontStyle: '400',
                            },
                        },

                        scales: {

                            xAxes: [{
                                barPercentage: 1,
                                categoryPercentage: 1,
                                barThickness: 10,
                                maxBarThickness: 10,
                                ticks: {
                                    display: true,
                                    beginAtZero: true,
                                    fontColor: '#afb2c5',
                                    fontFamily: "'Poppins'",
                                    fontStyle: '400',
                                    fontSize: 13,
                                    padding: 10
                                },
                                gridLines: false
                            }],
                            yAxes: [{
                                gridLines: {
                                    drawBorder: false,
                                    display: true,
                                    color: '#ced1e7',
                                    borderDash: [2, 5],
                                    zeroLineWidth: 1,
                                    zeroLineColor: '#ced1e7',
                                    zeroLineBorderDash: [2, 5]
                                },
                                categoryPercentage: 0.5,
                                ticks: {
                                    display: true,
                                    beginAtZero: true,
                                    stepSize: 20,
                                    max: 80,
                                    fontColor: '#afb2c5',
                                    fontFamily: "'Poppins'",
                                    fontStyle: '400',
                                    fontSize: 13,
                                    padding: 10
                                }
                            }],
                        },
                        tooltips: {
                            backgroundColor: '#4765FF',
                            bodyFontFamily: 'Poppins',
                            bodyFontColor: '#FFF',
                            bodyFontSize: 12,
                            displayColors: false,
                            intersect: false,
                        },
                    },
                    elements: {
                        point: {
                            radius: 0
                        }
                    }
                });
                portalChartFlag1--;
            }
            if(target == 3 && portalChartFlag2 > 0){
                var lineCtx = document.getElementById('portal-yearly-highlights').getContext("2d");
                var myChart = new Chart(lineCtx, {
                    type: 'bar',
                    data: {
                        labels: ['2014', '2015', '2016', '2017', '2018', '2019', '2020'],
                        datasets: [{
                            label: "Amazon",
                            data: [22, 40, 30, 55, 34, 40, 20],
                            backgroundColor: '#4765FF',
                            borderColor: '#4765FF',
                            borderWidth: 3,
                            radius: 0,
                            pointStyle: 'line'
                        },
                            {
                                label: "Wallmart",
                                data: [20, 10, 35, 55, 20, 65, 45],
                                backgroundColor: '#dae0ff',
                                borderColor: '#dae0ff',
                                borderWidth: 3,
                                radius: 0,
                                pointStyle: 'line'
                            }]
                    },
                    options: {
                        maintainAspectRatio: false,
                        legend: {
                            display: true,
                            position: "top",
                            labels: {
                                usePointStyle: true,
                                fontSize: 13,
                                fontFamily: "'Poppins', sans-serif",
                                fontColor: '#585e7f',
                                fontStyle: '400',
                            },
                        },

                        scales: {

                            xAxes: [{
                                barPercentage: 1,
                                categoryPercentage: 1,
                                barThickness: 10,
                                maxBarThickness: 10,
                                ticks: {
                                    display: true,
                                    beginAtZero: true,
                                    fontColor: '#afb2c5',
                                    fontFamily: "'Poppins'",
                                    fontStyle: '400',
                                    fontSize: 13,
                                    padding: 10
                                },
                                gridLines: false
                            }],
                            yAxes: [{
                                gridLines: {
                                    drawBorder: false,
                                    display: true,
                                    color: '#ced1e7',
                                    borderDash: [2, 5],
                                    zeroLineWidth: 1,
                                    zeroLineColor: '#ced1e7',
                                    zeroLineBorderDash: [2, 5]
                                },
                                categoryPercentage: 0.5,
                                ticks: {
                                    display: true,
                                    beginAtZero: true,
                                    stepSize: 20,
                                    max: 80,
                                    fontColor: '#afb2c5',
                                    fontFamily: "'Poppins'",
                                    fontStyle: '400',
                                    fontSize: 13,
                                    padding: 10
                                }
                            }],
                        },
                        tooltips: {
                            backgroundColor: '#4765FF',
                            bodyFontFamily: 'Poppins',
                            bodyFontColor: '#FFF',
                            bodyFontSize: 12,
                            displayColors: false,
                            intersect: false,
                        },
                    },
                    elements: {
                        point: {
                            radius: 0
                        }
                    }
                });
                portalChartFlag2--;
            }
        });

        //Chart JS - Social Network
        var start = moment().subtract(29, 'days');
        var end = moment();

        function cb1(start, end) {
            $('#daterange-picker-1 span').html(start.format('MMMM D') + ' - ' + end.format('MMMM D'));
        }

        $('#daterange-picker-1').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, cb1);

        cb1(start, end);
        function cb2(start, end) {
            $('#daterange-picker-2 span').html(start.format('MMMM D') + ' - ' + end.format('MMMM D'));
        }

        $('#daterange-picker-2').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, cb2);

        cb2(start, end);
        function cb3(start, end) {
            $('#daterange-picker-3 span').html(start.format('MMMM D') + ' - ' + end.format('MMMM D'));
        }

        $('#daterange-picker-3').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, cb3);

        cb3(start, end);

        var lineCtx = document.getElementById('social-fb-chart').getContext("2d");
        var gradientFill = lineCtx.createLinearGradient(0, 0, 0, 200);
        gradientFill.addColorStop(0, "#89BEFA");
        gradientFill.addColorStop(1, "#4765ff1a");

        var gradientFill1 = lineCtx.createLinearGradient(0, 0, 0, 300);
        gradientFill1.addColorStop(0, "#fd85b9");
        gradientFill1.addColorStop(1, "#fd85b900");

        var myChart = new Chart(lineCtx, {
            type: 'line',
            data: {
                //labels: ['1st', '2nd', '3rd', '4th', '5th', '6th', '7th', '8th', '9th', '10th', '11th', '12th', '13th', '14th', '15th', '16th', '17th', '18th', '19th'],
                labels: ['1st', '2nd', '3rd', '4th', '5th', '6th', '7th', '8th', '9th', '10th'],
                datasets: [{
                    label: "Present",
                    data: [0, 40, 30, 10, 20, 15, 0, 15, 20, 0, 45],
                    //data: [0, 40, 0, 10, 0, 20, 0, 40, 0, 10, 0, 20, 0, 40, 0, 10, 0, 20, 0, 30],
                    backgroundColor: gradientFill,
                    borderColor: '#4765FF',
                    borderWidth: 1,
                    radius: 0,
                    pointStyle: 'line'
                },{
                    label: "Past",
                    //data: [20, 0, 40, 0, 10, 0, 20, 0, 40, 0, 10, 0, 20, 0, 30, 0, 40, 0, 10, 0],
                    data: [10, 20, 35, 20, 55, 20, 15, 40, 35, 45],
                    //backgroundColor: '#dae0ff',
                    backgroundColor: gradientFill1,
                    borderColor: '#fd197d',
                    borderWidth: 1,
                    radius: 0,
                    pointStyle: 'line'
                }]
            },
            options: {
                plugins: {
                    filler: {
                        propagate: false
                    }
                },
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    display: false,
                },
                scales: {
                    xAxes: [{
                        gridLines: {
                            display:false,
                            drawBorder: false,
                            drawTicks: false
                        },ticks: {
                            display:false
                        },
                    }],
                    yAxes: [{
                        gridLines: {
                            drawBorder: false,
                            display: true,
                            color: '#afb2c5',
                            borderDash: [2, 5],
                            drawTicks: false
                        },
                        categoryPercentage: 0.5,
                        ticks: {
                            display: false,
                            beginAtZero: true,
                            stepSize: 12,
                            max: 60,
                        }
                    }]
                },
                layout: {
                    padding: {
                        bottom: 0
                    }
                },
                tooltips: {
                    backgroundColor: '#4765FF',
                    bodyFontFamily: 'Poppins',
                    bodyFontColor: '#FFF',
                    bodyFontSize: 12,
                    displayColors: false,
                    intersect: false,
                },
            },

            elements: {
                point: {
                    radius: 0
                }
            }
        });

        var socialChartFlag1 = 1, socialChartFlag2 = 1;
        $('#nav-social-tab').on('shown.bs.tab', function (e) {
            var target = $(e.target).index() + 1;
            if(target == 2 && socialChartFlag1 > 0){
                //Chart JS - Social Network
                var lineCtx = document.getElementById('social-tweeter-chart').getContext("2d");
                var myChart = new Chart(lineCtx, {
                    type: 'line',
                    data: {
                        labels: ['1st', '2nd', '3rd', '4th', '5th', '6th', '7th', '8th', '9th', '10th', '11th', '12th', '13th', '14th', '15th', '16th', '17th', '18th', '19th'],
                        datasets: [{
                            label: "Present",
                            data: [0, 40, 0, 10, 0, 20, 0, 40, 0, 10, 0, 20, 0, 40, 0, 10, 0, 20, 0, 30],
                            backgroundColor: gradientFill,
                            borderColor: '#4765FF',
                            borderWidth: 1,
                            radius: 0,
                            pointStyle: 'line'
                        },{
                            label: "Past",
                            data: [20, 0, 40, 0, 10, 0, 20, 0, 40, 0, 10, 0, 20, 0, 30, 0, 40, 0, 10, 0],
                            backgroundColor: gradientFill1,
                            borderColor: '#fd197d',
                            borderWidth: 1,
                            radius: 0,
                            pointStyle: 'line'
                        }]
                    },
                    options: {
                        plugins: {
                            filler: {
                                propagate: false
                            }
                        },
                        responsive: true,
                        maintainAspectRatio: false,
                        legend: {
                            display: false,
                        },
                        scales: {
                            xAxes: [{
                                gridLines: {
                                    display:false,
                                    drawBorder: false,
                                    drawTicks: false
                                },ticks: {
                                    display:false
                                },
                            }],
                            yAxes: [{
                                gridLines: {
                                    drawBorder: false,
                                    display: true,
                                    color: '#afb2c5',
                                    borderDash: [2, 5],
                                    drawTicks: false
                                },
                                categoryPercentage: 0.5,
                                ticks: {
                                    display: false,
                                    beginAtZero: true,
                                    stepSize: 12,
                                    max: 60,
                                }
                            }]
                        },
                        layout: {
                            padding: {
                                bottom: 0
                            }
                        },
                        tooltips: {
                            backgroundColor: '#4765FF',
                            bodyFontFamily: 'Poppins',
                            bodyFontColor: '#FFF',
                            bodyFontSize: 12,
                            displayColors: false,
                            intersect: false,
                        },
                    },

                    elements: {
                        point: {
                            radius: 0
                        }
                    }
                });
                socialChartFlag1--;
            }
            if(target == 3 && socialChartFlag2 > 0){
                var lineCtx = document.getElementById('social-li-chart').getContext("2d");
                var myChart = new Chart(lineCtx, {
                    type: 'line',
                    data: {
                        labels: ['1st', '2nd', '3rd', '4th', '5th', '6th', '7th', '8th', '9th', '10th'],
                        datasets: [{
                            label: "Present",
                            data: [0, 40, 30, 10, 20, 15, 0, 15, 20, 0, 45],
                            backgroundColor: gradientFill,
                            borderColor: '#4765FF',
                            borderWidth: 1,
                            radius: 0,
                            pointStyle: 'line'
                        },{
                            label: "Past",
                            data: [10, 20, 35, 20, 55, 20, 15, 40, 35, 45],
                            backgroundColor: gradientFill1,
                            borderColor: '#fd197d',
                            borderWidth: 1,
                            radius: 0,
                            pointStyle: 'line'
                        }]
                    },
                    options: {
                        plugins: {
                            filler: {
                                propagate: false
                            }
                        },
                        responsive: true,
                        maintainAspectRatio: false,
                        legend: {
                            display: false,
                        },
                        scales: {
                            xAxes: [{
                                gridLines: {
                                    display:false,
                                    drawBorder: false,
                                    drawTicks: false
                                },ticks: {
                                    display:false
                                },
                            }],
                            yAxes: [{
                                gridLines: {
                                    drawBorder: false,
                                    display: true,
                                    color: '#afb2c5',
                                    borderDash: [2, 5],
                                    drawTicks: false
                                },
                                categoryPercentage: 0.5,
                                ticks: {
                                    display: false,
                                    beginAtZero: true,
                                    stepSize: 12,
                                    max: 60,
                                }
                            }]
                        },
                        layout: {
                            padding: {
                                bottom: 0
                            }
                        },
                        tooltips: {
                            backgroundColor: '#4765FF',
                            bodyFontFamily: 'Poppins',
                            bodyFontColor: '#FFF',
                            bodyFontSize: 12,
                            displayColors: false,
                            intersect: false,
                        },
                    },

                    elements: {
                        point: {
                            radius: 0
                        }
                    }
                });
                socialChartFlag2--;
            }

        });

        //ApexChart - Product Radial Chart
        var options = {
            chart: {
                height: 315,
                type: 'radialBar',
            },
            fill: {
                colors:['#FF5666', '#FFC555', '#00CB8E', '#4765FF']
            },
            plotOptions: {
                radialBar: {
                    track: {
                        show: true,
                        background: '#293551',
                    },
                    dataLabels: {
                        name: {
                            fontFamily: 'Poppins',
                            fontSize: '22px',
                            color: '#ced1e7'
                        },
                        value: {
                            fontFamily: 'Poppins',
                            fontSize: '16px',
                            color: '#ced1e7',
                        },
                        total: {
                            show: true,
                            label: 'Sold Item',
                            color: '#ced1e7',
                            formatter: function (w) {
                                return 17282;
                            }
                        },
                        style: {
                            colors: ['#FF5666', '#FFC555', '#00CB8E', '#4765FF']
                        }
                    }
                }
            },
            stroke: {
                lineCap: 'round'
            },
            series: [44, 55, 67, 83],
            labels: ['Iphone 6s', 'Moto Razr', 'Oneplus 6T', 'S10+'],

        }

        var chart = new ApexCharts(
            document.querySelector("#product-highlights"),
            options
        );

        chart.render();

        //Chart JS - Widget Like
        var ctx = document.getElementById('social-fb-like-sparkline').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["JAN", "FEB", "MAR", "APR", "MAY", "JUN"],
                datasets: [{
                    borderColor: '#00CB8E',
                    pointBorderWidth: 1,
                    pointHoverRadius: 1,
                    pointHoverBorderWidth: 1,
                    pointRadius: 1,
                    backgroundColor: gradientFill,
                    borderWidth: 2,
                    pointBackgroundColor: '#00CB8E',
                    fill: false,
                    data: [25, 20, 27, 15, 30, 20]
                }]
            },
            options: {
                responsive: false,
                maintainAspectRatio: true,
                title: {
                    display: false,
                    text: "Stacked Area"
                },
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        display: false,
                        gridLines: {
                            color: "#eef2f9",
                            drawBorder: false,
                            offsetGridLines: true,
                            drawTicks: false
                        },
                        ticks: {
                            display: false,
                            beginAtZero: false,
                            max: 32,
                            min: 15
                        },
                    }],
                    xAxes: [{
                        gridLines: {
                            display:false,
                            drawBorder: false,
                        },ticks: {
                            display:false,
                            beginAtZero:true
                        },
                    }]
                },
                tooltips: {
                    enabled: false
                },
                layout: {
                    padding: {
                        left: 0,
                        right: 0,
                        top: 0,
                        bottom: 0
                    }
                }
            }
        });

        //Chart JS - Widget Users
        var ctx = document.getElementById('social-fb-user-sparkline').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["JAN", "FEB", "MAR", "APR", "MAY", "JUN"],
                datasets: [{
                    borderColor: '#4765FF',
                    pointBorderWidth: 1,
                    pointHoverRadius: 1,
                    pointHoverBorderWidth: 1,
                    pointRadius: 1,
                    backgroundColor: gradientFill,
                    borderWidth: 2,
                    pointBackgroundColor: '#4765FF',
                    fill: false,
                    data: [20, 30, 15, 27, 20, 25]
                }]
            },
            options: {
                responsive: false,
                maintainAspectRatio: true,
                title: {
                    display: false,
                    text: "Stacked Area"
                },
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        display: false,
                        gridLines: {
                            color: "#eef2f9",
                            drawBorder: false,
                            offsetGridLines: true,
                            drawTicks: false
                        },
                        ticks: {
                            display: false,
                            beginAtZero: false,
                            max: 32,
                            min: 15
                        },
                    }],
                    xAxes: [{
                        gridLines: {
                            display:false,
                            drawBorder: false,
                        },ticks: {
                            display:false,
                            beginAtZero:true
                        },
                    }]
                },
                tooltips: {
                    enabled: false
                },
                layout: {
                    padding: {
                        left: 0,
                        right: 0,
                        top: 0,
                        bottom: 0
                    }
                }
            }
        });

        //Chart JS - Widget Comments
        var ctx = document.getElementById('social-fb-comment-sparkline').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["JAN", "FEB", "MAR", "APR", "MAY", "JUN"],
                datasets: [{
                    borderColor: '#FFC555',
                    pointBorderWidth: 1,
                    pointHoverRadius: 1,
                    pointHoverBorderWidth: 1,
                    pointRadius: 1,
                    backgroundColor: gradientFill,
                    borderWidth: 2,
                    pointBackgroundColor: '#FFC555',
                    fill: false,
                    data: [20, 28, 31, 17, 22, 25]
                }]
            },
            options: {
                responsive: false,
                maintainAspectRatio: true,
                title: {
                    display: false,
                    text: "Stacked Area"
                },
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        display: false,
                        gridLines: {
                            color: "#eef2f9",
                            drawBorder: false,
                            offsetGridLines: true,
                            drawTicks: false
                        },
                        ticks: {
                            display: false,
                            beginAtZero: false,
                            max: 32,
                            min: 15
                        },
                    }],
                    xAxes: [{
                        gridLines: {
                            display:false,
                            drawBorder: false,
                        },ticks: {
                            display:false,
                            beginAtZero:true
                        },
                    }]
                },
                tooltips: {
                    enabled: false
                },
                layout: {
                    padding: {
                        left: 0,
                        right: 0,
                        top: 0,
                        bottom: 0
                    }
                }
            }
        });

        //Chart JS - Widget Shares
        var ctx = document.getElementById('social-fb-share-sparkline').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["JAN", "FEB", "MAR", "APR", "MAY", "JUN"],
                datasets: [{
                    borderColor: '#FF5666',
                    pointBorderWidth: 1,
                    pointHoverRadius: 1,
                    pointHoverBorderWidth: 1,
                    pointRadius: 1,
                    backgroundColor: gradientFill,
                    borderWidth: 2,
                    pointBackgroundColor: '#FF5666',
                    fill: false,
                    data: [20, 16, 25, 30, 19, 15]
                }]
            },
            options: {
                responsive: false,
                maintainAspectRatio: true,
                title: {
                    display: false,
                    text: "Stacked Area"
                },
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        display: false,
                        gridLines: {
                            color: "#eef2f9",
                            drawBorder: false,
                            offsetGridLines: true,
                            drawTicks: false
                        },
                        ticks: {
                            display: false,
                            beginAtZero: false,
                            max: 32,
                            min: 15
                        },
                    }],
                    xAxes: [{
                        gridLines: {
                            display:false,
                            drawBorder: false,
                        },ticks: {
                            display:false,
                            beginAtZero:true
                        },
                    }]
                },
                tooltips: {
                    enabled: false
                },
                layout: {
                    padding: {
                        left: 0,
                        right: 0,
                        top: 0,
                        bottom: 0
                    }
                }
            }
        });

        //Widget-9 - Project State
         var data = [{
             datasets: [{
                 borderColor: "#0b1835",
                 data: [10, 30],
                 hoverBorderColor: "#fff",
                 backgroundColor: ['#4765ff', '#aca9bb']
             }],
        },{
             datasets: [{
                 borderColor: "#0b1835",
                 hoverBorderColor: "#fff",
                 data: [60, 40],
                 backgroundColor: ['#1ace1a', '#aca9bb']
             }]
         },{
             datasets: [{
                 borderColor: "#0b1835",
                 hoverBorderColor: "#fff",
                 data: [40, 60],
                 backgroundColor: ['#e0631a', '#aca9bb']
             }]
         }, {
             datasets: [{
                 borderColor: "#0b1835",
                 hoverBorderColor: "#fff",
                 data: [30, 70],
                 backgroundColor: ['#cd2145', '#aca9bb']
             }]
         },
             {
                 datasets: [{
                     data: [50, 50],
                     borderColor: "#0b1835",
                     hoverBorderColor: "#fff",
                     backgroundColor: ['#00aaff', '#aca9bb']
                 }],
             },{
                 datasets: [{
                     borderColor: "#0b1835",
                     hoverBorderColor: "#fff",
                     data: [40, 60],
                     backgroundColor: ['#1ace1a', '#aca9bb']
                 }]
             },{
                 datasets: [{
                     borderColor: "#0b1835",
                     hoverBorderColor: "#fff",
                     data: [60, 40],
                     backgroundColor: ['#e0631a', '#aca9bb']
                 }]
             }, {
                 datasets: [{
                     borderColor: "#0b1835",
                     hoverBorderColor: "#fff",
                     data: [70, 30],
                     backgroundColor: ['#242a34', '#aca9bb']
                 }]
             },
             {
                 datasets: [{
                     borderColor: "#0b1835",
                     data: [10, 90],
                     hoverBorderColor: "#fff",
                     backgroundColor: ['#4765ff', '#aca9bb']
                 }],
             },{
                 datasets: [{
                     borderColor: "#0b1835",
                     hoverBorderColor: "#fff",
                     data: [35, 65],
                     backgroundColor: ['#242a34', '#aca9bb']
                 }]
             },{
                 datasets: [{
                     borderColor: "#0b1835",
                     hoverBorderColor: "#fff",
                     data: [90, 10],
                     backgroundColor: ['#e0631a', '#aca9bb']
                 }]
             }, {
                 datasets: [{
                     borderColor: "#0b1835",
                     hoverBorderColor: "#fff",
                     data: [100, 0],
                     backgroundColor: ['#00aaff', '#aca9bb']
                 }]
             }];
        [0, 1, 2, 3].forEach(function(a) {
            var obj = document.getElementById("pro-stat-" + (a + 1));
            new Chart(obj, {
                type: "doughnut",
                data: data[a],
                options: {
                    legend: false,
                    responsive: false,
                    cutoutPercentage: 70,
                    animation: false,
                    tooltips: false,
                    elements: {
                        center: {
                            text: data[a].datasets[0].data[0]+'%',
                            color: '#CED1E7',
                            fontStyle: 'Poppins',
                            fontSize: '20',
                            sidePadding: 20
                        }
                    },
                }
            });
        });
        var projectDesign = 1, projectApp = 1;
        $('#nav-project-tab').on('shown.bs.tab', function (e) {
            var target = $(e.target).index() + 1;
            if (target == 2 && projectDesign > 0) {
                [4,5,6,7].forEach(function(a) {
                    var obj = document.getElementById("pro-stat-" + (a + 1));
                    new Chart(obj, {
                        type: "doughnut",
                        data: data[a],
                        options: {
                            legend: false,
                            responsive: false,
                            cutoutPercentage: 70,
                            animation: false,
                            tooltips: false,
                            elements: {
                                center: {
                                    text: data[a].datasets[0].data[0]+'%',
                                    color: '#CED1E7',
                                    fontStyle: 'Poppins',
                                    fontSize: '20',
                                    sidePadding: 20
                                }
                            },
                        }
                    });
                });
                projectDesign--;
            }
            if (target == 3 && projectApp > 0) {
                [8,9,10,11].forEach(function(a) {
                    var obj = document.getElementById("pro-stat-" + (a + 1));
                    new Chart(obj, {
                        type: "doughnut",
                        data: data[a],
                        options: {
                            legend: false,
                            responsive: false,
                            cutoutPercentage: 70,
                            animation: false,
                            tooltips: false,
                            elements: {
                                center: {
                                    text: data[a].datasets[0].data[0]+'%',
                                    color: '#CED1E7',
                                    fontStyle: 'Poppins',
                                    fontSize: '20',
                                    sidePadding: 20
                                }
                            },
                        }
                    });
                });
                projectApp--;
            }
        });

        //Widget 10 - Scrollbar
        $(".widget-10").css({height: '400px', position: 'relative'});
        const ps = new PerfectScrollbar('#widget-10-tab-1', {
            wheelPropagation: false,
            wheelSpeed: 2,
            swipeEasing: true,
            minScrollbarLength: 50,
            maxScrollbarLength: 250,
        });
        var ticketPending = 1, ticketProgress = 1;
        $('#nav-ticket-tab').on('shown.bs.tab', function (e) {
            var target = $(e.target).index() + 1;
            if (target == 2 && ticketPending > 0) {
                const ps = new PerfectScrollbar('#widget-10-tab-2', {
                    wheelPropagation: false,
                    wheelSpeed: 2,
                    swipeEasing: true,
                    minScrollbarLength: 50,
                    maxScrollbarLength: 250,
                });
                ticketPending--;
            }
            if (target == 3 && ticketProgress > 0) {
                const ps = new PerfectScrollbar('#widget-10-tab-3', {
                    wheelPropagation: false,
                    wheelSpeed: 2,
                    swipeEasing: true,
                    minScrollbarLength: 50,
                    maxScrollbarLength: 250,
                });
                ticketProgress--;
            }
        });

        //Check all Checkbox
        $('#chk1').change(function() {
            if($(this).is(":checked")) {
                $('.form-check-input').prop('checked', true);
            }else{
                $('.form-check-input').prop('checked', false);
            }
        });
        //Setting Panel
        $(".setting-control").click(function () {
            $(".setting-content").fadeIn( "slow" );
        });
        $(".close-settings").click(function () {
            $(".setting-content").fadeOut( "slow" );
        });

        $(".sidebar-colors").click(function () {
            var colors = ["primary", "secondary", "dark", "light", "warning", "danger", "success", "info", "white"];
            var currentEle = $(this);
            if(currentEle.data("location") == "top"){
                $.each(colors, function( index, value ){
                    if(currentEle.data("color") == value){
                        $.each(colors, function( idx, val ){
                            if($(".navbar-menu-container").hasClass('navbar-'+val)){
                                $(".navbar-menu-container").removeClass('navbar-'+val);
                                return false;
                            }
                        });
                        $(".navbar-menu-container").addClass("navbar-"+value);
                    }
                });
            }else{
                $.each(colors, function( index, value ){
                    if(currentEle.data("color") == value){
                        $.each(colors, function( idx, val ){
                            if($(".navbar-brand-container").hasClass('navbar-'+val)){
                                $(".navbar-brand-container").removeClass('navbar-'+val);
                            }
                            if($(".sidebar-nav").hasClass('sidebar-'+val)){
                                $(".sidebar-nav").removeClass('sidebar-'+val);
                                return false;
                            }
                        });
                        $(".navbar-brand-container").addClass("navbar-"+value);
                        $(".sidebar-nav").addClass("sidebar-"+value);
                    }
                });
            }


        });
    });
})(jQuery);