<?php
include_once '../lib/Constantes.Class.php';
include_once '../modeloSistema/Asignatura.Class.php';
$id = $_GET["id"];
$Asignatura = new Asignatura($id);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.min.css">
        <script src="../lib/JQuery/jquery-3.3.1.js"></script>
        <script src="../lib/bootstrap-4.1.1-dist/js/bootstrap.bundle.js"></script>
        <style type="text/css">
            #regiration_form fieldset:not(:first-of-type) {
                display: none;
            }
        </style>
        <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Crear Programa</title>
    </head>
    <body>
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h3>Crear Programa de <?= $Asignatura->getNombre(); ?></h3>
                    <p>
                        Complete los campos a continuaci&oacute;n. 
                        Luego, presione el bot&oacute;n <b>Siguiente</b> para pasar a la siguiente secci&oacute;n.<br />
                        Si desea cancelar, presione el bot&oacute;n <b>Cancelar</b>.
                    </p>
                </div>


                <div class="card-body">
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <hr>
                    <form id="regiration_form" novalidate action="programa.crear.procesar.php"  method="post">
                        <fieldset>
                            <h2>Paso 1 - Datos B&aacute;sicos de la Asignatura</h2> 
                            <a href="#"><input type="button"  class="btn btn-outline-primary" value="Cargar Datos de &Uacute;ltimo Programa" /></a>
<!--                            TODO: Implementar método que cargue datos del último prograa-->
                            <hr>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-3 col-lg-4">
                                        <label for="inputAnio">A&ntilde;o del Programa</label>
                                        <input type="number" name="anio" class="form-control" id="inputAnio" required="">
                                    </div>

                                    <div class="col-md-3 col-lg-4">
                                        <label for="inputAnioCarrera">A&ntilde;o de la Carrera</label>
                                        <select name="anioCarrera" class="form-control" id="inputAnioCarrera">
                                            <option value="1">1er A&ntilde;o</option>
                                            <option value="2">2do A&ntilde;o</option>
                                            <option value="3">3er A&ntilde;o</option>
                                            <option value="4">4to A&ntilde;o</option>
                                            <option value="5">5to A&ntilde;o</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-3 col-lg-4">
                                        <label for="inputHorasTeoria">Horas semanalas de Teor&iacute;a</label>
                                        <input type="number" name="horasTeoria" class="form-control" id="inputHorasTeoria" required="">
                                    </div>

                                    <div class="col-md-3 col-lg-4">
                                        <label for="inputHorasPractica">Horas semanalas de Pr&aacute;ctica</label>
                                        <input type="number" name="horasPractica" class="form-control" id="inputHorasPractica" required="">
                                    </div>

                                    <div class="col-md-3 col-lg-4">
                                        <label for="inputHorasOtros">Otras horas semanales</label>
                                        <input type="number" name="horasOtros" class="form-control" id="inputHorasOtros" required="">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-3 col-lg-4">
                                        <label for="inputRegimen">Regimen cursada</label>
                                        <select name="regimenCursada" class="form-control" id="inputRegimen">
                                            <option value="1">Primer Cuatrimestre</option>
                                            <option value="2">Segundo Cuatrimestre</option>
                                            <option value="A">Anual</option>
                                            <option value="O">Otro</option>
                                        </select>
                                    </div>

                                    <div class="col-md-3 col-lg-4">
                                        <label for="inputObservacionesHoras">Obs horas</label>
                                        <input type="text" name="observacionesHoras" class="form-control" id="inputObservacionesHoras">
                                    </div>

                                    <div class="col-md-3 col-lg-4">
                                        <label for="inputObservacionesCursada">Obs cursada</label>
                                        <input type="text" name="observacionesCursada" class="form-control" id="inputObservacionesCursada">
                                    </div>
                                </div>
                            </div>


                            <input type="button" name="data[password]" class="next btn btn-info" value="Siguiente" />
                        </fieldset>


                        <fieldset>
                            <h2>Paso 2 - Informaci&oacute;n de la Asignatura</h2>

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

                            <input type="button" name="previous" class="previous btn btn-default" value="Anterior" />
                            <input type="button" name="next" class="next btn btn-info" value="Siguiente" />
                        </fieldset>

                        <fieldset>
                            <h2>Paso 4 - Metodolog&iacute;a, Regularizaci&oacute;n y Aprobaci&oacute;n Presencial</h2>
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


                            <input type="button" name="previous" class="previous btn btn-default" value="Anterior" />
                            <input type="button" name="next" class="next btn btn-info" value="Siguiente" />

                        </fieldset>

                        <fieldset>
                            <h2>Paso 5 - Metodolog&iacute;a, Regularizaci&oacute;n y Aprobaci&oacute;n SATEP</h2>

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
                            <input type="button" name="previous" class="previous btn btn-default" value="Anterior" />
                            <input type="button" name="next" class="next btn btn-info" value="Siguiente" />
                        </fieldset>
                        <fieldset>
                            <h2>Paso 6 - Metodolog&iacute;a y Aprobaci&oacute;n Libre</h2>
                            <div class="form-group">
                                <label for="textAreaMetodologiaLibre">Metodologia Libre</label>
                                <textarea name="metodologiaLibre" class="form-control" id="textAreaMetodologiaLibre" required=""></textarea>
                            </div>

                            <div class="form-group">
                                <label for="textAreaAprobacionLibre">Aprobacion Libre</label>
                                <textarea name="aprobacionLibre" class="form-control" id="textAreaAprobacionLibre" required=""></textarea>
                            </div>

                            <input type="hidden" name="codAsignatura" value="<?= $Asignatura->getId(); ?>">



                            <input type="button" name="previous" class="previous btn btn-default" value="Anterior" />
                            <input type="submit" name="submit" class="submit btn btn-info" value="Guardar" id="submit_data" />
                            <input type="submit" name="submit2" class="submit btn btn-success" value="Guardar y Enviar" onclick=this.form.action="prueba.php">
                        </fieldset>
                    </form>
                </div>
            </div>
    </body>
</html>
<script type="text/javascript">
    $(document).ready(function () {
        var current = 1, current_step, next_step, steps;
        steps = $("fieldset").length;
        $(".next").click(function () {
            current_step = $(this).parent();
            next_step = $(this).parent().next();
            next_step.show();
            current_step.hide();
            setProgressBar(++current);
        });
        $(".previous").click(function () {
            current_step = $(this).parent();
            next_step = $(this).parent().prev();
            next_step.show();
            current_step.hide();
            setProgressBar(--current);
        });
        setProgressBar(current);
        // Change progress bar action
        function setProgressBar(curStep) {
            var percent = parseFloat(100 / steps) * curStep;
            percent = percent.toFixed();
            $(".progress-bar")
                    .css("width", percent + "%")
                    .html(percent + "%");
        }
    });
</script>