<?php


class GestorArticulo{

    // Mostrar imagen slide
    public static function mostrarImagenController($datos){

        // getimagesize es para sacar la altura y ancho y (list) espara guardar esos valores en variables
       list($ancho,$alto) = getimagesize($datos);

       if($ancho < 800 || $alto < 400){
           echo 0;
       }else{
           $aleatorio = mt_rand(100,999);
           $ruta = "../../views/images/articulos/temp/articulo".$aleatorio.".jpg";

         // creamos la imagen apartir del archivo temp   
           $origen=imagecreatefromjpeg($datos);
         // recortamos la imagen a la medica necesaria    
           $destino =imagecrop($origen,["x"=>0, "y"=>0,"width"=>800,"height"=>400]);
        
           //    imagen se guarde
            imagejpeg($destino,$ruta);

           echo $ruta;

       }


    }

    // Guardar Articulo

    public function guardarArticuloController(){

        if(isset($_POST["tituloArticulo"])){
            
            $imagen = $_FILES["imagen"]["tmp_name"];
            // funcion para borrar los archivos de la carpeta temp
            $borrar =glob("views/images/articulos/temp/*");

            foreach ($borrar as $file) {
                unlink($file);
            }
        $aleatorio = mt_rand(100,999);
           $ruta = "views/images/articulos/articulo".$aleatorio.".jpg";
           // creamos la imagen apartir del archivo temp   
           $origen=imagecreatefromjpeg($imagen);
           // recortamos la imagen a la medica necesaria    
           $destino =imagecrop($origen,["x"=>0, "y"=>0,"width"=>800,"height"=>400]);
        
           //    imagen se guarde
            imagejpeg($destino,$ruta);

            $datosController = array("titulo"=>$_POST["tituloArticulo"],
                                     "introduccion"=>$_POST["introArticulo"]."...",
                                     "ruta"=>$ruta,
                                     "contenido"=>$_POST["contenidoArticulo"]);

           $respuesta = GestorArticulosModels::guardarArticuloModel($datosController,"articulo");

           echo $respuesta;
           if($respuesta =="ok"){
               echo'<script>
                        swal({
                            title:"OK..!",
                            text:"Articulo Guardado Correctamente",
                            type:"success",
                            confirmButtonText:"Cerrar",
                            closeOnConfirm:false},
                            function (isConfirm) {
                                if (isConfirm) {
                                    window.location = "articulos";
                                }

                            }
                        );
               </script>';
           }else{
               echo $respuesta;
           }

        }
    }

    // mostrar articulos

    public function mostrarArticuloController(){

        $respuesta = GestorArticulosModels::mostrarArticuloModel("articulo");

        foreach ($respuesta as $item) {
            # code...
            echo '<li id="'.$item["id"].'" class="bloqueArticulos">
            <span id="temporal" class="handleArticle">
                <a href="index.php?action=articulos&idBorrar='.$item["id"].'&rutaImagen='.$item["ruta"].'">
                    <i class="fa fa-times btn btn-danger"></i>
                </a>
                <i  class="fa fa-pencil btn btn-primary editarArticulo"></i>
            </span>
            <img src="'.$item["ruta"].'" class="img-thumbnail">
            <h1>'.$item["titulo"].'</h1>
            <p>'.$item["introduccion"].'</p>
            <input type="hidden" value="'.$item["contenido"].'">
            <a href="#articulo1'.$item["id"].'" data-toggle="modal">
                <button class="btn btn-default">Leer Más</button>
            </a>

            <hr>

        </li>
     <div id="articulo1'.$item["id"].'" class="modal fade">

        <div class="modal-dialog modal-content">

        <div class="modal-header" style="border:1px solid #eee">

            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h3 class="modal-title">'.$item["titulo"].'</h3>

        </div>

        <div class="modal-body" style="border:1px solid #eee">

            <img src="'.$item["ruta"].'" width="100%" style="margin-bottom:20px">
            <p class="parrafoContenido">'.$item["contenido"].'.</p>

        </div>

            <div class="modal-footer" style="border:1px solid #eee">

            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

            </div>

        </div> 

    </div>';
        }

    }

    // metodo borrar un articulo

    public function borrarArticuloController(){

        if (isset($_GET["idBorrar"])) {
            
            unlink($_GET["rutaImagen"]);

            $datosController =$_GET["idBorrar"];

           $respuesta = GestorArticulosModels::borrarArticuloModel($datosController,"articulo");

           if($respuesta == "ok"){
            echo'<script>
                     swal({
                         title:"OK..!",
                         text:"Articulo Borrado Correctamente",
                         type:"success",
                         confirmButtonText:"Cerrar",
                         closeOnConfirm:false},
                         function (isConfirm) {
                             if (isConfirm) {
                                 window.location = "articulos";
                             }

                         }
                     );
            </script>';
        }else{
            echo $respuesta;
        }
        }
    }

    // Editar articulo

    public function editarArticuloController(){

        $ruta ="";
        if(isset($_POST["editarTitulo"])){

            if (isset($_FILES["editarImagen"]["tmp_name"])) {
                
                $imagen =$_FILES["editarImagen"]["tmp_name"];
                $random = mt_rand(100,999);

                $ruta ="views/images/articulos/articulos".$random.".jpg";

                $origen = imagecreatefromjpeg($imagen);
                $destino = imagecrop($origen,["x"=>0, "y"=>0,"width"=>800,"height"=>400]);

                imagejpeg($destino,$ruta);
                $borrar =glob("views/images/articulos/temp/*");

                foreach ($borrar as $file) {
                    unlink($file);
                }
            }
            if($ruta ==""){

                $ruta = $_POST["antiguaImagen"];
            }else{
                unlink($POST["antiguaImagen"]);
            }


            $datosController =array("id"=>$_POST["id"],
                                    "titulo"=>$_POST["editarTitulo"],
                                    "introduccion"=>$_POST["editarIntroduccion"],
                                    "ruta"=>$ruta,
                                    "contenido"=>$_POST["editarContenido"]);

            $respuesta = GestorArticulosModels::editarArticuloModel($datosController,"articulo");

            if($respuesta == "ok"){
                echo'<script>
                         swal({
                             title:"OK..!",
                             text:"Articulo Editado Correctamente",
                             type:"success",
                             confirmButtonText:"Cerrar",
                             closeOnConfirm:false},
                             function (isConfirm) {
                                 if (isConfirm) {
                                     window.location = "articulos";
                                 }
    
                             }
                         );
                </script>';
            }else{
                echo $respuesta;
            }

        }
         
        
    }

    // actualizar orden articulos

    public static function actualizarOrdenController($datos){

        GestorArticulosModels::actualizarOrdenModel($datos,"articulo");
       

     $respuesta = GestorArticulosModels::seleccionarOrdenModel("articulo");
        
         foreach ($respuesta as $item) {
        # code...
        echo '<li id="'.$item["id"].'" class="bloqueArticulos">
                <span id="temporal" class="handleArticle">
                    <a href="index.php?action=articulos&idBorrar='.$item["id"].'&rutaImagen='.$item["ruta"].'">
                    <i class="fa fa-times btn btn-danger"></i>
                    </a>
                    <i  class="fa fa-pencil btn btn-primary editarArticulo"></i>
                </span>
                <img src="'.$item["ruta"].'" class="img-thumbnail">
                <h1>'.$item["titulo"].'</h1>
                <p>'.$item["introduccion"].'</p>
                <input type="hidden" value="'.$item["contenido"].'">
                <a href="#articulo1'.$item["id"].'" data-toggle="modal">
                <button class="btn btn-default">Leer Más</button>
                </a>

                <hr>

            </li>
            <div id="articulo1'.$item["id"].'" class="modal fade">

               <div class="modal-dialog modal-content">

                   <div class="modal-header" style="border:1px solid #eee">

                       <button type="button" class="close" data-dismiss="modal">&times;</button>
                       <h3 class="modal-title">'.$item["titulo"].'</h3>

                   </div>

               <div class="modal-body" style="border:1px solid #eee">

                   <img src="'.$item["ruta"].'" width="100%" style="margin-bottom:20px">
                   <p class="parrafoContenido">'.$item["contenido"].'.</p>

               </div>

                   <div class="modal-footer" style="border:1px solid #eee">

                       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                   </div>

               </div> 

            </div>';
        }
    }
    

}