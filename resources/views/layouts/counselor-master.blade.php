<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/png" href="{{ asset('template/img/safecenter-logo.png') }}">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <title>Counselor | Dashboard</title>

    {{-- font awesome --}}
    <link href="{{asset('template/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('template/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('template/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('template/css/style.css')}}" rel="stylesheet">

    {{-- data tables --}}
    <link href="{{ asset('template/css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">

    <!-- Toastr style -->
    <link href="{{asset('template/css/plugins/toastr/toastr.min.css')}}" rel="stylesheet">

    <!-- Gritter -->
    <link href="{{asset('template/js/plugins/gritter/jquery.gritter.css')}}" rel="stylesheet">

    <!-- iCheck -->
    <link href="{{asset('template/css/plugins/iCheck/custom.css')}}" rel="stylesheet">

    <!-- fullCalendar -->
    <link href="{{asset('template/css/plugins/fullcalendar/fullcalendar.css')}}" rel="stylesheet">
    <link href="{{asset('template/css/plugins/fullcalendar/fullcalendar.print.css')}}" rel='stylesheet' media='print'>

    <!-- morris -->
    <link href="{{ asset('template/css/plugins/morris/morris-0.4.3.min.css') }}" rel="stylesheet">
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
                                <span class="block m-t-xs font-bold d-flex align-items-center">
                                    <img src="{{ asset('template/img/profile_default.jpg') }}" alt="Default_Profile" style="width:40px; height:40px; border-radius:50%; object-fit:cover; margin-right:8px;">
                                    {{ Auth::user()->name }}
                                </span>
                                <span class="text-muted text-xs block">menu <b class="caret"></b></span>
                            </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a class="dropdown-item" href="{{ route('counselor.profile') }}">Profile</a></li>
                                <li><a class="dropdown-item" href="{{ route('login') }}">Logout</a></li>
                            </ul>
                        </div>
                        <div class="logo-element">
                            <img src="{{ asset('template/img/safecenter-logo.png') }}" alt="SafeCenter Logo" style="max-height:40px;">
                        </div>
                    </li>
                    <li class="{{ request()->routeIs('counselor.dashboard') ? 'active' : '' }}">
                        <a href="{{ route('counselor.dashboard') }}">
                            <i class="fa fa-th-large"></i>
                            <span class="nav-label">Dashboard</span>
                        </a>
                    </li>

                    <li class="{{ request()->routeIs('counselor.appointment') ? 'active' : '' }}">
                        <a href="{{ route('counselor.appointment') }}">
                            <i class="fa fa-suitcase"></i>
                            <span class="nav-label">Appointments</span>
                        </a>
                    </li>

                    <li class="{{ request()->routeIs('counselor.schedule') ? 'active' : '' }}">
                        <a href="{{ route('counselor.schedule') }}">
                            <i class="fa fa-calendar"></i>
                            <span class="nav-label">Schedule</span>
                        </a>
                    </li>

                    <li class="{{ request()->routeIs('counselor.resources.*') ? 'active' : '' }}">
                        <a href="{{ route('counselor.resources.index') }}">
                            <i class="fa fa-book"></i>
                            <span class="nav-label">Resources</span>
                        </a>
                    </li>

                </ul>
            </div>
        </nav>

        <div id="page-wrapper" style="background-color: #edf0f5 !important;">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header d-flex align-items-center">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary" style="margin-top: 2px;" href="#">
                            <i class="fa fa-bars"></i>
                        </a>
                        <a href="{{ route('counselor.dashboard') }}" class="navbar-brand d-flex align-items-center ml-3" style="font-weight: bold; color: #1ab394;">
                            SafeSupp
                            <img src="{{ asset('template/img/safecenter-logo.png') }}" alt="O" style="height: 24px; margin: 0 4px;">
                            rt
                        </a>
                    </div>
                    <ul class="nav navbar-top-links navbar-right">
                        <li>
                            <a href="{{ route('login') }}" class="logout-link">
                                <i class="fa fa-sign-out"></i>Logout 
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
    <script src="{{ asset('template/js/plugins/fullcalendar/moment.min.js') }}"></script>

    <!-- Flot -->
    <script src="{{asset('template/js/plugins/flot/jquery.flot.js')}}"></script>
    <script src="{{asset('template/js/plugins/flot/jquery.flot.tooltip.min.js')}}"></script>
    <script src="{{asset('template/js/plugins/flot/jquery.flot.spline.js')}}"></script>
    <script src="{{asset('template/js/plugins/flot/jquery.flot.resize.js')}}"></script>
    <script src="{{asset('template/js/plugins/flot/jquery.flot.pie.js')}}"></script>

    <!-- Peity -->
    <script src="{{asset('template/js/plugins/peity/jquery.peity.min.js')}}"></script>
    <script src="{{asset('template/js/demo/peity-demo.js')}}"></script>

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
    <script src="{{asset('template/js/demo/sparkline-demo.js')}}"></script>

    <!-- ChartJS-->
    <script src="{{asset('template/js/plugins/chartJs/Chart.min.js')}}"></script>
    <!-- Morris -->
    <script src="{{asset('template/js/plugins/morris/raphael-2.1.0.min.js')}}"></script>
    <script src="{{asset('template/js/plugins/morris/morris.js')}}"></script>

    <!-- Toastr -->
    <script src="{{asset('template/js/plugins/toastr/toastr.min.js')}}"></script>

    {{-- data tables --}}
    <script src="{{ asset('template/js/plugins/dataTables/datatables.min.js') }}"></script>

    <!-- iCheck -->
    <script src="{{asset('template/js/plugins/iCheck/icheck.min.js')}}"></script>

    <!-- Full Calendar -->
    <script src="{{asset('template/js/plugins/fullcalendar/fullcalendar.min.js')}}"></script>

    {{-- toast --}}
    <script>
        @if(session('success'))
        toastr.success("{{ session('success') }}", "Success");
        @endif

        @if(session('error'))
        toastr.error("{{ session('error') }}", "Error");
        @endif

        @if(session('info'))
        toastr.info("{{ session('info') }}", "Info");
        @endif

        @if(session('warning'))
        toastr.warning("{{ session('warning') }}", "Warning");
        @endif

    </script>

    @yield('scripts')
</body>

</html>
