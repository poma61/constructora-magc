<template>
    <div class="buttons">
        <v-btn @click="newForm()" color="cyan-darken-1" class="as-hover__box-shadow m-1" rounded="xl"
            :disabled="month == 'todos' ? false : true">
            <span class="mdi mdi-note-plus-outline is-size-5"></span>&nbsp;Nuevo registro
        </v-btn>
    </div>

    <nav class="breadcrumb" aria-label="breadcrumbs">
        <ul>
            <li>
                <div class="has-text-info">
                    <span class="icon is-small">
                        <span class="mdi mdi-calendar-clock"></span>
                    </span>
                    <span>Fechas de ingreso</span>
                </div>
            </li>
        </ul>
    </nav>

    <div class="buttons">
        <div class="control has-icons-left">
            <div class="select is-success is-rounded">
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
                <span class="mdi mdi-calendar-cursor has-text-black is-size-5"></span>
            </div>
        </div>
    </div>

    <div class="buttons">
        <button @click="selectMont('todos')" :class="['button is-success is-rounded', { 'is-light': month == 'todos' }]">
            <span class="mdi mdi-calendar-check-outline is-size-5"></span>&nbsp;Todos
        </button>

        <button @click="selectMont('enero')" :class="['button is-success is-rounded', { 'is-light': month == 'enero' }]">
            <span class="mdi mdi-calendar-check-outline is-size-5"></span>&nbsp;Enero
        </button>

        <button @click="selectMont('febrero')"
            :class="['button is-success is-rounded', { 'is-light': month == 'febrero' }]">
            <span class="mdi mdi-calendar-check-outline is-size-5"></span>&nbsp;Febrero
        </button>

        <button @click="selectMont('marzo')" :class="['button is-success is-rounded', { 'is-light': month == 'marzo' }]">
            <span class="mdi mdi-calendar-check-outline is-size-5"></span>&nbsp;Marzo
        </button>

        <button @click="selectMont('abril')" :class="['button is-success is-rounded', { 'is-light': month == 'abril' }]">
            <span class="mdi mdi-calendar-check-outline is-size-5"></span>&nbsp;Abril
        </button>

        <button @click="selectMont('mayo')" :class="['button is-success is-rounded', { 'is-light': month == 'mayo' }]">
            <span class="mdi mdi-calendar-check-outline is-size-5"></span>&nbsp;Mayo
        </button>

        <button @click="selectMont('junio')" :class="['button is-success is-rounded', { 'is-light': month == 'junio' }]">
            <span class="mdi mdi-calendar-check-outline is-size-5"></span>&nbsp;Junio
        </button>

        <button @click="selectMont('julio')" :class="['button is-success is-rounded', { 'is-light': month == 'julio' }]">
            <span class="mdi mdi-calendar-check-outline is-size-5"></span>&nbsp;Julio
        </button>


        <button @click="selectMont('agosto')" :class="['button is-success is-rounded', { 'is-light': month == 'agosto' }]">
            <span class="mdi mdi-calendar-check-outline is-size-5"></span>&nbsp;Agosto
        </button>


        <button @click="selectMont('septiembre')"
            :class="['button is-success is-rounded', { 'is-light': month == 'septiembre' }]">
            <span class="mdi mdi-calendar-check-outline is-size-5"></span>&nbsp;Septiembre
        </button>


        <button @click="selectMont('octubre')"
            :class="['button is-success is-rounded', { 'is-light': month == 'octubre' }]">
            <span class="mdi mdi-calendar-check-outline is-size-5"></span>&nbsp;Octubre
        </button>


        <button @click="selectMont('noviembre')"
            :class="['button is-success is-rounded', { 'is-light': month == 'noviembre' }]">
            <span class="mdi mdi-calendar-check-outline is-size-5"></span>&nbsp;Noviembre
        </button>


        <button @click="selectMont('diciembre')"
            :class="['button is-success is-rounded', { 'is-light': month == 'diciembre' }]">
            <span class="mdi mdi-calendar-check-outline is-size-5"></span>&nbsp;Diciembre
        </button>

    </div>

    <div class="buttons">
        <v-btn @click="generateReportExcel()" color="cyan-darken-1" class="m-1 as-hover__box-shadow" rounded="xl">
            <span class="mdi mdi-file-document-multiple-outline is-size-5"></span>&nbsp;Reporte excel
        </v-btn>
    </div>

    <!-- table -->
    <div class="box p-0">
        <v-text-field v-model="buscar_data_table" append-inner-icon="mdi-magnify" clearable label="Buscar Registros..."
            color="cyan-darken-1" />
        <v-data-table :hover="true" :items="data" :headers="columns" :search="buscar_data_table"
            :loading="loading_data_table" :items-per-page-options="items_per_page_options" :show-current-page="true"
            :fixed-header="true" :height="600" :sort-by="[{ key: 'id', order: 'desc' }]">

            <template v-slot:item.estado="{ item }">
                <span class="tag is-success as-font-9 m-1" v-if="item.columns.estado == 'En ejecucion'">
                    {{ item.columns.estado }}
                </span>
                <span class="tag is-danger as-font-9 m-1" v-if="item.columns.estado == 'Paralizado'">
                    {{ item.columns.estado }}
                </span>
                <span class="tag is-info as-font-9 m-1" v-if="item.columns.estado == 'Finalizado'">
                    {{ item.columns.estado }}
                </span>

            </template>


            <template v-slot:item.fecha_inicio="{ item }">
                <span class="tag is-warning is-rounded as-font-9 m-1">
                    {{ date_format.formatDate(item.columns.fecha_inicio) }}
                </span>
            </template>

            <template v-slot:item.fecha_finalizacion="{ item }">
                <span class="tag is-primary is-rounded as-font-9 m-1">
                    {{ date_format.formatDate(item.columns.fecha_finalizacion) }}
                </span>
            </template>

            <template v-slot:item.actions="{ item }">
                <div style="width: 150px;">
                    <v-btn @click="editForm(item.raw)" color="cyan-darken-1" class="m-1 as-hover__box-shadow" variant="outlined">
                        <span class="mdi mdi-pencil is-size-5"></span>
                    </v-btn>
                    <v-btn @click="openDeleteData(item.raw)" color="red" class="m-1 as-hover__box-shadow"  variant="outlined">
                        <span class="mdi mdi-delete is-size-5"></span>
                    </v-btn>
                </div>
            </template>

        </v-data-table>
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
        location="bottom right" rounded="pill" min-height="70px">
        <div class="is-flex is-justify-content-center is-align-items-center">
            <span :class="snackbar_message_response.icon"></span>
            <p class="is-size-6">{{ snackbar_message_response.text }}</p>
        </div>
    </v-snackbar>

    <FormBoardObra :item_obra_prop="item_obra" :city_prop="city" @closeFormEmit="closeForm" :dialog_form_prop="dialog_form"
        @refreshRowDataByFormEmit="refreshRowDataByForm" />
</template>

<script setup>
import { VDataTable } from 'vuetify/labs/VDataTable';
import FormBoardObra from '@/components/control-de-obra/FormBoardObra.vue';
import { ref } from 'vue';
import { onMounted } from 'vue';
import Obra from '@/services/Obra';
import DateFormat from '@/util/DateFormat';
import fileDownload from 'js-file-download';

//data
const data = ref([]);
const buscar_data_table = ref("");
const loading_data_table = ref(null);
const item_obra = ref({});
const city = ref("");
const select_year = ref(new Date().getFullYear());
const month = ref("todos");
const date_format = ref(new DateFormat());
const dialog_delete = ref(false);
const indice_data = ref(-1);
const dialog_form = ref(false);
const snackbar_message_response = ref({ active: false, text: "", color: "", icon: "" });
const items_per_page_options = ref([
    { value: 10, title: '10' },
    { value: 25, title: '25' },
    { value: 50, title: '50' },
]);
const columns = ref([
    { title: 'Nombres, cliente', key: 'nombres' },
    { title: 'Apellido paterno, cliente', key: 'apellido_paterno' },
    { title: 'Apellido materno, cliente', key: 'apellido_materno' },
    { title: 'N° contrato', key: 'n_contrato' },
    { title: 'Estado', key: 'estado' },
    { title: 'Fecha inicio', key: 'fecha_inicio' },
    { title: 'Fecha finalizacion', key: 'fecha_finalizacion' },
    { title: 'Monto pago contratista', key: 'monto_pago_contratista' },
    { title: 'Descripcion', key: 'descripcion' },
    { title: 'Acciones', key: 'actions', align: 'center' },
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
    item_obra.value = {};
}

const urlParams = () => {
    const parse_url = new URL(window.location.href);
    city.value = parse_url.pathname.split('/').pop();
}

const newForm = () => {
    const obra = new Obra();
    item_obra.value = Object.assign({
        n_contrato: "",
        nombres: "",
        apellido_paterno: "",
        apellido_materno: "",
    }, obra.getFill());

    dialog_form.value = true;
}

const editForm = async (item) => {
    indice_data.value = data.value.indexOf(item);
    item_obra.value = Object.assign({}, item);
    dialog_form.value = true;
}

const openDeleteData = (item) => {
    indice_data.value = data.value.indexOf(item);
    item_obra.value = Object.assign({}, item);
    dialog_delete.value = true;
}


const closeForm = () => {
    dialog_form.value = false;
    resetTo();
}

const refreshRowDataByForm = (type, item) => {
    switch (type) {
        case "edit":
            Object.assign(data.value[indice_data.value], item);
            break;
        case "add":
            data.value.push(item);
            break;
        default: break;
    }
}


const confirmDeleteData = async () => {
    const obra = new Obra();
    obra.setCity(city.value);
    obra.setFill(item_obra.value);
    const response = await obra.destroy();
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
        const obra = new Obra(city.value);
        const response = await obra.index(select_year.value, month.value);
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
    const obra = new Obra(city.value);
    const response = await obra.generateExcel(select_year.value, month.value);
    if (response.status == 200) {
        fileDownload(response.data, `${city.value}-${month.value}-${select_year.value}-obra.xlsx`);
        viewSnackbar('success', 'Archivo excel generado!');
    } else {
        viewSnackbar('error', response.message)
    }
}

onMounted(() => {
    urlParams();
    initData();
});

</script>

