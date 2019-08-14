<?php
// include Database connection file 
include_once '../../modeloSistema/BDConexionSistema.Class.php';
header('Content-Type: text/html; charset=UTF-8');

// check request
if(isset($_POST))
{
    // get values
    $id = $_POST['id'];
    
    $titulo = $_POST['titulo'];
    $apellido = $_POST['apellido'];
    $nombre = $_POST['nombre'];
    $datosAdicionales= $_POST['datosAdicionales'];
    $disponibilidad = $_POST['disponibilidad'];  

    // Updaste User details
    $query = "UPDATE RECURSO SET"
            . " titulo = '$titulo',"
            . " apellido = '$apellido',"
            . " nombre = '$nombre',"
            . " datosAdicionales = '$datosAdicionales',"
            . " disponibilidad = '$disponibilidad'"
            . " WHERE id = $id";
    
$consulta = BDConexionSistema::getInstancia()->query($query);
}