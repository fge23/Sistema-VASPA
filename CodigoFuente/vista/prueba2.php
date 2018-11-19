<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $items1 = ($_POST['idalumno']);
        $items2 = ($_POST['nombre']);
        $items3 = ($_POST['carrera']);
        $items4 = ($_POST['grupo']);

        var_dump($items1);
        var_dump($items2);
        var_dump($items3);
        var_dump($items4);

        while (true) {

            //// RECUPERAR LOS VALORES DE LOS ARREGLOS ////////
            $item1 = current($items1);
            $item2 = current($items2);
            $item3 = current($items3);
            $item4 = current($items4);

            ////// ASIGNARLOS A VARIABLES ///////////////////
            $id = (( $item1 !== false) ? $item1 : ", &nbsp;");
            $nom = (( $item2 !== false) ? $item2 : ", &nbsp;");
            $carr = (( $item3 !== false) ? $item3 : ", &nbsp;");
            $gru = (( $item4 !== false) ? $item4 : ", &nbsp;");

            //// CONCATENAR LOS VALORES EN ORDEN PARA SU FUTURA INSERCIÓN ////////
            $valores = '(' . $id . ',"' . $nom . '","' . $carr . '","' . $gru . '"),';

            //////// YA QUE TERMINA CON COMA CADA FILA, SE RESTA CON LA FUNCIÓN SUBSTR EN LA ULTIMA FILA /////////////////////
            $valoresQ = substr($valores, 0, -1);

            ///////// QUERY DE INSERCIÓN ////////////////////////////
            $sql = "INSERT INTO alumnos (id_alumno, nombre, carrera, grupo) 
					VALUES $valoresQ";


            $sqlRes = $conexion->query($sql) or mysql_error();


            // Up! Next Value
            $item1 = next($items1);
            $item2 = next($items2);
            $item3 = next($items3);
            $item4 = next($items4);

            // Check terminator
            if ($item1 === false && $item2 === false && $item3 === false && $item4 === false){
                break;
        }

        }
        ?>

    </body>
</html>
