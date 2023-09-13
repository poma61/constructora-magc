<!-- no esta hecho nada -->
<template>
    <nav class="breadcrumb is-medium" aria-label="breadcrumbs">
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
                <select v-model="year" @click="graphicInitDataBarPieMaterial()">
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
        <div ref="barContainer"></div>

    </div>

    <div class="box my-2 p-0 is-flex is-justify-content-center">
        <div ref="pieContainer"></div>
    </div>
</template>

<script>
import { defineComponent } from 'vue';

import esLocale from 'apexcharts/dist/locales/es.json'; // Importa el módulo de idioma "es" aquí
import Inventario from '@/services/Inventario';
import toastr from 'toastr';
import ApexCharts from "apexcharts";

export default defineComponent({
    data() {
        // Configurar opciones globales para Toastr (opcional)
        toastr.options = {
            closeButton: true,
            progressBar: true,
            positionClass: 'toast-top-right',
            timeOut: 3000,
            hideDuration: 100,
        };
        const anio_actual = new Date();
        const year = anio_actual.getFullYear();
        const month = "todos";
        const chart_options_pie = {
            chart: {
                width: 600,
                type: 'pie',
            },
            labels: [],
            responsive: [{
                breakpoint: 800,// se vuelve responsive cuando el window width sea 600
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
                height: 600,
                defaultLocale: 'es',
                locales: [esLocale],
            },
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
            xaxis: {},
        };
        const chart_pie = null;
        const chart_bar = null;
        const series_pie = [];
        const series_bar = [];
        const city = null;
        return {
            chart_options_bar,
            chart_options_pie,
            chart_bar,
            chart_pie,
            series_bar,
            series_pie,
            city,
            year,
            month,
        };
    },//data

    methods: {
        urlParams() {
            const parse_url = new URL(window.location.href);
            this.city = parse_url.pathname.split('/').pop();
        },

        viewToast(type, message) {
            if (type == 'success') {
                toastr.success(message)
            } else {
                toastr.error(message, 'Error')
            }
        },

        selectMont(mes) {
            this.month = mes;
            this.graphicInitDataBarPieMaterial();
        },

        renderGrapich() {
            this.chart_bar = new ApexCharts(this.$refs.barContainer, {
                ...this.chart_options_bar,
                series: this.series_bar
            });
            this.chart_bar.render();

            this.chart_pie = new ApexCharts(this.$refs.pieContainer, {
                ...this.chart_options_pie,
                series: this.series_pie
            });
            this.chart_pie.render();
        },
        async graphicInitDataBarPieMaterial() {
            const inventario = new Inventario(this.city);
            const response = await inventario.graphicMaterial(this.year, this.month);

            if (response.status) {
                const nombre_material = response.records.map(item => item.material);
                this.chart_options_pie.labels = nombre_material;
                const categories = [];
                for (let i = 0; i < nombre_material.length; i++) {
                    categories.push([nombre_material[i]]);
                }
                this.chart_options_bar.xaxis = {
                    categories: categories,
                    labels: {
                        style: {
                            fontSize: '12px'
                        }
                    }
                };

                const records = response.records.map(item =>Number(item.cantidad_total));
                this.series_bar = [{
                    data: records
                }];
                this.series_pie = records;

                this.chart_bar.updateOptions(this.chart_options_bar);
                this.chart_bar.updateSeries(this.series_bar);

                this.chart_pie.updateOptions(this.chart_options_pie);
                this.chart_pie.updateSeries(this.series_pie);

                this.viewToast('success', response.message);
            } else {
                this.viewToast('error', response.message)
            }
        },


    },//methods
    mounted() {
        this.urlParams();
        this.renderGrapich();
        this.graphicInitDataBarPieMaterial(this.year, this.month);
    }

});

</script>
