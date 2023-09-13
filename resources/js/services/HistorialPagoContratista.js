import axios from "axios";
import app from "@/config/app.js";


class HistorialPagoContratista {
    constructor(city, historial_pago_contratista) {
        this.city = "";
        this.historial_pago_contratista = {
            id: 0,
            id_contratista: "",
            monto: "",
            fecha_pago: "",
        };

        this.config = {
            headers: {
                'Assept': 'Application/json'
            }
        };
        
        if (historial_pago_contratista != undefined) {
            this.setFill(historial_pago_contratista);
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

    setFill(historial_pago_contratista) {
        Object.entries(this.historial_pago_contratista).forEach(([key]) => {
            if (Object.prototype.hasOwnProperty.call(historial_pago_contratista, key)) {
                this.historial_pago_contratista[key] = historial_pago_contratista[key];
            }
        });

    }//setFill

    getFill() {
        return this.historial_pago_contratista;
    }

    async index(id) {

        try {
            const resolve = await axios.post(app.BASE_URL + '/microservice/finanzas-de-construccion/ciudad/contratista/historial-pago-tablero-index', {
                id_contratista: id,
                ciudad: this.city,
            }, this.config);

            return resolve.data;
        } catch (error) {
            return error.response.data;
        }
    }

    async create() {
        try {
            const historial_pago_contratista = Object.assign({}, this.getFill());
            historial_pago_contratista['ciudad'] = this.city;

            const resolve = await axios.post(app.BASE_URL + '/microservice/finanzas-de-construccion/ciudad/contratista/historial-pago-tablero-create', historial_pago_contratista, this.config);

            return resolve.data;
        } catch (error) {
            return error.response.data;
        }
    }

    async update() {
        this.config.headers['X-HTTP-Method-Override'] = 'PUT';
        try {
            const historial_pago_contratista = Object.assign({}, this.getFill());
            historial_pago_contratista['ciudad'] = this.city;
            const resolve = await axios.post(app.BASE_URL + '/microservice/finanzas-de-construccion/ciudad/contratista/historial-pago-tablero-update', historial_pago_contratista, this.config);

            return resolve.data;
        } catch (error) {
            return error.response.data;
        }
    }

    async destroy() {
        try {
            const resolve = await axios.post(app.BASE_URL + '/microservice/finanzas-de-construccion/ciudad/contratista/historial-pago-tablero-destroy', {
                id: this.getFill().id,
                ciudad: this.city,
            }, this.config);

            return resolve.data;
        } catch (error) {
            return error.response.data;
        }
    }


}//class

export default HistorialPagoContratista;