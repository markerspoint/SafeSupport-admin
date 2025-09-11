<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="icon" type="image/png" href="{{ asset('template/img/safecenter-logo.png') }}">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <title>Admin | Dashboard</title>

    <link href="{{asset('template/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('template/font-awesome/css/font-awesome.css')}}" rel="stylesheet">

    <!-- Toastr style -->
    <link href="{{asset('template/css/plugins/toastr/toastr.min.css')}}" rel="stylesheet">

    <!-- Gritter -->
    <link href="{{asset('template/js/plugins/gritter/jquery.gritter.css')}}" rel="stylesheet">

    <link href="{{asset('template/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('template/css/style.css')}}" rel="stylesheet">


</head>

<style>
    body {
        font-family: 'Poppins', sans-serif !important;
    }
</style>

<body>
    <div id="wrapper">

        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="block m-t-xs font-bold">Example user</span>
                                <span class="text-muted text-xs block">menu <b class="caret"></b></span>
                            </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a class="dropdown-item" href="login.html">Logout</a></li>
                            </ul>
                        </div>
                        <div class="logo-element">
                            <img src="{{ asset('template/img/safecenter-logo.png') }}" alt="SafeCenter Logo"
                                style="max-height:40px;">
                        </div>
                    </li>
                    <li class="active">
                        <a href=""><i class="fa fa-th-large"></i> <span
                                class="nav-label">Dashboard</span></a>
                    </li>
                </ul>
            </div>
        </nav>

        <div id="page-wrapper" style="background-color: #f6f9ff !important;">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i
                                class="fa fa-bars"></i> </a>
                        <form role="search" class="navbar-form-custom" method="post" action="#">
                            <div class="form-group">
                                <input type="text" placeholder="Search for something..." class="form-control"
                                    name="top-search" id="top-search">
                            </div>
                        </form>
                    </div>
                    <ul class="nav navbar-top-links navbar-right">
                        <li>
                            <a href="#">
                                <i class="fa fa-sign-out"></i> Log out
                            </a>
                        </li>
                    </ul>

                </nav>
            </div>

            {{-- body --}}
            <div class="wrapper wrapper-content">
                @yield('body')
            </div>

            <div class="footer">
                <div class="pull-right">
                    SafeSupport.
                </div>
                <div>
                    Developed & maintained by <strong>Mark Ian D. Dela Cruz</strong>
                </div>
            </div>

        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="{{asset('template/js/jquery-3.1.1.min.js')}}"></script>
    <script src="{{asset('template/js/popper.min.js')}}"></script>
    <script src="{{asset('template/js/bootstrap.js')}}"></script>
    <script src="{{asset('template/js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>
    <script src="{{asset('template/js/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>

    <!-- Flot -->
    <script src="{{asset('template/js/plugins/flot/jquery.flot.js')}}"></script>
    <script src="{{asset('template/js/plugins/flot/jquery.flot.tooltip.min.js')}}"></script>
    <script src="{{asset('template/js/plugins/flot/jquery.flot.spline.js')}}"></script>
    <script src="{{asset('template/js/plugins/flot/jquery.flot.resize.js')}}"></script>
    <script src="{{asset('template/js/plugins/flot/jquery.flot.pie.js')}}"></script>

    <!-- Peity -->
    <script src="{{asset('template/js/plugins/peity/jquery.peity.min.js')}}"></script>
    {{-- <script src="{{asset('template/js/demo/peity-demo.js')}}"></script> --}}

    <!-- Custom and plugin javascript -->
    <script src="{{asset('template/js/inspinia.js')}}"></script>
    <script src="{{asset('template/js/plugins/pace/pace.min.js')}}"></script>

    <!-- jQuery UI -->
    <script src="{{{asset('template/js/plugins/jquery-ui/jquery-ui.min.js')}}}"></script>

    <!-- GITTER -->
    <script src="{{asset('template/js/plugins/gritter/jquery.gritter.min.js')}}"></script>

    <!-- Sparkline -->
    <script src="{{asset('template/js/plugins/sparkline/jquery.sparkline.min.js')}}"></script>

    <!-- Sparkline demo data  -->
    {{-- <script src="{{asset('template/js/demo/sparkline-demo.js')}}"></script> --}}

    <!-- ChartJS-->
    <script src="{{asset('template/js/plugins/chartJs/Chart.min.js')}}"></script>

    <!-- Toastr -->
    <script src="{{asset('template/js/plugins/toastr/toastr.min.js')}}"></script>

    <script>
        $(document).ready(function() {

            let toast = $('.toast');

            setTimeout(function() {
                toast.toast({
                    delay: 5000,
                    animation: true
                });
                toast.toast('show');

            }, 2200);

            var data1 = [
                [0,4],[1,8],[2,5],[3,10],[4,4],[5,16],[6,5],[7,11],[8,6],[9,11],[10,30],[11,10],[12,13],[13,4],[14,3],[15,3],[16,6]
            ];
            var data2 = [
                [0,1],[1,0],[2,2],[3,0],[4,1],[5,3],[6,1],[7,5],[8,2],[9,3],[10,2],[11,1],[12,0],[13,2],[14,8],[15,0],[16,0]
            ];
            $("#flot-dashboard-chart").length && $.plot($("#flot-dashboard-chart"), [
                data1, data2
            ],
                    {
                        series: {
                            lines: {
                                show: false,
                                fill: true
                            },
                            splines: {
                                show: true,
                                tension: 0.4,
                                lineWidth: 1,
                                fill: 0.4
                            },
                            points: {
                                radius: 0,
                                show: true
                            },
                            shadowSize: 2
                        },
                        grid: {
                            hoverable: true,
                            clickable: true,
                            tickColor: "#d5d5d5",
                            borderWidth: 1,
                            color: '#d5d5d5'
                        },
                        colors: ["#1ab394", "#1C84C6"],
                        xaxis:{
                        },
                        yaxis: {
                            ticks: 4
                        },
                        tooltip: false
                    }
            );

            var doughnutData = {
                labels: ["App","Software","Laptop" ],
                datasets: [{
                    data: [300,50,100],
                    backgroundColor: ["#a3e1d4","#dedede","#9CC3DA"]
                }]
            } ;


            var doughnutOptions = {
                responsive: false,
                legend: {
                    display: false
                }
            };


            var ctx4 = document.getElementById("doughnutChart").getContext("2d");
            new Chart(ctx4, {type: 'doughnut', data: doughnutData, options:doughnutOptions});

            var doughnutData = {
                labels: ["App","Software","Laptop" ],
                datasets: [{
                    data: [70,27,85],
                    backgroundColor: ["#a3e1d4","#dedede","#9CC3DA"]
                }]
            } ;


            var doughnutOptions = {
                responsive: false,
                legend: {
                    display: false
                }
            };


            var ctx4 = document.getElementById("doughnutChart2").getContext("2d");
            new Chart(ctx4, {type: 'doughnut', data: doughnutData, options:doughnutOptions});

        });

        $(window).bind("scroll", function () {
            let toast = $('.toast');
            toast.css("top", window.pageYOffset + 20);

        });
    </script>
</body>

</html>