<template>
    <div class="card">
        <header class="card-header has-background-info">
            <p class="card-header-title has-text-white">
                <v-icon size="50" icon="mdi-account-box" />&nbsp;REGISTRAR USUARIO
            </p>
        </header>
        <div class="card-content as-form">
            <form>
                <div class="is-flex is-flex-wrap-wrap" style="width: 100%;">
                    <v-text-field color="cyan-darken-2" label="Usuario" v-model="item_user.usuario"
                        :error-messages="getValidateErrors('usuario')" autocomplete="none" class="ma-1"
                        style="min-width:250px ;" />

                    <v-text-field color="cyan-darken-2" label="Contraseña" :type="show ? 'text' : 'password'"
                        :append-inner-icon="show ? 'mdi-eye' : 'mdi-eye-off'" @click:append-inner="show = !show"
                        v-model="item_user.password" :error-messages="getValidateErrors('password')" autocomplete="none"
                        class="ma-1" style="min-width:250px ;" />
                </div>

                <div class="is-flex">
                    <v-text-field class="ma-1" density="compact" label="Buscar Personal"
                        prepend-inner-icon="mdi-magnify" color="cyan-darken-2" v-model="ci"
                        :loading="change_search_personal" @keyup.enter="searchPersonal()"
                        placeholder="Introduzca C.I. del personal" />

                    <v-btn icon="mdi-magnify" color="orange-darken-3" variant="elevated" class="ma-1"
                        @click="searchPersonal()"></v-btn>
                </div>

                <div class="is-flex is-flex-wrap-wrap">

                    <v-text-field class="ma-1" color="cyan-darken-2" label="Personal" readonly
                        v-model="item_user.nombre_completo" :error-messages="getValidateErrors('id_personal')"
                        style="min-width: 250px;" />

                    <v-text-field class="ma-1" color="cyan-darken-2" label="Ciudad" readonly v-model="item_user.ciudad"
                        style="min-width: 250px;" />
                </div>

                <v-divider class="border-opacity-50"></v-divider>

                <div class="mx-2">
                    <p class="text-info">Todos los modulos | Acceso a las ciudades de: </p>
                    <div class="as-flex-content-permisions">
                        <!-- renderizamos los permisos la parte de ciudades -->
                        <v-checkbox v-for="(city, idx) in list_city_permissions" :key="idx" :label="city.code"
                            :value="city.code" hide-details color="success" class="item-flex-permisions"
                            v-model="user_city_permissions">
                        </v-checkbox>
                    </div>
                </div>

                <v-divider class="border-opacity-50"></v-divider>

                <div class="mx-2">
                    <!-- renderizamos los permisos la parte de grupos -->
                    <div v-for="(ciudad_grupo, idx) in list_cliente_groups_permissions" :key="idx">
                        <p class="text-info">Modulo Cliente | {{ ciudad_grupo.ciudad }} | Administra grupos:</p>
                        <div class="as-flex-content-permisions">
                            <!-- el grupo viene de esta forma "Santa-Cruz_01" -->
                            <!-- split => divide un string a partir de "_" y obtenemos ["Santa-Cruzz","01"] -->
                            <v-switch v-for="(grupo, grupo_index) in ciudad_grupo.grupos" :key="grupo_index"
                                :label="grupo.split('_')[1]" :value="grupo" class="item-flex-permisions" color="success"
                                hide-details inset
                                :disabled="user_city_permissions.includes(ciudad_grupo.ciudad) ? false : true"
                                v-model="user_cliente_groups_permissions">
                            </v-switch>
                        </div>
                    </div>
                </div>

                <v-divider class="border-opacity-50"></v-divider>

                <div class="mx-2">
                    <p class="text-info">Modulo Cliente | Registros: </p>

                    <div style="width: fit-content; height: 83px">
                        <v-radio-group v-model="user_cliente_records_reading_permissions">
                            <v-radio v-for="(row, idx) in list_cliente_records_reading_permissions" :label="row.name"
                                :value="row.code" color="cyan-darken-2" :key="idx" />
                        </v-radio-group>
                    </div>
                    <div style="width: fit-content; margin-left: 10px;">
                        <v-switch v-for="(row, idx) in list_cliente_records_actions_permissions" :key="idx"
                            :label="row.name" :value="row.code" hide-details color="cyan-darken-2"
                            v-model="user_cliente_records_actions_permissions" />
                    </div>
                </div>

                <v-divider class="border-opacity-50"></v-divider>

                <div class="mx-2">
                    <p class="text-info">Modulo administrativo: </p>
                    <div class="as-flex-content-permisions">
                        <!-- renderizamos los permisos la parte de ciudades -->
                        <v-switch v-for="(row, idx) in list_modules_permissions" :key="idx" :label="row.name"
                            :value="row.code" hide-details color="success" class="item-flex-permisions"
                            v-model="user_module_permissions">
                        </v-switch>
                    </div>
                </div>

                <!-- Aclaracion de todos los permisos -->
                <v-divider class="border-opacity-50"></v-divider>
                <div class="mx-2">
                    <p class="text-info">Todos los usuarios tiene acceso por defecto a los modulos: </p>
                    <ol class="ml-5">
                        <ul><span class="mdi mdi-arrow-right-bottom"></span> Clientes</ul>
                        <ul><span class="mdi mdi-arrow-right-bottom"></span> Contratos</ul>
                        <ul><span class="mdi mdi-arrow-right-bottom"></span> Control de obras</ul>
                        <ul><span class="mdi mdi-arrow-right-bottom"></span> Finanzas de construccion</ul>
                        <ul><span class="mdi mdi-arrow-right-bottom"></span> Inventario</ul>
                        <ul><span class="mdi mdi-arrow-right-bottom"></span> CCD</ul>
                        <ul><span class="mdi mdi-arrow-right-bottom"></span> Diseño</ul>
                    </ol>
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
        const user_cliente_groups_permissions = [];
        const user_city_permissions = [];
        const list_city_permissions = [];
        const list_cliente_groups_permissions = [];
        const item_user = this.props.item_user_parent;
        const message_errors_field = {};
        const list_modules_permissions = [];
        const list_cliente_records_actions_permissions = [];
        const list_cliente_records_reading_permissions = [];
        const user_module_permissions = [];
        const user_cliente_records_actions_permissions = [];
        const user_cliente_records_reading_permissions = null;
        return {
            show,
            ci,
            change_search_personal,
            list_city_permissions,
            list_cliente_groups_permissions,
            list_modules_permissions,
            list_cliente_records_actions_permissions,
            list_cliente_records_reading_permissions,
            user_cliente_groups_permissions,
            user_city_permissions,
            user_module_permissions,
            item_user,
            message_errors_field,
            change_overlay,
            user_cliente_records_actions_permissions,
            user_cliente_records_reading_permissions,
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
                // Filtrar solo los elementos de tipo "cities", para permisos de ciudad de todos los modulos
                this.list_city_permissions = list_permisos.filter(row => row.type == 'cities');

                //filtrar elementos de tipo module, para permisos de modulo
                this.list_modules_permissions = list_permisos.filter(row => row.type == "module")

                //filtrar
                this.list_cliente_records_actions_permissions = list_permisos.filter(row => row.type_content == "cliente_module_records_actions")
                this.list_cliente_records_reading_permissions = list_permisos.filter(row => row.type_content == "cliente_module_records_reading")

                //filtrar elementos de tipo module_cliente_groups, para permisos de grupos en el modulo cliente
                const list_cliente_groups = list_permisos.filter(row => row.type_content == 'module_cliente_groups');


                //ahora agrupamos las ciudades con sus respectivos grupos
                const ciudades = this.list_city_permissions.map(row => row.code);
                ciudades.forEach(city => {
                    // 'includes' verifica si la cadena city está presente dentro de la cadena code.
                    // El método .map() en JavaScript se utiliza para transformar cada elemento de un array y crear
                    // un nuevo array con los resultados de esa transformación
                    const grupos = list_cliente_groups.filter(item => item.code.includes(city)).map(item => item.code);

                    this.list_cliente_groups_permissions.push({
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
            const all_permissions = [
                ...this.user_city_permissions,
                ...this.user_cliente_groups_permissions,
                ...this.user_module_permissions,
                ...this.user_cliente_records_actions_permissions,
            ];

            // agregar el permiso de lectura de datos solo si no esta null
            // si enviamos null habra error en el backend
            if (this.user_cliente_records_reading_permissions != null) {
                all_permissions.push(this.user_cliente_records_reading_permissions)
            }

            usuario.setParameter({
                permissions: all_permissions
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

                // filter => objetos segun condicion
                // map => nos devulve un array
                // filtrar cities para ver si tiene acceso a todos los modulos
                this.user_city_permissions = permisos.filter(row => row.type == 'cities').map(row => row.code);
                this.user_module_permissions = permisos.filter(row => row.type == 'module').map(row => row.code);

                this.user_cliente_groups_permissions = permisos.filter(row => row.type_content == 'module_cliente_groups').map(row => row.code);

                this.user_cliente_records_actions_permissions = permisos.filter(row => row.type_content == 'cliente_module_records_actions').map(row => row.code);

                const is_user_cliente_records_reading_permissions = permisos.filter(row => row.type_content == 'cliente_module_records_reading').map(row => row.code);
                is_user_cliente_records_reading_permissions.forEach(row => {
                    this.user_cliente_records_reading_permissions = row;
                })

            } else {
                this.emit('isSnackbarMessageView', 'error', response.message)
            }
        },

    },//methods

    watch: {
        // verifica si el usuario ha selecciona una ciudad
        // en group_permissions solo debe de haber los grupos de las ciudades habilitadas por el usuario
        user_city_permissions(new_value, old_value) {
            let copy_groups_permissions = [];
            new_value.forEach(city => {
                // ise con el metodo filter para filtrar por ciudad, NO funciona ( this.user_cliente_groups_permissions.filter() )
                // porque el orden de iteracion segun el valor de city  y crea un copy_groups_permissions solo para un ciudad 
                for (let i = 0; i < this.user_cliente_groups_permissions.length; i++) {
                    if (this.user_cliente_groups_permissions[i].includes(city)) {
                        copy_groups_permissions.push(this.user_cliente_groups_permissions[i]);
                    }
                }
            });
            this.user_cliente_groups_permissions = copy_groups_permissions;

        },

    }, // watch

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
    margin: 10px 5px;
}
</style>
