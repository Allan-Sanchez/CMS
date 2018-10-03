<?php

require_once "../../controllers/gestorVideos.php";
require_once "../../models/gestorVideos.php";

class Ajax{

    public $videoTemporal;

    public function gestorVideoAjax(){
        $datos=$this->videoTemporal;

       $respuesta = GestorVideo::mostraVideoController($datos);
       echo'';

    }

    // borrar video 
    public $idVideo;
    public $rutaVideo;

    public function eliminarVideoAjax(){
            $datos = array("idVideo" =>$this -> idVideo,
                            "rutaVideo" =>$this -> rutaVideo);

            $respuesta = GestorVideo::eliminarVideoController($datos);

            echo $respuesta;
    }

    // Ordenar video 
    public $almacenarOrdenId;
    public $ordenItem;

    public function ordenarVideoAjax(){
            $datos = array("almacenarOrdenId" =>$this -> almacenarOrdenId,
                            "ordenItem" =>$this -> ordenItem);

            $respuesta = GestorVideo::actualizarVideoController($datos);

            echo $respuesta;
    }

}


// objetos de AJAX

if (isset($_FILES["video"]["tmp_name"])) {
    
    $video = new Ajax();
    $video -> videoTemporal =$_FILES["video"]["tmp_name"];
    $video -> gestorVideoAjax();
}
// borrar video
if (isset($_POST["idVideo"])) {
    
    $eliminarVideo = new Ajax();
    $eliminarVideo -> idVideo = $_POST["idVideo"];
    $eliminarVideo -> rutaVideo = $_POST["rutaVideo"];
    $eliminarVideo -> eliminarVideoAjax();
}

// Ordenar video
if (isset($_POST["almacenarOrdenId"])) {
    
    $ordenarVideo = new Ajax();
    $ordenarVideo -> almacenarOrdenId = $_POST["almacenarOrdenId"];
    $ordenarVideo -> ordenItem = $_POST["ordenItem"];
    $ordenarVideo -> ordenarVideoAjax();
}