import axios from "axios";
import app from "@/config/app.js"

class Permiso {
    constructor() {
        this.config = {
            headers: {
                'Assept': 'application/json'
            }
        }
    }

    async index() {
        try {
            const resolve = await axios.post(app.BASE_URL + "/microservice/permiso/list", {}, this.config);
            return resolve.data

        } catch (error) {
            return error.response.data;

        }
    }//index

}
export default Permiso;

