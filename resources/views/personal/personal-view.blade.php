@extends('layouts/app')
@section('title', 'Constructora MAGC | Personal')

@section('template_css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link href="{{ asset('src/css/data-table/data-table-bulma.css') }}" rel="stylesheet">
@endsection

@section('template_content')

    <div class="card mt-5">
        <div class="card-content">
            <h1 class="as-main-title has-background-primary is-size-5 has-text-centered has-text-white animate__animated animate__fadeInRightBig">
                Administracion del personal
            </h1>

            @include('components/personal/personal-tabs')

            <div class="columns is-desktop">
                <div class="column">
                    <button class="button is-info icon-text" id="new-form">
                        <span class="icon">
                            <span class="mdi mdi-pencil-plus"></span>
                        </span>
                        <span>Nuevo</span></button>
                </div>

            </div>

            <div id="table-container" class="as-table animate__animated animate__fadeInLeftBig">
                <table id="table-records" class="table  is-striped is-hoverable" style="width:100%">

                </table>
            </div>
        </div>
    </div>
@endsection


@section('template_js')
    <script src="{{ asset('/src/plugins/axios/Axios.min.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="{{ asset('/src/plugins/toastr/ToastConfig.js') }}"></script>

    <script src="{{ asset('src/plugins/data-table/DataTableBulma1.13.js') }}"></script>
    <script src="{{ asset('src/js/personal/PersonalRender.js') }}" type="module"></script>
    <script src="{{ asset('src/plugins/data-table/DataTableConfig.js') }}" type="module"></script>
@endsection
