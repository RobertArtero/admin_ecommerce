
<div class="content p-0">
	<?php $this->load->view("base/buscador"); ?>
	<div class="content-body">
		<div class="container pd-x-0">
			<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
				<div>
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb breadcrumb-style1 mg-b-10">
							<li class="breadcrumb-item"><a href="<?php echo base_url(__class()); ?>">Páginas</a></li>
							<li class="breadcrumb-item active" aria-current="page">Listado</li>
						</ol>
					</nav>
					<h4 class="mg-b-0 tx-spacing--1">Listado de páginas</h4>
				</div>
			</div>

			<div class="row row-xs">

				<div class="col-md-12 mt-2">
					<div class="card card-body">
						<form method="get" id="buscador" action="<?php base_url("paginas/listado") ?>">
							<div class="row">
								<div class="col-md-12 mt-1">
									<label>Buscar</label>
									<input type="text" class="form-control" placeholder="Buscar" name="b" value="<?php echo strip_tags($this->input->get("b")); ?>">
								</div>
								<div class="col-md-12 mt-3">
									<input type="submit" class="btn btn-primary mr-2" value="Filtrar listado">
									<a href="<?php echo base_url("paginas/listado"); ?>" class="btn btn-transparent border mr-2">Quitar filtros</a>
									<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#mdl-nueva-pagina">Nuevo</button>
								</div>
							</div>
						</form>
					</div>
				</div>

				<?php if ($this->input->get()) { ?>
					<div class="col-md-12 text-center font-weight-bold">
						<div class="alert alert-success">Filtros activados</div>
					</div>
				<?php } ?>

				<div class="col-md-12 mt-2">
					<div class="card card-body">
						<div class="table-responsive">
							Total registro: <span class="badge badge-secondary"><?php echo $total; ?></span>
							<table class="table table-hover table-bordered table-striped mt-2">
								<tbody>
								<thead>
								<tr>
									<td class="py-3">Título</td>
									<td class="py-3">Estado</td>
									<td class="py-3">Acciones</td>
								</tr>
								</thead>
								</thead>
								<tbody>
								<?php if ($paginas) {
									foreach ($paginas as $pagina) {
										?>
										<tr>
											<td><?php echo $pagina->titulo ?> </td>
											<td class="py-3"><?php echo ($pagina->activo) ? "<span class='badge badge-success'>Activo</span>" : "<span class='badge badge-danger'>No activo</span>"; ?></td>
											<td class="p-1"><a href="<?php echo base_url("/paginas/ver/" . $pagina->id); ?>" class="btn btn-transparent border btn-block">Ver</a></td>
										</tr>
									<?php }
								} ?>
								</tbody>
							</table>
							Total registro: <span class="badge badge-secondary"><?php echo $total; ?></span>
						</div>
						<?php echo $paginacion; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="mdl-nueva-pagina" tabindex="-1" role="dialog" aria-labelledby="mdl-nueva-pagina" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Nueva página</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<label class="label font-weight-bold">Título</label>
				<input id="titulo-nueva-pagina" type="text" class="form-control input-lg" placeholder="Nombre">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary btn-crear-nueva-pagina">Crear</button>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function(){
		$('.btn-crear-nueva-pagina').on('click', function() {
			var $titulo = $('#titulo-nueva-pagina').val();

			loading.show();

			$.ajax({
				url: BASE_URL + 'paginas/ajax_crear_pagina',
				method: 'post',
				dataType: 'text',
				data: {
					titulo: $titulo
				},
				success: function(data) {
					var $resultado = $.trim(data);
					if ($.trim($resultado) > 0) {
						window.location.href = BASE_URL + "paginas/ver/" + $resultado;
					} else if ($resultado == 0) {
						swal.fire("Error", "Se ha producido un error", "error");
						loading.hide();
					}
				},
				error: function() {
					swal.fire("Error", "Error al crear la página", "error");
					loading.hide();
				}

			});
		});
	});
</script>
