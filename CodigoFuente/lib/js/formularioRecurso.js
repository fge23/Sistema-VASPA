// Add Record
function addRecord() {
    // get values
    var nuevo_apellido = $("#nuevo_apellido").val();
    var nuevo_nombre = $("#nuevo_nombre").val();
    var nuevo_titulo = $("#nuevo_titulo").val();
    var nuevo_datos_adicionales = $("#nuevo_datos_adicionales").val();
    var nuevo_disponibilidad = $("#nuevo_disponibilidad").val();

    // Add record
    $.post("../pruebaFormDinamico/ajax/addRecord.php", {
        nuevo_apellido: nuevo_apellido,
        nuevo_nombre: nuevo_nombre,
        nuevo_titulo: nuevo_titulo,
        nuevo_datos_adicionales: nuevo_datos_adicionales,
        nuevo_disponibilidad: nuevo_disponibilidad
    }, function (data, status) {
        // close the popup
        $("#add_new_record_modal").modal("hide");

        // read records again
        readRecords();

        // clear fields from the popup
        $("#nuevo_apellido").val("");
        $("#nuevo_nombre").val("");
        $("#nuevo_titulo").val("");
        $("#nuevo_datos_adicionales").val("");
        $("#nuevo_disponibilidad").val("");
    });
}

// READ records
function readRecords() {
    $.get("../pruebaFormDinamico/ajax/readRecords.php", {}, function (data, status) {
        $("#divDatos").html(data);
    });
    console.log("a");
}


function DeleteUser(id) {
    var conf = confirm("Are you sure, do you really want to delete User?");
    if (conf == true) {
        $.post("ajax/deleteUser.php", {
            id: id
        },
                function (data, status) {
                    // reload Users by using readRecords();
                    readRecords();
                }
        );
    }
}

function GetUserDetails(id) {
    // Add User ID to the hidden field for furture usage
    $("#hidden_user_id").val(id);
    $.post("ajax/readUserDetails.php", {
        id: id
    },
            function (data, status) {
                // PARSE json data
                var user = JSON.parse(data);
                // Assing existing values to the modal popup fields
                $("#update_first_name").val(user.first_name);
                $("#update_last_name").val(user.last_name);
                $("#update_email").val(user.email);
            }
    );
    // Open modal popup
    $("#update_user_modal").modal("show");
}

function UpdateUserDetails() {
    // get values
    var first_name = $("#update_first_name").val();
    var last_name = $("#update_last_name").val();
    var email = $("#update_email").val();

    // get hidden field value
    var id = $("#hidden_user_id").val();

    // Update the details by requesting to the server using ajax
    $.post("ajax/updateUserDetails.php", {
        id: id,
        first_name: first_name,
        last_name: last_name,
        email: email
    },
            function (data, status) {
                // hide modal popup
                $("#update_user_modal").modal("hide");
                // reload Users by using readRecords();
                readRecords();
            }
    );
}

$(document).ready(function () {
    // READ recods on page load
    readRecords(); // calling function
});