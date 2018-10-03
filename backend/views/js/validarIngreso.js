// $(document).ready(function (){
// });

    function validarIngreso(){
    
        var expresion = /^[a-zA-Z0-9]*$/;
        var error = $("#error");

        if(error != ""){
            $("#usuarioIngreso").val()="";
        }
    
        if(!expresion.test($("#usuarioIngreso").val())){
            return false;
            
        }
        if(!expresion.test($("#passwordIngreso").val())){
            return false;
        }
    
    
        return true;
    
    }

    

