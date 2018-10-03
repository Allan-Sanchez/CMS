<?php


class MensajeController{


    public function registroMensajeController(){

        if(isset($_POST["nombre"])){

            if(preg_match('/^[a-zA-Z\s]+$/',$_POST["nombre"]) && 
               preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/',$_POST["correo"]) && 
               preg_match('/^[a-zA-Z0-9\s\.,]+$/',$_POST["mensaje"])){

                // enviar correo electronico
                #mail(correo destino,asunto del mensaje,mensaje,cabecera del correo)
                
                $correoDestino ="asanchezrixtun@gmail.com";
                $asunto = "Mensaje de la web";
                $mensaje = "Nombre: ".$_POST["nombre"]."\n".
                            "Email: ".$_POST["correo"]."\n".
                            "Mensaje: ".$_POST["mensaje"]."\n";
                $cabecera = "From: sitio web"."\r\n"."CC: ".$_POST["correo"];

               $envio = mail($correoDestino, $asunto, $mensaje, $cabecera);

               $datos  = array("nombre"=>$_POST["nombre"],
                                "correo"=>$_POST["correo"],
                                "mensaje"=>$_POST["mensaje"]);


             //    almacenar en BD el suscriptor
                $datosSuscriptor =$_POST["correo"];

                $revisarSuscriptor = MensajeModel::revisarSuscriptorModel($datosSuscriptor,"suscriptores");

                if (count($revisarSuscriptor["correo"]) == 0) {

                    MensajeModel::registroSuscriptoresModel($datos,"suscriptores");
                }

                // almacenar en base de datos
                
                
                $respuesta = MensajeModel::registroMensajeModel($datos,"mensajes");
                
                if ($envio == true && $respuesta == "ok") {
                    
                    echo '<script> 
                            swal({
                                title:"OK..!",
                                text:"Mensaje Enviado Correctamente",
                                type:"success",
                                confirmButtonText:"Cerrar",
                                closeOnConfirm:false},
                                function (isConfirm) {
                                    if (isConfirm) {
                                        window.location = "index.php";
                                    }
                                
                                }
                            );
                        </script>';
                }



            }
            else {

                echo '<div class="alert alert-danger">No se puede enviar el mensaje, no se permiten caracteres<strong> especiales <strong>. </div>';
            }
        }

    }
}