<?php

// include Database connection file 
include_once '../../modeloSistema/BDConexionSistema.Class.php';
/**
 *
 * @var mysqli_result
 */
$datos;

// Design initial table header 
$data = '<table class="table table-bordered table-striped">
						<tr>
							<th>T&iacute;tulo</th>
							<th>Apellido</th>
							<th>Nombre</th>
							<th>Datos Adicionales</th>
                                                        <th>Disponibilidad</th>
							<th>Update</th>
							<th>Delete</th>
						</tr>';

$query = "SELECT * FROM recurso";
$datos = BDConexionSistema::getInstancia()->query($query);
if ($datos) {
    echo "todo bien";
} else {
    echo "todo mal";
}

$data = 0;

// if query results contains rows then featch those rows 
 for ($x = 0; $x < $this->datos->num_rows; $x++) {
     var_dump($datos);
$data .= '<tr>
				<td>'.$x.'</td>
				<td>'.$row['first_name'].'</td>
				<td>'.$row['last_name'].'</td>
				<td>'.$row['email'].'</td>
				<td>
					<button onclick="GetUserDetails('.$row['id'].')" class="btn btn-warning">Update</button>
				</td>
				<td>
					<button onclick="DeleteUser('.$row['id'].')" class="btn btn-danger">Delete</button>
				</td>
    		</tr>';



}
 $data .= '</table>';
 echo $data;
?>