import axios from "axios";
import app from "@/config/app.js";


class Inventario {
    constructor(city, inventario) {
        this.city = "";
        this.inventario = {
            id: 0,
            id_contratista: "",
            n_recibo: "",
            material: "",
            unidad: "",
            cantidad: "",
            costo_unitario: "",
            costo_total: "",
            fecha_ingreso: "",
        };

        this.config = {
            headers: {
                'Assept': 'Application/json'
            }
        };
        if (inventario != undefined) {
            this.setFill(inventario);
        }
        if (city != undefined) {
            this.city = city;
        }

    }

    setCity(city) {
        this.city = city;
    }

    getCity() {
        return this.city;
    }

    setFill(inventario) {
        Object.entries(this.inventario).forEach(([key]) => {
            if (Object.prototype.hasOwnProperty.call(inventario, key)) {
                this.inventario[key] = inventario[key];
            }
        });

        this.inventario.costo_total = this.inventario.costo_unitario * this.inventario.cantidad;
    }//setFill

    getFill() {
        return this.inventario;
    }//getFill

    async index(filter_year, filter_month) {
        try {
            const resolve = await axios.post(app.BASE_URL + '/microservice/inventario/ciudad/tablero-index', {
                year: filter_year,
                month: filter_month,
                ciudad: this.city,
            }, this.config);

            return resolve.data;
        } catch (error) {
            return error.response.data;
        }
    }

    async create() {
        try {
            const inventario = Object.assign({}, this.getFill());
            inventario['ciudad'] = this.city;
            const resolve = await axios.post(app.BASE_URL + '/microservice/inventario/ciudad/tablero-create', inventario, this.config);

            return resolve.data;
        } catch (error) {
            return error.response.data;
        }
    }

    async update() {
        this.config.headers['X-HTTP-Method-Override'] = 'PUT';
        try {
            const inventario = Object.assign({}, this.getFill());
            inventario['ciudad'] = this.city;
            const resolve = await axios.post(app.BASE_URL + '/microservice/inventario/ciudad/tablero-update', inventario, this.config);
            return resolve.data;
        } catch (error) {
            return error.response.data;
        }
    }

    async destroy() {
        try {
            const resolve = await axios.post(app.BASE_URL + '/microservice/inventario/ciudad/tablero-destroy', {
                id: this.getFill('contrato').id,
                ciudad: this.city,
            }, this.config);

            return resolve.data;
        } catch (error) {
            return error.response.data;
        }
    }

    async buscarContratoByContratista(numero) {
        try {
            const resolve = await axios.post(app.BASE_URL + '/microservice/inventario/ciudad/buscar-contrato-by-contratista', {
                numero_contrato_contratista: numero,
                ciudad: this.city,
            }, this.config);
            return resolve.data;
        } catch (error) {
            return error.response.data;
        }
    }



    async generateExcel(filter_year, filter_month) {
        try {
            const resolve = await axios.post(app.BASE_URL + '/microservice/inventario/ciudad/generate-excel', {
                ciudad: this.city,
                year: filter_year,
                month: filter_month,
            }, {
                responseType: 'blob',
            });
            // como es devuelve archivo blob en data entonces por eso pasamos directo
            //sin hacer return resolve.data
            return resolve;

        } catch (error) {
            //como es un json envuelto en blob por la configuracion de axios  responseType: 'blob', entonces accedemos el json
            const content_type = error.response.headers['content-type'];
            if (content_type.toLowerCase().indexOf('application/json') !== -1) {
                // La respuesta es un Blob que contiene un JSON, necesitamos extraer el JSON
                const blob = await error.response.data;
                const json_text = await new Response(blob).text();
                return JSON.parse(json_text);

            }
        }
    }

    async graphicMaterial(filter_year, filter_month) {
        try {
            const resolve = await axios.post(app.BASE_URL + '/microservice/inventario/ciudad/graphic-material', {
                ciudad: this.city,
                year: filter_year,
                month: filter_month,
            }, this.config);
            return resolve.data;
        } catch (error) {
            return error.response.data;
        }
    }


    async calendarFechaIngreso() {
        try {
            const resolve = await axios.post(app.BASE_URL + '/microservice/inventario/ciudad/calendar-fecha-ingreso', {
                ciudad: this.city,
            }, this.config);
            return resolve.data;

        } catch (error) {
            return error.response.data;
        }
    }


    async ganttFechaIngreso(filter_year, filter_month) {
        try {
            const resolve = await axios.post(app.BASE_URL + '/microservice/inventario/ciudad/gantt-fecha-ingreso', {
                ciudad: this.city,
                year: filter_year,
                month: filter_month,
            }, this.config);

            return resolve.data;

        } catch (error) {
            return error.response.data;
        }
    }


}//class

export default Inventario;