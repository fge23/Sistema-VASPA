<?php
include_once '../lib/ControlAcceso.Class.php';
include_once '../controlSistema/ManejadorAsignatura.php';
include_once '../controlSistema/ManejadorProgramaPDF.php';
include_once '../modeloSistema/Carrera.Class.php';
include_once '../modeloSistema/Asignatura.Class.php';

$anio = $_POST['anio'];
$codCarrera = $_POST['idCarrera'];
$ManejadorAsignatura = new ManejadorAsignatura();
$Asignaturas = $ManejadorAsignatura->getAsignaturasDeCarrera($codCarrera, $anio);
//var_dump($Asignaturas);

//Creamos el manejador de los programas pdf el cual va a tener una coleccion de pdf de la carrera para el anio especificado
$ManejadorProgramaPDF = new ManejadorProgramaPDF($codCarrera, $anio);

$carrera = new Carrera($codCarrera, NULL);

?>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
        <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
        <script type="text/javascript" src="../lib/quicksearch/jquery.quicksearch.js"></script>

        <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Visualizar Programa</title>
    </head>
    <body>
        <?php include_once '../gui/navbar.php';   ?>
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h3>Visualizar Programa - Carrera: <i><?php echo $carrera->getNombre(); ?></i>, A&ntilde;o: <i><?php echo $anio; ?></i></h3>
                    <hr>
                    <label for="buscador">Buscador</label>
                    <input type="text" name="buscador" id="buscador" 
                           class="form-control" placeholder="Ingrese nombre de la asignatura a buscar..." autofocus="">
                    
                </div>
                <div class="card-body">
                    
                    <table class="table table-hover table-sm">
                        <thead>
                            <tr class="table-info">
                                <th>C&oacute;digo</th>
                                <th>Asignatura</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <?php if (!is_null($Asignaturas)){ foreach ($Asignaturas as $Asignatura) { ?>
                            <td><?= $Asignatura->getId(); ?></td>
                            <td><?= $Asignatura->getNombre(); ?></td>
                            
                            <?php 
                                $ruta = $ManejadorProgramaPDF->tieneProgramaPDF($Asignatura->getId());
                                if (!empty($ruta)){ ?>
                                    <td>
                                        <a title="Visualizar Programa de Asignatura" href="<?= $ruta; ?>" target="_blank">
                                            <button type="button" class="btn btn-outline-success">
                                                <span class="oi oi-document"></span>
                                            </button>
                                        </a>
                                    </td>
                                <?php } else { ?>
                                    <td>
                                    <a title="Programa no disponible">
                                        <button type="button" class="btn btn-outline-success" disabled="">
                                            <span class="oi oi-document"></span>
                                        </button>
                                    </a>
                                </td>
                                <?php } ?>
                            </tr>
                            <?php }} ?> 
                        </tbody>
                    </table>                    
<!--                    <div  class="no-results-container" style="display: block;">
                        No results have been found.</div>-->
                    <div id="noResultMessage" class="alert alert-warning" role="alert" style="display: block;">
                        No se han encontrado resultados
                    </div>
                </div>
<!--                    <div class="card-body" id="datos"> 
                </div>-->
            </div>
            <input type="hidden" name="codCarrera" id="codCarrera" value="<?= $_POST['idCarrera']; ?>">
            <input type="hidden" name="anio" id="anio" value="<?= $_POST['anio']; ?>">
        </div>        
        <?php include_once '../gui/footer.php'; ?>
    </body>
    <script>
            $('#buscador').quicksearch('table tbody tr', {noResults: "#noResultMessage"});
    </script>
    
</html>
