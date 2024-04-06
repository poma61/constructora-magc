<template>
    <div v-if="component_data_table">
        <div class="buttons">
            <v-btn @click="newForm()" color="indigo-lighten-1" class="as-hover__box-shadow m-1 outlined"
                :disabled="month == 'todos' ? false : true">
                <span class="mdi mdi-note-plus-outline is-size-5"></span>&nbsp;Nuevo diseño
            </v-btn>
        </div>

        <nav class="breadcrumb" aria-label="breadcrumbs">
            <ul>
                <li>
                    <div class="has-text-info">
                        <span class="icon is-small">
                            <span class="mdi mdi-calendar-clock"></span>
                        </span>
                        <span>Fecha</span>
                    </div>
                </li>
            </ul>
        </nav>

        <div class="buttons">
            <div class="control has-icons-left">
                <div class="select is-info">
                    <select v-model="select_year" @click="initData()">
                        <option value="2015">2015</option>
                        <option value="2016">2016</option>
                        <option value="2017">2017</option>
                        <option value="2018">2018</option>
                        <option value="2019">2019</option>
                        <option value="2020">2020</option>
                        <option value="2021">2021</option>
                        <option value="2022">2022</option>
                        <option value="2023">2023</option>
                        <option value="2024">2024</option>
                        <option value="2025">2025</option>
                        <option value="2026">2026</option>
                        <option value="2027">2027</option>
                        <option value="2028">2028</option>
                        <option value="2029">2029</option>
                        <option value="2030">2030</option>
                        <option value="2031">2031</option>
                        <option value="2032">2032</option>
                        <option value="2033">2033</option>
                    </select>
                </div>
                <div class="icon is-small is-left">
                    <span class="mdi mdi-calendar-cursor has-text-info is-size-5"></span>
                </div>
            </div>
        </div>

        <div class="buttons">
            <button @click="selectMont('todos')" :class="['button is-info', { 'is-light': month == 'todos' }]">
                <span class="mdi mdi-calendar-check-outline is-size-5"></span>&nbsp;Todos
            </button>

            <button @click="selectMont('enero')" :class="['button is-info', { 'is-light': month == 'enero' }]">
                <span class="mdi mdi-calendar-check-outline is-size-5"></span>&nbsp;Enero
            </button>

            <button @click="selectMont('febrero')" :class="['button is-info', { 'is-light': month == 'febrero' }]">
                <span class="mdi mdi-calendar-check-outline is-size-5"></span>&nbsp;Febrero
            </button>

            <button @click="selectMont('marzo')" :class="['button is-info', { 'is-light': month == 'marzo' }]">
                <span class="mdi mdi-calendar-check-outline is-size-5"></span>&nbsp;Marzo
            </button>

            <button @click="selectMont('abril')" :class="['button is-info', { 'is-light': month == 'abril' }]">
                <span class="mdi mdi-calendar-check-outline is-size-5"></span>&nbsp;Abril
            </button>

            <button @click="selectMont('mayo')" :class="['button is-info', { 'is-light': month == 'mayo' }]">
                <span class="mdi mdi-calendar-check-outline is-size-5"></span>&nbsp;Mayo
            </button>

            <button @click="selectMont('junio')" :class="['button is-info', { 'is-light': month == 'junio' }]">
                <span class="mdi mdi-calendar-check-outline is-size-5"></span>&nbsp;Junio
            </button>

            <button @click="selectMont('julio')" :class="['button is-info', { 'is-light': month == 'julio' }]">
                <span class="mdi mdi-calendar-check-outline is-size-5"></span>&nbsp;Julio
            </button>


            <button @click="selectMont('agosto')" :class="['button is-info', { 'is-light': month == 'agosto' }]">
                <span class="mdi mdi-calendar-check-outline is-size-5"></span>&nbsp;Agosto
            </button>


            <button @click="selectMont('septiembre')" :class="['button is-info', { 'is-light': month == 'septiembre' }]">
                <span class="mdi mdi-calendar-check-outline is-size-5"></span>&nbsp;Septiembre
            </button>


            <button @click="selectMont('octubre')" :class="['button is-info', { 'is-light': month == 'octubre' }]">
                <span class="mdi mdi-calendar-check-outline is-size-5"></span>&nbsp;Octubre
            </button>


            <button @click="selectMont('noviembre')" :class="['button is-info', { 'is-light': month == 'noviembre' }]">
                <span class="mdi mdi-calendar-check-outline is-size-5"></span>&nbsp;Noviembre
            </button>


            <button @click="selectMont('diciembre')" :class="['button is-info', { 'is-light': month == 'diciembre' }]">
                <span class="mdi mdi-calendar-check-outline is-size-5"></span>&nbsp;Diciembre
            </button>

        </div>

        <div class="buttons">
            <v-btn @click="generateReportExcel()" color="indigo-lighten-1" class="m-1 as-hover__box-shadow">
                <span class="mdi mdi-file-document-multiple-outline is-size-5"></span>&nbsp;Reporte excel
            </v-btn>
        </div>
        <!-- table -->
        <div class="box p-0">
            <v-text-field v-model="buscar_data_table" append-inner-icon="mdi-magnify" clearable label="Buscar Registros..."
                color="indigo-lighten-1" />
            <v-data-table :hover="true" :items="data" :headers="columns" :search="buscar_data_table"
                :loading="loading_data_table" :items-per-page-options="items_per_page_options" :show-current-page="true"
                :fixed-header="true" :height="500" :sort-by="[{ key: 'id', order: 'desc' }]">

                <template v-slot:item.fecha="{ item }">
                    <span class="tag is-rounded has-background-grey-light as-font-9 m-1">
                        {{ date_format.formatDate(item.columns.fecha) }}
                    </span>
                </template>

                <template v-slot:item.procesos="{ item }">
                    <v-btn @click="openProceso(item.raw)" color="green-darken-1" class="m-1 as-hover__box-shadow">
                        <span class="mdi mdi-chart-line is-size-5"></span>
                    </v-btn>
                </template>

                <template v-slot:item.estado="{ item }">
                    <v-btn @click="openEstado(item.raw)" color="cyan-darken-1" class="m-1 as-hover__box-shadow">
                        <span class="mdi mdi-list-status is-size-5"></span>
                    </v-btn>
                </template>

                <template v-slot:item.revisiones="{ item }">
                    <v-btn @click="viewRevision(item.raw)" color="light-blue-darken-3" class="m-1 as-hover__box-shadow">
                        <span class="mdi mdi-text-box-check-outline is-size-5"></span>

                    </v-btn>
                </template>

                <template v-slot:item.modificaciones="{ item }">
                    <v-btn @click="viewModificacion(item.raw)" color="deep-purple-lighten-1"
                        class="m-1 as-hover__box-shadow">
                        <span class="mdi mdi-file-sign is-size-5"></span>
                    </v-btn>
                </template>

                <template v-slot:item.actions="{ item }">
                    <div style="width: 150px;">
                        <v-btn @click="editForm(item.raw)" color="indigo-lighten-1" class="m-1 as-hover__box-shadow">
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

    <!-- table -->

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
                    <v-btn color="indigo-lighten-1" @click="confirmDeleteData()" class="m-1 as-hover__box-shadow"
                        >
                        <span class="mdi mdi-content-save-all is-size-5"></span>&nbsp;Aceptar
                    </v-btn>
                </div>
                <div class="m-1">
                    <v-btn color="red" @click="closeDialogDelete()" class="m-1 as-hover__box-shadow">
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

    <FormBoardDisenio :item_disenio_prop="item_disenio" @closeFormEmit="closeForm" :dialog_form_prop="dialog_form"
        @refreshRowDataByFormEmit="refreshRowDataByForm" />

    <ProcesoBoardDisenio :item_proceso_disenio_prop="item_proceso_disenio" :item_disenio_prop="item_disenio"
        @saveByCloseProcesoEmit="saveByCloseProceso" :sheet_proceso_prop="sheet_proceso" />

    <EstadoBoardDisenio :item_estado_disenio_prop="item_estado_disenio" :item_disenio_prop="item_disenio"
        @saveByCloseEstadoEmit="saveByCloseEstado" :sheet_estado_prop="sheet_estado" />

    <RevisionBoardDisenio v-if="component_revision" :item_disenio_prop="item_disenio" @viewDataTableEmit="viewDataTable" />

    <ModificacionBoardDisenio v-if="component_modificacion" :item_disenio_prop="item_disenio"
        @viewDataTableEmit="viewDataTable" />

</template>

<script setup>
import { VDataTable } from 'vuetify/labs/VDataTable';
import FormBoardDisenio from '@/components/disenio/FormBoardDisenio.vue';
import ProcesoBoardDisenio from '@/components/disenio/ProcesoBoardDisenio.vue';
import EstadoBoardDisenio from '@/components/disenio/EstadoBoardDisenio.vue';
import RevisionBoardDisenio from '@/components/disenio/RevisionBoardDisenio.vue';
import ModificacionBoardDisenio from '@/components/disenio/ModificacionBoardDisenio.vue';
import { ref } from 'vue';
import { onMounted } from 'vue';
import Disenio from '@/services/Disenio';
import ProcesoDisenio from '@/services/ProcesoDisenio';
import EstadoDisenio from '@/services/EstadoDisenio';
import DateFormat from '@/util/DateFormat';
import fileDownload from 'js-file-download';


//data
const data = ref([]);
const buscar_data_table = ref("");
const loading_data_table = ref(null);
const item_disenio = ref({});
const item_proceso_disenio = ref({});
const item_estado_disenio = ref({});
const select_year = ref(new Date().getFullYear());
const month = ref("todos");
const date_format = ref(new DateFormat());
const dialog_delete = ref(false);
const indice_data = ref(-1);
const dialog_form = ref(false);
const sheet_proceso = ref(false);
const sheet_estado = ref(false);
const snackbar_message_response = ref({ active: false, text: "", color: "", icon: "" });
const component_revision = ref(false);
const component_modificacion = ref(false);
const component_data_table = ref(false);
const items_per_page_options = ref([
    { value: 10, title: '10' },
    { value: 25, title: '25' },
    { value: 50, title: '50' },
    { value: 100, title: '100' },
]);
const columns = ref([
    { title: 'Nombres', key: 'nombres' },
    { title: 'Apellido paterno', key: 'apellido_paterno' },
    { title: 'Apellido materno', key: 'apellido_materno' },
    { title: 'Requerimiento', key: 'requerimiento' },
    { title: 'Fecha', key: 'fecha' },
    { title: 'Arquitecto', key: 'arquitecto' },
    { title: 'Procesos', key: 'procesos', align: 'center' },
    { title: 'Estado', key: 'estado', align: 'center' },
    { title: 'Revisiones', key: 'revisiones', align: 'center' },
    { title: 'Modificiones', key: 'modificaciones', align: 'center' },
    { title: 'Acciones', key: 'actions', align: 'center' },
]);

//methods
const viewSnackbar = (type, message) => {
    if (type == 'success') {
        snackbar_message_response.value.color = 'indigo-lighten-1';
        snackbar_message_response.value.icon = 'mdi mdi-check-circle is-size-1';
    } else {
        snackbar_message_response.value.color = 'red';
        snackbar_message_response.value.icon = 'mdi mdi-alert-box-outline is-size-1';
    }
    snackbar_message_response.value.active = true;
    snackbar_message_response.value.text = message;
}


const selectMont = (mes) => {
    month.value = mes;
    initData();
}

const resetTo = () => {
    indice_data.value = -1;
    item_disenio.value = {};
    item_proceso_disenio.value = {};
    item_estado_disenio.value = {};
}

//proceso
const openProceso = async (is_disenio) => {
    const disenio = new ProcesoDisenio(is_disenio);
    const response = await disenio.indexShe();

    if (response.status) {
        disenio.setFillShe(Object.assign({}, response.records));
        item_proceso_disenio.value = disenio.getFillShe();
        item_disenio.value = is_disenio;
        sheet_proceso.value = true;
    } else {
        viewSnackbar('error', response.message);
    }

}

const saveByCloseProceso = async () => {
    const disenio = new ProcesoDisenio(item_disenio.value, item_proceso_disenio.value);
    const response = await disenio.refreshProcesoShe();
    if (response.status) {
        viewSnackbar('success', response.message);
    } else {
        viewSnackbar('error', response.message);
    }
    sheet_proceso.value = false;
    resetTo();
}

//estados
const openEstado = async (is_disenio) => {
    const disenio = new EstadoDisenio(is_disenio);
    const response = await disenio.indexShe();

    if (response.status) {
        if (response.records == null) {
            //response.records == null => significa que aun no hay un estado creado
            //para el diseño actual
            const codigo_generado = await generateNumCodigoEstado(is_disenio);
            if (codigo_generado != null) {
                disenio.setFillShe({ prefix_codigo: codigo_generado })
                item_estado_disenio.value = disenio.getFillShe();
                item_disenio.value = is_disenio;
                sheet_estado.value = true;
            }

        } else {
            disenio.setFillShe(Object.assign({}, response.records));
            item_estado_disenio.value = disenio.getFillShe();
            item_disenio.value = is_disenio;
            sheet_estado.value = true;
        }

    } else {
        viewSnackbar('error', response.message);
    }

}

const saveByCloseEstado = async () => {
    const disenio = new EstadoDisenio(item_disenio.value, item_estado_disenio.value);
    const response = await disenio.refreshEstadoShe();
    if (response.status) {
        viewSnackbar('success', response.message);
    } else {
        viewSnackbar('error', response.message);
    }
    sheet_estado.value = false;
    resetTo();
}

const generateNumCodigoEstado = async (as_disenio) => {
    const disenio = new EstadoDisenio(as_disenio);
    const response = await disenio.generateNumCodigoEstadoShe();
    if (response.status) {
        return response.record.prefix_codigo;

    } else {
        viewSnackbar('error', response.message);
        return null;
    }

}

//form
const newForm = () => {
    const disenio = new Disenio();
    item_disenio.value = Object.assign({
        nombres: "",
        apellido_paterno: "",
        apellido_materno: "",
    }, disenio.getFill());
    dialog_form.value = true;
}


const editForm = async (item) => {
    indice_data.value = data.value.indexOf(item);
    item_disenio.value = Object.assign({}, item);
    dialog_form.value = true;

}

const closeForm = () => {
    dialog_form.value = false;
    resetTo();
}

const refreshRowDataByForm = (type, item) => {
    switch (type) {
        case "add":
            //para un nuevo registro
            data.value.push(item);
            break;
        case "edit":
            //para modificar registro
            Object.assign(data.value[indice_data.value], item);
            break;
        default: break;
    }
}

//delete
const openDeleteData = (item) => {
    indice_data.value = data.value.indexOf(item);
    item_disenio.value = Object.assign({}, item);
    dialog_delete.value = true;
}
const confirmDeleteData = async () => {
    const disenio = new Disenio();
    disenio.setFill(item_disenio.value);
    const response = await disenio.destroy();
    if (response.status) {
        data.value.splice(indice_data.value, 1)
        viewSnackbar('success', response.message);
    } else {
        viewSnackbar('error', response.message);
    }
    closeDialogDelete();
}
const closeDialogDelete = () => {
    dialog_delete.value = false;
    resetTo();
}

//datatable
const initData = () => {
    loading_data_table.value = 'indigo-lighten-1';
    setTimeout(async () => {
        const disenio = new Disenio();
        const response = await disenio.index(select_year.value, month.value);
        loading_data_table.value = null;
        if (response.status) {
            data.value = response.records;
            viewSnackbar('success', 'OK');
        } else {
            viewSnackbar('error', response.message);
        }
    }, 800);
}
const viewDataTable = () => {
    component_data_table.value = true;
    component_revision.value = false;
    component_modificacion.value = false;
    resetTo();
}
const generateReportExcel = async () => {
    const disenio = new Disenio();
    const response = await disenio.generateExcel(select_year.value, month.value);
    if (response.status == 200) {
        fileDownload(response.data, `${month.value}-${select_year.value}-disenio.xlsx`);
        viewSnackbar('success', 'Archivo excel generado!');
    } else {
        viewSnackbar('error', response.message)
    }
}

//revision
const viewRevision = (item) => {
    item_disenio.value = Object.assign({}, item);
    component_revision.value = true;
    component_data_table.value = false;
}

//revision
const viewModificacion = (item) => {
    item_disenio.value = Object.assign({}, item);
    component_modificacion.value = true;
    component_data_table.value = false;
}


onMounted(() => {
    viewDataTable();
    initData();
});

</script>

