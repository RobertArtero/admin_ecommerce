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
							<li class="breadcrumb-item">Editar</li>
						</ol>
					</nav>
					<h4 class="mg-b-0 tx-spacing--1">Editar
					</h4>
				</div>
			</div>
			<div class="row row-xs">
				<div class="col-md-6 mx-auto">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-md-12">
									<p class="font-weight-bold">Detalles</p>
								</div>
								<div class="col-md-12 mt-2">
									<input type="text" data-error="nombre_error" value="<?php echo $cliente->nombre; ?>" class="form-control input-lg" id="nombre" placeholder="Nombre">
									<p style="font-size:12px; color:red;" id="nombre_error"></p>
								</div>

								<div class="col-md-12 mt-2">
									<input type="text" data-error="telefono_error" value="<?php echo $cliente->telefono ?>" id="telefono" class="form-control input-lg" placeholder="Teléfono">
									<p style="font-size:12px; color:red;" id="telefono_error"></p>
								</div>
								<div class="col-md-12">
									<p class="font-weight-bold">Facturación</p>
								</div>
								<div class="col-md-12 mt-2">
									<input type="text" data-error="facturacion_nombre_error" value="<?php echo $cliente->facturacion_nombre; ?>" class="form-control input-lg" id="facturacion_nombre" placeholder="Nombre">
									<p style="font-size:12px; color:red;" id="facturacion_nombre_error"></p>
								</div>

								<div class="col-md-12 mt-2">
									<input type="text" data-error="facturacion_nif_error" value="<?php echo $cliente->facturacion_nif ?>" id="facturacion_nif" class="form-control input-lg" placeholder="NIF">
									<p style="font-size:12px; color:red;" id="facturacion_nif_error"></p>
								</div>

								<div class="col-md-12 mt-2">
									<input type="text" data-error="facturacion_direccion_error" value="<?php echo $cliente->facturacion_direccion ?>" id="facturacion_direccion" class="form-control input-lg" placeholder="Dirección de facturación">
									<p style="font-size:12px; color:red;" id="facturacion_direccion_error"></p>
								</div>


								<div class="col-md-12">
									<p class="font-weight-bold">Estado del cliente</p>
								</div>
								<div class="col-md-12">

									<div class="custom-control custom-switch">
										<input type="checkbox" class="custom-control-input estado-cliente" id="customSwitch1" <?php echo ($cliente->activo)? "checked" : ""; ?>>
										<label class="custom-control-label" for="customSwitch1"><?php echo ($cliente->activo)? "Activo" : "No activo"; ?></label>
									</div>

								</div>
								<div class="col-md-12 mt-4">
									<div class="btn btn-primary btn-editar-detalles">Guardar</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<script>
	$(".btn-editar-detalles").on("click",function(){



		var $nombre = $("#nombre").val();
		var $telefono = $("#telefono").val();

		var $facturacion_nombre = $("#facturacion_nombre").val();
		var $facturacion_nif = $("#facturacion_nif").val();
		var $facturacion_direccion = $("#facturacion_direccion").val();

		var $estado_cliente = $(".estado-cliente").is(":checked");

		var $return = true; /*Variable controladora del envío*/

		if($nombre.length == 0 || $nombre.length == ""){
			$("#nombre").addClass("input_error");
			$("#nombre_error").text('Nombre incompleto');

			$return = false;
		}

		/* Teléfono */

		var filter_telefono = /^[6798]{1}[0-9]{8}$/;

		if($telefono.length == 0 || $telefono.length == ""){
			$("#telefono").addClass("input_error");
			$("#telefono_error").text('Teléfono incompleto');

			$return = false;
		}else if(!filter_telefono.test($telefono)){
			$("#telefono").addClass("input_error");
			$("#telefono_error").text('Teléfono incorrecto');

			$return = false;
		}


		if($return){
			loading.show();

			$.ajax({

				url: BASE_URL + 'clientes/ajax_editar_detalles',
				dataType: 'json',
				method: 'post',
				data: {
					id: '<?php echo $cliente->id; ?>',
					nombre : $nombre,
					telefono : $telefono,
					facturacion_nombre : $facturacion_nombre,
					facturacion_nif : $facturacion_nif,
					facturacion_direccion : $facturacion_direccion,
					estado_cliente : $estado_cliente

				},
				success: function(data){

					if(data.result == "success"){
						window.location.href = BASE_URL  + 'clientes/ver/' + '<?php echo $cliente->id; ?>';
					}else{
						swal.fire("Error",data.mensaje,"error");
						loading.hide();

					}
				},
				error: function(){
					swal.fire("Error","No es posible editar el pedido","error");
					loading.hide();
				}

			});
		}



	});

	$(document).on("focusout",".input_error",function(){

		$(this).removeClass("input_error");
		var $err = $(this).data("error");
		$("#" + $err).text('');

	});
</script>
