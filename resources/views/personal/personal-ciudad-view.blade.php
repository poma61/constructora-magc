@extends('layouts/app')
@section('title', 'Personal | Constructora MAGC')

@section('template_content')

    <div class="card mt-5">
        <div class="card-content">
            <h1
                class="as-main-title has-background-link is-size-5 has-text-centered has-text-white animate__animated animate__zoomInDown">
                Panel de administracion del personal
            </h1>

            <div class="is-flex is-justify-content-center is-align-items-center is-flex-wrap-wrap">

                @foreach ($ciudades as $city)
                    <div class="box m-2" style="width:350px;height:200px">
                        <div class="is-flex is-justify-content-center is-align-items-center is-flex-direction-column">
                            <figure class="image is-96x96">
                                @php
                                    //convertir el nombre de la ciudad en minusculas
                                    // porque los nombres de las imagenes de las ciudades esta en minuscula
                                    $parse_name_city = strtolower($city);
                                @endphp
                                <img class="is-rounded" src="{{ asset('src/images/bandera-' . $parse_name_city . '.jpg') }}">
                            </figure>
                            <p> {{ $city }}</p>

                            <a href="{{ route('r-tablero-personal-view', $city) }}"
                                class="button is-primary is-outlined is-rounded">
                                <span class="icon is-small">
                                    <i class="mdi mdi-check"></i>
                                </span>
                                <span>Administrar personal</span>
                            </a>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>

@endsection
