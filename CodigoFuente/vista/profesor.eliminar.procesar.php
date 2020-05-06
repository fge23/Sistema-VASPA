<?php
include_once '../lib/Constantes.Class.php';
include_once '../controlSistema/ManejadorProfesor.php';
include_once '../modeloSistema/Profesor.Class.php';
include_once '../modeloSistema/BDConexionSistema.Class.php';

$DatosFormulario = $_POST;
$ManejadorProfesor = new ManejadorProfesor();
$profesor = new Profesor($DatosFormulario['id']);

$error = '';
$consulta = FALSE;

if (is_null($profesor->obtenerAsignaturas())){
    // El profesor no tiene asignaturas se lo puede eliminar
    
    // Chequeamos si el profesor es un usuario del sistema
    $sql = "SELECT id FROM ".Constantes::BD_USERS.".usuario "
            . "WHERE email LIKE '{$profesor->getEmail()}'";
            
    $consulta = BDConexionSistema::getInstancia()->query($sql);
    if (!$consulta){
        $error = 'Error al realizar petici&oacute;n a la Base de Datos';
    } else {
        
        $cantidadRegistros = $consulta->num_rows;
        
        if ($cantidadRegistros == 0){
            // como devolvio cero registros la peticion a la BD, el profesor no tiene usuario con lo cual se lo deberia eliminar de la tabla profesor
            
            // Comprobamos si es parte de un equipo de catedra de asignatura, si es no permitir eliminar y mostrar mensaje
            $sql = "SELECT * FROM profesor_asignatura WHERE idProfesor = {$profesor->getId()}";
            $resultado = BDConexionSistema::getInstancia()->query($sql);
            if (!$resultado){
                $error = 'Error al realizar petici&oacute;n a la Base de Datos.';
            } else {
                $numFilas = $resultado->num_rows;
                if ($numFilas > 0){
                    $error = 'El profesor forma parte de equipo de c&aacute;tedra. Operaci&oacute;n no permitida';
                    $consulta = FALSE;
                } else {
                    // no devolvio registros el profesor no forma parte de equipo de catedra se lo puede eliminar sin problemas.
                    $consulta = $ManejadorProfesor->baja($DatosFormulario['id']);
                }
                
            }
            
        } elseif ($cantidadRegistros == 1) {
            // devolvio un registro es un usuario del sistema, eliminarlo de USUARIO y PROFESOR
            // obtenemos el id del usuario del profesor
            $registro = $consulta->fetch_assoc();
            $idUsuario = $registro["id"];

            try {
                $consulta = $ManejadorProfesor->bajaUsuarioProfesor($profesor->getId(), $idUsuario);
            } catch (Exception $e) {
                $error = $e->getMessage();
                $consulta = FALSE;
            }
        } else {
            // no devolvio ni 0 ni un registro
            $error = 'Error al verificar si el profesor es un usuario del sistema';
            $consulta = FALSE;
        }
        
    }
    
} else {
    // El profesor tiene asignaturas no se lo puede eliminar
    $error = 'El profesor que intenta eliminar es un <b>Profesor responsable de Asignaturas</b>, y tiene asignaturas a su cargo. Operaci&oacute;n no permitida.';
    $consulta = FALSE;
}

?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
        <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>
        <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Eliminar Profesor</title>
    </head>
    <body>
        <?php include_once '../gui/navbar.php'; ?>
        <div class="container">
            <p></p>
            <div class="card">
                <div class="card-header">
                    <h3>Eliminar Profesor</h3>
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
