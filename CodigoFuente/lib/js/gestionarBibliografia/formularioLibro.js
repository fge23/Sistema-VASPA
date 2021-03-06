var idPrograma = 0;

function addRecord() {
    // recupera valores
    var nuevo_referencia = $("#nuevo_referencia").val();
    var nuevo_apellido = $("#nuevo_apellido").val();
    var nuevo_nombre = $("#nuevo_nombre").val();
    var nuevo_anioEdicion = $("#nuevo_anioEdicion").val();
    var nuevo_titulo = $("#nuevo_titulo").val();
    var nuevo_capitulo = $("#nuevo_capitulo").val();
    var nuevo_lugarEdicion = $("#nuevo_lugarEdicion").val();
    var nuevo_editorial = $("#nuevo_editorial").val();
    var nuevo_unidad = $("#nuevo_unidad").val();
    var nuevo_biblioteca = $("#nuevo_biblioteca").val();
    var nuevo_siunpa = $("#nuevo_siunpa").val();
    var nuevo_otro = $("#nuevo_otro").val();


    var ele = document.getElementsByName('nuevo_tipoBibliografia');
    var nuevo_tipoBibliografia;

    for (i = 0; i < ele.length; i++) {
        if (ele[i].checked)
            nuevo_tipoBibliografia = ele[i].value;
    }

    console.log("Bibliografia: " + nuevo_tipoBibliografia)

    if (nuevo_titulo.trim() == '' | nuevo_nombre.trim() == '' | nuevo_apellido.trim() == '' | nuevo_editorial.trim() == ''
            | nuevo_anioEdicion == '') {
        console.log("Campos inválidos");
        alert("Hay datos sin completar en el formulario, completelos e intente nuevamente");

    } else {
        if (typeof nuevo_tipoBibliografia === 'undefined') {
            alert("Debe elegir si la bibliografía es Obligatoria o Complementaria ");
        } else {
            if ((!isNaN(nuevo_anioEdicion)) && (nuevo_anioEdicion < 1901 || nuevo_anioEdicion > 2055)) {
                var anioActual = new Date().getFullYear();
                alert("Ingrese un año de edición entre 1901 y " + anioActual);
            } else {
                console.log(nuevo_anioEdicion);
                // se llama a la API addRecord para agregar nuevo registro
                $.post("../gestionarBibliografia/ajaxLibros/addRecord.php?id=" + idPrograma, {
                    nuevo_apellido: nuevo_apellido,
                    nuevo_nombre: nuevo_nombre,
                    nuevo_referencia: nuevo_referencia,
                    nuevo_anioEdicion: nuevo_anioEdicion,
                    nuevo_titulo: nuevo_titulo,
                    nuevo_capitulo: nuevo_capitulo,
                    nuevo_lugarEdicion: nuevo_lugarEdicion,
                    nuevo_editorial: nuevo_editorial,
                    nuevo_tipoBibliografia: nuevo_tipoBibliografia,
                    nuevo_unidad: nuevo_unidad,
                    nuevo_biblioteca: nuevo_biblioteca,
                    nuevo_siunpa: nuevo_siunpa,
                    nuevo_otro: nuevo_otro
                }, function (data) {
                    // oculta el Modal
                    $("#add_new_record_modal").modal("hide");
                    // actualiza tabla de registros mostrados
                    readRecords(idPrograma);
                    // limpia los datos del Modal
                    $("#nuevo_apellido").val("");
                    $("#nuevo_nombre").val("");
                    $("#nuevo_referencia").val("");
                    $("#nuevo_anioEdicion").val("");
                    $("#nuevo_titulo").val("");
                    $("#nuevo_capitulo").val("");
                    $("#nuevo_lugarEdicion").val("");
                    $("#nuevo_editorial").val("");
                    $("#nuevo_pagina").val("");
                    $("#nuevo_fecha").val("");
                    $("#nuevo_unidad").val("");
                    $("#nuevo_biblioteca").val("");
                    $("#nuevo_siunpa").val("");
                    $("#nuevo_otro").val("");
                    $("#nuevo_tipoBibliografia").prop("checked", false)
                });
            }
        }
    }
}


function readRecords(idPrograma_) {
    $.get("../gestionarBibliografia/ajaxLibros/readRecords.php?id=" + idPrograma_, {}, function (data, status) {
        $("#divDatos").html(data);
    });
    idPrograma = idPrograma_;
    console.log("Datos leídos");
}

function DeleteRecord(id) {
    bootbox.confirm({
        message: "¿Está seguro que desea eliminar este Libro?",
        buttons: {
            confirm: {
                label: '<i class="oi oi-trash"> </i> Sí',
                className: 'btn-danger'
            },
            cancel: {
                label: '<i class="oi oi-circle-x"></i> No',
                className: 'btn-info'
            }
        },
        callback: function (result) {
            console.log('El usuario eligio eliminar? ' + result);
            if (result) {
                $.post("../gestionarBibliografia/ajaxLibros/deleteRecord.php", {
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
    });
}



function ReadRecordDetails(id) {
    // recupera ID
    $("#hidden_id").val(id);
    $.post("../gestionarBibliografia/ajaxLibros/readRecordDetails.php", {
        id: id
    },
            function (data) {
                // Se utiliza un JSON para manejar los datos
                var libro = JSON.parse(data);
                //Carga campos del Modal con los datos del objeto
                $("#apellido").val(libro[0].apellido);
                $("#nombre").val(libro[0].nombre);
                $("#referencia").val(libro[0].referencia);
                $("#anioEdicion").val(libro[0].anioEdicion);
                $("#titulo").val(libro[0].titulo);
                $("#capitulo").val(libro[0].capitulo);
                $("#lugarEdicion").val(libro[0].lugarEdicion);
                $("#editorial").val(libro[0].editorial);
                $("#pagina").val(libro[0].pagina);
                $("#fecha").val(libro[0].fecha);
                $("#unidad").val(libro[0].unidad);
                $("#biblioteca").val(libro[0].biblioteca);
                $("#siunpa").val(libro[0].siunpa);
                $("#otro").val(libro[0].otro);
                if (libro[0].tipoLibro === 'O') {
                    $("#obligatoria").prop("checked", true)
                } else {
                    $("#complementaria").prop("checked", true)
                }


                //Hay que ver como se hace este 
                //$("#tipoBibliografia").prop("checked", false)

            }
    );
    // se muestra Modal
    $("#update_record_modal").modal("show");
}

function selectedRadio() {
    var selValue = document.querySelector('input[name="tipoBibliografia"]:checked').value;
    alert(selValue);
    return selValue;
}

function UpdateRecordDetails() {
    // recupera valores modificados
    var referencia = $("#referencia").val();
    var apellido = $("#apellido").val();
    var nombre = $("#nombre").val();
    var anioEdicion = $("#anioEdicion").val();
    var titulo = $("#titulo").val();
    var capitulo = $("#capitulo").val();
    var lugarEdicion = $("#lugarEdicion").val();
    var editorial = $("#editorial").val();
    var unidad = $("#unidad").val();
    var biblioteca = $("#biblioteca").val();
    var siunpa = $("#siunpa").val();
    var otro = $("#otro").val();
    var elem = document.getElementsByName('tipoBibliografia');
    var tipoBibliografia;
    for (i = 0; i < elem.length; i++) {
        if (elem[i].checked)
            tipoBibliografia = elem[i].value;
    }
    //se setea el ID obtenido anteriormente 
    var id = $("#hidden_id").val();
    if (titulo.trim() == '' | nombre.trim() == '' | apellido.trim() == '' | editorial.trim() == ''
            | anioEdicion == '') {
        console.log("Campos inválidos");
        alert("Hay datos sin completar en el formulario, completelos e intente nuevamente");
    } else {
        if (typeof tipoBibliografia === 'undefined') {
            alert("Debe elegir si la bibliografía es Obligatoria o Complementaria ");
        } else {
            if ((!isNaN(anioEdicion)) && (anioEdicion < 1901 || anioEdicion > 2055)) {
                var anioActual = new Date().getFullYear();
                alert("Ingrese un año de edición entre 1901 y " + anioActual);
            } else {
                // Actualiza datos
                $.post("../gestionarBibliografia/ajaxLibros/updateRecordDetails.php", {
                    id: id,
                    apellido: apellido,
                    nombre: nombre,
                    referencia: referencia,
                    anioEdicion: anioEdicion,
                    titulo: titulo,
                    capitulo: capitulo,
                    lugarEdicion: lugarEdicion,
                    editorial: editorial,
                    tipoBibliografia: tipoBibliografia,
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
    }
}