<?php

require_once('../modeloSistema/MYPDF.php');

$idPrograma = $_GET['id'];
//var_dump($idPrograma);
$pdf = new MYPDF($idPrograma);
$pdf->generarPDFprograma();

