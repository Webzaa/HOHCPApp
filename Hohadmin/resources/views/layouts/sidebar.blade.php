

<!-- <div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
        @if(Auth::check())  
            @if(Auth::user()->role_id == "1")
                <li class="nav-item" id="project"><a class="nav-link" href="{{ url('project') }}"><i class="nav-icon icon-plane"></i> Projects</a></li>
                <li class="nav-item" id="SalesManager"><a class="nav-link" href="{{ url('/SalesManager') }}"><i class="nav-icon icon-energy"></i> SalesManager</a></li>
                <li class="nav-item" id="ChannelPartner"><a class="nav-link" href="{{ url('/ChannelPartner') }}"><i class="nav-icon icon-diamond"></i> channel Partner</a></li>
                <li class="nav-item" id="city"><a class="nav-link" href="{{ url('/city') }}"><i class="nav-icon icon-diamond"></i>city</a></li>
                <li class="nav-item" id="ProjectCollateral"><a class="nav-link" href="{{ url('/ProjectCollateral') }}"><i class="nav-icon icon-flag"></i> Project Collateral</a></li>
            @endif
            @if(Auth::user()->role_id == "2")
                <li class="nav-item" id="project"><a class="nav-link" href="{{ url('project') }}"><i class="nav-icon icon-plane"></i> Projects</a></li>
                <li class="nav-item" id="ProjectCollateral"><a class="nav-link" href="{{ url('/ProjectCollateral') }}"><i class="nav-icon icon-flag"></i> Project Collateral</a></li>
            @endif
            
            @if(Auth::user()->role_id == "3")
                <li class="nav-item" id="project"><a class="nav-link" href="{{ url('project') }}"><i class="nav-icon icon-plane"></i> Projects</a></li>
                <li class="nav-item" id="ChannelPartner"><a class="nav-link" href="{{ url('/ChannelPartner') }}"><i class="nav-icon icon-diamond"></i> channel Partner</a></li>
                <li class="nav-item" id="ProjectCollateral"><a class="nav-link" href="{{ url('/ProjectCollateral') }}"><i class="nav-icon icon-flag"></i> Project Collateral</a></li>

            @endif
        @endif
        </ul>
    </nav>
</div> -->

<!-- sidebar.blade.php -->

<div class="container-fluid">
    <div class="row">
        <div class="d-flex align-items-start nopadding">
            <div class="col-lg-2 side-bar nopadding" style="border: 1px solid #000; background-color: #811f49; 
            height: 86vh;">
<aside class="main-sidebar">
    <section class="sidebar">    
        <!-- <div class="user-panel">
            <div class="pull-left image">
                <img src="{{asset('img/user2-160x160.jpg')}}" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p>AppDividend</p>
            </div>
        </div> -->
        <ul class="nav flex-column">
        @if(Auth::check())  
            @if(Auth::user()->hasRole('super-admin'))
                <li class="nav-item" id="project"><a class="nav-link" href="{{ url('project') }}"><i class="fa-regular fa-building"></i> Projects</a></li>
                <li class="nav-item" id="SalesManager"><a class="nav-link" href="{{ url('/SalesManager') }}"><i class="fa-solid fa-user-tie"></i> Sales Manager</a></li>
                <li class="nav-item" id="ChannelPartner"><a class="nav-link" href="{{ url('/ChannelPartner') }}"><i class="fa-solid fa-user-group"></i> Channel Partner</a></li>
                <li class="nav-item" id="city"><a class="nav-link" href="{{ url('/city') }}"><i class="fa-solid fa-city"></i>City</a></li>
                <li class="nav-item" id="Master"><a class="nav-link" href="{{ url('/Master') }}"><i class="fa-solid fa-city"></i>Master</a></li>
                <li class="nav-item" id="RolesPermission"><a class="nav-link" href="{{ url('RolesPermission') }}"><i class="fa-solid fa-city"></i>Roles and Permission</a></li>
                <li class="nav-item" id="User"><a class="nav-link" href="{{ url('User') }}"><i class="fa-solid fa-city"></i>Users</a></li>
                <!-- <li class="nav-item" id="ProjectCollateral"><a class="nav-link" href="{{ url('/ProjectCollateral') }}"><i class="nav-icon icon-flag"></i> Project Collateral</a></li> -->
            @endif
            @if(Auth::user()->role_id == "2")
                <li class="nav-item" id="project"><a class="nav-link" href="{{ url('project') }}"><i class="nav-icon icon-plane"></i> Projects</a></li>
                <!-- <li class="nav-item" id="ProjectCollateral"><a class="nav-link" href="{{ url('/ProjectCollateral') }}"><i class="nav-icon icon-flag"></i> Project Collateral</a></li> -->
            @endif
            
            @if(Auth::user()->role_id == "3")
                <li class="nav-item" id="project"><a class="nav-link" href="{{ url('project') }}"><i class="nav-icon icon-plane"></i> Projects</a></li>
                <li class="nav-item" id="ChannelPartner"><a class="nav-link" href="{{ url('/ChannelPartner') }}"><i class="nav-icon icon-diamond"></i> channel Partner</a></li>
                <!-- <li class="nav-item" id="ProjectCollateral"><a class="nav-link" href="{{ url('/ProjectCollateral') }}"><i class="nav-icon icon-flag"></i> Project Collateral</a></li> -->

            @endif
        @endif
        </ul>
    </section>
</aside>
            </div>
       
