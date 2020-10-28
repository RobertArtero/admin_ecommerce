<nav class="nav nav-pills nav-fill border">
	<a class="nav-item nav-link <?php echo ($activo == "listado")?"active" : ""; ?>" href="<?php echo base_url('productos/listado'); ?>">Listado</a>
	<a class="nav-item nav-link <?php echo ($activo == "eliminados")?"active" : ""; ?>" href="<?php echo base_url('productos/eliminados'); ?>">Eliminados (<?php echo $total_eliminados ?>)</a>
</nav>
