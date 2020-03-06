<?php
//  EN ESTE SCRIPT SE MUESTRA UNA TABLA EN LA CUAL SE PRESENTA LAS ASIGNATURAS DEL CORRESPONDIENTE PLAN
//  Y EL BOTON DE ELIMINAR ASIGNATURA
//include_once '../../modeloSistema/BDConexionSistema.Class.php';
include_once '../../../modeloSistema/Plan.Class.php';
include_once '../../../modeloSistema/Profesor.Class.php';
include_once '../../../modeloSistema/Departamento.Class.php';

// Falta validar el GET ¿Pero para que tanta validaciones? No es la parte mas importante del sistema
$idPlan = $_GET['id'];

$plan = new Plan($idPlan);

//var_dump($plan->getAsignaturas());

$asignaturas = $plan->getAsignaturas();

if (is_null($asignaturas)){
    $html = '<div class="alert alert-warning text-center" role="alert">
                No hay asignaturas asociadas a este Plan de Estudio
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
                                          <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalEliminar'.$asignatura->getId().'">
                                        Eliminar
                                      </button>

                                      <div class="modal fade" id="modalEliminar'.$asignatura->getId().'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="exampleModalLongTitle">Eliminar</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                              <form id="eliminar'.$asignatura->getId().'">
                                            <div class="modal-body">
                                                <input type="hidden" id="codAsigEliminar'.$asignatura->getId().'" name="codAsigEliminar" value="'.$asignatura->getId().'">
                                                <p>¿Esta seguro de eliminar la asignatura: <b>'.$asignatura->getId().'</b> - <b>'.$asignatura->getNombre().'</b></p>     

                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                              <button type="submit" class="btn btn-danger" data-dismiss="modal" onclick="eliminar(&quot;'.$asignatura->getId().'&quot;)">Confirmar</button>
                                            </div>
                                           </form>
                                          </div>
                                        </div>
                                      </div>
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

