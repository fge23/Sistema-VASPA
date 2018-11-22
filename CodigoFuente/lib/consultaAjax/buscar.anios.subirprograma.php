<?php
/*
 * En este archivo se lleva a cabo el filtrado para el archivo listar.anios.subirprograma.php
 */
include_once '../../modeloSistema/BDConexionSistema.Class.php';
$consulta = "SELECT anio FROM ANIO ORDER BY anio DESC LIMIT 25";
$datos = BDConexionSistema::getInstancia()->query($consulta);

$salida = "";

if (isset($_POST['consulta'])) {
    $q = BDConexionSistema::getInstancia()->real_escape_string($_POST['consulta']);
    $consulta = "SELECT anio FROM ANIO WHERE anio LIKE '%".$q."%'";
}
$datos = BDConexionSistema::getInstancia()->query($consulta);

if ($datos->num_rows > 0){
    $salida.="<table class='table table-hover table-sm'>
                        <tr class='table-info'>
                            <th>A&ntilde;o</th>
                        </tr>";
    
    while($fila = $datos->fetch_assoc()){
        $salida.="<tr><td><a href='subir.programa.php?anio=".$fila['anio']."'>".$fila['anio']."</a></td></tr>";
    }
    
    $salida.="</table>";
    
}
else {
    $salida.="No se encontraron coincidencias :(";
}

echo $salida;

?>