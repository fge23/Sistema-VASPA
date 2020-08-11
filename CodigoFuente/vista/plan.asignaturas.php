<?php

    include_once '../lib/ControlAcceso.Class.php';
    ControlAcceso::requierePermiso(PermisosSistema::PERMISO_PLANES);
    include_once '../modeloSistema/Plan.Class.php';


    $idPlan = $_GET['id'];

    $plan = new Plan($idPlan);

    if (is_null($plan->getAnio_fin())){
        $periodo = ' ('.$plan->getAnio_inicio().' - Presente)';
    } else {
        $periodo = ' ('.$plan->getAnio_inicio().' - '.$plan->getAnio_fin().')';
    }



    function obtener_asignaturas_bd(){

       $output = '';
       $query = "SELECT id, nombre FROM asignatura ORDER BY id";
       $asig = BDConexionSistema::getInstancia()->query($query);

       while ($asignatura=$asig->fetch_assoc()){

        $output .= '<option value="'.$asignatura['id'].'">'.$asignatura['id'].' - '.$asignatura['nombre'].'</option>';
       }

        return $output;
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
        <script src="../lib/consultaAjax/planAsignatura/main.js" type="text/javascript"></script>
        <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Planes</title>


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

                    <h3>Asignaturas de la revisi&oacute;n del Plan: <span class="text-info"><?= $plan->getId().$periodo;?></span></h3>
                </div>
                <div class="card-body">

                    <p>

                        <?php

                        //Verificamos si la revision del plan tiene asignaturas cargadas
                            
                        $asignaturas = $plan->getAsignaturas();
                                                    
                        //Si es nulo quiere decir que todavia no se han insertado asignaturas, asique el mensaje al usuario debe estar visible.

                        if (is_null($asignaturas)){ ?>

                            <div>
                                <p>
                                    Estimado usuario, presione el bot&oacute;n <b>Nueva Asignatura</b>
                                    para agregar las asignaturas que desee a la revisi&oacute;n del plan en cuesti&oacute;n.<br /> 
                                    Luego, presione el bot&oacute;n <b>Confirmar</b> para guardar los cambios de manera
                                    permanente.<br />
                                </p>
                            </div>
                            <br />

                        <?php } ?>

                        <form id="form" method="POST" action="">
                            
                            <input type="hidden" id="codPlan" name="codPlan" value="<?=$plan->getId();?>">
                            <div class="row justify-content-md-center">
                                <div class="col col-sm-8" id="campos"> 
                                    <!--Acá van cada uno de los select que se insertan mediante js -->
                                </div>
                            </div>

                            <br />
                            <br />

                            <?php

                            //Verificamos si la revision del plan tiene asignaturas cargadas
                            
                            $asignaturas = $plan->getAsignaturas();

                                                    
                            //Si es nulo quiere decir que todavia no se han insertado asignaturas, asique los botones deben estar visibles para permitir al usuario guardar un conjunto de asignaturas.

                            if (is_null($asignaturas)){ ?>

                                <div class="botonera">
                                    <button id="add_field" type="button" class="btn btn-primary" value="adicionar">
                                        <span class=""></span> Nueva Asignatura
                                    </button>

                                    <button id="boton" type="submit" class="btn btn-success">
                                        <span class=""></span> Confirmar
                                    </button>
                                </div>

                            <?php }?>

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

            $(document).ready(function(){
                var codPlan = $("#codPlan").val();
            $('#tabla').load('../lib/consultaAjax/planAsignatura/asignaturasDelPlan.php?id='+codPlan);
            });

        </script>


    </body>
</html>