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

        $this->datos = $this->datos->fetch_assoc();

        foreach ($this->datos as $atributo => $valor) {
            $this->{$atributo} = $valor;
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

}
