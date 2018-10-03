<?php

class Galeria{

    public function seleccionarGaleriaController(){

        $respuesta = GaleriaModel::seleccionarGaleriaModel("galeria");
        
        foreach ($respuesta as $item) {
            # code...
            echo'<li>
                    <a rel="grupo" href="backend/'.substr($item["ruta"],6).'">
                        <img src="backend/'.substr($item["ruta"],6).'">
                    </a>
                </li>';
        }
    }

}

