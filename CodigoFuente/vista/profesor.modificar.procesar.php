<?php
include_once '../controlSistema/ManejadorProfesor.php';
include_once '../lib/Constantes.Class.php';

$DatosFormulario = $_POST;
//var_dump($DatosFormulario);
$ManejadorProfesor = new ManejadorProfesor();
$idProfesor = $_POST["idProfesor"];

/*
 * Validamos el email, debe cumplir la siguiente estructura: nombreusuario@uarg.unpa.edu.ar
 */
$email = $_POST["email"];
$mensaje = '';
// Si cumple con la expresion regular realizamos la modificacion, caso contrario mostramos que ha ocurrido un error debido al email ingresado
if (preg_match("/^[a-z]+@uarg.unpa.edu.ar$/", $email)){
    $consulta = $ManejadorProfesor->modificacion($DatosFormulario, $idProfesor);
}
else{
    $consulta = false;
    $mensaje .= 'El e-mail: <b>'.$email.'</b> no es valido, debe cumplir el siguiente formato: <b>nombreusuario@uarg.unpa.edu.ar</b>';
}



?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
        <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>
        <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Modificar Profesor</title>
    </head>
    <body>
        <?php include_once '../gui/navbar.php'; ?>

        <div class="container">
            <p></p>
            <div class="card">
                <div class="card-header">
                    <h3>Modificar Profesor</h3>
                </div>
                <div class="card-body">
                    <?php if ($consulta) { ?>
                        <div class="alert alert-success" role="alert">
                            Operaci&oacute;n realizada con &eacute;xito.
                        </div>
                    <?php } ?>   
                    <?php if (!$consulta) { ?>
                        <div class="alert alert-danger" role="alert">
                            Ha ocurrido un error.
                            <p><?= $mensaje ?></p>
                        </div>
                    <?php } ?>
                    <hr />
                    <h5 class="card-text">Opciones</h5>
                    <a href="profesores.php">
                        <button type="button" class="btn btn-primary">
                            <span class="oi oi-account-logout"></span> Salir
                        </button>
                    </a>
                </div>
            </div>
        </div>
        <?php include_once '../gui/footer.php'; ?>
    </body>
</html>
