<?php
include_once '../lib/ControlAcceso.Class.php';
?>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
        <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>
        <title><?php //echo Constantes::NOMBRE_SISTEMA; ?>Sistema VASPA - Visualizar Programa</title>

    </head>
    <body>

        <?php include_once '../gui/navbar.php';   ?>

        <div class="container">
            <div class="card">
                <div class="card-header">

                    <h3>Seleccione el programa de asignatura a visualizar</h3>
                    <label>Ingrese el nombre de la Asignatura:</label>
                    <input type="text" name="caja_busqueda" id="caja_busqueda" 
                    class="form-control" placeholder="Ingrese nombre de la Asignatura">
                </div>
                <div class="card-body" id="datos"> 
                </div>
            </div>
            <input type="hidden" name="codCarrera" id="codCarrera" value="<?= $_GET['cod']; ?>">
            <input type="hidden" name="anio" id="anio" value="<?= $_GET['anio']; ?>">
        </div>
        
        <?php include_once '../gui/footer.php'; ?>
        
        <script type="text/javascript" src="../lib/js/jquery.min.js"></script>
        <script type="text/javascript" src="../lib/js/filtrar.programasPDF.js"></script>
    </body>
</html>
