class DateFormat {


    formatDateHour(string_fecha) {
        const fecha = new Date(string_fecha);
        const meses = ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'];
        const dia = fecha.getDate();
        const mes = meses[fecha.getMonth()];
        const anio = fecha.getFullYear();

        const hora = fecha.getHours();
        const minutos = fecha.getMinutes();

        return `${dia}/${mes}/${anio} ${hora.toString().padStart(2, '0')}:${minutos.toString().padStart(2, '0')}`;


    }


    formatHour(string_hour) {
        const hour = new Date(`2000-01-01T${string_hour}`);
        const hora = hour.getHours();
        const minutos = hour.getMinutes();
        return `${hora.toString().padStart(2, '0')}:${minutos.toString().padStart(2, '0')}`;
    }

    formatDate(string_fecha) {
        const fecha = new Date(`${string_fecha}T00:00:00`);

        const meses = ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'];

        const dia = fecha.getDate();
        const mes = meses[fecha.getMonth()];
        const anio = fecha.getFullYear();
        return `${dia}/${mes}/${anio}`;
    }


}
export default DateFormat