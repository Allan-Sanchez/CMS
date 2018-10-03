<?php

class Articulos{

    public function seleccionarArticulosController(){

     $respuesta = ArticulosModel::seleccionarArticulosModel("articulo");

     foreach ($respuesta as $item) {
         # code...

         echo '<li class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

                    <img src="backend/'.$item["ruta"].'" class="img-thumbnail">
                    <h1>'.$item["titulo"].'</h1>
                    <p>'.$item["introduccion"].'</p>
                    <a href="#articulo'.$item["id"].'" data-toggle="modal">
                        <button class="btn btn-default">Leer Más</button>
                    </a>
                
                    <hr>
                
                </li>
                <div id="articulo'.$item["id"].'" class="modal fade">

                    <div class="modal-dialog modal-content">

                        <div class="modal-header" style="border:1px solid #eee">

                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h3 class="modal-title">'.$item["titulo"].'</h3>

                        </div>

                        <div class="modal-body" style="border:1px solid #eee">

                            <img src="backend/'.$item["ruta"].'" width="100%" style="margin-bottom:20px">
                            <p class="parrafoContenido text-justify">'.$item["contenido"].'</p>

                        </div>

                        <div class="modal-footer" style="border:1px solid #eee">

                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                        </div>

                    </div>

                </div>';
     }
    }
}