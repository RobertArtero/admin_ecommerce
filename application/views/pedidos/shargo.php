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
							<li class="breadcrumb-item active" aria-current="page">Shargo</li>
						</ol>
					</nav>
					<h4 class="mg-b-0 tx-spacing--1">Shargo pedido  nº <?php echo $pedido->id ?>
					</h4>
				</div>
			</div>
			<div class="row row-xs">
				<div class="col-md-12 mb-3">
					<?php $this->load->view("pedidos/submenu",array("activo"=>"shargo")); ?>
				</div>
				<?php if($pedido->shargo_error){ ?>
				<div class="col-md-12">
					<div class="alert alert-danger text-center">
						El Shargo tiene un error. <strong>Posiblemente no está programado</strong>
					</div>
				</div>
				<?php } ?>
				<div class="col-md-6">
					<div class="card">
						<div class="card-header">
							<div class="title">
								Detalles envío
							</div>
						</div>
						<div class="card-body">
							<div class="mapa">
								<div id="map_<?php echo $pedido->id; ?>" style="height: 300px;" class="mb-3"></div>
								<script>


									var map_<?php echo $pedido->id; ?> = new google.maps.Map(document.getElementById('map_<?php echo $pedido->id; ?>'), {
										zoom: 10,
										center: {lat: 41.5304339 , lng: 2.1023763},
										streetViewControl: false,
										disableDefaultUI: true,
										styles: [{"elementType":"geometry","stylers":[{"color":"#f5f5f5"}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"elementType":"labels.text.fill","stylers":[{"color":"#616161"}]},{"elementType":"labels.text.stroke","stylers":[{"color":"#f5f5f5"}]},{"featureType":"administrative.land_parcel","elementType":"labels.text.fill","stylers":[{"color":"#bdbdbd"}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#eeeeee"}]},{"featureType":"poi","elementType":"labels.text.fill","stylers":[{"color":"#757575","visibility":"off"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#e5e5e5"}]},{"featureType":"poi.park","elementType":"labels.text.fill","stylers":[{"color":"#9e9e9e"}]},{"featureType":"road","elementType":"geometry","stylers":[{"color":"#ffffff"}]},{"featureType":"road.arterial","elementType":"labels.text.fill","stylers":[{"color":"#757575"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"color":"#dadada"}]},{"featureType":"road.highway","elementType":"labels.text.fill","stylers":[{"color":"#616161"}]},{"featureType":"road.local","elementType":"labels.text.fill","stylers":[{"color":"#9e9e9e"}]},{"featureType":"transit.line","elementType":"geometry","stylers":[{"color":"#e5e5e5"}]},{"featureType":"transit.station","elementType":"geometry","stylers":[{"color":"#eeeeee"}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#c9c9c9"}]},{"featureType":"water","elementType":"labels.text.fill","stylers":[{"color":"#9e9e9e"}]}]
									});

									var marker_origen = new google.maps.Marker({
										position: {lat: 41.5304339 , lng: 2.1023763},
										map: map_<?php echo $pedido->id; ?>,
										title: 'Dirección'
									});
									<?php if($pedido->altitud and $pedido->longitud){ ?>
										var marker_destino = new google.maps.Marker({
											position: {lat: <?php echo $pedido->altitud?>, lng: <?php echo $pedido->longitud?>},
											map: map_<?php echo $pedido->id; ?>,
											title: 'Dirección'
										});
									<?php } ?>

								</script>
							</div>
							<div class="table-responsive">
								<table class="table table-hover table-bordered">
									<tbody>
										<tr>
											<td class="font-weight-bold">Dirección:</td>
											<td><?php echo $pedido->direccion_google ?></td>
										</tr>
										<tr>
											<td class="font-weight-bold">Piso:</td>
											<td><?php echo $pedido->piso ?></td>
										</tr>
										<tr>
											<td class="font-weight-bold">Latitud:</td>
											<td><?php echo $pedido->latitud ?></td>
										</tr>
										<tr>
											<td class="font-weight-bold">Longitud:</td>
											<td><?php echo $pedido->longitud ?></td>
										</tr>

									</tbody>
								</table>
							</div>
						</div>
						<div class="card-footer">
							<a href="<?php echo base_url('pedidos/cambiar_direccion/' . $pedido->id); ?>" class="btn btn-transparent border">Cambiar dirección</a>
							<button class="btn btn-secondary btn-procesar-shargo">Procesar Shargo</button>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="card">
						<div class="card-header">
							<div class="title">
								Detalles Shargo
							</div>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-hover table-bordered">
									<tbody>
									<tr>
										<td class="font-weight-bold">Shargo ID:</td>
										<td><?php echo ($pedido->shargo_id) ? $pedido->shargo_id: "-"; ?></td>
									</tr>
									<tr>
										<td class="font-weight-bold">Estado shargo:</td>
										<td><?php echo ($pedido->shargo_estado) ? $pedido->shargo_estado : "-"; ?></td>
									</tr>
									<tr>
										<td class="font-weight-bold">Shargo error:</td>
										<td><?php echo ($pedido->shargo_error) ? "Error " . $pedido->shargo_error_mensaje : "-" ?></td>
									</tr>
									<tr>
										<td class="font-weight-bold">Shargo código:</td>
										<td><?php echo ($pedido->shargo_code_error) ? $pedido->shargo_code_error : "-" ?></td>
									</tr>
									<tr>
										<td class="font-weight-bold">Tracking:</td>
										<td><?php echo ($pedido->shargo_tracking) ? "<a target='_blank' href='$pedido->shargo_tracking'>" . $pedido->shargo_tracking . "</a>" : "-"; ?></td>
									</tr>
									<tr>
										<td class="font-weight-bold">Precio Shargo:</td>
										<td><?php echo ($pedido->shargo_precio) ? $pedido->shargo_precio : "-"; ?></td>
									</tr>
									<tr>
										<td class="font-weight-bold">Precio programado:</td>
										<td><?php echo ($pedido->shargo_programado) ? $pedido->shargo_programado : "-"; ?></td>
									</tr>

									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>
<script>
	$(".btn-procesar-shargo").on("click",function(){


		Swal.fire({
			title: '¿Quieres reenviar a Shargo?',
			text: "Enviar un pedido a Shargo generará costes",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			cancelButtonText: 'Cancelar',
			confirmButtonText: '¡Si, procesar!'
		}).then((result) => {
			if (result.value) {

				loading.show();

				$.ajax({

					url: BASE_URL + 'pedidos/ajax_envio_shargo',
					dataType: 'json',
					method: 'post',
					data: {
						id: '<?php echo $pedido->id; ?>',
					},
					success: function(data){

						if(data.result == "success"){
							window.location.href = BASE_URL  + 'pedidos/shargo/' + '<?php echo $pedido->id; ?>';
						}else{
							swal.fire("Error",data.mensaje,"error");
							loading.hide();
						}
					},
					error: function(){
							swal.fire("Error","No es posible conectar con el sistema","error");
							loading.hide();
					}

				});

			}
		})


	});
</script>
