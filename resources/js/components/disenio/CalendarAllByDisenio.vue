
<template>
    <div class="buttons">
        <button @click="selectRevisionByShe('Revision')" :class="['button is-info', { 'is-light': she === 'Revision' }]">
            <span class="mdi mdi-text-box-check-outline is-size-5"></span>&nbsp;Revision
        </button>

        <button @click="selectRevisionByShe('Estado')" :class="['button is-info', { 'is-light': she === 'Estado' }]">
            <span class="mdi mdi-list-status is-size-5"></span>&nbsp;Estado
        </button>

        <button @click="selectRevisionByShe('Modificacion')"
            :class="['button is-info', { 'is-light': she === 'Modificacion' }]">
            <span class="mdi mdi-file-sign is-size-5"></span>&nbsp;Modificacion
        </button>

    </div>

    <CalendarRevisionDisenio v-if="component_CalendarRevisionDisenio" />
    <CalendarEstadoDisenio v-if="component_CalendarEstadoDisenio" />
    <CalendarModificacionDisenio v-if="component_CalendarModificacionDisenio" />
</template>
<script setup>
import { onMounted, ref } from 'vue';
import CalendarRevisionDisenio from '@/components/disenio/CalendarRevisionDisenio.vue';
import CalendarEstadoDisenio from '@/components/disenio/CalendarEstadoDisenio.vue';
import CalendarModificacionDisenio from '@/components/disenio/CalendarModificacionDisenio.vue';

//data
const component_CalendarRevisionDisenio = ref(false);
const component_CalendarEstadoDisenio = ref(false);
const component_CalendarModificacionDisenio = ref(false);

const she = ref('Revision');
const selectRevisionByShe = (is_she) => {
    she.value = is_she;
    viewComponent();
}

const viewComponent = () => {
    switch (she.value) {
        case "Revision":
            component_CalendarRevisionDisenio.value = true;
            component_CalendarEstadoDisenio.value = false;
            component_CalendarModificacionDisenio.value = false;
            break;
        case "Estado":
            component_CalendarRevisionDisenio.value = false;
            component_CalendarEstadoDisenio.value = true;
            component_CalendarModificacionDisenio.value = false;
            break;

        case "Modificacion":
            component_CalendarRevisionDisenio.value = false;
            component_CalendarEstadoDisenio.value = false;
            component_CalendarModificacionDisenio.value = true;
            break;

        default: console.error('No existe el componente');
            break;
    }
}

onMounted(() => {
    viewComponent();
});
</script>