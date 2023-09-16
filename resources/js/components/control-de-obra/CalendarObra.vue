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

    <vue-cal style="min-height: 80vh" active-view="year" locale="es" :events="data_events" events-on-month-view="short"
        :disable-views="['years', 'week']" events-count-on-year-view show-time-in-cells />
</template>

<script>
import { defineComponent } from 'vue';
import VueCal from 'vue-cal'
import Obra from '@/services/Obra';
import toastr from 'toastr';

export default defineComponent({
    components: {
        VueCal,
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
            if (type == 'success') {
                toastr.success(message)
            } else {
                toastr.error(message, 'Error')
            }
        },

        async initCalendarFechaInicio() {
            const obra = new Obra(this.city);
            const response = await obra.calendarFechaInicio();

            if (response.status) {
                response.records.forEach(item => {
                    //indice aleatorio, segun el tamaño del array de clases de colores
                    this.indice_aleatorio = Math.floor(Math.random() * this.class_colors.length);

                    this.data_events.push({
                        start: `${item.fecha_inicio}`,
                        end: `${item.fecha_inicio}`,
                        title: `${item.nombres} ${item.apellido_paterno} ${item.apellido_materno}`,
                        content: `N° de contrato: ${item.n_contrato}`,
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
    background-color: #006fc9 !important;
    color: #fff;
}

.vuecal__title-bar {
    background-color: #81b3dd !important;
}

/* Dot indicator 'mes'*/
.vuecal__cell-events-count {
    min-width: 20px !important;
    min-height: 20px !important;
    font-size: 20px !important;
    padding: 2px !important;
}


/* ocultamos la hora del menu 'day'=>'dia' */
.vuecal__event-time {
    display: none !important;
}
</style>