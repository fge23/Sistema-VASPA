<?php

include_once '../../modeloSistema/BDConexionSistema.Class.php';
$idPrograma = $_GET["id"];

$query;
/**
 *
 * @var mysqli_result
 */
$consulta;
if (isset($_POST['nuevo_apellido']) && isset($_POST['nuevo_nombre'])) {
    $nuevo_apellido = $_POST['nuevo_apellido'];
    $nuevo_nombre = $_POST['nuevo_nombre'];
    $nuevo_tituloArticulo = $_POST['nuevo_tituloArticulo'];
    $nuevo_tituloRevista = $_POST['nuevo_tituloRevista'];
    $nuevo_pagina = $_POST['nuevo_pagina'];
    $nuevo_fecha = $_POST['nuevo_fecha'];
    $nuevo_unidad = $_POST['nuevo_unidad'];
    $nuevo_biblioteca = $_POST['nuevo_biblioteca'];
    $nuevo_siunpa = $_POST['nuevo_siunpa'];
    $nuevo_otro = $_POST['nuevo_otro'];


    $query = "INSERT INTO REVISTA "
            . "VALUES ("
            . " null,"
            . " '{$nuevo_apellido}' , "
            . "'{$nuevo_nombre}' , "
            . "'{$nuevo_tituloArticulo}' , "
            . "'{$nuevo_tituloRevista}' , "
            . "'{$nuevo_pagina}' , ";
    if ($nuevo_fecha == "NULL") {
        $query .= " NULL, ";
    } else {
        $query .= "'{$nuevo_fecha}' , ";
    }
    $query .= "'{$nuevo_unidad}' , "
            . "'{$nuevo_biblioteca}' , "
            . "'{$nuevo_siunpa}' , "
            . "'{$nuevo_otro}' ,"
            . " {$idPrograma}) ";

    $consulta = BDConexionSistema::getInstancia()->query($query);
}
?>