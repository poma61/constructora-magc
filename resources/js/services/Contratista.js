import axios from "axios";
import app from "@/config/app.js";


class Contratista {
    constructor(city, contratista) {
        this.city = "";
        this.contratista = {
            id: 0,
            nombres: "",
            apellido_paterno: "",
            apellido_materno: "",
            id_contrato: "",
            estado: "",
            monto: "",
            descripcion: "",
            fecha_inicio: "",
        };

        this.config = {
            headers: {
                'Assept': 'Application/json'
            }
        };

        if (contratista != undefined) {
            this.setFill(contratista);
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

    setFill(item_contratista) {

        Object.entries(this.contratista).forEach(([key]) => {
            if (Object.prototype.hasOwnProperty.call(item_contratista, key)) {
                this.contratista[key] = item_contratista[key];
            }
        });

    }//setFill

    getFill() {

        return this.contratista;

    }

    async index(filter_year, filter_month) {

        try {
            const resolve = await axios.post(app.BASE_URL + '/microservice/finanzas-de-construccion/ciudad/contratista/tablero-index', {
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
            const contratista = Object.assign({}, this.getFill());
            contratista['ciudad'] = this.city;

            const resolve = await axios.post(app.BASE_URL + '/microservice/finanzas-de-construccion/ciudad/contratista/tablero-create', contratista, this.config);

            return resolve.data;
        } catch (error) {
            return error.response.data;
        }
    }

    async update() {
        this.config.headers['X-HTTP-Method-Override'] = 'PUT';
        try {
            const contratista = Object.assign({}, this.getFill());
            contratista['ciudad'] = this.city;
            const resolve = await axios.post(app.BASE_URL + '/microservice/finanzas-de-construccion/ciudad/contratista/tablero-update', contratista, this.config);

            return resolve.data;
        } catch (error) {
            return error.response.data;
        }
    }

    async destroy() {
        try {
            const resolve = await axios.post(app.BASE_URL + '/microservice/finanzas-de-construccion/ciudad/contratista/tablero-destroy', {
                id: this.getFill('contrato').id,
                ciudad: this.city,
            }, this.config);

            return resolve.data;
        } catch (error) {
            return error.response.data;
        }
    }

    async buscarContrato(numero) {
        try {

            const resolve = await axios.post(app.BASE_URL + '/microservice/finanzas-de-construccion/ciudad/contratista/buscar-contrato', {
                numero_contrato: numero,
                ciudad: this.city,
            }, this.config);

            return resolve.data;
        } catch (error) {
            return error.response.data;
        }
    }



    async generateExcel(filter_year, filter_month) {
        try {
            const resolve = await axios.post(app.BASE_URL + '/microservice/finanzas-de-construccion/ciudad/contratista/generate-excel', {
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

    async graphicEstado(filter_year, filter_month) {
        try {
            const resolve = await axios.post(app.BASE_URL + '/microservice/finanzas-de-construccion/ciudad/contratista/graphic-estado', {
                ciudad: this.city,
                year: filter_year,
                month: filter_month,
            }, this.config);
            return resolve.data;
        } catch (error) {
            return error.response.data;
        }
    }


    async calendarFechaInicio() {
        try {
            const resolve = await axios.post(app.BASE_URL + '/microservice/finanzas-de-construccion/ciudad/contratista/calendar-fecha-inicio', {
                ciudad: this.city,
            }, this.config);
            return resolve.data;

        } catch (error) {
            return error.response.data;
        }
    }


    async ganttFechaInicio(filter_year, filter_month) {
        try {
            const resolve = await axios.post(app.BASE_URL + '/microservice/finanzas-de-construccion/ciudad/contratista/gantt-fecha-inicio', {
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

export default Contratista;