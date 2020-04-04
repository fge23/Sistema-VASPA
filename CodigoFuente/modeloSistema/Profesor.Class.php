<?php
include_once 'BDConexionSistema.Class.php';

/**
 * Description of Profesor
 *
 * @author Francisco
 */
class Profesor {
    private $id;
    private $dni;
    private $nombre;
    private $apellido;
    private $email;
    private $categoria;
    private $preferencias;
    private $idDepartamento;
    
    private $query;

    /**
     *
     * @var mysqli_result
     */
    private $datos;
    
    function __construct($id = null, $datos = null) {
        //Si vienen datos del formulario (Alta) setea valores de Objeto
        if (isset($datos)) {
            //$this->setId($datos['id']);
            //id = NULL debido a que el id es autoincremental
            $this->setId(NULL);
            $this->setDni($datos['dni']);
            $this->setNombre($datos['nombre']);
            $this->setApellido($datos['apellido']);
            $this->setEmail($datos['email']);
            $this->setCategoria($datos['categoria']);
            //$this->setPreferencias($datos['preferencias']);
            // Nulo debido a que es una dato que no es de interes en nuestro sistema
            $this->setPreferencias(NULL);
            $this->setIdDepartamento($datos['idDepartamento']);
        } else {
            //Sino viene un Objeto, lo recupero (para Modificar)
            if (isset($id)) {
                $this->recuperaObjeto($id);
            } else {
                return false;
            }
        }
        
    }
    
    function recuperaObjeto($id) {
        $this->id = $id;
        $this->query = "SELECT * FROM PROFESOR WHERE id = '{$this->id}'";
        
        $this->datos = BDConexionSistema::getInstancia()->query($this->query);
        $this->datos = $this->datos->fetch_assoc();
        
        foreach ($this->datos as $atributo => $valor) {
            $this->{$atributo} = $valor;
        }
        unset($this->query);
        unset($this->datos);
    }    
            
    function getId() {
        return $this->id;
    }

    function getDni() {
        return $this->dni;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getApellido() {
        return $this->apellido;
    }

    function getEmail() {
        return $this->email;
    }

    function getCategoria() {
        return $this->categoria;
    }

    function getIdDepartamento() {
        return $this->idDepartamento;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDni($dni) {
        $this->dni = $dni;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setApellido($apellido) {
        $this->apellido = $apellido;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setCategoria($categoria) {
        $this->categoria = $categoria;
    }

    function setIdDepartamento($idDepartamento) {
        $this->idDepartamento = $idDepartamento;
    }

    function getPreferencias() {
        return $this->preferencias;
    }

    function setPreferencias($preferencias) {
        $this->preferencias = $preferencias;
    }

    // Funcion que retorna en un array las asignaturas en las cuales el profesor
    // es responsable. Si no es responsable de asignaturas devuelve NULL
    /**
     * 
     * @return Asignatura[]
     */
    function obtenerAsignaturas(){
        // importamos la clase Asignatura
        include_once __DIR__.'/Asignatura.Class.php';
        //La constante __DIR__ retorna la ruta absoluta del directorio donde se encuentra el fichero que la está utilizando. Y dirname() retorna el directorio padre, en combinación dirname(__DIR__) nos retornaría la ruta absoluta del directorio padre donde se encuentra el fichero que la está usando.
        
        // obtenemos las asignaturas en donde es responsable el profesor
        $this->query = "SELECT * "
                . "FROM asignatura "
                . "WHERE idProfesor = '{$this->id}'";
                
        $this->datos = BDConexionSistema::getInstancia()->query($this->query);
        
        // validamos el resultado de la query (si retorna false -> Ocurrio un error en la BD) Lanzamos una Excepcion informando el Error
        if (!$this->datos) {
            throw new Exception("Ocurrio un Error al obtener las Asignaturas del Profesor: {$this->apellido}, '{$this->nombre}'.");
        }
        
        $asignaturas = NULL;
        
        if ($this->datos->num_rows > 0) {
            for ($x = 0; $x < $this->datos->num_rows; $x++) {
                $asignaturas[] = $this->datos->fetch_object("Asignatura"); // creamos objeto
            }
        }

        unset($this->query);
        unset($this->datos);

        return $asignaturas;
    }
    
}
