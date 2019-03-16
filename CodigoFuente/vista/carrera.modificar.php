<?php
include_once '../lib/Constantes.Class.php';;
include_once '../controlSistema/ManejadorCarrera.php';


$codCarrera = $_GET["id"];

$Carrera = new Carrera($codCarrera);

?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
        <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>
        <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Actualizar Carrera</title>

    </head>
    <body>
        <?php include_once '../gui/navbar.php';
        ?>
        <div class="container">
            <form action="carrera.modificar.procesar.php" method="post">
                <div class="card">
                    <div class="card-header">
                        <h3>Actualizar Carrera</h3>
                        <p>
                            Complete los campos a continuaci&oacute;n. 
                            Luego, presione el bot&oacute;n <b>Confirmar</b>.<br />
                            Si desea cancelar, presione el bot&oacute;n <b>Cancelar</b>.
                        </p>
                    </div>
                    <div class="card-body">
                        
                          <div class="form-group">
                              <label for="inputCodigo">C&oacute;digo de Carrera</label>
                              <input type="number" name="id" class="form-control" id="inputCodigo" value="<?= $Carrera->getId(); ?>" placeholder="C&oacute;digo de Carrera" min="001" max="999" required="">
                        </div>
                        
                        <div class="form-group">
                            <label for="inputNombre">Nombre de Carrera</label>
                            <input type="text" name="nombre" class="form-control" id="inputNombre" value="<?= $Carrera->getNombre(); ?>" placeholder="Nombre de la Carrera" required="">
                        </div>
                         
                        <input type="hidden" name="idAnterior" value="<?= $Carrera->getId(); ?>">
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-outline-success">
                            <span class="oi oi-check"></span> Confirmar
                        </button>
                        <a href="carreras.php">
                            <button type="button" class="btn btn-outline-danger">
                                <span class="oi oi-x"></span> Cancelar
                            </button>
                        </a>
                    </div>
                </div>
            </form>
        </div>
        <?php  include_once '../gui/footer.php'; ?>
    </body>
</html>