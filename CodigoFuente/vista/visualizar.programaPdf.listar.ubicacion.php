<?php
include_once '../lib/ControlAcceso.Class.php';

$nombreAsignatura = $_GET['nombreAsignatura'];

$codAsignatura = $_GET['codAsignatura'];

$ubicacionActual = $_GET['ubicacionActual'];

if($ubicacionActual == "SA"){

    $ubicacionActual = 'Secretar&iacute;a Acad&eacute;mica';

    }elseif ($ubicacionActual == "DPTO") {
        
        $ubicacionActual = 'Departamento';
    }else{
        $ubicacionActual = 'Todav&iacute;a no se imprimi&oacute; el documento PDF';
    }   

?>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
        <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
        <script type="text/javascript" src="../lib/quicksearch/jquery.quicksearch.js"></script>

        
      
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        
   
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.8/css/bootstrap-select.min.css" rel="stylesheet"/>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.8/js/bootstrap-select.min.js"></script>
       
        
        <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Seguir Programa</title>

    </head>


    <body>
        
        <?php include_once '../gui/navbar.php';   ?>
        <div class="container">

            <form action="programaPdf.procesar.php" method="post" id="formulario"> 
                <div class="card">
                
                    <div class="card-header">
                        <h3>Asignatura: <i><?php echo $codAsignatura ?> - <?php echo $nombreAsignatura ?>.</i> </h3>
                        <h3>Ubicaci&oacute;n actual del Programa: <i><?php echo $ubicacionActual ?>.</i> </h3>
                    </div>
                
                
                    <br/>
                    
                    <div class="form-group">
                        <p>&nbsp;&nbsp;&nbsp;&nbsp;Estimado usuario, seleccione la ubicaci&oacute;n donde se encuentra el Programa y luego presione el bot&oacute;n <b>Confirmar</b> para actualizarla.</p>
                        <br/>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="ubicacion" value="SA" id="SA" checked>
                        <label for="SA"><b>Secretar&iacute;a Acad&eacute;mica</b></label>
                        <br/>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="ubicacion" value="DPTO" id="DPTO">
                        <label for="DPTO"><b>Departamento</b></label>
                    </div>
                
                
                    <div class="card-body">
                    
                                   
                        <div class="card-footer">
                        
                        
                            <button type="submit" class="btn btn-outline-success">
                                <span class="oi oi-check"></span> Confirmar
                            </button>
                     
                        
                        
                            <a href="programa.seguirPdf.php">
                                <button type="button" class="btn btn-outline-danger">
                                    <span class="oi oi-x"></span> Cancelar
                                </button>
                            </a>
                        </div>
                 
                    </div>

                </div>

                <input type="hidden" name="idPrograma" id="idPrograma" value="<?= $_GET['idPrograma']; ?>">
               
            </form>
       
        </div>        
        <?php include_once '../gui/footer.php'; ?>
    </body>
  
</html>