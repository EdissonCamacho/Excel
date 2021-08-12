<?php

require_once "../modelo/archivoModelo.php";
class archivoControl
{

    public $ruta;


    public function ctrArchivo()
    {
        $objMostar = archivoModelo::mdlMostrarArchivo($this->ruta);
        echo json_encode($objMostar);
    }
    public function ctrCargarTabla(){
        $objConsulta= archivoModelo::mdlCargarTabla();
        echo json_encode($objConsulta);


    }
}




if (isset($_FILES["ruta"])) {
    $objArchivo = new archivoControl();
    $objArchivo->ruta = $_FILES["ruta"];
    $objArchivo->ctrArchivo();
}
if(isset($_POST["mensaje"])){
    $objCargar= new archivoControl();
    $objCargar->ctrCargarTabla();

}
