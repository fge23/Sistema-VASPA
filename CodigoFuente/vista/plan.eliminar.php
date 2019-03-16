<?php
include_once '../lib/ControlAcceso.Class.php';

include_once '../modeloSistema/Plan.Class.php';
$id = $_GET["id"];
$Plan = new Plan($id, null);
header('Content-Type: text/html; charset=UTF-8');

?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
        <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>
        <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Eliminar Plan</title>
    </head>
    <body>
        <?php include_once '../gui/navbar.php'; ?>
        <div class="container">
            <form action="plan.eliminar.procesar.php" method="post">
                <div class="card">
                    <div c  lass="card-header">
                        <h3>Eliminar Plan</h3>
                    </div>
                    <div class="card-body">
                        <p class="alert alert-warning ">
                            <span class="oi oi-warning"></span> ATENCI&Oacute;N. Esta operaci&oacute;n no puede deshacerse.
                        </p>
                        <p>¿Est&aacute; seguro que desea eliminar el Plan <b><?= $Plan->getId(); echo " del año ".$Plan->getAnio_inicio(); ?></b>?</p>
                    </div>
                    <div class="card-footer">
                        <input type="hidden" name="id" class="form-control" id="id" value="<?= $Plan->getId(); ?>" >
                        <button type="submit" class="btn btn-outline-success">
                            <span class="oi oi-check"></span> S&iacute;, deseo eliminar
                        </button>
                        <a href="planes.php">
                            <button type="button" class="btn btn-outline-danger">
                                <span class="oi oi-x"></span> NO (Salir de esta pantalla)
                            </button>
                        </a>
                    </div>
                </div>
            </form>
        </div>
        <?php include_once '../gui/footer.php'; ?>
    </body>
</html>