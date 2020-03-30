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
        unset($this->query);
        unset($this->datos);
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
        $Plan = new Plan(null, $datos);
        //validamos existencia la existencia del plan
        if ($this->chequearExistencia($Plan->getId())){
            //Si el año fin no está definido, la query cambia
            if (!empty($Plan->getAnio_fin())) {
                $this->query = "INSERT INTO PLAN "
                        . "VALUES ('{$Plan->getId()}',{$Plan->getAnio_inicio()},'{$Plan->getIdCarrera()}',{$Plan->getAnio_fin()} )";
            } else {
                $this->query = "INSERT INTO PLAN "
                        . "VALUES ('{$Plan->getId()}',{$Plan->getAnio_inicio()},'{$Plan->getIdCarrera()}', null )";
            }
            $consulta = BDConexionSistema::getInstancia()->query($this->query);
            if ($consulta) {
                return true;
            } else {
                return false;
            }
        } else {
            throw new Exception("El c&oacute;digo  <b>" . $Plan->getId() . "</b> ya corresponde a un Plan de Estudio en la Base de Datos");
        }
        
    }

    function baja($id_) {
        // comprobamos que el Plan no tenga asociados asignaturas para recien poder borrarlo sino devolvemos un string (mensaje)
        $plan = new Plan($id_);
        if (!is_null($plan->getAsignaturas())){
            // tiene Asignaturas lanzamos un excepcion
            throw new Exception("No se pudo llevar a cabo la operaci&oacute;n dado que <b>el plan {$id_} tiene asociados asignaturas</b>.");
            //return "";
        }
        
        $this->query = "DELETE FROM PLAN WHERE id = '{$id_}'";
        $consulta = BDConexionSistema::getInstancia()->query($this->query);
        if ($consulta) {
            return true;
        } else {
            return false;
        }
    }

    //Funcion para Modificación de Planes
    function modificacion($datos, $id_) {

        $Plan = new Plan(null, $datos);
        if ($id_ == $Plan->getId()){
            if (!empty($Plan->getAnio_fin())) {
                $this->query = "UPDATE PLAN "
                        . "SET id = '{$Plan->getId()}' ,"
                        . " anio_inicio = {$Plan->getAnio_inicio()}, "
                        . "idCarrera = '{$Plan->getIdCarrera()}' ,"
                        . "anio_fin = {$Plan->getAnio_fin()} "
                        . "WHERE id = '{$id_}'";
            } else {
                $this->query = "UPDATE PLAN "
                        . "SET id = '{$Plan->getId()}' ,"
                        . " anio_inicio = {$Plan->getAnio_inicio()}, "
                        . " anio_fin = NULL, "
                        . "idCarrera = '{$Plan->getIdCarrera()}' "
                        . "WHERE id = '{$id_}'";
            }
        } else {
            if ($this->chequearExistencia($Plan->getId())) {
                if (!empty($Plan->getAnio_fin())) {
                    $this->query = "UPDATE PLAN "
                            . "SET id = '{$Plan->getId()}' ,"
                            . " anio_inicio = {$Plan->getAnio_inicio()}, "
                            . "idCarrera = '{$Plan->getIdCarrera()}' ,"
                            . "anio_fin = {$Plan->getAnio_fin()} "
                            . "WHERE id = '{$id_}'";
                } else {
                    $this->query = "UPDATE PLAN "
                            . "SET id = '{$Plan->getId()}' ,"
                            . " anio_inicio = {$Plan->getAnio_inicio()}, "
                            . " anio_fin = NULL, "
                            . "idCarrera = '{$Plan->getIdCarrera()}' "
                            . "WHERE id = '{$id_}'";
                }
            } else {
                throw new Exception("El c&oacute;digo  <b>" . $Plan->getId() . "</b> ya corresponde a un Plan de Estudio en la Base de Datos");
            }
        }
        
        $consulta = BDConexionSistema::getInstancia()->query($this->query);
        if ($consulta) {
            return true;
        } else {
            return false;
        }
        
        
    }

    /* Metodo innecesario ya que se puede recuperar directamente

      function buscarCarrera($idPlan) {
      $this->query = "SELECT plan.idCarrera as idCarrera "
      . "FROM CARRERA carrera "
      . "INNER JOIN PLAN plan "
      . "ON carrera.id = plan.idCarrera "
      . "WHERE plan.id = '{$idPlan}'";
      $this->datos = BDConexionSistema::getInstancia()->query($this->query);
      for ($x = 0; $x < $this->datos->num_rows; $x++) {
      $fila =  $this->datos->fetch_row();
      return $fila[0];
      }
      }
     */
    
    function chequearExistencia($idPlan_) {
        $this->query = "SELECT * FROM PLAN WHERE id = '{$idPlan_}'";
        $this->datos = BDConexionSistema::getInstancia()->query($this->query);
        if ($this->datos->num_rows == 1) {
            //El registro existe en la BD. No se puede insertar
            return false;
        } else {
            //El registro no existe en la BD. Se puede insertar
            return true;
        }
    }
    
    function getPlanesSegunCarrera($codCarrera) {
        $planes = NULL;
        if (!empty($this->coleccion)){
            foreach ($this->coleccion as $plan) {
                if ($plan->getIdCarrera() == $codCarrera){
                    $planes[] = $plan;
                }
            }
        }
        return $planes;
    }
    
}
