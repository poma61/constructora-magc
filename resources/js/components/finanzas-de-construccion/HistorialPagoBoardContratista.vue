<template>
    <div class="m-1" style="width: 100%;">
        <nav class="breadcrumb is-medium" aria-label="breadcrumbs">
            <ul>
                <li>
                    <div class="has-text-info">
                        <span class="icon is-small">
                            <span class="mdi mdi-cash-100"></span>
                        </span>
                        <span>Historial de pago, contratista</span>
                    </div>
                </li>
            </ul>
        </nav>

        <div class="box p-1">
            <div class="table-container mt-2 mx-2">
                <table class="table  is-striped is-bordered">
                    <thead>
                        <th class="has-text-primary">N° contrato</th>
                        <th class="has-text-primary">Nombres, contratista</th>
                        <th class="has-text-primary">Apellido paterno, contratista</th>
                        <th class="has-text-primary">Apellido materno, contratista</th>
                    </thead>
                    <tbody>
                        <tr>
                            <th>{{ props.item_contratista_prop.n_contrato }}</th>
                            <th>{{ props.item_contratista_prop.nombres }}</th>
                            <th>{{ props.item_contratista_prop.apellido_paterno }}</th>
                            <th>{{ props.item_contratista_prop.apellido_materno }}</th>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="is-flex is-flex-wrap-wrap">
                <v-text-field v-model="item_historial_pago_contratista.monto" label="Monto" class="m-1"
                    color="cyan-darken-1" :error-messages="getViewMessageErrorsField('monto')" style="width: 300px;" />

                <v-text-field v-model="item_historial_pago_contratista.fecha_pago" label="Fecha pago" class="m-1"
                    color="cyan-darken-1" :error-messages="getViewMessageErrorsField('fecha_pago')" style="width: 300px;"
                    type="date" />

            </div>
            <div class="buttons m-1">
                <v-btn @click="save()" color="cyan-darken-1" class="as-hover__box-shadow m-1 outlined">
                    <span class="mdi mdi-note-plus-outline is-size-5"></span>&nbsp;Registrar pago
                </v-btn>
            </div>
        </div>

        <div class="box p-0 m-1">
            <v-text-field v-model="buscar_data_table" append-inner-icon="mdi-magnify" clearable label="Buscar Registros..."
                color="cyan-darken-1" />
            <v-data-table :hover="true" :items="data" :headers="columns" :search="buscar_data_table"
                :loading="loading_data_table" :items-per-page-options="items_per_page_options" :show-current-page="true"
                :fixed-header="true" :height="400" :sort-by="[{ key: 'id', order: 'desc' }]">

                <template v-slot:item.fecha_pago="{ item }">
                    <span class="tag is-rounded has-background-grey-light as-font-9 m-1">
                        {{ date_format.formatDate(item.columns.fecha_pago) }}
                    </span>
                </template>


                <template v-slot:item.actions="{ item }">
                    <v-btn @click="editForm(item.raw)" color="cyan-darken-1" icon="mdi-pencil"
                        class="m-1 as-hover__box-shadow" />
                    <v-btn @click="openDeleteData(item.raw)" color="red" icon="mdi-delete"
                        class="m-1 as-hover__box-shadow" />
                </template>

            </v-data-table>
        </div>

    </div>

    <v-dialog v-model="dialog_delete" persistent max-width="500px">
        <div class="card">
            <div class="card-content">
                <div class="is-flex is-justify-content-center is-align-items-center is-flex-direction-column">
                    <span 
                        class="mdi mdi-file-question as-icon-7 has-text-danger animate__animated animate__wobble"></span>
                    <p class="is-size-5 has-text-centered">
                        ¿Esta seguro(a) de eliminar el registro seleccionado?
                    </p>
                </div>
            </div>

            <div class="is-flex  is-justify-content-center  is-align-items-center p-2" style="width: 100%;">
                <div class="m-1">
                    <v-btn color="cyan-darken-1" @click="confirmDeleteData()" class="m-1 as-hover__box-shadow" rounded="xl">
                        <span class="mdi mdi-content-save-all is-size-5"></span>&nbsp;Aceptar
                    </v-btn>
                </div>
                <div class="m-1">
                    <v-btn color="red" @click="closeDialogDelete()" class="m-1 as-hover__box-shadow" rounded="xl">
                        <span class="mdi mdi-cancel is-size-5"></span>&nbsp;Cancelar
                    </v-btn>
                </div>
            </div>

        </div>
    </v-dialog>

    <v-snackbar v-model="snackbar_message_response.active" :timeout="2000" :color="snackbar_message_response.color"
        location="top right" rounded="pill" min-height="70px">
        <div class="is-flex is-justify-content-center is-align-items-center">
            <span :class="snackbar_message_response.icon"  ></span>
            <p class="is-size-6">{{ snackbar_message_response.text }}</p>
        </div>
    </v-snackbar>
</template>


<script setup>
import { VDataTable } from 'vuetify/labs/VDataTable';
import { onMounted, ref } from 'vue';
import { computed } from 'vue';
import HistorialPagoContratista from '@/services/HistorialPagoContratista';
import DateFormat from '@/util/DateFormat';
//props
const props = defineProps(['city_prop', 'item_contratista_prop']);

//data
const data = ref([]);
const buscar_data_table = ref("");
const loading_data_table = ref(null);
const date_format = ref(new DateFormat());
const dialog_delete = ref(false);
const indice_data = ref(-1);
const message_errors_field = ref({});
const item_historial_pago_contratista = ref(new HistorialPagoContratista().getFill());
const snackbar_message_response = ref({ active: false, text: "", color: "", icon: "" })
const items_per_page_options = ref([
    { value: 10, title: '10' },
    { value: 25, title: '25' },
    { value: 50, title: '50' },
    { value: 100, title: '100' },
])
const columns = ref([
    { title: 'Monto', key: 'monto' },
    { title: 'Fecha pago', key: 'fecha_pago' },
    { title: 'Acciones', key: 'actions' },
])

//computed
const getViewMessageErrorsField = computed(() => {
    return function (property) {
        if (message_errors_field.value[property]) {
            return message_errors_field.value[property][0];
        }
        return "";
    }
})

const confirmDeleteData = async () => {
    const historial_pago_contratista = new HistorialPagoContratista(props.city_prop, item_historial_pago_contratista.value);
    const response = await historial_pago_contratista.destroy();
    if (response.status) {
        viewSnackbar('success', response.message);
        data.value.splice(indice_data.value, 1);
        newForm();
        closeDialogDelete();
    } else {
        viewSnackbar('error', response.message);
    }
}

const closeDialogDelete = () => {
    dialog_delete.value = false;
    newForm();
}

const openDeleteData = (item) => {
    indice_data.value = data.value.indexOf(item);
    item_historial_pago_contratista.value = Object.assign({}, item);
    dialog_delete.value = true;
}

const editForm = (item) => {
    indice_data.value = data.value.indexOf(item);
    item_historial_pago_contratista.value = Object.assign({}, item);
}

//methods
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

const save = async () => {
    item_historial_pago_contratista.value.id_contratista = props.item_contratista_prop.id;
    const historial_pago_contratista = new HistorialPagoContratista(props.city_prop, item_historial_pago_contratista.value);

    if (historial_pago_contratista.getFill().id > 0) {
        //para editar el registro
        const response = await historial_pago_contratista.update();
        if (response.status) {
            viewSnackbar('success', response.message);
            Object.assign(data.value[indice_data.value], historial_pago_contratista.getFill());
            newForm();
        } else {
            if (response.message_errors != undefined) {
                message_errors_field.value = response.message_errors;
            }
            viewSnackbar('error', response.message);
        }

    } else {
        //para nuevo registro
        const response = await historial_pago_contratista.create();
        if (response.status) {
            viewSnackbar('success', response.message);
            data.value.push(historial_pago_contratista.getFill());
            newForm();
        } else {
            if (response.message_errors != undefined) {
                message_errors_field.value = response.message_errors;
            }
            viewSnackbar('error', response.message);
        }

    }

}

const newForm = () => {
    message_errors_field.value = {};
    indice_data.value = -1;
    item_historial_pago_contratista.value = new HistorialPagoContratista().getFill();
};

const initData = () => {
    loading_data_table.value = "cyan-darken-1";
    setTimeout(async () => {
        const historial_pago_contratista = new HistorialPagoContratista(props.city_prop);
        const response = await historial_pago_contratista.index(props.item_contratista_prop.id);
        loading_data_table.value = null;
        if (response.status) {
            data.value = response.records;
            viewSnackbar('success', response.message);
        } else {
            viewSnackbar('error', response.message);
        }

    }, 800);
}

onMounted(() => {
    initData();
});

</script>