<?php
include_once '../lib/ControlAcceso.Class.php';
include_once '../controlSistema/ManejadorDepartamento.php';
$ManejadorDepartamento= new ManejadorDepartamento();
$Departamentos = $ManejadorDepartamento->getColeccion();
?>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
        <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../lib/js/soloTexto.js"></script>
        <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Crear Profesor</title>
    </head>
    <body>
        <?php include_once '../gui/navbar.php'; ?>
        <div class="container">
            <form action="profesor.crear.procesar.php" method="post"> 
                <div class="card">
                    <div class="card-header">
                        <h3>Alta de Profesor</h3>
                        <p>
                            Complete los campos a continuaci&oacute;n. 
                            Luego, presione el bot&oacute;n <b>Confirmar</b>.<br />
                            Si desea cancelar, presione el bot&oacute;n <b>Cancelar</b>.
                        </p>
                    </div>
                    <div class="card-body">
                        <h4>Datos personales del profesor</h4>
                        
                        <div class="form-group">
                           <label for="inputApellidoProfesor">Apellido</label>
                            <input type="text" name="apellido" class="form-control" id="inputApellidoProfesor" placeholder="Ingrese el Apellido del Profesor" required="" autofocus 
                                   pattern="[A-Za-zñÑáéíóúáéíóúÁÉÍÓÚ']{2,}([A-Za-zñÑáéíóúáéíóúÁÉÍÓÚ']{2,}| [A-Za-zñÑáéíóúáéíóúÁÉÍÓÚ']{2,})*" 
                                  title="Escriba el apellido, en caso de tener más de uno, escribirlos separados mediante un espacio" onkeypress="return Solo_Texto(event);">
                        </div>
                        
                        <div class="form-group">
                           <label for="inputNombreProfesor">Nombre</label> 
                           <input type="text" name="nombre" class="form-control" id="inputNombreProfesor" placeholder="Ingrese el Nombre del Profesor" required="" 
                                  pattern="[A-Za-zñÑáéíóúáéíóúÁÉÍÓÚ']{2,}([A-Za-zñÑáéíóúáéíóúÁÉÍÓÚ']{2,}| [A-Za-zñÑáéíóúáéíóúÁÉÍÓÚ']{2,})*" 
                                  title="Escriba el nombre, en caso de tener más de uno, escribirlos separados mediante un espacio" onkeypress="return Solo_Texto(event);">
                        </div>
                        
                        <div class="form-group">
                           <label for="inputEmailProfesor">Email</label>
                           <input type="email" name="email" class="form-control" id="inputEmailProfesor" placeholder="Ingrese el Email del Profesor" pattern="^[a-z]+@uarg.unpa.edu.ar$" title="nombreusuario@uarg.unpa.edu.ar" required="">
                        </div>
                        
                        <div class="form-group">
                            <label for="selectDepartamento">Departamento</label>
                            <select class="form-control" id="selectDepartamento" name="idDepartamento" >
                                <?php foreach ($Departamentos as $Departamento) { ?>
                                    <option value="<?= $Departamento->getId(); ?>"><?= $Departamento->getNombre(); ?></option>
                                <?php } ?> </select>
                        </div>
                        <div>
<!--                            <input type="hidden" name="id" value="NULL">-->
                            <input type="hidden" name="categoria" value="cat1">
                            <!--<input type="hidden" name="preferencias" value="pref1">-->
                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-outline-success">
                            <span class="oi oi-check"></span> Confirmar
                        </button>
                        <a href="profesores.php">
                            <button type="button" class="btn btn-outline-danger">
                                <span class="oi oi-x"></span> Cancelar
                            </button>
                        </a>
                    </div>
                </div>
            </form>

        </div>
        <?php include_once '../gui/footer.php'; ?>
    </body>
</html>
