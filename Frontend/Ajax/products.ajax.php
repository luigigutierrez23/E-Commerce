<?php 
	
	require_once "../Controllers/products.controller.php";
	require_once "../Models/products.model.php";

	/**
	 * 
	 */
	class AjaxProductos
	{
		public $valor;
		public $item;
		public $ruta;

		/**
		 * [ajaxVistaProducto Actualizar numero de vistas de un producto]
		 * @return [type] [description]
		 */
		public function ajaxVistaProducto(){

			$datos = array('valor' =>$this -> valor,
						   'ruta' => $this -> ruta);

			$item = $this ->item;

			$respuesta = ControladorProductos::ctrActualizarVistaProductos($datos,$item);

			echo $respuesta;
		}
	}

	if(isset($_POST["valor"])){

		$vista = new AjaxProductos();
		$vista -> valor = $_POST["valor"];
		$vista -> item = $_POST["item"];
		$vista -> ruta = $_POST["ruta"];
		$vista ->ajaxVistaProducto();
	}

 ?>