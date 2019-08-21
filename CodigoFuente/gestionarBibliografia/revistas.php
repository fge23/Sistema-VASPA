<?php
include_once '../lib/ControlAcceso.Class.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Art&iacute;culos de Revistas</title>
        <!-- Bootstrap CSS  -->
        <link rel="stylesheet" type="text/css" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css"/>
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
        <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.min.js"></script>
        <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../lib/js/gestionarBibliografia/formularioRevista.js"></script>
    </head>
    <body>
        <?php include_once '../gui/navbar.php'; ?>
        <div class="container col-12">
            <div class="row">
                <div class="col-md-12">
                    <h3>Art&iacute;culos de Revistas:</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="pull-right">
                        <button type="button" class="btn btn-success"  data-toggle="modal" data-target="#add_new_record_modal">
                            <span class="oi oi-plus"></span> Nuevo Art&iacute;culo de Revista
                        </button>
                    </div>
                </div>
            </div> 
            <!-- Container donde se carga la tabla -->
            <div class="container col-12" id="divDatos">
            </div>
        </div>

        <!-- Modal - Nueva revista -->
        <div class="modal fade" id="add_new_record_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">

                        <h4 class="modal-title" id="myModalLabel">Agregar nueva Revista</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">


                        <div class="form-group">
                            <label for="nuevo_apellido">Apellido/s Autor/es</label>
                            <input type="text" id="nuevo_apellido" class="form-control"/>
                        </div>

                        <div class="form-group">
                            <label for="nuevo_nombre">Nombre/ Autor/es</label>
                            <input type="text" id="nuevo_nombre" class="form-control"/>
                        </div>

                        <div class="form-group">
                            <label for="nuevo_tituloArticulo">T&iacute;tulo del Art&iacute;culo</label>
                            <input type="text" id="nuevo_tituloArticulo" class="form-control"/>
                        </div>

                        <div class="form-group">
                            <label for="nuevo_tituloRevista">T&iacute;tulo de la Revista</label>
                            <input type="text" id="nuevo_tituloRevista" class="form-control"/>
                        </div>

                        <div class="form-group">
                            <label for="nuevo_pagina">P&aacute;gina</label>
                            <input type="text" id="nuevo_pagina" class="form-control"/>
                        </div>

                        <div class="form-group">
                            <label for="nuevo_fecha">Fecha</label>
                            <input type="date" id="nuevo_fecha" class="form-control"/>
                        </div>

                        <div class="form-group">
                            <label for="nuevo_unidad">Unidad</label>
                            <input type="text" id="nuevo_unidad" class="form-control"/>
                        </div>

                        <div class="form-group">
                            <label for="nuevo_bibilioteca">Biblioteca</label>
                            <input type="text" id="nuevo_biblioteca"  class="form-control"/>
                        </div>

                        <div class="form-group">
                            <label for="nuevo_siunpa">SIUNPA</label>
                            <input type="text" id="nuevo_siunpa" class="form-control"/>
                        </div>

                        <div class="form-group">
                            <label for="nuevo_otro">Otro</label>
                            <input type="text" id="nuevo_otro" class="form-control"/>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" onclick="addRecord()">Agregar Art&iacute;culo</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal - Actualiza revista-->
        <div class="modal fade" id="update_record_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Actualizar Recurso</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="apellido">Apellido/s Autor/es</label>
                            <input type="text" id="apellido" class="form-control"/>
                        </div>

                        <div class="form-group">
                            <label for="nombre">Nombre/ Autor/es</label>
                            <input type="text" id="nombre" class="form-control"/>
                        </div>

                        <div class="form-group">
                            <label for="tituloArticulo">T&iacute;tulo del Art&iacute;culo</label>
                            <input type="text" id="tituloArticulo" class="form-control"/>
                        </div>

                        <div class="form-group">
                            <label for="tituloRevista">T&iacute;tulo de la Revista</label>
                            <input type="text" id="tituloRevista" class="form-control"/>
                        </div>

                        <div class="form-group">
                            <label for="pagina">P&aacute;gina</label>
                            <input type="text" id="pagina" class="form-control"/>
                        </div>

                        <div class="form-group">
                            <label for="fecha">Fecha</label>
                            <input type="date" id="fecha" class="form-control"/>
                        </div>

                        <div class="form-group">
                            <label for="unidad">Unidad</label>
                            <input type="text" id="unidad" class="form-control"/>
                        </div>

                        <div class="form-group">
                            <label for="bibilioteca">Biblioteca</label>
                            <input type="text" id="biblioteca"  class="form-control"/>
                        </div>

                        <div class="form-group">
                            <label for="siunpa">SIUNPA</label>
                            <input type="text" id="siunpa" class="form-control"/>
                        </div>

                        <div class="form-group">
                            <label for="otro">Otro</label>
                            <input type="text" id="otro" class="form-control"/>
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


<!--       <script>
                    (function (i, s, o, g, r, a, m) {
                        i['GoogleAnalyticsObject'] = r;
                        i[r] = i[r] || function () {
                            (i[r].q = i[r].q || []).push(arguments)
                        }, i[r].l = 1 * new Date();
                        a = s.createElement(o),
                                m = s.getElementsByTagName(o)[0];
                        a.async = 1;
                        a.src = g;
                        m.parentNode.insertBefore(a, m)
                    })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

                    ga('create', 'UA-75591362-1', 'auto');
                    ga('send', 'pageview');

</script>-->
        <?php include_once '../gui/footer.php'; ?>
    </body>
</html>