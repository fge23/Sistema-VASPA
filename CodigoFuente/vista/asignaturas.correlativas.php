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


$query = "SELECT id, nombre FROM asignatura ORDER BY id";
$asig = BDConexionSistema::getInstancia()->query($query);

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
        
        <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Asignaturas Correlativas</title>

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

                    <h3>Asignaturas correlativas de: <span class="text-info"><?= $asignatura->getId();?> - <?= $asignatura->getNombre();?> </span></h3>

                </div>

                <div class="card-body">
                    <p> 

                        <?php 
                        
                        //Validamos si la asignatura actual No tiene asignaturas correlativas asociadas previamente.
                            
                        $correlativa = $tieneCorrelativa->fetch_assoc();

                        if($correlativa['tieneCorrelativa'] == 0){ ?>

                            <div class="alert alert-info" role="alert">
                                <p>
                                    Estimado usuario, seleccione una asignatura de la lista, el requisito y tipo de correlatividad y pulse el bot&oacute;n <b>AGREGAR</b> para agregarla a la lista de asignaturas correlativas provisorias.<br /> 
                                    Luego, presione el bot&oacute;n <b>Guardar y Procesar</b> para guardar los cambios de manera permanente.<br />
                                </p>
                            </div>
                            <br />

                        <?php } else{ ?>

                            <div class="alert alert-warning" role="alert">
                                <p>
                                    Estimado usuario, <b>NO</b> se pueden modificar las asignaturas correlativas vinculadas a esta asignatura de la revisi&oacute;n del plan.<br />
                                </p>
                            </div>
                            <br />

                        <?php } ?>


                        <form id="form" method="POST" action="asignaturas.correlativas.procesar.php">
                
                           <!--Enviamos el codigo del plan al otro archivo para realizar la insercion en la BD-->
                           <input type="hidden" id="idPlan" name="idPlan" value="<?=$plan->getId();?>">
                           <!--Enviamos el codigo de la asignatura al otro archivo para realizar la insercion en la BD-->
                           <input type="hidden" id="idAsignatura" name="idAsignatura" value="<?=$asignatura->getId();?>">

                           <div class="col-6">
                                <div class="form-group">   
                                    <div class="row justify-content-md-center">

                                        <?php if($correlativa['tieneCorrelativa'] == 1){ ?>

                                        <div class="col col-sm-10">
                                            <label for="asignatura">Asignaturas</label>
                                            <select id="asignatura" name="asignatura" class="selectpicker" data-width="100%" data-live-search="true" required="" title="Seleccione una Asignatura" data-none-results-text="No se encontraron resultados" disabled="" data-size="7">
                                                <?php while ($asignatura=$asig->fetch_assoc()){?>
                                                <option value="<?= $asignatura['id'] ?>"><?= $asignatura['id'].' - '.$asignatura['nombre'] ?>
                                                </option>
                                            <?php } ?>
                                            </select>
                                        </div>

                                        <div class="col col-sm-10">
                                            <label for="requisito">Requisito</label>
                                            <select id="requisito" name="requisito" class="selectpicker" data-width="100%" data-live-search="true" required="" title="Seleccione un Requisito" data-none-results-text="No se encontraron resultados" disabled="">
                                                <option value="Aprobada">Aprobada</option>
                                                <option value="Regular">Regular</option>
                                            </select>
                                        </div>

                                        <div class="col col-sm-10">
                                            <label for="tipo">Tipo de Correlatividad</label>
                                            <select id="tipo" name="tipo_correlatividad" class="selectpicker" data-width="100%" data-live-search="true" required="" title="Seleccione el Tipo de Correlatividad" data-none-results-text="No se encontraron resultados" disabled="">
                                                <option value="Precedente">Precedente</option>
                                                <option value="Subsiguiente">Subsiguiente</option>
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

                                        <div class="col col-sm-10" style="padding-top: 30px; padding-bottom: 30px;">
                                            <label for="requisito">Requisito</label>
                                            <select id="requisito" name="requisito" class="selectpicker" data-width="100%" data-live-search="true" required="" title="Seleccione un Requisito" data-none-results-text="No se encontraron resultados">
                                                <option value="Aprobada">Aprobada</option>
                                                <option value="Regular">Regular</option>
                                            </select>
                                        </div>

                                        <div class="col col-sm-10">
                                            <label for="tipo">Tipo de Correlatividad</label>
                                            <select id="tipo" name="tipo_correlatividad" class="selectpicker" data-width="100%" data-live-search="true" required="" title="Seleccione el Tipo de Correlatividad" data-none-results-text="No se encontraron resultados">
                                                <option value="Precedente">Precedente</option>
                                                <option value="Subsiguiente">Subsiguiente</option>
                                            </select>
                                        </div>

                                        <?php } ?>


                                        <?php if($correlativa['tieneCorrelativa'] == 1){ ?>

                                        <div class="col col-sm-4">
                                            <br />
                                            <button class="btn btn-info" type="button" onclick="return add_li()" disabled="">AGREGAR</button>
                                        </div>

                                        <?php } else { ?>

                                        <div class="col col-sm-4">
                                            <br />
                                            <button class="btn btn-info" type="button" onclick="return add_li()">AGREGAR</button>
                                        </div>

                                        <?php } ?>

                                    </div>

                                    <br />

                                    <?php if($correlativa['tieneCorrelativa'] == 0){ ?>

                                    <label for="listaDesordenada">Listado de asignaturas correlativas provisorias:</label>
                                    
                                    <ul id="listaDesordenada" class="list-group">
                    
                                    </ul> 

                                    <?php } ?>

                                </div>
                            </div>


                            <?php if($correlativa['tieneCorrelativa'] == 1){ ?>

                            <button class="btn btn-primary" id="submit-btn" type="submit" disabled="">Guardar y Procesar</button>
                            
                            <?php } else { ?>

                            <button class="btn btn-primary" id="submit-btn" type="submit">Guardar y Procesar</button>

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




        <script>

            /**
             * Funcion que añade un <li> dentro del <ul>
             */
            
            function add_li(){

                var nuevoLi = document.getElementById("asignatura").value;

                var elemento = document.getElementById("asignatura");

                var elemento_seleccionado = elemento.options[elemento.selectedIndex].text;

           
                var requisito = document.getElementById("requisito").value;

                var tipo = document.getElementById("tipo").value;

                //Obtenemos el codigo de la asignatura actual, donde queremos agregar las correlativas
                
                var cod = '<?php echo $idAsignatura;?>'

                //Primero validamos que todos los campos sean seleccionados

                if (nuevoLi === "" || requisito === "" || tipo === "") {

                    alert("No se han seleccionado todos los campos.");

                } else{

                    //Validamos que el codigo de la asignatura a asociar no sea el mismo de la asignatura actual
                    
                    if (nuevoLi == cod){

                        alert("No se puede agregar la asignatura como correlativa de si misma.");

                    }else{

                        if (nuevoLi.length > 0){

                            if (find_li(nuevoLi)){

                                var li = document.createElement('li');
                                li.id = nuevoLi;
                                li.value = nuevoLi;
                                li.className = "list-group-item";
                                li.innerHTML = "<button id='" + nuevoLi + "' type='button' class='btn btn-danger' \n\
                            title='Eliminar'  onClick='eliminar(id); eliminar_array(id);'><span class = 'oi oi-trash'></span></button>&nbsp;&nbsp;" + elemento_seleccionado+" - "+requisito+" - "+ tipo;

                                document.getElementById("listaDesordenada").appendChild(li);
                                
                                agregarElementos();
                            }
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

                        alert("La asignatura con el codigo " + contenido + " ya existe en la lista de asignaturas correlativas a agregar.");
                        return false;
                    }
                }
                return true;
            }




            /**
             * Funcion para eliminar los elementos de la lista
             * Tiene que recibir el elemento pulsado
             */
            
            function eliminar(id_){

                var id = id_;
                node = document.getElementById(id);
                node.parentNode.removeChild(node);
                
            }

        </script>




        <script>

            var vectorAsignaturas = new Array();
            var vectorRequisitos = new Array();
            var vectorTipos = new Array();


            /**
             * Funcion para agregar los elementos a cada uno de los array
             */
            
            function agregarElementos(){
                
                var asignatura = document.getElementById("asignatura").value;
                var requisito = document.getElementById("requisito").value;
                var tipo = document.getElementById("tipo").value;
                
                vectorAsignaturas.push(asignatura);
                vectorRequisitos.push(requisito);
                vectorTipos.push(tipo);

                validarElementos();

            }


            

            /**
             * Funcion para eliminar los elementos de los array
             * Tiene que recibir el elemento pulsado
             */
            
            function eliminar_array(id_){

                //Obtenemos el id del elemento (codigo asignatura)
                var id = id_;

                //Obtenemos la posicion de ese elemento del vector principal donde se almacena
                var indice = vectorAsignaturas.indexOf(id);

                //En base a esa posicion, lo eliminamos del array, junto a su requisito y tipo
                vectorAsignaturas.splice(indice, 1);
                vectorRequisitos.splice(indice, 1);
                vectorTipos.splice(indice, 1);

                validarElementos();
            }




            /**
             * Funcion para validar la longitud de los array
             * Si la longitud de cada uno es mayor a 0 habilitamos el botón Guardar y Procesar, sino lo dejamos
             * deshabilitado.
             */

            function validarElementos(){

                if(vectorAsignaturas.length > 0 && vectorRequisitos.length > 0 && vectorTipos.length > 0){

                    document.getElementById("submit-btn").disabled = "";

                }else{

                    document.getElementById("submit-btn").disabled = true;
                }
            }






            //Enviamos los arrays al clickear el boton "GUARDAR Y PROCESAR"

            $("#submit-btn").click(function(e){

                $.ajax({
                    type: "POST",
                    url: "lista.asignaturas.correlativas.php",
                    data: {'vectorAsignaturas': JSON.stringify(vectorAsignaturas),
                    'vectorRequisitos': JSON.stringify(vectorRequisitos),
                    'vectorTipos': JSON.stringify(vectorTipos)
                    },
                });

            })

        </script>




        <script type="text/javascript">
           
                $('#tablaAsignaturas').DataTable({
                    language: {
                        url: '../lib/datatable/es-ar.json'
                    }
                });
            
        </script>




        <!-- Script que lista las asignaturas correlativas -->

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