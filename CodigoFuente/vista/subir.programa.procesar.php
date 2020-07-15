<?php
/*
 * Procesamiento del subir programa escaneado en pdf
 */
include_once '../lib/ControlAcceso.Class.php';
ControlAcceso::requierePermiso(PermisosSistema::PERMISO_SUBIR_PROGRAMA_FIRMADO);
include_once '../modeloSistema/BDconexionSistema.Class.php';

//Obtenemos los datos del archivo a traves del array global _FILES y del Formulario
// $_FILES['programa']['tmp_name'] --> El nombre temporal del fichero en el cual se almacena el fichero subido en el servidor.
$archivo = $_FILES['programa']['tmp_name'];

//$_FILES['programa']['name'] --> El nombre original del fichero en la máquina del cliente.
$name = $_FILES['programa']['name'];

//$_FILES['programa']['size'] --> El tamaño, en bytes, del fichero subido.
$tamanio = $_FILES['programa']['size'];

//$_FILES['programa']['type'] --> El tipo MIME del fichero.
$tipo = $_FILES['programa']['type'];

// Buscamos el tipo de archivo que es realmente (aunque se le haya cambiado la extension) el que se esta por subir al sistema
$finfo = finfo_open(FILEINFO_MIME_TYPE); // buscaremos mimetype
$mimetype = finfo_file($finfo, $archivo);

//Obtenemos los datos del formulario
$descripcion = $_POST['descripcion'];
//Si la descripcion del formulario esta vacia, le asignamos NULL, caso contrario su valor original.
//$descripcion = (empty($descripcion) ? 'NULL' : $descripcion);

$anio = $_POST['anio'];
$codAsignatura = $_POST['asignatura'];
$codCarrera = $_POST['carrera'];

/* ESTRUCTURA DEL NOMBRE DE UN PROGRAMA EN EL SERVIDOR
 *  prg_XXXX_YYY_uarg_pact.pdf
 * donde XXXX --> Es el codigo de la asignatura y
 * YYY --> Es el codigo de la carrera 
 */

//nombre del archivo en el servidor
$nombrePrograma = 'prg_'.$codAsignatura.'_'.$codCarrera.'_uarg_pact.pdf';

// Constante que nos indica el tamaño maximo del archivo a subir al sistema
define('tamanioMaximo', 2097152);
        
// variable nombre del archivo en el servidor
// Esta variable nos servira para comprobar si ya se encuentra el programa para ese anio, con lo cual no se deberia resubir
$rutaDestino = '../programas/'.$anio.'/'.$nombrePrograma;
//$rutaDestino = $_SERVER['DOCUMENT_ROOT'].'/pruebauargflow/programas/'.$anio.'/'.$name;

// ruta donde se encuentra el programa y que se almacenara en la BD
$ruta = 'programas/'.$anio.'/'.$nombrePrograma;
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

//Comprobamos si no existe el programa para subirlo, sino se muestra un mensaje de error
if (!file_exists($rutaDestino)) {
    //Comprobamos si se subio el programa
    if (is_uploaded_file($archivo)) {
        //comprobamos que sea un archivo PDF
        if ($tipo == "application/pdf" && $mimetype == "application/pdf") {
            //Comprobamos que no exceda el tamaño permitido por el servidor
            if (tamanioMaximo >= $tamanio){
                if (move_uploaded_file($archivo, $rutaDestino)) {  //movemos el archivo a su ubicacion   
                    $subido = true;
                    $mensajeExito = 'El programa fue subido correctamente.';
                    //Guardamos los datos del programa en la BD
                    $nombrePrograma = utf8_decode($nombrePrograma);

                    //$query = "INSERT INTO programa_pdf VALUES ('{$nombrePrograma}', '{$anio}', '{$descripcion}', '{$ruta}', '{$tamanio}')";
                    $query = "INSERT INTO programa_pdf VALUES ('{$nombrePrograma}', '{$anio}', ".(empty($descripcion) ? "NULL" : "'$descripcion'").", '{$ruta}', '{$tamanio}')";
                    $consulta = BDConexionSistema::getInstancia()->query($query);
                    if ($consulta) {
                        $cargaBD = true;
                    } else {
                        $cargaBD = false;
                    }
                } else {
                    $mensajeError = 'Hubo un error al subir el programa.';
                    $subido = false;
                }
            }
            else {
                $mensajeError = 'El archivo seleccionado excede el tama&ntilde;o permitido por el sistema.';
            }
            
        } else {
            $mensajeError = 'El archivo que se intenta subir no es un PDF.';
        }
    } else {
        $mensajeError = 'No se ha seleccionado un programa a subir.';
    }
} else {
    include_once '../modeloSistema/Asignatura.Class.php';
    include_once '../modeloSistema/Carrera.Class.php';
    $asignatura = new Asignatura($codAsignatura, NULL);
    $carrera = new Carrera($codCarrera, NULL);
    $mensajeError = "<b>El programa que intenta subir ya se encuentra en el sistema</b>"
            . "<br>Programa de: <b>{$asignatura->getNombre()}</b>"
            . "<br>Carrera: <b>{$carrera->getNombre()}</b>"
            . "<br>A&ntilde;o: <b>{$anio}</b>";
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
        <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>
        <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Subir Programa</title>
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
<!--                    <hr />
                    <h5 class="card-text">Opciones</h5>-->
                    
                    
                </div>
                <div class="card-footer text-center">
                    <a href="subir.programa.formulario.php">
                        <button type="button" class="btn btn-outline-primary">
                            <span class="oi oi-cloud-upload"></span> Subir Otro Programa
                        </button>
                    </a>

                    <a href="panelSA.php">
                        <button type="button" class="btn btn-outline-secondary">
                            <span class="oi oi-home"></span> Volver a Inicio
                        </button>
                    </a>
                </div>
            </div>
        </div>
        <?php include_once '../gui/footer.php'; ?>
    </body>
</html>
