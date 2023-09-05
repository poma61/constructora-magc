@extends('layouts/app')
@section('title', 'MAGC | Finanzas de construccion')

@section('template_content')
    <div class="card mt-5">
        <div class="card-content">
            <h1
                class="as-main-title has-background-info is-size-5 has-text-centered has-text-white animate__animated animate__bounceInDown">
                Finanzas de construccion | Gantt
            </h1>
            <nav class="breadcrumb is-medium" aria-label="breadcrumbs">
                <ul>
                    <li>
                        <div class="has-text-info">
                            <span class="icon is-small">
                                <i class="mdi mdi-city" aria-hidden="true"></i>
                            </span>
                            <span>{{ strtoupper($ciudad) }}</span>
                        </div>
                    </li>
                </ul>
            </nav>
            @include('components/finanzas-de-construccion/contratista-options')

            <div id="app"></div>
        </div>
    </div>
@endsection


@section('template_js')
    @vite('resources/js/contratistaGantt.js')
@endsection
