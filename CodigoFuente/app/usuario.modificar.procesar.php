<?php
include_once '../lib/ControlAcceso.Class.php';
ControlAcceso::requierePermiso(PermisosSistema::PERMISO_USUARIOS);
include_once '../modelo/BDConexion.Class.php';
include_once '../modelo/Usuario.Class.php';
$DatosFormulario = $_POST;
$idUsuario = $DatosFormulario["id"];

$Usuario = new Usuario($idUsuario);


// chequeamos si ya existe tanto el nombre de Usuario como el email en "otros" usuarios del Sistema.
$sql = "SELECT * FROM usuario WHERE "
        . "id <> '{$idUsuario}' AND "
        . "(nombre LIKE '{$DatosFormulario["nombre"]}' "
        . "OR email LIKE '{$DatosFormulario["email"]}')";
        
$resultado = BDConexion::getInstancia()->query($sql);

$mensaje = '';

if (!$resultado){
    $mensaje = 'Error al realizar petici&oacute;n a la Base de Datos';
    $consulta = FALSE;
} else {
    
    if ($resultado->num_rows == 1) { // Si hay un registro esto puede significar que ya existe el nombre de usuario o correo
        $registro = $resultado->fetch_assoc();

        $nombre = $registro["nombre"];
        $email = $registro["email"];
        
        if ($DatosFormulario["nombre"] == $nombre && $DatosFormulario["email"] == $email){
            $mensaje = "El nombre de usuario: <b>$nombre</b> y el email: <b>$email</b> ya existen, por favor ingrese otro nombre de usuario y otro email.";
        } elseif ($DatosFormulario["nombre"] == $nombre) {
            $mensaje = "El nombre de usuario: <b>$nombre</b> ya existe, por favor ingrese otro nombre de usuario.";
        } elseif ($DatosFormulario["email"] == $email) {
            $mensaje = "El email: <b>$email</b> ya existe, por favor ingrese otro email";
        }
        
        $consulta = FALSE;
         
    } elseif ($resultado->num_rows == 2) {
        // si hay dos registros esto quiere decir que se repiten tanto el nombre como el correo.
        $consulta = FALSE;
        $mensaje = "El nombre de usuario: <b>{$DatosFormulario["nombre"]}</b> y el email: <b>{$DatosFormulario["email"]}</b> ya existen, por favor ingrese otro nombre de usuario y otro email.";
    } elseif ($resultado->num_rows == 0) { // no se encontraron coincidencias en la BD, por lo tanto se debe proceder con la insercion
        
        // obtenemos el rol del Usuario a modificar
        $rolUsuario = $Usuario->getRoles()[0]->getNombre();
        
        // comprobamos si el Rol es de Profesor (No se modifica el Rol, pero si hay que modificar el mail de la tabla profesor).
        if ($rolUsuario == "Profesor"){
            // es profesor --> hay que actualizar el email en la tabla profesor
            BDConexion::getInstancia()->autocommit(false);
            BDConexion::getInstancia()->begin_transaction();

            $query = "UPDATE usuario "
            . "SET nombre = '{$DatosFormulario["nombre"]}', email = '{$DatosFormulario["email"]}' "
            . "WHERE id = {$idUsuario}";
            $consulta = BDConexion::getInstancia()->query($query);
            if (!$consulta) {
                BDConexion::getInstancia()->rollback();
                //arrojar una excepcion
                die(BDConexion::getInstancia()->errno);
            }
            
            $query = "UPDATE ".Constantes::BD_SCHEMA.".profesor "
                    . "SET email = '{$DatosFormulario["email"]}' "
                    . "WHERE email = '{$Usuario->getEmail()}'";
            $consulta = BDConexion::getInstancia()->query($query);
            //var_dump($query);
            if (!$consulta) {
                BDConexion::getInstancia()->rollback();
                //arrojar una excepcion
                die(BDConexion::getInstancia()->errno);
            }
                        
            BDConexion::getInstancia()->commit();
            BDConexion::getInstancia()->autocommit(true);
            
        } else {
            // no es profesor, procedemos a actualizar los campos
            
            BDConexion::getInstancia()->autocommit(false);
            BDConexion::getInstancia()->begin_transaction();

            $query = "UPDATE usuario "
            . "SET nombre = '{$DatosFormulario["nombre"]}', email = '{$DatosFormulario["email"]}' "
            . "WHERE id = {$idUsuario}";
            $consulta = BDConexion::getInstancia()->query($query);
            if (!$consulta) {
                BDConexion::getInstancia()->rollback();
                //arrojar una excepcion
                die(BDConexion::getInstancia()->errno);
            }

            $query = "DELETE FROM usuario_rol "
                    . "WHERE id_usuario = {$idUsuario}";
            $consulta = BDConexion::getInstancia()->query($query);
            if (!$consulta) {
                BDConexion::getInstancia()->rollback();
                //arrojar una excepcion
                die(BDConexion::getInstancia()->errno);
            }
            
            $query = "INSERT INTO usuario_rol "
                     . "VALUES ({$idUsuario}, {$DatosFormulario["rol"]})";
            $consulta = BDConexion::getInstancia()->query($query);
            if (!$consulta) {
                BDConexion::getInstancia()->rollback();
                //arrojar una excepcion
                die(BDConexion::getInstancia()->errno);
            }
            
            BDConexion::getInstancia()->commit();
            BDConexion::getInstancia()->autocommit(true);
        }
        
        
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
        <title><?= Constantes::NOMBRE_SISTEMA; ?> - Actualizar Usuario</title>
    </head>
    <body>
        <?php include_once '../gui/navbar.php'; ?>

        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h3>Actualizar Usuario</h3>
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
