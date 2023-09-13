
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

    <vue-cal style="min-height: 80vh" active-view="year" locale="es" :events="data_events" events-on-month-view="short"
        :disable-views="['years', 'week', 'day']" events-count-on-year-view show-time-in-cells />
</template>

<script>
import { defineComponent } from 'vue';
import VueCal from 'vue-cal'
import Contratista from '@/services/Contratista';
import toastr from 'toastr';

export default defineComponent({
    components: {
        VueCal,
    },
    data() {
        const data_events = [];
        const city = "";
        const group = "";
        const class_colors = [
            'has-background-danger',
            'has-background-warning-dark',
            'has-background-success',
            'has-background-info',
            'has-background-link',
            'has-background-primary',
            'has-background-grey',
        ];
        const indice_aleatorio = -1;
        return {
            data_events,
            city,
            group,
            indice_aleatorio,
            class_colors,
        }
    },

    methods: {
        urlParams() {
            const parse_url = new URL(window.location.href);
            this.city = parse_url.pathname.split('/').pop();
        },

        viewToast(type, message) {
            // Configurar opciones globales para Toastr (opcional)
            toastr.options = {
                closeButton: true,
                progressBar: true,
                positionClass: 'toast-top-right',
                timeOut: 3000,
                hideDuration: 100,
            };
            if (type == 'success') {
                toastr.success(message)
            } else {
                toastr.error(message, 'Error')
            }
        },

        async initCalendarFechaInicio() {
            const contratista = new Contratista(this.city);
            const response = await contratista.calendarFechaInicio();

            if (response.status) {
                response.records.forEach(item => {
                    //indice aleatorio, segun el tamaño del array de clases de colores
                    this.indice_aleatorio = Math.floor(Math.random() * this.class_colors.length);

                    this.data_events.push({
                        start: `${item.fecha_inicio}`,
                        end: `${item.fecha_inicio}`,
                        title: `${item.nombres} ${item.apellido_paterno} ${item.apellido_materno}`,
                        class: `${this.class_colors[this.indice_aleatorio]} has-text-white my-1`
                    });

                });
                this.viewToast('success', response.message);
            } else {
                this.viewToast('error', response.message);
            }

        },

    },//methods

    mounted() {
        this.urlParams();
        this.initCalendarFechaInicio();
    }

});
</script>

<style>
/* Green-theme. */
.vuecal__menu,
.vuecal__cell-events-count {
    background-color: #00bcc9 !important;
    color: #fff;
}

.vuecal__title-bar {
    background-color: #c3fbff !important;
}

/* Dot indicator */
.vuecal__cell-events-count {
    min-width: 20px !important;
    min-height: 20px !important;
    font-size: 20px !important;
    padding: 2px !important;
}

/* ocultamos la hora final (end) */
.vuecal__event-time span {
    display: none !important;
}
</style>