<template>
  <div class="columns is-desktop">
    <div class="column">
      <button class="button is-info icon-text" @click="newForm()">
        <span class="icon">
          <span class="mdi mdi-plus-box"></span>
        </span>
        <span>Nuevo</span></button>
    </div>

  </div>
  <div class="card">
    <v-text-field v-model="buscar_registros" append-inner-icon="mdi-file-search-outline" clearable
      label="Buscar Registros" color="cyan-darken-2" >
    </v-text-field>
    
    <v-data-table   :hover="true" :headers="headers" :items="registros"  :loading="change"
      :items-per-page-options="items_per_page_options" :show-current-page="true" :fixed-header="true"
      :search="buscar_registros" page-text="{0}-{1} de {2}" :height="500" :sort-by="[{ key: 'id', order: 'desc' }]"
      >
     
      <template v-slot:item="{ item }" >
        <tr   >
          <td>{{ item.columns.nombres }} </td>
          <td>{{ item.columns.apellido_paterno }}</td>
          <td>{{ item.columns.apellido_materno }}</td>
          <td>{{ item.columns.ciudad }}</td>
          <td>{{ item.columns.role }}</td>
          <td>
            <span class="tag is-primary as-font-9 m-1"> {{ date_format.format(new Date(item.columns.created_at)) }}</span>
          </td>
          <td>
            <v-btn @click="editForm(item.raw)" class="m-1" color="cyan-darken-2" icon="mdi-pencil">
            </v-btn>
            <v-btn @click="deleteItem(item.raw)" color="red" class="m-1" icon="mdi-delete">
            </v-btn>

          </td>
        </tr>
      </template>


    </v-data-table>
  </div>


  <FormUser :dialog_form_parent="dialog_form" @closeDialogFormParent="closeDialogForm()" :item_user_parent="item_user"
    @saveParent="save()" :message_errors_field_parent="message_errors_field" />

  <v-snackbar v-model="snackbar_message_response.value" :timeout="2000" :color="snackbar_message_response.color"
    location="top right">
    <div class="is-flex is-justify-content-center is-align-items-center">
      <v-icon :icon="snackbar_message_response.icon" size="50"></v-icon>
      <p class="is-size-6">{{ snackbar_message_response.text }}
      </p>
    </div>
  </v-snackbar>

  <v-dialog v-model="dialog_delete" max-width="500px" persistent transition="dialog-top-transition">
    <div class="card">

      <div class="card-content">
        <div class="content">
          <div class="is-flex is-justify-content-center is-align-items-center  is-flex-direction-column">
            <v-icon icon="mdi-file-question-outline" size="90" color="warning" class="animate__animated animate__bounce"/>
            <p class="is-size-4 has-text-centered">¿Desea eliminar el registro seleccionado?</p>
          </div>
        </div>
      </div>

      <div class="is-flex  is-justify-content-center  is-align-items-center p-2" style="width: 100%;">
        <div class="m-1">
          <v-btn variant="outlined" color="cyan-darken-1" @click="confirmDeleteItem()">
            <v-icon icon="mdi-content-save-all" ></v-icon>&nbsp;Aceptar
          </v-btn>
        </div>
        <div class="m-1">
          <v-btn variant="outlined" color="red" @click="closeDialogDelete()">
            <v-icon icon="mdi-cancel"></v-icon>&nbsp;Cancelar
          </v-btn>
        </div>
      </div>

    </div>
  </v-dialog>
  
</template>
  
<script>
import { defineComponent } from 'vue';
import { VDataTable } from 'vuetify/labs/VDataTable'
import Usuario from '@/services/Usuario';
import DateFormat from '@/util/DateFormat';
import FormUser from '@/components/user/FormUser.vue';

export default defineComponent({
  components: {
    VDataTable,
    FormUser,
  },

  data() {
    const change = null;
    const registros = [];
    const date_format = new DateFormat();
    const dialog_form = false;
    const parsed_url = new URL(window.location.href);
    const city = parsed_url.pathname.split('/').pop();
    const item_user = {};
    const index_array = -1;
    const buscar_registros = "";
    const message_errors_field = null;
    const snackbar_message_response = { value: false, text: "", icon: "", color: "" };
    const dialog_delete = false;
    const headers = [
      { title: 'Nombres', key: 'nombres',  divider: true, },
      { title: 'Apellido Paterno', key: 'apellido_paterno', divider: true, },
      { title: 'Apellido Materno', key: 'apellido_materno', divider: true, },
      { title: 'Ciudad', key: 'ciudad', divider: true, },
      { title: 'Rol', key: 'role', divider: true, },
      { title: 'Creado el', key: 'created_at', divider: true, },
      { title: 'Acciones', key: 'actions', divider: true, },
    ];

    const items_per_page_options = [
      { value: 10, title: '10' },
      { value: 25, title: '25' },
      { value: 50, title: '50' },
      { value: 100, title: '100' },
    ];

    return {
      headers,
      change,
      registros,
      date_format,
      dialog_form,
      city,
      item_user,
      index_array,
      items_per_page_options,
      buscar_registros,
      message_errors_field,
      snackbar_message_response,
      dialog_delete,
    }
  },

  methods: {
    async initData() {

      const usuario = new Usuario(this.city);

      const respuesta = await usuario.index();
      if (respuesta.status) {
        this.registros = respuesta.records;
      }

    },//initData

    newForm() {
      const usuario = new Usuario(this.city);
      this.item_user = Object.assign({ nombre_completo_personal: "" }, usuario.getFill());
      this.dialog_form = true;
    },//newForm

    editForm(item) {
      this.index_array = this.registros.indexOf(item);

      const nom_completo_personal = `${item.nombres} ${item.apellido_paterno} ${item.apellido_materno}`;

      this.item_user = Object.assign({ nombre_completo_personal: nom_completo_personal }, this.registros[this.index_array]);
      this.dialog_form = true;
    },

    deleteItem(item) {
      this.index_array = this.registros.indexOf(item);
      this.item_user = Object.assign({}, item);
      this.dialog_delete = true;
    },//deleteItem

    async confirmDeleteItem() {
      const usuario = new Usuario(this.city);
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

    async save() {
      const usuario = new Usuario(this.city);
      usuario.setFill(this.item_user);
      if (this.item_user.id > 0) {
        // cuando sea update
        const response = await usuario.update();
        if (response.status) {
          this.snackbarMessageView('success', response.message)
          //buscamos el registro y cambiamos valores
          Object.assign(this.registros[this.index_array], response.record);
          this.closeDialogForm();
        } else {
          this.message_errors_field = response.message_errors;
          this.snackbarMessageView('error', response.message)
        }

      } else {
        //cuando es un registro nuevo
        const response = await usuario.create()

        if (response.status) {
          this.message_errors_field = response.message_errors;
          this.snackbarMessageView('success', response.message)
          //agregamos el rgistro al array de datos
          this.registros.push(response.record);
          this.closeDialogForm();
        } else {
          this.message_errors_field = response.message_errors;
          this.snackbarMessageView('error', response.message)

        }
      }

    },//save

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
      this.message_errors_field = {};
      this.item_user = {};
      this.index_array = -1;
    },//clear


  },//metodos

  created() {
    this.change = 'cyan';
    setTimeout(() => {
      this.initData();
      this.change = null;
    }, 1000);

  }


});



</script>
  

