<?php

$data = json_decode($_POST['vectorElementos']);

session_start();

$_SESSION['vectorElementos'] = $data;
header("location: plan.asignaturas.procesar.php");

?>