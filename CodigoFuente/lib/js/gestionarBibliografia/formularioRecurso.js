function addRecord() {
    // recupera valores
    var nuevo_apellido = $("#nuevo_apellido").val();
    var nuevo_nombre = $("#nuevo_nombre").val();
    var nuevo_titulo = $("#nuevo_titulo").val();
    var nuevo_datos_adicionales = $("#nuevo_datos_adicionales").val();
    var nuevo_disponibilidad = $("#nuevo_disponibilidad").val();

    if (nuevo_titulo == '' | nuevo_disponibilidad == '') {
        console.log("Campos inválidos");
        alert("Hay datos sin completar en el formulario, completelos e intente nuevamente");

    } else {

        // se llama a la API addRecord para agregar nuevo registro
        $.post("../gestionarBibliografia/ajaxRecursos/addRecord.php", {
            nuevo_apellido: nuevo_apellido,
            nuevo_nombre: nuevo_nombre,
            nuevo_titulo: nuevo_titulo,
            nuevo_datos_adicionales: nuevo_datos_adicionales,
            nuevo_disponibilidad: nuevo_disponibilidad
        }, function (data, status) {
            // oculta el Modal
            $("#add_new_record_modal").modal("hide");

            // actualiza tabla de registros mostrados
            readRecords();

            // limpia los datos del Modal
            $("#nuevo_apellido").val("");
            $("#nuevo_nombre").val("");
            $("#nuevo_titulo").val("");
            $("#nuevo_datos_adicionales").val("");
            $("#nuevo_disponibilidad").val("");
        });
    }
}


function readRecords() {
    $.get("../gestionarBibliografia/ajaxRecursos/readRecords.php", {}, function (data, status) {
        $("#divDatos").html(data);
    });
    console.log("Datos leídos");
}


function DeleteRecord(id) {
    var conf = confirm("¿Está seguro que desea eliminar este Recurso?");
    if (conf === true) {
        $.post("../gestionarBibliografia/ajaxRecursos/deleteRecord.php", {
            id: id
        },
                function (data, status) {
                    console.log("Datos enviados: " + data);
                    // actualiza tabla de registros mostrados
                    readRecords();
                }
        );
    }
}

function ReadRecordDetails(id) {
    // recupera ID
    $("#hidden_id").val(id);
    $.post("../gestionarBibliografia/ajaxRecursos/readRecordDetails.php", {
        id: id
    },
            function (data, status) {
                // Se utiliza un JSON para manejar los datos
                var recurso = JSON.parse(data);
                //Carga campos del Modal con los datos del objeto
                $("#titulo").val(recurso[0].titulo);
                $("#apellido").val(recurso[0].apellido);
                $("#nombre").val(recurso[0].nombre);
                $("#datosAdicionales").val(recurso[0].datosAdicionales);
                $("#disponibilidad").val(recurso[0].disponibilidad);
            }
    );
    // se muestra Modal
    $("#update_record_modal").modal("show");
}

function UpdateRecordDetails() {
    // recupera datos
    var titulo = $("#titulo").val();
    var apellido = $("#apellido").val();
    var nombre = $("#nombre").val();
    var datosAdicionales = $("#datosAdicionales").val();
    var disponibilidad = $("#disponibilidad").val();
    //se setea el ID obtenido anteriormente 
    var id = $("#hidden_id").val();

    console.log(titulo);
    console.log(id);

    if (titulo == '' | disponibilidad == '') {
        console.log("Campos inválidos");
        alert("Hay datos sin completar en el formulario, completelos e intente nuevamente");

    } else {
        // Actualiza datos
        $.post("../gestionarBibliografia/ajaxRecursos/updateRecordDetails.php", {
            id: id,
            titulo: titulo,
            nombre: nombre,
            apellido: apellido,
            datosAdicionales: datosAdicionales,
            disponibilidad: disponibilidad
        },
                function (data, status) {
                    // Oculta Modal
                    $("#update_record_modal").modal("hide");
                    // actualiza tabla de registros mostrados
                    readRecords();
                }
        );
    }
}
$(document).ready(function () {
    // actualiza tabla de registros mostrados
    readRecords();
});