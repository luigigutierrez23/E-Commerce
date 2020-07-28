<?php 

	class ControladorPlantilla
	{
		
		/**
		 * [plantilla Llamada a la plantilla]
		 * @return [type] [description]
		 */
		public function plantilla(){
			include "Views/template.php";
		}

		/**
		 * [ctrEstiloPlantilla Traemos los estilos dinamicos de la plantilla]
		 * @return [type] [description]
		 */
		public function ctrEstiloPlantilla(){

			$tabla = "e_template";

			$respuesta = ModeloPlantilla::mdlEstiloPlantilla($tabla);

			return $respuesta;
		}
	}
