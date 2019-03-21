<?php
include_once '../modeloSistema/BDConexionSistema.Class.php';
include_once '../modeloSistema/Asignatura.Class.php';


/**
 * Description of ManejadorAsignatura
 *
 * @author fabricio
 */
class ManejadorAsignatura {

    private $query;

    /**
     *
     * @var mysqli_result
     */
    private $datos;

    /**
     *
     * @var Asignatura[] 
     */
    protected $coleccion;

    function __construct() {
        $this->setColeccion();
    }

    function setColeccion() {
        $this->query = "SELECT * FROM ASIGNATURA";
        $this->datos = BDConexionSistema::getInstancia()->query($this->query);

         for ($x = 0; $x < $this->datos->num_rows; $x++) {
            $this->addElemento($this->datos->fetch_object("Asignatura"));
        }
    }

    function addElemento($elemento_) {
        $this->coleccion[] = $elemento_;
    }

    /**
     * 
     * @return Asignatura[]
     */
    function getColeccion() {
        return $this->coleccion;
    }

     //Funcion para Alta de Asignaturas
    function alta($datos) {

        //Creo objeto sin enviar ID y enviando todos los datos del formulario
        $Asignatura = new Asignatura(null, $datos);
        
        $this->query = "INSERT INTO ASIGNATURA "
                . "VALUES ('{$Asignatura->getId()}', '{$Asignatura->getNombre()}', {$Asignatura->getIdDepartamento()} , "
                . "'{$Asignatura->getContenidosMinimos()}', {$Asignatura->getIdProfesor()} )";
                     
        $consulta = BDConexionSistema::getInstancia()->query($this->query);
        
        if ($consulta) {
            return true;
        } else {
            return false;
        }
    }
    
       function baja($id_) {
        $this->query = "DELETE FROM ASIGNATURA WHERE id = '{$id_}'";
        $consulta = BDConexionSistema::getInstancia()->query($this->query);
        if ($consulta) {
            return true;
        } else {
            return false;
        }
    }
    
     //Funcion para Modificación de Asignaturas
    function modificacion($datos, $id_) {
     
        $Asignatura = new Asignatura(null, $datos);
        $this->query = "UPDATE ASIGNATURA "
                . "SET id = '{$Asignatura->getId()}', "
                        . "nombre = '{$Asignatura->getNombre()}', "
                        . "idDepartamento = {$Asignatura->getIdDepartamento()} , "
                        . "contenidosMinimos = '{$Asignatura->getContenidosMinimos()}' , "
                        . "idProfesor = {$Asignatura->getIdProfesor()} "
                        . "WHERE id = '{$id_}'";
        $consulta = BDConexionSistema::getInstancia()->query($this->query);
        if ($consulta) {
            return true;
        } else {
            return false;
        }
    }

}
