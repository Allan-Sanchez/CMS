<?php

require_once "conexion.php";


class GestorVideoModel{

    // subir la ruta a la base de Datos
    public static function subirVideoModel($datos,$tabla){
        $peticion = Conexion::conectar()->prepare("INSERT INTO $tabla (ruta) VALUES (:ruta)");
        
        $peticion->bindparam(":ruta",$datos,PDO::PARAM_STR);

        if ( $peticion->execute()) {
            
            return 'ok';

        }else{
            return 'error';
        }
       
        $peticion->close();

    }

    // mostrar video en la vista con AJAX
    public static function mostrarVideoModel($datos,$tabla){
        $peticion = Conexion::conectar()->prepare("SELECT ruta FROM $tabla WHERE ruta =:ruta");

        $peticion->bindparam(":ruta",$datos,PDO::PARAM_STR);

        $peticion->execute();

        return $peticion->fetch();

        $peticion->close();


    }

    // mostrar video en la vista
    public static function mostratVideoVistaModel($tabla){
        $peticion = Conexion::conectar()->prepare("SELECT id, ruta FROM $tabla ORDER BY orden ASC");

        $peticion->execute();

        return $peticion->fetchAll();

        $peticion->close();

    }

    // Eliminar video de la base de Datos
    public static function eliminarVideoModel($datos,$tabla){
        $peticion = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id =:id");
        
        $peticion->bindparam(":id",$datos["idVideo"],PDO::PARAM_INT);

        if ( $peticion->execute()) {
            
            return 'ok';

        }else{
            return 'error';
        }
       
        $peticion->close();

    }

    
    // actualizar video de la base de Datos
    public static function actualizarVideoModel($datos,$tabla){
        $peticion = Conexion::conectar()->prepare("UPDATE $tabla SET orden = :orden WHERE id =:id");
        
        $peticion->bindparam(":id",$datos["almacenarOrdenId"],PDO::PARAM_INT);
        $peticion->bindparam(":orden",$datos["ordenItem"],PDO::PARAM_INT);

        if ( $peticion->execute()) {
            
            return 'ok';

        }else{
            return 'error';
        }
       
        $peticion->close();

    }

    // mostrar video en la vista
    public static function seleccionarVideoModel($tabla){
        $peticion = Conexion::conectar()->prepare("SELECT id, ruta FROM $tabla ORDER BY orden ASC");

        $peticion->execute();

        return $peticion->fetchAll();

        $peticion->close();

    }
}