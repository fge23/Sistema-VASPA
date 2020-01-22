<?php

include_once 'C:/xampp/htdocs/vaspa/CodigoFuente/modeloSistema/BDConexionSistema.Class.php';
include_once 'C:/xampp/htdocs/vaspa/CodigoFuente/modeloSistema/Programa.Class.php';

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

    /*
     * TO DO: cambiar parametros de los SET y probar desde programa.crear
     */

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

        $Programa->setRegimenCursada($datos['regimenCursada']);
        $Programa->setObservacionesHoras($datos['observacionesHoras']);
        $Programa->setObservacionesCursada($datos['observacionesCursada']);
        $Programa->setFundamentacion($datos['fundamentacion']);
        $Programa->setObjetivosGenerales($datos['objetivosGenerales']);
        $Programa->setOrganizacionContenidos($datos['organizacionContenidos']);
        $Programa->setCriteriosEvaluacion($datos['criteriosEvaluacion']);
        $Programa->setMetodologiaPresencial($datos['metodologiaPresencial']);
        $Programa->setRegularizacionPresencial($datos['regularizacionPresencial']);
        $Programa->setAprobacionPresencial($datos['aprobacionPresencial']);
        $Programa->setMetodologiaSATEP($datos['metodologiaSATEP']);
        $Programa->setRegularizacionSATEP($datos['regularizacionSATEP']);
        $Programa->setAprobacionSATEP($datos['aprobacionSATEP']);
        $Programa->setMetodologiaLibre($datos['metodologiaLibre']);
        $Programa->setAprobacionLibre($datos['aprobacionLibre']);
        $Programa->setIdAsignatura($datos['idAsignatura']);
        $Programa->setAprobadoSa(0);
        $Programa->setAprobadoDepto(0);
        $Programa->setFechaCarga($datos['fechaCarga']);
        $Programa->setVigencia($datos['vigencia']);

        //aniocarrera 1,2,3,4,5
        //regimen A,1,2, O
        /*Se debe considerar el tema de los comentatios de Depto y de SA y el tema de la ubicacion predefinida*/
        $this->query = "INSERT INTO PROGRAMA "
                . "VALUES (null,{$Programa->getAnio()}, '{$Programa->getAnioCarrera()}', "
                . " '{$Programa->getHorasTeoria()}', '{$Programa->getHorasPractica()}', '{$Programa->getHorasOtros()}', "
                . " '{$Programa->getRegimenCursada()}', '{$Programa->getObservacionesHoras()}', '{$Programa->getObservacionesCursada()}', "
                . " '{$Programa->getFundamentacion()}', '{$Programa->getObjetivosGenerales()}', '{$Programa->getOrganizacionContenidos()}', "
                . "  '{$Programa->getCriteriosEvaluacion()}', '{$Programa->getMetodologiaPresencial()}', '{$Programa->getRegularizacionPresencial()}',"
                . "  '{$Programa->getAprobacionPresencial()}','{$Programa->getMetodologiaSATEP()}', '{$Programa->getRegularizacionSATEP()}', "
                . " '{$Programa->getAprobacionSATEP()}', '{$Programa->getMetodologiaLibre()}', '{$Programa->getAprobacionLibre()}',"
                . "  'SA','{$Programa->getIdAsignatura()}' , {$Programa->getAprobadoSa()},"
                . " {$Programa->getAprobadoDepto()}, '{$Programa->getFechaCarga()}', {$Programa->getVigencia()},"
                . "' ', ' ' )";
        //var_dump($this->query);
        $consulta = BDConexionSistema::getInstancia()->query($this->query);
        if ($consulta) {
            return true;
        } else {
            return false;
        }
    }

//    function modificacion($datos, $codCarrera){
//        $Carrera = new Carrera();
//        $Carrera->setCodCarrera($datos['codCarrera']);
//        $Carrera->setNombre($datos['nombre']);
//        $this->query = "UPDATE CARRERA "
//                . "SET codCarrera = {$Carrera->getCodCarrera()} , nombre = '{$Carrera->getNombre()}' "
//                . "WHERE codCarrera = {$codCarrera}";
//        $consulta = BDConexionSistema::getInstancia()->query($this->query);
//        if ($consulta) {
//            return true;
//        } else {
//            return false;
//        }
//    }

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

}
