import axios from "axios";
import app from "@/config/app.js";
import { NumerosALetras } from 'numero-a-letras';

class Contrato {
    constructor(city, contrato, detalle_contrato) {
        this.city = city;
        this.contrato = {
            id: 0,
            id_cliente: "",
            n_contrato: "",
            fecha_firma_contrato: "",
            monto_total_construccion: "",
            couta_inicial: "",
            couta_mensual: "",
            fecha_pago_couta_mensual: "",
            descripcion: "",
            archivo_pdf: "",
        };
        this.detalle_contrato = {
            id_contrato: "",
            n_lote: "",
            n_uv: "",
            zona: "",
            barrio: "",
            calle: "",
            superficie_terreno: "",
            numero_distrito: "",
            numero_identificacion_terreno: "",
            norte_medida_terreno: "",
            norte_colinda_lote: "",
            sur_medida_terreno: "",
            sur_colinda_lote: "",
            este_medida_terreno: "",
            este_colinda_lote: "",
            oeste_medida_terreno: "",
            oeste_colinda_lote: "",
            valor_monto_total_construccion_literal: "",
            valor_couta_inicial_literal: "",
            valor_couta_mensual_literal: "",
            cantidad_couta_mensual: "",
            lugar_firma_contrato: "",
        };
        this.config = {
            headers: {
                'Assept': 'Application/json'
            }
        };
        if (contrato != undefined) {
            this.setFill('contrato', contrato);
        }

        if (detalle_contrato != undefined) {
            this.setFill('detalle_contrato', detalle_contrato);
        }
    }

    setCity(city) {
        this.city = city;
    }

    getCity() {
        return this.city;
    }
    
    setFill(type, item_contrato) {
        switch (type) {
            case 'contrato':
                Object.entries(this.contrato).forEach(([key]) => {
                    if (Object.prototype.hasOwnProperty.call(item_contrato, key)) {
                        this.contrato[key] = item_contrato[key];
                    }
                });
                break;
            case 'detalle_contrato':
                Object.entries(this.detalle_contrato).forEach(([key]) => {
                    if (Object.prototype.hasOwnProperty.call(item_contrato, key)) {
                        switch (key) {
                            case 'valor_monto_total_construccion_literal':
                                this.detalle_contrato[key] = this.numeroAletras(this.contrato.monto_total_construccion);
                                break;
                            case 'valor_couta_inicial_literal':
                                this.detalle_contrato[key] = this.numeroAletras(this.contrato.couta_inicial);
                                break;
                            case 'valor_couta_mensual_literal':
                                this.detalle_contrato[key] = this.numeroAletras(this.contrato.couta_mensual);
                                break;
                            default:
                                this.detalle_contrato[key] = item_contrato[key];
                                break;
                        }

                    }
                });
                break;

            default: break;
        }

    }//setFill

    getFill(type) {
        switch (type) {
            case 'contrato':
                return this.contrato;
            case 'detalle_contrato':
                return this.detalle_contrato;
            default: return {};
        }

    }

    numeroAletras(numero) {
        const numero_literal = NumerosALetras(numero);
        // Reemplaza "Pesos" y "M.N." con cadenas vacías y elimina espacios en blanco
        return numero_literal.replace(/(Pesos|M\.N\.)/gi, '').trim();
    }


    async index(filter_year, filter_month) {

        try {
            const resolve = await axios.post(app.BASE_URL + '/microservice/contrato/ciudad/tablero-index', {
                year: filter_year,
                month: filter_month,
                ciudad: this.city,
            }, this.config);

            return resolve.data;
        } catch (error) {
            return error.response.data;
        }
    }


    async create() {
        try {
            const contrato_all = Object.assign({}, this.getFill('contrato'), this.getFill('detalle_contrato'));
            contrato_all['ciudad'] = this.city;

            const resolve = await axios.post(app.BASE_URL + '/microservice/contrato/ciudad/tablero-create', contrato_all, this.config);

            return resolve.data;
        } catch (error) {
            return error.response.data;
        }
    }


    async update() {
        this.config.headers['X-HTTP-Method-Override'] = 'PUT';
        try {
            const contrato_all = Object.assign({}, this.getFill('contrato'), this.getFill('detalle_contrato'));
            contrato_all['ciudad'] = this.city;

            const resolve = await axios.post(app.BASE_URL + '/microservice/contrato/ciudad/tablero-update', contrato_all, this.config);

            return resolve.data;
        } catch (error) {
            return error.response.data;
        }
    }



    async destroy() {
        try {
            const resolve = await axios.post(app.BASE_URL + '/microservice/contrato/ciudad/tablero-destroy', {
                id: this.getFill('contrato').id,
                ciudad: this.city,
            }, this.config);

            return resolve.data;
        } catch (error) {
            return error.response.data;
        }
    }


    async buscarCliente(carnet) {
        try {

            const resolve = await axios.post(app.BASE_URL + '/microservice/contrato/ciudad/buscar-cliente', {
                ci: carnet,
                ciudad: this.city,
            }, this.config);

            return resolve.data;
        } catch (error) {
            return error.response.data;
        }
    }



    async byIdDetalleContrato(id) {
        try {
            const resolve = await axios.post(app.BASE_URL + '/microservice/contrato/ciudad/by-id-detalle-contrato', {
                id_contrato: id,
                ciudad: this.city,
            }, this.config);

            return resolve.data;
        } catch (error) {
            return error.response.data;
        }
    }

}

export default Contrato;