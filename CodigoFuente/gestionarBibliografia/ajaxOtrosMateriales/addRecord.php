<?php
  include_once '../../modeloSistema/BDConexionSistema.Class.php';
$idPrograma = $_GET["id"];
$query;
/**
 *
 * @var mysqli_result
 */
$consulta;
if (isset($_POST['nuevo_descripcion'])) {
 
 $nuevo_descripcion =  $_POST['nuevo_descripcion'];

    /*
     * @ToDo: integrar con CU de Programa y pasar el idPrograma correspondiente
     */
    $query = "INSERT INTO otro_material "
            . "VALUES ("
            . " null,"
            . " '{$nuevo_descripcion}' , "
            . " {$idPrograma}) ";
    $consulta = BDConexionSistema::getInstancia()->query($query);
}
?>