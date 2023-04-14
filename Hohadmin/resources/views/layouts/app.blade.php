<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>HOH Admin</title>



    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Philosopher&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">
    <link href="{{ asset('frontend/css/bootstrap5.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/custom.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- JS, Popper.js, and jQuery -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <style>
        li.nav-item.active {
            font-weight: 600;
            background-color: #816e4e85 !important
        }

        a.nav-link active {
            color: #000 !important;
        }

        .table tr td {
    font-size: 14px;
}



        a.nav-link {
            color: #Fff;
        }

        .nav-link:focus,
        .nav-link:hover {
            font-weight: 600;
            color: #fff;
        }

        .side-bar {
            padding: 0px !important;
        }

        nav.navbar.navbar-expand-md.navbar-light.bg-white.shadow-sm {
            height: 60px;
            background-color: #eee !important;
        }

        a.navbar-brand img {
            position: absolute;
            top: -8px;
        }

        a.btn.btn-success {
            background-color: #811f49;
            border: 1px solid #811f49;
        }

        button.btn.btn-primary {
            background-color: #811f49;
            border: 1px solid #811f49;
            width: 49%;
        }

        .nopadding {
            padding: 0px;
        }

        main.py-4 {
            padding: 0 20px;
    width: 80%;
        }

        .mb-2 {
    margin-bottom: 0.5rem!important;
    padding: 0;
    margin: 0;
}

        .table tr th {
            width: 10% !important;
        }

        body {
            font-family: 'Philosopher', sans-serif;
            background-color: #eee !important;
        }

        .d-flex.align-items-start.nopadding {
            overflow: hidden;
        }

        .ameneties .btn-group {
            width: 70%;
        }

        .ameneties button {
            text-align: left;
        }

        .nav-item .nav-link i {
            margin-right: 15px;
        }

        .nav-item {
            font-size: 17px;
        }

        span.relative.z-0.inline-flex.shadow-sm.rounded-md {
            display: none;
        }

        li.select2-selection__choice {
            float: left;
            margin: 0px 0px 2px 5px;
            background-color: #811f49;
            padding: 5px 15px 5px 5px;
            border-radius: 20px;
            font-size: 14px;
            color: white;
        }

        button.select2-selection__choice__remove {
            border: none;
            background-color: #811f49;
            font-size: 15px;
            color: white;
        }

        textarea.select2-search__field {
            border: 1px solid #ced4da !important;
        }

        /*
        textarea.select2-search__field:focus-visible {
            border: none !important;
        }*/
        .select2-container {
            box-sizing: border-box;
            display: inline-block;
            border: 1px solid !important;
            margin: 0;
            position: relative;
            vertical-align: middle;
            background-color: #fff;
        }
    </style>
</head>

<body>
    <div id="app" class="mt-3">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm mt-4">
            <div class="container-fluid nopadding">
                <a class="navbar-brand" href="{{ url('/') }}"> <img src="{{ asset('images/logo-color.png') }}" alt="" style="width: 200px;"> </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
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
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="color:black; color:black; position: absolute; bottom: -10px; right: 25px;
">
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="fa-solid fa-right-from-bracket" style="margin-right: 20px;"></i>
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        @if(Auth::check())
        @include('layouts.sidebar')
        @endif
        <main class="py-4 col-lg-11">
            @yield('content')
        </main>
    </div>
</body>
<!-- Scripts -->
<!-- <script src="{{ asset('frontend/js/jquery-3.6.0.min.js') }}" defer></script> -->
<script src="{{ asset('frontend/js/bootstrap5.bundle.min.js') }}" defer></script>
<script src="{{ asset('frontend/js/custom.js') }}" defer></script>


<script>
    var path = $(location).attr('pathname').replace('/', '');
    console.log(path);
    $("#" + path).addClass('active')
</script>

</html>