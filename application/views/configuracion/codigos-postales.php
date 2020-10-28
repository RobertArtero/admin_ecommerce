<div class="content p-0">
	<?php $this->load->view("base/buscador"); ?>

	<div class="content-body">
		<div class="container pd-x-0">
			<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
				<div>
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb breadcrumb-style1 mg-b-10">
							<li class="breadcrumb-item"><a href="<?php echo base_url(__class()); ?>">codigos_postales</a></li>
							<li class="breadcrumb-item active" aria-current="page">Códigos postales</li>
						</ol>
					</nav>
				</div>
			</div>
			<div class="row row-xs">
				<div class="col-md-12 mb-3">
					<?php $this->load->view("configuracion/submenu",array("activo"=>"codigos_postales")); ?>
				</div>
			</div>
			<div class="row row-xs">
				<div class="col-md-12 mt-2">
					<div class="card card-body">
						<form method="get" action="<?php base_url("configuracion/codigos_postales") ?>">
							<div class="row">
								<div class="col-md-12 my-2">
									<label>Buscar</label>
									<input type="text" class="form-control" placeholder="Buscar" name="b" value="<?php echo strip_tags($this->input->get("b")); ?>">
								</div>

								<div class="col-md-12 mt-3">
									<input type="submit" class="btn btn-primary mr-2" value="Filtrar listado">
									<a href="<?php echo base_url("configuracion/codigos_postales"); ?>" class="btn btn-transparent border mr-2">Quitar filtros</a>
									<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-nuevo-cp">Nuevo</button>
								</div>
							</div>
						</form>
					</div>
				</div>
				<?php if($this->input->get()) { ?>
					<div class="col-md-12 text-center font-weight-bold">
						<div class="alert alert-success">Filtros activados</div>
					</div>
				<?php } ?>
				<div class="col-md-12 mt-2">
					<div class="card card-body table-cp">
						<?php
						$data['codigos_postales'] = $codigos_postales;
						echo $this->load->view('configuracion/ajax/table-codigos-postales', $data, true);
						?>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>

<div class="modal fade" id="modal-nuevo-cp" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<h3 class="mb-4">Nuevo código postal</h3>
				<form method="post" id="frm-add-cp">
					<div class="form-group mt-1">
						<label>Número</label>
						<input class="form-control" type="number" name="codigo_postal" placeholder="Código postal" required>
					</div>
					<div class="form-group">
						<label>Estado</label>
						<div class="row mb-0">
							<div class="col-12">
								<label class="custom-control custom-radio custom-control-inline">
									<input class="custom-control-input" type="radio" name="activo" value="1" checked><span class="custom-control-label custom-control-color">Activo</span>
								</label>
								<label class="custom-control custom-radio custom-control-inline">
									<input class="custom-control-input" type="radio" name="activo" value="0"><span class="custom-control-label custom-control-color">No activo</span>
								</label>
							</div>
						</div>
					</div>
				</form>
				<div class="mt-6">
					<button class="btn btn-sm btn-space btn-secondary" type="button" data-dismiss="modal">Cerrar</button>
					<button class="btn btn-sm btn-space btn-primary" type="submit" form="frm-add-cp">Crear</button>
				</div>

			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="md-edit" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body content-edit">

			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function(){

		$('#frm-add-cp').submit(function (e) {

			e.preventDefault();

			$.ajax({
				url : BASE_URL + 'configuracion/ajax_crear_cp',
				dataType: 'json',
				type : 'POST',
				data: $(this).serialize(),
				success : function (data) {
					if(data.result == "success"){
						swal.fire("Confirmado", "Categoría creada", "success");
						$('.table-cp').html(data.html);
						$('#frm-add-cp').trigger('reset');
						$('#modal-nuevo-cp').modal('hide');
					}
				},
				error : function () {
					swal.fire("Error","Se ha producido un error","error");
				}
			});

		});

		$(document).on('click','.btn-edit',function () {

			var id = $(this).data('id');

			$.ajax({
				url : BASE_URL + 'configuracion/ajax_modal_cp',
				dataType: 'json',
				type : 'post',
				data :{id : id},
				success : function (data) {
					if( data.result == "success"){
						$('.content-edit').html(data.html);
						$('#md-edit').modal('show');
						return;
					}
				},
				error : function () {
					swal.fire("Error","error");
				}
			})
		});

	});
</script>


