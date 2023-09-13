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
        let fecha;
        // Verifica si la hora es un formato ISO (00:00:00)
        if (/^\d{2}:\d{2}:\d{2}$/.test(string_hour)) {
            fecha = new Date(`2000-01-01T${string_hour}-04:00`);
        } else {
            fecha = new Date(string_hour);
        }
        const hora = fecha.getHours();
        const minutos = fecha.getMinutes();
        return `${hora.toString().padStart(2, '0')}:${minutos.toString().padStart(2, '0')}`;
    }

    formatDate(string_fecha) {
        let fecha;
        // Verifica si la fecha es un formato ISO (YYYY-MM-DD)
        if (/^\d{4}-\d{2}-\d{2}$/.test(string_fecha)) {
            fecha = new Date(`${string_fecha}T00:00:00-04:00`);
        } else {
            fecha = new Date(string_fecha);
        }
        const meses = ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'];
        const dia = fecha.getDate();
        const mes = meses[fecha.getMonth()];
        const anio = fecha.getFullYear();
        return `${dia}/${mes}/${anio}`;
    }

}//class

export default DateFormat;


