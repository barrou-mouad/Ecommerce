<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/jquery.min.js') }}" defer></script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}" defer></script>
   <script src="{{ asset('js/main.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link href="{{ asset('css/mystyle.css') }}" rel="stylesheet">
    <link href="{{ asset('css/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/owl.theme.default.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <link href="{{ asset('css/mystyle.css') }}" rel="stylesheet">
</head>
<body onload="selected()" class="">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light  bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                   <img width="70px" src="{{ asset('images/logo.png') }}">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                    <li  class="nav-item"><a href="/contact" class="nav-link">Contact</a></li>
                    </ul>

                    <div class="row ">
                        <div class="row " id="searching" >
                        @csrf
                      <input placeholder="Searching" id="search" type="search" class="form-control" ></div>
                      <div class="row" id="result" style="position: absolute;width:500px !important ; z-index: 2; top:70px !important;left:-px">

                       </div>
                    </div>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        @if (!app('request')->is('admin') and !app('request')->is('admin/*') )
                        @if (auth::guard('web')->check() and count(auth::user()->unreadNotifications)!=0 )

                                <li class="nav-item dropdown">
                                    <a class="nav-link" data-toggle="dropdown" href="#">
                                      <i class="far fa-bell"></i>
                                      <span class="badge badge-warning navbar-badge">{{count(auth::user()->unreadNotifications)}}</span>
                                    </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                  <a class="dropdown-item" href="{{route('mycommandes')}}">Affectaion de date de laivraison</a>
                                </div>

                        </li>
                        @endif
                        <li class="nav-item"><a href="{{route('mycart')}}" class="nav-link"><i class="fas fa-shopping-cart"></i></a></li>
                        <li class="nav-item"><a href="{{route('favorite')}}" class="nav-link"><i class="fas fa-heart"></i></a></li>

                        <!-- Authentication Links -->
                        @endif

                        @guest
                            @if (Route::has('login') and ( !app('request')->is('admin') and !app('request')->is('admin/*') ))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register') and  ( !app('request')->is('admin') and !app('request')->is('admin/*') ))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item"><a href="{{route('home')}}" class="nav-link">{{ Auth::user()->name }}</a></li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                </a>
                          @if (auth::guard('web')->check())


                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{route('user.setting')}}"><i class="fas fa-cog"></i> Pararmètre</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i>
                                         {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                                @else
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>

                                </div>
                                @endif


                            </li>
                        @endguest
                    </ul>

                </div>
            </div>
        </nav>

        <main>
            @yield('content')
        </main>

        <footer class="footer bg-bluesky-bottom">
            <div class="row">
                <div class="col-sm-6 col-md-4 footer-navigation">
                    <h3 class="text-center">
                        <a href="#" class="text-center"><img class="mx-auto" src="{{ asset('images/logo.png') }}" width="80px" alt="" srcset=""></a>
                    </h3>
                    <p class="links text-center"><a href="#">Home</a><strong> · </strong><a href="#">Login</a><strong> · </strong><a href="#">Sign up</a><strong> · </strong><a href="#">Contact</a></p>
                    <p class="company-name text-center">Copy Right © 2021</p>
                </div>
                <div class="col-sm-6 col-md-4 footer-contacts">
                    <div><span class="fa fa-map-marker footer-contacts-icon"> </span>
                        <p><span class="new-line-span">Ancienne Route de l’Aéroport. Tanger </span> Maroc</p>
                    </div>
                    <div><i class="fa fa-phone footer-contacts-icon"></i>
                        <p class="footer-center-info email text-left"> +1 9485045958</p>
                    </div>
                    <div><i class="fa fa-envelope footer-contacts-icon"></i>
                        <p> <a href="#" target="_blank">support@bbbootstrap.com</a></p>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-4 footer-about">
                    <h4>Supported payment systems</h4>
                    <p><img src="{{ asset('images/paypal.png') }}" height="40px" alt="" srcset=""></p>

                </div>
            </div>
        </footer>
    </div>

</body>
<script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
</html>
