<?php

// Generar el pdf de un programa de asignatura, se utiliza en el CU REVISAR PROGRAMA para la previsualizacion del programa
include_once '../lib/ControlAcceso.Class.php';
ControlAcceso::requierePermiso(PermisosSistema::PERMISO_REVISAR_PROGRAMA);
require_once('../modeloSistema/MYPDF.php');

$idPrograma = $_GET['id'];

try {
    $pdf = new MYPDF($idPrograma);
    $pdf->generarPDFprograma();
} catch (Exception $exc) {
    echo '<div class="alert alert-danger" role="alert">
            Ocurri&oacute; un error al intentar previsualizar el Programa. ('.$exc->getMessage().')
          </div>';
}