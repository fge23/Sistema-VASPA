<?php
include_once '../controlSistema/ManejadorPlan.php';
include_once '../lib/ControlAcceso.Class.php';
include_once '../modeloSistema/Carrera.Class.php';

$ManejadorPlan = new ManejadorPlan();
$Planes = $ManejadorPlan->getColeccion();

?>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
        <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>        
        <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Planes</title>

    </head>
    <body>

        <?php include_once '../gui/navbar.php'; ?>

        <div class="container">
            <div class="card">
                <div class="card-header">

                    <h3>Planes</h3>
                </div>
                <div class="card-body">
                    <p>
                        <a href="plan.crear.php">
                            <button type="button" class="btn btn-success">
                                <span class="oi oi-plus"></span> Nuevo Plan
                            </button>
                        </a>
                    </p>
                    <table class="table table-hover table-sm">
                        <tr class="table-info">
                            <th>C&oacute;digo de la Carrera</th>
                            <th>Carrera</th>
                            <th>A&ntilde;o de Inicio</th>
                            <th>A&ntilde;o de Fin</th>
                            <th>Opciones</th>
                        </tr>
                        <tr>
                            <?php
                            foreach ($Planes as $Plan) {
                                $Carrera = new Carrera($Plan->getIdCarrera());
                                ?>
                                <td><?= $Carrera->getId(); ?></td>
                                <td><?= $Carrera->getNombre(); ?></td>
                                <td><?= $Plan->getAnio_inicio(); ?></td>
                                <td><?= $Plan->getAnio_fin(); ?></td>

                                <td>
                                    <a title="Ver detalle" href="carrera.verAsignaturas.php">
                                        <button type="button" class="btn btn-outline-info">
                                            <span class="oi oi-zoom-in"></span>
                                        </button>
                                    </a>
                                    <a title="Modificar" href="plan.modificar.php?id=<?= "a"; //$Carrera->getId();     ?>">
                                        <button type="button" class="btn btn-outline-warning">
                                            <span class="oi oi-pencil"></span>
                                        </button>
                                    </a>
                                    <a title="Eliminar" href="plan.eliminar.php?id=<?= "a"; //$Carrera->getId();     ?>">
                                        <button type="button" class="btn btn-outline-danger">
                                            <span class="oi oi-trash"></span>
                                        </button>
                                    </a>  
                                </td>
                            </tr>
<?php } ?>
                    </table>
                </div>
            </div>
        </div>
<?php include_once '../gui/footer.php'; ?>
    </body>
</html>