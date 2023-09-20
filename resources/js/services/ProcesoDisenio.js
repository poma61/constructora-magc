import axios from "axios";
import app from "@/config/app.js";
import Disenio from "@/services/Disenio";


class ProcesoDisenio extends Disenio {
    constructor(disenio, proceso) {
        super(disenio);
        this.proceso = {
            id: 0,
            planos: "",
            elevaciones: "",
            instalaciones: "",
            p3D: "",
        };

        if (proceso != undefined) {
            this.setFillShe(proceso);
        }
    }


    setFillShe(proceso) {
        Object.entries(this.proceso).forEach(([key]) => {
            if (Object.prototype.hasOwnProperty.call(proceso, key)) {
                this.proceso[key] = proceso[key];
            }
        });

    }

    getFillShe() {
        return this.proceso;
    }

    async indexShe() {

        try {
            const resolve = await axios.post(app.BASE_URL + '/microservice/disenio/proceso/index-proceso', {
                id_disenio: this.getFill().id
            }, this.config);

            return resolve.data;
        } catch (error) {
            return error.response.data;
        }
    }

    async refreshProcesoShe() {
        try {
            const resolve = await axios.post(app.BASE_URL + '/microservice/disenio/proceso/is-refresh-proceso', {
                ...this.getFillShe(),
                id_disenio: this.getFill().id,
            }, this.config);
            return resolve.data;
        } catch (error) {
            return error.response.data;
        }
    }


}//class

export default ProcesoDisenio;