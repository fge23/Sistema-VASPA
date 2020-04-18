<?php

include_once 'notificaciones.php';
include_once '../../modeloSistema/Asignatura.Class.php';
include_once '../../modeloSistema/BDConexionSistema.Class.php';
include_once '../../modeloSistema/Profesor.Class.php';

/*
 * Se lleva cabo el envio del mail (Notificacion) al profesor responsable de la
 * asignatura, solicitando en el mismo la carga del programa del anio actual.
 */

//$_GET['id'] = 1655;
//$_POST['idAsignatura'] = 1655;
if (isset($_POST['idAsignatura'])){
    $idAsignatura = $_POST['idAsignatura'];
    
    $asignatura = new Asignatura($idAsignatura);
    $profesor = new Profesor($asignatura->getIdProfesor());
    $resultadoOperacion = '';
    
    $mensajeError = '<hr><div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                    <b>Ha ocurrido un error</b> al enviar el correo al Profesor: <b>'.$profesor->getApellido().'</b> solicitando el Programa de: <b>'.$asignatura->getNombre().'</b>.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
    
    setlocale(LC_ALL,"es_ES");
    //Establece la zona horaria predeterminada usada por todas las funciones de fecha/hora en un script
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    $fecha = date("Y-m-d"); // obtenemos la fecha actual
        
    // Iniciamos una transaccion, ya que si se pudo enviar la notificacion que inserte si no, que no inserte el registro
    
    /* Iniciar una transacción, desactivando 'autocommit' 
     * begin_transaction() --> devuelve true en caso de exito
     */ 
    
    if (BDConexionSistema::getInstancia()->begin_transaction()){ 
    
        // armamos la sentencia para insertar una nueva notificacion 
        $sql = "INSERT INTO `registro_notificacion`"
                . "(`fecha`, `observaciones`, `idProfesor`, `idAsignatura`) VALUES "
                . "('{$fecha}',NULL,'{$asignatura->getIdProfesor()}','{$asignatura->getId()}')";

        $result = BDConexionSistema::getInstancia()->query($sql);

        // Verificamos si se ejecutara correctamente la insercion en la BD
        if ($result){
            // Verificamos que haya afectado una sola fila (se inserto un elemento)
            if (BDConexionSistema::getInstancia()->affected_rows == 1) {
                // Procedemos a Enviar el correo al Profesor responsable de la asignatura
                if (enviarMailSolicitarCargaPrograma($idAsignatura) == 1){
                    $resultadoOperacion = '<hr><div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                        <b>Se envi&oacute; el correo</b> al Profesor: <b>'.$profesor->getApellido().'</b> solicitando el Programa de: <b>'.$asignatura->getNombre().'</b>.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>';
                    // insertamos en la BD
                    BDConexionSistema::getInstancia()->commit();
                    /* La conexión a la base de datos ahora a vuelto al modo 'autocommit' */
                } else {
                    // ocurrio un error al enviar el correo, hacemos rollback para que no se inserte el registro
                    BDConexionSistema::getInstancia()->rollback();
                    /* Ahora la conexión a la base de datos a vuelto al modo 'autocommit' */
                    $resultadoOperacion = $mensajeError;
                }
            } else {
                // No se inserto, no se vieron afectadas fila
                $resultadoOperacion = $mensajeError;
                BDConexionSistema::getInstancia()->rollback();
            }
        } else {
            // Ocurrio un error en al intentar insertar el registro
            $resultadoOperacion = $mensajeError;
            BDConexionSistema::getInstancia()->rollback();
        }
    } else {
        // error al iniciar transaccion
        $resultadoOperacion = $mensajeError;
    }
    
    echo $resultadoOperacion;
    
    //echo enviarMailSolicitarCargaPrograma($idAsignatura);
} else {
    echo '<hr><div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
        Ocurrio un error al intentar enviar el correo (Faltan datos).
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
}

