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
include_once '../modeloSistema/BDConexionSistema.Class.php';
require_once '../controlSistema/ManejadorCarrera.php';

$manejadorCarrera = new ManejadorCarrera();
$carreras = $manejadorCarrera->getColeccion();

// Obtenemos el rol del usuario logueado en el sistema
$Usuario = $_SESSION['usuario'];
$rol = $Usuario->roles[0]->nombre;

if ($rol == PermisosSistema::ROL_ADMIN || $rol == PermisosSistema::ROL_SECRETARIO_ACADEMICO){
    $rol = 'SA'; // administrador / SA
} elseif ($rol == PermisosSistema::ROL_DIRECTOR_DEPARTAMENTO) {
    include_once '../lib/funcionesUtiles/constantesMail.php';
    if ($Usuario->email == MAIL_DEPTO_CNE){
        $rol = 'DCNE'; // Dpto Ciencias Naturales y Exactas;
    } elseif ($Usuario->email == MAIL_DEPTO_CS) {
        $rol = 'DCS'; // Dpto Ciencias Sociales
    } else {
        $rol = 'NA'; // No se  encontro el rol del Usuario
    }  
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
                            <select id="carrera" name="carrera" class="selectpicker" data-width="100%" data-live-search="true" required="" title="Seleccione Carrera" data-none-results-text="No se encontraron resultados">
                                <?php
                                if (!empty($carreras)) {
                                    
                                        foreach ($carreras as $carrera) {
                                            echo '<option value="' . $carrera->getId() . '">'.$carrera->getId().' - '.$carrera->getNombre().'</option>';
                                        }
                                    
                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-sm-3">
                            <label for="plan">Plan de Estudio</label>
                            <select id="plan" name="plan" class="selectpicker" data-width="100%" data-live-search="true" required="" title="Seleccione Plan de Estudio" data-none-results-text="No se encontraron resultados">
                            </select>
                        </div>

                    </div>
                    <br>
                    <div id="tabProgramas"></div>
                    <br>
                    
                    
                        
                </div>
            </div>
        </div>
         <?php include_once '../gui/footer.php'; ?>
        
        <script>
            $(document).ready(function(){
                  $('#carrera').change(function () {
                    var codCarrera = $('#carrera').val();
                    //alert(codCarrera);
                    $.ajax({
                      type: 'POST',
                      url: '../lib/consultaAjax/revisarPrograma/planesDeCarrera.php',
                      data: {'codCarrera': codCarrera}
                    })
                    .done(function(planes){
                      $(".selectpicker").selectpicker(); 
                      $('#plan').html(planes).selectpicker('refresh');
                    })
                    .fail(function(){
                      alert('Hubo un error al cargar los Planes de Estudio.')
                    });
                  });
                  
                  $('#plan').change(function () {
                      var codPlan = $('#plan').val();
                      if (codPlan != -1){ // value = -1 significa que la carrera no tiene planes con lo cual no se podra obtener los programas
                            var codCarrera = $('#carrera').val();
                            // constante que almacena el rol del usuario logueado en el sistema
                            //const rol = "";
                            const rol = "<?php echo $rol; ?>";
                            //alert(rol);
                            //alert(codCarrera+codPlan);
                            $.ajax({
                              type: 'POST',
                              url: '../lib/consultaAjax/revisarPrograma/tablaProgramasAsignaturas.php',
                              data: {'codCarrera': codCarrera,
                                    'codPlan': codPlan,
                                    'rol': rol}
                            })
                            .done(function(programas){
                              //$(".selectpicker").selectpicker(); 
                              $('#tabProgramas').html(programas);
                              //alert(programas);
                            })
                            .fail(function(){
                              alert('Hubo un error al cargar los Programas de Asignaturas.')
                            });
                      }
                    
                  });
                  
              });
    </script>
        
    </body>
</html>

