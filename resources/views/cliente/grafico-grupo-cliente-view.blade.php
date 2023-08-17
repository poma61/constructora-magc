@extends('layouts/app')
@section('title', 'MAGC | Clientes')

@section('template_css')

@endsection

@section('template_content')
    <div class="card mt-5">
        <div class="card-content">
            <h1 class="as-main-title is-size-5 has-text-white animate__animated animate__rubberBand">
                Clientes
            </h1>

            @include('components/cliente/cliente-tabs')

            <nav class="breadcrumb is-medium" aria-label="breadcrumbs">
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

            <div class="buttons">
                <a href="{{ route('r-tablero-cliente-grupo-view', [$city, $grupo_active]) }}"
                    class="panel-block button is-success my-1 @if (request()->route()->getName() == 'r-tablero-cliente-grupo-view') is-outlined @endif">
                    Tablero
                </a>
                <a href="{{ route('r-grafico-cliente-grupo-view', [$city, $grupo_active]) }}"
                    class="panel-block button is-success my-1 @if (request()->route()->getName() == 'r-grafico-cliente-grupo-view') is-outlined @endif">
                    Grafico
                </a>
                <a class="panel-block button is-success my-1">
                    Calendario
                </a>
                <a class="panel-block button is-success my-1">
                    Gantt
                </a>
            </div>
            
        </div>
    </div>

@endsection



@section('template_js')

@endsection
