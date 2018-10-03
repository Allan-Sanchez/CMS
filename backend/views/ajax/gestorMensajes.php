<?php

require_once "../../controllers/gestorMensajes.php";
require_once "../../models/gestorMensajes.php";

require_once "../../controllers/gestorSuscriptores.php";
require_once "../../models/gestorSuscriptores.php";

class Ajax{

    public $revisionMensajes;

    public function gestorRevisionMensajesAjax(){
        $datos = $this->revisionMensajes;

        $respuesta = MensajesController::mensajesRevisadosController($datos);

        echo $respuesta;

    }

    public $revisionSuscriptore;

    public function gestorRevisionSuscriptoresAjax(){
        $datos = $this->revisionSuscriptore;

        $respuesta = SuscriptoresController ::suscriptoresRevisadosController($datos);

        echo $respuesta;

    }

}
// objetos 

if (isset($_POST["revisionMensajes"])) {
    
    $revisionMens = new Ajax();
    $revisionMens -> revisionMensajes = $_POST["revisionMensajes"];
    $revisionMens -> gestorRevisionMensajesAjax();
}
if (isset($_POST["revisionSuscriptores"])) {
    
    $revisionSuscrip = new Ajax();
    $revisionSuscrip -> revisionSuscriptore = $_POST["revisionSuscriptores"];
    $revisionSuscrip -> gestorRevisionSuscriptoresAjax();
}