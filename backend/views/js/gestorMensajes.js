$(document).ready(function () {

    // ==========================
    //   Modostrar todo el mensaje
    // ===========================

    $(".leerMensaje").click(function () {

        id = $(this).parent().attr("id");
        fecha = $("#" + id).children("p").html();
        nombre = $("#" + id).children("h3").html();
        console.log(nombre);
        correo = $("#" + id).children("h5").html();
        console.log(correo);
        
        mensaje = $("#" + id).children("input").val();
        console.log(mensaje);
        

        $("#verMensaje").html('<div class="well well-sm"> <h3>'+nombre+'</h3> <h5>'+correo+'</h5><p style="background:#fff; padding:10px">'+mensaje+'</p><button class="btn btn-info btn-sm responderMensaje">Responder</button>');

        $(".responderMensaje").click(function () { 
            enviarNombre = $(this).parent().children("h3").html();
            enviarCorreo = $(this).parent().children("h5").html();

            $("#verMensaje").html('<form method="POST"><p>Para: <input type="email" value="'+enviarCorreo.slice(6)+'" name="enviarCorreo" readonly style="border:0"><input type="hidden" value="'+enviarNombre+'" name="enviarNombre"></p><input type="text" placeholder="Título del Mensaje" class="form-control" name="enviarTitulo"><textarea name="enviarMensaje" id="" cols="30" rows="5" placeholder="Escribe tu mensaje..." class="form-control"></textarea><input type="submit" class="form-control btn btn-primary" value="Enviar"></form>');
            
        });



    });

    
    // ==========================
    //   Enviar Correo Masivo
    // ===========================



    $("#enviarCorreoMasivo").click(function () { 
        
        $("#verMensaje").html('<form method="POST"><p>Para: Todos los Suscriptore</p> <input type="text" class="form-control" name="tituloMasivo" placeholder="Titulo del Mensaje"><textarea name="mensajeMasivo" id="" cols="30" rows="5" placeholder="Escribe tu mensaje..." class="form-control"></textarea><input type="submit" class="form-control btn btn-primary" value="Enviar"></form>');

        
    });



});