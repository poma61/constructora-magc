 <div class="buttons">
     <a href="{{ route('r-contrato-tablero', $ciudad) }}"
         class="panel-block button is-info my-1 @if (request()->route()->getName() == 'r-contrato-tablero') is-outlined @endif">
         <span class="mdi mdi-table-of-contents is-size-4"></span>&nbsp;Tablero
     </a>

     <a href="{{ route('r-contrato-grafico', [$ciudad,]) }}"
         class="panel-block button is-info my-1 @if (request()->route()->getName() == 'r-contrato-grafico') is-outlined @endif">
         <span class="mdi mdi-chart-bar is-size-4"></span>&nbsp;Grafico
     </a>

     <a href="{{ route('r-contrato-calendario', $ciudad) }}"
         class="panel-block button is-info my-1 @if (request()->route()->getName() == 'r-contrato-calendario') is-outlined @endif">
         <span class="mdi mdi-calendar-clock is-size-4"></span>&nbsp;Calendario
     </a>

     <a href="{{ route('r-contrato-gantt', $ciudad) }}"
         class="panel-block button is-info my-1 @if (request()->route()->getName() == 'r-contrato-contrato') is-outlined @endif">
         <span class="mdi mdi-chart-timeline is-size-4"></span>&nbsp;Gantt
     </a>
 </div>
