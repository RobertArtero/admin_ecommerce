<div class="content p-0">
	<?php $this->load->view("base/buscador"); ?>

	<div class="content-body">
		<div class="container pd-x-0">
			<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
				<div>
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb breadcrumb-style1 mg-b-10">
							<li class="breadcrumb-item"><a href="<?php echo base_url(__class()); ?>">Clientes</a></li>
							<li class="breadcrumb-item active" aria-current="page">Listado</li>
						</ol>
					</nav>
					<h4 class="mg-b-0 tx-spacing--1">Listado de clientes</h4>
				</div>
				<div class="d-none d-md-block">
					<!--<button class="btn btn-sm pd-x-15 btn-primary btn-uppercase mg-l-5"><i data-feather="file" class="wd-10 mg-r-5"></i> Exportar</button> -->
				</div>
			</div>

			<div class="row row-xs">
				<div class="col-md-12 mt-2">
					<div class="card card-body">
						<form method="get" action="<?php base_url("clientes/listado") ?>">
							<div class="row">
								<div class="col-md-4 my-2">
									<label>Buscar</label>
									<input type="text" class="form-control" placeholder="Buscar" name="b" value="<?php echo strip_tags($this->input->get("b")); ?>">
								</div>
								<div class="col-md-4 mt-1">

									<label>Fecha de alta</label>

									<div class="custom-control custom-switch">
										<input type="checkbox" class="custom-control-input" id="filtrar_fecha" name="filtrar_fecha" <?php echo ($this->input->get("filtrar_fecha") == "on")? "checked":"";  ?>>
										<label class="custom-control-label" for="filtrar_fecha">Activar</label>
									</div>


									<div class="filtro-calendario" style="<?php echo (empty($this->input->get("filtrar_fecha"))) ? "display:none" : "display:block" ?>">
										<div id="reportrange"  name="rango_fecha" style="background: #fff; cursor: pointer; padding: 8px 12px; border: 1px solid #ccc; width: 100%">
											<i class="fa fa-calendar"></i>&nbsp;
											<span></span> <i class="fa fa-caret-down"></i>
										</div>
										<input type="hidden" id="fecha_inicio" name="fecha_inicio">
										<input type="hidden" id="fecha_final" name="fecha_final">
									</div>

								</div>
								<div class="col-md-4 mt-1">
									<label>Ver clientes</label>
									<div class="custom-control custom-switch">
										<input type="checkbox" class="custom-control-input" id="customSwitch1" name="activo" <?php echo ($this->input->get("no_pagado") == "on")? "checked":"";  ?>>
										<label class="custom-control-label" for="customSwitch1">No activos</label>
									</div>
								</div>
								<div class="col-md-4 mt-3">
									<input type="submit" class="btn btn-primary mr-2" value="Filtrar listado">
									<a href="<?php echo base_url("clientes/listado"); ?>" class="btn btn-transparent border">Quitar filtros</a>
								</div>
							</div>
						</form>
					</div>
				</div>
				<?php if($this->input->get()) { ?>
					<div class="col-md-12 text-center font-weight-bold">
						<div class="alert alert-success">Filtros activados</div>
					</div>
				<?php } ?>
				<div class="col-md-12 mt-2">
					<div class="card card-body">
						<div class="table-responsive">
							Total registro: <?php echo $total; ?>

							<table class="table table-hover table-bordered table-striped mt-3">
								<tbody>
								<thead>
									<tr>
										<td class="py-3">Nombre</td>
										<td class="py-3">Teléfono</td>
										<td class="py-3">Email</td>
										<td class="py-3">Nº Compras</td>
										<td class="py-3">Última conexión</td>
										<td class="py-3">Estado</td>
										<td class="py-3">Acciones</td>
									</tr>
								</thead>
								</thead>
								<tbody>
								<?php if($clientes){
									foreach($clientes as $c){
									?>
									<tr>
										<td class="py-3 font-weight-bold"><a href="<?php echo base_url("/clientes/ver/" . $c->id); ?>" class=""><?php echo __pm($c->nombre); ?></a></td>
										<td class="py-3"><?php echo $c->telefono; ?></td>
										<td class="py-3"><?php echo $c->email; ?></td>
										<td class="py-3"><i data-feather="shopping-bag"></i>  <?php echo __pedidos($c->id) ?></td>
										<td class="font-weight-bold py-3"><?php echo ($c->fecha_ultima_conexion) ? __fecha( $c->fecha_ultima_conexion,"Y-m-d H:i:s", true) : __fecha( $c->fecha_alta,"Y-m-d H:i:s", true); ?></td>
										<td class="py-3"><?php echo ($c->activo) ? "<span class='badge badge-success'>Activo</span>" : "<span class='badge badge-danger'>No activo</span>"; ?></td>
										<td class="p-1"><a href="<?php echo base_url("/clientes/ver/" . $c->id); ?>" class="btn btn-transparent border btn-block">Ver</a></td>
									</tr>
								<?php }
								}?>
								</tbody>
							</table>
							Total registro: <?php echo $total; ?>
						</div>
						<?php echo $paginacion; ?>
					</div>
				</div>
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
				'Hoy': [moment(), moment()],
				'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
				'Últimos 7 días': [moment().subtract(6, 'days'), moment()],
				'Últimos 30 días': [moment().subtract(29, 'days'), moment()],
				'Este mes': [moment().startOf('month'), moment().endOf('month')],
				'Mes pasado': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
			}
		}, cb);
		cb(start, end);

	});
</script>
