<?php


include_once '../../../modeloSistema/BDConexionSistema.Class.php';
include_once '../../../modeloSistema/Plan.Class.php';
include_once '../../../modeloSistema/Asignatura.Class.php';
include_once '../../../modeloSistema/Profesor.Class.php';

if (isset($_POST['codPlan'])){
    //$codCarrera = $_POST['codCarrera'];
    $codPlan = $_POST['codPlan'];
    
    $plan = new Plan($codPlan);

    // obtenemos las asignaturas del plan de estudio
    $asignaturas = $plan->getAsignaturas();

    //validamos que no este vacio asignaturas
    if (!is_null($asignaturas)){
        
        // Armamos la tabla con la vigencia de los programas (si es que tiene programa) de las asignaturas del Plan
        // Solo se tienen en cuenta los programas cuya vigencia contengan el anio actual
        
        $html = '<hr>
                        <table id="table" 
                           data-toggle="table"
                           data-locale="es-ES"
                           data-search="true"
                           data-search-align="left"
                           data-show-fullscreen="true"
                           data-show-columns="true"
                           data-filter-control="true" 
                           data-show-export="true"
                           data-export-types="[&#39;excel&#39;]"
                           data-export-options=&#39;{}&#39;
                           data-pagination="true"
                           data-pagination-loop="false"
                           data-pagination-pre-text="Anterior"
                           data-pagination-next-text="Siguiente"
                           data-click-to-select="true"
                           data-icons-prefix="oi"
                           data-icons="icons"
                           data-buttons-class="outline-secondary"
                           class="table table-hover table-sm">
                        <thead class="thead-light">
                            <tr>
                                <th data-field="anio" data-filter-control="select" data-filter-control-placeholder="A&ntilde;o" data-sortable="true" data-halign="center" data-align="center" data-title-tooltip="A&ntilde;o de la Carrera">A&ntilde;o</th>
                                <th data-field="cuatrimestre" data-filter-control="select" data-filter-control-placeholder="Cuatr." data-sortable="true" data-halign="center" data-align="center" data-title-tooltip="R&eacute;gimen de Cursado">Cuatr.</th>
                                <th data-field="codigo" data-filter-control="select" data-filter-control-placeholder="Cod." data-sortable="true" data-halign="center" data-align="center" data-title-tooltip="C&oacute;digo de la Asignatura">C&oacute;digo</th>
                                <th data-field="asignatura" data-filter-control="input" data-filter-control-placeholder="Buscar por Asignatura " data-sortable="true" data-halign="center" data-align="left">Asignatura</th>
                                <th data-field="docenteResponsable" data-filter-control="input" data-filter-control-placeholder="Buscar por Docente" data-sortable="true" data-halign="center" data-align="left">Docente Responsable</th>
                                <th data-field="vigencia" data-halign="center" data-align="center">Vigencia</th>
                                <th data-field="estado" data-halign="center">Estado</th>
                                <th data-field="acciones" data-halign="center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>';
        
        foreach ($asignaturas as $asignatura) {
            $profesor = new Profesor($asignatura->getIdProfesor());
            $programa = $asignatura->obtenerProgramaVigente();
            
            $mensajeCantidadNoti = '';
                        
            if (!is_null($programa)){
                // Vigencias del programa
                $botonEnviarNotificacion = '';
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
            } else {
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
                $botonEnviarNotificacion = '<a class="btn btn-outline-success" href="javascript:enviarNotificacion('.$asignatura->getId().')" role="button" title="Enviar Notificaci&oacute;n">'
                        . '<span class="oi oi-envelope-closed"></span></a>';
                $botonEnviarNotificacion = '<button type="button" class="btn btn-outline-success" onclick="enviarNotificacion('.$asignatura->getId().')">'
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
                    . '<td class="text-center">'.$botonEnviarNotificacion.'</td>'
                    . '</tr>';
        
        }
        
        $html .= '</tbody>'
                . '</table>';
    
    echo $html;
        
    } else {
        echo '<hr><div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
        Ocurrio un error. El Plan: <strong>'.$plan->getId().'</strong> no tiene Asignaturas.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
    }
    
} else {
    // retornamos un alert de que Ocurrio un error faltan datos.
    echo '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
        Ocurrio un error. <strong>Faltan datos</strong> para llevar a cabo la operaci&oacute;n.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
}


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>

<script>
            $(function() {
              $('#table').bootstrapTable()
            });
    </script>
    <script>
        window.icons = {
          refresh: 'oi-reload',
          fullscreen: 'oi-fullscreen-enter',
          export: 'oi-document',
          columns: 'oi-list'
        }
    </script>