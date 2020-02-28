<?php
include_once '../lib/ControlAcceso.Class.php';
include_once '../controlSistema/ManejadorAsignatura.php';
include_once '../controlSistema/ManejadorProgramaPDF.php';
include_once '../modeloSistema/Carrera.Class.php';
include_once '../modeloSistema/Asignatura.Class.php';
include_once '../modeloSistema/Programa.Class.php';


$codAsignatura = $_GET['codAsignatura'];
echo ($codAsignatura);
$asignatura = new Asignatura($codAsignatura);
$anio=($_GET['anio']);

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
       
        
        <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Visualizar Programa</title>
    </head>
    <body>
        
       

        
   
        
        <?php include_once '../gui/navbar.php';   ?>
        <div class="container">
          
            <form action="visualizar.programaPdf.listar.ubicacion.php" method="get"> 
            <div class="card">
                
                <div class="card-header">
                    <h3>Seguir Programa</h3>
                </div>
                
                
                
                <div class="form-group">
                    <label> Ubicación actual del Programa: </label>
                    <br/>
                    <input type="radio" name="ubicacion" value="SA"> SA
                    <br/>
                    <input type="radio" name="ubicacion" value="DPTO"> DPTO
                </div>
                
                
                <div class="card-body">
                    
                                   
                    <div class="card-footer">
                        
                        
                        <button type="submit" class="btn btn-outline-success">
                            <span class="oi oi-check"></span> Confirmar
                        </button>
                     
                        
                        
                        <a href="visualizar.programaPdf.listar.seguimiento.php">
                            <button type="button" class="btn btn-outline-danger">
                                <span class="oi oi-x"></span> Cancelar
                            </button>
                        </a>
                    </div>
                 
                </div>

            </div>
        </form>
            
            <!-- A partir de acá el código se encuentra incompleto. Falta terminar de codificar. -->
            
            <?php 
    
                $ubicacion = $_GET['ubicacion'];
    
                $this->query = "UPDATE PROGRAMA "
                        . "SET ubicacion = '{$ubicacion}'"
                        . "WHERE idAsignatura = '{$codAsignatura}' AND anio = '{$anio}'";
      
                        
                        
            ?>
            <!-- Estas dos lineas estan de mas, no hacen nada -->
            <input type="hidden" name="codCarrera" id="codCarrera" value="<?= $_POST['idCarrera']; ?>">
            <input type="hidden" name="anio" id="anio" value="<?= $_POST['anio']; ?>">
            
          
        </div>        
        <?php include_once '../gui/footer.php'; ?>
    </body>
  
    
    
    
 
</html>


