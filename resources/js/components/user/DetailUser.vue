<template>
    <div class="card">
        <header class="card-header has-background-success">
            <p class="card-header-title has-text-white">
                <v-icon size="50" icon="mdi-account-box" />&nbsp;PERFIL DE USUARIO
            </p>
        </header>
        <div class="card-content" style="height: 65vh;overflow: none; overflow-y: auto; border-bottom:1px solid #ccc;">
            <table class="table">
                <tbody>
                    <tr>
                        <th>Nombre completo:</th>
                        <td class="m-1">{{ item_user.nombre_completo }}</td>
                    </tr>
                    <tr>
                        <th>Usuario:</th>
                        <td class="m-1">{{ item_user.usuario }}</td>
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
                        <th>Ciudad:</th>
                        <td>{{ item_user.ciudad }}</td>
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
                        <th> Modulo Cliente | Acceso a los clientes registrados:</th>
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
                        <th>
                            Acceso a modulos administrativos:
                        </th>
                        <td>
                            <span class="tag is-success m-1" v-for="(module, index) in module_permissions" :key="index"
                                :index="index">
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

        <div class="is-flex is-justify-content-end  is-align-items-center p-2" style="width: 100%;">
            <div class="m-1">
                <v-btn variant="elevated" color="red" @click="emit('isCloseDialogDetailUser')">
                    <v-icon icon="mdi-close"></v-icon>&nbsp;Cerrar
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
import Usuario from '@/services/Usuario';

export default defineComponent({
    props: ['item_user_parent'],
    emits: ['isCloseDialogDetailUser', 'isSnackbarMessageView'],
    data() {
        const change_overlay = false;
        const item_user = this.props.item_user_parent;
        const city_permissions = [];
        const module_permissions = [];
        const groups_permissions = [];
        const record_permissions = null;
        const ciudades = [
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
        ];
        return {
            item_user,
            city_permissions,
            groups_permissions,
            ciudades,
            change_overlay,
            record_permissions,
            module_permissions,
        }
    },
    setup(props, { emit }) {
        return { props, emit }
    },
    methods: {
        async loadUserPermission() {
            const usuario = new Usuario(this.item_user);

            const response = await usuario.userPermission();
            if (response.status) {
                const permisos = response.records;

                this.city_permissions = permisos.filter(row => row.type_content == 'cities').map(row => row.name);
                this.module_permissions = permisos.filter(row => row.type == 'module').map(row => row.name);
                const is_record_permissions = permisos.filter(row => row.type == 'records');
                is_record_permissions.forEach(row => {
                    this.record_permissions = row.name;
                })

                //ahora agrupamos las ciudades con sus respectivos grupos
                //filter => devuelve un array de objetos segun cumplan la condicion
                // map => devuelve un array
                const list_groups = permisos.filter(row => row.type_content == 'groups');
                let grupos;
                this.ciudades.forEach(city => {
                    //filter => devulve un array segun condicion
                    //map => nos devulve un array
                    grupos = list_groups.filter(item => item.code_content.includes(city)).map(item => item.code_content);
                    this.groups_permissions.push({
                        ciudad: city,
                        grupos: grupos,
                    });
                });

            }else{
                this.emit('isSnackbarMessageView', 'error', response.message)
            }

        },
    },
    mounted() {
        this.change_overlay = true;
        setTimeout(async () => {
            await this.loadUserPermission();
            this.change_overlay = false;
        }, 400);

    }
});
</script>
