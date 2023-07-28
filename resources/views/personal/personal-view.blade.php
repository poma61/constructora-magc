@extends('layouts.app')
@section('title', 'MAGC | Personal')

@section('template_css')
    <link href="{{ asset('src/css/data-table-bulma.css') }}" rel="stylesheet">
@endsection

@section('template_content')

    <div class="card">
        <div class="card-content">

            @include('components/personal/personal-tabs')

            <div class="columns is-desktop">
                <div class="column">
                    <button class="button is-info icon-text" id="new-form"><span class="icon"> <i
                                class="bi bi-plus-square"></i></span>
                        <span>Nuevo</span></button>
                </div>

            </div>

            <div id="table-container">
                <table id="table-records" class="table  is-striped is-hoverable has-background-info-light">

                </table>
            </div>
        </div>
    </div>
@endsection


@section('template_js')
    <script src="{{ asset('src/plugins/data-table/DataTableBulma1.13.js') }}"></script>
    <script src="{{ asset('src/js/personal/PersonalRender.js') }}"  type="module"></script>

    <script>
        // Carga el archivo Spanish.json de forma síncrona
        var es_json = {{ Js::from(asset('src/plugins/data-table/es.json')) }};
        $.ajax({
            url: es_json,
            dataType: "json",
            async: false,
            success: function(data) {
                translations = data;
                // Configuración de la traducción global al español
                $.extend(true, $.fn.dataTable.defaults, {
                    language: translations,

                });
            }
        });
    </script>

      
@endsection
