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
    private $datos, $resultado;

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
        $Carrera = new Carrera(null, $datos);
        if ($this->validaEspaciosEnBlanco($Carrera->getNombre())) {
            if ($this->chequearExistencia($Carrera->getId())) {
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
            } else {
                throw new Exception("El c&oacute;digo  " . $Carrera->getId() . " ya corresponde a una carrera en la Base de Datos");
            }
        } else {
            throw new Exception("El nombre de la carrera no puede estar en blanco");
        }
    }

    function baja($id_) {
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
        
        $Carrera->setId($this->completaConCeros($Carrera->getId()));

        if ($this->validaEspaciosEnBlanco($Carrera->getNombre())) {
            if ($Carrera->getId() == $id_) {
                $this->query = "UPDATE CARRERA "
                        . "SET nombre = '{$Carrera->getNombre()}' "
                        . "WHERE id = '{$id_}'";
            } else {
                if ($this->chequearExistencia($Carrera->getId())) {
                    $this->query = "UPDATE CARRERA "
                            . "SET id = '{$Carrera->getId()}' , nombre = '{$Carrera->getNombre()}' "
                            . "WHERE id = '{$id_}'";
                } else {
                    throw new Exception("El c&oacute;digo  " . $Carrera->getId() . " ya corresponde a una carrera en la Base de Datos");
                }
            }
        } else {
            throw new Exception("El nombre de la carrera no puede estar en blanco");
        }

        $consulta = BDConexionSistema::getInstancia()->query($this->query);
        if ($consulta) {
            return true;
        } else {
            return false;
        }
    }

    function completaConCeros($id_) {
        //Se convierte a String
        $idCarrera = (String) $id_;

        //Se quitan los 0 a la 
        $idCarrera = ltrim($idCarrera, '0');

        if (strlen($idCarrera) == 2) {
            $idCarrera = "0" . $idCarrera;
        } else {
            if (strlen($idCarrera) == 1) {
                $idCarrera = "00" . $idCarrera;
            }
        }
        return $idCarrera;
    }

    function chequearExistencia($idCarrera_) {
        $this->resultado = BDConexionSistema::getInstancia()->query("SELECT 1 FROM CARRERA WHERE id = {$idCarrera_} LIMIT 1");
        if ($this->resultado->num_rows == 1) {
            //El registro existe en la BD. No se puede insertar
            return false;
        } else {
            //El registro no existe en la BD. Se puede insertar
            return true;
        }
    }

    function validaEspaciosEnBlanco($nombre_) {
        $nombre = trim($nombre_);
        if ($nombre == "") {
            return false;
        } else {
            return true;
        }
    }

}
