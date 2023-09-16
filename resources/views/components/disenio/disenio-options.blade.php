 <div class="buttons">
     <a href="{{ route('r-tablero-disenio') }}"
         class="button is-primary is-rounded my-1 @if (Route::currentRouteName() == 'r-tablero-disenio') is-outlined @endif">
         <span class="mdi mdi-table-of-contents is-size-4"></span>&nbsp;Tablero
     </a>

     <a href="{{ route('r-grafico-disenio') }}"
         class="button is-primary is-rounded my-1 @if (Route::currentRouteName() == 'r-grafico-disenio') is-outlined @endif">
         <span class="mdi mdi-chart-bar is-size-4"></span>&nbsp;Grafico
     </a>


     <a href="{{ route('r-calendario-disenio') }}"
         class="button is-primary is-rounded my-1 @if (Route::currentRouteName() == 'r-calendario-disenio') is-outlined @endif">
         <span class="mdi mdi-calendar-clock is-size-4"></span>&nbsp;Calendario
     </a>

 </div>

{{-- request()->route()->getName()  => es lo mismo que Route::currentRouteName()--}}