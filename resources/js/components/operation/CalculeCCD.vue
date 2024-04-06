<template>

    <!-- Inpust  editables -->
    <div class="box">
        <div class="is-flex is-align-items-center my-3 py-3" style="border-bottom: 1px solid #cfcfcf;">
            <span class="icon mx-3 has-text-info">
                <span class="mdi mdi-calculator-variant-outline is-size-1"></span>
            </span>
            <h1 class="has-text-info">CASA CREDITO DIRECTO</h1>
        </div>

        <div clas="is-flex is-flex-wrap-wrap">
            <div class="is-flex is-flex-wrap-wrap">
                <v-text-field v-model="is_ccd_edit.precio_construccion" label="Precio construccion" class="m-1"
                    color="indigo-lighten-1" suffix="$us/m²" clearable style="width: 250px;"
                    @input="fieldAsseptNumber($event, 'precio_construccion')"
                    @click:clear="onClearFieldEdit('precio_construccion')" />

                <v-text-field v-model="is_ccd_edit.superficie" label="Superficie construccion" class="m-1"
                    color="indigo-lighten-1" clearable suffix="m²" style="width: 250px;"
                    @input="fieldAsseptNumber($event, 'superficie')" @click:clear="onClearFieldEdit('superficie')" />

                <v-text-field v-model="is_ccd_edit.precio_terreno" label="Precio Terreno" class="m-1"
                    color="indigo-lighten-1" clearable style="width: 250px;" suffix="$us"
                    @input="fieldAsseptNumber($event, 'precio_terreno')"
                    @click:clear="onClearFieldEdit('precio_terreno')" />
            </div>

            <div class="is-flex is-flex-wrap-wrap">

                <v-text-field v-model="is_ccd_edit.plazo_anios" label="Plazo (años)" class="m-1"
                    color="indigo-lighten-1" clearable style="width: 250px;"
                    @input="plazoAniosAsseptNumberInteger($event, 'plazo_anios')"
                    @click:clear="onClearFieldEdit('plazo_anios')" />

                <v-text-field v-model="is_ccd_edit.interes_anual" label="Interes anual  (%)" class="m-1"
                    color="indigo-lighten-1" clearable style="width: 250px;" suffix="%"
                    @input="fieldAsseptNumber($event, 'interes_anual')"
                    @click:clear="onClearFieldEdit('interes_anual')" />

                <v-text-field v-model="is_ccd_edit.couta_inicial_porcentaje" label="Couta inicial (%)" class="m-1"
                    color="indigo-lighten-1" clearable style="width: 250px;" suffix="%"
                    @input="fieldAsseptNumber($event, 'couta_inicial_porcentaje')"
                    @click:clear="onClearFieldEdit('couta_inicial_porcentaje')" />


            </div>

        </div>


        <div class="buttons">

            <v-btn color="red" class="as-hover__box-shadow" @click="onClearFieldAll">
                <span class="mdi mdi-trash-can-outline is-size-4"></span>
                Limpiar campos
            </v-btn>

            <v-btn color="indigo-lighten-1" class="as-hover__box-shadow ma-1" :loading="loading_calculate"
                @click="calculateCCD()">
                <span class="mdi mdi-calculator-variant-outline is-size-4 ma-1"></span>
                Calcular
            </v-btn>

            <p v-if="loading_calculate" class="ma-1"> Calculando...</p>

        </div>

    </div>

    <!-- Seccion donde se muestran los resultados -->

    <div class="box">
        <div class="table-container">
            <table class="table  is-striped  is-narrow  is-fullwidth">
                <thead>
                    <tr>
                        <th class="has-text-info">Precio construccion ($us) </th>
                        <th class="has-text-info">Superficie construccion (m<sup>2</sup>) </th>
                        <th class="has-text-info">Precio terreno ($us) </th>
                        <th class="has-text-info">Construccion ($us) </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <!-- Precio construccion  -->
                            <v-text-field color="indigo-lighten-1" v-model="is_ccd_calculate.precio_construccion"
                                readonly style="min-width: 190px;" />
                        </td>

                        <td>
                            <!-- Supericie construccion -->

                            <v-text-field color="indigo-lighten-1" v-model="is_ccd_calculate.superficie" readonly
                                style="min-width: 190px;" />
                        </td>
                        <td>
                            <!-- Precio terreno  -->
                            <v-text-field color="indigo-lighten-1" v-model="is_ccd_calculate.precio_terreno" readonly
                                style="min-width: 190px;" />
                        </td>
                        <td>
                            <!-- construccion -->
                            <v-text-field color="indigo-lighten-1" v-model="is_ccd_calculate.construccion" readonly
                                style="min-width: 190px;" />
                        </td>

                    </tr>
                </tbody>
            </table>
        </div>

        <div class="table-container">
            <table class="table is-striped is-narrow is-fullwidth">
                <thead>
                    <tr>
                        <th class="has-text-success">Precio credito directo ($us) </th>
                        <th class="has-text-success">Couta inicial %</th>
                        <th class="has-text-success">Monto couta inicial ($sus)</th>
                        <th class="has-text-success">Monto por pagar ($sus)</th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <!-- precio credito directo -->
                            <v-text-field color="indigo-lighten-1" v-model="is_ccd_calculate.precio_credito_directo"
                                readonly style="min-width: 190px;" />
                        </td>
                        <td>
                            <!-- couta inicial % -->
                            <v-text-field color="indigo-lighten-1" readonly style="min-width: 190px;"
                                v-model="is_ccd_calculate.couta_inicial_porcentaje" />
                        </td>

                        <td>
                            <!-- Monto couta inicial -->
                            <v-text-field color="indigo-lighten-1" readonly style="min-width: 190px;"
                                v-model="is_ccd_calculate.monto_couta_inicial" />
                        </td>
                        <td>
                            <!-- monto por pagar -->
                            <v-text-field color="indigo-lighten-1" readonly style="min-width: 190px;"
                                v-model="is_ccd_calculate.monto_por_pagar" />
                        </td>

                    </tr>
                </tbody>
            </table>
        </div>


        <div class="table-container">
            <table class="table is-striped is-narrow is-fullwidth">
                <thead>
                    <tr>
                        <th class="has-text-link">Plazo (años)</th>
                        <th class="has-text-link">Interes anual (%)</th>
                        <th class="has-text-link">Couta mensual ($sus)</th>
                        <th class="has-text-link">N° de coutas</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <!-- Plazo -->
                            <v-text-field color="indigo-lighten-1" v-model="is_ccd_calculate.plazo_anios" readonly
                                style="min-width:  190px;" />
                        </td>

                        <td>
                            <!-- Intereses anual -->
                            <v-text-field color="indigo-lighten-1" v-model="is_ccd_calculate.interes_anual" readonly
                                style="min-width: 190px;" />
                        </td>

                        <td>
                            <!-- Couta mensual -->
                            <v-text-field color="indigo-lighten-1" v-model="is_ccd_calculate.couta_mensual" readonly
                                style="min-width: 190px;" />
                        </td>
                        <td>
                            <!-- N° de coutas -->
                            <v-text-field color="indigo-lighten-1" v-model="is_ccd_calculate.numero_coutas" readonly
                                style="min-width: 190px;" />
                        </td>

                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</template>

<script setup>
import { ref } from 'vue';
import toastr from 'toastr';

//data
// Configurar opciones globales para Toastr (opcional)
toastr.options = {
    closeButton: true,
    progressBar: true,
    positionClass: 'toast-bottom-right',
    timeOut: 3000,
    hideDuration: 100,
};
const is_ccd_edit = ref({
    precio_construccion: "",
    superficie: "",
    precio_terreno: "",
    plazo_anios: "",
    interes_anual: "",
    couta_inicial_porcentaje: "",
});

const is_ccd_calculate = ref({
    precio_construccion: 0.00,
    superficie: 0.00,
    precio_terreno: 0.00,
    construccion: 0.00,
    precio_credito_directo: 0.00,
    couta_inicial_porcentaje: 0.00,
    monto_couta_inicial: 0.00,
    monto_por_pagar: 0.00,
    plazo_anios: 0,
    interes_anual: 0.00,
    couta_mensual: 0.00,
    numero_coutas: 0.00,
});
const loading_calculate = ref(false);

//methods
const calculateCCD = () => {
    try {
        loading_calculate.value = true
        setTimeout(() => {
            if (!validarCampos()) {
                loading_calculate.value = false;
                return;
            }
            //calculos tabla 1
            const construccion = Number(is_ccd_edit.value.superficie) * Number(is_ccd_edit.value.precio_construccion);
            const precio_al_contado = Math.ceil((Number(construccion) + Number(is_ccd_edit.value.precio_terreno)) / 50) * 50;//multiplo superior a 50
            is_ccd_calculate.value.precio_construccion = Number(is_ccd_edit.value.precio_construccion).toFixed(2);
            is_ccd_calculate.value.superficie = Number(is_ccd_edit.value.superficie).toFixed(2);
            is_ccd_calculate.value.precio_terreno = Number(is_ccd_edit.value.precio_terreno).toFixed(2);
            is_ccd_calculate.value.construccion = construccion.toFixed(2);

            //calculos tabla 2
            is_ccd_calculate.value.precio_credito_directo = precio_al_contado.toFixed(2);
            is_ccd_calculate.value.couta_inicial_porcentaje = is_ccd_edit.value.couta_inicial_porcentaje + "%"; // asignamos el porcentaje sin parsear al formado 0.00, visualizar en formato porcentaje  %
            const parse_couta_inicial_porcentaje = Number(is_ccd_edit.value.couta_inicial_porcentaje) / 100; //obtenemos el porcentaje en formato => 0.00
            const monto_couta_inicial = Number(parse_couta_inicial_porcentaje) * Number(is_ccd_calculate.value.precio_credito_directo);
            is_ccd_calculate.value.monto_couta_inicial = monto_couta_inicial.toFixed(2);
            const monto_por_pagar = Number(is_ccd_calculate.value.precio_credito_directo) - Number(is_ccd_calculate.value.monto_couta_inicial);
            is_ccd_calculate.value.monto_por_pagar = monto_por_pagar.toFixed(2);

            //calculos tabla 3
            is_ccd_calculate.value.plazo_anios = is_ccd_edit.value.plazo_anios;
            is_ccd_calculate.value.interes_anual = is_ccd_edit.value.interes_anual + "%";
            const parse_interes_anual = Number(is_ccd_edit.value.interes_anual) / 100;//obtenemos el porcentaje en formato => 0.00
            const couta_mensual_part = (Number(is_ccd_calculate.value.monto_por_pagar) * Number(is_ccd_calculate.value.plazo_anios) * Number(parse_interes_anual)) + Number(is_ccd_calculate.value.monto_por_pagar);
            //verificar si plazo_anios es "0",porque no podemos hacer la division si plazo anios es "0" no existe division entre cero es una indeterminada
            const plazo_anios = (is_ccd_calculate.value.plazo_anios == 0) ? 1 : is_ccd_calculate.value.plazo_anios;
            const couta_mensual = Math.ceil((Number(couta_mensual_part) / (Number(plazo_anios) * 12)) / 5) * 5;
            is_ccd_calculate.value.couta_mensual = couta_mensual.toFixed(2)
            is_ccd_calculate.value.numero_coutas = Number(is_ccd_calculate.value.plazo_anios) * 12;

            //una vez hecho los calculos terminamos de cargar
            loading_calculate.value = false;
            viewToast('success', "Casa credito directo generado!");
        }, 800)

    } catch (error) {
        viewToast('error', error);
    }

}

const plazoAniosAsseptNumberInteger = (event, campo) => {
    let valor_campo = event.target.value;

    // Eliminar los caracteres no válidos, excepto números
    valor_campo = valor_campo.replace(/\D/g, '');

    // Actualizar el valor en el campo de entrada
    is_ccd_edit.value[campo] = valor_campo;
}

const fieldAsseptNumber = (event, campo) => {
    let valor_campo = event.target.value;

    // Eliminar los caracteres no válidos, excepto números y un único "."
    valor_campo = valor_campo.replace(/[^\d.]/g, '');

    // Validar si hay más de un "." y limitar a dos decimales
    const partes = valor_campo.split('.');
    if (partes.length > 2) {
        valor_campo = partes[0] + '.' + partes[1];
    } else if (partes.length == 2) {
        partes[1] = partes[1].substring(0, 2);
        valor_campo = partes.join('.');
    }
    // Actualizar el valor en el campo de entrada
    is_ccd_edit.value[campo] = valor_campo;
}

const validarCampos = () => {
    const is_campos = Object.values(is_ccd_edit.value);

    if (is_campos.every((campo) => campo != "")) {
        return true;
    } else {
        viewToast('warning', "Debe llenar todos los campos");
        return false;
    }
}

const viewToast = (type, message) => {
    if (type == 'success') {
        toastr.success(message, 'OK');
    } else {
        toastr.warning(message, 'Algo salio mal');
    }
}

// Hacemos eliminacion de  esta forma porque debemos asiggnar un "" vacio en cada textField editable
// si no utilizamos esta funcion y hacemos click en la X de eliminacion de textfield, si se elimina de forma predeterminada 
// la funcion calculateCCD se ejecuta aunque el campo este vacio  al utulizar la eliminacion predeterminada de vuetify,
// por eso debemos personalizar de esta forma
const onClearFieldEdit = (campo) => {
    is_ccd_edit.value[campo] = "";
}

const onClearFieldAll = () => {
    // resetar todos los valores de is_ccd_edit
    Object.keys(is_ccd_edit.value).forEach(key => {
        is_ccd_edit.value[key] = "";
    });
    // resetar todos los valores de is_ccd_calculate
    Object.keys(is_ccd_calculate.value).forEach(key => {
        is_ccd_calculate.value[key] = 0.00
    });

    viewToast('success', "Campos optimizados");
}
</script>