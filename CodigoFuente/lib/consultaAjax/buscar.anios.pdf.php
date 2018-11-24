<?php
/*
 * En este archivo se lleva a cabo el filtrado para el archivo anio.visualizar.pdf.php
 */
include_once '../../modeloSistema/BDConexionSistema.Class.php';
//$consulta = "SELECT anio FROM ANIO ORDER BY anio DESC LIMIT 25";
$consulta = "SELECT DISTINCT ANIO.anio FROM ANIO INNER JOIN PROGRAMA_PDF ON ANIO.anio = PROGRAMA_PDF.anio ORDER BY anio DESC LIMIT 25";
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
        $salida.="<tr><td><a href='listar.programa.pdf.php?anio=".$fila['anio']." 'style='text-decoration:none;color:black;'>".$fila['anio']."</a></td></tr>";
    }
    
    $salida.="</table>";
    
}
else {
    $salida.="No se encontraron coincidencias :(";
}

echo $salida;

?>