import app from '@/config/app.js';
import axios from "axios";

class Personal {
    constructor() {
        this.config = {
            headers: {
                'Accept': 'application/json'
            }
        }
    }

    async searchByCi(carnet) {
        try {
            const resolve = await axios.post(app.BASE_URL + "/microservice/personal/buscar-personal-registrado", {
                ci: carnet,
            }, this.config);

            return resolve.data;
        } catch (error) {
            return error.response.data;
        }
    }//searchByCi

}//class

export default Personal;