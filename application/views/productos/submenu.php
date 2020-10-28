<nav class="nav nav-pills nav-fill border">
	<a class="nav-item nav-link <?php echo ($activo == "productos")?"active" : ""; ?>" href="<?php echo base_url('productos/ver/' . $producto->id); ?>">Detalles</a>
	<a class="nav-item nav-link <?php echo ($activo == "pedidos")?"active" : ""; ?>" href="<?php echo base_url('productos/pedidos/' . $producto->id); ?>">Pedidos</a>
	<a class="nav-item nav-link <?php echo ($activo == "seo")?"active" : ""; ?>" href="<?php echo base_url('productos/seo/' . $producto->id); ?>">SEO</a>
	<a class="nav-item nav-link <?php echo ($activo == "precio")?"active" : ""; ?>" href="<?php echo base_url('productos/precio/' . $producto->id); ?>">Precios</a>
</nav>
<div class="row">
	<?php if(!$producto->activo){ ?>
		<div class="col-md-12">
			<div class="alert alert-danger text-center font-weight-bold">Este producto no está activo</div>
		</div>
	<?php } ?>
</div>
