<?php

include_once '../../modeloSistema/BDConexionSistema.Class.php';
header('Content-Type: text/html; charset=UTF-8');

if (isset($_POST)) {
    // Recuperar ID
    $id = $_POST['id'];

    //Recuperar datos
    $apellido = $_POST['apellido'];
    $nombre = $_POST['nombre'];
    $referencia = $_POST['referencia'];
    $anioEdicion = $_POST['anioEdicion'];
    $titulo = $_POST['titulo'];
    $capitulo = $_POST['capitulo'];
    $lugarEdicion = $_POST['lugarEdicion'];
    $editorial = $_POST['editorial'];
    $biblioteca = $_POST['biblioteca'];
    $siunpa = $_POST['siunpa'];
    $unidad = $_POST['unidad'];
    $otro = $_POST['otro'];
    $tipoBibliografia = $_POST['tipoBibliografia'];


    // Consulta a la BD para actualizar
    $query = "UPDATE LIBRO SET "
            . "referencia = '{$referencia}' , "
            . "apellido = '{$apellido}' , "
            . "nombre = '{$nombre}' , "
            . "anioEdicion = {$anioEdicion} , "
            . "titulo = '{$titulo}' , "
            . "capitulo = '{$capitulo}' , "
            . "lugarEdicion = '{$lugarEdicion}' , "
            . "editorial = '{$editorial}' , "
            . "unidad = '{$unidad}' , "
            . "biblioteca = '{$biblioteca}' , "
            . "siunpa = '{$siunpa}' , "
            . "otro = '{$otro}' ,"
            . "tipoLibro = '{$tipoBibliografia}' "
            . " WHERE id = $id";
            
    $consulta = BDConexionSistema::getInstancia()->query($query);
}