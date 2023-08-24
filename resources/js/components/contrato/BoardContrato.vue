<template>
    <div class="buttons">

        <v-btn @click="initData()" color="deep-purple-lighten-2" class="as-hover__box-shadow m-1">
            <v-icon icon="mdi-note-plus-outline"></v-icon>&nbsp;Recargar tablero
        </v-btn>


        <v-btn @click="newForm()" color="deep-purple-lighten-2" class="as-hover__box-shadow m-1">
            <v-icon icon="mdi-note-plus-outline"></v-icon>&nbsp;Nuevo contrato
        </v-btn>

    </div>

    <div class="card" v-if="show_data_table">
        <v-text-field v-model="buscar" append-inner-icon="mdi-magnify" clearable label="Buscar Registros..."
            color="deep-purple-lighten-2" />
        <v-data-table :hover="true" :items="data" :headers="columns" :search="buscar" :loading="loading_data_table"
            :items-per-page-options="items_per_page_options" :show-current-page="true" :fixed-header="true"
            page-text="{0}-{1} de {2}" :height="500" :sort-by="[{ key: 'id', order: 'desc' }]">


        </v-data-table>

    </div>

    <BoardFormContrato v-if="show_form" />
</template>

<script setup>
import { VDataTable } from 'vuetify/labs/VDataTable';
import BoardFormContrato from '@/components/contrato/BoardFormContrato.vue';
import { ref } from 'vue';
import { onMounted } from 'vue';
//data
const data = ref([]);
const buscar = ref("");
const loading_data_table = ref(null);
const show_form = ref(false);
const show_data_table = ref(true);
const items_per_page_options = ref([
    { value: 10, title: '10' },
    { value: 25, title: '25' },
    { value: 50, title: '50' },
    { value: 100, title: '100' },
]);
const columns = ref([
    { title: 'Nombres cliente', key: 'nombres' },
    { title: 'N° de contrato', key: 'n_de_contrato' },
    { title: 'Fecha de firma', key: 'fecha_de_firma' },
    { title: 'Monto total', key: 'monto_total' },
    { title: 'Couta inicial', key: 'couta_inicial' },
    { title: 'Couta mensual', key: 'couta_mensual' },
    { title: 'Fecha de pago couta mensual', key: 'fecha_pago_couta_mensual' },
    { title: 'Descripcion', key: 'descripcion' },
]);


const viewSnackbar = (type, mesage) => {

}
const newForm = () => {
    showForm();
}

const showForm = () => {
    show_form.value = true;
    show_data_table.value = false;
}

const showDataTable = () => {
    show_data_table.value = true;
    show_form.value = false;
}

const initData = () => {
    showDataTable();
    loading_data_table.value = 'deep-purple-lighten-2';
    setTimeout(async () => {
        loading_data_table.value = null;
    }, 1000);

};

onMounted(() => {
    initData();
});

</script>

