<?php

    include_once '../lib/ControlAcceso.Class.php';
    ControlAcceso::requierePermiso(PermisosSistema::PERMISO_PLANES);
    include_once '../modeloSistema/Plan.Class.php';

    $idCarrera = $_GET['idCarrera'];

    $idPlan = $_GET['id'];

    $plan = new Plan($idPlan);

    if (is_null($plan->getAnio_fin())){
        $periodo = ' ('.$plan->getAnio_inicio().' - Presente)';
    } else {
        $periodo = ' ('.$plan->getAnio_inicio().' - '.$plan->getAnio_fin().')';
    }


    $query = "SELECT id, nombre FROM asignatura ORDER BY id";
    $asig = BDConexionSistema::getInstancia()->query($query);

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

        <script>

            $(function() {

                // desactivamos el boton Guardar y Procesar
                document.getElementById("submit-btn").disabled = true;

            });
 
        </script>

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
                            
                        $asignaturas_plan = $plan->getAsignaturas();
                                                    
                        //Si es nulo quiere decir que todavia no se han insertado asignaturas.

                        if (is_null($asignaturas_plan)){ ?>

                            <div class="alert alert-info" role="alert">
                                <p>
                                    Estimado usuario, seleccione una asignatura de la lista y pulse el bot&oacute;n <b>AGREGAR</b> para agregarla a la lista de asignaturas provisorias de la revisi&oacute;n del plan en cuesti&oacute;n.<br /> 
                                    Luego, presione el bot&oacute;n <b>Guardar y Procesar</b> para guardar los cambios de manera permanente.<br />
                                </p>
                            </div>
                            <br />

                        <?php } else{ ?>

                            <div class="alert alert-warning" role="alert">
                                <p>
                                    Estimado usuario, <b>NO</b> se pueden modificar las asignaturas vinculadas a esta revisi&oacute;n del plan ya que al hacerlo seria una nueva revisi&oacute;n.<br />
                                    Para crear una nueva revisi&oacute;n haga click en <a href="plan.revisiones.php?id=<?= $idCarrera ?>">Nueva Revisi&oacute;n del Plan </a>.
                                </p>
                            </div>
                            <br />

                        <?php } ?>

                   
                        <form id="form" method="POST" action="plan.asignaturas.procesar.php">
                
                           <input type="hidden" id="codPlan" name="codPlan" value="<?=$plan->getId();?>">
                           <input type="hidden" id="codCarrera" name="codCarrera" value="<?=$idCarrera?>">

                           <div class="col-6">
                                <div class="form-group">   
                                    <div class="row justify-content-md-center">

                                        <?php if (!is_null($asignaturas_plan)){ ?>

                                        <div class="col col-sm-10">
                                            <label for="asignatura">Asignaturas</label>
                                            <select id="asignatura" name="asignatura" class="selectpicker" data-width="100%" data-live-search="true" required="" title="Seleccione una Asignatura" data-none-results-text="No se encontraron resultados" disabled="" data-size="7">
                                                <?php while ($asignatura=$asig->fetch_assoc()){?>
                                                <option value="<?= $asignatura['id'] ?>"><?= $asignatura['id'].' - '.$asignatura['nombre'] ?>
                                                </option>
                                            <?php } ?>
                                            </select>
                                        </div>

                                        <?php } else{ ?>

                                        <div class="col col-sm-10">
                                            <label for="asignatura">Asignaturas</label>
                                            <select id="asignatura" name="asignatura" class="selectpicker" data-width="100%" data-live-search="true" required="" title="Seleccione una Asignatura" data-none-results-text="No se encontraron resultados" data-size="7">
                                                <?php while ($asignatura=$asig->fetch_assoc()){?>
                                                <option value="<?= $asignatura['id'] ?>"><?= $asignatura['id'].' - '.$asignatura['nombre'] ?>
                                                </option>
                                            <?php } ?>
                                            </select>
                                        </div>

                                        <?php } ?>

                                        <?php if (!is_null($asignaturas_plan)){ ?>

                                        <div class="col col-sm-2">
                                            <br />
                                            <button class="btn btn-info" type="button" onclick="return add_li()" disabled="">AGREGAR</button>
                                        </div>

                                        <?php } else { ?>

                                            <div class="col col-sm-2">
                                                <br />
                                                <button class="btn btn-info" type="button" onclick="return add_li()">AGREGAR</button>
                                            </div>

                                        <?php } ?>

                                    </div>

                                    <br>

                                    <?php if (is_null($asignaturas_plan)){ ?>

                                    <label for="listaDesordenada">Listado de asignaturas provisorias:</label>
                                    
                                    <ul id="listaDesordenada" class="list-group">
                    
                                    </ul> 

                                    <?php } ?>

                                </div>
                            </div>


                            <?php if (!is_null($asignaturas_plan)){ ?>

                            <button class="btn btn-primary" id= "submit-btn" type="submit" disabled="">Guardar y Procesar</button>
                            
                            <?php } else { ?>

                            <button class="btn btn-primary" id= "submit-btn" type="submit">Guardar y Procesar</button>

                         <?php } ?>

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



        <script>

            /**
             * Funcion que añade un <li> dentro del <ul>
             */
            function add_li(){

                var nuevoLi = document.getElementById("asignatura").value;

                var elemento = document.getElementById("asignatura");

                var elemento_seleccionado = elemento.options[elemento.selectedIndex].text;


                if (nuevoLi === "") {

                    alert("No se ha seleccionado ninguna asignatura de la lista");

                } else{

                    if (nuevoLi.length > 0){

                        if (find_li(nuevoLi)){

                            var li = document.createElement('li');
                            li.id = nuevoLi;
                            li.value = nuevoLi;
                            li.className = "list-group-item";
                            li.innerHTML = "<button id='" + nuevoLi + "' type='button' class='btn btn-danger' \n\
                        title='Eliminar'  onClick='eliminar(id)'><span class = 'oi oi-trash'></span></button>&nbsp;&nbsp;" + elemento_seleccionado;
                            document.getElementById("listaDesordenada").appendChild(li);
                            elementosLista();
                        }
                    }
                }
                return false;
            }


            /**
             * Funcion que busca si existe ya el <li> dentrol del <ul>
             * Devuelve true si no existe.
             */
            function find_li(contenido){

                var el = document.getElementById("listaDesordenada").getElementsByTagName("li");

                for (var i = 0; i < el.length; i++){

                    if (el[i].id == contenido) {
                        alert("La asignatura con el codigo " + contenido + " ya existe en la lista de asignaturas a agregar");
                        return false;
                    }
                }
                return true;
            }


            /**
             * Funcion para eliminar los elementos
             * Tiene que recibir el elemento pulsado
             */
            function eliminar(id_){

                var id = id_;
                node = document.getElementById(id);
                node.parentNode.removeChild(node);
                elementosLista();

            }

        </script>





        <script>

            function elementosLista() {

                var lis = document.getElementById("listaDesordenada").getElementsByTagName("li");

                //Se utiliza spread operator para convertir en array los elementos de la lista
                let arr = [...lis];
                
                var vectorElementos = new Array();
              
                for (var i = 0; i < arr.length; i++) {
                    vectorElementos.push(arr[i]['id']);
                }


                if(vectorElementos.length > 0){

                    document.getElementById("submit-btn").disabled = "";

                }else{

                    document.getElementById("submit-btn").disabled = true;
                }
                

               $.ajax({
                    type: "POST",
                    url: "lista.asignaturas.php",
                    data: {'vectorElementos': JSON.stringify(vectorElementos)
                    },
                });
            }

        </script>




        <script type="text/javascript">

            $(document).ready(function(){
                var codPlan = $("#codPlan").val();
            $('#tabla').load('../lib/consultaAjax/planAsignatura/asignaturasDelPlan.php?id='+codPlan);
            });

        </script>


    </body>
</html>