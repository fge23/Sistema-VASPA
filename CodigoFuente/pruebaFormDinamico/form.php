<?php
include_once '../lib/ControlAcceso.Class.php';
?>
<html>
    <head>   
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
        <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
        <script type="text/javascript">
            function add_row()
            {
                $rowno = $("#employee_table tr").length;
                $rowno = $rowno + 1;
                $("#employee_table tr:last").after("<tr id='row" + $rowno + "'>\n\
        <td><input type='text' name='apellido[]'></td>\n\
        <td><input type='text' name='nombre[]'></td>\n\
        <td><input type='text' name='titulo[]'></td>\n\
        <td><input type='text' name='datosAdicionales[]'></td>\n\
        <td><input type='text' name='disponibilidad[]'></td>\n\
        <td><input type='button' class='btn btn-danger' value='Eliminar' onclick=delete_row('row" + $rowno + "')></td></tr>");
            }
            function delete_row(rowno)
            {
                $('#' + rowno).remove();
            }
        </script>
        <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Crear Recurso</title>
    </head>
    <body>
        <?php include_once '../gui/navbar.php'; ?>
        <div id="wrapper">

            <div id="form_div">
                <form method="post" action="procesaRecurso.php">
                    <table id="employee_table" align=center class="table table-hover table-sm">
                        <tr>
                            <th>Apellido</th>
                            <th>Nombre</th>
                            <th>T&iacute;tulo</th>
                            <th>Datos Adicionales</th>
                            <th>Disponibilidad/Dir. Electr&oacute;nica</th>
                        </tr>
                        <tr id="row1">
                            <td><input type="text" name="apellido[]"></td>
                            <td><input type="text" name="nombre[]"></td>
                            <td><input type="text" name="titulo[]"></td>
                            <td><input type="text" name="datosAdicionales[]"></td>
                            <td><input type="text" name="disponibilidad[]"></td>
                        </tr>
                    </table>
                    <input type="button" class="submit btn btn-info" onclick="add_row();" value="Agregar Recurso">
                    <input type="submit" class="submit btn btn-success" name="submit_row" value="Guardar">
                </form>
            </div>

        </div>
    </body>
</html>