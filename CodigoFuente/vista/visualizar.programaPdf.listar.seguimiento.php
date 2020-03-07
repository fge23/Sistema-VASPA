<?php
include_once '../lib/ControlAcceso.Class.php';
include_once '../controlSistema/ManejadorAsignatura.php';
include_once '../modeloSistema/Carrera.Class.php';
include_once '../modeloSistema/Asignatura.Class.php';


$anio = $_POST['anio'];
$codCarrera = $_POST['idCarrera'];
$ManejadorAsignatura = new ManejadorAsignatura();
$Asignaturas = $ManejadorAsignatura->asignaturasConProgramasAprobadosDeCarrera($codCarrera, $anio);

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
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <?php if (!is_null($Asignaturas)){ foreach ($Asignaturas as $Asignatura) { ?>
                            <td><?= $Asignatura->getId(); ?></td>
                            <td><?= $Asignatura->getNombre(); ?></td>
                          
                            <td>
                        
                                <a href="visualizar.programaPdf.listar.ubicacion.php?anio=<?php echo $anio ?>&codAsignatura=<?php echo $Asignatura->getId() ?>" >
    
                                    <button type="button" class="btn btn-outline-success" title="Ver ubicacion del programa">
                                        <span class="oi oi-document"></span>
                                    </button>
                                </a>
                              
                            </td>
             
                        </tr>
                            <?php }} ?> 
                        </tbody>
                    </table>                    

                    <div id="noResultMessage" class="alert alert-warning" role="alert" style="display: block;">
                        No se han encontrado resultados
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
