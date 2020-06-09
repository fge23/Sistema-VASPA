<?php

include_once '../../modeloSistema/BDConexionSistema.Class.php';
header('Content-Type: text/html; charset=UTF-8');

if (isset($_POST)) {
    // Recuperar ID
    $id = $_POST['id'];

    //Recuperar datos
    $apellido = $_POST['apellido'];
    $nombre = $_POST['nombre'];
    $tituloArticulo = $_POST['tituloArticulo'];
    $tituloRevista = $_POST['tituloRevista'];
    $pagina = $_POST['pagina'];
    $fecha = $_POST['fecha'];
    $unidad = $_POST['unidad'];
    $biblioteca = $_POST['biblioteca'];
    $siunpa = $_POST['siunpa'];
    $otro = $_POST['otro'];




    // Consulta a la BD para actualizar
    $query = "UPDATE REVISTA SET"
            . " apellido = '$apellido',"
            . " nombre = '$nombre',"
            . " tituloArticulo = '$tituloArticulo',"
            . " tituloRevista = '$tituloRevista',"
            . " pagina = '$pagina',";

    if ($fecha == "NULL") {
        $query .= "fecha = NULL, ";
    } else {
        $query .= "fecha = '{$fecha}' , ";
    }
    $query.=  " unidad = '$unidad', "
            . " biblioteca = '$biblioteca', "
            . " siunpa = '$siunpa',"
            . " otro = '$otro' "
            . " WHERE id = $id";
    $consulta = BDConexionSistema::getInstancia()->query($query);
}