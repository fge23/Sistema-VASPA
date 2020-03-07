<?php
include_once '../lib/ControlAcceso.Class.php';
include_once '../controlSistema/ManejadorPrograma.php';


$codAsignatura = $_POST['codAsignatura'];
$anio = $_POST['anio'];
$ubicacion = $_POST['ubicacion'];

$ManejadorPrograma = new ManejadorPrograma();

$consulta = $ManejadorPrograma->modificarUbicacion($ubicacion, $anio, $codAsignatura);

?>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
        <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>
        <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Seguir Programa</title>
    </head>
    <body>
        <?php include_once '../gui/navbar.php'; ?>

        <div class="container">
            <p></p>
            <div class="card">
                <div class="card-header">
                    <h3>Seguir Programa</h3>
                </div>
                <div class="card-body">
                    <?php if ($consulta) { ?>
                        <div class="alert alert-success" role="alert">
                            Operaci&oacute;n realizada con &eacute;xito. Se ha actualizado satisfactoriamente
                            la ubicaci&oacute;n del programa. 
                        </div>
                    <?php } ?>   
                    <?php if (!$consulta) { ?>
                        <div class="alert alert-danger" role="alert">
                            Ha ocurrido un error. No se ha actualizado la ubicaci&oacute;n del programa.
                        </div>
                    <?php } ?>
                    <hr />
                    <h5 class="card-text">Opciones</h5>
                    <a href="programa.seguirPdf.php">
                        <button type="button" class="btn btn-primary">
                            <span class="oi oi-document"></span> Ver ubicaci&oacute;n de otro programa
                        </button>
                    </a>
                    <a href="panelSA.php">
                        <button type="button" class="btn btn-primary">
                            <span class="oi oi-account-logout"></span> Salir
                        </button>
                    </a>
                </div>
            </div>
        </div>
        <?php include_once '../gui/footer.php'; ?>
    </body>
</html>
