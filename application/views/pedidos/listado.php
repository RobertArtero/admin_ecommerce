
<div class="content p-0">
	<?php $this->load->view("base/buscador"); ?>

	<div class="content-body">
		<div class="container pd-x-0">
			<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
				<div>
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb breadcrumb-style1 mg-b-10">
							<li class="breadcrumb-item"><a href="<?php echo base_url(__class()); ?>">Pedidos</a></li>
							<li class="breadcrumb-item active" aria-current="page">Listado</li>
						</ol>
					</nav>
					<h4 class="mg-b-0 tx-spacing--1">Listado de pedidos</h4>
				</div>
			</div>

			<div class="row row-xs">
				<div class="col-sm-6 col-lg-3 mt-2">
					<div class="card card-body">
						<h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8">Pedidos hoy</h6>
						<div class="d-flex d-lg-block d-xl-flex align-items-end">
							<h3 class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1"><?php echo $hoy->total_pedidos ?></h3>
						</div>
					</div>
				</div>

				<div class="col-sm-6 col-lg-3 mt-2">
					<div class="card card-body">
						<h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8">Pedidos mes</h6>
						<div class="d-flex d-lg-block d-xl-flex align-items-end">
							<h3 class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1"><?php echo $mes->total_pedidos ?></h3>
						</div>
					</div>
				</div>

				<div class="col-sm-6 col-lg-3 mt-2">
					<div class="card card-body">
						<h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8">Pedidos totales</h6>
						<div class="d-flex d-lg-block d-xl-flex align-items-end">
							<h3 class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1"><?php echo $total_c->total_pedidos ?></h3>
						</div>
					</div>
				</div>

				<div class="col-sm-6 col-lg-3 mt-2">
					<div class="card card-body">
						<h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8">Facturación total</h6>
						<div class="d-flex d-lg-block d-xl-flex align-items-end">
							<h3 class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1"><?php echo __dinero($total_c->total_facturacion); ?></h3>
						</div>
					</div>
				</div>

				<div class="col-md-12 mt-2">
					<div class="card card-body">
						<form method="get" id="buscador" action="<?php base_url("pedidos/listado") ?>">
							<div class="row">
								<div class="col-md-4 mt-1">
									<label>Buscar</label>
									<input type="text" class="form-control" placeholder="Buscar" name="b" value="<?php echo strip_tags($this->input->get("b")); ?>">
								</div>
								<div class="col-md-4 mt-1">

									<label>Fecha pedido</label>

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
								<div class="col-md-2 mt-1">
									<label>No pagados</label>
									<div class="custom-control custom-switch">
										<input type="checkbox" class="custom-control-input" id="customSwitch1" name="no_pagado" <?php echo ($this->input->get("no_pagado") == "on")? "checked":"";  ?>>
										<label class="custom-control-label" for="customSwitch1">Activar</label>
									</div>
								</div>
								<div class="col-md-2 mt-1">
									<label>Solo activos</label>
									<div class="custom-control custom-switch">
										<input type="checkbox" class="custom-control-input" id="customSwitch2" name="solo_activos" <?php echo ($this->input->get("solo_activos") == "on")? "checked":"";  ?>>
										<label class="custom-control-label" for="customSwitch2">Activar</label>
									</div>
								</div>
								<div class="col-md-12 mt-3">
									<input type="submit" class="btn btn-primary mr-2" value="Filtrar listado">
									<a href="<?php echo base_url("pedidos/listado"); ?>" class="btn btn-transparent border">Quitar filtros</a>
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
							Total registro: <span class="badge badge-secondary"><?php echo $total; ?></span> <?php echo ($this->input->get()) ? "Facturación <span class=\"badge badge-secondary\">" . __dinero($total_facturacion_filtro->total_facturacion) . "</span>" : ""; ?>

							<table class="table table-hover table-bordered table-striped mt-2">
								<tbody>
								<thead>
									<tr>
										<td class="py-3">Nº</td>
										<td class="py-3">Nombre</td>
										<td class="py-3">Teléfono</td>
										<td class="py-3">Nº Productos</td>
										<td class="py-3">Pedidos</td>
										<td class="py-3">Fecha Entrega</td>
										<td class="py-3">Estado</td>
										<td class="py-3">Pago</td>
										<td class="py-3">Acciones</td>
									</tr>
								</thead>
								</thead>
								<tbody>
								<?php if($pedidos){
									foreach($pedidos as $p){
									?>
									<tr>
										<td class="py-3 font-weight-bold"><a href="<?php echo base_url("/pedidos/ver/" . $p->id); ?>" class="btn btn-transparent border btn-block"><?php echo $p->id; ?></a></td>
										<td class="py-3 font-weight-bold">
											<?php echo ($p->id_usuario) ? "<i class='d-none d-sm-inline' data-feather='user'></i>
											<a href='".base_url("/clientes/ver/" . $p->id_usuario)." '> " . __pm(__cliente($p->id_usuario)->nombre) : __pm($p->nombre); ?></a>
										</td>
										<td class="py-3"><?php echo $p->telefono; ?></td>

										<td class="py-3"><?php echo "<i data-feather=\"box\"></i> " . $p->total_productos; ?></td>
										<td class="py-3"><?php echo __dinero($p->total_pedido); ?></td>
										<td class="font-weight-bold py-3"><?php echo __fecha($p->fecha_entrega,"Y-m-d"); ?></td>
										<td class="py-3"><?php echo ($p->activo) ? "<span class='badge badge-success'>Activo</span>" : "<span class='badge badge-danger'>No activo</span>"; ?></td>
										<td class="py-3"><?php echo ($p->pagado) ? "<span class='badge badge-success'>Pagado</span>" : "<span class='badge badge-danger'>No pagado</span>"; ?></td>
										<td class="p-1"><a href="<?php echo base_url("/pedidos/ver/" . $p->id); ?>" class="btn btn-transparent border btn-block">Ver</a></td>
									</tr>
								<?php }
								}?>
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
