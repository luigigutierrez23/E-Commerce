<?php 


/**
 * 
 */
class ControladorSlide
{
	
	/**
	 * [ctrMostrarSlide Mostrar Slide en el Home del Sistema]
	 * @return [type] [description]
	 */
	function ctrMostrarSlide(){

		$tabla = "e_slide";

		$respuesta = ModeloSlide::mdlMostrarSlide($tabla);

		return  $respuesta;
	}
}