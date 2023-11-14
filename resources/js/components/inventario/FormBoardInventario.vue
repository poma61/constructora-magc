<template>
    <v-dialog v-model="props.dialog_form_prop" max-width="600px" persistent>
        <div class="card">
            <div class="card-header has-background-info">
                <p class="card-header-title has-text-white">
                    <span class="mdi mdi-file-account-outline is-size-2"></span>
                    &nbsp;REGISTRAR INVENTARIO |&nbsp;
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
                        <v-text-field label="Buscar N° de contrato" prepend-inner-icon="mdi-magnify"
                            color="light-blue-lighten-1" :loading="loading_search_cliente"
                            @keyup.enter="searchContratoByContratista()" style="width: 300px;"
                            placeholder="Introduzca el n° de contrato/contratista" class="m-1" clearable
                            v-model="search_n_contrato_contratista" />

                        <div class="m-2">
                            <v-btn icon="mdi-magnify" color="light-blue-lighten-1" @click="searchContratoByContratista()"
                                class="as-hover__box-shadow p-3"></v-btn>
                        </div>
                    </div>

                    <v-text-field v-model="props.item_inventario_prop.n_contrato_contratista"
                        label="N° contrato/contratista" readonly class="m-1" color="light-blue-lighten-1"
                        :error-messages="getViewMessageErrorsField('id_contratista')" />

                    <v-text-field v-model="props.item_inventario_prop.n_recibo" label="N° de recibo" class="m-1"
                        color="light-blue-lighten-1" :error-messages="getViewMessageErrorsField('n_recibo')" clearable />

                    <v-text-field v-model="props.item_inventario_prop.material" label="Material" class="m-1"
                        color="light-blue-lighten-1" :error-messages="getViewMessageErrorsField('material')" clearable />

                    <v-text-field v-model="props.item_inventario_prop.unidad" label="Unidad" class="m-1"
                        color="light-blue-lighten-1" :error-messages="getViewMessageErrorsField('unidad')" clearable />

                    <v-text-field v-model="props.item_inventario_prop.cantidad" label="Cantidad" class="m-1"
                        color="light-blue-lighten-1" :error-messages="getViewMessageErrorsField('cantidad')" clearable />

                    <v-text-field v-model="props.item_inventario_prop.costo_unitario" label="Costo unitario" class="m-1"
                        color="light-blue-lighten-1" :error-messages="getViewMessageErrorsField('costo_unitario')"
                        clearable />

                    <v-text-field v-model="props.item_inventario_prop.fecha_ingreso" label="Fecha ingreso" class="m-1"
                        color="light-blue-lighten-1" :error-messages="getViewMessageErrorsField('fecha_ingreso')"
                        type="date" clearable />

                </div>
            </div>

            <div class="is-flex  is-justify-content-end p-2" style="width: 100%;">
                <div class="m-1">
                    <v-btn rounded="xl" color="light-blue-lighten-1" @click="save()" class="as-hover__box-shadow">
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
        location="bottom right" rounded="pill" min-height="70px">
        <div class="is-flex is-justify-content-center is-align-items-center">
            <span :class="snackbar_message_response.icon"></span>
            <p class="is-size-6">{{ snackbar_message_response.text }}</p>
        </div>
    </v-snackbar>
</template>


<script setup>
import Inventario from '@/services/Inventario';
import { computed, ref } from 'vue';


//props
const props = defineProps(['item_inventario_prop', 'dialog_form_prop', 'city_prop']);
//emits
const emit = defineEmits(['closeFormEmit', 'refreshRowDataByFormEmit']);
//datas
const loading_search_cliente = ref(null);
const message_errors_field = ref({});
const search_n_contrato_contratista = ref("");
const snackbar_message_response = ref({ active: false, icon: "", color: "", text: "" });

const closeChild = () => {
    resetTo();
    emit('closeFormEmit');
}

const save = async () => {
    const inventario = new Inventario();
    inventario.setCity(props.city_prop);
    inventario.setFill(props.item_inventario_prop);
    if (inventario.getFill().id > 0) {
        const response = await inventario.update();
        if (response.status) {
            //podemos pasar el props.item_inventario_prop pero
            //pasaremos la respuesta del servidor por buenas practicas y evitar confusiones
            //debemos pasar el n_contrato_contratista porque en la respuesta del servidor no hay ese dato porque el n_contrato_contratista
            //esta en otra tabla, y la tabla inventario solo tenemos el id_contratista
            emit('refreshRowDataByFormEmit', 'edit', Object.assign({
                n_contrato_contratista: props.item_inventario_prop.n_contrato_contratista
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
        const response = await inventario.create();
        if (response.status) {
            //debemos agregar el record desde la respuesta del servidor porque el 'id' debe actualizarse
            //como es un registro nuevo el  id=0 actualmente en props.item_inventario_prop,
            //debemos pasar el n_contrato_contratista porque en la respuesta del servidor no hay ese dato porque el n_contrato
            //esta en otra tabla, y la tabla inventario solo tenemos el id_contratista
            emit('refreshRowDataByFormEmit', 'add', Object.assign({
                n_contrato_contratista: props.item_inventario_prop.n_contrato_contratista
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



const searchContratoByContratista = () => {
    loading_search_cliente.value = 'light-blue-lighten-1';
    setTimeout(async () => {
        const inventario = new Inventario(props.city_prop);
        const response = await inventario.buscarContratoByContratista(search_n_contrato_contratista.value);
        loading_search_cliente.value = null;
        if (response.status) {
            props.item_inventario_prop.id_contratista = response.record.id;
            props.item_inventario_prop.n_contrato_contratista = response.record.n_contrato_contratista;
            search_n_contrato_contratista.value = "";

            viewSnackbar('success', response.message);
        } else {
            viewSnackbar('error', response.message);
        }
    }, 1000);

}

const viewSnackbar = (type, message) => {
    if (type == 'success') {
        snackbar_message_response.value.color = 'light-blue-lighten-1';
        snackbar_message_response.value.icon = 'mdi mdi-database-check-outline is-size-1';
    } else {
        snackbar_message_response.value.color = 'red';
        snackbar_message_response.value.icon = 'mdi mdi-alert-box-outline is-size-1';
    }
    snackbar_message_response.value.active = true;
    snackbar_message_response.value.text = message;
}

</script>