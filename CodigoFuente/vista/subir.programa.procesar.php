<?php
/*
 * Procesamiento del subir programa escaneado en pdf
 * falta mejorar el codigo usando OO
 */
include_once '../lib/ControlAcceso.Class.php';
include_once '../modeloSistema/BDconexionSistema.Class.php';

//Obtenemos los datos del archivo y del Formulario
$archivo = $_FILES['programa']['tmp_name'];
$name = $_FILES['programa']['name'];
$tamanio = $_FILES['programa']['size'];
$tipo = $_FILES['programa']['type'];
//$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$anio = $_POST['anio'];

//obtenemos el nombre de la asignatura
$nombreAsignatura = '';
$codAsignatura = $_POST['asignatura'];
$query = "SELECT nombre FROM ASIGNATURA WHERE id = {$codAsignatura}";
$consulta = BDConexionSistema::getInstancia()->query($query);
if ($consulta->num_rows > 0){
    $fila = $consulta->fetch_assoc();
    $nombreAsignatura = $fila['nombre'];
}
//echo $nombreAsignatura.'<br>';
//echo utf8_decode($nombreAsignatura).'<br>';
//echo utf8_encode($nombreAsignatura).'<br>';
$nombreAsignatura = utf8_encode($nombreAsignatura);
$nombreAsignatura = str_replace(" ", "_", $nombreAsignatura);
//echo $nombreAsignatura;
//muestra el nombre del archivo, dando la ruta del mismo o el nombre
//echo basename($name);

//nombre del archivo
$codCarrera = $_POST['carrera'];
$name = $codCarrera.'_'.$nombreAsignatura.'.pdf';
        
// variable nombre del archivo en el servidor
$rutaDestino = '../programas/'.$anio.'/'.$name;
//$rutaDestino = $_SERVER['DOCUMENT_ROOT'].'/pruebauargflow/programas/'.$anio.'/'.$name;

// ruta que se almacenara en la BD
$ruta = 'programas/'.$anio.'/'.$name;
$ruta = utf8_decode($ruta);

/*
 * Muestra la extension del archivo dando la ruta del mismo o el nombre
echo '<br>'.pathinfo($rutaDestino, PATHINFO_EXTENSION);
echo '<br>'.pathinfo($name, PATHINFO_EXTENSION);
echo '<br>'.$tipo;
*/

$subido = false;
$cargadoBD = false;
$mensajeExito = '';
$mensajeError = '';

//Comprobamos si no existe el archivo para subirlo, sino se muestra un mensaje de error
if (!file_exists($rutaDestino)) {
    //Comprobamos si se subio un archivo
    if (is_uploaded_file($archivo)) {
        //comprobamos que sea un archivo PDF
        if ($tipo == "application/pdf") {
            if (move_uploaded_file($archivo, $rutaDestino)) {  //movemos el archivo a su ubicacion   
                $subido = true;
                $mensajeExito = 'El programa fue cargado correctamente.';
                //Guardamos los datos del programa en la BD
                $name = utf8_decode($name);
                $query = "INSERT INTO programa_pdf VALUES ('{$name}', '{$anio}', '{$descripcion}', '{$ruta}', '{$tamanio}')";
                $consulta = BDConexionSistema::getInstancia()->query($query);
                if ($consulta) {
                    $cargaBD = true;
                } else {
                    $cargaBD = false;
                }
            } else {
                $mensajeError = 'Error al cargar archivo.';
                $subido = false;
            }
        } else {
            $mensajeError = 'Tipo de archivo no permitido.';
        }
    } else {
        $mensajeError = 'No se ha seleccionado un programa.';
    }
} else {
    $mensajeError = "El programa ya se encuentra en el sistema";
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
        <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>
        <title><?php //echo Constantes::NOMBRE_SISTEMA; ?> - Subir Programa</title>
    </head>
    <body>
        <?php include_once '../gui/navbar.php'; ?>

        <div class="container">
            <p></p>
            <div class="card">
                <div class="card-header">
                    <h3>Subir programa al Sistema</h3>
                </div>
                <div class="card-body">
                    <?php if ($subido) { ?>
                        <div class="alert alert-success" role="alert">
                            Operaci&oacute;n realizada con &eacute;xito. <?php echo '<br>'.$mensajeExito; ?>
                        </div>
                    <?php } ?>   
                    <?php if (!$subido) { ?>
                        <div class="alert alert-danger" role="alert">
                            Ha ocurrido un error. <?php echo '<br>'.$mensajeError; ?>
                        </div>
                    <?php } ?>
                    <hr />
                    <h5 class="card-text">Opciones</h5>
                    <a href="#">
                        <button type="button" class="btn btn-primary">
                            <span class="oi oi-home"></span> Volver a Inicio
                        </button>
                    </a>
                    
                    <a href="listar.anios.subirprograma.php">
                        <button type="button" class="btn btn-primary">
                            <span class="oi oi-cloud-upload"></span> Subir Otro Programa
                        </button>
                    </a>
                    
                </div>
            </div>
        </div>
        <?php include_once '../gui/footer.php'; ?>
    </body>
</html>
