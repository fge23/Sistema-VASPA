<?php
include_once '../lib/ControlAcceso.Class.php';
ControlAcceso::requierePermiso(PermisosSistema::PERMISO_PROFESORES);
include_once '../controlSistema/ManejadorProfesor.php';
include_once '../lib/Constantes.Class.php';

if (!isset($_POST["esResponsable"])){
    header("Location: profesores.php");
    exit();
}


$DatosFormulario = $_POST;
//echo '<pre>';
//var_dump($_POST);
//exit();
$ManejadorProfesor = new ManejadorProfesor();


/*
 * Validamos el email, debe cumplir la siguiente estructura: nombreusuario@uarg.unpa.edu.ar
 */
$email = $_POST["email"];
$mensaje = '';
$error = "";
$consulta = false;

// Si cumple con la expresion regular realizamos la insercion, caso contrario mostramos que ha ocurrido un error debido al email ingresado
if (preg_match("/^[a-z]+@uarg.unpa.edu.ar$/", $email)){
    // Chequeamos si el profesor que se esta por dar de alta es responsable o no de asignatura
    if ($_POST["esResponsable"] == "SI"){
        
        // chequeamos si no esta seteado el nombre de usuario, ya que puede crear un profesor responsable desde la pantalla alta de profesor sin pasar por la pantalla alta de usuario
        if (!isset($_POST["nombreUsuario"])){
            // si no tiene un nombre de usuario, tomamos el nombre de usuario como la parte inicial del correo hasta el '@'
            $DatosFormulario["nombreUsuario"] = explode("@", $_POST["email"])[0];
        }
        
        try {
            $consulta = $ManejadorProfesor->altaUsuarioProfesor($DatosFormulario);
        } catch (Exception $e) {
            $error = $e->getMessage();
        }
    } else {
        try {
            $consulta = $ManejadorProfesor->alta($DatosFormulario);
        } catch (Exception $e) {
            $error = $e->getMessage();
        }
    }
    
    
}
else{
    $consulta = false;
    $mensaje .= 'El e-mail: <b>'.$email.'</b> no es v&aacute;lido, debe cumplir el siguiente formato: <b>nombreusuario@uarg.unpa.edu.ar</b>';
}


?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
        <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>
        <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Crear Profesor</title>
    </head>
    <body>
        <?php include_once '../gui/navbar.php'; ?>

        <div class="container">
            <p></p>
            <div class="card">
                <div class="card-header">
                    <h3>Alta de Profesor</h3>
                </div>
                <div class="card-body">
                    <?php if ($consulta) { ?>
                        <div class="alert alert-success" role="alert">
                            Operaci&oacute;n realizada con &eacute;xito.
                        </div>
                    <?php } ?>   
                    <?php if (!$consulta) { ?>
                        <div class="alert alert-danger" role="alert">
                            Ha ocurrido un error. <?= $error; ?>
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
