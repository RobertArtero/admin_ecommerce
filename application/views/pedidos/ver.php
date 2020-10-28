<div class="content p-0">
	<?php $this->load->view("base/buscador"); ?>

	<div class="content-body">
		<div class="container pd-x-0">
			<div class="d-sm-flex align-items-center mg-b-20 mg-lg-b-25 mg-xl-b-30">
				<div class="col-md-8">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb breadcrumb-style1 mg-b-10">
							<li class="breadcrumb-item"><a href="<?php echo base_url(__class()); ?>">Pedidos</a></li>
							<li class="breadcrumb-item"><a href="<?php echo base_url(__class()); ?>">Listado</a></li>
							<li class="breadcrumb-item active" aria-current="page">Ver pedido</li>
						</ol>
					</nav>
					<h4 class="mg-b-0 tx-spacing--1">Ver pedido
						nº <?php echo $pedido->id ?> <?php echo ($pedido->pagado) ? "<span class='badge badge-success'>Pagado</span>" : "<span class='badge badge-danger'>No pagado</span>"; ?>
					</h4>
				</div>
				<div class="col-md-2">
					<?php if ($pedido->activo == 1) { ?>
						<div class="d-none d-md-block">
							<button data-activo="0" data-id="<?php echo $pedido->id ?>"
									class="btn btn-sm pd-x-15 btn-danger btn-uppercase mg-l-5 btn-desactivar-pedido"><i
										data-feather="alert-circle" class="wd-10 mg-r-5"></i> Desactivar
							</button>
						</div>

					<?php } else { ?>
						<div class="d-none d-md-block">
							<button data-activo="1" data-id="<?php echo $pedido->id ?>"
									class="btn btn-sm pd-x-15 btn-success btn-uppercase mg-l-5 btn-desactivar-pedido"><i
										data-feather="alert-circle" class="wd-10 mg-r-5"></i> Activar
							</button>
						</div>
					<?php } ?>
				</div>
				<div class="col-md-2">
					<div class="d-none d-md-block">
						<a href="<?php echo base_url('pedidos/pedido_pdf/' . $pedido->id); ?>"
						   class="btn btn-sm pd-x-15 btn-primary btn-uppercase mg-l-5"><i data-feather="file"
																						  class="wd-10 mg-r-5"></i>
							Exportar</a>
					</div>
				</div>
			</div>
			<div class="row row-xs">
				<div class="col-md-12 mb-3">
					<?php $this->load->view("pedidos/submenu", array("activo" => "pedido")); ?>
				</div>
				<div class="col-sm-6 col-lg-3">
					<div class="card card-body">
						<h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8">Total</h6>
						<div class="d-flex d-lg-block d-xl-flex align-items-end">
							<h3 class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1"><?php echo __dinero($pedido->total_pedido) ?></h3>
						</div>
						<p class="small pb-0 pt-2 mb-0"><a
									href="<?php echo base_url("pedidos/pago/") . $pedido->id; ?>"><u>Ver cobro <i
											class="fas fa-arrow-right"></i></u></a></p>
					</div>
				</div>
				<div class="col-sm-6 col-lg-3">
					<div class="card card-body">
						<h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8">Shargo</h6>
						<div class="d-flex d-lg-block d-xl-flex align-items-end">
							<h3 class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1"><?php echo ($pedido->shargo_error == 1 or $pedido->shargo_estado = "") ? "<span style='color:#ff0000'>Error</span>" : "Confirmado" ?> </h3>
						</div>
						<p class="small pb-0 pt-2 mb-0"><a
									href="<?php echo base_url("/pedidos/shargo/") . $pedido->id; ?>"><u>Ver shargo <i
											class="fas fa-arrow-right"></i></u></a></p>
					</div>
				</div>
				<div class="col-sm-6 col-lg-6">
					<div class="card card-body">
						<h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8">Usuario
							registrado</h6>
						<div class="d-flex d-lg-block d-xl-flex align-items-end">
							<h3 class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1"><?php echo ($pedido->id_usuario) ? $cliente->nombre : "No" ?> </h3>
						</div>
						<?php if ($pedido->id_usuario) { ?>
							<p class="small pb-0 pt-2 mb-0"><a
										href="<?php echo base_url("/clientes/ver/") . $pedido->id_usuario; ?>"><u>Ver
										usuario <i class="fas fa-arrow-right"></i></u></a></p>
						<?php } else { ?>
							<p class="small pb-0 pt-2 mb-0">El cliente compró sin registrarse</p>
						<?php } ?>
					</div>
				</div>
			</div>
			<div class="row row-xs mt-2">
				<div class="col-sm-6">
					<label class="tx-sans tx-uppercase tx-10 tx-medium tx-spacing-1 tx-color-03">Cliente</label>
					<h6 class="tx-15 mg-b-10 font-weight-bold"><?php echo $pedido->nombre; ?></h6>
					<p class="mg-b-0"><?php echo $pedido->direccion; ?></p>
					<p class="mg-b-0">Piso: <?php echo $pedido->piso; ?></p>

					<p class="mg-b-0"><?php echo $pedido->telefono; ?></p>
					<p class="mg-b-0"><?php echo $pedido->email; ?></p>

					<a href="<?php echo base_url("pedidos/editar_detalles_pedido/") . $pedido->id; ?>"
					   class="btn btn-secondary mt-2">Editar</a>
					<a href="<?php echo base_url("pedidos/cambiar_direccion/") . $pedido->id; ?>"
					   class="btn btn-secondary border mt-2">Editar dirección</a>
				</div>
				<div class="col-sm-6 tx-right d-none d-md-block">
					<label class="tx-sans tx-uppercase tx-10 tx-medium tx-spacing-1 tx-color-03">Número de
						pedido</label>
					<h1 class=" mg-b-10 tx-spacing--2"><?php echo $pedido->id; ?></h1>
				</div>
				<div class="col-sm-6 col-lg-8 mg-t-40 mg-sm-t-0 mg-md-t-40">
					<label class="tx-sans tx-uppercase tx-10 tx-medium tx-spacing-1 tx-color-03">Empresa</label>
					<h6 class="font-weight-bold mg-b-10"><?php echo $this->nombre_fiscal_empresa; ?></h6>
					<p class="mg-b-0"><?php echo $this->direccion_empresa; ?></p>
					<p class="mg-b-0"><?php echo $this->telefono_empresa; ?></p>
					<p class="mg-b-0"><?php echo $this->email_empresa; ?></p>
				</div>
				<div class="col-sm-6 col-lg-4 mg-t-40">
					<label class="tx-sans tx-uppercase tx-10 tx-medium tx-spacing-1 tx-color-03">Información del
						pedido</label>
					<ul class="list-unstyled lh-7">
						<li class="d-flex justify-content-between">
							<span>Fecha de entrega</span>
							<span class="font-weight-bold"><?php echo __fecha($pedido->fecha_entrega) ?></span>
						</li>
						<li class="d-flex justify-content-between">
							<span>Fecha creación</span>
							<span class="font-weight-bold"><?php echo __fecha($pedido->fecha_creacion, "Y-m-d H:i:s", true) ?></span>
						</li>
						<li class="d-flex justify-content-between">
							<span>Fecha de pago</span>
							<span class="font-weight-bold"><?php echo ($pedido->fecha_creacion) ? __fecha($pedido->fecha_creacion, "Y-m-d H:i:s", true) : ""; ?></span>
						</li>
						<li class="d-flex justify-content-between">
							<span>Método de pago</span>
							<span class="font-weight-bold"><?php echo ($pedido->metodo_pago) ? __metodos_pago($pedido->metodo_pago)->nombre : ""; ?></span>
						</li>
					</ul>
				</div>
				<div class="col-md-12">
					<div class="card">
						<div class="card-body">
							<?php if ($pedido->contenido) { ?>
								<div class="table-responsive">
									<table class="table table-bordered table-hover table-striped">
										<thead>
										<tr>
											<td>Descripcion</td>
											<td>Cantidad</td>
											<td>Precio</td>
										</tr>
										</thead>
										<tbody>
										<?php foreach (json_decode($pedido->contenido) as $pc) { ?>
											<tr>
												<td><?php echo $pc->nombre; ?></td>
												<td><?php echo $pc->cantidad; ?></td>
												<td><?php echo __dinero($pc->precio); ?></td>
											</tr>
										<?php } ?>
										</tbody>
									</table>
								</div>
							<?php } else { ?>
								<p>El pedido está vacío</p>
								<?php
							} ?>
						</div>
					</div>
				</div>


				<div class="col-md-8 mg-t-40">
					<label class="tx-sans tx-uppercase tx-10 tx-medium tx-spacing-1 tx-color-03">Comentarios</label>
					<p><?php echo ($pedido->comentarios) ? $pedido->comentarios : "El pedido no tiene comentarios" ?></p>
				</div>

				<div class="col-lg-4 mg-t-40">
					<ul class="list-unstyled lh-7 pd-r-10">
						<li class="d-flex justify-content-between">
							<strong>Total pedido</strong>
							<strong><?php echo __dinero($pedido->total_pedido); ?></strong>
						</li>
						<li class="d-flex justify-content-between">
							<span>Número de productos</span>
							<span><?php echo $pedido->total_productos ?></span>
						</li>
					</ul>
				</div>


			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function () {
		$('.btn-desactivar-pedido').click(function (e) {

			e.preventDefault();

			var activo = $(this).data('activo');
			var id = $(this).data('id');

			Swal.fire({
				title: 'Estás seguro?',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Si!'
			}).then((result) => {
				if (result.value) {
					$.ajax({
						url: BASE_URL + 'pedidos/ajax_activo',
						method: 'post',
						dataType: 'json',
						data: {
							id: id,
							activo: activo
						},
						success: function (data) {

							if (data.result == "success") {
								window.location.reload();
							} else {
								swal.fire("Error", data.mensaje, "error");
								loading.hide();
							}
						},
						error: function () {
							swal.fire("Error", "Error al intentar modificar el pedido", "error");
							loading.hide();
						}
					});
				}
			});

		});
	});
</script>
