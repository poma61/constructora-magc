<template>
    <VBottomSheet v-model="props.sheet_proceso_prop" persistent>
        <div class="card">
            <div class="card-header has-background-success">
                <p class="card-header-title has-text-white">
                    <span class="mdi mdi-chart-line is-size-2"></span>
                    &nbsp;PROCESOS | {{ props.item_disenio_prop.nombres }}
                    {{ props.item_disenio_prop.apellido_paterno }}
                    {{ props.item_disenio_prop.apellido_materno }}
                </p>
            </div>

            <div class="card-content as-content-process">
                <div class="is-flex is-flex-direction-column">

                    <v-radio-group v-model="props.item_proceso_disenio_prop.planos" label="Planos" inline>
                        <v-radio label="En ejecucion" value="En ejecucion" color="green-darken-1"></v-radio>
                        <v-radio label="Paralizado" value="Paralizado" color="red"></v-radio>
                        <v-radio label="Finalizado" value="Finalizado" color="light-blue-darken-3"></v-radio>
                    </v-radio-group>

                    <v-radio-group v-model="props.item_proceso_disenio_prop.elevaciones" label="Elevaciones" inline>
                        <v-radio label="En ejecucion" value="En ejecucion" color="green-darken-1"></v-radio>
                        <v-radio label="Paralizado" value="Paralizado" color="red"></v-radio>
                        <v-radio label="Finalizado" value="Finalizado" color="light-blue-darken-3"></v-radio>
                    </v-radio-group>


                    <v-radio-group v-model="props.item_proceso_disenio_prop.instalaciones" label="Instalaciones" inline>
                        <v-radio label="En ejecucion" value="En ejecucion" color="green-darken-1"></v-radio>
                        <v-radio label="Paralizado" value="Paralizado" color="red"></v-radio>
                        <v-radio label="Finalizado" value="Finalizado" color="light-blue-darken-3"></v-radio>
                    </v-radio-group>


                    <v-radio-group v-model="props.item_proceso_disenio_prop.p3D" label="3D" inline>
                        <v-radio label="En ejecucion" value="En ejecucion" color="green-darken-1"></v-radio>
                        <v-radio label="Paralizado" value="Paralizado" color="red"></v-radio>
                        <v-radio label="Finalizado" value="Finalizado" color="light-blue-darken-3"></v-radio>
                    </v-radio-group>

                </div>
            </div>

            <div class="is-flex  is-justify-content-end p-2" style="width: 100%;">
                <div class="m-1">
                    <v-btn color="green-darken-1" @click="saveByCloseProcesoChild()" class="as-hover__box-shadow">
                        <span class="mdi mdi-content-save-all is-size-5"></span>&nbsp;Guardar
                    </v-btn>
                </div>
            </div>
        </div>

    </VBottomSheet>
</template>


<script setup>
import { VBottomSheet } from 'vuetify/labs/VBottomSheet'

//props
const props = defineProps(['item_proceso_disenio_prop', 'sheet_proceso_prop', 'item_disenio_prop']);
//emits
const emit = defineEmits(['saveByCloseProcesoEmit'])
//datas


//emits events
const saveByCloseProcesoChild = () => {
    emit('saveByCloseProcesoEmit');
}


</script>

<style scoped>
.as-content-process {
    height: 45vh;
    overflow-y: auto;
    border-bottom: 1px solid #00000055;
}
</style>