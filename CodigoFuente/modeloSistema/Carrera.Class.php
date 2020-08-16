<?php

include_once 'BDConexionSistema.Class.php';

/**
 * Description of Carrera
 *
 * @author fabricio
 */
class Carrera {

    protected $id;
    protected $nombre;
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
            $this->setNombre($datos['nombre']);
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

        $this->query = "SELECT * FROM CARRERA WHERE id = '{$this->id}'";

        $this->datos = BDConexionSistema::getInstancia()->query($this->query);
        
        // comprobamos si luego de ejecutar la consulta a la BD esta devuelve un registro
        // si devuelve seteamos los valores devuelto de la BD, caso contrario seteamos a NULL el id del objeto
        if ($this->datos->num_rows == 1){
            $this->datos = $this->datos->fetch_assoc();

            foreach ($this->datos as $atributo => $valor) {
                $this->{$atributo} = $valor;
            }
        } else {
            // no exite una carrera con el id enviado, seteamos a NULL el atributo ID de la clase
            $this->setId(NULL);
        }    
        unset($this->query);
        unset($this->datos);
    }

    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }
    
    // Funcion que retorna en un array los planes de estudio de la carrera
    // Si no tiene planes devuelve NULL
    /**
     * 
     * @return Plan[]
     */
    function getPlanesDeEstudio(){
        // importamos la clase Plan
        include_once __DIR__.'/Plan.Class.php';
        //La constante __DIR__ retorna la ruta absoluta del directorio donde se encuentra el fichero que la está utilizando. Y dirname() retorna el directorio padre, en combinación dirname(__DIR__) nos retornaría la ruta absoluta del directorio padre donde se encuentra el fichero que la está usando.
        
        // obtenemos los planes de la Carrera segun su id
        $this->query = "SELECT id, anio_inicio, idCarrera, anio_fin "
                . "FROM plan "
                . "WHERE idCarrera = '{$this->id}'";
                
        $this->datos = BDConexionSistema::getInstancia()->query($this->query);
        
        // validamos el resultado de la query (si retorna false -> Ocurrio un error en la BD) Lanzamos una Excepcion informando el Error
        if (!$this->datos) {
            throw new Exception("Ocurrio un Error al obtener los Planes de Estudio de la Carrera: '{$this->id}' - '{$this->nombre}'.");
        }
        
        $planes = NULL;
        
        if ($this->datos->num_rows > 0) {
            for ($x = 0; $x < $this->datos->num_rows; $x++) {
                //$resultado = $this->datos->fetch_assoc();
                $planes[] = $this->datos->fetch_object("Plan"); // creamos objeto
                
            }
        }

        unset($this->query);
        unset($this->datos);

        return $planes;
    }
    
    /*
     * Funcion que retorna el plan vigente (revision del plan) de la carrera
     * @return Plan
     */
    function getPlanVigente(){
        // importamos la clase Plan
        include_once __DIR__.'/Plan.Class.php';
        //La constante __DIR__ retorna la ruta absoluta del directorio donde se encuentra el fichero que la está utilizando. Y dirname() retorna el directorio padre, en combinación dirname(__DIR__) nos retornaría la ruta absoluta del directorio padre donde se encuentra el fichero que la está usando.
        
        // obtenemos el plan vigente de la carrera
        // un plan vigente es aquel que no tiene seteado el campo anio_fin
        $this->query = "SELECT id, anio_inicio, idCarrera, anio_fin "
                . "FROM plan "
                . "WHERE idCarrera = '{$this->id}' AND anio_fin IS NULL";
                
        $this->datos = BDConexionSistema::getInstancia()->query($this->query);
        
        // validamos el resultado de la query (si retorna false -> Ocurrio un error en la BD) Lanzamos una Excepcion informando el Error
        if (!$this->datos) {
            throw new Exception("Ocurrio un Error al obtener el Plan de Estudio de la Carrera: '{$this->id}' - '{$this->nombre}'.");
        }
        
        $plan = NULL;
        
        if ($this->datos->num_rows > 0) {
            $plan = $this->datos->fetch_object("Plan"); // creamos objeto
        }

        unset($this->query);
        unset($this->datos);

        return $plan;
    }
    
    
    /* funcion que devuelve un boolean indicando si el anio del Plan es valido 
     * se utiliza para las operaciones de crear y modificar
     * Tiene 4 parametros, dos obligatorios, dos opcionales
     * los obligatorios son los anios que se quieren validar
     * los anios opcionales se utilizan para la operacion de modificar
     */
    function esValidoAniodelPlan($anioInicio, $anioFin, $anioI = NULL , $anioF = NULL) {       
        // obtenemos planes de la carrera
        //$planes = $this->getPlanesSegunCarrera($codCarrera);
        $planes = $this->getPlanesDeEstudio();
        
        if (is_null($planes)){
            return TRUE; // no hay planes de estudio de la carrera por lo que el plan es valido
        } else {
            
            $anioActual = date("Y");
            $anios = array();
            for ($i = 1995; $i <= ($anioActual+1); $i++) {
                $anios[$i] = "Disponible";
            }
            
            foreach ($planes as $plan) {
                
//                if (is_null($plan->getAnio_fin())){
//                    $anios[$anioActual] = "No disponible"; // seteamos como no disponible el anio siguiente al anio actual
//                } else {
                    
                    if (is_null($plan->getAnio_fin())){
                        for ($index = $plan->getAnio_inicio(); $index <= ($anioActual+1); $index++) {
                            $anios[$index] = "No Disponible";
                        }
                    } else {
                        for ($index = $plan->getAnio_inicio(); $index <= $plan->getAnio_fin(); $index++) {
                            $anios[$index] = "No Disponible";
                        }
                    }
                    
                    
                    
                //}
                
            }
            
            
        }
        
        // validamos si no es NULL las variables anioI y anioF --> se utiliza para la modificacion de un plan
        if (!is_null($anioI)) {
            if (is_null($anioF)) {
                for ($index = $anioI; $index <= ($anioActual + 1); $index++) {
                    $anios[$index] = "Disponible";
                }
            } else {
                for ($index = $anioI; $index <= $anioF; $index++) {
                    $anios[$index] = "Disponible";
                }
            }
        }


        //procedemos a validar los anios enviados por parametros
        
        if (is_null($anioFin)){
            for ($index1 = $anioInicio; $index1 <= ($anioActual+1); $index1++) {
                if ($anios[$index1] == "No Disponible"){
                    return FALSE;
                }
            }
        }else {
            for ($index1 = $anioInicio; $index1 <= $anioFin; $index1++) {
                if ($anios[$index1] == "No Disponible"){
                    return FALSE;
                }
            }
        }
        
        return TRUE;

    }
    
    /*
     * Funcion que retorna un array con todos los anios de todos los planes de la carrera
     */
    function obtenerAniosPlanes(){
        $planes = $this->getPlanesDeEstudio();
        $anios = NULL;
        
        if (!is_null($planes)){
            foreach ($planes as $plan) {
                // verificamos si el anio de fin es nulo para agregar 
                if (is_null($plan->getAnio_fin())){
                    $anioActual = date("Y"); // obtenemos anio actual del server
                    for ($index = $plan->getAnio_inicio(); $index <= $anioActual; $index++) {
                        $anios[] = $index;
                    }
                } else {
                    for ($index = $plan->getAnio_inicio(); $index <= $plan->getAnio_fin(); $index++) {
                        $anios[] = $index;
                    }
                }
                
            }
            
            // odenamos el array con los anios
            arsort($anios);
        }
        
        return $anios;
    }
    
    /*
     * Funcion que nos devuelve el plan de la carrera a partir del anio indicado por parametro
     * si no encuentra plan devuelve NULL
     */
    function getPlan($anio){
        $planes = $this->getPlanesDeEstudio();
        
        foreach ($planes as $plan) {
            if (is_null($plan->getAnio_fin())){
                $anioFin = date("Y"); // obtenemos anio actual del server
                
            } else {
                $anioFin = $plan->getAnio_fin();
            }
            
            if ($anio >= $plan->getAnio_inicio() && $anio <= $anioFin){
                return $plan;
            }
            
        }
        return NULL;
    }

}
