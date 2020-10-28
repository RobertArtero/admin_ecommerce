<div class="content p-0">
	<?php $this->load->view("base/buscador"); ?>

	<div class="content-body">
		<div class="container pd-x-0">
			<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
				<div>
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb breadcrumb-style1 mg-b-10">
							<li class="breadcrumb-item"><a href="<?php echo base_url(__class()); ?>">Clientes</a></li>
							<li class="breadcrumb-item"><a href="<?php echo base_url(__class() . "/ver/" . $cliente->id); ?>"><?php echo $cliente->nombre ?></a></li>
							<li class="breadcrumb-item">Monedero</li>
						</ol>
					</nav>
					<h4 class="mg-b-0 tx-spacing--1">Ver monedero de <?php echo $cliente->nombre; ?>
					</h4>
				</div>
			</div>
			<div class="row row-xs">
				<div class="col-md-12 mb-3">
					<?php $this->load->view("clientes/submenu",array("activo"=>"monedero")); ?>
				</div>
				<div class="col-12 col-md-12 mt-2 d-flex align-items-stretch w-100">
					<div class="card w-100">
						<div class="card-body">
							<div class="row row-xs">
								<div class="col-md-12">
									<h1 class="text-center font-weight-light" style="font-size:4rem;"><?php echo __dinero($cliente->saldo) ?></h1>
								</div>
								<div class="col-md-12 mx-auto text-center">
									<button class="btn btn-transparent border" data-toggle="modal" data-target="#aplicar_saldo">Modificar Saldo</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-12 mt-2 d-flex align-items-stretch w-100">
					<div class="card w-100">
						<div class="card-header">
							<div class="title">Listado monedero</div>
						</div>
						<div class="card-body">
							<?php
							if($monedero){ ?>
								<div class="row">
									<?php foreach($monedero as $m){  ?>
										<div class="col-md-12">
											<div class="card border mb-1">
												<div class="card-body">
													<?php if($m->tipo_movimiento == "anadido_cliente" or $m->tipo_movimiento == "anadido_admin"){?>
														<p><?php echo __dinero($m->saldo_momento); ?> <span  class="h3 mb-0 badge-success badge mb-1" style="font-size: 17px;font-weight: 400;">+<?php echo __dinero($m->valor); ?></span>
														</p>
														<p class="small">Saldo añadido el día <?php echo __arreglo_fecha_completa($m->fecha) ?></p>
													<?php }else if($m->tipo_movimiento == "gasto_cliente" or $m->tipo_movimiento == "gasto_admin"){ ?>
														<p><?php echo __dinero($m->saldo_momento); ?><span class="h3 mb-0 badge-danger badge mb-1" style="font-size: 17px;font-weight: 400;">-<?php echo __dinero($m->valor); ?></span></p>

														<p class="small">Saldo gastado el día <?php echo __arreglo_fecha_completa($m->fecha) ?></p>
													<?php } ?>
												</div>
											</div>
										</div>
									<?php } ?>
								</div>
							<?php }else{ ?>
								<p class="text-center">No existen movimientos en el monedero</p>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="aplicar_saldo" tabindex="-1" role="dialog" aria-labelledby="aplicar_saldo" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Modificar saldo</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12 my-3">
						<label>Modificar saldo actual</label>
						<div class="input-group mb-3 input-group-lg">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1">Saldo</span>
							</div>
							<input type="text" name="cantidad" id="cantidad_saldo" class="form-control input-lg" value="<?php echo number_format($cliente->saldo,2,",","."); ?>" placeholder="0,00">
							<div class="input-group-append">
								<span class="input-group-text" id="basic-addon1">€</span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				<button type="button" class="btn btn-primary crear-pago-saldo">Aplicar saldo</button>
			</div>
		</div>
	</div>
</div>


<script>
	$(document).ready(function(){

		var loading = $(".loading");

		$('[name="cantidad"]').keyup(function(e){


			var cantidad = $('[name="cantidad"]').val();


			$(this).val($(this).val().replace(".",","));
			$(this).val($(this).val().replace(",,",""));

			if(!$.isNumeric(e.key) && e.key != ","){
				$(this).addClass("not-good");
				$(this).val($(this).val().replace(e.key,""));
			}

			if(e.key == "'"){
				$(this).addClass("not-good");
				$(this).val($(this).val().replace(e.key,""));
			}

			if($(this).val().length > 10){
				$(this).addClass("not-good");
				$(this).val($(this).val().replace(e.key,""));
			}

			var doble_decimal = $(this).val().split(',');

			if(doble_decimal[1] != undefined){

				console.log("doble_decimal");
				var t = doble_decimal[1].substring(0,2);

				if(doble_decimal[1].length > 2){
					$(this).addClass("not-good");
				}

				$(this).val(doble_decimal[0].concat(','+t));
			}

			window.setTimeout(function(){$(".not-good").removeClass("not-good");}, 1000);

		});


		$(".crear-pago-saldo").on("click",function(){

			var $saldo = $("#cantidad_saldo").val();
			var $id = '<?php echo $cliente->id; ?>';

			$return = true;


			$saldo =  $saldo.replace(",",".");

			if(!$.isNumeric($saldo)){

				swal.fire("Error","La cantidad es erronea","warning");
				$return = false;

			}

			if($return == true){
				loading.show();

				$.ajax({
					url : BASE_URL + 'clientes/ajax_modificar_saldo',
					method : 'post',
					dataType: 'json',
					data: { saldo : $saldo , id : $id },
					success: function(data) {

						if(data.result == "success") {

							$("#aplicar_saldo").modal('hide');
							$('body').removeClass('modal-open');
							$('.modal-backdrop').remove();

							window.location.href = BASE_URL + "clientes/monedero/" + $id;

						}else{
							swal.fire("Error",data.mensaje,"error");
							loading.hide();
						}
					},error: function(){
						swal.fire("Error","Error al intentar modificar el saldo","error");
						loading.hide();
					}
				});
			}
		});
	});
</script>
