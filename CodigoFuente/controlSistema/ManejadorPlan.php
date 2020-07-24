<?php

include_once '../modeloSistema/BDConexionSistema.Class.php';
include_once '../modeloSistema/Plan.Class.php';
include_once '../modeloSistema/Carrera.Class.php';

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
        $carrera = new Carrera($Plan->getIdCarrera());
        //validamos si ya existe un plan con el mismo ID
        if ($this->chequearExistencia($Plan->getId())){
            //Si el año fin no está definido, la query cambia
            if (!empty($Plan->getAnio_fin())) {
                // validamos los anios del programa a agregar
                if ($carrera->esValidoAniodelPlan($Plan->getAnio_inicio(), $Plan->getAnio_fin())){
                    // es valido podemos insertar el plan 
                    $this->query = "INSERT INTO PLAN "
                        . "VALUES ('{$Plan->getId()}',{$Plan->getAnio_inicio()},'{$Plan->getIdCarrera()}',{$Plan->getAnio_fin()} )";
                } else {
                    throw new Exception("Ya hay un Plan de Estudio que contiene los años <b>['{$Plan->getAnio_inicio()}' - '{$Plan->getAnio_fin()}']</b>."
                    . " Por favor revise los a&ntilde;os.");
                }
                
            } else {
                // se esta por insertar un plan vigente, por lo tanto verificamos
                // que no haya otra revision del plan que este vigente
                
                if ($this->tienePlanVigenteCarrera($Plan->getIdCarrera())){
                    // tiene plan vigente, lanzamos excepcion informando al usuario
                    //$carrera = new Carrera($Plan->getIdCarrera());
                    $nombreCarrera = $carrera->getId().' - '.$carrera->getNombre();
                    $planVigente = $carrera->getPlanVigente();
                    throw new Exception("Ya hay un Plan de Estudio vigente <b>(".$planVigente->getId().")</b> "
                            . "para la carrera: <b>" .$nombreCarrera. "</b>.");
                } else {
                    // no tiene plan vigente, se puede insertar
                    // validamos que los anios del plan sean validos
                    
                    if ($carrera->esValidoAniodelPlan($Plan->getAnio_inicio(), NULL)){
                        // es valido podemos insertar el plan 
                        $this->query = "INSERT INTO PLAN "
                        . "VALUES ('{$Plan->getId()}',{$Plan->getAnio_inicio()},'{$Plan->getIdCarrera()}', null )";
                    } else {
                        $anioActual = date("Y");
                        throw new Exception("Ya hay un Plan de Estudio que contiene los años <b>['{$Plan->getAnio_inicio()}' - '{$anioActual}']</b>. "
                        . "Por favor revise los a&ntilde;os.");
                    }
                    
                }
                
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
            throw new Exception("No se pudo llevar a cabo la operaci&oacute;n dado que <b>el plan {$id_} se encuentra vinculado con asignaturas</b>.");
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

    function modificacion($datos, $id_) {
        
        $Plan = new Plan(null, $datos);
        $carrera = new Carrera($Plan->getIdCarrera());
        $planVigente = $carrera->getPlanVigente();
        $planModificar = new Plan($id_); // es el plan que se esta por modificar
                
        //validamos si el programa a modificar tiene el mismo id 
        if ($id_ != $Plan->getId() && !$this->chequearExistencia($Plan->getId())){
            throw new Exception("El c&oacute;digo  <b>" . $Plan->getId() . "</b> ya corresponde a un Plan de Estudio en la Base de Datos");
//            if ($this->chequearExistencia($Plan->getId())) {
//                
//            }
        }
        
        //verificamos si el anio fin esta vacio
        
        if (!empty($Plan->getAnio_fin())) {
            // validamos los anios del programa a agregar
            if ($carrera->esValidoAniodelPlan($Plan->getAnio_inicio(), $Plan->getAnio_fin(), $planModificar->getAnio_inicio(), $planModificar->getAnio_fin())) {
                // es valido podemos modificar el plan 
                $this->query = "UPDATE PLAN "
                    . "SET id = '{$Plan->getId()}' ,"
                    . " anio_inicio = {$Plan->getAnio_inicio()}, "
                    . "idCarrera = '{$Plan->getIdCarrera()}' ,"
                    . "anio_fin = {$Plan->getAnio_fin()} "
                    . "WHERE id = '{$id_}'";
            } else {
                throw new Exception("Ya hay un Plan de Estudio que contiene los años <b>['{$Plan->getAnio_inicio()}' - '{$Plan->getAnio_fin()}']</b>."
                . " Por favor revise los a&ntilde;os.");
            }
            
        } else {
            // se esta poniendo como vigente el plan, por lo tanto verificamos
                // que no haya otra revision del plan que este vigente
                
                if ($this->tienePlanVigenteCarrera($Plan->getIdCarrera())){
                    // tiene plan vigente, lanzamos excepcion informando al usuario pero primero verificamos que no se este modificando un plan vigente
                    //$carrera = new Carrera($Plan->getIdCarrera());
                    if ($planVigente->getId() != $id_){
                        $nombreCarrera = $carrera->getId().' - '.$carrera->getNombre();
                        $planVigente = $carrera->getPlanVigente();
                        throw new Exception("Ya hay un Plan de Estudio vigente <b>(".$planVigente->getId().")</b> "
                                . "para la carrera: <b>" .$nombreCarrera. "</b>.");
                    } else {
                        // validamos que los anios del plan sean validos
                    
                        if ($carrera->esValidoAniodelPlan($Plan->getAnio_inicio(), NULL, $planModificar->getAnio_inicio(), $planModificar->getAnio_fin())){
                            // es valido podemos modificar el plan 
                            $this->query = "UPDATE PLAN "
                            . "SET id = '{$Plan->getId()}' ,"
                            . " anio_inicio = {$Plan->getAnio_inicio()}, "
                            . " anio_fin = NULL, "
                            . "idCarrera = '{$Plan->getIdCarrera()}' "
                            . "WHERE id = '{$id_}'";
                        } else {
                            $anioActual = date("Y");
                            throw new Exception("Ya hay un Plan de Estudio que contiene los años <b>['{$Plan->getAnio_inicio()}' - '{$anioActual}']</b>. "
                            . "Por favor revise los a&ntilde;os.");
                        }
                        
                    }
                    
                } else {
                    
                    // validamos que los anios del plan sean validos
                    
                    if ($carrera->esValidoAniodelPlan($Plan->getAnio_inicio(), NULL, $planModificar->getAnio_inicio(), $planModificar->getAnio_fin())){
                        // es valido podemos insertar el plan 
                        // no tiene plan vigente, se puede puede poner el anio_fin como null
                        $this->query = "UPDATE PLAN "
                        . "SET id = '{$Plan->getId()}' ,"
                        . " anio_inicio = {$Plan->getAnio_inicio()}, "
                        . " anio_fin = NULL, "
                        . "idCarrera = '{$Plan->getIdCarrera()}' "
                        . "WHERE id = '{$id_}'";
                    } else {
                        $anioActual = date("Y");
                        throw new Exception("Ya hay un Plan de Estudio que contiene los años <b>['{$Plan->getAnio_inicio()}' - '{$anioActual}']</b>. "
                        . "Por favor revise los a&ntilde;os.");
                    }
                    
                    
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
    
    // La siguiente funcion verifica si una determinada carrera
    // tiene un plan vigente
    // retorna un boolean
    function tienePlanVigenteCarrera($codCarrera){
        // obtenemos los planes de la carrera mandada por parametro cuyo anio de
        // de fin no esta seteado, --> esto nos inidica que el plan esta vigente
        // si esta seteado es porque el plan ya no se encuentra vigente
        $this->query = "SELECT * FROM PLAN WHERE idCarrera = '{$codCarrera}' AND "
        . "anio_fin IS NULL";
        $this->datos = BDConexionSistema::getInstancia()->query($this->query);
        // verificamos la cantidad de registros devueltos
        if ($this->datos->num_rows >= 1) {
            //hay plan/es vigentes de la carrera
            return true;
        } else {
            //no hay plan vigente de la carrera
            return false;
        }
    }
    
    function esValidoAnioInicioFinPlan($codCarrera, $anio_inicio, $anio_fin){
        // obtenemos planes de la carrera
        $planes = $this->getPlanesSegunCarrera($codCarrera);
        $incluyeAnioInicio = FALSE;
        $incluyeAnioFin = FALSE;
        
        foreach ($planes as $plan) {
            if ($plan->getAnio_inicio() <= $anio_inicio && $anio_fin <= $plan->getAnio_fin()){
                return FALSE;
            }
            if ($plan->getAnio_inicio() <= $anio_fin && $anio_fin <= $plan->getAnio_fin()){
                return FALSE;
            }
        }
        
    }
    
    function esValidoAnioInicioFinDePlan($codCarrera, $anio_inicio, $anio_fin){
        // obtenemos planes de la carrera
        $planes = $this->getPlanesSegunCarrera($codCarrera);
        $esValido = TRUE;
        $anioMinimoPosible = 1995; // anio minimo que puede tener un plan de estudio
        $anioMenorPlan;
        
        
        //verificamos si es valido el plan
        $incluyeAnioInicio = FALSE;
        $incluyeAnioFin = FALSE;
        
        foreach ($planes as $plan) {
            if ($plan->getAnio_inicio() <= $anio_inicio && $anio_fin <= $plan->getAnio_fin()){
                return FALSE;
            }
            if ($plan->getAnio_inicio() <= $anio_fin && $anio_fin <= $plan->getAnio_fin()){
                return FALSE;
            }
        }
        
    }
    
}
