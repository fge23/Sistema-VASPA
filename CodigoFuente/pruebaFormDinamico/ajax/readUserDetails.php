<?php

// include Database connection file 
include_once '../../modeloSistema/BDConexionSistema.Class.php';
header('Content-Type: text/html; charset=UTF-8');

/**
 *
 * @var mysqli_result
 */
$datos;

// check request
//if (isset($_POST['id']) && isset($_POST['id']) != "") {
    // get User ID
   // $id = $_POST['id'];
 $id = 1;

    // Get User Details
    $query = "SELECT * FROM RECURSO WHERE id = $id";

    $datos = BDConexionSistema::getInstancia()->query($query);

    for ($x = 0; $x < $datos->num_rows; $x++) {
        $recursos[] = $datos->fetch_assoc();
    }
   
    // display JSON data
    echo json_encode($recursos);
//}
