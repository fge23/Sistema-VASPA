<?php
include_once '../../modeloSistema/BDConexionSistema.Class.php';
header('Content-Type: text/html; charset=UTF-8');

if(isset($_POST))
{
    // Recuperar ID
    $id = $_POST['id'];
    
    //Recuperar datos
    $titulo = $_POST['titulo'];
    $apellido = $_POST['apellido'];
    $nombre = $_POST['nombre'];
    $datosAdicionales= $_POST['datosAdicionales'];
    $disponibilidad = $_POST['disponibilidad'];  

    // Consulta a la BD para actualizar
    $query = "UPDATE RECURSO SET"
            . " titulo = '$titulo',"
            . " apellido = '$apellido',"
            . " nombre = '$nombre',"
            . " datosAdicionales = '$datosAdicionales',"
            . " disponibilidad = '$disponibilidad'"
            . " WHERE id = $id";
    
$consulta = BDConexionSistema::getInstancia()->query($query);
}