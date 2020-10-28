<div class="content p-0">
	<?php $this->load->view("base/buscador"); ?>

	<div class="content-body">
		<div class="container pd-x-0">
			<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
				<div>
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb breadcrumb-style1 mg-b-10">
							<li class="breadcrumb-item"><a href="<?php echo base_url(__class()); ?>">Productos</a></li>
							<li class="breadcrumb-item"><a href="<?php echo base_url(__class()); ?>">Listado</a></li>
							<li class="breadcrumb-item active" aria-current="page"><?php echo $pagina->titulo ?></li>
							<li class="breadcrumb-item active" aria-current="page">SEO</li>
						</ol>
					</nav>
					<h4 class="mg-b-0 tx-spacing--1">SEO de <?php echo $pagina->titulo; ?></h4>
					</h4>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<?php $this->load->view("paginas/submenu", array("activo" => "seo")); ?>
				</div>
				<div class="col-md-12 mt-2">
					<div class="card">
						<div class="card-body">
							<label class="label font-weight-bold">Slug</label>
							<input id="slug" type="text" class="form-control input-lg" value="<?php echo $pagina->slug; ?>" placeholder="Slug">
							<span><?php echo base_url("/paginas/").$pagina->slug ?></span>
						</div>
					</div>
					<div class="card mt-2">
						<div class="card-body">
							<label class="label font-weight-bold">Metatitle</label>
							<input id="meta_titulo" type="text" class="form-control input-lg" value="<?php echo $pagina->meta_titulo; ?>" placeholder="Metatitle">
						</div>
					</div>
					<div class="card mt-2">
						<div class="card-body">
							<label class="label font-weight-bold">Metadescription</label>
							<textarea class="form-control" name="meta_descripcion" id="meta_descripcion"><?php echo $pagina->meta_descripcion ?></textarea>
						</div>
					</div>
				</div>
			</div>
			<div class="row mt-3">
				<div class="col-md-12">
					<button class="btn btn-lg btn-primary btn-guardar-seo">Guardar</button>
				</div>
			</div>
		</div>
	</div>
</div>

<script>

	$(document).ready(function() {

		var loading = $(".loading");
		var $id = '<?php echo $pagina->id; ?>';


		$('.btn-guardar-seo').on('click', function() {
			var $slug = $("#slug").val();
			var $meta_titulo = $("#meta_titulo").val();
			var $meta_descripcion = $("#meta_descripcion").val();

			loading.show();

			$.ajax({
				url: BASE_URL + 'paginas/ajax_modificar_seo',
				method: 'post',
				dataType: 'json',
				data: {
					id: $id,
					slug : $slug ,
					meta_titulo : $meta_titulo ,
					meta_descripcion : $meta_descripcion ,
				},
				success: function(data) {
					if (data.result == "success") {
						window.location.reload();
					} else {
						swal.fire("Error", data.mensaje, "error");
						loading.hide();
					}
				},
				error: function() {
					swal.fire("Error", "Error al intentar modificar el producto", "error");
					loading.hide();
				}

			});

		});

	});
</script>
