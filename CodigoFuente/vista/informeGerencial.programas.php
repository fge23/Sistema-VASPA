<?php
include_once '../lib/ControlAcceso.Class.php';
ControlAcceso::requierePermiso(PermisosSistema::PERMISO_GENERAR_INFORME_GERENCIAL);
require_once '../modeloSistema/BDConexionSistema.Class.php';
include_once '../controlSistema/ManejadorAsignatura.php';
include_once '../controlSistema/ManejadorProfesor.php';
include_once '../controlSistema/ManejadorCarrera.php';

$manejadorCarrera = new ManejadorCarrera();
$carreras = $manejadorCarrera->getColeccion();

$manejadorProfesor = new ManejadorProfesor();
$profesores = $manejadorProfesor->getProfesoresResponsables();

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
        <link rel="stylesheet" href="../lib/datatable/dataTables.bootstrap4.min.css" />
        <script type="text/javascript" src="../lib/datatable/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="../lib/datatable/dataTables.bootstrap4.min.js"></script>
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
        <script type="text/javascript" src="../lib/datatable/extensiones/dataTables.buttons.min.js"></script>
        <script type="text/javascript" src="../lib/datatable/extensiones/buttons.flash.min.js"></script>
        <script type="text/javascript" src="../lib/datatable/extensiones/jszip.min.js"></script>
        <script type="text/javascript" src="../lib/datatable/extensiones/pdfmake.min.js"></script>
        <script type="text/javascript" src="../lib/datatable/extensiones/vfs_fonts.js"></script>
        <script type="text/javascript" src="../lib/datatable/extensiones/buttons.html5.min.js"></script>
        <script type="text/javascript" src="../lib/datatable/extensiones/buttons.print.min.js"></script>
        <link rel="stylesheet" href="../lib/datatable/extensiones/buttons.dataTables.min.css" />
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<!--        <style type="text/css">
            #chart_wrap {
    position: relative;
    padding-bottom: 100%;
    height: 0;
    overflow:hidden;
}

#piechart {
    position: absolute;
    top: 0;
    left: 0;
    width:100%;
    height:100%;
}
</style>-->
        <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Informe Gerencial de Programas</title>
    </head>
    <body>

        <?php include_once '../gui/navbar.php'; ?>

        <div class="container">
            <div class="card">
                <div class="card-header">

                    <h3>Informe Gerencial de Programas</h3>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                          <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Por Carrera</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Por Profesor Responsable</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <br>
                            <div class="row justify-content-md-center">
                                <div class="col-sm-5">
                                    <label for="carrera">Carrera</label>
                                    <select id="carrera" name="carrera" class="selectpicker" data-width="100%" data-live-search="true" required="" title="Seleccione carrera" data-none-results-text="No se encontraron resultados" data-size="5">
                                        <?php
                                        if (!empty($carreras)) {

                                                foreach ($carreras as $carrera) {
                                                    echo '<option value="' . $carrera->getId() . '">'.$carrera->getId().' - '.$carrera->getNombre().'</option>';
                                                }

                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="col-sm-2">
                                    <label for="anio">A&ntilde;o</label>
                                    <select id="anio" name="anio" class="selectpicker" data-width="100%" data-live-search="true" required="" title="Seleccione a&ntilde;o" data-none-results-text="No se encontraron resultados" data-size="5">
                                    </select>
                                </div>

                            </div>
                            <br>
                            
                            
                            <!-- Modal para mostrar el grafico de torta resumiendo la disponibilidad de los programas -->
                            <div class="modal fade bd-example-modal-lg" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalCenterTitle"><span id="titleProgCarrera"></span></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <div class="row justify-content-md-center" id="piechart"></div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                  </div>
                                </div>
                              </div>
                            </div>


                            <div id="tablaProgramasAsignaturas">
                                <div class="alert alert-info" role="alert">
                                    Para obtener el <b>informe Gerencial de Programas por Carreras</b>, seleccione una carrera y a continuaci&oacute;n
                                    un a&ntilde;o. Se le presentar&aacute; las asignaturas y su <b>disponibilidad para la comunidad universitaria</b>.

                                  </div>
                            </div>
                            
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            
                            <br>
                            <div class="row justify-content-md-center">
                                <div class="col-sm-4">
                                    <label for="profesor">Profesor Responsable</label>
                                    <select id="profesor" name="profesor" class="selectpicker" data-width="100%" data-live-search="true" required="" title="Seleccione profesor" data-none-results-text="No se encontraron resultados" data-size="5">
                                        <?php
                                        if (!empty($profesores)) {

                                                foreach ($profesores as $profesor) {
                                                    echo '<option value="' . $profesor->getId() . '">'.$profesor->getNombreCompleto().'</option>';
                                                }

                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="col-sm-2">
                                    <label for="anioProf">A&ntilde;o</label>
                                    <select id="anioProf" name="anioProf" class="selectpicker" data-width="100%" data-live-search="true" required="" title="Seleccione a&ntilde;o" data-none-results-text="No se encontraron resultados" data-size="5">
                                    </select>
                                </div>

                            </div>
                            <br>
                            
                            <!-- Modal para mostrar el grafico de torta resumiendo la disponibilidad de los programas -->
                            <div class="modal fade bd-example-modal-lg" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalCenterTitle"><span id="titleProgProf"></span></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <div class="row justify-content-md-center" id="piechart2"></div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div id="tablaProgramasAsignaturasProf">
                                <div class="alert alert-info" role="alert">
                                    Para obtener el <b>informe Gerencial de Programas por Profesor responsable</b>, seleccione el profesor y a continuaci&oacute;n
                                    un a&ntilde;o. Se le presentar&aacute; las asignaturas y la <b>disponibilidad del mismo en PDF para la comunidad universitaria</b>.
                                  </div>
                            </div>
                            
                        </div>
                    </div>
                    

                </div>
            </div>
        </div>

        <?php include_once '../gui/footer.php'; ?>
        
     <script>
         //PROGRAMAS SEGUN CARRERA
            $(document).ready(function(){
                  $('#carrera').change(function () {
                    var codCarrera = $('#carrera').val();
                    //alert(codCarrera);
                    $.ajax({
                      type: 'POST',
                      url: '../lib/consultaAjax/informeGerencial/cargaSelectAnios.php',
                      data: {'codCarrera': codCarrera}
                    })
                    .done(function(anios){
                      $(".selectpicker").selectpicker(); 
                      $('#anio').html(anios).selectpicker('refresh');
                      //$('#tablaProgramasAsignaturas').empty();
                    })
                    .fail(function(){
                      alert('Hubo un error al cargar los anios.')
                    });
                  });
                  
                  $('#anio').change(function () {
                      var anio = $('#anio').val();
                      if (anio != -1){ // value = -1 significa que la carrera no tiene planes con lo cual no se podra obtener los programas
                            var codCarrera = $('#carrera').val();
                            //alert(codCarrera+codPlan);
                            $.ajax({
                              type: 'POST',
                              url: '../lib/consultaAjax/informeGerencial/tablaProgramasPDFporCarrera.php',
                              data: {'codCarrera': codCarrera,
                                    'anio': anio}
                            })
                            .done(function(programas){
                              //$(".selectpicker").selectpicker(); 
                      
                              $('#tablaProgramasAsignaturas').html(programas);
                              var carrera = $('select[name="carrera"] option:selected').text();
                              var nombreArchivo = "Informe Estado de Programas "+carrera+", "+anio;
                              $('#tablaAsignaturas').DataTable({
                                    dom: 'Bfrtip',
                                    language: {
                                        url: '../lib/datatable/es-ar.json'
                                    },
//                                    buttons: [
//                                        'copy', 'csv', 'excel', 'pdf', 'print'
//                                    ]
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
                              //alert(programas);
                              // Modificamos el titulo del modal titleProgCarrera
                              var disponibilidad = 'Disponibilidad de Programas de '+carrera+', '+anio;
                              $('#titleProgCarrera').text(disponibilidad);
                              // mostramos modal con el grafico de torta
                              //$('#myModal').modal('show');
                            })
                            .fail(function(){
                              alert('Hubo un error al cargar los Programas de Asignaturas.')
                            });
                      }
                    
                  });
                  
              });
    </script>
    
    <script>
        // PROGRAMAS SEGUN PROFESOR RESPONSABLE
            $(document).ready(function(){
                  $('#profesor').change(function () {
                    var idProfesor = $('#profesor').val();
                    //alert(codCarrera);
                    $.ajax({
                      type: 'POST',
                      url: '../lib/consultaAjax/informeGerencial/cargaAniosProf.php',
                      data: {'idProfesor': idProfesor}
                    })
                    .done(function(anios){
                      $(".selectpicker").selectpicker(); 
                      $('#anioProf').html(anios).selectpicker('refresh');
                    })
                    .fail(function(){
                      alert('Hubo un error al cargar los anios.')
                    });
                  });
                  
                  $('#anioProf').change(function () {
                      var anio = $('#anioProf').val();
                      if (anio != -1){ // value = -1 significa que la carrera no tiene planes con lo cual no se podra obtener los programas
                            var idProfesor = $('#profesor').val();
                            //alert(codCarrera+codPlan);
                            $.ajax({
                              type: 'POST',
                              url: '../lib/consultaAjax/informeGerencial/tablaProgramasPDFporProfesor.php',
                              data: {'idProfesor': idProfesor,
                                    'anio': anio}
                            })
                            .done(function(programas){
                              //$(".selectpicker").selectpicker(); 
                              $('#tablaProgramasAsignaturasProf').html(programas);
                              var profesor = $('select[name="profesor"] option:selected').text();
                              var nombreArchivo = "Informe Estado de Programas del profesor "+profesor+" - año "+anio;
                              $('#tablaAsignaturasProf').DataTable({
                                    dom: 'Bfrtip',
                                    language: {
                                        url: '../lib/datatable/es-ar.json'
                                    },
//                                    buttons: [
//                                        'copy', 'csv', 'excel', 'pdf', 'print'
//                                    ]
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
                              //alert(programas);
                              // Modificamos el titulo del modal titleProgProf
                              var disponibilidad = 'Disponibilidad de Programas del profesor '+profesor+' - '+anio;
                              $('#titleProgProf').text(disponibilidad);
                              
                            })
                            .fail(function(){
                              alert('Hubo un error al cargar los Programas de Asignaturas.')
                            });
                      }
                    
                  });
                  
              });
    </script>
    </body>
</html>


