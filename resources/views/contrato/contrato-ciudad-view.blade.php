@extends('layouts/app')
@section('title', 'MAGC | Contratos')

@section('template_content')
    <div class="card mt-5">

        <div class="card-content">
            <h1 class="as-main-title as-background-orange is-size-5 has-text-centered has-text-white animate__animated animate__bounceInDown">
                Contratos
            </h1>
            {{-- ciudades --}}
            <div class="list has-hoverable-list-items has-visible-pointer-controls px-5">
                    @foreach ($ciudades as $city)
                        <div class="list-item">
                            <div class="list-item-image">
                                <figure class="image is-64x64">
                                    @php
                                        //convertir el nombre de la ciudad en minusculas
                                        // porque los nombres de las imagenes de las ciudades esta en minuscula
                                        $parse_name_city = strtolower($city);
                                    @endphp
                                    <img class="is-rounded"
                                        src="{{ asset('src/images/bandera-' . $parse_name_city . '.jpg') }}">
                                </figure>
                            </div>

                            <div class="list-item-content">
                                <div class="list-item-title">{{ $city }}</div>

                            </div>

                            <div class="list-item-controls">
                                <div class="buttons is-right">

                                    <a href="{{ route('r-tablero-contrato', $city) }}"
                                        class="button is-info is-outlined">
                                        <span class="icon is-small">
                                            <i class="mdi mdi-check"></i>
                                        </span>
                                        <span>Administrar</span>
                                    </a>

                                </div>
                            </div>
                        </div>
                    @endforeach
            </div>
            {{-- ciudades --}}
        </div>
    </div>

@endsection
