<?php

// Generar el pdf de un programa de asignatura, se utiliza en el CU REVISAR PROGRAMA
require_once('../modeloSistema/MYPDF.php');

//FALTA VALIDAR EL ID DEL PROGRAMA

$idPrograma = $_GET['id'];

$pdf = new MYPDF($idPrograma);
$pdf->generarPDFprograma();


