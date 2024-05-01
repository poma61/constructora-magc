@extends('layouts/app')
@section('title', 'Clientes | Constructora MAGC')

@section('template_content')
    <div class="card mt-5">
        <div class="card-content">
            <h1
                class="as-main-title as-background-orange is-size-5 has-text-centered has-text-white">
                Administracion de clientes
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
                                <img class="is-rounded" src="{{ asset('src/images/bandera-' . $parse_name_city . '.jpg') }}">
                            </figure>
                        </div>

                        <div class="list-item-content">
                            <div class="list-item-title">{{ $city }}</div>
                            <div class="list-item-description">
                                @php

                                    $city_ordered_groups = [];
                                    foreach ($city_groups as $row) {
                                        //extraemos todos los grupos que pertenecen a la determinada ciudad
                                        if ($row['ciudad'] == $city) {
                                            $city_ordered_groups[] = $row['grupo'];
                                        }
                                    }
                                    // Ordenamos los grupos de forma ascendente
                                    // porque hay la probabilidad de que esten desordenados 01, 10, 05
                                    sort($city_ordered_groups);
                                @endphp

                                @foreach ($city_ordered_groups as $group)
                                    <div class="tag is-rounded as-font-9 m-1 is-info">
                                        Grupo {{ $group }}
                                    </div>
                                @endforeach

                            </div>
                        </div>

                        <div class="list-item-controls">
                            <div class="buttons is-right">

                                @php
                                    //obtenemos el primer grupo del array de grupos ordenados
                                    //de una determinada ciudad
                                    $primer_grupo = null;
                                    foreach ($city_ordered_groups as $group) {
                                        $primer_grupo = $group;
                                        break;
                                    }
                                @endphp

                                @if ($primer_grupo != null)
                                    <a href="{{ route('r-tablero-cliente-grupo-view', [$city, $primer_grupo]) }}"
                                        class="button is-success">
                                        <span class="icon is-small">
                                            <i class="mdi mdi-check"></i>
                                        </span>
                                        <span>Administrar clientes</span>
                                    </a>
                                @endif
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
            {{-- ciudades --}}
        </div>
    </div>
@endsection
