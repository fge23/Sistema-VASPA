<?php

include_once '../../modeloSistema/BDConexionSistema.Class.php';
header('Content-Type: text/html; charset=UTF-8');

/**
 *
 * @var mysqli_result
 */
$datos;
if (isset($_POST['id']) && isset($_POST['id']) != "") {
//recupero  ID
    $id = $_POST['id'];
    //$id = 1;
// Recupero datos de Otro Material
    $query = "SELECT * FROM otro_material WHERE id = $id";

    $datos = BDConexionSistema::getInstancia()->query($query);
    for ($x = 0; $x < $datos->num_rows; $x++) {
        $otros[] = $datos->fetch_assoc();
    }
//var_dump($otros);
// Desplegar datos de JSON
    echo json_encode($otros);
}
