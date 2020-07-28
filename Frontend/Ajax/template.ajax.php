<?php 
	
	require_once "../Controllers/template.controller.php";
	require_once "../Models/template.model.php";


	/**
	 * 
	 */
	class AjaxPlantilla
	{
		
		public function ajaxEstiloPlantilla()
		{
			$respuesta = ControladorPlantilla::ctrEstiloPlantilla();

			echo json_encode($respuesta);
		}
	}


	$objeto = new AjaxPlantilla();
	$objeto ->ajaxEstiloPlantilla();

 ?>