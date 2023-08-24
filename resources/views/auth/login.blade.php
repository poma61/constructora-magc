@extends('layouts.master-login')


@section('title', 'Constructora MAGC')
@section('template_css')
    <link rel="stylesheet" type="text/css" href="{{ asset('src/css/bulma.css') }}" />
@endsection

@section('template_login')
    <form class="login100-form validate-form" action="{{ route('r-login') }}" method="post">
        @csrf
        <span class="login100-form-title p-b-43">
            Inicio de Sesion
        </span>

        <div class="wrap-input100 validate-input" data-validate="Este campo es obligatorio">
            <input class="input100" type="text" name="usuario"  autocomplete="username" >
            <span class="focus-input100"></span>
            <span class="label-input100">Usuario</span>

        </div>


        <div class="wrap-input100 validate-input" data-validate="Este campo es obligatorio">
            <input class="input100" type="password" name="password"  autocomplete="current-password">
            <span class="focus-input100"></span>
            <span class="label-input100">Contraseña</span>
        </div>

        <div class="container-login100-form-btn">
            <button class="login100-form-btn">
                Ingresar
            </button>
        </div>
        <br>
        @error('failed-user')
            <div class="notification is-warning">
                <button class="delete"></button>
                {{ $message }}
            </div>
        @enderror

    </form>

    <div class="login100-more" style="background-image: url({{ asset('src/images/logo-empresa.jpeg') }});">
    </div>
@endsection

@section('template_js')
    <script src="{{ asset('src/js/bulma.js') }}"></script>
@endsection
