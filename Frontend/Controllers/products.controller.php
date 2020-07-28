<?php 

	/**
	 * 
	 */
	class ControladorProductos
	{
		/**
		 * [ctrMostrarCategorias Mostrar categorias de la tienda]
		 * @param  [type] $item  [Campo a comparar en sentencia WHERE]
		 * @param  [type] $valor [Valor del campo a comparar en sentencia WHERE]
		 * @return [type]        [description]
		 */
		public function ctrMostrarCategorias($item, $valor){
			
				$tabla = "e_categories";

				$respuesta = ModeloProductos::mdlMostrarCategorias($tabla, $item, $valor);

				return $respuesta;			
		}

		/**
		 * [ctrMostrarSubCategorias Mostrar subcategorias de las categorias]
		 * @param  [type] $item  [Campo a comparar en sentencia WHERE]
		 * @param  [type] $valor [Valor del campo a comparar en sentencia WHERE]
		 * @return [type]        [description]
		 */
		static public function ctrMostrarSubCategorias($item, $valor){

			$tabla = "e_sub_categories";

			$respuesta = ModeloProductos::mdlMostrarSubCategorias($tabla,$item, $valor);

			return $respuesta;
		}

		/**
		 * [ctrMostrarProductos Mostrar productos destacados]
		 * @param  [type] $ordenar [Ordenar por que campo de la tabla ejemplo: id]
		 * @param  [type] $item    [Campo a comparar en sentencia WHERE]
		 * @param  [type] $valor   [Valor del campo a comparar en sentencia WHERE]
		 * @param  [type] $base    [Minimo de registros ejemplo: 0]
		 * @param  [type] $tope    [Maximo de registros ejemplo: 12]
		 * @param  [type] $modo    [Modo de ordenamiendo ejemplo: Ascendente o Descendente]
		 * @return [type]          [description]
		 */
		public function ctrMostrarProductos($ordenar,$item,$valor,$base, $tope,$modo){

			$tabla = "e_products";

			$respuesta = ModeloProductos::mdlMostrarProductos($tabla,$ordenar,$item,$valor,$base, $tope,$modo);

			return $respuesta;
		}

		/**
		 * [ctrMostrarInfoProducto Muestra la informaciòn de los productos]
		 * @param  [type] $item  [Campo a comparar en sentencia WHERE]
		 * @param  [type] $valor [Valor del campo a comparar en sentencia WHERE]
		 * @return [type]        [description]
		 */
		public function ctrMostrarInfoProducto($item,$valor){
			
			$tabla = "e_products";

			$respuesta = ModeloProductos::mdlMostrarInfoProducto($tabla,$item,$valor);

			return $respuesta;
		}

		/**
		 * [ctrListarProductos lista de productos]
		 * @param  [type] $ordenar [Ordenar por que campo de la tabla ejemplo: id]
		 * @param  [type] $item    [Campo a comparar en sentencia WHERE]
		 * @param  [type] $valor   [Valor del campo a comparar en sentencia WHERE]
		 * @return [type]          [description]
		 */
		static public function ctrListarProductos($ordenar,$item,$valor){

			$tabla = "e_products";

			$respuesta = ModeloProductos::mdlListarProductos($tabla,$ordenar,$item,$valor);

			return $respuesta;
		}

		/**
		 * [ctrMostrarBanner Banner estatico dependiendo de la categoria donde se encuentre]
		 * @param  [type] $ruta [url amigable]
		 * @return [type]       [description]
		 */
		static public function ctrMostrarBanner($ruta){

			$tabla = "e_banner";

			$respuesta  = ModeloProductos::mdlMostrarBanner($ruta,$tabla);

			return $respuesta;
		}

		/**
		 * [ctrBuscarProductos Metodo para el buscador de productos]
		 * @param  [type] $busqueda [Palabra a buscar]
		 * @param  [type] $base     [Minimo de registros ejemplo: 0]
		 * @param  [type] $tope     [Maximo de registros ejemplo: 12]
		 * @param  [type] $ordenar  [Ordenar por que campo de la tabla ejemplo: id]
		 * @param  [type] $modo     [Modo de ordenamiendo ejemplo: Ascendente o Descendente]
		 * @return [type]           [description]
		 */
		static public function ctrBuscarProductos($busqueda,$base,$tope,$ordenar,$modo){

			$tabla = "e_products";

			$respuesta  = ModeloProductos::mdlBuscarProductos($tabla,$busqueda,$base,$tope,$ordenar,$modo);

			return $respuesta;
		}

		/**
		 * [ctrListarProductosBusqueda Lista de productos que trae como resultado la busqueda]
		 * @param  [type] $busqueda [Palabra a buscar]
		 * @return [type]           [description]
		 */
		static public function ctrListarProductosBusqueda($busqueda){

			$tabla = "e_products";

			$respuesta  = ModeloProductos::mdlListarProductosBusqueda($tabla,$busqueda);

			return $respuesta;
		}

		/**
		 * [ctrActualizarVistaProductos Actualizar cantidad de vistas en un producto determinado]
		 * @param  [type] $datos [Datos del producto a actualizar]
		 * @return [type]        [description]
		 */
		static public function ctrActualizarVistaProductos($datos,$item){

			$tabla = "e_products";

			$respuesta  = ModeloProductos::mdlActualizarVistaProductos($tabla,$datos,$item);

			return $respuesta;
		}
	}