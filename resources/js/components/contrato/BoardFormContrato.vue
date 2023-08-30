<template>
    <div class="box p-0">
        <div class="card-header has-background-info">
            <p class="card-header-title has-text-white">
                <v-icon icon="mdi-file-account-outline" size="50" />
                &nbsp;REGISTRAR CONTRATO&nbsp;
            </p>
        </div>

        <div class="p-1">
            <!-- buscar cliente -->
            <div class="is-flex is-flex-wrap-wrap" style="width: 100%;">
                <v-text-field label="Buscar Cliente" prepend-inner-icon="mdi-magnify" color="deep-purple-lighten-2"
                    :loading="loading_search_cliente" @keyup.enter="searchCliente()"
                    placeholder="Introduzca el CI del cliente" class="m-1" style="width: 300px;" clearable
                    v-model="ci_cliente" />

                <div class="m-2">
                    <v-btn icon="mdi-magnify" size="compact" color="deep-purple-lighten-2" variant="outlined"
                        @click="searchCliente()" class="as-hover__box-shadow p-3"></v-btn>
                </div>
            </div>
            <!-- clientes -->
            <div class="is-flex is-flex-wrap-wrap" style="width: 100%;">
                <v-text-field v-model="nombreCompletoCliente" label="Nombre cliente" readonly class="m-1"
                    color="deep-purple-lighten-2" :error-messages="getViewMessageErrorsField('id_cliente')" />
            </div>

            <!-- datos principales del contrato -->

            <div class="is-flex is-flex-wrap-wrap" style="width: 100%;">
                <v-text-field v-model="props.item_contrato_prop.fecha_firma_contrato" label="Fecha de firma Contrato"
                    class="m-1" color="deep-purple-lighten-2" type="date" style="width: 300px"
                    :error-messages="getViewMessageErrorsField('fecha_firma_contrato')" clearable />
            </div>


            <div class="is-flex is-flex-wrap-wrap" style="width: 100%;">
                <v-text-field v-model="props.item_contrato_prop.monto_total_construccion" prefix="$us."
                    label="Monto total de la construccion" class="m-1" style="width: 300px" color="deep-purple-lighten-2"
                    :error-messages="getViewMessageErrorsField('monto_total_construccion')" clearable />

                <v-text-field v-model="props.item_contrato_prop.couta_inicial" label="Couta inicial" class="m-1"
                    style="width: 300px" color="deep-purple-lighten-2"
                    :error-messages="getViewMessageErrorsField('couta_inicial')" clearable />
            </div>

            <div class="is-flex is-flex-wrap-wrap" style="width: 100%;">
                <v-text-field v-model="props.item_contrato_prop.couta_mensual" label="Couta mensual" class="m-1"
                    style="width: 300px;" color="deep-purple-lighten-2" prefix="$us."
                    :error-messages="getViewMessageErrorsField('couta_mensual')" clearable />

                <v-text-field v-model="props.item_contrato_prop.fecha_pago_couta_mensual"
                    label="Fecha de pago de couta mensual" class="m-1" style="width: 300px;" color="deep-purple-lighten-2"
                    :error-messages="getViewMessageErrorsField('fecha_pago_couta_mensual')" clearable type="date" />

            </div>

            <div class="is-flex is-flex-wrap-wrap" style="width: 100%;">
                <v-textarea v-model="props.item_contrato_prop.descripcion" label="Descripcion" class="m-1"
                    color="deep-purple-lighten-2" :error-messages="getViewMessageErrorsField('descripcion')" clearable />
            </div>

            <!-- detalle contato -->
            <div class="is-flex is-flex-wrap-wrap" style="width: 100%;">
                <v-text-field v-model="props.item_detalle_contrato_prop.n_lote" label="N° de lote" class="m-1"
                    style="width: 300px;" color="deep-purple-lighten-2"
                    :error-messages="getViewMessageErrorsField('n_lote')" clearable />

                <v-text-field v-model="props.item_detalle_contrato_prop.n_uv" label="N° U.V." class="m-1"
                    style="width: 300px;" color="deep-purple-lighten-2"
                    :error-messages="getViewMessageErrorsField('n_uv')" />
            </div>

            <div class="is-flex is-flex-wrap-wrap" style="width: 100%;">
                <v-text-field v-model="props.item_detalle_contrato_prop.zona" label="Nombre de la zona" class="m-1"
                    style="width: 300px;" color="deep-purple-lighten-2" :error-messages="getViewMessageErrorsField('zona')"
                    clearable />

                <v-text-field v-model="props.item_detalle_contrato_prop.barrio" label="Nombre del barrio" class="m-1"
                    style="width: 300px;" color="deep-purple-lighten-2"
                    :error-messages="getViewMessageErrorsField('barrio')" clearable />
            </div>

            <div class="is-flex is-flex-wrap-wrap" style="width: 100%;">
                <v-text-field v-model="props.item_detalle_contrato_prop.calle" label="Nombre de la calle" class="m-1"
                    style="width: 300px;" color="deep-purple-lighten-2" :error-messages="getViewMessageErrorsField('calle')"
                    clearable />

                <v-text-field v-model="props.item_detalle_contrato_prop.superficie_terreno" suffix="metros²"
                    label="Superficie terreno en metros cuadrados" class="m-1" style="width: 300px;"
                    color="deep-purple-lighten-2" :error-messages="getViewMessageErrorsField('superficie_terreno')"
                    clearable />
            </div>

            <div class="is-flex is-flex-wrap-wrap" style="width: 100%;">
                <v-text-field v-model="props.item_detalle_contrato_prop.numero_distrito" label="Numero de distrito"
                    class="m-1" style="width: 300px;" color="deep-purple-lighten-2"
                    :error-messages="getViewMessageErrorsField('numero_distrito')" clearable />

                <v-text-field v-model="props.item_detalle_contrato_prop.numero_identificacion_terreno"
                    label="Numero de identificacion del terreno" class="m-1" style="width: 300px;"
                    color="deep-purple-lighten-2"
                    :error-messages="getViewMessageErrorsField('numero_identificacion_terreno')" clearable />
            </div>

            <div class="is-flex is-flex-wrap-wrap" style="width: 100%;">
                <v-text-field v-model="props.item_detalle_contrato_prop.norte_medida_terreno"
                    label="Norte, medida del terreno" class="m-1" style="width: 300px;" color="deep-purple-lighten-2"
                    :error-messages="getViewMessageErrorsField('norte_medida_terreno')" clearable />

                <v-text-field v-model="props.item_detalle_contrato_prop.norte_colinda_lote" label="Norte, colinda con lote"
                    class="m-1" style="width: 300px;" color="deep-purple-lighten-2"
                    :error-messages="getViewMessageErrorsField('norte_colinda_lote')" clearable />
            </div>

            <div class="is-flex is-flex-wrap-wrap" style="width: 100%;">
                <v-text-field v-model="props.item_detalle_contrato_prop.sur_medida_terreno" label="Sur, medida del terreno"
                    class="m-1" style="width: 300px;" color="deep-purple-lighten-2"
                    :error-messages="getViewMessageErrorsField('sur_medida_terreno')" clearable />

                <v-text-field v-model="props.item_detalle_contrato_prop.sur_colinda_lote" label="Sur, colinda con lote"
                    class="m-1" style="width: 300px;" color="deep-purple-lighten-2"
                    :error-messages="getViewMessageErrorsField('sur_colinda_lote')" clearable />
            </div>

            <div class="is-flex is-flex-wrap-wrap" style="width: 100%;">
                <v-text-field v-model="props.item_detalle_contrato_prop.este_medida_terreno"
                    label="Este, medida del terreno" class="m-1" style="width: 300px;" color="deep-purple-lighten-2"
                    :error-messages="getViewMessageErrorsField('este_medida_terreno')" clearable />

                <v-text-field v-model="props.item_detalle_contrato_prop.este_colinda_lote" label="Este, colinda con lote"
                    class="m-1" style="width: 300px;" color="deep-purple-lighten-2"
                    :error-messages="getViewMessageErrorsField('este_colinda_lote')" clearable />
            </div>

            <div class="is-flex is-flex-wrap-wrap" style="width: 100%;">
                <v-text-field v-model="props.item_detalle_contrato_prop.oeste_medida_terreno"
                    label="Oeste, medida del terreno" class="m-1" style="width: 300px;" color="deep-purple-lighten-2"
                    :error-messages="getViewMessageErrorsField('oeste_medida_terreno')" clearable />

                <v-text-field v-model="props.item_detalle_contrato_prop.oeste_colinda_lote" label="Oeste, colinda con lote"
                    class="m-1" style="width: 300px;" color="deep-purple-lighten-2"
                    :error-messages="getViewMessageErrorsField('oeste_colinda_lote')" clearable />
            </div>

            <div class="is-flex is-flex-wrap-wrap" style="width: 100%;">
                <v-text-field v-model="props.item_detalle_contrato_prop.cantidad_couta_mensual"
                    label="Cantidad de couta mensual" class="m-1" style="width: 300px;" color="deep-purple-lighten-2"
                    :error-messages="getViewMessageErrorsField('cantidad_couta_mensual')" clearable />

                <v-text-field v-model="props.item_detalle_contrato_prop.lugar_firma_contrato"
                    label="Lugar de firma de contrato" class="m-1" style="width: 300px;" color="deep-purple-lighten-2"
                    :error-messages="getViewMessageErrorsField('lugar_firma_contrato')" clearable />
            </div>

        </div>

        <div class="is-flex  is-justify-content-end p-2" style="width: 100%;">
            <div class="m-1">
                <v-btn variant="outlined" color="deep-purple-lighten-2" @click="save()" class="as-hover__box-shadow">
                    <v-icon icon="mdi-content-save-all"></v-icon>&nbsp;Guardar
                </v-btn>
            </div>
        </div>

    </div>

    <v-snackbar v-model="snackbar_message_response.value" :timeout="2000" :color="snackbar_message_response.color"
        location="top right" rounded="pill">
        <div class="is-flex is-justify-content-center is-align-items-center">
            <v-icon :icon="snackbar_message_response.icon" size="40" />
            <p class="is-size-6">{{ snackbar_message_response.text }}</p>
        </div>
    </v-snackbar>
</template>


<script setup>
import Contrato from '@/services/Contrato';
import { computed, ref } from 'vue';
import app from "@/config/app.js";

//props
const props = defineProps(['item_contrato_prop', 'item_detalle_contrato_prop', 'city_prop']);
//emits
const emit = defineEmits(['newFormEmit'])
//emits events
const newFormChild = () => {
    emit('newFormEmit');
}
//data
const snackbar_message_response = ref({ value: false, text: "", color: "", icon: "" })
const loading_search_cliente = ref(null);
const message_errors_field = ref({});

const ci_cliente = ref("");


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
    return `${props.item_contrato_prop.nombres} ${props.item_contrato_prop.apellido_paterno} ${props.item_contrato_prop.apellido_materno}`;
});



const searchCliente = () => {

    loading_search_cliente.value = 'deep-purple-lighten-2';
    setTimeout(async () => {
        const contrato = new Contrato(props.city_prop);
        const response = await contrato.buscarCliente(ci_cliente.value);
        loading_search_cliente.value = null;
        if (response.status) {
            props.item_contrato_prop.id_cliente = response.record.id;
            props.item_contrato_prop.nombres = response.record.nombres;
            props.item_contrato_prop.apellido_paterno = response.record.apellido_paterno;
            props.item_contrato_prop.apellido_materno = response.record.apellido_materno;
            ci_cliente.value = "";
            viewSnackbar('success', response.message);
        } else {
            viewSnackbar('error', response.message);
        }
    }, 1000);

}

const viewSnackbar = (type, message) => {
    if (type == 'success') {
        snackbar_message_response.value.color = 'deep-purple-lighten-2';
        snackbar_message_response.value.icon = 'mdi-database-check-outline';
    } else {
        snackbar_message_response.value.color = 'red';
        snackbar_message_response.value.icon = 'mdi-alert-box-outline';
    }
    snackbar_message_response.value.value = true;
    snackbar_message_response.value.text = message;
}

const descargarPDF = (archivo_url) => {
    // Crear un enlace temporal y simular el clic para la descarga
    const link = document.createElement('a');
    link.href = archivo_url;
    //debemos parsear el numero de contrato porque tiene el formato '2023/0001_LP' 
    // no se puede guardar archivos con ese tipop de nombre entonces  obtenemos el nombre de este formato '2023_0001_LP'
    const str = props.item_contrato_prop.n_contrato;
    const n_contrato_parse = str.replace(/\//g, '_');
    link.download = `${n_contrato_parse}_${props.item_contrato_prop.nombres}-${props.item_contrato_prop.apellido_paterno}-${props.item_contrato_prop.apellido_materno}`;
    link.click();
    //abrir en una nueva pestaña
    //  window.open(archivo_url);
}

const save = async () => {

    const contrato = new Contrato(props.city_prop, props.item_contrato_prop, props.item_detalle_contrato_prop);

    if (contrato.getFill('contrato').id > 0) {
        //para editar registro
        const response = await contrato.update();
        if (response.status) {
            viewSnackbar('success', response.message);
            descargarPDF(app.BASE_URL + '/' + response.record.archivo_pdf)
            //actualizamos al nuevo path del archivo pdf.. para eliminarlo en el backend, al hacer un update por segunda
            //vez sin recargar los props.. en la misma ventana 
            props.item_contrato_prop.archivo_pdf = response.record.archivo_pdf;
            clearMessageField();
        } else {
            if (response.message_errors == undefined) {
                viewSnackbar('error', response.message);
            } else {
                message_errors_field.value = Object.assign({}, response.message_errors);
                viewSnackbar('error', response.message);
            }

        }
    } else {
        //para nuevo registro
        const response = await contrato.create();
        if (response.status) {
            viewSnackbar('success', response.message);
            //asginamos al props el nuevo n_contrato que fue generado, porque en la funciona descargarPDF se requiere
            //este prop  props.item_contrato_prop.n_contrato para parsear el n_contrato y poder descargarlo
            props.item_contrato_prop.n_contrato = response.record.n_contrato;
            descargarPDF(app.BASE_URL + '/' + response.record.archivo_pdf)
            newFormChild();
            clearMessageField();
        } else {
            if (response.message_errors == undefined) {
                viewSnackbar('error', response.message);
            } else {
                message_errors_field.value = Object.assign({}, response.message_errors);
                viewSnackbar('error', response.message);
            }

        }
    }

}

const clearMessageField = () => {
    message_errors_field.value = {};
}

</script>