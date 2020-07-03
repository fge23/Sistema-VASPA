<?php
include_once '../ControlAcceso.Class.php';
include_once '../../modeloSistema/Asignatura.Class.php';
include_once '../../controlSistema/ManejadorPrograma.php';

$anioActual = date("Y");
$idAsignatura = $_GET["id"];
$Asignatura = new Asignatura($idAsignatura);
$cantidadHorasSemanales = $Asignatura->getHorasSemanales();
$ManejadorPrograma = new ManejadorPrograma();
$idProgramaActual = $ManejadorPrograma->getIDProgramaActual($anioActual, $idAsignatura);
echo $idProgramaActual;

header("location: ../../vista/cargarBibliografia.php?id=$idProgramaActual");