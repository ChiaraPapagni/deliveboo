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

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        body {
            background-color: #fece2c
        }

        .provanav,
        .provafoot {
            border: 5px solid #3b3b3b;
        }

        .provahover:hover {
            -webkit-box-shadow: 0px 0px 44px 3px rgba(202, 29, 31, 0.75);
            box-shadow: 0px 0px 44px 3px rgba(202, 29, 31, 0.75);
            transform: scale(1.2);
        }

    </style>
</head>

<body>

    @include('partials.header')

    @yield('content')

    @include('partials.footer')

</body>

</html>
