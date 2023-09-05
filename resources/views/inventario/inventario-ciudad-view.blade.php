@extends('layouts/app')
@section('title', 'MAGC | Inventario')

@section('template_content')

    <div class="card mt-5">
        <div class="card-content">
            <h1
                class="as-main-title has-background-info is-size-5 has-text-centered has-text-white animate__animated animate__zoomInDown">
                Inventario
            </h1>

            <div class="is-flex is-justify-content-center is-align-items-center is-flex-wrap-wrap">
                @if (Auth::user()->role == 'Administrador')
                    @foreach ($list_ciudades as $row)
                        <div class="box m-2" style="width:350px;height:200px">
                            <div class="is-flex is-justify-content-center is-align-items-center is-flex-direction-column">
                                <figure class="image is-96x96">
                                    @php
                                        //convertir el nombre de la ciudad en minusculas
                                        // porque los nombres de las imagenes de las ciudades esta en minuscula
                                        $parse_name_city = strtolower($row->city_name);
                                    @endphp
                                    <img class="is-rounded"
                                        src="{{ asset('src/images/bandera-' . $parse_name_city . '.jpg') }}">
                                </figure>
                                <p> {{ $row->city_name }}</p>

                                <a href="#"
                                    class="button is-primary is-outlined is-rounded">
                                    <span class="icon is-small">
                                        <i class="mdi mdi-check"></i>
                                    </span>
                                    <span>Administrar</span>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @else
                    {{-- si no tiene el rol administrador, mostramos la ciudad que le fue asignado --}}
                    <div class="box m-2" style="width:350px;height:200px">
                        <div class="is-flex is-justify-content-center is-align-items-center is-flex-direction-column">
                            <figure class="image is-96x96">
                                @php
                                    //convertir el nombre de la ciudad en minusculas
                                    // porque los nombres de las imagenes de las ciudades esta en minuscula
                                    $parse_name_city = strtolower($ciudad);
                                @endphp
                                <img class="is-rounded"
                                    src="{{ asset('src/images/bandera-' . $parse_name_city . '.jpg') }}">
                            </figure>
                            <p>{{ $ciudad }}</p>
                            <a href="#"
                                class="button is-primary is-outlined is-rounded">
                                <span class="icon is-small">
                                    <i class="mdi mdi-check"></i>
                                </span>
                                <span>Administrar</span>
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection
