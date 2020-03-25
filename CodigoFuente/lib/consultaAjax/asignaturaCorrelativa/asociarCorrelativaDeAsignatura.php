<?php
include_once '../../../modeloSistema/BDConexionSistema.Class.php';

// Validamos que esten seteados los campos

if (isset($_POST['idAsignatura']) && isset($_POST['idAsignaturaCorrelativa']) && isset($_POST['requisito']) && isset($_POST['tipo']) ){

    $idAsignatura = $_POST['idAsignatura'];
    $idAsignaturaCorrelativa = $_POST['idAsignaturaCorrelativa'];
    $requisito = $_POST['requisito'];
    $tipo = $_POST['tipo'];


    //Valida que no se agregue una asignatura como correlativa de si misma.
    if($idAsignatura != $idAsignaturaCorrelativa){

        //Busca si ya existe en la BD la asignatura que quiero agregar como correlativa precedente a la asignatura actual
        $resultado1 = BDConexionSistema::getInstancia()->query("SELECT 1 FROM correlativa_de WHERE idAsignatura = {$idAsignatura} AND idAsignatura_Correlativa_Anterior = {$idAsignaturaCorrelativa} LIMIT 1");

        //Busca si ya existe en la BD la asignatura que quiero agregar como correlativa subsiguiente a la asignatura actual
        $resultado2 = BDConexionSistema::getInstancia()->query("SELECT 1 FROM correlativa_de WHERE idAsignatura = {$idAsignaturaCorrelativa} AND idAsignatura_Correlativa_Anterior = {$idAsignatura} LIMIT 1");

        //si ambos resultados son distintos a 1 (son iguales a 0) quiere decir que no encontro nada en la BD.
        //Es decir, que no existe ningun registro, entonces se procede a asociar la correlativa.
        if ($resultado1->num_rows != 1 && $resultado2->num_rows != 1) {
            
                //El registro no existe en la BD. Se puede insertar
        
                if($tipo == 'Precedente'){
                    
                    $query = "INSERT INTO correlativa_de VALUES ('','{$requisito}','{$idAsignatura}', '{$idAsignaturaCorrelativa}')";
                    $consulta = BDConexionSistema::getInstancia()->query($query);
                    if ($consulta) {
        
                        $alert1 =  '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Asignatura correlativa agregada exitosamente.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>';

                        echo $alert1;
        
                    }
                
                }else{
                        $query = "INSERT INTO correlativa_de VALUES ('','{$requisito}','{$idAsignaturaCorrelativa}', '{$idAsignatura}')";
                        $consulta = BDConexionSistema::getInstancia()->query($query);
                        if ($consulta) {
       
                            $alert2 =  '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                       Asignatura correlativa agregada exitosamente.
                                       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                       <span aria-hidden="true">&times;</span>
                                       </button>
                                       </div>';

                            echo $alert2;
        
                        }
                    }
            }else{

                            $alert3 =  '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                       <strong>Error:</strong> Estimado usuario, la asignatura correlativa que desea agregar ya se encuentra asociada a esta asignatura.
                                       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                       <span aria-hidden="true">&times;</span>
                                       </button>
                                       </div>';

                            echo $alert3;
 
                        } 


    }else {
        
   
                $alert4 =  '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error:</strong> Estimado usuario, la asignatura correlativa que desea agregar debe ser diferente a la asignatura actual en la que se encuentra.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                            </div>';

                echo $alert4;

        }
}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */