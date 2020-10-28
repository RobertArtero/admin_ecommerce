<h3 class="mb-4">Editar código postal</h3>
<form method="post" id="frm-edit-cp">
	<input class="form-control" type="hidden" name="id" value="<?php echo $codigo_postal->id ?>">
	<div class="form-group mt-1">
		<label>Número</label>
		<input class="form-control" type="text" name="codigo_postal" placeholder="Código postal"
			   value="<?php echo $codigo_postal->codigo_postal ?>" required>
	</div>
	<div class="form-group">
		<label>Estado</label>
		<div class="row mb-0">
			<div class="col-12">
				<label class="custom-control custom-radio custom-control-inline">
					<input class="custom-control-input" type="radio" name="activo"
						   value="1" <?php echo ($codigo_postal->activo == 1) ? 'checked' : '' ?>><span
							class="custom-control-label custom-control-color">Activo</span>
				</label>
				<label class="custom-control custom-radio custom-control-inline">
					<input class="custom-control-input" type="radio" name="activo"
						   value="0" <?php echo ($codigo_postal->activo == 0) ? 'checked' : '' ?>><span
							class="custom-control-label custom-control-color">No activo</span>
				</label>
			</div>
		</div>
	</div>
</form>
<div class="mt-6">
	<button class="btn btn-sm btn-space btn-secondary" type="button" data-dismiss="modal">Cerrar</button>
	<button class="btn btn-sm btn-space btn-primary" type="submit" form="frm-edit-cp">Editar</button>
	<button class="btn btn-sm btn-space btn-danger btn-delete-cp" data-id="<?php echo $codigo_postal->id ?>"
			type="button" data-dismiss="modal">Eliminar
	</button>
</div>

<script>

	$('#frm-edit-cp').submit(function (e) {

		e.preventDefault();

		$.ajax({
			url: BASE_URL + 'configuracion/ajax_editar_cp',
			dataType: 'json',
			type: 'post',
			data: $(this).serialize(),
			success: function (data) {
				if (data.result == "success") {
					swal.fire("Confirmado", "Código postal modificado", "success");
					$('.table-cp').html(data.html);
					$('#frm-edit-cp').trigger('reset');
					$('#md-edit').modal('hide');
					return;
				}
			},
			error: function () {
				swal.fire("Error", "Se ha producido un error", "error");
			}
		});
	});

	$('.btn-delete-cp').on("click", function (e) {

		e.preventDefault();

		var $id = $(this).data("id");

		Swal.fire({
			title: 'Estás seguro?',
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Sí, borrar!'
		}).then((result) => {
			if (result.value) {
				$.ajax({
					url: BASE_URL + 'configuracion/ajax_eliminar_cp',
					dataType: 'json',
					type: 'post',
					data: {
						id: $id
					},
					success: function (data) {
						if (data.result == "success") {
							swal.fire("Confirmado", "Código postal eliminado", "success");
							$('.table-cp').html(data.html);
							$('#frm-edit-cp').trigger('reset');
							$('#md-edit').modal('hide');
							return;
						}
					},
					error: function () {
						swal.fire("Error", "Se ha producido un error", "error");
					}
				});
			}
		});


	});

</script>
