
class ValidateErrors {

   static  validator(message_errors_all, class_container_input) {
        // Eliminar todos los mensajes de error antes de mostrar los nuevos
        $(`${class_container_input} .has-text-danger.as-font-9`).remove();
        
        for (const property in message_errors_all) {
            //property => saca la propiedad en la variable  property del json
            //ejemplo => message_errors_all.message_errors={name:['error nombre']} entonces => property=nombres

            const input_field = $(`input[name="${property}"]`);
            const select_field = $(`select[name="${property}"]`);
            const textarea_field = $(`textarea[name="${property}"]`);
            const error_message = message_errors_all[property][0];
            const error_message_element = $(`<p class="has-text-danger as-font-9">${error_message}</p>`);
            //input_field.length cantidad de elementos(etiquetas html) encontrado
            // ejemplo =>si existe en el dom <input name="nombres"> entonces  input_field.length=1
            if (input_field.length>0) {
                const container_input = input_field.closest(class_container_input);
                // Agrega el nuevo mensaje de error debajo del campo de entrada
                container_input.append(error_message_element);
            } 

            if(select_field.length>0){
                const container_select = select_field.closest(class_container_input);
                // Agrega el nuevo mensaje de error debajo del campo de entrada
                container_select.append(error_message_element);
            }


            if(textarea_field.length>0){
                const container_select = textarea_field.closest(class_container_input);
                // Agrega el nuevo mensaje de error debajo del campo de entrada
                container_select.append(error_message_element);
            }
           
        }
    }
}

export default ValidateErrors;