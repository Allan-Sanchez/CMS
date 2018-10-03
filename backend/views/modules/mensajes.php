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
			MENSAJES        
			======================================-->

<div id="bandejaMensajes" class="col-lg-4 col-md-4 col-sm-6 col-xs-12">

    <div>
        <h1>Bandeja de Entrada</h1>
        <hr>
    </div>

    <?php 
        $mensajes = new MensajesController();
        $mensajes->mostrarMensajesController();
        $mensajes->borrarMensajeController();
    ?>
    
    
</div>

<div id="lecturaMensajes" class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

    <div>
        <hr>
        <button id="enviarCorreoMasivo" class="btn btn-success">Enviar mensaje a todos los usuarios</button>
        <hr>
    </div>

    <div id="verMensaje">
    <?php 
        $responderMensajes = new MensajesController();
        $responderMensajes-> responderMensajesController();
        $responderMensajes-> MensajesMasivosCotroller();
    ?>

    </div>

</div>
<script>
$(window).load(function () {

    var datos = new FormData();

    datos.append("revisionMensajes",1);

    $.ajax({
        method: "POST",
        url: "views/ajax/gestorMensajes.php",
        data: datos,
        cache: false,
        contentType:false,
        processData: false,
        success: function (response) {
            console.log(response);
            
        }
    });

});
</script>
<!--====  Fin de MENSAJES  ====-->