<?php

include_once '../modeloSistema/BDConexionSistema.Class.php';
include_once '../modeloSistema/Plan.Class.php';

/**
 * Description of ManejadorPlan
 *
 * @author fabricio
 */
class ManejadorPlan {

    private $query;

    /**
     *
     * @var mysqli_result
     */
    private $datos;

    /**
     *
     * @var Plan[] 
     */
    protected $coleccion;

    function __construct() {
        $this->setColeccion();
    }

    //Metodo que crea la coleccion Planes
    function setColeccion() {
        $this->query = "SELECT * FROM PLAN";
        $this->datos = BDConexionSistema::getInstancia()->query($this->query);

        for ($x = 0; $x < $this->datos->num_rows; $x++) {
            $this->addElemento($this->datos->fetch_object("Plan"));
        }
    }

    function addElemento($elemento_) {
        $this->coleccion[] = $elemento_;
    }

    /**
     * 
     * @return Plan[]
     */
    function getColeccion() {
        return $this->coleccion;
    }

    //Funcion para Alta de Planes
    function alta($datos) {
       
        //Creo objeto sin enviar ID y enviando todos los datos del formulario
        $Plan = new Plan(null,$datos);
        
        $this->query = "INSERT INTO PLAN "
                . "VALUES ('{$Plan->getId()}',{$Plan->getAnio_inicio()},'{$Plan->getIdCarrera()}',{$Plan->getAnio_fin()} )";
        
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
        $Carrera = new Carrera();
        $idCarrera = $datos['idActual'];
        $idAux = $this->completaConCeros($idCarrera);
        $Carrera->setId($idAux);
        $Carrera->setNombre($datos['nombreActual']);
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


}
