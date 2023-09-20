import axios from "axios";
import app from "@/config/app.js";


class Disenio {
    constructor(disenio) {
        this.disenio = {
            id: 0,
            id_cliente: "",
            requerimiento: "",
            fecha: "",
            arquitecto: "",
        };

        this.config = {
            headers: {
                'Assept': 'Application/json'
            }
        };

        if (disenio != undefined) {
            this.setFill(disenio);
        }

    }



    setFill(disenio) {
        Object.entries(this.disenio).forEach(([key]) => {
            if (Object.prototype.hasOwnProperty.call(disenio, key)) {
                this.disenio[key] = disenio[key];
            }
        });

    }//setFill

    getFill() {
        return this.disenio;
    }

    async index(filter_year, filter_month) {

        try {
            const resolve = await axios.post(app.BASE_URL + '/microservice/disenio/tablero-index', {
                year: filter_year,
                month: filter_month,
            }, this.config);

            return resolve.data;
        } catch (error) {
            return error.response.data;
        }
    }

    async create() {
        try {

            const resolve = await axios.post(app.BASE_URL + '/microservice/disenio/tablero-create', this.getFill(), this.config);
            return resolve.data;
        } catch (error) {
            return error.response.data;
        }
    }

    async update() {
        this.config.headers['X-HTTP-Method-Override'] = 'PUT';
        try {

            const resolve = await axios.post(app.BASE_URL + '/microservice/disenio/tablero-update', this.getFill() , this.config);

            return resolve.data;
        } catch (error) {
            return error.response.data;
        }
    }

    async destroy() {
        try {
            const resolve = await axios.post(app.BASE_URL + '/microservice/disenio/tablero-destroy', {
                id: this.getFill().id,
            }, this.config);

            return resolve.data;
        } catch (error) {
            return error.response.data;
        }
    }

    async buscarCliente(ci_cliente) {
        try {

            const resolve = await axios.post(app.BASE_URL + '/microservice/disenio/buscar-cliente', {
                ci: ci_cliente,
            }, this.config);

            return resolve.data;
        } catch (error) {
            return error.response.data;
        }
    }



    async generateExcel(filter_year, filter_month) {
        try {
            const resolve = await axios.post(app.BASE_URL + '/microservice/disenio/generate-excel', {
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

    // sin editar
    async graphicEstado(filter_year, filter_month) {
        try {
            const resolve = await axios.post(app.BASE_URL + '/microservice/finanzas-de-construccion/ciudad/disenio/graphic-estado', {
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
            const resolve = await axios.post(app.BASE_URL + '/microservice/finanzas-de-construccion/ciudad/disenio/calendar-fecha-inicio', {
                ciudad: this.city,
            }, this.config);
            return resolve.data;

        } catch (error) {
            return error.response.data;
        }
    }


    async ganttFechaInicio(filter_year, filter_month) {
        try {
            const resolve = await axios.post(app.BASE_URL + '/microservice/finanzas-de-construccion/ciudad/disenio/gantt-fecha-inicio', {
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

export default Disenio;