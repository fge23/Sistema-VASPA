<?php
include_once '../lib/ControlAcceso.Class.php';
include_once '../controlSistema/ManejadorProfesor.php';
include_once '../modeloSistema/Asignatura.Class.php';
include_once '../modeloSistema/Profesor.Class.php';

$manejadorProfesor = new ManejadorProfesor();

// Obtenemos todos los profesores de la BD
$profesores = $manejadorProfesor->getColeccion();

// Falta validar el GET ¿Pero para que tanta validaciones? No es la parte mas importante del sistema
$idAsignatura = $_GET['id'];
$asignatura = new Asignatura($idAsignatura);

$profesor = new Profesor($asignatura->getIdProfesor());
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
        <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Equipo de C&aacute;tedra de <?= $asignatura->getNombre(); ?></title>

    </head>
    <body>

        <?php include_once '../gui/navbar.php'; ?>

        <div class="container">
            <div class="card">
                <div class="card-header">

                    <h3>Equipo de C&aacute;tedra de: <span class="text-info"><?= $asignatura->getId().' - '.$asignatura->getNombre();?></span></h3>
                </div>
                <div class="card-body">
                    <div id="mensajeResultado"></div>
                    <p> <form id="form">
                        <input type="hidden" id="codAsignatura" name="codAsignatura" value="<?=$asignatura->getId();?>">
                        <div class="row justify-content-md-center">
                            <div class="col col-sm-4">
                                <label for="profesor">Asignaturas</label>
                                    <select id="profesor" name="idProfesor" class="selectpicker" data-width="100%" data-live-search="true" required="" title="Seleccione un Profesor" data-none-results-text="No se encontraron resultados">
                                        <?php foreach ($profesores as $profe) { ?>
                                        <option value="<?= $profe->getId(); ?>"><?= $profe->getApellido().', '.$profe->getNombre(); ?></option>
                                    <?php } ?>
                                    </select>
                            </div>
                            <div class="col col-sm-3">
                                <label for="rol">Rol</label>
                                <select id="rol" name="rol" class="selectpicker" data-width="100%" required="" title="Seleccione un Rol">
                                    <option value="teoria">Teor&iacute;a</option>
                                    <option value="practica">Pr&aacute;ctica</option>
                                </select>
                            </div>
                            <div class="col col-sm-2">
                                <button type="submit" class="btn btn-success">
                                    <span class="oi oi-plus"></span> Agregar Profesor
                                </button>
                            </div>

                        </div>
                    </form>
                    </p>
                    <div id="tabla">asd</div>
                </div>
                <div class="card-footer text-center">
                        <a href="asignaturas.php">
                        <button type="button" class="btn btn-primary">
                            <span class="oi oi-account-logout"></span> Volver A Asignaturas
                        </button>
                        </a>
                    </div>    
            </div>
        </div>
        <?php include_once '../gui/footer.php'; ?>

        <script type="text/javascript">
            $(document).ready(function(){
                var codAsignatura = $("#codAsignatura").val(); // obtenemos id Asignatura
                // cargamos el equipo de catedra de la asignatura mediante peticion ajax
                //$.get(URL, parametros, funcion(datos, estado, xhr), tipoDato)
                $.get("../lib/consultaAjax/equipoCatedra/equipoCatedra.php", {idAsignatura: codAsignatura}, function(htmlexterno){
                    $("#tabla").html(htmlexterno);});

		//$('#tabla').load('../lib/consultaAjax/planAsignatura/asignaturasDelPlan.php?id='+codPlan);
            });
        </script>
        
        <script type="text/javascript">
            // detenemos el envio del formulario (para que valide los campos requeridos)
            $('#form').on('submit', function (event) {
                event.preventDefault(); // se previene la acción por defecto
                //console.log($(this).serialize()); // serializa los datos del formulario (name->valor)
                // realizar petición AJAX
                var idProfesor = $("#profesor").val();
                var rol = $("#rol").val();
                var codAsignatura = $("#codAsignatura").val(); // obtenemos id Asignatura
//                console.log(idProfesor);
//                console.log(rol);
                $.ajax({
                    type: 'POST',
                    url: '../lib/consultaAjax/equipoCatedra/agregarProfesorEquipoCatedra.php',
                    data: {idProfesor: idProfesor,
                            rol: rol,
                            idAsignatura: codAsignatura}
                })
                .done(function(resultado){
                    $('#mensajeResultado').html(resultado);
                    $.get("../lib/consultaAjax/equipoCatedra/equipoCatedra.php", {idAsignatura: codAsignatura}, function(htmlexterno){
                    $("#tabla").html(htmlexterno);});
                    //$('#tabla').load('../lib/consultaAjax/planAsignatura/asignaturasDelPlan.php?id='+codPlan);
                    //alert(resultado);
                    //$('#carrera').html(carreras).selectpicker('refresh');
                })
                .fail(function(){
                    alert('Error en el servidor');
                });
            });

        </script>
        <script type="text/javascript">
            function eliminar(idProfesor, rol, contador){
                //console.log(codAsignatura);
                //var codAsignatura = $("#asignatura").val();
                var codAsignatura = $("#codAsignatura").val(); // obtenemos id Asignatura
                //console.log(codAsignatura);
                //console.log(codPlan);
                $.ajax({
                    type: 'POST',
                    url: '../lib/consultaAjax/equipoCatedra/desvincularProfesorEquipoCatedra.php',
                    data: {idAsignatura: codAsignatura,
                            idProfesor: idProfesor,
                            rol: rol}
                })
                .done(function(resultado){
                    //$('#modalEliminar'+codAsignatura).modal('hide');
                    // El siguiente codigo oculta el modal backdrop que queda
                    $('#modalEliminar'+contador).modal('hide');
                    if ($('.modal-backdrop').is(':visible')) {
                      $('body').removeClass('modal-open'); 
                      $('.modal-backdrop').remove(); 
                    };
                    $('#mensajeResultado').html(resultado);
                    $.get("../lib/consultaAjax/equipoCatedra/equipoCatedra.php", {idAsignatura: codAsignatura}, function(htmlexterno){
                    $("#tabla").html(htmlexterno);});
            
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