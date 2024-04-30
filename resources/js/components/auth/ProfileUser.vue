<template>
    <div class="box">
        <div class="px-5 my-3" style="border-bottom: 2px solid #dddddd;">
            <span class="icon is-small is-size-1 has-text-info">
                <span class="mdi mdi-account-lock"></span>
            </span>
        </div>

        <progress class="progress is-small is-info" max="100" v-if="loading_data_profile">100%</progress>

        <div class="is-flex is-justify-content-center is-align-items-center" v-if="!loading_data_profile">
        <div class="box">
            <form class="is-flex is-flex-wrap-wrap">
                <div class="field m-1">
                    <label class="label has-text-info">Usuario</label>
                    <p class="control has-icons-left">
                        <input class="input" type="text" placeholder="Escriba aquí..." v-model="is_user.usuario">
                        <span class="icon is-small is-left has-text-info">
                            <span class="mdi mdi-account"></span>
                        </span>
                    </p>
                    <p class="has-text-danger as-font-9">{{ getValidateErrors('usuario') }}</p>
                </div>
                <div class="field m-1">
                    <label class="label has-text-info">Contraseña anterior</label>
                    <p class="control has-icons-left">
                        <input class="input" type="password" placeholder="Escriba aquí..."
                            v-model="is_user.old_password" autocomplete="none">
                        <span class="icon is-small is-left has-text-info">
                            <span class="mdi mdi-lock-outline"></span>
                        </span>
                    </p>
                    <p class="has-text-danger as-font-9">{{ getValidateErrors('old_password') }}</p>
                </div>
                <div class="field m-1">
                    <label class="label has-text-info">Contraseña nueva</label>
                    <p class="control has-icons-left">
                        <input class="input" type="password" placeholder="Escriba aquí..."
                            v-model="is_user.new_password" autocomplete="none">
                        <span class="icon is-small is-left has-text-info">
                            <span class="mdi mdi-lock-outline"></span>
                        </span>
                    </p>
                    <p class="has-text-danger as-font-9">{{ getValidateErrors('new_password') }}</p>
                </div>
            </form>
            <div class="is-flex is-justify-content-end is-align-items-center m-2">
                <button :class="loading_save_credentials ? 'button is-info is-loading' : 'button is-info'"
                    @click="saveCredentials()">
                    <span class="icon is-size-5">
                        <span class="mdi mdi-account-lock"></span>
                    </span>
                    <span>Actualizar credenciales</span>
                </button>
            </div>
        </div>
    </div>
        <div class="is-flex is-justify-content-center is-flex-direction-column is-align-items-center"
            v-if="!loading_data_profile">
            <div class="m-1">
                <figure class="image is-128x128">
                    <img class="is-rounded" :src="`${app.BASE_URL}/${user_autenticate.foto}`">
                </figure>
            </div>

            <div class="table-container " v-if="!loading_data_profile">
                <table class="table" style="overflow: none; overflow-x: auto;">
                    <tbody>
                        <tr>
                            <th>Nombre completo:</th>
                            <td class="m-1">{{ user_autenticate.nombres }}</td>
                        </tr>

                        <tr>
                            <th>C.I.:</th>
                            <td class="m-1">{{ user_autenticate.ci }} {{ user_autenticate.ci_expedido }}</td>
                        </tr>

                        <tr>
                            <th>Cargo:</th>
                            <td class="m-1">{{ user_autenticate.cargo }}</td>
                        </tr>

                        <tr>
                            <th>direccion:</th>
                            <td class="m-1">{{ user_autenticate.direccion }}</td>
                        </tr>

                        <tr>
                            <th>Telefono:</th>
                            <td class="m-1">{{ user_autenticate.telefono }}</td>
                        </tr>

                        <tr>
                            <th>Usuario:</th>
                            <td class="m-1">{{ user_autenticate.usuario }}</td>
                        </tr>
                        <tr>
                            <th>Contraseña:</th>
                            <td>
                                <span class="tag is-warning m-1">
                                    Cifrado de extremo a extremo.
                                </span>
                            </td>
                        </tr>

                        <tr>
                            <th>Todos los modulos | Acceso a las ciudades de :</th>
                            <td>
                                <span class="tag is-info m-1" v-for="(city, index) in city_permissions" :key="index">
                                    {{ city }}
                                </span>
                                <span class="tag is-danger m-1" v-if="city_permissions.length == 0">
                                    Sin asignar ciudad.
                                </span>
                            </td>
                        </tr>

                        <tr v-for="(city_group, index_city_group) in groups_permissions" :key="index_city_group">
                            <th>
                                Modulo Cliente | {{ city_group.ciudad }} | Administra grupos:
                            </th>
                            <td>
                                <span class="tag is-success m-1" v-for="(group, index_grupo) in city_group.grupos"
                                    :index="index_grupo">
                                    <!-- el grupo viene de esta forma "Santa-Cruz_01" -->
                                    <!-- split => divide un string a partir de "_" y obtenemos ["Santa-Cruzz","01"] -->
                                    {{ group.split("_")[1] }}
                                </span>

                                <span class="tag is-danger m-1" v-if="city_group.grupos.length == 0">
                                    Sin asignar grupos.
                                </span>

                            </td>
                        </tr>

                        <tr>
                            <th>
                                Acceso a modulos administrativos:
                            </th>
                            <td>
                                <span class="tag is-success m-1" v-for="(module, index) in module_permissions"
                                    :key="index" :index="index">
                                    <!-- el grupo viene de esta forma "Santa-Cruz_01" -->
                                    <!-- split => divide un string a partir de "_" y obtenemos ["Santa-Cruzz","01"] -->
                                    {{ module }}
                                </span>

                                <span class="tag is-danger m-1" v-if="module_permissions.length == 0">
                                    Sin asignar modulos administrativos.
                                </span>
                            </td>
                        </tr>


                        <tr>
                            <th>Registros :</th>
                            <td>
                                <span v-if="record_permissions != null" class="tag is-info m-1">
                                    {{ record_permissions }}
                                </span>

                                <span v-else class="tag is-danger m-1">
                                    Sin asignar registros.
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Acceso por defecto a los modulos:</th>
                            <td>
                                <span class="tag is-link m-1"> Clientes</span>
                                <span class="tag is-link m-1">Contratos</span>
                                <span class="tag is-link m-1"> Control de obras</span>
                                <span class="tag is-link m-1"> Finanzas de construccion</span>
                                <span class="tag is-link m-1">Inventario</span>
                                <span class="tag is-link m-1"> CCD</span>
                                <span class="tag is-link m-1"> Diseño</span>
                            </td>
                        </tr>

                    </tbody>
                </table>

            </div>
        </div>
    </div>



    <div class="m-5">
        <p class="has-text-danger as-font-9">NOTA: Solo se puede actualizar las credenciales de inicio de sesion, para
            actualizar
            los datos personales debe comunicarse con el administrador del sistema.</p>
        <p class="has-text-danger as-font-9"> SI eres administrador del sistema debes ir al menu 'Personal' y actualizar
            los
            datos.</p>
    </div>

</template>
<script setup>
import app from '@/config/app.js';
import Auth from '@/services/Auth';
import toastr from 'toastr';
import { computed, onMounted, ref } from 'vue';

// Configurar opciones globales para Toastr (opcional)
toastr.options = {
    closeButton: true,
    progressBar: true,
    positionClass: 'toast-bottom-right',
    timeOut: 3000,
    hideDuration: 100,
};

const loading_data_profile = ref(false);
const loading_save_credentials = ref(false);
const message_errors_field = ref({});
const is_user = ref({
    id_usuario: 0,
    usuario: "",
    old_password: "",
    new_password: "",
});
const user_autenticate = ref({
    nombres: "",
    apellido_paterno: "",
    apellido_materno: "",
    cargo: "",
    ci: "",
    ci_expedido: "",
    telefono: "",
    direccion: "",
    foto: "",
    usuario: "",
    id_usuario: "",
});

const city_permissions = ref([]);
const module_permissions = ref([]);
const groups_permissions = ref([]);
const record_permissions = ref(null);
const ciudades = ref([
    "Santa-Cruz",
    "Chuquisaca",
    "Cochabamba",
    "Potosi",
    "Beni",
    "La-Paz",
    "Pando",
    "Tarija",
    "Oruro",
    "Otros",
]);


const getValidateErrors = computed(() => {
    return function (property) {
        if (message_errors_field.value[property]) {
            return message_errors_field.value[property][0];
        }
        return "";
    };
})

const viewToast = (type, message) => {
    if (type == 'success') {
        toastr.success(message)
    } else {
        toastr.error(message, 'Error')
    }
}

const me = async () => {
    loading_data_profile.value = true;
    setTimeout(async () => {
        const user = new Auth();
        const response = await user.me();
        loading_data_profile.value = false;
        if (response.status) {
            user_autenticate.value = Object.assign({}, response.record);
            is_user.value.usuario = user_autenticate.value.usuario;
            is_user.value.id_usuario = user_autenticate.value.id_usuario;
        } else {
            viewToast('error', response.message);
        }
    }, 800);
}


const saveCredentials = () => {
    loading_save_credentials.value = true;
    setTimeout(async () => {
        const user = new Auth(is_user.value);
        const response = await user.refreshCredentials();
        loading_save_credentials.value = false;
        if (response.status) {
            clear()
            viewToast('success', response.message);
        } else {
            if (response.message_errors != undefined) {
                message_errors_field.value = response.message_errors;
            }
            viewToast('error', response.message);
        }
    }, 800);
}
const clear = () => {
    message_errors_field.value = {};
    is_user.value.old_password = "";
    is_user.value.new_password = "";
};

const loadUserPermission = async () => {
    const usuario = new Auth();
    const response = await usuario.onPermission();
    if (response.status) {
        const permisos = response.records;

        city_permissions.value = permisos.filter(row => row.type_content == 'cities').map(row => row.name);
        module_permissions.value = permisos.filter(row => row.type == 'module').map(row => row.name);
        const is_record_permissions = permisos.filter(row => row.type == 'records');
        is_record_permissions.forEach(row => {
            record_permissions.value = row.name;
        })

        //ahora agrupamos las ciudades con sus respectivos grupos
        //filter => devuelve un array de objetos segun cumplan la condicion
        // map => devuelve un array
        const list_groups = permisos.filter(row => row.type_content == 'groups');
        let grupos;
        ciudades.value.forEach(city => {
            //filter => devulve un array segun condicion
            //map => nos devulve un array
            grupos = list_groups.filter(item => item.code_content.includes(city)).map(item => item.code_content);
            groups_permissions.value.push({
                ciudad: city,
                grupos: grupos,
            });
        });
    } else {
        viewToast('error', response.message);
    }
}

onMounted(async () => {
    await me();
    await loadUserPermission();

});
</script>
