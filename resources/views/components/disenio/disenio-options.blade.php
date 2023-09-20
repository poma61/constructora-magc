<div class="tabs is-boxed">
    <ul>
        <li class="@if (Route::currentRouteName() == 'r-tablero-disenio') is-active @endif">
            <a href="{{ route('r-tablero-disenio') }}">
                <span class="icon">
                    <i class="mdi mdi-table-of-contents is-size-4" aria-hidden="true"></i>
                </span>
                <span>Tablero</span>
            </a>
        </li>

        <li class="@if (Route::currentRouteName() == 'r-grafico-disenio') is-active @endif">
            <a href="{{ route('r-grafico-disenio') }}">
                <span class="icon">
                    <i class="mdi mdi-chart-bar is-size-4" aria-hidden="true"></i>
                </span>
                <span>Grafico</span>

            </a>
        </li class="@if (Route::currentRouteName() == 'r-calendario-disenio')
is-active
@endif">

        <li class="@if (Route::currentRouteName() == 'r-calendario-disenio') is-active @endif">
            <a href="{{ route('r-calendario-disenio') }}">
                <span class="icon">
                    <i class="mdi mdi-calendar-clock is-size-4" aria-hidden="true"></i>
                </span>
                <span>Calendario</span>

            </a>
        </li>


    </ul>
</div>

{{-- request()->route()->getName()  => es lo mismo que Route::currentRouteName() --}}
