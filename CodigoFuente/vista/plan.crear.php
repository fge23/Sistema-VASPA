<?php
include_once '../lib/ControlAcceso.Class.php';
include_once '../modeloSistema/Carrera.Class.php';
ControlAcceso::requierePermiso(PermisosSistema::PERMISO_PLANES);

// validamos que se esta enviando el codigo de la carrera
if (!isset($_GET["id"]) || empty($_GET["id"])){
    header("Location: planes.php");
    exit;
}
//$_GET["id"] = '016';
$codCarrera = $_GET["id"];
$carrera = new Carrera($codCarrera);

if (is_null($carrera->getId())){
    // no existe la carrera regresamos a la pantalla de planes
    header("Location: planes.php");
    exit;
}


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
        <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Crear nueva revisi&oacute;n de Plan</title>
    </head>
    <body>
        <?php include_once '../gui/navbar.php'; ?>
        <div class="container">
            <form action="plan.crear.procesar.php" method="post"> 
                <div class="card">
                    <div class="card-header">
                        <h3>Crear Nueva Revisi&oacute;n del Plan de: <span class="text-info"><?= $carrera->getId().' - '.$carrera->getNombre();?></span></h3>
                        <p>
                            Complete los campos a continuaci&oacute;n. 
                            Luego, presione el bot&oacute;n <b>Confirmar</b>.<br />
                            Si desea cancelar, presione el bot&oacute;n <b>Cancelar</b>.
                        </p>
                    </div>
                    <div class="card-body">
                        <h4>Propiedades</h4>
                        
                        <div class="form-group">
                            <label for="inputCodigoPlan">N&uacute;mero de revisi&oacute;n del Plan</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><?= $carrera->getId().'P'; ?></div>
                                  </div>
                                <input type="number" name="id" class="form-control" id="inputCodigoPlan" placeholder="Ingrese el n&uacute;mero de revisi&oacute;n del Plan" 
                                       min="1" max="20" required="" autofocus>
                            </div>
                        </div>
                        
                        <input type="hidden" id="inputCarrera" name="idCarrera" value="<?= $carrera->getId(); ?>">
                                                
                        <div class="form-group">
                            <label for="inputAnioInicio">A&ntilde;o de Inicio</label>
                            <!--En el año maximo se coloca el año actual + 1-->
                            <input type="number" name="anio_inicio" class="form-control" min="1995" max="<?= date("Y") + 1; ?>" id="inputAnioInicio" placeholder="Ingrese el a&ntilde;o de Inicio del Plan" required="">
                        </div>

                        <div class="form-group">
                            <label for="inputAnioFin">A&ntilde;o de Fin</label>
                            <!--En el año maximo se coloca el año actual + 25-->
                            <input type="number" name="anio_fin" class="form-control" min="1995" max="<?= date("Y") + 25; ?>" id="inputAnioFin" placeholder="Ingrese el a&ntilde;o de Fin del Plan" >
                        </div>

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
