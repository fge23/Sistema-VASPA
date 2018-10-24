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

    
    const NOMBRE_SISTEMA = "Sistema VASPA";
    
    const WEBROOT = "/var/www/html/vaspa/";
    const APPDIR = "vaspa";
        
    const SERVER = "http://localhost";
    const APPURL = "http://localhost/vaspa";
    const HOMEURL = "http://localhost/vaspa/uargflow/index.php";
    const HOMEAUTH = "http://localhost/vaspa/uargflow/app/usuarios.php";
    
    const BD_SCHEMA = "bdProgramas";
    const BD_USERS = "bdUsuarios";
    
}
