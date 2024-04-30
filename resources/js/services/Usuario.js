import app from '@/config/app.js';
import axios from "axios";

class Usuario {

    constructor(user) {
        this.user = {
            id: 0,
            usuario: "",
            password: "",
            id_personal: "",
        }
        this.parameter = {};
        this.config = {
            headers: {
                'Accept': 'application/json'
            }
        }

        if (user != undefined) {
            this.setFill(user);
        }

    }

    setFill(user) {
        //si se pasa alguna propiedad en user y esta propiedad no esta en this.user entonces se excluye
        //la propiedad.. solo se agregan los valores de las propiedades que este en this.user 
        Object.entries(this.user).forEach(([key]) => {
            if (Object.prototype.hasOwnProperty.call(user, key)) {
                this.user[key] = user[key];
            }
        });
    }

    getFill() {
        return this.user;
    }

    async index(city) {
        try {
            const resolve = await axios.post(app.BASE_URL + '/microservice/user/index', {
                ciudad: city
            }, this.config)
            return resolve.data;
        } catch (error) {
            return error.response.data;
        }

    }//index

    async create() {
        try {
            const resolve = await axios.post(app.BASE_URL + '/microservice/user/create', {
                ... this.getFill(),
                ...this.getParameter(),
            }, this.config);
            return resolve.data;

        } catch (error) {
            return error.response.data;
        }
    }//create


    async update() {
        try {
            this.config.headers['X-HTTP-Method-Override'] = 'PUT';
            const resolve = await axios.post(app.BASE_URL + '/microservice/user/update', {
                ... this.getFill(),
                ...this.getParameter(),
            }, this.config);
            return resolve.data;
        } catch (error) {
            return error.response.data;

        }
    }//update

    async destroy() {

        try {
            const resolve = await axios.post(app.BASE_URL + '/microservice/user/destroy', {
                id: this.getFill().id
            }, this.config);
            return resolve.data;

        } catch (error) {
            return error.response.data
        }

    }

    async userPermission() {
        try {
            const resolve = await axios.post(app.BASE_URL + '/microservice/user/user-permisos', {
                id: this.getFill().id
            }, this.config);

            return resolve.data;

        } catch (error) {

            return error.response.data
        }
    }


    getParameter() {
        return this.parameter
    }

    setParameter(parameter) {
        Object.assign(this.parameter, parameter);
    }

}//class

export default Usuario;