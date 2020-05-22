<?php

include_once '../../../modeloSistema/BDConexionSistema.Class.php';
// Validamos que esten seteados los campos
if(isset($_POST['idAsignatura']) && isset($_POST['codAsignatura']) && isset($_POST['requisito']) && isset($_POST['tipoCorrelatividad'])){
    
    //Es el codigo de la asignatura actual
    $idAsignatura = $_POST['idAsignatura'];

    //Es el codigo de la asignatura a eliminar
    $codAsignatura = $_POST['codAsignatura'];

    //Aprobada o Regular
    $requisito = $_POST['requisito'];

    //Precedente o subsiguiente
    $tipoCorrelatividad = $_POST['tipoCorrelatividad'];
    
    
if($tipoCorrelatividad == 'Precedente'){

   $query = "DELETE FROM correlativa_de WHERE  requisito = '{$requisito}' AND idAsignatura = '{$idAsignatura}' AND idAsignatura_Correlativa_Anterior = '{$codAsignatura}'";
    $consulta = BDConexionSistema::getInstancia()->query($query);
   	if ($consulta) {

            $alert1 =  '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Asignatura correlativa precedente eliminada exitosamente.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>';

            echo $alert1;
    } else {
        echo "Ocurrio un error al eliminar";
    }
 }else{
	
    $query = "DELETE FROM correlativa_de WHERE  requisito = '{$requisito}' AND idAsignatura = '{$codAsignatura}' AND idAsignatura_Correlativa_Anterior = '{$idAsignatura}'";
    $consulta = BDConexionSistema::getInstancia()->query($query);
    if ($consulta) {
            
            $alert2 =  '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Asignatura correlativa subsiguiente eliminada exitosamente.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>';

            echo $alert2;
       
    } else {
        echo "Ocurrio un error al eliminar";
    }

}

}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
