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
                $print .= '<td class="bg-success text-white text-center">Si</td></tr>';
            } else {
                $print .= '<td class="bg-danger text-white text-center">No</td></tr>';
            }
            
        }
        
        $print .= '</tbody>';
        $print .= '</table>';
        
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


