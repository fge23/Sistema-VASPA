<?php

include_once '../lib/ControlAcceso.Class.php';
ControlAcceso::requierePermiso(PermisosSistema::PERMISO_PLANES);
include_once '../modeloSistema/BDConexionSistema.Class.php';


// Validamos que esten seteados los campos

if (isset($_POST['codPlan']) && isset($_POST['cod_asignatura']) ){


	//Recibimos el codigo del plan
	$codPlan = $_POST['codPlan'];

	//Recibimos el array con los codigos de las asignaturas (puede haber repetidos)
	$codigos_asignaturas = $_POST['cod_asignatura'];

	//Por defecto, al insertar una asignatura a un plan, todavia no tiene correlativas.
	$tieneCorrelativa = 0;

	//Esta variable contiene un array con los codigos de las asignaturas, pero sin repeticiones.
	$codAsignatura = array_values(array_unique($codigos_asignaturas));


	$consulta = "INSERT INTO plan_asignatura (idPlan, idAsignatura, tieneCorrelativa) VALUES";

	for ($i=0; $i < count($codAsignatura) ; $i++) { 
		
		$consulta.="('".$codPlan."','".$codAsignatura[$i]."',".$tieneCorrelativa."),"; 
	}


	$consulta_final = substr($consulta, 0, -1);
	$consulta_final.= ";";

	//echo json_encode(array('consulta_final' => $consulta_final));

	$resultado = BDConexionSistema::getInstancia()->query($consulta_final);

	if ($resultado) {  
		echo json_encode(array('error' => false));
	}
	else{
		echo json_encode(array('error' => true));
	}

}

?>