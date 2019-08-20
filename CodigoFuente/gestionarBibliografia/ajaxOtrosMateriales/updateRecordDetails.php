<?php
include_once '../../modeloSistema/BDConexionSistema.Class.php';
header('Content-Type: text/html; charset=UTF-8');

if(isset($_POST)){
    // Recuperar ID
    $id = $_POST['id'];

    //Recuperar datos
    $descripcion = $_POST['descripcion'];
    
    // Consulta a la BD para actualizar
    $query = "UPDATE otro_material SET"
            . " descripcion = '$descripcion' "
            . " WHERE id = $id";
    
$consulta = BDConexionSistema::getInstancia()->query($query);
}