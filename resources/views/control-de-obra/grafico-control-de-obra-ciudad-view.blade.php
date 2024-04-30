@extends('layouts/app')
@section('title', 'MAGC | Control de obras')

@section('template_content')
    <div class="card mt-5">
        <div class="card-content">
            <h1
                class="as-main-title has-background-success is-size-5 has-text-centered has-text-white animate__animated animate__bounceInDown">
                Control de obras | Grafico
            </h1>
            <nav class="breadcrumb" aria-label="breadcrumbs">
                <ul>
                    <li>
                        <div class="has-text-info">
                            <span class="icon is-small">
                                <i class="mdi mdi-arrow-right-bold-outline" aria-hidden="true"></i>
                            </span>
                            <span>{{ $ciudad}}</span>
                        </div>
                    </li>
                </ul>
            </nav>
            @include('components/control-de-obra/control-de-obra-options')

            <div id="app"></div>
        </div>
    </div>
@endsection


@section('template_js')
    @vite('resources/js/obraChart.js')
@endsection
