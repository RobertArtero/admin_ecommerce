<nav class="nav nav-pills nav-fill border">
	<a class="nav-item nav-link <?php echo ($activo == "clientes")?"active" : ""; ?>" href="<?php echo base_url('clientes/ver/' . $cliente->id); ?>">Ver</a>
	<a class="nav-item nav-link <?php echo ($activo == "direcciones")?"active" : ""; ?>" href="<?php echo base_url('clientes/direcciones/' . $cliente->id); ?>">Direcciones</a>
	<a class="nav-item nav-link <?php echo ($activo == "monedero")?"active" : ""; ?>" href="<?php echo base_url('clientes/monedero/' . $cliente->id); ?>">Saldo</a>
	<a class="nav-item nav-link <?php echo ($activo == "pedidos")?"active" : ""; ?>" href="<?php echo base_url('clientes/pedidos/' . $cliente->id); ?>">Pedidos</a>
</nav>
