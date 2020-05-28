<?php

include_once 'BDConexionSistema.Class.php';
include_once 'Asignatura.Class.php';
include_once 'Libro.Class.php';
include_once 'Revista.Class.php';
include_once 'Recurso.Class.php';
include_once 'OtroMaterial.Class.php';

/**
 * Description of Programa
 *
 * @author fabricio
 */
class Programa {

    private $id;
    private $anio;
    private $anioCarrera;
    private $horasTeoria;
    private $horasPractica;
    private $horasOtros;
    private $regimenCursada;
    private $observacionesHoras;
    private $observacionesCursada;
    private $fundamentacion;
    private $objetivosGenerales;
    private $organizacionContenidos;
    private $criteriosEvaluacion;
    private $metodologiaPresencial;
    private $regularizacionPresencial;
    private $aprobacionPresencial;
    private $metodologiaSATEP;
    private $regularizacionSATEP;
    private $aprobacionSATEP;
    private $metodologiaLibre;
    private $aprobacionLibre;
    private $ubicacion;
    private $idAsignatura;
    private $aprobadoSa;
    private $aprobadoDepto;
    private $fechaCarga;
    private $vigencia;
    private $comentarioSa;
    private $comentarioDepto;
    private $enRevision;
    private $fueDesaprobado;
    private $query;

    /**
     *
     * @var mysqli_result
     */
    private $datos;

    function __construct($id = null, $datos = null) {
        //Si vienen datos de formulario (Alta) setea valores de Objeto
        if (isset($datos)) {
            //SETEAR TODOS LOS DATOS
            $this->setId($datos['id']);
            $this->setAnio($datos['anio']);
            $this->setAnioCarrera($datos['anioCarrera']);
            $this->setHorasTeoria($datos['horasTeoria']);
            $this->setHorasPractica($datos['horasPractica']);
            $this->setHorasOtros($datos['horasOtros']);
            $this->setRegimenCursada($datos['regimenCursada']);
            $this->setObservacionesHoras($datos['observacionesHoras']);
            $this->setObservacionesCursada($datos['observacionesCursada']);
            $this->setFundamentacion($datos['fundamentacion']);
            $this->setObjetivosGenerales($datos['objetivosGenerales']);
            $this->setOrganizacionContenidos($datos['organizacionContenidos']);
            $this->setCriteriosEvaluacion($datos['criteriosEvaluacion']);
            $this->setMetodologiaPresencial($datos['metodologiaPresencial']);
            $this->setRegularizacionPresencial($datos['regularizacionPresencial']);
            $this->setAprobacionPresencial($datos['aprobacionPresencial']);
            $this->setMetodologiaSATEP($datos['metodologiaSATEP']);
            $this->setRegularizacionSATEP($datos['regularizacionSATEP']);
            $this->setAprobacionSATEP($datos['aprobacionSATEP']);
            $this->setMetodologiaLibre($datos['metodologiaLibre']);
            $this->setAprobacionLibre($datos['aprobacionLibre']);
            $this->setUbicacion($datos['ubicacion']);
            $this->setIdAsignatura($datos['idAsignatura']);
            $this->setAprobadoSa($datos['aprobadoSa']);
            $this->setAprobadoDepto($datos['aprobadoDepto']);
            $this->setFechaCarga($datos['fechaCarga']);
            $this->setVigencia($datos['vigencia']);
    
        } else {
            //Sino viene un nuevo Objeto, lo recupero (para Modificar)
            if (isset($id)) {
                $this->recuperaObjeto($id);
            } else {
                return false;
            }
        }
    }

    function recuperaObjeto($id) {
        $this->id = $id;
        
        $this->query = "SELECT * FROM PROGRAMA WHERE id = {$this->id}";
        $this->datos = BDConexionSistema::getInstancia()->query($this->query);
        
        //validamos que devuelva un registro para setaear los atributos del objeto
        if ($this->datos->num_rows == 1){
            $this->datos = $this->datos->fetch_assoc();
            foreach ($this->datos as $atributo => $valor) {
                $this->{$atributo} = $valor;
            }    
        } else {
            // seteamos a NULL el id del objeto, con lo que se deberia validar si el id es NULL es que el no existe un programa con tal ID
            $this->setId(NULL);
        }

        unset($this->query);
        unset($this->datos);
    }

    function getId() {
        return $this->id;
    }

    function getAnio() {
        return $this->anio;
    }

    function getAnioCarrera() {
        return $this->anioCarrera;
    }

    function getHorasTeoria() {
        return $this->horasTeoria;
    }

    function getHorasPractica() {
        return $this->horasPractica;
    }

    function getHorasOtros() {
        return $this->horasOtros;
    }

    function getRegimenCursada() {
        return $this->regimenCursada;
    }

    function getObservacionesHoras() {
        return $this->observacionesHoras;
    }

    function getObservacionesCursada() {
        return $this->observacionesCursada;
    }

    function getIdAsignatura() {
        return $this->idAsignatura;
    }

    function getFundamentacion() {
        return $this->fundamentacion;
    }

    function getObjetivosGenerales() {
        return $this->objetivosGenerales;
    }

    function getOrganizacionContenidos() {
        return $this->organizacionContenidos;
    }

    function getCriteriosEvaluacion() {
        return $this->criteriosEvaluacion;
    }

    function getMetodologiaPresencial() {
        return $this->metodologiaPresencial;
    }

    function getRegularizacionPresencial() {
        return $this->regularizacionPresencial;
    }

    function getAprobacionPresencial() {
        return $this->aprobacionPresencial;
    }

    function getMetodologiaSATEP() {
        return $this->metodologiaSATEP;
    }

    function getRegularizacionSATEP() {
        return $this->regularizacionSATEP;
    }

    function getAprobacionSATEP() {
        return $this->aprobacionSATEP;
    }

    function getMetodologiaLibre() {
        return $this->metodologiaLibre;
    }

    function getAprobacionLibre() {
        return $this->aprobacionLibre;
    }

    function getUbicacion() {
        return $this->ubicacion;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setAnio($anio) {
        $this->anio = $anio;
    }

    function setAnioCarrera($anioCarrera) {
        $this->anioCarrera = $anioCarrera;
    }

    function setHorasTeoria($horasTeoria) {
        $this->horasTeoria = $horasTeoria;
    }

    function setHorasPractica($horasPractica) {
        $this->horasPractica = $horasPractica;
    }

    function setHorasOtros($horasOtros) {
        $this->horasOtros = $horasOtros;
    }

    function setRegimenCursada($regimenCursada) {
        $this->regimenCursada = $regimenCursada;
    }

    function setObservacionesHoras($observacionesHoras) {
        $this->observacionesHoras = $observacionesHoras;
    }

    function setObservacionesCursada($observacionesCursada) {
        $this->observacionesCursada = $observacionesCursada;
    }

    function setIdAsignatura($idAsignatura) {
        $this->idAsignatura = $idAsignatura;
    }

    function setFundamentacion($fundamentacion) {
        $this->fundamentacion = $fundamentacion;
    }

    function setObjetivosGenerales($objetivosGenerales) {
        $this->objetivosGenerales = $objetivosGenerales;
    }

    function setOrganizacionContenidos($organizacionContenidos) {
        $this->organizacionContenidos = $organizacionContenidos;
    }

    function setCriteriosEvaluacion($criteriosEvaluacion) {
        $this->criteriosEvaluacion = $criteriosEvaluacion;
    }

    function setMetodologiaPresencial($metodologiaPresencial) {
        $this->metodologiaPresencial = $metodologiaPresencial;
    }

    function setRegularizacionPresencial($regularizacionPresencial) {
        $this->regularizacionPresencial = $regularizacionPresencial;
    }

    function setAprobacionPresencial($aprobacionPresencial) {
        $this->aprobacionPresencial = $aprobacionPresencial;
    }

    function setMetodologiaSATEP($metodologiaSATEP) {
        $this->metodologiaSATEP = $metodologiaSATEP;
    }

    function setRegularizacionSATEP($regularizacionSATEP) {
        $this->regularizacionSATEP = $regularizacionSATEP;
    }

    function setAprobacionSATEP($aprobacionSATEP) {
        $this->aprobacionSATEP = $aprobacionSATEP;
    }

    function setMetodologiaLibre($metodologiaLibre) {
        $this->metodologiaLibre = $metodologiaLibre;
    }

    function setAprobacionLibre($aprobacionLibre) {
        $this->aprobacionLibre = $aprobacionLibre;
    }

    function setUbicacion($ubicacion) {
        $this->ubicacion = $ubicacion;
    }

    function getAprobadoSa() {
        return $this->aprobadoSa;
    }

    function getAprobadoDepto() {
        return $this->aprobadoDepto;
    }

    function getFechaCarga() {
        return $this->fechaCarga;
    }

    function getVigencia() {
        return $this->vigencia;
    }

    function setAprobadoSa($aprobadoSa) {
        $this->aprobadoSa = $aprobadoSa;
    }

    function setAprobadoDepto($aprobadoDepto) {
        $this->aprobadoDepto = $aprobadoDepto;
    }

    function setFechaCarga($fechaCarga) {
        $this->fechaCarga = $fechaCarga;
    }

    function setVigencia($vigencia) {
        $this->vigencia = $vigencia;
    }
    
    function getComentarioSa() {
        return $this->comentarioSa;
    }

    function getComentarioDepto() {
        return $this->comentarioDepto;
    }

    function setComentarioSa($comentarioSa) {
        $this->comentarioSa = $comentarioSa;
    }

    function setComentarioDepto($comentarioDepto) {
        $this->comentarioDepto = $comentarioDepto;
    }

    function getEnRevision() {
        return $this->enRevision;
    }

    function setEnRevision($enRevision) {
        $this->enRevision = $enRevision;
    }
    
    function getFueDesaprobado() {
        return $this->fueDesaprobado;
    }

    function setFueDesaprobado($fueDesaprobado) {
        $this->fueDesaprobado = $fueDesaprobado;
    }
    
    /*
     * 
     * @return Asignatura
     */

    function getAsignatura() {
        //Consulta para obtener los datos de la asigantura correspondiente al programa
        $this->query = "SELECT asignatura.id FROM ASIGNATURA JOIN PROGRAMA WHERE asignatura.id = programa.idAsignatura AND programa.id = '{$this->id}';";
        $this->datos = BDConexionSistema::getInstancia()->query($this->query);
        $Asignatura = new Asignatura(null, null);

        if ($this->datos->num_rows > 0) {
            //echo '<br> hola';
            $result = $this->datos->fetch_assoc();
            $Asignatura = new Asignatura($result['id'], null);
        }

        unset($this->query);
        unset($this->datos);

        return $Asignatura;
    }

    /**
     * 
     * @return Libro[]
     */
    function getLibrosObligatorios() {
        $this->query = "SELECT libro.id FROM libro JOIN programa WHERE programa.id = idPrograma AND tipoLibro LIKE 'O' AND idPrograma = {$this->id}";
        $this->datos = BDConexionSistema::getInstancia()->query($this->query);

        $Libros = NULL;

        if ($this->datos->num_rows > 0) {
            for ($x = 0; $x < $this->datos->num_rows; $x++) {
                $resultado = $this->datos->fetch_assoc();
                $Libros[] = new Libro($resultado['id']);
            }
        }

        unset($this->query);
        unset($this->datos);

        return $Libros;
    }

    /**
     * 
     * @return Libro[]
     */
    function getLibrosComplementarios() {
        $this->query = "SELECT libro.id FROM libro JOIN programa WHERE programa.id = idPrograma AND tipoLibro LIKE 'C' AND idPrograma = {$this->id}";
        $this->datos = BDConexionSistema::getInstancia()->query($this->query);

        $Libros = NULL;

        if ($this->datos->num_rows > 0) {
            for ($x = 0; $x < $this->datos->num_rows; $x++) {
                $resultado = $this->datos->fetch_assoc();
                $Libros[] = new Libro($resultado['id']);
            }
        }

        unset($this->query);
        unset($this->datos);

        return $Libros;
    }

    /**
     * 
     * @return Revista[]
     */
    function getRevistas() {
        $this->query = "SELECT revista.id FROM revista JOIN programa WHERE programa.id = idPrograma AND idPrograma = {$this->id}";
        $this->datos = BDConexionSistema::getInstancia()->query($this->query);

        $Revistas = NULL;

        if ($this->datos->num_rows > 0) {
            for ($x = 0; $x < $this->datos->num_rows; $x++) {
                $resultado = $this->datos->fetch_assoc();
                $Revistas[] = new Revista($resultado['id']);
            }
        }

        unset($this->query);
        unset($this->datos);

        return $Revistas;
    }

    /**
     * 
     * @return Recurso[]
     */
    function getRecursos() {
        $this->query = "SELECT recurso.id FROM recurso JOIN programa WHERE programa.id = idPrograma AND idPrograma = {$this->id}";
        $this->datos = BDConexionSistema::getInstancia()->query($this->query);

        $Recursos = NULL;

        if ($this->datos->num_rows > 0) {
            for ($x = 0; $x < $this->datos->num_rows; $x++) {
                $resultado = $this->datos->fetch_assoc();
                $Recursos[] = new Recurso($resultado['id']);
            }
        }

        unset($this->query);
        unset($this->datos);

        return $Recursos;
    }

    /**
     * 
     * @return OtroMaterial[]
     */
    function getOtroMateriales() {
        $this->query = "SELECT otro_material.id FROM otro_material JOIN programa WHERE programa.id = idPrograma AND idPrograma = {$this->id}";
        $this->datos = BDConexionSistema::getInstancia()->query($this->query);

        $OtroMateriales = NULL;

        if ($this->datos->num_rows > 0) {
            for ($x = 0; $x < $this->datos->num_rows; $x++) {
                $resultado = $this->datos->fetch_assoc();
                $OtroMateriales[] = new OtroMaterial($resultado['id']);
            }
        }

        unset($this->query);
        unset($this->datos);

        return $OtroMateriales;
    }
    
    function obtenerEstadoDelPrograma(){
        // Observacion el estado "No Cargado" se debe validar a la hora de obtener 
        // el programa vigente de la asignatura, si no tiene, devuelve NULL
        
        // V1.2
        $anioActual = date("Y"); //obtenemos el anio (4 digitos) del servidor (anio actual)
        $anioPrograma = $this->anio; // año de creacion del programa
        $anioVigencia = $this->vigencia;  // años de vigencia del programa
        
        /*
         * Un programa va a estar en vigencia si el año actual se encuentra en el segundo
         * de la vigencia ó en el tercer año de vigencia, ademas el programa tiene que estar aprobado
         */
        if ($anioActual > $anioPrograma && $anioActual <= ($anioPrograma+$anioVigencia-1) 
                && $this->aprobadoSa == "1" && $this->aprobadoDepto == "1"){
            return "En Vigencia";
        } elseif ($this->aprobadoSa == "1" && $this->aprobadoDepto == "1"){ // Estado Aprobado
            return "Aprobado";
        } elseif (($this->aprobadoSa == "0" && $this->aprobadoDepto == "0") || 
                ($this->aprobadoSa == "1" && $this->aprobadoDepto == "0") || 
                ($this->aprobadoSa == "0" && $this->aprobadoDepto == "1")) { // Estado Desaprobado
            return "Desaprobado";
        } elseif ($this->enRevision == "1") { // Estado En Revision
            return "En Revisi&oacute;n";
        } elseif ($this->enRevision == "0") { // Estado Cargando
            return "Cargando";
        } 
        
        // V1.1
//        if ($this->aprobadoSa == "1" && $this->aprobadoDepto == "1"){ // Estado Aprobado
//            return "Aprobado";
//        } elseif (($this->aprobadoSa == "0" && $this->aprobadoDepto == "0") || ($this->aprobadoSa == "1" && $this->aprobadoDepto == "0") || ($this->aprobadoSa == "0" && $this->aprobadoDepto == "1")) { // Estado Desaprobado
//            return "Desaprobado";
//        } elseif ($this->enRevision == "1") { // Estado En Revision
//            return "En Revisi&oacute;n";
//        } elseif ($this->enRevision == "0") { // Estado Cargando
//            return "Cargando";
//        } else { // Estado En Vigencia
//            return "En Vigencia";
//        }
       
//        if ($this->aprobadoSa == 1 && $this->aprobadoDepto == 1){ // Estado Aprobado
//            return "Aprobado";
//        } elseif (!is_null($this->aprobadoSa) && !is_null($this->aprobadoDepto) && $this->aprobadoSa == 0 && $this->aprobadoDepto == 0) { // Estado Desaprobado
//            return "Desaprobado";
//        } elseif ($this->enRevision == 1) { // Estado En Revision
//            return "En Revisi&oacute;n";
//        } elseif ($this->enRevision == 0) { // Estado Cargando
//            return "Cargando";
//        } else { // Estado En Vigencia
//            return "En Vigencia";
//        } 
    }
    
    

}
