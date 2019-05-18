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

//    function __construct() {
//        $this->setColeccion();
//    }
    
    function __construct($codCarrera, $anio) {
        $this->setColeccion($codCarrera, $anio);
    }
    
    function setColeccion($codCarrera, $anio) {
        $this->query = "SELECT * FROM PROGRAMA_PDF WHERE anio = '{$anio}' AND nombre LIKE '%".$codCarrera."%'";
        $this->datos = BDConexionSistema::getInstancia()->query($this->query);

        for ($x = 0; $x < $this->datos->num_rows; $x++) {
            $this->addElemento($this->datos->fetch_object("ProgramaPDF"));
        }
    }

//    function setColeccion() {
//        $this->query = "SELECT * FROM PROGRAMA_PDF";
//        $this->datos = BDConexionSistema::getInstancia()->query($this->query);
//
//        for ($x = 0; $x < $this->datos->num_rows; $x++) {
//            $this->addElemento($this->datos->fetch_object("ProgramaPDF"));
//        }
//    }

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
    
    /**
     * 
     * @return ProgramaPDF[]
     */
    function filtrarPrograma($subcadena, $anio){
        $this->query = "SELECT * FROM PROGRAMA_PDF WHERE nombre LIKE '%".$subcadena."%' AND anio LIKE ".$anio;
        $this->datos = BDConexionSistema::getInstancia()->query($this->query);
        
        $coleccion[] = NULL;
        for ($x = 0; $x < $this->datos->num_rows; $x++) {
            $coleccion = $this->datos->fetch_object("ProgramaPDF");
        }
        return $coleccion;
    }
    
    /**
     * 
     * @return string
     */
    function tieneProgramaPDF($codAsignatura){
        //$tiene = false;
        //En caso de que tenga programa la materia vamos a devolver la ruta al programa, caso contrario
        //damos la ruta a un pdf el cual indica que el programa no se encuentra disponible
        $ruta = "../programas/programa_no_disponible.pdf";
        
        if (!is_null($this->coleccion)){
            foreach ($this->coleccion as $programaPDF){
            //extraemos del nombre del archivo del programa pdf, el codigo de asignatura y se compara con el del argumento
                if ((substr($programaPDF->getNombre(), 4, 4)) == $codAsignatura){
                    //$tiene = true;
                    $ruta = "../".$programaPDF->getRuta();
                    break;
                }
            }
        }    
        //return $tiene;
        return $ruta;
    }
    
    
    
}
