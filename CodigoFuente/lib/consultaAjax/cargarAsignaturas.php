<?php

include_once '../../modeloSistema/BDConexionSistema.Class.php';

function getAsignaturas() {
    //Evitamos inyeccion SQL
    //$codPlan = BDConexionSistema::getInstancia()->real_escape_string($_POST['id']);
    
    $codCarrera = BDConexionSistema::getInstancia()->real_escape_string($_POST['id']);
    $anio = BDConexionSistema::getInstancia()->real_escape_string($_POST['anio']);
    
    //$codCarrera = "016";
    //$anio = 2012;
    
    //$consulta = "SELECT nombre, id FROM PLAN_ASIGNATURA JOIN ASIGNATURA 
    //WHERE PLAN_ASIGNATURA.codAsignatura = id AND codPlan LIKE '$codPlan'";
    
    $consulta = "SELECT asignatura.nombre, asignatura.id FROM carrera JOIN plan JOIN plan_asignatura JOIN asignatura".
            " WHERE carrera.id = idCarrera AND plan.id = plan_asignatura.idPlan "
            ."AND asignatura.id = idAsignatura AND carrera.id LIKE '$codCarrera' AND anio_inicio <= $anio"
            ." AND (anio_fin >= $anio OR anio_fin is NULL)";
    
    $result = BDConexionSistema::getInstancia()->query($consulta);
    //$listas = '<option value="0">Seleccione una Asignatura</option>';
    $listas = '';

    if ($result->num_rows > 0) {
        while ($fila = $result->fetch_assoc()) {
            $listas .= '<option value="'.$fila['id'].'">'.$fila['id'].' - '.utf8_encode($fila['nombre']).'</option>';
        }
    }
    return $listas;
}

echo getAsignaturas();
