<?php

include_once '../../../modeloSistema/BDConexionSistema.Class.php';
include_once '../../../modeloSistema/Carrera.Class.php';
include_once '../../../modeloSistema/Plan.Class.php';
include_once '../../../modeloSistema/Asignatura.Class.php';
include_once '../../../modeloSistema/Profesor.Class.php';

// verificamos que se recibe el codCarrera desde "panelSA.php"
if (isset($_POST['codCarrera'])){
    $codCarrera = $_POST['codCarrera'];
    $carrera = new Carrera($codCarrera);
    
    // obtenemos el plan vigente de la carrera
    $plan = $carrera->getPlanVigente();

    // validamos que te tenga plan de estudio vigente la carrera
    if (is_null($plan)){
        echo '<hr>
            <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
            La carrera seleccionada <strong>no tiene un Plan de Estudio en vigencia</strong>, por favor revise o seleccione otra carrera.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>';
    } else {
        // obtenemos las asignaturas del plan de estudio
        $asignaturas = $plan->getAsignaturas();

        //validamos que no este vacio asignaturas
        if (!is_null($asignaturas)){

            // Armamos la tabla con la vigencia de los programas (si es que tiene programa) de las asignaturas del Plan
            // Solo se tienen en cuenta los programas cuya vigencia contengan el anio actual

            $html = '<hr>
                            <table class="table table-hover table-sm" id="tablaAsignaturas">
                            <thead>
                                <tr class="table-info">
                                    <th>A&ntilde;o</th>
                                    <th>Cuatr.</th>
                                    <th>C&oacute;digo</th>
                                    <th>Asignatura</th>
                                    <th>Docente Responsable</th>
                                    <th>Vigencia</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>';

            foreach ($asignaturas as $asignatura) {
                $profesor = new Profesor($asignatura->getIdProfesor());
                $programa = $asignatura->obtenerProgramaVigente();

                $mensajeCantidadNoti = '';

                if (!is_null($programa)){
                    // Vigencias del programa
                    $boton = '';
                    $vigencia = $programa->getVigencia();
                    $anio = $programa->getAnio();
                    $anioCarrera = $programa->getAnioCarrera();
                    $estado = $programa->obtenerEstadoDelPrograma();
                    //$vigencias = '';
                    if ($vigencia == 1){
                        $vigencias = $anio;
                    }
                    if ($vigencia == 2){
                        $vigencias = $anio.' - '.($anio+1);
                    }
                    if ($vigencia == 3){
                        $vigencias = $anio.' - '.($anio+1).' - '.($anio+2);
                    }

                    $cursada = '';
                    switch ($programa->getRegimenCursada()) {
                        case 'A':
                            $cursada = 'Anual';
                            break;
                        case '1':
                            $cursada = '1er';
                            break;
                        case '2':
                            $cursada = '2do';
                            break;
                        case 'O':
                            $cursada = 'Otro';
                            break;
                        default:
                            break;
                    }

                //Si el estado del programa es Aprobado, se debe visualizar el boton Generar PDF en la tabla.
                    if($estado == 'Aprobado'){

                        $boton = '<a title="Generar PDF" class="btn btn-outline-info" href="../vista/programa.generarPDF.php?id='.$programa->getId().'" role="button" target="_blank"><span class="oi oi-document"></span></a>';

                    }

                } else {
                    // como no obtuvo un programa vigente, el mismo no se encuentra "cargado"
                    $cantidadNotificaciones = '';
                    try {
                        $cantidadNotificaciones = $asignatura->obtenerCantidadNotificacionDelProgramaActual();
                    } catch (Exception $e) {
                        $cantidadNotificaciones = $e->getMessage();
                    }
                    if ($cantidadNotificaciones == 1){
                        $mensajeCantidadNoti = " (solicitado <b>$cantidadNotificaciones</b> vez)";
                    } else {
                        $mensajeCantidadNoti = " (solicitado <b>$cantidadNotificaciones</b> veces)";
                    }



                    $vigencias = '-';
                    $cursada = '-';
                    $anio = '-';
                    $anioCarrera = '-';
                    $estado = 'No Cargado';
                    $boton = '<a class="btn btn-outline-success" href="javascript:enviarNotificacion('.$asignatura->getId().')" role="button" title="Enviar Notificaci&oacute;n">'
                            . '<span class="oi oi-envelope-closed"></span></a>';
                    $boton = '<button type="button" class="btn btn-outline-success" onclick="enviarNotificacion('.$asignatura->getId().')">'
                            . '<span class="oi oi-envelope-closed"></span></button>';
                }

                $html .= '<tr>'
                        . '<td>'.$anioCarrera.'</td>'
                        . '<td>'.$cursada.'</td>'
                        . '<td>'.$asignatura->getId().'</td>'
                        . '<td>'.$asignatura->getNombre().'</td>'
                        . '<td>'.$profesor->getApellido().' '. substr($profesor->getNombre(), 0, 1).'.</td>'
                        . '<td>'.$vigencias.'</td>'
                        . '<td>'.$estado.''.$mensajeCantidadNoti.'</td>'   
                        . '<td class="text-center">'.$boton.'</td>'
                        . '</tr>';

            }

            $html .= '</tbody>'
                    . '</table>';

        echo $html;

        } else {
            echo '<hr><div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
            Ocurri&oacute; un error. El Plan: <strong>'.$plan->getId().'</strong> no tiene Asignaturas.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
        }
    }
} else {
    // retornamos un alert de que Ocurrio un error faltan datos.
    echo '<hr><div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
        Ocurrio un error. <strong>Faltan datos</strong> para llevar a cabo la operaci&oacute;n.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
}

