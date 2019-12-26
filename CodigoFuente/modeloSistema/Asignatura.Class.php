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
    protected $idDepartamento;
    protected $contenidosMinimos;
    protected $idProfesor;
    protected $horasSemanales;
    private $query;

    /**
     *
     * @var mysqli_result
     */
    private $datos;

    function __construct($id = null, $datos = null) {

        //Si vienen datos de formulario (Alta) setea valores de Objeto
        if (isset($datos)) {
            $this->setId($datos['id']);
            $this->setNombre($datos['nombre']);
            $this->setContenidosMinimos($datos['contenidosMinimos']);
            $this->setIdDepartamento($datos['departamento']);
            $this->setIdProfesor($datos['idProfesor']);
            $this->setHorasSemanales($datos['horasSemanales']);
        } else {
            //Sino viene un nuevo Objeto, lo recupero (para Modificar)
            if (isset($id)) {
                $this->recuperaObjeto($id);
            } else {
                return false;
            }
        }
    }

    function recuperaObjeto($id) {
        $this->id = $id;

        $this->query = "SELECT * FROM ASIGNATURA WHERE id = '{$this->id}'";

        $this->datos = BDConexionSistema::getInstancia()->query($this->query);

        $this->datos = $this->datos->fetch_assoc();

        foreach ($this->datos as $atributo => $valor) {
            $this->{$atributo} = $valor;
        }
        unset($this->query);
        unset($this->datos);
    }

     function getHorasSemanales() {
        return $this->horasSemanales;
    }

    function setHorasSemanales($horasSemanales) {
        $this->horasSemanales = $horasSemanales;
    }
    
    function getIdDepartamento() {
        return $this->idDepartamento;
    }

    function setIdDepartamento($idDepartamento) {
        $this->idDepartamento = $idDepartamento;
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

    function getContenidosMinimos() {
        return $this->contenidosMinimos;
    }

    function getIdProfesor() {
        return $this->idProfesor;
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
    function getCarreras() {
        $this->query = "SELECT carrera.id, carrera.nombre FROM asignatura JOIN plan_asignatura JOIN plan JOIN carrera WHERE asignatura.id = plan_asignatura.idAsignatura AND plan_asignatura.idPlan = plan.id AND plan.idCarrera = carrera.id AND asignatura.id = '{$this->id}'";
        $this->datos = BDConexionSistema::getInstancia()->query($this->query);

        $Carreras = NULL;

        for ($x = 0; $x < $this->datos->num_rows; $x++) {
            $Carreras[] = $this->datos->fetch_object("Carrera");
            //$this->addElemento($this->datos->fetch_object("Carrera"));
        }

        unset($this->query);
        unset($this->datos);
        //echo $Carreras;
        return $Carreras;
    }

    /**
     * 
     * @return Profesor[]
     */
    function getProfesoresPractica() {
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
    
    /**
     * 
     * @return Profesor[]
     */
    function getProfesoresPracticaSinResponsable() {
        $this->query = "SELECT profesor_asignatura.idProfesor FROM profesor_asignatura JOIN asignatura WHERE asignatura.id = profesor_asignatura.idAsignatura AND rol LIKE 'practica' AND asignatura.id = {$this->id} AND profesor_asignatura.idProfesor != {$this->idProfesor}";
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

    /**
     * 
     * @return Profesor[]
     */
    function getProfesoresTeoria() {
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
    
    /**
     * 
     * @return Profesor[]
     *
    function getProfesoresTeoriaSinResponsable() {
        $this->query = "SELECT profesor_asignatura.idProfesor FROM profesor_asignatura JOIN asignatura WHERE asignatura.id = profesor_asignatura.idAsignatura AND rol LIKE 'teoria' AND asignatura.id = {$this->id} AND profesor_asignatura.idProfesor != {$this->idProfesor}";
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
     * 
     */

    /**
     * 
     * @return Asignatura[]
     */
    function getAsigCorrelativaPrecedenteAprobada() {
        $this->query = "SELECT idAsignatura_Correlativa_Anterior AS codAsignatura FROM asignatura JOIN correlativa_de WHERE idAsignatura = asignatura.id AND requisito LIKE 'Aprobada' AND asignatura.id LIKE '{$this->id}'";
        $this->datos = BDConexionSistema::getInstancia()->query($this->query);
        $Asignaturas = NULL;
        if ($this->datos->num_rows > 0) {
            for ($x = 0; $x < $this->datos->num_rows; $x++) {
                $resultado = $this->datos->fetch_assoc();
                $Asignaturas[] = new Asignatura($resultado['codAsignatura']);
            }
        }


        unset($this->query);
        unset($this->datos);

        return $Asignaturas;
    }

    function getAsigCorrelativaPrecedenteCursada() {
        $this->query = "SELECT idAsignatura_Correlativa_Anterior AS codAsignatura FROM asignatura JOIN correlativa_de WHERE idAsignatura = asignatura.id AND requisito LIKE 'Regular' AND asignatura.id LIKE '{$this->id}'";
        $this->datos = BDConexionSistema::getInstancia()->query($this->query);
        $Asignaturas = NULL;
        if ($this->datos->num_rows > 0) {
            for ($x = 0; $x < $this->datos->num_rows; $x++) {
                $resultado = $this->datos->fetch_assoc();
                $Asignaturas[] = new Asignatura($resultado['codAsignatura']);
            }
        }


        unset($this->query);
        unset($this->datos);

        return $Asignaturas;
    }

    /**
     * 
     * @return Asignatura[]
     */
    function getAsigCorrelativaSubsiguienteAprobada() {
        $this->query = "SELECT idAsignatura AS codAsignatura FROM asignatura JOIN correlativa_de WHERE idAsignatura_Correlativa_Anterior = asignatura.id AND requisito LIKE 'Aprobada' AND asignatura.id LIKE '{$this->id}'";
        $this->datos = BDConexionSistema::getInstancia()->query($this->query);
        $Asignaturas = NULL;
        if ($this->datos->num_rows > 0) {
            for ($x = 0; $x < $this->datos->num_rows; $x++) {
                $resultado = $this->datos->fetch_assoc();
                $Asignaturas[] = new Asignatura($resultado['codAsignatura'], null);
            }
        }


        unset($this->query);
        unset($this->datos);

        return $Asignaturas;
    }

    function getAsigCorrelativaSubsiguienteCursada() {
        $this->query = "SELECT idAsignatura AS codAsignatura FROM asignatura JOIN correlativa_de WHERE idAsignatura_Correlativa_Anterior = asignatura.id AND requisito LIKE 'Regular' AND asignatura.id LIKE '{$this->id}'";
        $this->datos = BDConexionSistema::getInstancia()->query($this->query);
        $Asignaturas = NULL;
        if ($this->datos->num_rows > 0) {
            for ($x = 0; $x < $this->datos->num_rows; $x++) {
                $resultado = $this->datos->fetch_assoc();
                $Asignaturas[] = new Asignatura($resultado['codAsignatura'], null);
            }
        }


        unset($this->query);
        unset($this->datos);

        return $Asignaturas;
    }

}
