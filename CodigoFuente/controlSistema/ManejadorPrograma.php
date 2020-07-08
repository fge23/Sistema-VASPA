<?php

include_once '../modeloSistema/BDConexionSistema.Class.php';
include_once '../modeloSistema/Programa.Class.php';
include_once '../lib/funcionesUtiles/sanearStringHTML.php';

/**
 * Description of ManejadorPrograma
 *
 * @author fabricio
 */
class ManejadorPrograma {

    private $query;

    /**
     *
     * @var mysqli_result
     */
    private $datos;

    /**
     *
     * @var Programa[] 
     */
    protected $coleccion;

    function __construct() {
        $this->setColeccion();
    }

    function setColeccion() {
        /*  $this->query = "SELECT * FROM PROGRAMA";
          $this->datos = BDConexionSistema::getInstancia()->query($this->query);

          for ($x = 0; $x < $this->datos->num_rows; $x++) {
          $Programa = new Programa();
          $fila = $this->datos->fetch_object();

          $Programa->setCodCarrera($fila->codCarrera);
          $Programa->setNombre($fila->nombre);

          $this->addElemento($Programa);
         */
    }

    function addElemento($elemento_) {
        $this->coleccion[] = $elemento_;
    }

    /**
     * 
     * @return Programa[]
     */
    function getColeccion() {
        return $this->coleccion;
    }

    function alta($datos) {
        $Programa = new Programa();
        $Programa->setAnio($datos['anio']);
        $Programa->setAnioCarrera($datos['anioCarrera']);
        $Programa->setHorasTeoria($datos['horasTeoria']);
        $Programa->setHorasPractica($datos['horasPractica']);
        /* TODO: revisar */
        if ($datos['horasOtros'] != "") {
            $Programa->setHorasOtros($datos['horasOtros']);
        } else {
            $Programa->setHorasOtros("null");
        }

        
        $observacionesHoras = sanearStringHTML($datos['observacionesHoras']);
        $observacionesCursada = sanearStringHTML($datos['observacionesCursada']);
        $fundamentacion = sanearStringHTML($datos['fundamentacion']);
        $objetivosGenerales = sanearStringHTML($datos['objetivosGenerales']);
        $organizacionContenidos = sanearStringHTML($datos['organizacionContenidos']);
        $criteriosEvaluacion = sanearStringHTML($datos['criteriosEvaluacion']);
        $metodologiaPresencial = sanearStringHTML($datos['metodologiaPresencial']);
        $regularizacionPresencial = sanearStringHTML($datos['regularizacionPresencial']);
        $aprobacionPresencial = sanearStringHTML($datos['aprobacionPresencial']);
        $metodologiaSATEP = sanearStringHTML($datos['metodologiaSATEP']);
        $regularizacionSATEP = sanearStringHTML($datos['regularizacionSATEP']);
        $aprobacionSATEP = sanearStringHTML($datos['aprobacionSATEP']);
        $metodologiaLibre = sanearStringHTML($datos['metodologiaLibre']);
        $aprobacionLibre = sanearStringHTML($datos['aprobacionLibre']);
        
        
        $Programa->setRegimenCursada($datos['regimenCursada']);
        $Programa->setObservacionesHoras($observacionesHoras);
        $Programa->setObservacionesCursada($observacionesCursada);
        $Programa->setFundamentacion($fundamentacion);
        $Programa->setObjetivosGenerales($objetivosGenerales);
        $Programa->setOrganizacionContenidos($organizacionContenidos);
        $Programa->setCriteriosEvaluacion($criteriosEvaluacion);
        $Programa->setMetodologiaPresencial($metodologiaPresencial);
        $Programa->setRegularizacionPresencial($regularizacionPresencial);
        $Programa->setAprobacionPresencial($aprobacionPresencial);
        $Programa->setMetodologiaSATEP($metodologiaSATEP);
        $Programa->setRegularizacionSATEP($regularizacionSATEP);
        $Programa->setAprobacionSATEP($aprobacionSATEP);
        $Programa->setMetodologiaLibre($metodologiaLibre);
        $Programa->setAprobacionLibre($aprobacionLibre);
        $Programa->setIdAsignatura($datos['idAsignatura']);
        $Programa->setFechaCarga($datos['fechaCarga']);
        $Programa->setVigencia($datos['vigencia']);
        

        //aniocarrera 1,2,3,4,5
        //regimen A,1,2, O
        $this->query = "INSERT INTO PROGRAMA "
                . "VALUES (null,{$Programa->getAnio()}, '{$Programa->getAnioCarrera()}', "
                . " '{$Programa->getHorasTeoria()}', '{$Programa->getHorasPractica()}', '{$Programa->getHorasOtros()}', "
                . " '{$Programa->getRegimenCursada()}', '{$Programa->getObservacionesHoras()}', '{$Programa->getObservacionesCursada()}', "
                . " '{$Programa->getFundamentacion()}', '{$Programa->getObjetivosGenerales()}', '{$Programa->getOrganizacionContenidos()}', "
                . "  '{$Programa->getCriteriosEvaluacion()}', '{$Programa->getMetodologiaPresencial()}', '{$Programa->getRegularizacionPresencial()}',"
                . "  '{$Programa->getAprobacionPresencial()}','{$Programa->getMetodologiaSATEP()}', '{$Programa->getRegularizacionSATEP()}', "
                . " '{$Programa->getAprobacionSATEP()}', '{$Programa->getMetodologiaLibre()}', '{$Programa->getAprobacionLibre()}',"
                . " NULL,'{$Programa->getIdAsignatura()}' , NULL, "
                . " NULL, '{$Programa->getFechaCarga()}', {$Programa->getVigencia()},"
                . "NULL, NULL, 0, 0)";
        // var_dump($this->query);
        $consulta = BDConexionSistema::getInstancia()->query($this->query);

        if ($consulta) {
            return true;
        } else {
            return false;
        }
    }

    //En este método se probará NO crear un objeto, sino directamente hacer el UPDATE con los datos que vienen del formulario
    function modificacion($datos, $idPrograma_) {
        
        $observacionesHoras = sanearStringHTML($datos['observacionesHoras']);
        $observacionesCursada = sanearStringHTML($datos['observacionesCursada']);
        $fundamentacion = sanearStringHTML($datos['fundamentacion']);
        $objetivosGenerales = sanearStringHTML($datos['objetivosGenerales']);
        $organizacionContenidos = sanearStringHTML($datos['organizacionContenidos']);
        $criteriosEvaluacion = sanearStringHTML($datos['criteriosEvaluacion']);
        $metodologiaPresencial = sanearStringHTML($datos['metodologiaPresencial']);
        $regularizacionPresencial = sanearStringHTML($datos['regularizacionPresencial']);
        $aprobacionPresencial = sanearStringHTML($datos['aprobacionPresencial']);
        $metodologiaSATEP = sanearStringHTML($datos['metodologiaSATEP']);
        $regularizacionSATEP = sanearStringHTML($datos['regularizacionSATEP']);
        $aprobacionSATEP = sanearStringHTML($datos['aprobacionSATEP']);
        $metodologiaLibre = sanearStringHTML($datos['metodologiaLibre']);
        $aprobacionLibre = sanearStringHTML($datos['aprobacionLibre']);
        
        
        $this->query = "UPDATE PROGRAMA "
                . "SET  "
                . "anio = {$datos['anio']}, "
                . "anioCarrera = '{$datos['anioCarrera']}', "
                . "horasTeoria = '{$datos['horasTeoria']}', "
                . "horasPractica = '{$datos['horasPractica']}', "
                . "horasOtros = '{$datos['horasOtros']}', "
                . "regimenCursada = '{$datos['regimenCursada']}', "
                . "observacionesHoras = '{$observacionesHoras}', "
                . "observacionesCursada = '{$observacionesCursada}', "
                . "fundamentacion = '{$fundamentacion}', "
                . "objetivosGenerales = '{$objetivosGenerales}', "
                . "organizacionContenidos = '{$organizacionContenidos}', "
                . "criteriosEvaluacion = '{$criteriosEvaluacion}', "
                . "metodologiaPresencial = '{$metodologiaPresencial}', "
                . "regularizacionPresencial = '{$regularizacionPresencial}', "
                . "aprobacionPresencial = '{$aprobacionPresencial}', "
                . "metodologiaSATEP = '{$metodologiaSATEP}', "
                . "regularizacionSATEP = '{$regularizacionSATEP}', "
                . "aprobacionSATEP = '{$aprobacionSATEP}', "
                . "metodologiaLibre = '{$metodologiaLibre}', "
                . "aprobacionLibre = '{$aprobacionLibre}', "
                . "fechaCarga = '{$datos['fechaCarga']}', "
                . "vigencia = '{$datos['vigencia']}', "
                . "aprobadoSA = NULL, "
                . "aprobadoDepto = NULL, "
                . "enRevision = 0 "
                . "WHERE id = {$idPrograma_}";
        //var_dump($this->query);
        $consulta = BDConexionSistema::getInstancia()->query($this->query);
        if ($consulta) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 
     * @return Programa
     */
    function getUltimoPrograma($anioActual, $idAsignatura) {
        $this->query = "SELECT id, anio "
                . "FROM PROGRAMA "
                . "WHERE anio < {$anioActual} AND idAsignatura LIKE '{$idAsignatura}' "
                . "ORDER BY anio DESC "
                . "LIMIT 1";

        $this->datos = BDConexionSistema::getInstancia()->query($this->query);
        $this->datos = $this->datos->fetch_assoc();
        return $this->datos['id'];
    }

    function modificarUbicacion($ubicacion, $id) {

        $this->query = "UPDATE PROGRAMA "
                . "SET ubicacion = '{$ubicacion}'"
                . "WHERE id = '{$id}'";
        $consulta = BDConexionSistema::getInstancia()->query($this->query);
        if ($consulta) {
            return true;
        } else {
            return false;
        }
    }

    function getUltimoID1($anio, $idAsignatura, $fechaCarga) {

        $this->query = "SELECT id "
                . "FROM PROGRAMA "
                . "WHERE idAsignatura = {$idAsignatura} "
                . "AND anio = {$anio} "
                . "AND fechaCarga = '{$fechaCarga}' "
                . "ORDER BY id desc "
                . "LIMIT 1";
        $this->datos = BDConexionSistema::getInstancia()->query($this->query);
        $this->datos = $this->datos->fetch_assoc();
        return $this->datos['id'];
    }

    function getUltimoID2() {
        $this->query = "SELECT LAST_INSERT_ID() as id";
        $this->datos = BDConexionSistema::getInstancia()->query($this->query);
        $this->datos = $this->datos->fetch_assoc();
        return $this->datos['id'];
    }

    function getIDProgramaActual($anioActual, $idAsignatura) {
        $this->query = "SELECT id "
                . "FROM PROGRAMA "
                . "WHERE anio = {$anioActual} AND idAsignatura LIKE '{$idAsignatura}' "
                . "ORDER BY anio DESC "
                . "LIMIT 1";
        $this->datos = BDConexionSistema::getInstancia()->query($this->query);
        $this->datos = $this->datos->fetch_assoc();
        return $this->datos['id'];
    }

}
