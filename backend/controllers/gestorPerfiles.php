<?php


class GestorPerfiles{


    // Guardar perfil
    public function guardarPerfilController(){

        $ruta = "";
        if (isset($_POST["nuevoUsuario"])) {
            
            if (isset($_FILES["nuevaImagen"]["tmp_name"])) {
            
                $imagen = $_FILES["nuevaImagen"]["tmp_name"];
                $random = mt_rand(100,999);
                $ruta = "views/images/perfiles/perfil".$random.".jpg";

                $origen = imagecreatefromjpeg($imagen);
                $destino = imagecrop($origen,["x"=>0, "y"=>0, "width"=>200, "height"=>200]);
                
                imagejpeg($destino,$ruta);
            }
            if($ruta == ""){
                 $ruta ="views/images/photo.jpg";
            }


            if (preg_match('/^[a-zA-Z]+$/',$_POST["nuevoUsuario"]) &&
                preg_match('/^[a-zA-Z0-9]+$/',$_POST["nuevoPassword"]) &&
                preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/',$_POST["nuevoCorreo"])) {
                
                    $encriptar = crypt($_POST["nuevoPassword"],'$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                    $datosController = array("usuario"=>$_POST["nuevoUsuario"],
                                             "password"=>$encriptar,
                                             "correo"=>$_POST["nuevoCorreo"],
                                             "rol"=>$_POST["nuevoRol"],
                                             "ruta"=>$ruta);

                    $respuesta = GestorPerfilModel::guardarPerfilModel($datosController,"usuarios");

                    if ($respuesta == "ok") {
                    
                        echo '<script> 
                                swal({
                                    title:"OK..!",
                                    text:"El Usuario se Agrego Correctamente",
                                    type:"success",
                                    confirmButtonText:"Cerrar",
                                    closeOnConfirm:false},
                                    function (isConfirm) {
                                        if (isConfirm) {
                                            window.location = "perfil";
                                        }
                                    
                                    }
                                );
                            </script>';
                    }
            }

            else{
                echo '<div class="alert alert-warning"><b>ERROR </b>No ingrese caracteres especiales</div>';
            }
        }
        
    }

    // listar los usuarios a la vista
    public function seleccionarUsuariosController(){
        $respuesta = GestorPerfilModel::seleccionarUsuariosModel("usuarios");
        $rol ="";

        //var_dump($respuesta);
        foreach ($respuesta as $row => $item) {

            if ($item["rol"] == 1) {
                $rol = "Administrador";
            }else{
                $rol = "Editor";
            }
            echo '<tr>
                    <td>'.$item["usuario"].'</td>
                    <td>'.$rol.'</td>
                    <td>'.$item["email"].'</td>
                    <td>
                    <a href="#perfil'.$item["id"].'" data-toggle="modal"><span class="btn btn-info fa fa-pencil quitarSuscriptor"></span></a>
                    <a  href="index.php?action=perfil&idBorrar='.$item["id"].'&borrarImg='.$item["foto"].'"><span class="btn btn-danger fa fa-remove "></span></a>
                    </td>
                </tr> 
                    <!-- Modal -->
                    <div class="modal fade" id="perfil'.$item["id"].'" tabindex="-1" role="dialog"  aria-hidden="true">
                    <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header" style="border:1px solid #eee;">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                    <h3 class="modal-title">Editar Perfil</h3>
                                </div>
                                <div class="modal-body" style="border:1px solid #eee;">
                                <form method="post" enctype="multipart/form-data" style="padding: 5px;">

                                   <div class="form-group">
                                     <input type="text" class="form-control" name="editarUsuario"  value="'.$item["usuario"].'"  required>
                                     <input type="hidden" name="idUsuario" value="'.$item["id"].'">
                                   </div>

                                   <div class="form-group">
                                     <input type="password" class="form-control" name="editarPassword" placeholder="Ingrese la contraseña hasta 10 caracteres" maxlength="10" required>
                                   </div>

                                   <div class="form-group">
                                     <input type="email" class="form-control" name="editarCorreo"   value="'.$item["email"].'" required>
                                   </div>

                                   <div class="form-group">
                                     <select class="form-control" name="editarRol"  required>
                                       <option value="">Seleccione un Rol</option>
                                       <option value="1">Administrador</option>
                                       <option value="2">Editor</option>
                                     </select>
                                   </div>

                                   <div style="display:block">
                                        <div class="form-group text-center">
                                        <img src="'.$item["foto"].'" alt="imagen de perfil" width="20%" class="img-circle">
                                        </div>
                                       <input type="hidden" name="fotoDefault" value="'.$item["foto"].'">
                                     <input type="file" name="editarImagen" class="form-control-file btn btn-default" style="display:inline-block; margin:10px 0;">
                                     <p class="text-center text-info" style="font-size:12px;">Tamaño recomendado de la imagen: <strong>100px * 100px</strong>, peso maximo <b>2MB</b></p>
                                   </div>
                                    <div class="form-group text-center">
                                    <input name="botonActualizarPerfil" id="guardarPerfil" class="btn btn-primary" type="submit" value="Actualizar Perfil">
                                    </div>

                                </form>
                                   
                                </div>
                                <div class="modal-footer" style="border:1px solid #eee;">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                ';
        }
    }

    /* edicion de el usuario  */

    public function editarPerfilController(){
        $ruta ="";

        if (isset($_POST["editarUsuario"])) {

            if (isset($_FILES["editarImagen"]["tmp_name"])) {

                $imagen = $_FILES["editarImagen"]["tmp_name"];
                $random = mt_rand(100,999);

                $ruta = "views/images/perfiles/perfil".$random.".jpg";

                $origen = imagecreatefromjpeg($imagen);

                $destino = imagecrop($origen,["x"=>0, "y"=>0, "width"=>200, "height"=>200]);

                imagejpeg($destino,$ruta);
                
            }
            if($ruta == ""){
                $ruta = $_POST["fotoDefault"];
            }
            if($ruta != "" && $_POST["fotoDefault"] != "views/images/photo.jpg"){
                unlink($_POST["fotoDefault"]);
            }

            if (preg_match('/^[a-zA-Z]+$/',$_POST["editarUsuario"]) &&
            preg_match('/^[a-zA-Z0-9]+$/',$_POST["editarPassword"]) &&
            preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/',$_POST["editarCorreo"])) {
            
                $encriptar = crypt($_POST["editarPassword"],'$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                $datos = array("id" => $_POST["idUsuario"],
                                "usuario" => $_POST["editarUsuario"],
                                "password" => $encriptar,
                                "correo" => $_POST["editarCorreo"],
                                "rol" => $_POST["editarRol"],
                                "foto" =>$ruta);

                $respuesta = GestorPerfilModel::editarPerfilModel($datos,"usuarios");

                
                if ($respuesta == "ok") {

                    if (isset($_POST["actualizarSeccion"])) {
                        # code...
                        $_SESSION["usuario"]=$_POST["editarUsuario"];
                        $_SESSION["id"]=$_POST["idUsuario"];
                        $_SESSION["correo"]=$_POST["editarCorreo"];
                        $_SESSION["rol"]=$_POST["editarRol"];
                        $_SESSION["foto"]=$ruta ;
                    }

                    
                    echo '<script> 
                            swal({
                                title:"OK..!",
                                text:"El Usuario se Edito Correctamente",
                                type:"success",
                                confirmButtonText:"Cerrar",
                                closeOnConfirm:false},
                                function (isConfirm) {
                                    if (isConfirm) {
                                        window.location = "perfil";
                                    }
                                
                                }
                            );
                        </script>';
                }



            }
            else{
                echo '<div class="alert alert-warning"><b>ERROR</b>No ingrese caracteres especiales</div>';
            }


        }
    }

    /* borrar al usuario perfil */

    public function borrarPerfilController(){
        if (isset($_GET["idBorrar"])) {
            $datos = $_GET["idBorrar"];
            $rutaImg =$_GET["borrarImg"];

            if($rutaImg != "views/images/photo.jpg"){
                
                unlink($_GET["borrarImg"]);
            }

            $respuesta = GestorPerfilModel::borrarPerfilModel($datos,"usuarios");

            if ($respuesta == "ok") {
                    
                echo '<script> 
                        swal({
                            title:"OK..!",
                            text:"El Usuario se Agrego Correctamente",
                            type:"success",
                            confirmButtonText:"Cerrar",
                            closeOnConfirm:false},
                            function (isConfirm) {
                                if (isConfirm) {
                                    window.location = "perfil";
                                }
                            
                            }
                        );
                    </script>';
            }


        }
    }
}