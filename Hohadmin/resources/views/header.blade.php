<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>House Of Hiranandani</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{url('/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{url('/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{url('/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <!-- Select2 -->
    <!-- <link rel="stylesheet" href="{{url('/plugins/select2/css/select2.min.css')}}"> -->
    <!-- Theme style -->
    <link rel="stylesheet" href="{{url('/dist/css/adminlte.min.css')}}">
    <!-- Custom style -->
    <link rel="stylesheet" href="{{url('/dist/css/custom.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- select 2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://demo.dashboardpack.com/architectui-html-free/main.css" rel="stylesheet">
    
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown show">
                    <a class="nav-link logout-dropdown" data-class="show" data-toggle="dropdown" href="#" aria-expanded="false">
                        @if(Auth::check())                         
                            <span class="badge navbar-badge">{{ Auth::user()->name }}</span>
                        @else
                            @guest
                            @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}" style="">{{ __('Login') }}</a>
                            </li>
                            @endif
    
                            @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}" style="color:black;">{{ __('Register') }}</a>
                            </li>
                            @endif
                            @endguest
                        @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
                        <div class="dropdown-divider"></div>
                         <span class="dropdown-item dropdown-header"><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="fa fa-power-off" aria-hidden="true"></i> Logout</a></span>
                        <div class="dropdown-divider"></div>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-primary elevation-4">
            <!-- Brand Logo -->
            <a href="#" class="brand-link" style="text-align: center;">
                <img src="{{url('/images/logo-color.png')}}" alt="AdminLTE Logo" class="" style="opacity: .8; width: 170px;height: auto;">
            </a>
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"></a>
                    </div>
                </div> -->
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        
                        @if(Auth::check())
                            @if(Auth::user()->hasPermission('view_dashboard'))
                            <li class="nav-item" id="Dashboard"><a class="nav-link" href="{{ url('Dashboard') }}"><i class="fa fa-building" aria-hidden="true"></i>&nbsp; <p>Dashboard</p></a></li>
                             @endif
                            @if(Auth::user()->hasPermission('view-project'))
                                <li class="nav-item" id="project"><a class="nav-link" href="{{ url('project') }}"><i class="fa fa-building" aria-hidden="true"></i>&nbsp; <p>Projects</p></a></li>
                            @endif
                             
                            @if(Auth::user()->hasPermission('view-lead'))    
                                <li class="nav-item" id="lead"><a class="nav-link" href="{{ url('/lead') }}"><i class="fa fa-user-tie" aria-hidden="true"></i>&nbsp;<p>Leads</p></a></li>
                            @endif
                             
                            @if(Auth::user()->hasPermission('view-sales-manager'))    
                                <li class="nav-item" id="SalesManager"><a class="nav-link" href="{{ url('/SalesManager') }}"><i class="fa fa-user-tie" aria-hidden="true"></i>&nbsp;<p>Sales Manager</p></a></li>
                            @endif
                            
                            @if(Auth::user()->hasPermission('view-channel-partner'))
                                <li class="nav-item" id="ChannelPartner"><a class="nav-link" href="{{ url('/ChannelPartner') }}"><i class="fa fa-user" aria-hidden="true"></i>&nbsp; <p>Channel Partner</p></a></li>
                            @endif
                            
                            @if(Auth::user()->hasPermission('view-city'))
                                <li class="nav-item" id="city"><a class="nav-link" href="{{ url('/city') }}"><i class="fa fa-city" aria-hidden="true"></i>&nbsp;<p>City</p></a></li>
                            @endif
                            
                            @if(Auth::user()->hasPermission('view-master'))
                                <li class="nav-item" id="Master"><a class="nav-link" href="{{ url('/Master') }}"><i class="fa fa-city" aria-hidden="true"></i>&nbsp;<p>Master</p></a></li>
                            @endif                            
                            
                            @if(Auth::user()->hasPermission('view-user'))
                                <li class="nav-item" id="Notification"><a class="nav-link" href="{{ url('Notification') }}"><i class="fa fa-users" aria-hidden="true"></i>&nbsp;<p>Notification</p></a></li>           
                            @endif
                            
                            @if(Auth::user()->hasPermission('view-roles-permission'))
                                <li class="nav-item" id="RolesPermission"><a class="nav-link" href="{{ url('RolesPermission') }}"><i class="fa fa-lock" aria-hidden="true"></i>&nbsp;<p>Roles and Permission</p></a></li>
                            @endif
                            
                            @if(Auth::user()->hasPermission('view-user'))
                                <li class="nav-item" id="User"><a class="nav-link" href="{{ url('User') }}"><i class="fa fa-users" aria-hidden="true"></i>&nbsp;<p>Users</p></a></li>           
                            @endif
                            <!-- <li class="nav-item" id="ProjectCollateral"><a class="nav-link" href="{{ url('/ProjectCollateral') }}"><i class="nav-icon icon-flag"></i> Project Collateral</a></li> -->
                        @endif
                            
                        
                        
                        
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>