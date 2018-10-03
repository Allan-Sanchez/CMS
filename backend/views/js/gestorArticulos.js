$(function () {

// =======================
//   Agregar Articulo
// =======================

$("#btnAgregarArticulo").click(function(){

    $("#agregarArticulo").toggle(400);
})


// ===============================
//   subir imagen atraves de input
// ===============================
$("#subirFoto").change(function () { 

    imagen = this.files[0];

    imagenSize=imagen.size;
    imagenType=imagen.type;

    if (Number(imagenSize) > 2000000) {
        $("#arrastreImagenArticulo").before('<div id="alerta" class="alert alert-warning text-center">El archivo exede el peso permitido de 2MB</div>');
    }else{
        $("#alerta").remove();
    }
    if (imagenType == "image/jpeg" || imagenType =="image/png") {
        $("#alerta").remove();
    }else{
        $("#arrastreImagenArticulo").before('<div id="alerta" class="alert alert-warning text-center">El archivo debe de ser JPG O PNG</div>');

    }

// ===============================
//   mostrar imagen con AJAX
// ===============================
    
if (Number(imagenSize) < 2000000 && imagenType =="image/jpeg" || imagenType =="image/png" ) {

    var datos = new FormData();

    datos.append("imagen",imagen);
    $.ajax({
        type: "POST",
        url: "views/ajax/gestorArticulos.php",
        data: datos,
        cache:false,
        contentType:false,
        processData:false,
        beforeSend:function(){
            $("#arrastreImagenArticulo").before('<img src="views/images/status.gif" id="status">');

        },
        success: function (respuesta) {
           
            $("#status").remove();

            if(respuesta == 0){
                $("#arrastreImagenArticulo").before('<div id="alerta" class="alert alert-warning text-center">Las dimensiones de la imagen no son las correctas estas den ser 800 x 400</div>');

            }else{
                $("#arrastreImagenArticulo").html('<div id="imagenArticulo"><img src="'+respuesta.slice(6)+'" class="img-thumbnail"></div>');
            }
            
        }
    });
    
}
    
});


// ===============================
//   Editar imagen con AJAX
// ===============================
    $(".editarArticulo").click(function () { 

        idArticulo = $(this).parent().parent().attr("id");
        rutaImagen = $("#"+idArticulo).children("img").attr("src");
        titulo = $("#"+idArticulo).children("h1").html();
        introduccion = $("#"+idArticulo).children("p").html();
        contenido = $("#"+idArticulo).children("input").val();

        $("#"+idArticulo).html('<form method="POST" enctype="multipart/form-data"> <span><input style="width:10%; padding:5px 0; margin-top:4px;" type="submit" class="btn btn-primary pull-right" value="Guardar"></span><div id="editarImagen"><input style="display:none" type="file" id="subirNuevaFoto" class="btn btn-default"><div id="nuevaFoto"><span class="fa fa-times cambiarImagen"></span><img src="'+rutaImagen+'" class="img-thumbnail n"></div></div><input type="text" value="'+titulo+'" name="editarTitulo"><textarea cols="30" rows="5" name="editarIntroduccion">'+introduccion+'</textarea><textarea name="editarContenido" id="editarContenido" cols="30" rows="10">'+contenido+'</textarea><input type="hidden" value="'+idArticulo+'" name="id"><input type="hidden" value="'+rutaImagen+'" name="antiguaImagen"><hr></form>');

        $(".cambiarImagen").click(function () { 
            $(this).hide();

            $("#subirNuevaFoto").show();
            $("#subirNuevaFoto").css({"width":"58%"});
            $("#nuevaFoto").html("");
            $("#subirNuevaFoto").attr("name","editarImagen");
            $("#subirNuevaFoto").attr("required",true);

            $("#subirNuevaFoto").change(function () { 
                imagen = this.files[0];

                imagenSize=imagen.size;
                imagenType=imagen.type;

                if (Number(imagenSize) > 2000000) {
                    $("#arrastreImagenArticulo").before('<div id="alerta" class="alert alert-warning text-center">El archivo exede el peso permitido de 2MB</div>');
                }else{
                    $("#alerta").remove();
                }
                if (imagenType == "image/jpeg" || imagenType =="image/png") {
                    $("#alerta").remove();
                }else{
                    $("#arrastreImagenArticulo").before('<div id="alerta" class="alert alert-warning text-center">El archivo debe de ser JPG O PNG</div>');
                
                }           

                if (Number(imagenSize) < 2000000 && imagenType =="image/jpeg" || imagenType =="image/png" ) {

                    var datos = new FormData();
                
                    datos.append("imagen",imagen);
                    $.ajax({
                        type: "POST",
                        url: "views/ajax/gestorArticulos.php",
                        data: datos,
                        cache:false,
                        contentType:false,
                        processData:false,
                        beforeSend:function(){
                            $("#nuevaFoto").before('<img src="views/images/status.gif" style="width:15%" id="status2">');
                
                        },
                        success: function (respuesta) {
                           
                            $("#status2").remove();
                
                            if(respuesta == 0){
                                $("#editarImagen").before('<div id="alerta" class="alert alert-warning text-center">Las dimensiones de la imagen no son las correctas estas den ser 800 x 400</div>');
                
                            }else{
                                $("#nuevaFoto").html('<img src="'+respuesta.slice(6)+'" class="img-thumbnail">');
                            }
                            
                        }
                    });
                
            }

             });
         });
            
    });



// ===============================
//   Editar imagen con AJAX
// ===============================

var almacenarOrdenId = new Array(); 
var ordenItem = new Array();
$("#ordenArticulos").click(function () { 

    // ocultamos y mostrmos alguno atributos 
    $("#ordenArticulos").hide();
    $("#editarArticulo").css({"cursor":"move"});
    $("#editarArticulo span i").hide();
    $("#editarArticulo button").hide();
    $("#guardarOrdenArticulos").show();
    $("#editarArticulo img").hide();
    $("#editarArticulo p").hide();
    $("#editarArticulo hr").hide();
    $("#editarArticulo div").remove();
    $(".bloqueArticulos h1").css({"font-size":"14px","position":"absolute","padding":"10px","top":"-15px"});
    $(".bloqueArticulos").css({"padding":"2px"});
    $("#editarArticulo span").html('<i class="glyphicon glyphicon-move" style="padding:8px"></i>');

    // animacion ir hacia ariba con el scroll
    $("body, html").animate({
        scrollTop:$("body").offset().top
    },500)

    // Sortable de Jquerry UI
    $("#editarArticulo").sortable({
        revert:true,
        connectWith:".bloqueArticulo",
        handle:".handleArticle",
        stop:function (event) {

            for (var i = 0; i < $("#editarArticulo li").length; i++) {
                
                almacenarOrdenId[i] =event.target.children[i].id;
                ordenItem[i]= i+1;
            }
            
        }
    })

    $("#guardarOrdenArticulos").click(function () { 

        $("#ordenArticulos").show();
        $("#guardarOrdenArticulos").hide();        

        for (var i= 0; i < $("#editarArticulo li").length; i++) {
                
            var actualizarOrden = new FormData();
            actualizarOrden.append("actualizarOrdenArticulos",almacenarOrdenId[i]);
            actualizarOrden.append("actualizarOrdenItem",ordenItem[i]);
            
            $.ajax({
                method:"POST",
                url: "views/ajax/gestorArticulos.php",
                data: actualizarOrden,
                cache:false,
                contentType:false,
                processData: false,
                success: function (response) {
                    
                    $("#editarArticulo").html(response);
                    
                    swal({
                        title:"OK..!",
                        text:"Orden Modificado Correctamente",
                        type:"success",
                        confirmButtonText:"Cerrar",
                        closeOnConfirm:false},
                        function (isConfirm) {
                            if (isConfirm) {
                                window.location = "articulos";
                            }

                        }
                    );
                }
            });
        }
    });
    
    });

    
});
