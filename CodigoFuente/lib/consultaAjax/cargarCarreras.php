<?php

include_once '../../modeloSistema/BDConexionSistema.Class.php';

function getCarreras() {
    $consulta = "SELECT * FROM CARRERA ORDER BY nombre ASC";
    $result = BDConexionSistema::getInstancia()->query($consulta);
    //$listas = '<option value="0">Seleccione una Carrera</option>';
    $listas = '';

    if ($result->num_rows > 0) {
        while ($fila = $result->fetch_assoc()) {
            $listas .= '<option value="'.$fila['id'].'">'.$fila['id'].' - '.utf8_encode($fila['nombre']).'</option>';
        }
    }
    return $listas;
}

echo getCarreras();
