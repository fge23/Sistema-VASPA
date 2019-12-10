<?php

header('Content-Type: application/json');
/*
 * Aqui se lleva a cabo el filtrado de la asignatura que se desea buscar
 */
//Para ocultar los warning que muestra por pantalla, estos warning hace referencia a los include
//error_reporting(0);

include_once '../../modeloSistema/BDConexionSistema.Class.php';

$aResult = array();
//$_POST['arguments'][0] = 2019;
//$_POST['arguments'][1] = '1668';
if (!isset($_POST['arguments'])) {
    $aResult['error'] = 'No se han enviado los argumentos!';
}

if (!isset($aResult['error'])) {
    if (!is_array($_POST['arguments']) || (count($_POST['arguments']) < 2)) {
        $aResult['error'] = 'Error en argumentos!';
    } else {
        echo "si";
        var_dump($_POST['arguments']);

        $query = "SELECT * "
                . "FROM PROGRAMA "
                . "WHERE anio < 2019 AND idAsignatura LIKE '1668' "
                . "ORDER BY anio DESC "
                . "LIMIT 1";
        try {
            $datos = BDConexionSistema::getInstancia()->query($query);
            $datos = $datos->fetch_assoc();
            $aResult = $datos;
            //var_dump($datos);
        } catch (Exception $e) {

            $e->getMessage();
        }
    }
}



echo json_encode($aResult);
?>