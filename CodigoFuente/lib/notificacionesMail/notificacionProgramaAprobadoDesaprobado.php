<?php

/* En este script se llevara a cabo el procesamiento del envio de mail (Notificacion) al profesor
 * responsable de asignatura, notificandole el resultado de la revision de las autoridades
 * (SA y Dpto) que puede ser Aprobado o Desaprobado, en el caso de que este desaprobado, se le indicara
 * en el mismo correo las observaciones realizadas por las autoridades.
 */

require '../lib/PHPMailer/PHPMailerAutoload.php';
require '../lib/notificacionesMail/constantesMail.php';

include_once '../modeloSistema/Asignatura.Class.php';
include_once '../modeloSistema/Profesor.Class.php';
include_once '../modeloSistema/Programa.Class.php';


function sendemail($mail_username, $mail_userpassword, $mail_addAddress, $mail_subject, $mensaje){
	$mail = new PHPMailer;
	$mail->isSMTP();                            // Establecer el correo electrónico para utilizar SMTP
	$mail->Host = 'smtp.gmail.com';             // Especificar el servidor de correo a utilizar 
	$mail->SMTPAuth = true;                     // Habilitar la autenticacion con SMTP
	$mail->Username = $mail_username;          // Correo electronico saliente ejemplo: tucorreo@gmail.com
	$mail->Password = $mail_userpassword; 		// Tu contraseña de gmail
	$mail->SMTPSecure = 'tls';                  // Habilitar encriptacion, `ssl` es aceptada
	$mail->Port = 587;                          // Puerto TCP  para conectarse 
	//$mail->setFrom($mail_setFromEmail, $mail_setFromName);//Introduzca la dirección de la que debe aparecer el correo electrónico. Puede utilizar cualquier dirección que el servidor SMTP acepte como válida. El segundo parámetro opcional para esta función es el nombre que se mostrará como el remitente en lugar de la dirección de correo electrónico en sí.
        $mail->FromName = "Sistema VASPA";
	//$mail->addReplyTo($mail_setFromEmail, $mail_setFromName);//Introduzca la dirección de la que debe responder. El segundo parámetro opcional para esta función es el nombre que se mostrará para responder
	$mail->addAddress($mail_addAddress);   // Agregar quien recibe el e-mail enviado
	$message = utf8_decode($mensaje);
	$mail->isHTML(true);  // Establecer el formato de correo electrónico en HTML
	
	$mail->Subject = $mail_subject;
        $mail->Subject = utf8_decode($mail->Subject); 
                
	$mail->msgHTML($message);
	if(!$mail->send()) {
            //echo '<div class="alert alert-danger" role="alert">Ha ocurrido un error al enviar el correo.<b>('.$mail->ErrorInfo.')</b></div>';
	} 
        else {
            //echo '<div class="alert alert-success" role="alert">Correo enviado con &eacute;xito.</div>';
	}
}



// funcion que prepara los datos necesarios para notificar al usuario de Secretaria 
// Academica de la creacion de un nuevo programa de asignatura para que despues lo revise
function enviarNotificacionProfesor($idPrograma) {
    $programa = new Programa($idPrograma);
    $asignatura = new Asignatura($programa->getIdAsignatura());
    $profesor = new Profesor($asignatura->getIdProfesor());
    $nombreAsignatura = $asignatura->getNombre();

    /* Configuracion de variables para enviar el correo 
      usar correo gmail */

    $mail_username = MAIL_SISTEMA; //Correo electronico saliente ejemplo: tucorreo@gmail.com
    $mail_userpassword = CONTRASENA_SISTEMA; //Tu contraseña de gmail
    $mail_addAddress = $profesor->getEmail(); //correo electronico que recibira el mensaje
    
    // chequeamos el estado del programa (aprobado/desaprobado)
    $aprobado = '';
    $observaciones = '';
    if ($programa->getAprobadoSa() && $programa->getAprobadoDepto()){
        $aprobado = 'aprobado';
        $observaciones = '<br><p>Puede descargar el programa de dicha asignatura, ingresando '
                . 'al <a href="'.Constantes::HOMEURL.'">Sistema VASPA</a>, o bien puede solicitarlo en Secretar&iacute;a '
                . 'Acad&eacute;mica.</p>';
    } else {
        $aprobado = 'desaprobado';
        $observaciones = '<br><p>A continuaci&oacute;n las observaciones realizadas por la cual el programa no fue aprobado:</p>';
        if (!$programa->getAprobadoDepto()){
            $observaciones .= '<br><p><u>Observaciones del Director del Departamento:</u></p>'
                    . '<p>'.$programa->getComentarioDepto().'</p>';
        }
        if (!$programa->getAprobadoSa()){
            $observaciones .= '<br><p><u>Observaciones de Secretar&iacute;a Acad&eacute;mica:</u></p>'
                    . '<p>'.$programa->getComentarioSa().'</p>';
        }
        $observaciones .= '<br><p>De acuerdo a las observaciones marcadas, tenga a bien modificar y corregir el '
                . 'programa de la asignatura, puede hacerlo ingresando al <a href="'.Constantes::HOMEURL.'">Sistema VASPA</a>.</p>';
    }
    
    // variable donde se alamcenara el mensaje a ser enviado al profesor
    $mensaje = '<html>
                    <head>
                    </head>
                    <body>
                        <div>
                            <p>Estimado/a profesor/a, por medio del presente se le informa el resultado 
                            de la revisi&oacute;n del programa de la asignatura: <b>'.$asignatura->getId().'</b> - <b>'.$asignatura->getNombre().'</b>.</p>
                            <p>
                            El programa est&aacute; <b>'.$aprobado.'</b>
                            </p>
                            '.$observaciones.'
                            <br>
                            <br>
                            <p>Saludos</p>
                            <p>Sistema VASPA</p>
                        </div>
                    </body>
                </html>';
    
    //$template = "../lib/notificacionesMail/plantillaMail/mail_Secretaria_Academica_Nuevo_Programa.html"; //Ruta de la plantilla HTML para enviar nuestro mensaje
    $mail_subject = "Resultado de la revisión del programa de: {$asignatura->getId()} - $nombreAsignatura";

    sendemail($mail_username, $mail_userpassword, $mail_addAddress, $mail_subject, $mensaje); //Enviar el correo
}
