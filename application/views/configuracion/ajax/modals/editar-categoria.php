<h3 class="mb-4">Editar categoría</h3>
<form method="post" id="frm-edit-categoria">
	<input class="form-control" type="hidden" name="id" value="<?php echo $categoria->id?>">
	<div class="form-group mt-1">
		<label>Nombre</label>
		<input class="form-control" type="text" name="nombre" placeholder="Nombre de la categoria" value="<?php echo $categoria->nombre ?>" required>
	</div>
	<div class="form-group">
		<label>Descripción</label>
		<textarea class="form-control" rows="4" name="descripcion"><?php echo $categoria->descripcion ?></textarea>
	</div>
	<div class="form-group">
		<label>Estado</label>
		<div class="row mb-0">
			<div class="col-12">
				<label class="custom-control custom-radio custom-control-inline">
					<input class="custom-control-input" type="radio" name="activo" value="1" <?php echo ($categoria->activo == 1) ? 'checked' : '' ?>><span class="custom-control-label custom-control-color">Activo</span>
				</label>
				<label class="custom-control custom-radio custom-control-inline">
					<input class="custom-control-input" type="radio" name="activo" value="0" <?php echo ($categoria->activo == 0) ? 'checked' : '' ?>><span class="custom-control-label custom-control-color">No activo</span>
				</label>
			</div>
		</div>
	</div>
	<div class="form-group mt-1">
		<label>Categoria superior</label>
		<select class="form-control" name="id_padre">
			<option>Ninguna</option>
			<?php foreach ($categorias as $categoria_todas){ ?>
				<option <?php echo ($categoria->id_padre == $categoria_todas->id) ? 'selected' : '' ?> style="<?php echo ($categoria->id == $categoria_todas->id) ? 'display:none' : '' ?>" value="<?php echo $categoria_todas->id ?>"><?php echo $categoria_todas->nombre ?></option <?php echo ($categoria->id_padre == $categoria_todas->id) ? 'selected' : '' ?> >
			<?php } ?>
		</select>
	</div>
</form>
<div class="mt-6">
	<button class="btn btn-sm btn-space btn-secondary" type="button" data-dismiss="modal">Cerrar</button>
	<button class="btn btn-sm btn-space btn-primary" type="submit" form="frm-edit-categoria">Editar</button>
</div>

<script>

	$('#frm-edit-categoria').submit(function (e) {

		e.preventDefault();

		$.ajax({
			url : BASE_URL + 'configuracion/ajax_editar_categoria',
			dataType: 'json',
			type : 'post',
			data : $(this).serialize(),
			success : function (data) {
				if( data.result == "success") {
					swal.fire("Confirmado", "Categoría modificada", "success");
					$('.table-categorias').html(data.html);
					$('#frm-edit-categoria').trigger('reset');
					$('#md-edit').modal('hide');
					return;
				}
			},
			error : function () {
				swal.fire("Error","Se ha producido un error","error");
			}
		})
	});

</script>
