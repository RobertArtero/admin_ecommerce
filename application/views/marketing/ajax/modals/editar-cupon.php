<h3 class="mb-4">Editar código postal</h3>
<form method="post" id="frm-edit-cupon">
	<input class="form-control" type="hidden" name="id" value="<?php echo $cupon->id ?>">
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label>Código*</label>
				<input class="form-control" type="number" name="codigo" placeholder="Código del cupón"
					   value="<?php echo $cupon->codigo ?>" required>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label>Nombre*</label>
				<input class="form-control" type="text" name="nombre" placeholder="Nombre del cupón"
					   value="<?php echo $cupon->nombre ?>" required>
			</div>
		</div>
	</div>
	<div class="form-group">
		<label>Descripción</label>
		<textarea class="form-control" name="descripcion"
				  placeholder="Descripción del cupon"><?php echo $cupon->descripcion ?></textarea>
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label>Tipo</label>
				<select class="form-control" name="tipo">
					<option <?php echo ($cupon->tipo == "descuento") ? 'selected' : '' ?> value="descuento">Descuento
					</option>
					<option <?php echo ($cupon->tipo == "fijo") ? 'selected' : '' ?> value="fijo">Fijo</option>
					<option <?php echo ($cupon->tipo == "producto") ? 'selected' : '' ?> value="producto">Producto
					</option>
				</select>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label>Descuento</label>
				<input class="form-control" type="number" name="descuento" placeholder="Descuento del cupón" min="0"
					   value="<?php echo $cupon->descuento ?>">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label>Fecha inicio</label>
				<input class="form-control" type="date" name="fecha_inicio">
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label>Fecha final</label>
				<input class="form-control" type="date" name="fecha_final">
			</div>
		</div>
	</div>
</form>
<div class="mt-6">
	<button class="btn btn-sm btn-space btn-secondary" type="button" data-dismiss="modal">Cerrar</button>
	<button class="btn btn-sm btn-space btn-primary" type="submit" form="frm-edit-cupon">Editar</button>
	<button class="btn btn-sm btn-space btn-danger btn-delete-cupon" data-id="<?php echo $cupon->id ?>" type="button"
			data-dismiss="modal">Eliminar
	</button>
</div>

<script type="text/javascript">
	$(function() {


		<?php if(!empty($cupon->fecha_inicio) and !empty($cupon->fecha_final)){ ?>

		var start = moment('<?php echo $cupon->fecha_inicio; ?>');
		var end = moment('<?php echo $cupon->fecha_final; ?>');

		<?php } else{ ?>

		var start = moment();
		var end = moment();

		<?php } ?>

		function cb(start, end) {

			$('#reportrange span').html(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));

			$("#fecha_inicio").val(start.format('YYYY-MM-DD'));
			$("#fecha_final").val(end.format('YYYY-MM-DD'));

		}

		$("#filtrar_fecha").on("change",function(){

			var $filtrar_fecha  = $(this).is(":checked");

			if($filtrar_fecha == true){
				$(".filtro-calendario").css("display","block");
			}else{
				$(".filtro-calendario").css("display", "none");
			}


		});

		$('#reportrange').daterangepicker({
			startDate: start,
			endDate: end,
			locale : {

				"separator": " - ",
				"applyLabel": "Aplicar",
				"cancelLabel": "Cancelar",
				"fromLabel": "DE",
				"toLabel": "HASTA",
				"customRangeLabel": "Personalizado",
				"daysOfWeek": [
					"Dom",
					"Lun",
					"Mar",
					"Mie",
					"Jue",
					"Vie",
					"Sáb"
				],
				"monthNames": [
					"Enero",
					"Febrero",
					"Marzo",
					"Abril",
					"Mayo",
					"Junio",
					"Julio",
					"Agosto",
					"Septiembre",
					"Octubre",
					"Noviembre",
					"Diciembre"
				],
				"firstDay": 1
			},
			ranges: {
				'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
				'Hoy': [moment(), moment()],
				'Mañana' : [moment().add(1,'days'), moment().add(1,'days')],

				'Últimos 7 días': [moment().subtract(6, 'days'), moment()],
				'Últimos 30 días': [moment().subtract(29, 'days'), moment()],
				'Este mes': [moment().startOf('month'), moment().endOf('month')],
				'Mes pasado': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
			}
		}, cb);

		cb(start, end);

	});
</script>

<script>

	$('#frm-edit-cupon').submit(function (e) {

		e.preventDefault();

		$.ajax({
			url: BASE_URL + 'marketing/ajax_editar_cupon',
			dataType: 'json',
			type: 'post',
			data: $(this).serialize(),
			success: function (data) {
				if (data.result == "success") {
					swal.fire("Confirmado", "Cupón modificado", "success");
					$('.table-cupon').html(data.html);
					$('#frm-edit-cupon').trigger('reset');
					$('#md-edit').modal('hide');
					return;
				}
			},
			error: function () {
				swal.fire("Error", "Se ha producido un error", "error");
			}
		});
	});

	$('.btn-delete-cupon').on("click", function (e) {

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
					url: BASE_URL + 'marketing/ajax_eliminar_cupon',
					dataType: 'json',
					type: 'post',
					data: {
						id: $id
					},
					success: function (data) {
						if (data.result == "success") {
							swal.fire("Confirmado", "Cupón eliminado", "success");
							$('.table-cupon').html(data.html);
							$('#frm-edit-cupon').trigger('reset');
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
