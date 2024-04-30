import app from '@/config/app.js';
import axios from "axios";

class Auth {

    constructor(auth) {
        this.auth = {
            id_usuario: 0,
            usuario: "",
            old_password: "",
            new_password: "",
        }

        this.config = {
            headers: {
                'Accept': 'application/json'
            }
        }
        if (auth != undefined) {
            this.setFill(auth);
        }
    }

    setFill(auth) {
        //si se pasa alguna propiedad en auth y esta propiedad no esta en this.auth entonces se excluye
        //la propiedad.. solo se agregan los valores de las propiedades que este en this.auth 
        Object.entries(this.auth).forEach(([key]) => {
            if (Object.prototype.hasOwnProperty.call(auth, key)) {
                this.auth[key] = auth[key];
            }
        });
    }

    getFill() {
        return this.auth;
    }

    async me() {

        try {
            const resolve = await axios.post(app.BASE_URL + '/microservice/auth/me', this.config)
            return resolve.data;
        } catch (error) {
            return error.response.data;
        }

    }//index


    async refreshCredentials() {
        try {
            this.config.headers['X-HTTP-Method-Override'] = 'PUT';
            const resolve = await axios.post(app.BASE_URL + '/microservice/auth/update-credentials-me', this.getFill(), this.config);
            return resolve.data;
        } catch (error) {
            return error.response.data;

        }
    }//update

    async onPermission() {
        try {
            const resolve = await axios.post(app.BASE_URL + '/microservice/auth/permisos', this.config);
            return resolve.data;

        } catch (error) {

            return error.response.data
        }
    }

}//class

export default Auth;