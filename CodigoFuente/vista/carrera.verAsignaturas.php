<?php
include_once '../lib/Constantes.Class.php';
include_once '../modeloSistema/Plan.Class.php';

if (empty($_GET['id'])) {
    header("location: planes.php");
}
else {
    $plan = new Plan($_GET['id'], NULL);
    if (is_null($plan->getId())){
        header("location: planes.php");
    }
    $asignaturas = $plan->getAsignaturas();

}

?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
        <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>
        <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Asignaturas por Carrera</title>
    </head>
    <body>
        <?php include_once '../gui/navbar.php'; ?>
        <div class="container">
            <p></p>
            <div class="card">
                <div class="card-header">
                    <h3>Asignaturas por Carrera - Plan <?= $plan->getId()?></h3>
                </div>
                <div class="card-body">
                    
                  
                    <table class="table table-hover table-sm text-center" id="tablaPlanes">
                        <thead>
                            <tr class="table-info">
                                <th>C&oacute;digo de Asignatura</th>
                                <th>Nombre de Asignatura</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                                
                                <?php
                                if (is_null($asignaturas)){
                                    echo '<tr><td colspan="2"> <b> No hay asignaturas asociadas al Plan de Estudio </b></td></tr>';
                                } else {
                                    foreach ($asignaturas as $asignatura) {
                                ?>
                                        <tr><td><?= $asignatura->getId(); ?></td>
                                        <td><?= $asignatura->getNombre(); ?></td></tr>
                                    
                                <?php } }?>
                                    
                                
                            
                        </tbody>
                    </table>
                    
<!--                    <hr />
                    <h5 class="card-text">Opciones</h5>-->
                    <div class="card-footer text-center">
                        <a href="planes.php">
                        <button type="button" class="btn btn-primary">
                            <span class="oi oi-account-logout"></span> Volver A Planes
                        </button>
                        </a>
                    </div>    
                </div>
            </div>
        </div>
        <?php include_once '../gui/footer.php'; ?>
    </body>
</html>
