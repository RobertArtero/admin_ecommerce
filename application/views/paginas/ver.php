<div class="content p-0">
	<?php $this->load->view("base/buscador"); ?>

	<div class="content-body">
		<div class="container pd-x-0">
			<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
				<div>
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb breadcrumb-style1 mg-b-10">
							<li class="breadcrumb-item"><a href="<?php echo base_url(__class()); ?>">Paginas</a></li>
							<li class="breadcrumb-item"><a href="<?php echo base_url(__class()); ?>">Listado</a></li>
							<li class="breadcrumb-item active" aria-current="page"><?php echo $pagina->titulo ?></li>
						</ol>
					</nav>
					<h4 class="mg-b-0 tx-spacing--1 titulo-header-actualizar"><?php echo $pagina->titulo; ?>
					</h4>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<?php $this->load->view("paginas/submenu", array("activo" => "pagina")); ?>
				</div>
				<div class="col-md-12 mt-2">
					<div class="card">
						<div class="card-body">
							<label class="label font-weight-bold">Título</label>
							<input id="titulo" type="text" class="form-control input-lg"
								   value="<?php echo $pagina->titulo; ?>" placeholder="Título de la página">
						</div>
					</div>
					<div class="card mt-2">
						<div class="card-body">
							<label class="label font-weight-bold">Contenido</label>
							<div id="contenido" class="ht-sm-300"
								 style="height:500px;"><?php echo $pagina->contenido ?></div>
						</div>
					</div>
					<div class="card mt-2">
						<div class="card-body">
							<label class="label font-weight-bold">Estado</label>
							<div class="custom-control custom-switch">
								<input type="checkbox" class="custom-control-input activo"
									   id="customSwitch1" <?php echo ($pagina->activo == 1) ? "checked" : ""; ?>>
								<label class="custom-control-label"
									   for="customSwitch1"><?php echo ($pagina->activo) ? "Activo" : "No activo"; ?></label>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row mt-3">
				<div class="col-md-10">
					<button class="btn btn-lg btn-primary btn-guardar-pagina">Guardar</button>
				</div>
				<div class="col-md-2">
					<button class="btn btn-lg btn-danger btn-eliminar-pagina">Eliminar</button>
				</div>
			</div>
		</div>
	</div>
</div>
</div>

<script>

	var quill2 = "";

	$(document).ready(function () {

		var loading = $(".loading");

		var $id = '<?php echo $pagina->id; ?>';

		var toolbarOptions = [
			['bold', 'italic', 'underline', 'strike'], // toggled buttons
			[{
				'header': 1
			}, {
				'header': 2
			}], // custom button values
			[{
				'size': ['small', false, 'large', 'huge']
			}], // custom dropdown
			[{
				'header': [1, 2, 3, 4, 5, 6, false]
			}],
			[{
				'color': []
			}, {
				'background': []
			}], // dropdown with defaults from theme
			[{
				'align': []
			}],
		];

		quill2 = new Quill('#contenido', {
			modules: {
				toolbar: toolbarOptions
			},
			placeholder: 'Añadir contenido',
			theme: 'snow'
		});

		$(".btn-guardar-pagina").on("click", function (e) {

			e.preventDefault();

			var $titulo = $("#titulo").val();
			var $contenido = quill2.container.firstChild.innerHTML;
			var $activo = $(".activo").is(":checked");

			loading.show();

			$.ajax({
				url: BASE_URL + 'paginas/ajax_modificar',
				method: 'post',
				dataType: 'json',
				data: {
					id: $id,
					titulo: $titulo,
					contenido: $contenido,
					activo: $activo
				},
				success: function (data) {

					if (data.result == "success") {
						$(".titulo-header-actualizar").html($titulo);
						swal.fire("Confirmado", data.mensaje, "success");
						loading.hide();
					} else {
						swal.fire("Error", data.mensaje, "error");
						loading.hide();
					}
				},
				error: function () {
					swal.fire("Error", "Error al intentar modificar la página", "error");
					loading.hide();
				}

			});

		});

		$(".btn-eliminar-pagina").on("click", function (e) {
			e.preventDefault();

			Swal.fire({
				title: 'Estás seguro?',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Sí'
			}).then((result) => {
				if (result.value) {
					$.ajax({
						url: BASE_URL + 'paginas/ajax_eliminar',
						method: 'post',
						dataType: 'json',
						data: {
							id: $id,
						},
						success: function (data) {

							if (data.result == "success") {
								window.location.replace(BASE_URL + 'paginas')
							} else {
								swal.fire("Error", data.mensaje, "error");
								loading.hide();
							}
						},
						error: function () {
							swal.fire("Error", "Error al intentar modificar la página", "error");
							loading.hide();
						}

					});
				}
			});
		});

	});

</script>
