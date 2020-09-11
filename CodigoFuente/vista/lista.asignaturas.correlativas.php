<?php

$data_asignaturas = json_decode($_POST['vectorAsignaturas']);
$data_requisitos = json_decode($_POST['vectorRequisitos']);
$data_tipos = json_decode($_POST['vectorTipos']);

session_start();

$_SESSION['vectorAsignaturas'] = $data_asignaturas;
$_SESSION['vectorRequisitos'] = $data_requisitos;
$_SESSION['vectorTipos'] = $data_tipos;

header("location: asignaturas.correlativas.procesar.php");

?>