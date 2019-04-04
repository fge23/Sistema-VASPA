<?php
include_once '../lib/ControlAcceso.Class.php';
include_once '../controlSistema/ManejadorCarrera.php';

$ManejadorCarrera = new ManejadorCarrera();
$Carreras = $ManejadorCarrera->getColeccion();
/*
include_once '../../modeloSistema/BDConexionSistema.Class.php';
$consulta = "SELECT anio FROM ANIO ORDER BY anio DESC LIMIT 25";
//$consulta = "SELECT DISTINCT ANIO.anio FROM ANIO INNER JOIN PROGRAMA_PDF ON ANIO.anio = PROGRAMA_PDF.anio ORDER BY anio DESC LIMIT 25";
$datos = BDConexionSistema::getInstancia()->query($consulta);
*/
header('Content-Type: text/html; charset=ISO-8859-1');

?>

<html>
    <head>
        <meta charset="UTF-8">
        <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.8/css/bootstrap-select.min.css" rel="stylesheet"/>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.8/js/bootstrap-select.min.js"></script>
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
        
        <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Visualizar Programa</title> 
    </head>
    <body>
        <?php include_once '../gui/navbar.php';   ?>
        <div class="container">
            <form action="visualizar.programa.listar.php" method="post"> 
                <div class="card">
                    <div class="card-header">
                        <h3>Visualizar programa de asignatura</h3>
                        <p>
                            Complete los campos a continuaci&oacute;n. 
                            Luego, presione el bot&oacute;n <b>Confirmar</b>.<br />
                            Si desea cancelar, presione el bot&oacute;n <b>Cancelar</b>.
                        </p>
                    </div>
                    <div class="card-body">   
                        <div class="form-group">
                            <label for="selectCarrera">Carrera</label>
                            <br>
                            <select class="selectpicker show-tick" data-live-search="true" data-width="100%" name="idCarrera" id="selectCarrera" title="Seleccione una carrera" required="">
                                 <?php foreach ($Carreras as $Carrera) { ?>
                                <option value="<?= $Carrera->getId(); ?>"><?= $Carrera->getId() . " - " . $Carrera->getNombre(); ?></option>
                                <?php } ?>

                            </select>
                        
                        </div>
                        
                        <div class="form-group">
                            <label for="selectAnio">A&ntilde;o</label>
                            <br>
                            <select class="selectpicker show-tick" data-live-search="true" data-width="100%" name="anio" id="selectAnio" title="Seleccione un a&ntilde;o" required="">
                                 <?php for ($i=date('Y'); $i>=2011; $i--) { ?>
                                    <option value="<?= $i; ?>"><?= $i; ?></option>
                                <?php } ?>
                            </select>
                        
                        </div>
                    </div>
                    <div class="card-footer">
                            <button type="submit" class="btn btn-outline-success">
                                <span class="oi oi-check"></span> Confirmar
                            </button>
                            <a href="asignaturas.php">
                                <button type="button" class="btn btn-outline-danger">
                                    <span class="oi oi-x"></span> Cancelar
                                </button>
                            </a>
                    </div>
                </div>
            </form>
        </div>
                
        <?php include_once '../gui/footer.php'; ?>
        
        <script type="text/javascript">$('.selectpicker').selectpicker({
            noneResultsText: 'No se encontraron resultados'});
        </script>
        
        <script type="text/javascript"> //$('select').selectpicker();
            $('#selectCarrera').change(function (e) {
    alert(e.target.value);
});

        </script>
        
    </body>
</html>