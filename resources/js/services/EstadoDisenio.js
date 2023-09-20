import axios from "axios";
import app from "@/config/app.js";
import Disenio from "@/services/Disenio";


class EstadoDisenio extends Disenio {
    constructor(disenio, estado) {
        super(disenio);
        this.estado = {
            id: 0,
            fecha_aprobacion: "",
            fecha_entrega: "",
            prefix_codigo: "",
            suffix_codigo: "",
        };

        if (estado != undefined) {
            this.setFillShe(estado);
        }
    }


    setFillShe(estado) {
        Object.entries(this.estado).forEach(([key]) => {
            if (Object.prototype.hasOwnProperty.call(estado, key)) {
                this.estado[key] = estado[key];
            }
        });

    }

    getFillShe() {
        return this.estado;
    }


    async indexShe() {

        try {
            const resolve = await axios.post(app.BASE_URL + '/microservice/disenio/estado/index-estado', {
                id_disenio: this.getFill().id
            }, this.config);

            return resolve.data;
        } catch (error) {
            return error.response.data;
        }
    }

    async refreshEstadoShe() {
        try {
            const resolve = await axios.post(app.BASE_URL + '/microservice/disenio/estado/is-refresh-estado', {
                ...this.getFillShe(),
                id_disenio: this.getFill().id,
            }, this.config);
            return resolve.data;
        } catch (error) {
            return error.response.data;
        }
    }

    async generateNumCodigoEstadoShe() {
        try {
            const resolve = await axios.post(app.BASE_URL + '/microservice/disenio/estado/generate-num-codigo-estado', {
                id_cliente:this.getFill().id_cliente,
            }, this.config);
            return resolve.data;
        } catch (error) {
            return error.response.data;
        }
    }


}//class

export default EstadoDisenio;