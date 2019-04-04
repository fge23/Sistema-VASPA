<?php
// Aqui comienza la ejecución del CU SUBIR PROGRAMA FIRMADO

include_once '../lib/ControlAcceso.Class.php';
include_once '../modeloSistema/BDConexionSistema.Class.php';

/*
 * Comprobamos que si la carpeta del anio actual este creada
 * de no ser asi, se procede a crearla y registrar en la BD.
 */
//obtenemos el anio actual
$anio = date("Y");
//direccion donde se va a crear la carpeta
$ruta = '../programas/';
$directorio = $ruta.$anio;


//Lo siguiente podria ser una funcion
if (!is_dir($directorio)){
    $creado = mkdir($directorio);
    if ($creado){
        //echo "Directorio creado <br>";
        //Insertamos el anio en la BD
        $consulta = "INSERT INTO ANIO VALUES ({$anio})";
        $resultado = BDConexionSistema::getInstancia()->query($consulta);
        /*
        if ($resultado){
            echo 'Cargado en la BD';
        }
        else{
            echo 'Error al cargar';
        }
        */
    }/*
    else {
        echo "No se pudo crear el directorio";
    }*/
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
        <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Subir Programa</title>
        
    </head>
    <body>

        <?php include_once '../gui/navbar.php';   ?>

        <div class="container">
            <form enctype="multipart/form-data" action="subir.programa.procesar.php" method="post" id="form">
                <div class="card">
                    <div class="card-header">
                        <h3>Subir programa al Sistema</h3>
                        <p>
                            Complete los campos a continuaci&oacute;n. 
                            Luego, presione el bot&oacute;n <b>Subir Programa</b>.<br/>
                            Si desea cancelar, presione el bot&oacute;n <b>Cancelar</b>.
                        </p>
                    </div>
                    
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <p><label for="selectAnio">A&ntilde;o</label>
                                <select class="selectpicker" data-live-search="true" data-width="100%" name="anio" id="selectAnio" title="Seleccione un a&ntilde;o" required="" liveSearchStyle='contains' data-none-results-text="No se encontraron resultados">
                                     <?php for ($i=date('Y'); $i>=2011; $i--) { ?>
                                        <option value="<?= $i; ?>"><?= $i; ?></option>
                                    <?php } ?>
                                </select>
                                </p>
                            </div>

                            <div class="col-md-4">
                                <p><label for="carrera">Carrera</label>
                                    <select id="carrera" name="carrera" class="selectpicker" data-width="100%" data-live-search="true" required="" title="Seleccione una carrera" data-none-results-text="No se encontraron resultados">
                                    </select>
                                </p>
                            </div>

                            <div class="col-md-5">
                                <p><label for="asignatura">Asignatura</label>
                                    <select id="asignatura" name="asignatura" class="selectpicker" data-width="100%" data-live-search="true" required="" title="Seleccione una asignatura" data-none-results-text="No se encontraron resultados">
                                    </select></p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputDescripcion">Descripci&oacute;n</label>
                            <input type="text" class="form-control" id="inputDescripcion" name="descripcion"
                                placeholder="Ingrese una descripci&oacute;n (opcional)">
                        </div>
                        <div class="form-group">
                            <label for="inputFile">Adjuntar programa</label>
                            <!--El campo oculto MAX_FILE_SIZE (medido en bytes) su valor es el tamaño de fichero máximo aceptado por PHP.-->
                            <!--En este caso se opto por el tamaño maximo de 2MB-->
                            <input type="hidden" name="MAX_FILE_SIZE" value="2097152" />
                            <input type="file" class="form-control-file" id="inputFile" name="programa" accept="application/pdf" required="">
                        </div>                     
                    </div>
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-outline-primary" id="boton" name="boton">
                            <span class="oi oi-cloud-upload"></span> Subir Programa</button>
                        
                        <a href="#">
                            <button type="button" class="btn btn-outline-danger">
                                <span class="oi oi-x"></span> Cancelar
                            </button>
                        </a>
                    </div>
                </div>
            </form>
        </div>
        
        <?php include_once '../gui/footer.php'; ?>
        
        <script>
            //Script para validar la extension y el tamaño maximo permitido a subir del programa en PDF
            $('input[type="file"]').on('change', function(){
                var ext = $( this ).val().split('.').pop();
                if ($( this ).val() != '') {
                  if(ext == "pdf"){
                    //alert("La extensión es: " + ext);
                    if($(this)[0].files[0].size > 2097152){
                        alert("El documento excede el tamaño máximo");
                      console.log("El documento excede el tamaño máximo");
                      //$('#modal-title').text('¡Precaución!');
                      //$('#modal-msg').html("Se solicita un archivo no mayor a 1MB. Por favor verifica.");
                      //$("#modal-gral").modal();           
                      $(this).val('');
                    }else{
                      $("#modal-gral").hide();
                    }
                  }
                  else
                  {
                    $( this ).val('');
                    alert("Extensión no permitida: " + ext);
                  }
                }
            });
    </script>
    
    <script>
  $(document).ready(function(){
            //$('.selectpicker').selectpicker();
  //alert($("selectAnio").val());
            //$('.selectpicker').selectpicker();
  $.ajax({
    type: 'POST',
    url: '../lib/consultaAjax/cargarCarreras.php',
    //data: {'peticion': 'cargar_listas'}
  })
  .done(function(carreras){
    $('#carrera').html(carreras)
  })
  .fail(function(){
    alert('Hubo un error al cargar las carreras')
  })

  //$('#carrera').on('change', function(){
  $('#carrera').change(function (e) {
    //$('.selectpicker').selectpicker();
    //alert($("#selectAnio").val());
    //alert(e.target.value);
    var id = e.target.value;
    //var id = $('#carrera').val()
    var anio = $('#selectAnio').val()
    //var anio = document.getElementById("selectAnio").value;
    //alert(anio)
    //alert(id)
    $.ajax({
      type: 'POST',
      url: '../lib/consultaAjax/cargarAsignaturas.php',
      data: {'id': id,
       'anio': anio}
    })
    .done(function(asignaturas){
      //$('#asignatura').html(asignaturas);
      //$('.selectpicker').selectpicker('refresh');
      $(".selectpicker").selectpicker(); 
      $('#asignatura').html(asignaturas).selectpicker('refresh');
    })
    .fail(function(){
      alert('Hubo un error al cargar las asignaturas')
    })
  })
  
  //Si se cambia de anio, reseteamos las asignaturas y tener en cuenta mas tarde las carreras
  $('#selectAnio').change(function () {
    //Reiniciamos asignaturas
    var groupFilter = $('#asignatura');
    groupFilter.selectpicker('val', '');
    groupFilter.find('option').remove();
    groupFilter.selectpicker("refresh");
    $("#asignatura").val('default').selectpicker("refresh");
    //Reiniciamos carreras pero sin eliminar los elementos de la lista
    //Probablemente se tendra que actualizar en base al año seleccionado
    $("#carrera").val('default').selectpicker("refresh");
  });
  /*
  //Cambiamos la leyenda cuando no se encontraron resultados en la busqueda en tiempo real del combobox
  $('.selectpicker').selectpicker({
    noneResultsText: 'No se encontraron resultados'
  });
  */
})
    </script>
    
    <!--<script type="text/javascript" src="../lib/js/cargarListasSubirPrograma.js"></script>-->
    </body>
</html>
