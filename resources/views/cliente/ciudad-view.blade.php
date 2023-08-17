@extends('layouts/app')
@section('title', 'MAGC | Clientes')


@section('template_content')

    <div class="card mt-5">

        <div class="card-content">
            <h1 class="as-main-title is-size-5 has-text-white animate__animated animate__jello">
                Administracion de clientes por ciudades
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
                                <div class="list-item-description">

                                    @if ($grupo == 'todos')
                                        @for ($i = 0; $i < 10; $i++)
                                            <div class="tag is-rounded as-font-9 m-1 is-info">
                                                Grupo {{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}
                                            </div>
                                        @endfor
                                    @else
                                        <div class="tag is-rounded as-font-9 m-1 is-info">Grupo {{ $grupo }}</div>
                                    @endif


                                </div>
                            </div>

                            <div class="list-item-controls">
                                <div class="buttons is-right">
                                    @if ($grupo == 'todos')
                                        <a href="{{ route('r-tablero-cliente-grupo-view', [$row->city_name, '01']) }}"
                                            class="button is-success">
                                            <span class="icon is-small">
                                                <i class="mdi mdi-check"></i>
                                            </span>
                                            <span>Administrar</span>
                                        </a>
                                    @else
                                        <a href="{{ route('r-tablero-cliente-grupo-view', [$row->city_name, $grupo]) }}"
                                            class="button is-success">
                                            <span class="icon is-small">
                                                <i class="mdi mdi-check"></i>
                                            </span>
                                            <span>Administrar</span>
                                        </a>
                                    @endif
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
                                    $parse_name_city = strtolower($city);
                                @endphp
                                <img class="is-rounded"
                                    src="{{ asset('src/images/bandera-' . $parse_name_city . '.jpg') }}">
                            </figure>
                        </div>

                        <div class="list-item-content">
                            <div class="list-item-title">{{ $city }}</div>
                            <div class="list-item-description">

                                @if ($grupo == 'todos')
                                    @for ($i = 0; $i < 10; $i++)
                                        <div class="tag is-rounded as-font-9 m-1 is-info">
                                            Grupo {{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}
                                        </div>
                                    @endfor
                                @else
                                    <div class="tag is-rounded as-font-9 m-1 is-info">Grupo {{ $grupo }}</div>
                                @endif


                            </div>
                        </div>

                        <div class="list-item-controls">
                            <div class="buttons is-right">

                                @if ($grupo == 'todos')
                                    <a href="{{ route('r-tablero-cliente-grupo-view', [$city, '01']) }}" class="button is-success">
                                    @else
                                        <a href="{{ route('r-tablero-cliente-grupo-view', [$city, $grupo]) }}"
                                            class="button is-success">
                                @endif

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
