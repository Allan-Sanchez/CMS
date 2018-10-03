<?php

class GestorSlide{

    // Metodos Mostra Imagenes en Sllide

    public static function mostrarImagenController($datosController){
        // propiedad para saber el alto de una imagen
        //lista los elementos 0 1
        list($ancho,$alto) = getimagesize($datosController["imagenTemporal"]);
        
        if($ancho < 1600 || $alto < 600){
            echo 0;
        }else{
            // genera numero aleatorios
            $random = mt_rand(100,999);
            $ruta ="../../views/images/slide/slide".$random.".jpg";

            // retorna una imagen
            $origen = imagecreatefromjpeg($datosController["imagenTemporal"]);

            // funcion para recortar una imagen

            $destino = imagecrop($origen,["x"=>0, "y"=>0, "width"=>1600, "height"=>600]);
            
            // crea la imagen le pasamos la imagen y la ruta
            imagejpeg($destino,$ruta);
            
           GestorSlideModels::subirImagenSlideModel($ruta,"slide");

           $respuesta = GestorSlideModels::mostrarImagenSlideModel($ruta,"slide");

           $enviarDatos =array("ruta"=>$respuesta["ruta"],
                               "titulo"=>$respuesta["titulo"],
                               "descripcion"=>$respuesta["descripcion"]);

           echo json_encode($enviarDatos);
        }

    }

    // Mostrar imagenes en la vista

    public function mostrarImagenVistaController(){

        $respuesta = GestorSlideModels::mostrarImagenVistaModel("slide");

        foreach ($respuesta as $row => $item) {
            # code...(substr) substrae elementos en este caso los primeros 6 caracteres
            echo '<li id="'.$item["id"].'" class="bloqueSlide"><span class="fa fa-times eliminarSlide" ruta="'.$item["ruta"].'"></span><img src="'.substr($item["ruta"],6).'" class="handleImg"></li>';
        }
    }

    // editar Slide su titulo y su body

    public function editorSlideController(){
        $respuesta = GestorSlideModels::mostrarImagenVistaModel("slide");

        foreach ($respuesta as $row => $item) {
            # code...(substr) substrae elementos en este caso los primeros 6 caracteres
            echo '<li id="item'.$item["id"].'">
            <span class="fa fa-pencil editarSlide" style="background:blue"></span>
            <img src="'.substr($item["ruta"],6).'" style="float:left; margin-bottom:10px" width="80%">
            <h1>'.$item["titulo"].'</h1>
            <p>'.$item["descripcion"].'</p>
        </li>';
        }

    }

    // Peticion de eliminacion a el model
    public function eliminarSlideController($datosController){

        GestorSlideModels::eliminarSlideModel($datosController,"slide");

        // borra un directorio
        unlink($datosController["rutaSlide"]);

    }

    // actualizar Slide en la BD

    public static function actualizarSlideController($datosController){
        GestorSlideModels::actualizarSlideModel($datosController,"slide");
        $respuesta = GestorSlideModels::seleccionarActualizarSlideModel($datosController,"slide");

        $enviarDatos = array("titulo"=>$respuesta["titulo"],
                            "descripcion"=>$respuesta["descripcion"]);

        echo json_encode($enviarDatos);

    }
     // Peticion de orden del SLIDE
     public static function actualizarOrdenSlideController($datosController){

        GestorSlideModels::actualizarOrdenSlideModel($datosController,"slide");
        $respuesta = GestorSlideModels::seleccionarOrdenSlideModel("slide");

        foreach ($respuesta as $row => $item) {
            # code...(substr) substrae elementos en este caso los primeros 6 caracteres
            echo '<li id="item'.$item["id"].'">
            <span class="fa fa-pencil editarSlide" style="background:blue"></span>
            <img src="'.substr($item["ruta"],6).'" style="float:left; margin-bottom:10px" width="80%">
            <h1>'.$item["titulo"].'</h1>
            <p>'.$item["descripcion"].'</p>
        </li>';
        }

    }

    // mostrar el SLIDE en el backend
    public function mostrarSlideController(){
      $respuesta = GestorSlideModels:: seleccionarOrdenSlideModel("slide");

      foreach ($respuesta as $row => $item) {
          
        echo'<li>
                <img src="'.substr($item["ruta"],6).'">
                <div class="slideCaption">
                    <h3>'.$item["titulo"].'</h3>
                    <p>'.$item["descripcion"].'.</p>
                </div>
            </li>'; 
       }

    }

}