<?php

require '../PHPMailer/PHPMailerAutoload.php';
require 'constantesMail.php';


//(observacion: el correo del emisor debe ser un correo de gmail, el cual se 
//debe configurar a priori hacer lo siguiente: 
//Ir a su cuenta/seleccionar inicio de sesión y seguridad, 
//luego ir hasta la sección “Aplicaciones con acceso a la cuenta” y habilitar el 
//acceso a las aplicaciones pocos seguras, eso es todo.)

//Author: Obed Alvarado
//Author URL: http://obedalvarado.pw
//License: Creative Commons Attribution 3.0 Unported
//License URL: http://creativecommons.org/licenses/by/3.0/ 
//La siguiente funcion se encarga de realizar el envio del mail en base a los parametros    
function sendemailProf($mail_username, $mail_userpassword, $mail_addAddress, $mail_subject, $template, $codAsignatura, $nombreAsignatura){
	$mail = new PHPMailer;
	$mail->isSMTP();                            // Establecer el correo electrónico para utilizar SMTP
	$mail->Host = 'smtp.gmail.com';             // Especificar el servidor de correo a utilizar 
	$mail->SMTPAuth = true;                     // Habilitar la autenticacion con SMTP
	$mail->Username = $mail_username;          // Correo electronico saliente ejemplo: tucorreo@gmail.com
	$mail->Password = $mail_userpassword; 		// Tu contraseña de gmail
	$mail->SMTPSecure = 'tls';                  // Habilitar encriptacion, `ssl` es aceptada
	$mail->Port = 587;                          // Puerto TCP  para conectarse 
	//$mail->setFrom($mail_setFromEmail, $mail_setFromName);//Introduzca la dirección de la que debe aparecer el correo electrónico. Puede utilizar cualquier dirección que el servidor SMTP acepte como válida. El segundo parámetro opcional para esta función es el nombre que se mostrará como el remitente en lugar de la dirección de correo electrónico en sí.
	//$mail->addReplyTo($mail_setFromEmail, $mail_setFromName);//Introduzca la dirección de la que debe responder. El segundo parámetro opcional para esta función es el nombre que se mostrará para responder
        $mail->FromName = "Sistema VASPA";
        $mail->addAddress($mail_addAddress);   // Agregar quien recibe el e-mail enviado
	$message = file_get_contents($template);
        $message = str_replace('{{codAsignatura}}', $codAsignatura, $message);
        $message = str_replace('{{nombreAsignatura}}', $nombreAsignatura, $message);
        $message = utf8_decode($message);
	
	$mail->isHTML(true);  // Establecer el formato de correo electrónico en HTML
	
	$mail->Subject = $mail_subject;
        $mail->Subject = utf8_decode($mail->Subject); 
                
	$mail->msgHTML($message);
        //var_dump($message);
	if(!$mail->send()) {
            return 0;
		//echo '<p style="color:red">No se pudo enviar el mensaje..';
		//echo 'Error de correo: ' . $mail->ErrorInfo."</p>";
            //echo '<div class="alert alert-danger" role="alert">Ha ocurrido un error al enviar el correo.<b>('.$mail->ErrorInfo.')</b></div>';
            
	} else {
		//echo '<p style="color:green">Tu mensaje ha sido enviado!</p>';
            return 1;
//                return '<div class="alert alert-success" role="alert">Correo enviado con &eacute;xito.</div>';
	}
}

// Prepara todos los datos necesarios para enviar el email al profesor solicitandole
// que carge el programa de la asignatura para el anio actual
function enviarMailSolicitarCargaPrograma($idAsignatura) {
    include_once '../../modeloSistema/Asignatura.Class.php';
    //include_once '../../modeloSistema/Asignatura.Class.php';
    include_once '../../modeloSistema/Profesor.Class.php';
    $asignatura = new Asignatura($idAsignatura);
    $profesor = new Profesor($asignatura->getIdProfesor());

    $mailProf = $profesor->getEmail();
    $nombreAsignatura = $asignatura->getNombre();

    /* Configuracion de variables para enviar el correo */

    $mail_username = MAIL_SISTEMA; //Correo electronico saliente ejemplo: tucorreo@gmail.com
    $mail_userpassword = CONTRASENA_SISTEMA; //Tu contraseña de gmail
    $mail_addAddress = $mailProf;

    $template = "plantillaMail/plantilla_mail.html"; //Ruta de la plantilla HTML para enviar nuestro mensaje
    $mail_subject = "Solicitud de Carga de Programa de Asignatura";
    
    return sendemailProf($mail_username, $mail_userpassword, $mail_addAddress, $mail_subject, $template, $asignatura->getId(), $nombreAsignatura); //Enviar el mensaje
    
}
