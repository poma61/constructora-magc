<template>
    <div class="box">
        <div class="px-5 my-3" style="border-bottom: 2px solid #dddddd;">
            <span class="icon is-small is-size-1 has-text-primary">
                <span class="mdi mdi-account-lock"></span>
            </span>
        </div>
        <progress class="progress is-small is-primary" max="100" v-if="loading_data_profile">100%</progress>
        <div class="is-flex is-justify-content-center is-flex-direction-column is-align-items-center"
            v-if="!loading_data_profile">
            <div class="m-1">
                <figure class="image is-128x128">
                    <img class="is-rounded" :src="`${app.BASE_URL}/${user_autenticate.foto}`">
                </figure>
            </div>

            <div class="table-container " style="width: 100%;">
                <table class="table table is-striped table is-fullwidth">
                    <thead>
                        <tr>
                            <th>Nombres</th>
                            <th>Apellido paterno</th>
                            <th>Apellido materno</th>
                            <th>Cargo</th>
                            <th>CI</th>
                            <th>Telefono</th>
                            <th>Direccion</th>
                            <th>Rol</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ user_autenticate.nombres }}</td>
                            <td>{{ user_autenticate.apellido_paterno }}</td>
                            <td>{{ user_autenticate.apellido_materno }}</td>
                            <td>{{ user_autenticate.cargo }}</td>
                            <td>{{ user_autenticate.ci }} {{ user_autenticate.ci_expedido }}</td>
                            <td>{{ user_autenticate.telefono }}</td>
                            <td>{{ user_autenticate.direccion }}</td>
                            <td>{{ user_autenticate.role }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <div class="box" v-if="!loading_data_profile">
        <form class="is-flex is-flex-wrap-wrap" style="width: 100%;">

            <div class="field m-1" style="width: 100%; ">
                <label class="label has-text-info">Usuario</label>
                <p class="control has-icons-left">
                    <input class="input" type="text" placeholder="Escriba aquí..." v-model="is_user.usuario">
                    <span class="icon is-small is-left has-text-info">
                        <span class="mdi mdi-account"></span>
                    </span>
                </p>
                <p class="has-text-danger as-font-9">{{ getValidateErrors('usuario') }}</p>
            </div>

            <div class="field m-1" style="width: 100%; ">
                <label class="label has-text-info">Contraseña anterior</label>
                <p class="control has-icons-left">
                    <input class="input" type="password" placeholder="Escriba aquí..." v-model="is_user.old_password"
                        autocomplete="none">
                    <span class="icon is-small is-left has-text-info">
                        <span class="mdi mdi-lock-outline"></span>
                    </span>
                </p>
                <p class="has-text-danger as-font-9">{{ getValidateErrors('old_password') }}</p>
            </div>

            <div class="field m-1" style="width: 100%; ">
                <label class="label has-text-info">Contraseña nueva</label>
                <p class="control has-icons-left">
                    <input class="input" type="password" placeholder="Escriba aquí..." v-model="is_user.new_password"
                        autocomplete="none">
                    <span class="icon is-small is-left has-text-info">
                        <span class="mdi mdi-lock-outline"></span>
                    </span>
                </p>
                <p class="has-text-danger as-font-9">{{ getValidateErrors('new_password') }}</p>
            </div>

        </form>

        <div class="buttons is-right mt-3">
            <button :class="loading_save_credentials ? 'button is-info is-loading' : 'button is-info'"
                @click="saveCredentials()">
                <span class="icon is-size-5">
                    <span class="mdi mdi-account-lock"></span>
                </span>
                <span>Actualizar credenciales</span>
            </button>
        </div>
    </div>

    <div v-if="!loading_data_profile">
        <p class="has-text-danger as-font-9">NOTA: Solo se puede actualizar las credenciales de inicio de sesion, para
            actualizar
            los datos personales debe comunicarse con el administrador del sistema.</p>
        <p class="has-text-danger as-font-9"> SI eres administrador del sistema debes ir al menu 'Personal' y actualizar los
            datos.</p>
    </div>
</template>

<script setup>
import app from '@/config/app.js';
import toastr from 'toastr';
import AuthProfile from '@/services/AuthProfile';
import { computed, onMounted, ref } from 'vue';

//data
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
    role: "",
    usuario: "",
    id_usuario: "",
});


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
        const user = new AuthProfile();
        const response = await user.me();
        loading_data_profile.value = false;
        if (response.status) {
            user_autenticate.value = Object.assign({}, response.record);
            viewToast('success', response.message);
            is_user.value.usuario = user_autenticate.value.usuario;
            is_user.value.id_usuario = user_autenticate.value.id_usuario;
        } else {
            viewToast('error', response.message);
        }
    }, 1000);

}

const saveCredentials = () => {
    loading_save_credentials.value = true;
    setTimeout(async () => {
        const user = new AuthProfile(is_user.value);
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


onMounted(() => {
    me();
});
</script>

