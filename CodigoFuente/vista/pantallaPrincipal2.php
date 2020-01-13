<?php 
include_once '../lib/ControlAcceso.Class.php'; 
include_once '../controlSistema/ManejadorCarrera.php';

$ManejadorCarrera = new ManejadorCarrera();
$Carreras = $ManejadorCarrera->getColeccion();

?>

<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.8/css/bootstrap-select.min.css" rel="stylesheet"/>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.8/js/bootstrap-select.min.js"></script>
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
        <link href="../lib/bootstrap-4.1.1-dist/css/uargflow_footer.css" type="text/css" rel="stylesheet" />      

        <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Bienvenida</title>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container navbar-dark bg-dark">
                <a class="navbar-brand" href="#">
                    <img src="../lib/img/VASPA_isotipo.png" width="30" height="30" class="d-inline-block align-top" alt="">
                    <b><?php echo Constantes::NOMBRE_SISTEMA; ?></b>
                </a>
            </div>
        </nav>
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h3><?php echo Constantes::NOMBRE_SISTEMA; ?> - Bienvenida</h3>
                </div>

                <div class="card-body">
                    <p>Estimado usuario: Bienvenido al <b>Sistema</b> para la <b>V</b>isualizaci&oacute;n
                        <b>A</b>dministraci&oacute;n y <b>S</b>eguimiento de <b>P</b>rogramas de 
                        <b>A</b>signaturas <b>(VASPA)</b>,
                        una aplicaci&oacute;n desarrollada en la UARG - UNPA.</p>  
                    <hr>

                    <div class="row">
                        <div class="col-md-8 mb-1">                                
                            <form action="visualizar.programa.listar.php" method="post"> 
                                <div class="card">
                                    
                                    <div class="card-header">
                                        <h5>Visualizar programa de asignatura</h5>
                                        <p>
                                            Complete los campos a continuaci&oacute;n. 
                                            Luego, presione el bot&oacute;n <b>Confirmar</b>.
                                        </p>
                                    </div>
                                    
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="selectAnio">A&ntilde;o</label>
                                            <br>
                                            <select class="selectpicker show-tick" data-live-search="true" data-width="100%" name="anio" id="selectAnio" title="Seleccione un a&ntilde;o" required="">
                                                <?php for ($i = date('Y'); $i >= 2011; $i--) { ?>
                                                    <option value="<?= $i; ?>"><?= $i; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="selectCarrera">Carrera</label>
                                            <br>
                                            <select class="selectpicker show-tick" data-live-search="true" data-width="100%" name="idCarrera" id="selectCarrera" title="Seleccione una carrera" required="">
                                            </select>
                                        </div>     
                                    </div>
                                    
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-outline-success">
                                            <span class="oi oi-check"></span> Confirmar
                                        </button>
                                    </div>
                                    </div>
                            </form>
                    </div>
                        
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-header">
                                <h5>Visualizar Plan de Estudio</h5>
                                <p>
                                    Seleccione una Carrera. 
                                </p>
                            </div>

                            <div class="card-body" id="datos">
                                <div class="form-group">
                                    <label for="selectCarrera">Carrera</label>
                                    <br>
                                    <select class="selectpicker show-tick" data-live-search="true" data-width="100%" name="selectCarrera" id="selectCarrera1" title="Seleccione una carrera" required="">
                                        <?php foreach ($Carreras as $Carrera) { ?>
                                            <option value="<?= $Carrera->getId(); ?>"><?= $Carrera->getId() ?>&nbsp;-&nbsp;<?= $Carrera->getNombre(); ?> </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div id="planesCarrera"></div>
                            </div>
                            
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title">Ingreso a la Administraci&oacute;n del Sistema</h5>
                                <p class="card-text">Si usted es un Profesor, empleado de Secretar&iacute;a Acad&eacute;mica o Director de Departamento y desea realizar operaciones en el Sistema, por favor presione el bot&oacute;n a continuaci&oacute;n.</p>
                            </div>
                            <div class="card-footer">
                                <a href="../app/index.php" class="btn btn-primary btn-sm">Ir a Inicio de Sesi&oacute;n</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
        
         <footer class="footer">
            <?php echo Constantes::NOMBRE_SISTEMA; ?> 
            <img src="../lib/img/VASPA_isotipo.png" width="25" height="20"  alt="">
             UNPA-UARG
        </footer>
        
        <script type="text/javascript">$('.selectpicker').selectpicker({
            noneResultsText: 'No se encontraron resultados'});
        </script>
                
        <script>
            $(document).ready(function(){
                  $('#selectAnio').change(function () {
                    var anio = $('#selectAnio').val();
                    //alert(anio);
                    $.ajax({
                      type: 'POST',
                      url: '../lib/consultaAjax/visualizar.programa.cargar.carreras.php',
                      data: {'anio': anio}
                    })
                    .done(function(carreras){
                      $(".selectpicker").selectpicker(); 
                      $('#selectCarrera').html(carreras).selectpicker('refresh');
                    })
                    .fail(function(){
                      alert('Hubo un error al cargar las asignaturas')
                    });
                  });
              });
    </script>
    
    <script type="text/javascript">
            //El siguiente script actualiza la tabla de planes, con los planes 
            //correspóndientes de acuerdo a la carrera seleccionada de la lista
            $(document).ready(function(){
                  $('#selectCarrera1').change(function () {
                    var codCarrera = $('#selectCarrera1').val();
                    //alert(codCarrera);
                    $.ajax({
                      type: 'POST',
                      url: '../lib/consultaAjax/visualizar.plan.cargarPlanesCarrera.php',
                      data: {'codCarrera': codCarrera}
                    })
                    .done(function(planes){
                      $("#planesCarrera").html(planes);
                    })
                    .fail(function(){
                      alert('Hubo un error al cargar los planes');
                    });
                  });
              });
        </script>
    
    </body>
</html>
