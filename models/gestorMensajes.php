<?php

require_once "backend/models/conexion.php";

class MensajeModel{

    public static function registroMensajeModel($datos,$tabla){

        $peticion= Conexion::conectar()->prepare("INSERT INTO $tabla (nombre, correo, mensaje) VALUES (:nombre, :correo, :mensaje)");

        $peticion-> bindparam(":nombre",$datos["nombre"],PDO::PARAM_STR);
        $peticion-> bindparam(":correo",$datos["correo"],PDO::PARAM_STR);
        $peticion-> bindparam(":mensaje",$datos["mensaje"],PDO::PARAM_STR);

        if ($peticion->execute()) {
            return "ok";
        }
        else{
            return "error";
        }
        $peticion->close();
    }
    public static function registroSuscriptoresModel($datos,$tabla){

        $peticion= Conexion::conectar()->prepare("INSERT INTO $tabla (nombre, correo) VALUES (:nombre, :correo )");

        $peticion-> bindparam(":nombre",$datos["nombre"],PDO::PARAM_STR);
        $peticion-> bindparam(":correo",$datos["correo"],PDO::PARAM_STR);

        if ($peticion->execute()) {
            return "ok";
        }
        else{
            return "error";
        }
        $peticion->close();
    }

    public static function revisarSuscriptorModel($datos,$tabla){

        $peticion= Conexion::conectar()->prepare("SELECT correo FROM $tabla WHERE correo =:correo");

        $peticion-> bindparam(":correo",$datos,PDO::PARAM_STR);

        $peticion->execute();
        
        return $peticion->fetch();
        
        $peticion->close();
    }
}