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

    function alta($datos) {
        $Carrera = new Carrera();
        $Carrera->setId($datos['id']);
        $Carrera->setNombre($datos['nombre']);
        $this->query = "INSERT INTO CARRERA "
                . "VALUES ({$Carrera->setId()},'{$Carrera->getNombre()}')";
        $consulta = BDConexionSistema::getInstancia()->query($this->query);
        if ($consulta) {
            return true;
        } else {
            return false;
        }
    }

    function modificacion($datos, $id) {
        $Carrera = new Carrera();
        $Carrera->setId($datos['id']);
        $Carrera->setNombre($datos['nombre']);
        $this->query = "UPDATE CARRERA "
                . "SET id = {$Carrera->getId()} , nombre = '{$Carrera->getNombre()}' "
                . "WHERE id = {$id}";
        $consulta = BDConexionSistema::getInstancia()->query($this->query);
        if ($consulta) {
            return true;
        } else {
            return false;
        }
    }

}
$ManejadorCarrera = new ManejadorCarrera();
$Carreras = $ManejadorCarrera->getColeccion();
var_dump($Carreras);
