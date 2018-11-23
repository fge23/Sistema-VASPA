<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MYPDF
 *
 * @author Francisco
 */
class MYPDF extends TCPDF {

    
    public function Header() {

    	//$idPrograma = $_GET['id'];
        $idPrograma = 3;
    	//Conexion a la BD ()
        $mysqli=new mysqli("localhost","root","","bdgef_vaspa"); //servidor, usuario de base de datos, contraseña del usuario, nombre de base de datos
    
    	if(mysqli_connect_errno()){
        	echo 'Conexion Fallida : ', mysqli_connect_error();
        exit();
    	}
   		$acentos = $mysqli->query("SET NAMES 'utf8'");

        
   		#CONSULTA A LA BD -- Obtener el nombre y codigo de la materia del programa 
        $consulta = "SELECT nombre, asignatura.id FROM asignatura JOIN programa WHERE asignatura.id = programa.idAsignatura AND programa.id = {$idPrograma}";
        $resul = $mysqli->query($consulta);

        $asig=$resul->fetch_assoc();
        $nombreAsignatura=$asig['nombre'];
        $codAsignatura=$asig['id'];


        #CONSULTA A LA BD -- Obtener nombre y codigo de las carreras de una determinada asignatura correspondiente a un programa.
        $consulta = 'SELECT carrera.nombre, carrera.id FROM programa NATURAL JOIN asignatura NATURAL JOIN plan_asignatura JOIN plan JOIN carrera WHERE plan_asignatura.codPlan = plan.codPlan AND plan.codCarrera = carrera.codCarrera AND programa.id = 3';
        $resul = $mysqli->query($consulta);
        
        //Concatenamos el html
        $tbl ='';
        $tbl .= '

                <table cellspacing="0" cellpadding="1" border="1">
                    <tr>
                        <td colspan="1" align="center"><img src="logoUNPA.jpg"/></td>
                        <td colspan="1" align="center"><b><br><br><br>UNIVERSIDAD NACIONAL <br> DE LA PATAGONIA <br> AUSTRAL <br> Unidad Académica <br> Río Gallegos</b></td>
        
                    </tr>
                </table>
                <table cellspacing="0" cellpadding="1" border="1">
                    <tr>
                        <td colspan="6"><b>Programa de: '.$nombreAsignatura.'</b></td>
                        <td><b>Cod. Asig.</b></td>
                        <td><b> '.$codAsignatura.'</b></td>
                    </tr>
                </table>    
                <table cellspacing="0" cellpadding="1" border="1">';
                    
                while ($carreras=$resul->fetch_assoc()){
                   $tbl .= '<tr>
                                <td colspan="6"><b>Carrera: '.$carreras['nombre'].'</b></td>
                                <td><b>Cod. Carr.</b></td>
                                <td><b> '.$carreras['codCarrera'].'</b></td>
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
