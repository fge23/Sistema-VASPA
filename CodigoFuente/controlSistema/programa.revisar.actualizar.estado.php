<?php

// Aqui se actualiza el estado de un Programa de asignatura (APROBADO, DESAPROBADO).
// en caso de desaprobado se guarda el comenario realizado por el usuario

include_once '../modeloSistema/BDConexionSistema.Class.php';

$idPrograma = $_POST["idPrograma"];

if ($_SERVER["REQUEST_METHOD"] !== "POST"){
    header("location: ../vista/revisar.programas.php");
} elseif (isset ($_POST["aprobarPrograma"])) {
    //echo 'aprobar';
    
    //procedemos a cambiar el estado del programa a "APROBADO"
    
    $query = "UPDATE PROGRAMA "
                        . "SET aprobadoSA = 1, "
                        . "aprobadoDepto = 1 "
                        . "WHERE id = '{$idPrograma}'";
    $resultado = BDConexionSistema::getInstancia()->query($query);
    
        if ($resultado) {
            //echo '<br> actualizado ';
            header("location: ../vista/revisar.programa.php?id=".$idPrograma);
        } else {
            //echo '<br> no actualizado';
        }
    
    
} elseif (isset ($_POST["desaprobarPrograma"])){
    //echo 'desaprobar';
    $comentario = $_POST["comentario"];
    
    //procedemos a cambiar el estado del programa a "DESAPROBADO" y modificando el comentario
    
    $query = "UPDATE PROGRAMA "
                        . "SET aprobadoSA = 0, "
                        . "aprobadoDepto = 0, "
                        . "comentarioSa = '{$comentario}', "
                        . "comentarioDepto = '{$comentario}' "
                        . "WHERE id = '{$idPrograma}'";
    $resultado = BDConexionSistema::getInstancia()->query($query);
    
        if ($resultado) {
            //echo '<br> actualizado ';
            header("location: ../vista/revisar.programa.php?id=".$idPrograma.'#comentarios');
        } else {
            //echo '<br> no actualizado';
        }
    
}

