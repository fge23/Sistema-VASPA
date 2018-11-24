<?php
//include_once '../lib/Constantes.Class.php';
$anio = $_GET['anio'];
include_once '../modeloSistema/BDConexionSistema.Class.php';
$consulta = "SELECT * FROM programa_pdf WHERE anio = {$anio}";
$datos = BDConexionSistema::getInstancia()->query($consulta);

?>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
        <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>
        <title><?php //echo Constantes::NOMBRE_SISTEMA; ?>Sistema VASPA - Visualizar Programa</title>

    </head>
    <body>

        <?php //include_once '../gui/navbar.php';   ?>

        <div class="container">
            <div class="card">
                <div class="card-header">

                    <h3>Seleccione el programa a visualizar</h3>
                </div>
                <div class="card-body">
                    
                    <table class="table table-hover table-sm">
                        <tr class="table-info">
                            <th>Nombre</th>
                            <th>Tama&ntilde;o (en MB)</th>
                            <th>Opciones</th>
                        </tr>
                        <?php while ($programa = $datos->fetch_assoc()){ 
                           $nombre = utf8_encode($programa['nombre']);
                           $ruta = utf8_encode($programa['ruta']);
                           $tamanio = $programa['tamanio']; ?>
                        <td><?php echo $nombre; ?></td>
                        <td><?php echo round(($tamanio/1024)/1024, 2); ?></td>        
                        <td><a title="Visualizar Programa" href="../<?= $ruta; ?>">
                                        <button type="button" class="btn btn-outline-success">
                                            <span class="oi oi-document"></span>
                                        </button></a>
                        </td> 
                        </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>
        <ul>
            <?php //echo $listar;?>
        </ul>
        <?php //include_once '../gui/footer.php'; ?>
    </body>
</html>
