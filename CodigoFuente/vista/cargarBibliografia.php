<?php
include_once '../lib/Constantes.Class.php';
?>

<html>
    <head>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
        <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>
        <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Agregar Revista</title>
    </head>

</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3>Agregar Bibliografia</h3>
                <p>
                    Complete los campos a continuaci&oacute;n. 
                    Luego, presione el bot&oacute;n <b>Siguiente</b> para pasar a la siguiente secci&oacute;n.<br />
                    Si desea cancelar, presione el bot&oacute;n <b>Cancelar</b>.
                </p>
            </div>
            <div class="card-body">
                <form method="post" action="prueba2.php">
                    <h3 class="bg-primary text-center pad-basic no-btm">Agregar Revista </h3>
                    <table class="table table-borderless" id="tabla">

                        <tr class="fila-fija">
                            <td><input class="form-control" required name="apellido[]" placeholder="Apellido del Autor"/></td>
                            <td><input class="form-control" required name="nombre[]" placeholder="Nombre del Autor"/></td>
                            <td><input class="form-control" required name="tituloArticulo[]" placeholder="T&iacute;tulo del Art&iacute;culo"/></td>
                            <td><input class="form-control" required name="tituloRevista[]" placeholder="T&iacute;tulo de la Revista"/></td>
                            <td><input class="form-control" required name="pagina[]" placeholder="Tomo, Volumen o P&aacute;gina"/></td>

                        </tr>
                        <tr class="fila-fija">
                            <td><input class="form-control" required name="fecha[]" placeholder="Fecha"/></td>
                            <td><input class="form-control" required name="unidad[]" placeholder="Unidad"/></td>
                            <td><input class="form-control" required name="biblioteca[]" placeholder="Biblioteca"/></td>
                            <td><input class="form-control" required name="siunpa[]" placeholder="SIUNPA"/></td>
                            <td><input class="form-control" required name="otro[]" placeholder="Otro"/></td>
                            <td class="eliminar"><input class="btn-danger" type="button"   value="Menos -"/></td>
                        </tr>

                    </table>

                    <div class="btn-der">
                        <input type="submit" name="insertar" value="Guardar" class="btn btn-info"/>
                        <button id="adicional" name="adicional" type="button" class="btn btn-warning"> Agregar + </button>

                    </div>
                </form>
            </div>
            <script>
                $(function () {
                    // Clona la fila oculta que tiene los campos base, y la agrega al final de la tabla
                    $("#adicional").on('click', function () {
                        $("#tabla tbody tr:eq(0),tr:eq(1)").clone().removeClass('fila-fija').appendTo("#tabla");
                    });

                    // Evento que selecciona la fila y la elimina 
                    $(document).on("click", ".eliminar", function () {
                        var parent = $(this).parents().get(0);

                        var p1 = $(parent).parents().children().get(0);
                        var p2 = $(parent).parents().children().get(1);
                        $(p1).remove();
                        $(p2).remove();


                    });
                });

            </script>
            </body>
            </html