<?php
include_once 'BDConexionSistema.Class.php';
include_once 'Carrera.Class.php';
include_once 'Profesor.Class.php';

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

    /**
     * 
     * @return Carrera[]
     */
    function  getCarreras(){
        $this->query = "SELECT carrera.id, carrera.nombre FROM asignatura JOIN plan_asignatura JOIN plan JOIN carrera WHERE asignatura.id = plan_asignatura.idAsignatura AND plan_asignatura.idPlan = plan.id AND plan.idCarrera = carrera.id AND asignatura.id = {$this->id}";
        $this->datos = BDConexionSistema::getInstancia()->query($this->query);
        
        //$Carreras[];
        
        for ($x = 0; $x < $this->datos->num_rows; $x++) {
            $Carreras[] = $this->datos->fetch_object("Carrera");
            //$this->addElemento($this->datos->fetch_object("Carrera"));
        }
        
        unset($this->query);
        unset($this->datos);
        
        return $Carreras;
    }
    
    /**
     * 
     * @return Profesor[]
     */
    function  getProfesoresPractica(){
        $this->query = "SELECT profesor_asignatura.idProfesor FROM profesor_asignatura JOIN asignatura WHERE asignatura.id = profesor_asignatura.idAsignatura AND rol LIKE 'practica' AND asignatura.id = {$this->id}";
        $this->datos = BDConexionSistema::getInstancia()->query($this->query);
        $Profesores = NULL;   
        for ($x = 0; $x < $this->datos->num_rows; $x++) {
            $resultado = $this->datos->fetch_assoc();
            $Profesores[] = new Profesor($resultado['idProfesor']);
        }
        
        unset($this->query);
        unset($this->datos);
        
        return $Profesores;
    }
    
    function  getProfesoresTeoria(){
        $this->query = "SELECT profesor_asignatura.idProfesor FROM profesor_asignatura JOIN asignatura WHERE asignatura.id = profesor_asignatura.idAsignatura AND rol LIKE 'teoria' AND asignatura.id = {$this->id}";
        $this->datos = BDConexionSistema::getInstancia()->query($this->query);
        $Profesores = NULL;   
        for ($x = 0; $x < $this->datos->num_rows; $x++) {
            $resultado = $this->datos->fetch_assoc();
            $Profesores[] = new Profesor($resultado['idProfesor']);
        }
        
        unset($this->query);
        unset($this->datos);
        
        return $Profesores;
    }
    
}
