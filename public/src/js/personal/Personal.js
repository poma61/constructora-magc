
class Personal {
    constructor(city, url_web) {
        this.city = city;
        this.url_web = url_web;
        this.personal_property = {
            id: 0,
            nombres: '',
            apellido_paterno: '',
            apellido_materno: '',
            cargo: '',
            ci: '',
            ci_expedido: '',
            telefono: null,
            direccion: '',
            foto: null,
            created_at: null,
        }
        this.config = {
            headers: {
                'Accept': 'application/json'
            }
        };
        this.records = [];
    }

    getFill() {
        return this.personal_property;
    }

    setFill(personal_property) {
        this.personal_property = personal_property;
    }

    setRecords(records) {
        this.records = records;
    }

    getRecords() {
        return this.records
    }

    getCity() {
        return this.city
    }
    setCity(city) {
        return this.city = city
    }

    async index() {

        try {
            const resolve = await axios.post(BASE_URL + this.url_web + "/index", {
                ciudad: this.city,
            },this.config);
            this.setRecords(resolve.data.records);
            return resolve.data;
        } catch (error) {
            return error.response.data;
        }
    }

    async create(datos) {
        datos.append('ciudad', this.city);

        try {
            const resolve = await axios.post(BASE_URL + this.url_web + "/create", datos, this.config);
            this.setFill(resolve.data.record);

            return resolve.data;
        } catch (error) {
            return error.response.data;
        }
    }//create

    async edit(data_id) {

        try {
            const resolve = await axios.post(BASE_URL + this.url_web + "/edit", {
                id: data_id
            }, this.config);
            this.setFill(resolve.data.record);
            return resolve.data;
        } catch (error) {
            return error.response.data;
        }
    }//edit

    async destroy(data_id) {
        try {
            const resolve = await axios.post(BASE_URL + this.url_web + "/destroy", {
                id: data_id
            }, this.config);
            return resolve.data;
        } catch (error) {
            return error.response.data;
        }
    }//destroy

    async update(datos) {
        try {
            // Agregar el encabezado 'X-HTTP-Method-Override': 'PUT' al objeto de encabezados
            this.config.headers['X-HTTP-Method-Override'] = 'PUT';
            const resolve = await axios.post(BASE_URL + this.url_web + "/update", datos, this.config);
            this.setFill(resolve.data.record);

            return resolve.data;
        } catch (error) {
            return error.response.data;
        }
    }//update


}

export default Personal;
