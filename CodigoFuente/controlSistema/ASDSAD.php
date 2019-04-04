<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once './ManejadorProgramaPDF.php';

$Programas = new ManejadorProgramaPDF();
$var = $Programas->filtrarPrograma('x', 2018);

var_dump($var);

