<?php
include_once '../lib/ControlAcceso.Class.php';

// Importar el siguiente script donde se encuentran los metodos para enviar el email
include_once '../lib/notificacionesMail/notificacionNuevoPrograma.php';

// Validar que el id del programa sea valido
// Luego llamar a la siguiente funcion que recibe como parametro el id del programa:
// notificarNuevoPrograma($idPrograma);


?>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
        <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>        
        <title><?php echo Constantes::NOMBRE_SISTEMA; ?> Enviar Noti</title>

    </head>
    <body>

        <?php include_once '../gui/navbar.php';   ?>

        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h3>Enviar notificaci&oacute;n a SA y DPTO</h3>

                    <?php notificarNuevoPrograma(104);?>
                </div>
                <div class="card-body" id="datos">
                </div>
            </div>
        </div>
        <?php include_once '../gui/footer.php'; ?>

    </body>
</html>

