<template>
    <div class="card">
        <header class="card-header has-background-info">
            <p class="card-header-title has-text-white">
                <v-icon size="50" icon="mdi-account-box" />&nbsp;REGISTRAR USUARIO
            </p>
        </header>
        <div class="card-content as-form">
            <form>
                <div class="d-flex is-flex-wrap-wrap" style="width: 100%;">
                    <v-text-field color="cyan-darken-2" label="Usuario" v-model="props.item_user_parent.usuario"
                        :error-messages="getValidateErrors('usuario')" autocomplete="none" class="ma-1"
                        style="min-width:250px ;" />

                    <v-text-field color="cyan-darken-2" label="Contraseña" :type="show ? 'text' : 'password'"
                        :append-inner-icon="show ? 'mdi-eye' : 'mdi-eye-off'" @click:append-inner="show = !show"
                        v-model="props.item_user_parent.password" :error-messages="getValidateErrors('password')"
                        autocomplete="none" class="ma-1" style="min-width:250px ;" />
                </div>

                <div class="d-flex">
                    <v-text-field class="ma-1" density="compact" label="Buscar Personal"
                        prepend-inner-icon="mdi-magnify" color="cyan-darken-2" v-model="ci"
                        :loading="change_search_personal" @keyup.enter="searchPersonal()"
                        placeholder="Introduzca C.I. del personal" />

                    <v-btn icon="mdi-magnify" color="orange-darken-3" variant="elevated" class="ma-1"
                        @click="searchPersonal()"></v-btn>
                </div>

                <div class="d-flex is-flex-wrap-wrap">

                    <v-text-field class="ma-1" color="cyan-darken-2" label="Personal" readonly
                        v-model="props.item_user_parent.nombre_completo_personal"
                        :error-messages="getValidateErrors('id_personal')" style="min-width: 250px;" />

                    <v-text-field class="ma-1" color="cyan-darken-2" label="Ciudad" readonly
                        v-model="props.item_user_parent.ciudad" :error-messages="getValidateErrors('id_personal')"
                        style="min-width: 250px;" />
                </div>

                <v-divider class="border-opacity-50" ></v-divider>

                <div class="mx-2">
                    <p class="text-info">Todos los modulos | Administra las ciudades de: </p>
                    <div class="as-flex-content-permisions">
                        <!-- renderizamos los permisos la parte de ciudades -->
                        <v-checkbox v-for="(city, index) in list_city_permisions" :key="index"
                            :label="city.code_content" :value="city.code_content" hide-details color="success"
                            class="item-flex-permisions" v-model="permisions_city">
                        </v-checkbox>
                    </div>
                </div>

                <v-divider class="border-opacity-50" ></v-divider>

                <div class="mx-2">
                    <!-- renderizamos los permisos la parte de grupos -->
                    <div v-for="(ciudad_grupo, index) in list_group_permisions" :key="index">
                        <p class="text-info">Modulo Cliente | {{ ciudad_grupo.ciudad }}  | Administra grupos:</p>
                        <div class="as-flex-content-permisions">
                            <v-switch v-for="(grupo, grupo_index) in ciudad_grupo.grupos" :key="grupo_index"
                                :label="grupo.split('_')[1]" :value="grupo" class="item-flex-permisions" color="success"
                                hide-details inset :disabled = "permisions_city.includes(ciudad_grupo.ciudad) ? false : true" >
                            </v-switch>
                        </div>
                    </div>
                </div>

                <v-divider class="border-opacity-50" ></v-divider>

                <div>
                    <v-radio-group v-model="props.item_user_parent.role" label="Rol" inline
                        :error-messages="getValidateErrors('role')">
                        <v-radio label="Normal" value="Normal" color="cyan-darken-2"></v-radio>
                        <v-radio label="Administrador" value="Administrador" color="cyan-darken-2"></v-radio>
                    </v-radio-group>
                    <p class="mx-5" v-if="props.item_user_parent.role == 'Normal'">
                        <span class="text-success">Normal:</span>
                    <ol class="ml-5" style="list-style-type:square;">
                        <li>Acceso a todos los modulos. Excepto a los modulos <b>personal</b> y <b>usuarios</b>
                        </li>
                        <li>Acceso solo a la ciudad a la que pertenece el usuario.</li>
                        <li>Acceso solo a los datos registrados por el mismo usuario del modulo cliente</li>
                    </ol>
                    </p>
                    <p class="mx-5" v-if="props.item_user_parent.role == 'Administrador'">
                        <span class="text-success">Administrador:</span>

                    <ol class="ml-5" style="list-style-type:square;">
                        <li>Acceso a todos los modulos.</li>
                        <li>Acceso a todas las ciudades.</li>
                        <li>Acceso a todos los registros del modulo cliente</li>
                    </ol>
                    </p>
                </div>
            </form>
        </div>

        <div class="is-flex is-justify-content-end  is-align-items-center p-2" style="width: 100%;">
            <div class="m-1">
                <v-btn variant="outlined" color="cyan-darken-1" @click="saveChild()">
                    <v-icon icon="mdi-content-save-all"></v-icon>&nbsp;Guardar
                </v-btn>
            </div>
            <div class="m-1">
                <v-btn variant="outlined" color="red" @click="closeDialogFormChild()">
                    <v-icon icon="mdi-cancel"></v-icon>&nbsp;Cancelar
                </v-btn>
            </div>
        </div>

    </div>
    <v-snackbar v-model="snackbar.value" :timeout="2500" location="bottom right"
        :color="snackbar.type == 'success' ? 'success' : 'red-darken-1'">
        <div class="is-flex is-justify-content-center is-align-items-center">
            <v-icon :icon="snackbar.type == 'success' ? 'mdi-check' : 'mdi-alert'" size="50" />
            <p class="is-size-6">
                <span class="has-text-weight-bold">{{ snackbar.text }}</span>
            </p>
        </div>
    </v-snackbar>

</template>


<script>
import { defineComponent } from 'vue';
import Personal from '@/services/Personal';
import Permiso from '@/services/Permiso';
export default defineComponent({
    props: ["dialog_form_parent", 'item_user_parent', 'message_errors_field_parent'],
    emits: ['closeDialogFormParent', 'saveParent'],
    data() {
        const show = false;
        const ci = "";
        const snackbar = { value: false, text: "", type: "" };
        const change_search_personal = null;
        const permisions_groups =[];
        const permisions_city =[];
        const list_city_permisions = [];
        const list_group_permisions = [
            {
                ciudad: "Santa-Cruz",
                grupos: []
            },
            {
                ciudad: "Chuquisaca",
                grupos: []
            },
            {
                ciudad: "Cochabamba",
                grupos: []
            },
            {
                ciudad: "Potosi",
                grupos: []
            },
            {
                ciudad: "Beni",
                grupos: []
            },
            {
                ciudad: "La-Paz",
                grupos: []
            },

            {
                ciudad: "Pando",
                grupos: []
            },

            {
                ciudad: "Tarija",
                grupos: []
            },
            {
                ciudad: "Oruro",
                grupos: []
            },
            {
                ciudad: "Otros",
                grupos: []
            },

        ];

        return {
            show,
            ci,
            snackbar,
            change_search_personal,
            list_city_permisions,
            list_group_permisions,
            permisions_groups,
            permisions_city,
        }
    },//data

    setup(props, { emit }) {
        const closeDialogFormChild = () => {
            emit('closeDialogFormParent');
        }
        const saveChild = () => {
            emit('saveParent');
        }
        return {
            props, closeDialogFormChild, saveChild
        }
    },//setup

    computed: {
        getValidateErrors() {
            return function (property) {
                if (this.props.message_errors_field_parent && this.props.message_errors_field_parent[property]) {
                    return this.props.message_errors_field_parent[property][0];
                }
                return "";
            };
        }
    },
    methods: {
        searchPersonal() {
            const usuario = new Personal();
            this.change_search_personal = 'cyan';
            setTimeout(async () => {
                const response = await usuario.searchByCi(this.ci);
                this.change_search_personal = null;
                this.snackbar.value = true;
                if (response.status) {
                    this.props.item_user_parent.nombre_completo_personal = `${response.record.nombres} ${response.record.apellido_paterno} ${response.record.apellido_materno}`;
                    this.props.item_user_parent.id_personal = response.record.id;
                    this.props.item_user_parent.ciudad = response.record.ciudad;
                    this.snackbar.type = "success";
                    this.snackbar.text = response.message;
                } else {
                    this.snackbar.type = "error";
                    this.snackbar.text = response.message;
                }
                this.ci = "";
            }, 800);

        },

        // nos quedamos en esta parte 
        // renderizando los permisos
        // debe entender bien el codigo
        async listPermissions() {
            const permiso = new Permiso();
            const response = await permiso.index();
            if (response.status) {
                const list_permisos = response.records;
                // Filtrar solo los elementos de tipo "ciudades"
                this.list_city_permisions = list_permisos.filter(row => row.content_type == 'ciudades');

                //ESTA PARTE DEL CODIGO AUN NO ENTIENDO TRATAR DE ENTENDER LO MAS EXPLICITO POSIBLE
                // Filtrar objetos según las ciudades especificadas
                list_permisos.forEach(row => {
                    if (row.content_type == 'grupos') {
                        const ciudad = row.code_content.split("_")[0];
                        const ciudadExistente = this.list_group_permisions.find(item => item.ciudad == ciudad);

                        if (ciudadExistente) {
                            ciudadExistente.grupos.push(row.code_content);
                        }

                    }

                });

            } else {
                this.snackbar.value = true;
                this.snackbar.type = "error";
                this.snackbar.text = response.message;
            }

        },
    },//methods
    mounted() {
        this.listPermissions();
    },

});


</script>

<style scoped>
.as-flex-content-permisions {
    display: flex;
    width: 100%;
    flex-wrap: wrap;
}

.as-flex-content-permisions .item-flex-permisions {
    flex-grow: 0;
    margin: 10px 5px
}
</style>