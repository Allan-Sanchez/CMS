<?php

class GestorVideo{

    // mostrar video en la vista
    public static function mostraVideoController($datos){
        $random = mt_rand(100,999);

        $ruta = "../../views/videos/video".$random.".mp4";

        move_uploaded_file($datos,$ruta);

        GestorVideoModel::subirVideoModel($ruta,"videos");

        $respuesta = GestorVideoModel::mostrarVideoModel($ruta,"videos");

        $enviarDatos = $respuesta["ruta"];

        echo $enviarDatos;

    }

    // mostra video en la vista
    public function mostratVideoVistaController(){
        $respuesta = GestorVideoModel::mostratVideoVistaModel("videos");

        foreach ($respuesta as $item) {
            
            echo '<li id="'.$item["id"].'" class="bloqueVideo">
					<span class="fa fa-times eliminarVideo" ruta="'.$item["ruta"].'"></span>
					<video controls class="handleVideo">
						<source src="'.substr($item["ruta"],6).'" type="video/mp4">
					</video>	
				</li>';
        }
    }

    // borrar video
    public static function eliminarVideoController($datos){
        
        $respuesta = GestorVideoModel::eliminarVideoModel($datos,"videos");

        unlink($datos["rutaVideo"]);

        echo $respuesta;
    }
    // actualizar orden

    public static function actualizarVideoController($datos){

        GestorVideoModel::actualizarVideoModel($datos,"videos");

        $respuesta = GestorVideoModel::seleccionarVideoModel($datos,"videos");

        foreach ($respuesta as $item) {

            echo '<li id="'.$item["id"].'" class="bloqueVideo">
					<span class="fa fa-times eliminarVideo" ruta="'.$item["ruta"].'"></span>
					<video controls class="handleVideo">
						<source src="'.substr($item["ruta"],6).'" type="video/mp4">
					</video>	
				</li>';
        }
    }
}