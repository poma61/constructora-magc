 <div class="buttons">
     <a href="{{ route('r-tablero-cliente-grupo-view', [$city, $grupo_active]) }}"
         class="panel-block button is-success my-1 @if (request()->route()->getName() == 'r-tablero-cliente-grupo-view') is-outlined @endif">

         <span class="mdi mdi-table-of-contents is-size-4"></span>&nbsp;Tablero
     </a>

     <a href="{{ route('r-grafico-cliente-grupo-view', [$city, $grupo_active]) }}"
         class="panel-block button is-success my-1 @if (request()->route()->getName() == 'r-grafico-cliente-grupo-view') is-outlined @endif">
         <span class="mdi mdi-chart-bar is-size-4"></span>&nbsp;Grafico
     </a>

     <a href="{{ route('r-calendario-cliente-grupo-view', [$city, $grupo_active]) }}"
         class="panel-block button is-success my-1 @if (request()->route()->getName() == 'r-calendario-cliente-grupo-view') is-outlined @endif">
         <span class="mdi mdi-calendar-clock is-size-4"></span>&nbsp;Calendario
     </a>

     <a href="{{ route('r-gantt-cliente-grupo-view', [$city, $grupo_active]) }}"
         class="panel-block button is-success my-1 @if (request()->route()->getName() == 'r-gantt-cliente-grupo-view') is-outlined @endif">
         <span class="mdi mdi-chart-timeline is-size-4"></span>&nbsp;Gantt
     </a>
 </div>
