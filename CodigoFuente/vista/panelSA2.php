<?php include_once '../lib/ControlAcceso.Class.php'; ?>

<html lang="es">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      
      <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
      <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>
      <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
      <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
      
      <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Bienvenida</title>
    </head>
    <body>
        <?php include_once '../gui/navbar.php'; ?>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h3><?php echo Constantes::NOMBRE_SISTEMA; ?> - Panel Secretar&iacute;a Acad&eacute;mica</h3>
                        </div>
                        <div class="card-body">
                            <p>Estimado empleado de Secretar&iacute;a Acad&eacute;mica: Bienvenido al Sistema VASPA, desde esta pantalla podr&aacute; adiministrar el Sistema.</p>  
                            <hr>
                            <div class="row">
                                <div class="col-md-8">
                                    <p>Funcionalidad/es mas importante/s...</p>
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Programas  pendientes</h5>
                            <p class="card-text">Si desea obtener un listado de los programas de asignaturas pendientes, por favor presione el bot&oacute;n a continuaci&oacute;n.</p>
                        </div>
                        <div class="card-footer">
                            <a href="programas.pendientes.php" class="btn btn-primary btn-sm btn-block">Programas pendientes</a>
                        </div>
                    </div>

                    <div class="card my-4">
                        <div class="card-body">
                            <h5 class="card-title">Seguimiento de Programas</h5>
                            <p class="card-text">Si desea saber en donde se encuentra un programa, por favor presione el bot&oacute;n a continuaci&oacute;n.</p>
                        </div>
                        <div class="card-footer">
                            <a href="#" class="btn btn-primary btn-sm btn-block">Seguimiento de programas</a>
                        </div>
                    </div>

                    <div class="card my-4">
                        <div class="card-body">
                            <h5 class="card-title">Subir Programa</h5>
                            <p class="card-text">Si desea cargar un nuevo programa en el sistema, por favor presione el bot&oacute;n a continuaci&oacute;n.</p>
                        </div>
                        <div class="card-footer">
                            <a href="subir.programa.formulario.php" class="btn btn-primary btn-sm btn-block">Subir Programa</a>
                        </div>
                    </div>

                    <div class="card my-4">
                        <div class="card-body">
                            <h5 class="card-title">Subir Plan</h5>
                            <p class="card-text">Si desea cargar un nuevo plan en el sistema, por favor presione el bot&oacute;n a continuaci&oacute;n.</p>
                        </div>
                        <div class="card-footer">
                            <a href="subir.plan.formulario.php" class="btn btn-primary btn-sm btn-block">Subir Plan</a>
                        </div>
                    </div>

                </div>
                
            </div>
        </div>
        <?php include_once '../gui/footer.php'; ?>

    </body>
</html>
