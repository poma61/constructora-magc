function html(datos) {
    return `
    <form id="custom-form" nctype="multipart/form-data" class="as-form">

    <input type="hidden" value="${datos.id}" name="id">
    <div class="field">
        <label class="label has-text-info">Nombres</label>
        <p class="control has-icons-left">
            <input class="input " type="text" placeholder="Escriba aquí..." name="nombres" value="${datos.nombres}">
            <span class="icon is-small is-left has-text-info">
               <span class="mdi mdi-text-box-check"></span>
            </span>
        </p>
    </div>

    <div class="field">
        <label class="label has-text-info">Apellido paterno</label>
        <p class="control has-icons-left">
            <input class="input" type="text" placeholder="Escriba aquí..." name="apellido_paterno"
                value="${datos.apellido_paterno}">
            <span class="icon is-small is-left has-text-info">
               <span class="mdi mdi-text-box-check"></span>
            </span>
        </p>
    </div>

    <div class="field">
        <label class="label has-text-info">Apellido materno</label>
        <p class="control has-icons-left">
            <input class="input" type="text" placeholder="Escriba aquí..." name="apellido_materno"
                value="${datos.apellido_materno}">
            <span class="icon is-small is-left has-text-info">
               <span class="mdi mdi-text-box-check"></span>
            </span>
        </p>
    </div>

    <div class="columns">
        <div class="column">
            <div class="field">
                <label class="label has-text-info">CI</label>
                <p class="control has-icons-left">
                    <input class="input" type="text" placeholder="Escriba aquí..." name="ci" value="${datos.ci}">
                    <span class="icon is-small is-left has-text-info">
                       <span class="mdi mdi-text-box-check"></span>
                    </span>
                </p>

            </div>
        </div>

        <div class="column is-narrow">
            <label class="label has-text-info">Expedido</label>
            <div class="field control has-icons-left">
                <div class="select">
                    <select name="ci_expedido">
                        <option value="">--Seleccione una opcion--</option>
                        <option value="SC" ${datos.ci_expedido == 'SC' ? "selected" : ""}>SC</option>
                        <option value="CH" ${datos.ci_expedido == 'CH' ? "selected" : ""}>CH</option>
                        <option value="CB" ${datos.ci_expedido == 'CB' ? "selected" : ""}>CB</option>
                        <option value="PT" ${datos.ci_expedido == 'PT' ? "selected" : ""}>PT</option>
                        <option value="BN" ${datos.ci_expedido == 'BN' ? "selected" : ""}>BN</option>
                        <option value="LP" ${datos.ci_expedido == 'LP' ? "selected" : ""}>LP</option>
                        <option value="PA" ${datos.ci_expedido == 'PA' ? "selected" : ""}>PA</option>
                        <option value="TJ" ${datos.ci_expedido == 'TJ' ? "selected" : ""}>TJ</option>
                        <option value="OR" ${datos.ci_expedido == 'OR' ? "selected" : ""}>OR</option>
                        <option value="S/E" ${datos.ci_expedido == 'S/E' ? "selected" : ""}>S/E</option>
                    </select>
                </div>
                <div class="icon is-small is-left has-text-info">
                   <span class="mdi mdi-text-box-check"></span>
                </div>
            </div>
        </div>

    </div>
    <div class="field">
        <label class="label has-text-info">Telefono</label>
        <p class="control has-icons-left">
            <input class="input" type="number" placeholder="Escriba aquí..." name="telefono" value="${datos.telefono}">
            <span class="icon is-small is-left has-text-info">
            <span class="mdi mdi-numeric-9-plus-circle"></span>
            </span>
        </p>
    </div>

    <div class="field">
        <label class="label has-text-info">Direccion</label>
        <div class="control">
            <textarea class="textarea" placeholder="Escriba aquí..." name="direccion">${datos.direccion}</textarea>
        </div>
    </div>

    <div class="field">
        <label class="label has-text-info">Cargo</label>
        <p class="control has-icons-left">
            <input class="input" type="text" placeholder="Escriba aquí..." name="cargo" value="${datos.cargo}">
            <span class="icon is-small is-left has-text-info">
               <span class="mdi mdi-text-box-check"></span>
            </span>
        </p>

    </div>

    <div class="field">
        <label class="label has-text-info">Administra grupo</label>
        <div class="select is-multiple" style="width:100%">
            <select multiple size="5" style="width:100%" name="grup_number">
            <option value="01"  ${datos.grup_number == '01' ? 'selected' : ''} >01</option>
            <option value="02"  ${datos.grup_number == '02' ? 'selected' : ''} >02</option>
            <option value="03"  ${datos.grup_number == '03' ? 'selected' : ''} >03</option>
            <option value="04"  ${datos.grup_number == '04' ? 'selected' : ''} >04</option>
            <option value="05"  ${datos.grup_number == '05' ? 'selected' : ''} >05</option>
            <option value="06"  ${datos.grup_number == '06' ? 'selected' : ''} >06</option>
            <option value="07"  ${datos.grup_number == '07' ? 'selected' : ''} >07</option>
            <option value="08"  ${datos.grup_number == '08' ? 'selected' : ''} >08</option>
            <option value="09"  ${datos.grup_number == '09' ? 'selected' : ''} >09</option>
            <option value="10"  ${datos.grup_number == '10' ? 'selected' : ''} >10</option>
            <option value="todos"  ${datos.grup_number == 'todos' ? 'selected' : ''} >todos</option>
            </select>
        </div>
    </div>


    <div class="field mt-3">
        <div class="file is-primary">
            <label class="file-label">
                <input class="file-input" type="file" name="foto" id="file-foto">
                <span class="file-cta">
                    <span class="file-icon">
                    <span class="mdi mdi-upload"></span>
                    </span>
                    <span class="file-label">
                        Subir foto
                    </span>
                </span>
            </label>
        </div>
        <div class="is-flex is-justify-content-center  mt-2">
            <figure class="image is-180x180">
                <img id="img-view"
                    src="${(datos.foto == null) ? BASE_URL + '/src/images/image-preview.png' : BASE_URL + '/' + datos.foto}">
            </figure>

        </div>
    </div>


</form>
   `;
}
import Personal from '/src/js/personal/Personal.js';
import ValidateError from '/src/js/util/ValidateError.js';
import SweetAlert from '/src/js/util/SweetAlert.js';
import DateFormat from '/src/js/util/DateFormat.js';
import ImageVisualize from '/src/js/util/ImageVisualize.js';

const url_web = "/microservice/personal";

// Obtener la URL
const parsed_url = new URL(window.location.href);

// Obtener el valor  de la url get=> por donde se pasa el nombre de la ciudad
const city = parsed_url.pathname.split('/').pop();;

async function initDataTable() {
    const personal = new Personal(city, url_web);
    await personal.index();
    const date_format = new DateFormat();
    $('#table-records').DataTable({
        data: personal.getRecords(),
        columns: [
            {
                // Aquí creamos la columna de conteo (N°)
                data: null,
                title: 'N°',
                render: function (data, type, row, meta) {
                    //meta.row no es lo mismo que meta.row => data-rowindex="${meta.row}
                    //meta.row no es lo mismo que meta.row => data-
                    return meta.row + 1; // Se suma 1 para empezar desde 1 en lugar de 0
                }
            },
            { data: 'nombres', title: 'Nombres' },
            { data: 'apellido_paterno', title: 'Apellido Paterno' },
            { data: 'apellido_materno', title: 'Apellido Materno' },
            { data: 'cargo', title: 'Cargo' },
            {
                data: null, //
                title: 'CI',
                render: function (data, type, row, meta) {
                    // Concatenar el valor de 'ci' con 'ci_espedido'
                    return data.ci + ' ' + data.ci_expedido;
                }
            },
            { data: 'telefono', title: 'Telefono' },
            { data: 'direccion', title: 'Direccion' },
            {
                data: null,
                title: 'Administra grupo',
                render: function (data, type, row, meta) {
                    return `<span class="tag is-primary as-font-9">${data.grup_number}</span>`
                }
            },
            {
                data: null,
                title: 'Foto',
                render: function (data, type, row, meta) {
                    return `
                    <figure class="image is-64x64">
                        <img class="is-rounded" src="${BASE_URL}/${data.foto}">
                    </figure>
                  `
                }
            },
            {
                data: null,
                title: 'Creado el',
                render: function (data, type, row, meta) {
                    return `<span class="tag is-link as-font-9">${date_format.formatDateHour(data.created_at)}</span>`

                }
            },
            {
                // Columna para los botones de acciones (editar y eliminar)
                data: 'id', // Utilizamos el ID como dato para la columna
                title: 'Acciones',
                render: function (data, type, row, meta) {
                    // Aquí construimos los botones con su respectivo ID
                    return `
                    <div class="columns">
                         <div class="column is-2 ">
                             <button class="button is-rounded is-primary edit-record" data-id="${data}"   data-rowindex="${meta.row}">
                             <span class="mdi mdi-pencil"></span>
                             </button>
                         </div>
                         <div class="column is-2 mx-2">
                              <button  class="button is-rounded is-danger delete-record" data-id="${data}"  data-rowindex="${meta.row}">
                              <span class="mdi mdi-delete-sweep"></span>
                              </button>
                         </div>
                    </div>
                    `;
                }
            },

        ],
        responsive: true,
        autoWidth: true,
        lengthMenu: [10, 25, 50, 100],
        order: [[0, 'desc']], //laravel nos devuelve de forma ascendente lo registro y datatble lo ordena de manera desc

    });

}


function save(type, data_table_row_index, obj_datos) {
    const table = $("#table-records").DataTable();

    switch (type) {
        case 'create':

            table.row.add(obj_datos).draw();
            break;
        case 'update':

            // Actualizar el DataTable con los nuevos datos
            table.row(data_table_row_index).data(obj_datos);
            //para evitar que la columna N° se cambia a un numero enviamos un parametro null a la columna N° que es '0'
            //es un comportamiento raro por que N° es un contador automatico, por eso hay ese comportamiento raro
            table.cell(data_table_row_index, 0).data(null);
            table.draw(false);
            break;
        case 'destroy':
            table.row(data_table_row_index).remove().draw(false); // Elimina la fila si obj_datos es nulo
            break;
        default: console.log("No se pudo realizar ningun accion en el data table");
    }

}


function showForm(personal, data_table_row_index) {
    const title = `${personal.getFill().id > 0 ? 'Editar' : 'Nuevo'} personal`;
    const ciudad = personal.getCity();
    const ciudad_parse = ciudad.replace(/-/g, ' ');//quitamos el '-' del nombre de la ciudad
    Swal.fire({
        title: title + ` | <span class='as-text-color-100'>  ${ciudad_parse} </span>`,
        html: html(personal.getFill()),

        showConfirmButton: true,
        showCancelButton: true,
        cancelButtonText: '<i class="mdi mdi-cancel"></i> Cancelar',
        confirmButtonText: '<i class="mdi mdi-content-save-all"></i> Guardar',
        buttonsStyling: true,

        showClass: {
            popup: 'animate__animated animate__flipInX'
        },
        hideClass: {
            popup: 'animate__animated animate__flipOutX'
        },
        allowOutsideClick: () => {
            const popup = Swal.getPopup()
            popup.classList.remove('animate__flipInX')
            setTimeout(() => {
                popup.classList.add('animate__animated', 'animate__bounceIn')
            })
            setTimeout(() => {
                popup.classList.remove('animate__animated', 'animate__bounceIn')
            }, 1000)
            return false
        },

        customClass: {
            confirmButton: 'button is-link m-1',
            cancelButton: 'button is-danger m-1',
            htmlContainer: 'as-custom-swal-html-container',
            title: 'has-background-info py-2 has-text-white as-swal-title',
            popup: 'as-swal-popup',

        },
        preConfirm: () => {
            return new Promise(async (resolve) => {

                const form_data = new FormData($('#custom-form')[0]);
                let response = null;
                if (personal.getFill().id > 0) {
                    response = await personal.update(form_data);
                } else {
                    response = await personal.create(form_data);
                }

                if (response.status) {
                    const properties2 = {
                        title: "¡OK!",
                        text: response.message,
                        timer: 3000,
                        position: 'top-end',
                        popup: 'has-background-info has-text-white'
                    };
                    SweetAlert.successToast(properties2);
                    if (response.type == 'create') {
                        save('create', data_table_row_index, personal.getFill());
                    } else {

                        save('update', data_table_row_index, personal.getFill());
                    }
                    resolve(true);

                } else {
                    if (response.message_errors == undefined) {
                        toastr.error("Error interno!", 'Error');
                    } else {
                        ValidateError.validator(response.message_errors, '.field');
                        toastr.error('Debe llenar todos los datos.', response.message);
                    }

                }
                resolve(false);
            });
        }

    });

    //iniziamos la visualizacion d ela imagen
    ImageVisualize.imgView('#file-foto', '#img-view');
}



$(document).ready(function () {

    initDataTable();
    $('#new-form').click(function () {
        const personal_obj = new Personal(city, url_web);
        showForm(personal_obj, null);
    });

    // Delegar el evento de clic al contenedor de la tabla y seleccionar los botones internos
    $('#table-container').on("click", '.edit-record', async function () {
        const personal_obj = new Personal(city, url_web);
        const data_id = $(this).data('id')
        const data_table_row_index = $(this).data('rowindex')
        await personal_obj.edit(data_id);

        showForm(personal_obj, data_table_row_index);
    });

    $('#table-container').on('click', '.delete-record', function () {

        const id = $(this).data('id');
        const data_table_row_index = $(this).data('rowindex')
        const properties2 = {
            title: "Eliminar",
            text: '¿Esta seguro de eliminar este registro?',
            confirmButtonText: 'OK',
            cancelButtonText: 'Cancelar',
            showConfirmButton: true,
            showCancelButton: true,
            showClass: 'animate__flipInX',
            hideClass: 'animate__flipOutX',
            persistentClass: 'animate__bounceIn',
        };
        SweetAlert.question(properties2).then(async (result) => {
            if (result.isConfirmed) {
                const personal = new Personal(city, url_web);
                const response = await personal.destroy(id);
                if (response.status) {
                    toastr.success(response.message, 'OK');
                    save('destroy', data_table_row_index, null);
                } else {
                    toastr.error(response.message, 'Error');
                }
            }

        });

    });

});




