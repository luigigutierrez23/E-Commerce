<?php 

	require_once "conexion.php";

	/**
	 * 
	 */
	class ModeloProductos
	{
		/**
		 * [mdlMostrarCategorias Mostrar categorias de la tienda]
		 * @param  [type] $tabla [Tabla a realizar la consulta]
		 * @param  [type] $item  [Campo a comparar en sentencia WHERE]
		 * @param  [type] $valor [Valor del campo a comparar en sentencia WHERE]
		 * @return [type]        [description]
		 */
		static public function mdlMostrarCategorias($tabla,$item,$valor){

			if($item == null && $valor == null)
			{
				$stmt = Conexion::conectar()->prepare("Select * from $tabla");

				$stmt->execute();

				return $stmt ->fetchAll();
			}
			else
			{
				$stmt = Conexion::conectar()->prepare("Select * from $tabla where $item = :$item");

				$stmt -> bindParam(":".$item,$valor, PDO::PARAM_STR);

				$stmt->execute();

				return $stmt ->fetch();
			}

				$stmt -> close();

				$stmt = null;
		}

		/**
		 * [mdlMostrarSubCategorias Mostrar subcategorias de la tienda]
		 * @param  [type] $tabla [Tabla a realizar la consulta]
		 * @param  [type] $item  [Campo a comparar en sentencia WHERE]
		 * @param  [type] $valor [Valor del campo a comparar en sentencia WHERE]
		 * @return [type]        [description]
		 */
		static public function mdlMostrarSubCategorias($tabla,$item,$valor){

			$stmt = Conexion::conectar()->prepare("Select * from $tabla where $item = :$item");
			
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt ->fetchAll();

			$stmt ->close();

			$stmt = null;
		}

		/**
		 * [mdlMostrarProductos Mostrar productos en seccion destacados]
		 * @param  [type] $tabla   [Tabla a realizar la consulta]
		 * @param  [type] $ordenar [Ordenar por que campo de la tabla ejemplo: id]
		 * @param  [type] $item    [Campo a comparar en sentencia WHERE]
		 * @param  [type] $valor   [Valor del campo a comparar en sentencia WHERE]
		 * @param  [type] $base    [Minimo de registros ejemplo: 0]
		 * @param  [type] $tope    [Maximo de registros ejemplo: 12]
		 * @param  [type] $modo    [Modo de ordenamiendo ejemplo: Ascendente o Descendente]
		 * @return [type]          [description]
		 */
		static public function mdlMostrarProductos($tabla,$ordenar,$item,$valor,$base, $tope,$modo){

			if($item != null)
			{
				$stmt = Conexion::conectar()->prepare("Select * from $tabla where $item = :$item order by $ordenar $modo limit $base, $tope");

				$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
				
				$stmt -> execute();

				return $stmt ->fetchAll();
			}
			else
			{
				$stmt = Conexion::conectar()->prepare("Select * from $tabla order by $ordenar $modo limit  $base, $tope");

				$stmt -> execute();

				return $stmt ->fetchAll();
			}



			$stmt ->close();

			$stmt = null;
		}

		/**
		 * [mdlMostrarInfoProducto Mostrar informacion de productos]
		 * @param  [type] $tabla [Tabla a realizar la consulta]
		 * @param  [type] $item  [Campo a comparar en sentencia WHERE]
		 * @param  [type] $valor [Valor del campo a comparar en sentencia WHERE]
		 * @return [type]        [description]
		 */
		static public function mdlMostrarInfoProducto($tabla,$item,$valor){
			
			if($item != null)
			{
				$stmt = Conexion::conectar()->prepare("Select * from $tabla where $item = :$item");

				$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
				
				$stmt -> execute();

				return $stmt ->fetch();
			}
			else
			{
				$stmt = Conexion::conectar()->prepare("Select * from $tabla");

				$stmt -> execute();

				return $stmt ->fetchAll();
			}



			$stmt ->close();

			$stmt = null;
		}

		/**
		 * [mdlListarProductos description]
		 * @param  [type] $tabla   [Tabla a realizar la consulta]
		 * @param  [type] $ordenar [Ordenar por que campo de la tabla ejemplo: id]
		 * @param  [type] $item    [Campo a comparar en sentencia WHERE]
		 * @param  [type] $valor   [Valor del campo a comparar en sentencia WHERE]
		 * @return [type]          [description]
		 */
		static public function mdlListarProductos($tabla,$ordenar,$item,$valor){

			if($item != null){

				$stmt = Conexion::conectar()->prepare("Select * from $tabla where $item = :$item order by $ordenar desc");

				$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
				
				$stmt -> execute();

				return $stmt ->fetchAll();

			}else{

				
				$stmt = Conexion::conectar()->prepare("Select * from $tabla order by $ordenar desc");

				$stmt -> execute();

				return $stmt ->fetchAll();

			}

			$stmt ->close();

			$stmt = null;
		}

		/**
		 * [mdlMostrarBanner description]
		 * @param  [type] $ruta  [url amigable]
		 * @param  [type] $tabla [Tabla a realizar la consulta]
		 * @return [type]        [description]
		 */
		static public function mdlMostrarBanner($ruta,$tabla){

			$stmt = Conexion::conectar()->prepare("Select * from $tabla where url = :ruta");

			$stmt -> bindParam(":ruta",$ruta, PDO::PARAM_STR);
			
			$stmt -> execute();

			return $stmt ->fetch();

			$stmt ->close();

			$stmt = null;
		}

		/**
		 * [mdlBuscarProductos description]
		 * @param  [type] $tabla    [Tabla a realizar la consulta]
		 * @param  [type] $busqueda [Palabra a buscar]
		 * @param  [type] $base     [Minimo de registros ejemplo: 0]
		 * @param  [type] $tope     [Maximo de registros ejemplo: 12]
		 * @param  [type] $ordenar  [Ordenar por que campo de la tabla ejemplo: id]
		 * @param  [type] $modo     [Modo de ordenamiendo ejemplo: Ascendente o Descendente]
		 * @return [type]           [description]
		 */
		static public function mdlBuscarProductos($tabla,$busqueda,$base,$tope,$ordenar,$modo){

			$stmt = Conexion::conectar()->prepare("Select * from $tabla where url like '%$busqueda%' or titulo like '$busqueda' or titular like '$busqueda' or descripcion like '$busqueda' order by $ordenar $modo limit $base, $tope");
			
			$stmt -> execute();

			return $stmt ->fetchAll();

			$stmt ->close();

			$stmt = null;
		}

		/**
		 * [mdlListarProductosBusqueda description]
		 * @param  [type] $tabla    [Tabla a realizar la consulta]
		 * @param  [type] $busqueda [Palabra a buscar]
		 * @return [type]           [description]
		 */
		static public function mdlListarProductosBusqueda($tabla,$busqueda){

			$stmt = Conexion::conectar()->prepare("Select * from $tabla where url like '%$busqueda%' or titulo like '$busqueda' or titular like '$busqueda' or descripcion like '$busqueda'");
			
			$stmt -> execute();

			return $stmt ->fetchAll();

			$stmt ->close();

			$stmt = null;	
		}

		/**
		 * [mdlActualizarVistaProductos Actualizar cantidad de vistas en un producto determinado]
		 * @param  [type] $tabla [Tabla a realizar la consulta]
		 * @param  [type] $datos [Datos del producto a actualizar]
		 * @return [type]        [description]
		 */
		static public function mdlActualizarVistaProductos($tabla,$datos,$item){

			$stmt = Conexion::conectar()->prepare("UPDATE $tabla set $item = :$item where url = :ruta");

			$stmt -> bindParam(":ruta",$datos["ruta"], PDO::PARAM_STR);

			$stmt -> bindParam(":".$item, $datos["valor"], PDO::PARAM_STR);
			
			if($stmt -> execute()){

				return "ok";
			}else{

				return "error";
			}

			$stmt ->close();

			$stmt = null;
		}
	}