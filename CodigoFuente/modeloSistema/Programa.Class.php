<?php
include_once './BDConexionSistema.Class.php';
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
    private $codAsignatura;
  
    private $query;

    /**
     *
     * @var mysqli_result
     */
    private $datos;
    
    
    function __construct($id_ = null) {
         if (isset($id_)) {
            $this->id = $id_;
            
            $this->query = "SELECT * FROM PROGRAMA WHERE id = {$this->id}";
           
            $this->datos = BDConexionSistema::getInstancia()->query($this->query);
           
            $this->datos = $this->datos->fetch_assoc();

            foreach ($this->datos as $atributo => $valor) {
                $this->{$atributo} = $valor;
            }
            unset($this->query);
            unset($this->datos);
        } else {
            return false;
        }
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

    function getCodAsignatura() {
        return $this->codAsignatura;
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

    function setCodAsignatura($codAsignatura) {
        $this->codAsignatura = $codAsignatura;
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

   


}
