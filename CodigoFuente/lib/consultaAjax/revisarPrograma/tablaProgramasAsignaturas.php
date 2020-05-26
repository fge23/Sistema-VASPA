<?php
/* EN ESTE SCRIPT SE CONSTRUYE EL TAB CON SUS RESPECTIVAS PESTANIAS SEGUN EL 
 * ESTADO DEL PROGRAMA (NR: NO REVISADO, A: APROBADO, D: DESAPROBADO) Y EL ROL 
 * DEL USUARIO (SA: ADMIN Y SA, DCNE: DPTO CIENCIAS NATURALES Y EXACTAS, 
 * DCS: DPTO CIENCIAS SOCIALES)
 * 
 * OBSERVACIONES:
 * - Posiblemente habria que agregar un ORDER BY en la consulta segun la fecha 
 * de carga, para que muestre los programas mas reciente.
 * - 
 */

include_once '../../../modeloSistema/BDConexionSistema.Class.php';

// RECUPERAMOS codCarrera, CodPlan y el rol del usuario.
if (isset($_POST['codCarrera']) && isset($_POST['codPlan']) && isset($_POST['rol'])){
    $codCarrera = $_POST['codCarrera'];
    $codPlan = $_POST['codPlan'];
    $rol = $_POST['rol'];
    
    // Tab a retornar en la pantalla Revisar Programas
    $html = '<ul class="nav nav-tabs nav-pills nav-fill" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="noRevisadas-tab" data-toggle="tab" href="#noRevisadas" role="tab" aria-controls="noRevisadas" aria-selected="true">No Revisados / No Calificados</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="aprobados-tab" data-toggle="tab" href="#aprobados" role="tab" aria-controls="aprobados" aria-selected="false">Aprobados</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Desaprobados</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">';
                            
    
    // Obtenemos las queries de los programas de Asignaturas segun su Estado
    
    $programasNoRevisados = getQuery($codCarrera, $codPlan, $rol, "NR");
    $programasAprobados = getQuery($codCarrera, $codPlan, $rol, "A");
    $programasDesaprobados = getQuery($codCarrera, $codPlan, $rol, "D");
    
    // Ejecutamos las consultas
    
    // PESTANIA PROGRAMA NO REVISADOS / NO CALIFICADOS
    $resultado = BDConexionSistema::getInstancia()->query($programasNoRevisados);
    
    $html .= '<div class="tab-pane fade show active" id="noRevisadas" role="tabpanel" aria-labelledby="noRevisadas-tab">';
    $html .= '<br>';
    if ($resultado !== false){
        if ($resultado->num_rows > 0) {
            // Creamos la tabla donde presentaremos la info
            $html .= '<table class="table table-hover table-sm" id="tablaProgramaNR">
                        <thead>
                            <tr class="table-info">
                                <th>Programa de</th>
                                <th>C&oacute;digo</th>
                                <th>Vigencia</th>
                                <th>Fecha de Carga</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>';
            for ($x = 0; $x < $resultado->num_rows; $x++) {
                
                $fila = $resultado->fetch_assoc();
                $fechaCarga = new DateTime($fila['fechaCarga']);
                $fechaCarga = $fechaCarga->format('d/m/y');
                $html .= '<tr>';
                $html .= '<td>'.$fila['nombre'].'</td>';
                $html .= '<td>'.$fila['id'].'</td>';
                $html .= '<td>'.getVigencia($fila['anio'], $fila['vigencia']).'</td>';
                $html .= '<td>'.$fechaCarga.'</td>';
                $html .= '<td><a title="Revisar Programa" href="revisar.programa.php?id='.$fila['idPrograma'].'">
                                        <button type="button" class="btn btn-outline-success">
                                            <span class="oi oi-document"></span>
                                        </button></a></td>';
                $html .= '</tr>';
                //$planes[] = $this->datos->fetch_object("Plan"); // creamos objeto
//                echo '<br>'.$fila['id'];
//                echo '<br>'.$fila['nombre'];
//                echo '<br>';
            }
            // cerramos etiquetas de la tabla
            $html .= '</tbody>';
            $html .= '</table>';
        } else { // No hay registros --> Mostramos mensaje en la pestania
            $html .= '<div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
                    No hay programas de asignaturas.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
        }
    }
    // cerramos el div de la pestania
    $html .= '</div>';
    
    
    // PESTANIA PROGRAMA APROBADOS
    $resultado = BDConexionSistema::getInstancia()->query($programasAprobados);
    
    $html .= '<div class="tab-pane fade" id="aprobados" role="tabpanel" aria-labelledby="aprobados-tab">';
    $html .= '<br>';
    if ($resultado !== false){
        if ($resultado->num_rows > 0) {
            // Creamos la tabla donde presentaremos la info
            $html .= '<table class="table table-hover table-sm" id="tablaProgramaA">
                        <thead>
                            <tr class="table-info">
                                <th>Programa de</th>
                                <th>C&oacute;digo</th>
                                <th>Vigencia</th>
                                <th>Fecha de Carga</th>
                            </tr>
                        </thead>
                        <tbody>';
            for ($x = 0; $x < $resultado->num_rows; $x++) {
                
                $fila = $resultado->fetch_assoc();
                $fechaCarga = new DateTime($fila['fechaCarga']);
                $fechaCarga = $fechaCarga->format('d/m/y');
                $html .= '<tr>';
                $html .= '<td>'.$fila['nombre'].'</td>';
                $html .= '<td>'.$fila['id'].'</td>';
                $html .= '<td>'.getVigencia($fila['anio'], $fila['vigencia']).'</td>';
                $html .= '<td>'.$fechaCarga.'</td>';
//                $html .= '<td><a title="Revisar Programa" href="revisar.programa.php?id='.$fila['idPrograma'].'" target="_blank">
//                                        <button type="button" class="btn btn-outline-success">
//                                            <span class="oi oi-document"></span>
//                                        </button></a></td>';
                $html .= '</tr>';

            }
            // cerramos etiquetas de la tabla
            $html .= '</tbody>';
            $html .= '</table>';
        } else { // No hay registros --> Mostramos mensaje en la pestania
            $html .= '<div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
                    No hay programas de asignaturas.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
        }
    }
    // cerramos el div de la pestania
    $html .= '</div>';
    
    
    // PESTANIA PROGRAMAS DESAPROBADOS
    $resultado = BDConexionSistema::getInstancia()->query($programasDesaprobados);
    
    $html .= '<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">';
    $html .= '<br>';
    if ($resultado !== false){
        if ($resultado->num_rows > 0) {
            // Creamos la tabla donde presentaremos la info
            $html .= '<table class="table table-hover table-sm" id="tablaProgramaD">
                        <thead>
                            <tr class="table-info">
                                <th>Programa de</th>
                                <th>C&oacute;digo</th>
                                <th>Vigencia</th>
                                <th>Fecha de Carga</th>
                            </tr>
                        </thead>
                        <tbody>';
            for ($x = 0; $x < $resultado->num_rows; $x++) {
                
                $fila = $resultado->fetch_assoc();
                $fechaCarga = new DateTime($fila['fechaCarga']);
                $fechaCarga = $fechaCarga->format('d/m/y');
                $html .= '<tr>';
                $html .= '<td>'.$fila['nombre'].'</td>';
                $html .= '<td>'.$fila['id'].'</td>';
                $html .= '<td>'.getVigencia($fila['anio'], $fila['vigencia']).'</td>';
                $html .= '<td>'.$fechaCarga.'</td>';
//                $html .= '<td><a title="Revisar Programa" href="revisar.programa.php?id='.$fila['idPrograma'].'" target="_blank">
//                                        <button type="button" class="btn btn-outline-success">
//                                            <span class="oi oi-document"></span>
//                                        </button></a></td>';
                $html .= '</tr>';
                //$planes[] = $this->datos->fetch_object("Plan"); // creamos objeto
//                echo '<br>'.$fila['id'];
//                echo '<br>'.$fila['nombre'];
//                echo '<br>';
            }
            // cerramos etiquetas de la tabla
            $html .= '</tbody>';
            $html .= '</table>';
        } else { // No hay registros --> Mostramos mensaje en la pestania
            $html .= '<div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
                    No hay programas de asignaturas.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
        }
    }
    // cerramos el div de la pestania
    $html .= '</div>';
    
    // cerramos div tab
    $html .= '</div>';
    
    echo $html;
    
} else {
    // retornamos un alert de que Ocurrio un error faltan datos.
    echo '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
        Ocurrio un error. <strong>Faltan datos</strong> para llevar a cabo la operaci&oacute;n.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
}

// Esta funcion retorna la query a ejecutar para presentar los datos relacionados a los programas segun su estado y el rol del usuario
// dicha query devuelve aquellos programas cuya vigencia incluya el año actual y se encuentren en el estado en "En Revision"
// y que se correspondan a la carrera y plan seleccionado de la lista desplegable
function getQuery($codCarrera, $codPlan, $rol, $estado) {
    
    $anioActual = date("Y"); //obtenemos el anio (4 digitos) del servidor (anio actual)
    $est = getEstadoSegunRol($estado, $rol);
    $query = "SELECT nombre, a.id, anio, vigencia, fechaCarga, p.id as idPrograma 
                FROM plan pl
                JOIN plan_asignatura pa 
                ON pl.id = pa.idPlan
                JOIN asignatura a 
                ON pa.idAsignatura = a.id 
                JOIN programa p 
                ON a.id = p.idAsignatura 
                WHERE idCarrera = '{$codCarrera}' "
                . "AND enRevision = 1 "
                . "AND anio <= {$anioActual} "
                . "AND (anio+vigencia-1) >= {$anioActual} "
                . "AND idPlan = '{$codPlan}'{$est}";
    
                /*
                 * Si año actual es: 2020
                 * año creacion del programa es: 2019
                 * años de vigencia es 3 --> 2019, 2020, 2021
                 * anio+vigencia-1 = 2021
                 * 
                 */
    return $query;
}

function getEstadoSegunRol($estado, $rol){
    $resultado = '';
    
    switch ($rol) {
        case 'SA':
            switch ($estado) {
                case 'A': // Aprobado
                    $resultado = " AND aprobadoSa = 1";

                    break;
                case 'D': // Desaprobado
                    $resultado = " AND aprobadoSa = 0";

                    break;
                case 'NR': // No revisado
                    $resultado = " AND aprobadoSa IS NULL";

                    break;

        //        default:
        //            break;
            }
            break;
        
        case 'DCNE':
            switch ($estado) {
                case 'A': // Aprobado
                    $resultado = " AND idDepartamento = '2' AND aprobadoDepto = 1";

                    break;
                case 'D': // Desaprobado
                    $resultado = " AND idDepartamento = '2' AND aprobadoDepto = 0";

                    break;
                case 'NR': // No revisado
                    $resultado = " AND idDepartamento = '2' AND aprobadoDepto IS NULL";

                    break;

        //        default:
        //            break;
            }
            break;
        
        case 'DCS':
            switch ($estado) {
                case 'A': // Aprobado
                    $resultado = " AND idDepartamento = '1' AND aprobadoDepto = 1";

                    break;
                case 'D': // Desaprobado
                    $resultado = " AND idDepartamento = '1' AND aprobadoDepto = 0";

                    break;
                case 'NR': // No revisado
                    $resultado = " AND idDepartamento = '1' AND aprobadoDepto IS NULL";

                    break;

        //        default:
        //            break;
            }
            break;

//        default:
//            break;
    }
        
    return $resultado;
}

function getVigencia($anio, $vigencia) {
    switch ($vigencia) {
        case 1:
            return $anio;
            //break;
        case 2:
            return $anio.' - '.($anio+1);
            //break;
        case 3:
            return $anio.' - '.($anio+1).' - '.($anio+2);
            //break;

        default:
            return $anio;
            //break;
    }
}

?>
<script type="text/javascript">
                $('.table').DataTable({
                    language: {
                        url: '../lib/datatable/es-ar.json'
                    }
                });
</script>