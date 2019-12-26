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
                
        $Asignatura->setId($this->completaConCeros($Asignatura->getId()));
        if ($this->validaEspaciosEnBlanco($Asignatura->getNombre())) {
            if ($this->chequearInexistencia($Asignatura->getId())) {
                $this->query = "INSERT INTO ASIGNATURA "
                        . "VALUES ('{$Asignatura->getId()}', '{$Asignatura->getNombre()}', '{$Asignatura->getIdDepartamento()}' , "
                        . "'{$Asignatura->getContenidosMinimos()}', '{$Asignatura->getIdProfesor()}', '{$Asignatura->getHorasSemanales()}' )";
                $consulta = BDConexionSistema::getInstancia()->query($this->query);
                if ($consulta) {
                    return true;
                } else {
                    return false;
                }
            } else {
                throw new Exception("El c&oacute;digo  " . $Asignatura->getId() . " ya corresponde a una Asignatura en la Base de Datos");
            }
        } else {
            throw new Exception("El nombre de la carrera no puede estar en blanco");
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
        $Asignatura->setId($this->completaConCeros($Asignatura->getId()));
        if ($this->validaEspaciosEnBlanco($Asignatura->getNombre())) {
            if ($Asignatura->getId() == $id_) {
                $this->query = "UPDATE ASIGNATURA "
                        . "SET nombre = '{$Asignatura->getNombre()}', "
                        . "idDepartamento = '{$Asignatura->getIdDepartamento()}' , "
                        . "contenidosMinimos = '{$Asignatura->getContenidosMinimos()}' , "
                        . "idProfesor = '{$Asignatura->getIdProfesor()}', "
                        . "horasSemanales = '{$Asignatura->getHorasSemanales()}'"
                        . "WHERE id = '{$id_}'";
            } else {
                if ($this->chequearInexistencia($Asignatura->getId())) {
                    $this->query = "UPDATE ASIGNATURA "
                            . "SET id = '{$Asignatura->getId()}', "
                            . "nombre = '{$Asignatura->getNombre()}', "
                            . "idDepartamento = '{$Asignatura->getIdDepartamento()}' , "
                            . "contenidosMinimos = '{$Asignatura->getContenidosMinimos()}' , "
                            . "idProfesor = '{$Asignatura->getIdProfesor()}', "
                            . "horasSemanales = '{$Asignatura->getHorasSemanales()}'"
                            . "WHERE id = '{$id_}'";
                } else {
                    throw new Exception("El c&oacute;digo  " . $Asignatura->getId() . " ya corresponde a una Asignatura en la Base de Datos");
                }
            }
            $consulta = BDConexionSistema::getInstancia()->query($this->query);
            if ($consulta) {
                return true;
            } else {
                return false;
            }
        } else {
            throw new Exception("El nombre de la Asignatura no puede estar en blanco");
        }
    }

    /* La siguiente funcion lo que hace es devolver una coleccion de asignaturas, con las asignaturas que
     * pertenecen a una determinada Carrera (codCarrera), y para un determinado Plan, de acuerdo al año.
     * Nota: podria haberlo hecho en el contructor (PHP no admite la sobrecarga de metodos), y no
     * queria modificar el constructor, ya que se verian afectados aquellas parte del codigo que utilicen
     * esta clase. Lo ideal (para mi) seria modifcar el contructor, ya que seria mas eficiente el codigo.
     */

    /**
     * 
     * @return Asignatura[]
     */
    function getAsignaturasDeCarrera($codCarrera, $anio) {
        // La siguiente consulta devuelve el codigo de todas las asignaturas que pertenecen a un plan de una carrera
        // Para saber cual es el plan correcto de la carrera se utiliza el anio
        $this->query = "SELECT asignatura.nombre, asignatura.id FROM carrera JOIN plan JOIN plan_asignatura JOIN asignatura" .
                " WHERE carrera.id = idCarrera AND plan.id = plan_asignatura.idPlan "
                . "AND asignatura.id = idAsignatura AND carrera.id LIKE '$codCarrera' AND anio_inicio <= $anio"
                . " AND (anio_fin >= $anio OR anio_fin is NULL)";
        $this->datos = BDConexionSistema::getInstancia()->query($this->query);
        $Asignaturas = NULL;
        if ($this->datos->num_rows > 0) {
            for ($x = 0; $x < $this->datos->num_rows; $x++) {
                $resultado = $this->datos->fetch_assoc();
                $Asignaturas[] = new Asignatura($resultado['id'], null);
            }
        }

        unset($this->query);
        unset($this->datos);

        return $Asignaturas;
    }

    function chequearInexistencia($idAsignatura_) {
        $this->resultado = BDConexionSistema::getInstancia()->query("SELECT 1 FROM ASIGNATURA WHERE id = {$idAsignatura_} LIMIT 1");
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

    function completaConCeros($id_) {
        //Se convierte a String
        $idAsignatura = (String) $id_;

        //Se quitan los 0 a la 
        $idAsignatura = ltrim($idAsignatura, '0');

        if (strlen($idAsignatura) == 3) {
            $idAsignatura = "0" . $idAsignatura;
        } else {
            if (strlen($idAsignatura) == 2) {
                $idAsignatura = "00" . $idAsignatura;
            } else {
                if (strlen($idAsignatura) == 1) {
                    $idAsignatura = "000" . $idAsignatura;
                }
            }
        }
        return $idAsignatura;
    }

}
