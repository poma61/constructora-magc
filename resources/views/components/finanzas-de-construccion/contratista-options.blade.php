 <div class="buttons">
     <a href="{{ route('r-tablero-finanzas-de-construccion', $ciudad) }}"
         class="button is-primary is-rounded my-1 @if (Route::currentRouteName() == 'r-tablero-finanzas-de-construccion') is-outlined @endif">
         <span class="mdi mdi-table-of-contents is-size-4"></span>&nbsp;Tablero
     </a>

     <a href="{{ route('r-grafico-finanzas-de-construccion', $ciudad) }}"
         class="button is-primary is-rounded my-1 @if (Route::currentRouteName() == 'r-grafico-finanzas-de-construccion') is-outlined @endif">
         <span class="mdi mdi-chart-bar is-size-4"></span>&nbsp;Grafico
     </a>


     <a href="{{ route('r-calendario-finanzas-de-construccion', $ciudad) }}"
         class="button is-primary is-rounded my-1 @if (Route::currentRouteName() == 'r-calendario-finanzas-de-construccion') is-outlined @endif">
         <span class="mdi mdi-calendar-clock is-size-4"></span>&nbsp;Calendario
     </a>

     <a href="{{ route('r-gantt-finanzas-de-construccion', $ciudad) }}"
         class="button is-primary is-rounded my-1 @if (Route::currentRouteName() == 'r-gantt-finanzas-de-construccion') is-outlined @endif">
         <span class="mdi mdi-chart-timeline is-size-4"></span>&nbsp;Gantt
     </a>
 </div>

{{-- request()->route()->getName()  => es lo mismo que Route::currentRouteName()--}}