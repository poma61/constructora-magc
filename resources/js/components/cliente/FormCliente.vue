<template>
    <v-dialog v-model="props.dialog_form_parent" max-width="500px" persistent transition="dialog-bottom-transition">
        <div class="card">
            <div class="card-header has-background-success">
                <p class="card-header-title has-text-white">
                        <v-icon icon="mdi-account-group" size="50" />
                        &nbsp;REGISTRAR CLIENTE |&nbsp;
                    <!--  fg-->
                <nav class="breadcrumb" aria-label="breadcrumbs">
                    <ul>
                        <li>
                            <div class="has-text-black">
                                <span class="icon is-small">
                                    <i class="mdi mdi-city" aria-hidden="true"></i>
                                </span>
                                <span>{{ props.city_parent }}</span>
                            </div>
                        </li>
                        <li>
                            <div class="has-text-black">
                                <span class="icon is-small">
                                    <i class="mdi mdi-group" aria-hidden="true"></i>
                                </span>
                                <span>Grupo {{ props.group_parent }}</span>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- df -->
                </p>

            </div>

            <div class="card-content as-form">
                <div class="is-flex is-flex-direction-column">

                    <v-text-field label="Nombres" color="orange-darken-2" v-model="props.item_cliente_parent.nombres"
                        append-inner-icon="mdi-text-box-edit" clearable
                        :error-messages="getViewMessageErrorsField('nombres')" />

                    <v-text-field label="Apellido paterno" color="orange-darken-2"
                        v-model="props.item_cliente_parent.apellido_paterno" append-inner-icon="mdi-text-box-edit" clearable
                        :error-messages="getViewMessageErrorsField('apellido_paterno')" />

                    <v-text-field label="Apellido materno" color="orange-darken-2"
                        v-model="props.item_cliente_parent.apellido_materno" append-inner-icon="mdi-text-box-edit" clearable
                        :error-messages="getViewMessageErrorsField('apellido_materno')" />

                    <v-text-field label="N° de contacto" color="orange-darken-2"
                        v-model="props.item_cliente_parent.n_de_contacto" append-inner-icon="mdi-text-box-edit" clearable
                        :error-messages="getViewMessageErrorsField('n_de_contacto')" />


                    <v-autocomplete label="Estado"
                        :items="['Cancelada', 'Programada', 'Por reprogramar', 'Se llevo a cabo', 'Firma de contrato', 'Otro']"
                        v-model="props.item_cliente_parent.estado" color="orange-darken-2"
                        append-inner-icon="mdi-text-box-edit" clearable=""
                        :error-messages="getViewMessageErrorsField('estado')" />

                    <v-text-field label="Monto inicial" color="orange-darken-2"
                        v-model="props.item_cliente_parent.monto_inicial" append-inner-icon="mdi-text-box-edit" clearable
                        :error-messages="getViewMessageErrorsField('monto_inicial')" />

                    <v-textarea label="Descripcion" v-model="props.item_cliente_parent.descripcion" color="orange-darken-2"
                        append-inner-icon="mdi-text-box-edit" clearable
                        :error-messages="getViewMessageErrorsField('descripcion')" />

                        <v-textarea label="Seguimiento" v-model="props.item_cliente_parent.seguimiento" color="orange-darken-2"
                        append-inner-icon="mdi-text-box-edit" clearable
                        :error-messages="getViewMessageErrorsField('seguimiento')" />
                        
                </div>
            </div>
            <div class="is-flex is-justify-content-end is-align-items-center p-2">


                <div class="m-1">
                    <v-btn class="has-background-success has-text-white as-hover__box-shadow" @click="saveChild()">
                        <v-icon icon="mdi-content-save-all" />&nbsp;Guardar
                    </v-btn>
                </div>
                
                <div class="m-1">
                    <v-btn class="has-background-danger has-text-white as-hover__box-shadow"
                        @click="closeDialogFormChild()">
                        <v-icon icon="mdi-cancel" />&nbsp;Cancelar
                    </v-btn>
                </div>
            </div>

        </div>
    </v-dialog>
</template>


<script>
import { defineComponent } from 'vue';

export default defineComponent({
    props: ['dialog_form_parent', 'item_cliente_parent', 'message_errors_field_parent', 'group_parent', 'city_parent'],
    emits: ['saveParent', 'closeDialogFormParent'],
    data() {
        return {

        }
    },

    setup(props, { emit }) {
        const closeDialogFormChild = () => {
            emit('closeDialogFormParent')
        }
        const saveChild = () => {
            emit('saveParent')
        }
        return { props, closeDialogFormChild, saveChild }
    },

    computed: {
        getViewMessageErrorsField() {

            return function (property) {
                if (this.props.message_errors_field_parent[property]) {
                    return this.message_errors_field_parent[property][0];
                }

                return "";
            };
        }
    },//computed

});

</script>