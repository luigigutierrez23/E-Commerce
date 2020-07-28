<?php 
	
	require_once "Controllers/template.controller.php";
	require_once "Controllers/products.controller.php";
	require_once "Controllers/slide.controller.php";
	require_once "Controllers/users.controller.php";
	require_once "Controllers/shopping-cart.controller.php";

	require_once "Models/template.model.php";
	require_once "Models/products.model.php";
	require_once "Models/slide.model.php";
	require_once "Models/users.model.php";
	require_once "Models/url.php";
	require_once "Models/shopping-cart.model.php";

	require_once "Extensions/PHPMailer/PHPMailerAutoload.php";
	require_once "Extensions/vendor/autoload.php";
	
	$plantilla = new ControladorPlantilla();
	$plantilla -> plantilla();
	
 ?>