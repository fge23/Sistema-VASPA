<?php include_once '../lib/ControlAcceso.Class.php'; 

$enlace = "generarPDFprograma.php?id=".$_GET['id']."#toolbar=0&navpanes=0&scrollbar=0";

?>

<html lang="es">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      
      <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
      <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>
      <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
      <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
      
      <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Revisar Programa</title>
    </head>
    <body>
        <?php include_once '../gui/navbar.php'; ?>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3><?php echo Constantes::NOMBRE_SISTEMA; ?> - Revisar Programa</h3>
                        </div>
                        <div class="card-body">
                            <p>Estimado empleado de Secretar&iacute;a Acad&eacute;mica: .</p>  
                            <hr>
                            <p style="text-align: center;">
                                <iframe src="<?= $enlace; ?>" width="97%" height="500" style="border: none;"></iframe>
                            </p>
                        </div>
                        
                        <div class="card-footer">
                            <!-- Comments Form -->
                            <div class="card my-4">
                                <h5 class="card-header">Deja un comentario:</h5>
                                <div class="card-body">
                                    <form>
                                        <div class="form-group">
                                            <textarea class="form-control" rows="3"></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Enviar</button>
                                    </form>
                                </div>
                            </div>

                            <!-- Single Comment -->
                            <div class="media mb-4">
                                <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
                                <div class="media-body">
                                    <h5 class="mt-0">Secretaria Academica</h5>
                                    asd asdjhgdjadgshuyerflahduhiau 
                                </div>
                            </div>

                        </div>
                        
                    </div>
                </div>
                
                
                
            </div>
            
<!--            <div class="row">
                <div class="col-md-12">
                    <p style="text-align: center;">
                <iframe src="" width="97%" height="500" style="border: none;"></iframe>
                </p>
                </div>
            </div>-->
            
<!--            <div class="row">
                <embed src="../doc.pdf#toolbar=0&navpanes=0&scrollbar=0" type="application/pdf" width="100%" height="600px" />
            </div>-->
            
            <div class="row">
                <div class="col-md-12">
                
                </div>
            </div>


        </div>
        <?php include_once '../gui/footer.php'; ?>

    </body>
</html>
