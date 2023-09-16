import axios from "axios";
import app from "@/config/app.js";


class Obra {
    constructor(city, obra) {
        this.city = "";
        this.obra = {
            id: 0,
            id_contrato: "",
            estado: "",
            fecha_inicio: "",
            fecha_finalizacion: "",
            monto_pago_contratista: "",
            descripcion: "",
        };

        this.config = {
            headers: {
                'Assept': 'Application/json'
            }
        };
        if (obra != undefined) {
            this.setFill(obra);
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

    setFill(obra) {
        Object.entries(this.obra).forEach(([key]) => {
            if (Object.prototype.hasOwnProperty.call(obra, key)) {
                this.obra[key] = obra[key];
            }
        });

    }//setFill

    getFill() {
        return this.obra;
    }//getFill

    async index(filter_year, filter_month) {
        try {
            const resolve = await axios.post(app.BASE_URL + '/microservice/control-de-obra/ciudad/tablero-index', {
                year: filter_year,
                month: filter_month,
                ciudad: this.getCity(),
            }, this.config);

            return resolve.data;
        } catch (error) {
            return error.response.data;
        }
    }

    async create() {
        try {
            const obra = Object.assign({ ciudad: this.getCity() }, this.getFill());
            const resolve = await axios.post(app.BASE_URL + '/microservice/control-de-obra/ciudad/tablero-create', obra, this.config);

            return resolve.data;
        } catch (error) {
            return error.response.data;
        }
    }

    async update() {
        this.config.headers['X-HTTP-Method-Override'] = 'PUT';
        try {
            const obra = Object.assign({ ciudad: this.getCity() }, this.getFill());
            const resolve = await axios.post(app.BASE_URL + '/microservice/control-de-obra/ciudad/tablero-update', obra, this.config);
            return resolve.data;
        } catch (error) {
            return error.response.data;
        }
    }

    async destroy() {
        try {
            const resolve = await axios.post(app.BASE_URL + '/microservice/control-de-obra/ciudad/tablero-destroy', {
                id: this.getFill('contrato').id,
                ciudad: this.getCity(),
            }, this.config);

            return resolve.data;
        } catch (error) {
            return error.response.data;
        }
    }

    async buscarContrato(numero) {
        try {
            const resolve = await axios.post(app.BASE_URL + '/microservice/control-de-obra/ciudad/buscar-contrato', {
                numero_contrato: numero,
                ciudad: this.getCity(),
            }, this.config);
            return resolve.data;
        } catch (error) {
            return error.response.data;
        }
    }



    async generateExcel(filter_year, filter_month) {
        try {
            const resolve = await axios.post(app.BASE_URL + '/microservice/control-de-obra/ciudad/generate-excel', {
                ciudad: this.getCity(),
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
            const resolve = await axios.post(app.BASE_URL + '/microservice/control-de-obra/ciudad/graphic-estado', {
                ciudad: this.getCity(),
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
            const resolve = await axios.post(app.BASE_URL + '/microservice/control-de-obra/ciudad/calendar-fecha-inicio', {
                ciudad: this.getCity(),
            }, this.config);
            return resolve.data;

        } catch (error) {
            return error.response.data;
        }
    }


    async ganttFechaAll(filter_year, filter_month) {
        try {
            const resolve = await axios.post(app.BASE_URL + '/microservice/control-de-obra/ciudad/gantt-fecha-all', {
                ciudad: this.getCity(),
                year: filter_year,
                month: filter_month,
            }, this.config);

            return resolve.data;

        } catch (error) {
            return error.response.data;
        }
    }


}//class

export default Obra;