<?php

include_once '../../../modeloSistema/BDConexionSistema.Class.php';

// variable donde se almacenara el resultado de la operacion y que se devolvera
$mensaje = '';

// Validamos que esten seteados los campos
if (isset($_POST['codPlan']) && isset($_POST['codAsignatura'])){
    $codPlan = $_POST['codPlan'];
    $codAsignatura = $_POST['codAsignatura'];
    
    // Procedemos a eliminar en la BD
    
    $query = "DELETE FROM plan_asignatura WHERE idPlan = '{$codPlan}' AND idAsignatura = '{$codAsignatura}'";
    $consulta = BDConexionSistema::getInstancia()->query($query);
    if (BDConexionSistema::getInstancia()->affected_rows == 1) {
        //echo "Eliminado exitosamente";
        $mensaje = '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                        Se desvincul&oacute; la asignatura con cod. <strong>'.$codAsignatura.'</strong> del Plan de Estudio.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>';
    } else {
        //echo "Ocurrio un error al eliminar";
        $mensaje = '<div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
                        Ocurrio un error al desvincular la asignatura con cod. <strong>'.$codAsignatura.'</strong> del Plan de Estudio.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>';
    }
}

echo $mensaje;

//echo $codAsignatura.' - '.$codPlan;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

