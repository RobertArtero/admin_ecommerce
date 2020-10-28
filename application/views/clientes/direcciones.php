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
							<li class="breadcrumb-item">Direcciones</li>
						</ol>
					</nav>
					<h4 class="mg-b-0 tx-spacing--1">Ver direcciones de <?php echo $cliente->nombre; ?>
					</h4>
				</div>
				<div class="d-none d-md-block">
				</div>
			</div>
			<div class="row row-xs">
				<div class="col-md-12 mb-3">
					<?php $this->load->view("clientes/submenu",array("activo"=>"direcciones")); ?>
				</div>
				<div class="col-md-12 float-left text-right">
					<a href="<?php echo base_url("clientes/guardar_direccion/" . $cliente->id) ?>" class="btn btn-transparent border"><i data-feather="map" class="wd-10 mg-r-5"></i> Añadir dirección</a>
				</div>
				<?php if($direcciones){
					foreach($direcciones as $d){
					?>
							<div class="col-md-6 mt-2 d-flex align-items-stretch w-100">
								<div class="card w-100">
									<div class="card-header">
										<div class="title">
											<?php echo $d->direccion; ?>
										</div>
									</div>
									<div class="card-body">
										<div id="map_<?php echo $d->id; ?>" style="height: 300px;" class="mb-3"></div>
										<script>


											var map_<?php echo $d->id; ?> = new google.maps.Map(document.getElementById('map_<?php echo $d->id; ?>'), {
												zoom: 10,
												center: {lat: 41.5304339 , lng: 2.1023763},
												streetViewControl: false,
												disableDefaultUI: true,
												styles: [{"elementType":"geometry","stylers":[{"color":"#f5f5f5"}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"elementType":"labels.text.fill","stylers":[{"color":"#616161"}]},{"elementType":"labels.text.stroke","stylers":[{"color":"#f5f5f5"}]},{"featureType":"administrative.land_parcel","elementType":"labels.text.fill","stylers":[{"color":"#bdbdbd"}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#eeeeee"}]},{"featureType":"poi","elementType":"labels.text.fill","stylers":[{"color":"#757575","visibility":"off"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#e5e5e5"}]},{"featureType":"poi.park","elementType":"labels.text.fill","stylers":[{"color":"#9e9e9e"}]},{"featureType":"road","elementType":"geometry","stylers":[{"color":"#ffffff"}]},{"featureType":"road.arterial","elementType":"labels.text.fill","stylers":[{"color":"#757575"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"color":"#dadada"}]},{"featureType":"road.highway","elementType":"labels.text.fill","stylers":[{"color":"#616161"}]},{"featureType":"road.local","elementType":"labels.text.fill","stylers":[{"color":"#9e9e9e"}]},{"featureType":"transit.line","elementType":"geometry","stylers":[{"color":"#e5e5e5"}]},{"featureType":"transit.station","elementType":"geometry","stylers":[{"color":"#eeeeee"}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#c9c9c9"}]},{"featureType":"water","elementType":"labels.text.fill","stylers":[{"color":"#9e9e9e"}]}]
											});

											var marker_origen = new google.maps.Marker({
												position: {lat: 41.5304339 , lng: 2.1023763},
												map: map_<?php echo $d->id; ?>,
												title: 'Dirección'
											});
											<?php if($d->latitud and $d->longitud){ ?>
											var marker_destino = new google.maps.Marker({
												position: {lat: <?php echo $d->latitud?>, lng: <?php echo $d->longitud?>},
												map: map_<?php echo $d->id; ?>,
												title: 'Dirección'
											});
											<?php } ?>

										</script>
										<button data-id="<?php echo $d->id; ?>" class="btn btn-danger my-3 float-right eliminar-direccion">Eliminar</button>

										<div class="table-responsive">
											<table class="table table-bordered table-hover">
												<tbody>
													<tr>
														<td>Nombre:</td>
														<td><?php echo $d->contacto_persona?></td>
													</tr>
													<tr>
														<td>Teléfono:</td>
														<td><?php echo $d->contacto_telefono?></td>
													</tr>
													<tr>
														<td>Dirección:</td>
														<td><?php echo $d->direccion ?></td>
													</tr>
													<tr>
														<td>Piso:</td>
														<td><?php echo $d->piso ?></td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
				<?php }
				}else{ ?>

						<p>No tiene direcciones conocidas</p>

				<?php }?>
			</div>
		</div>
	</div>
</div>
<script>
	$(".eliminar-direccion").on("click",function(){

		var $id = $(this).data("id");

		console.log($id);

		if($id <= 0){
			swal.fire("Error","Error al eliminar la dirección","error");
			return false;
		}

		Swal.fire({
			title: 'Eliminar dirección',
			text: "¿Deseas eliminar la dirección?",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#d33',
			cancelButtonColor: '#3085d6',
			cancelButtonText: 'Cancelar',
			confirmButtonText: '¡Si,eliminar!'
		}).then((result) => {
			if (result.value) {
				loading.show();

				$.ajax({

					url: BASE_URL + 'clientes/ajax_eliminar_direccion',
					dataType: 'json',
					method: 'post',
					data: {
						id: $id,
					},
					success: function(data){

						if(data.result == "success"){
							window.location.href = BASE_URL + "clientes/direcciones/" + '<?php echo $cliente->id ?>';
						}else{
							swal.fire("Error",data.mensaje,"error");
							loading.hide();

						}
					},
					error: function(){
						swal.fire("Error","No ha sido posible eliminar la dirección","error");
						loading.hide();
					}

				});

			}
		});

	});
</script>
