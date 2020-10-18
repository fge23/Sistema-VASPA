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

// Obtenemos el nombre del usuario de la sesion
$Usuario = $_SESSION['usuario'];
$nombreUsuario = $Usuario->nombre;

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
                            
<!--                            <div ><div id="piechart" ></div><br></div>-->
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
                                    <!--<div class="row justify-content-md-center" id="piechart" style="width: 900px; height: 500px;"></div>-->
                                  <!--<div id="piechart" style="width: 900px; height: 500px;"></div>-->
                                  <div id="piechart" ></div>
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
                                    un a&ntilde;o. Se le presentar&aacute; las asignaturas y su <b>disponibilidad para la comunidad universitaria</b>.
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
                              var nombreArchivo = "Informe Estado de Programas PDF "+carrera+", "+anio;
                              //fecha
                              var now = new Date();
                              var jsDate = now.getDate()+'/'+(now.getMonth()+1)+'/'+now.getFullYear();
                              //nombreusuarioEmisor
                              var emisor = '<?php echo $nombreUsuario; ?>';
                              var tituloExcel = 'Informe Gerencial - Sistema VASPA | Carrera: '+carrera+'. Año: '+anio+' | Fecha: '+jsDate;
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
                                            title: tituloExcel,
                                            text: 'Generar Excel',
                                            filename: nombreArchivo
                                        },
                                        {
                                            extend: 'pdfHtml5',
                                            title: nombreArchivo,
                                            text: 'Generar PDF',
                                            messageTop: 'Sistema VASPA\nFecha de emisión: '+jsDate+'\nUsuario emisor: '+emisor+'\nDescripción: en este informe se detalla qué programas PDF se encuentran disponibles en el Sistema VASPA para su consulta por parte de la Comunidad Universitaria. ',
                                            customize: function(doc) {
						doc.content.splice(0,1);
                                                var logoUnpa = 'data:image/png;base64,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';
                                                var logo = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAHgAAAB4CAYAAAA5ZDbSAAAUgElEQVR42u1dCVSTx9pWa5drqwICEggQICQhJCEhQEAChE1WEUVa99pq0Wurx71uven2/wKBELYQNhEQ1NQqu+KGS6u27ld7ra23699qte3V1rqbue+HBiaBDwJi77n/meecOcmXzMw3M8877zb5YNAgAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICgj8Ly86g51efRaOVbei5dYeQ9coTiP3aIcSZsgeJXmxDUdMOoNeT25AuYic6HtBkuCppQLd96tEDYT0yQHng24DuyZrQN9E7kealNiRI1aOn8P7TjqNhsw+i5LG7DLv8Gw2/YW0NkkZkENcbbgQ0ocsRrehszC5UOmU/WhG7C8XPOYQU4fsQ9yUYy/wDyBnGN1R5ClktPY5sBynREMKcJUBoSOxuJIdFLV17EiW9dhhNmNhmaA1rMbQFNhkOKVoMV/waEOJvR0hQB6X+YRFipf1z+F5YhwzyJvTP5D0oEUh9muqeIju0BUmAwG1ArIGqK6zvWtr7eFSoe1H3jN+N7kob0EEYR1twMyqliE1oRWMS96DcWCCekGcBxNuRlbgerYpsNVxZfgItn9yGlsFO7ZaE3oqRaEk9ugwkL6H6H7cPhQW3oONG8vrTL1VE9YbTc44iZmATSgpqQiioEekIexaABQQLBohgfCeK6lAz1T+/Hr3qvb3//XVHcEAjCFEdIfg/QnAHIYRgQjAhmBBMCCYEExCCCcGEYEIwIZgQTAgmBBOCCcGEYEIwIZgQTEAIJgQTggnBhGBCMCGYEEwIJgQTggnBBIRgQjAhmBBMCCYEE4IJwYRgQjAh+M8mGH9+CHsU5UE3n3Uh2KzOA1E9ut/e9tHzSr092kIIfoIEGxffuw4ZpI3oDpDzg7gO/QM+OyZpQB9J6tEx/nZ0SlRnuOTziHCcYOphMupz30b0q6DOcA6++wje74e2R6DtWXE9+gZef6FIxwknBD9hgo0LLW5A94C8H/nbDYdf2o+2R+xAczZ+ifiDEBps7CftOBoZtRO9IW82HAISLxkJ5j4k+FpICzo29QD6n1lHkSd+/3/+ilymH0TJKfvRO+J6QysQ98WYZnSbEiYTjUAIHkCCd7Q/ImoAYq/JmtAXcN0S3owWBmxDo3rrj6oT0IRWB7cYSqhrv2aUAtcbguqQ0JLxgBDEv34Y1fK3GXaAoFyEXX2vXSMQggeG4Jc/Qovjdht+hEXdF9qCslYeR6m1F5BtX/pUHke2/3sOBbe/P4JYyhNI1OeBKdEQcSOaJmtAelmj4VxwCzo47zRyIgT3k+CwHejXuUcM2XOPoCWwiyrj9qDk1ANI+J8uYBL8X/sYrYUx6aZ+jELDWtAC6uFwQrCFoB4ABzW4yq8R3QZV/FlIi6Ghr0X+qAx03e5KYJPhE3DIqL8AQAi2BIkNaJi0AU3l16EjVBH0owjr0NGgZsMlS57gf+iNGy4K+nkvaoww3n0xO9E8wp4FQOAJh+xEDI9tKILbzyLYjsZO24+KLCFYXN/ulau4j3E/sMeByjPInrD3J0EJDtGak8hv7C60B+LbHktAMyqS70Q+ZNX+y0D9VZ0lR1Egtbt6Kv7NyIGsFgEBAQEBAQEBAQEBAQEBAQEBwX8FGndeCCCr8P8YodEbrs5d0HzZWNLeaDoza972GZa2nzu/cSa0O4v3sXDpziM9tVmnPuQ+ffZ2bWRs1WW8RMRUXp45p16/fO0uz77NQv9UaFSVV2hMZbowoPgYwz3nt1FOKmTDyESjXbNvycLKrwr8dJVvrt27eM37e50GDVIOxVtTp1y1285Gw9wv4/PAS9KL+v32rOwMJ4+s96a9unX5amWb4FE/g/sy0umvfugzcfLmveZzD4e5p0zZum716oOMASXYU5B/erh9BhrpkIlGjM5A1k6q22xh/maLBq5EQ7gS7d5RzKwHVHtjH4Fh5Tt6ahYgX5/IFuR/T9U1tjMWG2bmVYabOsTS8UdOqBwlGaN7k8lW36L6665P4+dUcfbU/OHhlVvC5KttOsRDj56q2HhmTXdt6fqyc8m+7crJ3RoQVh4UF9fyrIXDHeziqY4CoftX13tRY8vZL5Do/AaU4DGK8rfxm1HvbZxUn0yd3ezaW9vZ81okNk6Zfze2fzj5zPuvLawbQ9cmLa1hGIutWTzCPr3L4lPX1gzV/dhxm9IaGn4Y1tv93aXFI104+SvNicWvu/uOyc655uFR6Nwfgs3v4c7Pux4QWj5TmtjQ63hnztw2yjew5P3hNHMHzXOXzS+YBjtn4P4JSOyEWrmHd/51fEFsnbO+l4WWp/XWNiRq/V/tXLJ+wNs6c3K+B6VHu/vjkjd78MW6amyhHkAxUBJMXVOTlwSWHIxOrOlRTSsUbUP5voWxxnbG+8OrYSQj45aVQ+Y1K0bmNRtH1Q1rRuZ940JS/YdFVyxJTdX/pSeCqfdWD1U8Gs1SI3uXbGTt2L3AcETaWyFRGyKhz6d6GrOXqEjgxss7g7WnxnXfeE2NjSvWaidO+5A5YATPmrXdShCgK8OlytZZdcvbt6hCb/Yva0x3YvHTPgHFDXbO2R0DHAmv0uDSSnr1jgZzhPlxDI+cHzsJybjFcFf/ZueafbfDTDhmXnflFQT1JCips/QOEfEbm8y0h8HeRXXFmZ2zhSMqVPLEhUppcJkWBPggwz37ayvHzCtgm6+7cTUifIx0BDux1ddjkmrOxE+oPRUeV3nK3Tv/tBUj42soN80FC+ZdEROjt6EdL5AvluniHdzVd41CAuv8s6OH+v+sQGsZP/PwzjsbGF4WPGAEUzth8kz9JEo6cRXk6J5zcPnavR507VKm1PJAPR/BF8XaQXU3JWWTH71Q6Ed6iYtWvGDXKUyUBgiQl7e68/MvGvuhdg5ohzdmLGt9nq4vrkjLdfHUmCzyaNes30UBuveLi48/jdc9dw49oyk4Fi2U6pYAUZrIpNrRJi4aDcHgm7TY2mYM73A5lG3P+SnKoxge6n1A8D28Poz/pl9wObcngQyJ3lCBz93RI+dT36CSLSDgV4192btmIR+ZNm3x4k4N89iYAI4KSPxlfDfYOWddlIWsn05ruyPKX4EF/dooye32yCvvq9EiFS0p8shKjpe4sBG/D8enYC94jyngqH2Af87yyj3qJimg9QOYvHzhsFHrTAjxFBacWLF6d0xf528pwUb4BBW/Aar7B7z+87brkDyqQkGnpp142RzQCOfxne/E1myNTa6ZzeLlfoqraTY/v8w/dL3zgBEcFKT+i7+8tBhX0zagJsGByG5rQ0PN6y9Y0PIsqL0SIOUmviBBivKiuLg8Go9SOcRLrE0AL/Z2px3LuMcTa1V6/dcOIMVFoKruYo7eLVFgsUyp7N7hcGEXeBvHa2zjwsm9GD9x04wnTfDU2fWhTE/NUXOCnTyyw2GvdiFYKgVzFlSSCOt1z9g32PSbPJ/CrPdUB9wgoiij7LHxOzd+/rcyRbkcITR4gNS0cmjKlC0p4Fzdx9WkC0ez641lrW7m9V9ZUMd3YKn3mzhmzKzb8SmbZHR2U5FcYcWTFK58wW5dRxt7CBc8+HkL24Uscv1cUFnfdkp4BlLEVr6X9Gr98G4dFrHOE0K8X/AxWDuqDLCzGt35GnnC1CbrJ0Vw2sKmcBa3c9e1EwzaxNU7t1uCFYpaW98xpZvxDQQm8II8YsOUdmHlahbC2nfMhTKXYlnJ/Bkz6E1UnxGRWOnkKSz8El8wB1b2eXl0VWoXz3tczSxHtuYrvC7Xp+ALjrSY9rGTyLiNfL6k6CO8DWiIU4kpNfHtIdfsJi8Ht+w9+PdsQd53bFEeky7kiEqoLjbfxeBB34GxHfeW6taGxVSEpILdH2iC/eSlaRCrf2taPx0FyouCu9E4gxVja3kQp5tEG/YsdWtiSi2PqhAcXp7E9Mw50/l9OvKSFH4oDS52GTCCg4PLh/sGFefgUgYO0HWuoPB9U0fp+NNcUWEu2OibnRPMQKHRFRpFqv4FOkfON1A3DtSwSbzs5KnRLVbutDHGxy7c3C2jmKpOZw/ISp60qVu7Ri2kIrrKj+mpvtCVmPT2DJanqOAo369QGTeuNuxVGk3QF4JhHCOF/iVho13VDSMZmXfw+uBL/BKbVM3txnt+JiK+ahY4pHie4Y6bV16pWn243ZFatGi3O9s7fyulNY39AeFXhJKeI4k+e9NBISUxcPM/OrxiUHngqW6dnrazI30WlVjpAu59A+5cUfYkNrFWrqT5L50KRYUVxKxvm4ZiWb+7cnPXmAhZVMVKEIIruKRHxVfXptIIzrRpG0fIIyvmj2ZlXzRm47ojGmzcYVlI2aq4uI3MPhL8d1CXrzNY2XNZHM1iWItMJ4+cI7AuN83rBkeuL4tJ7RomUckYtrCgHp87mLdvA0LK52Gp0iFuXvlvUSEcvmmk8tKldHPvF8B2ubhxc4/hA3dwyzktj6gY1+E9R21IgTj2HE6Ct7ToM3//QlqvjwofIIw4i7cBu3Mhelz1FLxe/Hi90MYp62O8nitHc82JVzCK3kEssxHKdGmuvNzDoDa7pCqxFOU1GMP6qPgKoblGoCN4hEPGHYh5r4Jz9Cv4C3fpEh0Q2571kmkDB3XVNIOnzGrgwQa4gteHUOhw8lS9FK8okZVOAmH8Bz53oZ/u4IB609ROEwaUpJup6V/Z3gVvPlyIc894+xZl2Ltk/YFLWkRMZTqdraM0g8C3KJFK/mN51wfOnJwtK1a0meyo+fP1LzBY6mZrhgk59xIm1oT3pKpmzKh6PiymMpwrKshx5WrOAxndEkGpSdiFDXwQ5N4ItiRVScW0zhzNl9LgktkKReEL3XnPicm1K/B21k6qu+Dtb3kzfbfJes1ftNsLNNoOE0FgZf9GedO9Zcj6pKZF/rpYO+fsG1i67gGLl1cxb1mr/eRZ21mgoj40k8brQSHrw+gGkTC1xloO6stMhT4AU3AaPMkCvDizc7QMt+yv8KQLdQ+fAF0jn698prfxSxXFttIxxQk8SVEWOHAXbJ2zDeZ5adiRSBJUolIoOlUf7Q7u4eACfJBLTp45m8DhmpKQoO3WY2dIlcP4vtpP8bmDer8HZuis+dxBu5SBqfnC/F7iwGLl2LFVA+dNU+GHhyDvCG5jQUo/iRlfExUeWxXj6KE5ZqJCeXn7uaJ8N1rnLbycC6HQla553gxEOVTmBXc0jHUZrJwbg1jK5yydw9gJVfa+QSUx7l55BdDnD5RGwsdMZY7csV1MR7A1Q3XNlZN7isXLPwEEnGDxctu8JNoPQXWms7zyXqJMD+VE0Y1j6qytnqbarjME7X7u7bkB0zy3T+FJD1HRwD38NgHCD0lQ8brh9uuwBcn5UehXNBds3SJHd/XPuHoW+emWg/Myovv8nP4pjkQbZ6na6+HU5sFfF7ak9XUuIlkeUzKm5D3YGT/ii0wR7sLO4hvz0XQEw+sRL3FBtNivKFgcWBQslGmlUROqvBasarGzRG2CcL+LE9afudsyVbdfnLE1fgDVtHKoQKpNgJj0986keNZdSWBJHldSqAMV05EMcXDN+pkn0YbRZZuo0EsWVq63RPV1pwbxa2+J9kx/5pM0eZMjqNMW04XOQEx3tbA3guniYEsBmvDzx597OgoIKc0D/+i5AdvFspD1fI6o4CC+U0E1Heb6FB7FVR3Ecrt5AQUcun6SkzdzHNzUJkeR4Gz9zhEVnoMQ4ChdEcl0J0Byb+ATtXHMvHX+/G8d3nRQTJlNZEy1RT8MsHZI32y+k9x5T5bgt97dJ4XNcMds7jcE/rqTPc2dLSj4kkrTmq3zV2x23ogBI/iVV1rsJEGl63Bv2oWj+YMqxhtTdsQ3SLd8wYKWEXTHY7ETal/uegSnOTFrbuO48KRqLl2JGrcxcIRD+memajXDMHtuncp47MjkakR2rlmfuwvyG4IjKuaBMHV78hUaWznf0UP9vXne2I2r4fY3k2UJ5BEbKk13a7vPcSYhuSagp7lHJtTMBpNyASeYylNPnKxP6uvPgwb1dHbJl+nGMzk5HWqacgCoYrwGW3yFsk904QtI3LO+Y4oPmHqwmfdgsTfn5X3Z409cqGwZaJCjNlhoRQkbk635xkiwg7vGnzrcp8IO8Lp/gh3/OZOd0ybwK6qKHV9TpYjZUAV97IHF+sl43mochyhAd0kiKXd8kgTDWL8zO5277R9auoUuGWTEUmWbLcTsu/BIgpq7X3BZTXd57n4jfGy1j5e4sA3/WUlHgRt6CvNb/cNLvOnaj0vVuwGht00OJFxU1wXSwiyLnL2X9MvxBPyjw4Q7EIs7YAR32ixKgBwy79k4qm5CmHeTOumiyKeEwJy4mPGbZiiV5555UgT/7f29E6hfauB9Ud58bFL1dEt+t8WXavNAYH83U9M31OrDNgNG8DJlq71UXpaOJ/M7YzlQz/LiFUplC61dSJ2iX2K+YI4eOZ8venN3gkU/JUrexBoxOvMLsz4ehI6tLMQJpnNQ6H6nFZNUm7N0aZvt4xw29AaIsxu6eOSMjPOLVu52t+j4NrxiKuz4r0xUPLyPNcv8PS4G+/jrJrJ4edfMF9HFU/MTxMvxPSYdgktNTlsoNenAym4Gj3uoJTenzpwhhjxndm+DDVP1HfW9b1AZ21NUcJKybb0lJSghdWCpz0FINyluWteQbqAJBkG+ZOIgOmXd95EV7bPUhq5Zs9cJtNcRk5jYPgPxfQvqB/QXlxERlU5eYu0csIXv4sXNO3eOT1CRE127iopTViMc09/B29gys/7m6pmd0idvXrF+kq1L1t86+mFmvWPnrFrVYauVDcNWvbsvePykLSqeT8FWvq/284DQMgRxPPKRlfyLLyk8yfPRFidN+mDyvHmttMkC6mC9uvqzEPAxOsZLvR/ByASV2nsGDYdWe4xr5aR6C5/7aLecNZOmfTC2L/1Ig8tednBXv2OcN1V44sK3BxEQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEDwe/g38llYYETAjtAAAAABJRU5ErkJggg==';
                                                // margin: [left, top, right, bottom]
						doc.pageMargins = [40,100,40,30];
						// Set the font size fot the entire document
						//doc.defaultStyle.fontSize = 10;
						// Set the fontsize for the table header
						//doc.styles.tableHeader.fontSize = 10;
						doc['header']=(function() {
							return {
								columns: [
									{
										image: logo,
										width: 50
									},
									{
										alignment: 'center',
										fontSize: 14,
										text: [
                                                                                        { text: 'Estados de Programas PDF\n\nCarrera: '},
                                                                                        { text: carrera, bold: true },
                                                                                        { text: '. Año: '},
                                                                                        { text: anio, bold: true }
                                                                                      ]
									},
                                                                        {
										image: logoUnpa,
										width: 30
									}
								],
								margin: 40
							}
						});
                                                
                                                doc.footer = function(page, pages) {
                                                  return {
                                                    margin: [5, 0, 10, 0],
                                                    height: 30,
                                                    columns: [
                                                    {
                                                       alignment: "center",
                                                       text: [
                                                         { text: page.toString(), italics: true },
                                                           " de ",
                                                         { text: pages.toString(), italics: true }
                                                       ]
                                                    }]
                                                  }
                                                }   
                                              }
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
                              var nombreArchivo = "Informe Estado de Programas PDF del profesor "+profesor+" - año "+anio;
                              //fecha
                              var now = new Date();
                              var jsDate = now.getDate()+'/'+(now.getMonth()+1)+'/'+now.getFullYear();
                              //nombreusuarioEmisor
                              var emisor = '<?php echo $nombreUsuario; ?>';
                              var tituloExcel = 'Informe Gerencial - Sistema VASPA | Profesor: '+profesor+'. Año: '+anio+' | Fecha: '+jsDate;
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
                                            title: tituloExcel,
                                            text: 'Generar Excel',
                                            filename: nombreArchivo
                                        },
                                        {
                                            extend: 'pdfHtml5',
                                            title: nombreArchivo,
                                            text: 'Generar PDF',
                                            messageTop: 'Sistema VASPA\nFecha de emisión: '+jsDate+'\nUsuario emisor: '+emisor+'\nDescripción: en este informe se detalla qué programas PDF se encuentran disponibles en el Sistema VASPA para su consulta por parte de la Comunidad Universitaria. ',
                                            customize: function(doc) {
						doc.content.splice(0,1);
                                                var logoUnpa = 'data:image/png;base64,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';
                                                var logo = 'data:image/png;base64,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';
                                                // margin: [left, top, right, bottom]
						doc.pageMargins = [40,100,40,30];
						// Set the font size fot the entire document
						//doc.defaultStyle.fontSize = 10;
						// Set the fontsize for the table header
						//doc.styles.tableHeader.fontSize = 10;
						doc['header']=(function() {
							return {
								columns: [
									{
										image: logo,
										width: 50
									},
									{
										alignment: 'center',
										fontSize: 14,
										text: [
                                                                                        { text: 'Estados de Programas PDF\n\nProfesor: '},
                                                                                        { text: profesor, bold: true },
                                                                                        { text: '. Año: '},
                                                                                        { text: anio, bold: true }
                                                                                      ]
									},
                                                                        {
										image: logoUnpa,
										width: 30
									}
								],
								margin: 40
							}
						});
                                                
                                                doc.footer = function(page, pages) {
                                                  return {
                                                    margin: [5, 0, 10, 0],
                                                    height: 30,
                                                    columns: [
                                                    {
                                                       alignment: "center",
                                                       text: [
                                                         { text: page.toString(), italics: true },
                                                           " de ",
                                                         { text: pages.toString(), italics: true }
                                                       ]
                                                    }]
                                                  }
                                                }   
                                              }
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
    <script>
        // arregla alineacion del grafico de torta en el modal
    $('#myModal1').on('show.bs.modal', function(e) {
        // se llama al metodo que agrega el grafico de torta despues de unos segundos de retraso, en el evento modal show
        setTimeout(
        function() 
        {
          drawChart();
        }, 200);

    })
    
    $('#myModal2').on('show.bs.modal', function(e) {
        // se llama al metodo que agrega el grafico de torta despues de unos segundos de retraso, en el evento modal show
        setTimeout(
        function() 
        {
          drawChart();
        }, 200);

    })
    </script>
    </body>
</html>


