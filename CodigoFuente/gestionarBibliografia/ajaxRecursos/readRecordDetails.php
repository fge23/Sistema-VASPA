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

    // Recupero datos de Recurso
    $query = "SELECT * FROM RECURSO WHERE id = $id";

    $datos = BDConexionSistema::getInstancia()->query($query);

    for ($x = 0; $x < $datos->num_rows; $x++) {
        $recursos[] = $datos->fetch_assoc();
    }
    // Desplegar datos de JSON
    echo json_encode($recursos);
   
}
