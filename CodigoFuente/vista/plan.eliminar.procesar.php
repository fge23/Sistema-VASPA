<?php
include_once '../lib/ControlAcceso.Class.php';
ControlAcceso::requierePermiso(PermisosSistema::PERMISO_PLANES);
include_once '../lib/Constantes.Class.php';
include_once '../controlSistema/ManejadorPlan.php';
include_once '../modeloSistema/Plan.Class.php';

$DatosFormulario = $_POST;
$ManejadorPlan = new ManejadorPlan();

$mensaje = "";
try {
    $plan = new Plan($DatosFormulario['id']);
    // usado para volver a las revisiones del plan
    $idCarrera = "?id=".$plan->getIdCarrera();
    $consulta = $ManejadorPlan->baja($DatosFormulario['id']);
    
} catch (Exception $e) {
    $consulta = false;
    $mensaje = $e->getMessage();
}





?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
        <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>
        <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Eliminar Revisi&oacute;n de Plan</title>
    </head>
    <body>
        <?php include_once '../gui/navbar.php'; ?>
        <div class="container">
            <p></p>
            <div class="card">
                <div class="card-header">
                    <h3>Eliminar Revisi&oacute;n de Plan</h3>
                </div>
                <div class="card-body">
                    <?php if ($consulta) { ?>
                        <div class="alert alert-success" role="alert">
                            Operaci&oacute;n realizada con &eacute;xito.
                        </div>
                    <?php } ?>   
                    <?php if (!$consulta) { ?>
                        <div class="alert alert-danger" role="alert">
                            Ha ocurrido un error. <?= $mensaje; ?>
                        </div>
                    <?php } ?>
                    <hr />
                    <h5 class="card-text">Opciones</h5>
                    <a href="plan.revisiones.php<?= $idCarrera; ?>">
                            <button type="button" class="btn btn-primary">
                                <span class="oi oi-arrow-thick-left"></span> Volver a Revisiones del Plan
                            </button>
                        </a>
                        <a href="planes.php">
                            <button type="button" class="btn btn-info">
                                <span class="oi oi-justify-center"></span> Volver a Planes
                            </button>
                        </a>
                </div>
            </div>
        </div>
        <?php include_once '../gui/footer.php'; ?>
    </body>
</html>
