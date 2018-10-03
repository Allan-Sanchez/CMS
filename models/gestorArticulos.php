<?php
require_once "backend/models/conexion.php";

class ArticulosModel{

    public static function seleccionarArticulosModel($tabla){
        $peticion = Conexion::conectar()->prepare("SELECT id,titulo,introduccion,ruta,contenido FROM $tabla ORDER BY orden ASC");
        
        $peticion->execute();

        return $peticion->fetchAll();

        $peticion->close();  

    }
}