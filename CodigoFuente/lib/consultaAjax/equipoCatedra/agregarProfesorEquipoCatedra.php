<?php

include_once '../../../modeloSistema/BDConexionSistema.Class.php';
include_once '../../../modeloSistema/Profesor.Class.php';

// variable donde se almacenara el resultado de la operacion y que se devolvera
$mensaje = '';

// Validamos que esten seteados los campos
if (isset($_POST['idProfesor']) && isset($_POST['idAsignatura']) && isset($_POST['rol'])){
    $idProfesor = $_POST['idProfesor'];
    $idAsignatura = $_POST['idAsignatura'];
    $rol = $_POST['rol'];
    
    $profesor = new Profesor($idProfesor);
        
    // Validamos que no se inserte en caso de que el profesor ya pertenezca al equipo de catedra bajo el mismo rol
    
    $query = "SELECT * "
            . "FROM profesor_asignatura "
            . "WHERE idProfesor = '{$idProfesor}' AND idAsignatura = '{$idAsignatura}' AND rol LIKE '{$rol}'";
    $resultado = BDConexionSistema::getInstancia()->query($query);
    
    if ($resultado) {
        
        // Si no se obtienen registros de la BD procedemos a insertar
        if ($resultado->num_rows == 0) {

            $query = "INSERT INTO profesor_asignatura "
                    . "VALUES ('{$idAsignatura}', '{$idProfesor}', '{$rol}')";
            $consulta = BDConexionSistema::getInstancia()->query($query);
            
            // Verificamos que la cantidad de filas afectadas sea igual a 1 (se inserto el registro)
            if (BDConexionSistema::getInstancia()->affected_rows == 1) {
                //echo "Se inserto";
                $mensaje = '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                        Se agreg&oacute; al Profesor <strong>'.$profesor->getApellido().', '.$profesor->getNombre().'</strong> al Equipo de C&aacute;tedra.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>';
            } else {
                //echo "No se inserto";
                $mensaje = '<div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
                        Ocurrio un error al agregar al Profesor <strong>'.$profesor->getApellido().', '.$profesor->getNombre().'</strong> al Equipo de C&aacute;tedra.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>';
            }
            
        } else {
            //echo "ya se encuentra";
            $mensaje = '<div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
                        El Profesor <strong>'.$profesor->getApellido().', '.$profesor->getNombre().'</strong> ya se encuentra en el Equipo de C&aacute;tedra.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>';
        }
    } else {
        //echo "Ocurrio un error al consultar";
        $mensaje = '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                        Ocurrio un error al agregar al Profesor <strong>'.$profesor->getApellido().', '.$profesor->getNombre().'</strong> al Equipo de C&aacute;tedra.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>';
    }
  
}

// imprimimos mensaje
echo $mensaje;
