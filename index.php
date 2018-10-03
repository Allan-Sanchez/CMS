<?php

require_once "controllers/template.php";
require_once "controllers/gestorSlide.php";
require_once "controllers/gestorArticulos.php";
require_once "controllers/gestorGaleria.php";
require_once "controllers/gestorVideo.php";
require_once "controllers/gestorMensajes.php";

require_once "models/gestorSlide.php";
require_once "models/gestorArticulos.php";
require_once "models/gestorGaleria.php";
require_once "models/gestorVideo.php";
require_once "models/gestorMensajes.php";



 $template = new TemplateController();

 $template->template();