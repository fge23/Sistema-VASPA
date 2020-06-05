<?php
include_once '../lib/ControlAcceso.Class.php';
$idPrograma = $_GET["id"];
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Libros</title>
        <!-- Bootstrap CSS  -->
        <link rel="stylesheet" type="text/css" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css"/>
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
        <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.min.js"></script>
        <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../lib/js/gestionarBibliografia/formularioLibro.js"></script>
    </head>
    <body>
        <style type="text/css">
            .row.no-margin {
                margin-left: -7.5px;
                margin-right: -7.5px;
            }

            .row.no-margin > .col-xs-3{
                padding-left: 7.5px;
                padding-right: 7.5px;
            }
        </style>

        <?php include_once '../gui/navbar.php'; ?>
        <div class="container col-12">
            <div class="row">
                <div class="col-md-12">
                    <h3>Libros:</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="pull-right">
                        <button type="button" class="btn btn-success"  data-toggle="modal" data-target="#add_new_record_modal">
                            <span class="oi oi-plus"></span> Nuevo Libro
                        </button>
                    </div>
                </div>
            </div> 
            <br>
            <!-- Container donde se carga la tabla -->
            <div class="table-responsive" id="divDatos">
            </div>
            <hr>
            <a href="../vista/cargarBibliografia.php?id=<?= $idPrograma; ?>"><button class="btn btn-danger">Regresar</button></a>
        </div>
        <!-- Modal - Nuevo libro -->
        <div class="modal fade" id="add_new_record_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Agregar nuevo Libro</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row no-margin">
                            <div class="col-xs-3">
                                <label for="nuevo_referencia" >Referencia</label>
                                <input type="text"  id="nuevo_referencia" name="nuevo_referencia" class="form-control required">
                            </div>

                            <div class="col-xs-3">
                                <label for="nuevo_anioEdicion">A&ntilde;o de Edici&oacute;n</label>
                                <input type="number" id="nuevo_anioEdicion" class="form-control" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nuevo_apellido">Apellido/s</label>
                            <input type="text" id="nuevo_apellido" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="nuevo_nombre">Nombre/s</label>
                            <input type="text" id="nuevo_nombre" class="form-control"/>
                        </div>

                        <label for="nuevo_tipo_bibliografia">Tipo de Bibliograf&iacute;a</label>
                        <div class="form-group" id="nuevo_tipo_bibliografia">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="nuevo_obligatoria" name="nuevo_tipoBibliografia" value="O">
                                <label class="custom-control-label" for="nuevo_obligatoria">Obligatoria</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="nuevo_complementaria" name="nuevo_tipoBibliografia" value="C">
                                <label class="custom-control-label" for="nuevo_complementaria">Complementaria</label>
                            </div>
                        </div>                   

                        <div class="form-group">
                            <label for="nuevo_titulo">T&iacute;tulo</label>
                            <input type="text" id="nuevo_titulo" class="form-control"/>
                        </div>

                        <div class="form-group">
                            <label for="nuevo_capitulo">Cap&iacute;tulo/Tomo/P&aacute;gina</label>
                            <input type="text" id="nuevo_capitulo" class="form-control"/>
                        </div>

                        <div class="form-group">
                            <label for="nuevo_lugarEdicion">Lugar de Edici&oacute;n</label>
                            <input type="text" id="nuevo_lugarEdicion" class="form-control"/>
                        </div>

                        <div class="form-group">
                            <label for="nuevo_editorial">Editorial</label>
                            <input type="text" id="nuevo_editorial" class="form-control"/>
                        </div>

                        <div class="row no-margin">
                            <div class="col-xs-3">
                                <label for="nuevo_bibilioteca">Biblioteca</label>
                                <input type="text" id="nuevo_biblioteca"  class="form-control"/>
                            </div>
                            <div class="col-xs-3">
                                <label for="nuevo_siunpa">SIUNPA</label>
                                <input type="text" id="nuevo_siunpa" class="form-control"/>
                            </div>
                        </div>

                        <div class="row no-margin">
                            <div class="col-xs-3">
                                <label for="nuevo_unidad">Unidad</label>
                                <input type="text" id="nuevo_unidad" class="form-control"/>
                            </div>
                            <div class="col-xs-3">
                                <label for="nuevo_otro">Otro</label>
                                <input type="text" id="nuevo_otro" class="form-control"/>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" onclick="addRecord()">Agregar Libro</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal - Actualiza Libro-->
        <div class="modal fade" id="update_record_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Actualizar Libro</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row no-margin">
                            <div class="col-xs-3">
                                <label for="referencia" >Referencia</label>
                                <input type="text"  id="referencia" class="form-control">
                            </div>
                            <div class="col-xs-3">
                                <label for="anioEdicion">A&ntilde;o de Edici&oacute;n</label>
                                <input type="number" id="anioEdicion" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="apellido">Apellido/s</label>
                            <input type="text" id="apellido" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="nombre">Nombre/s</label>
                            <input type="text" id="nombre" class="form-control"/>
                        </div>

                        <label for="tipo_bibliografia">Tipo de Bibliograf&iacute;a</label>
                        <div class="form-group" id="tipo_bibliografia">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="obligatoria" name="tipoBibliografia" value="O">
                                <label class="custom-control-label" for="obligatoria">Obligatoria</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="complementaria" name="tipoBibliografia" value="C">
                                <label class="custom-control-label" for="complementaria">Complementaria</label>
                            </div>
                        </div>                   

                        <div class="form-group">
                            <label for="titulo">T&iacute;tulo</label>
                            <input type="text" id="titulo" class="form-control"/>
                        </div>

                        <div class="form-group">
                            <label for="capitulo">Cap&iacute;tulo/Tomo/P&aacute;gina</label>
                            <input type="text" id="capitulo" class="form-control"/>
                        </div>

                        <div class="form-group">
                            <label for="lugarEdicion">Lugar de Edici&oacute;n</label>
                            <input type="text" id="lugarEdicion" class="form-control"/>
                        </div>

                        <div class="form-group">
                            <label for="editorial">Editorial</label>
                            <input type="text" id="editorial" class="form-control"/>
                        </div>

                        <div class="row no-margin">
                            <div class="col-xs-3">
                                <label for="bibilioteca">Biblioteca</label>
                                <input type="text" id="biblioteca"  class="form-control"/>
                            </div>
                            <div class="col-xs-3">
                                <label for="siunpa">SIUNPA</label>
                                <input type="text" id="siunpa" class="form-control"/>
                            </div>
                        </div>

                        <div class="row no-margin">
                            <div class="col-xs-3">
                                <label for="unidad">Unidad</label>
                                <input type="text" id="unidad" class="form-control"/>
                            </div>
                            <div class="col-xs-3">
                                <label for="otro">Otro</label>
                                <input type="text" id="otro" class="form-control"/>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" onclick="UpdateRecordDetails()">Guardar</button>
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
