<template>
    <nav class="breadcrumb" aria-label="breadcrumbs">
        <ul>
            <li>
                <div class="has-text-info">
                    <span class="icon is-small">
                        <span class="mdi mdi-calendar-clock"></span>
                    </span>
                    <span>Fechas de inicio</span>
                </div>
            </li>
        </ul>
    </nav>

    <div class="buttons">
        <div class="control has-icons-left">
            <div class="select is-info">
                <select v-model="year" @click="refreshDataGantt()">
                    <option value="2015">2015</option>
                    <option value="2016">2016</option>
                    <option value="2017">2017</option>
                    <option value="2018">2018</option>
                    <option value="2019">2019</option>
                    <option value="2020">2020</option>
                    <option value="2021">2021</option>
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                    <option value="2024">2024</option>
                    <option value="2025">2025</option>
                    <option value="2026">2026</option>
                    <option value="2027">2027</option>
                    <option value="2028">2028</option>
                    <option value="2029">2029</option>
                    <option value="2030">2030</option>
                    <option value="2031">2031</option>
                    <option value="2032">2032</option>
                    <option value="2033">2033</option>
                </select>
            </div>
            <div class="icon is-small is-left">
                <span class="mdi mdi-calendar-cursor has-text-info is-size-4"></span>
            </div>
        </div>
    </div>

    <div class="buttons">
        <button @click="selectMont('todos')" :class="['button is-info', { 'is-light': month === 'todos' }]">
            <span class="mdi mdi-calendar-check-outline is-size-4"></span>&nbsp;Todos
        </button>

        <button @click="selectMont('enero')" :class="['button is-info', { 'is-light': month === 'enero' }]">
            <span class="mdi mdi-calendar-check-outline is-size-4"></span>&nbsp;Enero
        </button>

        <button @click="selectMont('febrero')" :class="['button is-info', { 'is-light': month === 'febrero' }]">
            <span class="mdi mdi-calendar-check-outline is-size-4"></span>&nbsp;Febrero
        </button>

        <button @click="selectMont('marzo')" :class="['button is-info', { 'is-light': month === 'marzo' }]">
            <span class="mdi mdi-calendar-check-outline is-size-4"></span>&nbsp;Marzo
        </button>

        <button @click="selectMont('abril')" :class="['button is-info', { 'is-light': month === 'abril' }]">
            <span class="mdi mdi-calendar-check-outline is-size-4"></span>&nbsp;Abril
        </button>

        <button @click="selectMont('mayo')" :class="['button is-info', { 'is-light': month === 'mayo' }]">
            <span class="mdi mdi-calendar-check-outline is-size-4"></span>&nbsp;Mayo
        </button>

        <button @click="selectMont('junio')" :class="['button is-info', { 'is-light': month === 'junio' }]">
            <span class="mdi mdi-calendar-check-outline is-size-4"></span>&nbsp;Junio
        </button>

        <button @click="selectMont('julio')" :class="['button is-info', { 'is-light': month === 'julio' }]">
            <span class="mdi mdi-calendar-check-outline is-size-4"></span>&nbsp;Julio
        </button>


        <button @click="selectMont('agosto')" :class="['button is-info', { 'is-light': month === 'agosto' }]">
            <span class="mdi mdi-calendar-check-outline is-size-4"></span>&nbsp;Agosto
        </button>


        <button @click="selectMont('septiembre')" :class="['button is-info', { 'is-light': month === 'septiembre' }]">
            <span class="mdi mdi-calendar-check-outline is-size-4"></span>&nbsp;Septiembre
        </button>


        <button @click="selectMont('octubre')" :class="['button is-info', { 'is-light': month === 'octubre' }]">
            <span class="mdi mdi-calendar-check-outline is-size-4"></span>&nbsp;Octubre
        </button>


        <button @click="selectMont('noviembre')" :class="['button is-info', { 'is-light': month === 'noviembre' }]">
            <span class="mdi mdi-calendar-check-outline is-size-4"></span>&nbsp;Noviembre
        </button>


        <button @click="selectMont('diciembre')" :class="['button is-info', { 'is-light': month === 'diciembre' }]">
            <span class="mdi mdi-calendar-check-outline is-size-4"></span>&nbsp;Diciembre
        </button>

    </div>

    <div class="box p-0">
        <x-gantt :data="data_list" style="height: 600px;" locale="es">
            <x-gantt-column label="Detalles" :width="160">
                <template v-slot="{ row }">

                    <div class="is-flex is-justify-content-space-between">
                        <div style="min-width: 150px" class="mr-2">{{ row.name }}</div>
                        <div style="min-width: 150px" class="mr-2">Fecha inicio: {{ date_format.formatDate(row.startDate) }}
                        </div>
                    </div>
                </template>

            </x-gantt-column>

            <XGanttSlider prop="startDate">
                <template v-slot:content="{ row, $index }">
                    <div class="gantt-task" :style="{ 'background-color': colores[$index % colores.length] }">
                        {{ row.name }}
                    </div>
                </template>
            </XGanttSlider>
        </x-gantt>
    </div>

    <div class="box p-0">
        <div ref="chartContainer"></div>
    </div>
</template>

<script setup>
import ApexCharts from "apexcharts";
import esLocale from 'apexcharts/dist/locales/es.json'; // Importa el módulo de idioma "es" aquí
import toastr from "toastr";
import Contratista from '@/services/Contratista';
import { onMounted, ref } from "vue";
import DateFormat from '@/util/DateFormat';

//datas
toastr.options = {
    closeButton: true,
    progressBar: true,
    positionClass: 'toast-bottom-right',
    timeOut: 3000,
    hideDuration: 100,
};
const date_format = ref(new DateFormat());
const year = ref(new Date().getFullYear());
const month = ref("todos");
const colores = ref(['#F14668', '#485FC7', '#4994D2', '#D99F00', '#85D7B2', '#7A7A7A']);
const city = ref("");
const chart = ref(null);
const indice_aleatorio = ref(-1);
const series = ref([
    {
        data: []
    }
]);
const data_list = ref([]);
const chartContainer = ref(null);
const chart_options = {
    chart: {
        height: 600,
        type: 'rangeBar',
        defaultLocale: 'es',
        locales: [esLocale],
    },
    fill: {
        type: 'solid',
        opacity: 1
    },
    plotOptions: {
        bar: {
            horizontal: true,
            barHeight: '50%',
            distributed: true,
            dataLabels: {
                hideOverflowingLabels: true
            }
        }
    },
    dataLabels: {
        enabled: true,
        formatter: function (val, opts) {
            var label = opts.w.globals.labels[opts.dataPointIndex]
            return label;
        },
        style: {
            colors: ['#f3f4f5', '#fff']
        }
    },
    xaxis: {
        type: 'datetime'
    },
    yaxis: {
        show: true
    },
    grid: {
        row: {
            colors: ['#f3f4f5', '#fff'],
            opacity: 1
        }
    }
};

const urlParams = () => {
    const parse_url = new URL(window.location.href);
    city.value = parse_url.pathname.split('/').pop();
}
const addDate = (fecha_actual) => {
    const nueva_fecha = new Date(fecha_actual);
    // sumamos un dia a la nueva fecha quese creo a partir de la fecha actual
    //esto nos ayuda a mostrar la vista el el diagrama de gantt
    nueva_fecha.setDate(nueva_fecha.getDate() + 6);
    return nueva_fecha.toISOString().split('T')[0];
}

const selectMont = (mes) => {
    month.value = mes;
    refreshDataGantt();
}


const refreshDataGantt = () => {
    //borramos todos los datos de series y volvemos cargar
    series.value[0].data = [];
    data_list.value=[];
    initDataGantt();
};

const initDataGantt = async () => {
    let id=0;
    const contratista = new Contratista(city.value);
    const response = await contratista.ganttFechaInicio(year.value, month.value);
    if (response.status) {
        response.records.forEach(item => {
            indice_aleatorio.value = Math.floor(Math.random() * colores.value.length);
            id++;
            data_list.value.push({
                index: id,
                name: `${item.nombres} ${item.apellido_paterno} ${item.apellido_materno} - Contrato ${item.n_contrato}`,
                startDate: new Date(`${item.fecha_inicio}T00:00:00`),
                endDate: new Date(addDate(item.fecha_inicio) + 'T00:00:00'),
            });


            series.value[0].data.push({
                x: `${id}-${item.nombres} ${item.apellido_paterno} ${item.apellido_materno} - Contrato ${item.n_contrato}`,
                y: [
                    new Date(item.fecha_inicio).getTime(),
                    new Date(addDate(item.fecha_inicio)).getTime()//aumentamos 1 dia para mostrar en la vista gantt
                ],
                fillColor: colores.value[indice_aleatorio.value]
            });

        });

        viewToast('success', response.message);
    } else {
        viewToast('error', response.message);
    }

    chart.value.updateSeries(series.value);
}

const initGantt = () => {
    chart.value = new ApexCharts(chartContainer.value, {
        ...chart_options,
        series: series.value
    });
    chart.value.render();
}

const viewToast = (type, message) => {
    if (type == 'success') {
        toastr.success(message);
    } else {
        toastr.error(message, 'Error');
    }
}

onMounted(() => {
    urlParams();
    initGantt();
    initDataGantt();
});

</script>

<style >
.gantt-task {
  display: flex;
  justify-content: center;
  height: 15px;
  border-radius: 3px;
  color: #fff;
}


.xg-gantt-header-cell,
.xg-table-header-cell {
  background-color: #00BCC9 !important;
  text-align: center !important;
  color: #fff !important;
}
</style>
