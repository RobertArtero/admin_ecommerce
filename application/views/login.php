<div class="content p-0">
	<div class="container">
			<div class="col-md-6 mx-auto"  style="    transform: translateY(50%);">
				<div class="wd-100p">
					<h3 class="tx-color-01 mg-b-5">Iniciar sesión</h3>
					<p class="tx-color-03 tx-16 mg-b-40">Administrador tienda online</p>

					<div class="form-group">
						<label>Email</label>
						<input type="email" id="login_email" class="form-control" placeholder="Introducir email">
					</div>
					<div class="form-group">
						<div class="d-flex justify-content-between mg-b-5">
							<label class="mg-b-0-f">Contraseña</label>
						</div>
						<input type="password" id="login_ps" class="form-control" placeholder="Introducir contraseña">
					</div>
					<button class="btn btn-brand-02 btn-block btn-iniciar-sesion">Iniciar sesión</button>
				</div>
			</div>
	</div>
</div>

<script>


    $(document).ready(function(){

        var $return_sesion = true;
        var loading = $(".loading");


        var iniciar_sesion = function(){

            var $email =  $("#login_email").val();
            var $ps = $("#login_ps").val();

            if($email.length == 0 || $ps.length == 0){
                swal.fire("Error","Para iniciar sesión tienes que completar los campos","warning");
                $return_sesion = false;
            }

            if($return_sesion){
                loading.show();

                $.ajax({
                    url : BASE_URL + 'login/ajax_iniciar_sesion',
                    dataType : 'json',
                    method : 'post',
                    data: {
                        email : $email,
                        ps : $ps
                    },
                    success: function(data){

                      if (data.result == "success"){
                           window.location.href = BASE_URL + 'panel';
                      }else{
                          swal.fire(data.titulo,data.mensaje,"warning");
                          loading.hide();
                      }

                    },
                    error: function(){

                        swal.fire("Error","Error","error");
                        loading.hide();

                    }
                });
            }

        };

        $(".btn-iniciar-sesion").on("click",function(){
            iniciar_sesion();
        });

        $('#login_email').add('#login_ps').keyup(function(e){
            if(e.keyCode == 13) {
                iniciar_sesion();
            }
        });


    });

</script>
