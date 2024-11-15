<!DOCTYPE html>
<html lang="en" class="Scroll">
<head>
    <meta http-equiv="refresh" content="{{ config('session.lifetime') * 60 }}">
    <style type="text/css">
        * {
            margin: 0px;
            padding: 0;
        }

        #container {
            height: 100%;
            width: 100%;
            font-size: 0;
        }

        #left, #middle, #right {
            display: inline-block;
            *display: inline;
            zoom: 1;
            vertical-align: top;
            font-size: 12px;
        }

        #left {
            width: 48%;
        }


        #right {
            width: 48%;
        }

        .Scroll {
            scrollbar-color:  #343a40 #454d55;
            /*scrollbar-width: thin;*/
        }

        .progressbar {
            margin: 10px 0 10px 0;
            counter-reset: step;
        }

        .progressbar li {
            list-style-type: none;
            width: 25%;
            float: left;
            font-size: 12px;
            position: relative;
            text-align: center;
            text-transform: uppercase;
            color: #7d7d7d;
        }

        .progressbar li:before {
            width: 15px;
            height: 15px;
            content: '';
            line-height: 30px;
            border: 2px solid #7d7d7d;
            background-color: #7d7d7d;
            display: block;
            text-align: center;
            margin: 0 auto 10px auto;
            border-radius: 50%;
            transition: all .8s;
        }

        .progressbar li:after {
            width: 100%;
            height: 2px;
            content: '';
            position: absolute;
            background-color: #7d7d7d;
            top: 7px;
            left: -50%;
            z-index: -1;
            transition: all .8s;
        }

        .progressbar li:first-child:after {
            content: none;
        }


        .progressbar li.active:before {
            border-color: #55B776FF;
            background-color: #55b776;
            transition: all .8s;
        }

        .progressbar li.active:after {
            background-color: #55b776;
            transition: all .8s;
        }


        .progressbar-red li.active:before {
            border-color: #dc3a3a;
            background-color: #DC3A3AFF;
            transition: all .8s;
        }

        .progressbar-red li.active:after {
            background-color: #55b776;
            transition: all .8s;
        }


        .progressbar-red li {
            list-style-type: none;
            width: 25%;
            float: left;
            font-size: 12px;
            position: relative;
            text-align: center;
            text-transform: uppercase;
            color: #7d7d7d;
        }

        .progressbar-red li:before {
            width: 15px;
            height: 15px;
            content: '';
            line-height: 30px;
            border: 2px solid #7d7d7d;
            background-color: #7d7d7d;
            display: block;
            text-align: center;
            margin: 0 auto 10px auto;
            border-radius: 50%;
            transition: all .8s;
        }

        .progressbar-red li:after {
            width: 100%;
            height: 2px;
            content: '';
            position: absolute;
            background-color: #7d7d7d;
            top: 7px;
            left: -50%;
            z-index: -1;
            transition: all .8s;
        }

        .progressbar-red li:first-child:after {
            content: none;
        }




        .progressbar-yellow li.active:before {
            border-color: #dcb63a;
            background-color: #dcb63a;
            transition: all .8s;
        }

        .progressbar-yellow li.active:after {
            background-color: #55b776;
            transition: all .8s;
        }


        .progressbar-yellow li {
            list-style-type: none;
            width: 25%;
            float: left;
            font-size: 12px;
            position: relative;
            text-align: center;
            text-transform: uppercase;
            color: #7d7d7d;
        }

        .progressbar-yellow li:before {
            width: 15px;
            height: 15px;
            content: '';
            line-height: 30px;
            border: 2px solid #7d7d7d;
            background-color: #7d7d7d;
            display: block;
            text-align: center;
            margin: 0 auto 10px auto;
            border-radius: 50%;
            transition: all .8s;
        }

        .progressbar-yellow li:after {
            width: 100%;
            height: 2px;
            content: '';
            position: absolute;
            background-color: #7d7d7d;
            top: 7px;
            left: -50%;
            z-index: -1;
            transition: all .8s;
        }

        .progressbar-yellow li:first-child:after {
            content: none;
        }

        .btn {
            background-color: #55b776;
            margin: 5px;
            width: 75px;
            color: white;
        }

        .btn:hover {
            color: white;
        }

        .btn:focus {
            color: white;
        }

        .btn-container {
            display: flex;
            justify-content: center;
            width: 100%;
            position: absolute;
            bottom: 0;
        }

        body {
            background-color: #333333;
        }

        .bg-success-default {
            background-color: #5b636c !important;
        }
        .bg-success-red {
            background-color: rgba(248, 80, 80, 0.5) !important;
        }
        .bg-success-green {
            background-color: #56F68E49 !important;
        }
        .bg-success-yellow {
            background-color: rgba(245, 232, 75, 0.33) !important;
        }

        .step-progress {
            display: flex;
            width: 75%;
        }

        .step {
            flex: 1;
            position: relative;
            text-align: center;
            padding: 10px;
            background-color: rgba(175, 174, 174, 0.28);
            /*border-top: 1px solid #ccc;*/
            /*border-bottom: 1px solid #ccc;*/
        }

        .step.active-green {
            background-color: rgba(86, 246, 142, 0.29);
            color: #fff;
        }
        .step.active-red {
            background-color: rgba(250, 108, 108, 0.29);
            color: #fff;

        }
        .step.active-yellow {
            background-color: rgba(245, 232, 75, 0.34);
            color: #fff;

        }

        .step::before {
            content: '';
            position: absolute;
            top: 0;
            right: -10px;
            width: 0;
            height: 0;
            border-top: 20px solid transparent;
            border-bottom: 20px solid transparent;
            border-left: 10px solid rgba(175, 174, 174, 0.28);
        }
        .step.active-green::before {
            content: '';
            position: absolute;
            top: 0;
            right: -10px;
            width: 0;
            height: 0;
            border-top: 20px  solid transparent;
            border-bottom: 20px solid transparent;
            border-left: 10px solid rgba(9, 252, 94, 0.43);
        }
        .step.active-yellow::before {
            content: '';
            position: absolute;
            top: 0;
            right: -10px;
            width: 0;
            height: 0;
            border-top: 20px  solid transparent;
            border-bottom: 20px solid transparent;
            border-left: 10px solid rgba(245, 232, 75, 0.61);
        }
        .step.active-red::before {
            content: '';
            position: absolute;
            top: 0;
            right: -10px;
            width: 0;
            height: 0;
            border-top: 20px  solid transparent;
            border-bottom: 20px solid transparent;
            border-left: 10px solid rgba(252, 70, 70, 0.58);
        }

        .no-margin-padding {
            margin: 0;
            padding: 0;
        }



    </style>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
    <link rel="stylesheet" href=" {{asset('resources/css/app.css')}}"
          href=" {{asset('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback')}}">
    <!-- Font Awesome Icons -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin panel</title>


    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">


    <link rel="stylesheet" href=" {{asset('plugins/fontawesome-free/css/all.min.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href=" {{asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href=" {{asset('dist/css/adminlte.min.css')}}">
    {{--    @vite(['resources/sass/app.scss', 'resources/js/app.js'])--}}
    {{--    <link rel="stylesheet"--}}
    {{--          href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css') }}"/>--}}
</head>
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

    <!-- Navbar -->

    <nav class="main-header navbar navbar-expand navbar-dark">
        <!-- Left navbar links -->

        @if(\Illuminate\Support\Facades\Auth::user())
        <ul class="navbar-nav">
            {{--                        <li class="nav-item  mt-2 ">--}}
            {{--                            <a class="nav-link" data-widget="pushmenu" href="{{ route('logout') }}  " role="button"><i--}}
            {{--                                    class="fas fa-bars"></i></a>--}}
            {{--                        </li>--}}

            <h4>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Home</a>
                </li>
            </h4>

            <h4>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('deal.index') }}">Deals</a>
                </li>
            </h4>

            <h4>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('task.index') }}">Tasks</a>
                </li>
            </h4>

            @if(auth()->user()->position_id == App\Models\User::ADMIN_ID or 
            auth()->user()->position_id == App\Models\User::ANALYTIC_ID)
                <h4>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('product.index') }}">Products</a>
                    </li>
                </h4>

                <h4>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('company.index') }}">Companies</a>
                    </li>
                </h4>
            @endif
        </ul>
        @endif
        <!-- Right navbar links -->


        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>


        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ms-auto">


            <!-- Authentication Links -->
            @guest
                @if (Route::has('login'))

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
{{--                @if(App\Models\User::getPosition(Auth::user()->position_id) == "admin")--}}

{{--                @endif--}}

            @else

                <li class="nav-item dropdown">
                    <div class="nav-item dropdown mr-1 ">
                        <a class="nav-link dropdown-toggle" href="#"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ Auth::user()->name, 'logout'}}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>

    </nav>

    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4 ">
        <!-- Brand Logo -->
        <div class="info mt-3 ml-2">
            <h2> DiplomaCRM </h2>
        </div>
        <!-- Sidebar -->
        <div class="sidebar ">
            <!-- Sidebar user panel (optional) -->
            <!-- SidebarSearch Form -->
            <!-- Sidebar Menu -->
            <nav class="mt-5">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    @if(\Illuminate\Support\Facades\Auth::user())
                    <li class="nav-item menu-open">
                        <ul class="nav nav-treeview">
                            <li class="nav-item ">
                                <a href="{{ route("home") }}" class="nav-link ">
                                    <div class="d-inline-block">
                                        <h5>
                                            <ion-icon class="hover:text-orange-500" name="home-outline"></ion-icon>
                                        </h5>
                                    </div>
                                    <div class="d-inline-block">
                                        <h5>
                                            Home
                                        </h5>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a href="{{ route('deal.index') }}" class="nav-link ">
                                    <div class="d-inline-block">
                                        <h5>
                                            <ion-icon class="hover:text-orange-500" name="reader-outline"></ion-icon>
                                        </h5>
                                    </div>
                                    <div class="d-inline-block">
                                        <h5>
                                            Deals
                                        </h5>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a href="{{ route('task.index') }}" class="nav-link ">
                                    <div class="d-inline-block">
                                        <h5>
                                            <ion-icon class="hover:text-orange-500" name="calendar-outline"></ion-icon>
                                        </h5>
                                    </div>
                                    <div class="d-inline-block">
                                        <h5>
                                            Tasks
                                        </h5>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endif
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" id="app">
        <!-- Content Header (Page header) -->
        <!-- /.content-header -->
        @guest
            <section class="mt-5">
                <div class="container-fluid">
                    <!-- Info boxes -->
                    <div class="mt-3">
                        <div class="row">
                            <div class="col-md-12">
                                <div class=" mt-5">
                                    <div class="mt-5" id="app">
                                        @yield('login')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @else
            @yield("edit")

        @endguest

        @if(\Illuminate\Support\Facades\Auth::user())
            <!-- Main content -- -->
            @yield("content")
            @yield("content1")
            @yield("content2")
            @yield("content3")

        @endif

        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>

</div>
<script type="text/javascript" src="{{asset('/js/app.js')}}"></script>
<script type="module" src="{{asset('https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js')}}"></script>
<script nomodule src="{{asset('https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js')}}"></script>


{{--<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>--}}
{{--<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>--}}
{{--<script src="{{asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>--}}
{{--<script src="{{asset('dist/js/adminlte.js')}}"></script>--}}
{{--<script src="{{asset('plugins/jquery-mousewheel/jquery.mousewheel.js')}}"></script>--}}
{{--<script src="{{asset('plugins/raphael/raphael.min.js')}}"></script>--}}
{{--<script src="{{asset('plugins/jquery-mapael/jquery.mapael.min.js')}}"></script>--}}
{{--<script src="{{asset('plugins/jquery-mapael/maps/usa_states.min.js')}}"></script>--}}
{{--<script src="{{asset('plugins/chart.js/Chart.min.js')}}"></script>--}}
{{--<script src="{{asset('dist/js/demo.js')}}"></script>--}}
{{--<script src="{{asset('dist/js/pages/dashboard2.js')}}"></script>--}}
{{--</body>--}}
{{--<script type="text/javascript" src="{{asset('/js/app.js')}}"></script>--}}

