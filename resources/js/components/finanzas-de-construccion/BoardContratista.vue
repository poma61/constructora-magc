<template>
    <div v-if="component_data_table">
        <div class="buttons">
            <v-btn @click="newForm()" color="cyan-darken-1" class="as-hover__box-shadow m-1 outlined"
                :disabled="month == 'todos' ? false : true">
                <span class="mdi mdi-note-plus-outline is-size-5"></span>&nbsp;Nuevo contratista
            </v-btn>
        </div>


        <nav class="breadcrumb is-medium" aria-label="breadcrumbs">
            <ul>
                <li>
                    <div class="has-text-info">
                        <span class="icon is-small">
                            <span class="mdi mdi-calendar-clock"></span>
                        </span>
                        <span>Fechas de inicio</span>
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
            <v-btn @click="generateReportExcel()" color="cyan-darken-1" class="m-1 as-hover__box-shadow">
                <span class="mdi mdi-file-document-multiple-outline is-size-5"></span>&nbsp;Reporte excel
            </v-btn>
        </div>
        <!-- table -->
        <div class="box p-0">
            <v-text-field v-model="buscar_data_table" append-inner-icon="mdi-magnify" clearable label="Buscar Registros..."
                color="cyan-darken-1" />
            <v-data-table :hover="true" :items="data" :headers="columns" :search="buscar_data_table"
                :loading="loading_data_table" :items-per-page-options="items_per_page_options" :show-current-page="true"
                :fixed-header="true" :height="500" :sort-by="[{ key: 'id', order: 'desc' }]" locale="es">

                <template v-slot:item.fecha_inicio="{ item }">
                    <span class="tag is-rounded has-background-grey-light as-font-9 m-1">
                        {{ date_format.formatDate(item.columns.fecha_inicio) }}
                    </span>
                </template>

                <template v-slot:item.estado="{ item }">
                    <span class="tag is-rounded is-success as-font-9 m-1" v-if="item.columns.estado == 'En ejecucion'">
                        {{ item.columns.estado }}
                    </span>
                    <span class="tag is-rounded is-danger as-font-9 m-1" v-if="item.columns.estado == 'Paralizado'">
                        {{ item.columns.estado }}
                    </span>
                    <span class="tag is-rounded is-info as-font-9 m-1" v-if="item.columns.estado == 'Finalizado'">
                        {{ item.columns.estado }}
                    </span>

                </template>

                <template v-slot:item.add_pagos="{ item }">
                    <v-btn @click="historialPagos(item.raw)" color="yellow-darken-3" icon="mdi-cash-100"
                        class="m-1 as-hover__box-shadow" />
                </template>


                <template v-slot:item.actions="{ item }">
                    <div style="width: 150px;">
                        <v-btn @click="editForm(item.raw)" color="cyan-darken-1" icon="mdi-pencil"
                            class="m-1 as-hover__box-shadow"  variant="outlined"/>
                        <v-btn @click="openDeleteData(item.raw)" color="red" icon="mdi-delete"
                            class="m-1 as-hover__box-shadow"  variant="outlined"/>
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
            <span :class="snackbar_message_response.icon"></span>
            <p class="is-size-6">{{ snackbar_message_response.text }}</p>
        </div>
    </v-snackbar>

    <FormBoardContratista :item_contratista_prop="item_contratista" :city_prop="city" @closeFormEmit="closeForm"
        :dialog_form_prop="dialog_form" @refreshRowDataByFormEmit="refreshRowDataByForm" />

    <HistorialPagoBoardContratista v-if="component_historial_pago" :city_prop="city"
        :item_contratista_prop="item_contratista" />
</template>

<script setup>
import { VDataTable } from 'vuetify/labs/VDataTable';
import FormBoardContratista from '@/components/finanzas-de-construccion/FormBoardContratista.vue';
import HistorialPagoBoardContratista from '@/components/finanzas-de-construccion/HistorialPagoBoardContratista.vue';
import { ref } from 'vue';
import { onMounted } from 'vue';
import Contratista from '@/services/Contratista';
import DateFormat from '@/util/DateFormat';
import fileDownload from 'js-file-download';

//data
const data = ref([]);
const buscar_data_table = ref("");
const loading_data_table = ref(null);
const item_contratista = ref({});
const city = ref("");
const select_year = ref(new Date().getFullYear());
const month = ref("todos");
const date_format = ref(new DateFormat());
const dialog_delete = ref(false);
const indice_data = ref(-1);
const dialog_form = ref(false);
const snackbar_message_response = ref({ active: false, text: "", color: "", icon: "" });
const component_historial_pago = ref(false);
const component_data_table = ref(false);
const items_per_page_options = ref([
    { value: 10, title: '10' },
    { value: 25, title: '25' },
    { value: 50, title: '50' },
    { value: 100, title: '100' },
]);
const columns = ref([
    { title: 'Nombres, contratista', key: 'nombres' },
    { title: 'Apellido paterno, contratista', key: 'apellido_paterno' },
    { title: 'Apellido materno, contratista', key: 'apellido_materno' },
    { title: 'N° de contrato', key: 'n_contrato' },
    { title: 'Estado', key: 'estado' },
    { title: 'Monto', key: 'monto' },
    { title: 'Descripcion', key: 'descripcion' },
    { title: 'Fecha inicio', key: 'fecha_inicio' },
    { title: 'Historial pago', key: 'add_pagos' },
    { title: 'Acciones', key: 'actions' },
]);

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


const selectMont = (mes) => {
    month.value = mes;
    initData();
}

const resetTo = () => {
    indice_data.value = -1;
    item_contratista.value = {};
}

const urlParams = () => {
    const parse_url = new URL(window.location.href);
    city.value = parse_url.pathname.split('/').pop();
}

const newForm = () => {
    const contratista = new Contratista(city.value);
    item_contratista.value = Object.assign({ n_contrato: "" }, contratista.getFill());
    dialog_form.value = true;
}

const editForm = async (item) => {
    indice_data.value = data.value.indexOf(item);
    item_contratista.value = Object.assign({}, item);
    dialog_form.value = true;

}

const openDeleteData = (item) => {
    indice_data.value = data.value.indexOf(item);
    item_contratista.value = Object.assign({}, item);
    dialog_delete.value = true;
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


const confirmDeleteData = async () => {
    const contratista = new Contratista();
    contratista.setCity(city.value);
    contratista.setFill(item_contratista.value);
    const response = await contratista.destroy();
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

const initData = () => {
    loading_data_table.value = 'cyan-darken-1';
    setTimeout(async () => {
        const contratista = new Contratista(city.value);
        const response = await contratista.index(select_year.value, month.value);
        loading_data_table.value = null;
        if (response.status) {
            data.value = response.records;
            viewSnackbar('success', 'OK');
        } else {
            viewSnackbar('error', response.message);
        }
    }, 800);
}


const historialPagos = (item) => {
    item_contratista.value = Object.assign({}, item);
    viewHistorialPago();
}
const viewDataTable = () => {
    component_data_table.value = true;
    component_historial_pago.value = false;
    resetTo();
}
const viewHistorialPago = () => {
    component_historial_pago.value = true;
    component_data_table.value = false;
}

const generateReportExcel = async () => {
    const contratista = new Contratista(city.value);
    const response = await contratista.generateExcel(select_year.value, month.value);
    if (response.status == 200) {
        fileDownload(response.data, `${city.value}-${month.value}-${select_year.value}-contratista.xlsx`);
        viewSnackbar('success', 'Archivo excel generado!');
    } else {
        viewSnackbar('error', response.message)
    }
}

onMounted(() => {
    urlParams();
    viewDataTable();
    initData();
});

</script>

