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

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css"
        integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">




    @yield('personalCss')


</head>

<body>


    <div id="app">

        @include('partials.admin.header')


        <div class="dashboard">
            <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 mt-5">
                <a class="navbar-brand col-sm-3 col-md-2 ms-3" href="{{ route('homepage') }}">Homepage</a>
                {{-- <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search"> --}}
                <ul class="navbar-nav px-3">
                    <li class="nav-item text-nowrap">
                        <a class="nav-link" href="#"></a>
                    </li>
                </ul>
            </nav>

            <div class="container-fluid">
                <div class="row">
                    <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                        <div class="sidebar-sticky pt-3">
                            <ul class="navbar ul-sidebar flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.restaurants.index') }}">
                                        <i class="fa fa-shopping-bag fa-lg fa-fw" aria-hidden="true"></i>
                                        Restaurants
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </nav>

                    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
                        @yield('content')

                    </main>
                </div>
            </div>
        </div>

        @include('partials.footer')

    </div>


</body>
