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
    
    /**
     * La siguiente funcion obtiene el Programa de la asignatura siempre y cuando
     * el anio actual se encuentre en la vigencia del Programa
     * Por ejemplo el anio del Programa es 2019, tiene una vigencia por 3 anios
     * es decir que es valido para los siguientes anios: 2019, 2020, 2021
     * Si el anio actual es 2020, entonces debera devolver ese programa (objeto)
     * Ahora bien si el actual no encuentra entre los valores de la vigencia 
     * entonces la funcion devolvera NULL --> Esto significa que no hay programa 
     * vigente para el anio actual, lo cual deberia habilitarse el boton "Crear Programa"
     * en la pantalla principal del Profesor.
     * @return Programa
     */
    function obtenerProgramaVigente(){
        // importamos la clase Programa
        include_once __DIR__.'/Programa.Class.php';
        //La constante __DIR__ retorna la ruta absoluta del directorio donde se encuentra el fichero que la está utilizando. Y dirname() retorna el directorio padre, en combinación dirname(__DIR__) nos retornaría la ruta absoluta del directorio padre donde se encuentra el fichero que la está usando.
        
        $anioActual = date("Y"); //obtenemos el anio (4 digitos) del servidor (anio actual)
        
        // obtenemos el programa de asignatura que tenga vigencia para el anio actual
        $this->query = "SELECT * "
                . "FROM programa "
                . "WHERE idAsignatura = '{$this->id}' AND "
                . "anio <= {$anioActual} AND "
                . "(anio+vigencia-1) >= {$anioActual}";
        
        $this->datos = BDConexionSistema::getInstancia()->query($this->query);
        
        // validamos el resultado de la query (si retorna false -> Ocurrio un error en la BD) Lanzamos una Excepcion informando el Error
        if (!$this->datos) {
            throw new Exception("Ocurrio un Error al obtener el Programa de la Asignatura: {$this->id}, '{$this->nombre}'.");
        }
        
        $programa = NULL;
        
        if ($this->datos->num_rows == 1) { // Deberia devolver solo un registro en caso de que haya
            $programa = $this->datos->fetch_object("Programa"); // creamos objeto programa
        }

        unset($this->query);
        unset($this->datos);

        return $programa;
                
    }

    function obtenerCantidadNotificacionDelProgramaActual(){       
        $anioActual = date("Y"); //obtenemos el anio (4 digitos) del servidor (anio actual)
        
        // obtenemos la cantidad de notificaciones enviadas al profesor solicitando
        // el programa de asignatura del anio actual
        $this->query = "SELECT COUNT(*) AS cantidad "
                . "FROM `registro_notificacion` "
                . "WHERE idProfesor = '{$this->idProfesor}' AND "
                . "idAsignatura = '{$this->id}' AND "
                . "YEAR(fecha) = {$anioActual}";
        
        $this->datos = BDConexionSistema::getInstancia()->query($this->query);
        
        // validamos el resultado de la query (si retorna false -> Ocurrio un error en la BD) Lanzamos una Excepcion informando el Error
        if (!$this->datos) {
            throw new Exception("Ocurrio un Error al obtener la cantidad de notificaciones enviadas al profesor solicitando el Programa de la Asignatura");
        }
        
        $cantidadNotificaciones = -1;
        
        if ($this->datos->num_rows == 1) { // Deberia devolver solo un registro en caso de que haya
            $cantidadNotificaciones = $this->datos->fetch_assoc()['cantidad']; // 
        }

        unset($this->query);
        unset($this->datos);

        return $cantidadNotificaciones;
                
    }
    
}
