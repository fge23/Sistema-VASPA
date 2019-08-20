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
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <h3><?php echo Constantes::NOMBRE_SISTEMA; ?> - Panel Secretar&iacute;a Acad&eacute;mica</h3>
                        </div>
                        <div class="card-body">
                            <p>Estimado empleado de Secretar&iacute;a Acad&eacute;mica: Bienvenido al Sistema VASPA, desde esta pantalla podr&aacute; adiministrar el Sistema.</p>  
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <p>Funcionalidad/es mas importante/s...</p>
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Column -->
                <div class="col-md-3">
                    <div class="card">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title">Accesos r&aacute;pidos   </h5>
                                <hr>
                                <a href="programas.pendientes.php" class="btn btn-outline-secondary btn-block">Programas pendientes</a>
                                <a href="#" class="btn btn-outline-secondary btn-block">Seguimiento de Programa</a>
                                <a href="subir.programa.formulario.php" class="btn btn-outline-secondary btn-block">Subir Programa</a>
                                <a href="subir.plan.formulario.php" class="btn btn-outline-secondary btn-block">Subir Plan</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include_once '../gui/footer.php'; ?>
    </body>
</html>
