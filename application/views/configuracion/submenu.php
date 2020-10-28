<nav class="nav nav-pills nav-fill border">
	<a class="nav-item nav-link <?php echo ($activo == "categorias")?"active" : ""; ?>" href="<?php echo base_url('configuracion/categorias'); ?>">Categorias</a>
	<a class="nav-item nav-link <?php echo ($activo == "codigos_postales")?"active" : ""; ?>" href="<?php echo base_url('configuracion/codigos_postales'); ?>">Códigos postales</a>
	<a class="nav-item nav-link <?php echo ($activo == "administradores")?"active" : ""; ?>" href="<?php echo base_url('configuracion/administradores'); ?>">Administradores</a>
</nav>
