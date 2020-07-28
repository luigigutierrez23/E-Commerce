/**======================================================
 *											 			*
 *            								 			*
 *                     						 			*
 *                            				 			*											
/*=======================================================
VISUALIZAR LA CESTA DEL CARRITO DE COMPRAS            
=========================================================*/ 

if(localStorage.getItem("cantidadCesta") != null){

	$(".cantidadCesta").html(localStorage.getItem("cantidadCesta"));
	$(".sumaCesta").html(localStorage.getItem("sumaCesta"));

}else{

	$(".cantidadCesta").html("0");
	$(".sumaCesta").html("0");
}

/**======================================================
 *											 			*
 *            								 			*
 *                     						 			*
 *                            				 			*											
/*=======================================================
VISUALIZAR LOS PRODUCTOS EN LA PAGINA CARRITO DE COMPRAS              
=========================================================*/       

if(localStorage.getItem("listaProductos") != null){

	var listaCarrito = JSON.parse(localStorage.getItem("listaProductos"));

	listaCarrito.forEach(funcionForEach);

	function funcionForEach(item, index){
		
		$(".cuerpoCarrito").append(

		'<div class="row itemCarrito">'+
			
			'<div class="col-sm-1 col-xs-12">'+
				
				'<br>'+

				'<center>'+
					
					'<button class="btn btn-default backColor quitarItemCarrito" idProducto="'+item.idProducto+'" tipo ="'+item.tipo+'" peso ="'+item.peso+'">'+
						
						'<i class="fa fa-times"></i>'+

					'</button>'+

				'</center>'+

			'</div>'+

			'<div class="col-sm-1 col-xs-12">'+
				
				'<figure>'+
					
					'<img src="'+item.imagen+'" class="img-thumbnail" alt="">'+
					
				'</figure>'+

			'</div>'+

			'<div class="col-sm-4 col-xs-12">'+
				
				'<br>'+
					
				'<p class="tituloCarritoCompra text-left">'+item.titulo+'</p>'+

			'</div>'+

			'<div class=" col-md-2 col-sm-1 col-xs-12">'+
				
				'<br>'+
					
				'<p class="precioCarritoCompra text-center">USD $<span>'+item.precio+'</span></p>'+

			'</div>'+

			'<div class=" col-md-2 col-sm-3 col-xs-8">'+
				
				'<br>'+
					
				'<div class="col-xs-8">'+

					'<center>'+
					
						'<input type="number" name="" class="form-control cantidadItem" min="1" value="'+item.cantidad+'" tipo="'+item.tipo+'" precio="'+item.precio+'" idProducto = "'+item.idProducto+'">'+

					'</center>'+

				'</div>'+

			'</div>'+

			'<div class="col-md-2 col-sm-1 col-xs-4 text-center">'+
				
				'<br>'+

				'<p class="subTotal'+item.idProducto+' subtotales">'+
					
					'<strong>USD $<span>'+(Number(item.cantidad)*Number(item.precio))+'</span></strong>'+

				'</p>'+

			'</div>'+

		'</div>'+
		
		'<div class="clearfix"></div>'+
		'<hr>'+
		'<br>');

		/*==================================================
         EVITAR MANIPULAR LA CANTIDAD EN PRODUCTOS VIRTUALES       
		====================================================*/

		$(".cantidadItem[tipo = 'virtual']").attr("readonly","true");

		/**===========================================
		 *											 *
		 *            								 *
		 *                     						 *
		 *                            				 *		
		 /*============================================
		 ACTUALIZAR SUBTOTAL
		 =============================================*/
		// var precioCarritoCompra = $(".cuerpoCarrito .precioCarritoCompra span");

		// cestaCarrito(precioCarritoCompra.length);

		// sumaSubtotales();		
	}

}else{

	$(".cuerpoCarrito").html('<div class="well">Aún no hay productos en el carrito de compras.</div>');
	$(".sumaCarrito").hide();
	$(".cabeceraCheckout").hide();
}

/**===========================================
 *											 *
 *            								 *
 *                     						 *
 *                            				 *											
/*============================================
             AGREGAR AL CARRITO              
=============================================*/

$(".agregarCarrito").click(function() {
	
	var idProducto = $(this).attr("idProducto");
	var imagen = $(this).attr("imagen");
	var titulo = $(this).attr("titulo");
	var precio = $(this).attr("precio");
	var tipo = $(this).attr("tipo");
	var peso = $(this).attr("peso");

	var agregarAlCarrito = false;

/*=============================================
             CAPTURAR DETALLES             
=============================================*/

	if(tipo == "virtual"){

		agregarAlCarrito = true;

	}else{

		var seleccionarDetalle = $(".seleccionarDetalle");
		
		for(var i = 0; i < seleccionarDetalle.length; i++){

			if($(seleccionarDetalle[i]).val() == ""){

				swal({
					  title: "Debe seleccionar Talla y Color",
					  text: "",
					  type: "warning",
					  showCancelButton: false,
					  confirmButtonColor: "#DD6B55",
					  confirmButtonText: "¡Seleccionar!",
					  closeOnConfirm: false
					})

				return;

			}else{

				titulo = titulo + "-" + $(seleccionarDetalle[i]).val();

				agregarAlCarrito = true;

			}

		}	
	}

	/*================================================================
	  ALMACENAR EN EL LOCALSTORAGE LOS PRODUCTOS AGREGADOS AL CARRITO              
	==================================================================*/
	if(agregarAlCarrito){

		/*===========================================
		  RECUPERAR ALMACENAMIENTO DEL LOCALSTORAGE             
		============================================*/

		if(localStorage.getItem("listaProductos") == null){

			listaCarrito = [];

		}else{

			var listaProductos = JSON.parse(localStorage.getItem("listaProductos"));

			for(var i = 0; i < listaProductos.length; i++){

				if(listaProductos[i]["idProducto"] == idProducto && listaProductos[i]["tipo"] == "virtual"){

					swal({
					  title: "El producto ya está agregado al carrito de compras",
					  text: "",
					  type: "warning",
					  showCancelButton: false,
					  confirmButtonColor: "#DD6B55",
					  confirmButtonText: "¡Volver!",
					  closeOnConfirm: false
					})

					return;

				}

			}

			listaCarrito.concat(localStorage.getItem("listaProductos"));
		}

		listaCarrito.push({"idProducto":idProducto,
							   "imagen": imagen,
							   "titulo": titulo,
							   "precio": precio,
							   "tipo": tipo,
							   "peso": peso,
							   "cantidad":"1"});

		localStorage.setItem("listaProductos", JSON.stringify(listaCarrito));

		/*=======================================================
		ACTUALIZAR CESTA        
		=========================================================*/ 

		var cantidadCesta = Number($(".cantidadCesta").html()) + 1;

		var sumaCesta = Number($(".sumaCesta").html()) + Number(precio);

		$(".cantidadCesta").html(cantidadCesta);
		$(".sumaCesta").html(sumaCesta);

		localStorage.setItem("cantidadCesta", cantidadCesta);
		localStorage.setItem("sumaCesta", sumaCesta);

		swal({
		  title:"",
		  text: "¡Se ha agregado un nuevo producto al carrito de compras!",
		  type: "success",
		  showCancelButton:true,
		  confirmButtonColor:"#DD6B55",
		  cancelButtonText:"Continuar comprando",
		  confirmButtonText: "¡Ir a mi carrito de compras!",
		  closeOnConfirm: false
		},
		function(isConfirm){
			if(isConfirm){

				window.location = rutaOculta + "shopping-cart";
			}
		})
	}
	
});

/**======================================================
 *											 			*
 *            								 			*
 *                     						 			*
 *                            				 			*											
/*=======================================================
QUITAR PRODUCTOS DEL CARRITO              
=========================================================*/ 

$(document).on("click", ".quitarItemCarrito", function(){
	
	$(this).parent().parent().parent().remove();

	var idProducto = $(".cuerpoCarrito button");
	var imagen = $(".cuerpoCarrito img");
	var titulo = $(".cuerpoCarrito .tituloCarritoCompra");
	var precio = $(".cuerpoCarrito .precioCarritoCompra span");
	var cantidad = $(".cuerpoCarrito .cantidadItem");

	/*==================================================================
	SI AUN QUEDAN PRODUCTOS VOLVERLOS A AGREGAR AL CARRITO(LOCALSTORAGE)         
	===================================================================*/ 

	listaCarrito = [];

	if(idProducto.length != 0){

		for (var i = 0; i < idProducto.length; i++) {
			
			var idProductoArray = $(idProducto[i]).attr("idProducto");
			var imagenArray = $(imagen[i]).attr("src");
			var tituloArray = $(titulo[i]).html();
			var precioArray = $(precio[i]).html();
			var pesoArray = $(idProducto[i]).attr("peso");
			var tipoArray = $(cantidad[i]).attr("tipo");
			var cantidadArray = $(cantidad[i]).val();

			listaCarrito.push({"idProducto":idProductoArray,
						   "imagen":imagenArray,
						   "titulo":tituloArray,
						   "precio":precioArray,
					       "tipo":tipoArray,
				           "peso":pesoArray,
				           "cantidad":cantidadArray});
		}

		localStorage.setItem("listaProductos",JSON.stringify(listaCarrito));

		sumaSubtotales();
		cestaCarrito(listaCarrito.length);

	}else{

		/*=============================================
		SI YA NO QUEDAN PRODUCTOS HAY QUE REMOVER TODO
		=============================================*/	

		localStorage.removeItem("listaProductos");

		localStorage.setItem("cantidadCesta","0");
		
		localStorage.setItem("sumaCesta","0");

		$(".cantidadCesta").html("0");
		$(".sumaCesta").html("0");

		$(".cuerpoCarrito").html('<div class="well">Aún no hay productos en el carrito de compras.</div>');
		$(".sumaCarrito").hide();
		$(".cabeceraCheckout").hide();
	}
	
});

/**======================================================
 *											 			*
 *            								 			*
 *                     						 			*
 *                            				 			*											
/*=======================================================
GENERAR SUBTOTAL DESPUES DE CAMBIAR CANTIDAD
=========================================================*/

$(document).on("change", ".cantidadItem", function(){

	var cantidad = $(this).val();
	var precio = $(this).attr("precio");
	var idProducto = $(this).attr("idProducto");

	$(".subTotal"+idProducto).html('<strong>USD $<span>'+(cantidad*precio)+'</span></strong>');

	/*=======================================================
	ACTUALIZAR LA CANTIDAD EN EL LOCALSTORAGE
	=========================================================*/

	var idProducto = $(".cuerpoCarrito button");
	var imagen = $(".cuerpoCarrito img");
	var titulo = $(".cuerpoCarrito .tituloCarritoCompra");
	var precio = $(".cuerpoCarrito .precioCarritoCompra span");
	var cantidad = $(".cuerpoCarrito .cantidadItem");
	listaCarrito = [];

	for(var i = 0; i < idProducto.length; i++){

			var idProductoArray = $(idProducto[i]).attr("idProducto");
			var imagenArray = $(imagen[i]).attr("src");
			var tituloArray = $(titulo[i]).html();
			var precioArray = $(precio[i]).html();
			var pesoArray = $(idProducto[i]).attr("peso");
			var tipoArray = $(cantidad[i]).attr("tipo");
			var cantidadArray = $(cantidad[i]).val();

			listaCarrito.push({"idProducto":idProductoArray,
						   "imagen":imagenArray,
						   "titulo":tituloArray,
						   "precio":precioArray,
					       "tipo":tipoArray,
				           "peso":pesoArray,
				           "cantidad":cantidadArray});

	}

		localStorage.setItem("listaProductos",JSON.stringify(listaCarrito));

		sumaSubtotales();
		cestaCarrito(listaCarrito.length);

});

/**======================================================
 *											 			*
 *            								 			*
 *                     						 			*
 *                            				 			*											
/*=======================================================
ACTUALIZAR SUBTOTAL
=========================================================*/

var precioCarritoCompra = $(".cuerpoCarrito .precioCarritoCompra span");
var cantidadItem = $(".cuerpoCarrito .cantidadItem");

for (var i = 0; i < precioCarritoCompra.length; i++) {
	
	var precioCarritoCompraArray = $(precioCarritoCompra[i]).html();
	var cantidadItemArray = $(cantidadItem[i]).html();
	var idProductoArray = $(cantidadItem[i]).attr("idProducto");

	$(".subtotal"+idProductoArray).html('<strong>USD $<span>'+(precioCarritoCompraArray*cantidadItemArray)+'</span></strong>');

	sumaSubtotales();
	cestaCarrito(precioCarritoCompra.length);

}

/**======================================================
 *											 			*
 *            								 			*
 *                     						 			*
 *                            				 			*											
/*=======================================================
SUMA DE TODOS LOS SUBTOTALES
=========================================================*/

function sumaSubtotales(){

	var subtotales = $(".subtotales span");
	var arraySumaSubtotales = [];
	
	for(var i = 0; i < subtotales.length; i++){

		var subtotalesArray = $(subtotales[i]).html();
		arraySumaSubtotales.push(Number(subtotalesArray));
		
	}

	
	function sumaArraySubtotales(total, numero){

		return total + numero;

	}

	var sumaTotal = arraySumaSubtotales.reduce(sumaArraySubtotales);
	
	$(".sumaSubTotal").html('<strong>USD $<span>'+(sumaTotal).toFixed(2)+'</span></strong>');

	$(".sumaCesta").html((sumaTotal).toFixed(2));

	localStorage.setItem("sumaCesta", (sumaTotal).toFixed(2));

}

/**===========================================
 *											 *
 *            								 *
 *                     						 *
 *                            				 *
/*============================================
ACTUALIZAR CESTA AL CAMBIAR CANTIDAD
=============================================*/
function cestaCarrito(cantidadProductos){

	/*=============================================
	SI HAY PRODUCTOS EN EL CARRITO
	=============================================*/

	if(cantidadProductos != 0){
		
		var cantidadItem = $(".cuerpoCarrito .cantidadItem");

		var arraySumaCantidades = [];
	
		for(var i = 0; i < cantidadItem .length; i++){

			var cantidadItemArray = $(cantidadItem[i]).val();
			arraySumaCantidades.push(Number(cantidadItemArray));
			
		}
	
		function sumaArrayCantidades(total, numero){

			return total + numero;

		}

		var sumaTotalCantidades = arraySumaCantidades.reduce(sumaArrayCantidades);
		
		$(".cantidadCesta").html(sumaTotalCantidades );
		localStorage.setItem("cantidadCesta", sumaTotalCantidades);

	}

}

/**===========================================
 *											 *
 *            								 *
 *                     						 *
 *                            				 *
/*=============================================
CHECKOUT
=============================================*/

$("#btnCheckout").click(function() {

	$(".listaProductos table.tablaProductos tbody").html("");
	
	var idUsuario = $(this).attr("idUsuario");
	var peso = $(".cuerpoCarrito button");
	var titulo = $(".cuerpoCarrito .tituloCarritoCompra");
	var cantidad = $(".cuerpoCarrito .cantidadItem");
	var subtotal = $(".cuerpoCarrito .subtotales span");
	var tipoArray =[];
	var cantidadPeso = [];

	/*=============================================
	SUMA SUBTOTAL
	=============================================*/

	var sumaSubTotal = $(".sumaSubTotal span")
	
	$(".valorSubtotal").html($(sumaSubTotal).html());
	$(".valorSubtotal").attr("valor",$(sumaSubTotal).html());

	/*=============================================
	TASAS DE IMPUESTO
	=============================================*/

	var impuestoTotal = ($(".valorSubtotal").html() * $("#tasaImpuesto").val()) /100;
	
	$(".valorTotalImpuesto").html((impuestoTotal).toFixed(2));
	$(".valorTotalImpuesto").attr("valor",(impuestoTotal).toFixed(2));

	sumaTotalCompra();

	/*=============================================
	VARIABLES ARRAY 
	=============================================*/

	for (var i = 0; i < peso.length; i++) {
		
		var pesoArray = $(peso[i]).attr("peso");
		var tituloArray = $(titulo[i]).html();
		var cantidadArray = $(cantidad[i]).val();		
		var subtotalArray = $(subtotal[i]).html();

		/*=============================================
		EVALUAR EL PESO DE ACUERDO A LA CANTIDAD DE PRODUCTOS
		=============================================*/

		cantidadPeso[i] = pesoArray * cantidadArray;
		
		function sumaArrayPeso(total, numero){

			return total + numero;

		}

		var sumaTotalPeso = cantidadPeso.reduce(sumaArrayPeso);

		/*=============================================
		MOSTRAR PRODUCTOS DEFINITIVOS A COMPRAR
		=============================================*/

		$(".listaProductos table.tablaProductos tbody").append('<tr>'+
															   '<td class="valorTitulo">'+tituloArray+'</td>'+
															   '<td class="valorCantidad">'+cantidadArray+'</td>'+
															   '<td>$<span class="valorItem" valor="'+subtotalArray+'">'+subtotalArray+'</span></td>'+
															   '<tr>');

		/*=============================================
		SELECCIONAR PAÍS DE ENVÍO SI HAY PRODUCTOS FÍSICOS
		=============================================*/
	
		tipoArray.push($(cantidad[i]).attr("tipo"));
		
		function checkTipo(tipo){

			return tipo == "fisico";
		
		}

		if(tipoArray.find(checkTipo) == "fisico"){

			$(".seleccionePais").html('<select class="form-control" id="seleccionarPais" required>'+
							
							          '<option value="">Seleccione el país</option>'+

						              '</select>');

			$(".formEnvio").show();

			$(".btnPagar").attr("tipo","fisico");

			$.ajax({
			url:rutaOculta+"Views/js/plugins/countries.json",
			type: "GET",
			cache: false,
			contentType: false,
			processData:false,
			dataType:"json",
			success: function(respuesta){
			
				respuesta.forEach(seleccionarPais);

				function seleccionarPais(item, index){

					var pais = item.name;
					var codPais = item.code;

					$("#seleccionarPais").append('<option value="'+codPais+'">'+pais+'</option>');
				
				}

			}

			});

			/*=============================================
			EVALUAR TASAS DE ENVÍO SI EL PRODUCTO ES FÍSICO
			=============================================*/

			$("#seleccionarPais").change(function(){

				$(".alert").remove();

				$("#cambiarDivisa").val("USD");

				var pais = $(this).val();
				var tasaPais = $("#tasaPais").val();

				if(pais == tasaPais){

					var resultadoPeso = sumaTotalPeso * $("#envioNacional").val();
					
					if(resultadoPeso < $("#tasaMinimaNal").val()){

						$(".valorTotalEnvio").html($("#tasaMinimaNal").val());
						$(".valorTotalEnvio").attr("valor", $("#tasaMinimaNal").val());

					}else{

						$(".valorTotalEnvio").html(resultadoPeso);
						$(".valorTotalEnvio").attr("valor",resultadoPeso);
					}

				}else{

					var resultadoPeso = sumaTotalPeso * $("#envioInternacional").val();
					
					if(resultadoPeso < $("#tasaMinimaInt").val()){

						$(".valorTotalEnvio").html($("#tasaMinimaInt").val());
						$(".valorTotalEnvio").attr("valor",$("#tasaMinimaInt").val());

					}else{

						$(".valorTotalEnvio").html(resultadoPeso);
						$(".valorTotalEnvio").attr("valor",resultadoPeso);
					}

				}	

				sumaTotalCompra();
				//pagarConPayu();

				})

		}else{

			$(".btnPagar").attr("tipo","virtual");

		}

	}

});

/**===========================================
 *											 *
 *            								 *
 *                     						 *
 *                            				 *
/*=============================================
SUMA TOTAL DE LA COMPRA
=============================================*/
function sumaTotalCompra(){

	var sumaTotalTasas = Number($(".valorSubtotal").html())+ 
	                     Number($(".valorTotalEnvio").html())+ 
	                     Number($(".valorTotalImpuesto").html());


	$(".valorTotalCompra").html((sumaTotalTasas).toFixed(2));
	$(".valorTotalCompra").attr("valor",(sumaTotalTasas).toFixed(2));

	//localStorage.setItem("total",hex_md5($(".valorTotalCompra").html()));
}

/**===========================================
 *											 *
 *            								 *
 *                     						 *
 *                            				 *
/*=============================================
MÉTODO DE PAGO PARA CAMBIO DE DIVISA
=============================================*/

var metodoPago = "paypal";
divisas(metodoPago);

$("input[name='pago']").change(function(){

	var metodoPago = $(this).val();

	divisas(metodoPago);

	if(metodoPago == "payu"){

		$(".btnPagar").hide();
		$(".formPayu").show();

		//pagarConPayu();

	}else{

		$(".btnPagar").show();
		$(".formPayu").hide();

	}

})

/**===========================================
 *											 *
 *            								 *
 *                     						 *
 *                            				 *
/*=============================================
FUNCIÓN PARA EL CAMBIO DE DIVISA
=============================================*/

function divisas(metodoPago){

	$("#cambiarDivisa").html("");

	if(metodoPago == "paypal"){

		$("#cambiarDivisa").append('<option value="USD">USD</option>'+
			                       '<option value="EUR">EUR</option>'+
			                       '<option value="GBP">GBP</option>'+
			                       '<option value="MXN">MXN</option>'+
			                       '<option value="JPY">JPY</option>'+
			                       '<option value="CAD">CAD</option>'+
			                       '<option value="BRL">BRL</option>')

	}else{

		$("#cambiarDivisa").append('<option value="USD">USD</option>'+
			                       '<option value="PEN">PEN</option>'+
			                       '<option value="COP">COP</option>'+
			                       '<option value="MXN">MXN</option>'+
			                       '<option value="CLP">CLP</option>'+
			                       '<option value="ARS">ARS</option>'+
			                       '<option value="BRL">BRL</option>')

	}

}

/**===========================================
 *											 *
 *            								 *
 *                     						 *
 *                            				 *
/*=============================================
CAMBIO DE DIVISA
=============================================*/

var divisaBase = "USD";

$("#cambiarDivisa").change(function(){

	$(".alert").remove();

	if($("#seleccionarPais").val() == ""){

		$("#cambiarDivisa").after('<div class="alert alert-warning">No ha seleccionado el país de envío</div>');

		return;

	}
	
	var divisa = $(this).val();

	$.ajax({

		url: "http://free.currconv.com/api/v7/convert?q="+divisaBase+"_"+divisa+"&compact=ultra&apiKey=a01ebaf9a1c69eb4ff79",
		type:"GET",
		cache: false,
	    contentType: false,
	    processData: false,
	    dataType:"jsonp",
	    success:function(respuesta){
	    	console.log("respuesta", respuesta);
	        	
	    	var conversion = (respuesta["USD_"+divisa]).toFixed(2);

	    	$(".cambioDivisa").html(divisa);
	    	
	    	if(divisa == "USD"){

	    		$(".valorSubtotal").html($(".valorSubtotal").attr("valor"))
		    	$(".valorTotalEnvio").html($(".valorTotalEnvio").attr("valor"))
		    	$(".valorTotalImpuesto").html($(".valorTotalImpuesto").attr("valor"))
		    	$(".valorTotalCompra").html($(".valorTotalCompra").attr("valor"))

		    	var valorItem = $(".valorItem");

		    	//localStorage.setItem("total",hex_md5($(".valorTotalCompra").html()));

		    	for(var i = 0; i < valorItem.length; i++){

		    		$(valorItem[i]).html($(valorItem[i]).attr("valor"));

		    	}
	    		
	    	}else{
	
		    	$(".valorSubtotal").html(
		    		
		    		Math.ceil(Number(conversion) * Number($(".valorSubtotal").attr("valor"))*100)/100

		    	)

		    	$(".valorTotalEnvio").html(

		    		(Number(conversion) * Number($(".valorTotalEnvio").attr("valor"))).toFixed(2)

		    	)

		    	$(".valorTotalImpuesto").html(

		    		(Number(conversion) * Number($(".valorTotalImpuesto").attr("valor"))).toFixed(2)

		    	)

		    	$(".valorTotalCompra").html(

		    		(Number(conversion) * Number($(".valorTotalCompra").attr("valor"))).toFixed(2)

		    	)

		    	var valorItem = $(".valorItem");

		    	//localStorage.setItem("total",hex_md5($(".valorTotalCompra").html()));

		    	for(var i = 0; i < valorItem.length; i++){

		    		$(valorItem[i]).html(
		    			
		    			(Number(conversion) * Number($(valorItem[i]).attr("valor"))).toFixed(2)

		    		);

		    	}

		    }

	    	sumaTotalCompra();

	    	//pagarConPayu();

	    }

	})	

	

})

/**===========================================
 *											 *
 *            								 *
 *                     						 *
 *                            				 *
/*=============================================
BOTÓN PAGAR PAYPAL
=============================================*/

$(".btnPagar").click(function(){

	var tipo = $(this).attr("tipo");

	if(tipo == "fisico" && $("#seleccionarPais").val() == ""){

		$(".btnPagar").after('<div class="alert alert-warning">No ha seleccionado el país de envío</div>');

		return;

	}
})