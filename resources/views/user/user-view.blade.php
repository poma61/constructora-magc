@extends('layouts/app')
@section('title', 'MAGC | Usuarios')

@section('template_css')

@endsection

@section('template_content')

    <div class="card">
        <div class="card-content">


            @include('components/user/user-tabs')

            <div class="columns is-desktop">
                <div class="column">
                    <button class="button is-primary icon-text" id="new-form"><span class="icon"> <i
                                class="bi bi-plus-square"></i></span>
                        <span>Nuevo</span></button>
                </div>

            </div>

            <div id="table-container">
                <table id="table-records" class="table  is-striped is-hoverable has-background-info-light"
                    style="width:100%">

                </table>
            </div>

        </div>
    </div>



@endsection




@section('template_js')


@endsection
