<nav class="nav nav-pills nav-fill border">
	<a class="nav-item nav-link <?php echo ($activo == "general")?"active" : ""; ?>" href="<?php echo base_url('avanzada/general'); ?>">General</a>
	<a class="nav-item nav-link <?php echo ($activo == "seguimiento")?"active" : ""; ?>" href="<?php echo base_url('avanzada/seguimiento'); ?>">Seguimiento</a>
	<a class="nav-item nav-link <?php echo ($activo == "envio")?"active" : ""; ?>" href="<?php echo base_url('avanzada/envio'); ?>">Envio</a>
		<a class="nav-item nav-link <?php echo ($activo == "pagos")?"active" : ""; ?>" href="<?php echo base_url('avanzada/paypal'); ?>">Pagos</a>
	<a class="nav-item nav-link <?php echo ($activo == "whatsapp")?"active" : ""; ?>" href="<?php echo base_url('avanzada/whatsapp'); ?>">WhatsApp</a>
	<a class="nav-item nav-link <?php echo ($activo == "notificaciones")?"active" : ""; ?>" href="<?php echo base_url('avanzada/notificaciones'); ?>">Notificaciones</a>
	<a class="nav-item nav-link <?php echo ($activo == "personalizacion")?"active" : ""; ?>" href="<?php echo base_url('avanzada/personalizacion'); ?>">Personalizacion</a>
</nav>
