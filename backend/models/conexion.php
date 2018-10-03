<?php


class Conexion{

    public static function conectar(){

        $link = new PDO("mysql:host=localhost;dbname=cms","root","");
        return $link;

        
    }
}