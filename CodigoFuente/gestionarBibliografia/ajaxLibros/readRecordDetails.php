<?php

include_once '../../modeloSistema/BDConexionSistema.Class.php';
header('Content-Type: text/plain; charset=UTF-8');

/**
 *
 * @var mysqli_result
 */
$datos;

if (isset($_POST['id']) && isset($_POST['id']) != "") {
    //recupero  ID
    $id = $_POST['id'];
    //$id = 1;
    // Recupero datos de LIBRO
    $query = "SELECT * FROM LIBRO WHERE id = $id";

    $datos = BDConexionSistema::getInstancia()->query($query);

    for ($x = 0; $x < $datos->num_rows; $x++) {
        $libro[] = $datos->fetch_assoc();
    }
    // Desplegar datos de JSON
    echo json_encode($libro);
}
