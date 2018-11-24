<?php
/* 
 *Aqui se lleva a cabo el filtrado de la asignatura que se desea buscar
 */
include_once '../../modeloSistema/BDConexionSistema.Class.php';
include_once '../../controlSistema/ManejadorAsignatura.php';
include_once '../../modeloSistema/Profesor.Class.php';
include_once '../../modeloSistema/Asignatura.Class.php';

$ManejadorAsignatura = new ManejadorAsignatura();
$Asignaturas = $ManejadorAsignatura->getColeccion();

$salida = "";

$salida.="<table class='table table-hover table-sm'>
        <tr class='table-info'>
            <th>C&oacute;digo de Asignatura</th>
            <th>Asignatura</th>
            <th>Docente Responsable</th>
            <th>Opciones</th>
        </tr>";
    

if (isset($_POST['consulta'])) {  
    //$q = BDConexionSistema::getInstancia()->real_escape_string($_POST['consulta']);
    //$consulta = "SELECT anio FROM ANIO WHERE anio LIKE '%".$q."%'";
    //$q = "abo";
    $q = $_POST['consulta'];
    foreach ($Asignaturas as $Asignatura) {
        $var = "/".$q."/i";
        if ($Asignatura->getId() != '0174' && $Asignatura->getId() != '0175' && $Asignatura->getId() != '0473'){
            if (preg_match($var, $Asignatura->getNombre())){
                $Profesor = new Profesor($Asignatura->getIdProfesor());
                $salida .= "<tr><td>".$Asignatura->getId()."</td>
                <td>".utf8_encode($Asignatura->getNombre())."</td>
                <td>".$Profesor->getApellido().' '.$Profesor->getNombre()."</td>
                <td>
                    <a title='Enviar notificación' href='../vista/correo.enviar.procesar.php?codAsig=".$Asignatura->getId()."'>
                        <button type='button' class='btn btn-outline-info'>
                            <span class='oi oi-envelope-closed'></span>
                        </button>
                    </a>
                </td>
            </tr>";
            }
        }
    } 
    
}
else{
    foreach ($Asignaturas as $Asignatura) {
        if ($Asignatura->getId() != '0174' && $Asignatura->getId() != '0175' && $Asignatura->getId() != '0473'){
            $Profesor = new Profesor($Asignatura->getIdProfesor());
                $salida .= "<tr><td>".$Asignatura->getId()."</td>
                <td>".utf8_encode($Asignatura->getNombre())."</td>
                <td>".$Profesor->getApellido().' '.$Profesor->getNombre()."</td>
                <td>
                    <a title='Enviar notificación' href='../vista/correo.enviar.procesar.php?codAsig=".$Asignatura->getId()."'>
                        <button type='button' class='btn btn-outline-info'>
                            <span class='oi oi-envelope-closed'></span>
                        </button>
                    </a>
                </td>
            </tr>";
        }       
}

}

    
            
  
    $salida.="</table>";



/*
<table class="table table-hover table-sm">
        <tr class="table-info">
            <th>C&oacute;digo de Asignatura</th>
            <th>Nombre</th>
            <th>Docente Responsable</th>
            <th>Opciones</th>
        </tr>
        <tr>
            <?php foreach ($Asignaturas as $Asignatura) {
                $Profesor = new Profesor($Asignatura->getIdProfesor());?>
                <td><?= $Asignatura->getId(); ?></td>
                <td><?= $Asignatura->getNombre(); ?></td>
                <td><?= $Profesor->getApellido().' '.$Profesor->getNombre(); ?></td>
                <td>
                    <a title="Ver detalle" href="#">
                        <button type="button" class="btn btn-outline-info">
                            <span class="oi oi-zoom-in"></span>
                        </button>
                    </a>
                    <a title="Modificar" href="asignatura.modificar.php?id=<?= $Asignatura->getId(); ?>">
                        <button type="button" class="btn btn-outline-warning">
                            <span class="oi oi-pencil"></span>
                        </button>
                    </a>
                    <a title="Eliminar" href="#">
                        <button type="button" class="btn btn-outline-danger">
                            <span class="oi oi-trash"></span>
                        </button>
                    </a>  
                </td>
            </tr>
        <?php } ?>
    </table>*/

    echo $salida;
    ?>