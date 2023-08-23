import app from '@/config/app.js';
import axios from 'axios';

class Cliente {
    constructor(city, grupo) {
        this.cliente = {
            id: 0,
            nombres: "",
            apellido_paterno: "",
            apellido_materno: "",
            n_de_contacto: "",
            estado: "",
            descripcion: "",
            monto_inicial: "",
            hora_reunion:"",
            fecha_reunion:"",
            seguimiento: "",
        };

        this.config = {
            headers: {
                'Assept': 'Application/json'
            }
        }
        this.city = city;
        this.grupo = grupo;
    }

    setFill(cli) {
        Object.entries(this.cliente).forEach(([key]) => {
            if (Object.prototype.hasOwnProperty.call(cli, key)) {
                this.cliente[key] = cli[key]
            }
        });
    }

    getFill() {
        return this.cliente;
    }
    async index() {
        try {
            const resolve = await axios.post(app.BASE_URL + '/microservice/ciudad/grupo/cliente/index', {
                ciudad: this.city,//enviamos estos parametros para que el middleware  check.city.access y check.grup.access
                grupo: this.grupo,
            }, this.config);

            return resolve.data;

        } catch (error) {
            return error.response.data;
        }
    }//index

    async create() {
        const cliente = this.getFill();
        //enviamos estos parametros para que el middleware  check.city.access y check.grup.access verifique y proteja la ruta
        //practicamente no es necesario porque podemos saber mediante el usuario la ciudad y el grupo
        // pero para que el middleware proteja la ruta y que el sistema tena una seguridad optima debemos de enviar esos parametros
        cliente['ciudad'] = this.city;
        cliente['grupo'] = this.grupo;
        try {
            const resolve = await axios.post(app.BASE_URL + '/microservice/ciudad/grupo/cliente/create', cliente, this.config);

            return resolve.data;

        } catch (error) {

            return error.response.data;
        }
    }//create

    async destroy() {
        //enviamos estos parametros para que el middleware  check.city.access y check.grup.access verifique y proteja la ruta
        //practicamente no es necesario porque podemos saber mediante el usuario la ciudad y el grupo
        // pero para que el middleware proteja la ruta y que el sistema tena una seguridad optima debemos de enviar esos parametros
        try {
            const resolve = await axios.post(app.BASE_URL + '/microservice/ciudad/grupo/cliente/destroy', {
                id: this.getFill().id,
                ciudad: this.city,
                grupo: this.grupo,
            }, this.config)
            return resolve.data;

        } catch (error) {
            return error.response.data;

        }
    }//destroy


    async update() {
        const cliente = this.getFill();
        //enviamos estos parametros para que el middleware  check.city.access y check.grup.access verifique y proteja la ruta
        //practicamente no es necesario porque podemos saber mediante el usuario la ciudad y el grupo
        // pero para que el middleware proteja la ruta y que el sistema tena una seguridad optima debemos de enviar esos parametros
        cliente['ciudad'] = this.city;
        cliente['grupo'] = this.grupo;
        this.config.headers['X-HTTP-Method-Override'] = 'PUT';
        try {
            const resolve = await axios.post(app.BASE_URL + '/microservice/ciudad/grupo/cliente/update', this.getFill(), this.config)
            return resolve.data;

        } catch (error) {
            return error.response.data;

        }

    }//update


    async clienteResponsable(id_cli) {
        try {

            const resolve = await axios.post(app.BASE_URL + '/microservice/ciudad/grupo/cliente/record-cliente-responsable', {
                id_cliente: id_cli,
                ciudad: this.city,
                grupo: this.grupo,
            }, this.config);

            return resolve.data;
        } catch (error) {
            return error.response.data;

        }
    }

    async graphicEstado() {
        try {
            const resolve = await axios.post(app.BASE_URL + '/microservice/ciudad/grupo/cliente/graphic-estado', {
                ciudad: this.city,
                grupo: this.grupo,
            }, this.config);
            return resolve.data;
        } catch (error) {
            return error.response.data;
        }
    }

    async calendarMeeting() {
        try {
            const resolve = await axios.post(app.BASE_URL + '/microservice/ciudad/grupo/cliente/calendar-meeting', {
                ciudad: this.city,
                grupo: this.grupo,
            }, this.config);
            return resolve.data;
            
        } catch (error) {
            return error.response.data;
        }
    }


    async ganttMeeting() {
        try {
            const resolve = await axios.post(app.BASE_URL + '/microservice/ciudad/grupo/cliente/gantt-meeting', {
                ciudad: this.city,
                grupo: this.grupo,
            }, this.config);
            
            return resolve.data;
            
        } catch (error) {
            return error.response.data;
        }
    }

}//class

export default Cliente;

