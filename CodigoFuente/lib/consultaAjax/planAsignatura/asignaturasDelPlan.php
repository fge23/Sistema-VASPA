<?php
//  EN ESTE SCRIPT SE MUESTRA UNA TABLA EN LA CUAL SE PRESENTA LAS ASIGNATURAS DEL CORRESPONDIENTE PLAN

//include_once '../../modeloSistema/BDConexionSistema.Class.php';
include_once '../../../modeloSistema/Plan.Class.php';
include_once '../../../modeloSistema/Profesor.Class.php';
include_once '../../../modeloSistema/Departamento.Class.php';

$idPlan = $_GET['id'];

$plan = new Plan($idPlan);

//var_dump($plan->getAsignaturas());

$asignaturas = $plan->getAsignaturas();

if (is_null($asignaturas)){
    $html = '<div class="alert alert-warning text-center" role="alert">
                No hay asignaturas asociadas a esta revisi&oacute;n del Plan de Estudio
              </div>';
} else {
    


$html = '<table class="table table-hover table-sm" id="tablaAsignaturas">
                        <thead>
                            <tr class="table-info">
                                <th>C&oacute;digo</th>
                                <th>Asignatura</th>
                                <th>Departamento</th>
                                <th>Profesor Responsable</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>';
                                foreach ($asignaturas as $asignatura) {
                                    
                                    $departamento = new Departamento($asignatura->getIdDepartamento());
                                    $profesor = new Profesor($asignatura->getIdProfesor());
                                    
                                    $html .= '<td>'.$asignatura->getId().'</td>';
                                    $html .= '<td>'.$asignatura->getNombre().'</td>';
                                    $html .= '<td>'.$departamento->getNombre().'</td>';
                                    $html .= '<td>'.$profesor->getApellido().'</td>';
                                    $html .= '<td>
                                         <a title="Ver Asignaturas correlativas" href="../vista/asignaturas.correlativas.php?id='.$asignatura->getId().'">
                                            <button type="button" class="btn btn-outline-info">
                                                <span class="oi oi-list"></span>
                                            </button>
                                        </a>
                                      </td>
                            </tr>';
                            }
                        $html .= '</tbody>
                    </table>';
}
echo $html;
?>
<script type="text/javascript">
            //$(document).ready(function () {
                $('#tablaAsignaturas').DataTable({
                    language: {
                        url: '../lib/datatable/es-ar.json'
                    }
                });
            //});
</script>

