<?php
include_once '../../../modeloSistema/BDConexionSistema.Class.php';

//$_POST['idProfesor'] = 5;
//$_POST['anio'] = 2020;
$print = "";
if (isset($_POST['idProfesor']) && isset($_POST['anio'])){
    $idProfesor = $_POST['idProfesor'];
    $anio = $_POST['anio'];
    
    // query para obtener todas las asignaturas del profesor segun el año teniendo en cuenta los años de los
    // planes de estudio en donde se dicta la asignatura.
    $sql = "SELECT idPlan, anio_inicio, anio_fin, idAsignatura, idCarrera, a.nombre FROM 
    ((profesor p INNER JOIN asignatura a ON p.id = a.idProfesor) 
    INNER JOIN (SELECT idPlan, anio_inicio, anio_fin, idAsignatura, idCarrera FROM 
    plan p INNER JOIN plan_asignatura pa ON p.id = pa.idPlan) ap ON a.id = ap.idAsignatura)
    WHERE p.id = '{$idProfesor}' AND ((anio_inicio <= '{$anio}' AND anio_fin >= '{$anio}') OR (anio_inicio <= '{$anio}' AND anio_fin IS NULL))";
    
    $datos = BDConexionSistema::getInstancia()->query($sql);
    
    //echo '<pre>';
    //var_dump($datos);
    $cantProgDisponible = 0; // variable contador para saber la cantidad de programas disponibles.
    $cantProgNoDisponible = 0;
    if ($datos->num_rows > 0){
        $print .= '<table class="table table-hover table-sm" id="tablaAsignaturasProf">
                        <thead>
                            <tr class="table-info">
                                <th>C&oacute;digo Plan</th>
                                <th>C&oacute;digo Asignatura</th>
                                <th>Asignatura</th>
                                <th>Programa PDF disponible</th>
                            </tr>
                        </thead>
                        <tbody>';
        for ($x = 0; $x < $datos->num_rows; $x++) {
        
            $registro = $datos->fetch_assoc();
            $codAsignatura = $registro["idAsignatura"];
            $codCarrera = $registro["idCarrera"];
            
            $query = "SELECT * "
                    . "FROM PROGRAMA_PDF WHERE "
                    . "anio = '{$anio}' AND nombre LIKE 'prg_".$codAsignatura."_".$codCarrera."%'";
            $programa = BDConexionSistema::getInstancia()->query($query);
                    
            $print .= '<tr><td>'.$registro["idPlan"].'</td>';
            $print .= '<td>'.$registro["idAsignatura"].'</td>';
            $print .= '<td>'.$registro["nombre"].'</td>';
            
            if ($programa->num_rows > 0){
                //$print .= '<td class="bg-success text-white text-center">Si</td></tr>';
                $print .= '<td class="text-success text-center">Si <span class="oi oi-check"></span></td></tr>';
                $cantProgDisponible++;
            } else {
                //$print .= '<td class="bg-danger text-white text-center">No</td></tr>';
                $print .= '<td class="text-danger text-center">No <span class="oi oi-x"></span></td></tr>';
                $cantProgNoDisponible++;
            }
            
        }
        
        $print .= '</tbody>';
        $print .= '</table>';
        
        // agregamos boton para permitir ver el grafico estadistico en un modal
        $print = '<div class="row justify-content-md-center">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal2">
                                    Ver Gr&aacute;fico
                                </button>
                            </div>
                            <br>'.$print;
        
    } else {
        $print = '<div class="alert alert-warning" role="alert">
                    La/s asignatura/s del profesor no se encuentran vinculadas a planes.
                  </div>';
    }
    

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
    
    var chart = new google.visualization.PieChart(document.getElementById('piechart2'));
    
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



