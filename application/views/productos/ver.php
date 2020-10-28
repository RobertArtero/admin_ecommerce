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
						</ol>
					</nav>
					<h4 class="mg-b-0 tx-spacing--1 titulo-header-actualizar"><?php echo $producto->nombre; ?>
					</h4>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<?php $this->load->view("productos/submenu", array("activo" => "productos")); ?>
				</div>
				<div class="col-md-6 mt-2">
					<div class="card">
						<div class="card-header">
							Detalles
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-bordered">
									<tbody>
									<tr>
										<td class="font-weight-bold">Fecha creación</td>
										<td><?php echo ($producto->fecha_creacion) ? __fecha($producto->fecha_creacion, "Y-m-d H:i:s", true) : "Sin definir"; ?></td>
									</tr>
									<tr>
										<td class="font-weight-bold">Fecha modificación</td>
										<td><?php echo ($producto->fecha_modificacion) ? __fecha($producto->fecha_modificacion, "Y-m-d H:i:s", true) : "Sin definir"; ?></td>
									</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="card mt-2">
						<div class="card-body text-center">
							<?php
							if (__existe_fichero($this->config->item("imagenes_url") . $producto->fotografia)) { ?>
								<img class="img-fluid imagen-principal-producto"
									 src="<?php echo $this->config->item("imagenes_url") ?><?php echo $producto->fotografia; ?>">
							<?php } else { ?>
								<img class="img-fluid imagen-principal-producto"
									 src="<?php echo base_url("assets/img/default.jpg") ?>">
							<?php } ?>
							<input type="hidden" id="fotografia_producto_envio"
								   value="<?php echo $producto->fotografia ?>">
							<div class="progress loading-imagen-container" style="display:none;">
								<div class="progress-bar bg-primary progress-bar-striped progress-bar-animated loading-imagen"
									 role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
							<div class="custom-file mt-2 fotografia-producto-container">
								<input type="file" class="custom-file-input" id="fotografia_producto">
								<label class="custom-file-label" for="customFile">Fotografía</label>
							</div>
						</div>
					</div>
					<div class="card mt-2">
						<div class="card-body">
							<label class="label font-weight-bold">Categoría principal</label>
							<select name="categoria_principal" id="categoria_principal" class="form-control input-lg">
								<option value="">Seleccionar una categoria</option>
								<?php
								if ($categorias) {
									foreach ($categorias as $cat) { ?>
										<option value="<?php echo $cat->id; ?>" <?php echo ($producto->id_categoria == $cat->id) ? "selected" : ""; ?>><?php echo $cat->nombre; ?></option>
									<?php }
								} ?>
							</select>
						</div>
					</div>
					<div class="card mt-2">
						<div class="card-body">
							<label class="label font-weight-bold">Más vendido</label>
							<div class="custom-control custom-switch">
								<input type="checkbox" class="custom-control-input mas-vendido-producto"
									   id="customSwitch2" <?php echo ($producto->mas_vendido) ? "checked" : ""; ?>>
								<label class="custom-control-label"
									   for="customSwitch2"><?php echo ($producto->mas_vendido) ? "Si" : "No"; ?></label>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6 mt-2">
					<div class="card">
						<div class="card-body">
							<label class="label font-weight-bold">Nombre</label>
							<input id="nombre" type="text" class="form-control input-lg"
								   value="<?php echo $producto->nombre; ?>" placeholder="Nombre">
						</div>
					</div>
					<div class="card mt-2">
						<div class="card-body">
							<label class="label font-weight-bold">Descripción</label>
							<div id="descripcion" class="ht-sm-300"
								 style="height:200px;"><?php echo $producto->descripcion ?></div>
						</div>
					</div>
					<div class="card mt-2">
						<div class="card-body">
							<label class="label font-weight-bold">Alergenos</label>
							<input id="alergenos" type="text" class="form-control input-lg"
								   value="<?php echo $producto->alergenos; ?>" placeholder="Alergenos">
						</div>
					</div>
					<div class="card mt-2">
						<div class="card-body">
							<label class="label font-weight-bold">Orden</label>
							<input id="orden" type="text" class="form-control input-lg"
								   value="<?php echo $producto->orden; ?>" placeholder="Orden">
						</div>
					</div>
					<div class="card mt-2">
						<div class="card-body">
							<label class="label font-weight-bold">Precio</label>
							<input id="precio" type="text" name="cantidad" class="form-control input-lg"
								   value="<?php echo __dinero($producto->precio, false); ?>" placeholder="Precio">
						</div>
					</div>
					<div class="card mt-2">
						<div class="card-body">
							<label class="label font-weight-bold">Estado</label>
							<div class="custom-control custom-switch">
								<input type="checkbox" class="custom-control-input estado-producto"
									   id="customSwitch1" <?php echo ($producto->activo) ? "checked" : ""; ?>>
								<label class="custom-control-label"
									   for="customSwitch1"><?php echo ($producto->activo) ? "Activo" : "No activo"; ?></label>
							</div>
						</div>
					</div>
					<div class="row mt-3">
						<div class="col-md-12">
							<button class="btn btn-lg btn-primary btn-guardar-producto">Guardar</button>
							<?php if ($producto->eliminado == 0) { ?>
								<button type="button" class="btn btn-danger btn-lg btn-eliminar-producto">Eliminar
								</button>
							<?php } else { ?>
								<button type="button" class="btn btn-success btn-lg btn-recuperar-producto">Recuperar
								</button>
							<?php } ?>
						</div>
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
		var $id = '<?php echo $producto->id; ?>';

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

		quill2 = new Quill('#descripcion', {
			modules: {
				toolbar: toolbarOptions
			},
			placeholder: 'Añadir descripcion',
			theme: 'snow'
		});

		$("#fotografia_producto").on("change", function () {

			var fd = new FormData();
			var files = $(this)[0].files[0];
			fd.append('fichero', files);
			fd.append('id', $id)

			$.ajax({
				xhr: function () {

					$(".loading-imagen-container").show();
					$(".fotografia-producto-container").hide();
					var xhr = new window.XMLHttpRequest();

					xhr.upload.addEventListener("progress", function (evt) {
						if (evt.lengthComputable) {
							var percentComplete = evt.loaded / evt.total;
							$(".loading-imagen").css("width", (percentComplete * 100) + "%");
						}
					}, false);

					xhr.addEventListener("progress", function (evt) {
						if (evt.lengthComputable) {
							var percentComplete = evt.loaded / evt.total;
							$(".loading-imagen").css("width", (percentComplete * 100) + "%");
						}
					}, false);

					return xhr;
				},
				url: BASE_URL + 'productos/ajax_subir_imagen',
				type: "post",
				dataType: "json",
				data: fd,
				cache: false,
				contentType: false,
				processData: false,
				success: function (data) {

					if (data.result == "success") {
						$(".imagen-principal-producto").attr("src", data.data.url);
						$("#fotografia_producto_envio").val(data.data.fichero);

					} else {
						swal.fire('Error', data.mensaje, 'error');
					}

				}
			})
					.done(function (res) {
						$("#mensaje").html("Respuesta: " + res);
						$(".loading-imagen-container").hide();
						$(".fotografia-producto-container").show();

					});

		});

		$('[name="cantidad"]').keyup(function (e) {


			var cantidad = $('[name="cantidad"]').val();


			$(this).val($(this).val().replace(".", ","));
			$(this).val($(this).val().replace(",,", ""));

			if (!$.isNumeric(e.key) && e.key != ",") {
				$(this).addClass("not-good");
				$(this).val($(this).val().replace(e.key, ""));
			}

			if (e.key == "'") {
				$(this).addClass("not-good");
				$(this).val($(this).val().replace(e.key, ""));
			}

			if ($(this).val().length > 10) {
				$(this).addClass("not-good");
				$(this).val($(this).val().replace(e.key, ""));
			}

			var doble_decimal = $(this).val().split(',');

			if (doble_decimal[1] != undefined) {

				console.log("doble_decimal");
				var t = doble_decimal[1].substring(0, 2);

				if (doble_decimal[1].length > 2) {
					$(this).addClass("not-good");
				}

				$(this).val(doble_decimal[0].concat(',' + t));
			}

			window.setTimeout(function () {
				$(".not-good").removeClass("not-good");
			}, 1000);

		});

		$(".btn-guardar-producto").on("click", function () {

			var $nombre = $("#nombre").val();
			var $descripcion = quill2.container.firstChild.innerHTML;
			var $alergenos = $("#alergenos").val();
			var $orden = $("#orden").val();
			var $precio = $("#precio").val();
			var $estado_producto = $(".estado-producto").is(":checked");
			var $imagen_principal = $("#fotografia_producto_envio").val();
			var $categoria_principal = $("#categoria_principal").val();
			var $mas_vendido = $(".mas-vendido-producto").is(":checked");

			loading.show();

			$.ajax({
				url: BASE_URL + 'productos/ajax_modificar',
				method: 'post',
				dataType: 'json',
				data: {

					id: $id,
					nombre: $nombre,
					descripcion: $descripcion,
					alergeno: $alergenos,
					orden: $orden,
					precio: $precio,
					estado_producto: $estado_producto,
					imagen_principal: $imagen_principal,
					categoria_principal: $categoria_principal,
					mas_vendido: $mas_vendido

				},
				success: function (data) {

					if (data.result == "success") {
						$(".titulo-header-actualizar").html($nombre);
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

		$('.btn-eliminar-producto').on('click', function () {
			Swal.fire({
				title: 'Estás seguro?',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Si, eliminar!'
			}).then((result) => {
				if (result.value) {
					$.ajax({
						url: BASE_URL + 'productos/ajax_eliminar',
						method: 'post',
						dataType: 'json',
						data: {
							id: $id,
						},
						success: function (data) {

							if (data.result == "success") {
								loading.hide();
								window.location.reload();
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
				}
			})
		});

		$('.btn-recuperar-producto').on('click', function () {
			Swal.fire({
				title: 'Estás seguro?',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Si, recuperar!'
			}).then((result) => {
				if (result.value) {
					$.ajax({
						url: BASE_URL + 'productos/ajax_recuperar',
						method: 'post',
						dataType: 'json',
						data: {
							id: $id,
						},
						success: function (data) {

							if (data.result == "success") {
								loading.hide();
								window.location.reload();
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
				}
			})
		});

	});
</script>
