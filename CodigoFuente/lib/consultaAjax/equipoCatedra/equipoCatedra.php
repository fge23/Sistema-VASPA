<?php
//  EN ESTE SCRIPT SE MUESTRA UNA TABLA EN LA CUAL SE PRESENTA LAS ASIGNATURAS DEL CORRESPONDIENTE PLAN
//  Y EL BOTON DE ELIMINAR ASIGNATURA
include_once '../../../modeloSistema/BDConexionSistema.Class.php';
include_once '../../../modeloSistema/Plan.Class.php';
include_once '../../../modeloSistema/Profesor.Class.php';
include_once '../../../modeloSistema/Asignatura.Class.php';

$mensaje = '';

if (isset($_GET['idAsignatura'])){
    
    $idAsignatura= $_GET['idAsignatura'];
    
    $asignatura = new Asignatura($idAsignatura);
    $profesorResponsable = new Profesor($asignatura->getIdProfesor());
    
    // En la siguiente query vamos a obtener al equipo de catedra de la asignatura (Nota: no se obtiene al profesor responsable ya que se lo obtiene del idProfesor de la clase Asignatura)
    $sql = "SELECT * "
            . "FROM profesor JOIN profesor_asignatura ON id = idProfesor "
            . "WHERE idAsignatura = '{$idAsignatura}' "
            . "ORDER BY rol, apellido";
            
    // Ejecutamos la query            
    $resultado = BDConexionSistema::getInstancia()->query($sql);
    
    // validamos el resultado de la query (si retorna false -> Ocurrio un error en la BD)
    if (!$resultado) {
        $mensaje = '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                <strong>Ocurrio un error</strong> al cargar equipo de c&aacute;tedra.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
        
    } else {
        
        // comenzamos a armar la estructura de la tabla
            $html = '<table class="table table-hover table-sm" id="tablaEquipoCatedra">
                        <thead>
                            <tr class="table-info">
                                <th>Apellido</th>
                                <th>Nombre</th>
                                <th>Rol</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>';
            // Agregamos los datos en la primera fila del profesor Responsable
            
            $html .= '<tr>';
                $html .= '<td>'.$profesorResponsable->getApellido().'</td>';
                $html .= '<td>'.$profesorResponsable->getNombre().'</td>';
                $html .= '<td>Responsable</td>';
                $html .= '<td></td></tr>';
        
        if ($resultado->num_rows > 0) {
            
            $contador = 0; // se usara para los ID de los modal de eliminar
            while ($registro = $resultado->fetch_assoc()){
                $rol = '';
                if ($registro['rol'] == "practica"){
                    $rol = 'Pr&aacute;ctica';
                } elseif ($registro['rol'] == "teoria"){
                    $rol = 'Teor&iacute;a';
                }
                $html .= '<tr>';
                $html .= '<td>'.$registro['apellido'].'</td>';
                $html .= '<td>'.$registro['nombre'].'</td>';
                $html .= '<td>'.$rol.'</td>';
                $html .= '<td>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalEliminar'.$contador.'">
                                        Desvincular
                                      </button>

                                      <div class="modal fade" id="modalEliminar'.$contador.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="exampleModalLongTitle">Desvincular Profesor</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                              <form id="eliminar'.$contador.'">
                                            <div class="modal-body">
                                                <p>¿Esta seguro de desvincular al profesor: <b>'.$registro['apellido'].'</b>, <b>'.$registro['nombre'].'</b> del Equipo de C&aacute;tedra?</p>     
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                              <button type="submit" class="btn btn-success" data-dismiss="modal" onclick="eliminar('.$registro['idProfesor'].', &quot;'.$registro['rol'].'&quot;, '.$contador.')">Confirmar</button>
                                            </div>
                                           </form>
                                          </div>
                                        </div>
                                      </div>
                        </td>';
                $html .= '</tr>';
                
                $contador++;
            }
            
            
        }
        
        $html .= '</tbody>
                    </table>';
            
            $mensaje = $html;
        
    }
    
    echo $mensaje;
    
} else {
    echo '<div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
            <strong>Faltan datos</strong> para mostrar el Equipo de C&aacute;tedra.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
}

?>


