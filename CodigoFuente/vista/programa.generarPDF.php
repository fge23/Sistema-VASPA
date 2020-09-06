<?php

include_once '../lib/ControlAcceso.Class.php'; 
ControlAcceso::requierePermiso(PermisosSistema::PERMISO_GENERAR_PDF);
include_once '../modeloSistema/Programa.Class.php';
include_once '../modeloSistema/Asignatura.Class.php';
require_once('../modeloSistema/MYPDF.php');

// validamos que el id del programa este definido, sea un numero mayor o igual a 0
if (!isset($_GET['id']) || $_GET['id'] == "" || !is_numeric($_GET['id']) || $_GET['id'] < 0){
    $mensaje = 'No se ha especificado correctamente el ID del programa de asignatura.';
    mostrarPantallaError($mensaje);
}

// comprobamos si el programa existe
$programa = new Programa($_GET['id']);
if (is_null($programa->getId())){
    $mensaje = 'No existe un programa de asignatura con el ID: '.$_GET['id'];
    mostrarPantallaError($mensaje);
}

// comprobamos que el programa este aprobado por SA y Dpto para permitir la generacion del pdf
if ($programa->getAprobadoSa() != '1' || $programa->getAprobadoDepto() != '1'){
    $mensaje = 'El programa de asignatura no esta aprobado, solo se permite la generaci&oacute;n de programas que fueron aprobados tanto por Secretar&iacute;a Ac&aacute;demica y el Director de Departamento correspondiente.';
    mostrarPantallaError($mensaje);
}


$idPrograma = $_GET['id'];
// se procede a generar el PDF
try {
    $pdf = new MYPDF($idPrograma);
    $pdf->generarPDFprograma();
} catch (Exception $exc) {
    mostrarPantallaError($exc->getMessage());
}



function mostrarPantallaError($mensajeError){
    ?><html>
    <head>
        <meta charset="UTF-8">
        <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />       
        <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Error al Generar PDF</title> 
    </head>
    <body>
        <?php include_once "../gui/navbar.php";   ?>
        <div class="container">
                <div class="card">
                    <div class="card-header">
                        <h3>Error al Generar PDF</h3>
                        
                    </div>
                    <div class="card-body">
                        <div class="alert alert-danger" role="alert">
                            <?php echo $mensajeError; ?>
                        </div>   
                    </div>
                </div>
        </div>
                
        <?php include_once "../gui/footer.php"; ?>   
    </body>
</html><?php
    
    exit; // finalizamos el script
}

