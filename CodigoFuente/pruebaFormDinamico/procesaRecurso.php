<?php
//A modo de prueba. Hay que traer el ID del Programa asociado e insertarlo en lugar de 2
//El resto creo que esta bien
if (isset($_POST['submit_row']))
    include_once '../modeloSistema/BDConexionSistema.Class.php'; {
        
    $apellido = $_POST['apellido'];
    $nombre = $_POST['nombre'];
    $titulo = $_POST['titulo'];
    $datosAdicionales = $_POST['datosAdicionales'];
    $disponibilidad = $_POST['disponibilidad'];
    
    var_dump($apellido);
    echo "<br>";
    var_dump($nombre);
    echo "<br>";
    var_dump($titulo);
    echo "<br>";
    var_dump($datosAdicionales);
    echo "<br>";
    var_dump($disponibilidad);

    echo count($apellido);
    for ($i = 0; $i < count($nombre); $i++) {
        if ($apellido[$i] != "" && $nombre[$i] != "" && $titulo[$i] != "" && $datosAdicionales[$i] != "" && $disponibilidad[$i] != "") {
            $query = "INSERT INTO RECURSO "
                    . "VALUES ("
                    . " null,"
                    . " '{$apellido[$i]}' , "
                    . "'{$nombre[$i]}' , "
                    . "'{$titulo[$i]}' , "
                    . "'{$datosAdicionales[$i]}' , "
                    . "'{$disponibilidad[$i]}' , "
                    . " 2) ";
            $consulta = BDConexionSistema::getInstancia()->query($query);
            if ($consulta) {
                echo "Siii";
            } else {
                echo 'NOOOOOO';
            }
        }
    }
}
?>