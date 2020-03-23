var idPrograma = 0;

function addRecord() {
    // recupera valores
    var nuevo_descripcion = $("#nuevo_descripcion").val();


    if (nuevo_descripcion == '') {
        console.log("Campos inválidos");
        alert("El campo no tiene datos, complételo e intente nuevamente");

    } else {
        // se llama a la API addRecord para agregar nuevo registro
        $.post("../gestionarBibliografia/ajaxOtrosMateriales/addRecord.php?id="+idPrograma, {
            nuevo_descripcion: nuevo_descripcion,
        }, function (data, status) {
            // oculta el Modal
            $("#add_new_record_modal").modal("hide");

            // actualiza tabla de registros mostrados
            readRecords(idPrograma);

            // limpia los datos del Modal
            $("#nuevo_descripcion").val("");
        });
    }
}

function readRecords(idPrograma_) {
    $.get("../gestionarBibliografia/ajaxOtrosMateriales/readRecords.php?id="+idPrograma_, {}, function (data, status) {
        $("#divDatos").html(data);
    });
    idPrograma = idPrograma_;
    console.log("Datos leídos");
}


function DeleteRecord(id) {
    var conf = confirm("¿Está seguro que desea eliminar este Material?");
    if (conf === true) {
        $.post("../gestionarBibliografia/ajaxOtrosMateriales/deleteRecord.php", {
            id: id
        },
                function (data, status) {
                    console.log("Datos enviados: " + data);
                    // actualiza tabla de registros mostrados
                    readRecords(idPrograma);
                }
        );
    }
}

function ReadRecordDetails(id) {
    // recupera ID
    $("#hidden_id").val(id);
    $.post("../gestionarBibliografia/ajaxOtrosMateriales/readRecordDetails.php", {
        id: id
    },
            function (data, status) {
                // Se utiliza un JSON para manejar los datos    
                console.log(data);
                var otros = JSON.parse(data);
                //Carga campos del Modal con los datos del objeto
                $("#descripcion").val(otros[0].descripcion);
            }
    );
    // se muestra Modal
    $("#update_record_modal").modal("show");
}


function UpdateRecordDetails() {
    // recupera datos
    var descripcion = $("#descripcion").val();
    //se setea el ID obtenido anteriormente 
    var id = $("#hidden_id").val();

    console.log(id);
    console.log(descripcion);

    if (descripcion == '') {
        console.log("Campos inválidos");
        alert("El campo no tiene datos, complételo e intente nuevamente");

    } else {
        // Actualiza datos
        $.post("../gestionarBibliografia/ajaxOtrosMateriales/updateRecordDetails.php", {
            id: id,
            descripcion: descripcion
        },
                function (data, status) {
                    // Oculta Modal
                    $("#update_record_modal").modal("hide");
                    // actualiza tabla de registros mostrados
                    readRecords(idPrograma);
                }
        );
    }
}

/*
$(document).ready(function () {
    // actualiza tabla de registros mostrados
    readRecords(idPrograma);
});
*/
