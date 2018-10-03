<?php
    session_start();

    if(!$_SESSION["validar"]){
        header("location:login");
        exit();
    }

    include_once "views/modules/botonera.php";
    include_once "views/modules/header.php";

?>
 <!--=====================================
		EDITAR	PERFIL       
======================================-->
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" id="formEditarPerfil" style="display:none" >
    <form method="post" enctype="multipart/form-data" style="padding: 20px;">

        <div class="form-group">
          <input type="text" class="form-control" name="editarUsuario" id="editarUsuario" value="<?php echo $_SESSION["usuario"]; ?>"  required>
          <input type="hidden" name="idUsuario" value="<?php echo $_SESSION["id"]; ?>">
          <input type="hidden" name="actualizarSeccion" value="ok">
        </div>

        <div class="form-group">
          <input type="password" class="form-control" name="editarPassword" id="editarPassword" placeholder="Ingrese la contraseña hasta 10 caracteres" maxlength="10" required>
        </div>

        <div class="form-group">
          <input type="email" class="form-control" name="editarCorreo" id="editarCorreo"  value="<?php echo $_SESSION["email"]; ?>" required>
        </div>

        <div class="form-group">
          <select class="form-control" name="editarRol" id="editarRol" required>
            <option value="">Seleccione un Rol</option>
            <option value="1">Administrador</option>
            <option value="2">Editor</option>
          </select>
        </div>

        <div class="form-group text-center">
            <img src="<?php echo $_SESSION["foto"]; ?>" alt="imagen de perfil" width="20%" class="img-circle">
            <input type="hidden" name="fotoDefault" value="<?php echo $_SESSION["foto"]; ?>">
          <input type="file" id="editarFotoPerfil" class="form-control-file btn btn-default" style="display:inline-block; margin:10px 0;">
          <p class="text-center text-info" style="font-size:12px;">Tamaño recomendado de la imagen: <strong>100px * 100px</strong>, peso maximo <b>2MB</b></p>
        </div>

        <input name="botonActualizarPerfil" id="actualizarPerfil" class="btn btn-primary" type="submit" value="Actualizar Perfil">

    </form>
    </div>

<!--=====================================
		CREAR	PERFIL       
======================================-->

<div id="editarPerfil" class="col-lg-4 col-md-4 col-sm-6 col-xs-12">

    <h1>Usuario: <?php echo $_SESSION["usuario"]; ?>
        <span class="btn btn-info fa fa-pencil pull-left" id="btnEditarPerfil" style="font-size:10px; margin-right:10px"></span>
    </h1>

    <div style="position:relative">
        
        <img src="<?php echo $_SESSION["foto"]; ?> " class="img-circle pull-right">
    </div>

    <hr>

    <h4>Perfil: <?php  
        if($_SESSION["rol"] == 1){
            echo "Administrador";
        }
        else{

            echo "Editor";
        }

         ?>
    </h4>

    <h4>Email: <?php echo $_SESSION["email"]; ?>
    </h4>

    <h4>Contraseña: *******
        </ph4>

</div>

<?php  

    if ($_SESSION["rol"] == 1) {
        # code...
    
 echo' <div id="crearPerfil" class="col-lg-6 col-md-6 col-sm-6 col-xs-12">



    <button id="registrarPerfil" class="btn btn-default " style="margin-bottom:20px">Registrar un nuevo miembro</button>

    <form id="formularioPerfil" method="post" enctype="multipart/form-data" style="display:none;">

        <div class="form-group">
          <input type="text" class="form-control" name="nuevoUsuario" id="nuevoUsuario" placeholder="Ingrese el nombre de Usuario hasta 10 caracteres" maxlength="10" required>
        </div>

        <div class="form-group">
          <input type="password" class="form-control" name="nuevoPassword" id="nuevoPassword" placeholder="Ingrese la contraseña hasta 10 caracteres" maxlength="10" required>
        </div>

        <div class="form-group">
          <input type="email" class="form-control" name="nuevoCorreo" id="nuevoCorreo"  placeholder="Ingrese su correo electronico" required>
        </div>

        <div class="form-group">
          <select class="form-control" name="nuevoRol" id="nuevoRol" required>
            <option value="">Seleccione un Rol</option>
            <option value="1">Administrador</option>
            <option value="2">Editor</option>
          </select>
        </div>

        <div class="form-group text-center">
          <input type="file" id="subiFotoPerfil" class="form-control-file btn btn-default" style="display:inline-block; margin:10px 0;">
          <p class="text-center text-info" style="font-size:12px;">Tamaño recomendado de la imagen: <strong>100px * 100px</strong>, peso maximo <b>2MB</b></p>
        </div>

        <input name="botonGuardarPerfil" id="guardarPerfil" class="btn btn-primary" type="submit" value="Guardar Perfil">
    
    </form>';
    
        $perfil = new GestorPerfiles();
        $perfil -> guardarPerfilController();
        $perfil -> editarPerfilController();
        $perfil -> borrarPerfilController();

    }
    ?>

    <hr>

    <div class="table-responsive">

        <table id="tablaSuscriptores" class="table table-striped display">
            <thead>
                <tr>
                    <th>Usuario</th>
                    <th>Perfil</th>
                    <th>Email</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>

            <?php

                $usuarios = new GestorPerfiles();
                $usuarios -> seleccionarUsuariosController();

            ?>
                
            </tbody>
        </table>

    </div>
</div>

<!--====  Fin de PERFIL  ====-->