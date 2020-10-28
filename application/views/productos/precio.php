<div class="content p-0">
	<?php $this->load->view("base/buscador"); ?>

	<div class="content-body">
		<div class="container pd-x-0">
			<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
				<div>
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb breadcrumb-style1 mg-b-10">
							<li class="breadcrumb-item"><a href="<?php echo base_url(__class()); ?>">Productos</a></li>
							<li class="breadcrumb-item"><a href="<?php echo base_url(__class()); ?>">Listado</a></li>
							<li class="breadcrumb-item active" aria-current="page"><?php echo $producto->nombre ?></li>
							<li class="breadcrumb-item active" aria-current="page">Precio</li>
						</ol>
					</nav>
					<h4 class="mg-b-0 tx-spacing--1">SEO de <?php echo $producto->nombre; ?></h4>
					</h4>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<?php $this->load->view("productos/submenu", array("activo" => "precio")); ?>
				</div>
				<div class="col-md-12 mt-2">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-md-6">
									<label class="label font-weight-bold">Precio</label>
									<input id="precio" type="number" class="form-control input-lg"
										   value="<?php echo $producto->precio; ?>" placeholder="Precio">
								</div>
								<div class="col-md-6">
									<label class="label font-weight-bold">Precio sin IVA</label>
									<input id="precio_sin_iva" type="number" class="form-control input-lg"
										   value="<?php echo $producto->precio_sin_iva; ?>" placeholder="Precio sin IVA">
								</div>
							</div>
						</div>
					</div>
					<div class="card mt-2">
						<div class="card-body">
							<div class="row">
								<div class="col-md-6">
									<label class="label font-weight-bold">Precio oferta</label>
									<input id="precio_oferta" type="number" class="form-control input-lg"
										   value="<?php echo $producto->precio_oferta; ?>" placeholder="Precio oferta">
								</div>
								<div class="col-md-6">
									<label class="label font-weight-bold">Precio oferta sin IVA</label>
									<input id="precio_oferta_sin_iva" type="number" class="form-control input-lg"
										   value="<?php echo $producto->precio_oferta_sin_iva; ?>" placeholder="Precio oferta sin IVA">
								</div>
							</div>
						</div>
					</div>
					<div class="card mt-2">
						<div class="card-body">
							<label class="label font-weight-bold">Activar oferta</label>
							<div class="custom-control custom-switch">
								<input type="checkbox" class="custom-control-input oferta-activada"
									   id="customSwitch1" <?php echo ($producto->oferta_activada) ? "checked" : ""; ?>>
								<label class="custom-control-label"
									   for="customSwitch1"><?php echo ($producto->oferta_activada) ? "Activo" : "No activo"; ?></label>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row mt-3">
				<div class="col-md-12">
					<button class="btn btn-lg btn-primary btn-guardar-precios">Guardar</button>
				</div>
			</div>
		</div>
	</div>
</div>

<script>

	$(document).ready(function () {

		var loading = $(".loading");
		var $id = '<?php echo $producto->id; ?>';

		$('.btn-guardar-precios').on('click', function () {

			var $precio = $("#precio").val();
			var $precio_oferta = $("#precio_oferta").val();
			var $precio_sin_iva = $("#precio_sin_iva").val();
			var $precio_oferta_sin_iva = $("#precio_oferta_sin_iva").val();
			var $oferta_activada = $(".oferta_activada").is(":checked");

			loading.show();

			$.ajax({
				url: BASE_URL + 'productos/ajax_modificar_precios',
				method: 'post',
				dataType: 'json',
				data: {
					id: $id,
					precio: $precio,
					precio_oferta: $precio_oferta,
					precio_sin_iva: $precio_sin_iva,
					precio_oferta_sin_iva: $precio_oferta_sin_iva,
					oferta_activada: $oferta_activada
				},
				success: function (data) {
					if (data.result == "success") {
						swal.fire("Confirmado", data.mensaje, "success");
						loading.hide();
					} else {
						swal.fire("Error", data.mensaje, "error");
						loading.hide();
					}
				},
				error: function () {
					swal.fire("Error", "Error al intentar modificar el producto", "error");
					loading.hide();
				}

			});

		});

	});
</script>
