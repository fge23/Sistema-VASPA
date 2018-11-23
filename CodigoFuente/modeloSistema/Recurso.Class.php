<?php
include_once 'BDConexionSistema.Class.php';
/**
 * Description of Recurso
 *
 * @author Francisco
 */
class Recurso {
    
    private $id;
    private $apellido;
    private $nombre;
    private $titulo;
    private $datosAdicionales;
    private $disponibilidad;
    private $idPrograma;
    
    private $query;

    /**
     *
     * @var mysqli_result
     */
    private $datos;
    
    function __construct($id_ = null) {

        if (isset($id_)) {
            $this->id = $id_;
            
            $this->query = "SELECT * FROM RECURSO WHERE id = {$this->id}";
           
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

    function getApellido() {
        return $this->apellido;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function getDatosAdicionales() {
        return $this->datosAdicionales;
    }

    function getDisponibilidad() {
        return $this->disponibilidad;
    }

    function getIdPrograma() {
        return $this->idPrograma;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setApellido($apellido) {
        $this->apellido = $apellido;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    function setDatosAdicionales($datosAdicionales) {
        $this->datosAdicionales = $datosAdicionales;
    }

    function setDisponibilidad($disponibilidad) {
        $this->disponibilidad = $disponibilidad;
    }

    function setIdPrograma($idPrograma) {
        $this->idPrograma = $idPrograma;
    }

   
}
