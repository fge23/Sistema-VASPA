<?php
// include Database connection file 
include_once '../../modeloSistema/BDConexionSistema.Class.php';
header('Content-Type: text/html; charset=UTF-8');

// check request
if (isset($_POST['id']) && isset($_POST['id']) != "") {
 
    // get user id
    $id = $_POST['id'];
    var_dump($id);

    // delete User

    $query = "DELETE FROM REVISTA WHERE id = {$id}";
    $consulta = BDConexionSistema::getInstancia()->query($query);
    
}
?>