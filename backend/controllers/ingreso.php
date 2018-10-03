<?php


class Ingreso{

    public function ingresoController(){

        if(isset($_POST["usuarioIngreso"])){

            // evalu o compara con una expresion regular
            if(preg_match('/^[a-zA-Z0-9]+$/',$_POST["usuarioIngreso"]) &&
               preg_match('/^[a-zA-Z0-9]+$/',$_POST["passwordIngreso"])){
    
                $encriptar = crypt($_POST["passwordIngreso"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
    
                   $datosController = array("usuario" => $_POST["usuarioIngreso"],
                                            "password" => $encriptar);
           
                   $respuesta = IngresoModels :: ingresoModel($datosController,"usuarios");
                //    var_dump($respuesta);
    
                   $intentos = $respuesta["intentos"];
                   $usuarioActual = $_POST["usuarioIngreso"];
                   $maximoIntentos = 2;
    
                   if($intentos < $maximoIntentos){
    
                       if ($respuesta["usuario"] == $_POST["usuarioIngreso"] && 
                          $respuesta["password"] == $encriptar){
    
                            $intentos = 0;
                            $datosController= array("usuarioActual"=>$usuarioActual,
                                                    "actualizarIntentos"=>$intentos);
    
                            $respuestaIntentos = IngresoModels::intentosModel($datosController,"usuarios");
    
                           session_start();

                           $_SESSION["validar"]=true;
                           $_SESSION["usuario"]=$respuesta["usuario"];
                           $_SESSION["id"]=$respuesta["id"];
                           $_SESSION["email"]=$respuesta["email"];
                           $_SESSION["foto"]=$respuesta["foto"];
                           $_SESSION["rol"]=$respuesta["rol"];

                           header("location:inicio");
                       }else{
                           ++$intentos;
                           $datosController= array("usuarioActual"=>$usuarioActual,
                                                    "actualizarIntentos"=>$intentos);
    
                            $respuestaIntentos = IngresoModels::intentosModel($datosController,"usuarios");
    
                           echo'<div class="alert alert-danger" id="error">Error al ingresar</div>';
                       }
                   }else{
                    $intentos = 0;
                    $datosController= array("usuarioActual"=>$usuarioActual,
                                            "actualizarIntentos"=>$intentos);
    
                    $respuestaIntentos = IngresoModels::intentosModel($datosController,"usuarios");
    
                    echo'<div class="alert alert-danger" id="error">Error fallo tres veces en realidad eres tu</div>';
    
                   }
           
               }
        }

        
    }

}