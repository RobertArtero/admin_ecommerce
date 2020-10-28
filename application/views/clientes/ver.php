<div class="content p-0">
	<?php $this->load->view("base/buscador"); ?>

	<div class="content-body">
		<div class="container pd-x-0">
			<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
				<div>
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb breadcrumb-style1 mg-b-10">
							<li class="breadcrumb-item"><a href="<?php echo base_url(__class()); ?>">Clientes</a></li>
							<li class="breadcrumb-item active" aria-current="page"><?php echo $cliente->nombre ?></li>
						</ol>
					</nav>
					<h4 class="mg-b-0 tx-spacing--1"><?php echo $cliente->nombre; ?>
					</h4>
				</div>
			</div>
			<div class="row row-xs">
				<div class="col-md-12 mb-3">
					<?php $this->load->view("clientes/submenu",array("activo"=>"clientes")); ?>
				</div>
				<div class="col-md-12 mb-3">
					<div id="contactInformation" class="tab-pane show active pd-20 pd-xl-25">
						<div class="d-flex align-items-center justify-content-between mg-b-25">
							<h6 class="mg-b-0">Detalles personales</h6>
							<div class="d-flex">
								<a href="<?php echo base_url("/clientes/editar_cliente/" . $cliente->id) ?>" class="btn btn-sm btn-white d-flex align-items-center mg-r-5">
									<span class="d-none d-sm-inline mg-l-5"> Editar</span></a>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6 mt-2">
								<div class="card">
									<div class="card-body">
										<label class="label font-weight-bold">Nombre</label>
										<p class="mg-b-0"><?php echo ($cliente->nombre) ? $cliente->nombre : "No definido"; ?></p>
									</div>
								</div>
							</div>
							<div class="col-md-6 mt-2">
								<div class="card">
									<div class="card-body">
										<label class="label font-weight-bold">Teléfono</label>
										<p class="mg-b-0"><?php echo ($cliente->telefono) ? $cliente->telefono : "No definido"; ?></p>
									</div>
								</div>
							</div>
							<div class="col-md-6 mt-2">
								<div class="card">
									<div class="card-body">
										<label class="label font-weight-bold">Email</label>
										<p class="mg-b-0"><?php echo ($cliente->email) ? $cliente->email : "No definido"; ?></p>
									</div>
								</div>
							</div>
						</div>

						<h6 class="mg-t-40 mg-b-20">Facturación</h6>

						<div class="row row-sm">
							<div class="col-md-6 mt-2">
								<div class="card">
									<div class="card-body">
										<label class="label font-weight-bold">Nombre</label>
										<p class="mg-b-0"><?php echo ($cliente->facturacion_nombre) ? $cliente->facturacion_nombre : "No definido"; ?></p>
									</div>
								</div>
							</div>
							<div class="col-md-6 mt-2">

								<div class="card">
									<div class="card-body">
										<label class="label font-weight-bold">NIF</label>
										<p class="mg-b-0"><?php echo ($cliente->facturacion_nif) ? $cliente->facturacion_nif : "No definido"; ?></p>
									</div>
								</div>

							</div>
							<div class="col-md-6 mt-2">
								<div class="card">
									<div class="card-body">
										<label class="label font-weight-bold">No definido</label>
										<p class="mg-b-0"><?php echo ($cliente->facturacion_direccion) ? $cliente->facturacion_direccion : "No definido"; ?></p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
