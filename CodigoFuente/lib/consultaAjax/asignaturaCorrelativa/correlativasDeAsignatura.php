<?php
//  EN ESTE SCRIPT SE MUESTRA UNA TABLA EN LA CUAL SE PRESENTA LAS ASIGNATURAS CORRELATIVAS DE LA CORRESPONDIENTE ASIGNATURA
//include_once '../../modeloSistema/BDConexionSistema.Class.php';
include_once '../../../modeloSistema/Asignatura.Class.php';


$idAsignatura = $_GET['idAsignatura'];
//var_dump($idAsignatura);
$idPlan = $_GET['idPlan'];
//var_dump($idPlan);
$asignatura = new Asignatura($idAsignatura);


$asignaturaPrecedenteAprobada = $asignatura->getAsigCorrelativaPrecedenteAprobada($idPlan);
$asignaturaPrecedenteCursada = $asignatura->getAsigCorrelativaPrecedenteCursada($idPlan);
$asignaturaSubsiguienteAprobada = $asignatura->getAsigCorrelativaSubsiguienteAprobada($idPlan);
$asignaturaSubsiguienteCursada = $asignatura->getAsigCorrelativaSubsiguienteCursada($idPlan);



if (is_null($asignaturaPrecedenteAprobada) && is_null($asignaturaPrecedenteCursada) && is_null($asignaturaSubsiguienteAprobada) && is_null($asignaturaSubsiguienteCursada) ){
    $html = '<div class="alert alert-warning text-center" role="alert">
                No hay asignaturas correlativas correspondientes a la asignatura seleccionada
              </div>';
} else {
    

$html = '<table class="table table-hover table-sm" id="tablaAsignaturas">
                        <thead>
                            <tr class="table-info">
                                <th>C&oacute;digo</th>
                                <th>Asignatura</th>
                                <th>Requisito</th>
                                <th>Tipo de Correlatividad</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>';

                if (!is_null($asignaturaPrecedenteAprobada)){

                                foreach ($asignaturaPrecedenteAprobada as $asignaturas) {
                                    
                                    $html .= '<td>'.$asignaturas->getId().'</td>';
                                    $html .= '<td>'.$asignaturas->getNombre().'</td>';
                                    
                                   $html .= '<td>'."Aprobada".'</td>';
                                   $html .= '<td>'."Precedente".'</td>
                                            </tr>';
                            }

                }


                if (!is_null($asignaturaPrecedenteCursada)){

                            foreach ($asignaturaPrecedenteCursada as $asignaturas) {
                                    
                                    
                                    $html .= '<td>'.$asignaturas->getId().'</td>';
                                    $html .= '<td>'.$asignaturas->getNombre().'</td>';
                                    
                                   $html .= '<td>'."Regular".'</td>';
                                   $html .= '<td>'."Precedente".'</td>
                                            </tr>';
                            }

                }
            

                if (!is_null($asignaturaSubsiguienteAprobada)){

                            foreach ($asignaturaSubsiguienteAprobada as $asignaturas) {
                                    
                                    
                                    $html .= '<td>'.$asignaturas->getId().'</td>';
                                    $html .= '<td>'.$asignaturas->getNombre().'</td>';
                                    
                                   $html .= '<td>'."Aprobada".'</td>';
                                   $html .= '<td>'."Subsiguiente".'</td>
                                            </tr>';
                            }


                }


                if (!is_null($asignaturaSubsiguienteCursada) ){

                            foreach ($asignaturaSubsiguienteCursada as $asignaturas) {
                                    
                                    
                                    $html .= '<td>'.$asignaturas->getId().'</td>';
                                    $html .= '<td>'.$asignaturas->getNombre().'</td>';
                                    
                                   $html .= '<td>'."Regular".'</td>';
                                   $html .= '<td>'."Subsiguiente".'</td>
                                            </tr>';
                            }

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
