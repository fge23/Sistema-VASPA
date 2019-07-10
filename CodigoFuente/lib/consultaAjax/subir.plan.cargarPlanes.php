<?php

/* 
 * Devuelve los planes disponibles de una determinada carrera que se selecciona 
 * en la lista despegable Carrera.
 */

include_once '../../modeloSistema/Plan.Class.php';
include_once '../../controlSistema/ManejadorPlan.php';


$codCarrera = $_POST['codCarrera'];

$manejadorPlan = new ManejadorPlan();
$planes = $manejadorPlan->getColeccion();

$planesCarrera = '';

foreach ($planes as $plan){
    if ($plan->getIdCarrera() == $codCarrera){
        $planesCarrera .= '<option value="'.$plan->getId().'">'.$plan->getId().'</option>';
    }
}

echo $planesCarrera;