<?php

include_once '../modeloSistema/PlanPDF.Class.php';

/**
 * Description of ManejadorPlanPDF
 *
 * @author Francisco
 */
class ManejadorPlanPDF {
    private $query;

    /**
     *
     * @var mysqli_result
     */
    private $datos;

    /**
     *
     * @var PlanPDF[] 
     */
    protected $coleccion;

    function __construct() {
        $this->setColeccion();
    }
    
    function setColeccion() {
        $this->query = "SELECT * FROM PLAN_PDF";
        $this->datos = BDConexionSistema::getInstancia()->query($this->query);

        for ($x = 0; $x < $this->datos->num_rows; $x++) {
            $this->addElemento($this->datos->fetch_object("PlanPDF"));
        }
    }

    function addElemento($elemento_) {
        $this->coleccion[] = $elemento_;
    }

    /**
     * 
     * @return PlanPDF[]
     */
    function getColeccion() {
        return $this->coleccion;
    }
        
    /**
     * 
     * @return string
     */
    function tienePlanPDF($codPlan){
        //En caso de que tenga plan de la carrera vamos a devolver la ruta al plan, caso contrario
        //damos la ruta a un pdf el cual indica que el plan no se encuentra disponible
        $ruta = "../planes_de_estudio/plan_no_disponible.pdf";
        
        if (!is_null($this->coleccion)){
            foreach ($this->coleccion as $PlanPDF){
            //extraemos del nombre del archivo del plan pdf, el codigo del plan y se compara con el del argumento
                if ((substr($PlanPDF->getNombre(), 0, 5)) == $codPlan){
                    $ruta = "../".$PlanPDF->getRuta();
                    break;
                }
            }
        }    
        return $ruta;
    }
    
    
    
}
