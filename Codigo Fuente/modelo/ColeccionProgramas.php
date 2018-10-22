<?php
include_once 'BDColeccionGenerica.Class.php';
include_once 'Programa.Class.php';

class ColeccionProgramas extends BDColeccionGenerica {
    
    /**
     *
     * @var Programa[]
     */
    private $programas;
   
    function __construct() {
        parent::__construct();
        $this->setColeccion("programa","Programa");
        $this->programas = $this->coleccion;
    }
    
    /**
     * 
     * @return array()
     */
    function getProgramas() {
        return $this->programas;
    }


}