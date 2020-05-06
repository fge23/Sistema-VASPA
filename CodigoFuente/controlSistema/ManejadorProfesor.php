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

    //Funcion para Alta de Profesores que no son responsables de asignaturas (No inserta usuario)
    function alta($datos) {

        //Creo objeto sin enviar ID y enviando todos los datos del formulario
        $Profesor = new Profesor(null, $datos);
        $apellido = mysqli_real_escape_string(BDConexionSistema::getInstancia(), $Profesor->getApellido());
        
//        if ($this->chequearDNI($Profesor->getDni())) {
            if ($this->chequearEmail($Profesor->getEmail())) {
                $this->query = "INSERT INTO PROFESOR "
                        . "VALUES ('{$Profesor->getId()}', '0', '{$Profesor->getNombre()}', '{$apellido}',"
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
//        } else {
//            throw new Exception("El DNI:  <b>" . $Profesor->getDni() . "</b> ya corresponde a un profesor en la Base de Datos");
//        }
        
    }
    
    //Funcion para Alta de Profesores que son responsables de asignaturas (lo registra como usuario tambien)
    function altaUsuarioProfesor($datos) {
        
        if (BDConexionSistema::getInstancia()->begin_transaction()){ 
            // INSERCION PROFESOR
            //Creo objeto sin enviar ID y enviando todos los datos del formulario
            $Profesor = new Profesor(null, $datos);
            $apellido = mysqli_real_escape_string(BDConexionSistema::getInstancia(), $Profesor->getApellido());
        
            if ($this->chequearEmail($Profesor->getEmail())) {
                $this->query = "INSERT INTO PROFESOR "
                        . "VALUES ('{$Profesor->getId()}', '0', '{$Profesor->getNombre()}', '{$apellido}',"
                        . "'{$Profesor->getEmail()}', '{$Profesor->getCategoria()}', '{$Profesor->getPreferencias()}', '{$Profesor->getIdDepartamento()}')";

                $consulta = BDConexionSistema::getInstancia()->query($this->query);

            }
            else {
                throw new Exception("El email:  <b>" . $Profesor->getEmail() . "</b> ya corresponde a un profesor en la Base de Datos");
            }
            
            if (!$consulta) {
                BDConexionSistema::getInstancia()->rollback();
                throw new Exception("No se puedo dar de alta el profesor (Error en la Base de Datos).");
            } 
            
            // INSERCION USUARIO
            
            $query = "INSERT INTO ".Constantes::BD_USERS.".usuario "
                . "VALUES (null,'{$datos["nombreUsuario"]}','{$datos["email"]}')";
            $consulta = BDConexionSistema::getInstancia()->query($query);
            if (!$consulta) {
                BDConexionSistema::getInstancia()->rollback();
                //arrojar una excepcion
                //die(BDConexion::getInstancia()->errno);
                throw new Exception("No se puedo dar de alta el profesor (Error en la Base de Datos).");
            }
            
            // recuperamos la id del usuario
            $idUsuario = BDConexionSistema::getInstancia()->insert_id;
            
            // INSERCION USUARIO_ROL
            $query = "INSERT INTO ".Constantes::BD_USERS.".usuario_rol "
                . "VALUES ({$idUsuario}, 9)";
            $consulta = BDConexionSistema::getInstancia()->query($query);
            if (!$consulta) {
                BDConexionSistema::getInstancia()->rollback();
                //arrojar una excepcion
                //die(BDConexion::getInstancia()->errno);
                throw new Exception("No se puedo dar de alta el profesor (Error en la Base de Datos).");
            }
                        
            BDConexionSistema::getInstancia()->commit();
            BDConexionSistema::getInstancia()->autocommit(true);
            
            // si no se produjeron excepciones OK insercion, retornamos VERDADERO
            return TRUE;
            
        } else {
            throw new Exception("No se puedo dar de alta el profesor (Error en la Base de Datos).");
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
    
    function bajaUsuarioProfesor($idProfesor, $idUsuario) {
        
        if (BDConexionSistema::getInstancia()->begin_transaction()){
            
            BDConexionSistema::getInstancia()->autocommit(false);
            BDConexionSistema::getInstancia()->begin_transaction();

            $query = "DELETE FROM ".Constantes::BD_USERS.".usuario_rol "
                    . "WHERE id_usuario = {$idUsuario}";

            $consulta = BDConexionSistema::getInstancia()->query($query);
            if (!$consulta) {
                BDConexionSistema::getInstancia()->rollback();
                //arrojar una excepcion
                throw new Exception("No se pudo eliminar el usuario (Error en la Base de Datos).");
            }

            $query = "DELETE FROM ".Constantes::BD_USERS.".usuario "
                    . "WHERE id = {$idUsuario}";
            $consulta = BDConexionSistema::getInstancia()->query($query);
            if (!$consulta) {
                BDConexionSistema::getInstancia()->rollback();
                //arrojar una excepcion
                throw new Exception("No se pudo eliminar el usuario (Error en la Base de Datos).");
            }
            
            $this->query = "DELETE FROM PROFESOR WHERE id = '{$idProfesor}'";
            $consulta = BDConexionSistema::getInstancia()->query($this->query);
            if (!$consulta) {
                BDConexionSistema::getInstancia()->rollback();
                //arrojar una excepcion
                throw new Exception("No se pudo eliminar el usuario (Error en la Base de Datos).");
            } 
            
            BDConexionSistema::getInstancia()->commit();
            BDConexionSistema::getInstancia()->autocommit(true);
            
            // si no se produjeron excepciones OK eliminacion, retornamos VERDADERO
            return TRUE;
            
        } else {
            throw new Exception("No se pudo eliminar el usuario (Error en la Base de Datos).");
        }
           
    }

    //Funcion para Modificación de Profesores
    function modificacion($datos, $id_) {
        $Profesor = new Profesor(null, $datos);
        $profesorAntes = new Profesor ($id_, NULL);
        $apellido = mysqli_real_escape_string(BDConexionSistema::getInstancia(), $Profesor->getApellido());
        
        if ($profesorAntes->getEmail() != $Profesor->getEmail()) {
//            if ($this->chequearDNI($Profesor->getDni())) {
                if ($this->chequearEmail($Profesor->getEmail())) {
                    $this->query = "UPDATE PROFESOR "
                            . "SET dni = '0', "
                            . "nombre = '{$Profesor->getNombre()}', "
                            . "apellido = '{$apellido}' ,"
                            . "email = '{$Profesor->getEmail()}' ,"
                            . "idDepartamento = '{$Profesor->getIdDepartamento()}'"
                            . "WHERE id = '{$id_}'";
                } else {
                    throw new Exception("El email:  <b>" . $Profesor->getEmail() . "</b> ya corresponde a un profesor en la Base de Datos");
                }
//            } else {
//                throw new Exception("El DNI:  <b>" . $Profesor->getDni() . "</b> ya corresponde a un profesor en la Base de Datos");
//            }
        } else {
            $this->query = "UPDATE PROFESOR "
                            . "SET dni = '0', "
                            . "nombre = '{$Profesor->getNombre()}', "
                            . "apellido = '{$apellido}' ,"
                            . "idDepartamento = '{$Profesor->getIdDepartamento()}'"
                            . "WHERE id = '{$id_}'";
        }
       
        $consulta = BDConexionSistema::getInstancia()->query($this->query);
        if ($consulta) {
            return true;
        } else {
            return false;
        }
        
    }
    
//    function chequearDNI($dni_) {
//        $this->resultado = BDConexionSistema::getInstancia()->query("SELECT 1 FROM PROFESOR WHERE dni = {$dni_} LIMIT 1");
//        if ($this->resultado->num_rows == 1) {
//            //El registro existe en la BD. No se puede insertar
//            return false;
//        } else {
//            //El registro no existe en la BD. Se puede insertar
//            return true;
//        }
//    }
    
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
