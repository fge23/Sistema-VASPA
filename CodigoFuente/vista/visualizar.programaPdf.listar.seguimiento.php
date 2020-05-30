<?php
include_once '../lib/ControlAcceso.Class.php';
include_once '../modeloSistema/Carrera.Class.php';
include_once '../modeloSistema/BDConexionSistema.Class.php';


$anio = $_POST['anio'];
$codCarrera = $_POST['idCarrera'];

$carrera = new Carrera($codCarrera, NULL);


$consulta = "SELECT asignatura.nombre, asignatura.id, programa.ubicacion, programa.id AS idPrograma FROM carrera JOIN plan JOIN plan_asignatura JOIN asignatura JOIN programa" .
                       " WHERE carrera.`id` = plan.`idCarrera` AND plan.`id` = plan_asignatura.`idPlan` "
                       . "AND asignatura.`id` = plan_asignatura.`idAsignatura` AND (carrera.`id` LIKE '$codCarrera') AND (programa.`anio` = $anio)"
                       . " AND (asignatura.`id` = programa.`idAsignatura`) AND (programa.`aprobadoSa` = '1' AND programa.`aprobadoDepto` = '1')";

$asignaturas = BDConexionSistema::getInstancia()->query($consulta);

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

        <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Seguir Programa</title>
    </head>
    <body>
        
        <?php include_once '../gui/navbar.php';   ?>
        <div class="container">
            
          
            <div class="card">
                <div class="card-header">
                 <h3>Seguir Programa - Carrera: <i> <?php echo $carrera->getNombre(); ?></i>, A&ntilde;o: <i><?php echo $anio; ?></i></h3>
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
                                <th>Ubicaci&oacute;n Actual</th>
                                <th>Actualizar Ubicaci&oacute;n</th>
                                
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                            <?php while ($asignatura=$asignaturas->fetch_assoc()){ ?>
                                
                                <td><?php echo $asignatura['id']; ?></td>
                                <td><?php echo $asignatura['nombre']; ?></td>

                                <?php if( $asignatura['ubicacion'] == 'SA'){ ?>
                                    <td><?php echo 'Secretar&iacute;a Acad&eacute;mica'; ?></td>
                                <?php }elseif ($asignatura['ubicacion'] == 'DPTO') {?>
                                        <td><?php echo 'Departamento'; ?></td>
                                <?php }else{ ?>
                                        <td><?php echo 'Todav&iacute;a no se imprimi&oacute; el documento PDF'; ?></td>
                                <?php }?>
                                <td>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a href="visualizar.programaPdf.listar.ubicacion.php?idPrograma=<?php echo $asignatura['idPrograma'];?>&nombreAsignatura=<?php echo urlencode($asignatura['nombre']);?>&codAsignatura=<?php echo $asignatura['id'];?>&ubicacionActual=<?php echo $asignatura['ubicacion'];?>">
    
                                        <button type="button" class="btn btn-outline-success" title="Actualizar ubicaci&oacute;n del programa">
                                            <span class="oi oi-document"></span>
                                        </button>

                                    </a>
                                </td>
                            </tr>

                        <?php } ?>   
                          
                        </tbody>
                    </table>                    

                    <div id="noResultMessage" class="alert alert-warning" role="alert" style="display: block;">
                        No se han encontrado resultados
                    </div>

                    <div class="card-footer text-center">
                        <a href="programa.seguirPdf.php">
                        <button type="button" class="btn btn-primary">
                            <span class="oi oi-account-logout"></span> Volver atr&aacute;s
                        </button>
                        </a>
                    </div>   

                </div>

            </div>
         
        </div>        
        <?php include_once '../gui/footer.php'; ?>
    </body>
    <script>
            $('#buscador').quicksearch('table tbody tr', {noResults: "#noResultMessage"});
    </script>

</html>
