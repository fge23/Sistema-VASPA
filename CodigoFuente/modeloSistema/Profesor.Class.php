<?php
include_once 'BDConexionSistema.Class.php';
//include_once '';

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


    
}
