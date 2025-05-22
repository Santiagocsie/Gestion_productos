<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="utf-8">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <link rel="stylesheet" href="resources/css/app.css">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        /* Opcional: darle un poco de estilo personalizado al offcanvas */
        .offcanvas-end {
            width: 250px;
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),
            url("https://mdbootstrap.com/img/new/textures/full/171.jpg") no-repeat center center fixed;
        background-size: cover;
        color: white;
        }

        .offcanvas-header {
            border-bottom: 1px solid #dee2e6;
        }
        
        .btn-sidebar {
            margin: 0.75rem auto;
            display: block;
            width: 80%;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div id="app">
        @if (!Request::is('login'))
        <nav class="navbar navbar-expand-md navbar-dark" style="background-color: #81c6f7;">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    {{ config('app.name') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" 
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto"></ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <!-- Botón que abre la barra lateral -->
                                <a class="nav-link" href="#" data-bs-toggle="offcanvas" data-bs-target="#userSidebar" aria-controls="userSidebar">
                                    {{ Auth::user()->Nombre }}
                                </a>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Offcanvas sidebar -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="userSidebar" aria-labelledby="userSidebarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="userSidebarLabel">Hola, {{ Auth::user()->Nombre }}</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Cerrar"></button>
            </div>
            <div class="offcanvas-body d-flex flex-column justify-content-start">
                <a href="{{ route('password.edit') }}" class="btn btn-primary btn-sidebar">Cambiar contraseña</a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sidebar">Cerrar sesión</button>
                </form>
            </div>
        </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- Bootstrap JS y dependencias -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
