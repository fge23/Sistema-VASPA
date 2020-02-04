<?php

include_once '../../controlSistema/ManejadorPlan.php';
include_once '../../modeloSistema/BDConexionSistema.Class.php';
include_once '../../modeloSistema/Plan.Class.php';

$codCarrera = $_POST['id'];

$manejadorPlan = new ManejadorPlan();
$planes = $manejadorPlan->getPlanesSegunCarrera($codCarrera);

$opciones = '';

if (!empty($planes)){
    foreach ($planes as $plan) {
        $opciones .= '<option value="panelSA3.php?codCarrera='.$codCarrera.'&codPlan='.$plan->getId().'">'.$plan->getId().'</option>';
    }
}

echo $opciones;
//var_dump($planes);
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

