<?php 

class ControladorCarrito
{
	
	public function ctrMostrarTarifas()
	{
		$tabla = "e_commerce";

		$respuesta = ModeloCarrito::mdlMostrarTarifas($tabla);

		return $respuesta;
	}
}

 ?>