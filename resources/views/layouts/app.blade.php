<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm mb-4">
            <div class="container">

                <a class="navbar-brand fw-bold" href="/posts">
                    SkyStorm
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    @auth

                        <ul class="navbar-nav me-auto gap-2">

                            <li class="nav-item">
                                <a class="nav-link text-white" href="/posts">
                                    Feed
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link text-white" href="/posts/create">
                                    Create Post
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link text-white" href="/users">
                                    Users
                                </a>
                            </li>

                        </ul>

                    @endauth

                    <ul class="navbar-nav ms-auto">

                        @guest

                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('login') }}">
                                        Login
                                    </a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('register') }}">
                                        Register
                                    </a>
                                </li>
                            @endif

                        @else

                            <li class="nav-item dropdown">

                                <a id="navbarDropdown"
                                   class="nav-link dropdown-toggle text-white"
                                   href="#"
                                   role="button"
                                   data-bs-toggle="dropdown">

                                    {{ Auth::user()->name }}

                                </a>

                                <div class="dropdown-menu dropdown-menu-end">

                                    <a class="dropdown-item"
                                       href="/users/{{ auth()->id() }}">

                                        My Profile

                                    </a>

                                    <a class="dropdown-item"
                                       href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">

                                        Logout

                                    </a>

                                    <form id="logout-form"
                                          action="{{ route('logout') }}"
                                          method="POST"
                                          class="d-none">

                                        @csrf

                                    </form>

                                </div>

                            </li>

                        @endguest

                    </ul>

                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
