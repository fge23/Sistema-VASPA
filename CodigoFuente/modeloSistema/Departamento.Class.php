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
    
     function __construct($id = null) {

        if (isset($id)) {
            $this->id = $id;
            
            $this->query = "SELECT * FROM DEPARTAMENTO WHERE id = {$this->id}";
           
            $this->datos = BDConexionSistema::getInstancia()->query($this->query);
           
            $this->datos = $this->datos->fetch_assoc();

            foreach ($this->datos as $atributo => $valor) {
                $this->{$atributo} = $valor;
            }
            unset($this->query);
            unset($this->datos);
        } else {
            return false;
        }
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
