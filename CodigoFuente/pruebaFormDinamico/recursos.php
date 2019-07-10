<?php
include_once '../lib/ControlAcceso.Class.php';

?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
       <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Recursos</title>

        <!-- Bootstrap CSS File  -->
        <link rel="stylesheet" type="text/css" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css"/>
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
    </head>
    <body>
        <?php include_once '../gui/navbar.php'; ?>
        <!-- Content Section -->
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3>Recursos:</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="pull-right">
                            <button type="button" class="btn btn-success"  data-toggle="modal" data-target="#add_new_record_modal">
                                <span class="oi oi-plus"></span> Nuevo Recurso
                            </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Content Section -->


        <!-- Bootstrap Modals -->
        <!-- Modal - Add New Record/User -->
        <div class="modal fade" id="add_new_record_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">

                        <h4 class="modal-title" id="myModalLabel">Agregar nuevo Recurso</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">


                        <div class="form-group">
                            <label for="nuevo_apellido">Apellido</label>
                            <input type="text" id="nuevo_apellido" class="form-control"/>
                        </div>

                        <div class="form-group">
                            <label for="nuevo_nombre">Nombre</label>
                            <input type="text" id="nuevo_nombre" class="form-control"/>
                        </div>

                        <div class="form-group">
                            <label for="nuevo_titulo">T&iacute;tulo</label>
                            <input type="text" id="nuevo_titulo" class="form-control"/>
                        </div>

                          <div class="form-group">
                            <label for="nuevo_datos_adicionales">Datos Adicionales</label>
                            <input type="text" id="nuevo_datos_adicionales" class="form-control"/>
                        </div>
                        
                          <div class="form-group">
                            <label for="nuevo_disponibilidad">Disponibilidad</label>
                            <input type="text" id="nuevo_disponibilidad" class="form-control"/>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" onclick="addRecord()">Agregar Recurso</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- // Modal -->

        <!-- Modal - Update User details -->
        <div class="modal fade" id="update_user_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Update</h4>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="update_first_name">Apellido</label>
                            <input type="text" id="update_first_name" placeholder="First Name" class="form-control"/>
                        </div>

                        <div class="form-group">
                            <label for="update_last_name">Nombre</label>
                            <input type="text" id="update_last_name" placeholder="Last Name" class="form-control"/>
                        </div>

                        <div class="form-group">
                            <label for="update_titulo">T&iacute;tulo</label>
                            <input type="text" id="update_titulo" placeholder="titulo" class="form-control"/>
                        </div>


                        <div class="form-group">
                            <label for="update_email">Email Address</label>
                            <input type="text" id="update_email" placeholder="Email Address" class="form-control"/>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" onclick="UpdateUserDetails()" >Save Changes</button>
                        <input type="hidden" id="hidden_user_id">
                    </div>
                </div>
            </div>
        </div>
        <!-- // Modal -->

        <!-- Jquery JS file -->
        <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.min.js"></script>

        <!-- Bootstrap JS file -->
        <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>

        <!-- Custom JS file -->
        <script type="text/javascript" src="../lib/js/formularioRecurso.js"></script>

        <script>
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

        </script>
        <?php include_once '../gui/footer.php'; ?>
    </body>
</html>