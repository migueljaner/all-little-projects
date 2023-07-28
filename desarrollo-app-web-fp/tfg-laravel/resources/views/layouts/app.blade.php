<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="/images/favicon.ico" type="image/x-icon"/>
    <!-- <base href="{{ url()->current() }}"> -->

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/table.js') }}"></script>
    <script src="{{asset('js/modals.js')}}"></script>
    

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/w34-panel.css') }}" rel="stylesheet" type="text/css">
    <!-- DataTables -->
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/fh-3.1.4/r-2.2.2/datatables.min.css"/>
    

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg bg-primary text-uppercase">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home')}}">
                    <img src="https://w34marketing.com/wp-content/uploads/2019/01/Logo-W34-01-1.png" alt="W34Marketing" id="logo">
                </a>
                <button class="navbar-toggler navbar-toggler-right text-uppercase text-white btn bg-secondary collapsed" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"  aria-label="Toggle navigation">
                        <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse mt-2" id="navbarResponsive">
                    <!-- Left Side Of Navbar -->
                    @guest
                    @else 
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item mx-0 mx-lg-1">
                            <a id="clients" data-table='Client' class="nav-link py-3 px-0 px-lg-3 mt-2" href="{{ action('HomeController@showClients') }}">Clients</a>
                        </li>
                        <li class="nav-item dropdown p-0 text-white">
                            <a class="nav-link btn dropdown-toggle py-lg-3 px-lg-3 mt-2 text-left" data-toggle="dropdown" aria-expanded="false">Configuration</a>
                            <div class="dropdown-menu bg-primary">
                                @if (Auth::user()->isAdmin())
                                <a class="nav-link p-3" href="{{ action('HomeController@getUsers') }}">Admins</a>
                                @endif 
                                <a class="nav-link p-3" href="{{ action('HomeController@showCatTypes') }}">Category Types</a>
                                <a class="nav-link p-3" href="{{ action('HomeController@showQualTypes') }}">Quality Types</a>
                            </div>
                        </li>
                    </ul>
                    @endguest
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link mt-2" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link mt-2" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link mt-2 dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->nombre }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right bg-primary" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item nav-link px-3" href="{{ route('userconf') }}">
                                        Perfil
                                    </a>
                                    <a class="dropdown-item nav-link px-3" href="{{ route('userpwdchange') }}">
                                        Change Password
                                    </a>
                                    <a class="dropdown-item nav-link px-3" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <main class="pb-4 pt-2">
            @yield('content')
        </main>
        
        <footer class="page-footer bg-primary">
            <div class="text-center">
                <a class="footer-link" href="{{ route('home')}}""><img src="https://w34marketing.com/wp-content/uploads/2019/01/Logo-W34-01-1.png" alt="W34Marketing" id="logo"></a>
            </div>
        </footer>
    </div>
</body>
</html>
