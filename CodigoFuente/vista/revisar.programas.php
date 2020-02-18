<?php
header ('Content-Type: text/html; charset=ISO-8859-1');
/* Aqui comienza el CU Revisar Programa
 * Observaciones: 
 * - Falta filtrar de acuerdo al departamento de la materia y dependiendo
 * el rol del usuario, si es de SA puede revisar todos los programas pero si es el 
 * director del departamento de CS Sociales, solo deberia revisar los programas de 
 * aquellas asignaturas que correspondan al departamento anterior
 * 
 * - Tanto cuando se aprueba o se desaprueba un programa, se actualizan ambos atributos
 * (aprobadoSa y aprobadoDepto al igual que los comentarios). Estoy hay que corregir una 
 * vez definido los roles y gestion de usuarios
 */
include_once '../lib/ControlAcceso.Class.php';
//include_once '../modeloSistema/Programa.Class.php';
//include_once '../modeloSistema/Asignatura.Class.php';
include_once '../modeloSistema/BDConexionSistema.Class.php';


//Se obtiene las asignaturas las cuales tengan cargado su programa para luego revisar el documento
$consulta = 'SELECT nombre, asignatura.id as idAsignatura, programa.id as idPrograma FROM asignatura JOIN programa WHERE asignatura.id = programa.idAsignatura ORDER BY nombre ASC';
$asignaturas = BDConexionSistema::getInstancia()->query($consulta);
//$asignaturas=$mysqli->query($consulta);
//$asignatura=$asignaturas->fetch_assoc();
//echo $asignatura['nombre'];
//$asignatura=$asignaturas->fetch_assoc();
//var_dump($asignatura);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
        <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>        
           <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Programas</title>
    </head>
    <body>

        <?php include_once '../gui/navbar.php'; ?>

        <div class="container">

            <div class="card">
                <div class="card-header">
                    <h3>Revisar Programa - <span class="text-info">Programas de asignaturas</span></h3>
                </div>
                <div class="card-body">
                    
                    <table class="table table-hover table-sm">
                        <tr class="table-info text-center">
                            <th>Programa de:</th>
                            <th>C&oacute;digo asignatura</th>
                            <th></th>
                        </tr>
                        <tr>
                            <?php while ($asignatura=$asignaturas->fetch_assoc()){ ?>
                                <td><?php echo $asignatura['nombre']; ?></td>
                                <td class="text-center"><?php echo $asignatura['idAsignatura']; ?></td>
                                <td class="text-center">
                                        <a title="Revisar Programa" href="revisar.programa.php?id=<?= $asignatura['idPrograma']; ?>">
                                        <button type="button" class="btn btn-outline-success">
                                            <span class="oi oi-document"></span>
                                        </button></a>
<!--                                        <a title="Ver detalle" href="#">
                                        <button type="button" class="btn btn-outline-info">
                                            <span class="oi oi-zoom-in"></span>
                                        </button></a>-->
                                </td>
                                </tr>
                        <?php } ?>   
                                
                                
                    </table>
                        
                </div>
            </div>
        </div>
         <?php include_once '../gui/footer.php'; ?>
    </body>
</html>

