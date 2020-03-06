<?php

include_once '../../../modeloSistema/BDConexionSistema.Class.php';
// Validamos que esten seteados los campos
if (isset($_POST['codPlan']) && isset($_POST['codAsignatura'])){
    $codPlan = $_POST['codPlan'];
    $codAsignatura = $_POST['codAsignatura'];
    
    // Procedemos a insertar en la BD
    
    $query = "DELETE FROM plan_asignatura WHERE idPlan = '{$codPlan}' AND idAsignatura = '{$codAsignatura}'";
    $consulta = BDConexionSistema::getInstancia()->query($query);
    if ($consulta) {
        echo "Eliminado exitosamente";
    } else {
        echo "Ocurrio un error al eliminar";
    }
}

//echo $codAsignatura.' - '.$codPlan;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

