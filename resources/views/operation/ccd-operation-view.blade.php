@extends('layouts/app')
@section('title', 'Operaciones | Constructora MAGC')

@section('template_content')
    <div class="card mt-5">
        <div class="card-content">
            <h1
                class="as-main-title as-background-orange  is-size-5 has-text-centered has-text-white animate__animated animate__bounceInDown">
                Operaciones
            </h1>

            <div id="app"></div>

        </div>
    </div>
@endsection


@section('template_js')
    @vite('resources/js/operationCCD.js')
@endsection 
