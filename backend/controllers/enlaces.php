<?php


class Enlaces{

    public function enlacesControlles(){

       if(isset($_GET["action"])){

        $enlaces = $_GET["action"];
       }
       else{
           $enlaces ="index";
       }

       $respuesta = EnlacesModels::enlacesmodel($enlaces);

       include $respuesta;
    }
}