<?php

//include_once '../lib/Constantes.Class.php';
include_once '../modeloSistema/BDConexionSistema.Class.php';

/*
 * Comprobamos que si la carpeta del anio actual este creada
 * de no ser asi, se procede a crearla y registrar en la BD.
 */
//obtenemos el anio actual
$anio = date("Y");
//direccion donde se va a crear la carpeta
$ruta = '../programas/';
$directorio = $ruta.$anio;


//Lo siguiente podria ser una funcion
if (!is_dir($directorio)){
    $creado = mkdir($directorio);
    if ($creado){
        //echo "Directorio creado <br>";
        //Insertamos el anio en la BD
        $consulta = "INSERT INTO ANIO VALUES ({$anio})";
        $resultado = BDConexionSistema::getInstancia()->query($consulta);
        /*
        if ($resultado){
            echo 'Cargado en la BD';
        }
        else{
            echo 'Error al cargar';
        }
        */
    }/*
    else {
        echo "No se pudo crear el directorio";
    }*/
}

?>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
        <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>        
        <title><?php //echo Constantes::NOMBRE_SISTEMA; ?> Subir Programa - Carreras</title>

    </head>
    <body>

        <?php //include_once '../gui/navbar.php';   ?>

        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h3>Seleccione el a&ntilde;o del programa a subir</h3>
                    <label>Ingrese un a&ntilde;o:</label>
                    <input type="text" name="caja_busqueda" id="caja_busqueda" 
                    class="form-control" placeholder="Ingrese año a buscar">
                </div>
                <div class="card-body" id="datos">
                </div>
            </div>
        </div>
        <?php //include_once '../gui/footer.php'; ?>
        <script type="text/javascript" src="../lib/js/jquery.min.js"></script>
        <script type="text/javascript" src="../lib/js/filtrar.anio.js"></script>
    </body>
</html>