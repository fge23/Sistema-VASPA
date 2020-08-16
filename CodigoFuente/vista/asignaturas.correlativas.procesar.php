<?php

include_once '../lib/ControlAcceso.Class.php';
ControlAcceso::requierePermiso(PermisosSistema::PERMISO_ASIGNATURAS);
include_once '../modeloSistema/BDConexionSistema.Class.php';


// Validamos que esten seteados los campos

if (isset($_POST['cod_asignatura']) && isset($_POST['requisito']) && isset($_POST['tipo_correlatividad']) && isset($_POST['idPlan']) && isset($_POST['idAsignatura'])){


	//Recibimos el array con los codigos de las asignaturas correlativas (puede haber repetidos)
	$codigos_asignaturas = $_POST['cod_asignatura'];

	//Recibimos el array con los requisitos de las asignaturas (puede haber repetidos)
	$requisitos_asignaturas = $_POST['requisito'];

	//Recibimos el array con los tipos de correlatividad de las asignaturas (puede haber repetidos)
	$tipos_correlatividad_asignaturas = $_POST['tipo_correlatividad'];

	//Recibimos el codigo del plan
	$idPlan = $_POST['idPlan'];

	//Recibimos el codigo de la asignatura actual (sobre la cual le vamos a insertar las correlativas)
	$idAsignatura = $_POST['idAsignatura'];

	//Esta variable contiene un array con los codigos de las asignaturas, pero sin repeticiones.
	$codAsignatura = array_unique($codigos_asignaturas);



$consulta = "INSERT INTO correlativa_de (id, requisito, idAsignatura, idAsignatura_Correlativa_Anterior, idPlan) VALUES";


//En la condición del for, utilizo el array codigos_asignaturas ya que necesito contar la cantidad real de elementos que existen porque si cuento en el array codAsignatura, este al tener menos elementos, no llega a las ultimas posiciones de los otros arrays (diferente longitud).

for ($i=0; $i < count($codigos_asignaturas) ; $i++) {

	//Validamos que el indice (key) exista en el array codAsignatura, que es el que tiene solamente las asignaturas sin repetir. Realizamos esta validacion ya que el metodo array_unique() elimina los elementos repetidos, pero no reasigna cada uno de los indices, deja la posicion actual en la que se encuentran. 
	//Esto debe ser asi, ya que no podemos utilizar el metodo array_values() ya que este reasigna cada uno de los indices y el problema de esto es que no se van a corresponder cada una de las posiciones con el resto de los arrays ya que van a estar desfasadas (a una asignatura no le va a corresponder su tipo y requisito establecido)

	if (array_key_exists($i, $codAsignatura)){

		//Validamos que la asignatura a asociar como correlativa NO sea la asignatura actual en la que me encuetro

		if($codAsignatura[$i] != $idAsignatura){

			//Diferenciamos el tipo de correlatividad para armar la query para insertar en la BD

			if($tipos_correlatividad_asignaturas[$i] == 'Precedente'){
			
				$consulta.="('','".$requisitos_asignaturas[$i]."','".$idAsignatura."','".$codAsignatura[$i]."','".$idPlan."'),"; 
			}
			else{
				$consulta.="('','".$requisitos_asignaturas[$i]."','".$codAsignatura[$i]."','".$idAsignatura."','".$idPlan."'),"; 
			}
		}
	}
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



	//En esta query lo que hacemos es setear el campo 'tieneCorrelativa' al valor 1, de la tabla plan_asignaturas de la asignatura y plan en cuestión, para de esta forma, hacer referencia que esa asignatura de un determinado plan tiene correlativas.
	
	$query = "UPDATE `plan_asignatura` SET tieneCorrelativa = 1 WHERE `idAsignatura` = '$idAsignatura' AND `idPlan` = '$idPlan'";

	$execute_query = BDConexionSistema::getInstancia()->query($query);

}

?>