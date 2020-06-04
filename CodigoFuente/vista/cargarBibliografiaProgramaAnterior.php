<?php
include_once '../lib/Constantes.Class.php';
include_once '../modeloSistema/BDConexionSistema.Class.php';
include_once '../controlSistema/ManejadorPrograma.php';
include_once '../lib/ControlAcceso.Class.php';
ControlAcceso::requierePermiso(PermisosSistema::PERMISO_GESTIONAR_BIBLIOGRAFIA);

//Se recupera ID del programa de la URL
$idPrograma = $_GET["id"];
//echo "El ID del programa es: " . $idPrograma;
//Se consulta a que asignatura pertenece el Programa
$queryIDAsignatura = "SELECT idAsignatura FROM PROGRAMA WHERE id = {$idPrograma}";
$datosIDAsignatura = BDConexionSistema::getInstancia()->query($queryIDAsignatura);
$resultadoIDAsignatura = $datosIDAsignatura->fetch_assoc();
$idAsignatura = $resultadoIDAsignatura['idAsignatura'];

//crear O de tipo Programa con el id del P actual, recuperar ese anio y ese año enviarlo al metodo getUltimoPrograma
$Programa = new Programa($idPrograma);
$anioPrograma = $Programa->getAnio();

$ManejadorPrograma = new ManejadorPrograma();
//Se obtiene el ID del Programa Anterior de la asignatura
$idProgramaAnterior = $ManejadorPrograma->getUltimoPrograma($anioPrograma, $idAsignatura);


$_SESSION['cantidadLibros'] = 0;
$_SESSION['cantidadRevistas'] = 0;
$_SESSION['cantidadRecursos'] = 0;
$_SESSION['cantidadOtroMaterial'] = 0;

$_SESSION['estadoBibliografia'] = 0;

if (!isset($idProgramaAnterior)) {
    $_SESSION['estadoProgramaAnterior'] = 0;
    header("location: cargarBibliografia.php?id={$idPrograma}");
} else {
    $_SESSION['estadoProgramaAnterior'] = 1;


    if (validarExistenciaBibliografiaAnterior("libro", $idProgramaAnterior)) {
        //Se copian todos los registros correspondientes de la tabla Libro, modificando su id y su idPrograma
        $queryLibro = "INSERT INTO libro (referencia, apellido, nombre, anioEdicion, titulo, capitulo, lugarEdicion, editorial, unidad, biblioteca, siunpa, otro, tipoLibro, idPrograma) "
                . "SELECT referencia, apellido, nombre, "
                . "anioEdicion, titulo, capitulo, "
                . "lugarEdicion, editorial, unidad, "
                . "biblioteca, siunpa, otro, tipoLibro, "
                . "{$idPrograma} as idPrograma "
                . "FROM libro where idPrograma = {$idProgramaAnterior}";
        $resultadoLibro = BDConexionSistema::getInstancia()->query($queryLibro);
        
         //Query exitosa
        if($resultadoLibro){
            $_SESSION['estadoBibliografia'] = 1;
            $rowsLibros = BDConexionSistema::getInstancia()->affected_rows;
            $_SESSION['cantidadLibros'] = $rowsLibros;          
        }
    }

    if (validarExistenciaBibliografiaAnterior("revista", $idProgramaAnterior)) {
        //Se copian todos los registros correspondientes de la tabla revista, modificando su id y su idPrograma
        $queryRevista = "INSERT INTO revista (apellido, nombre, tituloArticulo, tituloRevista, pagina, fecha, unidad, biblioteca, siunpa, otro, idPrograma) "
                . "SELECT apellido, nombre, "
                . "tituloArticulo, tituloRevista, "
                . "pagina, fecha, unidad, "
                . "biblioteca, siunpa, otro, "
                . "{$idPrograma} as idPrograma "
                . "FROM revista where idPrograma = {$idProgramaAnterior}";
        $resultadoRevista = BDConexionSistema::getInstancia()->query($queryRevista);
        
        //Query exitosa
        if($resultadoRevista){
            $_SESSION['estadoBibliografia'] = 1;
            $rowsRevistas = BDConexionSistema::getInstancia()->affected_rows;
            $_SESSION['cantidadRevistas'] = $rowsRevistas;          
        }
            
    }

    if (validarExistenciaBibliografiaAnterior("recurso", $idProgramaAnterior)) {
        //Se copian todos los registros correspondientes de la tabla recurso, modificando su id y su idPrograma
        $queryRecurso = "INSERT INTO recurso (apellido, nombre, titulo, datosAdicionales, disponibilidad, idPrograma) "
                . "SELECT apellido, nombre, "
                . "titulo, datosAdicionales, disponibilidad, "
                . "{$idPrograma} as idPrograma "
                . "FROM recurso where idPrograma = {$idProgramaAnterior}";
        $resultadoRecurso = BDConexionSistema::getInstancia()->query($queryRecurso);
         //Query exitosa
        if($resultadoRecurso){
            $_SESSION['estadoBibliografia'] = 1;
            $rowsRecursos = BDConexionSistema::getInstancia()->affected_rows;
            $_SESSION['cantidadRecursos'] = $rowsRecursos;
        }else
        {
            //ERROR de la consulta
        }
        
    }

    if (validarExistenciaBibliografiaAnterior("otro_material", $idProgramaAnterior)) {
        //Se copian todos los registros correspondientes de la tabla otro_material, modificando su id y su idPrograma
        $queryOtroMaterial = "INSERT INTO otro_material (descripcion, idPrograma) "
                . "SELECT descripcion, "
                . "{$idPrograma} as idPrograma "
                . "FROM otro_material where idPrograma = {$idProgramaAnterior}";
        $resultadoOtroMaterial = BDConexionSistema::getInstancia()->query($queryOtroMaterial);
        //Query exitosa
        if($resultadoOtroMaterial){
            $_SESSION['estadoBibliografia'] = 1;
            $rowsOtroMaterial = BDConexionSistema::getInstancia()->affected_rows;
            $_SESSION['cantidadOtroMaterial'] = $rowsOtroMaterial;
        }
    }
     header("location: cargarBibliografia.php?id={$idPrograma}");
}
?>

<?php

function validarExistenciaBibliografiaAnterior($nombreTabla_, $idProgramaAnterior_) {
    $queryCantidad = "SELECT count(*) AS cantidad FROM {$nombreTabla_} WHERE idPrograma = {$idProgramaAnterior_}";
    $resultadoCantidad = BDConexionSistema::getInstancia()->query($queryCantidad);
    $datos = $resultadoCantidad->fetch_assoc();
    if ($datos['cantidad'] != "0") {
        return TRUE;
    } else {
        return FALSE;
    }
}
?>
