import axios from "axios";
import app from "@/config/app.js";
import Disenio from "@/services/Disenio";

class RevicionDisenio extends Disenio {
    constructor(disenio, revision) {
        super(disenio);
        this.revision = {
            id: 0,
            fecha_rev_plano: "",
            fecha_rev_3D: "",
            id_disenio: "",
        };

        if (revision != undefined) {
            this.setFillShe(revision);
        }
    }


    setFillShe(revision) {
        Object.entries(this.revision).forEach(([key]) => {
            if (Object.prototype.hasOwnProperty.call(revision, key)) {
                this.revision[key] = revision[key];
            }
        });
        //asignamos el id_disenio de la clase padre Disenio
        this.revision.id_disenio = this.disenio.id;
    }

    getFillShe() {
        return this.revision;
    }

    async indexShe() {
        try {
            const resolve = await axios.post(app.BASE_URL + '/microservice/disenio/revision/tablero-index', {
                id_disenio: this.getFill().id,
            }, this.config);

            return resolve.data;
        } catch (error) {
            return error.response.data;
        }
    }

    async createShe() {
        try {

            const resolve = await axios.post(app.BASE_URL + '/microservice/disenio/revision/tablero-create', {
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

            const resolve = await axios.post(app.BASE_URL + '/microservice/disenio/revision/tablero-update', {
                ...this.getFillShe()
            }, this.config);

            return resolve.data;
        } catch (error) {
            return error.response.data;
        }
    }

    async destroyShe() {
        try {
            const resolve = await axios.post(app.BASE_URL + '/microservice/disenio/revision/tablero-destroy', {
                id: this.getFillShe().id,
            }, this.config);

            return resolve.data;
        } catch (error) {
            return error.response.data;
        }
    }



    async calendarFechaAllShe(is_field) {
        try {
            const resolve = await axios.post(app.BASE_URL + '/microservice/disenio/revision/calendar-fecha-all', {
                field: is_field,
            }, this.config);

            return resolve.data;
        } catch (error) {
            return error.response.data;
        }
    }


}//class

export default RevicionDisenio;