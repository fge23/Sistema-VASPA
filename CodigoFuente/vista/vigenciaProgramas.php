<?php
/* 
 * Esta pantalla muestra un listado con la vigencia de los programas de asignaturas
 */
include_once '../lib/ControlAcceso.Class.php';
include_once '../lib/Constantes.Class.php';
include_once '../modeloSistema/BDConexionSistema.Class.php';

$consulta = "SELECT plan.idCarrera, asignatura.id, asignatura.nombre AS nombreAsignatura, profesor.apellido, profesor.nombre AS nombreProfesor "
        . "FROM plan JOIN plan_asignatura ON plan.id = plan_asignatura.idPlan JOIN asignatura ON "
        . "plan_asignatura.idAsignatura = asignatura.id JOIN profesor ON asignatura.idProfesor = profesor.id";

$resultados = BDConexionSistema::getInstancia()->query($consulta);

?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
        <!--<link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.15.4/dist/bootstrap-table.min.css">-->
        <link rel="stylesheet" href="../lib/bootstrap-table/bootstrap-table.min.css">
        <link rel="stylesheet" type="text/css" href="../lib/bootstrap-table/extensions/filter-control/bootstrap-table-filter-control.css">
        <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
        <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>
        <!--<script src="https://unpkg.com/bootstrap-table@1.15.4/dist/bootstrap-table.min.js"></script>-->
        <script src="../lib/bootstrap-table/bootstrap-table.min.js"></script>
        <script src="../lib/bootstrap-table/extensions/filter-control/bootstrap-table-filter-control.js"></script>
        <script src="../lib/bootstrap-table/extensions/export/bootstrap-table-export.min.js"></script>
        <script src="../lib/bootstrap-table/extensions/toolbar/bootstrap-table-toolbar.min.js"></script>
        <script src= "../lib/bootstrap-table/locale/bootstrap-table-es-ES.js" ></script>

        <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Vigencia de los Programas</title>

    </head>
    <body>

        <?php include_once '../gui/navbar.php';   ?>

        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h3>Vigencia de los Programas</h3>
<!--                        <p>
                            el bot&oacute;n <b>Enviar notificaci&oacute;n</b>.<br/>
                            Si desea cancelar, presione el bot&oacute;n <b>Cancelar</b>.
                        </p>-->
<!--                    <label>Ingrese el nombre de la asignatura:</label>
                    <input type="text" name="caja_busqueda" id="caja_busqueda" 
                    class="form-control" placeholder="Ingrese nombre de la asignatura">-->
                </div>
                <div class="card-body" id="datos">
                    <div id="toolbar">
                        <select class="form-control">
                            <option value="">Exportaci&oacute;n B&aacute;sica</option>
                            <option value="all">Exportar Todo</option>
                            <option value="selected">Exportar Seleccionados</option>
                        </select>
                    </div>

                    <table id="table" 
                           data-toggle="table"
                           data-locale="es-ES"
                           data-search="true"
                           data-filter-control="true" 
                           data-show-export="true"
                           data-pagination="true"
                           data-pagination-loop="false"
                           data-pagination-pre-text="Anterior"
                           data-pagination-next-text="Siguiente"
                           data-advanced-search="true"
                           data-id-table="advancedTable"
                           data-click-to-select="true"
                           data-toolbar="#toolbar"
                           class="table table-hover table-sm">
                        <thead>
                            <tr>
                                <th data-field="state" data-checkbox="true"></th>
                                <th data-field="carrera" data-filter-control="select" data-sortable="true" data-halign="center" data-align="center">Carrera</th>
                                <th data-field="anio" data-filter-control="select" data-sortable="true" data-halign="center" data-align="center">A&ntilde;o</th>
                                <th data-field="cuatrimestre" data-filter-control="select" data-sortable="true" data-halign="center" data-align="center">Cuatrimestre</th>
                                <th data-field="codigo" data-filter-control="select" data-sortable="true" data-halign="center" data-align="center">C&oacute;digo</th>
                                <th data-field="asignatura" data-filter-control="input" data-sortable="true" data-halign="center" data-align="center">Asignatura</th>
                                <th data-field="docenteResponsable" data-filter-control="input" data-sortable="true" data-halign="center" data-align="center">Docente Responsable</th>
                                <th data-field="vigencia" data-halign="center" data-align="center">Vigencia</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                               <?php
                                $contador = 0;
                                while ($registro=$resultados->fetch_assoc()) { ?>
                                <td class="bs-checkbox "><input data-index="<?= $contador; ?>" name="btSelectItem" type="checkbox"></td>  
                                <td><?php echo $registro['idCarrera']; ?></td> 
                                <td></td>
                                <td></td>
                                <td><?php echo $registro['id']; ?></td>
                                <td><?php echo $registro['nombreAsignatura']; ?></td>
                                <td><?= $registro['apellido'].' '.$registro['nombreProfesor'] ?></td>
                                <td></td>
                                </tr>
                               <?php $contador++; 
                                } ?>
                            
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php include_once '../gui/footer.php'; ?>
        <!--<script type="text/javascript" src="../lib/js/jquery.min.js"></script>-->
        
        <script>
            $(function() {
              $('#table').bootstrapTable()
            });
        </script>
    </body>
</html>