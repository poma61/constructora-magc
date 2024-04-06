@extends('layouts/app')
@section('title', 'MAGC | Clientes')


@section('template_content')
    <div class="card mt-5">
        <div class="card-content">
            <h1 class="as-main-title as-background-orange is-size-5 has-text-centered has-text-white animate__animated animate__rubberBand">
                Clientes | Tablero
            </h1>

            @include('components/cliente/cliente-tabs')

            <nav class="breadcrumb" aria-label="breadcrumbs">
                <ul>
                    <li>
                        <div class="has-text-info">
                            <span class="icon is-small">
                                <i class="mdi mdi-city" aria-hidden="true"></i>
                            </span>
                            <span>{{ $city }}</span>
                        </div>
                    </li>
                    <li>
                        <div class="has-text-info">
                            <span class="icon is-small">
                                <i class="mdi mdi-group" aria-hidden="true"></i>
                            </span>
                            <span> Grupo {{ $grupo_active }}</span>
                        </div>
                    </li>
                </ul>
            </nav>

            @include('components/cliente/cliente-group-options')

            <div id="app"></div>
        </div>
    </div>

@endsection

@section('template_js')
    @vite('resources/js/clienteBoard.js')
@endsection
