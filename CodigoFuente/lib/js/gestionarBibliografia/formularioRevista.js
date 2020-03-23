var idPrograma = 0;

function addRecord() {
    // recupera valores
    var nuevo_apellido = $("#nuevo_apellido").val();
    var nuevo_nombre = $("#nuevo_nombre").val();
    var nuevo_tituloArticulo = $("#nuevo_tituloArticulo").val();
    var nuevo_tituloRevista = $("#nuevo_tituloRevista").val();
    var nuevo_pagina = $("#nuevo_pagina").val();
    var nuevo_fecha = $("#nuevo_fecha").val();
    var nuevo_unidad = $("#nuevo_unidad").val();
    var nuevo_biblioteca = $("#nuevo_biblioteca").val();
    var nuevo_siunpa = $("#nuevo_siunpa").val();
    var nuevo_otro = $("#nuevo_otro").val();

    // se llama a la API addRecord para agregar nuevo registro
    if (nuevo_tituloArticulo == '' | nuevo_tituloRevista == '' | nuevo_apellido == ''
            | nuevo_nombre == '') {
        console.log("Campos inválidos");
        alert("Hay datos sin completar en el formulario, completelos e intente nuevamente");

    } else {


        $.post("../gestionarBibliografia/ajaxRevistas/addRecord.php?id=" + idPrograma, {
            nuevo_apellido: nuevo_apellido,
            nuevo_nombre: nuevo_nombre,
            nuevo_tituloArticulo: nuevo_tituloArticulo,
            nuevo_tituloRevista: nuevo_tituloRevista,
            nuevo_pagina: nuevo_pagina,
            nuevo_fecha: nuevo_fecha,
            nuevo_unidad: nuevo_unidad,
            nuevo_biblioteca: nuevo_biblioteca,
            nuevo_siunpa: nuevo_siunpa,
            nuevo_otro: nuevo_otro
        }, function (data, status) {
            // oculta el Modal
            $("#add_new_record_modal").modal("hide");

            // actualiza tabla de registros mostrados
            readRecords(idPrograma);
            // limpia los datos del Modal
            $("#nuevo_apellido").val("");
            $("#nuevo_nombre").val("");
            $("#nuevo_tituloArticulo").val("");
            $("#nuevo_tituloRevista").val("");
            $("#nuevo_pagina").val("");
            $("#nuevo_fecha").val("");
            $("#nuevo_unidad").val("");
            $("#nuevo_biblioteca").val("");
            $("#nuevo_siunpa").val("");
            $("#nuevo_otro").val("");
        });
    }
}


function readRecords(idPrograma_) {
    $.get("../gestionarBibliografia/ajaxRevistas/readRecords.php?id="+idPrograma_, {}, function (data, status) {
        $("#divDatos").html(data);
    });
    idPrograma = idPrograma_;
    console.log("Datos leídos");
}


function DeleteRecord(id) {
    var conf = confirm("¿Está seguro que desea eliminar este Artículo de Revista?");
    if (conf === true) {
        $.post("../gestionarBibliografia/ajaxRevistas/deleteRecord.php", {
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
    $.post("../gestionarBibliografia/ajaxRevistas/readRecordDetails.php", {
        id: id
    },
            function (data, status) {
                // Se utiliza un JSON para manejar los datos
                var revista = JSON.parse(data);
                //Carga campos del Modal con los datos del objeto
                $("#apellido").val(revista[0].apellido);
                $("#nombre").val(revista[0].nombre);

                $("#tituloArticulo").val(revista[0].tituloArticulo);
                $("#tituloRevista").val(revista[0].tituloRevista);
                $("#pagina").val(revista[0].pagina);
                $("#fecha").val(revista[0].fecha);
                $("#unidad").val(revista[0].unidad);
                $("#siunpa").val(revista[0].siunpa);
                $("#biblioteca").val(revista[0].biblioteca);
                $("#otro").val(revista[0].otro);
            }
    );
    // se muestra Modal
    $("#update_record_modal").modal("show");
}

function UpdateRecordDetails() {
    // recupera datos
    var apellido = $("#apellido").val();
    var nombre = $("#nombre").val();
    var tituloArticulo = $("#tituloArticulo").val();
    var tituloRevista = $("#tituloRevista").val();
    var pagina = $("#pagina").val();
    var fecha = $("#fecha").val();
    var unidad = $("#unidad").val();
    var biblioteca = $("#biblioteca").val();
    var siunpa = $("#siunpa").val();
    var otro = $("#otro").val();

    //se setea el ID obtenido anteriormente 
    var id = $("#hidden_id").val();


    if (tituloArticulo == '' | tituloRevista == '' | apellido == ''
            | nombre == '') {
        console.log("Campos inválidos");
        alert("Hay datos sin completar en el formulario, completelos e intente nuevamente");

    } else {

        // Actualiza datos
        $.post("../gestionarBibliografia/ajaxRevistas/updateRecordDetails.php", {
            id: id,
            apellido: apellido,
            nombre: nombre,
            tituloArticulo: tituloArticulo,
            tituloRevista: tituloRevista,
            pagina: pagina,
            fecha: fecha,
            unidad: unidad,
            biblioteca: biblioteca,
            siunpa: siunpa,
            otro: otro
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
    readRecords();
});
*/