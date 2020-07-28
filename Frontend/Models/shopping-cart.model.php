<?php 

require_once "conexion.php";

/**
 * 
 */
class ModeloCarrito 
{
	
	static public function mdlMostrarTarifas($tabla)
	{

		$stmt = Conexion::conectar()->prepare("SELECT * from $tabla");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;
	}
}

 ?>