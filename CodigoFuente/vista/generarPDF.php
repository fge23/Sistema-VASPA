<?php 
require_once('../modeloSistema/BDConexionSistema.Class.php');
include('../lib/tcpdf/tcpdf.php');
include_once '../modeloSistema/Programa.Class.php';
include_once '../modeloSistema/Asignatura.Class.php';
include_once '../modeloSistema/Libro.Class.php';
include_once '../modeloSistema/Revista.Class.php';
include_once '../modeloSistema/Recurso.Class.php';
include_once '../modeloSistema/OtroMaterial.Class.php';
include_once '../modeloSistema/Profesor.Class.php';
include_once '../modeloSistema/Departamento.Class.php';

/*
Observaciones si se quiere obtener el programa de Gestión de Proyectos de Software
	la variable idPrograma asignarle el id correspondiente 
	(hay dos variables idPrograma una es de la clase MYPDF (se encuentra en la funcion Header()) y otra del "principal", modificar con el mismo valor las dos)
*/


$idPrograma = $_GET['id'];

class MYPDF extends TCPDF {

    
    public function Header() {
    	
        $idPrograma = $_GET['id'];
        $Programa = new Programa($idPrograma);
    	$Asignatura = $Programa->getAsignatura();
        $Carreras = $Asignatura->getCarreras();
              
        //Concatenamos el html
        $tbl ='';
        $tbl .= '
                <table cellspacing="0" cellpadding="1" border="1">
                    <tr>
                        <td colspan="1" align="center"><img src="../lib/img/logo-UNPA-programa.jpg"/></td>
                        <td colspan="1" align="center"><b><br><br><br>UNIVERSIDAD NACIONAL <br> DE LA PATAGONIA <br> AUSTRAL <br> Unidad Académica <br> Río Gallegos</b></td>
        
                    </tr>
                </table>
                <table cellspacing="0" cellpadding="1" border="1">
                    <tr>
                        <td colspan="6"><b>Programa de: '.utf8_encode($Asignatura->getNombre()).'</b></td>
                        <td><b>Cod. Asig.</b></td>
                        <td><b> '.$Asignatura->getId().'</b></td>
                    </tr>
                </table>    
                <table cellspacing="0" cellpadding="1" border="1">';
                
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
    
   
    public function Footer() {
        
        // Posicion a 15 mm
        $this->SetY(-15);
        
        $foot = <<<EOD
                
                <table cellspacing="0" cellpadding="1" border="1">
                    <tr>
                        <td colspan="6"><b>VIGENCIA AÑOS </b></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>    
EOD;

       $this->writeHTML($foot, true, false, false, false, '');
       
       $this->Cell(0,10,'Página'.$this->getAliasNumPage().'/'.$this->getAliasNbPages(),0,false,'R',0,'',false,'T','M');  
    }
}


// Creo el nuevo documento PDF
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT,'A4' , true, 'UTF-8', false);


// Seteo las fuentes del encabezado y del pie de pagina
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));


// Seteo los margenes 
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);


// Seteo los cortes automaticos de las paginas 
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);


// Seteo la escala de la imagen 
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// Seteo el margen superior
//poner a 64 si se trata de una materia
$pdf->setTopMargin(68);

// Se agrega la primera pagina
$pdf->Addpage();

$Programa = new Programa($idPrograma);
$Asignatura = $Programa->getAsignatura();
$ProfesoresPractica = $Asignatura->getProfesoresPractica();
$profesorResponsable = new Profesor($Asignatura->getIdProfesor());
$departamento = new Departamento($profesorResponsable->getIdDepartamento());

// Concatenamos el html
$html = '';
$html .= '
<html>
<head><meta charset="utf-8">
</head>
<body><table border="1" cellspacing="0" cellpadding="0"> 
	<tbody>
	<tr>
		<td colspan="8" valign="top" ><p>Ciclo Académico:</p></td>
	</tr>

	<tr>
		<td valign="top" ><p align="center">Año de la Carrera:</p></td>
		<td colspan="3" valign="top" ><p align="center">Horas de Clases Semanales</p></td>
		<td colspan="4" valign="top" ><p align="center">Régimen de Cursado</p></td>
	</tr>

	<tr>
		<td rowspan="2" valign="top" align="center"> '.$Programa->getAnioCarrera().'°</td>
		<td valign="top" ><p align="center">Teoría</p></td>
		<td valign="top" ><p align="center">Práctica</p></td>
		<td valign="top" ><p align="center">Otros (1)</p></td>
		<td valign="top" ><p align="center">Anual</p></td>
		<td valign="top" ><p align="center">1er.Cuatr.</p></td>
		<td valign="top" ><p align="center">2do.Cuatr.</p></td>
		<td valign="top" ><p align="center">Otros (2)</p></td>
	</tr>

	<tr>
		<td valign="top" align="center"> '.$Programa->getHorasTeoria().' </td>
		<td valign="top" align="center"> '.$Programa->getHorasPractica().' </td>
		<td valign="top" align="center"> '.$Programa->getHorasOtros().' </td>';
		
		//Se marca con una "X" la celda correspondiente según el regimen de cursada de la materia
		if ($Programa->getRegimenCursada() == 'A') {
			$html .= '<td valign="top" align="center"> X </td>';
		}
		else{
			$html .= '<td valign="top" align="center">  </td>';
		}

		if ($Programa->getRegimenCursada() == '1') {
			$html .= '<td valign="top" align="center"> X </td>';
		}
		else{
			$html .= '<td valign="top" align="center">  </td>';
		}

		if ($Programa->getRegimenCursada() == '2') {
			$html .= '<td valign="top" align="center"> X </td>';
		}
		else{
			$html .= '<td valign="top" align="center">  </td>';
		}

		if ($Programa->getRegimenCursada() == 'O') {
			$html .= '<td valign="top" align="center"> X </td>';
		}
		else{
			$html .= '<td valign="top" align="center">  </td>';
		}


$html .= '</tr>

	<tr>
		<td colspan="8" valign="top" ><p>(1) Observaciones: '.$Programa->getObservacionesHoras().'</p></td>
	</tr>

	<tr>
		<td colspan="8" valign="top" ><p>(2) Observaciones: '.$Programa->getObservacionesCursada().'</p></td>
	</tr>

	</tbody>
</table>

<br/>
<br/>

<table border="1" cellspacing="0" cellpadding="0" > 
	<tbody>
	<tr>
		<td colspan="4" valign="top" align="center"><p>Docente/s</p></td>
	</tr>

	<tr>
		<td colspan="2" valign="top" ><p align="center">Teoría</p></td>
		<td colspan="2" valign="top" ><p align="center">Práctica</p></td>
	</tr>

	<tr>
		<td valign="top" ><p align="center">Apellido y Nombres</p></td>
		<td valign="top" ><p align="center">Departamento/División</p></td>
		<td valign="top" ><p align="center">Apellido y Nombres</p></td>
		<td valign="top" ><p align="center">Departamento/División</p></td>
	</tr>

	<tr>
		<td valign="top" > '.utf8_encode($profesorResponsable->getApellido()).', '.utf8_encode($profesorResponsable->getNombre()).'</td>
		<td valign="top" > '.utf8_encode($departamento->getNombre()).' </td>
		<td valign="top" > </td>
		<td valign="top" > </td>
	</tr>

	<tr>
		<td valign="top" > </td>
		<td valign="top" > </td>
		<td valign="top" > </td>
		<td valign="top" > </td>
	</tr>

	</tbody>
</table>

<br/>
<br/>

<table border="1" cellspacing="0" cellpadding="0" > 
	<tbody>
		<tr>
			<td colspan="4" valign="top" ><p align="center">Espacios Curriculares Correlativos Precedentes</p></td>
		</tr>

		<tr>
			<td valign="top" ><p align="center">Aprobada/s</p></td>
			<td valign="top" ><p align="center">Cod. Asig.</p></td>
			<td valign="top" ><p align="center">Cursada/s</p></td>
			<td valign="top" ><p align="center">Cod. Asig.</p></td>
		</tr>

		<tr>
			<td valign="top" > </td>
			<td valign="top" > </td>
			<td valign="top" > </td>
			<td valign="top" > </td>
		</tr>

		<tr>
			<td valign="top" > </td>
			<td valign="top" > </td>
			<td valign="top" > </td>
			<td valign="top" > </td>
		</tr>

	</tbody>
</table>

<br/>
<br/>

<table border="1" cellspacing="0" cellpadding="0" > 
	<tbody>
		<tr>
			<td colspan="4" valign="top" ><p align="center">Espacios Curriculares Correlativos Subsiguientes</p></td>
		</tr>

		<tr>
			<td valign="top" ><p align="center">Aprobada/s</p></td>
			<td valign="top" ><p align="center">Cod. Asig.</p></td>
			<td valign="top" ><p align="center">Cursada/s</p></td>
			<td valign="top" ><p align="center">Cod. Asig.</p></td>
		</tr>

		<tr>
			<td valign="top" > </td>
			<td valign="top" > </td>
			<td valign="top" > </td>
			<td valign="top" > </td>
		</tr>

		<tr>
			<td valign="top" > </td>
			<td valign="top" > </td>
			<td valign="top" > </td>
			<td valign="top" > </td>
		</tr>

	</tbody>
</table>


<br/>
<br/>


<table border="1" cellspacing="0" cellpadding="0" > 
	<tbody>
		<tr>
			<td valign="top" ><p><b>1- FUNDAMENTACIÓN</b></p></td>
		</tr>
		<tr>
			<td>
			'.utf8_encode($Programa->getFundamentacion()).'
			</td>
		</tr>
	</tbody>
</table>


<br/>
<br/>


<table border="1" cellspacing="0" cellpadding="0" > 
	<tbody>
		<tr>
			<td valign="top" ><p><b>2- CONTENIDOS MÍNIMOS:</b></p></td>
		</tr>
		<tr>
			<td>'.utf8_encode($Asignatura->getContenidosMinimos()).'</td>
		</tr>
	</tbody>
</table>


<br/>
<br/>


<table border="1" cellspacing="0" cellpadding="0" > 
	<tbody>
		<tr>
			<td valign="top" ><p><b>3- OBJETIVOS GENERALES:</b></p></td>
		</tr>
		<tr>
			<td>'. utf8_encode($Programa->getObjetivosGenerales()).'</td>
		</tr>
	</tbody>
</table>


<br/>
<br/>


<table border="1" cellspacing="0" cellpadding="0" > 
	<tbody>
		<tr>
			<td valign="top" ><p><b>4- ORGANIZACIÓN DE LOS CONTENIDOS - PROGRAMA ANALÍTICO</b></p></td>
		</tr>
		<tr>
			<td>'. utf8_encode($Programa->getOrganizacionContenidos()).'</td>
		</tr>
	</tbody>
</table>


<br/>
<br/>


<table border="1" cellspacing="0" cellpadding="0" > 
	<tbody>
		<tr>
			<td valign="top" ><p><b>5- CRITERIOS DE EVALUACIÓN</b></p></td>
		</tr>
		<tr>
			<td>'.utf8_encode($Programa->getCriteriosEvaluacion()).'</td>
		</tr>
	</tbody>
</table>


<br/>
<br/>


<table border="1" cellspacing="0" cellpadding="0" > 
	<tbody>
		<tr>
			<td valign="top" ><p><b>6- METODOLOGÍA DE TRABAJO PARA LA MODALIDAD PRESENCIAL:</b></p></td>
		</tr>
		<tr>
			<td>'.utf8_encode($Programa->getMetodologiaPresencial()).'</td>
		</tr>
	</tbody>
</table>


<br/>
<br/>


<table border="1" cellspacing="0" cellpadding="0" > 
	<tbody>
		<tr>
			<td valign="top" ><p><b>7- ACREDITACIÓN: Alumnos Presenciales</b></p></td>
		</tr>
		<tr>
			<td valign="top" ><b> Regularización</b></td>
		</tr>
		<tr>
			<td valign="top" >'.utf8_encode($Programa->getRegularizacionPresencial()).'</td>
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
			<td valign="top" >'. utf8_encode($Programa->getAprobacionPresencial()).'</td>
		</tr>

	</tbody>
</table>


<br/>
<br/>


<table border="1" cellspacing="0" cellpadding="0" > 
	<tbody>
		<tr>
			<td valign="top" ><p><b>8- METODOLOGÍA DE TRABAJO PARA ALUMNOS EN EL SISTEMA DE ASISTENCIA TÉCNICA PEDAGÓGICA (SATEP)</b></p></td>
		</tr>
		<tr>
			<td>'. utf8_encode($Programa->getMetodologiaSATEP()).'</td>
		</tr>
	</tbody>
</table>


<br/>
<br/>


<table border="1" cellspacing="0" cellpadding="0" > 
	<tbody>
		<tr>
			<td valign="top" ><p><b>9- ACREDITACIÓN: Alumnos No Presenciales (SATEP)</b></p></td>
		</tr>
		<tr>
			<td valign="top" ><b> Regularización</b></td>
		</tr>
		<tr>
			<td valign="top" >'. utf8_encode($Programa->getRegularizacionSATEP()).'</td>
		</tr>
		<tr>
			<td valign="top" > <b>Aprobación Final</b></td>
		</tr>
		<tr>
			<td valign="top" >'. utf8_encode($Programa->getAprobacionSATEP()).'</td>
		</tr>

	</tbody>
</table>


<br/>
<br/>


<table border="1" cellspacing="0" cellpadding="0" > 
	<tbody>
		<tr>
			<td valign="top" ><p><b>10- METODOLOGÍA DE TRABAJO SUGERIDA PARA EL APRENDIZAJE AUTOASISTIDO (Alumnos Libres)</b></p></td>
		</tr>
		<tr>
			<td>'. utf8_encode($Programa->getMetodologiaLibre()).'</td>
		</tr>
	</tbody>
</table>


<br/>
<br/>


<table border="1" cellspacing="0" cellpadding="0" > 
	<tbody>
		<tr>
			<td valign="top" ><p><b>11- ACREDITACIÓN: Alumnos Libres</b></p></td>
		</tr>
		<tr>
			<td>'. utf8_encode($Programa->getAprobacionLibre()).'</td>
		</tr>
	</tbody>
</table>


<br/>
<br/>';

// Se pasa el html al PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Se inserta una pagina con orientación horizontal
$pdf->Addpage('L');

$LibrosObligatorios = $Programa->getLibrosObligatorios();
$LibrosComplementarios = $Programa->getLibrosComplementarios();

//Se concatena el html
$html = '<table border="1" cellspacing="0" cellpadding="0" > <thead> <tr>
<td colspan="12" valign="top" ><p>· Libros (Bibliografía Básica)</p></td>
</tr>

<tr>
	<td valign="top" ><p align="center">Refer.</p></td>
	<td valign="top" ><p align="center">Apellido/s</p></td>
	<td valign="top" ><p align="center">Nombre/s</p></td>
	<td valign="top" ><p align="center">Año Edición</p></td>
	<td valign="top" ><p align="center">Título de la Obra</p></td>
	<td valign="top" ><p align="center">Capítulo/ Tomo </p></td>
	<td valign="top" ><p align="center">Lugar de Edición</p></td>
	<td valign="top" ><p align="center">Editorial</p></td>
	<td valign="top" ><p align="center">Unidad</p>
	<p align="center">opcional</p></td>
	<td valign="top" align="center"><p>Bibliotec UA</p></td>
	<td valign="top" align="center"><p>SIUNPA</p></td>
	<td valign="top" align="center"><p>Otro</p></td>
</tr>

</thead> 
<tbody>';

if ($LibrosObligatorios != NULL){
    foreach ($LibrosObligatorios as $Libro){
    $html .= '<tr>
            <td valign="top" >'.utf8_encode($Libro->getReferencia()).'</td>
            <td valign="top" >'.utf8_encode($Libro->getApellido()).'</td>
            <td valign="top" >'.utf8_encode($Libro->getNombre()).'</td>
            <td valign="top" >'.utf8_encode($Libro->getAnioEdicion()).'</td>
            <td valign="top" >'.utf8_encode($Libro->getTitulo()).'</td>
            <td valign="top" >'.utf8_encode($Libro->getCapitulo()).'</td>
            <td valign="top" >'.utf8_encode($Libro->getLugarEdicion()).'</td>
            <td valign="top" >'.utf8_encode($Libro->getEditorial()).'</td>
            <td valign="top" >'.utf8_encode($Libro->getUnidad()).'</td>
            <td valign="top" >'.utf8_encode($Libro->getBiblioteca()).'</td>
            <td valign="top" >'.utf8_encode($Libro->getSiunpa()).'</td>
            <td valign="top" >'.utf8_encode($Libro->getOtro()).'</td>
            </tr>';
    }
}
 else {
    $html .= '<tr>
	<td valign="top" > </td>
	<td valign="top" > </td>
	<td valign="top" > </td>
	<td valign="top" > </td>
	<td valign="top" > </td>
	<td valign="top" > </td>
	<td valign="top" > </td>
	<td valign="top" > </td>
	<td valign="top" > </td>
	<td valign="top" > </td>
	<td valign="top" > </td>
	<td valign="top" > </td>
    </tr>

    <tr>
	<td valign="top" > </td>
	<td valign="top" > </td>
	<td valign="top" > </td>
	<td valign="top" > </td>
	<td valign="top" > </td>
	<td valign="top" > </td>
	<td valign="top" > </td>
	<td valign="top" > </td>
	<td valign="top" > </td>
	<td valign="top" > </td>
	<td valign="top" > </td>
	<td valign="top" > </td>
    </tr>';
}

$html .= '</tbody>
</table>


<br/>
<br/>


<table border="1" cellspacing="0" cellpadding="0" > <thead> <tr>
<td colspan="12" valign="top" ><p>· Libros (Bibliografía Complementaria)</p></td>
</tr>

<tr>
	<td valign="top" ><p align="center">Refer.</p></td>
	<td valign="top" ><p align="center">Apellido/s</p></td>
	<td valign="top" ><p align="center">Nombre/s</p></td>
	<td valign="top" ><p align="center">Año Edición</p></td>
	<td valign="top" ><p align="center">Título de la Obra</p></td>
	<td valign="top" ><p align="center">Capítulo/ Tomo </p></td>
	<td valign="top" ><p align="center">Lugar de Edición</p></td>
	<td valign="top" ><p align="center">Editorial</p></td>
	<td valign="top" ><p align="center">Unidad</p>

	<p align="center">opcional</p></td>
	<td valign="top" ><p align="center">Bibliotec UA</p></td>
	<td valign="top" ><p align="center">SIUNPA</p></td>
	<td valign="top" ><p align="center">Otro</p></td>
</tr>

</thead> 
<tbody>';


if ($LibrosComplementarios != NULL){
    foreach ($LibrosComplementarios as $Libro){
    $html .= '<tr>
            <td valign="top" >'.utf8_encode($Libro->getReferencia()).'</td>
            <td valign="top" >'.utf8_encode($Libro->getApellido()).'</td>
            <td valign="top" >'.utf8_encode($Libro->getNombre()).'</td>
            <td valign="top" >'.utf8_encode($Libro->getAnioEdicion()).'</td>
            <td valign="top" >'.utf8_encode($Libro->getTitulo()).'</td>
            <td valign="top" >'.utf8_encode($Libro->getCapitulo()).'</td>
            <td valign="top" >'.utf8_encode($Libro->getLugarEdicion()).'</td>
            <td valign="top" >'.utf8_encode($Libro->getEditorial()).'</td>
            <td valign="top" >'.utf8_encode($Libro->getUnidad()).'</td>
            <td valign="top" >'.utf8_encode($Libro->getBiblioteca()).'</td>
            <td valign="top" >'.utf8_encode($Libro->getSiunpa()).'</td>
            <td valign="top" >'.utf8_encode($Libro->getOtro()).'</td>
            </tr>';
    }
}
 else {
    $html .= '<tr>
	<td valign="top" > </td>
	<td valign="top" > </td>
	<td valign="top" > </td>
	<td valign="top" > </td>
	<td valign="top" > </td>
	<td valign="top" > </td>
	<td valign="top" > </td>
	<td valign="top" > </td>
	<td valign="top" > </td>
	<td valign="top" > </td>
	<td valign="top" > </td>
	<td valign="top" > </td>
    </tr>

    <tr>
	<td valign="top" > </td>
	<td valign="top" > </td>
	<td valign="top" > </td>
	<td valign="top" > </td>
	<td valign="top" > </td>
	<td valign="top" > </td>
	<td valign="top" > </td>
	<td valign="top" > </td>
	<td valign="top" > </td>
	<td valign="top" > </td>
	<td valign="top" > </td>
	<td valign="top" > </td>
    </tr>';
}

$html .= '</tbody>
</table>


<br/>
<br/>


<table border="1" cellspacing="0" cellpadding="0" > <thead> <tr>
<td colspan="10" valign="top" ><p>· Artículos de Revistas</p></td>
</tr>

<tr>
	<td valign="top" ><p align="center">Apellido/s</p></td>
	<td valign="top" ><p align="center">Nombre/s</p></td>
	<td valign="top" ><p align="center">Título del Artículo</p></td>
	<td valign="top" ><p align="center">Título de la Revista</p></td>
	<td valign="top" ><p align="center">Tomo/Volumen/ Pág.</p></td>
	<td valign="top" ><p align="center">Fecha</p></td>
	<td valign="top" ><p align="center">Unidad</p></td>
	<td valign="top" ><p align="center">Bibliotec UA</p></td>
	<td valign="top" ><p align="center">SIUNPA</p></td>
	<td valign="top" ><p align="center">Otro</p></td>
</tr>

</thead> 
<tbody>';

$Revistas = $Programa->getRevistas();
if ($Revistas != NULL){
    foreach ($Revistas as $Revista){
        $html .= '<tr>
            <td valign="top" >'.utf8_encode($Revista->getApellido()).'</td>
            <td valign="top" >'.utf8_encode($Revista->getNombre()).'</td>
            <td valign="top" >'.utf8_encode($Revista->getTituloArticulo()).'</td>
            <td valign="top" >'.utf8_encode($Revista->getTituloRevista()).'</td>
            <td valign="top" >'.utf8_encode($Revista->getPagina()).'</td>
            <td valign="top" >'.utf8_encode($Revista->getFecha()).'</td>
            <td valign="top" >'.utf8_encode($Revista->getUnidad()).'</td>
            <td valign="top" >'.utf8_encode($Revista->getBiblioteca()).'</td>
            <td valign="top" >'.utf8_encode($Revista->getSiunpa()).'</td>
            <td valign="top" >'.utf8_encode($Revista->getOtro()).'</td>
        </tr>';
    }
}
else{
    $html .= '<tr>
	<td valign="top" > </td>
	<td valign="top" > </td>
	<td valign="top" > </td>
	<td valign="top" > </td>
	<td valign="top" > </td>
	<td valign="top" > </td>
	<td valign="top" > </td>
	<td valign="top" > </td>
	<td valign="top" > </td>
	<td valign="top" > </td>
    </tr>

    <tr>
	<td valign="top" > </td>
	<td valign="top" > </td>
	<td valign="top" > </td>
	<td valign="top" > </td>
	<td valign="top" > </td>
	<td valign="top" > </td>
	<td valign="top" > </td>
	<td valign="top" > </td>
	<td valign="top" > </td>
	<td valign="top" > </td>
    </tr>';
}

$html .= '</tbody>
</table>


<br/>
<br/>


<table border="1" cellspacing="0" cellpadding="0" > <thead> <tr>
<td colspan="5" valign="top" ><p>· Recursos en Internet</p></td>
</tr>

<tr>
	<td valign="top" ><p align="center">Autor/es Apellido/s</p></td>
	<td valign="top" ><p align="center">Autor/es Nombre/s</p></td>
	<td valign="top" ><p align="center">Título </p></td>
	<td valign="top" ><p align="center">Datos adicionales</p></td>
	<td valign="top" ><p align="center">Disponibilidad / Dirección electrónica</p></td>
</tr>

</thead> 
<tbody>';

$Recursos = $Programa->getRecursos();
if ($Recursos != NULL){
    foreach ($Recursos as $Recurso){
        $html .= '<tr>
                <td valign="top" >'.utf8_encode($Recurso->getApellido()).'</td>
                <td valign="top" >'.utf8_encode($Recurso->getNombre()).'</td>
                <td valign="top" >'.utf8_encode($Recurso->getTitulo()).'</td>
                <td valign="top" >'.utf8_encode($Recurso->getDatosAdicionales()).'</td>
                <td valign="top" >'.utf8_encode($Recurso->getDisponibilidad()).'</td>
            </tr>';
    }
}
else{
    $html .= '<tr>
            <td valign="top" > </td>
            <td valign="top" > </td>
            <td valign="top" > </td>
            <td valign="top" > </td>
            <td valign="top" > </td>
        </tr>

        <tr>
            <td valign="top" > </td>
            <td valign="top" > </td>
            <td valign="top" > </td>
            <td valign="top" > </td>
            <td valign="top" > </td>
        </tr>';
}



$html .= '</tbody>
</table>


<br/>
<br/>


<table border="1" cellspacing="0" cellpadding="0" > 
<tbody>
<tr>
	<td valign="top" ><p>· Otros Materiales</p></td>
</tr>';

$OtrosMateriales = $Programa->getOtroMateriales();
if ($OtrosMateriales != NULL){
    foreach ($OtrosMateriales as $OtroMaterial){
        $html .= '<tr>
                <td valign="top" >'.utf8_encode($OtroMaterial->getDescripcion()).'</td>
            </tr>';
    }
}
else{
    $html .= '<tr>
            <td valign="top" > </td>
        </tr>
        <tr>
            <td valign="top" > </td>
        </tr>';
}



$html .= '</tbody>
</table>';

//Se pasa el html al PDF
$pdf->writeHTML($html, true, false, true, false, '');

//Se inserta pagina con orientaxión vertical
$pdf->Addpage("P");

//Se concatena el html
$html = '<table border="1" cellspacing="0" cellpadding="0" > 
<tbody>
<tr>
<td colspan="3" valign="top" ><p><b>13- VIGENCIA DEL PROGRAMA</b></p></td>
</tr>

<tr>
	<td valign="top" ><p align="center">AÑO</p></td>
	<td valign="top" ><p align="center">Firma Profesor Responsable</p></td>
	<td valign="top" ><p align="center">Aclaración Firma</p></td>
</tr>

<tr>
	<td valign="top" height="40"> </td>
	<td valign="top" height="40"> </td>
	<td valign="top" height="40"> </td>
</tr>

<tr>
	<td valign="top" height="40"> </td>
	<td valign="top" height="40"> </td>
	<td valign="top" height="40"> </td>
</tr>

<tr>
	<td valign="top" height="40"> </td>
	<td valign="top" height="40"> </td>
	<td valign="top" height="40"> </td>
</tr>

<tr>
	<td valign="top" height="40"> </td>
	<td valign="top" height="40"> </td>
	<td valign="top" height="40"> </td>
</tr>

<tr>
	<td valign="top" height="40"> </td>
	<td valign="top" height="40"> </td>
	<td valign="top" height="40"> </td>
</tr>

</tbody>
</table>


<br/>
<br/>
<br/>


<table border="1" cellspacing="0" cellpadding="0" > 
<tbody>
<tr>
	<td valign="top" ><p><b>14- Observaciones</b></p></td>
</tr>

<tr>
	<td valign="top" ><p>El presente programa se considera un documento que, a modo de "contrato pedagógico", relaciona a los protagonistas del proceso de enseñanza-aprendizaje y constituye un acuerdo entre la Universidad y el Alumno.</p>

	<p>Los cuatrimestres tienen como mínimo una duración de 15 semanas.</p>
	<p> </p>

	</td>
</tr>

</tbody>
</table>


<br/>
<br/>
<br/>


<table border="1" cellspacing="0" cellpadding="0" > 
<tbody>
<tr>
	<td colspan="3" height="40"><p align="center"><b>VISADO</b></p></td>
</tr>

<tr>
	<td valign="top" height="40"><p align="center"><b>División</b></p></td>
	<td valign="top" height="40"><p align="center"><b>Departamento</b></p></td>
	<td valign="top" height="40"><p align="center"><b>Secretaria Académica</b></p></td>
</tr>

<tr>
	<td valign="top" height="60"> </td>
	<td valign="top" height="60"> </td>
	<td valign="top" height="60"> </td>
</tr>

<tr>
	<td valign="top" height="40"><p>Fecha:</p></td>
	<td valign="top" height="40"><p>Fecha:</p></td>
	<td valign="top" height="40"><p>Fecha:</p></td>
</tr>

</tbody>
</table>

</body>
</html>';

//Se pasa el html al PDF
$pdf->writeHTML($html, true, false, true, false, '');

//Se genera la salida del PDF
$pdf->Output();

?>