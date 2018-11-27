<?php
include_once '../lib/ControlAcceso.Class.php';

/* 
 * Esta pantalla muestra el listado de todos los programas "pendientes" de las asignaturas
 * junto con el nombre y apellido del docente responsable de la asignatura
 */

//include_once '../lib/Constantes.Class.php';

?>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
        <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>        
        <title><?php //echo Constantes::NOMBRE_SISTEMA; ?> Programas pendientes</title>

    </head>
    <body>

        <?php include_once '../gui/navbar.php';   ?>

        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h3>Enviar notificaci&oacute;n a Docente</h3>
<!--                        <p>
                            el bot&oacute;n <b>Enviar notificaci&oacute;n</b>.<br/>
                            Si desea cancelar, presione el bot&oacute;n <b>Cancelar</b>.
                        </p>-->
                    <label>Ingrese el nombre de la asignatura:</label>
                    <input type="text" name="caja_busqueda" id="caja_busqueda" 
                    class="form-control" placeholder="Ingrese nombre de la asignatura">
                </div>
                <div class="card-body" id="datos">
                </div>
            </div>
        </div>
        <?php include_once '../gui/footer.php'; ?>
        <script type="text/javascript" src="../lib/js/jquery.min.js"></script>
        <script type="text/javascript" src="../lib/js/filtrar.asignatura.js"></script>
    </body>
</html>

