<?php
include_once 'BDConexionSistema.Class.php';

/**
 * Description of OtroMaterial
 *
 * @author Francisco
 */
class OtroMaterial {
    private $id;
    private $descripcion;
    private $idPrograma;
    
    private $query;

    /**
     *
     * @var mysqli_result
     */
    private $datos;
    
    function __construct($id_ = null) {

        if (isset($id_)) {
            $this->id = $id_;
            
            $this->query = "SELECT * FROM OTRO_MATERIAL WHERE id = {$this->id}";
           
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

    function getDescripcion() {
        return $this->descripcion;
    }

    function getIdPrograma() {
        return $this->idPrograma;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setIdPrograma($idPrograma) {
        $this->idPrograma = $idPrograma;
    }

  
}
