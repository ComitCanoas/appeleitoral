<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'App Eleitoral') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery.mask.js') }}"></script>
    <script src="{{ asset('js/mascarasCampos.js') }}"></script>
    <script src="{{ asset('js/mapas.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Parâmetro sensor é utilizado somente em dispositivos com GPS -->
    <script src="http://maps.google.com/maps/api/js?key=AIzaSyAUYQ2SVSeO93ffaGQ2gEcwjozEYPaSOgk&sensor=false"></script>

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark navbar-laravel fixed-top" style="box-shadow: 0 3px 3px rgba(0, 0, 0, 0.4);">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'App Eleitoral') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @auth
                            @php
                                $route = Route::currentRouteName();
                            @endphp

                            <li class="nav-item">
                                <a class="nav-link {{ $route == 'home' ? 'active text-danger' : '' }}" href="{{ route('home') }}">Home</a>
                            </li>
                            @if(Auth::user()->isAdministrador() || Auth::user()->isCadastro())
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Administrar
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item {{ $route == 'politico.index' ? 'active' : '' }}" href="{{ route('politico.index') }}">Político</a>
                                        <a class="dropdown-item {{ $route == 'administrar-presidente-coordenador.index' ? 'active' : '' }}" href="{{ route('administrar-presidente-coordenador.index') }}">Presidente Coordenador</a>
                                        <a class="dropdown-item {{ $route == 'administrar-recurso.index' ? 'active' : '' }}" href="{{ route('administrar-recurso.index') }}">Recursos</a>
                                        <a class="dropdown-item {{ $route == 'administrar-apoiador.index' ? 'active' : '' }}" href="{{ route('administrar-apoiador.index') }}">Apoiador</a>
                                        <a class="dropdown-item {{ $route == 'administrar-visita.index' ? 'active' : '' }}" href="{{ route('administrar-visita.index') }}">Visitas</a>
                                        @if(Auth::user()->isAdministrador())
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item {{ $route == 'user.index' ? 'active' : '' }}" href="{{ route('user.index') }}">Usuários</a>
                                        @endif
                                    </div>
                                </li>
                            @endif
                        @endauth
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li><a class="nav-link" href="{{ route('login') }}">{{ __('Entrar') }}</a></li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
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

        <main class="py-4 mt-5">
            <div class="container">
                @yield('breadcrumbs')
                @yield('content')
            </div>
        </main>

        <br><br><br>

        <footer class="footer">
            <nav class="navbar navbar-dark bg-dark" style="height: 40px; border-top: solid 1px #D93545;">
                <div class="container">
                    <span class="navbar-brand mb-0 h1 active">PTB</span>
                    <div class="footer-copyright text-muted">
                        <small>versão 1.0</small> - © 2018 Copyright
                    </div>
                </div>
            </nav>
        </footer>
    </div>
</body>
</html>
