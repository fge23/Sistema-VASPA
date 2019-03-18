<?php
include_once '../controlSistema/ManejadorProfesor.php';
include_once '../lib/ControlAcceso.Class.php';
include_once '../modeloSistema/Profesor.Class.php';

$ManejadorProfesor = new ManejadorProfesor();
$Profesores = $ManejadorProfesor->getColeccion();

?>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
        <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>        
        <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Profesores</title>

    </head>
    <body>

        <?php include_once '../gui/navbar.php'; ?>

        <div class="container">
            <div class="card">
                <div class="card-header">

                    <h3>Profesores</h3>
                </div>
                <div class="card-body">
                    <p>
                        <a href="profesor.crear.php">
                            <button type="button" class="btn btn-success">
                                <span class="oi oi-plus"></span> Nuevo Profesor
                            </button>
                        </a>
                    </p>
                    <table class="table table-hover table-sm">
                        <tr class="table-info">
                            <th>Apellido/s</th>
                            <th>Nombre/s</th>
                            <th>Email</th>
                            <th>Opciones</th>
                        </tr>
                        <tr>
                            <?php
                            foreach ($Profesores as $Profesor) {
                                
                                ?>
                                <td><?= $Profesor->getApellido(); ?></td>
                                <td><?= $Profesor->getNombre(); ?></td>
                                <td><?= $Profesor->getEmail(); ?></td>
                                
                                <td>
                                    <a title="Ver detalle" href="#">
                                        <button type="button" class="btn btn-outline-info">
                                            <span class="oi oi-zoom-in"></span>
                                        </button>
                                    </a>
                                    <a title="Modificar" href="profesor.modificar.php?id=<?= $Profesor->getId(); ?>">
                                        <button type="button" class="btn btn-outline-warning">
                                            <span class="oi oi-pencil"></span>
                                        </button>
                                    </a>
                                    <a title="Eliminar" href="profesor.eliminar.php?id=<?= $Profesor->getId(); ?>">
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