    @php
        use App\Services\AlertDataAllSystem;
        $cliente_fecha_reunion = AlertDataAllSystem::listFechaReunionCliente();
        $contrato_fecha_firma = AlertDataAllSystem::listFechaFirmaContrato();
        $obra_fecha_inicio = AlertDataAllSystem::listFechaInicioObra();
        $obra_fecha_finalizacion = AlertDataAllSystem::listFechaFinalizacionObra();
    @endphp


    <div class="header">
        <div class="header-left">
            <div class="menu-icon mdi mdi-menu"></div>
        </div>

        <div class="header-right">

            {{--  obras que inician  finalizan date('Y-m-d') segun contratos by clientes --}}
            <div class="dropdown">
                <div class="dropdown-trigger">
                    <button class="button is-transparent is-medium has-text-white" aria-haspopup="true"
                        aria-controls="dropdown-menu-1">
                        <span class="icon">
                            <div class="icon-badge-container">
                                <span class="mdi mdi-file-tree is-size-5 is-size-5"></span>
                                <div class="icon-badge has-background-success">{{ $obra_fecha_finalizacion->count() }}
                                </div>
                            </div>
                        </span>
                    </button>
                </div>
                <div class="dropdown-menu animate__animated animate__bounceIn" id="dropdown-menu-1" role="menu">
                    <div class="dropdown-content">
                        <div class="dropdown-item">
                            Obras que finalizan hoy <span class="tag is-success">{{ date('d/m/Y') }}.</span>
                        </div>
                        <hr class="dropdown-divider">
                        @if ($obra_fecha_finalizacion->count() > 0)
                            @foreach ($obra_fecha_finalizacion as $is_row)
                                <div class="dropdown-item">
                                    <span class="icon has-text-success">
                                        <span class="mdi mdi-check-all"></span>
                                    </span>
                                    {{ $is_row->nombres }}
                                    {{ $is_row->apellido_paterno }}
                                    {{ $is_row->apellido_materno }},
                                    N° <span class="tag is-success"> {{ $is_row->n_contrato }}</span>
                                </div>
                            @endforeach
                        @else
                            <div class="dropdown-item">
                                <span class="icon has-text-success">
                                    <span class="mdi mdi-check-all"></span>
                                </span>
                                No hay obras que finalizan hoy {{ date('d/m/Y') }}.
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{--  obras que inician  hoy date('Y-m-d') segun contratos by clientes --}}
            <div class="dropdown is-right">
                <div class="dropdown-trigger">
                    <button class="button is-transparent is-medium has-text-white" aria-haspopup="true"
                        aria-controls="dropdown-menu-2">
                        <span class="icon">
                            <div class="icon-badge-container">
                                <span class="mdi mdi-file-tree is-size-5 is-size-5"></span>
                                <div class="icon-badge has-background-link">{{ $obra_fecha_inicio->count() }}
                                </div>
                            </div>
                        </span>
                    </button>
                </div>
                <div class="dropdown-menu animate__animated animate__bounceIn" id="dropdown-menu-2" role="menu">
                    <div class="dropdown-content">
                        <div class="dropdown-item">
                            Obras que incian hoy <span class="tag is-link">{{ date('d/m/Y') }}.</span>
                        </div>
                        <hr class="dropdown-divider">
                        @if ($obra_fecha_inicio->count() > 0)
                            @foreach ($obra_fecha_inicio as $is_row)
                                <div class="dropdown-item">
                                    <span class="icon has-text-link">
                                        <span class="mdi mdi-check-all"></span>
                                    </span>
                                    {{ $is_row->nombres }}
                                    {{ $is_row->apellido_paterno }}
                                    {{ $is_row->apellido_materno }},
                                    N° <span class="tag is-link"> {{ $is_row->n_contrato }}</span>
                                </div>
                            @endforeach
                        @else
                            <div class="dropdown-item">
                                <span class="icon has-text-link">
                                    <span class="mdi mdi-check-all"></span>
                                </span>
                                No hay obras que inician hoy {{ date('d/m/Y') }}.
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- alertas para firmar contratos  --}}
            <div class="dropdown is-right">
                <div class="dropdown-trigger">
                    <button class="button is-transparent is-medium has-text-white" aria-haspopup="true"
                        aria-controls="dropdown-menu-3">
                        <span class="icon">
                            <div class="icon-badge-container">
                                <span class="mdi mdi-file-account-outline is-size-5"></span>
                                <div class="icon-badge has-background-info">{{ $contrato_fecha_firma->count() }}
                                </div>
                            </div>
                        </span>
                    </button>
                </div>
                <div class="dropdown-menu animate__animated animate__bounceIn" id="dropdown-menu-3" role="menu">
                    <div class="dropdown-content">
                        <div class="dropdown-item">
                            Contratos programados para firmar hoy <span class="tag is-info">{{ date('d/m/Y') }}.</span>
                        </div>
                        <hr class="dropdown-divider">
                        @if ($contrato_fecha_firma->count() > 0)
                            @foreach ($contrato_fecha_firma as $is_row)
                                <div class="dropdown-item">
                                    <span class="icon has-text-info">
                                        <span class="mdi mdi-check-all"></span>
                                    </span>
                                    {{ $is_row->nombres }}
                                    {{ $is_row->apellido_paterno }}
                                    {{ $is_row->apellido_materno }},
                                    N° <span class="tag is-info"> {{ $is_row->n_contrato }}</span>
                                </div>
                            @endforeach
                        @else
                            <div class="dropdown-item">
                                <span class="icon has-text-info">
                                    <span class="mdi mdi-check-all"></span>
                                </span>
                                No hay contratos para firmar hoy {{ date('d/m/Y') }}.
                            </div>
                        @endif


                    </div>
                </div>
            </div>

            {{-- alertas para reuniones con clientes --}}
            <div class="dropdown is-right">
                <div class="dropdown-trigger">

                    <button class="button is-transparent is-medium has-text-white" aria-haspopup="true"
                        aria-controls="dropdown-menu-4">
                        <span class="icon">
                            <div class="icon-badge-container">
                                <span class="mdi mdi-table-account"></span>
                                <div class="icon-badge has-background-danger">{{ $cliente_fecha_reunion->count() }}
                                </div>
                            </div>
                        </span>
                    </button>

                </div>
                <div class="dropdown-menu animate__animated animate__bounceIn" id="dropdown-menu-4" role="menu">
                    <div class="dropdown-content">
                        <div class="dropdown-item">
                            Reuniones programadas para hoy <span class="tag is-danger">{{ date('d/m/Y') }}.</span>
                        </div>
                        <hr class="dropdown-divider">
                        @if ($cliente_fecha_reunion->count() > 0)
                            @foreach ($cliente_fecha_reunion as $is_row)
                                <div class="dropdown-item">
                                    <span class="icon has-text-danger">
                                        <span class="mdi mdi-check-all"></span>
                                    </span>
                                    {{ $is_row->nombres }}
                                    {{ $is_row->apellido_paterno }}
                                    {{ $is_row->apellido_materno }}
                                    Hrs: <span class="tag is-danger">
                                        {{ substr($is_row->hora_reunion, 0, 5) }}</span>
                                </div>
                            @endforeach
                        @else
                            <div class="dropdown-item">
                                <span class="icon has-text-danger">
                                    <span class="mdi mdi-check-all"></span>
                                </span>
                                No hay reuniones con clientes para hoy {{ date('d/m/Y') }}.
                            </div>
                        @endif


                    </div>
                </div>
            </div>

            {{-- opciones del sistema --}}
            <div class="dropdown is-right">
                <div class="dropdown-trigger">
                    <button class="button is-transparent is-medium has-text-white" aria-haspopup="true"
                        aria-controls="dropdown-menu-5">

                        <span class="icon">
                            <span class="mdi mdi-cog"></span>
                        </span>
                    </button>
                </div>
                <div class="dropdown-menu animate__animated animate__bounceIn" id="dropdown-menu-5" role="menu">
                    <div class="dropdown-content">
                        <a href="{{ route('r-me') }}" class="dropdown-item">
                            <span class="icon has-text-weight-bold  has-text-success">
                                <span class="mdi mdi-account-box"></span>
                            </span>
                            Perfil
                        </a>
                        <a class="dropdown-item" id="salir">
                            <span class="icon has-text-info">
                                <span class="mdi mdi-lock"></span>
                            </span>
                            Salir
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
