<?php
include_once '../lib/Constantes.Class.php';
include_once '../modeloSistema/BDConexionSistema.Class.php';

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
                <h3>Agregar Bibliografia</h3>
                <p>
                    A continuaci&oacute;n, podr&aacute; observar el estado de la Bibliograf&iacute;a cargada para el Programa.<br/>
                    Si desea enviar el Programa a revisi&oacute;n, presione el bot&oacute;n <b>Enviar a revisi&oacute;n</b><br/>
                    Si desea continuar m&aacute;s tarde, presione el bot&oacute;n <b>Continuar m&aacute;s tarde</b>
                </p>
            </div>
            <div class="card-body">
                <style>
                    .letragrande{font-size:17px;}
                </style>

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
                <a href="cargarBibliografia.php?id=<?= $idPrograma; ?>">
                    <button type="button" class="btn btn-primary">
                        <span class="oi oi-document"></span> Enviar Programa a Revisi&oacute;n
                    </button>
                </a>
                <a href="asignaturasDeProfesor.php">
                    <button type="button" class="btn btn-primary">
                        <span class="oi oi-account-logout"></span> Continuar m&aacute;s tarde
                    </button>
                </a>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            if (<?= $cantidadRevistas ?> === 0) {
                document.getElementById("estadoRevistas").style.color = "#F4B400";
            } else {
                document.getElementById("estadoRevistas").style.color = "green";
            }
             if (<?= $cantidadRecursos ?> === 0) {
                document.getElementById("estadoRecursos").style.color = "#F4B400";
            } else {
                document.getElementById("estadoRecursos").style.color = "green";
            }
             if (<?= $cantidadOtros ?> === 0) {
                document.getElementById("estadoOtros").style.color = "#F4B400";
            } else {
                document.getElementById("estadoOtros").style.color = "green";
            }
            if (<?= $cantidadLibrosObligatorios ?> === 0) {
                document.getElementById("estadoLibros").style.color = "red";
            } else {
                document.getElementById("estadoLibros").style.color = "green";
            }

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
