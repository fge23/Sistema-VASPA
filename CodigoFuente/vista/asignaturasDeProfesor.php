<?php
//include_once '../controlSistema/ManejadorAsignatura.php';
include_once '../lib/ControlAcceso.Class.php';
require_once '../modeloSistema/Profesor.Class.php';
require_once '../modeloSistema/BDConexionSistema.Class.php';


//$ManejadorAsignatura = new ManejadorAsignatura();
//$Asignaturas = $ManejadorAsignatura->getColeccion();

// Obtenemos el rol del usuario logueado en el sistema
$usuario = $_SESSION['usuario'];
$rol = $usuario->roles[0]->nombre;

// Obtenemos el email del profesor
$email = $usuario->email;
//var_dump($usuario->email);

// Preparamos la query para obtener todos los datos de Profesor segun el email
$sql = "SELECT * "
     . "FROM profesor "
     . "WHERE email = '{$email}'";
     
$resultado = BDConexionSistema::getInstancia()->query($sql);

$mostrarError = FALSE; // variable que utilizaremos para mostrar el Error (error Bd, no existe profesor)
// validamos el resultado de la query (si retorna false -> Ocurrio un error en la BD) Lanzamos una Excepcion informando el Error
if (!$resultado) {
    $mensaje = "Ocurrio un Error al obtener los datos del Profesor con email: {$email}.";
    $mostrarError = TRUE;
} elseif ($resultado->num_rows == 1) { // los correos no se pueden repetir por lo que deberia deber 1 o 0 registro
    $profesor = $resultado->fetch_object("Profesor"); // creamos objeto Profesor
} else {
    $mensaje = "No hay Profesor en el Sistema con email: <b>{$email}.</b>";
    $mostrarError = TRUE;
}

if (!$mostrarError){ // No ocurrio un error, y existe el profesor, obtenemos las asignaturas
    $asignaturas = $profesor->obtenerAsignaturas();
}

?>


<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
        <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>        
        <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Mis Asignaturas</title>

    </head>
    <body>

        <?php include_once '../gui/navbar.php';   ?>

        <div class="container">
            <div class="card">
                <div class="card-header">

                    <h3>Mis Asignaturas</h3>
                </div>
                <div class="card-body">
                    <?php
                    if ($mostrarError) { ?>
                        <div class="alert alert-danger text-center" role="alert">
                            <?= $mensaje;?>
                        </div>
                    <?php
                    } else {
                        //var_dump($asignaturas);
                        if (is_null($asignaturas)){ ?>
                            <div class="alert alert-warning text-center" role="alert">
                                No hay asignaturas en la cual el profesor es responsable.
                            </div>
                        <?php    
                        } else { ?>
                            <table class="table table-hover table-sm">
                        <tr class="table-info">
                            <th>C&oacute;digo de Asignatura</th>
                            <th>Nombre</th>
                            <th>Gestionar Programa</th>
                        </tr>
                        <tr>
                            <?php foreach ($asignaturas as $Asignatura) { ?>
                            <td><?= $Asignatura->getId(); ?></td>
                            <td><?= $Asignatura->getNombre(); ?></td>

                                <td>
                                    <a title="Nuevo Programa" href="programa.crear.php?id=<?= $Asignatura->getId(); ?>">
                                        <button type="button" class="btn btn-outline-success">
                                            <span class="oi oi-plus"></span>
                                        </button>
                                    </a>
                                    <a title="Modificar Programa Actual" href="programa.modificar.php?id=<?= $Asignatura->getId(); ?>">
                                        <button type="button" class="btn btn-outline-warning">
                                            <span class="oi oi-pencil"></span>
                                        </button>
                                    </a>
                                    <!--if Programa.aprobadoSA == true AND Programa.aprobadoDepto == true 
                                    and programa.fueradevigencia then habilitar boton GenerarPDF-->
                                    <a title="Generar PDF" href="#">
                                        <button type="button" class="btn btn-outline-info">
                                            <span class="oi oi-document"></span>
                                        </button>
                                    </a>  
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                    <?php    
                        }
                    }
                    ?>
                    
                </div>
            </div>
        </div>
        <?php include_once '../gui/footer.php'; ?>
    </body>
</html>