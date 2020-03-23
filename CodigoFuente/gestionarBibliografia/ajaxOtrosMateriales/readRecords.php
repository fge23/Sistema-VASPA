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
							<th>Descripci&oacute;n</th>
                                                        <th>Opciones</th>
						</tr>';

$query = "SELECT * FROM otro_material WHERE idPrograma = {$idPrograma}";
$datos = BDConexionSistema::getInstancia()->query($query);

 for ($x = 0; $x < $datos->num_rows; $x++) {
     $otros[] = $datos->fetch_assoc();

$data .= '<tr>
				<td>'.$otros[$x]['descripcion'].'</td>
				<td>
                                <a title="Modificar">
                                            <button type="button" class="btn btn-outline-warning" onclick="ReadRecordDetails('.$otros[$x]['id'].')">
                                                <span class="oi oi-pencil"></span>
                                            </button>
                                </a>
                                 <a title="Eliminar">
                                            <button type="button" class="btn btn-outline-danger" onclick="DeleteRecord('.$otros[$x]['id'].')" >
                                                <span class="oi oi-trash"></span>
                                            </button>
                                 </a>  
				</td>

    		</tr>';
}
$data .= '</table>';
echo $data;
?>