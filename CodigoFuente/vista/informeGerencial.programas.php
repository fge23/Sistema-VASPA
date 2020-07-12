<?php
//include_once '../controlSistema/ManejadorAsignatura.php';
include_once '../lib/ControlAcceso.Class.php';
require_once '../modeloSistema/BDConexionSistema.Class.php';
include_once '../controlSistema/ManejadorAsignatura.php';
include_once '../controlSistema/ManejadorProfesor.php';

$ManejadorAsignatura = new ManejadorAsignatura();
$ManejadorProfesor = new ManejadorProfesor();
$Profesores = $ManejadorAsignatura->getIDsProfesoresResponsables();
?>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
        <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>        
        <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Informe Gerencial de Programas</title>
    </head>
    <body>

        <?php include_once '../gui/navbar.php'; ?>

        <div class="container">
            <div class="card">
                <div class="card-header">

                    <h3>Informe Gerencial de Programas</h3>
                </div>
                <div class="card-body">
                     <table class="table table-hover table-sm">
                        <tr class="table-info">
                            <th>Nombre</th>
                            <th>Cantidad de asignaturas</th>
                            <th>Estado</th>
                        </tr>
                        <tr>
                            <?php foreach ($Profesores as $Profesor) { ?>
                            <td><?= $Profesor->getApellido().", ".$Profesor->getNombre();   ?></td>
                            <td><?= sizeof($ManejadorAsignatura->getAsignaturasSegunProfesor($Profesor->getId()));?></td>
                            <td></td>
                        </tr>
                          <?php } ?>
                    </table>
                </div>
            </div>
        </div>

        <?php include_once '../gui/footer.php'; ?>
    </body>
</html>


