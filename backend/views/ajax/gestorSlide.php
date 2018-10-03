<?php

require_once "../../controllers/gestorSlide.php";
require_once "../../models/gestorSlide.php";

class Ajax{

    // subir la imagen del Slide
    public $nombreImagen;
    public $imagenTemporal;

    public function gestorSlideAjax(){

        $datos = array("nombreImagen" =>$this->nombreImagen,
                       "imagenTemporal"=>$this->imagenTemporal);

        $respuesta = GestorSlide::mostrarImagenController($datos);
        echo $respuesta;

    }

    // eliminar la imgagen de Slide

    public $idSlide;
    public $rutaSlide;

    public function eliminarSlideAjax(){
        $datos = array("idSlide"=>$this->idSlide,
                       "rutaSlide"=>$this->rutaSlide);

        $respuesta = GestorSlide::eliminarSlideController($datos);

        echo $respuesta;
    }

    // actualizar Slide (titulo,descripcion)
    public $enviarId;
    public $enviarTitulo;
    public $enviarDescripcion;

    public function actualizarSlideAjax(){
            $datos = array("enviarId"=>$this->enviarId,
                           "enviarTitulo"=>$this->enviarTitulo,
                           "enviarDescripcion"=>$this->enviarDescripcion);

        $respuesta =GestorSlide::actualizarSlideController($datos);
        echo $respuesta;
    }

    
    // actualizar orden de Slide (titulo,descripcion)
    public $actualizarOrdenSlide;
    public $actualizarOrdenItem;
    

    public function actualizarOrdenSlideAjax(){
            $datos = array("actualizarOrdenSlide"=>$this->actualizarOrdenSlide,
                           "actualizarOrdenItem"=>$this->actualizarOrdenItem);

        $respuesta =GestorSlide::actualizarOrdenSlideController($datos);
        echo $respuesta;
    }
    
}

// objeto sube la imagen 
if (isset($_FILES["imagen"]["name"])) {
    # code...
    $nuevaImagen = new Ajax();
    $nuevaImagen->nombreImagen =$_FILES["imagen"]["name"];
    $nuevaImagen->imagenTemporal = $_FILES["imagen"]["tmp_name"];
    $nuevaImagen->gestorSlideAjax();
}

// objeto que pide la elimacion de una imagen
if (isset($_POST["idSlide"])) {
    # code...
    $elimarImagen = new Ajax();
    $elimarImagen->idSlide = $_POST["idSlide"];
    $elimarImagen->rutaSlide = $_POST["rutaSlide"];
    $elimarImagen->eliminarSlideAjax();
}

// objeto hace la pedicion para ingresar titulo y descripcion  de una imagen
if (isset($_POST["enviarId"])) {
    # code...
    $editarImagen = new Ajax();
    $editarImagen->enviarId = $_POST["enviarId"];
    $editarImagen->enviarTitulo = $_POST["enviarTitulo"];
    $editarImagen->enviarDescripcion = $_POST["enviarDescripcion"];
    $editarImagen->actualizarSlideAjax();
}

// objeto ingresa el orden del Slide en BD
if (isset($_POST["actualizarOrdenSlide"])) {
    # code...
    $ordenarmagen = new Ajax();
    $ordenarmagen->actualizarOrdenSlide = $_POST["actualizarOrdenSlide"];
    $ordenarmagen->actualizarOrdenItem = $_POST["actualizarOrdenItem"];
    $ordenarmagen->actualizarOrdenSlideAjax();
}