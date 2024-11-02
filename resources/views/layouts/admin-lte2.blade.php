<!DOCTYPE html>
<html lang="en" class="Scroll">
<head>

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
            height: 250px;
        }

        #left {
            width: 49%;
        }


        #right {
            width: 49%;

        }

        .Scroll {
            scrollbar-color: #454d55 #343a40;
            /*scrollbar-width: thin;*/
        }

        }
    </style>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin panel</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href=" {{asset('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback')}}">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href=" {{asset('plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href=" {{asset('resources/css/app.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href=" {{asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href=" {{asset('dist/css/adminlte.min.css')}}">
    {{--    @vite(['resources/sass/app.scss', 'resources/js/app.js'])--}}

</head>
<body class="Scroll hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

    <!-- Navbar -->

    <nav class="main-header navbar navbar-expand navbar-dark">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            {{--            <li class="nav-item  mt-2 ">--}}
            {{--                <a class="nav-link" data-widget="pushmenu" href="{{ route('logout') }}  " role="button"><i--}}
            {{--                        class="fas fa-bars"></i></a>--}}
            {{--            </li>--}}

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
                @endif


            @else
                {{--                <li class="nav-item dropdown">--}}
                {{--                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"--}}
                {{--                       data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>--}}
                {{--                        {{ Auth::user()->name }}--}}
                {{--                    </a>--}}

                {{--                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">--}}
                {{--                        <a class="dropdown-item" href="{{ route('logout') }}"--}}
                {{--                           onclick="event.preventDefault();--}}
                {{--                                                     document.getElementById('logout-form').submit();">--}}
                {{--                            {{ __('Logout') }}--}}
                {{--                        </a>--}}

                {{--                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">--}}
                {{--                            @csrf--}}
                {{--                        </form>--}}
                {{--                    </div>--}}
                {{--                </li>--}}
                @if(App\Models\User::getPosition(Auth::user()->position_id) == "admin")
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register User') }}</a>
                    </li>
                @endif
                @endif

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
                    <li class="nav-item menu-open">
                        <ul class="nav nav-treeview">
                            <li class="nav-item ">
                                <a href="{{ route('home') }}" class="nav-link ">
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
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>


    <div class="content-wrapper Scroll" id="app">
        <section class="content Scroll mr-4">
            <div class="container-fluid">
                <!-- Info boxes -->
                <div class="mt-5 ml-2">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card mt-5">
                                <div class="card-header" id="">
                                    <h3 class="ml-2">Welcome: {{ Auth::user()->name, }}</h3>
                                    <hr>
                                    <h5 class="ml-2">Email: {{ Auth::user()->email, }}</h5>
                                    @if(Auth::user()->position_id == 1 )
                                        <h5 class="ml-2">Position: Admin</h5>
                                    @elseif(Auth::user()->position_id == 2)
                                        <h5 class="ml-2">Position: Analytical Expert</h5>
                                    @elseif(Auth::user()->position_id == 3)
                                        <h5 class="ml-2">Position: Manager</h5>
                                    @endif

                                    <div id="container" class="Scroll" style="overflow-y: scroll">
                                        <div style="margin: 5px"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card mt-5">
                                <div class="card-header" id="">

                                    <div id="container">
                                        <div style="margin: 5px">@yield('content3')</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4" style="float: right">
                            <div class="card mt-5">
                                <div class="card-header" id="">

                                    <div id="container" class="Scroll" style="overflow-y: scroll">
                                        <div style="margin: 5px">@yield('content4')</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!-- Main content -->
        <section class="content Scroll" id="left">
            <div class="container-fluid">
                <!-- Info boxes -->
                <div class="ml-2">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card ">
                                <div class="card-header" id="">
                                    @if(Auth::user()->position_id == 1 )
                                        <h3 class="ml-3">
                                            Manager Statistic:
                                        </h3>

                                    @elseif(Auth::user()->position_id == 2)
                                        <h2 class="ml-3">
                                            Statistics:
                                        </h2>

                                    @elseif(Auth::user()->position_id == 3)
                                        <h2 class="ml-3">
                                            Leads:
                                        </h2>

                                    @endif

                                    @yield('login')


                                    @if(Auth::user()->position_id == 2)
                                        <div id="container" >
                                            <div style="margin: 5px; height: 300px">
                                                @yield('content')
                                            </div>
                                        </div>
                                    @else
                                        <div id="container" class="Scroll" style="overflow-y: scroll">
                                            <div style="margin: 5px" id="left">
                                                @yield('content')
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.card-footer -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.col -->
            </div>
        </section>

        <section class="content" id="right">
            <div class="container-fluid">
                <!-- Info boxes -->
                <div class="">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card ">
                                <div class="card-header">
                                    @if(Auth::user()->position_id == 1 )
                                        <h2 class="ml-3">
                                            Today's Callbacks:
                                        </h2>

                                    @elseif(Auth::user()->position_id == 2)
                                        <h2 class="ml-3">
                                            Parameters:
                                        </h2>

                                    @elseif(Auth::user()->position_id == 3)
                                        <h2 class="ml-3">
                                            Today's Callbacks:
                                        </h2>
                                    @endif
                                    @yield('login')

                                    @if(Auth::user()->position_id == 2)
                                        <div id="" >
                                            <div style="margin: 5px; height: 322px">
                                                @yield('content2')
                                            </div>
                                        </div>
                                    @else
                                        <div id="container" class="Scroll" style="overflow-y: scroll">
                                            <div style="margin: 5px" id="left">
                                                @yield('content2')
                                            </div>
                                        </div>
                                    @endif

                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.card-footer -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.col -->
            </div>
        </section>


        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>

</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.js')}}"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="{{asset('plugins/jquery-mousewheel/jquery.mousewheel.js')}}"></script>
<script src="{{asset('plugins/raphael/raphael.min.js')}}"></script>
<script src="{{asset('plugins/jquery-mapael/jquery.mapael.min.js')}}"></script>
<script src="{{asset('plugins/jquery-mapael/maps/usa_states.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('plugins/chart.js/Chart.min.js')}}"></script>

<!-- AdminLTE for demo purposes -->
{{--<script src="{{asset('dist/js/demo.js')}}"></script>--}}
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('dist/js/pages/dashboard2.js')}}"></script>

{{-- FOR POP UP WINDOW --}}
<script type="text/javascript" src="{{asset('/js/app.js')}}"></script>
{{--  FOR ICONS--}}
<script type="module" src="{{asset('https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js')}}"></script>
<script nomodule src="{{asset('https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js')}}"></script>
</body>

{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>--}}

<script type="text/javascript" src="{{asset('/js/app.js')}}"></script>

{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>--}}
</html>
