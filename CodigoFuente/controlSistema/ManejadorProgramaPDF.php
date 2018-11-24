<?php

include_once '../modeloSistema/ProgramaPDF.Class.php';

/**
 * Description of ManejadorProgramaPDF
 *
 * @author Francisco
 */
class ManejadorProgramaPDF {
    private $query;

    /**
     *
     * @var mysqli_result
     */
    private $datos;

    /**
     *
     * @var ProgramaPDF[] 
     */
    protected $coleccion;

    function __construct() {
        $this->setColeccion();
    }

    function setColeccion() {
        $this->query = "SELECT * FROM PROGRAMA_PDF";
        $this->datos = BDConexionSistema::getInstancia()->query($this->query);

        for ($x = 0; $x < $this->datos->num_rows; $x++) {
            $this->addElemento($this->datos->fetch_object("ProgramaPDF"));
        }
    }

    function addElemento($elemento_) {
        $this->coleccion[] = $elemento_;
    }

    /**
     * 
     * @return ProgramaPDF[]
     */
    function getColeccion() {
        return $this->coleccion;
    }
}
