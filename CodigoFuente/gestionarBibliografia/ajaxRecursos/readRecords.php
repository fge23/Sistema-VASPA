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
							<th>T&iacute;tulo</th>
							<th>Apellido</th>
							<th>Nombre</th>
							<th>Datos Adicionales</th>
                                                        <th>Disponibilidad</th>
							<th>Opciones</th>
						</tr>';

$query = "SELECT * FROM recurso";
$datos = BDConexionSistema::getInstancia()->query($query);

 for ($x = 0; $x < $datos->num_rows; $x++) {
     $recursos[] = $datos->fetch_assoc();

$data .= '<tr>
				<td>'.$recursos[$x]['titulo'].'</td>
				<td>'.$recursos[$x]['apellido'].'</td>
				<td>'.$recursos[$x]['nombre'].'</td>
                                <td>'.$recursos[$x]['datosAdicionales'].'</td>
                                <td>'.$recursos[$x]['disponibilidad'].'</td>
				<td>
                                <a title="Modificar">
                                            <button type="button" class="btn btn-outline-warning" onclick="ReadRecordDetails('.$recursos[$x]['id'].')">
                                                <span class="oi oi-pencil"></span>
                                            </button>
                                </a>
                                 <a title="Eliminar">
                                            <button type="button" class="btn btn-outline-danger" onclick="DeleteRecord('.$recursos[$x]['id'].')" >
                                                <span class="oi oi-trash"></span>
                                            </button>
                                 </a>  
				</td>

    		</tr>';
}
$data .= '</table>';
echo $data;
?>