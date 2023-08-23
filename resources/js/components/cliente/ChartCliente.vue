<template>
    <apexchart type="bar" :height="500" :options="chartOptions" :series="series"></apexchart>
</template>

<script>
import { defineComponent } from 'vue';
import VueApexCharts from "vue3-apexcharts";
import esLocale from 'apexcharts/dist/locales/es.json'; // Importa el módulo de idioma "es" aquí
import Cliente from '@/services/Cliente';
import toastr from 'toastr';

export default defineComponent({
    components: {
        apexchart: VueApexCharts,
    },
    data() {
        // Configurar opciones globales para Toastr (opcional)
        toastr.options = {
            closeButton: true,
            progressBar: true,
            positionClass: 'toast-top-right',
            timeOut: 3000,
            hideDuration: 100,
        };
        const colores = ['#F14668', '#485FC7', '#4994D2', '#FFE08A', '#85D7B2', '#00D1B2'];
        const estados = [
            'Cancelada',//0
            'Programada',//1
            'Por reprogramar',//2
            'Se llevo a cabo',//3
            'Firma de contrato',//4
            'Otro'//5
        ];
        const chartOptions = {
            chart: {
                type: 'bar',
                events: {
                    click: function (chart, w, e) {
                        console.log(chart, w, e)
                    }
                },
                defaultLocale: 'es',
                locales: [esLocale],
            },
            colors: colores,
            plotOptions: {
                bar: {
                    columnWidth: '45%',
                    distributed: true,
                }
            },
            dataLabels: {
                enabled: true
            },
            legend: {
                show: true
            },
            xaxis: {
                categories: [
                    [estados[0]],
                    [estados[1]],
                    [estados[2]],
                    [estados[3]],
                    [estados[4]],
                    [estados[5]],

                ],
                labels: {
                    style: {
                        fontSize: '12px'
                    }
                }
            },

        };//charts option
        const series = [];
        const city = null;
        const group = null;
        return {
            chartOptions,
            series,
            city,
            group,
            estados
        };
    },//data

    methods: {
        urlParams() {
            const parse_url = new URL(window.location.href);
            this.city = parse_url.pathname.split('/')[3];
            this.group = parse_url.pathname.split('/')[4];
        },

        viewToast(type, message) {

            if (type == 'success') {
                toastr.success(message)
            } else {

                toastr.error(message, 'Error')
            }
        },

        async graphicBarEstado() {

            const cliente = new Cliente(this.city, this.group);
            const response = await cliente.graphicEstado();
            const estado_totales = {};
            response.records.forEach(item => {
                estado_totales[item.estado] = item.total;
            });

            const records = this.estados.map(item => estado_totales[item] || 0);

            if (response.status) {
             
                this.series = [{
                    data: records
                }];
                this.viewToast('success', response.message)
            } else {
                this.viewToast('error', response.message)
            }
        },


    },//methods
    mounted() {

        this.urlParams();
        this.graphicBarEstado();
    }


});

</script>
