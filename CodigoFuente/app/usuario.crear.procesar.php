<?php
include_once '../lib/ControlAcceso.Class.php';
ControlAcceso::requierePermiso(PermisosSistema::PERMISO_USUARIOS);
include_once '../modelo/BDConexion.Class.php';
include_once '../modelo/Rol.Class.php';
$DatosFormulario = $_POST;

//// Comprobamos si el Rol seleccionado es de Profesor, de serlo redireccionamos
//$idRol = $DatosFormulario["rol"]; //obtenemos el id del rol
//$rol = new Rol($idRol); // creamos objeto rol
//
//if ($rol->getNombre() == "Profesor"){
//    $_SESSION["usuarioNombre"] = $DatosFormulario["nombre"];
//    $_SESSION["usuarioEmail"] = $DatosFormulario["mail"];
//    $_SESSION["usuarioRol"] = $DatosFormulario["rol"];
//    header("Location: ../vista/profesor.crear.php");
//    exit();
//}

// chequeamos si ya existe tanto el nombre de Usuario como el email.
$sql = "SELECT * FROM usuario WHERE "
        . "nombre LIKE '{$DatosFormulario["nombre"]}' "
        . "OR email LIKE '{$DatosFormulario["mail"]}'";
        
$resultado = BDConexion::getInstancia()->query($sql);

$mensaje = '';

if (!$resultado){
    $mensaje = 'Error al realizar petici&oacute;n a la Base de Datos';
} else {
    
    if ($resultado->num_rows == 1) { // Si hay un registro esto puede significar que ya existe el nombre de usuario o correo
        $registro = $resultado->fetch_assoc();

        $nombre = $registro["nombre"];
        $email = $registro["email"];
        
        if ($DatosFormulario["nombre"] == $nombre && $DatosFormulario["mail"] == $email){
            $mensaje = "El nombre de usuario: <b>$nombre</b> y el email: <b>$email</b> ya existen, por favor ingrese otro nombre de usuario y otro email.";
        } elseif ($DatosFormulario["nombre"] == $nombre) {
            $mensaje = "El nombre de usuario: <b>$nombre</b> ya existe, por favor ingrese otro nombre de usuario.";
        } elseif ($DatosFormulario["mail"] == $email) {
            $mensaje = "El email: <b>$email</b> ya existe, por favor ingrese otro email";
        }
        
        $consulta = FALSE;
         
    } elseif ($resultado->num_rows == 2) {
        // si hay dos registros esto quiere decir que se repiten tanto el nombre como el correo.
        $consulta = FALSE;
        $mensaje = "El nombre de usuario: <b>$nombre</b> y el email: <b>$email</b> ya existen, por favor ingrese otro nombre de usuario y otro email.";
    } elseif ($resultado->num_rows == 0) { // no se encontraron coincidencias en la BD, por lo tanto se debe proceder con la insercion

        // Comprobamos si el Rol seleccionado es de Profesor, de serlo redireccionamos
        $idRol = $DatosFormulario["rol"]; //obtenemos el id del rol
        $rol = new Rol($idRol); // creamos objeto rol

        if ($rol->getNombre() == "Profesor") {
            $_SESSION["usuarioNombre"] = $DatosFormulario["nombre"];
            $_SESSION["usuarioEmail"] = $DatosFormulario["mail"];
            $_SESSION["usuarioRol"] = $DatosFormulario["rol"];
            header("Location: ../vista/profesor.crear.php");
            exit();
        }

        // iniciamos transaccion para insertar el usuario y su rol en la BD
        BDConexion::getInstancia()->autocommit(false);
        BDConexion::getInstancia()->begin_transaction();

        $query = "INSERT INTO usuario "
                . "VALUES (null,'{$DatosFormulario["nombre"]}','{$DatosFormulario["mail"]}')";
        $consulta = BDConexion::getInstancia()->query($query);
        if (!$consulta) {
            BDConexion::getInstancia()->rollback();
            //arrojar una excepcion
            die(BDConexion::getInstancia()->errno);
        }
        $idUsuario = BDConexion::getInstancia()->insert_id;
//foreach ($DatosFormulario["rol"] as $idRol) {
        //$query = "INSERT INTO usuario_rol "
        //        . "VALUES ({$idUsuario}, {$idRol})";
        $query = "INSERT INTO usuario_rol "
                . "VALUES ({$idUsuario}, {$DatosFormulario["rol"]})";
        $consulta = BDConexion::getInstancia()->query($query);
        if (!$consulta) {
            BDConexion::getInstancia()->rollback();
            //arrojar una excepcion
            die(BDConexion::getInstancia()->errno);
        }
//}   

        BDConexion::getInstancia()->commit();
        BDConexion::getInstancia()->autocommit(true);
    }
}


?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
        <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>
        <title><?= Constantes::NOMBRE_SISTEMA; ?> - Crear Usuario</title>
    </head>
    <body>
        <?php include_once '../gui/navbar.php'; ?>

        <div class="container">
            <p></p>
            <div class="card">
                <div class="card-header">
                    <h3>Crear Usuario</h3>
                </div>
                <div class="card-body">
                    <?php if ($consulta) { ?>
                        <div class="alert alert-success" role="alert">
                            Operaci&oacute;n realizada con &eacute;xito.
                        </div>
                    <?php } ?>   
                    <?php if (!$consulta) { ?>
                        <div class="alert alert-danger" role="alert">
                            Ha ocurrido un error. <?= $mensaje; ?>
                        </div>
                    <?php } ?>
                    <hr />
                    <h5 class="card-text">Opciones</h5>
                    <a href="usuarios.php">
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
