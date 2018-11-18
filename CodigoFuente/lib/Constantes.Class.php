<?php

setlocale(LC_TIME, 'es_AR.utf8');

/**
 * 
 * Clase para mantener las directivas de sistema.
 * Deben coincidir con las configuraciones del proyecto.
 * 
 * @author Eder dos Santos <esantos@uarg.unpa.edu.ar>
 * 
 */
class Constantes {

    
    const NOMBRE_SISTEMA = "UARGFlow BS";
    
    const WEBROOT = "/var/www/html/uargflow/";
    const APPDIR = "uargflow";
        
    const SERVER = "http://localhost";
    const APPURL = "http://localhost/SVaspa";
    const HOMEURL = "http://localhost/SVaspa/app/index.php";
    const HOMEAUTH = "http://localhost/SVaspa/app/usuarios.php";
    
    const BD_SCHEMA = "bdMesas_Programas";
    const BD_USERS = "bdUsuarios";
    
}
