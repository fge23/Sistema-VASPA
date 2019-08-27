<?php
include_once '../modeloSistema/BDConexionSistema.Class.php';
include_once '../modeloSistema/Profesor.Class.php';

/**
 * Description of ManejadorProfesor
 *
 * @author francisco
 */
class ManejadorProfesor {

    private $query;

    /**
     *
     * @var mysqli_result
     */
    private $datos;

    /**
     *
     * @var Profesor[] 
     */
    protected $coleccion;

    function __construct() {
        $this->setColeccion();
    }

    //Metodo que crea la coleccion Profesores
    function setColeccion() {
        $this->query = "SELECT * FROM PROFESOR";
        $this->datos = BDConexionSistema::getInstancia()->query($this->query);

        for ($x = 0; $x < $this->datos->num_rows; $x++) {
            $this->addElemento($this->datos->fetch_object("Profesor"));
        }
    }

    function addElemento($elemento_) {
        $this->coleccion[] = $elemento_;
    }

    /**
     * 
     * @return Profesor[]
     */
    function getColeccion() {
        return $this->coleccion;
    }

    //Funcion para Alta de Profesores
    function alta($datos) {

        //Creo objeto sin enviar ID y enviando todos los datos del formulario
        $Profesor = new Profesor(null, $datos);
        $apellido = mysqli_real_escape_string(BDConexionSistema::getInstancia(), $Profesor->getApellido());
        
        if ($this->chequearDNI($Profesor->getDni())) {
            if ($this->chequearEmail($Profesor->getEmail())) {
                $this->query = "INSERT INTO PROFESOR "
                        . "VALUES ('{$Profesor->getId()}', '{$Profesor->getDni()}', '{$Profesor->getNombre()}', '{$apellido}',"
                        . "'{$Profesor->getEmail()}', '{$Profesor->getCategoria()}', '{$Profesor->getPreferencias()}', '{$Profesor->getIdDepartamento()}')";

                $consulta = BDConexionSistema::getInstancia()->query($this->query);
                if ($consulta) {
                    return true;
                } else {
                    return false;
                }
            }
            else {
                throw new Exception("El email:  <b>" . $Profesor->getEmail() . "</b> ya corresponde a un profesor en la Base de Datos");
            }
        } else {
            throw new Exception("El DNI:  <b>" . $Profesor->getDni() . "</b> ya corresponde a un profesor en la Base de Datos");
        }
        
    }

    function baja($id_) {
        $this->query = "DELETE FROM PROFESOR WHERE id = '{$id_}'";
        $consulta = BDConexionSistema::getInstancia()->query($this->query);
        if ($consulta) {
            return true;
        } else {
            return false;
        }
    }

    //Funcion para Modificación de Profesores
    function modificacion($datos, $id_) {
        $Profesor = new Profesor(null, $datos);
        $profesorAntes = new Profesor ($id_, NULL);
        $apellido = mysqli_real_escape_string(BDConexionSistema::getInstancia(), $Profesor->getApellido());
        
        //Chequeamos el dni y el email ingresado en el formulario comparandolo con el almacenado en la BD
        if ($profesorAntes->getDni() != $Profesor->getDni() && $profesorAntes->getEmail() != $Profesor->getEmail()) {
            if ($this->chequearDNI($Profesor->getDni())) {
                if ($this->chequearEmail($Profesor->getEmail())) {
                    $this->query = "UPDATE PROFESOR "
                            . "SET dni = '{$Profesor->getDni()}', "
                            . "nombre = '{$Profesor->getNombre()}', "
                            . "apellido = '{$apellido}' ,"
                            . "email = '{$Profesor->getEmail()}' ,"
                            . "idDepartamento = '{$Profesor->getIdDepartamento()}'"
                            . "WHERE id = '{$id_}'";
                } else {
                    throw new Exception("El email:  <b>" . $Profesor->getEmail() . "</b> ya corresponde a un profesor en la Base de Datos");
                }
            } else {
                throw new Exception("El DNI:  <b>" . $Profesor->getDni() . "</b> ya corresponde a un profesor en la Base de Datos");
            }
        } elseif ($profesorAntes->getDni() == $Profesor->getDni() && $profesorAntes->getEmail() == $Profesor->getEmail()) {
            $this->query = "UPDATE PROFESOR "
                            . "SET dni = '{$Profesor->getDni()}', "
                            . "nombre = '{$Profesor->getNombre()}', "
                            . "apellido = '{$apellido}' ,"
                            . "email = '{$Profesor->getEmail()}' ,"
                            . "idDepartamento = '{$Profesor->getIdDepartamento()}'"
                            . "WHERE id = '{$id_}'";
        } elseif ($profesorAntes->getDni() != $Profesor->getDni()) {
            if ($this->chequearDNI($Profesor->getDni())) {
                $this->query = "UPDATE PROFESOR "
                        . "SET dni = '{$Profesor->getDni()}', "
                        . "nombre = '{$Profesor->getNombre()}', "
                        . "apellido = '{$apellido}' ,"
                        . "email = '{$Profesor->getEmail()}' ,"
                        . "idDepartamento = '{$Profesor->getIdDepartamento()}'"
                        . "WHERE id = '{$id_}'";
            } else {
                throw new Exception("El DNI:  <b>" . $Profesor->getDni() . "</b> ya corresponde a un profesor en la Base de Datos");
            }
        } else {
            if ($this->chequearEmail($Profesor->getEmail())) {
                $this->query = "UPDATE PROFESOR "
                        . "SET dni = '{$Profesor->getDni()}', "
                        . "nombre = '{$Profesor->getNombre()}', "
                        . "apellido = '{$apellido}' ,"
                        . "email = '{$Profesor->getEmail()}' ,"
                        . "idDepartamento = '{$Profesor->getIdDepartamento()}'"
                        . "WHERE id = '{$id_}'";
            } else {
                throw new Exception("El email:  <b>" . $Profesor->getEmail() . "</b> ya corresponde a un profesor en la Base de Datos");
            }
        }
       
        $consulta = BDConexionSistema::getInstancia()->query($this->query);
        if ($consulta) {
            return true;
        } else {
            return false;
        }
        
    }
    
    function chequearDNI($dni_) {
        $this->resultado = BDConexionSistema::getInstancia()->query("SELECT 1 FROM PROFESOR WHERE dni = {$dni_} LIMIT 1");
        if ($this->resultado->num_rows == 1) {
            //El registro existe en la BD. No se puede insertar
            return false;
        } else {
            //El registro no existe en la BD. Se puede insertar
            return true;
        }
    }
    
    function chequearEmail($email_) {
        //$email = mysqli_real_escape_string(BDConexionSistema::getInstancia(), $email_);
        $this->resultado = BDConexionSistema::getInstancia()->query("SELECT 1 FROM PROFESOR WHERE email = '{$email_}' LIMIT 1");
        if ($this->resultado->num_rows == 1) {
            //El registro existe en la BD. No se puede insertar
            return false;
        } else {
            //El registro no existe en la BD. Se puede insertar
            return true;
        }
    }
    
}
