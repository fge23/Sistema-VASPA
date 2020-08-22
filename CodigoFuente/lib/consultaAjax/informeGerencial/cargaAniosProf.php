<?php
/*
 * En este script se arman los option con los anios correspondientes a los planes de estudio de la carrera seleccionada
 */

include_once '../../../modeloSistema/Carrera.Class.php';
include_once '../../../modeloSistema/Plan.Class.php';
include_once '../../../modeloSistema/BDConexionSistema.Class.php';

//$_POST['idProfesor'] = 14;

if (isset($_POST['idProfesor'])){
    $idProfesor = $_POST["idProfesor"];
    $query = "SELECT idPlan as id, anio_inicio, idCarrera, anio_fin FROM 
                (asignatura a
                INNER JOIN (SELECT idPlan, anio_inicio, anio_fin, idAsignatura, idCarrera FROM 
                plan p INNER JOIN plan_asignatura pa ON p.id = pa.idPlan) ap ON a.id = ap.idAsignatura)
            WHERE a.idProfesor = '{$idProfesor}'";

    $datos = BDConexionSistema::getInstancia()->query($query);

    // validamos el resultado de la query (si retorna false -> Ocurrio un error en la BD) Lanzamos una Excepcion informando el Error
    if (!$datos) {
        throw new Exception("Ocurrio un Error al obtener los a&ntilde;os de los Planes de Estudio");
    }

    $planes = NULL;

    if ($datos->num_rows > 0) {
        for ($x = 0; $x < $datos->num_rows; $x++) {
            //$resultado = $this->datos->fetch_assoc();
            $planes[] = $datos->fetch_object("Plan"); // creamos objeto
        }
    }

//    echo '<pre>';
//    var_dump($planes);
//    exit();
    $aniosOption = '';
    if (!is_null($planes)){
            foreach ($planes as $plan) {
                // verificamos si el anio de fin es nulo para agregar 
                if (is_null($plan->getAnio_fin())){
                    $anioActual = date("Y"); // obtenemos anio actual del server
                    for ($index = $plan->getAnio_inicio(); $index <= $anioActual; $index++) {
                        $anios[] = $index;
                    }
                } else {
                    for ($index = $plan->getAnio_inicio(); $index <= $plan->getAnio_fin(); $index++) {
                        $anios[] = $index;
                    }
                }
                
            }
            
            // odenamos el array con los anios
            arsort($anios);
            $anios = array_unique($anios); // elminamos los anios duplicados
            
            foreach ($anios as $anio) {
                $aniosOption .= '<option value="'.$anio.'">'.$anio.'</option>';
            }
            
    } else {
        $aniosOption .= '<option value="-1">La/s asignatura/s en las cuales es responsable no esta vinculado a planes de estudio</option>';
    }
    

}

echo $aniosOption;
