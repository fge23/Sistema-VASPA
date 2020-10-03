<?php
include_once '../lib/ControlAcceso.Class.php';
ControlAcceso::requierePermiso(PermisosSistema::PERMISO_CARRERAS);
include_once '../lib/Constantes.Class.php';
include_once '../modeloSistema/Carrera.Class.php';
include_once '../modeloSistema/Plan.Class.php';
include_once '../controlSistema/ManejadorPlan.php';


$codigoCarrera = $_GET['id'];

$carrera = new Carrera($codigoCarrera);

$ManejadorPlan = new ManejadorPlan();

$planes = $ManejadorPlan->getPlanesSegunCarrera($codigoCarrera);

?>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
        <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>
        <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Planes de Carrera</title>
    </head>
    <body>
        <?php include_once '../gui/navbar.php'; ?>
        <div class="container">
            <p></p>
            <div class="card">
                <div class="card-header">
                    <h3>Revisiones del Plan de Estudios de <span class="text-info"><?= $carrera->getId();?> - <?= $carrera->getNombre();?></span> </h3>
                </div>
                <div class="card-body">
                    
                  
                    <table class="table table-hover table-sm text-center" id="tablaPlanes">
                        <thead>
                            <tr class="table-info">
                                <th>C&oacute;digo del Plan</th>
                                <th>Año de Inicio</th>
                                <th>Año de Fin</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                                
                                <?php
                                if (is_null($planes)){

                                    echo '<tr>
                                            <td colspan="4">
                                                <div class="alert alert-warning" role="alert">
                                                    No hay planes asociados a la Carrera seleccionada.
                                                </div>
                                            </td>
                                         </tr>';
                                } else {
                                    foreach ($planes as $plan) {
                                ?>
                                        <tr>
                                            <td><?= $plan->getId(); ?></td>
                                            <td><?= $plan->getAnio_inicio(); ?></td>
                                            <td><?= $plan->getAnio_fin(); ?></td>
                                            <td>
                                                <a title="Ver Asignaturas" href="plan.asignaturas.php?id=<?= $plan->getId(); ?>&idCarrera=<?= $codigoCarrera ?>">
                                                    <button type="button" class="btn btn-outline-info">
                                                        <span class="oi oi-list"></span>
                                                    </button>
                                                </a> 
                                            </td>
                                        </tr>
                                    
                                <?php } }?>
                                    
                        </tbody>
                    </table>
                    

                    <div class="card-footer text-center">
                        <a href="carreras.php">
                        <button type="button" class="btn btn-primary">
                            <span class="oi oi-account-logout"></span> Volver A Carreras
                        </button>
                        </a>
                    </div>    
                </div>
            </div>
        </div>
        <?php include_once '../gui/footer.php'; ?>
    </body>
</html>
