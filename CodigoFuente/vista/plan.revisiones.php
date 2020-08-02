<?php
include_once '../controlSistema/ManejadorPlan.php';
include_once '../lib/ControlAcceso.Class.php';
ControlAcceso::requierePermiso(PermisosSistema::PERMISO_PLANES);
include_once '../modeloSistema/Carrera.Class.php';

// validamos que se esta enviando el codigo de la carrera
if (!isset($_GET["id"]) || empty($_GET["id"])){
    header("Location: planes.php");
    exit;
}

$codCarrera = $_GET["id"];
$carrera = new Carrera($codCarrera);

if (is_null($carrera->getId())){
    // no existe la carrera regresamos a la pantalla de planes
    header("Location: planes.php");
    exit;
}

$planes = $carrera->getPlanesDeEstudio();

?>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
        <link rel="stylesheet" href="../lib/datatable/dataTables.bootstrap4.min.css" />
        <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>  
        <script type="text/javascript" src="../lib/datatable/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="../lib/datatable/dataTables.bootstrap4.min.js"></script>
        <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Revisiones del Plan</title>

    </head>
    <body>

        <?php include_once '../gui/navbar.php'; ?>

        <div class="container">
            <div class="card">
                <div class="card-header">

                    <h3>Revisiones del Plan de Estudios de <span class="text-info"><?= $carrera->getId().' - '.$carrera->getNombre();?></span></h3>
                </div>
                <div class="card-body">
                    <p>
                        <a href="plan.crear.php?id=<?= $carrera->getId(); ?>">
                            <button type="button" class="btn btn-success">
                                <span class="oi oi-plus"></span> Nueva Revisi&oacute;n de Plan
                            </button>
                        </a>
                    </p>
                    <table class="table table-hover table-sm" id="tablaPlanes">
                        <thead>
                            <tr class="table-info">
<!--                                <th>C&oacute;digo de la Carrera</th>-->
<!--                                <th>Carrera</th>-->
                                <th>C&oacute;digo de Revisi&oacute;n</th>
                                <th>A&ntilde;o de Inicio</th>
                                <th>A&ntilde;o de Fin</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php
                                foreach ($planes as $plan) {
                                    
                                    ?>
                                    <td><?= $plan->getId(); ?></td>
                                    <td><?= $plan->getAnio_inicio(); ?></td>
                                    <td><?= $plan->getAnio_fin(); ?></td>

                                    <td>
                                        <a title="Ver Asignaturas" href="plan.asignaturas.php?id=<?= urlencode($plan->getId()); ?>">
                                            <button type="button" class="btn btn-outline-info">
                                                <span class="oi oi-list"></span>
                                            </button>
                                        </a>
                                        <a title="Modificar" href="plan.modificar.php?id=<?= urlencode($plan->getId()); ?>">
                                            <button type="button" class="btn btn-outline-warning">
                                                <span class="oi oi-pencil"></span>
                                            </button>
                                        </a>
                                        <a title="Eliminar" href="plan.eliminar.php?id=<?= urlencode($plan->getId()); ?>">
                                            <button type="button" class="btn btn-outline-danger">
                                                <span class="oi oi-trash"></span>
                                            </button>
                                        </a>  
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <a href="planes.php">
                            <button type="button" class="btn btn-info">
                                <span class="oi oi-justify-center"></span> Volver a Planes
                            </button>
                        </a>
                </div>
            </div>
        </div>
        <?php include_once '../gui/footer.php'; ?>
        <script type="text/javascript">
            $(document).ready(function () {
                $('#tablaPlanes').DataTable({
                    language: {
                        url: '../lib/datatable/es-ar.json'
                    }
                });
            });
        </script>
    </body>
</html>