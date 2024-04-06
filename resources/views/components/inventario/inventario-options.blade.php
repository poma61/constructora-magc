<div class="tabs is-toggle is-toggle-rounded">
    <ul>
        <li class="@if (Route::currentRouteName() == 'r-tablero-inventario') is-active @endif">
            <a href="{{ route('r-tablero-inventario', $ciudad) }}">
                <span class="icon">
                    <i class="mdi mdi-table-of-contents is-size-4" aria-hidden="true"></i>
                </span>
                <span>Tablero</span>
            </a>
        </li>

        <li class="@if (Route::currentRouteName() == 'r-grafico-inventario') is-active @endif">
            <a href="{{ route('r-grafico-inventario', $ciudad) }}">
                <span class="icon">
                    <i class="mdi mdi-chart-bar is-size-4" aria-hidden="true"></i>
                </span>
                <span>Grafico</span>

            </a>
        </li class="@if (Route::currentRouteName() == 'r-calendario-inventario')
is-active
@endif">

        <li class="@if (Route::currentRouteName() == 'r-calendario-inventario') is-active @endif">
            <a href="{{ route('r-calendario-inventario', $ciudad) }}">
                <span class="icon">
                    <i class="mdi mdi-calendar-clock is-size-4" aria-hidden="true"></i>
                </span>
                <span>Calendario</span>

            </a>
        </li>

        <li class="@if (Route::currentRouteName() == 'r-gantt-inventario') is-active @endif">
            <a href="{{ route('r-gantt-inventario', $ciudad) }}">
                <span class="icon">
                    <i class="mdi mdi-chart-timeline is-size-4" aria-hidden="true"></i>
                </span>
                <span>Gantt</span>
            </a>
        </li>

    </ul>
</div>


{{-- request()->route()->getName()  => es lo mismo que Route::currentRouteName() --}}
