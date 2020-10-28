<?php

class MY_Controller extends CI_Controller
{

	public $nombre_empresa;
	public $nombre_fiscal_empresa;
	public $direccion_empresa;
	public $telefono_empresa;
	public $email_empresa;

	public $usuario;
	public $por_pagina = 30;

    function  __construct()
    {
        parent::__construct();
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        $this->nombre_empresa = $this->config->item("nombre_empresa");
		$this->nombre_fiscal_empresa = $this->config->item("nombre_fiscal_empresa");

		$this->direccion_empresa = $this->config->item("direccion_empresa");
		$this->telefono_empresa = $this->config->item("telefono_empresa");
		$this->email_empresa = $this->config->item("email_empresa");

        if(isset($this->session->id_usuario) and $this->session->userdata("sesion_iniciada") == 1) {

        	$this->usuario = $this->db->get_where("administradores", array(
        		"id"=> $this->session->id_usuario
			))->row();

		}


        if($this->session->userdata("sesion_iniciada") == 1 && __class() == "login"){
        	redirect(base_url("panel"));
		}


        /*
         *
         * Control de sesión
         *
         * */

		$authExceptions = array(
			"login"     => array("index","ajax_iniciar_sesion")
		);


		$this->calledClass = $this->router->fetch_class();
		$this->calledMethod = $this->router->fetch_method();

		$this->isAuthException = array_key_exists($this->calledClass,$authExceptions) && in_array($this->calledMethod, $authExceptions[$this->calledClass]);


		if(!$this->isAuthException && !isset($this->session->id_usuario))
		{
			redirect('login');
		}
        /*
         *
         *
         *  Fin control de sesión
         *
         */



    }

    protected function __email($email,$asunto,$contenido){

        $this->email->initialize($this->config->item('email_config'));

        $data = array();

        $this->email->set_mailtype("html");
        $this->email->from($this->config->item('email'), $this->config->item('email_nombre'));
        $this->email->to($email);
        $this->email->subject($asunto);


        $this->email->message($mensaje = $this->load->view('mail/mailv2', array(

            "titulo" => $contenido["titulo"],
            "descripcion" =>$contenido["descripcion"],
            "link" => $contenido["link"],
            "boton" => $contenido["boton"]

        ), TRUE));

        $this->email->send();

    }

    protected function __email_pedido($transaccion){

        $this->email->initialize($this->config->item('email_config'));

        $this->email->set_mailtype("html");
        $this->email->from($this->config->item('email'), $this->config->item('email_nombre'));
        $this->email->to($transaccion->email);
        $this->email->subject('Pedido confirmado para el día ' . __arreglo_fecha_completa($transaccion->fecha_entrega));

        $this->email->message($mensaje = $this->load->view('mail/payv2', array("pedido"=>$transaccion), TRUE));

        $this->email->send();

    }

    protected function registro_inicio_sesion($id_usuario = ""){

        $ip_info = json_decode(@file_get_contents('http://www.ip-api.com/json/'.$this->input->ip_address()));
        $this->load->library('user_agent');

        $navegador = $this->agent->browser() . " " . $this->agent->version();
        $sistema_operativo = $this->agent->platform();



        $error = true;

        if($ip_info){

            if($ip_info->status == "success"){

                $d = array("ip" => $this->input->ip_address(),
                    "id_usuario" => $id_usuario,
                    "pais" =>$ip_info->country,
                    "codigo_pais"=>$ip_info->countryCode,
                    "ciudad"=>$ip_info->city,
                    "isp"=>$ip_info->isp,
                    "lat"=>$ip_info->lat,
                    "lon"=>$ip_info->lon,
                    "navegador"=> $navegador,
                    "sistema_operativo"=>$sistema_operativo
                );

                $error = false;

            }

        }

        if($error){
            $d = array(
                "ip" => $this->input->ip_address(),
                "id_usuario" => $id_usuario,
                "navegador"=> $navegador,
                "sistema_operativo"=>$sistema_operativo
            );
        }

        $this->db->insert("administradores_control_sesion",$d);

    }

    protected function __random() {
        $letras = "abcdefghijklmnopqrstuvwxyz";
        $numeros = "0123456789";
        return substr(str_shuffle($letras),0,3) . substr(str_shuffle($numeros),0,3);
    }


	protected function __paginacion($url, $total, $per_page = 10, $uri = 3)
	{

		$config['base_url'] = $url;
		$config['total_rows'] =  $total;
		$config['per_page'] = $per_page;
		$config['use_page_numbers'] = TRUE;


		$config['first_link'] = false;
		$config['last_link'] = false;
		$config['reuse_query_string'] = TRUE;
		$config['anchor_class'] = 'page-link';
		$config['num_links'] = 3;

		$config['uri_segment'] = $uri;


		$config['full_tag_open'] = '<nav style="margin: 0 auto;" aria-label="Page navigation example"><ul class="pagination" style="float: right;margin-right: 10px;">';
		$config['full_tag_close'] = '</ul></nav>';

		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['attributes'] = array('class' => 'page-link');

		$config['first_link'] = false;
		$config['last_link'] = false;
		$config['first_tag_open'] = '<li class="page-item">';
		$config['first_tag_close'] = '</li>';
		$config['prev_link'] = '&laquo';
		$config['prev_tag_open'] = '<li class="page-item">';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = '&raquo';
		$config['next_tag_open'] = '<li class="page-item">';
		$config['next_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li class="page-item">';
		$config['last_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';
		$config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';
		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';

		return $config;

	}

	protected function __comprobar_cp($cp){

		$resultado = $this->db->get_where("codigo_postal",array("codigo_postal"=>$cp,"activo"=>1));

		if($resultado->num_rows() > 0){
			return true;
		}else{
			return false;
		}

	}

	protected function __envio_shargo($transaccion){


		$this->load->library("Shargo");

		/**
		 *
		 * Calculo de las bolsas
		 *
		 */


		$numero_maximo_en_bolsa = 5;
		$y = 1;


		if($y > 0){

			//Calculo de cuantas bolsas necesito para una compra

			for($i=0;$i<$transaccion->total_productos;$i++){

				if($i%$numero_maximo_en_bolsa == 0){

					$y++;

				}

			}

		}

		if($y == 0){

			$y = 1;

		}


		/**
		 *
		 * Solicitud del shargo
		 *
		 */


		$shargo_json = $this->shargo->solicitar(array(

			"o_direccion"  => "Carrer de Tamarit, 10, 08205 Sabadell, Barcelona, España",
			"o_latitud"  => 41.5304339,
			"o_longitud"  => 2.1023763,

			"o_comentarios"  => "Pedido: " . $transaccion->id . " - Recoger a las 10:00AM",

			"d_direccion"  => $transaccion->direccion_google,
			"d_latitud"  =>   $transaccion->altitud,
			"d_longitud"  =>  $transaccion->longitud,

			"d_comentarios"  => "Pedido: " . $transaccion->id . " - Recoger a las 10:00AM",

			"d_nombre"  => $transaccion->nombre,
			"d_telefono"  => $transaccion->telefono,

			"d_items"  => $y,
			"d_transport"  => 1,

			"d_fecha"  => $transaccion->fecha_entrega


		));

		/**
		 *
		 * Envío de respuesta a base de datos
		 *
		 */

		if(!$shargo_json){

			$this->db

				->where('id', $transaccion->id)
				->set('shargo_error', 1)
				->set('shargo_code_error', 999)
				->set('shargo_error_mensaje', 'La api no devolvió ninguna respuesta. el pedido no está tramitado a Shargo')

				->update('pedidos');

		}

		if(isset($shargo_json->status)){


			$this->db->where('id', $transaccion->id);

			if(isset($shargo_json->trackingLink)){
				$this->db->set('shargo_tracking', $shargo_json->trackingLink);
			}
			if(isset($shargo_json->id)){
				$this->db->set('shargo_id',  $shargo_json->id);
			}
			if(isset($shargo_json->scheduledAt)){
				$this->db->set('shargo_programado',  $shargo_json->scheduledAt);
			}
			if(isset($shargo_json->status)){
				$this->db->set('shargo_estado', $shargo_json->status);
			}
			if(isset($shargo_json->price->amount)){
				$this->db->set('shargo_precio', $shargo_json->price->amount);
			}

			$this->db->set('shargo_error', 0);
			$this->db->set('shargo_code_error',  NULL);
			$this->db->set('shargo_error_mensaje',  NULL);
			$this->db->set('shargo_json', json_encode($shargo_json) );


			$this->db->update('pedidos');


		}

		if(isset($shargo_json->code)){


			//si entra aqui es que falla el sistema

			$this->db

				->where('id', $transaccion->id)

				->set('shargo_error', 1)
				->set('shargo_code_error',  $shargo_json->code)
				->set('shargo_error_mensaje',  $shargo_json->message)

				->update('pedidos');

		}


	}

	protected static function __slug($text) {
		$text = preg_replace('~[^\pL\d]+~u', '-', $text);
		$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
		$text = preg_replace('~[^-\w]+~', '', $text);
		$text = trim($text, '-');
		$text = preg_replace('~-+~', '-', $text);
		$text = strtolower($text);
		if (empty($text)) {
			return 'producto-sin-nombre';
		}
		return $text;
	}
	protected function __remover_extension($file){
		return substr($file, 0 , (strrpos($file, ".")));
	}


}

