<?php

require_once "conexion.php";

class SuscriptoresModel{

    // mostrar los datos a la vista
    public static function mostrarSuscriptoresModel($tabla){
        $peticion = Conexion::conectar()->prepare("SELECT id,nombre, correo FROM $tabla ");

        $peticion->execute();

         return $peticion->fetchAll();

        $peticion->close();
    }

    public static function borrarSuscriptoresModel($datos, $tabla){
        $peticion = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

        $peticion->bindparam(":id",$datos,PDO::PARAM_INT);

        if ( $peticion->execute()) {
            # code...
            return "ok";
        }

         return "error";

        $peticion->close();
    }

    // suscriptores sin revisar
    public static function suscriptorSinRevisarModel($tabla){
        $peticion = Conexion::conectar()->prepare("SELECT revision FROM $tabla");

        $peticion->execute();

         return $peticion->fetchAll();

        $peticion->close();
    }

    // suscriptores revisados
    public static function suscriptoresRevisadosModel($datos, $tabla){
        $peticion = Conexion::conectar()->prepare("UPDATE $tabla SET revision = :revision");

        $peticion->bindparam(":revision",$datos,PDO::PARAM_INT);

        if ( $peticion->execute()) {
            # code...
            return "ok";
        }

         return "error";

        $peticion->close();
    }

}