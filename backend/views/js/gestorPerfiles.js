$(document).ready(function () {
    
    // Mostrar Formulario Registro perfil

    $("#registrarPerfil").click(function () { 
        
        $("#formularioPerfil").toggle("fast");
        
    });

    // subir foto perfil
    $("#subiFotoPerfil").change(function () { 
        
        $("#subiFotoPerfil").attr("name","nuevaImagen");
        
    });

    /* btn editar perfil */
    $("#btnEditarPerfil").click(function () { 
        
        $("#editarPerfil").hide("fast");
        $("#formEditarPerfil").show("fast");
    });

    /* capturamos el cambio en la foto perfil */
    $("#editarFotoPerfil").change(function () { 
        $("#editarFotoPerfil").attr("name","editarImagen");        
    });




});