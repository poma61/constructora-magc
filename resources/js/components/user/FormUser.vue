<template>
    <v-dialog v-model="props.dialog_form_parent" max-width="500px" persistent transition="dialog-bottom-transition">
        <div class="card">
            <header class="card-header has-background-link">
                <p class="card-header-title has-text-white">
                    <v-icon size="50" icon="mdi-account-box" />&nbsp;REGISTRAR USUARIO
                </p>
            </header>
            <div class="card-content as-form">
                <form>
                    <div class="is-flex is-flex-direction-column">

                        <v-text-field color="orange-darken-2" label="Ciudad" v-model="props.item_user_parent.ciudad"
                            readonly />

                        <v-text-field color="cyan-darken-2" label="Usuario" v-model="props.item_user_parent.usuario"
                            :error-messages="getValidateErrors('usuario')"    autocomplete="none"/>

                        <v-text-field color="cyan-darken-2" label="Contraseña" :type="show ? 'text' : 'password'"
                            :append-inner-icon="show ? 'mdi-eye' : 'mdi-eye-off'" @click:append-inner="show = !show"
                            v-model="props.item_user_parent.password" :error-messages="getValidateErrors('password')"    autocomplete="none"/>


                        <v-radio-group v-model="props.item_user_parent.role" label="Rol" inline
                            :error-messages="getValidateErrors('role')">
                            <v-radio label="Normal" value="Normal" color="cyan-darken-2"></v-radio>
                            <v-radio label="Administrador" value="Administrador" color="cyan-darken-2"></v-radio>

                        </v-radio-group>

                        <v-text-field color="cyan-darken-2" label="Personal" readonly
                            v-model="props.item_user_parent.nombre_completo_personal"
                            :error-messages="getValidateErrors('id_personal')" />

                        <div class="columns">
                            <div class="column is-four-fifths">
                                <v-text-field density="compact" label="Buscar Personal" prepend-inner-icon="mdi-magnify"
                                    color="cyan-darken-2" v-model="ci" :loading="change_search_personal"
                                    @keyup.enter="searchPersonal()" placeholder="Introduzca el CI del personal" />
                            </div>

                            <div class="column">
                                <v-btn icon="mdi-magnify" size="compact" color="orange-darken-3" variant="outlined"
                                    class="pa-3" @click="searchPersonal()"></v-btn>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="is-flex  is-justify-content-center  is-align-items-center p-2" style="width: 100%;">
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

        <v-snackbar v-model="snackbar_search_personal.value" :timeout="2500" color="cyan-darken-2">
            <div class="is-flex is-justify-content-center is-align-items-center">
                <v-icon icon="mdi-alert" size="50" />
                <p class="is-size-6">
                    No se encontro ningun registro para&nbsp;
                    <span class="has-text-weight-bold">{{ snackbar_search_personal.text }}</span>
                </p>
            </div>
        </v-snackbar>

    </v-dialog>
</template>


<script>
import { defineComponent } from 'vue';
import Usuario from '@/services/Usuario';
export default defineComponent({
    props: ["dialog_form_parent", 'item_user_parent', 'message_errors_field_parent'],
    emits: ['closeDialogFormParent', 'saveParent'],
    data() {
        const show = false;
        const ci = "";
        const snackbar_search_personal = { value: false, text: "" };
        const change_search_personal = null;

        return { show, ci, snackbar_search_personal, change_search_personal }
    },//data

    setup(props, { emit }) {
        const closeDialogFormChild = () => {
            emit('closeDialogFormParent');
        }

        const saveChild = () => {
            emit('saveParent');
        }

        return { props, closeDialogFormChild, saveChild }
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
            const usuario = new Usuario(this.props.item_user_parent.ciudad);
            this.change_search_personal = 'cyan';
            setTimeout(async () => {
                const response = await usuario.buscarPersonal(this.ci);
                this.change_search_personal = null;
                if (response.status) {
                    this.props.item_user_parent.nombre_completo_personal = `${response.record.nombres} ${response.record.apellido_paterno} ${response.record.apellido_materno}`;
                    this.props.item_user_parent.id_personal = response.record.id;
                } else {
                    this.snackbar_search_personal.text = this.ci;
                    this.snackbar_search_personal.value = true;
                }
                this.ci = "";
            }, 1000);

        },

    },//methods

});


</script>
