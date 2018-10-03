<?php

require_once "backend/models/conexion.php";

class GaleriaModel{

    public static function seleccionarGaleriaModel($tabla){
        $peticion = Conexion::conectar()->prepare("SELECT ruta FROM $tabla ORDER BY orden ASC");

        $peticion->execute();

        return $peticion->fetchAll();
        
        $peticion->close();
    }
}