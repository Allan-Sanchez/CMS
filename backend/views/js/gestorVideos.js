$(document).ready(function () {
    // =============================
    //  Area para subir  videos
    // =============================

    if ($("#galeriaVideo").html()==0) {
        
        $("#galeriaVideo").css({"height":"100px"});
    }else{

        $("#galeriaVideo").css({"height":"auto"});

    }


    // =============================
    //  Subir videos
    // =============================

    $("#subirVideo").change(function () { 
        
        video = this.files[0];
        // validar tama;o
        videoSize = video.size;

        if(Number(videoSize)>50000000){
            $("#galeriaVideo").before('<div class="alert alert-warning alerta text-center">El Peso del video es muy grande el peso ideal es 50M</div>');

        }else{
            $(".alerta").remove();
        }
        // validar extencion de el video
        videoType = video.type;
        if (videoType =="video/mp4") {
            $(".alerta").remove();
        }else{
            $("#galeriaVideo").before('<div class="alert alert-warning alerta text-center">El Video debe de estar en formato MP4</div>');

        }

     // =============================
     //  Mostrar videos con Ajax
     // =============================

        if(Number(videoSize) < 50000000 && videoType =="video/mp4" ){

            var datos = new FormData();

            datos.append("video",video);
            $.ajax({
                method: "POST",
                url: "views/ajax/gestorVideos.php",
                data: datos,
                cache: false,
                processData: false,
                contentType :false,
                beforeSend:function () {
                    $("#galeriaVideo").before('<img src="views/images/status.gif" id="status">');
                  },
                success: function (response) {

                    $("#status").remove();
                    $("#galeriaVideo").css({"height":"auto"});
                    $("#galeriaVideo").append('<li><span class="fa fa-times"></span><video controls><source src="'+response.slice(6)+'" type="video/mp4"></video></li>');

                    swal({
                        title:"OK..!",
                        text:"El video se subio correctamente",
                        type:"success",
                        confirmButtonText:"Cerrar",
                        closeOnConfirm:false},
                        function (isConfirm) {
                            if (isConfirm) {
                                window.location = "videos";
                            }

                          }
                    ); 
                }
            });
        }

        
    });


    // =============================
    //  Eliminar  videos
    // =============================

    $(".eliminarVideo").click(function () { 
        
        if ($(".eliminarVideo").length== 1) {
         $("#galeriaVideo").css({"height":"100px"});   
        }
            idVideo=$(this).parent().attr("id");
            rutaVideo = $(this).attr("ruta");
            console.log(rutaVideo);
            

        $(this).parent().remove();

        borrarVideo = new FormData();

        borrarVideo.append("idVideo",idVideo);
        borrarVideo.append("rutaVideo",rutaVideo);
        console.log(borrarVideo);
        

        $.ajax({
            method: "POST",
            url: "views/ajax/gestorVideos.php",
            data: borrarVideo,
            cache: false,
            processData: false,
            contentType :false,
            success: function (response) {
                console.log(response);
                
                
            }
        });
    });

    // =============================
     //  ordenar videos con Ajax
     // =============================
     var almacenarOrdenId = new Array();
     var ordenItem = new Array();
     
     $("#ordenarVideo").click(function(){
     
         $("#ordenarVideo").hide();
         $("#guardarVideo").show();
     
         $("#galeriaVideo").css({"cursor":"move"})
         $("#galeriaVideo span").hide()
     
         $("#galeriaVideo").sortable({
             revert: true,
             connectWith: ".bloqueVideo",
             handle: ".handleVideo",
             stop: function(event){
     
                 for(var i= 0; i < $("#galeriaVideo li").length; i++){
     
                     almacenarOrdenId[i] = event.target.children[i].id;
                     ordenItem[i]  =  i+1;  	
                 }
     
             }
     
         })
     
     })

     $("#guardarVideo").click(function(){

        $("#ordenarVideo").show();
        $("#guardarVideo").hide();
    
        for(var i= 0; i < $("#galeriaVideo li").length; i++){
    
            var actualizarOrden = new FormData();
            actualizarOrden.append("actualizarOrdenVideo", almacenarOrdenId[i]);
            actualizarOrden.append("actualizarOrdenItem", ordenItem[i]);
    
            $.ajax({
                url:"views/ajax/gestorVideos.php",
                method: "POST",
                data: actualizarOrden,
                cache: false,
                contentType: false,
                processData: false,
                success: function(respuesta){
    
                    $("#galeriaVideo").html(respuesta);
    
                    swal({
                            title: "¡OK!",
                            text: "¡El orden se ha actualizado correctamente!",
                            type: "success",
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
                            },
                            function(isConfirm){
                                if (isConfirm){
                                    window.location = "videos";
                                }
                            });
    
                }
    
            })
    
        }
    
    })


    
});