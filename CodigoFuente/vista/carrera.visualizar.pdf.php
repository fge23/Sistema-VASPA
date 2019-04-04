<?php
include_once '../lib/ControlAcceso.Class.php';
include_once '../controlSistema/ManejadorCarrera.php';

$ManejadorCarrera = new ManejadorCarrera();
$Carreras = $ManejadorCarrera->getColeccion();
header('Content-Type: text/html; charset=ISO-8859-1');


# Agregar como atributo el siguiente codigo en la etiqueta <tr> si se quiere que toda la fila se considere como enlace
# Por lo pronto solo se utilizo dos etiqueta <a> con sus respectivos href 
/*
 * onclick="window.location='anio.visualizar.pdf.php?cod=<?= $Carrera->getId(); ?>'"
 */
?>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
        <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>        
        <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Seleccionar Carrera</title>

    </head>
    <body>

        <?php include_once '../gui/navbar.php';   ?>

        <div class="container">
            <div class="card">
                <div class="card-header">

                    <h3>Seleccione una Carrera</h3>
                </div>
                <div class="card-body">
                   
                    <table class="table table-hover table-sm">
                        <tr class="table-info">
                            <th>C&oacute;digo de Carrera</th>
                            <th>Nombre</th>
                        </tr>
                        
                            <?php foreach ($Carreras as $Carrera) { ?>
                        
                        <tr>    
                            <td><a href="anio.visualizar.pdf.php?cod=<?= $Carrera->getId(); ?>" style="text-decoration:none;color:black;"><?= $Carrera->getId(); ?></a></td>
                            <td><a href="anio.visualizar.pdf.php?cod=<?= $Carrera->getId(); ?>" style="text-decoration:none;color:black;"><?= $Carrera->getNombre(); ?></a></td>
                        </tr>
                           
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>
        <?php include_once '../gui/footer.php'; ?>
    </body>
</html>