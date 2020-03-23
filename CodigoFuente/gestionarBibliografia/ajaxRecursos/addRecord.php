<?php

include_once '../../modeloSistema/BDConexionSistema.Class.php';
$idPrograma = $_GET["id"];

$query;
/**
 *
 * @var mysqli_result
 */
$consulta;
if (isset($_POST['nuevo_apellido']) && isset($_POST['nuevo_nombre']) && isset($_POST['nuevo_titulo']) && isset($_POST['nuevo_datos_adicionales']) && isset($_POST['nuevo_disponibilidad'])) {

    $nuevo_apellido = $_POST['nuevo_apellido'];
    $nuevo_nombre = $_POST['nuevo_nombre'];
    $nuevo_titulo = $_POST['nuevo_titulo'];
    $nuevo_datos_adicionales = $_POST['nuevo_datos_adicionales'];
    $nuevo_disponibilidad = $_POST['nuevo_disponibilidad'];
    $query = "INSERT INTO RECURSO "
            . "VALUES ("
            . " null,"
            . " '{$nuevo_apellido}' , "
            . "'{$nuevo_nombre}' , "
            . "'{$nuevo_titulo}' , "
            . "'{$nuevo_datos_adicionales}' , "
            . "'{$nuevo_disponibilidad}' , "
            . " {$idPrograma}) ";
    $consulta = BDConexionSistema::getInstancia()->query($query);
}
?>