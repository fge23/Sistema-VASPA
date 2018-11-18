<?php
include_once 'BDConexionSistema.Class.php';
/**
 * Description of Asignatura
 *
 * @author fabricio
 */
class Asignatura {

    protected $id;
    protected $nombre;
    protected $departamento;
    protected $contenidosMinimos;
    protected $idProfesor;
    private $query;

    /**
     *
     * @var mysqli_result
     */
    private $datos;

    function __construct($id = null) {

        if (isset($id)) {
            $this->id = $id;
            
            $this->query = "SELECT * FROM ASIGNATURA WHERE id = {$this->id}";
           
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

    function getNombre() {
        return $this->nombre;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }
    function getDepartamento() {
        return $this->departamento;
    }

    function getContenidosMinimos() {
        return $this->contenidosMinimos;
    }

    function getIdProfesor() {
        return $this->idProfesor;
    }

    function setDepartamento($departamento) {
        $this->departamento = $departamento;
    }

    function setContenidosMinimos($contenidosMinimos) {
        $this->contenidosMinimos = $contenidosMinimos;
    }

    function setIdProfesor($idProfesor) {
        $this->idProfesor = $idProfesor;
    }


}
