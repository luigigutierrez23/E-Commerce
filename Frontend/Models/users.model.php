<?php 

require_once "conexion.php";

/**
 * 
 */
class ModeloUsuario{
	
	/**
	 * [mdlRegistroUsuario Registro de usuarios]
	 * @param  [type] $tabla [Tabla a realizar la consulta]
	 * @param  [type] $datos [Datos a insertar en la tabla]
	 * @return [type]        [description]
	 */
	static public function mdlRegistroUsuario($tabla,$datos){

		$stmt = Conexion::conectar()->prepare("insert into 
											  $tabla(nombre,password,email,foto,modo,verificacion,email_encriptado) 
											  values (:nombre,:password,:email,:foto,:modo,:verificacion,:email_encriptado)");

		$stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt -> bindParam(":password", $datos["password"], PDO::PARAM_STR);
		$stmt -> bindParam(":email", $datos["email"], PDO::PARAM_STR);
		$stmt -> bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
		$stmt -> bindParam(":modo", $datos["modo"], PDO::PARAM_STR);
		$stmt -> bindParam(":verificacion", $datos["verificacion"], PDO::PARAM_INT);
		$stmt -> bindParam(":email_encriptado", $datos["emailEncriptado"], PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		}else{

			return "error";
		}

		$stmt -> close();

		$stmt = null;
	}

	/**
	 * [mdlMostrarUsuario description]
	 * @param  [type] $tabla [Tabla a realizar la consulta]
	 * @param  [type] $item  [Campo a comparar en sentencia WHERE]
	 * @param  [type] $valor [Valor del campo a comparar en sentencia WHERE]
	 * @return [type]        [description]
	 */
	static public function mdlMostrarUsuario($tabla,$item,$valor){

		$stmt = Conexion::conectar()->prepare("SELECT * from $tabla where $item = :$item");

		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt ->fetch();

		$stmt -> close();

		$stmt = null;
	}

	/**
	 * [mdlActualizarUsuario description]
	 * @param  [type] $tabla  [Tabla a realizar la consulta]
	 * @param  [type] $id     [description]
	 * @param  [type] $item2  [Campo a comparar en sentencia WHERE]
	 * @param  [type] $valor2 [Valor del campo a comparar en sentencia WHERE]
	 * @return [type]         [description]
	 */
	static public function mdlActualizarUsuario($tabla,$id,$item,$valor){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla set $item = :$item where id = :id ");

		$stmt -> bindParam(":id", $id, PDO::PARAM_INT);

		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

		if($stmt -> execute()){

				return "ok";
			}else{

				return "error";
		}

		$stmt -> close();

		$stmt = null;
	}

	/**
	 * [mdlActualizarPerfil description]
	 * @param  [type] $tabla [Tabla a realizar la consulta]
	 * @param  [type] $datos [Nuevos datos del perfil del usuario a Actualizar]
	 * @return [type]        [description]
	 */
	static public function mdlActualizarPerfil($tabla,$datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, email = :email, password = :password, foto = :foto WHERE id = :id");

		$stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt -> bindParam(":email", $datos["email"], PDO::PARAM_STR);
		$stmt -> bindParam(":password", $datos["password"], PDO::PARAM_STR);
		$stmt -> bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt-> close();

		$stmt = null;
	}

	/**
	 * [mdlMostrarCompras description]
	 * @param  [type] $tabla [Tabla a realizar la consulta]
	 * @param  [type] $item  [Campo a comparar en sentencia WHERE]
	 * @param  [type] $valor [Valor del campo a comparar en sentencia WHERE]
	 * @return [type]        [description]
	 */
	static public function mdlMostrarCompras($tabla,$item,$valor){

		$stmt = Conexion::conectar()->prepare("SELECT * from $tabla where $item = :$item");

		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt ->fetchAll();

		$stmt -> close();

		$stmt = null;
	}

	/**
	 * [mdlMostrarComentariosPerfil description]
	 * @param  [type] $tabla [Tabla a realizar la consulta]
	 * @param  [type] $datos [id de usuario e id de productos a mostrar]
	 * @return [type]        [description]
	 */
	static public function mdlMostrarComentariosPerfil($tabla,$datos){

		if($datos["idUsuario"] != ""){

			$stmt = Conexion::conectar()->prepare("SELECT * from $tabla where id_usuario = :id_usuario and id_producto = :id_producto");

			$stmt -> bindParam(":id_usuario",$datos["idUsuario"], PDO::PARAM_INT);

			$stmt -> bindParam(":id_producto",$datos["idProducto"], PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt ->fetch();

			
		
		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * from $tabla where id_producto = :id_producto  ORDER BY Rand()");

			$stmt -> bindParam(":id_producto",$datos["idProducto"], PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt ->fetchAll();

		}

		$stmt -> close();

		$stmt = null;
	}

	/**
	 * [mdlActualizarComentario Actualizar comentario del producto]
	 * @param  [type] $tabla [Tabla a realizar la consulta]
	 * @param  [type] $datos [Calificacion y comentario nuevos proporcionados por el usuario]
	 * @return [type]        [description]
	 */
	static public function mdlActualizarComentario($tabla,$datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET calificacion = :calificacion, comentario = :comentario where id = :id");

		$stmt -> bindParam(":calificacion",$datos["calificacion"], PDO::PARAM_STR);

		$stmt -> bindParam(":comentario",$datos["comentario"], PDO::PARAM_STR);

		$stmt -> bindParam(":id",$datos["id"], PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";

		}else{

			return "error";
		}

		$stmt -> close();

		$stmt = null;
	}

	/**
	 * [mdlAgregarDeseo  Agregar producto a la lista de deseos del usuario]
	 * @param  [type] $tabla [Tabla a realizar la consulta]
	 * @param  [type] $datos [id del producto a agregar a la lista de deseos y el id del usuario]
	 * @return [type]        [description]
	 */
	static public function mdlAgregarDeseo($tabla,$datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (id_usuario, id_producto) values (:id_usuario , :id_producto)");

		$stmt -> bindParam(":id_usuario",$datos["idUsuario"], PDO::PARAM_INT);

		$stmt -> bindParam(":id_producto",$datos["idProducto"], PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";

		}else{

			return "error";
		}

		$stmt -> close();

		$stmt = null;
	}

	/**
	 * [mdlMostrarDeseos Mostrar lista de Deseos en el perfil]
	 * @param  [type] $tabla [Tabla a realizar la consulta]
	 * @param  [type] $item  [id usuario]
	 * @return [type]        [description]
	 */
	static public function mdlMostrarDeseos($tabla,$item){

		$stmt = Conexion::conectar()->prepare("SELECT * from $tabla where id_usuario = :id_usuario order by id desc");

		$stmt -> bindParam(":id_usuario",$item, PDO::PARAM_INT);

		$stmt -> execute();

		return $stmt ->fetchAll();

		$stmt -> close();

		$stmt = null;
	}

	/**
	 * [ctrQuitarDeseo Quitar producto de la lista de Deseos en el perfil]
	 * @param  [type] $tabla [Tabla a realizar la consulta]
	 * @param  [type] $datos [id del deseo a eliminar]
	 * @return [type]        [description]
	 */
	static public function mdlQuitarDeseo($tabla,$datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id",$datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";

		}else{

			return "error";
		}

		$stmt -> close();

		$stmt = null;
	}

	/**
	 * [mdlEliminarUsuario Eliminar usuario del Sistema]
	 * @param  [type] $tabla [Tabla a realizar la consulta]
	 * @param  [type] $id    [id de usuario a eliminar]
	 * @return [type]        [description]
	 */
	static public function mdlEliminarUsuario($tabla,$id){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id",$id, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";

		}else{

			return "error";
		}

		$stmt -> close();

		$stmt = null;
	}

	/**
	 * [mdlEliminarComentariosUsuario Eliminar todos los comentarios realizados por el usuario en el sistema]
	 * @param  [type] $tabla [Tabla a realizar la consulta]
	 * @param  [type] $id    [id de usuario]
	 * @return [type]        [description]
	 */
	static public function mdlEliminarComentariosUsuario($tabla,$id){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_usuario = :id_usuario");

		$stmt -> bindParam(":id_usuario",$id, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";

		}else{

			return "error";
		}

		$stmt -> close();

		$stmt = null;
	}

	/**
	 * [mdlEliminarComprasUsuario Eliminar todas las compras realizadas por el usuario]
	 * @param  [type] $tabla [Tabla a realizar la consulta]
	 * @param  [type] $id    [id de usuario]
	 * @return [type]        [description]
	 */
	static public function mdlEliminarComprasUsuario($tabla,$id){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_usuario = :id_usuario");

		$stmt -> bindParam(":id_usuario",$id, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";

		}else{

			return "error";
		}

		$stmt -> close();

		$stmt = null;
	}

	/**
	 * [mdlEliminarDeseosUsuario Eliminar la lista de Deseos completa del usuario]
	 * @param  [type] $tabla [Tabla a realizar la consulta]
	 * @param  [type] $id    [id de usuario]
	 * @return [type]        [description]
	 */
	static public function mdlEliminarDeseosUsuario($tabla,$id){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_usuario = :id_usuario");

		$stmt -> bindParam(":id_usuario",$id, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";

		}else{

			return "error";
		}

		$stmt -> close();

		$stmt = null;
	}
}