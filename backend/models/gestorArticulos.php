<?php

require_once "conexion.php";

class GestorArticulosModels{

    // Guardar el articulo
    public static function guardarArticuloModel($datosModel,$tabla){
        $peticion = Conexion::conectar()->prepare("INSERT INTO $tabla (titulo,introduccion,ruta,contenido) VALUES (:titulo,:introduccion,:ruta,:contenido)");

        $peticion->bindparam(":titulo",$datosModel["titulo"],PDO::PARAM_STR);
        $peticion->bindparam(":introduccion",$datosModel["introduccion"],PDO::PARAM_STR);
        $peticion->bindparam(":ruta",$datosModel["ruta"],PDO::PARAM_STR);
        $peticion->bindparam(":contenido",$datosModel["contenido"],PDO::PARAM_STR);
        

        if ($peticion->execute()) {
            return "ok";
        }else{
            return "error";
        }

        $peticion->close();

    }

    // mostrar articulo
    public static function mostrarArticuloModel($tabla){
        $peticion = Conexion::conectar()->prepare("SELECT id,titulo,introduccion,ruta,contenido FROM $tabla ORDER BY orden ASC");
        
        $peticion->execute();

        return $peticion->fetchAll();

        $peticion->close();    

    }

     // Guardar el articulo
     public static function borrarArticuloModel($datosModel,$tabla){
        $peticion = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id =:id");

        $peticion->bindparam(":id",$datosModel,PDO::PARAM_INT);
        

        if ($peticion->execute()) {
            return "ok";
        }else{
            return "error";
        }

        $peticion->close();

    }

    public static function editarArticuloModel($datosModel,$tabla){
        $peticion = Conexion::conectar()->prepare("UPDATE $tabla SET titulo = :titulo, introduccion = :introduccion, ruta = :ruta, contenido = :contenido WHERE id = :id");

        $peticion->bindparam(":id",$datosModel["id"],PDO::PARAM_INT);
        $peticion->bindparam(":titulo",$datosModel["titulo"],PDO::PARAM_STR);
        $peticion->bindparam(":introduccion",$datosModel["introduccion"],PDO::PARAM_STR);
        $peticion->bindparam(":ruta",$datosModel["ruta"],PDO::PARAM_STR);
        $peticion->bindparam(":contenido",$datosModel["contenido"],PDO::PARAM_STR);
        

        if ($peticion->execute()) {
            return "ok";
        }else{
            return "error";
        }

        $peticion->close();

    }

    // actualizar Orden Articulos
    public static function actualizarOrdenModel($datosModel,$tabla){
        $peticion = Conexion::conectar()->prepare("UPDATE $tabla SET orden = :orden WHERE id =:id");

        $peticion->bindparam(":orden",$datosModel["ordenItem"],PDO::PARAM_STR);
        $peticion->bindparam(":id",$datosModel["ordenArticulos"],PDO::PARAM_INT);
          

        if ($peticion->execute()) {
            return "ok";
        }else{
            return "error";
        }

        $peticion->close();

    }
    
    // seleccinar orden model

    public static function seleccionarOrdenModel($tabla){
        $peticion = Conexion::conectar()->prepare("SELECT id,titulo,introduccion,ruta,contenido FROM $tabla ORDER BY orden ASC");
        
        $peticion->execute();

        return $peticion->fetchAll();

        $peticion->close();    

    }
}