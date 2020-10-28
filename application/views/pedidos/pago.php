<div class="content p-0">
	<?php $this->load->view("base/buscador"); ?>

	<div class="content-body">
		<div class="container pd-x-0">
			<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
				<div>
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb breadcrumb-style1 mg-b-10">
							<li class="breadcrumb-item"><a href="<?php echo base_url(__class()); ?>">Pedidos</a></li>
							<li class="breadcrumb-item"><a href="<?php echo base_url(__class()); ?>">Listado</a></li>
							<li class="breadcrumb-item"><a href="<?php echo base_url(__class() . "/ver/" . $pedido->id); ?>">Ver pedido</a></li>
							<li class="breadcrumb-item active" aria-current="page">Pago</li>
						</ol>
					</nav>
					<h4 class="mg-b-0 tx-spacing--1">Detalles de pago pedido  nº <?php echo $pedido->id ?>
					</h4>
				</div>
			</div>
			<div class="row row-xs">
				<div class="col-md-12 mb-3">
					<?php $this->load->view("pedidos/submenu",array("activo"=>"pago")); ?>
				</div>
				<div class="col-md-6 mt-2">
					<div class="card">
						<div class="card-header">
							<div class="title">Detalles de pago</div>
						</div>
						<div class="card-body">
							<?php if($pedido->metodo_pago){
								$mp = __metodos_pago($pedido->metodo_pago)
								?>
							<div class="table-responsive">
								<table class="table table-bordered table-hover">
									<tbody>
										<tr>
											<td>
												Tipo de pago:
											</td>
											<td>
												<?php echo $mp->nombre ?>
											</td>
										</tr>
										<tr>
											<td>
												Tipo de descripción:
											</td>
											<td>
												<?php echo $mp->descripcion ?>
											</td>
										</tr>
										<tr>
											<td>
												Pago privado:
											</td>
											<td>
												<?php echo ($mp->protegido) ? "Si" : "No" ?>
											</td>
										</tr>
										<tr>
											<td>
												Activo:
											</td>
											<td>
												<?php echo ($mp->activo) ? "Si" : "No" ?>
											</td>
										</tr>
										<tr>
											<td>
												¿Es necesario cuenta de usuario?
											</td>
											<td>
												<?php echo ($mp->sesion_iniciada) ? "Si" : "No" ?>
											</td>
										</tr>
										<tr>
											<td>
												Id transacción:
											</td>
											<td>
												<?php echo ($pedido->id_banco) ? $pedido->id_banco : "-"; ?>
											</td>
										</tr>

									</tbody>
								</table>
							</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
