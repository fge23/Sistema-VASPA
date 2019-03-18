<?php
include_once '../modeloSistema/BDConexionSistema.Class.php';
include_once '../modeloSistema/Departamento.Class.php';

/**
 * Description of ManejadorDepartamento
 *
 * @author francisco
 */
class ManejadorDepartamento {

    private $query;

    /**
     *
     * @var mysqli_result
     */
    private $datos;

    /**
     *
     * @var Departamento[] 
     */
    protected $coleccion;

    function __construct() {
        $this->setColeccion();
    }

    //Metodo que crea la coleccion Departamentos
    function setColeccion() {
        $this->query = "SELECT * FROM DEPARTAMENTO";
        $this->datos = BDConexionSistema::getInstancia()->query($this->query);

        for ($x = 0; $x < $this->datos->num_rows; $x++) {
            $this->addElemento($this->datos->fetch_object("Departamento"));
        }
    }

    function addElemento($elemento_) {
        $this->coleccion[] = $elemento_;
    }

    /**
     * 
     * @return Departamento[]
     */
    function getColeccion() {
        return $this->coleccion;
    }
    
}    