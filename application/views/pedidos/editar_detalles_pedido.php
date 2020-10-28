<div class="content p-0">
	<?php $this->load->view("base/buscador"); ?>

	<div class="content-body">
		<div class="container pd-x-0">
			<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
				<div>
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb breadcrumb-style1 mg-b-10">
							<li class="breadcrumb-item"><a href="<?php echo base_url(__class()); ?>">Pedidos</a></li>
							<li class="breadcrumb-item"><a href="<?php echo base_url(__class()); ?>">Listado</a></li>
							<li class="breadcrumb-item"><a href="<?php echo base_url(__class() . "/ver/" . $pedido->id); ?>">Ver pedido</a></li>
							<li class="breadcrumb-item active" aria-current="page">Detalles pedido</li>
						</ol>
					</nav>
					<h4 class="mg-b-0 tx-spacing--1">Cambiar detalles nº <?php echo $pedido->id ?>
					</h4>
				</div>
			</div>
			<div class="row row-xs">
				<div class="col-md-6 mx-auto">
					<div class="card">
						<div class="card-header">
							<div class="title">Cambiar detalles nº <?php echo $pedido->id; ?></div>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-md-12">
									<p class="font-weight-bold">Detalles actuales</p>
									<div class="table-responsive">
										<table class="table table-hover table-bordered">
											<tbody>
											<tr>
												<td class="font-weight-bold">Nombre:</td>
												<td><?php echo $pedido->nombre ?></td>
											</tr>
											<tr>
												<td class="font-weight-bold">Teléfono:</td>
												<td><?php echo $pedido->telefono ?></td>
											</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<p class="font-weight-bold">Nuevos detalles del pedido</p>
								</div>
								<div class="col-md-12 mt-2">
									<input type="text" data-error="nombre_error" value="<?php echo $pedido->nombre; ?>" class="form-control input-lg" id="nombre" placeholder="Nombre">
									<p style="font-size:12px; color:red;" id="nombre_error"></p>
								</div>
								<div class="col-md-12 mt-2">
									<input type="text" data-error="telefono_error" value="<?php echo $pedido->telefono ?>" id="telefono" class="form-control input-lg" placeholder="Teléfono">
									<p style="font-size:12px; color:red;" id="telefono_error"></p>
								</div>
								<div class="col-md-12 mt-2">
									<input type="date" value="<?php echo $pedido->fecha_entrega ?>" name="fecha_entrega" id="fecha_entrega" class="form-control input-lg" placeholder="Fecha entrega">
								</div>
								<div class="col-md-12 mt-2">
									<p class="font-weight-bold">Editar estado del pedido</p>
								</div>
								<div class="col-md-12">
									<div class="custom-control custom-switch">
										<input type="checkbox" class="custom-control-input estado-pedido" id="customSwitch1" <?php echo ($pedido->activo)? "checked" : ""; ?>>
										<label class="custom-control-label" for="customSwitch1"><?php echo ($pedido->activo)? "Activo" : "No activo"; ?></label>
									</div>
								</div>
								<div class="col-md-12 mt-3">
									<button class="btn btn-primary btn-editar-detalles">Guardar</button>
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
		var $estado_pedido = $(".estado-pedido").is(":checked");
		var $fecha_entrega = $("#fecha_entrega").val();
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

				url: BASE_URL + 'pedidos/ajax_editar_detalles',
				dataType: 'json',
				method: 'post',
				data: {
					id: '<?php echo $pedido->id; ?>',
					nombre : $nombre,
					telefono : $telefono,
					estado_pedido : $estado_pedido,
					fecha_entrega : $fecha_entrega
				},
				success: function(data){

					if(data.result == "success"){
						window.location.href = BASE_URL  + 'pedidos/ver/' + '<?php echo $pedido->id; ?>';
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
