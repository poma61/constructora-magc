import app from '@/config/app.js';
import axios from "axios";

class Usuario {

    constructor(city) {

        this.user = {
            id: 0,
            usuario: "",
            password: "",
            id_personal: "",
            ciudad: city,
            role: '',
        }

        this.config = {
            headers: {
                'Accept': 'application/json'
            }
        }
        this.city = "";

        if (city != undefined) {
            this.city = city;
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

    async index() {

        try {
            const resolve = await axios.post(app.BASE_URL + '/microservice/user/index', {
                ciudad: this.city
            }, this.config)
            return resolve.data;
        } catch (error) {
            return error.response.data;
        }

    }//index

    async create() {
        try {
            const resolve = await axios.post(app.BASE_URL + '/microservice/user/create', this.getFill(), this.config);
            return resolve.data;

        } catch (error) {
            return error.response.data;
        }
    }//create



    async update() {
        try {
            this.config.headers['X-HTTP-Method-Override'] = 'PUT';
            const resolve = await axios.post(app.BASE_URL + '/microservice/user/update', this.getFill(), this.config);
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

    getCity() {
        return this.city;
    }

    setCity(city) {
        this.city = city;
    }

    async buscarPersonal(carnet) {
        try {
            const resolve = await axios.post(app.BASE_URL + "/microservice/user/buscar-personal-registrado", {
                ciudad: this.city,
                ci: carnet
            }, this.config);

            return resolve.data;
        } catch (error) {
            return error.response.data;
        }


    }

}//class

export default Usuario;