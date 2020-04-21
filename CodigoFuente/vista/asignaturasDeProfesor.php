<?php
//include_once '../controlSistema/ManejadorAsignatura.php';
include_once '../lib/ControlAcceso.Class.php';
require_once '../modeloSistema/Profesor.Class.php';
require_once '../modeloSistema/BDConexionSistema.Class.php';
require_once '../modeloSistema/Programa.Class.php';


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
        <style type="text/css">
            .btn-outline-purple {
                color: #3a2166;
                background-color: transparent;
                background-image: none;
                border-color: #3a2166;
            }

            .btn-outline-purple:hover {
                color: #fff;
                background-color: #3a2166;
                border-color: #3a2166;
            }

            .btn-outline-purple:focus, .btn-outline-purple.focus {
                box-shadow: 0 0 0 0.2rem rgba(145, 109, 208, 1);
            }

            .btn-outline-purple.disabled, .btn-outline-purple:disabled {
                color: #3a2166;
                background-color: transparent;
            }

            .btn-outline-purple:not(:disabled):not(.disabled):active, .btn-outline-purple:not(:disabled):not(.disabled).active,
            .show > .btn-outline-purple.dropdown-toggle {
                color: #fff;
                background-color: #3a2166;
                border-color: #3a2166;
            }

            .btn-outline-purple:not(:disabled):not(.disabled):active:focus, .btn-outline-purple:not(:disabled):not(.disabled).active:focus,
            .show > .btn-outline-purple.dropdown-toggle:focus {
                box-shadow: 0 0 0 0.2rem rgba(145, 109, 208, 1);
            }
        </style>

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
                            <th>Estado del programa</th>
                            <th>Vigencia</th>
                            <th>Gestionar Programa</th>
                        </tr>
                        <tr>
                            <?php foreach ($asignaturas as $Asignatura) { ?>
                            <td><?= $Asignatura->getId(); ?></td>
                            <td><?= $Asignatura->getNombre(); ?></td>
                            <td><?php 
                                 // Recuperamos un objeto Programa, vigente (del anio actual) si es que lo tiene
                                 $programa = $Asignatura->obtenerProgramaVigente();
                                 $vigencia = '-';
                                 $botones = ''; // varibale donde almacenaremos etiquetas HTML para los botones
                                 if (is_null($programa)){
                                     echo 'No Cargado';
                                     $botones = '<a title="Nuevo Programa" class="btn btn-outline-success" href="programa.crear.php?id='.$Asignatura->getId().'" role="button"><span class="oi oi-plus"></span></a>&nbsp;'
                                             . '<a title="Modificar Programa Actual" class="btn btn-outline-warning disabled" href="#" role="button" aria-disabled="true"><span class="oi oi-pencil"></span></a>&nbsp;'
                                             . '<a title="Enviar a Revisi&oacute;n" class="btn btn-outline-purple disabled" href="#" role="button" aria-disabled="true"><span class="oi oi-share"></span></a>&nbsp;'
                                             . '<a title="Generar PDF" class="btn btn-outline-info disabled" href="#" role="button" aria-disabled="true"><span class="oi oi-document"></span></a>';
                                 } else {
                                     $estado = $programa->obtenerEstadoDelPrograma();
                                     $anioPrograma = $programa->getAnio();
                                     $vigencia = $programa->getVigencia();
                                     if ($vigencia == 1){
                                         $vigencia = "$anioPrograma";
                                     } elseif ($vigencia == 2) {
                                         $vigencia = "$anioPrograma - ".($anioPrograma+1);
                                     } elseif ($vigencia == 3) {
                                         $vigencia = "$anioPrograma - ".($anioPrograma+1)." - ".($anioPrograma+2);
                                     }
                                     echo $estado;
                                     
                                     // segun estado habilitamos ciertos botones
                                     switch ($estado) {
                                         case "En Vigencia":
                                             $botones = '<a title="Nuevo Programa" class="btn btn-outline-success" href="programa.crear.php?id='.$Asignatura->getId().'" role="button"><span class="oi oi-plus"></span></a>&nbsp;'
                                             . '<a title="Modificar Programa Actual" class="btn btn-outline-warning disabled" href="#" role="button" aria-disabled="true"><span class="oi oi-pencil"></span></a>&nbsp;'
                                             . '<a title="Enviar a Revisi&oacute;n" class="btn btn-outline-purple" href="#" role="button"><span class="oi oi-share"></span></a>&nbsp;'
                                             . '<a title="Generar PDF" class="btn btn-outline-info disabled" href="#" role="button" aria-disabled="true"><span class="oi oi-document"></span></a>';									
                                             break;
                                         case "Cargando":
                                             $botones = '<a title="Nuevo Programa" class="btn btn-outline-success disabled" href="#" role="button" aria-disabled="true"><span class="oi oi-plus"></span></a>&nbsp;'
                                             . '<a title="Modificar Programa Actual" class="btn btn-outline-warning" href="programa.modificar.php?id='.$Asignatura->getId().'" role="button"="true"><span class="oi oi-pencil"></span></a>&nbsp;'
                                             . '<a title="Enviar a Revisi&oacute;n" class="btn btn-outline-purple disabled" href="#" role="button" aria-disabled="true"><span class="oi oi-share"></span></a>&nbsp;'
                                             . '<a title="Generar PDF" class="btn btn-outline-info disabled" href="#" role="button" aria-disabled="true"><span class="oi oi-document"></span></a>';									
                                             break;
                                         case "En Revisi&oacute;n":
                                             $botones = '<a title="Nuevo Programa" class="btn btn-outline-success disabled" href="#" role="button" aria-disabled="true"><span class="oi oi-plus"></span></a>&nbsp;'
                                             . '<a title="Modificar Programa Actual" class="btn btn-outline-warning disabled" href="#" role="button" aria-disabled="true"><span class="oi oi-pencil"></span></a>&nbsp;'
                                             . '<a title="Enviar a Revisi&oacute;n" class="btn btn-outline-purple disabled" href="#" role="button" aria-disabled="true"><span class="oi oi-share"></span></a>&nbsp;'
                                             . '<a title="Generar PDF" class="btn btn-outline-info disabled" href="#" role="button" aria-disabled="true"><span class="oi oi-document"></span></a>';									
                                             break;
                                         case "Desaprobado":
                                             $botones = '<a title="Nuevo Programa" class="btn btn-outline-success disabled" href="#" role="button" aria-disabled="true"><span class="oi oi-plus"></span></a>&nbsp;'
                                             . '<a title="Modificar Programa Actual" class="btn btn-outline-warning" href="programa.modificar.php?id='.$Asignatura->getId().'" role="button"><span class="oi oi-pencil"></span></a>&nbsp;'
                                             . '<a title="Enviar a Revisi&oacute;n" class="btn btn-outline-purple disabled" href="#" role="button" aria-disabled="true"><span class="oi oi-share"></span></a>&nbsp;'
                                             . '<a title="Generar PDF" class="btn btn-outline-info disabled" href="#" role="button" aria-disabled="true"><span class="oi oi-document"></span></a>';									
                                             break;
                                         case "Aprobado":
                                             $botones = '<a title="Nuevo Programa" class="btn btn-outline-success disabled" href="#" role="button" aria-disabled="true"><span class="oi oi-plus"></span></a>&nbsp;'
                                             . '<a title="Modificar Programa Actual" class="btn btn-outline-warning disabled" href="#" role="button" aria-disabled="true"><span class="oi oi-pencil"></span></a>&nbsp;'
                                             . '<a title="Enviar a Revisi&oacute;n" class="btn btn-outline-purple disabled" href="#" role="button" aria-disabled="true"><span class="oi oi-share"></span></a>&nbsp;'
                                             . '<a title="Generar PDF" class="btn btn-outline-info" href="../controlSistema/programa.revisar.generarpdf.php?id='.$programa->getId().'" role="button" target="_blank"><span class="oi oi-document"></span></a>';									
                                             break;
                                         default:
                                             break;
                                     }
                                 }
                                ?>
                            </td>
                            <td><?= $vigencia;?></td>

                                <td>
                                    <?php echo $botones; ?>
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