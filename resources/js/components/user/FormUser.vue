<template>
    <div class="card">
        <header class="card-header has-background-info">
            <p class="card-header-title has-text-white">
                <v-icon size="50" icon="mdi-account-box" />&nbsp;REGISTRAR USUARIO
            </p>
        </header>
        <div class="card-content as-form">
            <form>
                <div class="d-flex is-flex-wrappp-wrap" style="width: 100%;">
                    <v-text-field color="cyan-darken-2" label="Usuario" v-model="item_user.usuario"
                        :error-messages="getValidateErrors('usuario')" autocomplete="none" class="ma-1"
                        style="min-width:250px ;" />

                    <v-text-field color="cyan-darken-2" label="Contraseña" :type="show ? 'text' : 'password'"
                        :append-inner-icon="show ? 'mdi-eye' : 'mdi-eye-off'" @click:append-inner="show = !show"
                        v-model="item_user.password" :error-messages="getValidateErrors('password')" autocomplete="none"
                        class="ma-1" style="min-width:250px ;" />
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
                        v-model="item_user.nombre_completo" :error-messages="getValidateErrors('id_personal')"
                        style="min-width: 250px;" />

                    <v-text-field class="ma-1" color="cyan-darken-2" label="Ciudad" readonly v-model="item_user.ciudad"
                        :error-messages="getValidateErrors('id_personal')" style="min-width: 250px;" />
                </div>

                <v-divider class="border-opacity-50"></v-divider>

                <div class="mx-2">
                    <p class="text-info">Todos los modulos | Administra las ciudades de: </p>
                    <div class="as-flex-content-permisions">
                        <!-- renderizamos los permisos la parte de ciudades -->
                        <v-checkbox v-for="(city, index) in list_city_permissions" :key="index"
                            :label="city.code_content" :value="city.code_content" hide-details color="success"
                            class="item-flex-permisions" v-model="city_permissions">
                        </v-checkbox>
                    </div>
                </div>

                <v-divider class="border-opacity-50"></v-divider>

                <div class="mx-2">
                    <!-- renderizamos los permisos la parte de grupos -->
                    <div v-for="(ciudad_grupo, index) in list_groups_permissions" :key="index">
                        <p class="text-info">Modulo Cliente | {{ ciudad_grupo.ciudad }} | Administra grupos:</p>
                        <div class="as-flex-content-permisions">
                            <!-- el grupo viene de esta forma "Santa-Cruz_01" -->
                            <!-- split => divide un string a partir de "_" y obtenemos ["Santa-Cruzz","01"] -->
                            <v-switch v-for="(grupo, grupo_index) in ciudad_grupo.grupos" :key="grupo_index"
                                :label="grupo.split('_')[1]" :value="grupo" class="item-flex-permisions" color="success"
                                hide-details inset
                                :disabled="city_permissions.includes(ciudad_grupo.ciudad) ? false : true"
                                v-model="groups_permissions">
                            </v-switch>
                        </div>
                    </div>
                </div>

                <v-divider class="border-opacity-50"></v-divider>
                <div>
                    <v-radio-group v-model="item_user.role" label="Rol" inline
                        :error-messages="getValidateErrors('role')">
                        <v-radio label="Normal" value="Normal" color="cyan-darken-2"></v-radio>
                        <v-radio label="Administrador" value="Administrador" color="cyan-darken-2"></v-radio>
                    </v-radio-group>
                    <p class="mx-5" v-if="item_user.role == 'Normal'">
                        <span class="text-success">Normal:</span>
                    <ol class="ml-5" style="list-style-type:square;">
                        <li>Acceso a todos los modulos. Excepto a los modulos <b>personal</b> y <b>usuarios</b>
                        </li>
                        <li>Acceso solo a la ciudad a la que pertenece el usuario.</li>
                        <li>Acceso solo a los datos registrados por el mismo usuario del modulo cliente</li>
                    </ol>
                    </p>
                    <p class="mx-5" v-if="item_user.role == 'Administrador'">
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
                <v-btn variant="elevated" color="cyan-darken-1" @click="save">
                    <v-icon icon="mdi-content-save-all"></v-icon>&nbsp;Guardar
                </v-btn>
            </div>
            <div class="m-1">
                <v-btn variant="elevated" color="red" @click="emit('isCloseDialogForm')">
                    <v-icon icon="mdi-cancel"></v-icon>&nbsp;Cancelar
                </v-btn>
            </div>
        </div>
    </div>
    
    <v-overlay v-model="change_overlay" class="align-center justify-center" persistent>
        <div class="text-center">
            <v-progress-circular color="info" size="100" indeterminate></v-progress-circular>
            <h1 class="is-size-5 text-white text-center">Cargando datos...</h1>
        </div>
    </v-overlay>

</template>

<script>
import { defineComponent } from 'vue';
import Personal from '@/services/Personal';
import Permiso from '@/services/Permiso';
import Usuario from '@/services/Usuario';
export default defineComponent({
    props: ['item_user_parent'],
    emits: ['isCloseDialogForm', 'isUpdateLocalDataTable', 'isSnackbarMessageView',],
    data() {
        const change_overlay = false;
        const show = false;
        const ci = "";
        const change_search_personal = null;
        const groups_permissions = [];
        const city_permissions = [];
        const list_city_permissions = [];
        const list_groups_permissions = [];
        const item_user = this.props.item_user_parent;
        const message_errors_field = {};
        return {
            show,
            ci,
            change_search_personal,
            list_city_permissions,
            list_groups_permissions,
            groups_permissions,
            city_permissions,
            item_user,
            message_errors_field,
            change_overlay,
        }
    },//data

    setup(props, { emit }) {
        return {
            props, emit
        }
    },//setup

    computed: {
        getValidateErrors() {
            return function (property) {
                if (this.message_errors_field && this.message_errors_field[property]) {
                    return this.message_errors_field[property][0];
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
                if (response.status) {
                    this.props.item_user_parent.nombre_completo = `${response.record.nombres} ${response.record.apellido_paterno} ${response.record.apellido_materno}`;
                    this.props.item_user_parent.id_personal = response.record.id;
                    this.props.item_user_parent.ciudad = response.record.ciudad;
                    this.emit('isSnackbarMessageView', 'success', response.message)

                } else {
                    this.emit('isSnackbarMessageView', 'error', response.message)
                }
                this.ci = ""; 'Santa-Cruz'
            }, 800);

        },

        async listPermissions() {
            const permiso = new Permiso();
            const response = await permiso.index();
            if (response.status) {
                const list_permisos = response.records;
                // Filtrar solo los elementos de tipo "ciudades"
                this.list_city_permissions = list_permisos.filter(row => row.content_type == 'ciudades');
                //filtrar todos los grupos
                const list_groups = list_permisos.filter(row => row.content_type == 'grupos');

                const list_ciudades = this.list_city_permissions.map(row => row.code_content);

                //ahora agrupamos las ciudades con sus respectivos grupos
                list_ciudades.forEach(city => {
                    const grupos = list_groups.filter(item => item.code_content.includes(city)).map(item => item.code_content);
                    this.list_groups_permissions.push({
                        ciudad: city,
                        grupos: grupos,
                    });
                });

            } else {
                this.emit('isSnackbarMessageView', 'error', response.message)
            }

        },

        async save() {
            const usuario = new Usuario();
            usuario.setFill(this.item_user);
            usuario.setParameter({
                permissions: [...this.city_permissions, ...this.groups_permissions]
            });

            if (this.item_user.id > 0) {
                // cuando sea update 
                const response = await usuario.update();
                if (response.status) {
                    this.emit('isSnackbarMessageView', 'success', response.message)
                    this.emit('isUpdateLocalDataTable', 'edit', response.record);
                    this.emit('isCloseDialogForm');
                } else {
                    if (response.message_errors != undefined) {
                        this.message_errors_field = response.message_errors;
                    }
                    this.emit('isSnackbarMessageView', 'error', response.message)
                }

            } else {
                //cuando es un registro nuevo
                const response = await usuario.create()

                if (response.status) {
                    this.message_errors_field = response.message_errors;
                    this.emit('isSnackbarMessageView', 'success', response.message)
                    this.emit('isUpdateLocalDataTable', 'new', response.record);
                    this.emit('isCloseDialogForm');

                } else {
                    if (response.message_errors != undefined) {
                        this.message_errors_field = response.message_errors;
                    }
                    this.emit('isSnackbarMessageView', 'error', response.message)
                }
            }

        },//save

        async loadUserPermission() {
            const usuario = new Usuario(this.item_user);

            const response = await usuario.userPermission();
            if (response.status) {
                const permisos = response.records;
                //filter => objetos segun condicion
                //map => nos devulve un array
                this.city_permissions = permisos.filter(row => row.content_type == 'ciudades').map(row => row.code_content);
                this.groups_permissions = permisos.filter(row => row.content_type == 'grupos').map(row => row.code_content);
            }

        },

    },//methods

    watch: {
        // verifica si el usuario ha selecciona una ciudad
        // en group_permissions solo debe de haber los grupos de las ciudades habilitadas por el usuario
        city_permissions(new_value, old_value) {
            let copy_groups_permissions = [];
            new_value.forEach(city => {
                // ise con el metodo filter para filtrar por ciudad, NO funciona ( this.groups_permissions.filter() )
                // porque el orden de iteracion segun el valor de city  y crea un copy_groups_permissions solo para un ciudad 
                for (let i = 0; i < this.groups_permissions.length; i++) {
                    if (this.groups_permissions[i].includes(city)) {
                        copy_groups_permissions.push(this.groups_permissions[i]);
                    }
                }
            });
            this.groups_permissions = copy_groups_permissions;

        }
    },
    async mounted() {
        this.change_overlay = true;
        setTimeout(async () => {
            await this.listPermissions();
            //cuando es update listamos los permisos de usuarios
            if (this.item_user.id > 0) {
                await this.loadUserPermission();
            }
            this.change_overlay = false;
        }, 400);

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
