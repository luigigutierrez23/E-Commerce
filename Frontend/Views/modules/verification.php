<!-- /*=============================================
=            VERIFICAR           =
=============================================*/
 -->

 <?php 

 	$item = "email_encriptado";
 	$valor = $rutas[1];

 	$respuesta = ControladorUsuarios::ctrMostrarUsuario($item,$valor);

 	$usuarioVerificado = false;
 	
	if($respuesta != false){

		if($valor == $respuesta["email_encriptado"]){

			$id = $respuesta["id"];

		 	$item2 = "verificacion";
		 	$valor2 = 0; 

		 	$respuesta2 = ControladorUsuarios::ctrActualizarUsuario($id,$item2,$valor2);

		 	

		 	if(!is_null($respuesta2)){

		 		if($respuesta2 == "ok"){

		 		$usuarioVerificado = true;
		 		} 
		 	}
	 	}
	}
 	
 	
?>

<div class="container">
	
	<div class="row">
		
		<div class="col-xs-12 text-center verificar">

			<?php 

				if($usuarioVerificado == true){

					echo'<h3>Gracias</h3>
						<h2><small>¡Hemos verificado su correo electrónico, ya puede ingresar al sistema!</small></h2>

						<br>

						<a href="#modalIngreso" data-toggle="modal"><button class="btn btn-default backColor btn-lg">INGRESAR</button></a>';
				}else{

					echo'<h3>Error</h3>
						<h2><small>¡No se ha podido verificar el correo electrónico, vuelva a registrarse!</small></h2>

						<br>

						<a href="#modalRegistro" data-toggle="modal"><button class="btn btn-default backColor btn-lg">REGISTRARSE</button></a>';
				}
			 ?>
			
		</div>

	</div>

</div>