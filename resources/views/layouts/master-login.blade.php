<!DOCTYPE html>
<html lang="es">
<head>
    <title>@yield('title','Constructora')</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{asset('vendors/images/logo-empresa.jpeg')}}" />
    <link rel="stylesheet" media="screen" href="{{asset('vendors/css/auth/animacion.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/css/auth/util.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/css/auth/main.css')}}">

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

    <script src="{{asset('src/plugins/jquery-3.7/jquery-3.7.js')}}"></script>
    <script src="{{asset('vendors/js/auth/main.js')}}"></script>
    <script src="{{asset('vendors/js/auth/Animacion.js')}}"></script>
    <script src="{{asset('vendors/js/auth/Particles.js')}}"></script>
    @yield('template_js')
</body>
</html>
