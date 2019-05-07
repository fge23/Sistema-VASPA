<?php

//Actualiza la lista Carreras (con las carreras) de acuerdo al anio que se selecciono de la lista desplegable

include_once '../../modeloSistema/Plan.Class.php';
include_once '../../controlSistema/ManejadorPlan.php';
include_once '../../modeloSistema/Carrera.Class.php';

$anio = $_POST['anio'];
//$anio = 2011;
$manejadorPlan = new ManejadorPlan();
$planes = $manejadorPlan->getColeccion();

//$carreras = NULL;
$carreras = '';

foreach ($planes as $plan){
    //Comprobamos que anio sea mayor igual que anio inicio y menor igual a anio fin, o que solamente sea mayor a  anio inicio y que anio fin sea nulo 
    if (($plan->getAnio_inicio() <= $anio && $plan->getAnio_fin() >= $anio) || ($plan->getAnio_inicio() <= $anio && is_null($plan->getAnio_fin()))){
        $carrera = new Carrera($plan->getIdCarrera(), NULL);
        $carreras .= '<option value="'.$carrera->getId().'">'.$carrera->getId().' - '.utf8_encode($carrera->getNombre()).'</option>';
    }
}

echo $carreras;
//var_dump($carreras);