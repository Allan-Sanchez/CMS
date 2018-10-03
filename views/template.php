
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>FrontEnd</title>

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="icon" href="views/images/icono.jpg">

	<link rel="stylesheet" href="views/css/bootstrap.min.css">
	<link rel="stylesheet" href="views/css/font-awesome.min.css">
	<link rel="stylesheet" href="views/css/style.css">
	<link rel="stylesheet" href="views/css/fonts.css">
	<link rel="stylesheet" href="views/css/cssFancybox/jquery.fancybox.css">
	<link rel="stylesheet" href="backend/views/css/sweetalert.css">

	<script src="views/js/jquery-2.2.0.min.js"></script>
	<script src="views/js/bootstrap.min.js"></script>
	<script src="views/js/jquery.fancybox.js"></script>
	<script src="views/js/animatescroll.js"></script>
	<script src="views/js/jquery.scrollUp.js"></script>
	<script src="backend/views/js/sweetalert.min.js"></script>


</head>

<body>

	<div class="container-fluid">

        <!--=====================================
		HEADER
        ======================================-->
        <?php 
            include "modules/header.php";
        ?>

		<!--=====================================
		SLIDE
        ======================================-->
        <?php 
            include "modules/slide.php";
        ?>
                

		<!--=====================================
		TOP
        ======================================-->
        <?php 
            include "modules/top.php";
        ?>

		<!--=====================================
		GALERIA
		======================================-->
        <?php 
            include "modules/galeria.php";
        ?>


		<!--=====================================
		ARTÍCULOS
		======================================-->
        <?php 
            include "modules/articulos.php";
        ?>

		<!--=====================================
		VIDEOS
        ======================================-->
        <?php 
            include "modules/videos.php";
        ?>

		<!--=====================================
			CONTÁCTENOS         
		======================================-->
        <?php 
            include "modules/contactos.php";
        ?>

		<!--=====================================
			ARTÍCULO MODAL         
		======================================-->
        <?php 
            include "modules/articuloModal.php";
        ?>
		
	</div>




<script src="views/js/script.js"></script>

</body>
</html>





