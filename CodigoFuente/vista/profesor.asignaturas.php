<?php
include_once '../lib/ControlAcceso.Class.php';
ControlAcceso::requierePermiso(PermisosSistema::PERMISO_PROFESORES);
include_once '../lib/Constantes.Class.php';
include_once '../modeloSistema/Profesor.Class.php';
include_once '../controlSistema/ManejadorAsignatura.php';


$idProfesor = $_GET['id'];

$profesor = new Profesor($idProfesor);

$ManejadorAsignatura = new ManejadorAsignatura();

$asignaturas = $ManejadorAsignatura->getAsignaturasSegunProfesor($idProfesor);

?>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
        <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>
        <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Asignaturas de Profesor</title>
    </head>
    <body>
        <?php include_once '../gui/navbar.php'; ?>
        <div class="container">
            <p></p>
            <div class="card">
                <div class="card-header">
                    <h3>Asignaturas del Profesor: <span class="text-info"><?= $profesor->getApellido();?> <?= $profesor->getNombre();?></span> </h3>
                </div>
                <div class="card-body">
                    
                  
                    <table class="table table-hover table-sm text-center" id="tablaPlanes">
                        <thead>
                            <tr class="table-info">
                                <th>C&oacute;digo</th>
                                <th>Nombre</th>
                                <th>Horas Semanales</th>
                            </tr>
                        </thead>
                        <tbody>
                                
                                <?php
                                if (is_null($asignaturas)){

                                    echo '<tr>
                                            <td colspan="3">
                                                <div class="alert alert-warning" role="alert">
                                                    El profesor <b>NO</b> es responsable de ninguna asignatura.
                                                </div>
                                            </td>
                                         </tr>';
                                } else {
                                    foreach ($asignaturas as $asignatura) {
                                ?>
                                        <tr>
                                            <td><?= $asignatura->getId(); ?></td>
                                            <td><?= $asignatura->getNombre(); ?></td>
                                            <td><?= $asignatura->getHorasSemanales(); ?></td>
                                        </tr>
                                    
                                <?php } }?>
                                    
                        </tbody>
                    </table>
                    

                    <div class="card-footer text-center">
                        <a href="profesores.php">
                        <button type="button" class="btn btn-primary">
                            <span class="oi oi-account-logout"></span> Volver A Profesores
                        </button>
                        </a>
                    </div>    
                </div>
            </div>
        </div>
        <?php include_once '../gui/footer.php'; ?>
    </body>
</html>
