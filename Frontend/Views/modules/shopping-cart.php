<?php 

	$servidor = Url::ctrUrlServidor();
	$url = Url::ctrUrl();

 ?>

<!-- /*=============================================
			BREADCRUMB CARRITO DE COMPRAS
=============================================*/ -->

<div class="container-fluid well well-sm">
	
	<div class="container">
		
		<div class="row">
			
			<ul class="breadcrumb fondoBreadcrumb text-uppercase">
				
				<li><a href="<?php echo $url;  ?>">INICIO</a></li>
				<li class="active pagActiva">CARRITO DE COMPRAS</li>

			</ul>

		</div>

	</div>

</div>

<!-- /*=============================================
			TABLA CARRITO DE COMPRAS
=============================================*/ -->

<div class="container-fluid">
	
	<div class="container">
		
		<div class="panel panel-default">

			<!--=====================================
			=         	 HEADER PANEL         	   =
			======================================-->
			
			
			<div class="panel-heading cabeceraCarrito">
				
				<div class="col-md-6 col-sm-7 col-xs-12 text-center">
					
					<h3><small>PRODUCTO</small></h3>

				</div>

				<div class="col-md-2 col-sm-1 col-xs-0 text-center">
					
					<h3><small>PRECIO</small></h3>

				</div>


				<div class="col-md-2 col-xs-0 text-center">
					
					<h3><small>CANTIDAD</small></h3>

				</div>

				<div class="col-md-2 col-xs-0 text-center">
					
					<h3><small>SUBTOTAL</small></h3>

				</div>

			</div>

			<!--=====================================
			=         	 BODY PANEL         	   =
			======================================-->

			<div class="panel-body cuerpoCarrito">
				

			</div>

			<!--=====================================
			=        SUMA TOTAL DEL PRODUCTO 	    =
			======================================-->

			<div class="panel-body sumaCarrito">
				
				<div class="col-md-4 col-sm-6 col-xs-12 pull-right well">
					
					<div class="col-xs-6">
						
						<h4>TOTAL:</h4>

					</div>

					<div class="col-xs-6">
						
						<h4 class="sumaSubTotal">
							

						</h4>

					</div>

				</div>

			</div>
			
			<!--=====================================
			=    		    BOTON CHECKOUT 	  		 =
			======================================-->

			<div class="panel-heading cabeceraCheckout">

				<?php 

					if(isset($_SESSION["validarSesion"])){

						if($_SESSION["validarSesion"] == "ok"){

							echo'<a id="btnCheckout" href="#modalCheckout" data-toggle="modal" idUsuario ="'.$_SESSION["id"].'"><button class="btn btn-default backColor btn-lg pull-right">REALIZAR PAGO</button></a>';

						}
		
					}else{

						echo'<a href="#modalIngreso" data-toggle="modal"><button class="btn btn-default backColor btn-lg pull-right">REALIZAR PAGO</button></a>';

					}

				 ?>
					
				

			</div>

		</div>

	</div>

</div>

<!--=====================================
VENTANA MODAL PARA CHECKOUT
======================================-->

<div class="modal fade modalFormulario" role="dialog" id="modalCheckout">
	
	<div class="modal-content modal-dialog">
			
		<div class="modal-body modalTitulo">

			<h3 class="backColor"> REALIZAR PAGO</h3>

			<button type="button" class="close" data-dismiss="modal">&times;</button>

			<div class="contenidoCheckout">

				<?php 

					$respuesta = ControladorCarrito::ctrMostrarTarifas();

					echo '<input type="hidden" id="tasaImpuesto" value="'.$respuesta["impuesto"].'">
						  <input type="hidden" id="envioNacional" value="'.$respuesta["envio_nacional"].'">
					      <input type="hidden" id="envioInternacional" value="'.$respuesta["envio_internacional"].'">
					      <input type="hidden" id="tasaMinimaNal" value="'.$respuesta["tasa_min_nacional"].'">
					      <input type="hidden" id="tasaMinimaInt" value="'.$respuesta["tasa_min_internacional"].'">
					      <input type="hidden" id="tasaPais" value="'.$respuesta["pais"].'">';

				 ?>
				
				<div class="formEnvio row">
					
					<h4 class="text-center well text-muted text-uppercase">INFORMACION DE ENVIO</h4>

					<div class="col-xs-12 seleccionePais">
						

					</div>

				</div>

				<br>

				<div class="formaPago row">
					
					<h4 class="text-center well text-muted text-uppercase">Elige la forma de pago</h4>

					<figure class="col-xs-6">
						
						<center>
							
							<input id="checkPaypal" type="radio" name="pago" value="paypal" checked>

						</center>

						<img src="<?php echo $url; ?>Views/img/plantilla/paypal.jpg" class="img-thumbnail">

					</figure>

					<figure class="col-xs-6">
						
						<center>
							
							<input id="checkPayu" type="radio" name="pago" value="payu">

						</center>

						<img src="<?php echo $url; ?>Views/img/plantilla/payu.jpg" class="img-thumbnail">		

					</figure>

				</div>

				<div class="listaProductos row">
					
					<h4 class="text-center well text-muted text-uppercase">Productos a comprar</h4>

					<table class="table table-striped tablaProductos">
						
						<thead>

							<tr>
								<th>Producto</th>
								<th>Cantidad</th>
								<th>Precio</th>
							</tr>
						
						</thead>

						<tbody>

							
						
						</tbody>

					</table>

					<div class="col-sm-6 col-xs-12 pull-right">
						
						<table class="table table-striped tablaTasas">

							<tbody>

								<tr>
									
									<td>Subtotal</td>
									<td><span class="cambioDivisa">USD</span> $<span class="valorSubtotal" valor="0">0</span></td>

								</tr>

								<tr>
									
									<td>Envío</td>
									<td><span class="cambioDivisa">USD</span> $<span class="valorTotalEnvio" valor="0">0</span></td>

								</tr>

								<tr>
									
									<td>Impuestos</td>
									<td><span class="cambioDivisa">USD</span> $<span class="valorTotalImpuesto" valor="0">0</span></td>

								</tr>

								<tr>
									
									<td>Total</td>
									<td><span class="cambioDivisa">USD</span> $<span class="valorTotalCompra" valor="0">0</span></td>

								</tr>

							</tbody>
							
						</table>

						<div class="divisa">
							
							<select class="form-control" id="cambiarDivisa" name="divisa" required>
							
								<option value="USD">USD</option>
							
							</select>

							<br>

						</div>

					</div>

					<div class="clearfix"></div>

					<button class="btn btn-block btn-lg btn-default backColor btnPagar">PAGAR</button>

				</div>

			</div>			

		</div>

		<div class="modal-footer">
			

		</div>
	
	</div>

</div>