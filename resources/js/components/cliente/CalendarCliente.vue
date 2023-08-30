
<template>
      <nav class="breadcrumb is-medium" aria-label="breadcrumbs">
        <ul>
            <li>
                <div class="has-text-info">
                    <span class="icon is-small">
                        <span class="mdi mdi-calendar-clock"></span>
                    </span>
                    <span>Fechas de reunion</span>
                </div>
            </li>
        </ul>
    </nav>

    <vue-cal style="min-height: 80vh" locale="es" active-view="year" :events="data_events" events-on-month-view="short"
        :disable-views="['years']" events-count-on-year-view />
</template>

<script>
import { defineComponent } from 'vue';
import VueCal from 'vue-cal'
import Cliente from '@/services/Cliente';
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
            'has-background-warning',
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
            this.city = parse_url.pathname.split('/')[3];
            this.group = parse_url.pathname.split('/')[4];
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

        addHour(hora_actual) {
            const tiempo_actual = new Date(`2000-01-01T${hora_actual}`)
            tiempo_actual.setHours(tiempo_actual.getHours() + 1);
            tiempo_actual.setMinutes(tiempo_actual.getMinutes() + 10);

            const hora = tiempo_actual.getHours();
            const minutos = tiempo_actual.getMinutes();
            const segundos = tiempo_actual.getSeconds();
            return `${hora.toString().padStart(2, '0')}:${minutos.toString().padStart(2, '0')}:${segundos.toString().padStart(2, '0')}`;
        },

        async initCalendarMeeting() {
            const cliente = new Cliente(this.city, this.group);
            const response = await cliente.calendarMeeting();

            if (response.status) {
                response.records.forEach(item => {
                    //indice aleatorio, segun el tamaño del array de clases de colores
                    this.indice_aleatorio = Math.floor(Math.random() * this.class_colors.length);

                    this.data_events.push({
                        start: `${item.fecha_reunion} ${item.hora_reunion}`,
                        end: `${item.fecha_reunion} ${this.addHour(item.hora_reunion)}`,
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
        this.initCalendarMeeting();
    }

});
</script>

<style>
/* Green-theme. */
.vuecal__menu,
.vuecal__cell-events-count {
    background-color: #427bb9 !important;
    color: #fff;
}


/* Dot indicator */
.vuecal__cell-events-count {
    min-width: 20px !important;
    min-height: 20px !important;
    font-size: 20px !important;
    padding: 2px !important;
}


/* .vuecal__event {
    margin: 1px 0px;
} */

/* ocultamos la hora final (end) */
.vuecal__event-time span {
    display: none !important;
}
</style>