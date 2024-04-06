<template>
    <nav class="breadcrumb" aria-label="breadcrumbs">
        <ul>
            <li>
                <div class="has-text-info">
                    <span class="icon is-small">
                        <span class="mdi mdi-chart-line"></span>
                    </span>
                    <span>Procesos</span>
                </div>
            </li>

            <li>
                <div class="has-text-info">
                    <span class="icon is-small">
                        <span class="mdi mdi-calendar-clock"></span>
                    </span>
                    <span>Fechas de diseño</span>
                </div>
            </li>
        </ul>
    </nav>

    <div class="tabs is-toggle">
        <ul>

            <li :class="{ 'is-active': field == 'planos' }">
                <a @click="selectField('planos')">
                    <span class="icon is-small">
                        <i class="mdi mdi-chart-line"></i>
                    </span>
                    <span>Planos</span>
                </a>
            </li>

            <li :class="{ 'is-active': field == 'elevaciones' }">
                <a @click="selectField('elevaciones')">
                    <span class="icon is-small">
                        <i class="mdi mdi-chart-line"></i>
                    </span>
                    <span>Elevaciones</span>
                </a>
            </li>

            <li :class="{ 'is-active': field == 'instalaciones' }">
                <a @click="selectField('instalaciones')">
                    <span class="icon is-small">
                        <i class="mdi mdi-chart-line"></i>
                    </span>
                    <span>Instalaciones</span>
                </a>
            </li>

            <li :class="{ 'is-active': field == 'p3D' }">
                <a @click="selectField('p3D')">
                    <span class="icon is-small">
                        <i class="mdi mdi-chart-line"></i>
                    </span>
                    <span>3D</span>
                </a>
            </li>

        </ul>
    </div>

    <div class="buttons">
        <div class="control has-icons-left">
            <div class="select is-info">
                <select v-model="year" @click="graphicBarPieProceso()">
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
                <span class="mdi mdi-calendar-cursor has-text-info is-size-5"></span>
            </div>
        </div>
    </div>

    <div class="buttons">
        <button @click="selectMont('todos')" :class="['button is-info', { 'is-light': month === 'todos' }]">
            <span class="mdi mdi-calendar-check-outline is-size-5"></span>&nbsp;Todos
        </button>

        <button @click="selectMont('enero')" :class="['button is-info', { 'is-light': month === 'enero' }]">
            <span class="mdi mdi-calendar-check-outline is-size-5"></span>&nbsp;Enero
        </button>

        <button @click="selectMont('febrero')" :class="['button is-info', { 'is-light': month === 'febrero' }]">
            <span class="mdi mdi-calendar-check-outline is-size-5"></span>&nbsp;Febrero
        </button>

        <button @click="selectMont('marzo')" :class="['button is-info', { 'is-light': month === 'marzo' }]">
            <span class="mdi mdi-calendar-check-outline is-size-5"></span>&nbsp;Marzo
        </button>

        <button @click="selectMont('abril')" :class="['button is-info', { 'is-light': month === 'abril' }]">
            <span class="mdi mdi-calendar-check-outline is-size-5"></span>&nbsp;Abril
        </button>

        <button @click="selectMont('mayo')" :class="['button is-info', { 'is-light': month === 'mayo' }]">
            <span class="mdi mdi-calendar-check-outline is-size-5"></span>&nbsp;Mayo
        </button>

        <button @click="selectMont('junio')" :class="['button is-info', { 'is-light': month === 'junio' }]">
            <span class="mdi mdi-calendar-check-outline is-size-5"></span>&nbsp;Junio
        </button>

        <button @click="selectMont('julio')" :class="['button is-info', { 'is-light': month === 'julio' }]">
            <span class="mdi mdi-calendar-check-outline is-size-5"></span>&nbsp;Julio
        </button>


        <button @click="selectMont('agosto')" :class="['button is-info', { 'is-light': month === 'agosto' }]">
            <span class="mdi mdi-calendar-check-outline is-size-5"></span>&nbsp;Agosto
        </button>


        <button @click="selectMont('septiembre')" :class="['button is-info', { 'is-light': month === 'septiembre' }]">
            <span class="mdi mdi-calendar-check-outline is-size-5"></span>&nbsp;Septiembre
        </button>


        <button @click="selectMont('octubre')" :class="['button is-info', { 'is-light': month === 'octubre' }]">
            <span class="mdi mdi-calendar-check-outline is-size-5"></span>&nbsp;Octubre
        </button>


        <button @click="selectMont('noviembre')" :class="['button is-info', { 'is-light': month === 'noviembre' }]">
            <span class="mdi mdi-calendar-check-outline is-size-5"></span>&nbsp;Noviembre
        </button>


        <button @click="selectMont('diciembre')" :class="['button is-info', { 'is-light': month === 'diciembre' }]">
            <span class="mdi mdi-calendar-check-outline is-size-5"></span>&nbsp;Diciembre
        </button>

    </div>
    
    <div class="box p-0">
        <apexchart type="bar" :height="500" :options="chart_options_bar" :series="series_bar"></apexchart>
    </div>

    <div class="box my-2 p-0 is-flex is-justify-content-center">
        <apexchart type="pie" :width="600" :options="chart_options_pie" :series="series_pie"></apexchart>
    </div>
</template>

<script>
import { defineComponent } from 'vue';
import VueApexCharts from "vue3-apexcharts";
import esLocale from 'apexcharts/dist/locales/es.json'; // Importa el módulo de idioma "es" aquí
import ProcesoDisenio from '@/services/ProcesoDisenio';
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
            positionClass: 'toast-bottom-right',
            timeOut: 3000,
            hideDuration: 100,
        };
        const anio_actual = new Date();
        const year = anio_actual.getFullYear();
        const month = "todos";
        const colores = ['#51A351', '#F14668', '#3E8ED0'];
        const field = "planos";
        const estados = [
            'En ejecucion',//0
            'Paralizado',//1
            'Finalizado',//2
        ];
        const chart_options_pie = {
            chart: {
                width: 380,
                type: 'pie',
            },
            colors: colores,
            labels: [estados[0], estados[1], estados[2]],
            responsive: [{
                breakpoint: 650,// se vuelve responsive cuando el window width sea 650
                options: {
                    chart: {
                        width: 400
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };

        const chart_options_bar = {
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
                ],
                labels: {
                    style: {
                        fontSize: '12px'
                    }
                }
            },

        };

        const series_pie = [];
        const series_bar = [];

        return {
            chart_options_bar,
            chart_options_pie,
            series_bar,
            series_pie,
            estados,
            year,
            month,
            field
        };
    },//data

    methods: {

        viewToast(type, message) {
            if (type == 'success') {
                toastr.success(message)
            } else {
                toastr.error(message, 'Error')
            }
        },

        selectMont(mes) {
            this.month = mes;
            this.graphicBarPieProceso();
        },

        selectField(is_field) {
            this.field = is_field;
            this.graphicBarPieProceso();
        },


        async graphicBarPieProceso() {
            const proceso_disenio = new ProcesoDisenio();
            const response = await proceso_disenio.graphicProcesoShe(this.year, this.month, this.field);
            const estado_totales = {};

            if (response.status) {
                response.records.forEach(item => {
                    estado_totales[item[this.field]] = item.total;
                });
                const records = this.estados.map(item => estado_totales[item] || 0);
                this.series_bar = [{
                    data: records
                }];

                this.series_pie = records;
                this.viewToast('success', response.message)
            } else {
                this.viewToast('error', response.message)
            }
        },


    },//methods
    mounted() {
        this.graphicBarPieProceso();
    }

});

</script>
