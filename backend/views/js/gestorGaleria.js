$(document).ready(function () {
    
    // ==========================
    //   Evitar salir a otra ventana por error de  Imagenes
    // ===========================
    
    
    $("body,html").on("dragover", function (e) {
    
        e.preventDefault();
        e.stopPropagation();
    
    });
    $("body,html").on("drop", function (e) {
    
        e.preventDefault();
        e.stopPropagation();
    
    });
// ==========================
//   Subir Multiples Imagenes
// ===========================


    $("#lightbox").on("dragover", function (e) {

        e.preventDefault();
        e.stopPropagation();

        $("#lightbox").css({"background":"url(views/images/pattern.jpg)"});

    });
// ==========================
//   Soltar  Imagenes
// ===========================

var imagenSize = new Array();
var imagenType = new Array();
    $("#lightbox").on("drop", function (e) {

        e.preventDefault();
        e.stopPropagation();

        $("#lightbox").css({"background":"#fff"});

        archivo = e.originalEvent.dataTransfer.files;

        for (var i = 0; i < archivo.length; i++) {
            imagen = archivo[i];
            imagenSize.push(imagen.size);
            imagenType.push(imagen.type);

            if (Number(imagenSize[i])>2000000) {
                $("#lightbox").before('<div class="alert alert-warnig alerta text-center">El archivo exede el paso permitido, 2Mb</div>');
                
            }else{
                $(".alerta").remove();
            }

            if (imagenType[i] == "image/jpeg" || imagenType[i] == "image/png") {
                $(".alerta").remove();
            }else{
                $("#lightbox").before('<div class="alert alert-warnig alerta text-center">El archivo debe de ser JPG o PNG </div>');

            }

            if (Number(imagenSize[i]) < 2000000 && imagenType[i] == "image/jpeg" || imagenType[i] == "image/png") {

                var datos = new FormData();

                datos.append("imagen",imagen);

                $.ajax({
                    method: "POST",
                    url: "views/ajax/gestorGaleria.php",
                    data: datos,
                    contentType: false,
                    cache: false,
                    processData :false,
                    beforeSend:function(){
                        $("#lightbox").append('<li id="status"><img style="width:15%" src="views/images/status.gif"></li>');
                    },
                    success: function (response) {
                        $("#status").remove();

                        if (response == 0) {
                            $("#lightbox").before('<div class="alert alert-warnig alerta text-center">La imagen es menor a 1024px * 768px </div>');   
                        
                        }else{
                            $("#lightbox").css({"height":"auto"});
                            $("#lightbox").append('<li><span class="fa fa-times"></span><a rel="grupo" href="'+response.slice(6)+'"><img src="'+response.slice(6)+'"></a></li>');
                            
                            swal({
                                title:"OK..!",
                                text:"La imgen se subio correctamente",
                                type:"success",
                                confirmButtonText:"Cerrar",
                                closeOnConfirm:false},
                                function (isConfirm) {
                                    if (isConfirm) {
                                        window.location = "galeria";
                                    }
    
                                  }
                            );
                        
                        
                        }
                        console.log(response);
                        
                    }
                });
                
            }



        }


        

    });



    // ==========================
    //  Area de arrastre de imagenes
    // ===========================

    if ($("#lightbox").html() == 0) {
        
        $("#lightbox").css({"height":"100px"});

    }else{
        $("#lightbox").css({"height":"auto"});

    }

    
    // ==========================
    //  Eliminar imagen de la galeria
    // ===========================

    $(".eliminarImagen").click(function () { 
        if ($(".eliminarImagen").length == 1) {
            
            $(".eliminarImagen").css({"height":"100px"});
        }


        idGaleria = $(this).parent().attr("id"); 
        rutaImagen =$(this).attr("ruta");
        console.log(idGaleria);
          
        $(this).parent().remove();

        var borrarImagen = new FormData();

        borrarImagen.append("idGaleria",idGaleria);
        borrarImagen.append("rutaGaleria",rutaImagen);

        $.ajax({
            method: "POST",
            url: "views/ajax/gestorGaleria.php",
            data: borrarImagen,
            cache:false,
            contentType: false,
            processData: false,
            success: function (response) {

                if (response == "ok") {

                    swal({
                        title:"OK..!",
                        text:"La imgen se Elimino correctamente",
                        type:"success",
                        confirmButtonText:"Cerrar",
                        closeOnConfirm:false},
                        function (isConfirm) {
                            if (isConfirm) {
                                window.location = "galeria";
                            }

                          }
                    );
                    
                }
                
            }
        });
        
    });

    // ==========================
    //  Ordenar imagen de la galeria
    // ===========================
    var almacenarOrdenId = new Array();
    var ordenItem = new Array();

    $("#ordenarGaleria").click(function () { 
        
        $("#ordenarGaleria").hide();
        $("#guardarGaleria").show();

        $("#lightbox").css({"cursor":"move"});
        $("#lightbox span").hide();

        // sortable funcion qu usamos para mover mos elementos
        $("#lightbox").sortable({
            revert :true,
            
            connectWith:".bloqueGaleria",//creamos la conexion
            handle:".handleImg",
            stop:function (event) { 
                for (var i = 0; i < $("#lightbox li").length; i++) {
                    
                    almacenarOrdenId[i]= event.target.children[i].id;
                    ordenItem[i]= i+1;
                }
             }
        })
        
    });

    $("#guardarGaleria").click(function () { 
        
        $("#guardarGaleria").hide();
        $("#ordenarGaleria").show();

        for (var i = 0; i < $("#lightbox li").length; i++) {

            var actualizarOrden = new FormData();

            actualizarOrden.append("actualizarOrdenGaleria",almacenarOrdenId[i]);
            actualizarOrden.append("actualizarOrdenItem",ordenItem[i]);

            $.ajax({
            method: "POST",
            url: "views/ajax/gestorGaleria.php",
            data: actualizarOrden,
            cache:false,
            contentType: false,
            processData: false,
            success: function (response) {

                $("#lightbox").html(response);

                    swal({
                        title:"OK..!",
                        text:"El orden se actualizo correctamente",
                        type:"success",
                        confirmButtonText:"Cerrar",
                        closeOnConfirm:false},
                        function (isConfirm) {
                            if (isConfirm) {
                                window.location = "galeria";
                            }

                          }
                    ); 
                
                }
            });
        
        }
        
    });






});