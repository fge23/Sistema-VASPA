<?php
include_once '../modeloSistema/BDConexionSistema.Class.php';
include_once '../modeloSistema/Profesor.Class.php';

/**
 * Description of ManejadorProfesor
 *
 * @author francisco
 */
class ManejadorProfesor {

    private $query;

    /**
     *
     * @var mysqli_result
     */
    private $datos;

    /**
     *
     * @var Profesor[] 
     */
    protected $coleccion;

    function __construct() {
        $this->setColeccion();
    }

    //Metodo que crea la coleccion Profesores
    function setColeccion() {
        $this->query = "SELECT * FROM PROFESOR";
        $this->datos = BDConexionSistema::getInstancia()->query($this->query);

        for ($x = 0; $x < $this->datos->num_rows; $x++) {
            $this->addElemento($this->datos->fetch_object("Profesor"));
        }
    }

    function addElemento($elemento_) {
        $this->coleccion[] = $elemento_;
    }

    /**
     * 
     * @return Profesor[]
     */
    function getColeccion() {
        return $this->coleccion;
    }

    //Funcion para Alta de Profesores
    function alta($datos) {

        //Creo objeto sin enviar ID y enviando todos los datos del formulario
        $Profesor = new Profesor(null, $datos);
        
        $this->query = "INSERT INTO PROFESOR "
                . "VALUES ('{$Profesor->getId()}', '{$Profesor->getDni()}', '{$Profesor->getNombre()}', '{$Profesor->getApellido()}',"
                . "'{$Profesor->getEmail()}', '{$Profesor->getCategoria()}', '{$Profesor->getPreferencias()}', '{$Profesor->getIdDepartamento()}')";

        $consulta = BDConexionSistema::getInstancia()->query($this->query);
        if ($consulta) {
            return true;
        } else {
            return false;
        }
    }

    function baja($id_) {
        $this->query = "DELETE FROM PROFESOR WHERE id = '{$id_}'";
        $consulta = BDConexionSistema::getInstancia()->query($this->query);
        if ($consulta) {
            return true;
        } else {
            return false;
        }
    }

    //Funcion para Modificación de Profesores
    function modificacion($datos, $id_) {
     
        $Profesor = new Profesor(null, $datos);
        $this->query = "UPDATE PROFESOR "
                . "SET dni = '{$Profesor->getDni()}', "
                        . "nombre = '{$Profesor->getNombre()}', "
                        . "apellido = '{$Profesor->getApellido()}', "
                        . "email = '{$Profesor->getEmail()}', "
                        . "idDepartamento = '{$Profesor->getIdDepartamento()}' "
                        . "WHERE id = '{$id_}'";
        $consulta = BDConexionSistema::getInstancia()->query($this->query);
        if ($consulta) {
            return true;
        } else {
            return false;
        }
    }
    
}
