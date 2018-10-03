<?php
require_once "../../controllers/gestorGaleria.php";
require_once "../../models/gestorGaleria.php";

class Ajax{

    // subir la imagen a la galeria

    public $imagenTemporal;

    public function gestorGaleriaAjax(){
        $datos = $this->imagenTemporal;

        $respuesta = GestorGaleria::mostrarImagenController($datos);
    }

    // eliminar imagen de la galeria
    public $idGaleria;
    public $rutaGaleria;
    public function eliminarImagenAjax(){
        $datos = array("idGaleria"=>$this->idGaleria,
                        "rutaGaleria"=>$this->rutaGaleria);
        
        $respuesta = GestorGaleria::eliminarImagenController($datos);
        echo $respuesta;
    }

    // actualizar orden de las imagenes
    public $actualizarOrdenGaleria;
    public $actualizarOrdenItem;

    public function actualizarOrdenAjax(){
        
        $datos = array("ordenGaleria"=>$this->actualizarOrdenGaleria,
                        "ordenItem"=>$this->actualizarOrdenItem);

        $respuesta =GestorGaleria::actualizarOrdenController($datos);
        
        echo $respuesta;
    }
}

// Objetos

if (isset($_FILES["imagen"]["tmp_name"])) {
    $imagen = new Ajax();
    $imagen -> imagenTemporal = $_FILES["imagen"]["tmp_name"];
    $imagen -> gestorGaleriaAjax();
}
// elimnar imagen de la galeria
if (isset($_POST["idGaleria"])) {
    $eliminarImagen = new Ajax();
    $eliminarImagen -> idGaleria = $_POST["idGaleria"];
    $eliminarImagen -> rutaGaleria = $_POST["rutaGaleria"];
    $eliminarImagen -> eliminarImagenAjax();
}

// actualizar orden de las imagenes
if (isset($_POST["actualizarOrdenGaleria"])) {
    $ordenImagen = new Ajax();
    $ordenImagen -> actualizarOrdenGaleria = $_POST["actualizarOrdenGaleria"];
    $ordenImagen -> actualizarOrdenItem = $_POST["actualizarOrdenItem"];
    $ordenImagen -> actualizarOrdenAjax();
}