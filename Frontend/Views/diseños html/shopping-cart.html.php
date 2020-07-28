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
				
				<div class="row itemCarrito">
					
					<div class="col-sm-1 col-xs-12">
						
						<br>

						<center>
							
							<button class="btn btn-default backColor">
								
								<i class="fa fa-times"></i>

							</button>

						</center>

					</div>

					<div class="col-sm-1 col-xs-12">
						
						<figure>
							
							<img src="<?php echo $servidor ?>Views/img/productos/cursos/curso02.jpg" class="img-thumbnail" alt="">
							
						</figure>

					</div>

					<div class="col-sm-4 col-xs-12">
						
						<br>
							
						<p class="tituloCarritoCompra text-left">Aprende Javascript desde Cero</p>

					</div>

					<div class=" col-md-2 col-sm-1 col-xs-12">
						
						<br>
							
						<p class="precioCarritoCompra text-center">USD $<span>10</span></p>

					</div>

					<div class=" col-md-2 col-sm-3 col-xs-8">
						
						<br>	
							
						<div class="col-xs-8">

							<center>
							
								<input type="number" name="" class="form-control text-right" min="1" value="1" readonly>

							</center>

						</div>

					</div>

					<div class="col-md-2 col-sm-1 col-xs-4 text-center">
						
						<br>

						<p>
							
							<strong>USD $<span>10</span></strong>

						</p>

					</div>

				</div>
				
				<div class="clearfix"></div>
				<hr>
				<!-- item 2 -->
				<br>

				<div class="row itemCarrito">
					
					<div class="col-sm-1 col-xs-12">
						
						<br>

						<center>
							
							<button class="btn btn-default backColor">
								
								<i class="fa fa-times"></i>

							</button>

						</center>

					</div>

					<div class="col-sm-1 col-xs-12">
						
						<figure>
							
							<img src="<?php echo $servidor ?>Views/img/productos/ropa/ropa04.jpg" class="img-thumbnail" alt="">
							
						</figure>

					</div>

					<div class="col-sm-4 col-xs-12">
						
						<br>
							
						<p class="tituloCarritoCompra text-left">Vestido Jean</p>

					</div>

					<div class=" col-md-2 col-sm-1 col-xs-12">
						
						<br>
							
						<p class="precioCarritoCompra text-center">USD $<span>10</span></p>

					</div>

					<div class=" col-md-2 col-sm-3 col-xs-8">
						
						<br>	
							
						<div class="col-xs-8">

							<center>
							
								<input type="number" name="" class="form-control text-center" min="1" value="1">

							</center>

						</div>

					</div>

					<div class="col-md-2 col-sm-1 col-xs-4 text-center">
						
						<br>

						<p>
							
							<strong>USD $<span>10</span></strong>

						</p>

					</div>

				</div>

				<div class="clearfix"></div>
				<hr>
				<!-- item 3 -->
				<br>

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
							
							<strong>USD $<span>21</span></strong>

						</h4>

					</div>

				</div>

			</div>


			<!--=====================================
			=    		    BOTON CHECKOUT 	  		 =
			======================================-->

			<div class="panel-heading cabeceraCheckout">
					
				<button class="btn btn-default backColor btn-lg pull-right">REALIZAR PAGO</button>

			</div>

		</div>

	</div>

</div>