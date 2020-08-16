<?php
error_reporting(0); // desactivamos los warning --> sobre importacion
include_once '../../../modeloSistema/Carrera.Class.php';
include_once '../../../modeloSistema/Plan.Class.php';
include_once '../../../modeloSistema/Asignatura.Class.php';
include_once '../../../modeloSistema/Profesor.Class.php';
include_once '../../../modeloSistema/ProgramaPDF.Class.php';
include_once '../../../controlSistema/ManejadorProgramaPDF.php';

$print = ''; // valor a devolver
if (isset($_POST['codCarrera']) && isset($_POST['anio'])){
    $codCarrera = $_POST['codCarrera'];
    $anio = $_POST['anio'];
    $carrera = new Carrera($codCarrera);
    $plan = $carrera->getPlan($anio);
    $asignaturas = $plan->getAsignaturas();
    //var_dump($plan);
    
    $manejadorPDF = new ManejadorProgramaPDF($codCarrera, $anio);
    
    $programas = $manejadorPDF->getColeccion();
    
    if (is_null($plan)){
                $print = '<div class="alert alert-warning" role="alert">
                    No se encontr&oacute; el Plan de Estudio de la Carrera.
                  </div>';
    } else {
        $print .= '<table class="table table-hover table-sm" id="tablaAsignaturas">
                        <thead>
                            <tr class="table-info">
                                <th>C&oacute;digo</th>
                                <th>Asignatura</th>
                                <th>Profesor Responsable</th>
                                <th>Programa PDF disponible</th>
                            </tr>
                        </thead>
                        <tbody>';
        
        if (is_null($programas)){
            foreach ($asignaturas as $asignatura) {
                $prof = new Profesor($asignatura->getIdProfesor());
                $print .= '<tr ><td>'.$asignatura->getId().'</td>';
                $print .= '<td>'.$asignatura->getNombre().'</td>';
                $print .= '<td>'.$prof->getNombreCompleto().'</td>';
                $print .= '<td class="bg-danger text-white text-center">No</td></tr>';
                
            }
        } else {
            foreach ($asignaturas as $asignatura) {
                $prof = new Profesor($asignatura->getIdProfesor());
                if ($manejadorPDF->tieneProgramaPDF($asignatura->getId()) != ""){
                    $print .= '<tr><td>'.$asignatura->getId().'</td>';
                    $print .= '<td>'.$asignatura->getNombre().'</td>';
                    $print .= '<td>'.$prof->getNombreCompleto().'</td>';
                    $print .= '<td class="bg-success text-white text-center">Si</td></tr>';
                } else {
                    $print .= '<tr><td>'.$asignatura->getId().'</td>';
                    $print .= '<td>'.$asignatura->getNombre().'</td>';
                    $print .= '<td>'.$prof->getNombreCompleto().'</td>';
                    $print .= '<td class="bg-danger text-white text-center">No</td></tr>';
                }
            }
            
        }
        $print .= '</tbody>';
        $print .= '</table>';
        
    }
    
    
    //var_dump($programas);
    
    
} else {
            $print = '<div class="alert alert-warning" role="alert">
                    Faltan datos.
                  </div>';
}
echo $print;

