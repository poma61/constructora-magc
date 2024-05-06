@extends('layouts/app')
@section('title', 'Panel de Usuarios  | Constructora MAGC ')

@section('template_content')

    <div class="card mt-5">

        <div class="card-content">
          <h1 class="as-main-title has-background-primary is-size-5 has-text-centered has-text-white has-text-white animate__animated animate__bounce">
                Administracion de usuarios del sistema
            </h1>
            <div id="app">
            </div>

        </div>
    </div>
   
@endsection

@section('template_js')
 @vite('resources/js/userBoard.js')
@endsection