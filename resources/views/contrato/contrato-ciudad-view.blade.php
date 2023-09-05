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

                @if (Auth::user()->role == 'Administrador')
                    @foreach ($list_ciudades as $row)
                        <div class="list-item">
                            <div class="list-item-image">
                                <figure class="image is-64x64">
                                    @php
                                        //convertir el nombre de la ciudad en minusculas
                                        // porque los nombres de las imagenes de las ciudades esta en minuscula
                                        $parse_name_city = strtolower($row->city_name);
                                    @endphp
                                    <img class="is-rounded"
                                        src="{{ asset('src/images/bandera-' . $parse_name_city . '.jpg') }}">
                                </figure>
                            </div>

                            <div class="list-item-content">
                                <div class="list-item-title">{{ $row->city_name }}</div>

                            </div>

                            <div class="list-item-controls">
                                <div class="buttons is-right">

                                    <a href="{{ route('r-contrato-tablero', $row->city_name) }}"
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
                @else
                    {{-- si no tiene el rol administrador, mostramos la ciudad que le fue asignado --}}
                    <div class="list-item">
                        <div class="list-item-image">
                            <figure class="image is-64x64">
                                @php
                                    //convertir el nombre de la ciudad en minusculas
                                    // porque los nombres de las imagenes de las ciudades esta en minuscula
                                    $parse_name_city = strtolower($ciudad);
                                @endphp
                                <img class="is-rounded"
                                    src="{{ asset('src/images/bandera-' . $parse_name_city . '.jpg') }}">
                            </figure>
                        </div>

                        <div class="list-item-content">
                            <div class="list-item-title">{{ $ciudad }}</div>

                        </div>

                        <div class="list-item-controls">
                            <div class="buttons is-right">
                                <a href="{{ route('r-contrato-tablero', $ciudad) }}" class="button is-info is-outlined">
                                    <span class="icon is-small">
                                        <i class="mdi mdi-check"></i>
                                    </span>
                                    <span>Administrar</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endif

            </div>

            {{-- ciudades --}}
        </div>
    </div>

@endsection
