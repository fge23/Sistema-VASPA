<?php 

include_once '../lib/ControlAcceso.Class.php'; 
ControlAcceso::requierePermiso(PermisosSistema::PERMISO_REVISAR_PROGRAMA);
include_once '../modeloSistema/Programa.Class.php';
include_once '../modeloSistema/Asignatura.Class.php';

$programa = new Programa($_GET['id']);

// validamos que el id del programa este definido, sea un numero mayor o igual a 0, y que sea un programa existente en la BD
if (!isset($_GET['id']) || $_GET['id'] == "" || !is_numeric($_GET['id']) || $_GET['id'] < 0 || is_null($programa->getId())){
    header("location: revisar.programas.php"); 
    
}


// validamos que no se intenta aprobar nuevamente dicho programa


$enlace = "../controlSistema/programa.revisar.generarpdf.php?id=".$_GET['id']."#toolbar=0&navpanes=0&scrollbar=0";
//$enlace = "generarPDFprograma.php?id=".$_GET['id']."#toolbar=0&navpanes=0&scrollbar=0";


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
                            <?php 
                            // verificamos si el atributo "fueDesaprobado" es igual a 1
                            // si se cumple lo anterior significa que el programa fue desaprobado anteriormente con lo cual 
                            // se le informara al usuario.
                            if ($programa->getFueDesaprobado() == 1){
                                echo '<div class="alert alert-primary alert-dismissible fade show text-center" role="alert">
                                    El programa que est&aacute; revisando fue <strong>desaprobado </strong>anteriormente. El docente ha realizado los cambios en base a sus comentarios.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>';
                            }
                            
                            ?>
                            <div class="text-center">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" <?php if (is_null($carreras)){echo 'disabled=""';}?>>
                                    Aprobar Programa
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">¿Est&aacute; seguro de aprobar el programa?</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="../controlSistema/programa.revisar.actualizar.estado.php" method="POST">
                                                <div class="modal-footer">
                                                    <input type="hidden" name="idPrograma" value="<?= $programa->getId();?>">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                                    <button type="submit" class="btn btn-primary" name="aprobarPrograma">S&iacute;, aprobar programa</button>
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
                                                            <label for="comentario" class="col-form-label">Comentario:</label>
                                                            <textarea class="form-control" id="comentario" rows="5" name="comentario" required=""></textarea>
                                                        </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                                    <button type="submit" class="btn btn-primary" name="desaprobarPrograma">S&iacute;, desaprobar y enviar Comentario</button>
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
                                        <span class="oi oi-arrow-circle-left"></span> Volver a Revisar Programas
                                    </button>
                                </a>
                            </div>
                            
                        </div>
                        
                        <div class="card-footer">

                                <div class="card mb-12">
                                    <div class="card-header"><h4 class="card-title" id="comentarios">Comentarios</h4></div>
            
            <?php 
                                
                                if (!is_null($programa->getComentarioSa())){
                                    echo '<div class="card-body">
                                            <h5 class="card-title">Secretar&iacute;a Acad&eacute;mica</h5>
                                            <p class="card-text text-muted">'.$programa->getComentarioSa().'</p>
                                          </div>';
                                }
                                if (!is_null($programa->getComentarioDepto())){
                                    echo '<hr>
                                          <div class="card-body">
                                            <h5 class="card-title">Departamento</h5>
                                            <p class="card-text text-muted">'.$programa->getComentarioDepto().'</p>
                                          </div>';
                                }
                                
                                ?>
                                </div>
                            <!--</div>-->
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
