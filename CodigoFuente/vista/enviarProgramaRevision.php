<?php
include_once '../lib/Constantes.Class.php';
include_once '../modeloSistema/BDConexionSistema.Class.php';

include_once '../lib/ControlAcceso.Class.php';
// Importar el siguiente script donde se encuentran los metodos para enviar el email
include_once '../lib/notificacionesMail/notificacionNuevoPrograma.php';

$DatosFormulario = $_POST;
if (empty($DatosFormulario) && !isset($_GET['idPrograma'])) {
    header("location: asignaturasDeProfesor.php");
} else {
    $error = "";
    $consulta = false;
    if (!empty($DatosFormulario)) {
        $idPrograma = $DatosFormulario['idPrograma'];
        echo $idPrograma;
    } else {
        if (isset($_GET['idPrograma'])) {
            $idPrograma = $_GET['idPrograma'];
        }
    }
    try {
        $queryProgramaRevision = "UPDATE PROGRAMA SET enRevision = 1 WHERE id = {$idPrograma}";
        $consulta = BDConexionSistema::getInstancia()->query($queryProgramaRevision);
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
    ?>
    <html>
        <head>
            <meta charset="UTF-8">
            <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
            <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
            <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
            <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>
            <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Enviar Programa a revisi&oacute;n</title>
        </head>
        <body>
            <?php include_once '../gui/navbar.php'; ?>
            <div class="container">
                <p></p>
                <div class="card">
                    <div class="card-header">
                        <h3>Enviar Programa a revisi&oacute;n</h3>
                    </div>
                    <div class="card-body">
                        <?php
                        if ($consulta) {
                            notificarNuevoPrograma($idPrograma);
                            ?>
                            <div class="alert alert-success" role="alert">
                                Se ha enviado el Programa a revisi&oacute;n con &eacute;xito.
                            </div>
                        <?php } ?>   
    <?php if (!$consulta) { ?>
                            <div class="alert alert-danger" role="alert">
                                Ha ocurrido un error al enviar el Programa a revisi&oacute;n: <?= $error; ?>
                            </div>
    <?php } ?>
                        <hr />
                        <h5 class="card-text">Opciones</h5>
                        <a href="asignaturasDeProfesor.php">
                            <button type="button" class="btn btn-primary">
                                <span class="oi oi-account-logout"></span> Salir
                            </button>
                        </a>
                    </div>
                </div>
            </div>
            <?php
            include_once '../gui/footer.php';
        }
        ?>
    </body>
</html>
