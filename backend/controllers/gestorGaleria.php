<?php



class GestorGaleria{

    public static function mostrarImagenController($datos){

        // mostrar la imagen
        list($ancho,$alto) = getimagesize($datos);

        if($ancho < 1024 || $alto < 768){
            echo'0';

        }else{

            $aletorio = mt_rand(100,999);

            $ruta ="../../views/images/galeria/galeria".$aletorio.".jpg";

            $nuevo_alto = 768;
            $nuevo_ancho = 1024;

            $origen = imagecreatefromjpeg($datos);

            // imagencreatetruecolor  crea una nueva imagen de color verdadero
            $destino = imagecreatetruecolor($nuevo_ancho,$nuevo_alto);

            // imagecopyresized() - copia una porcion de una imagen  a otra imagen
            // bool imagecopyresized($destino, $origen int $destino_x, int $destino_y, int $origen_x, int $origen_y, 
            // int $destino_w, int $destino_h, int $origen_w, int $origen_h)

            imagecopyresized($destino,$origen,0,0,0,0,$nuevo_ancho,$nuevo_alto,$ancho,$alto);

            imagejpeg($destino,$ruta);

            GestorGaleriaModel::subirImagenGaleriaModel($ruta,"galeria");
           $respuesta= GestorGaleriaModel::seleccionarImagenGaleriaModel($ruta,"galeria");

           echo $respuesta["ruta"];
            
        }

    }

    // mostrar las imagen en la vista
    public function mostrarImagenVistaController(){
       $respuesta =GestorGaleriaModel::mostrarImagenVistaModel("galeria");

       foreach ($respuesta as $item) {
           
           echo '<li id="'.$item["id"].'" class="bloqueGaleria">
                    <span class="fa fa-times eliminarImagen" ruta="'.$item["ruta"].'"></span>
                    <a rel="grupo" href="'.substr($item["ruta"],6).'">
                        <img src="'.substr($item["ruta"],6).'" class="handleImg">
                    </a>
                </li>';
       }
    }

    // eliminar imagen de la galeria de imagenes
    public static function eliminarImagenController($datos){
        $respuesta = GestorGaleriaModel::eliminarImagenModel($datos,"galeria");

        unlink($datos["rutaGaleria"]);
        echo $respuesta;
    }

    // actualizar orden en la tabla imagen
    public static function actualizarOrdenController($datos){
        
        GestorGaleriaModel::actualizarOrdenModel($datos,"galeria");

        $respuesta = GestorGaleriaModel::seleccionarOrdenModel("galeria");

        foreach ($respuesta as $item) {
           
            echo '<li id="'.$item["id"].'" class="bloqueGaleria">
                     <span class="fa fa-times eliminarImagen" ruta="'.$item["ruta"].'"></span>
                     <a rel="grupo" href="'.substr($item["ruta"],6).'">
                         <img src="'.substr($item["ruta"],6).'" class="handleImg">
                     </a>
                 </li>';
        }   
    }
}