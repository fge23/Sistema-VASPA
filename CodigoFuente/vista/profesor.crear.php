<?php
include_once '../lib/ControlAcceso.Class.php';
include_once '../controlSistema/ManejadorDepartamento.php';
$ManejadorDepartamento= new ManejadorDepartamento();
$Departamentos = $ManejadorDepartamento->getColeccion();

// Comprobamos si estan definidas las variables de sesión, estan se setean cuando se quiere dar de alta un 
// Profesor desde la pantalla de Usuarios
if (isset($_SESSION["usuarioNombre"]) && isset($_SESSION["usuarioEmail"]) && isset($_SESSION["usuarioRol"])){
    $seteado = TRUE;
    $nombreUsuario = $_SESSION["usuarioNombre"];
    $emailUsuario = $_SESSION["usuarioEmail"];
    $rolUsuario = $_SESSION["usuarioRol"];
    
    // destruimos las variable de sesion
    unset($_SESSION["usuarioNombre"]);
    unset($_SESSION["usuarioEmail"]);
    unset($_SESSION["usuarioRol"]);

} else {
    $seteado = FALSE;
}

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
                        <?php if ($seteado) {?>
                            <div class="alert alert-info alert-dismissible fade show text-center" role="alert">
                                Como elegiste profesor, es redirigido al alta de profesor, para completar los datos.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php } ?>
                        <p>
                            Complete los campos a continuaci&oacute;n. 
                            Luego, presione el bot&oacute;n <b>Confirmar</b>.<br />
                            Si desea cancelar, presione el bot&oacute;n <b>Cancelar</b>.
                        </p>
                    </div>
                    <div class="card-body">
                        <h4>Datos personales del profesor</h4>
                        
                        <?php if ($seteado){?>
                           <div class="form-group">
                                <label for="inputNombreUsuario">Nombre de Usuario</label> 
                                <input type="text" name="nombreUsuario" class="form-control" id="inputNombreUsuario" placeholder="Ingrese el Nombre de Usuario del Profesor" required="" value="<?= $nombreUsuario; ?>">
                            </div>
                        <?php } ?>
                                                
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
                           <?php if ($seteado){?>
                           <input type="email" name="email" class="form-control" value="<?= $emailUsuario; ?>" id="inputEmailProfesor" placeholder="Ingrese el Email del Profesor" pattern="^[a-z]+@uarg.unpa.edu.ar$" title="nombreusuario@uarg.unpa.edu.ar" required="">
                           <?php } else { ?>
                           <input type="email" name="email" class="form-control" id="inputEmailProfesor" placeholder="Ingrese el Email del Profesor" pattern="^[a-z]+@uarg.unpa.edu.ar$" title="nombreusuario@uarg.unpa.edu.ar" required="">
                           <?php } ?>
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
                                                
                        <div class="form-group">
                            <label>¿Es Responsable de Asignatura?</label>
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="esResponsableSI" value="SI" name="esResponsable" required="">
                                <label class="custom-control-label" for="esResponsableSI">Si</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="esResponsableNO" value="NO" name="esResponsable">
                                <label class="custom-control-label" for="esResponsableNO">No</label>
                            </div>
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
