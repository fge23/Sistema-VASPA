<?php
//FALTA REALIZAR EL MANEJO DE EXCEPCIONES!!
include_once '../lib/Constantes.Class.php';
include_once '../modeloSistema/BDConexionSistema.Class.php';
include_once '../controlSistema/ManejadorPrograma.php';

//Se recupera ID del programa de la URL
$idPrograma = $_GET["id"];
//echo "El ID del programa es: " . $idPrograma;

//Se consulta a que asignatura pertenece el Programa
$queryIDAsignatura = "SELECT idAsignatura FROM PROGRAMA WHERE id = {$idPrograma}";
$datosIDAsignatura = BDConexionSistema::getInstancia()->query($queryIDAsignatura);
$resultadoIDAsignatura = $datosIDAsignatura->fetch_assoc();
$idAsignatura = $resultadoIDAsignatura['idAsignatura'];
//echo $idAsignatura;

//Se recupera el año actual para llamar al metodo getUltimoPrograma
$anioActual = date("Y");
$ManejadorPrograma = new ManejadorPrograma();
//Se obtiene el ID del Programa Anterior de la asignatura
$idProgramaAnterior = $ManejadorPrograma->getUltimoPrograma($anioActual, $idAsignatura);
if (!isset($idProgramaAnterior)) {
    echo '<script language="javascript">alert("No hay Programa anterior");</script>';
}
//echo $idProgramaAnterior;

$mensaje = "";

//Se copian todos los registros correspondientes de la tabla Libro, modificando su id y su idPrograma
$queryLibro = "INSERT INTO libro (referencia, apellido, nombre, anioEdicion, titulo, capitulo, lugarEdicion, editorial, unidad, biblioteca, siunpa, otro, tipoLibro, idPrograma) "
        . "SELECT referencia, apellido, nombre, "
        . "anioEdicion, titulo, capitulo, "
        . "lugarEdicion, editorial, unidad, "
        . "biblioteca, siunpa, otro, tipoLibro, "
        . "{$idPrograma} as idPrograma "
        . "FROM libro where idPrograma = {$idProgramaAnterior}";
$resultadoLibro = BDConexionSistema::getInstancia()->query($queryLibro);



//Se copian todos los registros correspondientes de la tabla revista, modificando su id y su idPrograma
$queryRevista = "INSERT INTO revista (apellido, nombre, tituloArticulo, tituloRevista, pagina, fecha, unidad, biblioteca, siunpa, otro, idPrograma) "
        . "SELECT apellido, nombre, "
        . "tituloArticulo, tituloRevista, "
        . "pagina, fecha, unidad, "
        . "biblioteca, siunpa, otro, "
        . "{$idPrograma} as idPrograma "
        . "FROM revista where idPrograma = {$idProgramaAnterior}";
$resultadoRevista = BDConexionSistema::getInstancia()->query($queryRevista);

//Se copian todos los registros correspondientes de la tabla recurso, modificando su id y su idPrograma
$queryRecurso = "INSERT INTO recurso (apellido, nombre, titulo, datosAdicionales, disponibilidad, idPrograma) "
        . "SELECT apellido, nombre, "
        . "titulo, datosAdicionales, disponibilidad, "
        . "{$idPrograma} as idPrograma "
        . "FROM recurso where idPrograma = {$idProgramaAnterior}";
$resultadoRecurso = BDConexionSistema::getInstancia()->query($queryRecurso);



//Se copian todos los registros correspondientes de la tabla otro_material, modificando su id y su idPrograma
$queryOtroMaterial = "INSERT INTO otro_material (descripcion, idPrograma) "
        . "SELECT descripcion, "
        . "{$idPrograma} as idPrograma "
        . "FROM otro_material where idPrograma = {$idProgramaAnterior}";
$resultadoOtroMaterial = BDConexionSistema::getInstancia()->query($queryOtroMaterial);


//Se redirige a la pantalla anterior
header("location: cargarBibliografia.php?id={$idPrograma}");
