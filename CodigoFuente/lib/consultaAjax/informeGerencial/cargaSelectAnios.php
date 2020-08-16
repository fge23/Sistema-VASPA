<?php
/*
 * En este script se arman los option con los anios correspondientes a los planes de estudio de la carrera seleccionada
 */

include_once '../../../modeloSistema/Carrera.Class.php';

$anios = '';

if (isset($_POST['codCarrera'])){
    $carrera = new Carrera($_POST['codCarrera']);
    $arrayAnios = $carrera->obtenerAniosPlanes();
    
    // Recorremos los anios de los planes y lo guardamos en un option
    
    if (is_null($arrayAnios)){
        $anios .= '<option value="-1">La carrera no tiene plan de estudio</option>';
    } else {
        foreach ($arrayAnios as $anio) {
            $anios .= '<option value="'.$anio.'">'.$anio.'</option>';
        }
    }
    
}

echo $anios;
