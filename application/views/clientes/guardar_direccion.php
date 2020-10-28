<div class="content p-0">
	<?php $this->load->view("base/buscador"); ?>

	<div class="content-body">
		<div class="container pd-x-0">
			<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
				<div>
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb breadcrumb-style1 mg-b-10">
							<li class="breadcrumb-item"><a href="<?php echo base_url(__class()); ?>">Pedidos</a></li>
							<li class="breadcrumb-item"><a href="<?php echo base_url(__class()); ?>">Clientes</a></li>
							<li class="breadcrumb-item"><a href="<?php echo base_url(__class() . "/ver/" . $cliente->id); ?>"><?php echo $cliente->nombre; ?></a></li>
						</ol>
					</nav>
					<h4 class="mg-b-0 tx-spacing--1">Añadir dirección a <?php echo $cliente->nombre; ?>
					</h4>
				</div>
			</div>
			<div class="row row-xs">
				<div class="col-md-6 mx-auto">
					<div class="card">
						<div class="card-header">
							<div class="title">Añadir dirección</div>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-md-12">
									<p>Nueva dirección:</p>
								</div>
								<div class="col-md-12 mt-2">
									<input type="text" data-error="direccion_error" class="form-control input-lg" id="dir33" placeholder="Dirección">
									<p style="font-size:12px; color:red;" id="direccion_error"></p>
								</div>
								<div class="col-md-6 mt-2">
									<input type="text" data-error="direccion_cp_error" id="direccion_cp" class="form-control input-lg" placeholder="Código postal">
									<p style="font-size:12px; color:red;" id="direccion_cp_error"></p>
								</div>
								<div class="col-md-6 mt-2">
									<input type="text" data-error="direccion_piso_error" id="direccion_piso" class="form-control input-lg" placeholder="Piso">
									<p style="font-size:12px; color:red;" id="direccion_piso_error"></p>
								</div>
								<div class="col-md-6 mt-2">
									<input type="text" id="contacto_persona" class="form-control input-lg" placeholder="Persona de contacto" required>
									<p style="font-size:12px; color:red;"></p>
								</div>
								<div class="col-md-6 mt-2">
									<input type="tel" id="contacto_telefono" class="form-control input-lg" placeholder="Teléfono">
									<p style="font-size:12px; color:red;"></p>
								</div>
								<div class="col-md-12 mt-2">
									<div class="btn btn-primary btn-add-direccion">Añadir dirección</div>
								</div>
								<div class="col-12" style="display:none;">
									<div class="form-group">
										<input type="text" placeholder="" id="direccion_latitud" class="form-control">
										<input type="text" placeholder="" id="direccion_longitud" class="form-control">
										<input type="text" placeholder="" id="direccion_numero" class="form-control">
										<input type="text" placeholder="" id="direccion_goo" class="form-control">
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


<script>
	var $latitud = "";
	var $longitude = "";

	google.maps.event.addDomListener(window, 'load', function () {

		var options = {
			componentRestrictions: {country: "es"}
		};
		var places = new google.maps.places.Autocomplete(document.getElementById('dir33'),options);

		google.maps.event.addListener(places, 'place_changed', function () {


			var place = places.getPlace();

			var address = place.formatted_address;
			var latitude = place.geometry.location.lat();
			var longitude = place.geometry.location.lng();
			var street_number = place.street_number;

			var components = place.address_components;
			var num_street = null;

			for (var i = 0, component; component = components[i]; i++) {
				if (component.types[0] == 'street_number') {
					num_street = component['long_name'];
				}
			}

			if (num_street==null)
			{
				$("#direccion_latitud").val('');
				$("#direccion_longitud").val('');
				$("#direccion_goo").val('');
				$("#direccion_numero").val('');

			}
			else
			{
				$("#direccion_latitud").val(latitude);
				$("#direccion_longitud").val(longitude);
				$("#direccion_goo").val(address);
				$("#direccion_numero").val(num_street);

			}
		});

	});
</script>
<script>
	$(".btn-add-direccion").on("click",function(){


		var $cp = $("#direccion_cp").val();
		var $latitud  =  $("#direccion_latitud").val();
		var $longitud =  $("#direccion_longitud").val();
		var $direccion_go =  $("#direccion_goo").val();
		var $numero =  $("#direccion_numero").val();
		var $piso = $("#direccion_piso").val();
		var $contacto_persona = $("#contacto_persona").val();
		var $contacto_telefono = $("#contacto_telefono").val();


		var $return = true; /*Variable controladora del envío*/

		if($piso.length == 0 || $piso.length == ""){
			$("#direccion_piso_error").text('Piso incompleto');
			$("#direccion_piso").addClass("input_error");
			$return = false;
		}


		if($latitud.length == 0 || $latitud.length == ""){
			console.log("Dirección");
			$("#direccion_error").text('La dirección no es correcta o está incompleta, Recuerds que es necesario el número');
			$("#dir33").addClass("input_error");

			$return = false;
		}
		if($longitud.length == 0 ||$longitud.length == ""){
			console.log("Dirección");
			$("#direccion_error").text('La dirección no es correcta o está incompleta, Recuerds que es necesario el número');
			$("#dir33").addClass("input_error");

			$return = false;
		}
		if($direccion_go.length == 0 || $direccion_go.length == ""){
			console.log("Dirección");
			$("#direccion_error").text('La dirección no es correcta o está incompleta, Recuerds que es necesario el número');
			$("#dir33").addClass("input_error");

			$return = false;
		}
		if($direccion_go.length == 0 || $direccion_go.length == ""){
			console.log("Dirección");
			$("#direccion_error").text('La dirección no es correcta o está incompleta, Recuerda que es necesario el número');
			$("#dir33").addClass("input_error");

			$return = false;
		}

		/* Codigo postal */
		var filter_cp = /^(?:0?[1-9]|[1-4]\d|5[0-2])\d{3}$/;

		if($cp.length == 0 || $cp.length == ""){
			$("#direccion_cp_error").text('Código postal incompleto');
			$("#direccion_cp").addClass("input_error");
			$return = false;
		}else if(!filter_cp.test($cp)) {
			$("#direccion_cp_error").text('Código postal incorrecto');
			$("#direccion_cp").addClass("input_error");
			$return = false;
		}

		if($return){
			loading.show();

			$.ajax({

				url: BASE_URL + 'clientes/ajax_crear_direccion',
				dataType: 'json',
				method: 'post',
				data: {
					id: '<?php echo $cliente->id; ?>',
					piso : $piso,
					cp : $cp,
					latitud: $latitud,
					longitud : $longitud,
					direccion_go : $direccion_go,
					numero : $numero,
					contacto_persona: $contacto_persona,
					contacto_telefono: $contacto_telefono
				},
				success: function(data){

					if(data.result == "success"){
						window.location.href = BASE_URL  + 'clientes/direcciones/' + '<?php echo $cliente->id; ?>';
					}
				},
				error: function(){
					swal.fire("Error","No ha sido posible añadir  la dirección","error");
					loading.hide();
				}

			});

		}



	});

	$(document).on("focusout",".input_error",function(){

		$(this).removeClass("input_error");
		var $err = $(this).data("error");
		$("#" + $err).text('');

	});
</script>
