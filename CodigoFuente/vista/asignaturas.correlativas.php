<?php
include_once '../lib/ControlAcceso.Class.php';
include_once '../controlSistema/ManejadorAsignatura.php';
include_once '../modeloSistema/Asignatura.Class.php';

$manejadorAsignatura = new ManejadorAsignatura();

// Obtenemos todas las asignaturas de la BD
$asignaturas = $manejadorAsignatura->getColeccion();

// Falta validar el GET ¿Pero para que tanta validaciones? No es la parte mas importante del sistema
$idAsignatura = $_GET['id'];
$asignatura = new Asignatura($idAsignatura);

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
        <link rel="stylesheet" href="../lib/datatable/dataTables.bootstrap4.min.css" />
        <script type="text/javascript" src="../lib/datatable/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="../lib/datatable/dataTables.bootstrap4.min.js"></script>
        <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Asignaturas Correlativas</title>

    </head>
    <body>

        <?php include_once '../gui/navbar.php'; ?>

        <div class="container">
            <div class="card">
                <div class="card-header">

                    <h3>Asignaturas correlativas de: <span class="text-info"><?= $asignatura->getId();?> - <?= $asignatura->getNombre();?> </span></h3>
                </div>
                <div class="card-body">
                    <p> <form id="form">
                        <input type="hidden" id="idAsignatura" name="idAsignatura" value="<?=$asignatura->getId();?>">
                        <div class="row justify-content-md-center">
                            <div class="col col-sm-5">
                                <label for="asignatura">Asignaturas</label>
                                    <select id="asignatura" name="codAsignatura" class="selectpicker" data-width="100%" data-live-search="true" required="" title="Seleccione una asignatura" data-none-results-text="No se encontraron resultados">
                                        <?php foreach ($asignaturas as $asignatura) { ?>
                                        <option value="<?= $asignatura->getId(); ?>"><?= $asignatura->getId().' - '.$asignatura->getNombre(); ?></option>
                                    <?php } ?>
                                    </select>



                                <label for="requisito">Requisito</label>
                                    <select id="requisito" name="requisito" class="selectpicker" data-width="100%" data-live-search="true" required="" title="Seleccione un requisito" data-none-results-text="No se encontraron resultados">
                                        <option value="Aprobada">Aprobada</option>
                                        <option value="Regular">Regular</option>
                                    </select>


                                <label for="tipo">Tipo de Correlatividad</label>
                                    <select id="tipo" name="tipo" class="selectpicker" data-width="100%" data-live-search="true" required="" title="Seleccione el tipo de correlatividad" data-none-results-text="No se encontraron resultados">
                                        <option value="Precedente">Precedente</option>
                                        <option value="Subsiguiente">Subsiguiente</option>
                                    </select>

                            </div>
                            <div class="col col-sm-2">
                                <button type="submit" class="btn btn-success">
                                    <span class="oi oi-plus"></span> Agregar Asignatura
                                </button>
                            </div>

                        </div>
                    </form>
                    </p>

                    <div id="aviso"></div>

                    <div id="tabla"></div>

                </div>
                <div class="card-footer text-center">
                        <a href="asignaturas.php">
                        <button type="button" class="btn btn-primary">
                            <span class="oi oi-account-logout"></span> Volver a Asignaturas
                        </button>
                        </a>
                    </div>    
            </div>
        </div>
        <?php include_once '../gui/footer.php'; ?>






        <script type="text/javascript">
            //$(document).ready(function () {
                $('#tablaAsignaturas').DataTable({
                    language: {
                        url: '../lib/datatable/es-ar.json'
                    }
                });
            //});
        </script>

<!-- Script que lista asignaturas correlativas, funciona correctamente -->

        <script type="text/javascript">
            $(document).ready(function(){
                var idAsignatura = $("#idAsignatura").val();
		$('#tabla').load('../lib/consultaAjax/asignaturaCorrelativa/correlativasDeAsignatura.php?id='+idAsignatura);
                $('#tablaAsignaturas').DataTable({
                    language: {
                        url: '../lib/datatable/es-ar.json'
                    }
                });
            });
        </script>


<!-- Script que inserta asignaturas correlativas, funciona correctamente -->

        <script type="text/javascript">
            // detenemos el envio del formulario (para que valide los campos requiros)
            $('#form').on('submit', function (event) {
                event.preventDefault(); // se previene la acción por defecto
                //console.log($(this).serialize()); // serializa los datos del formulario (name->valor)
                // realizar petición AJAX
                
                //Este corresponde al ID de la asignatura actual. 
                 var idAsignatura = $("#idAsignatura").val();

                 //Este es el ID de la lista desplegable, asignatura que quiero agregar.
                var idAsignaturaCorrelativa = $("#asignatura").val();
               
               //Es el requisito de la asignatura
               var requisito = $("#requisito").val();

                //Es el tipo de asignatura correlativa
                var tipo = $("#tipo").val();


                //console.log(idAsignatura);
                //console.log(idAsignaturaCorrelativa);
                //console.log(requisito);
                //console.log(tipo);
                $.ajax({
                    type: 'POST',
                    url: '../lib/consultaAjax/asignaturaCorrelativa/asociarCorrelativaDeAsignatura.php',
                    data: {idAsignatura: idAsignatura,
                    idAsignaturaCorrelativa: idAsignaturaCorrelativa,
                    requisito: requisito,
                    tipo: tipo}
                })
                .done(function(resultado){
                    $('#tabla').load('../lib/consultaAjax/asignaturaCorrelativa/correlativasDeAsignatura.php?id='+idAsignatura);
                    
                    //alert(resultado);
                    $('#aviso').html(resultado);
                    //$('#carrera').html(carreras).selectpicker('refresh');
                })
                .fail(function(){
                    alert('Error en el servidor');
                });
            });

        </script>



     <!-- Script que elimina asignaturas correlativas, funciona correctamente -->



        <script type="text/javascript">
            function eliminar(codAsignatura, requisito, tipoCorrelatividad){
                //console.log(codAsignatura);
                //var codAsignatura = $("#asignatura").val();
                
                //Este es el id de la asignatura actual.
                var idAsignatura = $("#idAsignatura").val();


           //Este es el codigo de la asignatura a eliminar (correlativa)
                //console.log(codAsignatura);
                
                //console.log(requisito);
                //console.log(tipoCorrelatividad);
                
                $.ajax({
                    type: 'POST',
                    url: '../lib/consultaAjax/asignaturaCorrelativa/eliminarCorrelativaDeAsignatura.php',
                    data: {idAsignatura: idAsignatura,
                        codAsignatura: codAsignatura,
                        requisito: requisito,
                        tipoCorrelatividad: tipoCorrelatividad}
                })
                .done(function(resultado){
                    //$('#modalEliminar'+codAsignatura).modal('hide');
                    // El siguiente codigo oculta el modal backdrop que queda
                    $('#modalEliminar'+idAsignatura).modal('hide');
                    if ($('.modal-backdrop').is(':visible')) {
                      $('body').removeClass('modal-open'); 
                      $('.modal-backdrop').remove(); 
                    };
                    $('#tabla').load('../lib/consultaAjax/asignaturaCorrelativa/correlativasDeAsignatura.php?id='+idAsignatura);
            
                    //alert(resultado);
                    //$('#carrera').html(carreras).selectpicker('refresh');
                })
                .fail(function(){
                    alert('Error en el servidor');
                });
            }
        </script>

    </body>
</html>