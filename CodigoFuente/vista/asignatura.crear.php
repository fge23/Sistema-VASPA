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
        <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />

       <link rel="stylesheet" href="../chosen_v1.8.7/docsupport/style.css">
        <link rel="stylesheet" href="../chosen_v1.8.7/docsupport/prism.css">
        <link rel="stylesheet" href="../chosen_v1.8.7/chosen.css">
        <meta http-equiv="Content-Security-Policy" content="default-src &apos;self&apos;; script-src &apos;self&apos; https://ajax.googleapis.com; style-src &apos;self&apos;; img-src &apos;self&apos; data:"> 

        <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>

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
                            <input type="number" name="id" class="form-control" id="inputCodigo" placeholder="Ingrese el C&oacute;digo de la Carrera" min="001" max="999" required="">
                        </div>

                        <div class="form-group">
                            <label for="inputNombre">Nombre</label>
                            <input type="text" name="nombre" class="form-control" id="inputNombre" placeholder="Ingrese el nombre de la Asignatura" required="">
                        </div>
                        <div class="form-group">
                            <label for="selectDepartamento">Departamento</label>
                            <select class="form-control" id="selectDepartamento" name="idDepartamento" >
                                <?php foreach ($Departamentos as $Departamento) { ?>
                                    <option value="<?= $Departamento->getId(); ?>"><?= $Departamento->getNombre(); ?></option>
                                <?php } ?> </select>
                        </div>
                        <div class="form-group">
                            <label for="txtAreaContenidosMinimos">Contenidos M&iacute;nimos</label>
                            <textarea class="form-control" rows="5" name="contenidosMinimos" id="txtAreaContenidosMinimos"></textarea>
                        </div>



                        <div class="form-group">
                                <label for="selectProfesor">Docente Responsable</label>
                                <select data-placeholder="Seleccione un Docente" class="chosen-select" tabindex="2" id="selectProfesor">
                                    <?php foreach ($Profesores as $Profesor) { ?>
                                        <option value="<?= $Profesor->getId(); ?>"><?= $Profesor->getApellido() . ", " . $Profesor->getNombre(); ?></option>
                                    <?php } ?>
                                </select>
                        </div>


                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-outline-success">
                            <span class="oi oi-check"></span> Confirmar
                        </button>
                        <a href="carreras.php">
                            <button type="button" class="btn btn-outline-danger">
                                <span class="oi oi-x"></span> Cancelar
                            </button>
                        </a>
                    </div>
                </div>
            </form>

        </div>
        <?php include_once '../gui/footer.php'; ?>
        <script src="../chosen_v1.8.7/docsupport/jquery-3.2.1.min.js" type="text/javascript"></script>
        <script src="../chosen_v1.8.7/chosen.jquery.js" type="text/javascript"></script>
        <script src="../chosen_v1.8.7/docsupport/prism.js" type="text/javascript" charset="utf-8"></script>
        <script src="../chosen_v1.8.7/docsupport/init.js" type="text/javascript" charset="utf-8"></script>
    </body>
</html>
