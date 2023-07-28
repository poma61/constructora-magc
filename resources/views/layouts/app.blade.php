<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Basic Page Info -->
    <meta charset="UTF-8" />
    <title>@yield('title', 'Constructora')</title>
    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <!-- CSS -->

    <link rel="stylesheet" type="text/css" href="{{ asset('src/font/bootstrap-icons.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('src/css/style.css') }}" media="all" />
    <link rel="stylesheet" type="text/css" href="{{ asset('src/css/bulma.css') }}" media="all" />
    <link rel="stylesheet" type="text/css" href="{{ asset('src/css/animate.css') }}" media="all" />
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="icon" href="{{ asset('src/images/logo-empresa.jpeg') }}" />
    @yield('template_css')

</head>

<body>

    @include('components.nav-bar')
    @include('components.sidebar')

    <div class="as-container-page">
        <div class="mi-content">
            @yield('template_content')
        </div>
    </div>
    <script src="{{ asset('src/plugins/jquery-3.7/jquery-3.7.js') }}"></script>
    <script src="{{ asset('src/js/script.js') }}"></script>
    <script src="{{ asset('src/plugins/sweetalert2/sweetalert2.all.js') }}"></script>
    <script src="{{ asset('src/js/Config.js') }}"></script>
    <script src="{{ asset('src/js/auth/Auth.js') }}"></script>
    <script src="{{ asset('src/js/bulma.js') }}"></script>

    <script src="{{ asset('/src/plugins/axios/Axios.min.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="{{ asset('/src/plugins/toastr/ToastConfig.js') }}"></script>

    @yield('template_js')
</body>

</html>
