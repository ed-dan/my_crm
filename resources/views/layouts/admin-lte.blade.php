<!DOCTYPE html>
<html lang="en" class="Scroll">
<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta http-equiv="refresh" content="{{ config('session.lifetime') * 60 }}">

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
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
    
</head>
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

    <!-- Navbar -->

    <nav class="main-header navbar navbar-expand navbar-dark">
        <!-- Left navbar links -->

        @if(\Illuminate\Support\Facades\Auth::user())
        <ul class="navbar-nav">

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
    <div class="content-wrapper Scroll" id="app">
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
            @yield("content4")

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