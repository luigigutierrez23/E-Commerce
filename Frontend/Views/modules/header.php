<?php 
	$servidor = Url::ctrUrlServidor();
	$url = Url::ctrUrl();

/*=============================================
API DE GOOGLE
=============================================*/

// https://console.developers.google.com/apis
// https://github.com/google/google-api-php-client

/*=============================================
INICIO DE SESION USUARIO
=============================================*/

if(isset($_SESSION["validarSesion"])){

	if($_SESSION["validarSesion"] == "ok"){

		echo '<script>
				
				localStorage.setItem("usuario","'.$_SESSION["id"].'");
				
			</script>';
	}
}
/*=============================================
CREAR OBJETO API DE GOOGLE
=============================================*/

	$client = new Google_Client();
	$client-> setAuthConfig('Models/client_secret.json');
	$client->setAccessType("offline");
	$client->setScopes(['profile','email']);

/*=============================================
RUTA PARA EL LOGIN DE GOOGLE
=============================================*/

	$rutaGoogle = $client->createAuthUrl();

/*=============================================
RECIBIMOS VARIABLE GET DE GOOGLE LLAMADA CODE
=============================================*/
	
	if(isset($_GET["code"])){

		$token = $client->authenticate($_GET["code"]);

		$_SESSION['id_token_google'] = $token;

		$client->setAccessToken($token);

	}

/*=============================================
RECIBIMOS DATOS CIFRADOS DE GOOGLE EN UN ARRAY
=============================================*/

	if($client->getAccessToken()){

		$item = $client->verifyIdToken();

		$datos = array("nombre"=>$item["name"],
					   "email"=>$item["email"],
					   "foto"=>$item["picture"],
					   "password"=>"null",
					   "modo"=>"google",
					   "verificacion"=>0,
					   "emailEncriptado"=>"null");

		$respuesta = ControladorUsuarios::ctrRegistroRedesSociales($datos);

			echo'<script>
				
				setTimeout(function(){

					window.location = localStorage.getItem("rutaActual");

					},100);
				
			</script>';

	}
 ?>


<!--=========================
=            TOP            =
==========================-->

<div class="container-fluid barraSuperior" id="top">
	
	<div class="container">
		
		<div class="row">
			<!--============================
			=            SOCIAL            =
			=============================-->

			<div class="col-lg-9 col-md-9 col-sm-8 col-xs-12 social" >
				<ul>
					<?php 

						$social = ControladorPlantilla::ctrEstiloPlantilla();

						$jsonRedesSociales = json_decode($social["redesSociales"],true);
			
						foreach ($jsonRedesSociales as $key => $value){

						   echo '<li>
									<a href="'.$value["url"].'" target="_blank">
										<i class="fa '.$value["red"].' redSocial '.$value["estilo"].'" aria-hidden="true"></i>
									</a>
								</li>';
						}

					 ?>
				</ul>
			</div>
			
			<!--============================
			=            REGISTRO          =
			=============================-->

			<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 registro" >
				<ul>

					<?php 

						if(isset($_SESSION["validarSesion"])){

							if($_SESSION["validarSesion"] == "ok"){

								if($_SESSION["modo"] == "directo"){

									if($_SESSION["foto"] != ""){

										echo '<li>

												<img class = "img-circle" src="'.$url.$_SESSION["foto"].'" width="10%">
										</li>';

									}else{

										echo '<li>

												<img class = "img-circle" src="'.$servidor.'Views/img/usuarios/default/anonymous.png" width="10%">
										</li>';

									}

									echo '<li>|</li>
										  <li><a href="'.$url.'profile">Ver Perfil</a></li>
										  <li>|</li>
										  <li><a href="'.$url.'exit">Salir</a></li>';

								}

								if($_SESSION["modo"] == "facebook"){

									echo '<li>

												<img class = "img-circle" src="'.$_SESSION["foto"].'" width="10%">
										</li>

										<li>|</li>

										<li><a href="'.$url.'profile">Ver Perfil<a></li>

										<li>|</li>

										<li><a href="'.$url.'exit" class="salir">Salir<a></li>';

								}

								if($_SESSION["modo"] == "google"){

									echo '<li>

												<img class = "img-circle" src="'.$_SESSION["foto"].'" width="10%">
										</li>

										<li>|</li>

										<li><a href="'.$url.'profile">Ver Perfil<a></li>

										<li>|</li>

										<li><a href="'.$url.'exit">Salir<a></li>';

								}
							}
						}
						else{

							echo'<li><a href="#modalIngreso" data-toggle="modal">Ingresar</a></li>
								<li>|</li>
								<li><a href="#modalRegistro" data-toggle="modal">Crear una cuenta</a></li>';
						}

					 ?>
					
				</ul>
			</div>
		</div>
	</div>
</div>

<!--====  End of TOP  ====-->

<!--============================
=            HEADER            =
=============================-->

<header class="container-fluid">
	
	<div class="container">
		
		<div class="row" id="header">
			
			<!--============================
			=            LOGOTIPO          =
			=============================-->

			<div class="col-lg-3 col-md-3 col-sm-2 col-xs-12" id="logotipo" >

				<a href="<?php echo $url ?>">

					<img src="<?php echo $servidor.$social["logo"]?>" class="img-responsive">

				</a>
			</div>

			<!--============================
			=    CATEGORIAS Y BUSCADOR  =
			=============================-->

			<div class="col-lg-6 col-md-6 col-sm-8 col-xs-12">

					<!--============================
					=    BOTON CATEGORIAS  =
					=============================-->
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 backColor" id="btnCategorias">
						<p>
							CATEGORIAS
							<span class="pull-right"><i class="fa fa-bars" aria-hidden="true"></i></span>
						</p>
					</div>

					<!--============================
					=    		BUSCADOR 		   =
					=============================-->

					<div class="input-group col-lg-8 col-md-8 col-sm-8 col-xs-12 backColor" id="buscador">
						
						<input type="search" name="buscar" class="form-control" placeholder="Buscar...">	

						<span class="input-group-btn">
							
							<a href="<?php echo $url; ?>buscador/1/recientes">

								<button class="btn btn-default backColor" type="submit">
									
									<i class="fa fa-search"></i>

								</button>

							</a>

						</span>

					</div>
			</div>

			<!--=====================================
			CARRITO DE COMPRAS
			======================================-->

			<div class="col-lg-3 col-md-3 col-sm-2 col-xs-12" id="carrito">
				
				<a href="<?php echo $url;?>shopping-cart">

					<button class="btn btn-default pull-left backColor"> 
						
						<i class="fa fa-shopping-cart" aria-hidden="true"></i>
					
					</button>
				
				</a>	

				<p>TU CESTA <span class="cantidadCesta"></span> <br> USD $ <span class="sumaCesta"></span></p>	

			</div>			
		</div>

		<!--=====================================
			CATEGORÍAS
			======================================-->

		<div class="col-xs-12 backColor" id="categorias">
				
			 <?php 

			 	$item = null;

			 	$valor = null;
				$categorias = ControladorProductos::ctrMostrarCategorias($item,$valor);

				foreach ($categorias as $key => $value) {

					

					echo 	'<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
								
								<h4>
									<a href="'.$url.$value["url"].'" class="pixelCategorias">'.$value["categoria"].'</a>
								</h4>
								
								<hr>
			
								<ul>';

								$item = "id_categoria";
								$valor = $value["id"];

								$subCategorias = ControladorProductos::ctrMostrarSubCategorias($item,$valor);

								foreach ($subCategorias as $key => $value) 
								{
									echo '<li>
											<a href="'.$url.$value["url"].'" class="pixelSubCategorias">'.$value["subcategoria"].'</a>
										 </li>';	
								}	
								
						echo '</ul>
							</div>';
								
				}	

			 ?>
				
		</div>	
	</div>
</header>

<!--============================
  VENTANA MODAL PARA EL REGISTRO     
=============================-->

  <div class="modal fade modalFormulario" id="modalRegistro" role="dialog">
    <div class="modal-content modal-dialog">
    
      <!-- Modal content-->

        <div class="modal-body modalTitulo">

        	<h3 class="backColor">Registrarse</h3>
          	<button type="button" class="close" data-dismiss="modal">&times;</button>

          	<!--============================
			  REGISTRO FACEBOOK     
			=============================-->

			<div class="col-sm-6 col-xs-12 facebook">
					
				<p>
					<i class="fa fa-facebook"></i>
					  Registro con Facebook
				</p>

			</div>
			<!--============================
			  REGISTRO GOOGLE    
			=============================-->

			<a href="<?php echo $rutaGoogle; ?>">
				<div class="col-sm-6 col-xs-12 google">
						
					<p>
						<i class="fa fa-google"></i>Registro con Google
					</p>

				</div>
			</a>
			<!--============================
			  REGISTRO DIRECTO
			=============================-->

			<form method="post" onsubmit="return registroUsuario()" >

				<hr>

				<div class="form-group">

					<div class="input-group">
						
						<span class="input-group-addon">
							
							<i class="glyphicon glyphicon-user"></i>
						</span>

						<input type="text" class="form-control text-uppercase" id="regUsuario" name="regUsuario" placeholder="Nombre Completo" required>

					</div>

				</div>

				<div class="form-group">

					<div class="input-group">
						
						<span class="input-group-addon">
							
							<i class="glyphicon glyphicon-envelope"></i>
						</span>
						
						<input type="email" class="form-control" id="regEmail" name="regEmail" placeholder="CORREO ELECTRONICO" required>

					</div>

				</div>

				<div class="form-group">

					<div class="input-group">
						
						<span class="input-group-addon">
							
							<i class="glyphicon glyphicon-lock"></i>
						</span>
						
						<input type="password" class="form-control" id="regPassword" name="regPassword" placeholder="CONTRASEÑA" required>

					</div>

				</div>

				<div class="checkBox">
					
					<label>
						<input type="checkbox" id="regPoliticas">
						<small class="iubenda">
							 Al registrarse, acepta nuestras condiciones de uso y politicas de privacidad.
							<br>
								<a  href="https://www.iubenda.com/privacy-policy/95029080" class="iubenda-white iubenda-embed" title="Condiciones de uso y politicas de privacidad">Leer mas</a><script type="text/javascript">(function (w,d) {var loader = function () {var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0]; s.src="https://cdn.iubenda.com/iubenda.js"; tag.parentNode.insertBefore(s,tag);}; if(w.addEventListener){w.addEventListener("load", loader, false);}else if(w.attachEvent){w.attachEvent("onload", loader);}else{w.onload = loader;}})(window, document);</script>
		
						</small>
					</label>

				</div>

				<?php 

					$registro = new ControladorUsuarios();
					$registro -> ctrRegistroUsuarios();

				 ?>

				<input type="submit" value="ENVIAR" class="btn btn-default backColor btn-block">
				
			</form>

      
        </div>

        <div class="modal-footer">
          <h5>¿Ya tienes una cuenta ? <strong><a href="#modalIngreso" data-dismiss="modal" data-toggle="modal">Ingresar</a></strong></h5>
        </div>
          
    </div>
  </div>
<!--====  End of HEADER  ====-->

<!--============================
  VENTANA MODAL PARA EL INGRESO    
=============================-->

  <div class="modal fade modalFormulario" id="modalIngreso" role="dialog">
    <div class="modal-content modal-dialog">
    
      <!-- Modal content-->

        <div class="modal-body modalTitulo">

        	<h3 class="backColor">INGRESAR</h3>
          	<button type="button" class="close" data-dismiss="modal">&times;</button>

          	<!--============================
			  INGRESO FACEBOOK     
			=============================-->

			<div class="col-sm-6 col-xs-12 facebook">
					
				<p>
					<i class="fa fa-facebook"></i>
					  Ingreso con Facebook
				</p>

			</div>
			<!--============================
			  INGRESO GOOGLE    
			=============================-->

			<a href="<?php echo $rutaGoogle; ?>">
				<div class="col-sm-6 col-xs-12 google">
						
					<p>
						<i class="fa fa-google"></i>Ingreso con Google
					</p>

				</div>
			</a>

			<!--============================
			  INGRESO DIRECTO
			=============================-->

			<form method="post" >

				<hr>

				<div class="form-group">

					<div class="input-group">
						
						<span class="input-group-addon">
							
							<i class="glyphicon glyphicon-envelope"></i>
						</span>
						
						<input type="email" class="form-control" id="ingEmail" name="ingEmail" placeholder="CORREO ELECTRONICO" required>

					</div>

				</div>

				<div class="form-group">

					<div class="input-group">
						
						<span class="input-group-addon">
							
							<i class="glyphicon glyphicon-lock"></i>
						</span>
						
						<input type="password" class="form-control" id="ingPassword" name="ingPassword" placeholder="CONTRASEÑA" required>

					</div>

				</div>

				<?php 

					$ingreso = new ControladorUsuarios();
					$ingreso -> ctrIngresoUsuarios();

				 ?>

				<input type="submit" value="ENVIAR" class="btn btn-default backColor btn-block btnIngreso">

				<br>

				<center>
					
					<a href="#modalPassword" data-dismiss="modal" data-toggle="modal">¿Olvidaste tu contraseña?</a>

				</center>
				
			</form>

      
        </div>

        <div class="modal-footer">
          <h5>¿No tienes una cuenta registrada? <strong><a href="#modalRegistro" data-dismiss="modal" data-toggle="modal">Registrarse</a></strong></h5>
        </div>
          
    </div>
  </div>
<!--====  End of HEADER  ====-->

<!--============================
  VENTANA MODAL PARA EL OLVIDO DE CONTRASEÑA   
=============================-->

  <div class="modal fade modalFormulario" id="modalPassword" role="dialog">
    <div class="modal-content modal-dialog">
    
      <!-- Modal content-->

        <div class="modal-body modalTitulo">

        	<h3 class="backColor">SOLICITUD DE NUEVA CONTRASEÑA</h3>
          	<button type="button" class="close" data-dismiss="modal">&times;</button>

          	<!--============================
			 OLVIDO CONTRASEÑA    
			=============================-->

			<form method="post" >

				<label class="text-muted">Escribe el correo electrónico con el que estas registrado y alli te enviaremos una nueva contraseña</label>

				<div class="form-group">

					<div class="input-group">
						
						<span class="input-group-addon">
							
							<i class="glyphicon glyphicon-envelope"></i>
						</span>
						
						<input type="email" class="form-control" id="passEmail" name="passEmail" placeholder="CORREO ELECTRONICO" required>

					</div>

				</div>

				<?php 

					$password = new ControladorUsuarios();
					$password -> ctrOlvidoPassword();

				 ?>

				<input type="submit" value="ENVIAR" class="btn btn-default backColor btn-block btnIngreso">
				
			</form>

      
        </div>

        <div class="modal-footer">
          <h5>¿No tienes una cuenta registrada? <strong><a href="#modalRegistro" data-dismiss="modal" data-toggle="modal">Registrarse</a></strong></h5>
        </div>
          
    </div>
  </div>
<!--====  End of HEADER  ====-->



