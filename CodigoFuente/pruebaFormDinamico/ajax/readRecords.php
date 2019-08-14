<?php

// include Database connection file 
include_once '../../modeloSistema/BDConexionSistema.Class.php';
header('Content-Type: text/html; charset=UTF-8');    
/**
 *
 * @var mysqli_result
 */
$datos;


// Design initial table header 
$data = '<table class="table table-hover table-sm">
						<tr class="table-info">
                                                        <th>Registro</th>
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
				<td>'.$x.'</td>
				<td>'.$recursos[$x]['titulo'].'</td>
				<td>'.$recursos[$x]['apellido'].'</td>
				<td>'.$recursos[$x]['nombre'].'</td>
                                <td>'.$recursos[$x]['datosAdicionales'].'</td>
                                <td>'.$recursos[$x]['disponibilidad'].'</td>
				<td>
                                <a title="Modificar" href="">
                                            <button type="button" class="btn btn-outline-warning">
                                                <span class="oi oi-pencil"></span>
                                            </button>
                                </a>
                                 <a title="Eliminar" href="">
                                            <button type="button" class="btn btn-outline-danger">
                                                <span class="oi oi-trash"></span>
                                            </button>
                                 </a>  
					  <!-- <button onclick="GetUserDetails('.$recursos[$x]['id'].')" class="btn btn-warning">Update</button> -->
                                         <!-- <button onclick="DeleteUser('.$recursos[$x]['id'].')" class="btn btn-danger">Delete</button> -->
				</td>

    		</tr>';
}
$data .= '</table>';
echo $data;
?>