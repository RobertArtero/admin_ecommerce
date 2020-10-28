<div class="content p-0">
	<?php $this->load->view("base/buscador"); ?>

	<div class="content-body">
		<div class="container pd-x-0">
			<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
				<div>
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb breadcrumb-style1 mg-b-10">
							<li class="breadcrumb-item"><a href="<?php echo base_url(__class()); ?>">Configuración
									avanzada</a>
							</li>
							<li class="breadcrumb-item active"
								aria-current="page"><?php echo $this->uri->segment(2) ?></li>
						</ol>
					</nav>
				</div>
			</div>
			<div class="row row-xs">
				<div class="col-md-12 mb-3">
					<?php $this->load->view("configuracion_avanzada/submenu", array("activo" => $this->uri->segment(2))); ?>
				</div>

				<div class="col-md-12 mt-2">
					<div class="row">
						<?php if (!empty($opciones)) {
							foreach ($opciones as $opcion) { ?>
								<div class="col-md-4">
									<div class="card mt-2">
										<div class="card-body">
											<label class="label font-weight-bold"><?php echo strtoupper(str_replace("_", " ", $opcion->opcion)) ?></label>
											<input data-id="<?php echo $opcion->id ?>" class="form-control opcion-input"
												   name="<?php echo $opcion->opcion ?>" type="color"
												   value="<?php echo $opcion->valor ?>">
										</div>
									</div>
								</div>
							<?php }
						} ?>
					</div>
				</div>
				<div class="col-md-12 mt-2">
					<button class="btn btn-lg btn-primary btn-guardar-pagina">Guardar</button>
				</div>
			</div>
		</div>
	</div>

</div>

<script>

	$(document).ready(function () {

		$('.btn-guardar-pagina').on('click', function (e) {

			e.preventDefault();

			$('.opcion-input').each(function () {
				var val = $(this).val();
				var id = $(this).data('id');

				$.ajax({
					url: BASE_URL + 'avanzada/editar_input',
					data: {val: val, id: id},
					dataType: 'json',
					type: 'post',
					success: function (data) {
						if (data.result == "success") {
							swal.fire("Confirmado", data.mensaje, "success");
							loading.hide();
						}
					},
					error: function () {
						swal.fire("Error", "Error al intentar modificar las opciones", "error");
						loading.hide();
					}
				});
			});

		});

	});
</script>
