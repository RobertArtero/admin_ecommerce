<nav class="nav nav-pills nav-fill border">
	<a class="nav-item nav-link <?php echo ($activo == "paypal")?"active" : ""; ?>" href="<?php echo base_url('avanzada/paypal'); ?>">Paypal</a>
	<a class="nav-item nav-link <?php echo ($activo == "redsys")?"active" : ""; ?>" href="<?php echo base_url('avanzada/redsys'); ?>">Redsys</a>
	<a class="nav-item nav-link <?php echo ($activo == "metodos")?"active" : ""; ?>" href="<?php echo base_url('avanzada/metodos'); ?>">Métodos</a>
</nav>
