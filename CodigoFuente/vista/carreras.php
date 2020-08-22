<?php
include_once '../controlSistema/ManejadorCarrera.php';
include_once '../lib/ControlAcceso.Class.php';
ControlAcceso::requierePermiso(PermisosSistema::PERMISO_CARRERAS);

$ManejadorCarrera = new ManejadorCarrera();
$Carreras = $ManejadorCarrera->getColeccion();
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
        <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Carreras</title>

    </head>
    <body>

        <?php include_once '../gui/navbar.php'; ?>

        <div class="container">
            <div class="card">
                <div class="card-header">

                    <h3>Carreras</h3>
                </div>
                <div class="card-body">
                    <p>
                        <a href="carrera.crear.php">
                            <button type="button" class="btn btn-success">
                                <span class="oi oi-plus"></span> Nueva Carrera
                            </button>
                        </a>
                    </p>
                    <table class="table table-hover table-sm" id="tablaCarreras">
                        <thead>
                            <tr class="table-info">
                                <th>C&oacute;digo de Carrera</th>
                                <th>Nombre</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php foreach ($Carreras as $Carrera) { ?>
                                    <td><?= $Carrera->getId(); ?></td>
                                    <td><?= $Carrera->getNombre(); ?></td>

                                    <td>
                                        <a title="Ver Revisiones del Plan" href="carrera.verPlanes.php?id=<?= $Carrera->getId(); ?>">
                                            <button type="button" class="btn btn-outline-info">
                                                <span class="oi oi-list"></span>
                                            </button>
                                        </a>
                                        <a title="Modificar" href="carrera.modificar.php?id=<?= $Carrera->getId(); ?>">
                                            <button type="button" class="btn btn-outline-warning">
                                                <span class="oi oi-pencil"></span>
                                            </button>
                                        </a>
                                        <a title="Eliminar" href="carrera.eliminar.php?id=<?= $Carrera->getId(); ?>">
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
            </div>
        </div>
        <?php include_once '../gui/footer.php'; ?>
        <script type="text/javascript">
            $(document).ready(function () {
                $('#tablaCarreras').DataTable({
                    language: {
                        url: '../lib/datatable/es-ar.json'
                    }
                });
            });
        </script>
    </body>
</html>