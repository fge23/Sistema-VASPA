<?php

include_once '../../modeloSistema/BDConexionSistema.Class.php';
header('Content-Type: text/html; charset=UTF-8');
/**
 *
 * @var mysqli_result
 */
$datos;


//Diseño de headers de tabla inicial 
$data = '<table class="table table-hover table-sm">
						<tr class="table-info">
							<th>T&iacute;tulo de Art&iacute;culo</th>
                                                        <th>T&iacute;tulo de Revista</th>
							<th>Apellido/s de Autor/es</th>
							<th>Nombre/s de Autor/es</th>
							<th>P&aacute;gina</th>
                                                        <th>Fecha</th>
                                                        <th>Unidad</th>
                                                        <th>Biblioteca</th>
                                                        <th>SIUNPA</th>
                                                        <th>Otro</th>
							<th>Opciones</th>
						</tr>';

$query = "SELECT id, "
        . "apellido, "
        . "nombre, "
        . "tituloRevista, "
        . "tituloArticulo, "
        . "DATE_FORMAT(fecha, '%d/%m/%Y') as fecha,"
        . "pagina, "
        . "unidad, "
        . "biblioteca, "
        . "siunpa, "
        . "otro FROM revista";
$datos = BDConexionSistema::getInstancia()->query($query);

for ($x = 0; $x < $datos->num_rows; $x++) {
    $revistas[] = $datos->fetch_assoc();

    $data .= '<tr>
				<td>' . $revistas[$x]['tituloArticulo'] . '</td>
                                <td>' . $revistas[$x]['tituloRevista'] . '</td>
				<td>' . $revistas[$x]['apellido'] . '</td>
				<td>' . $revistas[$x]['nombre'] . '</td>
                                <td>' . $revistas[$x]['pagina'] . '</td>
                                <td>' . $revistas[$x]['fecha'] . '</td>
                                <td>' . $revistas[$x]['unidad'] . '</td>
                                <td>' . $revistas[$x]['biblioteca'] . '</td>
                                <td>' . $revistas[$x]['siunpa'] . '</td>
                                <td>' . $revistas[$x]['otro'] . '</td>
				<td>
                                <a title="Modificar">
                                            <button type="button" class="btn btn-outline-warning" onclick="ReadRecordDetails(' . $revistas[$x]['id'] . ')">
                                                <span class="oi oi-pencil"></span>
                                            </button>
                                </a>
                                 <a title="Eliminar">
                                            <button type="button" class="btn btn-outline-danger" onclick="DeleteRecord(' . $revistas[$x]['id'] . ')" >
                                                <span class="oi oi-trash"></span>
                                            </button>
                                 </a>  
				</td>

    		</tr>';
}
$data .= '</table>';
echo $data;
?>