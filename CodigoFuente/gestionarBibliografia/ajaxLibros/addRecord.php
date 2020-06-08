<?php
include_once '../../modeloSistema/BDConexionSistema.Class.php';
$idPrograma = $_GET["id"];

$query;
/**
 *
 * @var mysqli_result
 */
$consulta;
/* Definir IDs para cada tipo de bibliogafia. 
 */
if (isset($_POST['nuevo_apellido']) && isset($_POST['nuevo_nombre'])) {
    $nuevo_apellido = $_POST['nuevo_apellido'];
    $nuevo_nombre = $_POST['nuevo_nombre'];
    $nuevo_referencia = $_POST['nuevo_referencia'];
    $nuevo_anioEdicion = $_POST['nuevo_anioEdicion'];
    $nuevo_titulo = $_POST['nuevo_titulo'];
    $nuevo_capitulo = $_POST['nuevo_capitulo'];
    $nuevo_lugarEdicion = $_POST['nuevo_lugarEdicion'];
    $nuevo_editorial = $_POST['nuevo_editorial'];
    $nuevo_biblioteca = $_POST['nuevo_biblioteca'];
    $nuevo_siunpa = $_POST['nuevo_siunpa'];
    $nuevo_unidad = $_POST['nuevo_unidad'];
    $nuevo_otro = $_POST['nuevo_otro'];
    $nuevo_tipoBibliografia = $_POST['nuevo_tipoBibliografia'];

    $query = "INSERT INTO LIBRO "
            . "VALUES ("
            . " null,"
            . "'{$nuevo_referencia}' , "
            . "'{$nuevo_apellido}' , "
            . "'{$nuevo_nombre}' , "
            . "{$nuevo_anioEdicion} , "
            . "'{$nuevo_titulo}' , "
            . "'{$nuevo_capitulo}' , "
            . "'{$nuevo_lugarEdicion}' , "
            . "'{$nuevo_editorial}' , "
            . "'{$nuevo_unidad}' , "
            . "'{$nuevo_biblioteca}' , "
            . "'{$nuevo_siunpa}' , "
            . "'{$nuevo_otro}' ,"
            . "'{$nuevo_tipoBibliografia}', "
            . " {$idPrograma}) ";
/*
 * DEBUG DE QUERY MYSQL
    $file = fopen("archivoVASPA.txt", "w");
    fwrite($file, $query . PHP_EOL);
    fclose($file);
 */
    $consulta = BDConexionSistema::getInstancia()->query($query);
}