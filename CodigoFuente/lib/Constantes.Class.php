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

    
    const NOMBRE_SISTEMA = "VASPA";
    
    const WEBROOT = "/var/www/html/uargflow/";
    const APPDIR = "vaspa";
        
    const SERVER = "http://localhost";
    const APPURL = "http://localhost/vaspa";
    const HOMEURL = "http://localhost/vaspa/CodigoFuente/app/index.php";
    const HOMEAUTH = "http://localhost/vaspa/CodigoFuente/app/usuarios.php";
    
    const BD_SCHEMA = "bdMesas_Programas";
    const BD_USERS = "bdUsuarios";
    
}
