<?php

include_once '../lib/ControlAcceso.Class.php';
ControlAcceso::requierePermiso(PermisosSistema::PERMISO_PLANES);
include_once '../modeloSistema/BDConexionSistema.Class.php';

//Recibimos el array con los codigos de las asignaturas
$vectorElementos = $_SESSION['vectorElementos'];

// Validamos que este seteado el campo

if (isset($_POST['codPlan'])){


	//Recibimos el codigo del plan
	$codPlan = $_POST['codPlan'];

	//Por defecto, al insertar una asignatura a un plan, todavia no tiene correlativas.
	$tieneCorrelativa = 0;


	$consulta = "INSERT INTO plan_asignatura (idPlan, idAsignatura, tieneCorrelativa) VALUES";

	for ($i=0; $i < count($vectorElementos) ; $i++) { 
		
		$consulta.="('".$codPlan."','".$vectorElementos[$i]."',".$tieneCorrelativa."),"; 
	}


	$consulta_final = substr($consulta, 0, -1);
	$consulta_final.= ";";

	$resultado = BDConexionSistema::getInstancia()->query($consulta_final);

}

?>


<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
        <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>
        <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Planes</title>
    </head>
    <body>
        <?php include_once '../gui/navbar.php'; ?>
        <div class="container">
            <p></p>
            <div class="card">
                <div class="card-header">
                    <h3>Asignaturas de la Revisi&oacute;n del Plan</h3>
                </div>
                <div class="card-body">
                    <?php if ($resultado) { ?>
                    <div class="alert alert-success" role="alert">
                        Las asignaturas se han agregado con &eacute;xito.
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
