<?php
include_once 'BDColeccionGenerica.Class.php';
include_once 'Departamento.Class.php';

class ColeccionDepartamentos extends BDColeccionGenerica {
    
    /**
     *
     * @var Departamento[]
     */
    private $departamentos;
   
    function __construct() {
        parent::__construct();
        $this->setColeccion("DEPARTAMENTO","Departamento");
        $this->permisos = $this->coleccion;
    }
    
    /**
     * 
     * @return array()
     */
    function getDepartamentos() {
        return $this->departamentos;
    }


}