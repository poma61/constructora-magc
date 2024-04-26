<template>
    <nav class="breadcrumb" aria-label="breadcrumbs">
        <ul>
            <li>
                <div class="has-text-info">
                    <span class="icon is-small">
                        <span class="mdi mdi-calendar-clock"></span>
                    </span>
                    <span>Fechas de reunion</span>
                </div>
            </li>
        </ul>
    </nav>

    <div class="buttons">
        <v-btn @click="newForm()" color="orange-darken-2" class="m-1 as-hover__box-shadow"
            :disabled="month == 'todos' ? false : true">
            <span class="mdi mdi-note-plus-outline is-size-5"></span>&nbsp;Nuevo registro
        </v-btn>
    </div>

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
        <v-btn @click="generateReportExcel()" color="orange-darken-2" class="m-1 as-hover__box-shadow">
            <span class="mdi mdi-file-document-multiple-outline is-size-5"></span>&nbsp;Reporte excel
        </v-btn>
    </div>

    <div class="box p-0">
        <v-text-field v-model="buscar" append-inner-icon="mdi-magnify" clearable label="Buscar Registros..."
            color="orange-darken-2" />

        <v-data-table :hover="true" :items="data" :headers="columns" :loading="change_table"
            :items-per-page-options="items_per_page_options" :show-current-page="true" :fixed-header="true" :search="buscar"
            :height="600" :sort-by="[{ key: 'id', order: 'desc' }]">

            <template v-slot:item.estado="{ item }">
                <span class="tag is-danger as-font-9 m-1" v-if="item.columns.estado == 'Cancelada'">
                    {{ item.columns.estado }}
                </span>
                <span class="tag is-link as-font-9 m-1" v-if="item.columns.estado == 'Programada'">
                    {{ item.columns.estado }}
                </span>
                <span class="tag is-info as-font-9 m-1" v-if="item.columns.estado == 'Por reprogramar'">
                    {{ item.columns.estado }}
                </span>
                <span class="tag is-warning as-font-9 m-1" v-if="item.columns.estado == 'Se llevo a cabo'">
                    {{ item.columns.estado }}
                </span>
                <span class="tag is-success as-font-9 m-1" v-if="item.columns.estado == 'Firma de contrato'">
                    {{ item.columns.estado }}
                </span>
                <span class="tag has-background-grey has-text-white as-font-9 m-1" v-if="item.columns.estado == 'Otro'">
                    {{ item.columns.estado }}
                </span>

            </template>

            <template v-slot:item.fecha_reunion="{ item }">
                <span class="tag is-primary as-font-9 m-1">
                    {{ date_format.formatDate(item.columns.fecha_reunion) }}
                </span>
            </template>

            <template v-slot:item.hora_reunion="{ item }">
                <span class="tag is-primary as-font-9 m-1">
                    {{ date_format.formatHour(item.columns.hora_reunion) }}
                </span>
            </template>

            <template v-slot:item.responsables="{ item }">
                <v-btn color="orange-darken-2" class="as-hover__box-shadow m-1" icon="mdi-badge-account"
                    @click="openClienteResponsable(item.raw)" />

            </template>

            <template v-slot:item.actions="{ item }">
                <div style="width: 150px;">
                    <v-btn @click="editForm(item.raw)"
                        class="has-background-success has-text-white m-1 as-hover__box-shadow" icon="mdi-pencil" />
                    <v-btn @click="openDeleteData(item.raw)"
                        class="has-background-danger has-text-white m-1 as-hover__box-shadow" icon="mdi-delete" />
                </div>
            </template>

            <template v-slot:tfoot>
                <tr>
                    <td colspan="6"></td>
                    <td><span class="tag has-background-grey-ligth m-1 as-font-9">Total= {{ sumMontoInicial.toFixed(2)
                    }}</span></td>
                    <td colspan="4"></td>
                </tr>
            </template>

        </v-data-table>

    </div>
    <FormBoardCliente @saveParent="save()" @closeDialogFormParent="closeDialogForm" :item_cliente_parent="item_cliente"
        :message_errors_field_parent="message_errors_field" :dialog_form_parent="dialog_form" :city_parent="city"
        :group_parent="group" />

    <v-snackbar v-model="snackbar_message_response.value" :timeout="2000" :color="snackbar_message_response.color"
        location="bottom right" min-height="70px">
        <div class="is-flex is-justify-content-center is-align-items-center">
            <span :class="snackbar_message_response.icon"></span>
            <p class="is-size-6">{{ snackbar_message_response.text }}</p>
        </div>
    </v-snackbar>

    <v-dialog v-model="dialog_delete" persistent transition="dialog-bottom-transition" max-width="500px">
        <div class="card">
            <div class="card-content">
                <div class="is-flex is-justify-content-center is-align-items-center is-flex-direction-column">
                    <span class="mdi mdi-file-question as-icon-7 has-text-warning animate__animated animate__flip"></span>
                    <p class="is-size-5 has-text-centered">
                        ¿Esta seguro(a) de eliminar el registro seleccionado?
                    </p>
                </div>
            </div>

            <div class="is-flex  is-justify-content-center  is-align-items-center p-2" style="width: 100%;">
                <div class="m-1">
                    <v-btn class="has-background-success has-text-white as-hover__box-shadow" @click="confirmDeleteData()">
                        <span class="mdi mdi-content-save-all is-size-5"></span>&nbsp;Aceptar
                    </v-btn>
                </div>
                <div class="m-1">
                    <v-btn class="has-background-danger has-text-white as-hover__box-shadow" @click="closeDialogDelete()">
                        <span class="mdi mdi-cancel is-size-5"></span>&nbsp;Cancelar
                    </v-btn>
                </div>
            </div>

        </div>
    </v-dialog>

    <v-dialog v-model="dialog_cliente_responsable" max-width="600px" transition="dialog-bottom-transition" persistent>
        <div class="card">
            <header class="card-header has-background-success">
                <p class="card-header-title has-text-white">
                    <span class="mdi mdi-badge-account is-size-2"></span> &nbsp;RESPONSABLE
                </p>
                <p class="card-header-title has-text-white">
                    <span class="mdi mdi-account-group is-size-2"></span>&nbsp;
                    CLIENTE : {{ item_cliente.nombres + " " + item_cliente.apellido_materno + " " +
                        item_cliente.apellido_materno }}
                </p>
            </header>
            <progress v-if="loading_table_cliente_responsable" class="progress is-small is-primary m-0"
                max="100"></progress>
            <div class="card-content">
                <div class="table-container" style="max-height: 40vh; overflow-y: auto;">

                    <table class="table  is-striped is-hoverable">
                        <thead>
                            <th>Nombres</th>
                            <th>Apellido paterno</th>
                            <th>Apellido materno</th>
                            <th>Es responsable desde</th>
                        </thead>
                        <tbody v-if="loading_table_cliente_responsable == false">
                            <tr v-for="row in data_cliente_responable" :key="row.id">
                                <th>{{ row.nombres }}</th>
                                <th>{{ row.apellido_paterno }}</th>
                                <th>{{ row.apellido_materno }}</th>
                                <th>
                                    <span class="tag is-primary as-font-9 m-1">
                                        {{ date_format.formatDateHour(row.created_at) }}
                                    </span>
                                </th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="is-flex is-justify-content-end is-align-items-center">
                <div class="m-2">
                    <v-btn class="has-background-success has-text-white as-hover__box-shadow"
                        @click="closeClienteResponsable()">
                        <span class="mdi mdi-check-circle is-size-5"></span>&nbsp;OK
                    </v-btn>
                </div>
            </div>

        </div>
    </v-dialog>
</template>

<script>
import { defineComponent } from 'vue';
import { VDataTable } from 'vuetify/labs/VDataTable';
import Cliente from '@/services/Cliente';
import FormBoardCliente from '@/components/cliente/FormBoardCliente.vue';
import DateFormat from '@/util/DateFormat';
import fileDownload from 'js-file-download';

export default defineComponent({
    components: {
        VDataTable,
        FormBoardCliente,
    },

    data() {
        const fecha_actual = new Date();
        const anio_actual = fecha_actual.getFullYear();
        const data = [];
        const select_year = anio_actual;
        const month = "todos";
        const columns = [
            { title: 'Nombres', key: 'nombres' },
            { title: 'Apellido Paterno', key: 'apellido_paterno' },
            { title: 'Apellido Materno', key: 'apellido_materno' },
            { title: 'N° de contacto', key: 'n_de_contacto', align: 'center' },

            { title: 'CI', key: 'ci_all', value: (item) => `${item.ci} ${item.ci_expedido}` },
            { title: 'Estado', key: 'estado', align: 'center' },
            { title: 'Monto inicial', key: 'monto_inicial', align: 'center' },
            { title: 'Descripcion', key: 'descripcion', align: 'center' },
            { title: 'Seguimiento', key: 'seguimiento', align: 'center' },
            { title: 'Fecha reunion', key: 'fecha_reunion', align: 'center' },
            { title: 'Hora reunion', key: 'hora_reunion', align: 'center' },
            { title: 'Responsables', key: 'responsables', align: 'center' },
            { title: 'Acciones', key: 'actions', align: 'center' },
        ];
        const items_per_page_options = [
            { value: 10, title: '10' },
            { value: 25, title: '25' },
            { value: 50, title: '50' },
            { value: 100, title: '100' },
        ];
        const date_format = new DateFormat();
        const dialog_form = false;
        const dialog_delete = false;
        const dialog_cliente_responsable = false;
        const buscar = "";
        const change_table = null;
        const city = null;
        const group = null;
        const item_cliente = {};
        const index_array = -1;
        const message_errors_field = {};
        const snackbar_message_response = { icon: "", value: false, text: "", color: "" };
        const data_cliente_responable = [];
        const loading_table_cliente_responsable = false;
        return {

            data,
            select_year,
            month,
            columns,
            change_table,
            buscar,
            dialog_delete,
            dialog_form,
            dialog_cliente_responsable,
            items_per_page_options,
            city,
            group,
            item_cliente,
            index_array,
            message_errors_field,
            snackbar_message_response,
            date_format,
            data_cliente_responable,
            loading_table_cliente_responsable,
        }
    },//data

    computed: {
        sumMontoInicial() {
            return this.data.reduce((total, item) => total + Number(item.monto_inicial), 0);
        },
    },

    methods: {
        urlParams() {
            const parse_url = new URL(window.location.href);
            this.city = parse_url.pathname.split('/')[3];
            this.group = parse_url.pathname.split('/')[4];
        },
        selectMont(mes) {
            this.month = mes;
            this.initData();
        },
        initData() {

            this.change_table = 'orange-darken-2';
            setTimeout(async () => {
                const cliente = new Cliente(this.city, this.group);
                const response = await cliente.index(this.select_year, this.month);
                this.change_table = null;
                if (response.status) {
                    this.snackbarMessageView('success', response.message);
                    this.data = response.records;

                } else {
                    this.snackbarMessageView('error', response.message);
                }

            }, 1000);
        },

        snackbarMessageView(type, message) {
            if (type == 'success') {
                this.snackbar_message_response.icon = "mdi mdi-check-circle-outline is-size-1";
                this.snackbar_message_response.color = 'success'
            } else {
                this.snackbar_message_response.icon = "mdi mdi-alert is-size-1";
                this.snackbar_message_response.color = 'red'
            }
            this.snackbar_message_response.text = message;
            this.snackbar_message_response.value = true;

        },

        clearVars() {
            this.index_array = -1;
            this.message_errors_field = {};
            this.item_cliente = {};
        },

        closeDialogForm() {
            this.dialog_form = false;
            this.clearVars();
        },

        closeDialogDelete() {
            this.dialog_delete = false;
            this.clearVars();
        },

        newForm() {
            const cliente = new Cliente(this.city, this.group);
            this.item_cliente = Object.assign({}, cliente.getFill());
            this.dialog_form = true;
        },

        editForm(item) {
            this.index_array = this.data.indexOf(item);
            this.item_cliente = Object.assign({}, item);
            this.dialog_form = true;
        },

        openDeleteData(item) {
            this.index_array = this.data.indexOf(item);
            this.item_cliente = Object.assign({}, item);
            this.dialog_delete = true;
        },

        async confirmDeleteData() {
            const cliente = new Cliente(this.city, this.group);
            cliente.setFill(this.item_cliente);
            const response = await cliente.destroy();
            if (response.status) {
                this.snackbarMessageView('success', response.message);
                this.data.splice(this.index_array, 1);

            } else {
                this.snackbarMessageView('error', response.message);

            }
            this.closeDialogDelete();

        },

        async save() {
            const cliente = new Cliente(this.city, this.group);
            cliente.setFill(this.item_cliente);
            if (cliente.getFill().id > 0) {
                //cuando sea update
                const response = await cliente.update();
                if (response.status) {
                    this.snackbarMessageView('success', response.message);
                    //buscamos el registro y cambiamos valores
                    Object.assign(this.data[this.index_array], response.record);

                    this.closeDialogForm();
                } else {
                    if (response.message_errors != undefined) {
                        this.message_errors_field = response.message_errors;
                    }
                    this.snackbarMessageView('error', response.message);
                }

            } else {
                //cuando sea un nuevo registro
                const response = await cliente.create();
                if (response.status) {
                    this.snackbarMessageView('success', response.message);
                    this.data.push(response.record);
                    this.closeDialogForm();
                } else {
                    this.snackbarMessageView('error', response.message);
                    if (response.message_errors != undefined) {
                        this.message_errors_field = response.message_errors;
                    }
                }

            }



        },

        openClienteResponsable(item) {
            this.dialog_cliente_responsable = true;
            this.loading_table_cliente_responsable = true;
            this.item_cliente = Object.assign({}, item);
            setTimeout(async () => {
                const cliente = new Cliente(this.city, this.group);
                const response = await cliente.clienteResponsable(item.id);
                this.loading_table_cliente_responsable = false;//dejamos de cargar la tabla de cliente responsable

                if (response.status) {
                    this.data_cliente_responable = response.records;

                } else {
                    this.snackbarMessageView('error', response.message);
                }

            }, 1500);
        },

        closeClienteResponsable() {
            this.dialog_cliente_responsable = false;
            this.clearVars();
        },

        async generateReportExcel() {
            const cliente = new Cliente(this.city, this.group);
            const response = await cliente.generateExcel(this.select_year, this.month);

            if (response.status == 200) {
                fileDownload(response.data, `${this.city}-grupo-${this.group}-${this.month}-${this.select_year}-cliente.xlsx`);
                this.snackbarMessageView('success', 'Archivo excel generado!');
            } else {
                this.snackbarMessageView('error', response.message)
            }

        }
    },//methods

    mounted() {
        this.urlParams();
        this.initData(this.select_year, this.month);
    },

});

</script>

