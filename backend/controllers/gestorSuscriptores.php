<?php

class SuscriptoresController{

    // mostrar suscripores a la vista
    public function mostrarSuscriptoresController(){

        $respuesta = SuscriptoresModel::mostrarSuscriptoresModel("suscriptores");

        foreach ($respuesta as $row => $item) {
            
            echo '<tr>
                    <td>'.$item["nombre"].'</td>
                    <td>'.$item["correo"].'</td>
                    <td>
                       <a href="index.php?action=suscriptores&idBorrar='.$item["id"].'"> <span class="btn btn-danger fa fa-times quitarSuscriptor"></span></a>
                    </td>
                    <td></td>
                </tr>'; 
        }
    }

    // borrar suscriptores
    public function borrarSuscriptoresController(){
        if (isset($_GET["idBorrar"])) {
            # code...
            $dato = $_GET["idBorrar"];
            $respuesta = SuscriptoresModel:: borrarSuscriptoresModel($dato,"suscriptores");

            if ($respuesta == "ok") {
                    
                echo '<script> 
                        swal({
                            title:"OK..!",
                            text:"Mensaje Eliminado Correctamente",
                            type:"success",
                            confirmButtonText:"Cerrar",
                            closeOnConfirm:false},
                            function (isConfirm) {
                                if (isConfirm) {
                                    window.location = "suscriptores";
                                }
                            
                            }
                        );
                    </script>';
            }
        }
    }

    // imprimir suscriptores en el PDF
    public static function imprimirSuscriptoresController($dato){
        $datosController = $dato;

        $respuesta = SuscriptoresModel::mostrarSuscriptoresModel($datosController);
        return $respuesta;
    }

    // suscriptores sin revisar
    public function suscriptorSinRevisarController(){
    $respuesta = SuscriptoresModel::suscriptorSinRevisarModel("suscriptores");

        $sumaRevision=0;

        foreach ($respuesta as $row => $item) {
            
            if ($item["revision"] == 0) {
                ++$sumaRevision;
                echo '<span>'.$sumaRevision.'</span>';
            }
        }
    }
    // sucriptores revisados
    public static function suscriptoresRevisadosController($datos){
        $datosController = $datos;
        $respuesta = SuscriptoresModel::suscriptoresRevisadosModel($datosController,"suscriptores");

        echo $respuesta;
    }
}