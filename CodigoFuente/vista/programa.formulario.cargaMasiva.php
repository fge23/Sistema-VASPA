<?php

// Aqui comienza la ejecución del CU REALIZAR CARGA MASIVA DE PROGRAMAS

//NOTA: El boton cancelar no hace "nada", deberia redirigir a la pagina principal o al panel de Secretaria Academica 

//cambiar configuracion del servidor post_max_size admite hasta 8MB, es decir que solamente se podran enviar archivos hasta ese tamaño

include_once '../lib/ControlAcceso.Class.php';
include_once '../modeloSistema/BDConexionSistema.Class.php';


?>

<html>
    <head>
        <meta charset="UTF-8">
        
        <meta http-equiv="X-UA-Compatible" content="IE=edge">     
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
        <!--<link rel="stylesheet" href="../lib/bootstrap-fileinput/css/fileinput.min.css" />-->
        <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        
        
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
        <!--<script src="../lib/bootstrap-fileinput/js/fileinput.min.js" type="text/javascript"></script>-->
        <!--<script src="../lib/bootstrap-fileinput/js/locales/es.js" type="text/javascript"></script>-->
        
        <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>
        
        <script src="../lib/bootbox/bootbox.js"></script>
        <script src="../lib/bootbox/bootbox.locales.js"></script>
        <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Carga Masiva de Programas</title>
        
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
                            Si desea cancelar, presione el bot&oacute;n <b>Cancelar</b>.
                        </p>
                        <div class="alert alert-warning" role="alert">
                            Estimado usuario, los programas a subir deben cumplir el 
                            siguiente formato en el nombre de los mismos: <br>
                            <b>a&ntilde;oVigencia-c&oacute;digoCarrera-c&oacute;digoAsignatura.pdf</b>. Ejemplo: 2020-016-1668.pdf
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <!--                            <form enctype="multipart/form-data">
                                                            <label for="file-es" role="button">Seleccionar Archivos</label>
                                            <input id="file-es" name="file-es[]" type="file" multiple>
                                            <SMALL class="form-text text-muted">Seleccionar archivos de Office 201X: docx, xlsx, pptx y pdf hasta un máximo de 5.</SMALL>
                                                        </form>-->

                            <div class="col-12">
                                <label for="programas">Adjuntar programas</label>
                                <input id="programas" type="file" name="programas[]" multiple="" accept="application/pdf" required="">
                                <SMALL class="form-text text-muted">Seleccionar archivos pdf hasta un máximo de x.</SMALL>
                            <!--    <input id="input-b3" name="input-b3[]" type="file" class="file" multiple 
                                data-show-upload="false" data-show-caption="true" data-msg-placeholder="Select {files} for upload...">-->
                                                        <!--<input id = "input-b1" name = "input-b1" type = "file" class = "file" data-browse-on-zone-click = "true" >--> 


                            </div>


                        </div>

                    </div>

                    <div class="card-footer">
                        <div class="text-center">
                            <button type="submit" class="btn btn-outline-primary" id="subirProgramas" name="subirProgramas">
                                <span class="oi oi-cloud-upload"></span> Subir Programas</button>

                            <a href="#">
                                <button type="button" class="btn btn-outline-danger">
                                    <span class="oi oi-x"></span> Cancelar
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </form>
            <!--</form>-->
        </div>
        
        <?php include_once '../gui/footer.php'; ?>
        
    </body>
</html>
