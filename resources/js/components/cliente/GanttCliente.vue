<template>
    <div ref="chartContainer"></div>
</template>

<script setup>
import ApexCharts from "apexcharts";
import esLocale from 'apexcharts/dist/locales/es.json'; // Importa el módulo de idioma "es" aquí
import moment from 'moment';
import toastr from "toastr";
import Cliente from '@/services/Cliente';
import { onMounted, ref } from "vue";

//datas
toastr.options = {
    closeButton: true,
    progressBar: true,
    positionClass: 'toast-top-right',
    timeOut: 3000,
    hideDuration: 100,
};
const colores = ref(['#F14668', '#485FC7', '#4994D2', '#FFE08A', '#85D7B2', '#00D1B2']);
const city = ref("");
const group = ref("");
const indice_aleatorio = ref(-1);
const series = ref([{ data: [] }]);
const chartContainer = ref(null);
const chart_options = {
    chart: {
        height: 500,
        type: 'rangeBar',
        defaultLocale: 'es',
        locales: [esLocale],
    },
    plotOptions: {
        bar: {
            horizontal: true,
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
            var a = moment(val[0])
            var b = moment(val[1])
            var diff = b.diff(a, 'days')
            return label + ': ' + diff + (diff > 1 ? ' days' : ' day')
        },
        style: {
            colors: ['#f3f4f5', '#fff']
        }
    },
    xaxis: {
        type: 'datetime'
    },
    yaxis: {
        show: false
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
    city.value = parse_url.pathname.split('/')[3];
    group.value = parse_url.pathname.split('/')[4];
}
const addDate = (fecha_actual) => {
    const nueva_fecha = new Date(fecha_actual);
    // sumamos un dia a la nueva fecha quese creo a partir de la fecha actual
    nueva_fecha.setDate(nueva_fecha.getDate() + 1);
    return nueva_fecha.toISOString().split('T')[0];
}

const initDataGantt = async () => {
    const cliente = new Cliente(city.value, group.value);
    const response = await cliente.ganttMeeting();
    if (response.status) {

        response.records.forEach(item => {
            indice_aleatorio.value = Math.floor(Math.random() * colores.value.length);
            series.value[0].data.push({
                x: `${item.nombres} ${item.apellido_paterno} ${item.apellido_materno}`,
                y: [
                    new Date(item.fecha_reunion).getTime(),
                    new Date(addDate(item.fecha_reunion)).getTime()
                ],
                fillColor: colores.value[indice_aleatorio.value]
            }
            );

        });

        viewToast('success', response.message);
    } else {
        viewToast('error', response.message);
    }


    const chart = new ApexCharts(chartContainer.value, {
        ...chart_options,
        series: series.value
    });
    chart.render();

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
    initDataGantt();
});

</script>
