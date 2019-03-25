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
        <td><input type='text' name='referencia[]' size='8'></td>\n\
        <td><input type='text' name='apellido[]'></td>\n\
        <td><input type='text' name='nombre[]'></td>\n\
        <td><input type='text' name='anio[]' size='4'></td>\n\
            <td><input type='text' name='titulo[]'></td>\n\
        \n\<td><input type='text' name='capitulo[]' size='3'></td>\n\
\n\<td><input type='text' name='editorial[]'></td>\n\
\n\ <td><input type='text' name='unidad[]' size='3'></td>\n\
\n\<td><input type='text' name='biblioteca[]' size='2'></td>\n\
\n\<td><input type='text' name='siunpa[]' size='2'></td>\n\
\n\<td><input type='text' name='otro[]' size='2'></td>\n\
\n\        <td><input type='button' class='btn btn-danger' value='-' title='Eliminar' onclick=delete_row('row" + $rowno + "')></td></tr>");
            }

            function delete_row(rowno)
            {
                $('#' + rowno).remove();
            }
        </script>
        <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Crear Recurso</title>
    </head>
    <body>
        <?php //ARREGLAR RESPONSIVO
        include_once '../gui/navbar2.php';
        ?>
        <div id="wrapper">

            <div id="form_div">
                <form method="post" action="recurso.crear.procesar.php">
                    <table id="employee_table" style="text-align:center;" class="table  table-sm">
                        <tr>
                            <th width="5%">Referencia</th>
                            <th width="10%">Apellido</th>
                            <th>Nombre</th>
                            <th width="1%">A&ntilde;o Edici&oacute;n</th>
                            <th width="10%">T&iacute;tulo</th>
                            <th width="3%">Cap&iacute;tulo</th>
                            <th>Editorial</th>
                            <th width="3%">Unidad</th>
                            <th>Biblioteca</th>
                            <th>SIUNPA</th> 
                            <th>Otro</th>
                        </tr>   
                        <tr id="row1">
                            <td><input type='text' name='referencia[]' size='8'></td>
                            <td><input type='text' name='apellido[]'></td>
                            <td><input type='text' name='nombre[]'></td>
                            <td><input type='text' name='anio[]' size='4'></td>
                            <td><input type='text' name='titulo[]'></td>
                            <td><input type='text' name='capitulo[]' size='3'></td>
                            <td><input type='text' name='editorial[]'></td>
                            <td><input type='text' name='unidad[]' size='3'></td>
                            <td><input type='text' name='biblioteca[]' size='2'></td>
                            <td><input type='text' name='siunpa[]' size='2'></td>
                            <td><input type='text' name='otro[]' size='2'></td>
                        </tr>
                    </table>
                    <input type="button" class="submit btn btn-info" onclick="add_row();" value="Agregar Recurso">
                    <input type="submit" class="submit btn btn-success" name="submit_row" value="Guardar">
                </form>
            </div>

        </div>
    </body>
</html>