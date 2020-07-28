<?php 

require_once "conexion.php";

/**
 * 
 */
class ModeloSlide
{
	/**
	 * [mdlMostrarSlide Mostrar Slide en el Home del Sistema]
	 * @param  [type] $tabla [Tabla a realizar la consulta]
	 * @return [type]        [description]
	 */
	static public function mdlMostrarSlide($tabla){
		
		$stmt = Conexion::conectar()->prepare("SELECT * from $tabla");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;
	}
}