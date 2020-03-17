<?php
include_once '../lib/Constantes.Class.php';
$idPrograma = $_GET["id"];
//echo "El ID del programa es: " . $idPrograma;
?>

<html>
    <head>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
        <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>
        <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Bibliograf&ia&iacute;a</title>
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
                <table class="table table-hover table-sm">
                    <tr class="table-info">
                        <th>Tipo de Bibliograf&iacute;a</th>
                        <th>Estado</th>
                    </tr>
                    <tr>
                  
                        <td><a href="../gestionarBibliografia/libros.php">Libros - Bibliograf&iacute;a Obligatoria </a></td>
                   
                        <td>Estado Libros</td>
                    </tr>
                    <tr>
                        <td><a href="../gestionarBibliografia/libros.php">Libros - Bibliograf&iacute;a Complementaria</a></td>
                        <td>Estado Libros</td>
                    </tr>
                    <tr>
                        <td><a href="../gestionarBibliografia/revistas.php">Art&iacute;culos de Revistas</a></td>
                        <td>Estado Revistas</td>
                    </tr>
                    <tr>
                        <td><a href="../gestionarBibliografia/recursos.php">Recursos en Internet</a></td>
                        <td>Estado Recursos</td>
                    </tr>
                    <tr>
                        <td><a href="../gestionarBibliografia/otrosMateriales.php?id=<?= $idPrograma; ?>">Otros</a></td>
                        <td>Estado otros</td>
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

</html