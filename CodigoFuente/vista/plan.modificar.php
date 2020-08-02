<?php
include_once '../lib/ControlAcceso.Class.php';
ControlAcceso::requierePermiso(PermisosSistema::PERMISO_PLANES);
include_once '../modeloSistema/Plan.Class.php';
include_once '../modeloSistema/Carrera.Class.php';
include_once '../controlSistema/ManejadorCarrera.php';

// validamos que se esta enviando el codigo del plan
if (!isset($_GET["id"]) || empty($_GET["id"])){
    header("Location: planes.php");
    exit;
}


$idPlan = $_GET["id"];
$Plan = new Plan($idPlan, null);

if (is_null($Plan->getId())){
    // no existe la carrera regresamos a la pantalla de planes
    header("Location: planes.php");
    exit;
}

$carrera = new Carrera($Plan->getIdCarrera());

if (is_null($carrera->getId())){
    // no existe la carrera regresamos a la pantalla de planes
    header("Location: planes.php");
    exit;
}

$ManejadorCarrera = new ManejadorCarrera();
$Carreras = $ManejadorCarrera->getColeccion();

?>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
        <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../lib/js/valida.anios.js"></script>
        <script src="../lib/bootbox/bootbox.js"></script>
        <script src="../lib/bootbox/bootbox.locales.js"></script>
        <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Modificar Plan</title>
    </head>
    <body>
        <?php include_once '../gui/navbar.php'; ?>
        <div class="container">
            <form action="plan.modificar.procesar.php" method="post"> 
                <div class="card">
                    <div class="card-header">
                        <h3>Modificar Revisi&oacute;n de Plan: <span class="text-info"><?= $Plan->getId(); ?></span></h3>
                        <p>
                            Complete los campos a continuaci&oacute;n. 
                            Luego, presione el bot&oacute;n <b>Confirmar</b>.<br />
                            Si desea cancelar, presione el bot&oacute;n <b>Cancelar</b>.
                        </p>
                    </div>
                    <div class="card-body">
                        <h4>Propiedades</h4>

                        <div class="form-group">
                            <label for="inputCodigoPlan">C&oacute;digo del Plan</label>
                            <!--En el año maximo se coloca el año actual + 1-->
                            <input type="text" name="id" class="form-control" id="inputCodigoPlan" placeholder="Ingrese el c&oacute;digo del Plan" value="<?= $Plan->getId(); ?>" 
                                   pattern="^\d{3}P\d{1,2}$" title="(C&oacute;digoCarrera)P(N&uacute;meroPlan) ejemplo: 016P4" required="" readonly="">
                        </div>
                        
                        <input type="hidden" id="inputCarrera" name="idCarrera" value="<?= $carrera->getId(); ?>">

                        <div class="form-group">
                            <label for="inputAnioInicio">A&ntilde;o de Inicio</label>
                            <!--En el año maximo se coloca el año actual + 1-->
                            <input type="number" name="anio_inicio" class="form-control" min="1995" max="<?= date("Y") + 1; ?>" value="<?= $Plan->getAnio_inicio(); ?>" id="inputAnioInicio" placeholder="Ingrese el a&ntilde;o de Inicio del Plan" required="">
                        </div>

                        <div class="form-group">
                            <label for="inputAnioFin">A&ntilde;o de Fin</label>
                            <!--En el año maximo se coloca el año actual + 25-->
                            <input type="number" name="anio_fin" class="form-control" min="1995" max="<?= date("Y") + 25; ?>" value="<?= $Plan->getAnio_fin(); ?>"  id="inputAnioFin" placeholder="Ingrese el a&ntilde;o de Fin del Plan">
                        </div>

                        <input type="hidden" name="idAnterior" value="<?= $Plan->getId(); ?>">

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-outline-success" onclick="return valida_anios(event);">
                            <span class="oi oi-check"></span> Confirmar
                        </button>
                        <a href="planes.php">
                            <button type="button" class="btn btn-outline-danger">
                                <span class="oi oi-x"></span> Cancelar
                            </button>
                        </a>
                    </div>
                </div>
            </form>

        </div>
        <?php include_once '../gui/footer.php'; ?>
    </body>
</html>
