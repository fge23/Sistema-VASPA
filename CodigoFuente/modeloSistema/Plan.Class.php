<?php

include_once 'BDConexionSistema.Class.php';
include_once 'Asignatura.Class.php';

/**
 * Description of Plan
 *
 * @author fabricio
 */
class Plan {

    protected $id;
    protected $anio_inicio;
    protected $idCarrera;
    protected $anio_fin;
    private $query;

    /**
     *
     * @var mysqli_result
     */
    private $datos;

    function __construct($id = null, $datos = null) {

        //Si vienen datos de formulario (Alta) setea valores de Objeto
        if (isset($datos)) {
            $this->setId($datos['id']);
            $this->setAnio_inicio($datos['anio_inicio']);
            $this->setIdCarrera($datos['idCarrera']);
            $this->setAnio_fin($datos['anio_fin']);
        } else {
            //Sino viene un nuevo Objeto, lo recupero (para Modificar)
            if (isset($id)) {
                $this->recuperaObjeto($id);
            } else {
                return false;
            }
        }
    }

    function recuperaObjeto($id) {
        $this->id = $id;

        $this->query = "SELECT * FROM PLAN WHERE id = '{$this->id}'";

        $this->datos = BDConexionSistema::getInstancia()->query($this->query);
        
        // comprobamos si luego de ejecutar la consulta a la BD esta devuelve un registro
        if ($this->datos->num_rows == 1){
            $this->datos = $this->datos->fetch_assoc();

            foreach ($this->datos as $atributo => $valor) {
                $this->{$atributo} = $valor;
            }
        // Sino devuelve un registro entonces seteamos el id del objeto en NULL, con esto se validara la existencia o no de dicho objeto    
        } else {
            $this->setId(NULL);
        }
        //var_dump($this->datos->num_rows);
        unset($this->query);
        unset($this->datos);
    }

    function getId() {
        return $this->id;
    }

    function getIdCarrera() {
        return $this->idCarrera;
    }

    function getAnio_fin() {
        return $this->anio_fin;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setIdCarrera($idCarrera) {
        $this->idCarrera = $idCarrera;
    }

    function setAnio_fin($anio_fin) {
        $this->anio_fin = $anio_fin;
    }
    function getAnio_inicio() {
        return $this->anio_inicio;
    }

    function setAnio_inicio($anio_inicio) {
        $this->anio_inicio = $anio_inicio;
    }
    
    /**
     * 
     * @return Asignatura[]
     */
    function getAsignaturas(){
        $asignaturas = NULL;
        
        $this->query = "SELECT B.* "
                . "FROM PLAN_ASIGNATURA A JOIN "
                . "ASIGNATURA B "
                . "ON idAsignatura = id "
                . "WHERE idPlan = '{$this->id}'";
        
        $this->datos = BDConexionSistema::getInstancia()->query($this->query);
       
        if ($this->datos->num_rows > 0){
            for ($x = 0; $x < $this->datos->num_rows; $x++) {
                $asignaturas[] = $this->datos->fetch_object("Asignatura");
            }
        }
        
        return $asignaturas;

    }
    
    /*
     * Funcion que retorna un array asociativo (clave(idAsignatura), valor(nombreAsignatura) de este plan)
    */
    function getAsignaturasArrayAsociativo(){
        $asignaturas = NULL;
        
        $this->query = "SELECT B.* FROM PLAN_ASIGNATURA A JOIN ASIGNATURA B ON idAsignatura = id WHERE idPlan = '{$this->id}'";
        
        $this->datos = BDConexionSistema::getInstancia()->query($this->query);
       
        if ($this->datos->num_rows > 0){
            while ($fila = $this->datos->fetch_assoc()) {
                $asignaturas[$fila['id']] = $fila['nombre'];
            }           
        }
        return $asignaturas;

    }
    
    /*
     * Devuelve un String con el periodo de año del programa
     * con el siguiente formato: (anio_inicio - anio_fin)
     * en caso de no tener anio_fin se pondra "Presente"
     */
    function getPeriodo() {
        $periodo = '';
        if (is_null($this->anio_fin)) {
            $periodo = '(' . $this->anio_inicio . ' - Presente)';
        } else {
            $periodo = '(' . $this->anio_inicio . ' - ' . $this->anio_fin . ')';
        }
        
        return $periodo;
    }

}
