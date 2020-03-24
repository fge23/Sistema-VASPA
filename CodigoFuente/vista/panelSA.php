<?php 
include_once '../lib/ControlAcceso.Class.php'; 
include_once '../controlSistema/ManejadorCarrera.php';

$manejadorCarrera = new ManejadorCarrera();
$carreras = $manejadorCarrera->getColeccion();
?>

<html lang="es">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
      <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>
      <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
      <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.8/css/bootstrap-select.min.css" rel="stylesheet"/>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.8/js/bootstrap-select.min.js"></script>
      <link rel="stylesheet" href="../lib/bootstrap-table/bootstrap-table.min.css">
      <link rel="stylesheet" type="text/css" href="../lib/bootstrap-table/extensions/filter-control/bootstrap-table-filter-control.css">
      <script src="../lib/bootstrap-table/bootstrap-table.min.js"></script>
      <script src="../lib/bootstrap-table/extensions/filter-control/bootstrap-table-filter-control.js"></script>
      <script src="../lib/bootstrap-table/extensions/export/bootstrap-table-export.min.js"></script>
      <script src="../lib/bootstrap-table/extensions/toolbar/bootstrap-table-toolbar.min.js"></script>
      <script src="../lib/bootstrap-table/locale/bootstrap-table-es-ES.js" ></script>
      <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
      <script src="../lib/bootstrap-table/tableExport.js"></script>
      <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
      
      <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Bienvenida</title>
      
      <script type="text/javaScript">
            $(document).ready(function(){
              // En este script modificamos el nombre del archivo a exportar en una hoja de calculo
              var codCarrera = $('#carrera').val();
              var codPlan = $('#plan').val(); //Obtiene el value
              var valor = $("#plan option:selected").html(); //Obtiene el contenido del option seleccionado
              var nombre = "Vigencias_Programas_"+codCarrera+"_"+valor; //nombre del archivo
              $('#table').bootstrapTable('refreshOptions', {
                  exportOptions: {fileName: nombre}
              });
            });
      </script>
      
    </head>
    <body>
        <?php include_once '../gui/navbar.php'; ?>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3>Panel Secretar&iacute;a Acad&eacute;mica</h3>
                        </div>
                        <div class="card-body">
                           
                                <div class="row">
                                    <div class="col-sm-6">
                                    <label for="carrera">Carrera</label>
                                    <select id="carrera" name="carrera" class="selectpicker" data-width="100%" data-live-search="true" required="" title="Seleccione una Carrera" data-none-results-text="No se encontraron resultados">
                                        <?php if (!empty($carreras)){
                                                    if (!empty($_GET['codCarrera']) && !empty($_GET['codPlan'])){
                                                        foreach ($carreras as $carrera) {
                                                            if ($_GET['codCarrera'] == $carrera->getId()){
                                                                echo '<option value="'.$carrera->getId().'" selected>'.$carrera->getNombre().'</option>';
                                                            } else {
                                                                echo '<option value="'.$carrera->getId().'">'.$carrera->getNombre().'</option>';
                                                            }
                                                        }
                                                    } else {
                                                        foreach ($carreras as $carrera) {
                                                            echo '<option value="'.$carrera->getId().'">'.$carrera->getNombre().'</option>';
                                                    }    
                                                }
                                        }
                                            ?>
                                    </select>
                                    </div>
                                    
                                    <div class="col-sm-6">
                                        <label for="plan">Plan de Estudio</label>
                                        <select id="plan" name="plan" class="selectpicker" data-width="100%" data-live-search="true" required="" title="Seleccione un Plan de Estudio" data-none-results-text="No se encontraron resultados" onchange="location = this.value">
                                    <?php 
                                                    if (!empty($_GET['codCarrera']) && !empty($_GET['codPlan'])){
                                                        include_once '../controlSistema/ManejadorPlan.php';
                                                        $manejadorPlan = new ManejadorPlan();
                                                        $planes = $manejadorPlan->getPlanesSegunCarrera($_GET['codCarrera']);
                                                        if (!empty($planes)){
                                                            foreach ($planes as $plan) {
                                                                if ($_GET['codPlan'] == $plan->getId()){
                                                                    echo '<option value="panelSA.php?codCarrera='.$plan->getIdCarrera().'&codPlan='.$plan->getId().'" selected>'.$plan->getId().'    ('.$plan->getAnio_inicio().' - '.$plan->getAnio_fin().')</option>';
                                                                } else {
                                                                    echo '<option value="panelSA.php?codCarrera='.$plan->getIdCarrera().'&codPlan='.$plan->getId().'">'.$plan->getId().'    ('.$plan->getAnio_inicio().' - '.$plan->getAnio_fin().')</option>';
                                                                }
                                                            }
                                                        }
                                                        
                                                    } 
                                            ?>
                                </select>
                                    </div>
                                
                                </div>

                        <?php imprimirTablaProgramasAsignaturas(); ?>

                        </div>
                    </div>
                </div>

                <!-- Sidebar Column -->
<!--                <div class="col-md-3">
                    <div class="card">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title">Accesos r&aacute;pidos   </h5>
                                <hr>
                                <a href="programas.pendientes.php" class="btn btn-outline-secondary btn-block">Programas pendientes</a>
                                <a href="programa.seguirPdf.php" class="btn btn-outline-secondary btn-block">Seguimiento de Programa</a>
                                <a href="subir.programa.formulario.php" class="btn btn-outline-secondary btn-block">Subir Programa</a>
                                <a href="subir.plan.formulario.php" class="btn btn-outline-secondary btn-block">Subir Plan</a>
                            </div>
                        </div>
                    </div>
                </div>-->
            </div>
        </div>
        <?php include_once '../gui/footer.php'; ?>
    </body>
    
    <script>
            $(document).ready(function(){
            // Si selecciona una carrera se actualiza el select de los planes de estudio
            $('#carrera').change(function (e) {
              var id = $("#carrera").val(); //obtenemos el codigo de la carrera seleccionada
              $.ajax({
                type: 'POST',
                url: '../lib/consultaAjax/cargarPlanes.php',
                data: {'id': id}
              })
              .done(function(planes){
                $(".selectpicker").selectpicker(); 
                $('#plan').html(planes).selectpicker('refresh');
              })
              .fail(function(){
                alert('Hubo un error al cargar los Planes de Estudio');
              });
            });
          });
    </script>
    
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
        
</html>

<?php 

function imprimirTablaProgramasAsignaturas() {
    if (!empty($_GET['codCarrera']) && !empty($_GET['codPlan'])){
    include_once '../modeloSistema/BDConexionSistema.Class.php';
    
    $codPlan = $_GET['codPlan'];
    $consulta = "SELECT asignatura.id AS codAsignatura, asignatura.nombre AS nombreAsignatura, profesor.apellido, profesor.nombre AS nombreProfesor, anioCarrera, anio, vigencia, regimenCursada "
        . "FROM plan_asignatura JOIN asignatura ON "
        . "plan_asignatura.idAsignatura = asignatura.id JOIN profesor ON asignatura.idProfesor = profesor.id "
        . "JOIN programa ON asignatura.id = programa.idAsignatura "
        . "WHERE idPlan = '{$codPlan}'";

    $datos = BDConexionSistema::getInstancia()->query($consulta);
    
    $html = '';
    
    if ($datos->num_rows == 0){
        $html = '<br><div class="alert alert-warning" role="alert">
                    <b>No se encontraron Programas de Asignaturas</b> para el Plan de Estudio: <b>'.$codPlan.'
                </b></div>';
    }
    
    if ($datos->num_rows > 0) {
        
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
                                <th data-field="docenteResponsable" data-filter-control="input" data-filter-control-placeholder="Buscar por Docente" data-sortable="true" data-halign="center" data-align="center">Docente Responsable</th>
                                <th data-field="vigencia" data-halign="center" data-align="center">Vigencia</th>
                            </tr>
                        </thead>
                        <tbody>';
        
        while ($fila = $datos->fetch_assoc()) {

            // Vigencias del programa
            $vigencia = $fila['vigencia'];
            $anio = $fila['anio'];
            $vigencias = '';
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
            switch ($fila['regimenCursada']) {
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
            
            $html .= '<tr>'
                    . '<td>'.$fila['anioCarrera'].'</td>'
                    . '<td>'.$cursada.'</td>'
                    . '<td>'.$fila['codAsignatura'].'</td>'
                    . '<td>'.$fila['nombreAsignatura'].'</td>'
                    . '<td>'.$fila['apellido'].' '. substr($fila['nombreProfesor'], 0, 1).'.</td>'
                    . '<td>'.$vigencias.'</td>'
                    . '</tr>';
        }
        $html .= '</tbody>'
                . '</table>';
    }
    
    echo $html;
    }
    
}
