<?php

require '../lib/PHPMailer/PHPMailerAutoload.php';


//(observacion: el correo del emisor debe ser un correo de gmail, el cual se 
//debe configurar a priori hacer lo siguiente: 
//Ir a su cuenta/seleccionar inicio de sesión y seguridad, 
//luego ir hasta la sección “Aplicaciones con acceso a la cuenta” y habilitar el 
//acceso a las aplicaciones pocos seguras, eso es todo.)

//constante que almacena la direccion de correo del emisor del mensaje 
define("MAIL_EMISOR", "");
//constante que almacena la contraseña del correo del emisor
define("CONTRASENA", "");

//constante que almacena la direccion de correo del receptor del mensaje
define("MAIL_RECEPTOR", "");


//Author: Obed Alvarado
//Author URL: http://obedalvarado.pw
//License: Creative Commons Attribution 3.0 Unported
//License URL: http://creativecommons.org/licenses/by/3.0/ 
//La siguiente funcion se encarga de realizar el envio del mail en base a los parametros    
function sendemail($mail_username, $mail_userpassword, $mail_addAddress, $mail_subject, $template, $codAsignatura, $nombreAsignatura, $nombreProfesor, $idPrograma){
//	require '../lib/PHPMailer/PHPMailerAutoload.php';
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
	$mail->addAddress($mail_addAddress);   // Agregar quien recibe el e-mail enviado
	$message = file_get_contents($template);
        $message = str_replace('{{codAsignatura}}', $codAsignatura, $message);
        $message = str_replace('{{nombreAsignatura}}', $nombreAsignatura, $message);
        $message = str_replace('{{nombreProfesor}}', $nombreProfesor, $message);
        $message = str_replace('{{idPrograma}}', $idPrograma, $message);
        $message = utf8_decode($message);
	
	$mail->isHTML(true);  // Establecer el formato de correo electrónico en HTML
	
	$mail->Subject = $mail_subject;
        $mail->Subject = utf8_decode($mail->Subject); 
                
	$mail->msgHTML($message);
	if(!$mail->send()) {
		//echo '<p style="color:red">No se pudo enviar el mensaje..';
		//echo 'Error de correo: ' . $mail->ErrorInfo."</p>";
            echo '<div class="alert alert-danger" role="alert">Ha ocurrido un error al enviar el correo.<b>('.$mail->ErrorInfo.')</b></div>';
	} 
//        else {
//		//echo '<p style="color:green">Tu mensaje ha sido enviado!</p>';
//                echo '<div class="alert alert-success" role="alert">Correo enviado con &eacute;xito.</div>';
//	}
}

// funcion que prepara los datos necesarios para notificar al usuario de Secretaria 
// Academica de la creacion de un nuevo programa de asignatura para que despues lo revise
function enviarMailNuevoProgramaSA($idPrograma) {
    include_once '../modeloSistema/Asignatura.Class.php';
    include_once '../modeloSistema/Profesor.Class.php';
    include_once '../modeloSistema/Programa.Class.php';
    //if (isset($_GET['codAsig'])) {
        //include("../sendemail.php"); //Mando a llamar la funcion que se encarga de enviar el correo electronico
        $programa = new Programa($idPrograma);
        $asignatura = new Asignatura($programa->getIdAsignatura());
        $profesor = new Profesor($asignatura->getIdProfesor());
        $nombreProfesor = $profesor->getApellido().', '.$profesor->getNombre(); 
        //$codAsignatura = $Asignatura->getId();
        $nombreAsignatura = $asignatura->getNombre();
        
        /* Configuracion de variables para enviar el correo 
        usar correo gmail*/
        
        $mail_username = MAIL_EMISOR; //Correo electronico saliente ejemplo: tucorreo@gmail.com
        $mail_userpassword = CONTRASENA; //Tu contraseña de gmail
        $mail_addAddress = MAIL_RECEPTOR; //correo electronico que recibira el mensaje
        
        $template = "../lib/plantillaMail/mail_Secretaria_Academica_Nuevo_Programa.html"; //Ruta de la plantilla HTML para enviar nuestro mensaje
        $mail_subject = "Nuevo Programa de $nombreAsignatura para revisar";

        sendemail($mail_username, $mail_userpassword, $mail_addAddress, $mail_subject, $template, $asignatura->getId(), $nombreAsignatura, $nombreProfesor, $idPrograma); //Enviar el mensaje
    //}
}

// funcion que prepara los datos necesarios para notificar al director de Departamento 
// correspondiente de la creacion de un nuevo programa de asignatura para que despues lo revise
function enviarMailNuevoProgramaDepartamento($idPrograma) {
    include_once '../modeloSistema/Asignatura.Class.php';
    include_once '../modeloSistema/Profesor.Class.php';
    include_once '../modeloSistema/Programa.Class.php';
    //if (isset($_GET['codAsig'])) {
        //include("../sendemail.php"); //Mando a llamar la funcion que se encarga de enviar el correo electronico
        $programa = new Programa($idPrograma);
        $asignatura = new Asignatura($programa->getIdAsignatura());
        $profesor = new Profesor($asignatura->getIdProfesor());
        $nombreProfesor = $profesor->getApellido().', '.$profesor->getNombre(); 
        //$codAsignatura = $Asignatura->getId();
        $nombreAsignatura = $asignatura->getNombre();
        
        /* Configuracion de variables para enviar el correo 
        usar correo gmail*/
        
        $mail_username = MAIL_EMISOR; //Correo electronico saliente ejemplo: tucorreo@gmail.com
        $mail_userpassword = CONTRASENA; //Tu contraseña de gmail
        $mail_addAddress = MAIL_RECEPTOR; //correo electronico que recibira el mensaje
        $template = "../lib/plantillaMail/mail_Departamento_Nuevo_Programa.html"; //Ruta de la plantilla HTML para enviar nuestro mensaje
        $mail_subject = "Nuevo Programa de $nombreAsignatura para revisar";
        sendemail($mail_username, $mail_userpassword, $mail_addAddress, $mail_subject, $template, $asignatura->getId(), $nombreAsignatura, $nombreProfesor, $idPrograma); //Enviar el mensaje
    //}
}

function notificarNuevoPrograma($idPrograma) {
    enviarMailNuevoProgramaSA($idPrograma);
    enviarMailNuevoProgramaDepartamento($idPrograma);
}