<template>
    <div class="buttons">
        <v-btn @click="showDataTable()" color="deep-purple-lighten-2" class="as-hover__box-shadow m-1"
            :variant="show_data_table == true ? 'outlined' : undefined">
            <span class="mdi mdi-note-plus-outline is-size-5"></span>&nbsp;Ver tablero
        </v-btn>


        <v-btn @click="newForm()" color="deep-purple-lighten-2" class="as-hover__box-shadow m-1 outlined"
            :variant="show_form == true ? 'outlined' : undefined" v-if="!edit_form">
            <span class="mdi mdi-note-plus-outline is-size-5"></span>&nbsp;Nuevo contrato
        </v-btn>

    </div>
    <!-- meses -->
    <div v-if="show_data_table" class="my-4">
        <nav class="breadcrumb is-medium" aria-label="breadcrumbs">
            <ul>
                <li>
                    <div class="has-text-info">
                        <span class="icon is-small">
                            <span class="mdi mdi-calendar-clock"></span>
                        </span>
                        <span>Fechas de firma de contrato</span>
                    </div>
                </li>
            </ul>
        </nav>

        <div class="buttons">
            <div class="control has-icons-left">
                <div class="select is-primary">
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
                    <span class="mdi mdi-calendar-cursor has-text-primary is-size-5"></span>
                </div>
            </div>
        </div>

        <div class="buttons">
            <button @click="selectMont('todos')" :class="['button is-primary', { 'is-light': month == 'todos' }]">
                <span class="mdi mdi-calendar-check-outline is-size-5"></span>&nbsp;Todos
            </button>

            <button @click="selectMont('enero')" :class="['button is-primary', { 'is-light': month == 'enero' }]">
                <span class="mdi mdi-calendar-check-outline is-size-5"></span>&nbsp;Enero
            </button>

            <button @click="selectMont('febrero')" :class="['button is-primary', { 'is-light': month == 'febrero' }]">
                <span class="mdi mdi-calendar-check-outline is-size-5"></span>&nbsp;Febrero
            </button>

            <button @click="selectMont('marzo')" :class="['button is-primary', { 'is-light': month == 'marzo' }]">
                <span class="mdi mdi-calendar-check-outline is-size-5"></span>&nbsp;Marzo
            </button>

            <button @click="selectMont('abril')" :class="['button is-primary', { 'is-light': month == 'abril' }]">
                <span class="mdi mdi-calendar-check-outline is-size-5"></span>&nbsp;Abril
            </button>

            <button @click="selectMont('mayo')" :class="['button is-primary', { 'is-light': month == 'mayo' }]">
                <span class="mdi mdi-calendar-check-outline is-size-5"></span>&nbsp;Mayo
            </button>

            <button @click="selectMont('junio')" :class="['button is-primary', { 'is-light': month == 'junio' }]">
                <span class="mdi mdi-calendar-check-outline is-size-5"></span>&nbsp;Junio
            </button>

            <button @click="selectMont('julio')" :class="['button is-primary', { 'is-light': month == 'julio' }]">
                <span class="mdi mdi-calendar-check-outline is-size-5"></span>&nbsp;Julio
            </button>


            <button @click="selectMont('agosto')" :class="['button is-primary', { 'is-light': month == 'agosto' }]">
                <span class="mdi mdi-calendar-check-outline is-size-5"></span>&nbsp;Agosto
            </button>


            <button @click="selectMont('septiembre')" :class="['button is-primary', { 'is-light': month == 'septiembre' }]">
                <span class="mdi mdi-calendar-check-outline is-size-5"></span>&nbsp;Septiembre
            </button>


            <button @click="selectMont('octubre')" :class="['button is-primary', { 'is-light': month == 'octubre' }]">
                <span class="mdi mdi-calendar-check-outline is-size-5"></span>&nbsp;Octubre
            </button>


            <button @click="selectMont('noviembre')" :class="['button is-primary', { 'is-light': month == 'noviembre' }]">
                <span class="mdi mdi-calendar-check-outline is-size-5"></span>&nbsp;Noviembre
            </button>


            <button @click="selectMont('diciembre')" :class="['button is-primary', { 'is-light': month == 'diciembre' }]">
                <span class="mdi mdi-calendar-check-outline is-size-5"></span>&nbsp;Diciembre
            </button>

        </div>

        <div class="buttons">
            <v-btn @click="generateReportExcel()" color="deep-purple-lighten-2" class="m-1 as-hover__box-shadow">
                <span class="mdi mdi-file-document-multiple-outline is-size-5"></span>&nbsp;Reporte excel
            </v-btn>
        </div>
        <!-- table -->
        <div class="box p-0">
            <v-text-field v-model="buscar" append-inner-icon="mdi-magnify" clearable label="Buscar Registros..."
                color="deep-purple-lighten-2" />
            <v-data-table :hover="true" :items="data" :headers="columns" :search="buscar" :loading="loading_data_table"
                :items-per-page-options="items_per_page_options" :show-current-page="true" :fixed-header="true"
                :height="500" :sort-by="[{ key: 'id', order: 'desc' }]" locale="es">

                <template v-slot:item.fecha_firma_contrato="{ item }">
                    <span class="tag is-rounded is-info as-font-9 m-1">
                        {{ date_format.formatDate(item.columns.fecha_firma_contrato) }}
                    </span>
                </template>

                <template v-slot:item.fecha_pago_couta_mensual="{ item }">
                    <span class="tag is-rounded is-warning as-font-9 m-1">
                        {{ date_format.formatDate(item.columns.fecha_pago_couta_mensual) }}
                    </span>
                </template>

                <template v-slot:item.archivo_pdf="{ item }">
                    <v-btn @click="viewPDF(item.raw)" color="yellow-darken-3" icon="mdi-file-account-outline"
                        class="m-1 as-hover__box-shadow"  />
                </template>


                <template v-slot:item.actions="{ item }">
                    <div style="width: 150px;">
                        <v-btn @click="editForm(item.raw)" color="deep-purple-lighten-2" icon="mdi-pencil"
                            class="m-1 as-hover__box-shadow" />
                        <v-btn @click="openDeleteData(item.raw)" color="red" icon="mdi-delete"
                            class="m-1 as-hover__box-shadow"  />
                    </div>
                </template>

            </v-data-table>
        </div>
    </div>
    <FormBoardContrato v-if="show_form" :item_contrato_prop="item_contrato"
        :item_detalle_contrato_prop="item_detalle_contrato" :city_prop="city" @newFormEmit="newForm()" />


    <v-dialog v-model="dialog_delete" persistent transition="dialog-bottom-transition" max-width="500px">
        <div class="card">
            <div class="card-content">
                <div class="is-flex is-justify-content-center is-align-items-center is-flex-direction-column">
                    <span class="mdi mdi-file-question as-icon-7 has-text-danger animate__animated animate__flip"></span>
                    <p class="is-size-5 has-text-centered">
                        ¿Esta seguro(a) de eliminar el registro seleccionado?
                    </p>
                </div>
            </div>

            <div class="is-flex  is-justify-content-center  is-align-items-center p-2" style="width: 100%;">
                <div class="m-1">
                    <v-btn color="deep-purple-lighten-2" @click="confirmDeleteData()" class="m-1 as-hover__box-shadow"
                        variant="outlined">
                        <span class="mdi mdi-content-save-all is-size-5"></span>&nbsp;Aceptar
                    </v-btn>
                </div>
                <div class="m-1">
                    <v-btn color="red" @click="closeDialogDelete()" class="m-1 as-hover__box-shadow" variant="outlined">
                        <span class="mdi mdi-cancel is-size-5"></span>&nbsp;Cancelar
                    </v-btn>
                </div>
            </div>

        </div>
    </v-dialog>

    <v-dialog v-model="dialog_pdf" persistent transition="dialog-bottom-transition" max-width="950px">
        <div class="card">
            <div class="card-content" style="max-height: 85vh; overflow:auto">
                <embed :src="contrato_pdf_url" width="890px" height="890px" type="application/pdf"
                    style=" user-select: none;">
            </div>
            <div class="is-flex  is-justify-content-end  is-align-items-center p-2" style="width: 100%;">
                <div class="m-1">
                    <v-btn color="yellow-darken-3" @click="closeDialogPDF()" class="m-1 as-hover__box-shadow"
                        variant="outlined">
                        <span class="mdi mdi-content-save-all is-size-5"></span>&nbsp;Aceptar
                    </v-btn>
                </div>
            </div>
        </div>
    </v-dialog>

    <v-snackbar v-model="snackbar_message_response.value" :timeout="2000" :color="snackbar_message_response.color"
        location="top right"  min-height="70px">
        <div class="is-flex is-justify-content-center is-align-items-center">
            <span :class="snackbar_message_response.icon"></span>
            <p class="is-size-6">{{ snackbar_message_response.text }}</p>
        </div>
    </v-snackbar>
</template>

<script setup>
import { VDataTable } from 'vuetify/labs/VDataTable';
import FormBoardContrato from '@/components/contrato/FormBoardContrato.vue';
import { ref } from 'vue';
import { onMounted } from 'vue';
import Contrato from '@/services/Contrato';
import DateFormat from '@/util/DateFormat';
import app from "@/config/app.js";
import fileDownload from 'js-file-download';

//data
const data = ref([]);
const buscar = ref("");
const loading_data_table = ref(null);
const show_form = ref(false);
const show_data_table = ref(true);
const item_contrato = ref({});
const item_detalle_contrato = ref({});
const city = ref("");
const select_year = ref(new Date().getFullYear());
const month = ref("todos");
const date_format = ref(new DateFormat());
const dialog_delete = ref(false);
const index_array = ref(-1);
const edit_form = ref(false);
const dialog_pdf = ref(false);
const contrato_pdf_url = ref("");

const snackbar_message_response = ref({ value: false, text: "", color: "", icon: "" })
const items_per_page_options = ref([
    { value: 10, title: '10' },
    { value: 25, title: '25' },
    { value: 50, title: '50' },
    { value: 100, title: '100' },
]);
const columns = ref([
    { title: 'Nombres cliente', key: 'name', value: (item) => { return ` ${item.nombres} ${item.apellido_materno} ${item.apellido_paterno}` } },
    { title: 'N° de contrato', key: 'n_contrato' },
    { title: 'Fecha de firma', key: 'fecha_firma_contrato' },
    { title: 'Monto total', key: 'monto_total_construccion' },
    { title: 'Couta inicial', key: 'couta_inicial' },
    { title: 'Couta mensual', key: 'couta_mensual' },
    { title: 'Fecha de pago couta mensual', key: 'fecha_pago_couta_mensual' },
    { title: 'Descripcion', key: 'descripcion' },
    { title: 'Contrato PDF', key: 'archivo_pdf' },
    { title: 'Acciones', key: 'actions' },
]);

//methods
const viewSnackbar = (type, message) => {
    if (type == 'success') {
        snackbar_message_response.value.color = 'deep-purple-lighten-2';
        snackbar_message_response.value.icon = 'mdi mdi-database-check-outline is-size-1';
    } else {
        snackbar_message_response.value.color = 'red';
        snackbar_message_response.value.icon = 'mdi mdi-alert-box-outline is-size-1';
    }
    snackbar_message_response.value.value = true;
    snackbar_message_response.value.text = message;
}
const selectMont = (mes) => {
    month.value = mes;
    initData();
}

const resetTo = () => {
    index_array.value = -1;
    edit_form.value = false;
    item_contrato.value = {};
    item_detalle_contrato.value = {};
}

const urlParams = () => {
    const parse_url = new URL(window.location.href);
    city.value = parse_url.pathname.split('/').pop();
}

const newForm = () => {
    const contrato = new Contrato();
    const cliente = {
        nombres: "",
        apellido_paterno: "",
        apellido_materno: ""
    }
    item_contrato.value = Object.assign({ ...cliente }, contrato.getFill('contrato'));
    item_detalle_contrato.value = Object.assign({}, contrato.getFill('detalle_contrato'));
    showForm();
}
const editForm = async (item) => {
    index_array.value = data.value.indexOf(item);
    item_contrato.value = Object.assign({}, item);
    edit_form.value = true
    const detalle_contrato = new Contrato();
    const response = await detalle_contrato.byIdDetalleContrato(item_contrato.value.id);
    if (response.status) {
        item_detalle_contrato.value = Object.assign({}, response.record);
        showForm();
    } else {
        viewSnackbar('error', response.message);
    }
}

const openDeleteData = (item) => {
    index_array.value = data.value.indexOf(item);
    item_contrato.value = Object.assign({}, item);
    dialog_delete.value = true;

}

const viewPDF = (item) => {
    dialog_pdf.value = true;
    contrato_pdf_url.value = `${app.BASE_URL}/${item.archivo_pdf}`;
}

const closeDialogPDF = () => {
    dialog_pdf.value = false;
    //para evitar que el contenido se distorcione cuando no haya archivo
    // al cerrar el dialog
    setTimeout(() => {
        contrato_pdf_url.value = "";
    }, 300)
};

const confirmDeleteData = async () => {
    const contrato = new Contrato();
    contrato.setCity(city.value);
    contrato.setFill('contrato', item_contrato.value);
    const response = await contrato.destroy();
    if (response.status) {
        data.value.splice(index_array.value, 1)
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

const showForm = () => {
    show_form.value = true;
    show_data_table.value = false;
}

const showDataTable = () => {
    show_data_table.value = true;
    show_form.value = false;
    resetTo();
    initData();
}

const initData = () => {
    loading_data_table.value = 'deep-purple-lighten-2';
    setTimeout(async () => {
        const contrato = new Contrato(city.value);
        const response = await contrato.index(select_year.value, month.value);
        loading_data_table.value = null;
        if (response.status) {
            data.value = response.records;
            viewSnackbar('success', 'OK');
        } else {
            viewSnackbar('error', response.message);
        }

    }, 800);

}

const generateReportExcel = async () => {
    const contrato = new Contrato(city.value);
    const response = await contrato.generateExcel(select_year.value, month.value);
    if (response.status == 200) {
        fileDownload(response.data, `${city.value}-${month.value}-${select_year.value}-contrato.xlsx`);
        viewSnackbar('success', 'Archivo excel generado!');
    } else {
        viewSnackbar('error', response.message)
    }
}

onMounted(() => {
    urlParams();
    showDataTable();
});

</script>

