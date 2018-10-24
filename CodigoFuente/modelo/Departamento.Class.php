<?php

include_once 'BDObjetoGenerico.Class.php';

class Departamento extends BDObjetoGenerico {

    protected $nombre;
    protected $id;
                function __construct($id = null) {
        parent::__construct($id, "DEPARTAMENTO");
    }

    function getNombre() {
        return $this->nombre;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }
    function getId() {
        return $this->id;
    }

    function setId($id) {
        $this->id = $id;
    }



}
