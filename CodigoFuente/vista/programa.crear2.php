<?php
include_once '../lib/Constantes.Class.php';
?>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
        <script type="text/javascript" src="../lib/JQuery/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="../lib/bootstrap-4.1.1-dist/js/bootstrap.min.js"></script>
        <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Crear Programa</title>
    </head>
    <body>
        <?php // include_once '../gui/navbar.php'; ?>
        <div class="container">
            <form action="programa.crear.procesar.php" method="post"> 
                <div class="card">
                    <div class="card-header">
                        <h3>Crear Programa</h3>
                        <p>
                            Complete los campos a continuaci&oacute;n. 
                            Luego, presione el bot&oacute;n <b>Confirmar</b>.<br />
                            Si desea cancelar, presione el bot&oacute;n <b>Cancelar</b>.
                        </p>
                    </div>
                    <div class="card-body">
                        <h4>Propiedades</h4>

                        <div class="form-group">
                            <label for="inputAnio">A&ntilde;o</label>
                            <input type="number" name="anio" class="form-control" id="inputAnio" required="">
                        </div>

                        <div class="form-group">
                            <label for="inputAnioCarrera">A&ntilde;o de la Carrera</label>
                            <input type="number" name="anioCarrera" class="form-control" id="inputAnioCarrera" required="">
                        </div>


                        <div class="form-group">
                            <label for="inputHorasTeoria">Horas semanalas de Teor&iacute;a</label>
                            <input type="number" name="horasTeoria" class="form-control" id="inputHorasTeoria" required="">
                        </div>

                        <div class="form-group">
                            <label for="inputHorasPractica">Horas semanalas de Pr&aacute;ctica</label>
                            <input type="number" name="horasPractica" class="form-control" id="inputHorasPractica" required="">
                        </div>
                        
                        <div class="form-group">
                            <label for="inputHorasOtros">Otras horas semanales</label>
                            <input type="number" name="horasOtros" class="form-control" id="inputHorasOtros" required="">
                        </div>


                        <div class="form-group">
                            <label for="inputRegimen">Regimen cursada</label>
                            <input type="text" name="regimenCursada" class="form-control" id="inputRegimen" required="">
                        </div>

                        <div class="form-group">
                            <label for="inputObservacionesHoras">Obs horas</label>
                            <input type="text" name="observacionesHoras" class="form-control" id="inputObservacionesHoras" required="">
                        </div>
                        
                        <div class="form-group">
                            <label for="inputObservacionesCursada">Obs cursada</label>
                            <input type="text" name="observacionesCursada" class="form-control" id="inputObservacionesCursada" required="">
                        </div>
                        
                        

                        <div class="form-group">
                            <label for="textAreaDocentesTeoria">Docentes Teoria</label>
                            <textarea name="docentesTeoria" class="form-control" id="textAreaDocentesTeoria" required=""></textarea>
                        </div>

                        <div class="form-group">
                            <label for="textAreaDocentesPractica">Docentes Practica</label>
                            <textarea name="docentesPractica" class="form-control" id="textAreaDocentesPractica" required=""></textarea>
                        </div>




                        <div class="form-group">
                            <label for="textAreaFundamentacion">Fundamentacion</label>
                            <textarea name="fundamentacion" class="form-control" id="textAreaFundamentacion" required=""></textarea>
                        </div>

                        <div class="form-group">
                            <label for="textAreaObjetivosGenerales">Objetivos Generales</label>
                            <textarea name="objetivosGenerales" class="form-control" id="textAreaObjetivosGenerales" required=""></textarea>
                        </div>

                        <div class="form-group">
                            <label for="textAreaOrganizacionContenidos">Organizacion Contenidos</label>
                            <textarea name="organizacionContenidos" class="form-control" id="textAreaOrganizacionContenidos" required=""></textarea>
                        </div>


                        <div class="form-group">
                            <label for="textAreaCriteriosEvaluacion">Criterios evaluacion</label>
                            <textarea name="criteriosEvaluacion" class="form-control" id="textAreaCriteriosEvaluacion" required=""></textarea>
                        </div>



                        <div class="form-group">
                            <label for="textAreaMetodologiaPresencial">Metodologia Presencial</label>
                            <textarea name="metodologiaPresencial" class="form-control" id="textAreaMetodologiaPresencial" required=""></textarea>
                        </div>

                        <div class="form-group">
                            <label for="textAreaRegularizacionPresencial">Regularizacion Presencial</label>
                            <textarea name="regularizacionPresencial" class="form-control" id="textAreaRegularizacionPresencial" required=""></textarea>
                        </div>

                        <div class="form-group">
                            <label for="textAreaAprobacionPresencial">Aprobacion Presencial</label>
                            <textarea name="aprobacionPresencial" class="form-control" id="textAreaAprobacionPresencial" required=""></textarea>
                        </div>

                        <div class="form-group">
                            <label for="textAreaMetodologiaSATEP">Metodologia SATEP</label>
                            <textarea name="metodologiaSATEP" class="form-control" id="textAreaMetodologiaSATEP" required=""></textarea>
                        </div>

                        <div class="form-group">
                            <label for="textAreaRegularizacionSATEP">Regularizacion SATEP</label>
                            <textarea name="regularizacionSATEP" class="form-control" id="textAreaRegularizacionSATEP" required=""></textarea>
                        </div>

                        <div class="form-group">
                            <label for="textAreaAprobacionSATEP">Aprobacion SATEP</label>
                            <textarea name="aprobacionSATEP" class="form-control" id="textAreaAprobacionSATEP" required=""></textarea>
                        </div>


                        <div class="form-group">
                            <label for="textAreaMetodologiaLibre">Metodologia Libre</label>
                            <textarea name="metodologiaLibre" class="form-control" id="textAreaMetodologiaLibre" required=""></textarea>
                        </div>
                        
                          <div class="form-group">
                            <label for="textAreaAprobacionLibre">Aprobacion Libre</label>
                            <textarea name="aprobacionLibre" class="form-control" id="textAreaAprobacionLibre" required=""></textarea>
                        </div>


                    </div>


                    <div class="card-footer">
                        <button type="submit" class="btn btn-outline-success">
                            <span class="oi oi-check"></span> Confirmar
                        </button>
                        <a href="programas.php">
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
