<?php
include_once '../controlSistema/ManejadorAsignatura.php';
include_once '../lib/ControlAcceso.Class.php';


$ManejadorAsignatura = new ManejadorAsignatura();
$Asignaturas = $ManejadorAsignatura->getColeccion();
?>


<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
        <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>   
    
        <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Libros</title>

    </head>
    
    <body>

        <?php include_once '../gui/navbar.php'; ?>

        <div class="container">
            <div class="embed-responsive embed-responsive-21by9">
                <iframe class="embed-responsive-item" src="libros.crear.php" allowfullscreen></iframe>
               
            </div>
            <hr>
            <div class="card">
                <div class="card-header">

                    <h3>Libros</h3>
                </div>
                <div class="card-body">

                    <table class="table table-hover table-sm">
                        <tr class="table-info">
                            <th>C&oacute;digo de Libro</th>
                            <th>Nombre</th>
                            <th>Opciones</th>
                        </tr>
                        <tr>
                            <?php foreach ($Asignaturas as $Asignatura) { ?>
                                <td><?= $Asignatura->getId(); ?></td>
                                <td><?= $Asignatura->getNombre(); ?></td>

                                <td>
                                    <a title="Ver detalle" href="#">
                                        <button type="button" class="btn btn-outline-info">
                                            <span class="oi oi-zoom-in"></span>
                                        </button>
                                    </a>
                                    <a title="Modificar" href="asignatura.modificar.php?id=<?= $Asignatura->getId(); ?>">
                                        <button type="button" class="btn btn-outline-warning">
                                            <span class="oi oi-pencil"></span>
                                        </button>
                                    </a>
                                    <a title="Eliminar" href="../vista/asignatura.eliminar.php?id=<?= $Asignatura->getId(); ?>">
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