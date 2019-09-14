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
    <link rel="stylesheet" href="/font/iconsmind/style.css" />
    <link rel="stylesheet" href="/font/simple-line-icons/css/simple-line-icons.css" />

    <link rel="stylesheet" href="css/vendor/bootstrap-stars.css" />
    <link rel="stylesheet" href="css/vendor/bootstrap.min.css" />
    <link rel="stylesheet" href="css/vendor/owl.carousel.min.css" />
    <link rel="stylesheet" href="css/vendor/bootstrap-float-label.min.css" />
    <link rel="stylesheet" href="css/vendor/bootstrap-stars.css" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dore/main.css') }}" rel="stylesheet">
    @stack("styles")
</head>
<body class="background show-spinner">
<div id="app">
    <div class="fixed-background"></div>
    <main>
        @yield('content')
    </main>
</div>
</body>
</html>
