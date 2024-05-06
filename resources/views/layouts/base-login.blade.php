<!DOCTYPE html>
<html lang="es">

<head>
    <title>@yield('title', 'Constructora MAGC | Inicio de Sesión')</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('src/images/logo-empresa.jpeg') }}" />
    <link rel="stylesheet" media="screen" href="{{ asset('src/css/auth/animacion.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('src/css/auth/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('src/css/auth/main.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('src/css/bulma/bulma.css') }}" />

    @yield('template_css')
</head>

<body>

    <div id="particles-js"></div>

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                @yield('template_login')
            </div>
        </div>
    </div>

    <script src="{{ asset('src/plugins/jquery-3.7/jquery-3.7.js') }}"></script>
    <script src="{{ asset('src/js/auth/main.js') }}"></script>
    <script src="{{ asset('src/js/auth/Animacion.js') }}"></script>
    <script src="{{ asset('src/js/auth/Particles.js') }}"></script>
    <script src="{{ asset('src/js/bulma/bulma.js') }}"></script>
    @yield('template_js')
</body>

</html>
