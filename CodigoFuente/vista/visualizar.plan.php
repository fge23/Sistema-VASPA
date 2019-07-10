<?php

/*
 * Aqui comienza la ejecución del CU Visualizar Plan PDF
 * 
 * Nota: El boton "Cancelar" no tiene funcionalidad por ahora, hasta que se diseñe
 * la pagina principal del sistema
 */

include_once '../lib/ControlAcceso.Class.php';
include_once '../controlSistema/ManejadorCarrera.php';

$ManejadorCarrera = new ManejadorCarrera();
$Carreras = $ManejadorCarrera->getColeccion();

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
        <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Visualizar Plan de Estudios</title>

    </head>
    <body>

        <?php include_once '../gui/navbar.php';   ?>

        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h3>Visualizar Plan de Estudio</h3>
                    <p>
                        Seleccione una Carrera. 
                        Luego, presione el bot&oacute;n <b>Visualizar Plan</b>.<br/>
                        Si desea cancelar, presione el bot&oacute;n <b>Cancelar</b>.
                    </p>
                </div>
                
               <div class="card-body" id="datos">
                   <div class="form-group">
                        <label for="selectCarrera">Carrera</label>
                        <br>
                        <select class="selectpicker show-tick" data-live-search="true" data-width="100%" name="selectCarrera" id="selectCarrera" title="Seleccione una carrera" required="">
                            <?php 
                            foreach($Carreras as $Carrera){ ?>
                                <option value="<?= $Carrera->getId(); ?>"><?= $Carrera->getId() ?>&nbsp;-&nbsp;<?= $Carrera->getNombre(); ?> </option>
                            <?php } ?>
                        </select>
                    </div>
                   
                   <div id="planesCarrera">
                       
                   </div>
               </div>
                
                <div class="card-footer">
                        <a href="#">
                            <button type="button" class="btn btn-outline-danger">
                                <span class="oi oi-x"></span> Cancelar
                            </button>
                        </a>
                </div>
                
            </div>
            
        </div>
        <?php include_once '../gui/footer.php'; ?>
        
        <script type="text/javascript">$('.selectpicker').selectpicker({
            noneResultsText: 'No se encontraron resultados'});
        </script>
        
        <script type="text/javascript">
            //El siguiente script actualiza la tabla de planes, con los planes 
            //correspóndientes de acuerdo a la carrera seleccionada de la lista
            $(document).ready(function(){
                  $('#selectCarrera').change(function () {
                    var codCarrera = $('#selectCarrera').val();
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