<?php

//include_once '../lib/Constantes.Class.php';
//include_once '../modeloSistema/BDConexionSistema.Class.php';

?>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
        <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>        
        <title><?php //echo Constantes::NOMBRE_SISTEMA; ?>A&ntilde;os</title>

    </head>
    <body>

        <?php //include_once '../gui/navbar.php';   ?>

        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h3>Seleccione el a&ntilde;o del programa</h3>
                    <label>Ingrese un a&ntilde;o:</label>
                    <input type="text" name="caja_busqueda" id="caja_busqueda" 
                    class="form-control" placeholder="Ingrese año a buscar">
                </div>
               <div class="card-body" id="datos">
                </div>
            </div>
            <input type="hidden" name="codCarrera" id="codCarrera" value="<?= $_GET['cod']; ?>">
        </div>
        <?php //include_once '../gui/footer.php'; ?>
        <script type="text/javascript" src="../lib/js/jquery.min.js"></script>
        <script type="text/javascript" src="../lib/js/buscar.anios.pdf.js"></script>
        
    </body>
</html>