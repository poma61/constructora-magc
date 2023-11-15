import app from '@/config/app.js';
import axios from "axios";

class AuthProfile {

    constructor(auth_user) {
        this.auth_user = {
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
        if (auth_user != undefined) {
            this.setFill(auth_user);
        }
    }

    setFill(auth_user) {
        //si se pasa alguna propiedad en auth_user y esta propiedad no esta en this.auth_user entonces se excluye
        //la propiedad.. solo se agregan los valores de las propiedades que este en this.auth_user 
        Object.entries(this.auth_user).forEach(([key]) => {
            if (Object.prototype.hasOwnProperty.call(auth_user, key)) {
                this.auth_user[key] = auth_user[key];
            }
        });
    }

    getFill() {
        return this.auth_user;
    }

    async me() {

        try {
            const resolve = await axios.post(app.BASE_URL + '/microservice/index-me', this.config)
            return resolve.data;
        } catch (error) {
            return error.response.data;
        }

    }//index


    async refreshCredentials() {
        try {
            this.config.headers['X-HTTP-Method-Override'] = 'PUT';
            const resolve = await axios.post(app.BASE_URL + '/microservice/update-credentials-me', this.getFill(), this.config);
            return resolve.data;
        } catch (error) {
            return error.response.data;

        }
    }//update

}//class

export default AuthProfile;