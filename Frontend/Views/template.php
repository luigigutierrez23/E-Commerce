<!DOCTYPE html>
 <html lang="es">
 <head>
 	<meta charset="utf-8">
 	<meta http-equiv="X-UA-Compatible" content="IE=edge">

 	<meta name="viewport" content="width=device-width, initial-scale = 1.0,minimum-scale=1.0,
 	maximum-scale=1.0,user-scalable=no">

 	<meta name="description" content="Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
 	tempor incididunt ut labore et dolore magna aliqua.">

 	<meta name="keyword" content="Lorem ipsum, dolor sit amet, consectetur adipisicing, elit, sed do eiusmod,
 	tempor incididunt, ut labore et, dolore magna aliqua.">

 	<meta name="title" content="Tienda Virtual">
	
	<?php 

		session_start();
		
		$servidor = Url::ctrUrlServidor();

		$icono = ControladorPlantilla::ctrEstiloPlantilla();

		echo '<link rel="icon" href="'.$servidor.$icono["icono"].'">';

		/*=============================================
		=            MANTENER RUTA DEL PROYECTO       =
		=============================================*/
		
		$url = Url::ctrUrl();	
	 ?>
	
	<!--=====================================
	PLUGINS CSS
	======================================-->
 	<link rel="stylesheet" type="text/css" href="<?php echo $url; ?>Views/css/plugins/font-awesome.min.css">
 	<link rel="stylesheet" type="text/css" href="<?php echo $url; ?>Views/css/plugins/bootstrap.min.css">
 	<link rel="stylesheet" type="text/css" href="<?php echo $url; ?>Views/css/plugins/flexslider.css">
 	<link rel="stylesheet" type="text/css" href="<?php echo $url; ?>Views/css/plugins/sweetalert.css">

 	<link href="https://fonts.googleapis.com/css?family=Ubuntu+Condensed&display=swap" rel="stylesheet">
 	<link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet">

	<!--=====================================
	HOJAS DE ESTILO PERSONALIZADAS
	======================================-->
 	<link rel="stylesheet" type="text/css" href="<?php echo $url; ?>Views/css/template.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $url; ?>Views/css/header.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $url; ?>Views/css/slide.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $url; ?>Views/css/products.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $url; ?>Views/css/products-info.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $url; ?>Views/css/profile.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $url; ?>Views/css/shopping-cart.css">

	<!--=====================================
	PLUGINS JAVASCRIPT
	======================================-->

 	<script src="<?php echo $url; ?>Views/js/plugins/jquery.min.js"></script>
 	<script src="<?php echo $url; ?>Views/js/plugins/bootstrap.min.js"></script>
 	<script src="<?php echo $url; ?>Views/js/plugins/jquery.easing.js"></script>
 	<script src="<?php echo $url; ?>Views/js/plugins/jquery.scrollUp.js"></script>
 	<script src="<?php echo $url; ?>Views/js/plugins/jquery.flexslider.js"></script>
 	<script src="<?php echo $url; ?>Views/js/plugins/sweetalert.min.js"></script>

 	<title>Tienda Virtual</title>
 </head>
 <body>
 	<?php 

 		/*=============================================
 		=            HEAD          					  =
 		=============================================*/
 		
 		include "modules/header.php";
 		

 		/*=============================================
 		=            CONTENIDO DINAMICO        		  =
 		=============================================*/
 		$rutas = array();

 		$ruta = "";
 		$infoProducto = null;

 		if(isset($_GET["url"]))
 		{
 			$rutas = explode("/", $_GET["url"]);

 			$item = "url";
 			$valor = $rutas[0];

 			/*=============================================
 			=           URL'S AMIGABLES DE CATEGORIAS 	  =
 			=============================================*/
 			$rutaCategorias = ControladorProductos::ctrMostrarCategorias($item,$valor);
			
			if(is_array($rutaCategorias)){
				if($rutas[0] == $rutaCategorias["url"]){

					$ruta = $rutas[0];

				}
				
			}
			

 			/*=============================================
 			=        URL'S AMIGABLES DE SUBCATEGORIAS 	  =
 			=============================================*/

 			$rutaSubCategorias = ControladorProductos::ctrMostrarSubCategorias($item, $valor);

 			foreach ($rutaSubCategorias as $key => $value) {
 				
 				if($rutas[0] == $value["url"]){

	 				$ruta = $rutas[0];
	 			}
 			}

 			/*=============================================
 			=        URL'S AMIGABLES DE PRODUCTOS    	  =
 			=============================================*/

 			$rutaProductos = ControladorProductos::ctrMostrarInfoProducto($item,$valor);

 			if ((!is_null($rutas[0])) && (!empty($rutaProductos))){
 				if($rutas[0] == $rutaProductos["url"]){
 	
	 				$infoProducto = $rutas[0];
	 			}
 			}
 			

 			/*=============================================
 			=  		LISTA BLANCA DE URL'S AMIGABLES	 	  =
 			=============================================*/
 			if($ruta != null || $rutas[0] =="articulos-gratis" || $rutas[0] =="lo-mas-vendido" || $rutas[0] == "lo-mas-visto"){

 				include "modules/products.php";

 			}else if($infoProducto != null)
 			{
 				include "modules/products-info.php";

 			}else if($rutas[0] == "buscador" || $rutas[0] == "verification" || $rutas[0] == "exit" || $rutas[0] == "profile" || $rutas[0] == "shopping-cart")
 			{
 				include "modules/".$rutas[0].".php";

 			}else
 			{
 				include "modules/error404.php";
 			}
 		}else
 		{
 			include "modules/slide.php";

 			include "modules/featured.php";
 		}

 		/*=====  End of Section comment block  ======*/
 		

 	 ?>

 	 <input type="hidden" value ="<?php echo $url ?>" id="rutaOculta">
 	<!--=====================================
	 JAVASCRIPT PERSONALIZADOS
	======================================-->
 	<script src="<?php echo $url ?>Views/js/header.js"></script>
 	<script src="<?php echo $url ?>Views/js/template.js"></script>
 	<script src="<?php echo $url ?>Views/js/slide.js"></script>
 	<script src="<?php echo $url ?>Views/js/search.js"></script>
 	<script src="<?php echo $url ?>Views/js/products-info.js"></script>
 	<script src="<?php echo $url ?>Views/js/users.js"></script>
 	<script src="<?php echo $url ?>Views/js/registro-facebook.js"></script>
 	<script src="<?php echo $url ?>Views/js/shopping-cart.js"></script>


	<script>
	  window.fbAsyncInit = function() {
	    FB.init({
	      appId      : '657614951752272',
	      cookie     : true,
	      xfbml      : true,
	      version    : 'v6.0'
	    });
	      
	    FB.AppEvents.logPageView();   
	      
	  };

	  (function(d, s, id){
	     var js, fjs = d.getElementsByTagName(s)[0];
	     if (d.getElementById(id)) {return;}
	     js = d.createElement(s); js.id = id;
	     js.src = "https://connect.facebook.net/en_US/sdk.js";
	     fjs.parentNode.insertBefore(js, fjs);
	   }(document, 'script', 'facebook-jssdk'));
	</script>

 </body>
 </html>
