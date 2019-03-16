<?php

include_once '../modeloSistema/BDConexionSistema.Class.php';
include_once '../modeloSistema/Carrera.Class.php';

/**
 * Description of ManejadorCarrera
 *
 * @author fabricio
 */
class ManejadorCarrera {

    private $query;

    /**
     *
     * @var mysqli_result
     */
    private $datos;

    /**
     *
     * @var Carrera[] 
     */
    protected $coleccion;

    function __construct() {
        $this->setColeccion();
    }

    //Metodo que crea la coleccion Carreras
    function setColeccion() {
        $this->query = "SELECT * FROM CARRERA";
        $this->datos = BDConexionSistema::getInstancia()->query($this->query);

        for ($x = 0; $x < $this->datos->num_rows; $x++) {
            $this->addElemento($this->datos->fetch_object("Carrera"));
        }
    }

    function addElemento($elemento_) {
        $this->coleccion[] = $elemento_;
    }

    /**
     * 
     * @return Carrera[]
     */
    function getColeccion() {
        return $this->coleccion;
    }

    //Funcion para Alta de Carreras
    function alta($datos) {
       
        //Creo objeto sin enviar ID y enviando todos los datos del formulario
        $Carrera = new Carrera(null,$datos);
        
        //Seteo el nuevo ID como el ID que viene del formulario, completado con 0 a la izquierda
        $Carrera->setId($this->completaConCeros($Carrera->getId()));
        $this->query = "INSERT INTO CARRERA "
                . "VALUES ('{$Carrera->getId()}','{$Carrera->getNombre()}')";
        $consulta = BDConexionSistema::getInstancia()->query($this->query);
        if ($consulta) {
            return true;
        } else {
            return false;
        }
    }
    
    function baja($id_){
        $this->query = "DELETE FROM CARRERA WHERE id = '{$id_}'";
        $consulta = BDConexionSistema::getInstancia()->query($this->query);
        if ($consulta) {
            return true;
        } else {
            return false;
        }
    }
    
    
    //Funcion para Modificación de Carreras
    function modificacion($datos, $id_) {
        $Carrera = new Carrera(null, $datos);
        $idCarrera = $datos['id'];
        $idAux = $this->completaConCeros($idCarrera);
        $Carrera->setId($idAux);
        $this->query = "UPDATE CARRERA "
                . "SET id = '{$Carrera->getId()}' , nombre = '{$Carrera->getNombre()}' "
                . "WHERE id = '{$id_}'";
        $consulta = BDConexionSistema::getInstancia()->query($this->query);
        if ($consulta) {
            return true;
        } else {
            return false;
        }
    }

    function completaConCeros($id_) {
        $idCarrera = (String) $id_;

        if (strlen($idCarrera) == 2) {
            $idCarrera = "0" . $idCarrera;
        }
        if (strlen($idCarrera) == 1) {
            $idCarrera = "00" . $idCarrera;
        }

        return $idCarrera;
    }

}
