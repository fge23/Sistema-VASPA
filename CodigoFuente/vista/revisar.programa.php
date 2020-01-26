<?php 

include_once '../lib/ControlAcceso.Class.php'; 
include_once '../modeloSistema/Programa.Class.php';
include_once '../modeloSistema/Asignatura.Class.php';


// validamos que el id del programa este definido y sea un numero
//if (isset($_GET['id']) && $_GET['id'] !== "" && is_numeric($_GET['id']) && $_GET['id'] >= 0){
//    echo 'esta seteado';
//    
//} else {
//    header("location: revisarProgramas.php");;
//}

// validamos que el id del programa este definido y sea un numero
if (!isset($_GET['id']) || $_GET['id'] == "" || !is_numeric($_GET['id']) || $_GET['id'] < 0){
    header("location: revisar.programas.php"); 
    
}

//validar que el id sea uno que se encuentre en la BD
$enlace = "../controlSistema/programa.revisar.generarpdf.php?id=".$_GET['id']."#toolbar=0&navpanes=0&scrollbar=0";

//$enlace = "generarPDFprograma.php?id=".$_GET['id']."#toolbar=0&navpanes=0&scrollbar=0";


// ¡VALIDAR QUE EL ID CORRESPONDA A UN REGISTRO DE PROGRAMA EN LA BD, PREGUNTAR SI ESTA LISTO
// EL MANEJADOR PROGRAMA!
$programa = new Programa($_GET['id']);
//if (empty($programa->getId())){
//    var_dump($programa);
//}
$asignatura = new Asignatura($programa->getIdAsignatura());
$carreras = $asignatura->getCarreras();
    
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
                            <h3>Revisar Programa de <span class="text-info"><?= $asignatura->getNombre().' - '.$asignatura->getId()?></span></h3>
                        </div>
                        <div class="card-body">

                            <div class="text-center">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" <?php if (is_null($carreras)){echo 'disabled=""';}?>>
                                    Aprobar Programa
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">¿Est&aacute; seguro de aprobar el programa?</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">

                                            </div>
                                            <form action="../controlSistema/programa.revisar.actualizar.estado.php" method="POST">
                                                <div class="modal-footer">
                                                    <input type="hidden" name="idPrograma" value="<?= $programa->getId();?>">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No estoy seguro</button>
                                                    <button type="submit" class="btn btn-primary" name="aprobarPrograma">Si aprobar programa</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalCenter" <?php if (is_null($carreras)){echo 'disabled=""';}?>>
                                    Desaprobar Programa
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">¿Est&aacute; seguro de desaprobar el programa?</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="../controlSistema/programa.revisar.actualizar.estado.php" method="POST">
                                                <div class="modal-body">

                                                        <!--<p>Agregue a modo de comentario porque desaprobo el programa</p>-->
                                                        <div class="form-group">
                                                            <input type="hidden" name="idPrograma" value="<?= $programa->getId();?>">
                                                            <label for="comentario" class="col-form-label">Deja un Comentario:</label>
                                                            <textarea class="form-control" id="comentario" rows="5" name="comentario" required=""></textarea>
                                                        </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No estoy seguro</button>
                                                    <button type="submit" class="btn btn-primary" name="desaprobarPrograma">Si y Enviar Comentario</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <hr>
                            <?php if (is_null($carreras)){
                                echo '<div class="alert alert-danger" role="alert">
                                        Ha ocurrido un error. La asignatura: '.$asignatura->getNombre().' - '.$asignatura->getId().' <b>no se encuentra asociado a un Plan de Estudio y/o Carrera.</b>
                                    </div>';
                            }
                            else {
                                echo '<p style="text-align: center;">
                                <iframe src="'.$enlace.'" width="97%" height="500" style="border: none;"></iframe>
                            </p>';
                            }
                            ?>
                            
                            <div class="text-center">
                                <a href="revisar.programas.php">
                                    <button type="button" class="btn btn-secondary">
                                        <span class="oi oi-arrow-circle-left"></span> Volver a Programas
                                    </button>
                                </a>
                            </div>
                            
                        </div>
                        
                        <div class="card-footer">
                            <!-- Comments Form -->
<!--                            <div class="card my-4">
                                <h5 class="card-header">Deja un comentario:</h5>
                                <div class="card-body">
                                    <form action="revisar.programa.guardar.comentario.php" method="POST">
                                        <div class="form-group">
                                            <textarea class="form-control" rows="3" name="comentario"></textarea>
                                        </div>
                                        <button name="enviarComentario" type="submit" class="btn btn-primary">Enviar</button>
                                    </form>
                                </div>
                            </div>-->

                            <!-- Single Comment -->
                            <div class="media mb-4" id="comentarios">
                                <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
                                <div class="media-body">
                                    <h5 class="mt-0">Secretaria Academica</h5>
                                    ... 
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
