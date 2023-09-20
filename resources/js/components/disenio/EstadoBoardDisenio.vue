<template>
    <VBottomSheet v-model="props.sheet_estado_prop" persistent>
        <div class="card">
            <div class="card-header has-background-info">
                <p class="card-header-title has-text-white">
                    <span class="mdi mdi-list-status is-size-2"></span>
                    &nbsp;ESTADO | {{ props.item_disenio_prop.nombres }}
                    {{ props.item_disenio_prop.apellido_paterno }}
                    {{ props.item_disenio_prop.apellido_materno }}
                </p>
            </div>

            <div class="card-content as-content-estado">
                <div class="is-flex is-flex-wrap-wrap">

                    <v-text-field v-model="props.item_estado_disenio_prop.fecha_aprobacion" label="Fecha aprobacion"
                        class="m-1" color="indigo-lighten-1" type="date" clearable style="width: 350px;" />

                    <v-text-field v-model="props.item_estado_disenio_prop.fecha_entrega" label="Fecha entrega" class="m-1"
                        color="indigo-lighten-1" type="date" clearable style="width: 350px;" />

                    <v-text-field v-model="props.item_estado_disenio_prop.suffix_codigo" label="Codigo" class="m-1"
                        :prefix="props.item_estado_disenio_prop.prefix_codigo" color="indigo-lighten-1" type="text" clearable
                        style="width: 350px;" @input="filterDashes" />

                </div>
            </div>

            <div class="is-flex  is-justify-content-end p-2" style="width: 100%;">
                <div class="m-1">
                    <v-btn color="cyan-darken-1" @click="saveByCloseEstadoChild()" class="as-hover__box-shadow">
                        <span class="mdi mdi-content-save-all is-size-5"></span>&nbsp;Guardar
                    </v-btn>
                </div>
            </div>
        </div>

    </VBottomSheet>
</template>


<script setup>
import { VBottomSheet } from 'vuetify/labs/VBottomSheet'
import { ref, computed } from 'vue';

//props
const props = defineProps(['item_estado_disenio_prop', 'sheet_estado_prop', 'item_disenio_prop']);
//emits
const emit = defineEmits(['saveByCloseEstadoEmit'])

//evitar los guiones -
const filterDashes = () => {
    props.item_estado_disenio_prop.suffix_codigo = props.item_estado_disenio_prop.suffix_codigo.replace(/[/\-]/g, '');
}

//emits events
const saveByCloseEstadoChild = () => {
    emit('saveByCloseEstadoEmit');
}


</script>

<style scoped>
.as-content-estado {
    height: 15vh;
    overflow-y: auto;
    border-bottom: 1px solid #00000055;
}

@media screen and (max-width: 750px) {
    .as-content-estado {
        height: 30vh;
    }
}
</style>