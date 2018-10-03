<?php


require_once "conexion.php";

class MensajesModels{


    public static function mostrarMensajesModel($tabla){
        $peticion = Conexion::conectar()->prepare("SELECT id, nombre, correo, mensaje ,fecha FROM $tabla ORDER BY fecha DESC");

        $peticion->execute();

         return $peticion->fetchAll();

        $peticion->close();
    }

    public static function borrarMensajeModel($datos,$tabla){
        $peticion = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

        $peticion->bindparam(":id",$datos,PDO::PARAM_STR);

        if ( $peticion->execute()) {
            # code...
            return "ok";
        }

         return "error";

        $peticion->close();
        
    }

    // seleccion el nombre el correo de suscriptores
    public static function seleccionarEmailSuscriptores($tabla){
        $peticion = Conexion::conectar()->prepare("SELECT nombre, correo FROM $tabla ");

        $peticion->execute();

         return $peticion->fetchAll();

        $peticion->close();
    }

    // mensajes sin revisar
    public static function mensajesSinRevisarModel($tabla){
        $peticion = Conexion::conectar()->prepare("SELECT revision FROM $tabla ");

        $peticion->execute();

         return $peticion->fetchAll();

        $peticion->close();
    }

    // mensaje revisados
    public static function mensajesRevisadosModel($datos,$tabla){
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