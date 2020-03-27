<?php

include_once '../../../modeloSistema/BDConexionSistema.Class.php';

// variable donde se almacenara el resultado de la operacion y que se devolvera
$mensaje = '';

// Validamos que esten seteados los campos
if (isset($_POST['codPlan']) && isset($_POST['codAsignatura'])){
    $codPlan = $_POST['codPlan'];
    $codAsignatura = $_POST['codAsignatura'];
    
    // Validamos que no se inserte en caso de que la asignatura ya este vinculada con el Plan
    
    $query = "SELECT * "
            . "FROM plan_asignatura "
            . "WHERE idPlan = '{$codPlan}' AND idAsignatura = '{$codAsignatura}'";
    $resultado = BDConexionSistema::getInstancia()->query($query);
    
    if ($resultado) {
        //echo "Agregado exitosamente";
        //echo $resultado->num_rows;
        
        // Si no se obtienen registros de la BD procedemos a insertar
        if ($resultado->num_rows == 0) {

//            $query = "INSERT INTO plan_asignatura "
//                    . "VALUES ('{$codPlan}', '{$codAsignatura}')";
//            $consulta = BDConexionSistema::getInstancia()->query($query);
//            if ($consulta) {
//                echo "1";
//            } else {
//                echo "2";
//            }
            $query = "INSERT INTO plan_asignatura "
                    . "VALUES ('{$codPlan}', '{$codAsignatura}')";
            $consulta = BDConexionSistema::getInstancia()->query($query);
            // Verificamos que la cantidad de filas afectadas sea igual a 1 (se inserto el registro)
            if (BDConexionSistema::getInstancia()->affected_rows == 1) {
                //echo "Se inserto";
                $mensaje = '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                        Se vincul&oacute; la asignatura con cod. <strong>'.$codAsignatura.'</strong> al Plan de Estudio.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>';
            } else {
                //echo "No se inserto";
                $mensaje = '<div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
                        Ocurrio un error al vincular la asignatura con cod. <strong>'.$codAsignatura.'</strong> al Plan de Estudio.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>';
            }
            
        } else {
            //echo "ya se encuentra";
            $mensaje = '<div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
                        La asignatura con cod. <strong>'.$codAsignatura.' ya se encuentra vinculada</strong> al Plan de Estudio.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>';
        }
    } else {
        //echo "Ocurrio un error al consultar";
        $mensaje = '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                        Ocurrio un error al vincular la asignatura con cod. <strong>'.$codAsignatura.'</strong> al Plan de Estudio.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>';
    }
  
}

// imprimimos mensaje
echo $mensaje;

//echo $codAsignatura.' - '.$codPlan;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

