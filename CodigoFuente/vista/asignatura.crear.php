<?php
include_once '../lib/ControlAcceso.Class.php';
include_once '../controlSistema/ManejadorDepartamento.php';
include_once '../controlSistema/ManejadorProfesor.php';

$ManejadorDepartamento = new ManejadorDepartamento();
$Departamentos = $ManejadorDepartamento->getColeccion();

$ManejadorProfesor = new ManejadorProfesor();
$Profesores = $ManejadorProfesor->getColeccion();
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
        <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Crear Asignatura</title>
    </head>
    <body>
        <?php include_once '../gui/navbar.php'; ?>
        <div class="container">
            <form action="asignatura.crear.procesar.php" method="post"> 
                <div class="card">
                    <div class="card-header">
                        <h3>Crear Asignatura</h3>
                        <p>
                            Complete los campos a continuaci&oacute;n. 
                            Luego, presione el bot&oacute;n <b>Confirmar</b>.<br />
                            Si desea cancelar, presione el bot&oacute;n <b>Cancelar</b>.
                        </p>
                    </div>
                    <div class="card-body">
                        <h4>Propiedades</h4>
                        <div class="form-group">
                            <label for="inputCodigo">C&oacute;digo de Asignatura</label>
                            <input type="number" name="id" class="form-control" id="inputCodigo" placeholder="Ingrese el C&oacute;digo de la Asignatura" min="0001" max="9999" required="" autofocus>
                        </div>

                        <div class="form-group">
                            <label for="inputNombre">Nombre</label>
                            <input type="text" name="nombre" class="form-control" id="inputNombre" placeholder="Ingrese el nombre de la Asignatura" required="">
                        </div>
                        <div class="form-group">
                            <label for="selectDepartamento">Departamento</label>
                            <select class="selectpicker show-tick" data-width="100%" name="departamento" id="selectDepartamento" title="Seleccione un Departamento" required="">
                                <?php foreach ($Departamentos as $Departamento) { ?>
                                    <option value="<?= $Departamento->getId(); ?>"><?= $Departamento->getNombre(); ?></option>
                                <?php } ?> 
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="selectProfesor">Docente Responsable</label>
                            <br>
                            <select class="selectpicker show-tick" data-live-search="true" data-width="100%" name="idProfesor" id="selectProfesor" title="Seleccione un Docente" required="">
                                <?php foreach ($Profesores as $Profesor) { ?>
                                    <option value="<?= $Profesor->getId(); ?>"><?= $Profesor->getApellido() . ", " . $Profesor->getNombre(); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="inputHora">Horas Semanales</label>
                            <input type="number" name="horasSemanales" class="form-control" id="inputHora" placeholder="Ingrese la cantidad de horas semanales"  min="2" max="12" required="">
                        </div>
                        
                        <div class="form-group">
                            <label for="txtAreaContenidosMinimos">Contenidos M&iacute;nimos</label>
                            <textarea class="form-control" rows="5" name="contenidosMinimos" id="txtAreaContenidosMinimos" required></textarea>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-outline-success">
                            <span class="oi oi-check"></span> Confirmar
                        </button>
                        <a href="asignaturas.php">
                            <button type="button" class="btn btn-outline-danger">
                                <span class="oi oi-x"></span> Cancelar
                            </button>
                        </a>
                    </div>
                </div>
            </form>

        </div>
        <?php include_once '../gui/footer.php'; ?>
        
        <script type="text/javascript">
            $('.selectpicker').selectpicker({
            noneResultsText: 'No se encontraron resultados'});
        </script>
        
    </body>
</html>
