<?php
include_once '../lib/ControlAcceso.Class.php';
ControlAcceso::requierePermiso(PermisosSistema::PERMISO_ASIGNATURAS);
include_once '../controlSistema/ManejadorAsignatura.php';
include_once '../modeloSistema/Asignatura.Class.php';
include_once '../modeloSistema/Plan.Class.php';

$manejadorAsignatura = new ManejadorAsignatura();

// Obtenemos todas las asignaturas de la BD
$asignaturas = $manejadorAsignatura->getColeccion();


$idAsignatura = $_GET['idAsignatura'];
$asignatura = new Asignatura($idAsignatura);

$idPlan = $_GET['idPlan'];
$plan = new Plan($idPlan);


function obtener_asignaturas_bd(){

       $output = '';
       $query = "SELECT id, nombre FROM asignatura ORDER BY id";
       $asig = BDConexionSistema::getInstancia()->query($query);

       while ($asignatura=$asig->fetch_assoc()){

        $output .= '<option value="'.$asignatura['id'].'">'.$asignatura['id'].' - '.$asignatura['nombre'].'</option>';
       }

        return $output;
    }


//Esta query obtiene si una asignatura tiene o no correlativas asociadas. Esto me va a permitir mostrar/ ocultar los botones y el mensaje al usuario, del formulario.

$consulta = "SELECT plan_asignatura.tieneCorrelativa FROM `plan_asignatura` WHERE `idAsignatura` = '$idAsignatura' AND `idPlan` = '$idPlan'";

$tieneCorrelativa = BDConexionSistema::getInstancia()->query($consulta);

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
        <script src="../lib/consultaAjax/asignaturaCorrelativa/main.js" type="text/javascript"></script>
        <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Asignaturas Correlativas</title>

        <style type="text/css" media="screen">
            
            .botonera {
                    display: flex;
                    justify-content: space-between;
                    width: 25%;
            }
            
        </style>

    </head>
    <body>

        <?php include_once '../gui/navbar.php'; ?>

        <div class="container">
            <div class="card">
                <div class="card-header">

                    <h3>Asignaturas correlativas de: <span class="text-info"><?= $asignatura->getId();?> - <?= $asignatura->getNombre();?> </span></h3>
                </div>
                <div class="card-body">
                    <p> 

                        <?php 
                        
                        //Validamos si la asignatura actual No tiene asignaturas correlativas, asi de esta manera mostramos los botones y el mensaje al usuario.
                            
                        $correlativa = $tieneCorrelativa->fetch_assoc();

                        if($correlativa['tieneCorrelativa'] == 0){ ?>

                            <div>
                                <p>
                                    Estimado usuario, presione el bot&oacute;n <b>Nueva Correlativa</b>
                                    para agregar las asignaturas correlativas que desee.<br /> 
                                    Luego, presione el bot&oacute;n <b>Confirmar</b> para guardar los cambios de manera permanente.<br />
                                </p>
                            </div>
                            <br />

                        <?php } ?>


                        <form id="form" method="POST" action="">
                            <!--Enviamos el codigo del plan al otro archivo para realizar la insercion en la BD-->
                            <input type="hidden" id="idPlan" name="idPlan" value="<?=$plan->getId();?>">
                            <!--Enviamos el codigo de la asignatura al otro archivo para realizar la insercion en la BD-->
                            <input type="hidden" id="idAsignatura" name="idAsignatura" value="<?=$asignatura->getId();?>">
                            <div class="row justify-content-md-center">
                                <div class="col col-sm-8" id="campos">
                                    <!--Acá van cada uno de los select que se insertan mediante js -->
                                </div>
                            </div>
                            <br />
                            <br />

                            <?php 
                            
                            //Validamos si la asignatura actual No tiene asignaturas correlativas, asi de esta manera mostramos los botones y el mensaje al usuario.
                            
                            if($correlativa['tieneCorrelativa'] == 0){ ?>

                                <div class="botonera">
                                    <button id="add_field" type="button" class="btn btn-primary" value="adicionar">
                                        <span class=""></span> Nueva Correlativa
                                    </button>

                                    <button id="boton" type="submit" class="btn btn-success">
                                        <span class=""></span> Confirmar
                                    </button>
                                </div>

                            <?php } ?>
                            
                        </form>
                    </p>

                    <div id="tabla"></div>

                </div>
                <div class="card-footer text-center">
                    <a href="planes.php">
                    <button type="button" class="btn btn-primary">
                        <span class="oi oi-account-logout"></span> Volver a Planes
                    </button>
                    </a>
                </div>    
            </div>
        </div>
        <?php include_once '../gui/footer.php'; ?>




<!--Script que me permite insertar campos dinamicamente, esta asociado al boton nuevo -->

        <script type="text/javascript">

            $(document).ready(function(){
                $(document).on("click",".btn-primary", function(){

                    var html = '';

                    html += '<div>'+
                                '<div class="float-left col col-sm-10">'+
                                    '<label for="asignatura">Asignaturas</label>'+
                                    '<br />'+
                                    '<select class="selectpicker show-tick" id="asignatura" name="cod_asignatura[]" data-width="100%" data-live-search="true" required="" title="Seleccione una asignatura" data-none-results-text="No se encontraron resultados" data-size="7">'+
                                        '<option value=""></option>'+
                                        '<?php echo obtener_asignaturas_bd(); ?>'+                                 
                                    '</select>'+

                                    '<label for="requisito">Requisito</label>'+
                                    '<select id="requisito" name="requisito[]" class="selectpicker" data-width="100%" data-live-search="true" required="" title="Seleccione un requisito" data-none-results-text="No se encontraron resultados">'+
                                        '<option value="Aprobada">Aprobada</option>'+
                                        '<option value="Regular">Regular</option>'+
                                    '</select>'+


                                    '<label for="tipo">Tipo de Correlatividad</label>'+
                                    '<select id="tipo" name="tipo_correlatividad[]" class="selectpicker" data-width="100%" data-live-search="true" required="" title="Seleccione el tipo de correlatividad" data-none-results-text="No se encontraron resultados">'+
                                        '<option value="Precedente">Precedente</option>'+
                                        '<option value="Subsiguiente">Subsiguiente</option>'+
                                    '</select>'+

                                '</div>'+ 
                                '<div class="float-right">'+
                                    '<button type="button" class="btn btn-danger">'+
                                        '<span class="oi oi-trash"></span> Eliminar'+
                                    '</button>'+
                                '</div>'+
                            '</div>';
                    
                    $('#campos').append(html);
                    $(".selectpicker").selectpicker(); 
                    $('#asignatura').selectpicker('refresh');
                    
                })

            });

        </script>




<!--Script que me permite eliminar elementos, esta asociado al boton eliminar -->

        <script type="text/javascript">

            $('#campos').on("click",".btn-danger",function(e) {
                    e.preventDefault();
                    $(this).parent().parent().remove();
                });

        </script>



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
                var idPlan = $("#idPlan").val();
		$('#tabla').load('../lib/consultaAjax/asignaturaCorrelativa/correlativasDeAsignatura.php?idAsignatura='+idAsignatura+'&idPlan='+idPlan);
                $('#tablaAsignaturas').DataTable({
                    language: {
                        url: '../lib/datatable/es-ar.json'
                    }
                });
            });
        </script>


    </body>
</html>