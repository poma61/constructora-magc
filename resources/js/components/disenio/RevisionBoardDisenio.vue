<template>
    <div class="m-1" style="width: 100%;">
        <nav class="breadcrumb" aria-label="breadcrumbs">
            <ul>
                <li>
                    <div class="has-text-info">
                        <span class="icon is-small">
                            <span class="mdi mdi-text-box-check-outline"></span>
                        </span>
                        <span>Revision</span>
                    </div>
                </li>
            </ul>
        </nav>

        <div class="box p-1">
            <div class="table-container mt-2 mx-2">
                <table class="table  is-striped is-bordered">
                    <thead>
                        <th class="has-text-success">Nombres, cliente</th>
                        <th class="has-text-success">Apellido paterno, cliente</th>
                        <th class="has-text-success">Apellido materno, cliente</th>
                    </thead>
                    <tbody>
                        <tr>
                            <th>{{ props.item_disenio_prop.nombres }}</th>
                            <th>{{ props.item_disenio_prop.apellido_paterno }}</th>
                            <th>{{ props.item_disenio_prop.apellido_materno }}</th>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="is-flex is-flex-wrap-wrap">
                <v-text-field v-model="item_revision_disenio.fecha_rev_plano" label="Fecha revision plano" class="m-1"
                    color="indigo-lighten-1" :error-messages="getViewMessageErrorsField('fecha_rev_plano')"
                    style="width: 300px;" type="date" />

                <v-text-field v-model="item_revision_disenio.fecha_rev_3D" label="Fecha revision 3D" class="m-1"
                    color="indigo-lighten-1" :error-messages="getViewMessageErrorsField('fecha_rev_3D')" style="width: 300px;"
                    type="date" />

            </div>
            <div class="buttons m-1">
                <v-btn @click="viewDataTableChild()" color="indigo-lighten-1" class="as-hover__box-shadow m-1 outlined">
                    <span class="mdi mdi-table-of-contents is-size-5"></span>&nbsp;Ver tablero principal
                </v-btn>
                <v-btn @click="initData()" color="indigo-lighten-1" class="as-hover__box-shadow m-1 outlined" :loading="loading_refresh_data_table">
                    <span class="mdi mdi-refresh is-size-5"></span>&nbsp;Actualizar
                </v-btn>
                <v-btn @click="save()" color="indigo-lighten-1" class="as-hover__box-shadow m-1 outlined">
                    <span class="mdi mdi-content-save-all is-size-6"></span>&nbsp;Guardar revision
                </v-btn>
                
            </div>
        </div>

        <div class="box p-0 m-1">
            <v-text-field v-model="buscar_data_table" append-inner-icon="mdi-magnify" clearable label="Buscar Registros..."
                color="indigo-lighten-1" />
            <v-data-table :hover="true" :items="data" :headers="columns" :search="buscar_data_table"
                :loading="loading_data_table" :items-per-page-options="items_per_page_options" :show-current-page="true"
                :fixed-header="true" :height="400" :sort-by="[{ key: 'id', order: 'desc' }]">

                <template v-slot:item.fecha_rev_plano="{ item }">
                    <span class="tag has-background-info as-font-9 m-1">
                        {{ date_format.formatDate(item.columns.fecha_rev_plano) }}
                    </span>
                </template>

                <template v-slot:item.fecha_rev_3D="{ item }">
                    <span class="tag has-background-primary as-font-9 m-1">
                        {{ date_format.formatDate(item.columns.fecha_rev_3D) }}
                    </span>
                </template>


                <template v-slot:item.actions="{ item }">
                    <div style="width: 150px;">
                        <v-btn @click="editForm(item.raw)" color="indigo-lighten-1" 
                            class="m-1 as-hover__box-shadow">
                            <span class="mdi mdi-pencil is-size-5"></span>
                        </v-btn>

                        <v-btn @click="openDeleteData(item.raw)" color="red" class="m-1 as-hover__box-shadow">
                            <span class="mdi mdi-delete is-size-5"></span>
                        </v-btn>
                    </div>
                </template>

            </v-data-table>
        </div>

    </div>

    <v-dialog v-model="dialog_delete" persistent max-width="500px">
        <div class="card">
            <div class="card-content">
                <div class="is-flex is-justify-content-center is-align-items-center is-flex-direction-column">
                    <span class="mdi mdi-file-question as-icon-7 has-text-danger animate__animated animate__wobble"></span>
                    <p class="is-size-5 has-text-centered">
                        ¿Esta seguro(a) de eliminar el registro seleccionado?
                    </p>
                </div>
            </div>

            <div class="is-flex  is-justify-content-center  is-align-items-center p-2" style="width: 100%;">
                <div class="m-1">
                    <v-btn color="indigo-lighten-1" @click="confirmDeleteData()" class="m-1 as-hover__box-shadow" rounded="xl">
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
        location="bottom right" min-height="70px">
        <div class="is-flex is-justify-content-center is-align-items-center">
            <span :class="snackbar_message_response.icon"></span>
            <p class="is-size-6">{{ snackbar_message_response.text }}</p>
        </div>
    </v-snackbar>
</template>


<script setup>
import { VDataTable } from 'vuetify/labs/VDataTable';
import { onMounted, ref } from 'vue';
import { computed } from 'vue';
import RevisionDisenio from '@/services/RevisionDisenio';
import DateFormat from '@/util/DateFormat';
//props
const props = defineProps(['item_disenio_prop']);
const emits = defineEmits(['viewDataTableEmit']);

const viewDataTableChild = () => {
    emits('viewDataTableEmit');
}

//data
const data = ref([]);
const buscar_data_table = ref("");
const loading_data_table = ref(null);
const loading_refresh_data_table=ref(null);
const date_format = ref(new DateFormat());
const dialog_delete = ref(false);
const indice_data = ref(-1);
const message_errors_field = ref({});
const item_revision_disenio = ref(new RevisionDisenio().getFill());
const snackbar_message_response = ref({ active: false, text: "", color: "", icon: "" })
const items_per_page_options = ref([
    { value: 10, title: '10' },
    { value: 25, title: '25' },
    { value: 50, title: '50' },
    { value: 100, title: '100' },
])
const columns = ref([
    { title: 'Fecha revision plano', key: 'fecha_rev_plano' },
    { title: 'Fecha revision 3D', key: 'fecha_rev_3D' },
    { title: 'Acciones', key: 'actions', align: 'center' },
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
    const revision = new RevisionDisenio(props.item_disenio_prop, item_revision_disenio.value);
    const response = await revision.destroyShe();
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
    item_revision_disenio.value = Object.assign({}, item);
    dialog_delete.value = true;
}

const editForm = (item) => {
    indice_data.value = data.value.indexOf(item);
    item_revision_disenio.value = Object.assign({}, item);
}

//methods
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

const save = async () => {

    const revision = new RevisionDisenio(props.item_disenio_prop, item_revision_disenio.value);

    if (revision.getFillShe().id > 0) {
        //para editar el registro
        const response = await revision.updateShe();
        if (response.status) {
            viewSnackbar('success', response.message);
            Object.assign(data.value[indice_data.value], response.record);
            newForm();
        } else {
            if (response.message_errors != undefined) {
                message_errors_field.value = response.message_errors;
            }
            viewSnackbar('error', response.message);
        }

    } else {
        //para nuevo registro
        const response = await revision.createShe();
        if (response.status) {
            viewSnackbar('success', response.message);
            data.value.push(response.record);
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
    item_revision_disenio.value = new RevisionDisenio().getFillShe();
};

const initData = () => {
    loading_data_table.value = "indigo-lighten-1";
    loading_refresh_data_table.value="white"
    setTimeout(async () => {
        const revision = new RevisionDisenio(props.item_disenio_prop);
        const response = await revision.indexShe();
        loading_data_table.value = null;
        loading_refresh_data_table.value=null;

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