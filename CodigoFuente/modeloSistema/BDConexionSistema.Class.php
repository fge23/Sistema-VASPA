<?php

/**
 * Description of BDConexionSistema
 * 
 * Esta clase implementa la conexion a la BD del sistema mediante el patron Singleton.
 *
 * @author Fabricio
 * 
 * @uses mysqli Libería estándar de PHP para acceder a bases de datos MySQL
 * @see https://es.wikipedia.org/wiki/Singleton
 * 
 */
class BDConexionSistema extends mysqli {

    private $host, $usuario, $contrasenia, $schema;
    public static $instancia;
    
    function __construct() {
        $this->host = "bgtfa3dnthygbzx1adfd-mysql.services.clever-cloud.com";
        $this->usuario = "uo7jxw0qb79geplw";
        $this->contrasenia = "QjZnnquDt9AVZhenapaK";
        $this->schema = "bgtfa3dnthygbzx1adfd";

        parent::__construct($this->host, $this->usuario, $this->contrasenia, $this->schema);

        if ($this->connect_errno) {
            throw new Exception("Error de Conexion a la Base de Datos", $this->connect_errno);
        }
    }
    
       /**
        * 
        * @return BDConexion
        */
      public static function getInstancia() {
        if (!self::$instancia instanceof self) {
            try {
                self::$instancia = new self;
            } catch (Exception $e) {
                die("Error de Conexion a la Base de Datos: " . $e->getCode() . ".");
            }
        }
        return self::$instancia;
    }

}
