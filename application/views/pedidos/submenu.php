<nav class="nav nav-pills nav-fill border">
	<a class="nav-item nav-link <?php echo ($activo == "pedido")?"active" : ""; ?>" href="<?php echo base_url('pedidos/ver/' . $pedido->id); ?>">Ver</a>
	<a class="nav-item nav-link <?php echo ($activo == "shargo")?"active" : ""; ?>" href="<?php echo base_url('pedidos/shargo/' . $pedido->id); ?>">Shargo</a>
	<a class="nav-item nav-link <?php echo ($activo == "descuento")?"active" : ""; ?>" href="<?php echo base_url('pedidos/descuentos/' . $pedido->id); ?>">Cupón</a>
	<a class="nav-item nav-link <?php echo ($activo == "pago")?"active" : ""; ?>" href="<?php echo base_url('pedidos/pago/' . $pedido->id); ?>">Pago</a>
	<a class="nav-item nav-link <?php echo ($activo == "avanzado")?"active" : ""; ?>" href="<?php echo base_url('pedidos/avanzado/' . $pedido->id); ?>">Más</a>
</nav>
<div class="row">
	<?php if(!$pedido->activo){ ?>
		<div class="col-md-12">
			<div class="alert alert-danger text-center font-weight-bold">El pedido no está activo</div>
		</div>
	<?php } ?>
</div>
