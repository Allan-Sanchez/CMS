<?php

require_once "conexion.php";

class GestorGaleriaModel{

    public static function subirImagenGaleriaModel($datos,$tabla){
        $peticion = Conexion::conectar()->prepare("INSERT INTO $tabla (ruta) VALUES (:ruta)");

        $peticion->bindparam(":ruta",$datos,PDO::PARAM_STR);
        
        if ($peticion->execute()) {
            return "ok";
        }else{
            return "error";
        }

        $peticion->close();

    }
    public static function seleccionarImagenGaleriaModel($datos,$tabla){
        $peticion =Conexion::conectar()->prepare("SELECT ruta FROM $tabla WHERE ruta = :ruta");
        $peticion->bindparam(":ruta",$datos,PDO::PARAM_STR);

        $peticion->execute();

        return $peticion->fetch();

        $peticion->close();
    }
    public static function mostrarImagenVistaModel($tabla){
        $peticion =Conexion::conectar()->prepare("SELECT id,ruta FROM $tabla ORDER BY orden ASC");

        $peticion->execute();

        return $peticion->fetchAll();

        $peticion->close();
    }
    
    // eliminar imagen de la BD de la Tabla Galeria
    public static function eliminarImagenModel($datos,$tabla){
        $peticion = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id= :id");

        $peticion->bindparam(":id",$datos["idGaleria"],PDO::PARAM_INT);
        
        if ($peticion->execute()) {
            return "ok";
        }else{
            return "error";
        }

        $peticion->close();

    }

    // actualizar orden model
    public static function actualizarOrdenModel($datos,$tabla){
        $peticion = Conexion::conectar()->prepare("UPDATE $tabla SET orden = :orden WHERE id = :id");

        $peticion->bindparam(":orden",$datos["ordenItem"],PDO::PARAM_INT);
        $peticion->bindparam(":id",$datos["ordenGaleria"],PDO::PARAM_INT);
        
        if ($peticion->execute()) {
            return "ok";
        }else{
            return "error";
        }

        $peticion->close();

    }

    // selecciona el orden de las imagenes
    public static function seleccionarOrdenModel($tabla){
        $peticion =Conexion::conectar()->prepare("SELECT id,ruta FROM $tabla ORDER BY orden ASC");

        $peticion->execute();

        return $peticion->fetchAll();

        $peticion->close();
    }


}