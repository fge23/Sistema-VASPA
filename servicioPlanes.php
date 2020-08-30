<?php
header("Access-Control-Allow-Origin: *");
header('content-type: application/json; charset=utf-8');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");


$dns = "mysql:host=127.0.0.1;dbname=bdGEF_VASPA";
$user = "root";
$pass = "";

try {
	$con = new PDO($dns, $user, $pass);

	if(!$con){
		echo "No se puede conectar a la base de datos";
	}
	$query = $con->prepare('SELECT plan.id, plan.anio_inicio, plan.anio_fin, carrera.nombre
							FROM plan plan
							LEFT JOIN carrera carrera
							ON plan.idCarrera = carrera.id
							ORDER BY carrera.nombre, plan.anio_inicio ASC');

		$query->execute();

		$registros = "[";

		while($result = $query->fetch()){
			if ($registros != "[") {
				$registros .= ",";
			}
			$registros .= '{"id": "'.$result["id"].'",';
			$registros .= '"anio_inicio": "'.$result["anio_inicio"].'",';
			$registros .= '"nombre": "'.$result["nombre"].'",';
			if($result["anio_fin"] == ""){
			$registros .= '"anio_fin": "Actualidad"}';
			}
			else{
			$registros .= '"anio_fin": "'.$result["anio_fin"].'"}';
			}
		}
		$registros .= "]";
		echo $registros;



} catch (Exception $e) {
	echo "Error: ". $e->getMessage();
};
