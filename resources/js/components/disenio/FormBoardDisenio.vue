<template>
    <v-dialog v-model="props.dialog_form_prop" max-width="800px" persistent>
        <div class="card">
            <div class="card-header has-background-info">
                <p class="card-header-title has-text-white">
                    <span class="mdi mdi-dishwasher is-size-2"></span>
                    &nbsp;REGISTRAR DISEÑO
                </p>
            </div>

            <div class="card-content as-form">
                <div class="is-flex is-flex-direction-column">

                    <div class="is-flex is-flex-wrap-wrap" style="width: 100%;">
                        <v-text-field label="Buscar cliente" prepend-inner-icon="mdi-magnify" color="indigo-lighten-1"
                            :loading="loading_search_cliente" @keyup.enter="searchCliente()" style="width: 300px;"
                            placeholder="Introduzca el CI del cliente" class="m-1" clearable v-model="search_cliente"
                            type="text" />

                        <div class="m-2">
                            <v-btn icon="mdi-magnify" size="compact" color="indigo-lighten-1" variant="outlined"
                                @click="searchCliente()" class="as-hover__box-shadow p-3"></v-btn>
                        </div>
                    </div>

                    <v-text-field v-model="nombreCompletoCliente" label="Nombre cliente" readonly class="m-1"
                        color="indigo-lighten-1" :error-messages="getViewMessageErrorsField('id_cliente')" />

                    <v-textarea v-model="props.item_disenio_prop.requerimiento" label="Requerimiento" class="m-1"
                        color="indigo-lighten-1" :error-messages="getViewMessageErrorsField('requerimiento')" clearable />

                    <v-text-field v-model="props.item_disenio_prop.fecha" label="Fecha" class="m-1" color="indigo-lighten-1"
                        type="date" :error-messages="getViewMessageErrorsField('fecha')" clearable />

                    <v-text-field v-model="props.item_disenio_prop.arquitecto" label="Arquitecto" class="m-1"
                        color="indigo-lighten-1" :error-messages="getViewMessageErrorsField('arquitecto')" clearable
                        type="text" />

                </div>
            </div>

            <div class="is-flex  is-justify-content-end p-2" style="width: 100%;">
                <div class="m-1">
                    <v-btn  color="indigo-lighten-1" @click="save()" class="as-hover__box-shadow">
                        <span class="mdi mdi-content-save-all is-size-5"></span>&nbsp;Guardar
                    </v-btn>
                </div>
                <div class="m-1">
                    <v-btn  color="red" @click="closeChild()" class="as-hover__box-shadow">
                        <span class="mdi mdi-cancel is-size-5"></span>&nbsp;Cancelar
                    </v-btn>
                </div>
            </div>
        </div>

    </v-dialog>

    <v-snackbar v-model="snackbar_message_response.active" :timeout="2000" :color="snackbar_message_response.color"
        location="bottom right"  min-height="70px">
        <div class="is-flex is-justify-content-center is-align-items-center">
            <span :class="snackbar_message_response.icon"></span>
            <p class="is-size-6">{{ snackbar_message_response.text }}</p>
        </div>
    </v-snackbar>
</template>


<script setup>
import Disenio from '@/services/Disenio';
import { computed, ref } from 'vue';


//props
const props = defineProps(['item_disenio_prop', 'dialog_form_prop']);
//emits
const emit = defineEmits(['closeFormEmit', 'refreshRowDataByFormEmit'])
//datas
const loading_search_cliente = ref(null);
const message_errors_field = ref({});
const search_cliente = ref("");
const snackbar_message_response = ref({ active: false, icon: "", color: "", text: "", });

//computed
const getViewMessageErrorsField = computed(() => {
    return function (property) {
        if (message_errors_field.value[property]) {
            return message_errors_field.value[property][0];
        }
        return "";
    }
});

//computed
const nombreCompletoCliente = computed(() => {
    return `${props.item_disenio_prop.nombres} ${props.item_disenio_prop.apellido_paterno} ${props.item_disenio_prop.apellido_materno}`;
});



//emits events
const closeChild = () => {
    resetTo();
    emit('closeFormEmit');
}


const save = async () => {
    const disenio = new Disenio(props.item_disenio_prop);
    if (disenio.getFill().id > 0) {
        //para editar registro
        const response = await disenio.update();
        if (response.status) {
            emit('refreshRowDataByFormEmit', 'edit', Object.assign({
                nombres: props.item_disenio_prop.nombres,
                apellido_paterno: props.item_disenio_prop.apellido_paterno,
                apellido_materno: props.item_disenio_prop.apellido_materno,
            }, response.record));
            viewSnackbar('success', response.message);
            closeChild();
        } else {
            if (response.message_errors != undefined) {
                message_errors_field.value = Object.assign({}, response.message_errors);
            }
            viewSnackbar('error', response.message);
        }

    } else {
        //para un nuevo registro
        const response = await disenio.create();
        if (response.status) {
            emit('refreshRowDataByFormEmit', 'add', Object.assign({
                nombres: props.item_disenio_prop.nombres,
                apellido_paterno: props.item_disenio_prop.apellido_paterno,
                apellido_materno: props.item_disenio_prop.apellido_materno,
            }, response.record));
            viewSnackbar('success', response.message);
            closeChild();
        } else {
            if (response.message_errors != undefined) {
                message_errors_field.value = Object.assign({}, response.message_errors);
            }
            viewSnackbar('error', response.message);
        }

    }
}//save

const resetTo = () => {
    message_errors_field.value = {};
}


const searchCliente = () => {
    loading_search_cliente.value = 'indigo-lighten-1';
    setTimeout(async () => {
        const disenio = new Disenio();
        const response = await disenio.buscarCliente(search_cliente.value);
        loading_search_cliente.value = null;
        if (response.status) {
            props.item_disenio_prop.id_cliente = response.record.id;
            props.item_disenio_prop.nombres = response.record.nombres;
            props.item_disenio_prop.apellido_paterno = response.record.apellido_paterno;
            props.item_disenio_prop.apellido_materno = response.record.apellido_materno;
            search_cliente.value = "";
            viewSnackbar('success', response.message);
        } else {
            viewSnackbar('error', response.message);
        }
    }, 1000);

}

const viewSnackbar = (type, message) => {
    if (type == 'success') {
        snackbar_message_response.value.color = 'indigo-lighten-1';
        snackbar_message_response.value.icon = 'mdi mdi-database-check-outline is-size-1';
    } else {
        snackbar_message_response.value.color = 'red';
        snackbar_message_response.value.icon = 'mdi mdi-alert-box-outline is-size-1';
    }
    snackbar_message_response.value.active = true;
    snackbar_message_response.value.text = message;
}

</script>