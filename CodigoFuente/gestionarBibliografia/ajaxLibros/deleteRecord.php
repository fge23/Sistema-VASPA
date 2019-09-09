<?php
include_once '../../modeloSistema/BDConexionSistema.Class.php';
header('Content-Type: text/html; charset=UTF-8');

//chequear si tengo el id
if (isset($_POST['id']) && isset($_POST['id']) != "") {
 
    // getID
    $id = $_POST['id'];

    // Borrar Libro
    $query = "DELETE FROM LIBRO WHERE id = {$id}";
    $consulta = BDConexionSistema::getInstancia()->query($query);
    
}
