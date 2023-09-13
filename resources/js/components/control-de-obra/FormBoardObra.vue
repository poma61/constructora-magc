<template>
    <v-dialog v-model="props.dialog_form_prop" max-width="600px" persistent>
        <div class="card">
            <div class="card-header has-background-success">
                <p class="card-header-title has-text-white">
                    <span class="mdi mdi-file-account-outline is-size-2"></span>
                    &nbsp;REGISTRAR OBRA |&nbsp;
                <nav class="breadcrumb" aria-label="breadcrumbs">
                    <ul>
                        <li>
                            <div class="has-text-black">
                                <span class="icon is-small">
                                    <i class="mdi mdi-city" aria-hidden="true"></i>
                                </span>
                                <span>{{ props.city_prop.toUpperCase() }}</span>
                            </div>
                        </li>
                    </ul>
                </nav>
                </p>
            </div>

            <div class="card-content as-form">
                <div class="is-flex is-flex-direction-column">

                    <div class="is-flex is-flex-wrap-wrap" style="width: 100%;">
                        <v-text-field label="Buscar N° de contrato" prepend-inner-icon="mdi-magnify" color="cyan-darken-1"
                            :loading="loading_search_cliente" @keyup.enter="searchContrato()" style="width: 300px;"
                            placeholder="Introduzca el n° de contrato" class="m-1" clearable v-model="search_n_contrato" />

                        <div class="m-2">
                            <v-btn icon="mdi-magnify" color="cyan-darken-1" @click="searchContrato()"
                                class="as-hover__box-shadow p-3"></v-btn>
                        </div>
                    </div>

                    <v-text-field v-model="props.item_obra_prop.n_contrato" label="N° contrato" readonly class="m-1"
                        color="cyan-darken-1" :error-messages="getViewMessageErrorsField('id_contrato')" />

                    <v-text-field v-model="nombreCompletoCliente" label="Nombre cliente" readonly class="m-1"
                        color="cyan-darken-1" :error-messages="getViewMessageErrorsField('id_contrato')" />

                    <v-autocomplete label="Estado" :items="['En ejecucion', 'Paralizado', 'Finalizado']"
                        v-model="props.item_obra_prop.estado" color="cyan-darken-1" append-inner-icon="mdi-text-box-edit"
                        clearable :error-messages="getViewMessageErrorsField('estado')" />

                    <v-text-field v-model="props.item_obra_prop.fecha_inicio" label="Fecha inicio" class="m-1"
                        color="cyan-darken-1" :error-messages="getViewMessageErrorsField('fecha_inicio')" clearable
                        type="date" />


                    <v-text-field v-model="props.item_obra_prop.fecha_finalizacion" label="Fecha finalizacion" class="m-1"
                        color="cyan-darken-1" :error-messages="getViewMessageErrorsField('fecha_finalizacion')" clearable
                        type="date" />

                    <v-text-field v-model="props.item_obra_prop.monto_pago_contratista" label="Monto pago contratista"
                        class="m-1" color="cyan-darken-1"
                        :error-messages="getViewMessageErrorsField('monto_pago_contratista')" clearable type="number" />

                    <v-textarea label="Descripcion" v-model="props.item_obra_prop.descripcion" color="cyan-darken-1"
                        append-inner-icon="mdi-text-box-edit" clearable
                        :error-messages="getViewMessageErrorsField('descripcion')" />
                </div>
            </div>

            <div class="is-flex  is-justify-content-end p-2" style="width: 100%;">
                <div class="m-1">
                    <v-btn rounded="xl" color="cyan-darken-1" @click="save()" class="as-hover__box-shadow">
                        <span class="mdi mdi-content-save-all is-size-5"></span>&nbsp;Guardar
                    </v-btn>
                </div>
                <div class="m-1">
                    <v-btn rounded="xl" color="red" @click="closeChild()" class="as-hover__box-shadow">
                        <span class="mdi mdi-cancel is-size-5"></span>&nbsp;Cancelar
                    </v-btn>
                </div>
            </div>
        </div>

    </v-dialog>

    <v-snackbar v-model="snackbar_message_response.active" :timeout="2000" :color="snackbar_message_response.color"
        location="top right" rounded="pill" min-height="70px">
        <div class="is-flex is-justify-content-center is-align-items-center">
            <span :class="snackbar_message_response.icon"></span>
            <p class="is-size-6">{{ snackbar_message_response.text }}</p>
        </div>
    </v-snackbar>
</template>


<script setup>
import Obra from '@/services/Obra';
import { computed, ref } from 'vue';


//props
const props = defineProps(['item_obra_prop', 'dialog_form_prop', 'city_prop']);
//emits
const emit = defineEmits(['closeFormEmit', 'refreshRowDataByFormEmit']);
//datas
const loading_search_cliente = ref(null);
const message_errors_field = ref({});
const search_n_contrato = ref("");
const snackbar_message_response = ref({ active: false, icon: "", color: "", text: "" });

const closeChild = () => {
    resetTo();
    emit('closeFormEmit');
}

const save = async () => {
    const obra = new Obra();
    obra.setCity(props.city_prop);
    obra.setFill(props.item_obra_prop);
    if (obra.getFill().id > 0) {
        const response = await obra.update();
        if (response.status) {
            //podemos pasar el props.item_obra_prop pero
            //pasaremos la respuesta del servidor por buenas practicas y evitar confusiones
            //debemos pasar el n_contrato,nombres,apellido_paterno,apellido_materno
            // porque en la respuesta del servidor no hay esos datos
            emit('refreshRowDataByFormEmit', 'edit', Object.assign({
                n_contrato: props.item_obra_prop.n_contrato,
                nombres: props.item_obra_prop.nombres,
                apellido_paterno: props.item_obra_prop.apellido_paterno,
                apellido_materno: props.item_obra_prop.apellido_materno,

            }, response.record));
            closeChild();
            viewSnackbar('success', response.message);
        } else {
            if (response.message_errors != undefined) {
                message_errors_field.value = Object.assign({}, response.message_errors);
            }
            viewSnackbar('error', response.message);
        }

    } else {
        //para un nuevo registro
        const response = await obra.create();
        if (response.status) {
            //podemos pasar el props.item_obra_prop pero
            //pasaremos la respuesta del servidor por buenas practicas y evitar confusiones
            //debemos pasar el n_contrato,nombres,apellido_paterno,apellido_materno
            // porque en la respuesta del servidor no hay esos datos
            emit('refreshRowDataByFormEmit', 'add', Object.assign({
                n_contrato: props.item_obra_prop.n_contrato,
                nombres: props.item_obra_prop.nombres,
                apellido_paterno: props.item_obra_prop.apellido_paterno,
                apellido_materno: props.item_obra_prop.apellido_materno,
            }, response.record));
            closeChild();
            viewSnackbar('success', response.message);
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

//computed
const getViewMessageErrorsField = computed(() => {
    return function (property) {
        if (message_errors_field.value[property]) {
            return message_errors_field.value[property][0];
        }
        return "";
    }
});

const nombreCompletoCliente = computed(() => {
    return `${props.item_obra_prop.nombres} ${props.item_obra_prop.apellido_paterno} ${props.item_obra_prop.apellido_materno}`;
});


const searchContrato = () => {
    loading_search_cliente.value = 'cyan-darken-1';
    setTimeout(async () => {
        const obra = new Obra(props.city_prop);
        const response = await obra.buscarContrato(search_n_contrato.value);
        loading_search_cliente.value = null;
        if (response.status) {
            props.item_obra_prop.id_contrato = response.record.id;
            props.item_obra_prop.n_contrato = response.record.n_contrato;
            props.item_obra_prop.nombres = response.record.nombres;
            props.item_obra_prop.apellido_paterno = response.record.apellido_paterno;
            props.item_obra_prop.apellido_materno = response.record.apellido_materno;
            search_n_contrato.value = "";

            viewSnackbar('success', response.message);
        } else {
            viewSnackbar('error', response.message);
        }
    }, 1000);

}

const viewSnackbar = (type, message) => {
    if (type == 'success') {
        snackbar_message_response.value.color = 'cyan-darken-1';
        snackbar_message_response.value.icon = 'mdi mdi-database-check-outline is-size-1';
    } else {
        snackbar_message_response.value.color = 'red';
        snackbar_message_response.value.icon = 'mdi mdi-alert-box-outline is-size-1';
    }
    snackbar_message_response.value.active = true;
    snackbar_message_response.value.text = message;
}

</script>