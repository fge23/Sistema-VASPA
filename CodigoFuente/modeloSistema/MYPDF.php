<?php

require_once('BDConexionSistema.Class.php');
include('../lib/tcpdf/tcpdf.php');
include_once 'Programa.Class.php';
include_once 'Asignatura.Class.php';
include_once 'Libro.Class.php';
include_once 'Revista.Class.php';
include_once 'Recurso.Class.php';
include_once 'OtroMaterial.Class.php';
include_once 'Profesor.Class.php';
include_once 'Departamento.Class.php';
include_once 'Carrera.Class.php';
include_once '../lib/funcionesUtiles/sanearString.php';

/**
 * Description of MYPDF
 *
 * @author Francisco
 */

class MYPDF extends TCPDF {
    
    /*
     * @var Programa
     */
    private $programa;
    /*
     * @var Asignatura
     */
    private $asignatura;
    
    // El atributo html se lo va a utilizar para almacenar el codigo html de todo el programa que se va a generar en PDF
    private $html;
    
    function __construct($idPrograma) {
        parent::__construct(PDF_PAGE_ORIENTATION, PDF_UNIT,'A4' , true, 'UTF-8', false);
        $this->programa = new Programa($idPrograma);
        $this->asignatura = $this->programa->getAsignatura();
        $this->html = '';
    }
    
    public function Header() {
    	
        $Carreras = $this->asignatura->getCarreras();
        //var_dump($Carreras);
              
        //Concatenamos el html
        $tbl ='';
        $tbl .= '<table cellspacing="0" cellpadding="2" border="1" style="font-family:Arial;font-size:10pt;">
                    <tr>
                        <td colspan="1" align="center" style="width: 37.1%;"><img src="../lib/img/logo-UNPA-programa.jpg" width="50" height="77"></td>
                        <td colspan="1" align="center" style="width: 62.9%;"><b><br>UNIVERSIDAD NACIONAL DE LA PATAGONIA AUSTRAL <br><br> Unidad Académica Río Gallegos</b></td>
                    </tr>
                </table>
                <table cellspacing="0" cellpadding="2" border="1">
                    <tr>
                        <td colspan="6"><b>Programa de: '.$this->asignatura->getNombre().'</b></td>
                        <td><b>Cod. Asig.</b></td>
                        <td><b> '.$this->asignatura->getId().'</b></td>
                    </tr>
                </table>    
                <table cellspacing="0" cellpadding="2" border="1">';
                
        if (is_null($Carreras)){
            throw new Exception('El programa de la asignatura: '.$this->asignatura->getNombre().' - '.$this->asignatura->getId().' <b>no se encuentra asociado a un Plan de Estudio y/o Carrera.</b>');
        }
        else {
            foreach ($Carreras as $Carrera){
                    $tbl .= '<tr>
                                <td colspan="6"><b>Carrera: '.$Carrera->getNombre().'</b></td>
                                <td><b>Cod. Carr.</b></td>
                                <td><b> '.$Carrera->getId().'</b></td>
                            </tr>';
                }   
                $tbl .= '</table>';

            $this->writeHTML($tbl, true, false, false, false, '');
        }
                
    }
    
    public function Footer() {
        
        // Posicion a 15 mm
        $this->SetY(-15);
        
        $foot = '<table cellspacing="0" cellpadding="1" border="1" style="font-family:Arial;font-size:10pt;">
                    <tr>
                        <td colspan="6"><b>VIGENCIA AÑOS </b></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>';
        
        if ($this->programa->getVigencia() == 1){
            $foot = '<table cellspacing="0" cellpadding="1" border="1" style="font-family:Arial;font-size:10pt;">
                    <tr>
                        <td colspan="6"><b>VIGENCIA AÑOS </b></td>
                        <td align="center">'.$this->programa->getAnio().'</td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>';
        } elseif ($this->programa->getVigencia() == 2) {
            $foot = '<table cellspacing="0" cellpadding="1" border="1" style="font-family:Arial;font-size:10pt;">
                    <tr>
                        <td colspan="6"><b>VIGENCIA AÑOS </b></td>
                        <td align="center">'.$this->programa->getAnio().'</td>
                        <td align="center">'.($this->programa->getAnio()+1).'</td>
                        <td></td>
                    </tr>
                </table>';
        } elseif ($this->programa->getVigencia() == 3) {
            $foot = '<table cellspacing="0" cellpadding="1" border="1" style="font-family:Arial;font-size:10pt;">
                    <tr>
                        <td colspan="6"><b>VIGENCIA AÑOS </b></td>
                        <td align="center">'.$this->programa->getAnio().'</td>
                        <td align="center">'.($this->programa->getAnio()+1).'</td>
                        <td align="center">'.($this->programa->getAnio()+2).'</td>
                    </tr>
                </table>';
        }
        
       $this->writeHTML($foot, true, false, false, false, '');
       
       $this->Cell(0,10,'Pag - '.$this->getAliasNumPage().' -',0,false,'R',0,'',false,'T','M');  
    }
    
    private function setearParametros(){
        // Seteo las fuentes del encabezado y del pie de pagina
        parent::setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        parent::setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // Seteo los margenes 
        //$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        parent::SetMargins(20, PDF_MARGIN_TOP, 10);
        //$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        parent::SetHeaderMargin(10);
        parent::SetFooterMargin(PDF_MARGIN_FOOTER);

        // Seteo los cortes automaticos de las paginas 
        //$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        parent::SetAutoPageBreak(TRUE, 19.5);

        // Seteo la escala de la imagen 
        parent::setImageScale(PDF_IMAGE_SCALE_RATIO);

        // Seteo el margen superior
        //69 si headermargin es de 5, si es de 10 sumarle 5
        
        //$topMargin = 63 + (5.5 * $this->getCantidadCarreras()); // funciona con el encabezado anterior
        $topMargin = 43.5 + (5.5 * $this->getCantidadCarreras()); // funciona con el encabezado anterior

        //parent::setTopMargin(49); // 1 carrera para el encabezado nuevo
        parent::setTopMargin($topMargin);
    }
    
    /*
     * @ return int
     */
    private function getCantidadCarreras() {
        $Carreras = $this->asignatura->getCarreras();
        if (is_null($Carreras)){
            return 0;
        }
        else {
            return count($Carreras);
        }
        
    }
    
    private function setearInformacionDocumento(){
        //$Programa = new Programa($this->getIdPrograma());
        //$Asignatura = $Programa->getAsignatura();

        // seteo la info del documento
        parent::SetCreator(PDF_CREATOR);
        parent::SetAuthor('VASPA Team');
        $nombrePrograma = 'Programa de '.$this->asignatura->getNombre().' - '.$this->asignatura->getId();
        parent::SetTitle($nombrePrograma);
    }
    
    private function cargarTablaCicloAcademico() {
        //--------------------1ra Tabla - CICLO ACADEMICO--------------------
        // Concatenamos el codigo html
        $this->html .= '
        <html>
        <head><meta charset="utf-8">
        <style type="text/css">
          body {
            font-family: Arial;
            font-size: 9pt;
            //color: red;
            //background-color: #d8da3d }</style>
        </head>
        <body><table border="1" cellspacing="0" cellpadding="2" style="width: 100%;"> 
                <tbody>
                <tr>
                        <td colspan="8" valign="top" ><p>Ciclo Académico: '.$this->programa->getAnio().'</p></td>
                </tr>

                <tr>
                        <td rowspan="2" valign="top" style="width: 19%;"><p align="center">Año de la Carrera:</p></td>
                        <td colspan="3" valign="top" style="width: 39%;"><p align="center">Horas de Clases Semanales</p></td>
                        <td colspan="4" valign="top" style="width: 42%;"><p align="center">Régimen de Cursado</p></td>
                </tr>

                <tr>
                        <td valign="top" style="width: 13%;"><p align="center">Teoría</p></td>
                        <td valign="top" style="width: 13%;"><p align="center">Práctica</p></td>
                        <td valign="top" style="width: 13%;"><p align="center">Otros (1)</p></td>
                        <td valign="top" style="width: 10.5%;"><p align="center">Anual</p></td>
                        <td valign="top" style="width: 10.5%;"><p align="center">1er.Cuatr.</p></td>
                        <td valign="top" style="width: 10.5%;"><p align="center">2do.Cuatr.</p></td>
                        <td valign="top" style="width: 10.5%;"><p align="center">Otros (2)</p></td>
                </tr>

                <tr>
                        <td valign="top" align="center" style="width: 19%;"> '.$this->programa->getAnioCarrera().'°</td>
                        <td valign="top" align="center" style="width: 13%;"> '.substr($this->programa->getHorasTeoria(), 0, 5).' </td>
                        <td valign="top" align="center" style="width: 13%;"> '.substr($this->programa->getHorasPractica(), 0, 5).' </td>
                        <td valign="top" align="center" style="width: 13%;"> '.$this->programa->getHorasOtros().' </td>';

                        //Se marca con una "X" la celda correspondiente según el regimen de cursada de la materia
                        if ($this->programa->getRegimenCursada() == 'A') {
                            $this->html .= '<td valign="top" align="center" style="width: 10.5%;"> X </td>';
                        }
                        else{
                            $this->html .= '<td valign="top" align="center" style="width: 10.5%;">  </td>';
                        }

                        if ($this->programa->getRegimenCursada() == '1') {
                            $this->html .= '<td valign="top" align="center" style="width: 10.5%;"> X </td>';
                        }
                        else{
                            $this->html .= '<td valign="top" align="center" style="width: 10.5%;">  </td>';
                        }

                        if ($this->programa->getRegimenCursada() == '2') {
                            $this->html .= '<td valign="top" align="center" style="width: 10.5%;"> X </td>';
                        }
                        else{
                            $this->html .= '<td valign="top" align="center" style="width: 10.5%;">  </td>';
                        }

                        if ($this->programa->getRegimenCursada() == 'O') {
                            $this->html .= '<td valign="top" align="center" style="width: 10.5%;"> X </td>';
                        }
                        else{
                            $this->html .= '<td valign="top" align="center" style="width: 10.5%;">  </td>';
                        }

            $this->html .= '</tr>
                <tr>
                        <td colspan="8" valign="top" ><p>(1) Observaciones: '. $this->programa->getObservacionesHoras().'</p></td>
                </tr>
                <tr>
                        <td colspan="8" valign="top" ><p>(2) Observaciones: '. $this->programa->getObservacionesCursada().'</p></td>
                </tr>
                </tbody>
        </table>

        <br/>
        <br/>';
    }
    
    private function cargarTablaDocentes() {
        //--------------------DOCENTES--------------------
        $this->html .= '<table border="1" cellspacing="0" cellpadding="2" style="width: 100%;"> 
	<tbody>
	<tr>
		<td colspan="4" valign="top" align="center"><p>Docente/s</p></td>
	</tr>

	<tr>
		<td colspan="2" valign="top" ><p align="center">Teoría</p></td>
		<td colspan="2" valign="top" ><p align="center">Práctica</p></td>
	</tr>

	<tr>
                <td valign="top" style="width: 3.1%;"><p align="center">R/I</p></td>
		<td valign="top" style="width: 28%;"><p align="center">Apellido y Nombres</p></td>
		<td valign="top" style="width: 18.9%;"><p align="center">Departamento</p></td>
                <td valign="top" style="width: 3.1%;"><p align="center">R/I</p></td>
		<td valign="top" style="width: 28%;"><p align="center">Apellido y Nombres</p></td>
		<td valign="top" style="width: 18.9%;"><p align="center">Departamento</p></td>
	</tr>';

        $ProfesoresPractica = $this->asignatura->getProfesoresPractica();
        $ProfesoresTeoria = $this->asignatura->getProfesoresTeoria();
        $profesorResponsable = new Profesor($this->asignatura->getIdProfesor(), null);
        
        $profesoresPracticaSinResponsable = $this->asignatura->getProfesoresPracticaSinResponsable();
        
        /* La siguiente variable nos va a servir para ver si el profesor responsable de la asignatura
         * tambien se encuentra en la practica
         */
        $hayResponsablePractica = false;
        if (!is_null($ProfesoresPractica)){
            foreach ($ProfesoresPractica as $prof) {
                if ($prof->getId() == $profesorResponsable->getId()){
                    $hayResponsablePractica = true;
                    break;
                }
            }
        }
        
        $departamento = new Departamento($profesorResponsable->getIdDepartamento(), null);
        
        // El profesor responsable de la materia se da por entendido que da la teoria de la asignatura
        if ($ProfesoresPractica != NULL && $ProfesoresTeoria == NULL){
            
            if ($hayResponsablePractica){
                // Esto quiere decir que tanto en la primera fila de la tabla Docentes
                // el profesor responsable aparece tanto en la teoria como en la practica
                $this->html .= '<tr>
                        <td valign="top" style="width: 3.1%;"><p align="center">R</p></td>
                        <td valign="top" style="width: 28%;">'.$profesorResponsable->getApellido().', '.$profesorResponsable->getNombre().'</td>
                        <td valign="top" style="width: 18.9%;" align="center">'.$departamento->getNombre().' </td>
                        <td valign="top" style="width: 3.1%;"><p align="center">R</p></td>
                        <td valign="top" style="width: 28%;">'.$profesorResponsable->getApellido().', '.$profesorResponsable->getNombre().'</td>
                        <td valign="top" style="width: 18.9%;" align="center">'.$departamento->getNombre().'</td>
                </tr>';
                
                //comprobamos si es que hay mas profesores de practica
                if (!is_null($profesoresPracticaSinResponsable)){
                    foreach ($profesoresPracticaSinResponsable as $ProfesorPractica) {
                    //if ($ProfesorPractica->getId() != $profesorResponsable->getId()){
                        $dpto = new Departamento($ProfesorPractica->getIdDepartamento(), null);
                        $this->html .= '<tr>
                                <td valign="top" style="width: 3.1%;"><p align="center"> </p></td>
                                <td valign="top" style="width: 28%;"></td>
                                <td valign="top" style="width: 18.9%;" align="center"></td>
                                <td valign="top" style="width: 3.1%;"><p align="center">I</p></td>
                                <td valign="top" style="width: 28%;">'.$ProfesorPractica->getApellido().', '.$ProfesorPractica->getNombre().'</td>
                                <td valign="top" style="width: 18.9%;" align="center">'.$dpto->getNombre().'</td>
                        </tr>';
                    //}
                    }
                }
                    
            } else {
                $ProfesorPractica = $ProfesoresPractica[0];
                $dpto = new Departamento($ProfesorPractica->getIdDepartamento(), null);
                $this->html .= '<tr>
                            <td valign="top" style="width: 3.1%;"><p align="center">R</p></td>
                            <td valign="top" style="width: 28%;">'.$profesorResponsable->getApellido().', '.$profesorResponsable->getNombre().'</td>
                            <td valign="top" style="width: 18.9%;" align="center">'.$departamento->getNombre().' </td>
                            <td valign="top" style="width: 3.1%;"><p align="center">I</p></td>
                            <td valign="top" style="width: 28%;">'.$ProfesorPractica->getApellido().', '.$ProfesorPractica->getNombre().'</td>
                            <td valign="top" style="width: 18.9%;" align="center">'.$dpto->getNombre().'</td>
                    </tr>';
                $tamanio = sizeof($ProfesoresPractica);
                if ($tamanio > 1){
                    for ($i=1; $i<$tamanio; $i++){
                        $ProfesorPractica = $ProfesoresPractica[$i];
                        $dpto = new Departamento($ProfesorPractica->getIdDepartamento(), null);
                        $this->html .= '<tr>
                                    <td valign="top" style="width: 3.1%;"><p align="center"> </p></td>
                                    <td valign="top" style="width: 28%;"></td>
                                    <td valign="top" style="width: 18.9%;" align="center"></td>
                                    <td valign="top" style="width: 3.1%;"><p align="center">I</p></td>
                                    <td valign="top" style="width: 28%;">'.$ProfesorPractica->getApellido().', '.$ProfesorPractica->getNombre().'</td>
                                    <td valign="top" style="width: 18.9%;" align="center">'.$dpto->getNombre().'</td>
                            </tr>';
                    }
                }
            }
        } elseif (!is_null($ProfesoresTeoria) && !is_null($ProfesoresPractica)) {
            
            if ($hayResponsablePractica){
                // Esto quiere decir que tanto en la primera fila de la tabla Docentes
                // el profesor responsable aparece tanto en la teoria como en la practica
                
                $this->html .= '<tr>
                        <td valign="top" style="width: 3.1%;"><p align="center">R</p></td>
                        <td valign="top" style="width: 28%;">'.$profesorResponsable->getApellido().', '.$profesorResponsable->getNombre().'</td>
                        <td valign="top" style="width: 18.9%;" align="center">'.$departamento->getNombre().' </td>
                        <td valign="top" style="width: 3.1%;"><p align="center">R</p></td>
                        <td valign="top" style="width: 28%;">'.$profesorResponsable->getApellido().', '.$profesorResponsable->getNombre().'</td>
                        <td valign="top" style="width: 18.9%;" align="center">'.$departamento->getNombre().'</td>
                    </tr>';
                
                $cantidadProfTeoria = count($ProfesoresTeoria);
                
                if (!is_null($profesoresPracticaSinResponsable)){
                    $cantidadProfPracticaSinResponsable = count($profesoresPracticaSinResponsable);
                    
                    if ($cantidadProfTeoria == $cantidadProfPracticaSinResponsable){
                    
                        for ($i = 0; $i < $cantidadProfPracticaSinResponsable; $i++) {
                            $ProfesorPractica = $profesoresPracticaSinResponsable[$i];
                            $ProfesorTeoria = $ProfesoresTeoria[$i];
                            $dptoPractica = new Departamento($ProfesorPractica->getIdDepartamento(), null);
                            $dptoTeoria = new Departamento($ProfesorTeoria->getIdDepartamento(), null);
                            $this->html .= '<tr>
                                        <td valign="top" style="width: 3.1%;"><p align="center">I</p></td>
                                        <td valign="top" style="width: 28%;">'.$ProfesorTeoria->getApellido().', '.$ProfesorTeoria->getNombre().'</td>
                                        <td valign="top" style="width: 18.9%;" align="center">'.$dptoTeoria->getNombre().'</td>
                                        <td valign="top" style="width: 3.1%;"><p align="center">I</p></td>
                                        <td valign="top" style="width: 28%;">'.$ProfesorPractica->getApellido().', '.$ProfesorPractica->getNombre().'</td>
                                        <td valign="top" style="width: 18.9%;" align="center">'.$dptoPractica->getNombre().'</td>
                                </tr>';
                        }
                    
                    } elseif ($cantidadProfTeoria > $cantidadProfPracticaSinResponsable) {
                        
                        for ($i=0; $i<$cantidadProfPracticaSinResponsable; $i++){
                            $ProfesorPractica = $profesoresPracticaSinResponsable[$i];
                            $ProfesorTeoria = $ProfesoresTeoria[$i];
                            $dptoPractica = new Departamento($ProfesorPractica->getIdDepartamento(), null);
                            $dptoTeoria = new Departamento($ProfesorTeoria->getIdDepartamento(), null);
                            $this->html .= '<tr>
                                        <td valign="top" style="width: 3.1%;"><p align="center">I</p></td>
                                        <td valign="top" style="width: 28%;">'.$ProfesorTeoria->getApellido().', '.$ProfesorTeoria->getNombre().'</td>
                                        <td valign="top" style="width: 18.9%;" align="center">'.$dptoTeoria->getNombre().'</td>
                                        <td valign="top" style="width: 3.1%;"><p align="center">I</p></td>
                                        <td valign="top" style="width: 28%;">'.$ProfesorPractica->getApellido().', '.$ProfesorPractica->getNombre().'</td>
                                        <td valign="top" style="width: 18.9%;" align="center">'.$dptoPractica->getNombre().'</td>
                                </tr>';
                        }
                        
                        for ($j=$i; $j<$cantidadProfTeoria; $j++){
                            $ProfesorTeoria = $ProfesoresTeoria[$j];
                            $dptoTeoria = new Departamento($ProfesorTeoria->getIdDepartamento(), null);
                            $this->html .= '<tr>
                                        <td valign="top" style="width: 3.1%;"><p align="center">I</p></td>
                                        <td valign="top" style="width: 28%;">'.$ProfesorTeoria->getApellido().', '.$ProfesorTeoria->getNombre().'</td>
                                        <td valign="top" style="width: 18.9%;" align="center">'.$dptoTeoria->getNombre().'</td>
                                        <td valign="top" style="width: 3.1%;"><p align="center"></p></td>
                                        <td valign="top" style="width: 28%;"></td>
                                        <td valign="top" style="width: 18.9%;" align="center"></td>
                                </tr>';
                        }
                        
                    } else {
                        
                        for ($i=0; $i<$cantidadProfTeoria; $i++){
                            $ProfesorPractica = $profesoresPracticaSinResponsable[$i];
                            $ProfesorTeoria = $ProfesoresTeoria[$i];
                            $dptoPractica = new Departamento($ProfesorPractica->getIdDepartamento(), null);
                            $dptoTeoria = new Departamento($ProfesorTeoria->getIdDepartamento(), null);
                            $this->html .= '<tr>
                                        <td valign="top" style="width: 3.1%;"><p align="center">I</p></td>
                                        <td valign="top" style="width: 28%;">'.$ProfesorTeoria->getApellido().', '.$ProfesorTeoria->getNombre().'</td>
                                        <td valign="top" style="width: 18.9%;" align="center">'.$dptoTeoria->getNombre().'</td>
                                        <td valign="top" style="width: 3.1%;"><p align="center">I</p></td>
                                        <td valign="top" style="width: 28%;">'.$ProfesorPractica->getApellido().', '.$ProfesorPractica->getNombre().'</td>
                                        <td valign="top" style="width: 18.9%;" align="center">'.$dptoPractica->getNombre().'</td>
                                </tr>';
                        }
                        
                        for ($j=$i; $j<$cantidadProfPracticaSinResponsable; $j++){
                            $ProfesorPractica = $profesoresPracticaSinResponsable[$j];
                            $dptoPractica = new Departamento($ProfesorPractica->getIdDepartamento(), null);
                            $this->html .= '<tr>
                                        <td valign="top" style="width: 3.1%;"><p align="center"></p></td>
                                        <td valign="top" style="width: 28%;"></td>
                                        <td valign="top" style="width: 18.9%;" align="center"></td>
                                        <td valign="top" style="width: 3.1%;"><p align="center">I</p></td>
                                        <td valign="top" style="width: 28%;">'.$ProfesorPractica->getApellido().', '.$ProfesorPractica->getNombre().'</td>
                                        <td valign="top" style="width: 18.9%;" align="center">'.$dptoPractica->getNombre().'</td>
                                </tr>';
                        }
                        
                    }
                     
                } else {
                    
                    for ($i=0; $i<$cantidadProfTeoria; $i++){
                            $ProfesorTeoria = $ProfesoresTeoria[$i];
                            $dptoTeoria = new Departamento($ProfesorTeoria->getIdDepartamento(), null);
                            $this->html .= '<tr>
                                        <td valign="top" style="width: 3.1%;"><p align="center">I</p></td>
                                        <td valign="top" style="width: 28%;">'.$ProfesorTeoria->getApellido().', '.$ProfesorTeoria->getNombre().'</td>
                                        <td valign="top" style="width: 18.9%;" align="center">'.$dptoTeoria->getNombre().'</td>
                                        <td valign="top" style="width: 3.1%;"><p align="center"></p></td>
                                        <td valign="top" style="width: 28%;"></td>
                                        <td valign="top" style="width: 18.9%;" align="center"></td>
                                </tr>';
                    }
                    
                }
            } else {
                
                $ProfesorPractica = $ProfesoresPractica[0];
                $dptoPractica = new Departamento($ProfesorPractica->getIdDepartamento(), null);
                
                $this->html .= '<tr>
                        <td valign="top" style="width: 3.1%;"><p align="center">R</p></td>
                        <td valign="top" style="width: 28%;">'.$profesorResponsable->getApellido().', '.$profesorResponsable->getNombre().'</td>
                        <td valign="top" style="width: 18.9%;" align="center">'.$departamento->getNombre().' </td>
                        <td valign="top" style="width: 3.1%;"><p align="center">I</p></td>
                        <td valign="top" style="width: 28%;">'.$ProfesorPractica->getApellido().', '.$ProfesorPractica->getNombre().'</td>
                        <td valign="top" style="width: 18.9%;" align="center">'.$dptoPractica->getNombre().'</td>
                    </tr>';
                
                
                $cantidadProfTeoria = count($ProfesoresTeoria);
                $cantidadProfPractica = count($ProfesoresPractica) - 1;
                
                if ($cantidadProfPractica > 0){
                    
                    if ($cantidadProfTeoria == $cantidadProfPractica){
                    
                        for ($i = 0; $i < $cantidadProfPractica; $i++) {
                            $ProfesorPractica = $ProfesoresPractica[$i+1];
                            $ProfesorTeoria = $ProfesoresTeoria[$i];
                            $dptoPractica = new Departamento($ProfesorPractica->getIdDepartamento(), null);
                            $dptoTeoria = new Departamento($ProfesorTeoria->getIdDepartamento(), null);
                            $this->html .= '<tr>
                                        <td valign="top" style="width: 3.1%;"><p align="center">I</p></td>
                                        <td valign="top" style="width: 28%;">'.$ProfesorTeoria->getApellido().', '.$ProfesorTeoria->getNombre().'</td>
                                        <td valign="top" style="width: 18.9%;" align="center">'.$dptoTeoria->getNombre().'</td>
                                        <td valign="top" style="width: 3.1%;"><p align="center">I</p></td>
                                        <td valign="top" style="width: 28%;">'.$ProfesorPractica->getApellido().', '.$ProfesorPractica->getNombre().'</td>
                                        <td valign="top" style="width: 18.9%;" align="center">'.$dptoPractica->getNombre().'</td>
                                </tr>';
                        }
                    
                    } elseif ($cantidadProfTeoria > $cantidadProfPractica) {
                        
                        for ($i=0; $i<$cantidadProfPractica; $i++){
                            $ProfesorPractica = $ProfesoresPractica[$i+1];
                            $ProfesorTeoria = $ProfesoresTeoria[$i];
                            $dptoPractica = new Departamento($ProfesorPractica->getIdDepartamento(), null);
                            $dptoTeoria = new Departamento($ProfesorTeoria->getIdDepartamento(), null);
                            $this->html .= '<tr>
                                        <td valign="top" style="width: 3.1%;"><p align="center">I</p></td>
                                        <td valign="top" style="width: 28%;">'.$ProfesorTeoria->getApellido().', '.$ProfesorTeoria->getNombre().'</td>
                                        <td valign="top" style="width: 18.9%;" align="center">'.$dptoTeoria->getNombre().'</td>
                                        <td valign="top" style="width: 3.1%;"><p align="center">I</p></td>
                                        <td valign="top" style="width: 28%;">'.$ProfesorPractica->getApellido().', '.$ProfesorPractica->getNombre().'</td>
                                        <td valign="top" style="width: 18.9%;" align="center">'.$dptoPractica->getNombre().'</td>
                                </tr>';
                        }
                        
                        for ($j=$i; $j<$cantidadProfTeoria; $j++){
                            $ProfesorTeoria = $ProfesoresTeoria[$j];
                            $dptoTeoria = new Departamento($ProfesorTeoria->getIdDepartamento(), null);
                            $this->html .= '<tr>
                                        <td valign="top" style="width: 3.1%;"><p align="center">I</p></td>
                                        <td valign="top" style="width: 28%;">'.$ProfesorTeoria->getApellido().', '.$ProfesorTeoria->getNombre().'</td>
                                        <td valign="top" style="width: 18.9%;" align="center">'.$dptoTeoria->getNombre().'</td>
                                        <td valign="top" style="width: 3.1%;"><p align="center"></p></td>
                                        <td valign="top" style="width: 28%;"></td>
                                        <td valign="top" style="width: 18.9%;" align="center"></td>
                                </tr>';
                        }
                        
                    } else {
                        
                        for ($i=0; $i<$cantidadProfTeoria; $i++){
                            $ProfesorPractica = $ProfesoresPractica[$i+1];
                            $ProfesorTeoria = $ProfesoresTeoria[$i];
                            $dptoPractica = new Departamento($ProfesorPractica->getIdDepartamento(), null);
                            $dptoTeoria = new Departamento($ProfesorTeoria->getIdDepartamento(), null);
                            $this->html .= '<tr>
                                        <td valign="top" style="width: 3.1%;"><p align="center">I</p></td>
                                        <td valign="top" style="width: 28%;">'.$ProfesorTeoria->getApellido().', '.$ProfesorTeoria->getNombre().'</td>
                                        <td valign="top" style="width: 18.9%;" align="center">'.$dptoTeoria->getNombre().'</td>
                                        <td valign="top" style="width: 3.1%;"><p align="center">I</p></td>
                                        <td valign="top" style="width: 28%;">'.$ProfesorPractica->getApellido().', '.$ProfesorPractica->getNombre().'</td>
                                        <td valign="top" style="width: 18.9%;" align="center">'.$dptoPractica->getNombre().'</td>
                                </tr>';
                        }
                        
                        for ($j=$i; $j<$cantidadProfPractica; $j++){
                            $ProfesorPractica = $ProfesoresPractica[$j+1];
                            $dptoPractica = new Departamento($ProfesorPractica->getIdDepartamento(), null);
                            $this->html .= '<tr>
                                        <td valign="top" style="width: 3.1%;"><p align="center"></p></td>
                                        <td valign="top" style="width: 28%;"></td>
                                        <td valign="top" style="width: 18.9%;" align="center"></td>
                                        <td valign="top" style="width: 3.1%;"><p align="center">I</p></td>
                                        <td valign="top" style="width: 28%;">'.$ProfesorPractica->getApellido().', '.$ProfesorPractica->getNombre().'</td>
                                        <td valign="top" style="width: 18.9%;" align="center">'.$dptoPractica->getNombre().'</td>
                                </tr>';
                        }
                        
                    }
                     
                } else {
                    
                    for ($i=0; $i<$cantidadProfTeoria; $i++){
                            $ProfesorTeoria = $ProfesoresTeoria[$i];
                            $dptoTeoria = new Departamento($ProfesorTeoria->getIdDepartamento(), null);
                            $this->html .= '<tr>
                                        <td valign="top" style="width: 3.1%;"><p align="center">I</p></td>
                                        <td valign="top" style="width: 28%;">'.$ProfesorTeoria->getApellido().', '.$ProfesorTeoria->getNombre().'</td>
                                        <td valign="top" style="width: 18.9%;" align="center">'.$dptoTeoria->getNombre().'</td>
                                        <td valign="top" style="width: 3.1%;"><p align="center"></p></td>
                                        <td valign="top" style="width: 28%;"></td>
                                        <td valign="top" style="width: 18.9%;" align="center"></td>
                                </tr>';
                    }
                    
                }
                
                
            }
        } elseif (!is_null($ProfesoresTeoria) && is_null($ProfesoresPractica)) {
            
            $this->html .= '<tr>
                        <td valign="top" style="width: 3.1%;"><p align="center">R</p></td>
                        <td valign="top" style="width: 28%;">'.$profesorResponsable->getApellido().', '.$profesorResponsable->getNombre().'</td>
                        <td valign="top" style="width: 18.9%;" align="center">'.$departamento->getNombre().'</td>
                        <td valign="top" style="width: 3.1%;"><p align="center"></p></td>
                        <td valign="top" style="width: 28%;"></td>
                        <td valign="top" style="width: 18.9%;" align="center"></td>
                    </tr>';
                
                
            $cantidadProfTeoria = count($ProfesoresTeoria);
            
            for ($i = 0; $i < $cantidadProfTeoria; $i++) {
                $ProfesorTeoria = $ProfesoresTeoria[$i];
                $dptoTeoria = new Departamento($ProfesorTeoria->getIdDepartamento(), null);
                $this->html .= '<tr>
                                        <td valign="top" style="width: 3.1%;"><p align="center">I</p></td>
                                        <td valign="top" style="width: 28%;">' . $ProfesorTeoria->getApellido() . ', ' . $ProfesorTeoria->getNombre() . '</td>
                                        <td valign="top" style="width: 18.9%;" align="center">' . $dptoTeoria->getNombre() . '</td>
                                        <td valign="top" style="width: 3.1%;"><p align="center"></p></td>
                                        <td valign="top" style="width: 28%;"></td>
                                        <td valign="top" style="width: 18.9%;" align="center"></td>
                                </tr>';
            }
            
        } else {
            
            $this->html .= '<tr>
                        <td valign="top" style="width: 3.1%;"><p align="center">R</p></td>
                        <td valign="top" style="width: 28%;">'.$profesorResponsable->getApellido().', '.$profesorResponsable->getNombre().'</td>
                        <td valign="top" style="width: 18.9%;" align="center">'.$departamento->getNombre().'</td>
                        <td valign="top" style="width: 3.1%;"><p align="center"></p></td>
                        <td valign="top" style="width: 28%;"></td>
                        <td valign="top" style="width: 18.9%;" align="center"></td>
                    </tr>';
            
        }
        
        /*
         * Nota falta los casos en donde tanto los profes de teoria como de practica son nulos
        */
        
    }   
    
    private function cargarCorrelativasPrecedentes() {
        //--------------------ESPACIOS CURRICULARES CORRELATIVOS PRECEDENTES--------------------

                $this->html .= '</tbody>
        </table>
        <br/>
        <br/>

        <table border="1" cellspacing="0" cellpadding="2" style="width: 100%;"> 
                <tbody>
                        <tr>
                                <td colspan="4" valign="top" ><p align="center">Espacios Curriculares Correlativos Precedentes</p></td>
                        </tr>

                        <tr>
                                <td valign="top" style="width: 40%;"><p align="center">Aprobada/s</p></td>
                                <td valign="top" style="width: 10%;"><p align="center">Cod. Asig.</p></td>
                                <td valign="top" style="width: 40%;"><p align="center">Cursada/s</p></td>
                                <td valign="top" style="width: 10%;"><p align="center">Cod. Asig.</p></td>
                        </tr>';

        $aprobadas = $this->asignatura->getAsigCorrelativaPrecedenteAprobada();
        $cursadas = $this->asignatura->getAsigCorrelativaPrecedenteCursada();

        if ($aprobadas != NULL && $cursadas != NULL){
            $cantAprobadas = sizeof($aprobadas);
            //echo $cantAprobadas;
            $cantCursadas = sizeof($cursadas);
            //echo $cantCursadas;

            if ($cantAprobadas > $cantCursadas){
                for ($i=0; $i<$cantAprobadas; $i++){
                    $AsigAprob = $aprobadas[$i];
                    if ($cantCursadas > $i){
                        $AsigCur = $cursadas[$i];
                        $this->html .= '<tr>
                                <td valign="top" style="width: 40%;" align="center">'.$AsigAprob->getNombre().'</td>
                                <td valign="top" style="width: 10%;" align="center">'.$AsigAprob->getId().'</td>
                                <td valign="top" style="width: 40%;" align="center">'.$AsigCur->getNombre().'</td>
                                <td valign="top" style="width: 10%;" align="center">'.$AsigCur->getId().'</td>
                        </tr>';
                    }
                    else{
                        $this->html .= '<tr>
                                <td valign="top" style="width: 40%;" align="center">'.$AsigAprob->getNombre().'</td>
                                <td valign="top" style="width: 10%;" align="center">'.$AsigAprob->getId().'</td>
                                <td valign="top" style="width: 40%;" align="center"> </td>
                                <td valign="top" style="width: 10%;" align="center"> </td>
                        </tr>';
                    }

                }
            }

            // Probar la siguiente parte del codigo cuando hay mas materias cursadas que aprobadas
            elseif ($cantAprobadas < $cantCursadas){
                for ($i=0; $i<$cantCursadas; $i++){
                    $AsigCur = $cursadas[$i];
                    if ($cantAprobadas > $i){
                        $AsigAprob = $aprobadas[$i];
                        $this->html .= '<tr>
                                <td valign="top" style="width: 40%;" align="center">'.$AsigAprob->getNombre().'</td>
                                <td valign="top" style="width: 10%;" align="center">'.$AsigAprob->getId().'</td>
                                <td valign="top" style="width: 40%;" align="center">'.$AsigCur->getNombre().'</td>
                                <td valign="top" style="width: 10%;" align="center">'.$AsigCur->getId().'</td>
                        </tr>';
                    }
                    else{
                        $this->html .= '<tr>
                                <td valign="top" style="width: 40%;" align="center"> </td>
                                <td valign="top" style="width: 10%;" align="center"> </td>
                                <td valign="top" style="width: 40%;" align="center">'.$AsigCur->getNombre().'</td>
                                <td valign="top" style="width: 10%;" align="center">'.$AsigCur->getId().'</td>
                        </tr>';
                    }

                }
            } else {
                for ($i=0; $i<$cantCursadas; $i++){
                    $AsigCur = $cursadas[$i];
                        $AsigAprob = $aprobadas[$i];
                        $this->html .= '<tr>
                                <td valign="top" style="width: 40%;" align="center">'.$AsigAprob->getNombre().'</td>
                                <td valign="top" style="width: 10%;" align="center">'.$AsigAprob->getId().'</td>
                                <td valign="top" style="width: 40%;" align="center">'.$AsigCur->getNombre().'</td>
                                <td valign="top" style="width: 10%;" align="center">'.$AsigCur->getId().'</td>
                        </tr>';
                    }
                }
        } elseif (is_null($aprobadas) && !is_null($cursadas)){
            $cantCursadas = sizeof($cursadas);
            for ($i = 0; $i < $cantCursadas; $i++) {
                $AsigCur = $cursadas[$i];
                $this->html .= '<tr>
                                <td valign="top" style="width: 40%;" align="center"> </td>
                                <td valign="top" style="width: 10%;" align="center"> </td>
                                <td valign="top" style="width: 40%;" align="center">' . $AsigCur->getNombre() . '</td>
                                <td valign="top" style="width: 10%;" align="center">' . $AsigCur->getId() . '</td>
                        </tr>';
            }
        } elseif (!is_null($aprobadas) && is_null($cursadas)){
            $cantAprobadas = sizeof($aprobadas);
            for ($i = 0; $i < $cantAprobadas; $i++) {
                $AsigAprob = $aprobadas[$i];
                $this->html .= '<tr>
                                <td valign="top" style="width: 40%;" align="center">' . $AsigAprob->getNombre() . '</td>
                                <td valign="top" style="width: 10%;" align="center">' . $AsigAprob->getId() . '</td>
                                <td valign="top" style="width: 40%;" align="center"> </td>
                                <td valign="top" style="width: 10%;" align="center"> </td>
                        </tr>';
            }
        } else {
            $this->html .= '<tr>
                                <td valign="top" style="width: 40%;" align="center"> </td>
                                <td valign="top" style="width: 10%;" align="center"> </td>
                                <td valign="top" style="width: 40%;" align="center"> </td>
                                <td valign="top" style="width: 10%;" align="center"> </td>
                        </tr>
                        <tr>
                                <td valign="top" style="width: 40%;" align="center"> </td>
                                <td valign="top" style="width: 10%;" align="center"> </td>
                                <td valign="top" style="width: 40%;" align="center"> </td>
                                <td valign="top" style="width: 10%;" align="center"> </td>
                        </tr>';
        }
    }
    
    private function cargarCorrelativasSubsiguientes() {
        //--------------------ESPACIOS CURRICULARES CORRELATIVOS SUBSIGUIENTES--------------------

        $this->html .= '</tbody>
        </table>		

        <br/>
        <br/>

        <table border="1" cellspacing="0" cellpadding="2" style="width: 100%;"> 
                <tbody>
                        <tr>
                                <td colspan="4" valign="top" ><p align="center">Espacios Curriculares Correlativos Subsiguientes</p></td>
                        </tr>

                        <tr>
                                <td valign="top" style="width: 40%;" align="center"><p align="center">Aprobada/s</p></td>
                                <td valign="top" style="width: 10%;" align="center"><p align="center">Cod. Asig.</p></td>
                                <td valign="top" style="width: 40%;" align="center"><p align="center">Cursada/s</p></td>
                                <td valign="top" style="width: 10%;" align="center"><p align="center">Cod. Asig.</p></td>
                        </tr>';

        $aprobadas = $this->asignatura->getAsigCorrelativaSubsiguienteAprobada();
        $cursadas = $this->asignatura->getAsigCorrelativaSubsiguienteCursada();

        if ($aprobadas != NULL && $cursadas != NULL){
            $cantAprobadas = sizeof($aprobadas);
            //echo $cantAprobadas;
            $cantCursadas = sizeof($cursadas);
            //echo $cantCursadas;

            if ($cantAprobadas > $cantCursadas){
                for ($i=0; $i<$cantAprobadas; $i++){
                    $AsigAprob = $aprobadas[$i];
                    if ($cantCursadas > $i){
                        $AsigCur = $cursadas[$i];
                        $this->html .= '<tr>
                                <td valign="top" style="width: 40%;" align="center">'.$AsigAprob->getNombre().'</td>
                                <td valign="top" style="width: 10%;" align="center">'.$AsigAprob->getId().'</td>
                                <td valign="top" style="width: 40%;" align="center">'.$AsigCur->getNombre().'</td>
                                <td valign="top" style="width: 10%;" align="center">'.$AsigCur->getId().'</td>
                        </tr>';
                    }
                    else{
                        $this->html .= '<tr>
                                <td valign="top" style="width: 40%;" align="center">'.$AsigAprob->getNombre().'</td>
                                <td valign="top" style="width: 10%;" align="center">'.$AsigAprob->getId().'</td>
                                <td valign="top" style="width: 40%;" align="center"> </td>
                                <td valign="top" style="width: 10%;" align="center"> </td>
                        </tr>';
                    }

                }
            }
        

        elseif ($cantAprobadas < $cantCursadas){
                for ($i=0; $i<$cantCursadas; $i++){
                    $AsigCur = $cursadas[$i];
                    if ($cantAprobadas > $i){
                        $AsigAprob = $aprobadas[$i];
                        $this->html .= '<tr>
                                <td valign="top" style="width: 40%;" align="center">'.$AsigAprob->getNombre().'</td>
                                <td valign="top" style="width: 10%;" align="center">'.$AsigAprob->getId().'</td>
                                <td valign="top" style="width: 40%;" align="center">'.$AsigCur->getNombre().'</td>
                                <td valign="top" style="width: 10%;" align="center">'.$AsigCur->getId().'</td>
                        </tr>';
                    }
                    else{
                        $this->html .= '<tr>
                                <td valign="top" style="width: 40%;" align="center"> </td>
                                <td valign="top" style="width: 10%;" align="center"> </td>
                                <td valign="top" style="width: 40%;" align="center">'.$AsigCur->getNombre().'</td>
                                <td valign="top" style="width: 10%;" align="center">'.$AsigCur->getId().'</td>
                        </tr>';
                    }

                }
            } else {
                for ($i=0; $i<$cantCursadas; $i++){
                    $AsigCur = $cursadas[$i];
                        $AsigAprob = $aprobadas[$i];
                        $this->html .= '<tr>
                                <td valign="top" style="width: 40%;" align="center">'.$AsigAprob->getNombre().'</td>
                                <td valign="top" style="width: 10%;" align="center">'.$AsigAprob->getId().'</td>
                                <td valign="top" style="width: 40%;" align="center">'.$AsigCur->getNombre().'</td>
                                <td valign="top" style="width: 10%;" align="center">'.$AsigCur->getId().'</td>
                        </tr>';
                    }
                }
        } elseif (is_null($aprobadas) && !is_null($cursadas)){
            $cantCursadas = sizeof($cursadas);
            for ($i = 0; $i < $cantCursadas; $i++) {
                $AsigCur = $cursadas[$i];
                $this->html .= '<tr>
                                <td valign="top" style="width: 40%;" align="center"> </td>
                                <td valign="top" style="width: 10%;" align="center"> </td>
                                <td valign="top" style="width: 40%;" align="center">' . $AsigCur->getNombre() . '</td>
                                <td valign="top" style="width: 10%;" align="center">' . $AsigCur->getId() . '</td>
                        </tr>';
            }
        } elseif (!is_null($aprobadas) && is_null($cursadas)){
            $cantAprobadas = sizeof($aprobadas);
            for ($i = 0; $i < $cantAprobadas; $i++) {
                $AsigAprob = $aprobadas[$i];
                $this->html .= '<tr>
                                <td valign="top" style="width: 40%;" align="center">' . $AsigAprob->getNombre() . '</td>
                                <td valign="top" style="width: 10%;" align="center">' . $AsigAprob->getId() . '</td>
                                <td valign="top" style="width: 40%;" align="center"> </td>
                                <td valign="top" style="width: 10%;" align="center"> </td>
                        </tr>';
            }
        } else {
            $this->html .= '<tr>
                                <td valign="top" style="width: 40%;" align="center"> </td>
                                <td valign="top" style="width: 10%;" align="center"> </td>
                                <td valign="top" style="width: 40%;" align="center"> </td>
                                <td valign="top" style="width: 10%;" align="center"> </td>
                        </tr>
                        <tr>
                                <td valign="top" style="width: 40%;" align="center"> </td>
                                <td valign="top" style="width: 10%;" align="center"> </td>
                                <td valign="top" style="width: 40%;" align="center"> </td>
                                <td valign="top" style="width: 10%;" align="center"> </td>
                        </tr>';
        }
    }
    
    private function cargarFundamentacion (){
        //--------------------FUNDAMENTACION--------------------

        $this->html .= '</tbody>
        </table>

        <br/>
        <br/>

        <table border="1" cellspacing="0" cellpadding="2" > 
                <tbody>
                        <tr>
                                <td valign="top" ><p><b>1- FUNDAMENTACIÓN</b></p></td>
                        </tr>
                        <tr>
                                <td>
                                '.$this->programa->getFundamentacion().'
                                </td>
                        </tr>
                </tbody>
        </table>

        <br/>
        <br/>';
    }
    
    private function cargarContenidosMinimos() {
        $this->html .=  '<table border="1" cellspacing="0" cellpadding="2" > 
                <tbody>
                        <tr>
                                <td valign="top" ><p><b>2- CONTENIDOS MÍNIMOS:</b></p></td>
                        </tr>
                        <tr>
                                <td>'.$this->asignatura->getContenidosMinimos().'</td>
                        </tr>
                </tbody>
        </table>

        <br/>
        <br/>';
    }
    
    private function cargarObjetivosGenerales() {
        $this->html .= '<table border="1" cellspacing="0" cellpadding="2" > 
                <tbody>
                        <tr>
                                <td valign="top" ><p><b>3- OBJETIVOS GENERALES:</b></p></td>
                        </tr>
                        <tr>
                                <td>'.$this->programa->getObjetivosGenerales().'</td>
                        </tr>
                </tbody>
        </table>

        <br/>
        <br/>';
    }
    
    private function cargarOrganizacionContenidos() {
        $this->html .= '<table border="1" cellspacing="0" cellpadding="2" > 
                <tbody>
                        <tr>
                                <td valign="top" ><p><b>4- ORGANIZACIÓN DE LOS CONTENIDOS - PROGRAMA ANALÍTICO</b></p></td>
                        </tr>
                        <tr>
                                <td>'.$this->programa->getOrganizacionContenidos().'</td>
                        </tr>
                </tbody>
        </table>

        <br/>
        <br/>';
    }
    
    private function cargarCriteriosEvaluacion() {
        $this->html .= '<table border="1" cellspacing="0" cellpadding="2" > 
                <tbody>
                        <tr>
                                <td valign="top" ><p><b>5- CRITERIOS DE EVALUACIÓN</b></p></td>
                        </tr>
                        <tr>
                                <td>'.$this->programa->getCriteriosEvaluacion().'</td>
                        </tr>
                </tbody>
        </table>

        <br/>
        <br/>';
    }
    
    private function cargarMetodologiaPresencial() {
        $this->html .= '<table border="1" cellspacing="0" cellpadding="2" > 
                <tbody>
                        <tr>
                                <td valign="top" ><p><b>6- METODOLOGÍA DE TRABAJO PARA LA MODALIDAD PRESENCIAL:</b></p></td>
                        </tr>
                        <tr>
                                <td>'.$this->programa->getMetodologiaPresencial().'</td>
                        </tr>
                </tbody>
        </table>

        <br/>
        <br/>';
    }
    
    private function cargarAcreditacionPresencial() {
        $this->html .= '<table border="1" cellspacing="0" cellpadding="2" > 
                <tbody>
                        <tr>
                                <td valign="top" ><p><b>7- ACREDITACIÓN: Alumnos Presenciales</b></p></td>
                        </tr>
                        <tr>
                                <td valign="top" ><b> Regularización</b></td>
                        </tr>
                        <tr>
                                <td valign="top" >'.$this->programa->getRegularizacionPresencial().'</td>
                        </tr>
                        <tr>
                                <td valign="top" ><b> Promoción</b></td>
                        </tr>
                        <tr>
                                <td valign="top" > </td>
                        </tr>
                        <tr>
                                <td valign="top" > <b>Aprobación Final</b></td>
                        </tr>
                        <tr>
                                <td valign="top" >'.$this->programa->getAprobacionPresencial().'</td>
                        </tr>

                </tbody>
        </table>

        <br/>
        <br/>';
    }
    
    private function cargarMetodologiaSATEP() {
        $this->html .= '<table border="1" cellspacing="0" cellpadding="2" > 
                <tbody>
                        <tr>
                                <td valign="top" ><p><b>8- METODOLOGÍA DE TRABAJO PARA ALUMNOS EN EL SISTEMA DE ASISTENCIA TÉCNICA PEDAGÓGICA (SATEP)</b></p></td>
                        </tr>
                        <tr>
                                <td>'.$this->programa->getMetodologiaSATEP().'</td>
                        </tr>
                </tbody>
        </table>

        <br/>
        <br/>';
    }
    
    private function cargarAcreditacionSATEP() {
        $this->html .= '<table border="1" cellspacing="0" cellpadding="2" > 
                <tbody>
                        <tr>
                                <td valign="top" ><p><b>9- ACREDITACIÓN: Alumnos No Presenciales (SATEP)</b></p></td>
                        </tr>
                        <tr>
                                <td valign="top" ><b> Regularización</b></td>
                        </tr>
                        <tr>
                                <td valign="top" >'.$this->programa->getRegularizacionSATEP().'</td>
                        </tr>
                        <tr>
                                <td valign="top" > <b>Aprobación Final</b></td>
                        </tr>
                        <tr>
                                <td valign="top" >'.$this->programa->getAprobacionSATEP().'</td>
                        </tr>

                </tbody>
        </table>

        <br/>
        <br/>';
    }
    
    private function cargarMetodologiaLibres() {
        $this->html .= '<table border="1" cellspacing="0" cellpadding="2" > 
                <tbody>
                        <tr>
                                <td valign="top" ><p><b>10- METODOLOGÍA DE TRABAJO SUGERIDA PARA EL APRENDIZAJE AUTOASISTIDO (Alumnos Libres)</b></p></td>
                        </tr>
                        <tr>
                                <td>'.$this->programa->getMetodologiaLibre().'</td>
                        </tr>
                </tbody>
        </table>

        <br/>
        <br/>';
    }
    
    private function cargarAcreditacionLibres(){
        $this->html .= '<table border="1" cellspacing="0" cellpadding="2" > 
                <tbody>
                        <tr>
                                <td valign="top" ><p><b>11- ACREDITACIÓN: Alumnos Libres</b></p></td>
                        </tr>
                        <tr>
                                <td>'.$this->programa->getAprobacionLibre().'</td>
                        </tr>
                </tbody>
        </table>

        <br/>
        <br/>';
    }
    
    private function cargarLibros() {
        $LibrosObligatorios = $this->programa->getLibrosObligatorios();
        $LibrosComplementarios = $this->programa->getLibrosComplementarios();

        //Se concatena el html

        $this->html = '<html>
        <head><meta charset="utf-8">
        <style type="text/css">
          body {
            font-family: Arial;
            font-size: 9pt;
            //color: red;
            //background-color: #d8da3d }</style>
        </head>
        <body>';

        //--------------------BIBLIOGRAFIA OBLIGATORA--------------------

        $this->html .= '<table border="1" cellspacing="0" cellpadding="2" style="width: 100%;"> <thead> <tr>
        <td colspan="12" valign="top" >
        12- BIBLIOGRAFÍA <br>
        · Libros (Bibliografía Obligatoria)</td>
        </tr>

        <tr>
                <td valign="top" style="width: 5.3%;"><p align="center">Refer.</p></td>
                <td valign="top" style="width: 14.7%;"><p align="center">Apellido/s</p></td>
                <td valign="top" style="width: 10.7%;"><p align="center">Nombre/s</p></td>
                <td valign="top" style="width: 4.4%;"><p align="center">Año Edición</p></td>
                <td valign="top" style="width: 20%;"><p align="center">Título de la Obra</p></td>
                <td valign="top" style="width: 5.3%;"><p align="center">Capítulo/ Tomo </p></td>
                <td valign="top" style="width: 6.7%;"><p align="center">Lugar de Edición</p></td>
                <td valign="top" style="width: 9.3%;"><p align="center">Editorial</p></td>
                <td valign="top" style="width: 5.3%;"><p align="center">Unidad</p></td>
                <td valign="top" align="center" style="width: 6.5%;"><p>Bibliotec<br>UA</p></td>
                <td valign="top" align="center" style="width: 5.2%;"><p>SIUNPA</p></td>
                <td valign="top" align="center" style="width: 6.6%;"><p>Otro</p></td>
        </tr>

        </thead> 
        <tbody>';

        if ($LibrosObligatorios != NULL){
            foreach ($LibrosObligatorios as $Libro){
            $this->html .= '<tr>
                        <td valign="top" style="width: 5.3%;">'.$Libro->getReferencia().'</td>
                        <td valign="top" style="width: 14.7%;">'.$Libro->getApellido().'</td>
                        <td valign="top" style="width: 10.7%;">'.$Libro->getNombre().'</td>
                        <td valign="top" style="width: 4.4%;">'.$Libro->getAnioEdicion().'</td>
                        <td valign="top" style="width: 20%;">'.$Libro->getTitulo().'</td>
                        <td valign="top" style="width: 5.3%;">'.$Libro->getCapitulo().'</td>
                        <td valign="top" style="width: 6.7%;">'.$Libro->getLugarEdicion().'</td>
                        <td valign="top" style="width: 9.3%;">'.$Libro->getEditorial().'</td>
                        <td valign="top" style="width: 5.3%;">'.$Libro->getUnidad().'</td>
                        <td valign="top" style="width: 6.5%;">'.$Libro->getBiblioteca().'</td>
                        <td valign="top" style="width: 5.2%;">'.$Libro->getSiunpa().'</td>
                        <td valign="top" style="width: 6.6%;">'.$Libro->getOtro().'</td>
                    </tr>';
            }
        }
         else {
            $this->html .= '<tr>
                <td valign="top" style="width: 5.3%;"> </td>
                <td valign="top" style="width: 14.7%;"> </td>
                <td valign="top" style="width: 10.7%;"> </td>
                <td valign="top" style="width: 4.4%;"> </td>
                <td valign="top" style="width: 20%;"> </td>
                <td valign="top" style="width: 5.3%;"> </td>
                <td valign="top" style="width: 6.7%;"> </td>
                <td valign="top" style="width: 9.3%;"> </td>
                <td valign="top" style="width: 5.3%;"> </td>
                <td valign="top" style="width: 6.5%;"> </td>
                <td valign="top" style="width: 5.2%;"> </td>
                <td valign="top" style="width: 6.6%;"> </td>
            </tr>

            <tr>
                <td valign="top" style="width: 5.3%;"> </td>
                <td valign="top" style="width: 14.7%;"> </td>
                <td valign="top" style="width: 10.7%;"> </td>
                <td valign="top" style="width: 4.4%;"> </td>
                <td valign="top" style="width: 20%;"> </td>
                <td valign="top" style="width: 5.3%;"> </td>
                <td valign="top" style="width: 6.7%;"> </td>
                <td valign="top" style="width: 9.3%;"> </td>
                <td valign="top" style="width: 5.3%;"> </td>
                <td valign="top" style="width: 6.5%;"> </td>
                <td valign="top" style="width: 5.2%;"> </td>
                <td valign="top" style="width: 6.6%;"> </td>
            </tr>';
        }

        //--------------------BIBLIOGRAFIA COMPLEMENTARIA--------------------

        $this->html .= '</tbody>
        </table>

        <br/>
        <br/>

        <table border="1" cellspacing="0" cellpadding="2" style="width: 100%;"> <thead> <tr>
        <td colspan="12" valign="top" ><p>· Libros (Bibliografía Complementaria)</p></td>
        </tr>

        <tr>
                <td valign="top" style="width: 5.3%;"><p align="center">Refer.</p></td>
                <td valign="top" style="width: 14.7%;"><p align="center">Apellido/s</p></td>
                <td valign="top" style="width: 10.7%;"><p align="center">Nombre/s</p></td>
                <td valign="top" style="width: 4.4%;"><p align="center">Año Edición</p></td>
                <td valign="top" style="width: 20%;"><p align="center">Título de la Obra</p></td>
                <td valign="top" style="width: 5.3%;"><p align="center">Capítulo/ Tomo </p></td>
                <td valign="top" style="width: 6.7%;"><p align="center">Lugar de Edición</p></td>
                <td valign="top" style="width: 9.3%;"><p align="center">Editorial</p></td>
                <td valign="top" style="width: 5.3%;"><p align="center">Unidad</p></td>
                <td valign="top" style="width: 6.5%;"><p align="center">Bibliotec UA</p></td>
                <td valign="top" style="width: 5.2%;"><p align="center">SIUNPA</p></td>
                <td valign="top" style="width: 6.6%;"><p align="center">Otro</p></td>
        </tr>

        </thead> 
        <tbody>';

        if ($LibrosComplementarios != NULL){
            foreach ($LibrosComplementarios as $Libro){
                $this->html .= '<tr>
                    <td valign="top" style="width: 5.3%;">'.$Libro->getReferencia().'</td>
                    <td valign="top" style="width: 14.7%;">'.$Libro->getApellido().'</td>
                    <td valign="top" style="width: 10.7%;">'.$Libro->getNombre().'</td>
                    <td valign="top" style="width: 4.4%;">'.$Libro->getAnioEdicion().'</td>
                    <td valign="top" style="width: 20%;">'.$Libro->getTitulo().'</td>
                    <td valign="top" style="width: 5.3%;">'.$Libro->getCapitulo().'</td>
                    <td valign="top" style="width: 6.7%;">'.$Libro->getLugarEdicion().'</td>
                    <td valign="top" style="width: 9.3%;">'.$Libro->getEditorial().'</td>
                    <td valign="top" style="width: 5.3%;">'.$Libro->getUnidad().'</td>
                    <td valign="top" style="width: 6.5%;">'.$Libro->getBiblioteca().'</td>
                    <td valign="top" style="width: 5.2%;">'.$Libro->getSiunpa().'</td>
                    <td valign="top" style="width: 6.6%;">'.$Libro->getOtro().'</td>
                    </tr>';
            }
        }
         else {
            $this->html .= '<tr>
                <td valign="top" style="width: 5.3%;"> </td>
                <td valign="top" style="width: 14.7%;"> </td>
                <td valign="top" style="width: 10.7%;"> </td>
                <td valign="top" style="width: 4.4%;"> </td>
                <td valign="top" style="width: 20%;"> </td>
                <td valign="top" style="width: 5.3%;"> </td>
                <td valign="top" style="width: 6.7%;"> </td>
                <td valign="top" style="width: 9.3%;"> </td>
                <td valign="top" style="width: 5.3%;"> </td>
                <td valign="top" style="width: 6.5%;"> </td>
                <td valign="top" style="width: 5.2%;"> </td>
                <td valign="top" style="width: 6.6%;"> </td>
            </tr>

            <tr>
                <td valign="top" style="width: 5.3%;"> </td>
                <td valign="top" style="width: 14.7%;"> </td>
                <td valign="top" style="width: 10.7%;"> </td>
                <td valign="top" style="width: 4.4%;"> </td>
                <td valign="top" style="width: 20%;"> </td>
                <td valign="top" style="width: 5.3%;"> </td>
                <td valign="top" style="width: 6.7%;"> </td>
                <td valign="top" style="width: 9.3%;"> </td>
                <td valign="top" style="width: 5.3%;"> </td>
                <td valign="top" style="width: 6.5%;"> </td>
                <td valign="top" style="width: 5.2%;"> </td>
                <td valign="top" style="width: 6.6%;"> </td>
            </tr>';
        }
    }
    
    private function cargarRevistas(){
        //--------------------ARTICULOS DE REVISTAS--------------------

        $this->html .= '</tbody>
        </table>

        <br/>
        <br/>

        <table border="1" cellspacing="0" cellpadding="2" style="width: 100%;"> <thead> <tr>
        <td colspan="10" valign="top" ><p>· Artículos de Revistas</p></td>
        </tr>

        <tr>
                <td valign="top" style="width: 13.3%;"><p align="center">Apellido/s</p></td>
                <td valign="top" style="width: 12%;"><p align="center">Nombre/s</p></td>
                <td valign="top" style="width: 17.3%;"><p align="center">Título del Artículo</p></td>
                <td valign="top" style="width: 17.3%;"><p align="center">Título de la Revista</p></td>
                <td valign="top" style="width: 10.7%;"><p align="center">Tomo/Volumen/ Pág.</p></td>
                <td valign="top" style="width: 5.88%;"><p align="center">Fecha</p></td>
                <td valign="top" style="width: 5.88%;"><p align="center">Unidad</p></td>
                <td valign="top" style="width: 5.88%;"><p align="center">Bibliotec UA</p></td>
                <td valign="top" style="width: 5.88%;"><p align="center">SIUNPA</p></td>
                <td valign="top" style="width: 5.88%;"><p align="center">Otro</p></td>
        </tr>

        </thead> 
        <tbody>';

        $Revistas = $this->programa->getRevistas();
        if ($Revistas != NULL){
            foreach ($Revistas as $Revista){
                $this->html .= '<tr>
                    <td valign="top" style="width: 13.3%;">'.$Revista->getApellido().'</td>
                    <td valign="top" style="width: 12%;">'.$Revista->getNombre().'</td>
                    <td valign="top" style="width: 17.3%;">'.$Revista->getTituloArticulo().'</td>
                    <td valign="top" style="width: 17.3%;">'.$Revista->getTituloRevista().'</td>
                    <td valign="top" style="width: 10.7%;">'.$Revista->getPagina().'</td>
                    <td valign="top" style="width: 5.88%;">'.$Revista->getFecha().'</td>
                    <td valign="top" style="width: 5.88%;">'.$Revista->getUnidad().'</td>
                    <td valign="top" style="width: 5.88%;">'.$Revista->getBiblioteca().'</td>
                    <td valign="top" style="width: 5.88%;">'.$Revista->getSiunpa().'</td>
                    <td valign="top" style="width: 5.88%;">'.$Revista->getOtro().'</td>
                </tr>';
            }
        }
        else{
            $this->html .= '<tr>
                <td valign="top" style="width: 13.3%;"> </td>
                <td valign="top" style="width: 12%;"> </td>
                <td valign="top" style="width: 17.3%;"> </td>
                <td valign="top" style="width: 17.3%;"> </td>
                <td valign="top" style="width: 10.7%;"> </td>
                <td valign="top" style="width: 5.88%;"> </td>
                <td valign="top" style="width: 5.88%;"> </td>
                <td valign="top" style="width: 5.88%;"> </td>
                <td valign="top" style="width: 5.88%;"> </td>
                <td valign="top" style="width: 5.88%;"> </td>
            </tr>

            <tr>
                <td valign="top" style="width: 13.3%;"> </td>
                <td valign="top" style="width: 12%;"> </td>
                <td valign="top" style="width: 17.3%;"> </td>
                <td valign="top" style="width: 17.3%;"> </td>
                <td valign="top" style="width: 10.7%;"> </td>
                <td valign="top" style="width: 5.88%;"> </td>
                <td valign="top" style="width: 5.88%;"> </td>
                <td valign="top" style="width: 5.88%;"> </td>
                <td valign="top" style="width: 5.88%;"> </td>
                <td valign="top" style="width: 5.88%;"> </td>
            </tr>';
        }
    }
    
    private function cargarRecursosInternet() {
        //--------------------RECURSOS EN INTERNET--------------------

        $this->html .= '</tbody>
        </table>

        <br/>
        <br/>

        <table border="1" cellspacing="0" cellpadding="2" style="width: 100%;"> <thead> <tr>
        <td colspan="5" valign="top" ><p>· Recursos en Internet</p></td>
        </tr>

        <tr>
                <td valign="top" style="width: 14.7%;"><p align="center">Autor/es Apellido/s</p></td>
                <td valign="top" style="width: 13.3%;"><p align="center">Autor/es Nombre/s</p></td>
                <td valign="top" style="width: 25.3%;"><p align="center">Título </p></td>
                <td valign="top" style="width: 22.7%;"><p align="center">Datos adicionales</p></td>
                <td valign="top" style="width: 24%;"><p align="center">Disponibilidad / Dirección electrónica</p></td>
        </tr>

        </thead> 
        <tbody>';

        $Recursos = $this->programa->getRecursos();
        if ($Recursos != NULL){
            foreach ($Recursos as $Recurso){
                $this->html .= '<tr>
                        <td valign="top" style="width: 14.7%;">'.$Recurso->getApellido().'</td>
                        <td valign="top" style="width: 13.3%;">'.$Recurso->getNombre().'</td>
                        <td valign="top" style="width: 25.3%;">'.$Recurso->getTitulo().'</td>
                        <td valign="top" style="width: 22.7%;">'.$Recurso->getDatosAdicionales().'</td>
                        <td valign="top" style="width: 24%;">'.$Recurso->getDisponibilidad().'</td>
                    </tr>';
            }
        }
        else{
            $this->html .= '<tr>
                    <td valign="top" style="width: 14.7%;"> </td>
                    <td valign="top" style="width: 13.3%;"> </td>
                    <td valign="top" style="width: 25.3%;"> </td>
                    <td valign="top" style="width: 22.7%;"> </td>
                    <td valign="top" style="width: 24%;"> </td>
                </tr>

                <tr>
                    <td valign="top" style="width: 14.7%;"> </td>
                    <td valign="top" style="width: 13.3%;"> </td>
                    <td valign="top" style="width: 25.3%;"> </td>
                    <td valign="top" style="width: 22.7%;"> </td>
                    <td valign="top" style="width: 24%;"> </td>
                </tr>';
        }
    }
    
    private function cargarOtrosMateriales() {
        //--------------------OTROS MATERIALES--------------------

        $this->html .= '</tbody>
        </table>

        <br/>
        <br/>

        <table border="1" cellspacing="0" cellpadding="2" > 
        <tbody>
        <tr>
                <td valign="top" ><p>· Otros Materiales</p></td>
        </tr>';

        $OtrosMateriales = $this->programa->getOtroMateriales();
        if ($OtrosMateriales != NULL){
            foreach ($OtrosMateriales as $OtroMaterial){
                $this->html .= '<tr>
                        <td valign="top" >'.$OtroMaterial->getDescripcion().'</td>
                    </tr>';
            }
        }
        else{
            $this->html .= '<tr>
                    <td valign="top" > </td>
                </tr>
                <tr>
                    <td valign="top" > </td>
                </tr>';
        }

        $this->html .= '</tbody>
        </table></body></html>';
    }
    
    private function cargarVigencia() {
        //--------------------13- VIGENCIA DEL PROGRAMA--------------------
        //
        //Nota ver porque la primera tabla de esta seccion se desplaza apenas a la derecha sin el <br/>
        //que se encuentra antes de la primera tabla
        //
        //Se concatena el html
        $this->html = '<html><head><meta charset="utf-8">
                <style type="text/css">
                    table {
                    font-family: Arial;
                    font-size: 9pt;
                    }</style>
                </head><body><br/>
        <table border="1" cellspacing="0" cellpadding="2" style="width: 100%;"> 
            <thead>
                <tr>
                    <th colspan="3" valign="top" ><p><b>13- VIGENCIA DEL PROGRAMA</b></p></th>
                </tr>

                <tr>
                        <th valign="top" style="width: 20%;"><p align="center">AÑO</p></th>
                        <th valign="top" style="width: 35%;"><p align="center">Firma Profesor Responsable</p></th>
                        <th valign="top" style="width: 45%;"><p align="center">Aclaración Firma</p></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                        <td valign="top" height="40" style="width: 20%;"> </td>
                        <td valign="top" height="40" style="width: 35%;"> </td>
                        <td valign="top" height="40" style="width: 45%;"> </td>
                </tr>

                <tr>
                        <td valign="top" height="40" style="width: 20%;"> </td>
                        <td valign="top" height="40" style="width: 35%;"> </td>
                        <td valign="top" height="40" style="width: 45%;"> </td>
                </tr>

                <tr>
                        <td valign="top" height="40" style="width: 20%;"> </td>
                        <td valign="top" height="40" style="width: 35%;"> </td>
                        <td valign="top" height="40" style="width: 45%;"> </td>
                </tr>

                <tr>
                        <td valign="top" height="40" style="width: 20%;"> </td>
                        <td valign="top" height="40" style="width: 35%;"> </td>
                        <td valign="top" height="40" style="width: 45%;"> </td>
                </tr>

                <tr>
                        <td valign="top" height="40" style="width: 20%;"> </td>
                        <td valign="top" height="40" style="width: 35%;"> </td>
                        <td valign="top" height="40" style="width: 45%;"> </td>
                </tr>
            </tbody>
        </table>

        <br/>
        <br/>
        <br/>';
    }
    
    private function cargarObservaciones() {
        $this->html .= '<table border="1" cellspacing="0" cellpadding="2" > 
        <tbody>
        <tr>
                <td valign="top" ><p><b>14- Observaciones</b></p></td>
        </tr>

        <tr>
                <td valign="top" ><p>El presente programa se considera un documento que, a modo de "contrato pedagógico", relaciona a los protagonistas del proceso de enseñanza-aprendizaje y constituye un acuerdo entre la Universidad y el Alumno.
                <br>Los cuatrimestres tienen como mínimo una duración de 15 semanas.<br></p>
                </td>
        </tr>

        </tbody>
        </table>

        <br/>
        <br/>
        <br/>';
    }
    
    private function cargarVisado() {
        $this->html .= '<table border="1" cellspacing="0" cellpadding="2" > 
        <tbody>
        <tr>
                <td colspan="3" height="40"><p align="center">&nbsp;<br><b>VISADO</b></p></td>
        </tr>

        <tr>
                <td valign="top" height="40"><p align="center">&nbsp;<br><b>División</b></p></td>
                <td valign="top" height="40"><p align="center">&nbsp;<br><b>Departamento</b></p></td>
                <td valign="top" height="40"><p align="center">&nbsp;<br><b>Secretaria Académica</b></p></td>
        </tr>

        <tr>
                <td valign="top" height="60"> </td>
                <td valign="top" height="60"> </td>
                <td valign="top" height="60"> </td>
        </tr>

        <tr>
                <td valign="top" height="40"><p>&nbsp;<br>Fecha:</p></td>
                <td valign="top" height="40"><p>&nbsp;<br>Fecha:</p></td>
                <td valign="top" height="40"><p>&nbsp;<br>Fecha:</p></td>
        </tr>

        </tbody>
        </table>';
        $this->html .= '</body></html>';
    }
    
    private function cargarVisado2() {
        $this->html = '<html><head><meta charset="utf-8">
                <style type="text/css">
                    table {
                    font-family: Arial;
                    font-size: 9pt;
                    }</style>
                </head><body><br/>
            <table border="1" cellspacing="0" cellpadding="2" > 
        <tbody>
        <tr>
                <td colspan="3" height="40"><p align="center">&nbsp;<br><b>VISADO</b></p></td>
        </tr>

        <tr>
                <td valign="top" height="40"><p align="center">&nbsp;<br><b>División</b></p></td>
                <td valign="top" height="40"><p align="center">&nbsp;<br><b>Departamento</b></p></td>
                <td valign="top" height="40"><p align="center">&nbsp;<br><b>Secretaria Académica</b></p></td>
        </tr>

        <tr>
                <td valign="top" height="60"> </td>
                <td valign="top" height="60"> </td>
                <td valign="top" height="60"> </td>
        </tr>

        <tr>
                <td valign="top" height="40"><p>&nbsp;<br>Fecha:</p></td>
                <td valign="top" height="40"><p>&nbsp;<br>Fecha:</p></td>
                <td valign="top" height="40"><p>&nbsp;<br>Fecha:</p></td>
        </tr>

        </tbody>
        </table>';
        $this->html .= '</body></html>';
    }
    
    private function cargarDatosPrograma() {
        $this->setearParametros();
        // Se agrega la primera pagina
        parent::AddPage();
        $this->setearInformacionDocumento();
        $this->cargarTablaCicloAcademico();
        $this->cargarTablaDocentes();
        $this->cargarCorrelativasPrecedentes();
        $this->cargarCorrelativasSubsiguientes();
        $this->cargarFundamentacion();
        $this->cargarContenidosMinimos();
        $this->cargarObjetivosGenerales();
        $this->cargarOrganizacionContenidos();
        $this->cargarCriteriosEvaluacion();
        $this->cargarMetodologiaPresencial();
        $this->cargarAcreditacionPresencial();
        $this->cargarMetodologiaSATEP();
        $this->cargarAcreditacionSATEP();
        $this->cargarMetodologiaLibres();
        $this->cargarAcreditacionLibres();
        
        // Se pasa el html al PDF
        parent::writeHTML($this->html, true, false, true, false, '');

        // Se inserta una pagina con orientación horizontal
        parent::Addpage('L');
        
        $this->cargarLibros();
        $this->cargarRevistas();
        $this->cargarRecursosInternet();
        $this->cargarOtrosMateriales();
        
        //Se pasa el html al PDF
        parent::writeHTML($this->html, true, false, true, false, '');

        //Se inserta pagina con orientación vertical
        parent::Addpage("P");
        
        $this->cargarVigencia();
        $this->cargarObservaciones();
        
        // chequeamos la cantidad de carreras si es mayor a 12
        // agregamos una nueva pagina en donde se agregara la tabla "VISADO"
        if ($this->getCantidadCarreras() > 12){
            //Se pasa el html al PDF
            parent::writeHTML($this->html, true, false, true, false, '');
            
            //Se inserta pagina con orientación vertical
            parent::Addpage("P");
            $this->cargarVisado2();
            //Se pasa el html al PDF
            parent::writeHTML($this->html, true, false, true, false, '');
        } else {
            
            // como no tiene mas de 12 asignaturas lo agregamos en la misma pagina
            $this->cargarVisado();
        
            //Se pasa el html al PDF
            parent::writeHTML($this->html, true, false, true, false, '');
        }
        
    }
    
    public function generarPDFprograma() {
        $this->cargarDatosPrograma();
        //Se genera la salida del PDF
        $nombrePrograma = 'Programa de '.$this->asignatura->getNombre().' - '.$this->asignatura->getId();
        parent::Output(sanear_string($nombrePrograma).'.pdf', 'I');
    }
    
    
}
