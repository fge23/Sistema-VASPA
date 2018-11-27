<?php
//Para ocultar los warning que muestra por pantalla, estos warning hace referencia a los include
error_reporting(0);

include_once '../../controlSistema/ManejadorProgramaPDF.php';
include_once '../../modeloSistema/ProgramaPDF.Class.php';

$ManejadorProgramaPDF = new ManejadorProgramaPDF();
$Programas = $ManejadorProgramaPDF->getColeccion();

$salida = "";

$salida.="<table class='table table-hover table-sm'>
                        <tr class='table-info'>
                            <th>Nombre</th>
                            <th>Tama&ntilde;o (en MB)</th>
                            <th>Opciones</th>
                        </tr>";

if (isset($_POST['consulta'])) {
    $q = $_POST['consulta'];
    $codCarrera = $_POST['cod'];
    $anio = $_POST['anio'];
    foreach ($Programas as $Programa) {
        $var = "/".$q."/i";
        if ($codCarrera == substr($Programa->getNombre(), 0, 3) && $anio == $Programa->getAnio()){
            if (preg_match($var, $Programa->getNombre())){  
                $salida .= "<tr>
                <td>".utf8_encode($Programa->getNombre())."</td>
                <td>".round(($Programa->getTamanio()/1024)/1024, 2)."</td>
                <td>
                    <a title='Visualizar PDF' href='../".utf8_encode($Programa->getRuta())."'>
                        <button type='button' class='btn btn-outline-success'>
                            <span class='oi oi-document'></span>
                        </button>
                    </a>
                </td>
            </tr>";
            }
        }
    } 
}
else{
    $codCarrera = $_POST['cod'];
    $anio = $_POST['anio'];
    foreach ($Programas as $Programa) {
        if ($codCarrera == substr($Programa->getNombre(), 0, 3) && $anio == $Programa->getAnio()){
             
                $salida .= "<tr>
                <td>".utf8_encode($Programa->getNombre())."</td>
                <td>".round(($Programa->getTamanio()/1024)/1024, 2)."</td>
                <td>
                    <a title='Visualizar PDF' href='../".utf8_encode($Programa->getRuta())."'>
                        <button type='button' class='btn btn-outline-success'>
                            <span class='oi oi-document'></span>
                        </button>
                    </a>
                </td>
            </tr>";
            
        }
    } 
}

  $salida.="</table>";
  
  echo $salida;
  ?>