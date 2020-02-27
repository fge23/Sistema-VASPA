<?php

// Aqui comienza la ejecución del CU REALIZAR CARGA MASIVA DE PROGRAMAS

//cambiar configuracion del servidor post_max_size admite hasta 8MB, es decir que solamente se podran enviar archivos hasta ese tamaño
// al igual que el tamaño individual de los archivos no debe superar los 2 MB

include_once '../lib/ControlAcceso.Class.php';
include_once '../modeloSistema/BDConexionSistema.Class.php';

?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">     
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
        <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />       
        <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>
        <script src="../lib/bootbox/bootbox.js"></script>
        <script src="../lib/bootbox/bootbox.locales.js"></script>
        <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Carga Masiva de Programas</title>
        
        <style type="text/css">
            .custom-file-input:lang(es) ~ .custom-file-label::after {
            content: "Examinar";}
        </style>
        <style type="text/css">
            .alinIzq {text-align: left}
        </style>
        
        <script>
//        $( document ).ready(function() {
      $(function() {

        console.log( "Ha ocurrido document.ready: documento listo" );
        // desactivamos el boton subir programas
        document.getElementById("btnSubir").disabled = true;
    });
 
//    $( window ).on( "load", function() {
//        console.log( "Ha ocurrido window.load: ventana lista" );
//    });
    </script>
        
    </head>
    <body>

        <?php include_once '../gui/navbar.php';   ?>

        <div class="container">
            <!--<form enctype="multipart/form-data" action="subir.programa.procesar.php" method="post" id="form">-->
            <form action="programa.procesar.cargaMasiva.php" enctype="multipart/form-data" method="POST">    
                <div class="card">
                    <div class="card-header">
                        <h3>Carga Masiva de Programas</h3>
                        <p>
                            Presione el bot&oacute;n <b>Examinar</b>.
                            A continuación, seleccione los programas que desea cargar en el sistema.
                            <br/>Luego, presione el bot&oacute;n <b>Subir Programas</b>. 
<!--                            Si desea cancelar, presione el bot&oacute;n <b>Cancelar</b>.-->
                        </p>
                        <div class="alert alert-warning text-center" role="alert">
                            Estimado usuario, los programas a subir deben cumplir el 
                            siguiente formato en el nombre de los mismos: <br>
                            <b>a&ntilde;oVigencia-c&oacute;digoCarrera-c&oacute;digoAsignatura.pdf</b>. Ejemplo: 2020-016-1668.pdf
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <!--                                <label for="programas">Adjuntar programas</label>
                                                                <input id="programas" type="file" name="programas[]" multiple="" accept="application/pdf" required="">-->
                                <div class="col-sm-12 col-lg-8 mr-auto ml-auto border p-4">
                                    <div class="form-group">
                                        <div class="custom-file">
                                            <input type="file" name="programas[]" multiple class="custom-file-input" id="customFile" lang="es" required="" accept="application/pdf" autofocus="">
                                            <label class="custom-file-label" for="customFile" >Seleccionar Programas</label>
                                        </div>
                                    </div>

                                    <SMALL class="form-text text-muted" id="cantidadArchivos">Seleccionar programas hasta un m&aacute;ximo de <b>10</b>. </SMALL>
                                <SMALL class="form-text text-muted" id="pesoArchivos">El peso total de todos los programas a subir no deben superar los <b>8MB</b>. </SMALL>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <div class="text-center">
                            
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#exampleModalLong" id="btnSubir">
                                <span class="oi oi-cloud-upload"></span> Subir Programas
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">¿Est&aacute; seguro de subir los siguientes programas?</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body alinIzq">
                                  <!--          <p>Los archivos en <span class="text-success">verde</span> se podran subir.</p>
                                            <p>Los archivos en <span class="text-danger">rojo</span>no se podran subir.</p>-->
                                            Los archivos resaltados en <span class="text-success">verde</span> se podran subir. <br/> 
                                            Los archivos resaltados en <span class="text-danger">rojo</span> no se podran subir.
                                            <output id="list"></output>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No estoy seguro</button>
                                            <button type="submit" class="btn btn-primary" name="subirProgramas">Si, Subir Programas</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <a href="panelSA.php">
                                <button type="button" class="btn btn-outline-secondary">
                                    <span class="oi oi-home"></span> Volver a Inicio
                                </button>
                            </a>
                            
                        </div>
 
                    </div>
                </div>
            </form>
            <!--</form>-->
        </div>
        
        <?php include_once '../gui/footer.php'; ?>
        
        <script>
            function handleFileSelect(evt) {
              var files = evt.target.files; // FileList object
              // files is a FileList of File objects. List some properties.
              var output = [];
              var tamanioTotal = 0.00;
              for (var i = 0, f; f = files[i]; i++) {
                  // convertimos a MB;
                  var tamanio = ((f.size/1024)/1024);
                  tamanio = tamanio.toFixed(2); // toma dos decimales
                  if (tamanio == 0.00){
                      tamanio = 0.01;
                  }
                  tamanioTotal = tamanioTotal + parseFloat(tamanio);
                  if (validaFormato(f.name)){
                      output.push('<li class="text-success"><strong>', f.name, '</strong> - ',
                            tamanio, ' MB.</li>');
                  } else {
                      output.push('<li class="text-danger"><strong>', f.name, '</strong>  - ',
                            tamanio, ' MB.</li>');
                  }
              }
              tamanioTotal = tamanioTotal.toFixed(2);
              tamanioTotal = parseFloat(tamanioTotal);
              document.getElementById("cantidadArchivos").innerHTML = "Seleccionar programas hasta un máximo de <b>10</b>. Cantidad de programas seleccionados: <b>" + this.files.length + "</b>.";
              
              document.getElementById("pesoArchivos").innerHTML = "El peso total de todos los programas a subir no deben superar los <b>8MB</b>. Peso total: <b>"+tamanioTotal+"MB</b>.";
              document.getElementById('list').innerHTML = '<ul>' + output.join('') + '</ul>';
              
              //validamos el tamanio total de los programas y su cantidad, si no cumplen se deshabilita el boton subir
              if (tamanioTotal > 8.00 && files.length > 10){
                  document.getElementById("btnSubir").disabled = true;
                  //alert("Se supero la cantidad (hasta 10 programas) y peso máximo permitido (hasta 8MB), por favor seleccione nuevos programas.");
                  bootbox.setLocale('es');
                  bootbox.alert("Se supero la cantidad (<b>hasta 10 programas</b>) y peso máximo permitido (<b>hasta 8MB</b>), por favor seleccione nuevos programas.");  
              } else if (tamanioTotal > 8.00){
                  document.getElementById("btnSubir").disabled = true;
                  //alert("Se supero el peso máximo permitido (8MB), por favor seleccione nuevos programas.");
                  bootbox.alert("Se supero el peso máximo permitido (<b>8MB</b>), por favor seleccione nuevos programas.");  
              } else if (files.length > 10){
                  document.getElementById("btnSubir").disabled = true;
                  //alert("Solo se puede subir hasta 10 programas, por favor seleccione esa cantidad o menos.");
                  bootbox.alert("Solo se puede subir <b>hasta 10 programas</b>, por favor seleccione esa cantidad o menos.");  
              } else if (files.length == 0){
                  document.getElementById("btnSubir").disabled = true;
              } else {
                  document.getElementById("btnSubir").disabled = "";
              }

            }

            document.getElementById('customFile').addEventListener('change', handleFileSelect, false);

            function validaFormato(nombreArchivo){
              // validacion mediante expresion regular
                  var exp = /^\d{4}-\d{3}-\d{4}.pdf$/;
                  return exp.test(nombreArchivo);
            }
        </script>
        
        <script>
            $(document).ready(function() {
            $('input[type="file"]').on("change", function() {
              //$("#cantidadArchivos").innerHTML("Seleccionar programas hasta un máximo de <b>10</b>. Cantidad de programas seleccionados: <b>" + this.files.length + "</b>.");
              let filenames = [];
              let files = document.getElementById("customFile").files;
              if (files.length == 0) {
                filenames.push("Seleccionar Programas");}
              if (files.length > 1) {
                filenames.push("Total de Programas Seleccionados (" + files.length + ")");
              } else {
                for (let i in files) {
                  if (files.hasOwnProperty(i)) {
                    filenames.push(files[i].name);
                  }
                }
              }
              $(this)
                .next(".custom-file-label")
                .html(filenames.join(","));
            });
          });
        </script>
    </body>
</html>
