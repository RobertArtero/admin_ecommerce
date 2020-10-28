<aside class="aside aside-fixed">
	<div class="aside-header">
		<a href="<?php echo base_url(); ?>" class="aside-logo"><?php echo $this->nombre_empresa; ?></span></a>
		<a href="" class="aside-menu-link">
			<i data-feather="menu"></i>
			<i data-feather="x"></i>
		</a>
	</div>
	<div class="aside-body">
		<div class="aside-loggedin">
			<div class="d-flex align-items-center justify-content-start">
				<div class="aside-alert-link">
				<!--	<a href="" class="new" data-toggle="tooltip" title="You have 2 unread messages"><i data-feather="message-square"></i></a> -->
				<!--	<a href="" class="new" data-toggle="tooltip" title="You have 4 new notifications"><i data-feather="bell"></i></a> -->
				<!--	<a href="" data-toggle="tooltip" title="Sign out"><i data-feather="log-out"></i></a> -->
				</div>
			</div>
			<div class="aside-loggedin-user">
				<a href="#loggedinMenu" class="d-flex align-items-center justify-content-between mg-b-2" data-toggle="collapse">
					<h6 class="tx-semibold mg-b-0"><?php echo $this->usuario->nombre; ?></h6>
					<i data-feather="chevron-down"></i>
				</a>
				<p class="tx-color-03 tx-12 mg-b-0"><?php echo $this->usuario->email; ?></p>
			</div>
			<div class="collapse" id="loggedinMenu">
				<ul class="nav nav-aside mg-b-0">
					<li class="nav-item"><a href="<?php echo base_url('panel/cerrar_sesion'); ?>" class="nav-link"><i data-feather="log-out"></i> <span>Cerrar sesión</span></a></li>
				</ul>
			</div>
		</div>
		<ul class="nav nav-aside">
			<li class="nav-item <?php echo (__class() == "pedidos") ? "active" : ""; ?>"><a href="<?php echo base_url("/pedidos") ;?>" class="nav-link"><i data-feather="shopping-bag"></i> <span>Pedidos</span></a></li>
			<li class="nav-item <?php echo (__class() == "clientes") ? "active" : ""; ?>"><a href="<?php echo base_url("/clientes") ;?>" class="nav-link"><i data-feather="user"></i> <span>Clientes</span></a></li>
			<li class="nav-item <?php echo (__class() == "productos") ? "active" : ""; ?>"><a href="<?php echo base_url("/productos") ;?>" class="nav-link"><i data-feather="box"></i> <span>Productos</span></a></li>
			<li class="nav-item <?php echo (__class() == "paginas") ? "active" : ""; ?>"><a href="<?php echo base_url("/paginas") ;?>" class="nav-link"><i data-feather="book"></i> <span>Paginas</span></a></li>
			<li class="nav-item <?php echo (__class() == "marketing") ? "active" : ""; ?>"><a href="<?php echo base_url("/marketing") ;?>" class="nav-link"><i data-feather="truck"></i> <span>Marketing</span></a></li>
			<li class="nav-item <?php echo (__class() == "configuracion") ? "active" : ""; ?>"><a href="<?php echo base_url("/configuracion") ;?>" class="nav-link"><i data-feather="folder"></i> <span>Configuracion</span></a></li>
			<li class="nav-item <?php echo (__class() == "avanzada") ? "active" : ""; ?>"><a href="<?php echo base_url("/avanzada") ;?>" class="nav-link"><i data-feather="sliders"></i> <span>Configuración avanzada</span></a></li>
		</ul>
	</div>
</aside>



