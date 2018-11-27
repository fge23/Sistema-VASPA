<?php
include_once '../modeloSistema/Asignatura.Class.php';
include_once '../modeloSistema/Profesor.Class.php';

//validar que lo que viene por GET existe y es valido;
function enviarMail() {
    if (isset($_GET['codAsig'])) {
        include("sendemail.php"); //Mando a llamar la funcion que se encarga de enviar el correo electronico
        $Asignatura = new Asignatura($_GET['codAsig']);
        $Profesor = new Profesor($Asignatura->getIdProfesor());
        $codAsignatura = $Asignatura->getId();
        $nombreAsignatura = $Asignatura->getNombre();
        /* Configuracion de variables para enviar el correo 
        usar correo gmail*/
        $mail_username = ""; //Correo electronico saliente ejemplo: tucorreo@gmail.com
        $mail_userpassword = ""; //Tu contraseña de gmail
        $mail_addAddress = $Profesor->getEmail(); //correo electronico que recibira el mensaje
        $template = "../lib/plantillaMail/plantilla_mail.html"; //Ruta de la plantilla HTML para enviar nuestro mensaje

        /* Inicio captura de datos enviados por $_POST para enviar el correo */
        //$mail_setFromEmail = $_POST['customer_email'];
        //$mail_setFromName = $_POST['customer_name'];
        //$txt_message = $_POST['message'];
        $mail_subject = "Solicitud de Carga de Programa de Asignatura";

        sendemail($mail_username, $mail_userpassword, $mail_addAddress, $mail_subject, $template, $codAsignatura, $nombreAsignatura); //Enviar el mensaje
    }
}
?>
<?php include_once '../lib/ControlAcceso.Class.php'; ?>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
        <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>
        <title><?php //echo Constantes::NOMBRE_SISTEMA; ?>Enviar notificaci&oacute;n</title>
    </head>
    <body>
        <?php include_once '../gui/navbar.php'; ?>

        <div class="container">
            <p></p>
            <div class="card">
                <div class="card-header">
                    <h3>Enviar notificaci&oacute;n a docente</h3>
                </div>
                <div class="card-body">
                    
                    <?php enviarMail();?>
                    
                    <hr />
                    <h5 class="card-text">Opciones</h5>
                    <a href="#">
                        <button type="button" class="btn btn-primary">
                            <span class="oi oi-home"></span> Volver a Inicio
                        </button>
                    </a>
                    
                    <a href="programas.pendientes.php">
                        <button type="button" class="btn btn-primary">
                            <span class="oi oi-envelope-closed"></span> Enviar otra notificaci&oacute;n
                        </button>
                    </a>
                    
                </div>
            </div>
        </div>
        <?php include_once '../gui/footer.php'; ?>
    </body>
</html>
