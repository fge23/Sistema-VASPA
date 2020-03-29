<?php

// Aqui se actualiza el estado de un Programa de asignatura (APROBADO, DESAPROBADO).
// en caso de desaprobado se guarda el comentario realizado por el usuario segun su Rol (SA, Depto)
/*
 * Observaciones: Rol Secretario Academico y Admin comparten la misma funcionalidad
 * Esto quiere decir que si el usuario tiene el rol de Admin va a revisar los programas
 * como si fuese un usuario de SA. (preguntar a los chicos)
 */

include_once '../lib/ControlAcceso.Class.php';
include_once '../modeloSistema/BDConexionSistema.Class.php';

$idPrograma = $_POST["idPrograma"];

if ($_SERVER["REQUEST_METHOD"] !== "POST"){
    header("location: ../vista/revisar.programas.php");
} elseif (isset ($_POST["aprobarPrograma"])) {
    
    // preparamos la sentencia SQL segun el rol del usuario (SA o Dpto)
    
    $Usuario = $_SESSION['usuario'];
    $rol = $Usuario->roles[0]->nombre;
    $query = '';
    if ($rol == PermisosSistema::ROL_ADMIN || $rol == PermisosSistema::ROL_SECRETARIO_ACADEMICO){
        $query = "UPDATE PROGRAMA "
                        . "SET aprobadoSA = 1 "
                        . "WHERE id = '{$idPrograma}'";
    } elseif ($rol == PermisosSistema::ROL_DIRECTOR_DEPARTAMENTO) {
        $query = "UPDATE PROGRAMA "
                        . "SET aprobadoDepto = 1 "
                        . "WHERE id = '{$idPrograma}'";
    }
    
    //procedemos a cambiar el estado del programa a "APROBADO"
    
    $resultado = BDConexionSistema::getInstancia()->query($query);
    
    // chequeamos la ejecucion del update
    if (BDConexionSistema::getInstancia()->affected_rows == 1) {
        // se actualizo
        $_SESSION['mensajeRevisarPrograma'] = '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
            El programa fue Aprobado.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
        header("location: ../vista/revisar.programa.php?id=".$idPrograma);
    } else {
        // no se actualizo
        $_SESSION['mensajeRevisarPrograma'] = '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
            Ocurrio un error al intentar aprobar el programa.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
        header("location: ../vista/revisar.programa.php?id=".$idPrograma);
    }
//        if ($resultado) {
//            //echo '<br> actualizado ';
//            header("location: ../vista/revisar.programa.php?id=".$idPrograma);
//        } else {
//            //echo '<br> no actualizado';
//        }
    
    
} elseif (isset ($_POST["desaprobarPrograma"])){

    $comentario = $_POST["comentario"];
    
    //procedemos a cambiar el estado del programa a "DESAPROBADO" y modificando el comentario
    
    // preparamos la sentencia SQL segun el rol del usuario (SA o Dpto)
    
    $Usuario = $_SESSION['usuario'];
    $rol = $Usuario->roles[0]->nombre;
    $query = '';
    if ($rol == PermisosSistema::ROL_ADMIN || $rol == PermisosSistema::ROL_SECRETARIO_ACADEMICO){
        $query = "UPDATE PROGRAMA "
                        . "SET aprobadoSA = 0, "
                        . "comentarioSa = '{$comentario}' "
                        . "WHERE id = '{$idPrograma}'";
    } elseif ($rol == PermisosSistema::ROL_DIRECTOR_DEPARTAMENTO) {
        $query = "UPDATE PROGRAMA "
                        . "SET aprobadoDepto = 0, "
                        . "comentarioDepto = '{$comentario}' "
                        . "WHERE id = '{$idPrograma}'";
    }
    
    $resultado = BDConexionSistema::getInstancia()->query($query);
//    var_dump($query);
//    exit;
    // chqueamos que se haya realizado correctamente el update
    if (BDConexionSistema::getInstancia()->affected_rows == 1) {
        // se actualizo
        $_SESSION['mensajeRevisarPrograma'] = '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
            El programa fue Desaprobado.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
        header("location: ../vista/revisar.programa.php?id=".$idPrograma.'#comentarios');
    } else {
        // no se actualizo
        $_SESSION['mensajeRevisarPrograma'] = '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
            Ocurrio un error al intentar desaprobar el programa.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
        header("location: ../vista/revisar.programa.php?id=".$idPrograma);
    }
    
    
//        if ($resultado) {
//            //echo '<br> actualizado ';
//            header("location: ../vista/revisar.programa.php?id=".$idPrograma.'#comentarios');
//        } else {
//            //echo '<br> no actualizado';
//        }
    
}

