<?php
require_once"backend/models/conexion.php";

class SlideModels{

    public static function seleccionarSlideModel($tabla){
        $peticion = Conexion::conectar()->prepare("SELECT ruta,titulo,descripcion FROM $tabla ORDER BY orden ASC");
   
    $peticion->execute();

    return $peticion->fetchAll();

    $peticion->close();

    }
}