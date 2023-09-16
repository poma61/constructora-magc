@php
    $routes_cliente = ['r-cliente-index-view', 'r-tablero-cliente-grupo-view', 'r-grafico-cliente-grupo-view', 'r-calendario-cliente-grupo-view', 'r-gantt-cliente-grupo-view'];
    $routes_contrato = ['r-ciudad-contrato', 'r-tablero-contrato', 'r-calendario-contrato', 'r-gantt-contrato'];
    $routes_finanzas_de_construccion = ['r-ciudad-finanzas-de-construccion', 'r-tablero-finanzas-de-construccion', 'r-grafico-finanzas-de-construccion', 'r-calendario-finanzas-de-construccion', 'r-gantt-finanzas-de-construccion'];
    $routes_inventario = ['r-ciudad-inventario', 'r-tablero-inventario','r-grafico-inventario','r-calendario-inventario','r-gantt-inventario'];
    $routes_control_de_obra = ['r-ciudad-control-de-obra','r-tablero-control-de-obra','r-grafico-control-de-obra','r-calendario-control-de-obra','r-gantt-control-de-obra'];
    //obtenemos el name de la ruta actual que esta en la url
    $route_actual=Route::currentRouteName();
@endphp

<div class="left-side-bar">

    <div class="brand-logo">
        <a href="#">
            <img src="{{ asset('src/images/logo-empresa.jpeg') }}" alt="" width="50" height="50" />
            <span>MAGC</span>
        </a>
        <div class="close-sidebar" data-toggle="left-sidebar-close">
            <i class="ion-close-round"></i>
        </div>
    </div>


    <div class="menu-block">
        <div class="sidebar-menu">
            <div class="user-image-sidebar">
                @php
                    $user_all = Auth::user()
                        ->onPersonal()
                        ->first();
                @endphp
                <img class="user_img" src="{{ asset($user_all->foto) }}" alt="" height="100" width="100" />
                <span class="user_name">

                    {{ $user_all->nombres }} {{ $user_all->apellido_paterno }} {{ $user_all->apellido_materno }}
                </span>
            </div>

            <ul id="accordion-menu">

                <li>
                    <div class="unfold-divider"></div>
                </li>
                <li>
                    <div class="sidebar-small-cap">Principal</div>
                </li>

                <li>
                    <a href="{{ route('r-home') }}"
                        class="unfold-toggle no-arrow @if ( $route_actual == 'r-home') active @endif">
                        <i class="as-icon mdi mdi-home-circle-outline is-size-4"></i>
                        <span>Inicio</span>
                    </a>
                </li>

                <li>
                    <div class="unfold-divider"></div>
                </li>
                <li>
                    <div class="sidebar-small-cap">Clientes</div>
                </li>

                <li>
                    <a href="{{ route('r-cliente-index-view') }}"
                        class="unfold-toggle no-arrow @if (in_array( $route_actual, $routes_cliente)) active @endif">
                        <i class="as-icon mdi mdi-table-account is-size-4"></i>
                        <span>Clientes</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('r-ciudad-contrato') }}"
                        class="unfold-toggle no-arrow  @if (in_array( $route_actual, $routes_contrato)) active @endif">
                        <i class="as-icon mdi mdi-file-account-outline is-size-4"></i>
                        <span>Contratos</span>
                    </a>
                </li>

                <li>
                    <div class="unfold-divider"></div>
                </li>
                <li>
                    <div class="sidebar-small-cap">Construccion</div>
                </li>

                <li>
                    <a href="{{ route('r-ciudad-control-de-obra') }}"
                        class="unfold-toggle no-arrow @if (in_array( $route_actual, $routes_control_de_obra)) active @endif">
                        <i class="as-icon mdi mdi-file-tree is-size-4"></i>
                        <span>Control de obras</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('r-ciudad-finanzas-de-construccion') }}"
                        class="unfold-toggle no-arrow  @if (in_array( $route_actual, $routes_finanzas_de_construccion)) active @endif">
                        <i class="as-icon mdi mdi-counter is-size-4"></i>
                        <span>Finanzas de construccion</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('r-ciudad-inventario') }}"
                        class="unfold-toggle no-arrow  @if (in_array( $route_actual, $routes_inventario)) active @endif">
                        <i class="as-icon mdi mdi-file-table-box-outline is-size-4"></i>
                        <span>Inventario</span>
                    </a>
                </li>


                <li>
                    <div class="unfold-divider"></div>
                </li>
                <li>
                    <div class="sidebar-small-cap">Operaciones</div>
                </li>

                <li>
                    <a href="#" class="unfold-toggle no-arrow">
                        <i class="as-icon mdi mdi-file-table-box-outline is-size-4"></i>
                        <span>CCD Economicas</span>
                    </a>
                </li>

                <li>
                    <a href="#" class="unfold-toggle no-arrow">
                        <i class="as-icon mdi mdi-file-table-box-outline is-size-4"></i>
                        <span>CCD Estandar</span>
                    </a>
                </li>

                <li>
                    <a href="#" class="unfold-toggle no-arrow">
                        <i class="as-icon mdi mdi-file-table-box-outline is-size-4"></i>
                        <span>CCD Lujos</span>
                    </a>
                </li>
                <li>
                    <div class="unfold-divider"></div>
                </li>

                <li>
                    <div class="sidebar-small-cap">Otros</div>
                </li>

                <li>
                    <a href="{{ route('r-tablero-disenio') }}" class="unfold-toggle no-arrow">
                        <span class="as-icon mdi mdi-dishwasher is-size-4"></span>
                        <span>Diseño</span>
                    </a>
                </li>


                {{-- opciones del menu solo cuando es rol administrador --}}
                @if (Auth::user()->role == 'Administrador')

                    <li>
                        <div class="unfold-divider"></div>
                    </li>

                    <li>
                        <div class="sidebar-small-cap">Administracion</div>
                    </li>

                    <li>
                        <a href="{{ route('r-personal-index-view', 'Santa-Cruz') }}"
                            class="unfold-toggle no-arrow @if ( $route_actual == 'r-personal-index-view') active @endif">
                            <span class="as-icon  mdi mdi-badge-account-outline is-size-4"></span>
                            <span>Personal</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('r-user-view', 'Santa-Cruz') }}"
                            class="unfold-toggle no-arrow @if ( $route_actual == 'r-user-view') active @endif">
                            <span class="as-icon mdi mdi-home-account is-size-4"></span>
                            <span>Usuarios</span>
                        </a>
                    </li>
                @endif

            </ul>
        </div>
    </div>
</div>

<div class="mobile-menu-overlay"></div>
