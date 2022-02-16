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

        <div class="dashboard mt-5">
            <div class="container-fluid">
                <div class="row">
                    <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                        <div class="sidebar-sticky pt-3">
                            <ul class="navbar ul-sidebar flex-column">
                                <li class="nav-item">
                                    @if (Auth::user()->has_restaurant)
                                        <a class="nav-link" href="{{ route('admin.restaurants.index') }}">

                                            <i class="fa fa-shopping-bag fa-lg fa-fw" aria-hidden="true"></i>
                                            Restaurants
                                        </a>
                                    @else
                                        <a href="{{ route('admin.register.create') }}">Crea il primo ristorante
                                        </a>
                                    @endif
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
