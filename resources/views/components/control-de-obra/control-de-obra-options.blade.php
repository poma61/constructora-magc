<div class="tabs is-boxed">
    <ul>
        <li class="@if (Route::currentRouteName() == 'r-tablero-control-de-obra') is-active @endif">
            <a href="{{ route('r-tablero-control-de-obra', $ciudad) }}">
                <span class="icon">
                    <i class="mdi mdi-table-of-contents is-size-4" aria-hidden="true"></i>
                </span>
                <span>Tablero</span>
            </a>
        </li>

        <li class="@if (Route::currentRouteName() == 'r-grafico-control-de-obra') is-active @endif">
            <a href="{{ route('r-grafico-control-de-obra', $ciudad) }}">
                <span class="icon">
                    <i class="mdi mdi-chart-bar is-size-4" aria-hidden="true"></i>
                </span>
                <span>Grafico</span>

            </a>
        </li class="@if (Route::currentRouteName() == 'r-calendario-control-de-obra')
is-active
@endif">

        <li class="@if (Route::currentRouteName() == 'r-calendario-control-de-obra') is-active @endif">
            <a href="{{ route('r-calendario-control-de-obra', $ciudad) }}">
                <span class="icon">
                    <i class="mdi mdi-calendar-clock is-size-4" aria-hidden="true"></i>
                </span>
                <span>Calendario</span>

            </a>
        </li>

        <li class="@if (Route::currentRouteName() == 'r-gantt-control-de-obra') is-active @endif">
            <a href="{{ route('r-gantt-control-de-obra', $ciudad) }}">
                <span class="icon">
                    <i class="mdi mdi-chart-timeline is-size-4" aria-hidden="true"></i>
                </span>
                <span>Gantt</span>
            </a>
        </li>

    </ul>
</div>


{{-- request()->route()->getName()  => es lo mismo que Route::currentRouteName() --}}
