<?php
//include_once '../../../controlSistema/ManejadorPlan.php';
include_once '../../../modeloSistema/Carrera.Class.php';

$planesEstudio = '';
if (isset($_POST['codCarrera'])){
    $carrera = new Carrera($_POST['codCarrera']);

    try {
        $planes = $carrera->getPlanesDeEstudio();
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    
    // Recorremos los planes y lo guardamos en un option
    
    if (is_null($planes)){
        $planesEstudio .= '<option value="-1">No hay Planes de Estudio</option>';
    } else {
        foreach ($planes as $plan) {
            $planesEstudio .= '<option value="'.$plan->getId().'">'.$plan->getId().' - '.$plan->getPeriodo().'</option>';
        }
    }
    
}

echo $planesEstudio;



/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

