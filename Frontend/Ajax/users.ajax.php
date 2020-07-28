<?php

require_once "../Controllers/users.controller.php";
require_once "../Models/users.model.php";

/**
 *  
 */
class AjaxUsuarios
{

	public $validarEmail;
	
	/**
	 * [ajaxValidarEmail Validar Email Existente]
	 * @return [type] [description]
	 */
	function ajaxValidarEmail(){

		$datos = $this->validarEmail;

		$respuesta = ControladorUsuarios::ctrMostrarUsuario('email',$datos);

		echo json_encode($respuesta);
	}

/*=============================================
            REGISTRO CON FACEBOOK         
=============================================*/

	public $email;
	public $nombre;
	public $foto;

	/**
	 * [ajaxRegistroFacebook Registro del usuario a la BD proveniente de Facebook]
	 * @return [type] [description]
	 */
	public function ajaxRegistroFacebook(){

		$datos = array("nombre"=>$this->nombre,
					   "email"=>$this->email,
					   "foto"=>$this->foto,
					   "password"=>"null",
					   "modo"=>"facebook",
					   "verificacion"=>0,
					   "emailEncriptado"=>"null");

		$respuesta = ControladorUsuarios::ctrRegistroRedesSociales($datos);

		echo $respuesta;
	}

/*=============================================
AGREGAR A LISTA DE DESEOS
=============================================*/	

	public $idUsuario;
	public $idProducto;

	/**
	 * [ajaxAgregarDeseo Agregar producto a la lista de deseos del usuario]
	 * @return [type] [description]
	 */
	public function ajaxAgregarDeseo(){

		$datos = array("idUsuario"=>$this->idUsuario,
					   "idProducto"=>$this->idProducto);

		$respuesta = ControladorUsuarios::ctrAgregarDeseo($datos);

		echo $respuesta;
	}

/*=============================================
QUITAR PRODUCTO DE LA LISTA DE DESEOS
=============================================*/	

	public $idDeseo;

	/**
	 * [ajaxQuitarDeseo Quitar articulo de la lista de Deseos]
	 * @return [type] [description]
	 */
	public function ajaxQuitarDeseo(){

		$datos = $this->idDeseo;

		$respuesta = ControladorUsuarios::ctrQuitarDeseo($datos);

		echo $respuesta;
	}
}

/*=============================================
=            VALIDAR EMAIL EXISTENTE          =
=============================================*/

if(isset($_POST["validarEmail"])){

	$valEmail = new AjaxUsuarios();
	$valEmail -> validarEmail = $_POST["validarEmail"];
	$valEmail -> ajaxValidarEmail();
}

/*=============================================
            REGISTRO CON FACEBOOK         
=============================================*/

if(isset($_POST["email"])){

	$regFacebook = new AjaxUsuarios();
	$regFacebook -> email = $_POST["email"];
	$regFacebook -> nombre = $_POST["nombre"];
	$regFacebook -> foto = $_POST["foto"];
	$regFacebook -> ajaxRegistroFacebook();
}

/*=============================================
AGREGAR A LISTA DE DESEOS
=============================================*/	

if(isset($_POST["idUsuario"])){

	$deseo = new AjaxUsuarios();
	$deseo -> idUsuario = $_POST["idUsuario"];
	$deseo -> idProducto = $_POST["idProducto"];
	$deseo ->ajaxAgregarDeseo();
}

/*=============================================
QUITAR PRODUCTO DE LA LISTA DE DESEOS
=============================================*/	

if(isset($_POST["idDeseo"])){

	$deseo = new AjaxUsuarios();
	$deseo -> idDeseo = $_POST["idDeseo"];
	$deseo ->ajaxQuitarDeseo();
}