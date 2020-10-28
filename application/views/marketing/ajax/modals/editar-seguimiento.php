<h3 class="mb-4">Editar seguimiento</h3>
<form method="post" id="frm-edit-seguimiento">
	<input class="form-control" type="hidden" name="id" value="<?php echo $seguimiento->id ?>">
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label>Referéncia*</label>
				<input class="form-control" type="text" name="referencia" placeholder="Referéncia"
					   required value="<?php echo $seguimiento->referencia ?>">
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label>Nombre*</label>
				<input class="form-control" type="text" name="nombre" placeholder="Nombre del cupón"
					   required value="<?php echo $seguimiento->nombre ?>">
			</div>
		</div>
	</div>
	<div class="form-group">
		<label>Descripción</label>
		<textarea class="form-control" name="descripcion"
				  placeholder="Descripción del cupon"><?php echo $seguimiento->descripcion ?></textarea>
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label>Medio</label>
				<input class="form-control" type="text" name="medio" placeholder="Medio" value="<?php echo $seguimiento->medio ?>">
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label>UTM Source</label>
				<input class="form-control" type="text" name="utm_source" placeholder="UTM Source" value="<?php echo $seguimiento->utm_source ?>">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label>UTM Medium</label>
				<input class="form-control" type="text" name="utm_medium" placeholder="UTM Medium" value="<?php echo $seguimiento->utm_medium ?>">
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label>UTM Campaign</label>
				<input class="form-control" type="text" name="utm_campaign" placeholder="UTM Campaign" value="<?php echo $seguimiento->utm_campaign ?>">
			</div>
		</div>
	</div>
</form>
<div class="mt-6">
	<button class="btn btn-sm btn-space btn-secondary" type="button" data-dismiss="modal">Cerrar</button>
	<button class="btn btn-sm btn-space btn-primary" type="submit" form="frm-edit-seguimiento">Editar</button>
	<button class="btn btn-sm btn-space btn-danger btn-delete-seguimiento" data-id="<?php echo $seguimiento->id ?>" type="button"
			data-dismiss="modal">Eliminar
	</button>
</div>
<script>

	$('#frm-edit-seguimiento').submit(function (e) {

		e.preventDefault();

		$.ajax({
			url: BASE_URL + 'marketing/ajax_editar_seguimiento',
			dataType: 'json',
			type: 'post',
			data: $(this).serialize(),
			success: function (data) {
				if (data.result == "success") {
					swal.fire("Confirmado", "seguimiento modificado", "success");
					$('.table-seguimiento').html(data.html);
					$('#frm-edit-seguimiento').trigger('reset');
					$('#md-edit').modal('hide');
					return;
				}
			},
			error: function () {
				swal.fire("Error", "Se ha producido un error", "error");
			}
		});
	});

	$('.btn-delete-seguimiento').on("click", function (e) {

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
					url: BASE_URL + 'marketing/ajax_eliminar_seguimiento',
					dataType: 'json',
					type: 'post',
					data: {
						id: $id
					},
					success: function (data) {
						if (data.result == "success") {
							swal.fire("Confirmado", "Seguimiento eliminado", "success");
							$('.table-seguimiento').html(data.html);
							$('#frm-edit-seguimiento').trigger('reset');
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
