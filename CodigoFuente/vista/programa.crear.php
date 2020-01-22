<?php
include_once '../lib/ControlAcceso.Class.php';
include_once '../modeloSistema/Asignatura.Class.php';

$idAsignatura = $_GET["id"];
$Asignatura = new Asignatura($idAsignatura);
?>
<!DOCTYPE html>
<!--Se deben agregar validaciones para evitar que vayan vacios los campos que deberían tener datos-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../lib/open-iconic-master/font/css/open-iconic-bootstrap.css" />
        <script src="../lib/JQuery/jquery-3.3.1.js"></script>
        <script src="../lib/bootstrap-4.1.1-dist/js/bootstrap.bundle.js"></script>
        <link rel="stylesheet" href="../lib/bootstrap-4.1.1-dist/css/bootstrap.css" />
        <!--         Librerias Summernote-->
        <link href="../lib/summernote-master/dist/summernote-bs4.css" rel="stylesheet">
        <script src="../lib/summernote-master/dist/summernote-bs4.js"></script>
        <script src="../lib/summernote-master/lang/summernote-es-ES.js"></script>

        <style type="text/css">
            #regiration_form fieldset:not(:first-of-type) {
                display: none;
            }
        </style>
        <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Crear Programa</title>
    </head>
    <body>
        <?php include_once '../gui/navbar.php'; ?>

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
                            <a href="programa.crear.datosUltimoPrograma.php?id=<?= $Asignatura->getId(); ?>"><input type="button"  class="btn btn-outline-primary" value="Cargar Datos de &Uacute;ltimo Programa" onclick="cargarDatosUltimoPrograma()"/></a>
                            <hr>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-3 col-lg-4">
                                        <label for="inputAnio">A&ntilde;o del Programa</label>
                                        <input type="number" name="anio" class="form-control" id="inputAnio" required="" value="<?= date("Y"); ?>">
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

                                    <div class="col-md-3 col-lg-4">
                                        <label for="inputVigencia">Vigencia</label>
                                        <select name="vigencia" class="form-control" id="inputVigencia">
                                            <option value="1">Solo este año</option>
                                            <option value="2">2 a&ntilde;os</option>
                                            <option value="3">3 a&ntilde;os</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-3 col-lg-4">
                                        <label for="inputHorasTeoria">Horas semanales de Teor&iacute;a</label>
                                        <input onkeyup="sumar();"type="time" name="horasTeoria" class="form-control" id="inputHorasTeoria" required value="00:00">
                                    </div>

                                    <div class="col-md-3 col-lg-4">
                                        <label for="inputHorasPractica">Horas semanales de Pr&aacute;ctica</label>
                                        <input onkeyup="sumar();" type="time" name="horasPractica" class="form-control" id="inputHorasPractica" required value="00:00">
                                    </div>

                                    <div class="col-md-3 col-lg-4">
                                        <label for="inputHorasOtros">Otras horas semanales</label><small> - Opcional</small> 
                                        <input type="time" name="horasOtros" class="form-control" id="inputHorasOtros" required value="00:00">
                                    </div>
                                </div>
                            </div>
                            <b><p class="cantidadTotalHoras">
                                    La suma total de horas semanales es: 
                                </p></b>

                            <br>


                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-3 col-lg-4">
                                        <label for="inputRegimen">R&eacute;gimen cursada</label>
                                        <select name="regimenCursada" class="form-control" id="inputRegimen">
                                            <option value="1">Primer Cuatrimestre</option>
                                            <option value="2">Segundo Cuatrimestre</option>
                                            <option value="A">Anual</option>
                                            <option value="O">Otro</option>
                                        </select>
                                    </div>

                                    <div class="col-md-3 col-lg-4">
                                        <label for="inputObservacionesHoras">Observaciones horas</label><small> - Opcional</small> 
                                        <input type="text" name="observacionesHoras" class="form-control" id="inputObservacionesHoras">
                                    </div>

                                    <div class="col-md-3 col-lg-4">
                                        <label for="inputObservacionesCursada">Observaciones cursada</label><small> - Opcional</small> 
                                        <input type="text" name="observacionesCursada" class="form-control" id="inputObservacionesCursada">
                                    </div>
                                </div>
                            </div>

                            <input type="button" name="data[password]" disabled id="btnSiguiente" class="next btn btn-info" value="Siguiente" />
                        </fieldset>

                        <fieldset>
                            <h2>Paso 2 - Informaci&oacute;n de la Asignatura</h2>

                            <div class="form-group">
                                <label for="textAreaContenidosMinimos">Contenidos M&iacute;nimos</label>
                                <textarea readonly class="form-control" id="textAreaContenidosMinimos" name="contenidosMinomos">
                                    <?= $Asignatura->getContenidosMinimos() ?>
                                </textarea> 
                            </div>

                            <div class="form-group">
                                <label for="textAreaFundamentacion">Fundamentaci&oacute;n</label>
                                <textarea class="summernote" id="textAreaFundamentacion" name="fundamentacion">   </textarea> 
                            </div>


                            <div class="form-group">
                                <label for="textAreaObjetivosGenerales">Objetivos Generales</label>
                                <textarea class="summernote" name="objetivosGenerales" required=""></textarea>
                            </div>

                            <div class="form-group">
                                <label for="textAreaOrganizacionContenidos">Organizaci&oacute;n de los Contenidos - Programa Anal&iacute;tico</label>
                                <textarea name="organizacionContenidos" class="summernote" id="textAreaOrganizacionContenidos" required=""></textarea>
                            </div>


                            <div class="form-group">
                                <label for="textAreaCriteriosEvaluacion">Criterios de evaluaci&oacute;n</label>
                                <textarea name="criteriosEvaluacion" class="summernote" id="textAreaCriteriosEvaluacion" required=""></textarea>
                            </div>

                            <input type="button" name="previous" class="previous btn btn-default" value="Anterior" />
                            <input type="button" name="next" class="next btn btn-info" value="Siguiente" />
                        </fieldset>

                        <fieldset>
                            <h2>Paso 3 - Metodolog&iacute;a, Regularizaci&oacute;n y Aprobaci&oacute;n Presencial</h2>
                            <div class="form-group">
                                <label for="textAreaMetodologiaPresencial">Metodolog&iacute;a Presencial</label>
                                <textarea name="metodologiaPresencial" class="summernote" id="textAreaMetodologiaPresencial" required=""></textarea>
                            </div>

                            <div class="form-group">
                                <label for="textAreaRegularizacionPresencial">Regularizaci&oacute;n Presencial</label>
                                <textarea name="regularizacionPresencial" class="summernote" id="textAreaRegularizacionPresencial" required=""></textarea>
                            </div>

                            <div class="form-group">
                                <label for="textAreaAprobacionPresencial">Aprobaci&oacute;n Presencial</label>
                                <textarea name="aprobacionPresencial" class="summernote" id="textAreaAprobacionPresencial" required=""></textarea>
                            </div>


                            <input type="button" name="previous" class="previous btn btn-default" value="Anterior" />
                            <input type="button" name="next" class="next btn btn-info" value="Siguiente" />

                        </fieldset>

                        <fieldset>
                            <h2>Paso 4 - Metodolog&iacute;a, Regularizaci&oacute;n y Aprobaci&oacute;n SATEP</h2>

                            <div class="form-group">
                                <label for="textAreaMetodologiaSATEP">Metodolog&iacute;a SATEP</label>
                                <textarea name="metodologiaSATEP" class="summernote" id="textAreaMetodologiaSATEP" required=""></textarea>
                            </div>

                            <div class="form-group">
                                <label for="textAreaRegularizacionSATEP">Regularizaci&oacute;n SATEP</label>
                                <textarea name="regularizacionSATEP" class="summernote" id="textAreaRegularizacionSATEP" required=""></textarea>
                            </div>

                            <div class="form-group">
                                <label for="textAreaAprobacionSATEP">Aprobaci&oacute;n SATEP</label>
                                <textarea name="aprobacionSATEP" class="summernote" id="textAreaAprobacionSATEP" required=""></textarea>
                            </div>
                            <input type="button" name="previous" class="previous btn btn-default" value="Anterior" />
                            <input type="button" name="next" class="next btn btn-info" value="Siguiente" />
                        </fieldset>
                        <fieldset>
                            <h2>Paso 5 - Metodolog&iacute;a y Aprobaci&oacute;n Libre</h2>
                            <div class="form-group">
                                <label for="textAreaMetodologiaLibre">Metodolog&iacute;a Libre</label>
                                <textarea name="metodologiaLibre" class="summernote" id="textAreaMetodologiaLibre" required=""></textarea>
                            </div>

                            <div class="form-group">
                                <label for="textAreaAprobacionLibre">Aprobaci&oacute;n Libre</label>
                                <textarea name="aprobacionLibre" class="summernote" id="textAreaAprobacionLibre" required=""></textarea>
                            </div>
                            <input type="hidden" name="fechaCarga" value="<?= getdate()['year'].'-'.  getdate()['mon'].'-'.getdate()['mday']; ?>">
                            <input type="hidden" name="idAsignatura" value="<?= $Asignatura->getId(); ?>">
                            <input type="button" name="previous" class="previous btn btn-default" value="Anterior" />
                            <input type="submit" name="submit" class="submit btn btn-info" value="Guardar" id="submit_data" />
                            <input type="submit" name="submit2" class="submit btn btn-success" value="Guardar y Enviar" onclick=this.form.action = "prueba.php">
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
        <?php include_once '../gui/footer.php'; ?>
    </body>
    <script type="text/javascript">
        /**
         * Suma los valores de los cuadros de texto y vaida que las horas semanales coincidan con el plan
         */
        function sumar()
        {
            var horasTeoria = document.getElementById("inputHorasTeoria").value + ":00";
            var horasPractica = document.getElementById("inputHorasPractica").value + ":00";
            var hour = 0;
            var minute = 0;
            var horasTotales = 0
            var splitTime1 = horasTeoria.split(':');
            var splitTime2 = horasPractica.split(':');


            hour = parseInt(splitTime1[0]) + parseInt(splitTime2[0]);
            minute = parseInt(splitTime1[1]) + parseInt(splitTime2[1]);
            hour = hour + minute / 60;
            minute = minute % 60;
            horasTotales = Math.floor(hour);
            console.log("Cantidad de horas " + horasTotales);

            if (!isNaN(horasTotales)) {
                document.getElementsByClassName('cantidadTotalHoras')[0].textContent = "La suma total de horas semanales es: " + Math.floor(hour);
                if (<?= $Asignatura->getHorasSemanales() ?> != Math.floor(hour)) {
                    console.log("La cantidad de horas de cursada son DIFERENTES a las de la Asignatura");
                    document.getElementsByClassName('cantidadTotalHoras')[0].textContent += "\nLa cantidad de horas semanales debe ser igual a las definidas en el Plan de la Carrera";
                    document.getElementById("btnSiguiente").disabled = true;
                } else {
                    document.getElementsByClassName('cantidadTotalHoras')[0].textContent += "\nLa cantidad de horas semanales es igual a las definidas en el Plan de la Carrera";
                    document.getElementById("btnSiguiente").disabled = false;
                }
            }
        }
    </script>

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
    <script>
        $(document).ready(function () {
            $('.summernote').summernote({
                lang: 'es-ES',
                toolbar: [
                    ['style', ['bold', 'italic', 'underline']],
                    ['para', ['ul', 'ol', 'paragraph']]
                ]
            });
        });
    </script>
<!--    Se debe desarrollar una funcionalidad que valide que no haya campos vacíos -->
      <script>
      function validaCampos() {
            
        
        }
    </script>
</html>


