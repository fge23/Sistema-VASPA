<?php
//  EN ESTE SCRIPT SE MUESTRA UNA TABLA EN LA CUAL SE PRESENTA LAS ASIGNATURAS CORRELATIVAS DE LA CORRESPONDIENTE ASIGNATURA
//  Y EL BOTON DE ELIMINAR ASIGNATURA
//include_once '../../modeloSistema/BDConexionSistema.Class.php';
include_once '../../../modeloSistema/Asignatura.Class.php';

// Falta validar el GET ¿Pero para que tanta validaciones? No es la parte mas importante del sistema
$idAsignatura = $_GET['id'];
//var_dump($idAsignatura);

$asignatura = new Asignatura($idAsignatura);


$asignaturaPrecedenteAprobada = $asignatura->getAsigCorrelativaPrecedenteAprobada();
$asignaturaPrecedenteCursada = $asignatura->getAsigCorrelativaPrecedenteCursada();
$asignaturaSubsiguienteAprobada = $asignatura->getAsigCorrelativaSubsiguienteAprobada();
$asignaturaSubsiguienteCursada = $asignatura->getAsigCorrelativaSubsiguienteCursada();



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
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>';

                if (!is_null($asignaturaPrecedenteAprobada)){

                                foreach ($asignaturaPrecedenteAprobada as $asignaturas) {
                                    
                                    $html .= '<td>'.$asignaturas->getId().'</td>';
                                    $html .= '<td>'.$asignaturas->getNombre().'</td>';
                                    
                                   $html .= '<td>'."Aprobada".'</td>';
                                   $html .= '<td>'."Precedente".'</td>';

                                    $html .= '<td>
                                          <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalEliminar'.$asignaturas->getId().'">
                                        Eliminar
                                      </button>

                                      <div class="modal fade" id="modalEliminar'.$asignaturas->getId().'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="exampleModalLongTitle">Eliminar</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                              <form id="eliminar'.$asignaturas->getId().'">
                                            <div class="modal-body">
                                                <input type="hidden" id="codAsigEliminar'.$asignaturas->getId().'" name="codAsigEliminar" value="'.$asignaturas->getId().'">
                                                <p>¿Esta seguro de eliminar la asignatura: <b>'.$asignaturas->getId().'</b> - <b>'.$asignaturas->getNombre().'</b></p>     

                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                              <button type="submit" class="btn btn-danger" data-dismiss="modal" onclick="eliminar(&quot;'.$asignaturas->getId().'&quot;,&quot;'."Aprobada".'&quot;,&quot;'."Precedente".'&quot;)">Confirmar</button>
                                            </div>
                                           </form>
                                          </div>
                                        </div>
                                      </div>
                                    </td>
                                </tr>';
                            }

                }


                if (!is_null($asignaturaPrecedenteCursada)){

                            foreach ($asignaturaPrecedenteCursada as $asignaturas) {
                                    
                                    
                                    $html .= '<td>'.$asignaturas->getId().'</td>';
                                    $html .= '<td>'.$asignaturas->getNombre().'</td>';
                                    
                                   $html .= '<td>'."Regular".'</td>';
                                   $html .= '<td>'."Precedente".'</td>';

                                    $html .= '<td>
                                          <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalEliminar'.$asignaturas->getId().'">
                                        Eliminar
                                      </button>

                                      <div class="modal fade" id="modalEliminar'.$asignaturas->getId().'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="exampleModalLongTitle">Eliminar</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                              <form id="eliminar'.$asignaturas->getId().'">
                                            <div class="modal-body">
                                                <input type="hidden" id="codAsigEliminar'.$asignaturas->getId().'" name="codAsigEliminar" value="'.$asignaturas->getId().'">
                                                <p>¿Esta seguro de eliminar la asignatura: <b>'.$asignaturas->getId().'</b> - <b>'.$asignaturas->getNombre().'</b></p>     

                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                              <button type="submit" class="btn btn-danger" data-dismiss="modal" onclick="eliminar(&quot;'.$asignaturas->getId().'&quot;,&quot;'."Regular".'&quot;,&quot;'."Precedente".'&quot;)">Confirmar</button>
                                            </div>
                                           </form>
                                          </div>
                                        </div>
                                      </div>
                                    </td>
                                </tr>';
                            }

                }
            


                if (!is_null($asignaturaSubsiguienteAprobada)){

                            foreach ($asignaturaSubsiguienteAprobada as $asignaturas) {
                                    
                                    
                                    $html .= '<td>'.$asignaturas->getId().'</td>';
                                    $html .= '<td>'.$asignaturas->getNombre().'</td>';
                                    
                                   $html .= '<td>'."Aprobada".'</td>';
                                   $html .= '<td>'."Subsiguiente".'</td>';

                                    $html .= '<td>
                                          <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalEliminar'.$asignaturas->getId().'">
                                        Eliminar
                                      </button>

                                      <div class="modal fade" id="modalEliminar'.$asignaturas->getId().'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="exampleModalLongTitle">Eliminar</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                              <form id="eliminar'.$asignaturas->getId().'">
                                            <div class="modal-body">
                                                <input type="hidden" id="codAsigEliminar'.$asignaturas->getId().'" name="codAsigEliminar" value="'.$asignaturas->getId().'">
                                                <p>¿Esta seguro de eliminar la asignatura: <b>'.$asignaturas->getId().'</b> - <b>'.$asignaturas->getNombre().'</b></p>     

                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                              <button type="submit" class="btn btn-danger" data-dismiss="modal" onclick="eliminar(&quot;'.$asignaturas->getId().'&quot;,&quot;'."Aprobada".'&quot;,&quot;'."Subsiguiente".'&quot;)">Confirmar</button>
                                            </div>
                                           </form>
                                          </div>
                                        </div>
                                      </div>
                                    </td>
                                </tr>';
                            }


                }



                if (!is_null($asignaturaSubsiguienteCursada) ){

                            foreach ($asignaturaSubsiguienteCursada as $asignaturas) {
                                    
                                    
                                    $html .= '<td>'.$asignaturas->getId().'</td>';
                                    $html .= '<td>'.$asignaturas->getNombre().'</td>';
                                    
                                   $html .= '<td>'."Regular".'</td>';
                                   $html .= '<td>'."Subsiguiente".'</td>';

                                    $html .= '<td>
                                          <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalEliminar'.$asignaturas->getId().'">
                                        Eliminar
                                      </button>

                                      <div class="modal fade" id="modalEliminar'.$asignaturas->getId().'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="exampleModalLongTitle">Eliminar</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                              <form id="eliminar'.$asignaturas->getId().'">
                                            <div class="modal-body">
                                                <input type="hidden" id="codAsigEliminar'.$asignaturas->getId().'" name="codAsigEliminar" value="'.$asignaturas->getId().'">
                                                <p>¿Esta seguro de eliminar la asignatura: <b>'.$asignaturas->getId().'</b> - <b>'.$asignaturas->getNombre().'</b></p>     

                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                              <button type="submit" class="btn btn-danger" data-dismiss="modal" onclick="eliminar(&quot;'.$asignaturas->getId().'&quot;,&quot;'."Regular".'&quot;,&quot;'."Subsiguiente".'&quot;)">Confirmar</button>
                                            </div>
                                           </form>
                                          </div>
                                        </div>
                                      </div>
                                    </td>
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
