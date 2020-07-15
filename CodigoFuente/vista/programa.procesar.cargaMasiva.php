<?php
include_once '../lib/ControlAcceso.Class.php';
ControlAcceso::requierePermiso(PermisosSistema::PERMISO_CARGA_MASIVA_PROGRAMAS);
include_once '../modeloSistema/BDConexionSistema.Class.php';
//include_once '../modeloSistema/BDConexionSistema.Class.php';

//constante para el tamaño maximo permitido del archivo a subir
define("TAMANIO_MAXIMO", 2097152); // expresada en bytes --> MB 2

//obtenemos los codigos de todas las carreras y lo guardamos en un array
$query = "SELECT * FROM CARRERA ORDER BY id ASC";
$datos = BDConexionSistema::getInstancia()->query($query);

while ($fila = $datos->fetch_assoc()){
    $codigoCarreras[] = $fila['id'];
}

//obtenemos los codigos de todas las asignaturas y lo guardamos en un array
$query = "SELECT * FROM ASIGNATURA ORDER BY id ASC";
$datos = BDConexionSistema::getInstancia()->query($query);

while ($fila = $datos->fetch_assoc()){
    $codigoAsignaturas[] = $fila['id'];
}

//Para aceptar los datos se ha puesto _isset($POST["submit"]), que crea la key 
//submit cuando se hace click en el botón, y _$_SERVER["REQUESTMETHOD"] == "post", 
//que especifica que el método request ha de ser POST. Se puede usar una de las dos 
//formas o las dos a la vez.

// validamos que se haya enviado los programas a traves del formulario
if (isset($_POST['subirProgramas']) && $_SERVER["REQUEST_METHOD"] == "POST"){
    //echo 'ok';
    //Comprobamos que se haya seleccionado algunos programas
    if ($_FILES['programas']['error']['0'] !== UPLOAD_ERR_NO_FILE){
        //echo 'se selecciono programa<br>';
        
        $estadoSubidaProgramas = '<ul>'; //vamos a almacenar en una lista el resultado si se pudo subir o no cada uno de los programas
        
        foreach ($_FILES["programas"]["tmp_name"] as $key => $tmp_name) {
            //Validamos que el archivo exista
            if ($_FILES["programas"]["name"][$key]) {
                
                if ($_FILES["programas"]["error"][$key] === UPLOAD_ERR_OK){
                    
                    
                    $nombrePrograma = $_FILES["programas"]["name"][$key]; //Obtenemos el nombre original del archivo
                    
                    //Obtenemos los datos del archivo a traves del array global _FILES y del Formulario
                    // $_FILES['programa']['tmp_name'] --> El nombre temporal del fichero en el cual se almacena el fichero subido en el servidor.
                    $nombreTemporal = $_FILES["programas"]["tmp_name"][$key]; //Obtenemos el nombre temporal del archivo


                    //$_FILES['programa']['size'] --> El tamaño, en bytes, del fichero subido.
                    $tamanio = $_FILES["programas"]["size"][$key];

                    //$_FILES['programa']['type'] --> El tipo MIME del fichero.
                    $tipoArchivo = $_FILES["programas"]["type"][$key];

                    // Buscamos el tipo de archivo que es realmente (aunque se le haya cambiado la extension)
                    $finfo = finfo_open(FILEINFO_MIME_TYPE); // buscaremos mimetype
                    $mimetype = finfo_file($finfo, $nombreTemporal);
                    
                    //Validamos que el archivo sea realmente un pdf
                    if ($tipoArchivo == "application/pdf" && $mimetype == "application/pdf"){
                        
                        //Validamos el tamaño maximo permitido
                        if (TAMANIO_MAXIMO >= $tamanio){

                            // A continuacion validamos que el nombre del archivo cumple con el estandar de nombre de programas
                            $resultado = chequearNombrePrograma($nombrePrograma, $codigoCarreras, $codigoAsignaturas);
                            if ($resultado === true){
                                
                                $codCarrera = substr($nombrePrograma, 5, 3);
                                $codAsignatura = substr($nombrePrograma, 9, 4);
                                $nuevoNombrePrograma = 'prg_'.$codAsignatura.'_'.$codCarrera.'_uarg_pact.pdf';
                                $anio = substr($nombrePrograma, 0, 4);
                                // Esta variable nos servira para comprobar si ya se encuentra el programa para ese anio, con lo cual no se deberia resubir
                                $rutaDestino = '../programas/'.$anio.'/'.$nuevoNombrePrograma;
                                
                                // ruta donde se guardara el programa y se almacenara en la BD
                                $ruta = 'programas/'.$anio.'/'.$nuevoNombrePrograma;
                                
                                //Comprobamos si no existe el programa para subirlo, sino se muestra un mensaje de error
                                if (!file_exists($rutaDestino)){
                                    
                                    if (move_uploaded_file($nombreTemporal, $rutaDestino)){ //movemos el archivo a su ubicacion   
                                    // Guardamos los datos del programa en la BD
                                    $query = "INSERT INTO programa_pdf VALUES ('{$nuevoNombrePrograma}', '{$anio}', NULL, '{$ruta}', '{$tamanio}')";
                                    $res = BDConexionSistema::getInstancia()->query($query);
                                    
                                    $estadoSubidaProgramas .= '<li type="disc" class="text-success">El archivo: <b>'.$nombrePrograma.'</b> fue subido correctamente al sistema.</li>';
                                    
                                    } else {
                                        $estadoSubidaProgramas .= '<li type="disc" class="text-danger">El programa: <b>'.$nombrePrograma.' no pudo ser subido</b>. Error al intentar subir.</li>';
                                    }
                                    
                                } else {
                                    $estadoSubidaProgramas .= '<li type="disc" class="text-danger">El programa: <b>'.$nombrePrograma.' no pudo ser subido</b>. (Ya esta cargado en el Sistema).</li>';
                                }
                                
                            } else {
                                $estadoSubidaProgramas .= $resultado;
                            }
                            
                        } else {
                            $estadoSubidaProgramas .= '<li type="disc" class="text-danger">El programa: <b>'.$nombrePrograma.' no pudo ser subido</b> excede el tama&ntilde;o m&aacute;ximo permitido.</li>';
                        }
                        
                    } else {
                        $estadoSubidaProgramas .= '<li type="disc" class="text-danger">El archivo: <b>'.$nombrePrograma.' no pudo ser subido</b> ya que no es un PDF.</li>';
                    }   
                } else {
                    $nombrePrograma = $_FILES["programas"]["name"][$key];
                    $estadoSubidaProgramas .= '<li type="disc" class="text-danger">El programa: <b>'.$nombrePrograma.' no pudo ser subido</b>. ('.getMensajeError($_FILES["programas"]["error"][$key]).').</li>';
                    //echo '<br>El programa: '.$nombrePrograma.' tiene el siguiente error: '.getMensajeError($_FILES["programas"]["error"][$key]);
                }

                
            }
	}
        $estadoSubidaProgramas .= '</ul>';
        //echo '<br>'.$estadoSubidaProgramas;
    }
    else {
        //echo 'no se selecciono ningun programa<br>';
        header("location: programa.formulario.cargaMasiva.php");
    }
}
 else {
     //echo 'no se mando por medio del submit<br>';
     header("location: programa.formulario.cargaMasiva.php");
}

?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">     
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
        <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />     
        <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>
        <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Carga Masiva de Programas</title>
    </head>
    <body>

        <?php include_once '../gui/navbar.php';   ?>

        <div class="container">
                <div class="card">
                    <div class="card-header">
                        <h3>Carga Masiva de Programas  - Estado de carga de los Programas</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">  
                            <div class="col-12">
                                <?php echo $estadoSubidaProgramas; ?>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="text-center">     
                            <a href="programa.formulario.cargaMasiva.php">
                                <button type="button" class="btn btn-outline-primary">
                                    <span class="oi oi-cloud-upload"></span> Cargar m&aacute;s Programas
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
        </div>
        <?php include_once '../gui/footer.php'; ?>
    </body>
</html>

<?php 
//Funciones a utilizar

//funcion que valida el año del programa se encuentre entre el año actual y un año de inicio
function esAnioValido($num) {
    //obtenemos la parte entera del numero
    $anio = intval($num);
    // ver posible constante "anioInicio"
    return ($anio > 1994 && $anio <= date("Y"));
}

function esCodigoCarreraValido($cod, $carreras) {
    if ($carreras[0] == $cod){
        return true;
    } elseif (array_search($cod, $carreras)){
        return true;
    } else {
        return false;
    }
}

function esCodigoAsignaturaValido($cod, $asignaturas){
    if ($asignaturas[0] == $cod){
        return true;
    } elseif (array_search($cod, $asignaturas)){
        return true;
    } else {
        return false;
    }
}

function getMensajeError($codigo) {
    switch ($codigo) {
            case UPLOAD_ERR_INI_SIZE:
                $message = "Supera el tama&ntilde;o m&aacute;ximo permitido (".((TAMANIO_MAXIMO/1024)/1024)." MB)";
                break;
            case UPLOAD_ERR_FORM_SIZE:
                $message = "Supera el tama&ntilde;o m&aacute;ximo permitido (".((TAMANIO_MAXIMO/1024)/1024)." MB)";
                break;
            case UPLOAD_ERR_PARTIAL:
                $message = "Se cargo parcialmente";
                break;
            case UPLOAD_ERR_NO_FILE:
                $message = "No se seleccion&oacute ning&uacute;n archivo";
                break;
            case UPLOAD_ERR_NO_TMP_DIR:
                $message = "Falta Carpeta temporal";
                break;
            case UPLOAD_ERR_CANT_WRITE:
                $message = "Error al escribir el archivo en el disco";
                break;
            case UPLOAD_ERR_EXTENSION:
                $message = "Carga de archivo detenida por extensión";
                break;

            default:
                $message = "Error de carga desconocido";
                break;
        }
        return $message;
    
}

function chequearNombrePrograma($nombrePrograma, $carreras, $asignaturas) {
    // A continuacion validamos que el nombre del archivo cumple con el estandar de nombre de programas
    /* Formato nombre de programa:
     * xxxx-yyy-zzzz.pdf
     * donde xxxx: es el anio del programa
     *       yyy: es el codigo de la carrera
     *       zzzz: es el codigo de la asignatura 
     */
    if (strlen($nombrePrograma) == 17 && substr($nombrePrograma, 13, 4) == '.pdf') {
        //extraemos el anio y los codigos
        $anio = substr($nombrePrograma, 0, 4);
        $codigoCarrera = substr($nombrePrograma, 5, 3);
        $codigoAsignatura = substr($nombrePrograma, 9, 4);
        
        //validamos el año del programa
        
        if (is_numeric($anio)){
            if (esAnioValido($anio)){
                // validamos codigo de carrera
                if (is_numeric($codigoCarrera)){
                    if (esCodigoCarreraValido($codigoCarrera, $carreras)){
                        // validamos codigo de asignatura
                        if (is_numeric($codigoAsignatura)){
                            if (esCodigoAsignaturaValido($codigoAsignatura, $asignaturas)) {
                                return true;
                            } else {
                                return '<li type="disc" class="text-danger">El programa: <b>' . $nombrePrograma . ' no pudo ser subido</b>. <b>(C&oacute;digo de Asignatura no v&aacute;lido)</b>.</li>';
                            }
                        } else {
                            return '<li type="disc" class="text-danger">El programa: <b>' . $nombrePrograma . ' no pudo ser subido</b>. <b>(C&oacute;digo de Asignatura no es un n&uacute;mero)</b>.</li>';
                        }
                    } else {
                        return '<li type="disc" class="text-danger">El programa: <b>' . $nombrePrograma . ' no pudo ser subido</b>. <b>(C&oacute;digo de Carrera no v&aacute;lido)</b>.</li>';
                    }
                    
                } else {
                    return '<li type="disc" class="text-danger">El programa: <b>' . $nombrePrograma . ' no pudo ser subido</b>. <b>(C&oacute;digo de Carrera no es un n&uacute;mero)</b>.</li>';
                }
            }
            else {
                return '<li type="disc" class="text-danger">El programa: <b>' . $nombrePrograma . ' no pudo ser subido</b>. <b>(A&ntilde;o no v&aacute;lido)</b>.</li>';
            }
        }    
        else {
            return '<li type="disc" class="text-danger">El programa: <b>' . $nombrePrograma . ' no pudo ser subido</b>. <b>(A&ntilde;o no es un n&uacute;mero)</b>.</li>';
        }
        
    } else {
        return '<li type="disc" class="text-danger">El programa: <b>' . $nombrePrograma . ' no pudo ser subido</b> dado que <b>no cumple con el formato de nombre establecido</b>.</li>';
    }
}

?>