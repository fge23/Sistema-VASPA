<?php
/*
 * Procesamiento del subir plan de estudio escaneado en pdf
 */
include_once '../lib/ControlAcceso.Class.php';
include_once '../modeloSistema/BDconexionSistema.Class.php';
include_once '../modeloSistema/Carrera.Class.php';

//Obtenemos los datos del archivo a traves del array global _FILES y del Formulario
// $_FILES['plan']['tmp_name'] --> El nombre temporal del fichero en el cual se almacena el fichero subido en el servidor.
$archivo = $_FILES['plan']['tmp_name'];

//$_FILES['plan']['name'] --> El nombre original del fichero en la máquina del cliente.
$name = $_FILES['plan']['name'];

//$_FILES['plan']['size'] --> El tamaño, en bytes, del fichero subido.
$tamanio = $_FILES['plan']['size'];

//$_FILES['plan']['type'] --> El tipo MIME del fichero.
$tipo = $_FILES['plan']['type'];

// Buscamos el tipo de archivo que es realmente (aunque se le haya cambiado la extension) el que se esta por subir al sistema
$finfo = finfo_open(FILEINFO_MIME_TYPE); // buscaremos mimetype
$mimetype = finfo_file($finfo, $archivo);

//Obtenemos los datos del formulario
$descripcion = $_POST['descripcion'];
//Si la descripcion del formulario esta vacia, le asignamos NULL, caso contrario su valor original.
//$descripcion = (empty($descripcion) ? 'NULL' : $descripcion);

$codPlan = $_POST['selectPlan'];
$codCarrera = $_POST['selectCarrera'];

/* ESTRUCTURA DEL NOMBRE DE UN PLAN EN EL SERVIDOR
 *  CodPlan_nombreCarrera.pdf
 */

$carrera = new Carrera($codCarrera);
$nombreCarrera = sanear_string($carrera->getNombre());

//nombre del archivo en el servidor
$nombrePlan = $codPlan.'_'.$nombreCarrera.'.pdf';

// Constante que nos indica el tamaño maximo del archivo a subir al sistema
define('tamanioMaximo', 2097152);

/*
 * A continuacion vamos a proceder a crear la carpeta de la carrera en caso de ser necesario
 */

/* ESTRUCTURA DEL NOMBRE DE LA CARPETA QUE VA A CONTENER LOS PLANES DE UNA CARRERA EN EL SERVIDOR
 *  CodCarrera_nombreCarrera
 */

//direccion donde se va a crear la carpeta
$ruta = '../planes_de_estudio/';
$directorio = $ruta.$carrera->getId().'_'.$nombreCarrera;

//creamos la carpeta si es que no existe
$creado = false;
if (!is_dir($directorio)){
    $creado = mkdir($directorio);
}

// variable nombre del archivo en el servidor
// Esta variable nos servira para comprobar si ya se encuentra el plan de esa carrera en el sistema, con lo cual no se deberia resubir
$rutaDestino = $directorio.'/'.$nombrePlan;

// ruta donde se alojara el plan (archivo) y se almacenara dicha informacion en la BD
$ruta = 'planes_de_estudio/'.$carrera->getId().'_'.$nombreCarrera.'/'.$nombrePlan;
//$ruta = utf8_decode($ruta);

$subido = false;
$cargadoBD = false;
$mensajeExito = '';
$mensajeError = '';

//Comprobamos si no encuentra ya el plan para subirlo, sino se muestra un mensaje de error
if (!file_exists($rutaDestino)) {
    //Comprobamos si se subio el plan
    if (is_uploaded_file($archivo)) {
        //comprobamos que sea un archivo PDF
        if ($tipo == "application/pdf" && $mimetype == "application/pdf") {
            //Comprobamos que no exceda el tamaño permitido por el servidor
            if (tamanioMaximo >= $tamanio){
                if (move_uploaded_file($archivo, $rutaDestino)) {  //movemos el archivo a su ubicacion   
                    $subido = true;
                    $mensajeExito = 'El Plan de Estudio fue subido correctamente.';
                    
                    //Guardamos los datos del plan en la BD
                    $nombrePlan = utf8_decode($nombrePlan);
                    $query = "INSERT INTO plan_pdf VALUES ('{$nombrePlan}', ".(empty($descripcion) ? "NULL" : "'$descripcion'").", '{$ruta}', '{$tamanio}')";
                    $consulta = BDConexionSistema::getInstancia()->query($query);
                    if ($consulta) {
                        $cargaBD = true;
                    } else {
                        $cargaBD = false;
                    }
                } else {
                    $mensajeError = 'Hubo un error al subir el Plan de Estudio.';
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
        $mensajeError = 'No se ha seleccionado un Plan de Estudio a subir al sistema.';
    }
} else {
    $mensajeError = "<b>El Plan de Estudio que intenta subir ya se encuentra en el sistema</b>"
            . "<br>Plan de Estudio de la carrera: <b>{$carrera->getId()} - {$carrera->getNombre()}</b>"
            . "<br>Código del Plan: <b>{$codPlan}</b>";
}

?>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
        <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>
        <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Subir Plan de Estudio</title>
    </head>
    <body>
        <?php include_once '../gui/navbar.php'; ?>

        <div class="container">
            <p></p>
            <div class="card">
                <div class="card-header">
                    <h3>Subir plan de Estudio al Sistema</h3>
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
                </div>
                <div class="card-footer text-center">
                    <a href="subir.plan.formulario.php">
                        <button type="button" class="btn btn-outline-primary">
                            <span class="oi oi-cloud-upload"></span> Subir otro Plan de Estudio
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

<?php
/**
 * Reemplaza todos los acentos por sus equivalentes sin ellos
 *
 * @param $string
 *  string la cadena a sanear
 *
 * @return $string
 *  string saneada
 */
function sanear_string($string){
 
    $string = trim($string);
 
    $string = str_replace(
        array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
        array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
        $string
    );
 
    $string = str_replace(
        array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
        array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
        $string
    );
 
    $string = str_replace(
        array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
        array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
        $string
    );
 
    $string = str_replace(
        array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
        array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
        $string
    );
 
    $string = str_replace(
        array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
        array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
        $string
    );
 
    $string = str_replace(
        array('ñ', 'Ñ', 'ç', 'Ç', ' '),
        array('n', 'N', 'c', 'C', '_'),
        $string
    );
  
    return $string;
}