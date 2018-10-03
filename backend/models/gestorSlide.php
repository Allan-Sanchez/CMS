<?php

require_once "conexion.php";

class GestorSlideModels{

    public static function subirImagenSlideModel($datosModel,$tabla){

        $peticion = Conexion::conectar()->prepare("INSERT INTO $tabla (ruta) VALUES (:ruta)");

        $peticion->bindparam(":ruta",$datosModel,PDO::PARAM_STR);

        if ($peticion->execute()) {
            return "ok";
        }else{
            return "error";
        }

        $peticion->close();

    }

    public static function mostrarImagenSlideModel($datosModel,$tabla){
        $peticion = Conexion::conectar()->prepare("SELECT ruta,titulo,descripcion FROM $tabla WHERE ruta =:ruta");
       
        $peticion->bindparam(":ruta",$datosModel,PDO::PARAM_STR);

        $peticion->execute();

        return $peticion->fetch();

        $peticion->close();

    }
    
    // mostrar todas las imagenes en la vista

    public static function mostrarImagenVistaModel($tabla){
        $peticion = Conexion::conectar()->prepare("SELECT id, ruta,titulo,descripcion FROM $tabla ORDER BY orden ASC");
       

        $peticion->execute();

        return $peticion->fetchAll();

        $peticion->close();

    }

    // eliminamos la imgagen del Slide de la BD
    public static function eliminarSlideModel($datosModel,$tabla){
        $peticion = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id=:id");
        
        $peticion->bindparam(":id",$datosModel["idSlide"],PDO::PARAM_INT);

        if ($peticion->execute()) {
            return "ok";
        }else{
            return "error";
        }

        $peticion->close();
    }

    // actualizar el Slide(titulo , descripcion)BD
    public static function actualizarSlideModel($datosModel,$tabla){
        $peticion = Conexion::conectar()->prepare("UPDATE $tabla SET titulo =:titulo, descripcion =:descripcion WHERE id=:id");
        
        $peticion->bindparam(":id",$datosModel["enviarId"],PDO::PARAM_INT);
        $peticion->bindparam(":titulo",$datosModel["enviarTitulo"],PDO::PARAM_STR);
        $peticion->bindparam(":descripcion",$datosModel["enviarDescripcion"],PDO::PARAM_STR);

        if ($peticion->execute()) {
            return "ok";
        }else{
            return "error";
        }

        $peticion->close();
    }

     //selecciona todos los campos de Slide

     public static function seleccionarActualizarSlideModel($datosModel,$tabla){
        $peticion = Conexion::conectar()->prepare("SELECT titulo,descripcion FROM $tabla WHERE id=:id");
       
        $peticion->bindparam(":id",$datosModel["enviarId"],PDO::PARAM_INT);

        $peticion->execute();

        return $peticion->fetch();

        $peticion->close();

    }

     // actualizar el orden Slide en BD
     public static function actualizarOrdenSlideModel($datosModel,$tabla){
        $peticion = Conexion::conectar()->prepare("UPDATE $tabla SET orden =:orden WHERE id=:id");
        
        $peticion->bindparam(":id",$datosModel["actualizarOrdenSlide"],PDO::PARAM_INT);
        $peticion->bindparam(":orden",$datosModel["actualizarOrdenItem"],PDO::PARAM_INT);

        if ($peticion->execute()) {
            return "ok";
        }else{
            return "error";
        }

        $peticion->close();
    }

    //selecciona orden del Slide

    public static function seleccionarOrdenSlideModel($tabla){
        $peticion = Conexion::conectar()->prepare("SELECT id, ruta,titulo,descripcion FROM $tabla ORDER BY orden ASC");
       
        $peticion->execute();

        return $peticion->fetchAll();

        $peticion->close();

    }

}