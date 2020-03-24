<?php
include_once '../../../modeloSistema/BDConexionSistema.Class.php';
// Validamos que esten seteados los campos

if (isset($_POST['idAsignatura']) && isset($_POST['idAsignaturaCorrelativa']) && isset($_POST['requisito']) && isset($_POST['tipo']) ){
    $idAsignatura = $_POST['idAsignatura'];
    $idAsignaturaCorrelativa = $_POST['idAsignaturaCorrelativa'];
    $requisito = $_POST['requisito'];
    $tipo = $_POST['tipo'];
    // Procedemos a insertar en la BD
    
    if($tipo == 'Precedente'){
    $query = "INSERT INTO correlativa_de VALUES ('','{$requisito}','{$idAsignatura}', '{$idAsignaturaCorrelativa}')";
    $consulta = BDConexionSistema::getInstancia()->query($query);
    if ($consulta) {
        echo "Agregado exitosamente";
    } else {
        echo "Ocurrio un error al agregar";
    }
}else{
$query = "INSERT INTO correlativa_de VALUES ('','{$requisito}','{$idAsignaturaCorrelativa}', '{$idAsignatura}')";
    $consulta = BDConexionSistema::getInstancia()->query($query);
    if ($consulta) {
        echo "Agregado exitosamente";
    } else {
        echo "Ocurrio un error al agregar";
    }

}

}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

