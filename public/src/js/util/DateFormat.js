class DateFormart{

    static format(fecha) {
        const meses = ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'];
    
        const dia = fecha.getDate();
        const mes = meses[fecha.getMonth()];
        const anio = fecha.getFullYear();
    
        const hora = fecha.getHours();
        const minutos = fecha.getMinutes();
    
        const fechaFormateada = `${dia}/${mes}/${anio} ${hora.toString().padStart(2, '0')}:${minutos.toString().padStart(2, '0')}`;
    
        return fechaFormateada;
    }


}
export default DateFormart