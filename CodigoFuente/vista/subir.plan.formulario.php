<?php

/*
 * Aqui comienza la ejecucion del CU Subir Plan
 * NOTA: El boton cancelar no hace "nada", deberia redirigir a la pagina principal o al panel de Secretaria Academica 
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
        <script src="../lib/bootbox/bootbox.js"></script>
        <script src="../lib/bootbox/bootbox.locales.js"></script>
        
        <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Subir Plan de Estudio</title> 
    </head>
    <body>
        <?php include_once '../gui/navbar.php';   ?>
        <div class="container">
            <form enctype="multipart/form-data" action="subir.plan.procesar.php" method="post" id="form"> 
                <div class="card">
                    <div class="card-header">
                        <h3>Subir Plan de Estudio al Sistema</h3>
                        <p>
                            Complete los campos a continuaci&oacute;n. 
                            Luego, presione el bot&oacute;n <b>Subir Plan</b>.<br />
                            Si desea cancelar, presione el bot&oacute;n <b>Cancelar</b>.
                        </p>
                    </div>
                    <div class="card-body">
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
                        
                        <div class="form-group">
                            <label for="selectPlan">C&oacute;digo del Plan</label>
                            <br>
                            <select class="selectpicker show-tick" data-width="100%" name="selectPlan" id="selectPlan" title="Seleccione el c&oacute;digo del plan" required="">
                            </select>
                        
                        </div>
                        
                        <div class="form-group">
                            <label for="inputDescripcion">Descripci&oacute;n</label>
                            <input type="text" class="form-control" id="inputDescripcion" name="descripcion"
                                placeholder="Ingrese una descripci&oacute;n (opcional)">
                        </div>
                        
                        <div class="form-group">
                            <label for="inputFile">Adjuntar Plan de Estudio</label>
                            <!--El campo oculto MAX_FILE_SIZE (medido en bytes) su valor es el tamaño de fichero máximo aceptado por PHP.-->
                            <!--En este caso se opto por el tamaño maximo de 2MB-->
                            <input type="hidden" name="MAX_FILE_SIZE" value="2097152" />
                            <input type="file" class="form-control-file" id="inputFile" name="plan" accept="application/pdf" required="">
                        </div>
                           
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-outline-primary" id="boton" name="boton">
                            <span class="oi oi-cloud-upload"></span> Subir Plan
                        </button>
                        
                        <a href="#">
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
        
<!--        <script type="text/javascript"> //$('select').selectpicker();
            $('#selectCarrera').change(function (e) {
                 alert(e.target.value);
            });

        </script>-->
        
        <script>
            $(document).ready(function(){
                  $('#selectCarrera').change(function () {
                    var codCarrera = $('#selectCarrera').val();
                    //alert(codCarrera);
                    $.ajax({
                      type: 'POST',
                      url: '../lib/consultaAjax/subir.plan.cargarPlanes.php',
                      data: {'codCarrera': codCarrera}
                    })
                    .done(function(planes){
                      $(".selectpicker").selectpicker(); 
                      $('#selectPlan').html(planes).selectpicker('refresh');
                    })
                    .fail(function(){
                      alert('Hubo un error al cargar los planes');
                    });
                  });
              });
    </script>
    
    <script>
            //Script para validar la extension y el tamaño maximo permitido a subir del plan de estudio en PDF
            $(document).ready(function(){
            $('input[type="file"]').on('change', function(){
                var ext = $( this ).val().split('.').pop();
                ext = ext.toLowerCase();
                if ($( this ).val() != '') {
                  if(ext == "pdf"){
                    //alert("La extensión es: " + ext);
                    if($(this)[0].files[0].size > 2097152){
                      //alert("El documento excede el tamaño máximo");
                      bootbox.setLocale('es');
                      bootbox.alert("El documento excede el tama&ntilde;o m&aacute;ximo de 2MB");    
                      $(this).val('');
                    }
                  }
                  else
                  {
                    $( this ).val('');
                    //alert("Extensión no permitida: " + ext);
                    bootbox.setLocale('es');
                    bootbox.alert("Archivo con extensi&oacute;n no permitida: " + ext);
                  }
                }
            });});
        </script>

    </body>
</html>