<div class="row" id="videos">

    <hr>

    <h1 class="text-center text-info">
        <b>GALERÍA DE VIDEOS</b>
    </h1>

    <hr>

    <?php
        $videos = new Videos();
        $videos -> seleccionarVistaVideosController();
    ?>

    <!-- <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">

        <video controls width="100%">

            <source src="views/videos/video01.mp4" type="video/mp4">

        </video>

    </div>

    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">

        <video controls width="100%">

            <source src="views/videos/video02.mp4" type="video/mp4">

        </video>

    </div>

    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">

        <video controls width="100%">

            <source src="views/videos/video03.mp4" type="video/mp4">

        </video>

    </div>

    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">

        <video controls width="100%">

            <source src="views/videos/video04.mp4" type="video/mp4">

        </video>

    </div> -->

</div>