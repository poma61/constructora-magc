@extends('layouts/app')
@section('title', 'Diseños | Constructora MAGC')

@section('template_content')
    <div class="card mt-5">
        <div class="card-content">
            <h1
                class="as-main-title as-background-orange  is-size-5 has-text-centered has-text-white animate__animated animate__bounceInDown">
                Diseño | Calendario
            </h1>
          
            @include('components/disenio/disenio-options')

            <div id="app"></div>
        </div>
    </div>
@endsection


@section('template_js')
    @vite('resources/js/disenioCalendar.js')
@endsection
