<?php

require_once "conexion.php";

class IngresoModels{

    public static function ingresoModel($datosModel,$tabla){

        $peticion = Conexion::conectar()->prepare("SELECT id,usuario,password, email, foto, rol,intentos FROM $tabla
                                                   WHERE usuario = :usuario");

        $peticion->bindparam(":usuario",$datosModel["usuario"],PDO::PARAM_STR);
        // $peticion->bindparam(":password",$datosModel["password"],PDO::PARAM_STR); 

        $peticion->execute();

        return $peticion->fetch();

        $peticion->close();
        
    }

    public static function intentosModel($datosModel,$tabla){

        $peticion = Conexion::conectar()->prepare("UPDATE $tabla SET intentos =:intentos WHERE usuario = :usuario");
        
        $peticion->bindparam(":usuario",$datosModel["usuarioActual"],PDO::PARAM_STR);
        $peticion->bindparam(":intentos",$datosModel["actualizarIntentos"],PDO::PARAM_INT);
        
        if ($peticion->execute()) {
            
            return "ok";
        }else {
            return "error";
        }

        // return $peticion->fetch();

        $peticion->close();
        

    }
}