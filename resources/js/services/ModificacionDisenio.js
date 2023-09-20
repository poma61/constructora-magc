import axios from "axios";
import app from "@/config/app.js";
import Disenio from "@/services/Disenio";

class ModificacionDisenio extends Disenio {
    constructor(disenio, modificacion) {
        super(disenio);
        this.modificacion = {
            id: 0,
            fecha: "",
            observacion: "",
            id_disenio: "",
        };

        if (modificacion != undefined) {
            this.setFillShe(modificacion);
        }
    }


    setFillShe(modificacion) {
        Object.entries(this.modificacion).forEach(([key]) => {
            if (Object.prototype.hasOwnProperty.call(modificacion, key)) {
                this.modificacion[key] = modificacion[key];
            }
        });
        //asignamos el id_disenio de la clase padre Disenio
        this.modificacion.id_disenio = this.disenio.id;
    }

    getFillShe() {
        return this.modificacion;
    }

    async indexShe() {
        try {
            const resolve = await axios.post(app.BASE_URL + '/microservice/disenio/modificacion/tablero-index', {
                id_disenio: this.getFill().id,
            }, this.config);

            return resolve.data;
        } catch (error) {
            return error.response.data;
        }
    }

    async createShe() {
        try {

            const resolve = await axios.post(app.BASE_URL + '/microservice/disenio/modificacion/tablero-create', {
                ...this.getFillShe()
            }, this.config);
            return resolve.data;
        } catch (error) {
            return error.response.data;
        }
    }

    async updateShe() {
        this.config.headers['X-HTTP-Method-Override'] = 'PUT';
        try {

            const resolve = await axios.post(app.BASE_URL + '/microservice/disenio/modificacion/tablero-update', {
                ...this.getFillShe()
            }, this.config);

            return resolve.data;
        } catch (error) {
            return error.response.data;
        }
    }

    async destroyShe() {
        try {
            const resolve = await axios.post(app.BASE_URL + '/microservice/disenio/modificacion/tablero-destroy', {
                id: this.getFillShe().id,
            }, this.config);

            return resolve.data;
        } catch (error) {
            return error.response.data;
        }
    }

}//class

export default ModificacionDisenio;