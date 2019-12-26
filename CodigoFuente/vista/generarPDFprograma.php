<?php
/*
 * Falta el redireccionamiento del boton "Volver" ya cuando se defina el panel del profesor responsable
 */
require_once('../modeloSistema/MYPDF.php');

$idPrograma = $_GET['id'];
//var_dump($idPrograma);

try {
    $pdf = new MYPDF($idPrograma);
    //echo $pdf->getCantidadCarreras();
    $pdf->generarPDFprograma();
} catch (Exception $e) { ?>
            <?php
        include_once '../lib/Constantes.Class.php';
            ?>
            <html>
                <head>
                    <meta charset="UTF-8">
                    <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
                    <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
                    <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
                    <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>
                    <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Generar</title>
                </head>
                <body>
                    <?php include_once '../gui/navbar.php'; ?>

                    <div class="container">
                        <p></p>
                        <div class="card">
                            <div class="card-header">
                                <h3>Generación PDF Programa de Asignatura</h3>
                            </div>
                            <div class="card-body">  
                                    <div class="alert alert-danger" role="alert">
                                        Ha ocurrido un error. <?= $e->getMessage(); ?>
                                    </div>
                                <hr />
                                <h5 class="card-text">Opciones</h5>
                                <a href="javascript:history.back()">
                                    <button type="button" class="btn btn-primary">
                                        <span class="oi oi-account-logout"></span> Volver
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php
                    include_once '../gui/footer.php';
                
                ?>
            </body>
        </html>

    <?php //echo $e->getMessage();
}
