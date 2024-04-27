<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Basic Page Info -->
    <meta charset="UTF-8" />
    <title>@yield('title', 'Constructora MAGC')</title>
    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet" />

    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/@mdi/font@7.2.96/css/materialdesignicons.min.css" />

    <link rel="stylesheet" type="text/css" href="{{ asset('src/css/bulma/bulma.css') }}" media="all" />
    <link rel="stylesheet" type="text/css" href="{{ asset('src/css/animate/animate.css') }}" media="all" />
    <link rel="stylesheet" type="text/css" href="{{ asset('src/css/sidebar/style.css') }}" media="all" />

    <!-- CSS -->

    <link rel="icon" href="{{ asset('src/images/logo-empresa.jpeg') }}" />
    @yield('template_css')

</head>

<body>

    @include('layouts/partials/nav-bar')
    @include('layouts/partials/sidebar')

    <div class="as-container-page">  
        @include("layouts/partials/system-notifications")
        @yield('template_content')
    </div>

    <script src="{{ asset('src/plugins/jquery-3.7/jquery-3.7.js') }}"></script>
    <script src="{{ asset('src/js/bulma/bulma.js') }}"></script>
    <script src="{{ asset('src/js/sidebar/script.js') }}"></script>

    <script src="{{ asset('src/plugins/sweetalert2/sweetalert2.all.js') }}"></script>

    <script src="{{ asset('src/js/auth/logout.js') }}" type="module"></script>

    @yield('template_js')
</body>

</html>
