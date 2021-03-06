<?php
include_once '../lib/ControlAcceso.Class.php';
$idPrograma = $_GET["id"];
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Otros Materiales</title>
        <!-- Bootstrap CSS  -->
        <link rel="stylesheet" type="text/css" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css"/>
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
        <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.min.js"></script>
        <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../lib/js/gestionarBibliografia/formularioOtroMaterial.js"></script>
           <!--         Librerias Bootbox-->
        <script src="../lib/bootbox/bootbox.js"></script>
        <script src="../lib/bootbox/bootbox.locales.js"></script>
    </head>
    <body>
        <?php include_once '../gui/navbar.php'; ?>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3>Otros materiales:</h3>
                </div>
            </div> 
            <div class="row">
                <div class="col-md-12">
                    <div class="pull-right">
                        <button type="button" class="btn btn-success"  data-toggle="modal" data-target="#add_new_record_modal">
                            <span class="oi oi-plus"></span> Agregar otro material
                        </button>
                    </div>
                </div>
            </div> 
            <br>
            <!-- Container donde se carga la tabla -->
            <div class="table-responsive" id="divDatos">
            </div>
            <hr>
            <a href="../vista/cargarBibliografia.php?id=<?= $idPrograma; ?>"><button class="btn btn-danger"><span class="oi oi-account-logout"></span> Regresar</button></a>
        </div>

        <!-- Modal - Otro material nuevo -->
        <div class="modal fade" id="add_new_record_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">

                        <h4 class="modal-title" id="myModalLabel">Agregar Otro material</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nuevo_descripcion">Descripci&oacute;n</label>
                            <input type="text" id="nuevo_descripcion" class="form-control"/>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-primary" onclick="addRecord()">Agregar material</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal - Actualiza Recurso-->
        <div class="modal fade" id="update_record_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Actualizar material</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="descripcion">Descripci&oacute;n</label>
                            <input type="text" id="descripcion" class="form-control"/>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" onclick="UpdateRecordDetails()" >Guardar</button>
                        <input type="hidden" id="hidden_id">
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function () {
                // actualiza tabla de registros mostrados
                var idPrograma = <?= $idPrograma ?>;
                readRecords(idPrograma);
            });
        </script>

        <?php include_once '../gui/footer.php'; ?>
    </body>
</html>
