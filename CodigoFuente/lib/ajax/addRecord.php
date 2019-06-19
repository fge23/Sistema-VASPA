<?php

$query;
/**
 *
 * @var mysqli_result
 */
$consulta;
if (isset($_POST['nuevo_apellido']) && isset($_POST['nuevo_nombre']) && isset($_POST['nuevo_titulo'])
        && isset($_POST['nuevo_datos_adicionales']) && isset($_POST['nuevo_disponibilidad'])) {
    // include Database connection file 
    include_once '../../modeloSistema/BDConexionSistema.Class.php';

    // get values 

 $nuevo_apellido =  $_POST['nuevo_apellido'];
 $nuevo_nombre =  $_POST['nuevo_nombre'];
 $nuevo_titulo =  $_POST['nuevo_titulo'];
 $nuevo_datos_adicionales =  $_POST['nuevo_datos_adicionales'];
 $nuevo_disponibilidad =  $_POST['nuevo_disponibilidad'];
       
 var_dump($_POST);
    
    $query = "INSERT INTO RECURSO "
            . "VALUES ("
            . " null,"
            . " '{$nuevo_apellido}' , "
            . "'{$nuevo_nombre}' , "
            . "'{$nuevo_titulo}' , "
            . "'{$nuevo_datos_adicionales}' , "
            . "'{$nuevo_disponibilidad}' , "
            . " 2) ";
    $consulta = BDConexionSistema::getInstancia()->query($query);
    if ($consulta) {
        echo "1 Record Added!";
        return true;
    } else {
        echo "Error";
        return false;
    }
}
?>