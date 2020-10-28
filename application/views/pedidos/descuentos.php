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
							<li class="breadcrumb-item active" aria-current="page">Descuentos</li>
						</ol>
					</nav>
					<h4 class="mg-b-0 tx-spacing--1">Descuentos pedido  nº <?php echo $pedido->id ?>
					</h4>
				</div>
			</div>
			<div class="row row-xs">
				<div class="col-md-12 mb-3">
					<?php $this->load->view("pedidos/submenu",array("activo"=>"descuento")); ?>
				</div>
							<?php
							if($pedido->cupon){
								foreach(json_decode($pedido->cupon) as $cp){
									$cg = __cupon($cp->id_codigo);
									?>
				<div class="col-md-6 mt-2">
					<div class="card">
						<div class="card-header">
							<div class="title">Detalles del cupón</div>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-bordered table-hover">
									<tbody>

									<tr>
										<td>Cupón</td>
										<td><?php echo $cg->codigo ?></td>
									</tr>
									<tr>
										<td>Tipo descuento</td>
										<td><?php echo __pm($cp->tipo) ?></td>
									</tr>
									<tr>
										<td>Nombre del cupón</td>
										<td><?php echo $cp->nombre?></td>
									</tr>
									<tr>
										<td>Descripción</td>
										<td><?php echo $cp->descripcion ?></td>
									</tr>
									<tr>
										<td>Fecha inicio</td>
										<td><?php echo __fecha($cp->fecha_inicio, "Y-m-d H:i:s") ?></td>
									</tr>
									<tr>
										<td>Fecha final</td>
										<td><?php echo __fecha($cp->fecha_final, "Y-m-d H:i:s") ?></td>
									</tr>
									<tr>
										<td>Fecha introducción</td>
										<td><?php echo __fecha($cp->fecha_introducion, "Y-m-d H:i:s") ?></td>
									</tr>
									<tr>
										<td>Descuento</td>
										<td><?php echo __dinero($cp->descuento) ?></td>
									</tr>
									<tr>
										<td>Uso por usuario</td>
										<td><?php echo $cg->uso_por_usuario ?></td>
									</tr>
									<tr>
										<td>Uso total</td>
										<td><?php echo $cg->uso_total ?></td>
									</tr>
									</tbody>
								</table>
							</div>

						</div>
					</div>
				</div>
							<?php
								}
							}else{

							?>

					<p clas>No se encuentra ningún cupon usado en el pedido</p>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
