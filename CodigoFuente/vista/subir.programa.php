<?php
//include_once '../lib/Constantes.Class.php';

?>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
        <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>        
        <title><?php //echo Constantes::NOMBRE_SISTEMA; ?> Subir Programa - Carreras</title>
        
        <script language="Javascript">
// Creamos una función que mira si los dos selects han sido elegidos
// Esta es lanzada cada vez que se produce el evento "onChange" de los selects, es decir en el momento que puede haber cambiado la situación
function valida(){
    var indice = document.getElementById("carrera").selectedIndex;
    //var indice2 = document.getElementById("plan").selectedIndex;
    var indice3 = document.getElementById("asignatura").selectedIndex;
    if( indice !=0 && indice3 !=0) {
        document.getElementById("boton").disabled=false;
    }else{
        document.getElementById("boton").disabled=true;
    }
}
</script>

    </head>
    <body>

        <?php //include_once '../gui/navbar.php';   ?>

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
                        <!--                    <form enctype="multipart/form-data" action="subirPrograma.procesar2.php" method="post">-->
                    <div class="row">
                        <div class="col-md-6">
                            <p>Carrera
                                <select id="carrera" name="carrera" class="form-control" onChange="valida()" required="">
                                </select>
                            </p>
                        </div>
<!--                        <div class="col-md-4">
                            <p>Plan
                                <select id="plan" name="plan" class="form-control" onChange="valida()" required="">
                                    <option value="0">Seleccione un Plan</option>
                                </select>
                            </p>
                        </div>-->
                        <div class="col-md-6">
                            <p>Asignatura
                                <select id="asignatura" name="asignatura" class="form-control" onChange="valida()" required="">
                                    <option value="0">Seleccione una Asignatura</option>
                                </select>
                            </p>
                        </div>
                    </div>
                        <!--<div class="form-group">-->
                            <!--<label>Nombre del Programa</label>-->
                            <!--<input type="text" class="form-control" id="inputNombre" name="nombre"-->
                                   <!--placeholder="Ingrese el nombre del Programa" required="">-->
                        <!--</div>-->
                        <div class="form-group">
                            <label>Descripci&oacute;n</label>
                            <input type="text" class="form-control" id="inputDescripcion" name="descripcion"
                                   placeholder="Ingrese una Descripci&oacute;n (opcional)">
                        </div>
                        <div class="form-group">
                            <label>Adjuntar programa</label>
                            <!--<input type="file" name="programa">-->
                            <input type="file" class="form-control-file" id="inputFile" name="programa" accept="application/pdf" required="">
                            <!--<p class="help-block">Ejemplo de texto de ayuda.</p>-->
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-outline-primary" id="boton" name="boton" disabled="">
                            <span class="oi oi-cloud-upload"></span> Subir Programa</button>
                        <input type="hidden" name="anio" id="anio" value="<?= $_GET['anio']; ?>">
                        <a href="listar.anios.subirprograma.php">
                            <button type="button" class="btn btn-outline-danger">
                                <span class="oi oi-x"></span> Cancelar
                            </button>
                        </a>
                    </div>
                </div>
            </form>
        </div>
        
        <?php //include_once '../gui/footer.php'; ?>
        
        <script>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="../lib/js/cargarListasSubirPrograma.js"></script>
    </body>
</html>
