<?php
include_once '../lib/ControlAcceso.Class.php';
include_once '../controlSistema/ManejadorPrograma.php';

$DatosFormulario = $_POST;
$ManejadorPrograma = new ManejadorPrograma();

$idAsignatura = $DatosFormulario['idAsignatura'];
$anioActual = date("Y");

$idProgramaActual = $ManejadorPrograma->getIDProgramaActual($anioActual, $idAsignatura);
//echo "ID PROGRAMA".$idProgramaActual;
$consulta = $ManejadorPrograma->modificacion($DatosFormulario, $idProgramaActual);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
        <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>
        <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Modificar Programa</title>
    </head>
    <body>
        <?php include_once '../gui/navbar.php'; ?>

        <div class="container">
            <p></p>
            <div class="card">
                <div class="card-header">
                    <h3>Modificar Programa</h3>
                </div>
                <div class="card-body">
                    <?php if ($consulta) { ?>
                        <div class="alert alert-success" role="alert">
                            Los datos del Programa se han guardado con &eacute;xito.
                        </div>
                    <?php } ?>   
                    <?php if (!$consulta) { ?>
                        <div class="alert alert-danger" role="alert">
                            Ha ocurrido un error.
                        </div>
                    <?php } ?>
                    <hr />
                    <h5 class="card-text">Opciones</h5>
                    <a href="cargarBibliografia.php?id=<?= $idPrograma; ?>">
                        <button type="button" class="btn btn-primary">
                            <span class="oi oi-document"></span> Agregar Bibliograf&iacute;a
                        </button>
                    </a>
                    <a href="asignaturasDeProfesor.php">
                        <button type="button" class="btn btn-primary">
                            <span class="oi oi-account-logout"></span> Continuar m&aacute;s tarde
                        </button>
                    </a>
                </div>
            </div>
        </div>
        <?php include_once '../gui/footer.php'; ?>
    </body>
</html>
