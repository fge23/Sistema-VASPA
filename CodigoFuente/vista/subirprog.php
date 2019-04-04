<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/*
var_dump($_FILES);
echo '<br>';
echo '<br>';
echo '<br>';
var_dump($_POST);

echo '<br>';
echo '<br>';

if (isset($_POST['descripcion'])){
    echo 'Hola';
}
else {
    echo 'chau';
}

*/

/*
$descripcion = '';echo var_dump($descripcion);

$descripcion = (empty($descripcion) ? NULL : $descripcion);

$descripcion = var_dump($descripcion);
echo var_dump($descripcion);
 *
 */

//Obtenemos los datos del archivo a traves del array global _FILES y del Formulario
// $_FILES['programa']['tmp_name'] --> El nombre temporal del fichero en el cual se almacena el fichero subido en el servidor.
$archivo = $_FILES['programa']['tmp_name'];

//$_FILES['programa']['name'] --> El nombre original del fichero en la máquina del cliente.
$name = $_FILES['programa']['name'];

//$_FILES['programa']['size'] --> El tamaño, en bytes, del fichero subido.
$tamanio = $_FILES['programa']['size'];

//$_FILES['programa']['type'] --> El tipo MIME del fichero.
$tipo = $_FILES['programa']['type'];

$finfo = finfo_open(FILEINFO_MIME_TYPE); // buscaremos mimetype
$mimetype = finfo_file($finfo, $archivo);
finfo_close($finfo);

var_dump($_FILES);
echo '<br>';
echo '<br>';
echo '<br>';

var_dump($mimetype);