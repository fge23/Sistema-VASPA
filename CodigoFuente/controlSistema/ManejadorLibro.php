<?php

include_once '../modeloSistema/BDConexionSistema.Class.php';
include_once '../modeloSistema/Libro.Class.php';

/**
 * Description of ManejadorLibro
 *
 * @author fabricio
 */
class ManejadorLibro {

    private $query;

    /**
     *
     * @var mysqli_result
     */
    private $datos;

    /**
     *
     * @var Libro[] 
     */
    protected $coleccion;

    function __construct() {
        $this->setColeccion();
    }

    function setColeccion() {
        $this->query = "SELECT * FROM LIBRO";
        $this->datos = BDConexionSistema::getInstancia()->query($this->query);

        for ($x = 0; $x < $this->datos->num_rows; $x++) {
            $this->addElemento($this->datos->fetch_object("Libro"));
        }
    }

    function addElemento($elemento_) {
        $this->coleccion[] = $elemento_;
    }

    /**
     * 
     * @return Libro[]
     */
    function getColeccion() {
        return $this->coleccion;
    }

    //Funcion para Alta de Libros
    function alta($datos) {

        //Creo objeto sin enviar ID y enviando todos los datos del formulario
        $Libro = new Libro(null, $datos);

        $this->query = "INSERT INTO LIBRO "
                . "VALUES "
                . "(null, "
                . "'{$Libro->getReferencia()}', " //ref
                . "'{$Libro->getApellido()}', " //ape
                . "'{$Libro->getNombre()}', " //nom
                . "{$Libro->getAnioEdicion()}, " //anio
                . "'{$Libro->getTitulo()}', " //tit
                . "'{$Libro->getCapitulo()}', " //capit
                . "'{$Libro->getLugarEdicion()}', " //lugEd
                . "'{$Libro->getEditorial()}', " //editorial
                . "'{$Libro->getUnidad()}', " //Unidad
                . "'{$Libro->getBiblioteca()}', " //biblio
                . "'{$Libro->getSiunpa()}', "  //siunpa
                . "'{$Libro->getOtro()}', " //Otro
                . "'{$Libro->getTipoLibro()}', "  //tipoLibro
                . "{$Libro->getIdPrograma()} )";  //idPrograma

        $consulta = BDConexionSistema::getInstancia()->query($this->query);

        if ($consulta) {
            return true;
        } else {
            return false;
        }
    }

    function baja($id_) {
        $this->query = "DELETE FROM LIBRO WHERE id = {$id_}";
        $consulta = BDConexionSistema::getInstancia()->query($this->query);
        if ($consulta) {
            return true;
        } else {
            return false;
        }
    }

    //Funcion para Modificación de Libros
    function modificacion($datos, $id_) {

        $Libro = new Libro(null, $datos);
        $this->query = "UPDATE LIBRO "
                . "SET id = {$Libro->getId()}, "
                . "referencia = '{$Libro->getReferencia()}', "
                . "apellido = '{$Libro->getApellido()}', "
                . "nombre = '{$Libro->getNombre()}', "
                . "anioEdicion = {$Libro->getAnioEdicion()}, "
                . "titulo = '{$Libro->getTitulo()}', "
                . "capitulo = '{$Libro->getCapitulo()}', "
                . "lugarEdicion = '{$Libro->getLugarEdicion()}', "
                . "Editorial = '{$Libro->getEditorial()}', "
                . "unidad = '{$Libro->getUnidad()}', "
                . "biblioteca = '{$Libro->getBiblioteca()}', "
                . "siunpa = '{$Libro->getSiunpa()}', "
                . "otro = '{$Libro->getOtro()}', "
                . "tipoLibro = '{$Libro->getTipoLibro()}', "
                . "idPrograma = {$Libro->getIdPrograma()} "
                . "WHERE id = {$id_}";
        $consulta = BDConexionSistema::getInstancia()->query($this->query);
        if ($consulta) {
            return true;
        } else {
            return false;
        }
    }

}
