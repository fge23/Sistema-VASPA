<?php
header ('Content-Type: text/html; charset=ISO-8859-1');
/* Aqui comienza el CU Revisar Programa
 * Observaciones: 
 * - Rol Secretario Academico y Administrador comparten la misma funcionalidad
 * Esto quiere decir que si el usuario tiene el rol de Admin va a revisar los programas
 * como si fuese un usuario de SA. (preguntar a los chicos)
 * 
 */
include_once '../lib/ControlAcceso.Class.php';
ControlAcceso::requierePermiso(PermisosSistema::PERMISO_REVISAR_PROGRAMA);
include_once '../modeloSistema/BDConexionSistema.Class.php';
require_once '../controlSistema/ManejadorCarrera.php';

$manejadorCarrera = new ManejadorCarrera();
$carreras = $manejadorCarrera->getColeccion();

// Obtenemos el rol del usuario logueado en el sistema
$Usuario = $_SESSION['usuario'];
$rol = $Usuario->roles[0]->nombre;

$filtro = '';// Filtro para utilizar en la query

if ($rol == PermisosSistema::ROL_ADMIN || $rol == PermisosSistema::ROL_SECRETARIO_ACADEMICO){
    $rol = 'SA'; // administrador / SA
    $filtro = " aprobadoSa IS NULL"; // Filtro para utilizar en la query
} elseif ($rol == PermisosSistema::ROL_DIRECTOR_DEPARTAMENTO) {
    include_once '../lib/funcionesUtiles/constantesMail.php';
    if ($Usuario->email == MAIL_DEPTO_CNE){
        $rol = 'DCNE'; // Dpto Ciencias Naturales y Exactas;
        $filtro = " idDepartamento = '2' AND aprobadoDepto IS NULL"; // Filtro para utilizar en la query
    } elseif ($Usuario->email == MAIL_DEPTO_CS) {
        $rol = 'DCS'; // Dpto Ciencias Sociales 
        $filtro = " idDepartamento = '1' AND aprobadoDepto IS NULL"; // Filtro para utilizar en la query
    } else {
        $rol = 'NA'; // No se  encontro el rol del Usuario
    }  
}

// ARMAMOS LA CONSULTA EN DONDE SE OBTENDRAN LOS 20 PROGRAMAS DE ASIGNATURAS "NO REVISADOS" MAS RECIENTES TENIENDO EN CUENTA QUE LA VIGENCIA CONTENGA EL AÑO ACTUAL
$anioActual = date("Y"); //obtenemos el anio (4 digitos) del servidor (anio actual)

$query = "SELECT DISTINCT (p.id) as idPrograma, nombre, a.id, anio, vigencia, fechaCarga 
                FROM plan pl
                JOIN plan_asignatura pa 
                ON pl.id = pa.idPlan
                JOIN asignatura a 
                ON pa.idAsignatura = a.id 
                JOIN programa p 
                ON a.id = p.idAsignatura 
                WHERE enRevision = 1 AND $filtro "
                . "AND anio <= {$anioActual} "
                . "AND (anio+vigencia-1) >= {$anioActual} "
                . "ORDER BY fechaCarga DESC "
                . "LIMIT 20";

        //var_dump($query);
        //exit();

// Ejecutamos la query

function getVigencia($anio, $vigencia) {
    switch ($vigencia) {
        case 1:
            return $anio;
            //break;
        case 2:
            return $anio.' - '.($anio+1);
            //break;
        case 3:
            return $anio.' - '.($anio+1).' - '.($anio+2);
            //break;

        default:
            return $anio;
            //break;
    }
}

function obtenerProgramasAsignaturasRecientes($query) {
    $resultado = BDConexionSistema::getInstancia()->query($query);
    //$html = '<br>'; // variable a retornar
    $html = '<h5 class="text-center text-muted">Programas recientes No Revisados</h5>';
    //$html .= '<br>'; 
    if ($resultado !== false){
        if ($resultado->num_rows > 0) {
            // Creamos la tabla donde presentaremos la info
            $html .= '<table class="table table-hover table-sm" id="tablaPrograma">
                        <thead>
                            <tr class="table-info">
                                <th>Programa de</th>
                                <th>C&oacute;digo</th>
                                <th>Vigencia</th>
                                <th>Fecha de Carga</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>';
            for ($x = 0; $x < $resultado->num_rows; $x++) {
                
                $fila = $resultado->fetch_assoc();
                $fechaCarga = new DateTime($fila['fechaCarga']);
                $fechaCarga = $fechaCarga->format('d/m/y');
                $html .= '<tr>';
                $html .= '<td>'.$fila['nombre'].'</td>';
                $html .= '<td>'.$fila['id'].'</td>';
                $html .= '<td>'.getVigencia($fila['anio'], $fila['vigencia']).'</td>';
                $html .= '<td>'.$fechaCarga.'</td>';
                $html .= '<td><a title="Revisar Programa" href="revisar.programa.php?id='.$fila['idPrograma'].'">
                                        <button type="button" class="btn btn-outline-success">
                                            <span class="oi oi-document"></span>
                                        </button></a></td>';
                $html .= '</tr>';

            }
            // cerramos etiquetas de la tabla
            $html .= '</tbody>';
            $html .= '</table>';
        } else { // No hay registros --> Mostramos mensaje 
            $html .= '<div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
                    No hay programas de asignaturas para revisar.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
        }
    } else { // Ocurrio un error al realizar peticion --> Mostramos mensaje
            $html .= '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                    Ocurrio un Error al realizar peticion a la BD.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
        }
    return $html;
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.8/css/bootstrap-select.min.css" rel="stylesheet"/>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.8/js/bootstrap-select.min.js"></script>
        <link rel="stylesheet" href="../lib/datatable/dataTables.bootstrap4.min.css" />
        <script type="text/javascript" src="../lib/datatable/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="../lib/datatable/dataTables.bootstrap4.min.js"></script>
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
           <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Revisar Programas</title>
    </head>
    <body>

        <?php include_once '../gui/navbar.php'; ?>

        <div class="container">

            <div class="card">
                <div class="card-header">
                    <h3>Revisar Programa - <span class="text-info">Programas de asignaturas</span></h3>
                </div>
                <div class="card-body">
                    
                    
                    <div class="row justify-content-md-center">
                        <div class="col-sm-5">
                            <label for="carrera">Carrera</label>
                            <select id="carrera" name="carrera" class="selectpicker" data-width="100%" data-live-search="true" required="" title="Seleccione Carrera" data-none-results-text="No se encontraron resultados" data-size="5">
                                <?php
                                if (!empty($carreras)) {
                                    
                                        foreach ($carreras as $carrera) {
                                            echo '<option value="' . $carrera->getId() . '">'.$carrera->getId().' - '.$carrera->getNombre().'</option>';
                                        }
                                    
                                }
                                ?>
                            </select>
                        </div>

<!--                        <div class="col-sm-3">
                            <label for="plan">Plan de Estudio</label>
                            <select id="plan" name="plan" class="selectpicker" data-width="100%" data-live-search="true" required="" title="Seleccione Plan de Estudio" data-none-results-text="No se encontraron resultados" data-size="5">
                            </select>
                        </div>-->

                    </div>
                    <br>
                    <?php
                        // Mostramos mensaje, resultado de la operacion de haber aprobado o no un programa.
                        if (isset($_SESSION['mensajeRevisarPrograma'])) {
                            echo $_SESSION['mensajeRevisarPrograma'];
                            unset($_SESSION['mensajeRevisarPrograma']); //
                        }
                    ?>
                    <div id="tabProgramas">
                        <?php 
                            echo obtenerProgramasAsignaturasRecientes($query); // Mostramos tabla programas recientes o mensaje
                        ?>
                    </div>
                    <br>
                    
                    
                        
                </div>
            </div>
        </div>
         <?php include_once '../gui/footer.php'; ?>
        
        <script>
            $(document).ready(function(){
                  $('#carrera').change(function () {
                    var codCarrera = $('#carrera').val();
                    // constante que almacena el rol del usuario logueado en el sistema
                    //const rol = "";
                    const rol = "<?php echo $rol; ?>";
                    //alert(codCarrera);
                    $.ajax({
                      type: 'POST',
                      url: '../lib/consultaAjax/revisarPrograma/tablaProgramasAsignaturas.php',
                      data: {'codCarrera': codCarrera,
                            'rol': rol}
                    })
                    .done(function(programas){
                      $('#tabProgramas').html(programas);
                    })
                    .fail(function(){
                      alert('Hubo un error al cargar los Programas de Asignaturas.')
                    });
                  });
                                    
              });
    </script>
    
    <script type="text/javascript">
                $('#tablaPrograma').DataTable({
                    language: {
                        url: '../lib/datatable/es-ar.json'
                    }
                });
</script>
    
    </body>
</html>

