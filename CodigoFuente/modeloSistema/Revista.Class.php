<?php
include_once 'BDConexionSistema.Class.php';

/**
 * Description of Revista
 *
 * @author Francisco
 */
class Revista {
    private $id;
    private $apellido;
    private $nombre;
    private $tituloArticulo;
    private $tituloRevista;
    private $pagina;
    private $fecha;
    private $unidad;
    private $biblioteca;
    private $siunpa;
    private $otro;
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
            
            $this->query = "SELECT * FROM REVISTA WHERE id = {$this->id}";
           
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

    function getTituloArticulo() {
        return $this->tituloArticulo;
    }

    function getTituloRevista() {
        return $this->tituloRevista;
    }

    function getPagina() {
        return $this->pagina;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getUnidad() {
        return $this->unidad;
    }

    function getBiblioteca() {
        return $this->biblioteca;
    }

    function getSiunpa() {
        return $this->siunpa;
    }

    function getOtro() {
        return $this->otro;
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

    function setTituloArticulo($tituloArticulo) {
        $this->tituloArticulo = $tituloArticulo;
    }

    function setTituloRevista($tituloRevista) {
        $this->tituloRevista = $tituloRevista;
    }

    function setPagina($pagina) {
        $this->pagina = $pagina;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setUnidad($unidad) {
        $this->unidad = $unidad;
    }

    function setBiblioteca($biblioteca) {
        $this->biblioteca = $biblioteca;
    }

    function setSiunpa($siunpa) {
        $this->siunpa = $siunpa;
    }

    function setOtro($otro) {
        $this->otro = $otro;
    }

    function setIdPrograma($idPrograma) {
        $this->idPrograma = $idPrograma;
    }

    
}
