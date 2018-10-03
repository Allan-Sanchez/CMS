<!--=====================================
			 CABEZOTE             
			======================================-->


<div id="cabezote" class="col-lg-10 col-md-10 col-sm-9 col-xs-12">
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
    <?php
    if ($_SESSION["rol"] == 1) {
        # code...
        echo'<ul>
                <li style="background: #333">
                    <a href="mensajes" style="color: #fff">
                        <i class="fa fa-envelope"></i>';
                         
                            $revisarMensajes = new MensajesController();
                            $revisarMensajes -> mensajesSinRevisarController();
                        
                  echo' </a>
                </li>
    
                <li style="background: #333">
                    <a href="suscriptores" style="color: #fff">
                        <i class="fa fa-bell"></i>';
                         
                            $revisarSuscriptores = new SuscriptoresController();
                            $revisarSuscriptores -> suscriptorSinRevisarController();
                        
                    echo'</a>
                </li>
    
            </ul>';
    }
        ?>

    </div>

    <div id="time" class="col-lg-4 col-md-4 col-sm-4 col-xs-4">


        <div class="text-center">
        <?php
        switch (date("l")) {
            case "Monday":
                $dia = "Lunes";
                break;
            case "Tuesday":
                $dia = "Martes";
                break;
            case "Wednesday":
                $dia = "Miercoles";
                break;
             case "Thursday":
                $dia = "Jueves";
                break;
            case "Friday":
                $dia = "Viernes";
                break;
            case "Saturday":
                $dia = "Sabado";
                break;
            case "Sunday":
                $dia = "Domingo";
                break;
        }

        switch (date("F")) {
            case "January":
                $mes = "Enero";
                break;
            case "February":
                $mes = "Febrero";
                break;
            case "March":
                $mes = "Marzo";
                break;
             case "April":
                $mes = "Abril";
                break;
            case "May":
                $mes = "Mayo";
                break;
            case "June":
                $mes = "Junio";
                break;
            case "July":
                $mes = "Julio";
                break;
            case "August":
                $mes = "Agosto";
                break;
            case "September":
                $mes = "Septiembre";
                break;
             case "October":
                $mes = "Octubre";
                break;
            case "November":
                $mes = "Noviembre";
                break;
            case "December":
                $mes = "Diciembre";
                break;
        }



            
            echo  $dia.",".date("d")." de ".$mes." de ".date("Y");
        ?>
        </div>
        <div class="text-center">
        <?php
            // siempre cuendo se usa tiempo en php
            date_default_timezone_get("America/Guatemala");

            // echo date("h").":".date("i").":".date("s")." ".date("a");

            echo '<div id="hora" hora="'.date("h").'" minutos="'.date("i").'" segundos="'.date("s").'" jornada="'.date("a").'"></div>'
        ?>
        
        </div>

    </div>

    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-right">

        <img src="<?php echo $_SESSION["foto"]; ?>" class="img-circle">

        <p id="member"><?php echo $_SESSION["usuario"]; ?>
            <span class="fa fa-chevron-down"></span>
            <br>
            <ol id="admin">
                <li>
                    <a href="perfil">
                        <span class="fa fa-user"></span>Editar Perfil</a>
                </li>
                <li>
                    <a href="">
                        <span class="fa fa-file-text"></span>Términos y Condiciones</a>
                </li>
                <li>
                    <a href="salir ">
                        <span class="fa fa-times"></span>Salir</a>
                </li>
            </ol>

        </p>

    </div>

</div>

<!--====  Fin de CABEZOTE  ====-->

<script>

 function reloj(){

     var hora = $("#hora").attr("hora");
     var minutos = $("#hora").attr("minutos");
     var segundos = $("#hora").attr("segundos");
     var jornada = $("#hora").attr("jornada");

     setInterval(function () { 

         if(segundos == 59){

             segundos ="0" + 0; 
             minutos = Number(minutos)+1;   
         }
         else{

            segundos++;

            if (segundos > 0 && segundos < 10) {
               segundos ="0" + segundos++;             
            }
         }
         
         if(minutos > 59){
             window.location.reload();
         }


         $("#hora").html(hora+":"+minutos+":"+segundos+":"+jornada);
         

      },1000);

 }      

 reloj(); 

</script>