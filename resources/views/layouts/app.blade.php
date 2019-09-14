<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Кулинарная книга</title>

    <link rel="icon" href="/img/icons/book.png">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    @stack("styles")
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container-fluid">
                <div class="row w-100">
                    <div class="offset-md-1 col-md-5">
                        <img class="logo" src="{{ asset("/img/logo.png") }}" alt="Logotype">
                        <a class="navbar-brand" href="{{ url('/') }}">
                            Кулинарная книга
                        </a>
                    </div>
                    <div class="col-md-6 text-right">
                        <img src="{{ asset("/img/icons/logout.png") }}" alt="Logout">
                        <a class="" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            Выход
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>



            </div>
        </nav>

        <div class="container-fluid">
            <div class="row">
                <div class="offset-md-1 col-md-2">
                    <ul class="nav flex-column aside">
                        <li class="nav-item text-center">
                            <a class="nav-link active" href="{{ route("recipes.index") }}">Мои рецепты</a>
                        </li>
                        <li class="nav-item text-center">
                            <a class="nav-link" href="{{ route("ingredients.index") }}">Ингредиенты</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-9">
                    <main class="py-4 w-100">
                        @yield('content')
                    </main>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
