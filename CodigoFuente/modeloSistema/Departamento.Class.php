<?php
include_once 'BDConexionSistema.Class.php';

/**
 * Description of Departamento
 *
 * @author Francisco
 */
class Departamento {
   private $id;
   private $nombre;
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

        $this->query = "SELECT * FROM DEPARTAMENTO WHERE id = '{$this->id}'";

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
   
}
