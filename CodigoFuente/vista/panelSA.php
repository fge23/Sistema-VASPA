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
      <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
      <link rel="stylesheet" href="../lib/datatable/dataTables.bootstrap4.min.css" />
      <script type="text/javascript" src="../lib/datatable/jquery.dataTables.min.js"></script>
      <script type="text/javascript" src="../lib/datatable/dataTables.bootstrap4.min.js"></script>
      <script type="text/javascript" src="../lib/datatable/extensiones/dataTables.buttons.min.js"></script>
      <script type="text/javascript" src="../lib/datatable/extensiones/buttons.flash.min.js"></script>
      <script type="text/javascript" src="../lib/datatable/extensiones/jszip.min.js"></script>
      <script type="text/javascript" src="../lib/datatable/extensiones/pdfmake.min.js"></script>
      <script type="text/javascript" src="../lib/datatable/extensiones/vfs_fonts.js"></script>
      <script type="text/javascript" src="../lib/datatable/extensiones/buttons.html5.min.js"></script>
      <script type="text/javascript" src="../lib/datatable/extensiones/buttons.print.min.js"></script>
      <link rel="stylesheet" href="../lib/datatable/extensiones/buttons.dataTables.min.css" />
      
      <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Bienvenida</title>
      
    </head>
    <body>
        <?php include_once '../gui/navbar.php'; ?>
        <br>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="text-center">Estados de los Programas de Asignaturas</h3>
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
                                    
                                </div>
                            <div id="msgEnviarNotificacion"></div>
                            <div id="tablaVigenciaProgramas">
                                <br>
                                <div class="alert alert-info text-center" role="alert">
                                    Estimado usuario en esta pantalla podra obtener informaci&oacute;n acerca del estado de los Programas de Asignaturas de una Carrera. Para ello seleccione una Carrera de la lista.
                                  </div>
                            </div>

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
                data: {'codCarrera': codCarrera}
              })
              .done(function(tablaVigenciaProgramasAsignaturas){
                $('#tablaVigenciaProgramas').html(tablaVigenciaProgramasAsignaturas);
                var carrera = $('select[name="carrera"] option:selected').text();
                var nombreArchivo = "Informe Estado de Programas de las Asignaturas de "+carrera;
                              $('#tablaAsignaturas').DataTable({
                                    dom: 'Bfrtip',
                                    language: {
                                        url: '../lib/datatable/es-ar.json'
                                    },
                                    buttons: [
                                        {
                                            extend: 'excelHtml5',
                                            title: nombreArchivo
                                        },
                                        {
                                            extend: 'pdfHtml5',
                                            title: nombreArchivo
                                        }
                                    ]
                                });
              })
              .fail(function(){
                alert('Hubo un error al cargar la Vigencia de los programas de asignaturas');
              });
            });
                    
          });
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
                                    var carrera = $('select[name="carrera"] option:selected').text();
                                    var nombreArchivo = "Informe Estado de Programas de las Asignaturas de "+carrera;
                                      $('#tablaAsignaturas').DataTable({
                                            dom: 'Bfrtip',
                                            language: {
                                                url: '../lib/datatable/es-ar.json'
                                            },
                                            buttons: [
                                                {
                                                    extend: 'excelHtml5',
                                                    title: nombreArchivo
                                                },
                                                {
                                                    extend: 'pdfHtml5',
                                                    title: nombreArchivo
                                                }
                                            ]
                                        });
                              });
                            })
                            .fail(function(){
                              alert('Ocurrio un error al enviar la notificación.');
                            });
                
                
            }
    </script>
        
</html>
