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


        <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>

        <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Crear Asignatura</title>
    </head>

    <body>

        <div class="container-fluid">
            <form action="libros.php" target="" method="post"> 

                <h3>Nuevo Libro</h3>
                <hr>
                <h4>Propiedades</h4>

                <div class="form-group col-8">
                    <h6>Tipo de Bibliograf&iacute;a</h6>
                    <div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input" id="defaultUnchecked" name="defaultExampleRadios">
                        <label class="custom-control-label" for="defaultUnchecked">Complementaria</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input" id="defaultChecked" name="defaultExampleRadios" checked>
                        <label class="custom-control-label" for="defaultChecked">Obligatoria</label>
                    </div>
                </div> 

                <div class="form-group col-8">
                    <label for="inputReferencia">Referencia</label>
                    <input type="text" name="referencia" class="form-control" id="inputReferencia" required="">
                </div>

                <div class="form-group col-8">
                    <label for="inputApellido">Apellido/s de Autor/es</label>
                    <input type="text" name="apellido" class="form-control" id="inputApellido" required="">
                </div>

                <div class="form-group col-8">
                    <label for="inputNombre">Nombre/s de Autor/es</label>
                    <input type="text" name="nombre" class="form-control" id="inputNombre" required="">
                </div>

                <div class="form-group col-8">
                    <label for="inputAnioEdicion">A&ntilde;o de Edic&oacute;n</label>
                    <input type="number" name="anioEdicion" class="form-control" id="inputAnioEdicion" required="">
                </div>

                <div class="form-group col-8">
                    <label for="inputTitulo">T&iacute;tulo</label>
                    <input type="text" name="titulo" class="form-control" id="inputTitulo" required="">
                </div>

                <div class="form-group col-8">
                    <label for="inputCapitulo">Cap&iacute;tulo, Tomo o P&aacute;gina</label>
                    <input type="text" name="capitulo" class="form-control" id="inputCapitulo" required="">
                </div>

                <div class="form-group col-8">
                    <label for="inputLugarEdicion">Lugar de Edici&oacute;n</label>
                    <input type="text" name="lugarEdicion" class="form-control" id="inputLugarEdicion" required="">
                </div>

                <div class="form-group col-8">
                    <label for="inputEditorial">Editorial</label>
                    <input type="text" name="editorial" class="form-control" id="inputEditorial" required="">
                </div>

                <div class="form-group col-8">
                    <label for="inputUnidad">Unidad</label>
                    <input type="text" name="unidad" class="form-control" id="inputUnidad" required="">
                </div>

                <div class="form-inline"> 
                    <div class="form-group col-8">
                        <div>
                            <h6>Biblioteca UA</h6>
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="E" name="defaultExampleRadios">
                                <label class="custom-control-label" for="E">Default unchecked</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="F" name="defaultExampleRadios" checked>
                                <label class="custom-control-label" for="F">Default checked</label>
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-1"></div>
                        <div>
                            <h6>SIUNPA</h6>
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="C" name="defaultExampleRadios">
                                <label class="custom-control-label" for="C">DSi</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="D" name="defaultExampleRadios" checked>
                                <label class="custom-control-label" for="D">nod</label>
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-1"></div>
                        <div>
                            <h6>Otro</h6>
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="a" name="defaultExampleRadios">
                                <label class="custom-control-label" for="a">DSi</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="b" name="defaultExampleRadios">
                                <label class="custom-control-label" for="b">No</label>
                            </div>
                        </div>
                    </div>
                </div>
       
          <div class="form-group col-12">
              <button  type="submit" class="btn btn-outline-success">
                <span class="oi oi-check"></span> Confirmar
            </button>
            <a href="#">
                <button type="reset" class="btn btn-outline-danger">
                    <span class="oi oi-x"></span> Limpiar
                </button>
            </a>
        </div>
    </form>
</div>





</body>
</html>
