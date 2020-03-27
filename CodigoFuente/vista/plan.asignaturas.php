<?php
include_once '../lib/ControlAcceso.Class.php';
include_once '../controlSistema/ManejadorAsignatura.php';
include_once '../modeloSistema/Plan.Class.php';

$manejadorAsignatura = new ManejadorAsignatura();

// Obtenemos todas las asignaturas de la BD
$asignaturas = $manejadorAsignatura->getColeccion();

// Falta validar el GET ¿Pero para que tanta validaciones? No es la parte mas importante del sistema
$idPlan = $_GET['id'];
$plan = new Plan($idPlan);
if (is_null($plan->getAnio_fin())){
    $periodo = ' ('.$plan->getAnio_inicio().' - Presente)';
} else {
    $periodo = ' ('.$plan->getAnio_inicio().' - '.$plan->getAnio_fin().')';
}

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
        <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Planes</title>

    </head>
    <body>

        <?php include_once '../gui/navbar.php'; ?>

        <div class="container">
            <div class="card">
                <div class="card-header">

                    <h3>Asignaturas del Plan: <span class="text-info"><?= $plan->getId().$periodo;?></span></h3>
                </div>
                <div class="card-body">
                    <div id="mensajeResultado"></div>
                    <p> <form id="form">
                        <input type="hidden" id="codPlan" name="codPlan" value="<?=$plan->getId();?>">
                        <div class="row justify-content-md-center">
                            <div class="col col-sm-5">
                                <label for="asignatura">Asignaturas</label>
                                    <select id="asignatura" name="codAsignatura" class="selectpicker" data-width="100%" data-live-search="true" required="" title="Seleccione una asignatura" data-none-results-text="No se encontraron resultados">
                                        <?php foreach ($asignaturas as $asignatura) { ?>
                                        <option value="<?= $asignatura->getId(); ?>"><?= $asignatura->getId().' - '.$asignatura->getNombre(); ?></option>
                                    <?php } ?>
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
                    <div id="tabla"></div>
                </div>
                <div class="card-footer text-center">
                        <a href="planes.php">
                        <button type="button" class="btn btn-primary">
                            <span class="oi oi-account-logout"></span> Volver A Planes
                        </button>
                        </a>
                    </div>    
            </div>
        </div>
        <?php include_once '../gui/footer.php'; ?>

        <script type="text/javascript">
            $(document).ready(function(){
                var codPlan = $("#codPlan").val();
		$('#tabla').load('../lib/consultaAjax/planAsignatura/asignaturasDelPlan.php?id='+codPlan);
            });
        </script>
        
        <script type="text/javascript">
            // detenemos el envio del formulario (para que valide los campos requeridos)
            $('#form').on('submit', function (event) {
                event.preventDefault(); // se previene la acción por defecto
                //console.log($(this).serialize()); // serializa los datos del formulario (name->valor)
                // realizar petición AJAX
                var codAsignatura = $("#asignatura").val();
                var codPlan = $("#codPlan").val();
                //console.log(codAsignatura);
                //console.log(codPlan);
                $.ajax({
                    type: 'POST',
                    url: '../lib/consultaAjax/planAsignatura/asociarAsignaturaPlan.php',
                    data: {codAsignatura: codAsignatura,
                            codPlan: codPlan}
                })
                .done(function(resultado){
                    $('#mensajeResultado').html(resultado);
                    $('#tabla').load('../lib/consultaAjax/planAsignatura/asignaturasDelPlan.php?id='+codPlan);
                    //alert(resultado);
                    //$('#carrera').html(carreras).selectpicker('refresh');
                })
                .fail(function(){
                    alert('Error en el servidor');
                });
            });

        </script>
        <script type="text/javascript">
            function eliminar(codAsignatura){
                //console.log(codAsignatura);
                //var codAsignatura = $("#asignatura").val();
                var codPlan = $("#codPlan").val();
                //console.log(codAsignatura);
                //console.log(codPlan);
                $.ajax({
                    type: 'POST',
                    url: '../lib/consultaAjax/planAsignatura/eliminarAsignaturaPlan.php',
                    data: {codAsignatura: codAsignatura,
                            codPlan: codPlan}
                })
                .done(function(resultado){
                    //$('#modalEliminar'+codAsignatura).modal('hide');
                    // El siguiente codigo oculta el modal backdrop que queda
                    $('#modalEliminar'+codAsignatura).modal('hide');
                    if ($('.modal-backdrop').is(':visible')) {
                      $('body').removeClass('modal-open'); 
                      $('.modal-backdrop').remove(); 
                    };
                    $('#mensajeResultado').html(resultado);
                    $('#tabla').load('../lib/consultaAjax/planAsignatura/asignaturasDelPlan.php?id='+codPlan);
            
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