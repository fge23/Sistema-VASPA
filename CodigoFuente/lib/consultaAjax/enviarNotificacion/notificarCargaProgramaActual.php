<?php

include_once __DIR__.'/../../notificacionesMail/notificaciones.php';
//include_once __DIR__.'/notificacionesMail/notificaciones.php';
/*
 * Se lleva cabo el envio del mail (Notificacion) al profesor responsable de la
 * asignatura, solicitando en el mismo la carga del programa del anio actual.
 */

//$_GET['id'] = 1655;

if (isset($_POST['idAsignatura'])){
    $idAsignatura = $_POST['idAsignatura'];
    echo enviarMailSolicitarCargaPrograma($idAsignatura);
} else {
    echo '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
        Ocurrio un error al intentar enviar el correo (Faltan datos).
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
}

