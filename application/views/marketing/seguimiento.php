<div class="content p-0">
	<?php $this->load->view("base/buscador"); ?>
	<div class="content-body">
		<div class="container pd-x-0">
			<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
				<div>
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb breadcrumb-style1 mg-b-10">
							<li class="breadcrumb-item"><a href="<?php echo base_url(__class()); ?>">Marketing</a></li>
							<li class="breadcrumb-item active" aria-current="page">Seguimiento</li>
						</ol>
					</nav>
				</div>
			</div>
			<div class="row row-xs">
				<div class="col-md-12 mb-3">
					<?php $this->load->view("marketing/submenu",array("activo"=>"seguimiento")); ?>
				</div>
			</div>
			<div class="row row-xs">
				<div class="col-md-12 mt-2">
					<div class="card card-body">
						<form method="get" action="<?php base_url("marketing/seguimiento") ?>">
							<div class="row">
								<div class="col-md-12 my-2">
									<label>Buscar</label>
									<input type="text" class="form-control" placeholder="Buscar" name="b" value="<?php echo strip_tags($this->input->get("b")); ?>">
								</div>

								<div class="col-md-12 mt-3">
									<input type="submit" class="btn btn-primary mr-2" value="Filtrar listado">
									<a href="<?php echo base_url("marketing/seguimiento"); ?>" class="btn btn-transparent border mr-2">Quitar filtros</a>
									<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-nuevo-seguimiento">Nuevo</button>
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
					<div class="card card-body table-seguimiento">
						<?php
						$data['seguimientos'] = $seguimentos;
						echo $this->load->view('marketing/ajax/table-seguimientos', $data, true);
						?>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>

<div class="modal fade" id="modal-nuevo-seguimiento" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<h3 class="mb-4">Nuevo seguimiento</h3>
				<form method="post" id="frm-add-seguimiento">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Referéncia*</label>
								<input class="form-control" type="text" name="referencia" placeholder="Referéncia"
									   required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Nombre*</label>
								<input class="form-control" type="text" name="nombre" placeholder="Nombre del cupón"
									   required>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label>Descripción</label>
						<textarea class="form-control" name="descripcion"
								  placeholder="Descripción del cupon"></textarea>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Medio</label>
								<input class="form-control" type="text" name="medio" placeholder="Medio">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>UTM Source</label>
								<input class="form-control" type="text" name="utm_source" placeholder="UTM Source">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>UTM Medium</label>
								<input class="form-control" type="text" name="utm_medium" placeholder="UTM Medium">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>UTM Campaign</label>
								<input class="form-control" type="text" name="utm_campaign" placeholder="UTM Campaign">
							</div>
						</div>
					</div>
				</form>
				<div class="mt-6">
					<button class="btn btn-sm btn-space btn-secondary" type="button" data-dismiss="modal">Cerrar</button>
					<button class="btn btn-sm btn-space btn-primary" type="submit" form="frm-add-seguimiento">Crear</button>
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

		$('#frm-add-seguimiento').submit(function (e) {

			e.preventDefault();

			$.ajax({
				url : BASE_URL + 'marketing/ajax_crear_seguimiento',
				dataType: 'json',
				type : 'POST',
				data: $(this).serialize(),
				success : function (data) {
					if(data.result == "success"){
						swal.fire("Confirmado", "Seguimiento creado", "success");
						$('.table-seguimiento').html(data.html);
						$('#frm-add-seguimiento').trigger('reset');
						$('#modal-nuevo-seguimiento').modal('hide');
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
				url : BASE_URL + 'marketing/ajax_modal_seguimiento',
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
