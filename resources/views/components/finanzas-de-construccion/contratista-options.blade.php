 <div class="buttons">
     <a href="{{ route('r-finanzas-de-construccion-tablero', $ciudad) }}"
         class="button is-primary is-rounded my-1 @if (request()->route()->getName() == 'r-finanzas-de-construccion-tablero') is-outlined @endif">
         <span class="mdi mdi-table-of-contents is-size-4"></span>&nbsp;Tablero
     </a>

     <a href="{{ route('r-finanzas-de-construccion-grafico', $ciudad) }}"
         class="button is-primary is-rounded my-1 @if (request()->route()->getName() == 'r-finanzas-de-construccion-grafico') is-outlined @endif">
         <span class="mdi mdi-chart-bar is-size-4"></span>&nbsp;Grafico
     </a>


     <a href="{{ route('r-finanzas-de-construccion-calendario', $ciudad) }}"
         class="button is-primary is-rounded my-1 @if (request()->route()->getName() == 'r-finanzas-de-construccion-calendario') is-outlined @endif">
         <span class="mdi mdi-calendar-clock is-size-4"></span>&nbsp;Calendario
     </a>

     <a href="{{ route('r-finanzas-de-construccion-gantt', $ciudad) }}"
         class="button is-primary is-rounded my-1 @if (request()->route()->getName() == 'r-finanzas-de-construccion-gantt') is-outlined @endif">
         <span class="mdi mdi-chart-timeline is-size-4"></span>&nbsp;Gantt
     </a>
 </div>
