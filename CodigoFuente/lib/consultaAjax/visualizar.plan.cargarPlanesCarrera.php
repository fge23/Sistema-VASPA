<?php

/* 
 * Devuelve una tabla con los planes de Estudio de la carrera seleccionada de 
 * lista desplegable Carreras
 */

error_reporting(0);

include_once '../../modeloSistema/PlanPDF.Class.php';
include_once '../../modeloSistema/Plan.Class.php';
include_once '../../controlSistema/ManejadorPlan.php';
include_once '../../controlSistema/ManejadorPlanPDF.php';

//$codCarrera = 016;
$codCarrera = $_POST['codCarrera'];

$manejadorPlan = new ManejadorPlan();
$planes = $manejadorPlan->getColeccion();

$manejadorPlanPDF = new ManejadorPlanPDF();
$planesPDF = $manejadorPlanPDF->getColeccion();

$salida = "<table class='table table-hover table-sm'>
                        <tr class='table-info'>
                            <th>C&oacute;digo Plan</th>
                            <th>Opciones</th>
                        </tr>";

$planesCarrera = "";

if (!is_null($planes)){
    foreach ($planes as $plan){
        if ($plan->getIdCarrera() == $codCarrera){
            $rutaPlan = $manejadorPlanPDF->tienePlanPDF($plan->getId());
            if (!empty($rutaPlan)){
                $planesCarrera .= "<tr><td>{$plan->getId()}</td>
                                    <td>
                                        <a title='Visualizar Plan de Estudio' href='{$rutaPlan}' target='_blank'>
                                            <button type='button' class='btn btn-outline-success'>
                                                <span class='oi oi-document'></span> Visualizar Plan
                                            </button>
                                        </a>
                                    </td>
                                </tr>";
            }
            else {
                $planesCarrera .= "<tr><td>{$plan->getId()}</td>
                                    <td>
                                        <a title='Plan de Estudio no disponible'>
                                            <button type='button' class='btn btn-outline-success' disabled>
                                                <span class='oi oi-document'></span> Visualizar Plan
                                            </button>
                                        </a>
                                    </td>
                                </tr>";
            }
            
            //$rutaPlan = $manejadorPlanPDF->tienePlanPDF($plan->getId());
            
        }
    }
} 

$salida .= $planesCarrera;
$salida .= "</table>";
        
echo $salida;