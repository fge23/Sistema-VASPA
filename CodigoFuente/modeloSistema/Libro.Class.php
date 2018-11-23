<?php
include_once 'BDConexionSistema.Class.php';

/**
 * Description of Libro
 *
 * @author Francisco
 */
class Libro {
    private $id;
    private $referencia;
    private $apellido;
    private $nombre;
    private $anioEdicion;
    private $titulo;
    private $capitulo;
    private $lugarEdicion;
    private $Editorial;
    private $unidad;
    private $biblioteca;
    private $siunpa;
    private $otro;
    private $tipoLibro;
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
            
            $this->query = "SELECT * FROM LIBRO WHERE id = {$this->id}";
           
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

    function getReferencia() {
        return $this->referencia;
    }

    function getApellido() {
        return $this->apellido;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getAnioEdicion() {
        return $this->anioEdicion;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function getCapitulo() {
        return $this->capitulo;
    }

    function getLugarEdicion() {
        return $this->lugarEdicion;
    }

    function getEditorial() {
        return $this->Editorial;
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

    function getTipoLibro() {
        return $this->tipoLibro;
    }

    function getIdPrograma() {
        return $this->idPrograma;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setReferencia($referencia) {
        $this->referencia = $referencia;
    }

    function setApellido($apellido) {
        $this->apellido = $apellido;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setAnioEdicion($anioEdicion) {
        $this->anioEdicion = $anioEdicion;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    function setCapitulo($capitulo) {
        $this->capitulo = $capitulo;
    }

    function setLugarEdicion($lugarEdicion) {
        $this->lugarEdicion = $lugarEdicion;
    }

    function setEditorial($Editorial) {
        $this->Editorial = $Editorial;
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

    function setTipoLibro($tipoLibro) {
        $this->tipoLibro = $tipoLibro;
    }

    function setIdPrograma($idPrograma) {
        $this->idPrograma = $idPrograma;
    }


    
}
