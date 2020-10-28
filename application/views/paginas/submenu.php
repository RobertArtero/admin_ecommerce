<nav class="nav nav-pills nav-fill border">
	<a class="nav-item nav-link <?php echo ($activo == "pagina")?"active" : ""; ?>" href="<?php echo base_url('paginas/ver/' . $pagina->id); ?>">Detalles</a>
	<a class="nav-item nav-link <?php echo ($activo == "seo")?"active" : ""; ?>" href="<?php echo base_url('paginas/seo/' . $pagina->id); ?>">SEO</a>
</nav>
<div class="row">
	<?php if(!$pagina->activo){ ?>
		<div class="col-md-12">
			<div class="alert alert-danger text-center font-weight-bold">Esta página no está activada</div>
		</div>
	<?php } ?>
</div>
