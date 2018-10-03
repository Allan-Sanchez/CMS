<?php


class EnlacesModels{


    public static function enlacesModel($enlace){

        if($enlace == "inicio" ||
           $enlace == "articulos" ||
           $enlace == "galeria" ||
           $enlace == "login" ||
           $enlace == "mensajes" ||
           $enlace == "slide" ||
           $enlace == "salir" ||
           $enlace == "suscriptores" ||
           $enlace == "videos" ||
           $enlace == "perfil"){

            $respuesta = "views/modules/".$enlace.".php";

        }elseif ($enlace == "index") {
            $respuesta = "views/modules/login.php";
            
        }
        else{
            $respuesta = "views/modules/login.php";
        }

        return $respuesta;
    }
}