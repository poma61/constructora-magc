@extends('layouts/app')
@section('title', 'MAGC | Usuarios')

@section('template_css')

@endsection

@section('template_content')

    <div class="list has-hoverable-list-items has-visible-pointer-controls">
        <div class="list-item">
            <div class="list-item-image">
                <figure class="image is-64x64">
                    <img class="is-rounded" src="https://via.placeholder.com/128x128.png?text=Image">
                </figure>
            </div>

            <div class="list-item-content">
                <div class="list-item-title">Grupo 01</div>
                <div class="list-item-description">
                    <div class="tag is-rounded">+64 22 049 5863</div>
                    <div class="tag is-rounded">+64 22 049 5863</div>
                </div>
            </div>

            <div class="list-item-controls">
                <div class="buttons is-right">
                    <button class="button">
                        <span class="icon is-small">
                            <i class="fas fa-edit"></i>
                        </span>
                        <span>Edit</span>
                    </button>

                    <button class="button">
                        <span class="icon is-small">
                            <i class="fas fa-ellipsis-h"></i>
                        </span>
                    </button>
                </div>
            </div>
        </div>

        <div class="list-item">
            <div class="list-item-image">
                <figure class="image is-64x64">
                    <img class="is-rounded" src="https://via.placeholder.com/128x128.png?text=Image">
                </figure>
            </div>

            <div class="list-item-content">
                <div class="list-item-title">List item</div>
                <div class="list-item-description">
                    <div class="tag is-rounded">+64 22 049 5863</div>
                    <div class="tag is-rounded">+64 22 049 5863</div>
                </div>
            </div>

            <div class="list-item-controls">
                <div class="buttons is-right">
                    <button class="button">
                        <span class="icon is-small">
                            <i class="fas fa-edit"></i>
                        </span>
                        <span>Edit</span>
                    </button>

                    <button class="button">
                        <span class="icon is-small">
                            <i class="fas fa-ellipsis-h"></i>
                        </span>
                    </button>
                </div>
            </div>
        </div>

        <div class="list-item">
            <div class="list-item-image">
                <figure class="image is-64x64">
                    <img class="is-rounded" src="https://via.placeholder.com/128x128.png?text=Image">
                </figure>
            </div>

            <div class="list-item-content">
                <div class="list-item-title">List item</div>
                <div class="list-item-description">
                    <div class="tag is-rounded">+64 22 049 5863</div>
                    <div class="tag is-rounded">+64 22 049 5863</div>
                </div>
            </div>

            <div class="list-item-controls">
                <div class="buttons is-right">
                    <button class="button">
                        <span class="icon is-small">
                            <i class="fas fa-edit"></i>
                        </span>
                        <span>Edit</span>
                    </button>

                    <button class="button">
                        <span class="icon is-small">
                            <i class="fas fa-ellipsis-h"></i>
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>


    <!-- dropdown-->
    <div class="dropdown" style="width:100px">
        <div class="dropdown-trigger">
            <button class="button is-warning is-rounded" aria-haspopup="true" aria-controls="dropdown-menu-grupos">
                <span class="icon">
                    <span class="mdi mdi-format-list-group"></span>
                </span>
                <span>Grupos</span>
            </button>
        </div>
        <div class="dropdown-menu animate__animated animate__bounceIn" id="dropdown-menu-grupos" role="menu">
            <div class="dropdown-content">

                <a href="#" class="dropdown-item">
                    <span class="icon has-text-info">
                        <span class="mdi mdi-numeric-1-box"></span>
                    </span>
                    Grupo 01
                </a>
                <a href="#" class="dropdown-item">
                    <span class="icon has-text-info">
                        <span class="mdi mdi-numeric-2-box"></span>
                    </span>
                    Grupo 02
                </a>
                <a href="#" class="dropdown-item">
                    <span class="icon has-text-info">
                        <span class="mdi mdi-numeric-3-box"></span>
                    </span>
                    Grupo 03
                </a>
                <a href="#" class="dropdown-item">
                    <span class="icon has-text-info">
                        <span class="mdi mdi-numeric-4-box"></span>
                    </span>
                    Grupo 04
                </a>
                <a href="#" class="dropdown-item has-background-warning">
                    <span class="icon has-text-info">
                        <span class="mdi mdi-numeric-5-box"></span>
                    </span>
                    Grupo 05
                </a>
                <a href="#" class="dropdown-item">
                    <span class="icon has-text-info">
                        <span class="mdi mdi-numeric-6-box"></span>
                    </span>
                    Grupo 06
                </a>
                <a href="#" class="dropdown-item">
                    <span class="icon has-text-info">
                        <span class="mdi mdi-numeric-7-box"></span>
                    </span>
                    Grupo 07
                </a>
                <a href="#" class="dropdown-item">
                    <span class="icon has-text-info">
                        <span class="mdi mdi-numeric-8-box"></span>
                    </span>
                    Grupo 08
                </a>
                <a href="#" class="dropdown-item">
                    <span class="icon has-text-info">
                        <span class="mdi mdi-numeric-9-box"></span>
                    </span>
                    Grupo 09
                </a>
                <a href="#" class="dropdown-item">
                    <span class="icon has-text-info">
                        <span class="mdi mdi-numeric-0-box"></span>
                    </span>
                    Grupo 10
                </a>

            </div>
        </div>
    </div>
    <!-- dropdown -->

    <!-- sidebar scrollable -->
    <li class="unfold">
        <a href="javascript:;" class="unfold-toggle">
            <i class="as-icon mdi mdi-form-select is-size-4"></i>
            <span>Forms</span>

        </a>
        <ul class="submenu">
            <li>
                <a href="#">
                    <i class="mdi mdi-form-select is-size-4"></i><span> Form Basic</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="mdi mdi-form-select is-size-4"></i><span> Form Basic</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="mdi mdi-form-select is-size-4"></i><span> Form Basic</span>
                </a>
            </li>

        </ul>
    </li>
    <!-- sidebar scrollable -->



{{-- tabs  vertical--}}
 <div class="tile is-ancestor">
                <div class="tile  is-parent is-horizontal">
                    <div class="tile is-child is-3 p-3">
                        <nav class="panel is-info">
                            <a class="panel-block  p-6 button is-success">  Santa Cruz</a>
                            <a class="panel-block  p-6 button is-success">Chuquisaca</a>
                            <a class="panel-block  p-6 button is-success">Cochabamba</a>
                            <a class="panel-block  p-6 button is-success">Potosi</a>
                            <a class="panel-block  p-6 button is-success">Beni</a>
                            <a class="panel-block  p-6 button is-success">La Paz</a>
                            <a class="panel-block  p-6 button is-success">Pando</a>
                            <a class="panel-block  p-6 button is-success">Tarija</a>
                            <a class="panel-block  p-6 button is-success">Oruro</a>
                            <a class="panel-block  p-6 button is-success">Otros</a>
                        </nav>
                    </div>
                    <div class="tile is-child is-9 p-3">

                        <div class="buttons">

                            <a class="button is-rounded is-info is-outlined">
                                <span>Grupo</span>
                                <span class="icon is-size-5">
                                    <span class="mdi mdi-numeric-2-circle-outline"></span>
                                </span>
                            </a>

                        </div>

                    </div>
                </div>
            </div>

{{-- tabs  vertical--}}
@endsection




@section('template_js')


@endsection
