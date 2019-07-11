<?php include_once '../lib/ControlAcceso.Class.php'; ?>

<html lang="es">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="">

      <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
      <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>
      <link href="../lib/bootstrap-4.1.1-dist/css/uargflow_footer.css" type="text/css" rel="stylesheet" />
      <!--<link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/uargflow_footer.css" />-->
      <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
      <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
      
      <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Bienvenida</title>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container navbar-dark bg-dark">
                <a class="navbar-brand" href="#">
                    <img src="../lib/img/VASPA_isotipo.png" width="30" height="30" class="d-inline-block align-top" alt="">
                    <b>Sistema <?php echo Constantes::NOMBRE_SISTEMA; ?></b>
                </a>
            </div>
        </nav>
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h3>Sistema <?php echo Constantes::NOMBRE_SISTEMA; ?> - Bienvenida</h3>
                </div>

                <div class="card-body">
                    <p>Estimado usuario: Bienvenido al <b>Sistema</b> para la <b>V</b>isualizaci&oacute;n
                        <b>A</b>dministraci&oacute;n y <b>S</b>eguimiento de <b>P</b>rogramas de 
                        <b>A</b>signaturas <b>(VASPA)</b>,
                        una aplicaci&oacute;n desarrollada en la UARG - UNPA.</p>  
                    <hr>
                    
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">Ingreso a la Administraci&oacute;n del Sistema</h5>
                                    <p class="card-text">Si usted es un Profesor, empleado de Secretar&iacute;a Acad&eacute;mica o Director de Departamento y desea realizar operaciones en el Sistema, por favor presione el bot&oacute;n a continuaci&oacute;n.</p>
                                </div>
                                <div class="card-footer">
                                    <a href="../app/index.php" class="btn btn-primary btn-sm">Ir a Inicio de Sesi&oacute;n</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">Visualizaci&oacute;n de Programas de Asignaturas</h5>
                                    <p class="card-text">Si usted es un miembro de la comunidad universitaria y desea visualizar y/o descargar un Programa, por favor presione el bot&oacute;n a continuaci&oacute;n.</p>
                                </div>
                                <div class="card-footer">
                                    <a href="visualizar.programa.seleccionar.carrera.anio.php" class="btn btn-primary btn-sm">Ir a Visualizaci&oacute;n de Programas</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">Visualizaci&oacute;n de Planes de Estudio</h5>
                                    <p class="card-text">Si usted es un miembro de la comunidad universitaria y desea visualizar y/o descargar un Plan de Estudio, por favor presione el bot&oacute;n a continuaci&oacute;n.</p>
                                </div>
                                <div class="card-footer">
                                    <a href="visualizar.plan.php" class="btn btn-primary btn-sm">Ir a Visualizaci&oacute;n de Planes</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <footer class="footer">
            Sistema VASPA    
            <span class="oi oi-globe"></span> 
            UNPA-UARG
        </footer>
    </body>
</html>
