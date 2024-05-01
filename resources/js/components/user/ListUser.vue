<template>
  
  <div class="columns">
    <div class="column">
      <button class="button is-success icon-text" @click="newForm()" :disabled="city == 'todos' ? false : true">
        <span class="icon">
          <span class="mdi mdi-plus"></span>
        </span>
        <span>Nuevo usuario</span>
      </button>
    </div>
  </div>
  <!--  otros codigos -->
  <div>
    <p class="my-3">
      <span class="mdi mdi-text-search is-size-5"></span>
      Filtrar por ciudades:
    </p>
    <div class="buttons mb-2">
      <button @click="selectCity('todos')" :class="['button is-info', { 'is-light': city == 'todos' }]">
        <span class="mdi mdi-text-search is-size-5"></span>&nbsp;Todos
      </button>

      <button @click="selectCity('Santa-Cruz')" :class="['button is-info', { 'is-light': city == 'Santa-Cruz' }]">
        <span class="mdi mdi-text-search is-size-5"></span>&nbsp;Santa Cruz
      </button>

      <button @click="selectCity('Chuquisaca')" :class="['button is-info', { 'is-light': city == 'Chuquisaca' }]">
        <span class="mdi mdi-text-search is-size-5"></span>&nbsp;Chuquisaca
      </button>

      <button @click="selectCity('Cochabamba')" :class="['button is-info', { 'is-light': city == 'Cochabamba' }]">
        <span class="mdi mdi-text-search is-size-5"></span>&nbsp;Cochabamba
      </button>

      <button @click="selectCity('Potosi')" :class="['button is-info', { 'is-light': city == 'Potosi' }]">
        <span class="mdi mdi-text-search is-size-5"></span>&nbsp;Potosi
      </button>

      <button @click="selectCity('Beni')" :class="['button is-info', { 'is-light': city == 'Beni' }]">
        <span class="mdi mdi-text-search is-size-5"></span>&nbsp;Beni
      </button>

      <button @click="selectCity('La-Paz')" :class="['button is-info', { 'is-light': city == 'La-Paz' }]">
        <span class="mdi mdi-text-search is-size-5"></span>&nbsp;La-Paz
      </button>

      <button @click="selectCity('Pando')" :class="['button is-info', { 'is-light': city == 'Pando' }]">
        <span class="mdi mdi-text-search is-size-5"></span>&nbsp;Pando
      </button>

      <button @click="selectCity('Tarija')" :class="['button is-info', { 'is-light': city == 'Tarija' }]">
        <span class="mdi mdi-text-search is-size-5"></span>&nbsp;Tarija
      </button>


      <button @click="selectCity('Oruro')" :class="['button is-info', { 'is-light': city == 'Oruro' }]">
        <span class="mdi mdi-text-search is-size-5"></span>&nbsp;Oruro
      </button>


      <button @click="selectCity('Otros')" :class="['button is-info', { 'is-light': city == 'Otros' }]">
        <span class="mdi mdi-text-search is-size-5"></span>&nbsp;Otros
      </button>
    </div>
  </div>

  <!-- otros codigos -->
  <div class="card">
    <v-text-field v-model="buscar_registros" append-inner-icon="mdi-magnify" clearable label="Buscar Registros"
      color="cyan-darken-2">
    </v-text-field>

    <v-data-table :hover="true" :headers="headers" :items="registros" :loading="change_data_table"
      :items-per-page-options="items_per_page_options" :show-current-page="true" :fixed-header="true"
      :search="buscar_registros" :height="600" :sort-by="[{ key: 'id', order: 'desc' }]">

      <template v-slot:item="{ item }">
        <tr>
          <td>{{ item.columns.nombres }} </td>
          <td>{{ item.columns.apellido_paterno }}</td>
          <td>{{ item.columns.apellido_materno }}</td>
          <td>{{ item.columns.ciudad }}</td>
          <td>
            <span class="tag is-primary as-font-9 m-1"> {{ date_format.formatDateHour(item.columns.created_at) }}</span>
          </td>
          <td>
            <div style="min-width: 200px;">
              <v-btn @click="showDetailUser(item.raw)" color="success" class="m-1" icon="mdi-account-details-outline">
              </v-btn>

              <v-btn @click="editForm(item.raw)" class="m-1" color="cyan-darken-2" icon="mdi-pencil">
              </v-btn>

              <v-btn @click="deleteItem(item.raw)" color="red" class="m-1" icon="mdi-delete">
              </v-btn>
            </div>
          </td>
        </tr>
      </template>
    </v-data-table>
  </div>

  <v-dialog v-model="dialog_form" max-width="1400px" persistent transition="dialog-bottom-transition">
    <FormUser @isCloseDialogForm="closeDialogForm()" :item_user_parent="item_user"
      @isUpdateLocalDataTable="updateLocalDataTable" @isSnackbarMessageView="snackbarMessageView" />
  </v-dialog>

  <v-dialog v-model="dialog_detail_user" max-width="1000px" persistent transition="dialog-bottom-transition">
    <DetailUser :item_user_parent="item_user" @isCloseDialogDetailUser="closeDialogDetailUser" 
    @isSnackbarMessageView ="snackbarMessageView"/>
  </v-dialog>

  <v-dialog v-model="dialog_delete" max-width="500px" persistent transition="dialog-bottom-transition">
    <div class="card">
      <div class="card-content">
        <div class="content">
          <div class="is-flex is-justify-content-center is-align-items-center  is-flex-direction-column">
            <v-icon icon="mdi-trash-can-outline" size="90" color="warning"
              class="animate__animated animate__bounce" />
            <p class="is-size-5 has-text-centered">¿Desea eliminar el registro seleccionado?</p>
          </div>
        </div>
      </div>

      <div class="is-flex is-justify-content-center  is-align-items-center p-2" style="width: 100%;">
        <div class="m-1">
          <v-btn variant="elevated" color="cyan-darken-1" @click="confirmDeleteItem()">
            <v-icon icon="mdi-content-save-all"></v-icon>&nbsp;Aceptar
          </v-btn>
        </div>
        <div class="m-1">
          <v-btn variant="elevated" color="red" @click="closeDialogDelete()">
            <v-icon icon="mdi-cancel"></v-icon>&nbsp;Cancelar
          </v-btn>
        </div>
      </div>

    </div>
  </v-dialog>

  <v-snackbar v-model="snackbar_message_response.value" :timeout="2000" :color="snackbar_message_response.color"
    location="bottom right">
    <div class="is-flex is-justify-content-center is-align-items-center">
      <v-icon :icon="snackbar_message_response.icon" size="50"></v-icon>
      <p class="is-size-6">{{ snackbar_message_response.text }}
      </p>
    </div>
  </v-snackbar>

</template>

<script>
import { defineComponent } from 'vue';
import { VDataTable } from 'vuetify/labs/VDataTable'
import Usuario from '@/services/Usuario';
import DateFormat from '@/util/DateFormat';
import FormUser from '@/components/user/FormUser.vue';
import DetailUser from '@/components/user/DetailUser.vue';

export default defineComponent({
  components: {
    VDataTable,
    FormUser,
    DetailUser,
  },

  data() {
    const change_data_table = null;
    const registros = [];
    const date_format = new DateFormat();
    const dialog_form = false;
    const city = "todos";
    const item_user = {};
    const index_array = -1;
    const buscar_registros = "";
    const snackbar_message_response = { value: false, text: "", icon: "", color: "" };
    const dialog_delete = false;
    const dialog_detail_user = false;
    const headers = [
      { title: 'Nombres', key: 'nombres', divider: true, },
      { title: 'Apellido Paterno', key: 'apellido_paterno', divider: true, },
      { title: 'Apellido Materno', key: 'apellido_materno', divider: true, },
      { title: 'Ciudad', key: 'ciudad', divider: true, },
      { title: 'Creado el', key: 'created_at', divider: true, },
      { title: 'Acciones', key: 'actions', divider: true, },
    ];

    const items_per_page_options = [
      { value: 10, title: '10' },
      { value: 25, title: '25' },
      { value: 50, title: '50' },
    ];

    return {
      headers,
      change_data_table,
      registros,
      date_format,
      city,
      dialog_form,
      item_user,
      index_array,
      items_per_page_options,
      buscar_registros,
      snackbar_message_response,
      dialog_delete,
      dialog_detail_user,
    }
  },

  methods: {
    initData() {
      this.change_data_table = 'cyan';
      setTimeout(async () => {
        const usuario = new Usuario();
        const respuesta = await usuario.index(this.city);
        this.change_data_table = null;
        if (respuesta.status) {
          this.registros = respuesta.records;
        } else {
          this.snackbarMessageView('error', respuesta.message)
        }
      }, 400);
    },//initData

    selectCity(ciudad) {
      this.city = ciudad;
      this.initData();
    },

    newForm() {
      const usuario = new Usuario();
      const additional_attributes_item_user = {
        nombre_completo: "",
      }
      this.item_user = Object.assign(additional_attributes_item_user, usuario.getFill());
      this.dialog_form = true;
    },//newForm

    editForm(item) {
      this.index_array = this.registros.indexOf(item);
      const additional_attributes_item_user = {
        nombre_completo: `${item.nombres} ${item.apellido_paterno} ${item.apellido_materno}`,
      }

      this.item_user = Object.assign(additional_attributes_item_user, this.registros[this.index_array]);
      this.dialog_form = true;
    },

    deleteItem(item) {
      this.index_array = this.registros.indexOf(item);
      this.item_user = Object.assign({}, item);
      this.dialog_delete = true;
    },//deleteItem

    async confirmDeleteItem() {
      const usuario = new Usuario();
      usuario.setFill(this.item_user);
      const response = await usuario.destroy();
      if (response.status) {
        this.snackbarMessageView('success', response.message)
        //eliminamos el dato del array
        this.registros.splice(this.index_array, 1);
      } else {

        this.snackbarMessageView('error', response.message)
      }
      this.closeDialogDelete();
    },

    snackbarMessageView(type, message) {
      if (type == 'success') {
        this.snackbar_message_response.icon = "mdi-file-check-outline",
          this.snackbar_message_response.color = "green"
      } else {
        this.snackbar_message_response.icon = "mdi-alert",
          this.snackbar_message_response.color = "red"
      }
      this.snackbar_message_response.text = message;
      this.snackbar_message_response.value = true;
    },

    closeDialogForm() {
      this.dialog_form = false;
      this.clear();
    },//closeDialogForm

    closeDialogDelete() {
      this.dialog_delete = false;
      this.clear();
    },//closedialogDelete

    clear() {
      this.item_user = {};
      this.index_array = -1;
    },//clear

    updateLocalDataTable(type, item) {
      switch (type) {
        case 'new':
          //agregamosel registro al array de datos
          this.registros.push(item);
          break;
        case 'edit':
          //buscamos el registro y actualizamos valores
          Object.assign(this.registros[this.index_array], item);
          break;
        default:
          this.snackbarMessageView('error', 'Error method updateLocalDataTable');
          break;

      }
    },

    showDetailUser(item) {
      const additional_attributes_item_user = {
        nombre_completo: `${item.nombres} ${item.apellido_paterno} ${item.apellido_materno}`,
      }

      this.item_user = Object.assign(additional_attributes_item_user, item);
      this.dialog_detail_user = true;
    },

    closeDialogDetailUser() {
      this.clear();
      this.dialog_detail_user = false;
    }
  },//metodos

  created() {
    this.initData();
  }

});
</script>
