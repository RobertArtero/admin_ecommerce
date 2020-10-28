<div class="content p-0">
	<?php $this->load->view("base/buscador"); ?>

	<div class="content-body">
		<div class="container pd-x-0">
			<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
				<div>
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb breadcrumb-style1 mg-b-10">
							<li class="breadcrumb-item"><a href="<?php echo base_url(__class()); ?>">Marketing</a></li>
							<li class="breadcrumb-item active" aria-current="page">Cupones</li>
						</ol>
					</nav>
				</div>
			</div>
			<div class="row row-xs">
				<div class="col-md-12 mb-3">
					<?php $this->load->view("marketing/submenu", array("activo" => "cupones")); ?>
				</div>
			</div>
			<div class="row row-xs">
				<div class="col-md-12 mt-2">
					<div class="card card-body">
						<form method="get" action="<?php base_url("marketing/cupones") ?>">
							<div class="row">
								<div class="col-md-12 my-2">
									<label>Buscar</label>
									<input type="text" class="form-control" placeholder="Buscar" name="b"
										   value="<?php echo strip_tags($this->input->get("b")); ?>">
								</div>

								<div class="col-md-12 mt-3">
									<input type="submit" class="btn btn-primary mr-2" value="Filtrar listado">
									<a href="<?php echo base_url("marketing/cupones"); ?>"
									   class="btn btn-transparent border mr-2">Quitar filtros</a>
									<button type="button" class="btn btn-primary" data-toggle="modal"
											data-target="#modal-nuevo-cupon">Nuevo
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
				<?php if ($this->input->get()) { ?>
					<div class="col-md-12 text-center font-weight-bold">
						<div class="alert alert-success">Filtros activados</div>
					</div>
				<?php } ?>
				<div class="col-md-12 mt-2">
					<div class="card card-body table-cupon">
						<?php
						$data['cupones'] = $cupones;
						echo $this->load->view('marketing/ajax/table-cupones', $data, true);
						?>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>

<div class="modal fade" id="modal-nuevo-cupon" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<h3 class="mb-4">Nuevo cupón</h3>
				<form method="post" id="frm-add-cupon">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Código*</label>
								<input class="form-control" type="number" name="codigo" placeholder="Código del cupón"
									   required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Nombre*</label>
								<input class="form-control" type="text" name="nombre" placeholder="Nombre del cupón"
									   required>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label>Descripción</label>
						<textarea class="form-control" name="descripcion"
								  placeholder="Descripción del cupon"></textarea>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Tipo</label>
								<select class="form-control" name="tipo">
									<option value="descuento">Descuento</option>
									<option value="fijo">Fijo</option>
									<option value="producto">Producto</option>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Descuento</label>
								<input class="form-control" type="number" name="descuento"
									   placeholder="Descuento del cupón" min="0">
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
					<button class="btn btn-sm btn-space btn-secondary" type="button" data-dismiss="modal">Cerrar
					</button>
					<button class="btn btn-sm btn-space btn-primary" type="submit" form="frm-add-cupon">Crear</button>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="md-edit" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body content-edit">

			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(function() {


		<?php if(!empty($this->input->get("fecha_inicio")) and !empty( $this->input->get("fecha_final") )){ ?>

		var start = moment('<?php echo $this->input->get("fecha_inicio"); ?>');
		var end = moment('<?php echo $this->input->get("fecha_final"); ?>');

		<?php }else{ ?>

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
	$(document).ready(function () {

		$('#frm-add-cupon').submit(function (e) {

			e.preventDefault();

			$.ajax({
				url: BASE_URL + 'marketing/ajax_crear_cupon',
				dataType: 'json',
				type: 'POST',
				data: $(this).serialize(),
				success: function (data) {
					if (data.result == "success") {
						swal.fire("Confirmado", "Cupón creado", "success");
						$('.table-cupon').html(data.html);
						$('#frm-add-cupon').trigger('reset');
						$('#modal-nuevo-cupon').modal('hide');
					}
				},
				error: function () {
					swal.fire("Error", "Se ha producido un error", "error");
				}
			});

		});

		$(document).on('click', '.btn-edit', function () {

			var id = $(this).data('id');

			$.ajax({
				url: BASE_URL + 'marketing/ajax_modal_cupon',
				dataType: 'json',
				type: 'post',
				data: {id: id},
				success: function (data) {
					if (data.result == "success") {
						$('.content-edit').html(data.html);
						$('#md-edit').modal('show');
						return;
					}
				},
				error: function () {
					swal.fire("Error", "error");
				}
			})
		});

	});
</script>
