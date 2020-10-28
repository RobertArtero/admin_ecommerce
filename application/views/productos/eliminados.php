<div class="content p-0">
	<?php $this->load->view("base/buscador"); ?>

	<div class="content-body">
		<div class="container pd-x-0">
			<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
				<div>
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb breadcrumb-style1 mg-b-10">
							<li class="breadcrumb-item"><a href="<?php echo base_url(__class()); ?>">Productos</a></li>
							<li class="breadcrumb-item active" aria-current="page">Eliminados</li>
						</ol>
					</nav>
					<h4 class="mg-b-0 tx-spacing--1">Listado de productos eliminados</h4>
				</div>
			</div>
			<div class="row row-xs">
				<div class="col-md-12 mb-3">
					<?php $this->load->view("productos/submenu_listado",array("activo"=>"eliminados")); ?>
				</div>
			</div>
			<div class="row row-xs">

				<div class="col-md-12 mt-2">
					<div class="card card-body">
						<form method="get" id="buscador" action="<?php base_url("pedidos/eliminados") ?>">
							<div class="row">
								<div class="col-md-12 mt-1">
									<label>Buscar</label>
									<input type="text" class="form-control" placeholder="Buscar" name="b" value="<?php echo strip_tags($this->input->get("b")); ?>">
								</div>
								<div class="col-md-12 mt-3">
									<input type="submit" class="btn btn-primary mr-2" value="Filtrar listado">
									<a href="<?php echo base_url("productos/eliminados"); ?>" class="btn btn-transparent border mr-2">Quitar filtros</a>
									<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#mdl-nuevo-producto">Nuevo</button>
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
					<div class="card card-body">
						<div class="table-responsive">
							Total registro: <span class="badge badge-secondary"><?php echo $total; ?></span>
							<table class="table table-hover table-bordered table-striped mt-2">
								<tbody>
								<thead>
								<tr>
									<td class="py-3">Nombre</td>
									<td class="py-3">Descripción</td>
									<td class="py-3">Estado</td>
									<td class="py-3">Acciones</td>
								</tr>
								</thead>
								</thead>
								<tbody>
								<?php if ($productos) {
									foreach ($productos as $p) {
										?>
										<tr>
											<td class="py-3 font-weight-bold"><a href="<?php echo base_url("/productos/ver/" . $p->id); ?>" class=""><?php echo $p->nombre; ?></a></td>
											<td class="py-3"><?php echo ($p->descripcion) ? __acortar($p->descripcion, 50) : "Sin descripción"; ?></td>
											<td class="py-3"><?php echo ($p->eliminado == 1) ? "<span class='badge badge-danger'>Eliminado</span>" :'' ?></td>
											<td class="p-1"><a href="<?php echo base_url("/productos/ver/" . $p->id); ?>" class="btn btn-transparent border btn-block">Ver</a></td>
										</tr>
									<?php }
								} ?>
								</tbody>
							</table>
							Total registro: <span class="badge badge-secondary"><?php echo $total; ?></span>
						</div>
						<?php echo $paginacion; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="mdl-nuevo-producto" tabindex="-1" role="dialog" aria-labelledby="mdl-nuevo-producto" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Nuevo producto</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<label class="label font-weight-bold">Nombre del producto</label>
				<input id="nombre-nuevo-producto" type="text" class="form-control input-lg" placeholder="Nombre">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary btn-crear-nuevo-producto">Crear</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(function() {

		<?php if (!empty($this->input->get("fecha_inicio")) and !empty($this->input->get("fecha_final"))) { ?>

		var start = moment('<?php echo $this->input->get("fecha_inicio"); ?>');
		var end = moment('<?php echo $this->input->get("fecha_final"); ?>');

		<?php } else { ?>

		var start = moment();
		var end = moment();

		<?php } ?>

		function cb(start, end) {

			$('#reportrange span').html(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));

			$("#fecha_inicio").val(start.format('YYYY-MM-DD'));
			$("#fecha_final").val(end.format('YYYY-MM-DD'));

		}

		function cb_send(start, end) {
			cb(start, end);
			$("#buscador").submit()[0];
		}

		$('#reportrange').daterangepicker({
			startDate: start,
			endDate: end,
			locale: {

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
				'Mañana': [moment().add(1, 'days'), moment().add(1, 'days')],

				'Últimos 7 días': [moment().subtract(6, 'days'), moment()],
				'Últimos 30 días': [moment().subtract(29, 'days'), moment()],
				'Este mes': [moment().startOf('month'), moment().endOf('month')],
				'Mes pasado': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
			}
		}, cb_send);

		cb(start, end);

		$('.btn-crear-nuevo-producto').on('click', function() {
			var $nombre = $('#nombre-nuevo-producto').val();

			loading.show();

			$.ajax({
				url: BASE_URL + 'productos/ajax_crear_producto',
				method: 'post',
				dataType: 'text',
				data: {
					nombre: $nombre
				},
				success: function(data) {
					var $resultado = $.trim(data);
					if ($.trim($resultado) > 0) {
						window.location.href = BASE_URL + "productos/ver/" + $resultado;
					} else if ($resultado == 0) {
						swal.fire("Error", "Se ha producido un error", "error");
						loading.hide();
					}
				},
				error: function() {
					swal.fire("Error", "Error al intentar modificar el producto", "error");
					loading.hide();
				}

			});
		});

	});
</script>
