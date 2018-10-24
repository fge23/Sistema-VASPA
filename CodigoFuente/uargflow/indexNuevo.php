<?php include_once '../lib/Constantes.Class.php'; ?>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
        <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/uargflow_footer.css" />
        <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>        
        <meta name="google-signin-client_id" content="356408280239-7airslbg59lt2nped9l4dtqm2rf25aii.apps.googleusercontent.com" />
        <script type="text/javascript" src="https://apis.google.com/js/platform.js" async defer></script>
        <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="../lib/login.js"></script>
        <title><?php echo Constantes::NOMBRE_SISTEMA; ?> </title>
    </head>
    <body>

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container navbar-dark bg-dark">
                <a class="navbar-brand" href="#">
                    <img src="../lib/img/Logo-VASPA.png" width="100" height="60" class="d-inline-block align-top" alt="">
                    <?php echo Constantes::NOMBRE_SISTEMA; ?> 
                </a>
            </div>
        </nav>

        <div class="container">
            <section id="main-content">
                <article>
                    <div class="card">
                        <div class="card-header">
                            <h3> <?php echo Constantes::NOMBRE_SISTEMA; ?></h3>
                        </div>
                        <div class="card-body">

                            <h5>Bienvenido</h5>
                            <p>Estimado usuario: Bienvenido al Sistema VASPA, una aplicaci&oacute;n desarrollada en la UARG - UNPA.</p>

                            <hr />
                            <p>Este Sistema sirve para la Visualizaci&oacute;n y Gesti&oacute;n de Programas de Asignaturas.</p>
                            <hr />

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">B&uacute;squeda de Programas de Asignaturas</h4>
                                            <p class="card-text">Si usted es un miembro de la comunidad universitaria y desea buscar un Programa, por favor presione el bot&oacute;n a continuaci&oacute;n.</p>
                                            <a href="#" class="btn btn-primary">Buscar Programa</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">Ingreso a la Administraci&oacute;n del Sistema</h4>
                                            <p class="card-text">Si usted es un Profesor, empleado de Secretar&iacute;a 
                                                Acad&eacute;mica o Director de Departamento y desea realizar operaciones en el Sistema, por favor presione el bot&oacute;n a continuaci&oacute;n.</p>
                                            <a href="indexAdmin.php" class="btn btn-primary">Ir a Inicio de Sesi&oacute;n</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            </section>
        </div>
        <footer class="footer">
            Sistema VASPA
            <span class="oi oi-globe"></span> 
            UNPA-UARG
        </footer>
    </body>
</html>

