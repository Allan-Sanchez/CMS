<?php

require_once "../../controllers/gestorArticulos.php";
require_once "../../models/gestorArticulos.php";

// metodos y propiedades
 class Ajax{

    public $imagenTemporal;

    public function gestorArticuloAjax(){

    $datos = $this->imagenTemporal;
       $respuesta = GestorArticulo::mostrarImagenController($datos);
        echo $respuesta;

    }

    // modificar el orden de los articulos
    public $actualizarOrdenArticulos;
    public $actualizarOrdenItem;

    public function actualizarOrdenAjax(){

        $datos = array("ordenArticulos" => $this->actualizarOrdenArticulos,
                        "ordenItem"=>$this->actualizarOrdenItem);
        // var_dump($datos);
        
        $respuesta = GestorArticulo::actualizarOrdenController($datos);

        echo $respuesta;
    }
 }

//  objetos de la clase Ajax

if (isset($_FILES["imagen"]["tmp_name"])) {
    $imagen = new Ajax();
    $imagen->imagenTemporal=$_FILES["imagen"]["tmp_name"];
    $imagen->gestorArticuloAjax();

}

// objeto de actualizar

if(isset($_POST["actualizarOrdenArticulos"])){
    $ordenar = new Ajax();
    $ordenar -> actualizarOrdenArticulos = $_POST["actualizarOrdenArticulos"];
    $ordenar -> actualizarOrdenItem = $_POST["actualizarOrdenItem"];
    $ordenar -> actualizarOrdenAjax();
}