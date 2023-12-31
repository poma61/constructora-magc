@extends('layouts/app')
@section('title', 'MAGC | Perfil')


@section('template_content')

    <div class="card mt-5" style="min-height:85vh">

        <div class="card-content">
          <h1 class="as-main-title has-background-primary is-size-5 has-text-centered has-text-white has-text-white animate__animated animate__bounce">
                Datos del usuario del sistema
            </h1>

            <div id="app">
            </div>

        </div>
    </div>
   
@endsection

@section('template_js')

 @vite('resources/js/authUserProfile.js')
@endsection