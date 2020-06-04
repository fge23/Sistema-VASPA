<?php
include_once '../lib/Constantes.Class.php';
include_once '../modeloSistema/BDConexionSistema.Class.php';
include_once '../lib/ControlAcceso.Class.php';
ControlAcceso::requierePermiso(PermisosSistema::PERMISO_GESTIONAR_BIBLIOGRAFIA);

$idPrograma = $_GET["id"];
//echo "El ID del programa es: " . $idPrograma;


$cantidadLibrosObligatorios = getEstadoLibrosObligatorios($idPrograma);
$cantidadLibrosComplementarios = getEstadoLibrosComplementarios($idPrograma);
$cantidadRevistas = getEstado($idPrograma, "revista");
$cantidadRecursos = getEstado($idPrograma, "recurso");
$cantidadOtros = getEstado($idPrograma, "otro_material");
?>

<html>
    <head>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
        <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>
        <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Bibliograf&iacute;a</title>
    </head>
</head>
<body>
    <?php include_once '../gui/navbar.php'; ?>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3>Gestionar Bibliografia del Programa</h3>
                <p>
                    A continuaci&oacute;n, podr&aacute; observar el estado de la Bibliograf&iacute;a cargada para el Programa de la asignatura X.<br/>
                    Si desea cargar autom&aacute;ticamente la Bibliograf&iacute;a del &uacute;ltimo Programa cargado (si existiese), presione el bot&oacute;n <b>Cargar Bibliograf&iacute;a de Programa Anterior</b><br/>
                    Si desea enviar el Programa a revisi&oacute;n, presione el bot&oacute;n <b>Enviar a revisi&oacute;n</b>.<br/>
                </p>
            </div>
            <div class="card-body">
                <style>
                    .letragrande{font-size:20px;}
                </style>


                <div id="btnCargarBiblioProgramaAnterior">
                    <a href="cargarBibliografiaProgramaAnterior.php?id=<?= $idPrograma; ?>">
                        <button type="button" class="btn btn-outline-info" id="btnCargarBibliografiaProgramaAnterior"   >
                            <span class="oi oi-caret-bottom"></span> Cargar Bibliograf&iacute;a de Programa Anterior
                        </button>
                    </a>
                    <br>
                    <small>Esta operaci&oacute;n s&oacute;lo est&aacute; disponible antes de cargar alg&uacute;n material bibliogr&aacute;fico para evitar registros repetidos</small>

                </div>

                <?php
                if (isset($_SESSION['estadoProgramaAnterior'])) {
                    if ($_SESSION['estadoProgramaAnterior'] == 0) {
                        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                        No se ha encontrado Programa anterior                       
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                          </button>
                         </div>';
                        $_SESSION['estadoProgramaAnterior'] = NULL;
                    } else {
                        //Existe Programa Anterior
                        if (isset($_SESSION['estadoBibliografia'])) {
                            if ($_SESSION['estadoBibliografia'] == 0) {
                                //No hay biliografia en el programa anterior
                                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                     No se ha encontrado material bibliogr&aacute;fico en el Programa anterior                       
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                     </div>';
                                 $_SESSION['estadoBibliografia'] = NULL;
                            } else {
                                //Hay biliografia en el programa anterior
                                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                Se agreg&oacute; la siguiente Bibliograf&iacute;a:
                                <br>
                                <ul> 
                                    <li>' . $_SESSION['cantidadLibros'] . ' Libros</li>
                                    <li>' . $_SESSION['cantidadRevistas'] . ' Art&iacute;culos de Revistas</li>
                                    <li>' . $_SESSION['cantidadRecursos'] . ' Recursos en Internet</li>
                                    <li>' . $_SESSION['cantidadOtroMaterial'] . ' otros materiales</li>
                                </ul>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                  </button>
                                 </div>';
                                 $_SESSION['estadoBibliografia'] = NULL;
                            }
                        }
                    }
                }
                ?>
                <br>
                <table class="table table-hover table-sm letragrande">
                    <tr class="table-info">
                        <th>Tipo de Bibliograf&iacute;a</th>
                        <th>Estado</th>
                    </tr>
                    <tr>

                        <td><a href="../gestionarBibliografia/libros.php?id=<?= $idPrograma; ?>">Libros - Bibliograf&iacute;a Obligatoria y Complementaria</a></td>
                        <td id="estadoLibros">
                            Se han cargado <?= $cantidadLibrosObligatorios ?> libros de tipo 'Bibliograf&iacute;a Obligatoria' 
                            y <?= $cantidadLibrosComplementarios ?> libros de tipo 'Bibliograf&iacute;a Complementaria' 
                        </td>
                    </tr>
                    <tr>
                        <td><a href="../gestionarBibliografia/revistas.php?id=<?= $idPrograma; ?>">Art&iacute;culos de Revistas</a></td>
                        <td id="estadoRevistas"> Se han cargado <?= $cantidadRevistas ?> Art&iacute;culos de Revistas </td>
                    </tr>
                    <tr>
                        <td><a href="../gestionarBibliografia/recursos.php?id=<?= $idPrograma; ?>">Recursos de Internet</a></td>
                        <td id="estadoRecursos"> Se han cargado <?= $cantidadRecursos ?> Recursos en Internet </td>
                    </tr>
                    <tr>
                        <td><a href="../gestionarBibliografia/otrosMateriales.php?id=<?= $idPrograma; ?>">Otros</a></td>
                        <td id="estadoOtros"> Se han cargado <?= $cantidadOtros ?> Otros materiales</td>
                    </tr>
                </table>
            </div>
            <div class="card-footer">
                <form action="enviarProgramaRevision.php" method="POST">

                    <input type="hidden" value="<?= $idPrograma ?>" name="idPrograma">
                    <button type="submit" class="btn btn-outline-success" id="btnEnviarPrograma">
                        <span class="oi oi-document"></span> Enviar Programa a Revisi&oacute;n
                    </button>
                    <a href="asignaturasDeProfesor.php">
                        <button type="button" class="btn btn-outline-danger">
                            <span class="oi oi-account-logout"></span> Continuar m&aacute;s tarde
                        </button>
                    </a>
                    <br>
                    <p>El Programa s&oacute;lo se podr&aacute; enviar a revisi&oacute;n cuando haya cargado al menos un libro de tipo Bibliograf&iacute;a obligatoria.</p>
                </form>




            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('#modalCargaBibliografia').modal('show');
            if (<?= $cantidadRevistas ?> === 0) {
                document.getElementById("estadoRevistas").style.color = "#e0a600";
            } else {
                document.getElementById("estadoRevistas").style.color = "green";
                document.getElementById("btnCargarBiblioProgramaAnterior").style.display = "none";
            }
            if (<?= $cantidadRecursos ?> === 0) {
                document.getElementById("estadoRecursos").style.color = "#e0a600";
            } else {
                document.getElementById("estadoRecursos").style.color = "green";
                document.getElementById("btnCargarBiblioProgramaAnterior").style.display = "none";
            }
            if (<?= $cantidadOtros ?> === 0) {
                document.getElementById("estadoOtros").style.color = "#e0a600";
            } else {
                document.getElementById("estadoOtros").style.color = "green";
                document.getElementById("btnCargarBiblioProgramaAnterior").style.display = "none";
            }
            if (<?= $cantidadLibrosObligatorios ?> === 0) {
                document.getElementById("estadoLibros").style.color = "red";
                document.getElementById("btnEnviarPrograma").disabled = true;
            } else {
                document.getElementById("estadoLibros").style.color = "green";
                document.getElementById("btnEnviarPrograma").disabled = false;
                document.getElementById("btnCargarBiblioProgramaAnterior").style.display = "none";

            }
            //La siguiente linea oculta el boton de cargar programa anterior si es que hay libros cargados
            //document.getElementById("btnCargarBiblioProgramaAnterior").style.display = "none";
        });
    </script>

</body>
</html

<?php

function getEstadoLibrosObligatorios($idPrograma) {
    $queryObligatorios = "SELECT COUNT(*) as librosObligatorios FROM libro WHERE idPrograma = {$idPrograma} AND tipoLibro = 'O'";
    $datosObligatorios = BDConexionSistema::getInstancia()->query($queryObligatorios);
    $resultadoObligatorios = $datosObligatorios->fetch_assoc();
    $cantidadLibrosObligatorios = $resultadoObligatorios['librosObligatorios'];
    return $cantidadLibrosObligatorios;
}

function getEstadoLibrosComplementarios($idPrograma) {
    $queryComplementarios = "SELECT COUNT(*) as librosComplementarios FROM libro WHERE idPrograma = {$idPrograma} AND tipoLibro = 'C'";
    $datosComplementarios = BDConexionSistema::getInstancia()->query($queryComplementarios);
    $resultadoComplementarios = $datosComplementarios->fetch_assoc();
    $cantidadLibrosComplementarios = $resultadoComplementarios['librosComplementarios'];
    return $cantidadLibrosComplementarios;
}

function getEstado($idPrograma, $tabla) {
    $query = "SELECT COUNT(*) as cantidad FROM {$tabla} WHERE idPrograma = {$idPrograma}";
    $datos = BDConexionSistema::getInstancia()->query($query);
    $resultado = $datos->fetch_assoc();
    $cantidad = $resultado['cantidad'];
    return $cantidad;
}
?>
