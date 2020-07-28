<?php 

/**
 * 
 */
class Conexion
{
	/**
	 * [conectar Conexion a la Base de Datos]
	 * @return [type] [description]
	 */
	public function conectar()
	{
		$link = new PDO("mysql:host=localhost;dbname=ecommerce", 
						"root", 
						"",
						array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
							  PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
						);

		return $link;
	}
}
 ?>