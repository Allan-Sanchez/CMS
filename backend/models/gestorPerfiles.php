<?php

require_once "conexion.php";

class GestorPerfilModel{

    // ingreso de nuevos usuarios
    public static function guardarPerfilModel($datos,$tabla){
        $peticion = Conexion::conectar()->prepare("INSERT INTO $tabla (usuario,password,email,foto,rol) VALUES(:usuario,:password,:email,:foto,:rol)");

        $peticion->bindparam(":usuario",$datos["usuario"],PDO::PARAM_STR);
        $peticion->bindparam(":password",$datos["password"],PDO::PARAM_STR);
        $peticion->bindparam(":email",$datos["correo"],PDO::PARAM_STR);
        $peticion->bindparam(":foto",$datos["ruta"],PDO::PARAM_STR);
        $peticion->bindparam(":rol",$datos["rol"],PDO::PARAM_INT);

        if ( $peticion->execute()) {
            # code...
            return "ok";
        }

         return "error";

        $peticion->close();
        
    
    }
    

    // Lista los usuarios en la vista
    public static function seleccionarUsuariosModel($tabla){
        $peticion = Conexion::conectar()->prepare("SELECT id,usuario,password,email,foto,rol FROM $tabla");


       $peticion->execute();

         return $peticion->fetchAll();  

        $peticion->close();
        
    
    }

    /* Editar Perfil de los usuarios registrados */
    public static function editarPerfilModel($datos,$tabla){
        $peticion = Conexion::conectar()->prepare("UPDATE $tabla SET usuario =:usuario, password =:password, email =:email, foto =:foto, rol =:rol WHERE id =:id");

        $peticion->bindparam(":id",$datos["id"],PDO::PARAM_INT);
        $peticion->bindparam(":usuario",$datos["usuario"],PDO::PARAM_STR);
        $peticion->bindparam(":password",$datos["password"],PDO::PARAM_STR);
        $peticion->bindparam(":email",$datos["correo"],PDO::PARAM_STR);
        $peticion->bindparam(":foto",$datos["foto"],PDO::PARAM_STR);
        $peticion->bindparam(":rol",$datos["rol"],PDO::PARAM_INT);

        if ( $peticion->execute()) {
            # code...
            return "ok";
        }

         return "error";

        $peticion->close();

    }

    public static function borrarPerfilModel($datos,$tabla){
        $peticion = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

        $peticion->bindparam(":id",$datos,PDO::PARAM_INT);
        

        if ( $peticion->execute()) {
            # code...
            return "ok";
        }

         return "error";

        $peticion->close();
    }
}