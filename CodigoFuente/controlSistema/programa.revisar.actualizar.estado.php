<?php

// Aqui se actualiza el estado de un Programa de asignatura (APROBADO, DESAPROBADO).
// en caso de desaprobado se guarda el comentario realizado por el usuario segun su Rol (SA, Depto)
/*
 * Observaciones: Rol Secretario Academico y Admin comparten la misma funcionalidad
 * Esto quiere decir que si el usuario tiene el rol de Admin va a revisar los programas
 * como si fuese un usuario de SA. (preguntar a los chicos)
 */
// 17/05/20 --> Se agrega funcionalidad que Envia Notificacion al Profesor infomando el resultado de la revision
// 30/06/20 --> Se agrega mas info al mensaje que se devuelve cuando se aprueba/desaprueba un programa (como el nombre de la asignatura, codigo y vigencia del programa)

include_once '../lib/ControlAcceso.Class.php';
include_once '../modeloSistema/BDConexionSistema.Class.php';
include_once '../modeloSistema/Programa.Class.php';
include_once '../modeloSistema/Asignatura.Class.php';

$idPrograma = $_POST["idPrograma"];

//creacion de objetos programa y asignatura
$programa = new Programa($idPrograma);
$asignatura = new Asignatura($programa->getIdAsignatura());
$vigencia = "";
switch ($programa->getVigencia()) {
    case "1":
        $vigencia = "el a&ntilde;o: [".$programa->getAnio()."]";
        break;
    case "2":
        $vigencia = "los a&ntilde;os: [".$programa->getAnio()." - ".($programa->getAnio()+1)."]";
        break;
    case "3":
        $vigencia = "los a&ntilde;os: [".$programa->getAnio()." - ".($programa->getAnio()+1)." - ".($programa->getAnio()+2)."]";
        break;

}
$datosAsig = "<b>{$asignatura->getNombre()} - {$asignatura->getId()}</b>, con vigencia para <b>{$vigencia}</b>";

if ($_SERVER["REQUEST_METHOD"] !== "POST"){
    header("location: ../vista/revisar.programas.php");
} elseif (isset ($_POST["aprobarPrograma"])) {
    
    // preparamos la sentencia SQL segun el rol del usuario (SA o Dpto)
    
    $Usuario = $_SESSION['usuario'];
    $rol = $Usuario->roles[0]->nombre;
    $query = '';
    if ($rol == PermisosSistema::ROL_ADMIN || $rol == PermisosSistema::ROL_SECRETARIO_ACADEMICO){
        // comprobamos si fue desaprobado por Dpto para setear a 1 el campo  fueDesaprobado
        if ($programa->getAprobadoDepto() === '0'){
            $desa = ", fueDesaprobado = 1 ";
        }else {
            $desa = "";
        }
        $query = "UPDATE PROGRAMA "
                        . "SET aprobadoSA = 1 "
                        . $desa 
                        . "WHERE id = '{$idPrograma}'";
    } elseif ($rol == PermisosSistema::ROL_DIRECTOR_DEPARTAMENTO) {
        // comprobamos si fue desaprobado por SA para setear a 1 el campo  fueDesaprobado
        if ($programa->getAprobadoSa() === '0'){
            $desa = ", fueDesaprobado = 1 ";
        }else {
            $desa = "";
        }
        $query = "UPDATE PROGRAMA "
                        . "SET aprobadoDepto = 1 "
                        . $desa 
                        . "WHERE id = '{$idPrograma}'";
    }
    
    //procedemos a cambiar el estado del programa a "APROBADO"
    
    $resultado = BDConexionSistema::getInstancia()->query($query);
    
    // chequeamos la ejecucion del update
    if (BDConexionSistema::getInstancia()->affected_rows == 1) {
        // se actualizo
        $_SESSION['mensajeRevisarPrograma'] = '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
            El programa de '.$datosAsig.' <b>fue Aprobado</b>.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
        
        // Chequeamos si fue revisado por ambas autoridades para enviar el email
        $revisado = fueRevisadoPorSAyDpto($idPrograma);
        if ($revisado){
            include_once '../lib/notificacionesMail/notificacionProgramaAprobadoDesaprobado.php';
            enviarNotificacionProfesor($idPrograma); // enviamos el mail
        }
        
        header("location: ../vista/revisar.programas.php");
    } else {
        // no se actualizo
        $_SESSION['mensajeRevisarPrograma'] = '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
            Ocurrio un error al intentar aprobar el programa de '.$datosAsig.'.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
        header("location: ../vista/revisar.programas.php");
    }   
    
} elseif (isset ($_POST["desaprobarPrograma"])){

    $comentario = $_POST["comentario"];
    
    //procedemos a cambiar el estado del programa a "DESAPROBADO" y modificando el comentario
    // Con que uno lo haya desaprobado al programa, este pasa al estado "Desaprobado" por lo cual tambien se modifica el campo "fueDesaprobado"
    
    // preparamos la sentencia SQL segun el rol del usuario (SA o Dpto)
    
    $Usuario = $_SESSION['usuario'];
    $rol = $Usuario->roles[0]->nombre;
    $query = '';
    if ($rol == PermisosSistema::ROL_ADMIN || $rol == PermisosSistema::ROL_SECRETARIO_ACADEMICO){
        // comprobamos si depto todavia no califico el programa, en ese caso el campo fueDesaprobado se setea a 0 ya que sino se muestra el mensaje que el programa ya fue desaprobado con anterioridad
        if (is_null($programa->getAprobadoDepto())){
            $desa = 0;
        } else {
            $desa = 1;
        }
        $query = "UPDATE PROGRAMA "
                        . "SET aprobadoSA = 0, "
                        . "fueDesaprobado = {$desa}, "
                        . "comentarioSa = '{$comentario}' "
                        . "WHERE id = '{$idPrograma}'";
    } elseif ($rol == PermisosSistema::ROL_DIRECTOR_DEPARTAMENTO) {
        // comprobamos si depto todavia no califico el programa, en ese caso el campo fueDesaprobado se setea a 0 ya que sino se muestra el mensaje que el programa ya fue desaprobado con anterioridad
        if (is_null($programa->getAprobadoSa())){
            $desa = 0;
        } else {
            $desa = 1;
        }
        $query = "UPDATE PROGRAMA "
                        . "SET aprobadoDepto = 0, "
                        . "fueDesaprobado = {$desa}, "
                        . "comentarioDepto = '{$comentario}' "
                        . "WHERE id = '{$idPrograma}'";
    }
    
    $resultado = BDConexionSistema::getInstancia()->query($query);

    // chqueamos que se haya realizado correctamente el update
    if (BDConexionSistema::getInstancia()->affected_rows == 1) {
        // se actualizo
        $_SESSION['mensajeRevisarPrograma'] = '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
            El programa de '.$datosAsig.' <b>fue Desaprobado</b>.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
        
        // Chequeamos si fue revisado por ambas autoridades para enviar el email notificando al profesor el resultado de la evaluacion del programa
        $revisado = fueRevisadoPorSAyDpto($idPrograma);
        if ($revisado){
            include_once '../lib/notificacionesMail/notificacionProgramaAprobadoDesaprobado.php';
            enviarNotificacionProfesor($idPrograma); // enviamos el mail
        }
        
        header("location: ../vista/revisar.programas.php");
    } else {
        // no se actualizo
        $_SESSION['mensajeRevisarPrograma'] = '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
            Ocurrio un error al intentar desaprobar el programa de '.$datosAsig.'.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
        header("location: ../vista/revisar.programas.php");
    }
        
}

// metodo que comprueba si el programa ya fue revisado por ambas autoridades tanto SA o como Dpto
function fueRevisadoPorSAyDpto($idPrograma){
    $programa = new Programa($idPrograma);
    // comprobamos que los campos aprobados tanto en SA como en Dpto no sean nulos
    if (!is_null($programa->getAprobadoSa()) && !is_null($programa->getAprobadoDepto())){
        return TRUE;
    } else {
        return FALSE;
    }
}

