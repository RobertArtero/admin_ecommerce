<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {


	public function __construct()
	{
		parent::__construct();

		foreach ($_POST as $key => $item) {
			$_POST[$key] = $this->security->xss_clean($item);
		}

		foreach ($_GET as $key => $item) {
			$_GET[$key] = $this->security->xss_clean($item);
		}

		foreach ($_SESSION as $key => $item) {
			$_SESSION[$key] = $this->security->xss_clean($item);
		}

		foreach ($_COOKIE as $key => $item) {
			$_COOKIE[$key] = $this->security->xss_clean($item);
		}


	}



	public function index(){

		$data = array();

		$this->load->view('base/header',$data);
		$this->load->view('login');
		$this->load->view('base/footer');
	}


	public function ajax_iniciar_sesion(){

		$email = $this->input->post("email");
		$password = $this->input->post("ps");


		if(empty($email) or empty($password)){
			echo json_encode(array("result"=>"error","titulo"=>"Error","mensaje"=>"Es obligatorio completar todos los campos"));
			return false;
		}

		if(strlen($email) == 0 or $email == "" or !preg_match('/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}/', $email)){
			echo json_encode(array("result"=>"error","titulo"=>"Error","mensaje"=>"El email no es correcto"));
			return false;
		}

		$admin = $this->db->get_where("administradores",array("email"=>$email,"activo"=>1));

		if($admin->num_rows() > 0){

			$admin_r = $admin->row();

			if($admin_r->email === $email){

				if(password_verify($password, $admin_r->password)){

					$this->session->set_userdata(array(
						"id_usuario" =>  $admin_r->id,
						"sesion_iniciada" => 1,
					));

					$this->db->where("id",$admin_r->id)->update("clientes",array(
						"fecha_ultima_conexion"=> date("Y-m-d H:i:s"),
						"ip" =>$this->input->ip_address()
					));


					echo json_encode(array("result"=>"success","titulo"=>"Sesión iniciada","mensaje"=>"La sesión se ha iniciado de forma correcta"));
					return true;

				}else{

					$this->registro_inicio_sesion($admin_r->id);

					echo json_encode(array("result"=>"error","titulo"=>"Error","mensaje"=>"La contraseña no es correcta"));
					return false;

				}

			}else{

				echo json_encode(array("result"=>"error","titulo"=>"Error","mensaje"=>"Error al iniciar sesión"));
				return false;

			}

		}else{

			echo json_encode(array("result"=>"error","titulo"=>"Error","mensaje"=>"El correo electrónico no está registrado"));
			return false;

		}

	}

}
