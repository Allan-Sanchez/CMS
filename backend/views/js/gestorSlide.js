$(function () {
    // =============================
    //  Area de arrastrar imagenes
    // =============================

    if ($("#columnasSlide").html() == 0) {
        $("#columnasSlide").css({
            "height": "100px"
        });

    } else {
        $("#columnasSlide").css({
            "height": "auto"
        });

    }
    // fin
    
    // =============================
    // ajuste de pantalla
    // =============================

    // if ($("#slide").html() != 0) {
    //     $("#col1").css({
    //         "height": "200vh"
    //     });

    // }


    // =============================
    //  Subir imagenes
    // =============================

    $("#columnasSlide").on("dragover", function (e) {
        e.preventDefault();
        e.stopPropagation();

        $("#columnasSlide").css({
            "background": "url(views/images/pattern.jpg)"
        });
    })

    // =============================
    //  soltar imagenes
    // =============================

    $("#columnasSlide").on("drop", function (ex) {
        ex.preventDefault();
        ex.stopPropagation();

        $("#columnasSlide").css({
            "background": "#fff"
        });

        var archivo = ex.originalEvent.dataTransfer.files;
        var imagen = archivo[0];

        // validar el peso de la imagen
        var imagenSize = imagen.size;

        if (Number(imagenSize) > 2000000) {

            $("#columnasSlide").before('<div id="alertaSlide" class="alert alert-warning text-center">El archivo exede el peso permitido de 2MB</div>');

        } else {
            $("#alertaSlide").remove();
        }

        // validar extencion de la imagen
        var imagenType = imagen.type;

        if (imagenType == "image/jpeg" || imagenType == "image/png") {

            $("#alertaSlide").remove();

        } else {

            $("#columnasSlide").before('<div id="alertaSlide" class="alert alert-warning text-center">El archivo de ser formato (jpeg /png)</div>');
        }

        // subir imagen al servido
        if (Number(imagenSize) < 2000000 && imagenType == "image/jpeg" || imagenType == "image/png") {

            var datos = new FormData();

            datos.append("imagen", imagen);

            $.ajax({
                url: "views/ajax/gestorSlide.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                beforeSend: function () {
                    $("#columnasSlide").before('<img src="views/images/status.gif" id="statusSlide">');
                },
                success: function (respuesta) {

                    $("#statusSlide").remove();
                    if (respuesta == 0) {
                        $("#columnasSlide").before('<div id="alertaSlide" class="alert alert-warning text-center">La image es inferior a (1600px * 600px) que es lo permitido</div>');

                    } else {
                        $("#columnasSlide").css({
                            "height": "auto"
                        });
                        // (slice) nos permite cordar algunos caracteres
                        $("#columnasSlide").append('<li class="bloqueSlide"><span class="fa fa-times"></span><img src="' + respuesta["ruta"].slice(6) + '" class="handleImg"></li>');

                        $("#ordenarTextSlide").append('<li><span class="fa fa-pencil" style="background:blue"></span><img src="' + respuesta["ruta"].slice(6) + '" style="float:left; margin-bottom:10px" width="80%"><h1>'+respuesta["titulo"]+'</h1><p>'+respuesta["descripcion"]+'</p></li>');

                        // alerta suabe
                        swal({
                            title:"OK..!",
                            text:"La imgen se subio correctamente",
                            type:"success",
                            confirmButtonText:"Cerrar",
                            closeOnConfirm:false},
                            function (isConfirm) {
                                if (isConfirm) {
                                    window.location = "slide";
                                }

                              }
                        );
                    }

                }
            });

        }


    })

    // Eliminar item Slide
$(".eliminarSlide").click(function(){

    if($(".eliminarSlide").length ==1){
        $("#columnasSlide").css({
            "height": "100px"
        });
    }

    var idSlide = $(this).parent().attr("id");
    var rutaSlide =$(this).attr("ruta");
    
    $(this).parent().remove();

    $("#item"+idSlide).remove();

    var borrarItem = new FormData();

    borrarItem.append("idSlide",idSlide);
    borrarItem.append("rutaSlide",rutaSlide);

    $.ajax({
       url: "views/ajax/gestorSlide.php",
       method: "POST",
       data: borrarItem,
       cache: false,
       contentType: false,
       processData: false,
       // dataType: "json",
       success: function (respuesta) {
           
       }
       });

})


// Editar SLide

    $(".editarSlide").click(function () {
        var idSlide = $(this).parent().attr("id");
        var rutaImagen =$(this).parent().children("img").attr("src");
        var tituloImagen =$(this).parent().children("h1").html();
        var descripcionImagen =$(this).parent().children("p").html();

        $(this).parent().html('<img src="'+rutaImagen+'" class="img-thumbnail"><input id="enviarTitulo" type="text" class="form-control" placeholder="Título" value="'+tituloImagen+'"><textarea row="5" id="enviarDescripcion" class="form-control" placeholder="Descripción" >'+descripcionImagen+'</textarea><button id="guardar'+idSlide+'" class="btn btn-info pull-right" style="margin:10px">Guardar</button>');
        
        $("#guardar"+idSlide).click(function(){
            var enviarId = idSlide.slice(4);

            var enviarTitulo = $("#enviarTitulo").val();
            var enviarDescripcion =$("#enviarDescripcion").val();

            var actualizaSlide = new FormData;
            actualizaSlide.append("enviarId",enviarId);
            actualizaSlide.append("enviarTitulo",enviarTitulo);
            actualizaSlide.append("enviarDescripcion",enviarDescripcion);

            $.ajax({
                url: "views/ajax/gestorSlide.php",
                method: "POST",
                data: actualizaSlide,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",   
                success: function (respuesta) {
                    
                    $("#guardar"+idSlide).parent().html('<span class="fa fa-pencil editarSlide" style="background:blue"></span><img src="' +rutaImagen + '" style="float:left; margin-bottom:10px" width="80%"><h1>'+respuesta["titulo"]+'</h1><p>'+respuesta["descripcion"]+'</p>');
                    
                    swal({
                        title:"OK..!",
                        text:"Sean guardado los cambios correctamente",
                        type:"success",
                        confirmButtonText:"Cerrar",
                        closeOnConfirm:false},
                        function (isConfirm) {
                            if (isConfirm) {
                                window.location = "slide";
                            }

                          }
                    );
                }
                });


        })
      })



      var almacenarOrdenId = new Array();
      var ordenItems = new Array();
    //  Ordenar el Slide con JS
    $("#ordenarSlide").click(function () {
        $("#ordenarSlide").hide();
        $("#guardarSlide").show();

        $("#columnasSlide").css({"cursor":"move"});
        $("#columnasSlide span").hide();
        // accion de jquerry ui

        $("#columnasSlide").sortable({
            revert: true,
            connectWith:".bloqueSlide",
            handle:".handleImg",
            stop:function (event) {
                for (var i= 0; i< $("#columnasSlide li").length; i++) {
                    
                    almacenarOrdenId[i] = event.target.children[i].id;
                    ordenItems[i] = i+1;
                     
                }
              }
        })



      })

    $("#guardarSlide").click(function () {
        $("#ordenarSlide").show();
        $("#guardarSlide").hide(); 

        for (var i= 0; i< $("#columnasSlide li").length; i++){
            var actualizarOrden = new FormData();

            actualizarOrden.append("actualizarOrdenSlide",almacenarOrdenId[i]);
            actualizarOrden.append("actualizarOrdenItem",ordenItems[i]);

            $.ajax({
                url: "views/ajax/gestorSlide.php",
                method: "POST",
                data: actualizarOrden,
                cache: false,
                contentType: false,
                processData: false,
                // dataType: "json",
                success: function (respuesta) {
                    
                    $("#textoSlide ul").html(respuesta);
                    // alerta
                    swal({
                        title:"OK..!",
                        text:"Orden actualizado correctamente",
                        type:"success",
                        confirmButtonText:"Cerrar",
                        closeOnConfirm:false},
                        function (isConfirm) {
                            if (isConfirm) {
                                window.location = "slide";
                            }

                          }
                    );
                }
                });
        }
      })

    

});



