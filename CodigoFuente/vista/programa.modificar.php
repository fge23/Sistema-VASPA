<?php
include_once '../lib/ControlAcceso.Class.php';
include_once '../modeloSistema/Asignatura.Class.php';
include_once '../controlSistema/ManejadorPrograma.php';

$anioActual = date("Y");
$idAsignatura = $_GET["id"];
$Asignatura = new Asignatura($idAsignatura);
$cantidadHorasSemanales = $Asignatura->getHorasSemanales();
$ManejadorPrograma = new ManejadorPrograma();
$idProgramaActual = $ManejadorPrograma->getIDProgramaActual($anioActual, $idAsignatura);

$Programa = new Programa($idProgramaActual);
?>
<!DOCTYPE html>
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
        <!--         Librerias Bootbox-->
        <script src="../lib/bootbox/bootbox.js"></script>
        <script src="../lib/bootbox/bootbox.locales.js"></script>
        <style type="text/css">
            #regiration_form fieldset:not(:first-of-type) {
                display: none;
            }
        </style>
        <title><?php echo Constantes::NOMBRE_SISTEMA; ?> - Modificar Programa</title>
    </head>
    <body>
        <?php include_once '../gui/navbar.php'; ?>

        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h3>Modificar Programa de <?= $Asignatura->getNombre(); ?></h3>
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
                    <form id="regiration_form" novalidate action="programa.modificar.procesar.php"  method="post">
                        <fieldset>
                            <h2>Paso 1 - Datos B&aacute;sicos de la Asignatura</h2> 
                            <hr>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-3 col-lg-4">
                                        <label for="inputAnio">A&ntilde;o del Programa</label>
                                        <input type="number" name="anio" class="form-control" id="inputAnio" required readonly value="<?= $anioActual; ?>">
                                    </div>

                                    <div class="col-md-3 col-lg-4">
                                        <label for="inputAnioCarrera">A&ntilde;o de la Carrera</label>
                                        <select name="anioCarrera" class="form-control" id="inputAnioCarrera">
                                            <option   
                                            <?php
                                            if ($Programa->getAnioCarrera() == 1) {
                                                echo "selected";
                                            }
                                            ?>
                                                value="1">1er A&ntilde;o</option>
                                            <option 
                                            <?php
                                            if ($Programa->getAnioCarrera() == 2) {
                                                echo "selected";
                                            }
                                            ?>  
                                                value="2">2do A&ntilde;o</option>
                                            <option
                                            <?php
                                            if ($Programa->getAnioCarrera() == 3) {
                                                echo "selected";
                                            }
                                            ?>  
                                                value="3">3er A&ntilde;o</option>
                                            <option 
                                            <?php
                                            if ($Programa->getAnioCarrera() == 4) {
                                                echo "selected";
                                            }
                                            ?>  
                                                value="4">4to A&ntilde;o</option>
                                            <option 
                                            <?php
                                            if ($Programa->getAnioCarrera() == 5) {
                                                echo "selected";
                                            }
                                            ?>   
                                                value="5">5to A&ntilde;o</option>
                                        </select>
                                    </div>

                                    <div class="col-md-3 col-lg-4">
                                        <label for="inputVigencia">Vigencia</label>
                                        <select name="vigencia" class="form-control" id="inputVigencia">
                                            <option 
                                            <?php
                                            if ($Programa->getVigencia() == 1) {
                                                echo "selected";
                                            }
                                            ?>  
                                                value="1">Solo este año</option>
                                            <option 
                                            <?php
                                            if ($Programa->getVigencia() == 2) {
                                                echo "selected";
                                            }
                                            ?>  
                                                value="2">2 a&ntilde;os</option>
                                            <option 
                                            <?php
                                            if ($Programa->getVigencia() == 3) {
                                                echo "selected";
                                            }
                                            ?>  
                                                value="3">3 a&ntilde;os</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-3 col-lg-4">
                                        <label for="inputHorasTeoria">Horas semanales de Teor&iacute;a</label>
                                        <input onkeyup="sumar();"type="time" name="horasTeoria" class="form-control" id="inputHorasTeoria" required="" value="<?= substr($Programa->getHorasTeoria(), 0, 5); ?>">
                                    </div>

                                    <div class="col-md-3 col-lg-4">
                                        <label for="inputHorasPractica">Horas semanales de Pr&aacute;ctica</label>
                                        <input onkeyup="sumar();" type="time" name="horasPractica" class="form-control" id="inputHorasPractica" required="" value="<?= substr($Programa->getHorasPractica(), 0, 5); ?>">
                                    </div>

                                    <div class="col-md-3 col-lg-4">
                                        <label for="inputHorasOtros">Otras horas semanales</label><small> - Opcional</small> 
                                        <input type="time" name="horasOtros" class="form-control" id="inputHorasOtros" required="" value="<?= substr($Programa->getHorasOtros(), 0, 5); ?>">
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

                                            <option
                                            <?php
                                            if ($Programa->getRegimenCursada() == 1) {
                                                echo "selected";
                                            }
                                            ?>  
                                                value="1">Primer Cuatrimestre</option>
                                            <option 
                                              <?php
                                            if ($Programa->getRegimenCursada() == 2) {
                                                echo "selected";
                                            }
                                            ?> 
                                                value="2">Segundo Cuatrimestre</option>
                                            <option 
                                                      <?php
                                            if ($Programa->getRegimenCursada() == 'A') {
                                                echo "selected";
                                            }
                                            ?> 
                                                value="A">Anual</option>
                                            <option value="O">Otro</option>
                                        </select>
                                    </div>

                                    <div class="col-md-3 col-lg-4">
                                        <label for="inputObservacionesHoras">Observaciones horas</label><small> - Opcional</small> 
                                        <input type="text" name="observacionesHoras" class="form-control" id="inputObservacionesHoras" value="<?= $Programa->getObservacionesHoras(); ?>">
                                    </div>

                                    <div class="col-md-3 col-lg-4">
                                        <label for="inputObservacionesCursada">Observaciones cursada</label><small> - Opcional</small> 
                                        <input type="text" name="observacionesCursada" class="form-control" id="inputObservacionesCursada" value="<?= $Programa->getObservacionesCursada(); ?>">
                                    </div>
                                </div>
                            </div>
                             <a href="asignaturasDeProfesor.php"><button type="button" class="btn btn-outline-danger">Cancelar</button></a>
                            <input type="button" name="data[password]" disabled id="btnSiguiente" class="next btn btn-outline-info" value="Siguiente" />
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
                                <textarea class="summernote" id="textAreaFundamentacion" name="fundamentacion"> <?= $Programa->getFundamentacion(); ?>  </textarea> 
                            </div>


                            <div class="form-group">
                                <label for="textAreaObjetivosGenerales">Objetivos Generales</label>
                                <textarea class="summernote" name="objetivosGenerales"  id="textAreaObjetivosGenerales"  required=""><?= $Programa->getObjetivosGenerales(); ?>  </textarea>
                            </div>

                            <div class="form-group">
                                <label for="textAreaOrganizacionContenidos">Organizaci&oacute;n de los Contenidos - Programa Anal&iacute;tico</label>
                                <textarea name="organizacionContenidos" class="summernote" id="textAreaOrganizacionContenidos" required="">
                                    <?= $Programa->getOrganizacionContenidos(); ?>  
                                </textarea>
                            </div>


                            <div class="form-group">
                                <label for="textAreaCriteriosEvaluacion">Criterios de evaluaci&oacute;n</label>
                                <textarea name="criteriosEvaluacion" class="summernote" id="textAreaCriteriosEvaluacion" required="">
                                    <?= $Programa->getCriteriosEvaluacion(); ?>  
                                </textarea>
                            </div>

                            <input type="button" name="previous" class="previous btn btn-default" value="Anterior" />
                            <input type="button" name="next" class="next btn btn-outline-info" value="Siguiente" />
                        </fieldset>

                        <fieldset>
                            <h2>Paso 3 - Metodolog&iacute;a, Regularizaci&oacute;n y Aprobaci&oacute;n Presencial</h2>
                            <div class="form-group">
                                <label for="textAreaMetodologiaPresencial">Metodolog&iacute;a Presencial</label>
                                <textarea name="metodologiaPresencial" class="summernote" id="textAreaMetodologiaPresencial" required="">
                                    <?= $Programa->getMetodologiaPresencial(); ?>  
                                </textarea>
                            </div>

                            <div class="form-group">
                                <label for="textAreaRegularizacionPresencial">Regularizaci&oacute;n Presencial</label>
                                <textarea name="regularizacionPresencial" class="summernote" id="textAreaRegularizacionPresencial" required=""> 
                                    <?= $Programa->getRegularizacionPresencial(); ?>  
                                </textarea>
                            </div>

                            <div class="form-group">
                                <label for="textAreaAprobacionPresencial">Aprobaci&oacute;n Presencial</label>
                                <textarea name="aprobacionPresencial" class="summernote" id="textAreaAprobacionPresencial" required="">
                                    <?= $Programa->getAprobacionPresencial(); ?>  
                                </textarea>
                            </div>


                            <input type="button" name="previous" class="previous btn btn-default" value="Anterior" />
                            <input type="button" name="next" class="next btn btn-outline-info" value="Siguiente" />

                        </fieldset>

                        <fieldset>
                            <h2>Paso 4 - Metodolog&iacute;a, Regularizaci&oacute;n y Aprobaci&oacute;n SATEP</h2>

                            <div class="form-group">
                                <label for="textAreaMetodologiaSATEP">Metodolog&iacute;a SATEP</label>
                                <textarea name="metodologiaSATEP" class="summernote" id="textAreaMetodologiaSATEP" required="">
                                    <?= $Programa->getMetodologiaSATEP(); ?>  
                                </textarea>
                            </div>

                            <div class="form-group">
                                <label for="textAreaRegularizacionSATEP">Regularizaci&oacute;n SATEP</label>
                                <textarea name="regularizacionSATEP" class="summernote" id="textAreaRegularizacionSATEP" required="">
                                    <?= $Programa->getRegularizacionSATEP(); ?>  
                                </textarea>
                            </div>

                            <div class="form-group">
                                <label for="textAreaAprobacionSATEP">Aprobaci&oacute;n SATEP</label>
                                <textarea name="aprobacionSATEP" class="summernote" id="textAreaAprobacionSATEP" required="">
                                    <?= $Programa->getAprobacionSATEP(); ?>  
                                </textarea>
                            </div>
                            <input type="button" name="previous" class="previous btn btn-default" value="Anterior" />
                            <input type="button" name="next" class="next btn btn-outline-info" value="Siguiente" />
                        </fieldset>
                        <fieldset>
                            <h2>Paso 5 - Metodolog&iacute;a y Aprobaci&oacute;n Libre</h2>
                            <div class="form-group">
                                <label for="textAreaMetodologiaLibre">Metodolog&iacute;a Libre</label>
                                <textarea name="metodologiaLibre" class="summernote" id="textAreaMetodologiaLibre" required="">
                                    <?= $Programa->getMetodologiaLibre(); ?>  
                                </textarea>
                            </div>

                            <div class="form-group">
                                <label for="textAreaAprobacionLibre">Aprobaci&oacute;n Libre</label>
                                <textarea name="aprobacionLibre" class="summernote" id="textAreaAprobacionLibre" required="">
                                    <?= $Programa->getAprobacionLibre(); ?>  
                                </textarea>
                            </div>
                            <input type="hidden" name="fechaCarga" value="<?= getdate()['year'] . '-' . getdate()['mon'] . '-' . getdate()['mday']; ?>">
                            <input type="hidden" name="idAsignatura" value="<?= $Asignatura->getId(); ?>">
                            <input type="hidden" name="idPrograma" value="<?= $idProgramaActual; ?>">
                            <input type="button" name="previous" class="previous btn btn-default" value="Anterior" />
                            <input type="submit" name="submit" class="submit btn btn-outline-success" value="Guardar" id="submit_data"/>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
        <?php include_once '../gui/footer.php'; ?>
    </body>
  
    <script type="text/javascript">
        $(document).ready(function () {
            sumar();
        });
    </script>
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
                document.getElementsByClassName('cantidadTotalHoras')[0].textContent = "La suma total de horas semanales es: " + Math.floor(hour) + ". ";
                if (<?= $cantidadHorasSemanales ?> != Math.floor(hour)) {
                    console.log("La cantidad de horas de cursada son DIFERENTES a las de la Asignatura");
                    document.getElementsByClassName('cantidadTotalHoras')[0].textContent += "\n\n La cantidad de horas semanales debe ser igual a las definidas en el Plan de la Carrera (<?= $cantidadHorasSemanales ?> horas).";
                    document.getElementById("btnSiguiente").disabled = true;
                } else {
                    document.getElementsByClassName('cantidadTotalHoras')[0].textContent += "\n\n La cantidad de horas semanales es igual a las definidas en el Plan de la Carrera.";
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
 
    <script>
        $('#regiration_form').on('submit', function (e) {
            var bandera = true;
            var camposFaltantes = "";

            //Año de programa
            if ($('#inputAnio').val().length == 0) {
                //alert("El campo 'Fundamentación' no puede estar en blanco");
                camposFaltantes += "<br><li>Año de Programa";
                bandera = false;
            }
            //Fundamentacion
            if ($('#textAreaFundamentacion').summernote('isEmpty')) {
                //alert("El campo 'Fundamentación' no puede estar en blanco");
                camposFaltantes += "<br><li>Fundamentación";
                bandera = false;
            }
            //Objetivos generales
            if ($('#textAreaObjetivosGenerales').summernote('isEmpty')) {
                //  alert("El campo 'Objetivos generales' no puede estar en blanco");
                camposFaltantes += "<br><li>Objetivos generales";
                bandera = false;
            }
            //Organizacion contenidos
            if ($('#textAreaOrganizacionContenidos').summernote('isEmpty')) {
                //alert("El campo 'Organización de Contenidos' no puede estar en blanco");
                camposFaltantes += "<br><li>Organización de Contenidos";
                bandera = false;
            }
            //Criterios de evaluacion
            if ($('#textAreaCriteriosEvaluacion').summernote('isEmpty')) {
                //  alert("El campo 'Criterios de evaluación' no puede estar en blanco");
                camposFaltantes += "<br><li>Criterios de evaluación";
                bandera = false;
            }
            //Metodologia presencial
            if ($('#textAreaMetodologiaPresencial').summernote('isEmpty')) {
                //  alert("El campo 'Metodología presencial' no puede estar en blanco");
                camposFaltantes += "<br><li>Metodología presencial";
                bandera = false;
            }
            //Regularizacion presencial
            if ($('#textAreaRegularizacionPresencial').summernote('isEmpty')) {
                //  alert("El campo 'Regularización presencial' no puede estar en blanco");
                camposFaltantes += "<br><li>Regularización presencial";
                bandera = false;
            }
            //Aprobación presencial
            if ($('#textAreaAprobacionPresencial').summernote('isEmpty')) {
                //alert("El campo 'Aprobación presencial' no puede estar en blanco");
                camposFaltantes += "<br><li>Aprobación presencial";
                bandera = false;
            }
            //Metodologia SATEP
            if ($('#textAreaMetodologiaSATEP').summernote('isEmpty')) {
                //  alert("El campo 'Metodología SATEP' no puede estar en blanco");
                camposFaltantes += "<br><li>Metodología SATEP";
                bandera = false;
            }
            //Regularizacion SATEP
            if ($('#textAreaRegularizacionSATEP').summernote('isEmpty')) {
                // alert("El campo 'Regularización SATEP' no puede estar en blanco");
                camposFaltantes += "<br><li>Regularización SATEP";
                bandera = false;
            }
            //Aprobación SATEP
            if ($('#textAreaAprobacionSATEP').summernote('isEmpty')) {
                //alert("El campo 'Aprobación SATEP' no puede estar en blanco");
                camposFaltantes += "<br><li>Aprobación SATEP";
                bandera = false;
            }
            //Metodologia libre
            if ($('#textAreaMetodologiaLibre').summernote('isEmpty')) {
                // alert("El campo 'Metodologia Libre' no puede estar en blanco");
                camposFaltantes += "<br><li>Metodologia Libre";
                bandera = false;
            }
            //Aprobacion libre
            if ($('#textAreaAprobacionLibre').summernote('isEmpty')) {
                // alert("El campo 'Aprobacion Libre' no puede estar en blanco");
                camposFaltantes += "<br><li>Aprobación Libre";
                bandera = false;
            }


            if (bandera === true) {
                $("#regiration_form").submit();
            } else {
                e.preventDefault();
                bootbox.alert("Faltan completar los siguientes campos: <br>" + camposFaltantes);
                camposFaltantes = " ";
            }
        });
    </script>
</html>
