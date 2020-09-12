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
    
    $manejadorPDF = new ManejadorProgramaPDF($codCarrera, $anio);
    
    $programas = $manejadorPDF->getColeccion();
    $cantProgDisponible;
    $cantProgNoDisponible;
    if (is_null($plan)){
                $print = '<div class="alert alert-warning" role="alert">
                    No se encontr&oacute; el Plan de Estudio de la Carrera.
                  </div>';
                $cantProgDisponible = -1;
                $cantProgNoDisponible = -1;
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
            // no hay programas PDF escaneados subidos al sistema para la carrera segun el anio
            $cantProgDisponible = 0;
            
            foreach ($asignaturas as $asignatura) {
                $prof = new Profesor($asignatura->getIdProfesor());
                $print .= '<tr ><td>'.$asignatura->getId().'</td>';
                $print .= '<td>'.$asignatura->getNombre().'</td>';
                $print .= '<td>'.$prof->getNombreCompleto().'</td>';
                $print .= '<td class="text-danger text-center">No <span class="oi oi-x"></span></td></tr>';
                $cantProgNoDisponible++;
            }
        } else {
            foreach ($asignaturas as $asignatura) {
                $prof = new Profesor($asignatura->getIdProfesor());
                if ($manejadorPDF->tieneProgramaPDF($asignatura->getId()) != ""){
                    $print .= '<tr><td>'.$asignatura->getId().'</td>';
                    $print .= '<td>'.$asignatura->getNombre().'</td>';
                    $print .= '<td>'.$prof->getNombreCompleto().'</td>';
                    $print .= '<td class="text-success text-center">Si <span class="oi oi-check"></span></td></tr>';
                    $cantProgDisponible++;
                } else {
                    $print .= '<tr><td>'.$asignatura->getId().'</td>';
                    $print .= '<td>'.$asignatura->getNombre().'</td>';
                    $print .= '<td>'.$prof->getNombreCompleto().'</td>';
                    $print .= '<td class="text-danger text-center">No <span class="oi oi-x"></span></td></tr>';
                    $cantProgNoDisponible++;
                }
            }
            
        }
        $print .= '</tbody>';
        $print .= '</table>';
        
        $print = '<div class="row justify-content-md-center">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal1">
                                    Ver Gr&aacute;fico
                                </button>
                            </div>
                            <br>'.$print;
    }
    
    
    //var_dump($programas);
    
    
} else {
            $print = '<div class="alert alert-warning" role="alert">
                    Faltan datos.
                  </div>';
}
echo $print;
?>
<script type="text/javascript">
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {

    var data = google.visualization.arrayToDataTable([
      ['Language', 'Rating'],
      <?php
      echo "['Programas Disponibles', ".$cantProgDisponible."],";
      echo "['Programas No disponibles', ".$cantProgNoDisponible."],";
      ?>
    ]);
    
    var options = {
        //title: 'Disponibilidad de los Programas de <?php //echo $carrera->getNombre(). " - ".$anio; ?>',
        width: '100%',
        height: '100%',
        //colors: ['#28a745', '#dc3545'],
        colors: ['#6BD382', '#FF5E6C']
        //is3D: true
    };
    
    var chart = new google.visualization.PieChart(document.getElementById('piechart'));
    
    chart.draw(data, options);
    
//    function resizeHandler () {
//        chart.draw(data, options);
//    }
//    if (window.addEventListener) {
//        window.addEventListener('resize', resizeHandler, false);
//    }
//    else if (window.attachEvent) {
//        window.attachEvent('onresize', resizeHandler);
//    }
    
}
</script>
