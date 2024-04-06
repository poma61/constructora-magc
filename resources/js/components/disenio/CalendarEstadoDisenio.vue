
<template>

    <nav class="breadcrumb" aria-label="breadcrumbs">
        <ul>
            <li>
                <div class="has-text-success">
                    <span class="icon is-small">
                        <span class="mdi mdi-list-status"></span>
                    </span>
                    <span>ESTADO</span>
                </div>
            </li>
        </ul>
    </nav>

    <div class="tabs is-toggle">
        <ul>
            <li :class="{ 'is-active': field == 'fecha_aprobacion' }">
                <a @click="selectField('fecha_aprobacion')">
                    <span class="icon is-small">
                        <i class="mdi mdi-calendar-check-outline is-size-5"></i>
                    </span>
                    <span>Fechas, aprobacion</span>
                </a>
            </li>

            <li :class="{ 'is-active': field == 'fecha_entrega' }">
                <a @click="selectField('fecha_entrega')">
                    <span class="icon is-small">
                        <i class="mdi mdi-calendar-check-outline is-size-5"></i>
                    </span>
                    <span>Fechas, entrega</span>
                </a>
            </li>

        </ul>
    </div>

    <vue-cal style="min-height: 80vh" active-view="year" locale="es" :events="data_events" events-on-month-view="short"
        :disable-views="['years', 'week', 'day']" events-count-on-year-view show-time-in-cells />
        
</template>

<script>
import { defineComponent } from 'vue';
import VueCal from 'vue-cal'
import EstadoDisenio from '@/services/EstadoDisenio';
import toastr from 'toastr';

export default defineComponent({
    components: {
        VueCal,
    },
    data() {
        const data_events = [];
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
        const field = "fecha_aprobacion";
        return {
            data_events,
            indice_aleatorio,
            class_colors,
            field,
        }
    },

    methods: {
        viewToast(type, message) {
            // Configurar opciones globales para Toastr (opcional)
            toastr.options = {
                closeButton: true,
                progressBar: true,
                positionClass: 'toast-bottom-right',
                timeOut: 3000,
                hideDuration: 100,
            };
            if (type == 'success') {
                toastr.success(message)
            } else {
                toastr.error(message, 'Error')
            }
        },

        async initCalendarFechaAll() {

            const revision = new EstadoDisenio();
            const response = await revision.calendarFechaAllShe(this.field);
            if (response.status) {
                response.records.forEach(item => {
                    //indice aleatorio, segun el tamaño del array de clases de colores
                    this.indice_aleatorio = Math.floor(Math.random() * this.class_colors.length);

                    this.data_events.push({
                        start: `${item[this.field]}`,
                        end: `${item[this.field]}`,
                        title: `${item.nombres} ${item.apellido_paterno} ${item.apellido_materno}`,
                        class: `${this.class_colors[this.indice_aleatorio]} has-text-white my-1`
                    });

                });
                this.viewToast('success', response.message);
            } else {
                this.viewToast('error', response.message);
            }

        },

        selectField(is_field) {
            this.field = is_field;
            this.data_events=[];//reiniciamos la variable
            this.initCalendarFechaAll();
        }

    },//methods

    mounted() {
        this.initCalendarFechaAll();
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

</style>