<?php 
include_once '../lib/ControlAcceso.Class.php'; 
include_once '../controlSistema/ManejadorCarrera.php';


if (!empty($_GET['codCarrera']) && !empty($_GET['codPlan'])){
    include_once '../modeloSistema/BDConexionSistema.Class.php';

$consulta = "SELECT plan.idCarrera, asignatura.id, asignatura.nombre AS nombreAsignatura, profesor.apellido, profesor.nombre AS nombreProfesor "
        . "FROM plan JOIN plan_asignatura ON plan.id = plan_asignatura.idPlan JOIN asignatura ON "
        . "plan_asignatura.idAsignatura = asignatura.id JOIN profesor ON asignatura.idProfesor = profesor.id";

$resultados = BDConexionSistema::getInstancia()->query($consulta);


}

$manejadorCarrera = new ManejadorCarrera();
$carreras = $manejadorCarrera->getColeccion();

?>

<html lang="es">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
      <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>
      <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
      <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.8/css/bootstrap-select.min.css" rel="stylesheet"/>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.8/js/bootstrap-select.min.js"></script>
      <link rel="stylesheet" href="../lib/bootstrap-table/bootstrap-table.min.css">
      <link rel="stylesheet" type="text/css" href="../lib/bootstrap-table/extensions/filter-control/bootstrap-table-filter-control.css">
      <script src="../lib/bootstrap-table/bootstrap-table.min.js"></script>
      <script src="../lib/bootstrap-table/extensions/filter-control/bootstrap-table-filter-control.js"></script>
      <script src="../lib/bootstrap-table/extensions/export/bootstrap-table-export.min.js"></script>
      <script src="../lib/bootstrap-table/extensions/toolbar/bootstrap-table-toolbar.min.js"></script>
      <script src="../lib/bootstrap-table/locale/bootstrap-table-es-ES.js" ></script>
      
      
      <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
      
      <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Bienvenida</title>
    </head>
    <body>
        <?php include_once '../gui/navbar.php'; ?>
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <h3><?php echo Constantes::NOMBRE_SISTEMA; ?> - Panel Secretar&iacute;a Acad&eacute;mica</h3>
                        </div>
                        <div class="card-body">
<!--                            <p>Estimado empleado de Secretar&iacute;a Acad&eacute;mica: Bienvenido al Sistema VASPA, desde esta pantalla podr&aacute; adiministrar el Sistema.</p>  
                            <hr>-->
                            <!--<div class="row">-->
                                <!--<div class="col-md-12">-->
<!--                                    <p>Funcionalidad/es mas importante/s...</p>
                                    <br>-->
                                    
                                <div class="form-group col-md-6">
    <label for="exampleFormControlSelect1">Example select</label>
    <select class="form-control" id="exampleFormControlSelect1">
      <option>1</option>
      <option>2</option>
      <option>3</option>
      <option>4</option>
      <option>5</option>
    </select>
  </div>
                                
                                
                                    <div class="form-group col-md-4">
                                <label for="carrera">Carrera</label>
                                    <select id="carrera" name="carrera" class="selectpicker" data-width="100%" data-live-search="true" required="" title="Seleccione una Carrera" data-none-results-text="No se encontraron resultados">
                                        <?php if (!empty($carreras)){
                                                    if (!empty($_GET['codCarrera']) && !empty($_GET['codPlan'])){
                                                        foreach ($carreras as $carrera) {
                                                            if ($_GET['codCarrera'] == $carrera->getId()){
                                                                echo '<option value="'.$carrera->getId().'" selected>'.$carrera->getNombre().'</option>';
                                                            } else {
                                                                echo '<option value="'.$carrera->getId().'">'.$carrera->getNombre().'</option>';
                                                            }
                                                        }
                                                    } else {
                                                        foreach ($carreras as $carrera) {
                                                            echo '<option value="'.$carrera->getId().'">'.$carrera->getNombre().'</option>';
                                                    }    
                                                }
                                        }
                                            ?>
                                    </select>
                            </div>

                            <div class="form-group col-md-5">
                                <label for="plan">Plan de Estudio</label>
                                <select id="plan" name="plan" class="selectpicker" data-width="100%" data-live-search="true" required="" title="Seleccione un Plan de Estudio" data-none-results-text="No se encontraron resultados" onchange="location = this.value">
                                    </select>
                            </div>
                                    
                                <!--</div>-->
<!--                            </div>
                            <hr>-->
<?php if (!empty($_GET['codCarrera']) && !empty($_GET['codPlan'])){ ?>
<table id="table" 
                           data-toggle="table"
                           data-locale="es-ES"
                           data-search="true"
                           data-filter-control="true" 
                           data-show-export="true"
                           data-pagination="true"
                           data-pagination-loop="false"
                           data-pagination-pre-text="Anterior"
                           data-pagination-next-text="Siguiente"
                           data-advanced-search="true"
                           data-id-table="advancedTable"
                           data-click-to-select="true"
                           data-toolbar="#toolbar"
                           class="table table-hover table-sm">
                        <thead>
                            <tr>
                                <th data-field="state" data-checkbox="true"></th>
                                <th data-field="carrera" data-filter-control="select" data-sortable="true" data-halign="center" data-align="center">Carrera</th>
                                <th data-field="anio" data-filter-control="select" data-sortable="true" data-halign="center" data-align="center">A&ntilde;o</th>
                                <th data-field="cuatrimestre" data-filter-control="select" data-sortable="true" data-halign="center" data-align="center">Cuatrimestre</th>
                                <th data-field="codigo" data-filter-control="select" data-sortable="true" data-halign="center" data-align="center">C&oacute;digo</th>
                                <th data-field="asignatura" data-filter-control="input" data-sortable="true" data-halign="center" data-align="center">Asignatura</th>
                                <th data-field="docenteResponsable" data-filter-control="input" data-sortable="true" data-halign="center" data-align="center">Docente Responsable</th>
                                <th data-field="vigencia" data-halign="center" data-align="center">Vigencia</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                               <?php
                                $contador = 0;
                                while ($registro=$resultados->fetch_assoc()) { ?>
                                <td class="bs-checkbox "><input data-index="<?= $contador; ?>" name="btSelectItem" type="checkbox"></td>  
                                <td><?php echo $registro['idCarrera']; ?></td> 
                                <td></td>
                                <td></td>
                                <td><?php echo $registro['id']; ?></td>
                                <td><?php echo $registro['nombreAsignatura']; ?></td>
                                <td><?= $registro['apellido'].' '.$registro['nombreProfesor'] ?></td>
                                <td></td>
                                </tr>
                               <?php $contador++; 
                                } ?>
                            
                            
                        </tbody>
                    </table>
<?php } ?>

                        </div>
                    </div>
                </div>

                <!-- Sidebar Column -->
                <div class="col-md-3">
                    <div class="card">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title">Accesos r&aacute;pidos   </h5>
                                <hr>
                                <a href="programas.pendientes.php" class="btn btn-outline-secondary btn-block">Programas pendientes</a>
                                <a href="#" class="btn btn-outline-secondary btn-block">Seguimiento de Programa</a>
                                <a href="subir.programa.formulario.php" class="btn btn-outline-secondary btn-block">Subir Programa</a>
                                <a href="subir.plan.formulario.php" class="btn btn-outline-secondary btn-block">Subir Plan</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include_once '../gui/footer.php'; ?>
    </body>
    
    <script>
            $(document).ready(function(){
                      //$('.selectpicker').selectpicker();
            //alert($("selectAnio").val());
                      //$('.selectpicker').selectpicker();
            
//            $('#selectAnio').change(function (e) {
//              var anio = $('#selectAnio').val();
//              $.ajax({
//                type: 'POST',
//                url: '../lib/consultaAjax/visualizar.programa.cargar.carreras.php',
//                data: {'anio': anio}
//              })
//              .done(function(carreras){
//                $(".selectpicker").selectpicker(); 
//                $('#carrera').html(carreras).selectpicker('refresh');
//              })
//              .fail(function(){
//                alert('Hubo un error al cargar las carreras');
//              });
//            });
            
            //$('#carrera').on('change', function(){
            $('#carrera').change(function (e) {
              //$('.selectpicker').selectpicker();
              //alert($("#carrera").val());
              //alert(e.target.value);
              //var id = e.target.value;
              //var id = $('#carrera').val()
              //var anio = $('#selectAnio').val();
              //var anio = document.getElementById("selectAnio").value;
              //alert(anio)
              //alert(id)
              var id = $("#carrera").val(); //obtenemos el codigo de la carrera seleccionada
              $.ajax({
                type: 'POST',
                url: '../lib/consultaAjax/cargarPlanes.php',
                data: {'id': id}
              })
              .done(function(planes){
                //$('#asignatura').html(asignaturas);
                //$('.selectpicker').selectpicker('refresh');
                $(".selectpicker").selectpicker(); 
                $('#plan').html(planes).selectpicker('refresh');
              })
              .fail(function(){
                alert('Hubo un error al cargar los Planes de Estudio');
              });
            });

            //Si se cambia de anio, reseteamos las asignaturas y tener en cuenta mas tarde las carreras
            $('#selectAnio').change(function () {
              //Reiniciamos asignaturas
              var groupFilter = $('#asignatura');
              groupFilter.selectpicker('val', '');
              groupFilter.find('option').remove();
              groupFilter.selectpicker("refresh");
              $("#asignatura").val('default').selectpicker("refresh");
              //Reiniciamos carreras pero sin eliminar los elementos de la lista
              //Probablemente se tendra que actualizar en base al año seleccionado
              $("#carrera").val('default').selectpicker("refresh");
            });
            /*
            //Cambiamos la leyenda cuando no se encontraron resultados en la busqueda en tiempo real del combobox
            $('.selectpicker').selectpicker({
              noneResultsText: 'No se encontraron resultados'
            });
            */
          });
    </script>
    
    <script>
            $(function() {
              $('#table').bootstrapTable()
            });
        </script>
    
</html>
