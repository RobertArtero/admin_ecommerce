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
							<li class="breadcrumb-item active" aria-current="page">Avanzado</li>
						</ol>
					</nav>
					<h4 class="mg-b-0 tx-spacing--1">Menú avanzado pedido  nº <?php echo $pedido->id ?>
					</h4>
				</div>
			</div>
			<div class="row row-xs">
				<div class="col-md-12 mb-3">
					<?php $this->load->view("pedidos/submenu",array("activo"=>"avanzado")); ?>
				</div>
				<div class="col-md-6 mt-2">
					<div class="card">
						<div class="card-header">
							<div class="title">Detalles campaña de marketing</div>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-hover table-bordered">
									<tbody>
							<?php if($pedido->id_seguimiento){
								$sg = __seguimiento($pedido->id_seguimiento);
								?>

								<tr>
									<td>Nombre campaña:</td>
									<td><?php echo $sg->nombre ?></td>
								</tr>
								<tr>
									<td>Descripción:</td>
									<td><?php echo $sg->descripcion ?></td>
								</tr>
								<tr>
									<td>Medio:</td>
									<td><?php echo __pm($sg->medio); ?></td>
								</tr>
								<tr>
									<td>Fecha compra:</td>
									<td><?php echo __fecha($pedido->fecha_creacion,"Y-m-d H:i:s",true); ?></td>
								</tr>
								<tr>
									<td>Enlace de seguimiento:</td>
									<td><a target="_blank" href="<?php echo $this->config->item("tienda_url") . "?mkt=" . $sg->referencia; ?>"><?php echo $this->config->item("tienda_url") . "?mkt=" . $sg->referencia; ?></a></td>
								</tr>

							<?php }else{ ?>

									<p>No existe campaña asociada al pedido</p>

							<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6 mt-2">
					<div class="card">
						<div class="card-header">
							<div class="title">Detalles de la compra</div>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-hover table-bordered">
									<tbody>

										<tr>
											<td>Sistema perativo:</td>
											<td><?php echo $pedido->sistema_operativo ?></td>
										</tr>
										<tr>
											<td>Dispositivo:</td>
											<td><?php echo ($pedido->movil) ? "Móvil": "Ordenador"; ?></td>
										</tr>
										<tr>
											<td>Navegador:</td>
											<td><?php echo $pedido->navegador ?></td>
										</tr>
										<tr>
											<td>Referencia:</td>
											<td><?php echo $pedido->referencia ?></td>
										</tr>

									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
