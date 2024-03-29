<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- Tomtom --}}
    <link rel="stylesheet"
        type="text/css"href="https://api.tomtom.com/maps-sdk-for-web/cdn/plugins/SearchBox/3.1.3-public-preview.0/SearchBox.css" />
    <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/plugins/SearchBox/3.1.3-public-preview.0/SearchBox-web.js">
    </script>
    <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.1.2-public-preview.15/services/services-web.min.js">
    </script>

    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])
</head>

<body>
    <div id="app">


        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                    <div class="logo_laravel text-danger fs-1 fw-bold">
                        BoolBnB
                    </div>
                    {{-- config('app.name', 'Laravel') --}}
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/') }}">{{ __('Home') }}</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Registrati') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item"
                                        href="{{ route('user.dashboard') }}">{{ __('Dashboard') }}</a>
                                    <a class="dropdown-item" href="{{ url('profile') }}">{{ __('Profilo') }}</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Esci') }}
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

        <main class="container-fluid vh-100">
            <div class="row h-100">
                <nav id="sidebar" class="col-1 col-md-2 d-block px-0 bg-dark navbar-dark  sidebar collapse">
                    <div class="position-sticky pt-3">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a href="{{ route('user.dashboard') }}"
                                    class="py-2 px-0 nav-link text-white w-100 text-center text-lg-start ps-lg-4 {{ Route::currentRouteName() == 'user.dashboard' ? 'bg-secondary' : '' }}">
                                    <i class="fa-solid fa-tachometer fa-md fa-fw"></i>
                                    <span class="d-none d-md-inline-block"> Dashboard </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('user.apartment.index') }}"
                                    class="py-2 px-0 nav-link text-white text-center text-lg-start ps-lg-4 {{ Route::currentRouteName() == 'user.apartment.index' ? 'bg-secondary' : '' }}">
                                    <i class="fa-solid fa-house fa-md fa-fw "></i>
                                    <span class="d-none d-md-inline-block"> Appartamenti </span>
                                </a>
                            </li>
                            @if (count(Auth::user()->apartments) > 0)
                                
                            <li class="nav-item">
                                <a href="{{ route('user.sponsor.index') }}"
                                    class="py-2 px-0 nav-link text-white text-center text-lg-start ps-lg-4 {{ Route::currentRouteName() == 'user.sponsor.index' ? 'bg-secondary' : '' }}">
                                    <i class="fas fa-hand-holding-dollar"></i>
                                    <span class="d-none d-md-inline-block"> Sponsor </span>
                                </a>
                            </li>
                            @endif
                        </ul>
                </nav>
                <main class="col-11 ms-sm-auto col-md-10 px-md-4 pt-3 color_main d-flex justify-content-center p-0">
                    @yield('content')
                </main>
            </div>
        </main>
    </div>
</body>

</html>
