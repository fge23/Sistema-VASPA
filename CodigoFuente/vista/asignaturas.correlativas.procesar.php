<?php

include_once '../lib/ControlAcceso.Class.php';
ControlAcceso::requierePermiso(PermisosSistema::PERMISO_ASIGNATURAS);
include_once '../modeloSistema/BDConexionSistema.Class.php';


//Recibimos el array con los codigos de las asignaturas correlativas.
$vectorAsignaturas = $_SESSION['vectorAsignaturas'];

//Recibimos el array con los requisitos de las asignaturas.
$vectorRequisitos = $_SESSION['vectorRequisitos'];

//Recibimos el array con los tipos de correlatividad de las asignaturas.
$vectorTipos = $_SESSION['vectorTipos'];


// Validamos que esten seteados los campos

if (isset($_POST['idPlan']) && isset($_POST['idAsignatura'])){


	//Recibimos el codigo del plan
	$idPlan = $_POST['idPlan'];

	//Recibimos el codigo de la asignatura actual (sobre la cual le vamos a insertar las correlativas)
	$idAsignatura = $_POST['idAsignatura'];


	$consulta = "INSERT INTO correlativa_de (id, requisito, idAsignatura, idAsignatura_Correlativa_Anterior, idPlan) VALUES";


	for ($i=0; $i < count($vectorAsignaturas) ; $i++) {

		//Diferenciamos el tipo de correlatividad para armar la query para insertar en la BD

		if($vectorTipos[$i] == 'Precedente'){
				
				$consulta.="('','".$vectorRequisitos[$i]."','".$idAsignatura."','".$vectorAsignaturas[$i]."','".$idPlan."'),"; 
		}
		else{
				$consulta.="('','".$vectorRequisitos[$i]."','".$vectorAsignaturas[$i]."','".$idAsignatura."','".$idPlan."'),"; 
		}
		
	}


	$consulta_final = substr($consulta, 0, -1);
	$consulta_final.= ";";


	$resultado = BDConexionSistema::getInstancia()->query($consulta_final);




	//En esta query lo que hacemos es setear el campo 'tieneCorrelativa' al valor 1, de la tabla plan_asignaturas de la asignatura y plan en cuestión, para de esta forma, hacer referencia que esa asignatura de un determinado plan tiene correlativas.
	
	$query = "UPDATE `plan_asignatura` SET tieneCorrelativa = 1 WHERE `idAsignatura` = '$idAsignatura' AND `idPlan` = '$idPlan'";

	$execute_query = BDConexionSistema::getInstancia()->query($query);

}

?>


<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
        <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>
        <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Asignaturas Correlativas</title>
    </head>
    <body>
        <?php include_once '../gui/navbar.php'; ?>
        <div class="container">
            <p></p>
            <div class="card">
                <div class="card-header">
                    <h3>Asignaturas Correlativas.</h3>
                </div>
                <div class="card-body">
                    <?php if ($resultado) { ?>
                    <div class="alert alert-success" role="alert">
                        Las asignaturas correlativas se han agregado con &eacute;xito.
                    </div>
                    <?php } ?>   
                    <?php if (!$resultado) { ?>
                    <div class="alert alert-danger" role="alert">
                        Ha ocurrido un error. <?= $error; ?>
                    </div>
                    <?php } ?>
                    <hr />
                    <h5 class="card-text">Opciones</h5>
                    <a href="planes.php">
                        <button type="button" class="btn btn-primary">
                            <span class="oi oi-account-logout"></span> Salir
                        </button>
                    </a>
                </div>
            </div>
        </div>
               
        <?php include_once '../gui/footer.php'; ?>

    </body>
</html>
