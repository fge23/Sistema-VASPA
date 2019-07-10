<?php
include_once 'BDConexionSistema.Class.php';

/**
 * Description of PlanPDF
 *
 * @author Francisco
 */

class PlanPDF {
    private $nombre;
    private $descripcion;
    private $ruta;
    private $tamanio;
    
    private $query;

    /**
     *
     * @var mysqli_result
     */
    private $datos;
    
    function __construct($nombre = null) {

        if (isset($nombre)) {
            $this->nombre = $nombre;
            
            $this->query = "SELECT * FROM plan_pdf WHERE nombre LIKE '".$nombre."%'";

            $this->datos = BDConexionSistema::getInstancia()->query($this->query);
            
            $this->datos = $this->datos->fetch_assoc();
            
            $this->descripcion = $this->datos['descripcion'];
            $this->ruta = $this->datos['ruta'];
            $this->tamanio = $this->datos['tamanio'];

            unset($this->query);
            unset($this->datos);
        } else {
            return false;
        }
    }
    
    function getNombre() {
        return $this->nombre;
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
