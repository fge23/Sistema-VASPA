<?php

//include_once '../../../controlSistema/ManejadorAsignatura.php';
//include_once '../../../controlSistema/ManejadorProgramaPDF.php';
//include_once '../../../modeloSistema/Asignatura.Class.php';
error_reporting(0); // desactivamos los warning
// importamos la clase Programa
include_once __DIR__ . '/../../../controlSistema/ManejadorAsignatura.php';
include_once __DIR__ . '/../../../controlSistema/ManejadorProgramaPDF.php';
include_once __DIR__ . '/../../../modeloSistema/Asignatura.Class.php';
include_once __DIR__ . '/../../../modeloSistema/ProgramaPDF.Class.php';

//La constante __DIR__ retorna la ruta absoluta del directorio donde se encuentra el fichero que la está utilizando. Y dirname() retorna el directorio padre, en combinación dirname(__DIR__) nos retornaría la ruta absoluta del directorio padre donde se encuentra el fichero que la está usando.


$anio = $_POST['anio'];
$codCarrera = $_POST['idCarrera'];

//$anio = 2020;
//$codCarrera = "016";
$manejadorAsignatura = new ManejadorAsignatura();
$asignaturas = $manejadorAsignatura->getAsignaturasDeCarrera($codCarrera, $anio);
//var_dump($Asignaturas);

$html = ''; // variable que va a contener el HTML a devolver en la peticion AJAX

// Comprobamos si hay asignaturas
if (is_null($asignaturas)){
    $html = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        No se encontrar&oacute;n asignaturas.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
} else {
    //Creamos el manejador de los programas pdf el cual va a tener una coleccion de pdf de la carrera para el anio especificado
    $manejadorProgramaPDF = new ManejadorProgramaPDF($codCarrera, $anio);
    
    $html = '
<div class="row justify-content-center"><button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Ver Programas de Asignaturas</button></div>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Visualizar Programa de Asignatura</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">';
        
    
    // Agregamos el input para buscar de acuerdo al nombre de la asignatura
    $html .= '<label for="buscador">Buscador</label>
                    <input type="text" name="buscador" id="buscador" 
                           class="form-control" placeholder="Ingrese nombre &oacute; el c&oacute;digo de la asignatura a buscar..."><br>';
    
    $html .= '<table class="table table-hover table-sm">
                        <thead>
                            <tr class="table-info">
                                <th class="text-center">C&oacute;digo</th>
                                <th class="text-center">Asignatura</th>
                                <th class="text-center">Visualizar</th>
                            </tr>
                        </thead>
                        <tbody>';

    foreach ($asignaturas as $asignatura) { 
        $html .= '<tr><td class="text-center">'.$asignatura->getId().'</td>';
        $html .= '<td>'.$asignatura->getNombre().'</td>';
        $ruta = $manejadorProgramaPDF->tieneProgramaPDF($asignatura->getId());
        if (!empty($ruta)){ 
            $html .= '<td><div class="row justify-content-center">
                          <a title="Visualizar Programa de Asignatura" href="'.$ruta.'" target="_blank">
                              <button type="button" class="btn btn-outline-success">
                                <span class="oi oi-document"></span>
                              </button>
                          </a>
                          </div>
                      </td>';
        } else {
            $html .= '<td><div class="row justify-content-center">
                         <a title="Programa no disponible">
                            <button type="button" class="btn btn-outline-success" disabled="">
                              <span class="oi oi-document"></span>
                            </button>
                         </a>
                         </div>
                      </td>';
        }                        
                                    
        $html .= '</tr>';                                

    }
    $html .= '</tbody></table>';
    $html .= '<div id="noResultMessage" class="alert alert-warning" role="alert" style="display: block;">
                        No se han encontrado resultados.
                    </div>';
    $html .= '</div>
    </div>
  </div>
</div>';
}
echo $html;
?>
    <script>
            $('#buscador').quicksearch('table tbody tr', {noResults: "#noResultMessage"});
    </script>


