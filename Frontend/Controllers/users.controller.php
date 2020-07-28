<?php

/**
 * 
 */
class ControladorUsuarios
{
	
	/**
	 * [ctrRegistroUsuarios description]
	 * @return [type] [description]
	 */
	public function ctrRegistroUsuarios(){

		if(isset($_POST["regUsuario"])){

			if(preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["regUsuario"]) &&
			   preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["regEmail"]) &&
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["regPassword"])){

					$encriptar = crypt($_POST["regPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

					$encriptarEmail = md5($_POST["regEmail"]);

					$datos = array("nombre" => $_POST["regUsuario"],
								   "password" => $encriptar,
								   "email" => $_POST["regEmail"],
								   "foto" => "",
								   "modo" => "directo",
								   "verificacion" => 1,
								   "emailEncriptado" => $encriptarEmail);

					$tabla = "e_users";

					$respuesta = ModeloUsuario::mdlRegistroUsuario($tabla,$datos);

					if($respuesta == "ok"){

						/*=============================================
						=            VERIFICACION CORREO           =
						=============================================*/
						
						
						date_default_timezone_set("America/Argentina/Buenos_Aires");

						$url = Url::ctrUrl();

						$mail = new PHPMailer;

						$mail->CharSet='UFT-8';

						$mail->isMail();

						$mail ->setFrom('info@luigigutierrez.com','Couple Design Tech');

						$mail ->addReplyTo('info@luigigutierrez.com','Couple Design Tech');

						$mail -> Subject = "Verificacíon de Correo Electronico - Couple Design Tech";

						$mail ->addAddress($_POST["regEmail"]);

						$mail -> msgHTML('<div style="width:100%; background:#eee; position:relative; font-family:sans-serif; padding-bottom:40px">
	
											<center>
												
												<img style="padding:20px; width:10%" src="http://tutorialesatualcance.com/tienda/logo.png">

											</center>

											<div style="position:relative; margin:auto; width:600px; background:white; padding:20px">
											
												<center>
												
												<img style="padding:20px; width:15%" src="http://tutorialesatualcance.com/tienda/icon-email.png">

												<h3 style="font-weight:100; color:#999">VERIFIQUE SU DIRECCIÓN DE CORREO ELECTRÓNICO</h3>

												<hr style="border:1px solid #ccc; width:80%">

												<h4 style="font-weight:100; color:#999; padding:0 20px">Para comenzar a usar su cuenta de Tienda Virtual, debe confirmar su dirección de correo electrónico</h4>

												<a href="'.$url.'verificar/'.$encriptarEmail.'" target="_blank" style="text-decoration:none">

												<div style="line-height:60px; background:#0aa; width:60%; color:white">Verifique su dirección de correo electrónico</div>

												</a>

												<br>

												<hr style="border:1px solid #ccc; width:80%">

												<h5 style="font-weight:100; color:#999">Si no se inscribió en esta cuenta, puede ignorar este correo electrónico y la cuenta se eliminará.</h5>

												</center>

											</div>

										</div>');

						$envio = $mail -> Send();

						if(!$envio){

							echo '<script> swal({
									  title: "¡ERROR!",
									  text: "¡Ha ocurrido un problema enviando verificación de correo electrónico a '.$_POST["regEmail"].$mail->ErrorInfo.'!",
									  type: "error",
									  confirmButtonText: "Cerrar",
									  closeOnConfirm: false
									}, 
										
									  function(isConfirm){

									  	if(isConfirm){

											history.back();
									  	}
									  }
									); 
								</script>';

						}else{

							echo '<script> swal({
									  title: "OK!",
									  text: "¡Por favor, revise la bandeja de entrada o la carpeta de SPAM de su correo electrónico '.$_POST["regEmail"].' para verificar la cuenta!",
									  type: "success",
									  confirmButtonText: "Cerrar",
									  closeOnConfirm: false
									}, 
										
									  function(isConfirm){

									  	if(isConfirm){

											history.back();
									  	}
									  }
									); 
							</script>';

						}
						

					}

			}else{

				echo '<script> swal({
									  title: "¡ERROR!",
									  text: "Al registrar el usuario, no se permiten caracteres especiales",
									  type: "error",
									  confirmButtonText: "Cerrar",
									  closeOnConfirm: false
									}, 
										
									  function(isConfirm){

									  	if(isConfirm){

											history.back();
									  	}
									  }
									); 
					</script>';
			}
		}
	}

	/**
	 * [ctrMostrarUsuario description]
	 * @param  [type] $item  [Campo a comparar en sentencia WHERE]
	 * @param  [type] $valor [Valor del campo a comparar en sentencia WHERE]
	 * @return [type]        [description]
	 */
	static public function ctrMostrarUsuario($item,$valor){

		$tabla="e_users";

		$respuesta = ModeloUsuario::mdlMostrarUsuario($tabla,$item,$valor);

		return $respuesta;
	}

	/**
	 * [ctrActualizarUsuario Actualizar usuario en el sistema]
	 * @param  [type] $id     [description]
	 * @param  [type] $item2  [Campo a comparar en sentencia WHERE]
	 * @param  [type] $valor2 [Valor del campo a comparar en sentencia WHERE]
	 * @return [type]         [description]
	 */
	static public function ctrActualizarUsuario($id,$item,$valor){

		$tabla = "e_users";

		$respuesta = ModeloUsuario::mdlActualizarUsuario($tabla,$id,$item,$valor);

		return $respuesta;
	}

	/**
	 * [ctrIngresoUsuarios Ingreso del usuario al sistema]
	 * @return [type] [description]
	 */
	public function ctrIngresoUsuarios(){

		if(isset($_POST["ingEmail"])){

			if(preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["ingEmail"]) &&
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingPassword"])){

				$encriptar = crypt($_POST["ingPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

				$tabla = "e_users";

				$item = "email";

				$valor = $_POST["ingEmail"];

				$respuesta = ModeloUsuario::mdlMostrarUsuario($tabla, $item, $valor);

				if($respuesta["email"] == $_POST["ingEmail"] && $respuesta["password"] == $encriptar){

					if($respuesta["verificacion"] == 1){

						echo '<script> swal({
									  title: "¡NO HA VERIFICADO SU CORREO ELECTRÓNICO!",
									  text: "Por favor revise la bandeja de entrada o la carpeta de SPAM de su correo para verificar la dirección de correo electrónico '.$respuesta["email"].'",
									  type: "error",
									  confirmButtonText: "Cerrar",
									  closeOnConfirm: false
									}, 
										
									  function(isConfirm){

									  	if(isConfirm){

											history.back();
									  	}
									  }
									); 
							</script>';

					}else{

						$_SESSION["validarSesion"] = "ok";
						$_SESSION["id"] = $respuesta["id"];
						$_SESSION["nombre"] = $respuesta["nombre"];
						$_SESSION["foto"] = $respuesta["foto"];
						$_SESSION["email"] = $respuesta["email"];
						$_SESSION["password"] = $respuesta["password"];
						$_SESSION["modo"] = $respuesta["modo"];

						echo '<script>
								
								window.location = localStorage.getItem("rutaActual");
	
							</script>';
					}
				}else{

					echo '<script> swal({
									  title: "¡ERROR AL INGRESAR!",
									  text: "Por favor revise que el email exista o la contraseña coincida con la registrada",
									  type: "error",
									  confirmButtonText: "Cerrar",
									  closeOnConfirm: false
									}, 
										
									  function(isConfirm){

									  	if(isConfirm){

											window.location = localStorage.getItem("rutaActual");
									  	}
									  }
									); 
					</script>';
				}


			}else{

				echo '<script> swal({
									  title: "¡ERROR!",
									  text: "Error al ingresar al sistema, no se permiten caracteres especiales",
									  type: "error",
									  confirmButtonText: "Cerrar",
									  closeOnConfirm: false
									}, 
										
									  function(isConfirm){

									  	if(isConfirm){

											history.back();
									  	}
									  }
									); 
					</script>';
			}
		}
	}

	/**
	 * [ctrOlvidoPassword Olvido de contraseña]
	 * @return [type] [description]
	 */
	public function ctrOlvidoPassword(){

		if(isset($_POST["passEmail"])){

			if(preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["passEmail"])){


			function generarPassword($longitud){

				$key = "";
				$pattern = "1234567890abcdefghijklmnopqrstuvwxyz";
				$max = strlen($pattern)-1;

				for ($i=0; $i < $longitud ; $i++) { 
					
					$key .= $pattern{mt_rand(0,$max)};
				}

				return $key;
			}

			$nuevaPassword = generarPassword(11);

			$encriptar = crypt($nuevaPassword, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

			$tabla= "e_users";

			$item1 = "email";

			$valor1 = $_POST["passEmail"];

			$respuesta1 = ModeloUsuario::mdlMostrarUsuario($tabla,$item1,$valor1);

			if($respuesta1){

				$id = $respuesta1["id"]; 

				$item2 = "password";

				$valor2 = $encriptar;

				$respuesta2 = ModeloUsuario::mdlActualizarUsuario($tabla,$id,$item2,$valor2);

				if($respuesta2 == "ok"){

					/*=============================================
					=           CAMBIO DE CONTRASEÑA            =
					=============================================*/
						
						
						date_default_timezone_set("America/Argentina/Buenos_Aires");

						$url = Url::ctrUrl();

						$mail = new PHPMailer;

						$mail->CharSet='UFT-8';

						$mail->isMail();

						$mail ->setFrom('info@luigigutierrez.com','Couple Design Tech');

						$mail ->addReplyTo('info@luigigutierrez.com','Couple Design Tech');

						$mail -> Subject = "Solicitud de nueva contraseña - Couple Design Tech";

						$mail ->addAddress($_POST["passEmail"]);

						$mail -> msgHTML('<div style="width:100%; background:#eee; position:relative; font-family:sans-serif; padding-bottom:40px">
											
								<center>
									
									<img style="padding:20px; width:10%" src="http://tutorialesatualcance.com/tienda/logo.png">

								</center>

								<div style="position:relative; margin:auto; width:600px; background:white; padding:20px">
								
									<center>
									
									<img style="padding:20px; width:15%" src="http://tutorialesatualcance.com/tienda/icon-pass.png">

									<h3 style="font-weight:100; color:#999">SOLICITUD DE NUEVA CONTRASEÑA</h3>

									<hr style="border:1px solid #ccc; width:80%">

									<h4 style="font-weight:100; color:#999; padding:0 20px"><strong>Su nueva contraseña: </strong>'.$nuevaPassword.'</h4>

									<a href="'.$url.'" target="_blank" style="text-decoration:none">

									<div style="line-height:60px; background:#0aa; width:60%; color:white">Ingrese nuevamente al sitio</div>

									</a>

									<br>

									<hr style="border:1px solid #ccc; width:80%">

									<h5 style="font-weight:100; color:#999">Si no se inscribió en esta cuenta, puede ignorar este correo electrónico y la cuenta se eliminará.</h5>

									</center>

								</div>

							</div>');

						$envio = $mail -> Send();

						if(!$envio){

							echo '<script> swal({
									  title: "¡ERROR!",
									  text: "¡Ha ocurrido un problema enviando cambio de contraseña a '.$_POST["passEmail"].$mail->ErrorInfo.'!",
									  type: "error",
									  confirmButtonText: "Cerrar",
									  closeOnConfirm: false
									}, 
										
									  function(isConfirm){

									  	if(isConfirm){

											history.back();
									  	}
									  }
									); 
								</script>';

						}else{

							echo '<script> swal({
									  title: "OK!",
									  text: "¡Por favor, revise la bandeja de entrada o la carpeta de SPAM de su correo electrónico '.$_POST["passEmail"].' para su cambio de contraseña!",
									  type: "success",
									  confirmButtonText: "Cerrar",
									  closeOnConfirm: false
									}, 
										
									  function(isConfirm){

									  	if(isConfirm){

											history.back();
									  	}
									  }
									); 
							</script>';

						}
				
				}

			}else{

				echo '<script> swal({
										  title:"¡ERROR!",
										  text: "El correo electrónico no existe en el sistema",
										  type: "error",
										  confirmButtonText: "Cerrar",
										  closeOnConfirm: false
										}, 
											
										  function(isConfirm){

										  	if(isConfirm){

												history.back();
										  	}
										  }
										); 
					</script>';

			}

			


			}else{

				echo '<script> swal({
										  title: "¡ERROR!",
										  text: "Error al enviar el correo electrónico, no se permiten caracteres especiales",
										  type: "error",
										  confirmButtonText: "Cerrar",
										  closeOnConfirm: false
										}, 
											
										  function(isConfirm){

										  	if(isConfirm){

												history.back();
										  	}
										  }
										); 
						</script>';
			}

		}		
	}

	/**
	 * [ctrRegistroRedesSociales Registrar mediante redes sociales]
	 * @param  [type] $datos [Datos obtenidos para el registro de la red social seleccionada]
	 * @return [type]        [description]
	 */
	static public function ctrRegistroRedesSociales($datos){

		$tabla = "e_users";

		$item = "email";
		$valor = $datos["email"];
		$emailRepetido = false;

		$respuesta0 = ModeloUsuario::mdlMostrarUsuario($tabla,$item,$valor);

		if($respuesta0){

			if($respuesta0["modo"] != $datos["modo"]){

				echo '<script> swal({
										  title: "¡ERROR!",
										  text: "El correo electrónico '.$datos["email"].' ya esta registrado en el sistema con un metodo diferente a google",
										  type: "error",
										  confirmButtonText: "Cerrar",
										  closeOnConfirm: false
										}, 
											
										  function(isConfirm){

										  	if(isConfirm){

												history.back();
										  	}
										  }
										); 
						</script>';

					$emailRepetido = false;

			}

			$emailRepetido = true;

		}else{

			$respuesta1 = ModeloUsuario::mdlRegistroUsuario($tabla,$datos);
		}

		

		if($emailRepetido || $respuesta1 =="ok"){

			$respuesta2 = ModeloUsuario::mdlMostrarUsuario($tabla,$item,$valor);

			if($respuesta2["modo"] == "facebook"){

				session_start();

				$_SESSION["validarSesion"] = "ok";
				$_SESSION["id"] = $respuesta2["id"];
				$_SESSION["nombre"] = $respuesta2["nombre"];
				$_SESSION["foto"] = $respuesta2["foto"];
				$_SESSION["email"] = $respuesta2["email"];
				$_SESSION["password"] = $respuesta2["password"];
				$_SESSION["modo"] = $respuesta2["modo"];

				echo "ok";
			}
			else if($respuesta2["modo"] == "google"){

				$_SESSION["validarSesion"] = "ok";
				$_SESSION["id"] = $respuesta2["id"];
				$_SESSION["nombre"] = $respuesta2["nombre"];
				$_SESSION["foto"] = $respuesta2["foto"];
				$_SESSION["email"] = $respuesta2["email"];
				$_SESSION["password"] = $respuesta2["password"];
				$_SESSION["modo"] = $respuesta2["modo"];

			}else{

				echo "";

			}
		}
	}

	/**
	 * [ctrActualizarPerfil Actualizar informacion del usuario]
	 * @return [type] [description]
	 */
	public function ctrActualizarPerfil(){

		if(isset($_POST["editarNombre"])){

			/*=============================================
            VALIDAR IMAGEN          
			=============================================*/

			$ruta = $_POST["fotoUsuario"];

			if(isset($_FILES["datosImagen"]["tmp_name"]) && !empty($_FILES["datosImagen"]["tmp_name"])){

				/*=============================================
	            PREGUNTAR SI EXISTE OTRA IMAGEN EN LA BD
				=============================================*/
				$directorio = "Views/img/usuarios/".$_POST["idUsuario"];

				if(!empty($_POST["fotoUsuario"])){

					unlink($_POST["fotoUsuario"]);
				
				}else{

					mkdir($directorio, 0755);
				}

				/*=============================================
	            GUARDAR IMAGEN EN EL DIRECTORIO
				=============================================*/

				list($ancho,$alto) = getimagesize($_FILES["datosImagen"]["tmp_name"]);

				$nuevoAncho = 500;
				$nuevoAlto = 500;

				$aleatorio = mt_rand(100,999);

				if($_FILES["datosImagen"]["type"] == "image/jpeg"){

					$ruta = "Views/img/usuarios/".$_POST["idUsuario"]."/".$aleatorio.".jpg";

					/*=============================================
		            MODIFICAR TAMAÑO DE LA FOTO
					=============================================*/

					$origen = imagecreatefromjpeg($_FILES["datosImagen"]["tmp_name"]);

					$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

					imagejpeg($destino,$ruta);
				}

				if($_FILES["datosImagen"]["type"] == "image/png"){

					$ruta = "Views/img/usuarios/".$_POST["idUsuario"]."/".$aleatorio.".png";

					/*=============================================
		            MODIFICAR TAMAÑO DE LA FOTO
					=============================================*/

					$origen = imagecreatefrompng($_FILES["datosImagen"]["tmp_name"]);

					$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

					imagealphablending($destino, false);

					imagesavealpha($destino, true);

					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

					imagepng($destino,$ruta);
				}

			}

			if($_POST["editarPassword"] == ""){

				$password = $_POST["passUsuario"];
			
			}else{

				$password = crypt($_POST["editarPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
			}

			$datos = array("nombre" => $_POST["editarNombre"],
						   "email" => $_POST["editarEmail"],
						   "password" => $password,
						   "foto" => $ruta,
						   "id" => $_POST["idUsuario"]);


			$tabla = "e_users";

			$respuesta = ModeloUsuario::mdlActualizarPerfil($tabla, $datos);

			var_dump($respuesta);

			if($respuesta =="ok"){

				$_SESSION["validarSesion"] = "ok";
				$_SESSION["id"] = $datos["id"];
				$_SESSION["nombre"] = $datos["nombre"];
				$_SESSION["foto"] = $datos["foto"];
				$_SESSION["email"] = $datos["email"];
				$_SESSION["password"] = $datos["password"];
				$_SESSION["modo"] = $_POST["modoUsuario"];

				echo '<script> swal({
										  title: "¡OK!",
										  text: "Su cuenta ha sido actualizada correctamente",
										  type: "success",
										  confirmButtonText: "Cerrar",
										  closeOnConfirm: false
										}, 
											
										  function(isConfirm){

										  	if(isConfirm){

												history.back();
										  	}
										  }
										); 
						</script>';


			}else{

				echo "Hola error";
			}
		}
	}

	/**
	 * [ctrMostrarCompras Mostrar las compras en el perfil del usuario]
	 * @param  [type] $item  [parametro a buscar en la BD]
	 * @param  [type] $valor [valor a comparar]
	 * @return [type]        [description]
	 */
	static public function ctrMostrarCompras($item,$valor){

		$tabla="e_purchases";

		$respuesta = ModeloUsuario::mdlMostrarCompras($tabla,$item,$valor);

		return $respuesta;
	}

	/**
	 * [ctrMostrarComentariosPerfil Mostrar comentarios del producto]
	 * @param  [type] $datos [description]
	 * @return [type]        [description]
	 */
	static public function ctrMostrarComentariosPerfil($datos){

		$tabla="e_reviews";

		$respuesta = ModeloUsuario::mdlMostrarComentariosPerfil($tabla,$datos);

		return $respuesta;
	}

	/**
	 * [ctrActualizarComentario Actualizar comentario del producto adquirido por el usuario]
	 * @return [type] [description]
	 */
	public function ctrActualizarComentario(){

		if(isset($_POST["comentario"])){

			if(preg_match('/^[,\\.\\a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]*$/', $_POST["comentario"])){

				if($_POST["comentario"] != ""){

					$tabla = "e_reviews";

					$datos = array("id" => $_POST["idComentario"],
								   "calificacion" => $_POST["puntaje"],
								   "comentario" => $_POST["comentario"]);

					$respuesta = ModeloUsuario::mdlActualizarComentario($tabla,$datos);

					if($respuesta == "ok"){

						echo '<script> swal({
										  title: "¡GRACIAS POR COMPARTIR SU OPINIÓN!",
										  text: "¡Su calificación y comentario ha sido guardado!",
										  type: "success",
										  confirmButtonText: "Cerrar",
										  closeOnConfirm: false
										}, 
											
										  function(isConfirm){

										  	if(isConfirm){

												history.back();
										  	}
										  }
										); 
						</script>';
					}
				
				}else{

					echo '<script> swal({
										  title: "¡ERROR AL ENVIAR SU CALIFICACIÓN!",
										  text: "¡El comentario no puede estar vacio!",
										  type: "error",
										  confirmButtonText: "Cerrar",
										  closeOnConfirm: false
										}, 
											
										  function(isConfirm){

										  	if(isConfirm){

												history.back();
										  	}
										  }
										); 
						</script>';
				}

			}else{

				echo '<script> swal({
										  title: "¡ERROR AL ENVIAR SU CALIFICACIÓN!",
										  text: "¡El comentario no puede llevar caracteres especiales!",
										  type: "error",
										  confirmButtonText: "Cerrar",
										  closeOnConfirm: false
										}, 
											
										  function(isConfirm){

										  	if(isConfirm){

												history.back();
										  	}
										  }
										); 
						</script>';

			}
		}
	}

	/**
	 * [ctrAgregarDeseo Agregar producto a la lista de deseos del usuario]
	 * @param  [type] $datos [id usuario e id de producto]
	 * @return [type]        [description]
	 */
	static public function ctrAgregarDeseo($datos){

		$tabla = "e_wishlist";

		$respuesta = ModeloUsuario::mdlAgregarDeseo($tabla,$datos);

		return $respuesta;
	}

	/**
	 * [ctrMostrarDeseos Mostrar lista de Deseos en el perfil]
	 * @param  [type] $item [description]
	 * @return [type]       [description]
	 */
	static public function ctrMostrarDeseos($item){

		$tabla = "e_wishlist";

		$respuesta = ModeloUsuario::mdlMostrarDeseos($tabla,$item);

		return $respuesta;
	}

	/**
	 * [ctrQuitarDeseo Quitar producto de la lista de Deseos en el perfil]
	 * @param  [type] $datos [id del deseo a eliminar]
	 * @return [type]        [description]
	 */
	static public function ctrQuitarDeseo($datos){

		$tabla = "e_wishlist";

		$respuesta = ModeloUsuario::mdlQuitarDeseo($tabla,$datos);

		return $respuesta;
	}

	public function ctrEliminarUsuario(){

		if(isset($_GET["id"])){

			$tabla1 = "e_users";

			$tabla2 = "e_reviews";

			$tabla3 = "e_purchases";

			$tabla4 = "e_wishlist";

			$id = $_GET["id"];

			if($_GET["foto"] != ""){

				unlink($_GET["foto"]);
				rmdir('Views/img/usuarios/'.$_GET["id"]);
			}

			$respuesta = ModeloUsuario::mdlEliminarUsuario($tabla1,$id);

			ModeloUsuario::mdlEliminarComentariosUsuario($tabla2,$id);

			ModeloUsuario::mdlEliminarComprasUsuario($tabla3,$id);

			ModeloUsuario::mdlEliminarDeseosUsuario($tabla4,$id);

			if($respuesta == "ok"){

				echo '<script> swal({
										  title: "¡SU CUENTA HA SIDO BORRADA!",
										  text: "Debe registrarse nuevamente si desea ingresar",
										  type: "success",
										  confirmButtonText: "Cerrar",
										  closeOnConfirm: false
										}, 
											
										  function(isConfirm){

										  	if(isConfirm){

												window.location = "'.$url.'exit";
										  	}
										  }
										); 
						</script>';

			}

		}
	}						
}