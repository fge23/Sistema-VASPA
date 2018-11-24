<?php
include_once 'BDConexionSistema.Class.php';

/**
 * Description of ProgramaPDF
 *
 * @author Francisco
 */
class ProgramaPDF {
    private $nombre;
    private $anio;
    private $descripcion;
    private $ruta;
    private $tamanio;
    
    private $query;

    /**
     *
     * @var mysqli_result
     */
    private $datos;
    
    function __construct($nombre = null, $anio = null) {

        if (isset($nombre) && isset($anio)) {
            $this->nombre = $nombre;
            $this->anio = $anio;
            
            $this->query = "SELECT * FROM programa_pdf WHERE nombre = {$nombre} AND anio = {$anio}";
           
            $this->datos = BDConexionSistema::getInstancia()->query($this->query);
           
            $this->datos = $this->datos->fetch_assoc();
            
            $this->descripcion = $this->datos['descripcion'];
            $this->ruta = $this->datos['ruta'];
            $this->tamanio = $this->datos['tamanio'];

            /*
            foreach ($this->datos as $atributo => $valor) {
                $this->{$atributo} = $valor;
            }*/
            unset($this->query);
            unset($this->datos);
        } else {
            return false;
        }
    }
    
    function getNombre() {
        return $this->nombre;
    }

    function getAnio() {
        return $this->anio;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getRuta() {
        return $this->ruta;
    }

    function getTamanio() {
        return $this->tamanio;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setAnio($anio) {
        $this->anio = $anio;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setRuta($ruta) {
        $this->ruta = $ruta;
    }

    function setTamanio($tamanio) {
        $this->tamanio = $tamanio;
    }


    
}
