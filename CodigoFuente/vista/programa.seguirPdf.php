<?php
include_once '../lib/ControlAcceso.Class.php';
ControlAcceso::requierePermiso(PermisosSistema::PERMISO_SEGUIR_PROGRAMA);
include_once '../controlSistema/ManejadorCarrera.php';

$ManejadorCarrera = new ManejadorCarrera();
$Carreras = $ManejadorCarrera->getColeccion();

?>

<html>
    <head>
        <meta charset="UTF-8">
        <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.8/css/bootstrap-select.min.css" rel="stylesheet"/>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.8/js/bootstrap-select.min.js"></script>
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
        
        <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Seguir Programa</title> 
    </head>
    <body>
        <?php include_once '../gui/navbar.php';   ?>
        <div class="container">
            <form action="visualizar.programaPdf.listar.seguimiento.php" method="post"> 
                <div class="card">
                    <div class="card-header">
                        <h3>Seguimiento de Programas de Asignaturas</h3>
                        <p>
                            Estimado usuario, complete los campos a continuaci&oacute;n. 
                            Luego, presione el bot&oacute;n <b>Confirmar</b>.<br />
                            Si desea cancelar, presione el bot&oacute;n <b>Cancelar</b>.
                        </p>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="selectAnio">A&ntilde;o</label>
                            <br>
                            <select class="selectpicker show-tick" data-live-search="true" data-width="100%" name="anio" id="selectAnio" title="Seleccione un a&ntilde;o" required="" data-size="5">
                                 <?php for ($i=date('Y'); $i>=2011; $i--) { ?>
                                    <option value="<?= $i; ?>"><?= $i; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="selectCarrera">Carrera</label>
                            <br>
                            <select class="selectpicker show-tick" data-live-search="true" data-width="100%" name="idCarrera" id="selectCarrera" title="Seleccione una carrera" required="" data-size="5">
                            </select>
                        
                        </div>
                        
                    </div>
                    <div class="card-footer">
                            <button type="submit" class="btn btn-outline-success">
                                <span class="oi oi-check"></span> Confirmar
                            </button>
                            <a href="panelSA.php">
                                <button type="button" class="btn btn-outline-danger">
                                    <span class="oi oi-x"></span> Cancelar
                                </button>
                            </a>
                    </div>
                </div>
            </form>
        </div>
                
        <?php include_once '../gui/footer.php'; ?>
        
        <script type="text/javascript">$('.selectpicker').selectpicker({
            noneResultsText: 'No se encontraron resultados'});
        </script>
        
        
        <script>
            $(document).ready(function(){
                  $('#selectAnio').change(function () {
                    var anio = $('#selectAnio').val();
                    //alert(anio);
                    $.ajax({
                      type: 'POST',
                      url: '../lib/consultaAjax/visualizar.programa.cargar.carreras.php',
                      data: {'anio': anio}
                    })
                    .done(function(carreras){
                      $(".selectpicker").selectpicker(); 
                      $('#selectCarrera').html(carreras).selectpicker('refresh');
                    })
                    .fail(function(){
                      alert('Hubo un error al cargar las asignaturas')
                    });
                  });
              });
    </script>
        
    </body>
</html>