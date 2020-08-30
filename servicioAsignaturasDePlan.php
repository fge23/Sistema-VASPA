<?php
header("Access-Control-Allow-Origin: *");
header('content-type: application/json; charset=utf-8');
$idPlan = $_GET['idPlan'];
//echo $idPlan;

$dns = "mysql:host=127.0.0.1;dbname=bdGEF_VASPA";
$user = "root";
$pass = "";

try {
	$con = new PDO($dns, $user, $pass);

	if(!$con){
		echo "No se puede conectar a la base de datos";
	}
	$query = $con->prepare("SELECT asignatura.id, asignatura.nombre, plan.anio_inicio 
		FROM plan_asignatura plan_asignatura
		INNER JOIN asignatura asignatura
		ON plan_asignatura.idAsignatura =  asignatura.id
		INNER JOIN plan plan
		ON plan_asignatura.idPlan = plan.id 
		WHERE plan_asignatura.idPlan = '{$idPlan}' 
		ORDER BY plan.anio_inicio");

		$query->execute();

		$registros = "[";

		while($result = $query->fetch()){
			if ($registros != "[") {
				$registros .= ",";
			}
			$registros .= '{"nombre": "'.$result["nombre"].'",';
			$registros .= '"id": "'.$result["id"].'",';
			$registros .= '"anio_inicio": "'.$result["anio_inicio"].'"}';
			
		}
		$registros .= "]";
		echo $registros;



} catch (Exception $e) {
	echo "Error: ". $e->getMessage();
};

