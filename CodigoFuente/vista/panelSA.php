<?php 
include_once '../lib/ControlAcceso.Class.php'; 
ControlAcceso::requierePermiso(PermisosSistema::PERMISO_VER_VIGENCIA_PROGRAMAS);
include_once '../controlSistema/ManejadorCarrera.php';

$manejadorCarrera = new ManejadorCarrera();
$carreras = $manejadorCarrera->getColeccion();
?>

<html lang="es">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
      <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>
      <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
      <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.8/css/bootstrap-select.min.css" rel="stylesheet"/>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.8/js/bootstrap-select.min.js"></script>
      <link rel="stylesheet" href="../lib/bootstrap-table/bootstrap-table.min.css">
      <link rel="stylesheet" type="text/css" href="../lib/bootstrap-table/extensions/filter-control/bootstrap-table-filter-control.css">
      <script src="../lib/bootstrap-table/bootstrap-table.min.js"></script>
      <script src="../lib/bootstrap-table/extensions/filter-control/bootstrap-table-filter-control.js"></script>
      <script src="../lib/bootstrap-table/extensions/export/bootstrap-table-export.min.js"></script>
      <script src="../lib/bootstrap-table/extensions/toolbar/bootstrap-table-toolbar.min.js"></script>
      <script src="../lib/bootstrap-table/locale/bootstrap-table-es-ES.js" ></script>
      <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
      <script src="../lib/bootstrap-table/tableExport.js"></script>
      <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
      
      <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Bienvenida</title>
      
      <script type="text/javaScript">
            $(document).ready(function(){
              // En este script modificamos el nombre del archivo a exportar en una hoja de calculo
              var codCarrera = $('#carrera').val();
              var codPlan = $('#plan').val(); //Obtiene el value
              var valor = $("#plan option:selected").html(); //Obtiene el contenido del option seleccionado
              var nombre = "Vigencias_Programas_"+codCarrera+"_"+valor; //nombre del archivo
              $('#table').bootstrapTable('refreshOptions', {
                  exportOptions: {fileName: nombre}
              });
            });
      </script>
      
    </head>
    <body>
        <?php include_once '../gui/navbar.php'; ?>
        <br>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="text-center">Panel Secretar&iacute;a Acad&eacute;mica</h3>
                        </div>
                        <div class="card-body">
                            <div id="codigoPlan"></div>
                                <div class="row justify-content-center">
                                    <div class="col-sm-5">
                                    <label for="carrera">Carrera</label>
                                    <select id="carrera" name="carrera" class="selectpicker" data-width="100%" data-live-search="true" required="" title="Seleccione una Carrera" data-none-results-text="No se encontraron resultados" data-size="7">
                                        <?php if (!empty($carreras)){
                                                    
                                                        foreach ($carreras as $carrera) {
                                                            echo '<option value="'.$carrera->getId().'">'.$carrera->getId().' - '.$carrera->getNombre().'</option>';
                                                        }    
                                                
                                        }
                                            ?>
                                    </select>
                                    </div>
                                    
<!--                                    <div class="col-sm-3">
                                        <label for="plan">Plan de Estudio</label>
                                        <select id="plan" name="plan" class="selectpicker" data-width="100%" data-live-search="true" required="" title="Seleccione un Plan de Estudio" data-none-results-text="No se encontraron resultados" data-size="7">

                                </select>
                                    </div>-->
                                
                                </div>
                            <div id="msgEnviarNotificacion"></div>
                            <div id="tablaVigenciaProgramas"></div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
        <?php include_once '../gui/footer.php'; ?>
    </body>
    
    <script>
            $(document).ready(function(){
            // Si selecciona una carrera se actualiza la tabla que contiene la vigencia de los programas
            // segun la carrera seleccionada, se mostrara solamente las asignaturas del plan vigente de la carrera
            $('#carrera').change(function (e) {
              var codCarrera = $("#carrera").val(); //obtenemos el codigo de la carrera seleccionada
              $.ajax({
                type: 'POST',
                url: '../lib/consultaAjax/vigenciaProgramas/tablaProgramaAsignaturas.php',
                //url: '../lib/consultaAjax/revisarPrograma/planesDeCarrera.php',
                data: {'codCarrera': codCarrera}
              })
              .done(function(tablaVigenciaProgramasAsignaturas){
                $('#tablaVigenciaProgramas').html(tablaVigenciaProgramasAsignaturas);
              })
              .fail(function(){
                alert('Hubo un error al cargar la Vigencia de los programas de asignaturas');
              });
            });
                    
          });
    </script>
    
    <script>
            $(function() {
              $('#table').bootstrapTable()
            });
    </script>
    <script>
        window.icons = {
          refresh: 'oi-reload',
          fullscreen: 'oi-fullscreen-enter',
          export: 'oi-document',
          columns: 'oi-list'
        }
    </script>
    
    <script>
            function enviarNotificacion(idAsignatura){
                var codCarrera = $("#carrera").val(); //obtenemos el codigo de la carrera seleccionada
                //console.log(codPlan);
                //console.log(idAsignatura);
                $('#msgEnviarNotificacion').html('<br><div class="row justify-content-center"><img src="../lib/img/loader.gif"/>&nbsp;&nbsp;&nbsp;Espere por favor se esta enviando la notificaci&oacute;n...</div>');
                $.ajax({
                              type: 'POST',
                              url: '../lib/notificacionesMail/notificarCargaProgramaActual.php',
                              data: {'idAsignatura': idAsignatura}
                            })
                            .done(function(resultado){
                              //$(".selectpicker").selectpicker(); 
                              //$('#msgEnviarNotificacion').html(resultado);
                              $('#msgEnviarNotificacion').fadeIn(1000).html(resultado);
                              //alert(programas);
                              $.post("../lib/consultaAjax/vigenciaProgramas/tablaProgramaAsignaturas.php", {'codCarrera': codCarrera}, function(tabla){
                                    $('#tablaVigenciaProgramas').html(tabla);
                              });
                            })
                            .fail(function(){
                              alert('Ocurrio un error al enviar la notificación.');
                            });
                
                
            }
    </script>
        
</html>
