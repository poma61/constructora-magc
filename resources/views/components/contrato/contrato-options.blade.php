 <div class="buttons">
     <a href="{{ route('r-tablero-contrato', $ciudad) }}"
         class="button is-info my-1 @if (Route::currentRouteName() == 'r-tablero-contrato') is-outlined @endif">
         <span class="mdi mdi-table-of-contents is-size-4"></span>&nbsp;Tablero
     </a>

     <a href="{{ route('r-calendario-contrato', $ciudad) }}"
         class="button is-info my-1 @if (Route::currentRouteName() == 'r-calendario-contrato') is-outlined @endif">
         <span class="mdi mdi-calendar-clock is-size-4"></span>&nbsp;Calendario
     </a>

     <a href="{{ route('r-gantt-contrato', $ciudad) }}"
         class="button is-info my-1 @if (Route::currentRouteName() == 'r-gantt-contrato') is-outlined @endif">
         <span class="mdi mdi-chart-timeline is-size-4"></span>&nbsp;Gantt
     </a>
 </div>


{{-- request()->route()->getName()  => es lo mismo que Route::currentRouteName()--}}