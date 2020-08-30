<?php
header("Access-Control-Allow-Origin: *");
header('content-type: application/json; charset=utf-8');
$idAsignatura = $_GET['idAsignatura'];
//echo $idPlan;

$dns = "mysql:host=127.0.0.1;dbname=bdGEF_VASPA";
$user = "root";
$pass = "";

try {
	$con = new PDO($dns, $user, $pass);

	if(!$con){
		echo "No se puede conectar a la base de datos";
	}
	$query = $con->prepare("SELECT anio, nombre
		FROM programa_pdf
		WHERE SUBSTRING(nombre, 5,4) LIKE '{$idAsignatura}'
		ORDER BY anio DESC");

		$query->execute();

		$registros = "[";

		while($result = $query->fetch()){
			if ($registros != "[") {
				$registros .= ",";
			}
			$registros .= '{"nombre": "'.$result["nombre"].'",';
			$registros .= '"anio": "'.$result["anio"].'"}';
			
		}
		$registros .= "]";
		echo utf8_encode($registros);



} catch (Exception $e) {
	echo "Error: ". $e->getMessage();
};

