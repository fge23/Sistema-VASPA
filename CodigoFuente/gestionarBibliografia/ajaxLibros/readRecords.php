<?php
include_once '../../modeloSistema/BDConexionSistema.Class.php';
header('Content-Type: text/html; charset=UTF-8');
$idPrograma = $_GET["id"];
/**
 *
 * @var mysqli_result
 */
$datos;


//Diseño de headers de tabla inicial 
$data = '<table class="table table-hover table-sm">
						<tr class="table-info">
							<th>Referencia</th>
							<th>Autor/es</th>
							<th>A&ntildeo</th>
							<th>T&iacute;tulo</th>
                                                        <th>Cap&iacute;tulo/Tomo/P&aacute;gina</th>
                                                        <th>Lugar de Edici&oacute;n</th>
                                                        <th>Editoral</th>
                                                        <th>Tipo</th>
                                                      
							<th>Opciones</th>
						</tr>';

$query = "SELECT * FROM libro  WHERE idPrograma = {$idPrograma} order by tipoLibro ASC";
$datos = BDConexionSistema::getInstancia()->query($query);

for ($x = 0; $x < $datos->num_rows; $x++) {
    $libros[] = $datos->fetch_assoc();
   
    $tipoLibro = "";
    if ($libros[$x]['tipoLibro'] == "O") {
        $tipoLibro = "Obligatoria";
    } else {
        $tipoLibro = "Complementaria";
    }

    $data .= '<tr>
				<td>' . $libros[$x]['referencia'] . '</td>
                                <td>' . $libros[$x]['apellido'] . ' '. $libros[$x]['nombre'] . '</td>
				<td>' . $libros[$x]['anioEdicion'] . '</td>
                                <td>' . $libros[$x]['titulo'] . '</td>
                                <td>' . $libros[$x]['capitulo'] . '</td>
                                <td>' . $libros[$x]['lugarEdicion'] . '</td>
                                <td>' . $libros[$x]['editorial'] . '</td>
                                <td>' . $tipoLibro.'</td>
                             
				<td>
                                <a title="Modificar">
                                            <button type="button" class="btn btn-outline-warning" onclick="ReadRecordDetails(' . $libros[$x]['id'] . ')">
                                                <span class="oi oi-pencil"></span>
                                            </button>
                                </a>
                                 <a title="Eliminar">
                                            <button type="button" class="btn btn-outline-danger" onclick="DeleteRecord(' . $libros[$x]['id'] . ')" >
                                                <span class="oi oi-trash"></span>
                                            </button>
                                 </a>  
				</td>
    		</tr>';
}
$data .= '</table>';
echo $data;
?>